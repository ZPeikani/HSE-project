# سامانه مدیریت HSE

نسخه فاز اول سامانه سازمانی مدیریت سلامت، ایمنی و محیط‌زیست با Laravel 12 و Tailwind CSS 4.

## امکانات

- چهار نقش مدیر سامانه، مسئول HSE، مدیر واحد و بازرس با محدودسازی دسترسی و داده
- داشبورد اختصاصی، ساختار واحدهای سازمانی و ثبت فعالیت کاربران
- بانک چک‌لیست نسخه‌دار، برنامه‌ریزی و اجرای بازرسی و امتیاز انطباق
- دفتر خطرات و ماتریس ریسک ۵×۵ با اولویت‌بندی خودکار
- ثبت حادثه، شبه‌حادثه، بیماری شغلی و رویداد محیط‌زیستی
- تحلیل علت ریشه‌ای و اقدامات فوری
- چرخه کامل اقدامات اصلاحی: ارجاع، نتیجه، مستند، تأیید اثربخشی یا عودت
- گزارش مدیریتی واحدها، ریسک‌ها و رویدادها

## نصب

```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

برای MySQL، مقادیر `DB_*` در `.env` را تنظیم کنید و `DB_CONNECTION=mysql` قرار دهید.

## حساب‌های آزمایشی

| نقش | ایمیل | رمز |
|---|---|---|
| مدیر سامانه | admin@hse.test | password |
| مسئول HSE | manager@hse.test | password |
| مدیر واحد | unit@hse.test | password |
| بازرس | inspector@hse.test | password |

## نکات استقرار

- Document Root دامنه روی پوشه `public` تنظیم شود.
- در محیط واقعی `APP_DEBUG=false` و رمزهای آزمایشی فوراً تغییر کنند.
- اجرای زمان‌بند و صف برای اعلان‌های آینده توصیه می‌شود.
- پوشه‌های `storage` و `bootstrap/cache` باید قابل نوشتن باشند.

برای نصب روی XAMPP ویندوز، فایل `INSTALL-WINDOWS.md` را مطالعه کنید.
