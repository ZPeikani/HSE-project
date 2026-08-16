# نصب روی ویندوز (XAMPP)

1. PHP 8.2 یا جدیدتر، Composer و Node.js 20 یا جدیدتر را نصب کنید.
2. پروژه را مثلاً در `C:\xampp\htdocs\hse-manager` استخراج کنید.
3. CMD را در پوشه پروژه باز و دستورات زیر را اجرا کنید:

```bat
copy .env.example .env
composer install
npm install
php artisan key:generate
```

4. در phpMyAdmin دیتابیسی با نام `hse_manager` و Collation برابر `utf8mb4_unicode_ci` بسازید.
5. تنظیمات زیر را در `.env` جایگزین کنید:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hse_manager
DB_USERNAME=root
DB_PASSWORD=
```

6. سپس اجرا کنید:

```bat
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

سامانه در `http://127.0.0.1:8000` باز می‌شود. اطلاعات حساب‌های آزمایشی در README قرار دارد.
