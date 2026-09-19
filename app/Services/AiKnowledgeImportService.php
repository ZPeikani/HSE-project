<?php

namespace App\Services;

use App\Models\AiKnowledgeChunk;
use App\Models\AiKnowledgeDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Smalot\PdfParser\Parser;

class AiKnowledgeImportService
{
    /**
     * Import one text-based PDF source into the AI knowledge base.
     * Runtime intentionally has no OCR/LibreOffice dependency. Scanned PDFs
     * and legacy DOC files are prepared offline and shipped as a Knowledge Bundle.
     */
    public function import(UploadedFile|string $file, array $metadata = []): AiKnowledgeDocument
    {
        $path = $this->resolvePath($file);

        // For UploadedFile, getRealPath() points to Laravel's temporary file
        // and may have no .pdf extension. Always use the original client
        // extension for uploaded files; use pathinfo() only for local paths.
        $extension = $file instanceof UploadedFile
            ? strtolower($file->getClientOriginalExtension())
            : strtolower(pathinfo($path, PATHINFO_EXTENSION));

        if ($extension !== 'pdf') {
            throw new RuntimeException('فقط فایل‌های PDF قابل Import هستند.');
        }

        $hash = hash_file('sha256', $path);
        if (!$hash) {
            throw new RuntimeException('امکان محاسبه شناسه یکتای فایل وجود ندارد.');
        }

        if ($existing = AiKnowledgeDocument::where('file_hash', $hash)->first()) {
            throw new RuntimeException("این فایل قبلاً با عنوان «{$existing->title}» وارد شده است.");
        }

        $pages = $this->extractPages($path);
        $chunks = $this->extractChunks($pages, $metadata);

        if ($chunks === []) {
            $chunks = [[
                'chapter' => $metadata['category'] ?? 'پایگاه دانش',
                'page_number' => 1,
                'content' => 'این PDF بدون متن قابل استخراج آپلود شد و به‌صورت ذخیره‌سازی اولیه در پایگاه دانش ثبت گردید. برای جست‌وجوی بهتر، نسخه متنی یا OCR شده‌ی آن را هم ارسال کنید.',
            ]];
        }

        return DB::transaction(function () use ($metadata, $chunks, $file, $hash) {
                $document = AiKnowledgeDocument::create([
                    'title' => $metadata['title'] ?? $this->defaultTitle($file),
                    'source_name' => $metadata['source_name'] ?? 'منبع HSE',
                    'source_type' => $metadata['source_type'] ?? 'iranian_regulation',
                    'document_type' => $metadata['document_type'] ?? 'آیین نامه',
                    'issuing_authority' => $metadata['issuing_authority'] ?? null,
                    'category' => $metadata['category'] ?? 'ایمنی',
                    'language' => $metadata['language'] ?? 'fa',
                    'version' => $metadata['version'] ?? null,
                    'approval_date' => $metadata['approval_date'] ?? null,
                    'status' => $metadata['status'] ?? 'active',
                    'source_url' => $metadata['source_url'] ?? null,
                    'original_file_path' => $this->storeOriginalFile($file),
                    'description' => $metadata['description'] ?? null,
                    'file_hash' => $hash,
                ]);

                foreach ($chunks as $index => $chunk) {
                    AiKnowledgeChunk::create([
                        'ai_knowledge_document_id' => $document->id,
                        'chunk_index' => $index,
                        'chapter' => $chunk['chapter'] ?? null,
                        'article_number' => $chunk['article_number'] ?? null,
                        'paragraph_number' => $chunk['paragraph_number'] ?? null,
                        'page_number' => $chunk['page_number'] ?? null,
                        'content' => $chunk['content'],
                    ]);
                }

                return $document->load('chunks');
        });
    }

    /**
     * Import all supported files in a directory. The returned report is safe
     * for CLI use and does not stop the whole batch because of one bad source.
     */
    public function importDirectory(string $directory, array $manifest = []): array
    {
        if (!is_dir($directory)) {
            throw new RuntimeException("پوشه منبع پیدا نشد: {$directory}");
        }

        $files = [];
        foreach (scandir($directory) ?: [] as $name) {
            if (in_array($name, ['.', '..'], true)) {
                continue;
            }

            $path = $directory . DIRECTORY_SEPARATOR . $name;
            if (is_file($path) && in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['pdf'], true)) {
                $files[] = $path;
            }
        }

        usort($files, fn ($a, $b) => strnatcasecmp(basename($a), basename($b)));

        $report = ['imported' => [], 'skipped' => [], 'failed' => []];

        foreach ($files as $path) {
            $name = basename($path);
            $metadata = $manifest[$name] ?? $this->metadataFromFilename($name);

            try {
                $document = $this->import($path, $metadata);
                $report['imported'][] = [
                    'file' => $name,
                    'document_id' => $document->id,
                    'title' => $document->title,
                    'chunks' => $document->chunks->count(),
                ];
            } catch (RuntimeException $e) {
                if (str_contains($e->getMessage(), 'قبلاً')) {
                    $report['skipped'][] = ['file' => $name, 'reason' => $e->getMessage()];
                } else {
                    $report['failed'][] = ['file' => $name, 'reason' => $e->getMessage()];
                }
            }
        }

        return $report;
    }

    private function extractPages(string $pdfPath): array
    {
        if (!class_exists(Parser::class)) {
            throw new RuntimeException(
                'کتابخانه smalot/pdfparser نصب نیست. composer install را اجرا کنید.'
            );
        }

        if (!$this->looksLikePdf($pdfPath)) {
            throw new RuntimeException('فایل PDF معتبر نیست.');
        }

        try {
            $parser = new Parser();
            $pdf = $parser->parseFile($pdfPath);
            $pdfPages = $pdf->getPages();

            if ($pdfPages === []) {
                return [['page' => 1, 'text' => '']];
            }

            $pages = [];
            $totalMeaningfulCharacters = 0;

            foreach ($pdfPages as $index => $page) {
                $text = $this->normalizeText($page->getText());

                $pages[] = [
                    'page' => $index + 1,
                    'text' => $text,
                ];

                $compactText = preg_replace('/\s+/u', '', $text) ?? $text;
                $totalMeaningfulCharacters += mb_strlen($compactText, 'UTF-8');
            }

            if ($totalMeaningfulCharacters < 100) {
                return $pages;
            }

            return $pages;
        } catch (RuntimeException $e) {
            if ($this->looksLikePdf($pdfPath)) {
                return [['page' => 1, 'text' => '']];
            }

            throw $e;
        } catch (\Throwable $e) {
            if ($this->looksLikePdf($pdfPath)) {
                return [['page' => 1, 'text' => '']];
            }

            throw new RuntimeException(
                'خواندن متن PDF انجام نشد. مطمئن شوید فایل PDF سالم و دارای لایه متن است.'
            );
        }
    }

    private function looksLikePdf(string $pdfPath): bool
    {
        $header = @file_get_contents($pdfPath, false, null, 0, 5);
        return is_string($header) && str_starts_with($header, '%PDF');
    }

    private function extractChunks(array $pages, array $metadata = []): array
    {
        $records = [];
        $currentChapter = null;
        $hasExplicitArticleMarkers = false;

        foreach ($pages as $page) {
            $text = $this->normalizeText($page['text'] ?? '');
            if ($text === '') {
                continue;
            }

            foreach (preg_split('/\R/u', $text) ?: [] as $line) {
                $line = $this->cleanLine($line);
                if ($line === '') {
                    continue;
                }

                if ($chapter = $this->detectChapter($line)) {
                    $currentChapter = $chapter;
                    $records[] = [
                        'page' => $page['page'],
                        'line' => $line,
                        'chapter' => $currentChapter,
                        'article_number' => null,
                    ];
                    continue;
                }

                $articleNumber = $this->detectArticleCandidate($line);
                if ($articleNumber !== null && preg_match('/^\s*ماده\s*/u', $line)) {
                    $hasExplicitArticleMarkers = true;
                }

                $records[] = [
                    'page' => $page['page'],
                    'line' => $line,
                    'chapter' => $currentChapter,
                    'article_number' => $articleNumber,
                ];
            }
        }

        foreach ($records as $index => $record) {
            if ($record['article_number'] === null) {
                continue;
            }

            $line = $record['line'];
            if ($hasExplicitArticleMarkers && !preg_match('/^\s*ماده\s*/u', $line)) {
                $records[$index]['article_number'] = null;
            }
        }

        $articleIndexes = $this->selectArticleSequence($records);

        if ($articleIndexes !== []) {
            return $this->buildArticleChunks($records, $articleIndexes);
        }

        // Not every useful source is an article-based regulation. News,
        // introductions and secondary sources must still be searchable.
        return $this->buildSectionChunks($pages, $metadata);
    }

    private function buildArticleChunks(array $records, array $indexes): array
    {
        $chunks = [];

        foreach ($indexes as $position => $recordIndex) {
            $record = $records[$recordIndex];
            $nextIndex = $indexes[$position + 1] ?? count($records);
            $contentLines = [];

            for ($i = $recordIndex; $i < $nextIndex; $i++) {
                $line = $records[$i]['line'];
                if ($i === $recordIndex) {
                    $contentLines[] = $this->stripArticlePrefix($line, $record['article_number']);
                    continue;
                }
                if ($this->isNoiseLine($line)) {
                    continue;
                }
                $contentLines[] = $line;
            }

            $content = $this->normalizeContent(implode(' ', $contentLines));
            if ($content === '') {
                continue;
            }

            $chunks[] = [
                'article_number' => 'ماده ' . $record['article_number'],
                'chapter' => $record['chapter'],
                'page_number' => $record['page'],
                'content' => $content,
            ];
        }

        return $chunks;
    }

    private function buildSectionChunks(array $pages, array $metadata): array
    {
        $chunks = [];
        $buffer = [];
        $pageStart = null;
        $chunkIndex = 0;

        foreach ($pages as $page) {
            $text = $this->normalizeContent($page['text'] ?? '');
            if ($text === '') {
                continue;
            }

            if ($pageStart === null) {
                $pageStart = $page['page'];
            }
            $buffer[] = $text;

            // Keep secondary/news documents in manageable chunks.
            if (mb_strlen(implode(' ', $buffer)) >= 7000) {
                $chunks[] = [
                    'chapter' => $metadata['category'] ?? 'منبع زمینه‌ای',
                    'page_number' => $pageStart,
                    'content' => implode(' ', $buffer),
                ];
                $chunkIndex++;
                $buffer = [];
                $pageStart = null;
            }
        }

        if ($buffer !== []) {
            $chunks[] = [
                'chapter' => $metadata['category'] ?? 'منبع زمینه‌ای',
                'page_number' => $pageStart,
                'content' => implode(' ', $buffer),
            ];
        }

        return $chunks;
    }

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

            $hasChapterBefore = false;
            for ($i = max(0, $startIndex - 3); $i < $startIndex; $i++) {
                if (preg_match('/^\s*فصل\s+/u', $records[$i]['line'])) {
                    $hasChapterBefore = true;
                    break;
                }
            }

            $score = count($sequence) + ($hasChapterBefore ? 1000 : 0);
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $sequence;
            }
        }

        return count($best) >= 2 ? $best : [];
    }

    private function detectArticleCandidate(string $line): ?int
    {
        if (preg_match('/^\s*ماده\s*([0-9]{1,3})\s*[:.\-–—]?/u', $line, $m)) {
            return (int) $m[1];
        }

        if (preg_match('/^\s*([0-9]{1,3})\s*(?:[.\-–—]\s*)(?=\p{L})/u', $line, $m)) {
            return (int) $m[1];
        }

        return null;
    }

    private function stripArticlePrefix(string $line, int $articleNumber): string
    {
        $pattern = '/^\s*(?:ماده\s*)?' . preg_quote((string) $articleNumber, '/') . '\s*(?:[.\-–—:]\s*)?/u';
        return trim((string) preg_replace($pattern, '', $line));
    }

    private function detectChapter(string $line): ?string
    {
        if (!preg_match('/^\s*(?:فصل|باب)\s+(.+)$/u', $line, $m)) {
            return null;
        }
        $chapter = preg_replace('/\s+/u', ' ', trim($m[1])) ?? trim($m[1]);
        return trim($m[0]);
    }

    private function resolvePath(UploadedFile|string $file): string
    {
        if ($file instanceof UploadedFile) {
            $candidates = [
                $file->getRealPath(),
                $file->getPathname(),
            ];

            foreach ($candidates as $candidate) {
                if (is_string($candidate) && $candidate !== '' && is_file($candidate)) {
                    return $candidate;
                }
            }

            throw new RuntimeException('فایل برای پردازش پیدا نشد.');
        }

        if (!is_file($file)) {
            throw new RuntimeException('فایل برای پردازش پیدا نشد.');
        }

        return $file;
    }

    private function cleanLine(string $line): string
    {
        $line = trim($line);
        if ($line === '' || preg_match('/^(?:https?:\/\/|www\.)/iu', $line)) {
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

    private function toEnglishDigits(string $text): string
    {
        return strtr($text, [
            '۰'=>'0','۱'=>'1','۲'=>'2','۳'=>'3','۴'=>'4','۵'=>'5','۶'=>'6','۷'=>'7','۸'=>'8','۹'=>'9',
            '٠'=>'0','١'=>'1','٢'=>'2','٣'=>'3','٤'=>'4','٥'=>'5','٦'=>'6','٧'=>'7','٨'=>'8','٩'=>'9',
        ]);
    }

    private function defaultTitle(UploadedFile|string $file): string
    {
        $name = $file instanceof UploadedFile ? $file->getClientOriginalName() : basename($file);
        return pathinfo($name, PATHINFO_FILENAME);
    }

    private function storeOriginalFile(UploadedFile|string $file): ?string
    {
        $name = $file instanceof UploadedFile ? $file->getClientOriginalName() : basename($file);
        $safeName = preg_replace('/[^\pL\pN._-]+/u', '-', $name) ?: ('source-' . uniqid());
        $target = 'ai-knowledge/' . uniqid('', true) . '-' . $safeName;

        if ($file instanceof UploadedFile) {
            $candidates = [
                $file->getRealPath(),
                $file->getPathname(),
                method_exists($file, 'path') ? $file->path() : null,
            ];

            foreach ($candidates as $candidate) {
                if (!is_string($candidate) || $candidate === '' || !is_file($candidate)) {
                    continue;
                }

                $contents = @file_get_contents($candidate);
                if ($contents === false) {
                    continue;
                }

                Storage::disk('local')->put($target, $contents);
                return $target;
            }

            return null;
        }

        $contents = @file_get_contents($file);
        if ($contents === false) {
            return null;
        }
        Storage::disk('local')->put($target, $contents);
        return $target;
    }

    private function metadataFromFilename(string $filename): array
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $defaults = [
            'source_name' => 'منابع HSE ایران',
            'source_type' => 'iranian_regulation',
            'document_type' => 'آیین نامه',
            'issuing_authority' => 'وزارت تعاون، کار و رفاه اجتماعی / شورای عالی حفاظت فنی',
            'category' => 'ایمنی',
        ];

        $map = [
            '1998.pdf' => ['title' => 'قانون کار جمهوری اسلامی ایران', 'document_type' => 'قانون', 'source_type' => 'iranian_law', 'category' => 'قوانین کار'],
            '1594.pdf' => ['title' => 'آیین نامه و مقررات حفاظتی پرس ها (پرسکاری سرد فلزات)'],
            '1611.pdf' => ['title' => 'آیین نامه آموزش ایمنی کارفرمایان، کارگران و کارآموزان'],
            '1613.pdf' => ['title' => 'آیین نامه حفاظتی حمل دستی بار'],
            'hefazat17.pdf' => ['title' => 'آیین نامه ایمنی کار روی خطوط و تجهیزات برق دار'],
            'hefazat3.pdf' => ['title' => 'آیین نامه حفاظتی وسایل حمل و نقل و جابه جا کردن مواد و اشیاء در کارگاه ها'],
            'hefazat19.pdf' => ['title' => 'آیین نامه پیشگیری و مبارزه با آتش سوزی در کارگاه ها'],
            'imenilifterak.pdf' => ['title' => 'آیین نامه ایمنی ماشین های لیفتراک'],
            '1632.pdf' => ['title' => 'آیین نامه ایمنی کار در ارتفاع'],
            'ایین-نامه-وسایل-حفاطت-فردی.pdf' => ['title' => 'آیین نامه وسایل حفاظت فردی'],
        ];

        if (isset($map[$filename])) {
            return array_merge($defaults, $map[$filename]);
        }

        if (str_contains($filename, 'News-49266')) {
            return array_merge($defaults, [
                'title' => 'خبر تصویب آیین نامه بکارگیری مسئول ایمنی در کارگاه ها',
                'document_type' => 'خبر',
                'source_type' => 'secondary_source',
                'category' => 'قوانین و مقررات ایمنی',
                'description' => 'منبع خبری/ثانویه؛ برای زمینه و شناسایی سند استفاده شود و جایگزین متن رسمی آیین نامه نیست.',
            ]);
        }

        if (str_contains($filename, 'وکیلیک')) {
            return array_merge($defaults, [
                'title' => 'رونوشت بخش تعاریف آیین نامه وسایل حفاظت فردی',
                'document_type' => 'منبع ثانویه',
                'source_type' => 'secondary_source',
                'description' => 'رونوشت ثانویه از بخشی از آیین نامه وسایل حفاظت فردی؛ منبع اصلی اولویت دارد.',
            ]);
        }

        if (str_contains($filename, 'ماشین آلات عمرانی')) {
            return array_merge($defaults, [
                'title' => 'آیین نامه ایمنی کار با ماشین آلات عمرانی',
            ]);
        }

        return array_merge($defaults, ['title' => $name]);
    }
}
