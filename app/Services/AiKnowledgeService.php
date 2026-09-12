<?php

namespace App\Services;

use App\Models\AiKnowledgeChunk;

class AiKnowledgeService
{
    /**
     * Find the most relevant active knowledge chunks for a user question.
     * This first version intentionally uses MySQL LIKE matching so no vector DB
     * or external embedding service is required.
     */
    public function search(string $question, int $limit = 6): array
    {
        $terms = $this->extractTerms($question);

        if ($terms === []) {
            return [];
        }

        $query = AiKnowledgeChunk::query()
            ->with('document')
            ->whereHas('document', fn ($q) => $q->where('status', 'active'))
            ->where(function ($q) use ($terms) {
                foreach ($terms as $term) {
                    $q->orWhere('content', 'like', '%' . $term . '%')
                        ->orWhere('article_number', 'like', '%' . $term . '%')
                        ->orWhere('chapter', 'like', '%' . $term . '%');
                }
            })
            ->limit(40)
            ->get();

        $scored = $query->map(function (AiKnowledgeChunk $chunk) use ($terms) {
            $haystack = mb_strtolower(
                $chunk->content . ' ' .
                ($chunk->article_number ?? '') . ' ' .
                ($chunk->chapter ?? '') . ' ' .
                $chunk->document->title . ' ' .
                $chunk->document->category
            );

            $score = 0;
            foreach ($terms as $term) {
                if (mb_stripos($haystack, $term) !== false) {
                    $score++;
                }
            }

            // Legal/regulatory sources get priority for questions that look legal.
            if ($this->looksLegal($question) && $chunk->document->source_type === 'iranian_regulation') {
                $score += 3;
            }

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
                'title' => $doc->title,
                'source_name' => $doc->source_name,
                'issuing_authority' => $doc->issuing_authority,
                'document_type' => $doc->document_type,
                'status' => $doc->status,
                'article_number' => $chunk->article_number,
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
            return 'برای این پرسش، منبع فعال و مشخصی در پایگاه دانش پیدا نشد. از ساختن نام آیین‌نامه، ماده یا شماره بند خودداری کن.';
        }

        $output = "=== منابع HSE بازیابی‌شده ===\n";
        foreach ($results as $index => $result) {
            $output .= "\n[منبع " . ($index + 1) . "]\n";
            $output .= "عنوان: {$result['title']}\n";
            $output .= "منبع: {$result['source_name']}\n";
            if ($result['issuing_authority']) {
                $output .= "مرجع صادرکننده: {$result['issuing_authority']}\n";
            }
            if ($result['article_number']) {
                $output .= "ماده/بند: {$result['article_number']}\n";
            }
            if ($result['chapter']) {
                $output .= "فصل: {$result['chapter']}\n";
            }
            if ($result['page_number']) {
                $output .= "صفحه PDF: {$result['page_number']}\n";
            }
            $output .= "متن: {$result['content']}\n";
            if ($result['source_url']) {
                $output .= "نشانی منبع: {$result['source_url']}\n";
            }
        }

        return $output;
    }

    private function extractTerms(string $question): array
    {
        $text = mb_strtolower(trim($question));
        $text = preg_replace('/[\x{200C}\x{200D}\x{0640}]/u', ' ', $text) ?? $text;
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text) ?? $text;
        $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        $stopWords = [
            'از','به','در','با','برای','که','را','و','یا','این','آن','یک','های','است','هست',
            'شود','شده','کنم','کنید','می','من','ما','چه','چطور','چگونه','آیا','درباره','مورد',
            'طبق','بر','تا','اگر','هم','همه','روی','ای','ترین','کردن','کرد','دارم','دارید',
        ];

        return array_values(array_unique(array_filter($words, function ($word) use ($stopWords) {
            return mb_strlen($word) >= 3 && !in_array($word, $stopWords, true);
        })));
    }

    private function looksLegal(string $question): bool
    {
        foreach (['قانون', 'آیین نامه', 'آیین‌نامه', 'ماده', 'تبصره', 'الزام', 'اجباری', 'مقررات', 'وزارت کار'] as $term) {
            if (mb_stripos($question, $term) !== false) {
                return true;
            }
        }

        return false;
    }
}
