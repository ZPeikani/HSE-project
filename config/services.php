<?php

return [

    'openrouter' => [
        'key' => env('OPENROUTER_API_KEY'),
        'model' => env('OPENROUTER_MODEL', 'openrouter/free'),
        // مسیریاب رایگان فقط مدل‌های رایگانِ سازگار با ورودی تصویر را انتخاب می‌کند.
        'vision_model' => env('OPENROUTER_VISION_MODEL', 'openrouter/free'),
        'vision_fallbacks' => env(
            'OPENROUTER_VISION_FALLBACKS',
            'qwen/qwen3.8-27b:free,google/gemma-4-31b-it:free,google/gemma-4-26b-a4b-it:free'
        ),
        // جستجوی وب وقتی جواب در منابع سامانه نبود (نیاز به اعتبار OpenRouter؛ با false خاموش می‌شود)
        'web_search' => env('OPENROUTER_WEB_SEARCH', true),
        // مقدار هدر X-Title؛ باید فقط ASCII باشد (نام فارسی می‌تواند با ۴۰۳ رد شود)
        'title' => env('OPENROUTER_TITLE', 'HSE Manager'),
    ],

    // سرویس سازگار با OpenAI که از ایران در دسترس است (مثلاً AvalAI: https://api.avalai.ir/v1)
    'ai' => [
        'base_url'     => env('AI_BASE_URL'),
        'key'          => env('AI_API_KEY'),
        'model'        => env('AI_MODEL'),
        // مدلی که ورودی تصویر را بپذیرد؛ اگر خالی باشد از AI_MODEL استفاده می‌شود
        'vision_model' => env('AI_VISION_MODEL'),
        // ترتیب تلاش؛ اولی خطا داد بعدی امتحان می‌شود
        'providers'    => env('AI_PROVIDERS', 'compatible,openrouter'),
        // اختیاری: ترتیب جدا برای متن و تصویر (اگر خالی باشد AI_PROVIDERS استفاده می‌شود)
        'providers_text'  => env('AI_PROVIDERS_TEXT'),
        'providers_image' => env('AI_PROVIDERS_IMAGE'),
    ],

];
