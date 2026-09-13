# پایگاه دانش AI — معماری بدون OCR در Runtime

این پروژه در زمان اجرای Laravel به هیچ ابزار سیستم‌عاملی مثل Tesseract، Poppler یا LibreOffice وابسته نیست.

## اصل طراحی

- PDF متنی: با `smalot/pdfparser` در PHP پردازش می‌شود.
- PDF اسکن‌شده / Encoding خاص و فایل‌های DOC: فقط در مرحله آماده‌سازی آفلاین پردازش می‌شوند.
- خروجی آماده‌سازی به صورت `Knowledge Bundle` (JSON) وارد دیتابیس می‌شود.
- روی سرور/سیستم مقصد فقط PHP + Composer dependencies لازم است.
- موبایل/مرورگر کاربر هرگز نیاز به OCR ندارد؛ OCR اگر استفاده شود مربوط به مرحله Build/Import اولیه روی سیستم توسعه است.

## وارد کردن بسته آماده

```bash
php artisan ai:knowledge:import-bundle database/seeders/data/ai_knowledge_bundle.json
```

این دستور فقط JSON و دیتابیس را می‌خواند و هیچ binary خارجی اجرا نمی‌کند.

## وارد کردن PDF متنی جدید

```bash
php artisan ai:knowledge:import-sources "PATH_TO_FOLDER"
```

اگر PDF اسکن‌شده یا دارای Encoding غیرقابل‌استخراج باشد، سیستم عمداً آن را رد می‌کند و پیشنهاد نمی‌دهد روی سیستم مقصد OCR نصب شود. چنین فایل‌هایی باید یک‌بار در محیط آماده‌سازی به Bundle تبدیل شوند.
