<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

/**
 * جستجوی ساده و بدون وابستگی در پایگاه دانش (جدول‌های ai_knowledge_*).
 * چانک‌ها به بخش‌های کوچک (~۹۰۰ نویسه) شکسته و با امتیازدهی BM25-مانند رتبه‌بندی می‌شوند.
 * بدون embedding و بدون سرویس خارجی.
 */
class KnowledgeRetriever
{
    private const WINDOW_CHARS = 900;
    private const MAX_RESULTS  = 5;

    private const STOPWORDS = [
        'و','در','به','از','که','را','با','این','آن','است','بود','شد','شود','می','باید','برای','یا','هم','تا','بر',
        'ها','های','یک','چه','چی','چرا','چطور','چگونه','کدام','آیا','من','ما','شما','او','ان','اگر','اما','ولی','نیز',
        'هر','همه','کند','کنند','کنم','بگو','بگویید','توضیح','لطفا','لطفاً','درباره','مورد','چیست','هست','نیست',
        'باشد','باشند','دارد','دارند','چقدر','نحوه','عکس','تصویر','داره','میشه','میکنه','کنید','سلام','ممنون','مرسی',
        'داریم','چند','کی','بشه','روی','بدون','خیلی','لطفاََ','بده','بدهید','میخوام','میخواهم',
        // کلمه‌های «درخواست منبع» که موضوع را مشخص نمی‌کنند و فقط سقف کلمات و پوشش جستجو را خراب می‌کنند
        'طبق','آیین','نامه','شماره','مربوطه','مربوط','ذکر','بنویس','بیاور','مشخص','کن','کنید','حداقل','حداکثر',
    ];

    /** اگر کلمه‌ی کلیدی انگلیسی یا آوانگاری غلط آمد، معادل فارسیِ موجود در منابع جستجو شود */
    private const ALIASES = [
        'ladder' => 'نردبان', 'ladders' => 'نردبان', 'لدرا' => 'نردبان', 'ادر' => 'نردبان',
        'scaffold' => 'داربست', 'scaffolding' => 'داربست',
        'harness' => 'کمربند ایمنی', 'helmet' => 'کلاه ایمنی', 'fall' => 'سقوط',
        'forklift' => 'لیفتراک', 'fire' => 'آتش', 'extinguisher' => 'خاموش کننده',
        'ppe' => 'وسایل حفاظت فردی', 'کمربند' => 'کمربند هارنس حمایل', 'هارنس' => 'هارنس حمایل کمربند', 'electric' => 'برق', 'crane' => 'جرثقیل',
    ];

    private const TYPE_LABELS = [
        'iranian_law'        => 'قانون',
        'iranian_regulation' => 'آیین‌نامه',
        'secondary_source'   => 'منبع ثانویه و غیررسمی',
    ];

    /**
     * @return array<int, array{title:string,type:string,chapter:?string,article:?string,text:string,score:float}>
     */
    public function search(string $query, int $limit = self::MAX_RESULTS): array
    {
        $terms = $this->terms($query);
        if (!$terms) {
            return [];
        }

        $windows = $this->buildWindows();
        $n = count($windows);
        if ($n === 0) {
            return [];
        }

        $termCount = count($terms);
        $counts = [];               // [windowIndex][termIndex] => tf
        $df = array_fill(0, $termCount, 0);

        foreach ($windows as $wi => $w) {
            foreach ($terms as $ti => $term) {
                $len = mb_strlen($term);
                $tf = 0;
                foreach ($w['tf'] as $token => $c) {
                    if (str_starts_with((string) $token, $term) && (mb_strlen((string) $token) - $len) <= 3) {
                        $tf += $c;
                    }
                }
                if ($tf > 0) {
                    $counts[$wi][$ti] = $tf;
                    $df[$ti]++;
                }
            }
        }

        $idf = [];
        foreach ($df as $ti => $d) {
            $idf[$ti] = log(1 + ($n - $d + 0.5) / ($d + 0.5));
        }

        $scored = [];
        foreach ($counts as $wi => $row) {
            $sum = 0.0;
            foreach ($row as $ti => $tf) {
                $sum += $idf[$ti] * (1 + log($tf));
            }
            $matched = count($row);
            $cov = $matched / $termCount;
            $scored[] = [
                'wi'      => $wi,
                'score'   => $sum * (0.5 + 0.5 * $cov),
                'matched' => $matched,
                'cov'     => $cov,
            ];
        }

        if (!$scored) {
            return [];
        }

        usort($scored, fn ($a, $b) => $b['score'] <=> $a['score']);

        $best     = $scored[0]['score'];
        $minScore = min(5.0, 2.2 * $termCount);
        $minMatch = min(2, $termCount);
        $minCov   = $termCount >= 5 ? 0.3 : 0.5;

        $hits = [];
        $shown = [];
        foreach ($scored as $s) {
            if ($s['matched'] < $minMatch || $s['cov'] < $minCov || $s['score'] < $minScore || $s['score'] < 0.4 * $best) {
                continue;
            }
            $w = $windows[$s['wi']];
            // نسخه‌های تکراریِ یک سند (چند بار import، املای کمی متفاوت) فقط یک بار در خروجی بیایند
            $dupKey = md5(mb_substr(preg_replace('/\s+/u', '', $this->normalize($w['text'])), 0, 120));
            if (isset($shown[$dupKey])) {
                continue;
            }
            $shown[$dupKey] = true;
            $hits[] = [
                'title'   => $w['title'],
                'type'    => $w['type'],
                'chapter' => $w['chapter'],
                'article' => $w['article'],
                'text'    => $w['text'],
                'score'   => round($s['score'], 2),
            ];
            if (count($hits) >= $limit) {
                break;
            }
        }

        return $hits;
    }

    /** کلمات کلیدی پرسش (نرمال‌سازی‌شده، بدون حروف اضافه) */
    public function terms(string $query): array
    {
        $out = [];
        foreach ($this->tokenize($query) as $tok) {
            if (in_array($tok, self::STOPWORDS, true)) {
                continue;
            }
            if (isset(self::ALIASES[$tok])) {
                foreach ($this->tokenize(self::ALIASES[$tok]) as $a) {
                    $out[$a] = true;
                }
                continue;
            }
            if (mb_strlen($tok) > 4 && str_ends_with($tok, 'های')) {
                $tok = mb_substr($tok, 0, -3);
            } elseif (mb_strlen($tok) > 3 && str_ends_with($tok, 'ها')) {
                $tok = mb_substr($tok, 0, -2);
            }
            // «ارتفاعی/قانونی» → «ارتفاع/قانون» (جستجو پیشوندی است، پس «ایمنی» با «ایمن» هم پیدا می‌شود)
            if (mb_strlen($tok) > 4 && str_ends_with($tok, 'ی') && !preg_match('/^[a-z0-9]+$/', $tok)) {
                $tok = mb_substr($tok, 0, -1);
            }
            if (mb_strlen($tok) < 3 && !preg_match('/^[a-z0-9]{2,}$/', $tok)) {
                continue;
            }
            $out[$tok] = true;
        }

        return array_slice(array_keys($out), 0, 14);
    }

    // ─────────────────────────────────────────────────────────────

    /**
     * کلمه‌های موضوعی یک متن (مثلاً پاسخ قبلی دستیار) برای پرسش‌های پیگیری:
     * کلمه‌هایی که در پایگاه دانش حداقل ۳ بار آمده‌اند، به ترتیب «تکرار در متن × کمیابی در پایگاه».
     * @return string[]
     */
    public function topicTerms(string $text, int $limit = 6): array
    {
        $windows = $this->buildWindows();
        $n = count($windows);
        if ($n === 0) {
            return [];
        }

        $counts = [];
        foreach ($this->tokenize($text) as $tok) {
            foreach ($this->terms($tok) as $t) {
                $counts[$t] = ($counts[$t] ?? 0) + 1;
            }
        }

        $scores = [];
        foreach ($counts as $term => $c) {
            $len = mb_strlen($term);
            $df = 0;
            foreach ($windows as $w) {
                foreach ($w['tf'] as $token => $_) {
                    if (str_starts_with((string) $token, $term) && (mb_strlen((string) $token) - $len) <= 3) {
                        $df++;
                        break;
                    }
                }
            }
            if ($df >= 3) {
                $scores[$term] = $c * log(1 + $n / $df);
            }
        }

        arsort($scores);

        return array_slice(array_keys($scores), 0, $limit);
    }

    /**
     * جستجوی سطح «ماده»: هر ماده‌ی آیین‌نامه یک واحد است (برخلاف search که پنجره‌های ~۹۰۰ نویسه‌ای دارد).
     * برای نقل مستقیم ماده‌ی مرتبط با هر خطر، بدون اینکه مدل شماره یا متن ماده را بسازد.
     *
     * @param string[] $titles اگر خالی نباشد فقط سندهایی با این عنوان
     * @return array<int, array{title:string,article:string,text:string,score:float}>
     */
    public function searchArticles(string $query, int $limit = 2, array $titles = []): array
    {
        // اگر کاربر شماره ماده را صریحاً خواسته، شماره باید یک فیلتر قطعی باشد؛
        // جستجوی واژه‌ایِ «ماده 24» به‌تنهایی ممکن است ماده‌های تصادفی را برگرداند.
        $requestedArticle = $this->requestedArticleNumber($query);

        $terms = $this->terms($query);
        if (!$terms && $requestedArticle === null) {
            return [];
        }

        $units = $this->buildArticleUnits($titles);

        if ($requestedArticle !== null) {
            $exact = array_values(array_filter(
                $units,
                fn ($u) => (string) $u['article'] === $requestedArticle
            ));
            if ($exact) {
                $units = $exact;
            }
        }
        $n = count($units);
        if ($n === 0) {
            return [];
        }

        $tc = count($terms);
        $df = array_fill(0, $tc, 0);
        $counts = [];
        foreach ($units as $ui => $u) {
            foreach ($terms as $ti => $term) {
                $len = mb_strlen($term);
                $tf = 0;
                foreach ($u['tf'] as $token => $c) {
                    if (str_starts_with((string) $token, $term) && (mb_strlen((string) $token) - $len) <= 3) {
                        $tf += $c;
                    }
                }
                if ($tf > 0) {
                    $counts[$ui][$ti] = $tf;
                    $df[$ti]++;
                }
            }
        }

        $idf = [];
        foreach ($df as $ti => $d) {
            $idf[$ti] = log(1 + ($n - $d + 0.5) / ($d + 0.5));
        }

        $scored = [];
        foreach ($counts as $ui => $row) {
            if (count($row) < min(2, $tc)) {
                continue;
            }
            $sum = 0.0;
            foreach ($row as $ti => $tf) {
                $sum += $idf[$ti] * (1 + log($tf));
            }

            // تقویت عمومیِ پرسش‌های تعریفی/آستانه‌ای: هر سندی که خودِ متنش
            // رابطه‌ی «بیش از X نسبت به سطح/مبنای ...» را دارد، برای سؤال‌هایی
            // مثل «از چه ارتفاعی/حداقل چقدر/چه زمانی محسوب می‌شود» اولویت می‌گیرد.
            // این منطق به هیچ آیین‌نامه یا عدد خاصی وابسته نیست.
            $intentBoost = 0.0;
            $q = $this->normalize($query);
            $definitionIntent = preg_match('/(?:از\s+چه|حداقل|حداکثر|چه\s+زمانی|چه\s+مقدار|چند\s+متر|محسوب\s+می.?شود|تعریف)/u', $q);
            if ($definitionIntent) {
                $textNorm = $this->normalize($units[$ui]['text']);
                if (preg_match('/بیش\s+از\s+[0-9۰-۹]+(?:\s*\/\s*[0-9۰-۹]+)?\s*(?:متر|سانتی.?متر|میلی.?متر)?/u', $textNorm)) {
                    $intentBoost += 2.5;
                }
                if (str_contains($textNorm, 'نسبت به سطح مبنا') || str_contains($textNorm, 'سطح مبنا')) {
                    $intentBoost += 2.0;
                }
                if (preg_match('/(?:کار|فعالیت).*?(?:محسوب|انجام|تعریف)/u', $textNorm)) {
                    $intentBoost += 1.0;
                }
            }

            $scored[$ui] = $sum * (0.5 + 0.5 * count($row) / $tc) + $intentBoost;
        }
        if (!$scored) {
            return [];
        }

        arsort($scored);
        $best = reset($scored);
        $out = [];
        foreach ($scored as $ui => $score) {
            if ($score < 0.8 * $best) {
                break;
            }
            $u = $units[$ui];
            $out[] = ['title' => $u['title'], 'article' => $u['article'], 'text' => $u['text'], 'score' => round($score, 2)];
            if (count($out) >= $limit) {
                break;
            }
        }

        return $out;
    }

    /**
     * شماره ماده‌ای که کاربر صریحاً درخواست کرده است.
     * فقط الگوهای «ماده 24»، «ماده-24» و «ماده:24» را می‌گیرد تا ارجاعاتی
     * مثل «ماده 85 قانون کار» هم به‌صورت قابل پیش‌بینی مدیریت شوند.
     */
    private function requestedArticleNumber(string $query): ?string
    {
        $q = $this->normalize($query);
        if (!preg_match('/(?:^|\s)ماده\s*[-–:]?\s*([0-9]{1,3})(?=\s|$|[،,:؛.)])/u', $q, $m)) {
            return null;
        }

        return $this->normalize($m[1]);
    }

    /** @return array<int, array<string,mixed>> */
    private function buildArticleUnits(array $titles): array
    {
        $rows = DB::table('ai_knowledge_chunks as c')
            ->join('ai_knowledge_documents as d', 'd.id', '=', 'c.ai_knowledge_document_id')
            ->where('d.status', 'active')
            ->orderBy('c.ai_knowledge_document_id')
            ->orderBy('c.chunk_index')
            ->get(['c.ai_knowledge_document_id as doc_id', 'c.content', 'd.title']);

        // متن هر سند را کامل به هم می‌چسبانیم تا ماده‌ای که بین دو تکه شکسته شده کامل شود
        $docs = [];
        foreach ($rows as $row) {
            if ($titles && !in_array((string) $row->title, $titles, true)) {
                continue;
            }
            $docs[$row->doc_id]['title'] = (string) $row->title;
            $docs[$row->doc_id]['text'] = ($docs[$row->doc_id]['text'] ?? '') . "\n" . $row->content;
        }

        $units = [];
        $seen = [];
        foreach ($docs as $doc) {
            // سرتیتر ماده همیشه با خط تیره یا دونقطه می‌آید («ماده -25»، «ماده :19»)؛ «ماده 85قانون کار» ارجاع است، نه سرتیتر
            // PDFها و منابع وب از چند شکل «ماده 24 / ماده-24 / مادهـ24» استفاده می‌کنند.
            $parts = preg_split('/(?=ماده\s*[-–:ـ]?\s*[0-9۰-۹٠-٩]{1,3}(?![0-9۰-۹٠-٩]))/u', $doc['text'], -1, PREG_SPLIT_NO_EMPTY) ?: [];
            foreach ($parts as $part) {
                if (!preg_match('/^ماده\s*[-–:ـ]?\s*([0-9۰-۹٠-٩]{1,3})/u', $part, $m)) {
                    continue;
                }
                $article = $this->normalize($m[1]);
                $text = trim($part);
                // ماده‌ی آخرِ هر فصل/سند نباید عنوان فصل بعدی یا ضمیمه‌ها را هم بکشد
                $cut = preg_split('/\s[0-9۰-۹]{0,2}\s*(?:فصل\s+(?:اول|دوم|سوم|چهارم|پنجم|ششم|هفتم|هشتم|نهم|دهم)|ضمائم|ضمایم|ضمیمه)/u', $text, 2);
                $text = trim($cut[0]);
                if (mb_strlen($text) > 700) {
                    $text = mb_substr($text, 0, 700);
                }
                $key = md5($doc['title'] . '|' . $article . '|' . mb_substr($this->normalize($text), 0, 80));
                if (isset($seen[$key])) {
                    continue; // سند تکراری (چند بار import شده)
                }
                $seen[$key] = true;

                $tokens = $this->tokenize($text);
                if (!$tokens) {
                    continue;
                }
                $units[] = ['title' => $doc['title'], 'article' => $article, 'text' => $text, 'tf' => array_count_values($tokens)];
            }
        }

        return $units;
    }

    /** @return array<int, array<string,mixed>> */
    private function buildWindows(): array
    {
        $rows = DB::table('ai_knowledge_chunks as c')
            ->join('ai_knowledge_documents as d', 'd.id', '=', 'c.ai_knowledge_document_id')
            ->where('d.status', 'active')
            ->orderBy('c.ai_knowledge_document_id')
            ->orderBy('c.chunk_index')
            ->get(['c.content', 'c.chapter', 'c.article_number', 'd.title', 'd.source_type']);

        $windows = [];
        $seen = [];

        foreach ($rows as $row) {
            $chapter = $this->chapterLabel($row->chapter);
            $type = self::TYPE_LABELS[$row->source_type] ?? 'سند';

            foreach ($this->splitWindows((string) $row->content) as $text) {
                $norm = $this->normalize($text);
                $key = md5(mb_substr($norm, 0, 300));
                if (isset($seen[$key])) {
                    continue; // سند تکراری (چند بار import شده)
                }
                $seen[$key] = true;

                $tokens = $this->tokenize($text);
                if (!$tokens) {
                    continue;
                }

                $windows[] = [
                    'title'   => (string) $row->title,
                    'type'    => $type,
                    'chapter' => $chapter,
                    'article' => $this->articleLabel($text, $row->article_number),
                    'text'    => $text,
                    'tf'      => array_count_values($tokens),
                ];
            }
        }

        return $windows;
    }

    /** @return string[] */
    private function splitWindows(string $content): array
    {
        $paras = preg_split('/\n\s*\n/u', trim($content)) ?: [];
        $out = [];
        $cur = '';

        foreach ($paras as $p) {
            $p = trim($p);
            if ($p === '') {
                continue;
            }
            // پاراگراف خیلی بلند را هم می‌شکنیم
            while (mb_strlen($p) > self::WINDOW_CHARS * 1.5) {
                if ($cur !== '') {
                    $out[] = $cur;
                    $cur = '';
                }
                $out[] = mb_substr($p, 0, self::WINDOW_CHARS);
                $p = mb_substr($p, self::WINDOW_CHARS);
            }
            if ($cur !== '' && mb_strlen($cur) + mb_strlen($p) > self::WINDOW_CHARS) {
                $out[] = $cur;
                $cur = '';
            }
            $cur = $cur === '' ? $p : $cur . "\n\n" . $p;
        }
        if ($cur !== '') {
            $out[] = $cur;
        }

        return $out;
    }

    private function articleLabel(string $text, mixed $fallback): ?string
    {
        // «به استناد ماده 85 قانون کار» ارجاع به قانون دیگری است، نه شماره‌ی ماده‌ی همین سند
        if (preg_match_all('/ماده\s*[:\-–]?\s*([0-9۰-۹٠-٩]{1,3})(?!\s*(?:قانون|قانو))/u', $text, $m) && $m[1]) {
            $nums = array_values(array_unique(array_map(fn ($x) => $this->normalize($x), $m[1])));
            return count($nums) > 1 ? $nums[0] . ' تا ' . end($nums) : $nums[0];
        }

        // ستون article_number در داده‌های فعلی برای بعضی سندها غلط است (مثلاً ۸۵ برای همه‌ی تکه‌های آیین‌نامه‌ی ارتفاع)؛
        // شماره‌ی بدون پشتوانه در متن به مدل داده نمی‌شود.
        return null;
    }

    private function chapterLabel(mixed $chapter): ?string
    {
        if (!$chapter) {
            return null;
        }
        $decoded = json_decode((string) $chapter, true);
        if (is_array($decoded)) {
            $chapter = implode(' / ', array_filter(array_map('strval', $decoded)));
        }

        return trim((string) $chapter) ?: null;
    }

    /** @return string[] */
    private function tokenize(string $text): array
    {
        // در متن منابع عدد و واحد چسبیده است («1/2متر» → «2متر»)؛ مرز عدد/حرف را جدا می‌کنیم تا «متر» پیدا شود
        $norm = preg_replace('/(?<=\p{N})(?=\p{L})|(?<=\p{L})(?=\p{N})/u', ' ', $this->normalize($text)) ?? $this->normalize($text);

        return preg_split('/[^\p{L}\p{N}]+/u', $norm, -1, PREG_SPLIT_NO_EMPTY) ?: [];
    }

    /**
     * یکسان‌سازی حروف عربی/فارسی، ارقام و نیم‌فاصله.
     * «لا»→«ا» عمداً روی هر دو طرف (متن و پرسش) اعمال می‌شود، چون استخراج PDF در متن منابع
     * «ل» را انداخته است (مثل «اسالمی» به جای «اسلامی») و بدون این کار جستجو گم می‌شود.
     */
    private function normalize(string $t): string
    {
        if (class_exists(\Normalizer::class)) {
            $t = \Normalizer::normalize($t, \Normalizer::FORM_KC) ?: $t;
        }

        $t = strtr($t, [
            'ي' => 'ی', 'ى' => 'ی', 'ك' => 'ک', 'ۀ' => 'ه', 'ة' => 'ه', 'ھ' => 'ه', 'ہ' => 'ه',
            'أ' => 'ا', 'إ' => 'ا', 'ٱ' => 'ا', 'ؤ' => 'و',
            "\u{200C}" => ' ', "\u{200E}" => ' ', "\u{200F}" => ' ',
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);

        $t = preg_replace('/[\x{064B}-\x{065F}\x{0670}\x{0640}]/u', '', $t) ?? $t;
        $t = str_replace('لا', 'ا', $t);

        return mb_strtolower($t);
    }
}
