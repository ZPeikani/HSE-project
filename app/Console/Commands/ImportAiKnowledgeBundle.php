<?php

namespace App\Console\Commands;

use App\Models\AiKnowledgeChunk;
use App\Models\AiKnowledgeDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use RuntimeException;

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
                        'chapter' => $chunk['chapter'] ?? null,
                        'article_number' => $chunk['article_number'] ?? null,
                        'paragraph_number' => $chunk['paragraph_number'] ?? null,
                        'page_number' => $chunk['page_number'] ?? null,
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
}
