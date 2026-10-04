<?php

namespace App\Services;

class HseRetrievalFilter
{
    private array $topicKeywords = [
        'press' => [
            'پرس', 'پرسکاری', 'ضربه زن', 'ضربه‌زن', 'قالب', 'کلاچ',
            'فرمان دو دستی', 'پدال'
        ],

        'work_at_height' => [
            'نردبان', 'کار در ارتفاع', 'داربست', 'سقوط', 'پاگرد',
            'سکوی کار', 'کمربند ایمنی', 'هارنس'
        ],

        'electrical' => [
            'تابلو برق', 'برق', 'برقدار', 'الکتریکی', 'اتصال زمین', 'ارت',
            'هادی', 'کابل', 'ولتاژ', 'جریان'
        ],

        'fire' => [
            'آتش سوزی', 'آتش‌سوزی', 'حریق', 'کپسول', 'خاموش کننده',
            'خاموش‌کننده', 'اطفا', 'اطفاء', 'اعلام حریق'
        ],

        'forklift' => [
            'لیفتراک', 'شاخک', 'راننده لیفتراک'
        ],

        'ppe' => [
            'تجهیزات حفاظت فردی', 'حفاظت فردی', 'کلاه ایمنی', 'عینک ایمنی',
            'کفش ایمنی', 'دستکش', 'گوشی', 'ماسک'
        ],

        'housekeeping' => [
            'مسیر تردد', 'راهرو', 'نظافت', 'نظم', 'چیدمان',
            'مانع', 'لغزش', 'زمین خوردن', 'زمین‌خوردن', 'خرده ریز', 'خرده‌ریز'
        ],

        'construction_machinery' => [
            'ماشین آلات عمرانی', 'ماشین‌آلات عمرانی', 'لودر', 'بیل مکانیکی',
            'بولدوزر', 'گریدر', 'کامیون'
        ],

        'manual_handling' => [
            'حمل دستی بار', 'بلند کردن بار', 'جابجایی دستی', 'جابه‌جایی دستی'
        ],

        'transportation' => [
            'حمل و نقل مواد', 'حمل‌ونقل مواد', 'انبارش', 'بارگیری', 'تخلیه بار'
        ],
    ];

    private array $documentTopics = [
        'پرس'               => 'press',
        'کار در ارتفاع'     => 'work_at_height',
        'برق'               => 'electrical',
        'آتش'               => 'fire',
        'حریق'              => 'fire',
        'لیفتراک'           => 'forklift',
        'حفاظت فردی'        => 'ppe',
        'ماشین آلات عمرانی' => 'construction_machinery',
        'ماشین‌آلات عمرانی' => 'construction_machinery',
        'حمل دستی بار'      => 'manual_handling',
        'حمل و نقل مواد'    => 'transportation',
        'حمل‌ونقل مواد'     => 'transportation',
    ];

    /**
     * Queryهای کوتاه و اختصاصی برای مرحله دوم Retrieval.
     * این‌ها «قانون» یا «ماده» تولید نمی‌کنند؛ فقط retrieval را به سند درست هدایت می‌کنند.
     */
    private array $topicQueries = [
        'press' => 'پرس پرسکاری حفاظ منطقه عمل ضربه زن قالب تجهیزات ایمنی',
        'work_at_height' => 'نردبان کار در ارتفاع سقوط پاگرد سکوی کار',
        'electrical' => 'تابلو برق تجهیزات برق برقدار کابل اتصال زمین ایمنی برق',
        'fire' => 'آتش سوزی حریق کپسول خاموش کننده اعلام حریق',
        'forklift' => 'لیفتراک شاخک راننده لیفتراک ایمنی',
        'ppe' => 'تجهیزات حفاظت فردی کلاه ایمنی دستکش کفش ایمنی عینک',
        'housekeeping' => 'نظم نظافت مسیر تردد راهرو مانع لغزش',
        'construction_machinery' => 'ماشین آلات عمرانی ایمنی ماشین آلات',
        'manual_handling' => 'حمل دستی بار جابجایی دستی ایمنی',
        'transportation' => 'حمل و نقل مواد بارگیری تخلیه انبارش',
    ];

    public function detectTopics(string $text): array
    {
        $text = $this->normalize($text);
        if ($text === '') {
            return [];
        }

        $scores = [];

        foreach ($this->topicKeywords as $topic => $keywords) {
            $score = 0;

            foreach ($keywords as $keyword) {
                $needle = $this->normalize($keyword);
                if ($needle !== '' && mb_stripos($text, $needle) !== false) {
                    $score += mb_strlen($needle) >= 7 ? 3 : 1;
                }
            }

            if ($score > 0) {
                $scores[$topic] = $score;
            }
        }

        if ($scores === []) {
            return [];
        }

        arsort($scores);

        return array_keys($scores);
    }

    public function topicQuery(string $topic): ?string
    {
        return $this->topicQueries[$topic] ?? null;
    }

    /**
     * Search results are filtered only after broad + per-topic retrieval have been merged.
     */
    public function filterHits(
        string $query,
        array $hits,
        ?string $visionKeywords = null,
        bool $isImage = false
    ): array {
        if ($hits === []) {
            return [];
        }

        $queryTopics = $this->detectTopics(trim($query . ' ' . ($visionKeywords ?? '')));

        if ($queryTopics === []) {
            return $hits;
        }

        $filtered = [];

        foreach ($hits as $hit) {
            $title = (string) ($hit['title'] ?? '');
            $text  = (string) ($hit['text'] ?? '');
            $type  = (string) ($hit['type'] ?? '');

            $documentTopic = $this->documentTopic($title);
            $hitTopics = $documentTopic !== null
                ? [$documentTopic]
                : $this->detectTopics($title . ' ' . $type . ' ' . $text);

            if ($hitTopics === []) {
                // برای متن عادی حذف نکن؛ برای Vision فقط نتایج قابل‌طبقه‌بندی را نگه دار.
                if (!$isImage) {
                    $filtered[] = $hit;
                }
                continue;
            }

            if (array_intersect($queryTopics, $hitTopics) !== []) {
                $filtered[] = $hit;
            }
        }

        return $this->dedupe($filtered);
    }

    public function filterArticleHits(string $query, array $hits): array
    {
        if ($hits === []) {
            return [];
        }

        $queryTopics = $this->detectTopics($query);
        if ($queryTopics === []) {
            return $hits;
        }

        $out = [];

        foreach ($hits as $hit) {
            $title = (string) ($hit['title'] ?? '');
            $text  = (string) ($hit['text'] ?? '');

            $documentTopic = $this->documentTopic($title);
            $hitTopics = $documentTopic !== null
                ? [$documentTopic]
                : $this->detectTopics($title . ' ' . $text);

            if ($hitTopics !== [] && array_intersect($queryTopics, $hitTopics) !== []) {
                $out[] = $hit;
            }
        }

        return $this->dedupe($out);
    }

    public function mergeHits(array ...$groups): array
    {
        $merged = [];
        foreach ($groups as $group) {
            foreach ($group as $hit) {
                $merged[] = $hit;
            }
        }

        return $this->dedupe($merged);
    }

    private function dedupe(array $hits): array
    {
        $seen = [];
        $out = [];

        foreach ($hits as $hit) {
            $key = implode('|', [
                (string) ($hit['title'] ?? ''),
                (string) ($hit['article'] ?? ''),
                mb_substr((string) ($hit['text'] ?? ''), 0, 160),
            ]);

            if (isset($seen[$key])) {
                continue;
            }

            $seen[$key] = true;
            $out[] = $hit;
        }

        return array_values($out);
    }

    private function documentTopic(string $title): ?string
    {
        $title = $this->normalize($title);

        foreach ($this->documentTopics as $needle => $topic) {
            if (mb_stripos($title, $this->normalize($needle)) !== false) {
                return $topic;
            }
        }

        return null;
    }

    private function normalize(string $text): string
    {
        $text = mb_strtolower($text);

        $text = strtr($text, [
            'ي' => 'ی',
            'ى' => 'ی',
            'ك' => 'ک',
            'ۀ' => 'ه',
            'ة' => 'ه',
            "\u{200C}" => ' ',
        ]);

        $text = preg_replace('/[^\p{L}\p{N}\s]+/u', ' ', $text) ?? $text;
        $text = preg_replace('/\s+/u', ' ', $text) ?? $text;

        return trim($text);
    }
}
