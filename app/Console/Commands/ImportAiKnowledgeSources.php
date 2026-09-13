<?php

namespace App\Console\Commands;

use App\Services\AiKnowledgeImportService;
use Illuminate\Console\Command;
use Throwable;

class ImportAiKnowledgeSources extends Command
{
    protected $signature = 'ai:knowledge:import-sources
                            {directory : پوشه‌ای که فایل‌های PDF متنی منابع داخل آن قرار دارد}
                            {--continue-on-error : در صورت خطا، Import منابع بعدی ادامه پیدا کند}';

    protected $description = 'Import a directory of Iranian HSE PDF/DOC sources into the AI knowledge base';

    public function handle(AiKnowledgeImportService $service): int
    {
        $directory = $this->argument('directory');

        try {
            $report = $service->importDirectory($directory);
        } catch (Throwable $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }

        foreach ($report['imported'] as $item) {
            $this->info("✓ {$item['file']} → {$item['title']} ({$item['chunks']} chunk)");
        }

        foreach ($report['skipped'] as $item) {
            $this->warn("↷ {$item['file']} → {$item['reason']}");
        }

        foreach ($report['failed'] as $item) {
            $this->error("✗ {$item['file']} → {$item['reason']}");
        }

        $this->newLine();
        $this->table(
            ['وضعیت', 'تعداد'],
            [
                ['واردشده', count($report['imported'])],
                ['تکراری/ردشده', count($report['skipped'])],
                ['خطادار', count($report['failed'])],
            ]
        );

        return $report['failed'] === [] || $this->option('continue-on-error')
            ? self::SUCCESS
            : self::FAILURE;
    }
}
