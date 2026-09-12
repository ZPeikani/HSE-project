# HSE AI Knowledge - PDF Import

این مرحله Import PDF را به پروژه اضافه می‌کند.

## تغییرات
- افزودن `AiKnowledgeImportService`
- افزودن `AiKnowledgeImportController`
- افزودن صفحه `/ai/knowledge/import`
- افزودن لینک «پایگاه دانش AI» برای admin و hse_manager
- استخراج PDF با `smalot/pdfparser`
- تشخیص فصل‌ها و توالی مواد
- ذخیره هر ماده در `ai_knowledge_chunks`
- نگهداری شماره صفحه
- ذخیره فایل اصلی در storage خصوصی
- حذف `search_text` اضافی از `AiKnowledgeChunk`

## نصب وابستگی
به دلیل اینکه Composer در محیط توسعه فعلی شما به Packagist دسترسی پایدار نداشت، فقط dependency در `composer.json` ثبت شده است.

پس از برقراری اتصال Composer اجرا کنید:

```bash
composer update smalot/pdfparser --with-dependencies
```

سپس:

```bash
php artisan optimize:clear
```

## استفاده
با حساب admin یا hse_manager وارد سامانه شوید و از منوی:

مدیریت و تحلیل → پایگاه دانش AI

فایل PDF را انتخاب کنید و Import را بزنید.

برای PDF «آیین نامه وسایل حفاظت فردی» انتظار می‌رود ساختار ماده‌ها به‌صورت chunk ذخیره شود و شماره صفحه هر ماده نیز حفظ شود.

## نکته
این Importer برای PDFهای متنی است. PDF اسکن‌شده که متن قابل استخراج ندارد، در این مرحله نیازمند OCR است.
