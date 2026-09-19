<?php

namespace App\Services;

use App\Models\AiKnowledgeChunk;

class AiKnowledgeService
{
    /**
     * بازیابی منابع دانش HSE بدون نیاز به Vector DB یا سرویس Embedding.
     *
     * نکته مهم:
     * - عنوان سند هم در candidate retrieval بررسی می‌شود؛ بنابراین اگر کاربر
     *   نام یک آیین‌نامه را صریحاً بگوید، چانک‌های همان سند حتی در صورت کم بودن
     *   تطابق کلمات متن، از دست نمی‌روند.
     * - برای سوالات حقوقی/مقرراتی، قانون و آیین‌نامه ایرانی بر منابع ثانویه مقدم است.
     * - برای سوال «بر اساس کدام ماده/بند؟» چانک دارای شماره ماده/بند اولویت بالاتری دارد.
     */
    public function search(string $question, int $limit = 6): array
    {
        $question = $this->normalize($question);
        $terms = $this->extractTerms($question);

        if ($terms === []) {
            return [];
        }

        $isLegalQuestion = $this->looksLegal($question);
        $isArticleQuestion = $this->looksLikeArticleRequest($question);
        $regulationHints = $this->extractRegulationHints($question);

        // ابتدا اسناد شناخته‌شده موضوعی را مستقیماً پیدا می‌کنیم.
        // این مسیر عمداً مستقل از تطابق کلمات داخل chunk است تا اگر متن chunk
        // با واژه‌های سؤال هم‌خوانی نداشت، سند صحیح از دست نرود.
        $topicDocumentIds = [];
        if ($regulationHints !== []) {
            $topicDocumentIds = AiKnowledgeChunk::query()
                ->whereHas('document', function ($docQuery) use ($regulationHints) {
                    $docQuery->where('status', 'active')
                        ->where(function ($q) use ($regulationHints) {
                            foreach ($regulationHints as $hint) {
                                $q->orWhere('title', 'like', '%' . $hint . '%')
                                    ->orWhere('source_name', 'like', '%' . $hint . '%');
                            }
                        });
                })
                ->pluck('ai_knowledge_document_id')
                ->unique()
                ->values()
                ->all();
        }

        // Candidate retrieval: علاوه بر متن چانک، عنوان/نام منبع سند هم بررسی می‌شود.
        $query = AiKnowledgeChunk::query()
            ->with('document')
            ->whereHas('document', fn ($q) => $q->where('status', 'active'))
            ->where(function ($q) use ($terms, $regulationHints, $topicDocumentIds) {
                if ($topicDocumentIds !== []) {
                    $q->whereIn('ai_knowledge_document_id', $topicDocumentIds);
                }

                foreach ($terms as $term) {
                    $q->orWhere('content', 'like', '%' . $term . '%')
                        ->orWhere('article_number', 'like', '%' . $term . '%')
                        ->orWhere('paragraph_number', 'like', '%' . $term . '%')
                        ->orWhere('chapter', 'like', '%' . $term . '%');

                    $q->orWhereHas('document', function ($docQuery) use ($term) {
                        $docQuery->where('title', 'like', '%' . $term . '%')
                            ->orWhere('source_name', 'like', '%' . $term . '%')
                            ->orWhere('category', 'like', '%' . $term . '%');
                    });
                }

                foreach ($regulationHints as $hint) {
                    $q->orWhereHas('document', function ($docQuery) use ($hint) {
                        $docQuery->where('title', 'like', '%' . $hint . '%')
                            ->orWhere('source_name', 'like', '%' . $hint . '%');
                    });
                }
            })
            ->limit(120)
            ->get();

        $scored = $query->map(function (AiKnowledgeChunk $chunk) use (
            $terms,
            $question,
            $topicDocumentIds,
            $isLegalQuestion,
            $isArticleQuestion,
            $regulationHints
        ) {
            $document = $chunk->document;
            $content = $this->normalize((string) $chunk->content);
            $title = $this->normalize((string) ($document->title ?? ''));
            $sourceName = $this->normalize((string) ($document->source_name ?? ''));
            $category = $this->normalize((string) ($document->category ?? ''));
            $article = $this->normalize((string) ($chunk->article_number ?? ''));
            $paragraph = $this->normalize((string) ($chunk->paragraph_number ?? ''));
            $chapter = $this->normalize((string) ($chunk->chapter ?? ''));

            $haystack = implode(' ', [$content, $title, $sourceName, $category, $article, $paragraph, $chapter]);

            $score = 0;
            $matchedTerms = 0;

            // اگر سند مستقیماً از روی موضوع پیدا شده باشد، امتیاز پایه بالایی می‌گیرد.
            if ($topicDocumentIds !== [] && in_array($document->id, $topicDocumentIds, true)) {
                $score += 60;
            }

            foreach ($terms as $term) {
                if (mb_stripos($haystack, $term) !== false) {
                    $matchedTerms++;
                    $score += 2;
                }

                // تطابق در عنوان سند از تطابق عادی متن مهم‌تر است.
                if (mb_stripos($title, $term) !== false) {
                    $score += 5;
                }
            }

            // تطابق عبارت نام آیین‌نامه، نه فقط تک‌کلمه‌ها.
            foreach ($regulationHints as $hint) {
                if ($hint !== '' && mb_stripos($title, $hint) !== false) {
                    $score += 25;
                }
                if ($hint !== '' && mb_stripos($sourceName, $hint) !== false) {
                    $score += 15;
                }
            }

            if ($isLegalQuestion) {
                if ($document->source_type === 'iranian_law') {
                    $score += 12;
                } elseif ($document->source_type === 'iranian_regulation') {
                    $score += 10;
                } elseif ($document->source_type === 'secondary_source') {
                    $score -= 8;
                }
            }

            if ($isArticleQuestion) {
                if ($article !== '') {
                    $score += 14;
                }
                if ($paragraph !== '') {
                    $score += 5;
                }
                if (preg_match('/(?:^|\s)ماده\s*[۰-۹0-9]+/u', $content)) {
                    $score += 8;
                }
                if (preg_match('/(?:^|\s)(?:بند|تبصره)\s*[الف-یآ-ی۰-۹0-9]+/u', $content)) {
                    $score += 5;
                }
            }

            $score += min($matchedTerms, 8);

            return ['chunk' => $chunk, 'score' => $score];
        })
            ->sortByDesc('score')
            ->take($limit)
            ->values();

        return $scored->map(function (array $item) {
            /** @var AiKnowledgeChunk $chunk */
            $chunk = $item['chunk'];
            $doc = $chunk->document;

            return [
                'document_id' => $doc->id,
                'title' => $doc->title,
                'source_name' => $doc->source_name,
                'source_type' => $doc->source_type,
                'issuing_authority' => $doc->issuing_authority,
                'document_type' => $doc->document_type,
                'status' => $doc->status,
                'article_number' => $chunk->article_number,
                'paragraph_number' => $chunk->paragraph_number,
                'chapter' => $chunk->chapter,
                'page_number' => $chunk->page_number,
                'content' => $chunk->content,
                'source_url' => $doc->source_url,
            ];
        })->all();
    }

    public function formatForPrompt(array $results): string
    {
        if ($results === []) {
            return <<<TEXT
=== منابع HSE بازیابی‌شده ===
برای این پرسش، منبع فعال و مشخصی در پایگاه دانش پیدا نشد.
قانون مهم: نام آیین‌نامه، ماده، بند، تبصره، عدد یا الزام قانونی را حدس نزن و از حافظه مدل به‌عنوان منبع قانونی استفاده نکن.
TEXT;
        }

        $output = "=== منابع HSE بازیابی‌شده ===\n";
        $output .= "قواعد استفاده از منابع:\n";
        $output .= "1) پاسخ حقوقی/مقرراتی را فقط بر اساس منابع بازیابی‌شده بده.\n";
        $output .= "2) اگر کاربر درباره ماده/بند پرسید، شماره ماده/بند را فقط وقتی ذکر کن که در منبع بازیابی‌شده پشتیبانی شود.\n";
        $output .= "3) اگر منابع کافی نیستند، صریحاً بگو منبع کافی پیدا نشد؛ عدد یا ماده را حدس نزن.\n";

        foreach ($results as $index => $result) {
            $output .= "\n[منبع " . ($index + 1) . "]\n";
            $output .= "شناسه سند: {$result['document_id']}\n";
            $output .= "عنوان: {$result['title']}\n";
            $output .= "منبع: {$result['source_name']}\n";
            if (!empty($result['source_type'])) {
                $output .= "نوع منبع: {$result['source_type']}\n";
            }
            if (!empty($result['issuing_authority'])) {
                $output .= "مرجع صادرکننده: {$result['issuing_authority']}\n";
            }
            if (!empty($result['document_type'])) {
                $output .= "نوع سند: {$result['document_type']}\n";
            }
            if (!empty($result['article_number'])) {
                $output .= "ماده/بند ثبت‌شده: {$result['article_number']}\n";
            }
            if (!empty($result['paragraph_number'])) {
                $output .= "شماره پاراگراف: {$result['paragraph_number']}\n";
            }
            if (!empty($result['chapter'])) {
                $output .= "فصل: {$result['chapter']}\n";
            }
            if (!empty($result['page_number'])) {
                $output .= "صفحه PDF: {$result['page_number']}\n";
            }
            $output .= "متن منبع:\n{$result['content']}\n";
            if (!empty($result['source_url'])) {
                $output .= "نشانی منبع: {$result['source_url']}\n";
            }
        }

        return $output;
    }

    private function extractTerms(string $question): array
    {
        $text = $this->normalize($question);

        if ($text === '') {
            return [];
        }

        $text = preg_replace('/[\x{200C}\x{200D}\x{200E}\x{200F}\x{2060}\x{FEFF}]/u', ' ', $text) ?? $text;
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text) ?? $text;

        if (trim($text) === '') {
            return [];
        }

        preg_match_all('/[\p{L}\p{N}]{3,}/u', $text, $matches);
        $words = $matches[0] ?? [];

        $stopWords = [
            'از','به','در','با','برای','که','را','و','یا','این','آن','یک','های','است','هست',
            'شود','شده','کنم','کنید','می','من','ما','چه','چطور','چگونه','آیا','درباره','مورد',
            'طبق','بر','تا','اگر','هم','همه','روی','ای','ترین','کردن','کرد','دارم','دارید',
            'براساس','اساس','برحسب','میشه','میشود','استفاده','مشمول','الزامات','الزام',
        ];

        return array_values(array_unique(array_filter(array_map('mb_strtolower', $words), function ($word) use ($stopWords) {
            return mb_strlen($word, 'UTF-8') >= 3 && !in_array($word, $stopWords, true);
        })));
    }

    private function extractRegulationHints(string $question): array
    {
        $normalized = $this->normalize($question);
        $hints = [];

        // عبارات شناخته‌شده برای اسناد مهم؛ این‌ها Retrieval را در برابر تغییر عبارت سؤال مقاوم می‌کنند.
        $topicAliases = [
            'کار در ارتفاع' => ['کار در ارتفاع', 'ایمنی کار در ارتفاع', 'آیین نامه ایمنی کار در ارتفاع'],
            'وسایل حفاظت فردی' => ['وسایل حفاظت فردی', 'حفاظت فردی', 'آیین نامه وسایل حفاظت فردی'],
            'پرس' => ['پرس ها', 'پرس‌ها', 'آیین نامه حفاظتی پرس ها'],
            'لیفتراک' => ['لیفتراک', 'آیین نامه ایمنی ماشین های لیفتراک'],
        ];

        foreach ($topicAliases as $trigger => $aliases) {
            if (mb_stripos($normalized, $trigger) !== false) {
                $hints = array_merge($hints, $aliases);
            }
        }

        // نام آیین‌نامه‌های موجود در پایگاه دانش؛ برای نام‌های جدید هم عبارت «آیین نامه ...»
        // را نگه می‌داریم تا عنوان سند وارد candidate retrieval شود.
        if (preg_match('/آیین\s*نامه\s+(.{3,100}?)(?:[،,؟?]|\s+(?:کار|در|چیست|کدام|چه|باید|مشمول)\b|$)/u', $normalized, $m)) {
            $suffix = trim($m[1]);
            if ($suffix !== '') {
                $hints[] = 'آیین نامه ' . $suffix;
            }
        }

        if (mb_stripos($normalized, 'کار در ارتفاع') !== false) {
            $hints[] = 'آیین نامه ایمنی کار در ارتفاع';
            $hints[] = 'کار در ارتفاع';
        }

        return array_values(array_unique($hints));
    }

    private function looksLikeArticleRequest(string $question): bool
    {
        foreach ([
            'کدام ماده', 'کدوم ماده', 'چه ماده', 'ماده چند', 'ماده یا بند', 'ماده بند',
            'بند کدام', 'بند چه', 'تبصره کدام', 'شماره ماده', 'مستند به کدام',
            'بر اساس کدام ماده', 'براساس کدام ماده', 'بر اساس چه ماده', 'براساس چه ماده',
            'مستند به چه ماده', 'ماده قانونی', 'مستند قانونی',
        ] as $term) {
            if (mb_stripos($question, $term) !== false) {
                return true;
            }
        }

        return false;
    }

    private function looksLegal(string $question): bool
    {
        foreach ([
            'قانون', 'آیین نامه', 'آیین‌نامه', 'ماده', 'تبصره', 'بند', 'الزام',
            'اجباری', 'مقررات', 'وزارت کار', 'شورای عالی حفاظت فنی', 'مصوبه',
        ] as $term) {
            if (mb_stripos($question, $term) !== false) {
                return true;
            }
        }

        return false;
    }

    private function normalize(string $text): string
    {
        if ($text === '') {
            return '';
        }

        if (!mb_check_encoding($text, 'UTF-8')) {
            $text = mb_convert_encoding($text, 'UTF-8', ['UTF-8', 'Windows-1256', 'ISO-8859-1']);
        }

        $text = str_replace(
            ['ي', 'ى', 'ك', 'ة', 'ۀ', 'ؤ', 'إ', 'أ', "\xEF\xBB\xBF"],
            ['ی', 'ی', 'ک', 'ه', 'ه', 'و', 'ا', 'ا', ''],
            $text
        );

        $text = strtr($text, [
            '۰'=>'0','۱'=>'1','۲'=>'2','۳'=>'3','۴'=>'4','۵'=>'5','۶'=>'6','۷'=>'7','۸'=>'8','۹'=>'9',
            '٠'=>'0','١'=>'1','٢'=>'2','٣'=>'3','٤'=>'4','٥'=>'5','٦'=>'6','٧'=>'7','٨'=>'8','٩'=>'9',
        ]);

        $text = preg_replace('/[\x{200C}\x{200D}\x{200E}\x{200F}\x{2060}\x{FEFF}\x{0640}]/u', ' ', $text) ?? $text;
        $text = preg_replace('/\s+/u', ' ', trim(mb_strtolower($text, 'UTF-8'))) ?? trim(mb_strtolower($text, 'UTF-8'));

        return $text;
    }
}
