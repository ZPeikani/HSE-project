# Health Phase 1 — گزارش تغییرات

## قابلیت‌های اضافه‌شده
- داشبورد کل HSE به‌عنوان Executive Dashboard با Summary ایمنی و سلامت
- داشبورد تخصصی Safety مستقل از داشبورد کل
- داشبورد تخصصی Health
- پرونده سلامت شغلی کارکنان
- معاینات طب کار + History
- Fitness Status، محدودیت شغلی، Follow-up و موعد معاینه بعدی
- پیوست نتیجه معاینه
- آماده‌سازی Data Model برای Healthyline (`data_source`, `external_id`, `last_synced_at`) بدون API فرضی
- اعلان معاینه نزدیک سررسید/منقضی و Follow-up پزشکی
- Scope واحد سازمانی برای Unit Manager
- جلوگیری از دسترسی Inspector به اطلاعات Health
- نمایش محدود جزئیات پزشکی برای Unit Manager
- UI/UX جدید برای داشبوردها و صفحات سلامت

## خارج از این فاز
- عوامل زیان‌آور شغلی
- Measurement
- Ergonomics
- Environment

## نصب روی دیتابیس فعلی
1. از DB بکاپ بگیرید.
2. `DATABASE_UPDATE_HEALTH_PHASE1.sql` را روی دیتابیس فعلی Import کنید.
3. سورس جدید را جایگزین کنید.
4. اجرا کنید:

```bash
composer install
php artisan optimize:clear
php artisan storage:link
npm install
npm run build
```

## تست پذیرش سریع
1. ورود Admin و مشاهده Dashboard کل HSE.
2. ورود به Dashboard ایمنی و اطمینان از حفظ KPIهای قبلی.
3. ورود به Health Dashboard.
4. ایجاد Health Profile برای یک User بدون پرونده.
5. ثبت Medical Examination و مشاهده Update خودکار Summary پرونده.
6. ویرایش معاینه و بررسی History.
7. ورود Unit Manager و اطمینان از محدودشدن افراد به همان واحد.
8. بررسی اینکه Unit Manager جزئیات محرمانه Result/Notes را نمی‌بیند.
9. ورود Inspector و اطمینان از نبود دسترسی به routeهای Health.
10. بررسی اعلان‌های سررسید Health.
11. Upload پیوست و بررسی مسیر `storage/app/public/health-exams`.

## محدودیت فعلی
مدل پرسنل پروژه فعلی همان `users` است؛ بنابراین Health Profile فعلاً برای کاربرانی ساخته می‌شود که در جدول users وجود دارند. در فازهای بعدی، اگر نیاز سازمان به ثبت کارکنان بدون حساب ورود مطرح شود، بهتر است موجودیت Employee جداگانه طراحی شود و User فقط برای Authentication باقی بماند.
