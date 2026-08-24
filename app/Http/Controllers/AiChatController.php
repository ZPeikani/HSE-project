<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message'  => 'required|string|max:2000',
            'history'  => 'nullable|array|max:20',
            'history.*.role'    => 'required|in:user,assistant',
            'history.*.content' => 'required|string|max:4000',
        ]);

        $systemPrompt = 'شما یک دستیار هوش مصنوعی تخصصی در حوزه HSE (بهداشت، ایمنی و محیط‌زیست) هستید. '
            . 'در یک سامانه مدیریت HSE فعالیت می‌کنید و به کارکنان، بازرسان و مدیران کمک می‌کنید. '
            . 'پاسخ‌های خود را به فارسی، کوتاه، دقیق و عملی ارائه دهید. '
            . 'در صورت لزوم از اعداد، لیست‌بندی یا راهنمای گام‌به‌گام استفاده کنید.';

        $messages = [['role' => 'system', 'content' => $systemPrompt]];

        foreach (($request->history ?? []) as $h) {
            $messages[] = ['role' => $h['role'], 'content' => $h['content']];
        }
        $messages[] = ['role' => 'user', 'content' => $request->message];

        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.key'),
                'HTTP-Referer'  => config('app.url'),
                'X-Title'       => config('app.name'),
                'Content-Type'  => 'application/json',
            ])
            ->timeout(30)
            ->post('https://openrouter.ai/api/v1/chat/completions', [
                'model'       => 'openai/gpt-4o-mini',
                'messages'    => $messages,
                'max_tokens'  => 1000,
                'temperature' => 0.7,
            ]);

        if ($response->failed()) {
            return response()->json([
                'error'   => 'خطا در اتصال به سرویس هوش مصنوعی.',
                'debug'   => [
                    'http_status' => $response->status(),
                    'body'        => $response->json() ?? $response->body(),
                ],
            ], 502);
        }

        $content = $response->json('choices.0.message.content', '');

        if (empty($content)) {
            return response()->json([
                'error' => 'پاسخی از سرویس هوش مصنوعی دریافت نشد.',
                'debug' => [
                    'http_status' => $response->status(),
                    'body'        => $response->json() ?? $response->body(),
                ],
            ], 502);
        }

        return response()->json(['reply' => trim($content)]);
    }
}
