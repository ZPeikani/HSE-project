<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

/**
 * php artisan ai:diagnose
 * علت قطع بودن چت هوش مصنوعی (۴۰۳ / ۴۲۹ / کلید / شبکه) را مرحله‌به‌مرحله نشان می‌دهد.
 */
class AiDiagnose extends Command
{
    protected $signature = 'ai:diagnose';
    protected $description = 'تست اتصال به سرویس AI (داخلی و OpenRouter) و پیدا کردن علت خطای چت هوش مصنوعی';

    public function handle(): int
    {
        $this->info('── ۱) OpenRouter: دسترسی شبکه (بدون کلید) ──');
        $this->probe('هدر ASCII', 'GET', 'https://openrouter.ai/api/v1/models', ['X-Title' => 'HSE Manager']);
        $this->probe('هدر فارسی (مثل نسخه‌ی قبلی پروژه)', 'GET', 'https://openrouter.ai/api/v1/models', ['X-Title' => 'سامانه مدیریت HSE']);

        $orKey = (string) config('services.openrouter.key');
        $this->newLine();
        $this->info('── ۲) OpenRouter: اعتبار کلید ──');
        if ($orKey === '' || str_contains($orKey, 'your_openrouter_api_key')) {
            $this->warn('OPENROUTER_API_KEY تنظیم نشده.');
        } else {
            $this->probe('GET /key', 'GET', 'https://openrouter.ai/api/v1/key', ['Authorization' => 'Bearer ' . $orKey]);
        }

        $this->newLine();
        $this->info('── ۳) سرویس سازگار با OpenAI (AI_BASE_URL) ──');
        $base = rtrim((string) config('services.ai.base_url'), '/');
        $key  = (string) config('services.ai.key');
        if ($base === '' || $key === '' || str_contains($key, 'your_ai_api_key')) {
            $this->warn('AI_BASE_URL / AI_API_KEY تنظیم نشده.');
        } else {
            $res = $this->probe('لیست مدل‌ها', 'GET', $base . '/models', ['Authorization' => 'Bearer ' . $key]);
            if ($res && $res->successful()) {
                $ids = collect($res->json('data', []))->pluck('id')->take(40)->all();
                $this->line('نمونه مدل‌ها: ' . implode(', ', $ids));
                $this->line('AI_MODEL=' . config('services.ai.model') . ' | AI_VISION_MODEL=' . config('services.ai.vision_model'));
            }
        }

        $this->newLine();
        $this->line('راهنما: ۴۰۳ «Access denied by security policy» یعنی درخواست قبل از رسیدن به مدل بلاک شده (IP/VPN/منطقه، یا هدر نامعتبر).');
        $this->line('اگر ردیف «هدر فارسی» ۴۰۳ و «هدر ASCII» ۲۰۰ بود، مشکل از هدر بوده و با این نسخه حل شده است. اگر هر دو ۴۰۳ بودند، VPN/شبکه را عوض کنید یا از سرویس داخلی (AI_BASE_URL) استفاده کنید.');

        return self::SUCCESS;
    }

    private function probe(string $label, string $method, string $url, array $headers, bool $print = true)
    {
        try {
            $res = Http::withHeaders($headers)->connectTimeout(10)->timeout(20)->send($method, $url);
        } catch (ConnectionException $e) {
            $this->error("{$label}: اتصال برقرار نشد → " . $e->getMessage());
            return null;
        }

        $line = "{$label}: HTTP {$res->status()}";
        if (! $res->successful()) {
            $line .= ' → ' . mb_substr(trim($res->body()), 0, 160);
            $this->error($line);
        } else {
            $this->info($line);
        }

        return $res;
    }
}
