این بسته شامل فایل Knowledge Bundle آماده برای پروژه hse_manager است.
مسیر داخل پروژه:
database/seeders/data/ai_knowledge_bundle.json

بعد از کپی فایل، اجرا کنید:
php artisan ai:knowledge:import-bundle database/seeders/data/ai_knowledge_bundle.json

توجه: Runtime به OCR نیاز ندارد. چند منبع PDF رمزگذاری/اسکن‌شده بودند و متن کامل آنها از فایل اصلی با اطمینان قابل استخراج نبود؛ در این نسخه از بازسازی حدسی متن خودداری شده است.
