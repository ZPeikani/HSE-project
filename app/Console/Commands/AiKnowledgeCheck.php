<?php

namespace App\Console\Commands;

use App\Services\KnowledgeRetriever;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * php artisan ai:knowledge-check "نردبان سقوط ارتفاع"
 * بررسی می‌کند پایگاه دانش خوانده می‌شود و جستجو نتیجه می‌دهد (بدون تماس با مدل).
 */
class AiKnowledgeCheck extends Command
{
    protected $signature = 'ai:knowledge-check {query?* : متن جستجو}';
    protected $description = 'بررسی اتصال چت به پایگاه دانش (جدول‌ها، تعداد سند/تکه و نتیجه‌ی جستجو)';

    public function handle(): int
    {
        try {
            $docs   = DB::table('ai_knowledge_documents')->count();
            $active = DB::table('ai_knowledge_documents')->where('status', 'active')->count();
            $chunks = DB::table('ai_knowledge_chunks')->count();
        } catch (\Throwable $e) {
            $this->error('خواندن جدول‌ها ناموفق بود: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info("اسناد: {$docs} (فعال: {$active}) | تکه‌ها: {$chunks} | دیتابیس: " . DB::connection()->getDatabaseName());
        if ($active === 0 || $chunks === 0) {
            $this->error('پایگاه دانش خالی یا غیرفعال است؛ ایمپورت (AI_KNOWLEDGE_IMPORT.md) را بررسی کنید.');
            return self::FAILURE;
        }

        $queries = $this->argument('query') ? [implode(' ', $this->argument('query'))]
            : ['نردبان سقوط ارتفاع', 'کمربند ایمنی کار در ارتفاع', 'وسایل حفاظت فردی'];

        $retriever = new KnowledgeRetriever();
        foreach ($queries as $q) {
            $this->newLine();
            $this->line("جستجو: {$q}");
            try {
                // برای سؤال‌هایی که شماره ماده را صریح می‌خواهند، حتماً جستجوی سطح ماده را تست کن؛
                // search() فقط پنجره‌های چندماده‌ای برمی‌گرداند و برای اعتبارسنجی شماره ماده مناسب نیست.
                if (preg_match('/(?:^|\s)ماده\s*[-–:]?\s*[0-9]{1,3}(?=\s|$|[،,:؛.)])/u', $q)) {
                    $hits = $retriever->searchArticles($q, 5);
                } else {
                    $hits = $retriever->search($q);
                }
            } catch (\Throwable $e) {
                $this->error('خطا در جستجو: ' . $e->getMessage() . ' @ ' . basename($e->getFile()) . ':' . $e->getLine());
                return self::FAILURE;
            }
            if (!$hits) {
                $this->warn('  نتیجه‌ای پیدا نشد.');
            }
            foreach ($hits as $h) {
                $this->line("  - {$h['title']} | ماده " . ($h['article'] ?? '-') . " | امتیاز {$h['score']}");
                if (isset($h['text']) && trim($h['text']) !== '') {
                    $this->line('    شاهد: ' . preg_replace('/\s+/u', ' ', trim(mb_substr($h['text'], 0, 300))));
                }
            }
        }

        return self::SUCCESS;
    }
}
