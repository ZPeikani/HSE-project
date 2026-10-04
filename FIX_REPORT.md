# HSE Manager - AI Knowledge Fix

اصلاحات انجام‌شده:

1. `app/Http/Controllers/AiChatController.php`
   - citation قانونی دیگر فقط برای عکس/follow-up نیست؛ هر درخواست صریح برای ماده/منبع از مسیر verification عبور می‌کند.
   - reminder متناقض «شماره ماده را خودت ننویس...» به قانون روشن ضد hallucination تبدیل شد.
   - prompt کلی اصلاح شد تا مدل شماره ماده را حدس نزند و citation از متن بازیابی‌شده بیاید.
   - برای سؤال مستقیم، citation با `searchArticles()` از خود سؤال استخراج می‌شود.

2. `app/Services/KnowledgeRetriever.php`
   - درخواست‌های صریح مثل «ماده 24» با شماره ماده به‌صورت exact filter پردازش می‌شوند.
   - parser شکل‌های `ماده 24`، `ماده-24` و `مادهـ24` را می‌پذیرد.

3. `DATABASE_FIX_KNOWLEDGE_HEIGHT.sql`
   - سه کپی فعال آیین‌نامه ارتفاع را به یک کپی canonical محدود می‌کند (ID=13 باقی می‌ماند).
   - ماده‌های 1 تا 10 که در dump فعلی document 13 گم شده‌اند را به پایگاه دانش برمی‌گرداند.
   - این بخش برای رفع مشکل واقعی «1/2 متر → ماده 2» ضروری است؛ صرفاً تغییر prompt این داده‌ی گمشده را برنمی‌گرداند.

اعتبارسنجی انجام‌شده:
- `php -l app/Http/Controllers/AiChatController.php` → OK
- `php -l app/Services/KnowledgeRetriever.php` → OK
- `php -l app/Console/Commands/AiKnowledgeCheck.php` → OK

بعد از استقرار:
1. از دیتابیس backup بگیر.
2. `DATABASE_FIX_KNOWLEDGE_HEIGHT.sql` را اجرا کن.
3. `php artisan optimize:clear`
4. `php artisan ai:knowledge-check "حداقل ارتفاع کار در ارتفاع چند متر است"`
5. سپس در چت:
   `حداقل ارتفاعی که کار در ارتفاع محسوب می‌شود چند متر است؟ شماره ماده را بگو.`
6. تست‌های بعدی:
   - `ماده 24 درباره کمربند ایمنی چیست؟`
   - `ماده 26 درباره نردبان چه می‌گوید؟`
   - عکس نردبان روی مصالح + «برای هر خطر ماده مرتبط را بگو»

نکته: متن ماده‌های 1 تا 10 در SQL repair بر اساس نسخه متنی همان آیین‌نامه‌ای که برای URL منبع سند در پروژه ثبت شده بازسازی شده است. برای استناد رسمی، نسخه اصلی PDF/منبع رسمی را با داده‌ی واردشده تطبیق بده.
