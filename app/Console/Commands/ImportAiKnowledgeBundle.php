<?php

namespace App\Console\Commands;

use App\Models\AiKnowledgeChunk;
use App\Models\AiKnowledgeDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportAiKnowledgeBundle extends Command
{
    protected $signature = 'ai:knowledge:import-bundle {file : مسیر فایل JSON بسته Knowledge Base}';
    protected $description = 'Import a preprocessed AI knowledge bundle without OCR or external binaries';

    public function handle(): int
    {
        $path = $this->argument('file');
        if (!is_file($path)) {
            $this->error("فایل پیدا نشد: {$path}");
            return self::FAILURE;
        }

        $data = json_decode((string) file_get_contents($path), true);
        if (!is_array($data) || !isset($data['documents']) || !is_array($data['documents'])) {
            $this->error('فرمت Knowledge Bundle معتبر نیست.');
            return self::FAILURE;
        }

        $imported = 0;
        $skipped = 0;

        foreach ($data['documents'] as $item) {
            $metadata = $item['metadata'] ?? [];
            $chunks = $item['chunks'] ?? [];
            $hash = hash('sha256', json_encode($item, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

            if (AiKnowledgeDocument::where('file_hash', $hash)->exists()) {
                $skipped++;
                continue;
            }

            if ($chunks === []) {
                $this->warn('بدون chunk: ' . ($metadata['title'] ?? ($item['file_name'] ?? 'unknown')));
                continue;
            }

            DB::transaction(function () use ($metadata, $chunks, $item, $hash) {
                $document = AiKnowledgeDocument::create([
                    'title' => $metadata['title'] ?? pathinfo($item['file_name'] ?? 'source', PATHINFO_FILENAME),
                    'source_name' => $metadata['source_name'] ?? 'منابع HSE ایران',
                    'source_type' => $metadata['source_type'] ?? 'iranian_regulation',
                    'document_type' => $metadata['document_type'] ?? 'آیین نامه',
                    'issuing_authority' => $metadata['issuing_authority'] ?? null,
                    'category' => $metadata['category'] ?? 'ایمنی',
                    'language' => $metadata['language'] ?? 'fa',
                    'version' => $metadata['version'] ?? null,
                    'approval_date' => $metadata['approval_date'] ?? null,
                    'status' => $metadata['status'] ?? 'active',
                    'source_url' => $metadata['source_url'] ?? null,
                    'original_file_path' => null,
                    'description' => $metadata['description'] ?? null,
                    'file_hash' => $hash,
                ]);

                foreach ($chunks as $index => $chunk) {
                    AiKnowledgeChunk::create([
                        'ai_knowledge_document_id' => $document->id,
                        'chunk_index' => $chunk['chunk_index'] ?? $index,
                        'chapter' => $this->normalizeChapter($chunk['chapter'] ?? null),
                        'article_number' => $this->normalizeArticleNumber($chunk),
                        'paragraph_number' => $this->normalizeScalar($chunk['paragraph_number'] ?? null),
                        'page_number' => $this->normalizeScalar($chunk['page_number'] ?? null),
                        'content' => trim((string) ($chunk['content'] ?? '')),
                    ]);
                }
            });

            $imported++;
            $this->info('✓ ' . ($metadata['title'] ?? ($item['file_name'] ?? 'source')) . ' (' . count($chunks) . ' chunk)');
        }

        $this->newLine();
        $this->info("وارد شد: {$imported} | تکراری: {$skipped}");
        return self::SUCCESS;
    }

    /**
     * JSON جدید chapter را به مقدار scalar قابل ذخیره در ستون فعلی تبدیل می‌کند.
     * ساختار قدیمی scalar نیز همچنان پشتیبانی می‌شود.
     */
    private function normalizeChapter(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_array($value)) {
            $value = array_values(array_filter(array_map(
                static fn ($item) => is_scalar($item) ? trim((string) $item) : null,
                $value
            ), static fn ($item) => $item !== null && $item !== ''));

            return $value === [] ? null : implode(' | ', $value);
        }

        return is_scalar($value) ? trim((string) $value) : null;
    }

    /**
     * article_numbers در JSON جدید می‌تواند چند مقدار داشته باشد، اما ستون فعلی
     * article_number در دیتابیس یک مقدار scalar است. اگر ستون متنی باشد، همه مقادیر
     * با کاما ذخیره می‌شوند؛ اگر عددی باشد، فقط وقتی یک مقدار وجود دارد همان مقدار
     * ذخیره می‌شود و در حالت چندمقداری، مقدار اول به‌عنوان مقدار legacy نگه داشته می‌شود.
     */
    private function normalizeArticleNumber(array $chunk): int|string|null
    {
        $values = $chunk['article_numbers'] ?? null;

        // پشتیبانی از JSON قدیمی
        if ($values === null && array_key_exists('article_number', $chunk)) {
            $values = $chunk['article_number'];
        }

        if ($values === null || $values === '') {
            return null;
        }

        if (!is_array($values)) {
            return is_scalar($values) ? $values : null;
        }

        $values = array_values(array_filter(array_map(
            static fn ($item) => is_scalar($item) ? trim((string) $item) : null,
            $values
        ), static fn ($item) => $item !== null && $item !== ''));

        if ($values === []) {
            return null;
        }

        $columnType = Schema::getColumnType('ai_knowledge_chunks', 'article_number');
        $numericTypes = ['integer', 'bigint', 'smallint', 'mediumint', 'tinyint'];

        if (in_array($columnType, $numericTypes, true)) {
            return (int) $values[0];
        }

        return implode(', ', $values);
    }

    /**
     * جلوگیری از ارسال آرایه به ستون‌های scalar در صورت وجود metadata قدیمی/نامتعارف.
     */
    private function normalizeScalar(mixed $value): int|string|null
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_array($value)) {
            $value = array_values(array_filter(array_map(
                static fn ($item) => is_scalar($item) ? trim((string) $item) : null,
                $value
            ), static fn ($item) => $item !== null && $item !== ''));

            return $value === [] ? null : implode(', ', $value);
        }

        return is_scalar($value) ? $value : null;
    }
}
