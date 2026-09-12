<?php

namespace App\Services;

use App\Models\AiKnowledgeChunk;
use App\Models\AiKnowledgeDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Smalot\PdfParser\Parser;

class AiKnowledgeImportService
{
    /**
     * Import a text-based HSE PDF into the AI knowledge base.
     *
     * The extractor is deliberately isolated here so it can be replaced later
     * without changing the knowledge models or chatbot.
     */
    public function import(
        UploadedFile|string $file,
        array $metadata = []
    ): AiKnowledgeDocument {
        if (!class_exists(Parser::class)) {
            throw new RuntimeException(
                'کتابخانه استخراج PDF نصب نیست. ابتدا دستور composer install را اجرا کنید.'
            );
        }

        $path = $file instanceof UploadedFile
            ? $file->getRealPath()
            : $file;

        if (!$path || !is_file($path)) {
            throw new RuntimeException('فایل PDF برای پردازش پیدا نشد.');
        }

        $parser = new Parser();
        $pdf = $parser->parseFile($path);
        $pages = $pdf->getPages();

        $articles = $this->extractArticles($pages);

        if ($articles === []) {
            throw new RuntimeException(
                'هیچ ماده قابل تشخیصی از PDF استخراج نشد. احتمالاً فایل اسکن‌شده است یا ساختار آن نیاز به استخراج‌کننده دیگری دارد.'
            );
        }

        return DB::transaction(function () use ($metadata, $articles, $file, $pages) {
            $document = AiKnowledgeDocument::create([
                'title' => $metadata['title'] ?? $this->defaultTitle($file),
                'source_name' => $metadata['source_name'] ?? 'منبع PDF',
                'source_type' => $metadata['source_type'] ?? 'iranian_regulation',
                'document_type' => $metadata['document_type'] ?? 'آیین نامه',
                'issuing_authority' => $metadata['issuing_authority'] ?? null,
                'category' => $metadata['category'] ?? 'ایمنی',
                'language' => $metadata['language'] ?? 'fa',
                'version' => $metadata['version'] ?? null,
                'approval_date' => $metadata['approval_date'] ?? null,
                'status' => 'active',
                'source_url' => $metadata['source_url'] ?? null,
                'original_file_path' => $this->storeOriginalFile($file),
                'description' => $metadata['description'] ?? null,
            ]);

            foreach ($articles as $index => $article) {
                AiKnowledgeChunk::create([
                    'ai_knowledge_document_id' => $document->id,
                    'chunk_index' => $index,
                    'chapter' => $article['chapter'],
                    'article_number' => $article['article_number'],
                    'paragraph_number' => null,
                    'page_number' => $article['page_number'],
                    'content' => $article['content'],
                ]);
            }

            return $document->load('chunks');
        });
    }

    /**
     * Extract article-sized chunks from ordered PDF pages.
     *
     * Supports both explicit headings such as "ماده 1" and the common
     * Iranian-regulation format used by the supplied PPE regulation:
     * "1 - متن ماده".
     */
    private function extractArticles(array $pages): array
    {
        $records = [];
        $currentChapter = null;

        foreach ($pages as $pageIndex => $page) {
            $pageNumber = $pageIndex + 1;
            $text = $this->normalizeText($page->getText());

            if ($text === '') {
                continue;
            }

            $lines = preg_split('/\R/u', $text) ?: [];

            foreach ($lines as $line) {
                $line = $this->cleanLine($line);

                if ($line === '') {
                    continue;
                }

                if ($chapter = $this->detectChapter($line)) {
                    $currentChapter = $chapter;
                    $records[] = [
                        'page' => $pageNumber,
                        'line' => $line,
                        'chapter' => $currentChapter,
                        'article_number' => null,
                    ];
                    continue;
                }

                $records[] = [
                    'page' => $pageNumber,
                    'line' => $line,
                    'chapter' => $currentChapter,
                    'article_number' => $this->detectArticleCandidate($line),
                ];
            }
        }

        $selected = $this->selectArticleSequence($records);

        if ($selected === []) {
            return [];
        }

        $articles = [];

        foreach ($selected as $selectedIndex => $recordIndex) {
            $record = $records[$recordIndex];
            $nextIndex = $selected[$selectedIndex + 1] ?? count($records);

            $contentLines = [];

            for ($i = $recordIndex; $i < $nextIndex; $i++) {
                if ($i === $recordIndex) {
                    $contentLines[] = $this->stripArticlePrefix(
                        $records[$i]['line'],
                        $record['article_number']
                    );
                    continue;
                }

                $line = $records[$i]['line'];

                if ($this->isNoiseLine($line) || preg_match('/^\s*فصل\s+/u', $line)) {
                    continue;
                }

                $contentLines[] = $line;
            }

            $content = $this->normalizeContent(implode(' ', $contentLines));

            if ($content === '') {
                continue;
            }

            $articles[] = [
                'article_number' => 'ماده ' . $record['article_number'],
                'chapter' => $record['chapter'],
                'page_number' => $record['page'],
                'content' => $content,
            ];
        }

        return $articles;
    }

    /**
     * Find the longest consecutive 1..N article sequence.
     *
     * This is important for Iranian regulations whose PDF extraction contains
     * numbered lists, standards and annexes in addition to the real articles.
     */
    private function selectArticleSequence(array $records): array
    {
        $positions = [];

        foreach ($records as $index => $record) {
            $number = $record['article_number'];

            if ($number === null || $number < 1 || $number > 999) {
                continue;
            }

            $positions[$number][] = $index;
        }

        if (!isset($positions[1])) {
            return [];
        }

        $best = [];
        $bestScore = -1;

        foreach ($positions[1] as $startIndex) {
            $sequence = [$startIndex];
            $expected = 2;
            $cursor = $startIndex;

            while (isset($positions[$expected])) {
                $next = null;

                foreach ($positions[$expected] as $candidate) {
                    if ($candidate > $cursor) {
                        $next = $candidate;
                        break;
                    }
                }

                if ($next === null) {
                    break;
                }

                $sequence[] = $next;
                $cursor = $next;
                $expected++;
            }

            // In many Iranian regulations, Article 1 starts immediately after
            // a chapter heading. Prefer that start when several numeric
            // sequences exist (definitions, standards, annexes, etc.).
            $startsAfterChapter =
                $startIndex > 0 &&
                $records[$startIndex - 1]['article_number'] === null &&
                preg_match('/^\s*فصل\s+/u', $records[$startIndex - 1]['line']) === 1;

            $score = count($sequence) + ($startsAfterChapter ? 1000 : 0);

            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $sequence;
            }
        }

        return count($best) >= 2 ? $best : [];
    }

    private function detectArticleCandidate(string $line): ?int
    {
        if (preg_match('/^\s*ماده\s+([0-9]{1,3})\s*[:.\-–—]?/u', $line, $m)) {
            return (int) $m[1];
        }

        if (preg_match('/^\s*([0-9]{1,3})\s*(?:[.\-–—]\s*)/u', $line, $m)) {
            return (int) $m[1];
        }

        // Some PDF extractors lose the separator completely, e.g. "14وسایل..."
        // or keep a space before the first word, e.g. "70 باشد...".
        if (preg_match('/^\s*([0-9]{1,3})\s*(?=\p{L})/u', $line, $m)) {
            return (int) $m[1];
        }

        return null;
    }

    private function appendArticle(array &$articles, array &$article): void
    {
        $article['content'] = $this->normalizeContent($article['content']);

        if ($article['content'] !== '') {
            $articles[] = $article;
        }
    }

    private function stripArticlePrefix(string $line, int $articleNumber): string
    {
        $pattern = '/^\s*(?:ماده\s+)?' .
            preg_quote((string) $articleNumber, '/') .
            '\s*(?:[.\-–—]\s*)?/u';

        return trim((string) preg_replace($pattern, '', $line));
    }

    private function detectChapter(string $line): ?string
    {
        if (!preg_match('/^\s*فصل\s+(.+)$/u', $line, $m)) {
            return null;
        }

        $chapter = preg_replace('/\s+/u', ' ', trim($m[1])) ?? trim($m[1]);

        return 'فصل ' . $chapter;
    }

    private function normalizeText(string $text): string
    {
        if (class_exists(\Normalizer::class)) {
            $text = \Normalizer::normalize($text, \Normalizer::FORM_KC) ?: $text;
        }

        $text = str_replace(
            ['ي', 'ى', 'ك', 'ۀ', 'ة', 'ـ', "\xEF\xBF\xBD"],
            ['ی', 'ی', 'ک', 'ه', 'ه', '', ''],
            $text
        );

        $text = $this->toEnglishDigits($text);
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $text = preg_replace('/[ \t]+/u', ' ', $text) ?? $text;
        $text = preg_replace('/\n{3,}/u', "\n\n", $text) ?? $text;

        return trim($text);
    }

    private function normalizeContent(string $text): string
    {
        $text = $this->normalizeText($text);
        $text = preg_replace('/\s*\n\s*/u', ' ', $text) ?? $text;
        $text = preg_replace('/\s{2,}/u', ' ', $text) ?? $text;

        return trim($text);
    }

    private function cleanLine(string $line): string
    {
        $line = trim($line);

        // Remove common PDF footer/header noise without touching article text.
        if (preg_match('/^(?:https?:\/\/|www\.)/iu', $line)) {
            return '';
        }

        if (preg_match('/^\d{1,3}$/u', $line)) {
            return '';
        }

        return $line;
    }

    private function isNoiseLine(string $line): bool
    {
        return preg_match('/^(?:www\.[^\s]+|https?:\/\/\S+)$/iu', $line) === 1;
    }

    private function toEnglishDigits(string $text): string
    {
        return strtr($text, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);
    }

    private function defaultTitle(UploadedFile|string $file): string
    {
        $name = $file instanceof UploadedFile
            ? $file->getClientOriginalName()
            : basename($file);

        return pathinfo($name, PATHINFO_FILENAME);
    }

    private function storeOriginalFile(UploadedFile|string $file): ?string
    {
        if (!$file instanceof UploadedFile) {
            return null;
        }

        return $file->store('ai-knowledge', 'local');
    }
}
