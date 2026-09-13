<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class SafetyChecklistsSeeder extends Seeder
{
    public function run(): void
    {
        $createdBy = DB::table('users')
            ->whereIn('role', ['admin', 'hse_manager'])
            ->where('is_active', 1)
            ->orderBy('id')
            ->value('id');

        if (!$createdBy) {
            $createdBy = DB::table('users')
                ->where('is_active', 1)
                ->orderBy('id')
                ->value('id');
        }

        if (!$createdBy) {
            throw new RuntimeException('SafetyChecklistsSeeder: هیچ کاربر فعالی برای مقدار created_by پیدا نشد.');
        }

        $checklists = array (
  0 => 
  array (
    'title' => 'بازرسی ایمنی عمومی محیط کار',
    'category' => 'ایمنی عمومی',
    'description' => 'کنترل شرایط عمومی ایمنی، نظم، حریق و تجهیزات حفاظت فردی',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'مسیرهای تردد و خروج اضطراری باز و بدون مانع هستند؟',
        'guidance' => NULL,
        'weight' => 3,
        'is_critical' => true,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'کپسول‌های آتش‌نشانی در دسترس و دارای اعتبار هستند؟',
        'guidance' => NULL,
        'weight' => 3,
        'is_critical' => true,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'کارکنان از تجهیزات حفاظت فردی مناسب استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 3,
        'is_critical' => true,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'تابلوها و علائم هشداردهنده در محل مناسب نصب شده‌اند؟',
        'guidance' => NULL,
        'weight' => 2,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'محیط کار دارای نظم و نظافت قابل قبول است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  1 => 
  array (
    'title' => 'وسایل حفاظت فردی',
    'category' => 'تجهیزات حفاظت فردی',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا محیط کار کارکنان از نظر تعیین نوع خطرات موجود و وسایل حفاظت فردی مورد نیاز (دستکش، ماسک، گوشی و …) ارزیابی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا مسئول ایمنی هر روز قبل از شروع کار پوشش‌ها و وسایل حفاظتی کارگران را بازدید می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا همه کارگران کلاه، کفش، ماسک، عینک و سایر وسایل حفاظت فردی خود را بررسی می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا پوشش‌ها و وسایل ایمنی توسط مسئولین ایمنی و بهداشت بازدید می‌شوند و سالم هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا صافی ماسک‌های تنفسی به موقع تعویض می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا وسایل حفاظت فردی به اندازه کافی در کارگاه موجود است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا کارکنان به استفاده از وسایل حفاظت فردی علاقمندی نشان می دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا کارکنان آموزش‌های لازم را در زمینه به‌کارگیری صحیح وسایل حفاظت فردی، اینکه چه وسیله‌ای برای چه کاری لازم است و نحوه استفاده از آن را دیده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا در صورت مشخص شدن خطرات یا احتمال بروز آن‌ها، برای پیشگیری از حوادث وسایل حفاظت فردی مناسب در اختیار کارکنان قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا در جاهایی که خطر پرتاب ذرات و مواد خورنده وجود دارد عینک‌های ایمنی یا محافظ صورت تهیه و توسط کارکنان استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا در جاهایی که امکان بریدگی دست و سایر اعضای بدن یا تماس پوستی با مواد شیمیایی، مواد خورنده، خون و سایر آلودگی‌های عفونی وجود دارد، دستکش ایمنی، پیش‌بند و سایر حفاظ‌های مناسب فراهم شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا وسایل حفاظتی از استاندارد مناسبی برخوردار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا پوسترهای هشداردهنده جهت استفاده از وسایل وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا کلاه ایمنی به‌طور مرتب از نظر آسیب بدنه و ملحقاتش بازرسی می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا وسایل حفاظت فردی جهت استفاده از کارگران به موقع توزیع می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا وسایل حفاظت فردی برای خطرات اختصاصی کافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا مناطق و مشاغلی که نیاز به حفاظت دستگاه تنفسی دارند مشخص است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا در جاهایی که تراز صدا بیشتر از حد مجاز توصیه‌شده است، اقدامات حفاظتی برای جلوگیری از اثرات آن به‌کار گرفته شده و از گوشی‌های حفاظتی استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا لباس کار و لباس حفاظتی با نوع شغل تهیه گردیده و به‌طور مناسب نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا محل ها و مشاغلی که نیاز به کمربند ایمنی دارند مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا افراد در زمینه چگونگی کاربرد و استفاده صحیح کمربند ایمنی آموزش دیده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا وسایل حفاظت فردی در شرایط بهداشتی جهت استفاده در انبار نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا در جاهایی که خطر جراحت پا در اثر حرارت، مواد خورنده، مواد سمی یا سقوط اشیاء وجود دارد، کفش و پوتین ایمنی مناسب تهیه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا پوسترهای ایمنی در جاهای مهم که همه کارگران بتوانند آن را ببینند نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا شماره تلفن اورژانس به دیوار زده شده است در جایی که کارگران بتوانند در مواقع اضطراری از آن استفاده نمایند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا در جایی که کارگران ممکن است در تماس با مواد سمی یا عوامل فیزیکی مضر باشند اطلاعات مربوط به نحوه دسترسی کارگران به خدمات پزشکی و ثبت تماس ها و ورقه‌های اطلاعات ایمنی مواد به آسانی در دسترس کارگران است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا نشانه‌ها و علائم ایمنی در محل‌های مورد نیاز نصب شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا برای کارکنانی که از نظر بینایی مشکل دارند و باید از عینک‌های ایمنی طبی استفاده نمایند و از سوی دیگر بر اساس نوع شغلشان در معرض آسیب و حادثه چشمی می‌باشند عینک ایمنی طبی خاص با نمره مناسب فراهم گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا مراحل و روش‌های خاصی جهت تمیز سازی و ضدعفونی وسایل حفاظت فردی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا هنگام تمیز کردن ریخت‌وپاش های مواد سمی و دیگر مواد خطرناک، از روش‌های کاری و لباس‌های ایمنی مناسب و وسایل حفاظتی دیگر استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا در جاهایی که کارگران در تماس با مواد شیمیایی و خورنده می‌باشند، امکاناتی از قبیل چشم‌شوی و دوش اضطراری وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  2 => 
  array (
    'title' => 'ایمنی حریق',
    'category' => 'حریق',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا نوع کپسول های اطفای حریق با توجه به نوع حریق انتخاب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا کپسول های اطفای حریق ظرفیت کافی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا کپسول ها دارای تاریخ انقضاء و شارژ هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا تعداد کپسول ها ی موجود کافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا کپسول‌ها در محل مناسب نصب شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا کپسول ها از زنگ زدن و ضربه زدن محافظت می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا افراد با نحوه استفاده از کپسول ها و عملیات اطفای حریق آشنایی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا در صورت بروز حریق امکان تماس و دسترسی با آتش‌نشانی وجود دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا در کارگاه مرکز آتش‌نشانی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا به‌جز کپسول های اطفاء حریق از وسایل دیگر آتش‌نشانی استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا از مجاورت منابع حریق با منابع سوخت ممانعت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا طرح از پیش تعیین شده برای اطفای حریق به موقع صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا بازدید و سرویس وسایل اطفای حریق به موقع صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا آب آتش‌نشانی در مخزن آب به‌طور جداگانه تهیه می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا جایگزینی خاموش‌کننده های مصرف شده سریعاًً انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا شیلنگ های رابط کپسول های اطفای حریق از وضعیت خوبی برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا دسترسی به خاموش‌کننده ها به سهولت انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا فشارسنج خاموش‌کننده‌ها در وضعیت صحیح قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا سیستم اعلام حریق دستی (زنگ خطر) وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا در کنار پست برق کپسول های موجود است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا خاموش‌کننده ها دستور عملکرد استفاده به صورت فارسی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا در صورت تغییر مکان خاموش‌کننده‌ها، مسئول ایمنی و سایر افراد از محل جدید آن‌ها مطلع هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا نقشه ای برای نشان دادن موقعیت تمام وسایل اطفای حریق وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا خاموش‌کننده ها شکستگی، فرورفتگی، ترک، سوراخ و یا نواقص دیگری دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا خاموش‌کننده های خالی شده همچنان روی دیوار قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا ضامن خاموش‌کننده ها سرجایش است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا خاموش‌کننده ها به سادگی قابل رویت هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا کارگر با توجه به وزن کپسول می‌تواند از آن استفاده کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا کالاها در فواصل مناسب از وسایل روشنایی و برقی به‌طور جداگانه انبار می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا مسئول معینی وجود دارد که مراقب خطرات و سرکشی به کارگاه ها باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا محل نصب شاسی زنگ خطر مشخص است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا کتابچه ای مبنی بر یادداشت تاریخ های تست سیستم اعلام حریق وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا کارگران تاکنون مانور اطفای حریق انجام داده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا سیستم اعلام حریق به صورت هفتگی چک می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا کارگران آموزش کار با وسایل اطفای حریق را دیده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا کارگران می‌دانند که با توجه به نوع حریق به‌وجود آمده می‌بایستی از چه نوع کپسولی برای خاموش کردن آن استفاده کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا در صورت مشاهده آتش‌سوزی موارد ذیل را به ترتیب انجام می دهند؟ ) به صدا در آوردن آژیر خطر، مطلع کردن واحد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا علائم مخصوص ) سیگار کارگاه و اداره آتش‌نشانی، بستن تمام درها و پنجره ها در صورت امکان و خارج شدن از ناحیه یا ساختمان آتش گرفته( نکشید ( در محل های لازم نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا در انتهای روز کاری از خاموش بودن تمام دستگاه ها اطمینان حاصل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا فیوز با مقاومت مناسب در دستگاه نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  3 => 
  array (
    'title' => 'واکنش در شرایط اضطراری',
    'category' => 'شرایط اضطراری',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا شرکت یک طرح اضطراری مدون دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا کمیته اضطراری برای اجرای برنامه‌ها و پیاده سازی طرح تشکیل شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا نمایندگان قسمت‌های مختلف در کمیته اضطراری عضویت دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا شرح وظایف اعضای کمیته اضطراری به روشنی مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا شرایط اضطراری محتمل و شناسایی و دسته بندی شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا برای شرایط اضطراری مختلف شناسایی شده سناریوی مانور تعریف شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا نقشه شرایط اضطراری که در آن خروجی‌ها، مناطق امن، مناطق خطرناک، ایستگاه آتش‌نشانی و بهداری کانکس ایمنی و بهداشت مشخص شده، تهیه گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا نقشه شرایط اضطراری در اختیار پرسنل و بازدیدکنندگان قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا چارت تیم کمیته بحران و واکنش در شرایط اضطراری تهیه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا اعضای کمیته بحران و واکنش در شرایط اضطراری مشخص شده در چارت تهیه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا در کلینیک و بهداری وسایل و تجهیزات پزشکی و جوابگوی طرح‌های اضطراری است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا فهرست شماره تلفن‌های اضطراری داخل و خارج از سایت وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا طرح‌های تخلیه اضطراری وجود داشته و تمرین می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا اطلاعات مربوط به تجهیزات و فرآیندهای واحدهای مختلف جمع‌آوری شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا برگه های اطلاعات ایمنی مواد تهیه شده و در نقاط مختلف اطلاع‌رسانی گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا تجهیزات اعلام عمومی از قبیل آژیر و زنگ اخبار، بلندگو و سیستم پیجینگ، بی سیم، تلفن داخل و خارجی، موبایل و فاکس موجود است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا سیستم‌های صوتی و تصویری برای ثبت وقایع وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا تجهیزات کمیته واکنش در شرایط اضطراری از قبیل لوازم‌التحریر، فایل، کمد، ملزومات اداری، رایانه و نرم‌افزارهای جانبی، تجهیزات رادیویی، تجهیزات هواشناسی، چراغ‌قوه، تبر، طناب نجات، کیف کمک‌های اولیه و کپسول اکسیژن وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا تابلویی جهت ثبت و گزارش وقایع، حوادث و آمار نیروی انسانی تهیه شده و در سایت پس از نصب به روز می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا در منطقه عملیاتی، شبکه واکنش در شرایط اضطراری برای ارتباط با سایر پیمانکاران، کارفرمایان، مرکز بهداشت، آتش‌نشانی، نزدیک‌ترین بیمارستان، هلال احمر و شهرداری محل وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا مستنداتی حاکی از مشخص بودن شرح وظایف افراد در شبکه واکنش در شرایط اضطراری وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا دستورالعمل‌های عمومی و اختصاصی آمادگی و واکنش در شرایط اضطراری برای شرایط محتمل تدوین و اجرا شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا دستورالعمل‌های آمادگی و واکنش در شرایط اضطراری به‌صورت دوره‌ای مورد بازنگری و تجدیدنظر قرار می‌گیرند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا طرح‌های توقف اضطراری، تخلیه اضطراری، امداد و نجات، کمک‌های اولیه، حراست و امنیت فیزیکی تهیه شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا سناریوهایی برای اانواع شرایط اضطراری تدوین شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا مطابق با سناریوهای تدوین‌شده، برنامه‌های مانور به اجرا درمی‌آیند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا مانورها به‌صورت دوره‌ای اجرا می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا سوابقی حاکی از سنجش اثربخشی مانورها موجود است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا با توجه به برنامه‌های انجام شده، سناریوها و مانورها به روز می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا طرح ارتباطات و اطلاعات اضطراری، طرح واکنش اضطراری مواد خطرناک، طرح پاکسازی ریخت‌وپاش‌ها، طرح آتش‌نشانی، مستندات پشتیبان، طرح استقرار سیستم‌های اعلام و اطفای حریق، جانمایی خاموش‌کننده‌های دستی، بازرسی و تست تجهیزات ایمنی و تعیین خطوط تلفن اضطراری (آتش‌نشانی، ایمنی، اورژانس و بهداری) تهیه و تدوین شده و به قسمت‌های مختلف ابلاغ می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  4 => 
  array (
    'title' => 'ایمنی تجهیزات و جلوگیری از سقوط از ارتفاع',
    'category' => 'کار در ارتفاع',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا محل استقرار کارگران برای اجرای عملیات اجرایی به لحاظ تحمل وزن کارگران و ابزار آلات آنها استحکام کافی دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا تجهیزات ایمنی جلوگیری از سقوط کارگران از ارتفاع ۳ متر یا بیشتر به درستی انتخاب و نصب شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا تجهیزات ایمنی جلوگیری از سقوط کارگران مقاومت لازم را برای نگه داشتن کارگر در حال سقوط و یا حداقل کم کردن سرعت سقوط کارگر تا سرعت ایمن دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا محل هایی که ارتفاع حفاری و خاکبرداری بیش از ۵ متر می‌باشد نرده‌های محافظ در لبه‌ها گود نصب شده و از استحکام کافی برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا در عملیات آرماتوربندی دیوارها در ارتفاع، برای استقرار ایمن آرماتوربند دستگیره‌ها و پله‌های مخصوص در دیوار تعبیه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا در عملیات آرماتوربندی دیوارها در ارتفاع بیش از ۷ متر کمربند ایمنی توسط کارگران آرماتوربند مورد استفاده قرار می‌گیرند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا در مکان‌هایی که نرده‌های محافظ برای بارگیری مصالح به‌صورت موقت برداشته می‌شوند، پرسنل پیمانکار از کمربند ایمنی استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا اگر از کمربند ایمنی مسیر نباشد از تور ایمنی ) ( محافظ زیر سکو استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'می‌باشد نرده محافظ (گارد) نصب شده است؟ متر بازشوهایی که امکان سقوط در آنها وجود دارد و دارای ارتفاع بیش از آیا در اطراف؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'مقابل خطر سقوط از ارتفاع محافظت می‌شوند؟ متر می‌باشد از طریق نصب گارد، تور ایمنی و یا کمربند ایمنی در آیا کارگرانی که روی بام و سقف کار می‌کنند و ارتفاع بام بیشتر از؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'تور ایمنی از استحکام آیا و شده است؟ متر زیر سطحی که کارگران روی آن مشغول کارند نصب آیا تور ایمنی محافظ در فاصله ماکزیمم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا تور ایمنی از استحکام کافی مطابق با استاندارد برخوردار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => '۳۱ سانتی متر مربع است؟ ۵۱ سانتی متر مربع و آیا هر ضلع چشمه نیز کوچکتر از آیا اندازه چشمه های تور محافظ کوچکتر از؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کارگرها با زمین و یا سازه زیر آن برخورد نکرده و مطابق با رعایت حداقل فاصله آیا تور ایمنی در ارتفاعی نصب شده است که به هنگام سقوط استاندارد با سطح زمین نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'متری از پرتگاه و محل های گودبرداری شده نصب شبرنگ به رنگ زرد یا قرمز حداقل تا فاصله افقی آیا علائم هشداردهنده ساخته شده از گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا نرده‌های محافظ (گارد) دور تا دور سطوح کار مرتفع نصب شده و از استحکام کافی برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => '۷۱ کیلوتن است؟ / آیا طناب، سیم و یا زنجیر محافظ نصب شده دارای حداقل مقاومت کششی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا پوشش مستقر روی سطح محل عبور و مرور کارگران قادر به تحمل وزن کارگر با تمام ی وسایل و ابزار آلاتش است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'متر از سطح زمین و یا سکو ارتفاع ۱ متر و در بلندی حداکثر / آیا نرده محافظ به طریقی نصب شده است که در گودی های حداقل؟ داشته باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا چشمه ها و درزهای نرده‌های محافظ نصب شده به اندازه ای کوچک هستند که مانع از سقوط و عبور اجسام و مصالح از داخل آنها شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا نخاله و مواد زائد به‌طور منظم از کارگاه جمع‌آوری و به داخل از کارگاه منتقل می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => '۲۲ متری از لبه پرتگاه انبار شده‌اند؟ / آیا کلیه مصالح در فاصله حداقل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا کلیه مصالح، لوازم و ابزار آلات به صورت ایمن و طوری که به خودی خود جابجا و یا سقوط نکنند قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا به تمامی کارگران تذکرات لازم در مورد رعایت کردن موارد ایمنی و توجه به هشدارهای افسر ایمنی داده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا کارگران آموزش‌های لازم را طی کرده‌اند و مسئول ایمنی از تمام نقاط سرکشی و بازدیدهای ایمنی را انجام می‌دهد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  5 => 
  array (
    'title' => 'ایمنی خاکبرداری و گودبرداری',
    'category' => 'خاکبرداری و گودبرداری',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا احتمال رانش و فرسایش خاک بعد از عملیات خاکبرداری وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا اطراف محل مانع سخت، نوار خطر و علائم هشداردهنده نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا رفت‌وآمد وسایل نقلیه در اطراف محل خاکبرداری‌شده کنترل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا معبر موقت ارتباطی دوطرفه روی محل خاکبرداری‌شده ایجاد شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا فاصله مواد و اشیاء از لبه کانال بیش از یک متر است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا نگهداری و مراقبت از تأسیسات زیرزمینی انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا در خاکبرداری‌های عمیق، تخته و شمع‌کوبی، تخلیه آب، طراحی مناسب پله یا شیب و تهویه مناسب در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا برای ورود و خروج پرسنل، نردبان یا راه‌پله مناسب فراهم شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا در اطراف محل خاکبرداری‌شده، برای نوبت کاری شب روشنایی کافی جهت حفاظت پرسنل و ماشین‌آلات از خطر سقوط فراهم شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا پرسنل از تجهیزات حفاظت فردی متناسب با کار استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا مجوز خاکبرداری اخذ گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا محل تأسیسات برق، آب و گاز وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا علائم ایمنی جهت نصب در محل وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا مسیر ایمن تردد ماشین‌آلات در هنگام و پس از حفاری پیش‌بینی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا موانعی نظیر درخت و یا تخته سنگ یا سایر موارد مشابه که ممکن است ایجاد خطر نماید از محل گودبرداری خارج شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'در صورت وجود احتمال خطر برای ساختمان ها، خیابان ها و … مجاور گودبرداری و با توجه به نوع خاک، آیا سازه نگهبان برای آنها در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا شیب مناسب برای دیواره های گودبرداری منظور شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'امیکی ناشی از تردد وسایل نقلیه و غیره وجود دارد، آیا تدابیر خاصی به منظور در صورتی که در حاشیه گودبرداری بار دین تقویت آن قسمت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => '۰۲ متر ( آیا فاصله دپوی مصالح حاصل از گودبرداری تا لبه گود به اندازه کافی است؟ ) حداقل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'متر عمق، پاگردی جهت در گودبرداری های عمیق آیا در محل ورود و خروج کارگران و یا پلکان و نردبان دسترسی در هر ایمنی نصب یا احداث شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'و اشیاء متر وبه منظور جلوگیری از سقوط انسان ۵.آیا حاشیه های گودبرداری به کمک نرده ) گاردریل ( و یا تخته و تا ارتفاع محافظت شده است؟ آیا نرده ها محکم نصب شده‌اند و از مقاومت کافی برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا برای حفاظت تأسیسات زیر بنایی ) لوله آب، گاز و کابل برق و غیره ( عبوری از پیاده اقدامی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کافی بوده و در صورت لزوم از چراغ گردان استفاده می‌شود؟ دارای نور آیا در شب هنگام، معابر عمومی اطراف گودبرداری؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'در صورت وجود آب، آیا پیش‌بینی خاصی جهت تثبیت دیوارها و زهکشی در نظر گرفته می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا ورودی های محل گودبرداری و حفاری برای اشخاص غیر مجاز ممنوع شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'غیر مجاز امضاء شده و نگهداری می‌شود؟ به بازرسی ها به تعداد کافی و توسط اشخاص آیا تمام اسناد و مدارک مربوط؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'و خاکبرداری با لودر یا بیل مکانیکی و بعد از هوای طوفانی آیا قبل از شروع هر شیفت کاری، بعد از استفاده از مواد منفجره بخصوص بارندگی شدید و یخبندان، بررسی ها و بازرسی های روزانه انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا دیوارها ی گودبرداری شده با عمق بیش از یک متر بوسیله نصب شمع و مهارها محکم حفاظت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا از فعالیت کارگر به تنهایی در گودال ها، کانال ها و شیارهای با عمق بیش از یک متر جلوگیری به‌عمل می آید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا در کانالها و شیارهای عمیق بیش از یک متر به ازای هر ۱۳ متر طول حداقل یک نردبان کار گذاشته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا لبه بالایی نردبان ها تا ۲۳ سانتی متر از لبه کانال ادامه دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا اقدامات احتیاطی برای کارگرانی که در مجاورت محل گودبرداری و حفاری مشغول به‌کارند به‌عمل آمد است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا از چراغ های چشمک زن در شب در محل گودبرداری ها استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => '۵۳ متر است؟ حفاری و گودبرداری از کانال آیا حداقل فاصله ضایعات ناشی از عملیات؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا پیرامون منطقه گودبرداری، مهار یا حفاظ مناسب با حداقل ارتفاع یک متر از سطح زمین استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا لبه‌های گود به صورت مقاوم حفاظ گذاری شده‌اند تا در صورت عبور خودروها مشکلی پیش نیاید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا از چراغ های اخطار دهنده و علائم ترافیکی برای گودبرداری ها استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا موانعی نظیر تخته سنگ یا سایر موارد مشابه که ممکن است ایجاد خطر نماید از محل گودبرداری خارج شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => '۱۴ متر فاصله دارد؟ ۵.۲ الی آیا دپوی مصالح حاصل از گودبرداری تا لبه گود حداقل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'متر عمق، پاگردی جهت در گودبرداری های عمیق آیا در محل ورود و خروج کارگران و یا پلکان و نردبان دسترسی در هر ایمنی نصب یا احداث شده است؟ و آیا پاگرد نصب شده دارای حفاظ مناسب و مطمئن است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'در صورتی که گودبرداری تا زیر پیاده رو ادامه دارد آیا سازه نگهبان در زیر نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا علائم هشداردهنده و موانع در محل گودبرداری جهت اطلاع کارکنان و عموم نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا دستگاه های بالابر مورد استفاده به‌طور ایمن در محل نصب شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا نشتی آب زیرزمینی یا نفوذی در دیوارها ی گودبرداری شده مشاهده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا برای جلوگیری از ورود آب های سطحی به داخل گودبرداری فکر ی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا روش حفاری قبل از شروع به‌کار مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا نحوه برچیدن سازه نگهبان منطبق با شرایط حفاری برنامه ریزی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا از مصالح مرغوب استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا در مواقع حفاری متخصص و کارشناس مربوطه حضور دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا تخته های عرضی جهت پایدار ی دامنه ها بلافاصله پس از حفاری نصب می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا سازه های نگهبان به درستی و ایمن در جای خود قرار داده شده و کاملاً ثابت گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا کلیه عملیات مربوطه به به درستی و کامل انجام شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'آیا اپراتور وسایل مکانیکی و ماشین‌آلات حفاری و گودبرداری دارای دید کافی و مسلط می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'کافی و مناسب و به‌طور ایمن نظیر طناب ها، پلکان های متحرک و غیره تعبیه شده یا آیا لوازم و تجهیزات دسترسی به تعداد وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'آیا عرض معابر و رمپ های احداثی ویژه وسایل نقلیه در گودبرداری ها کمتر از ۵ متر است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'آیا دیواره های محل گودبرداری و سازه های مجاور گودبرداری، بعد از وارد آمدن صدمات اساسی به مهارها، توسط شخص ذیصالح بررسی و بازدید می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'آیا قبل از ورود مقنی به چاه همکار وی سر چاه حاضر است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'رخورد با قنوات قدیمی، پی ها، تأسیسات آب و برق و … به عمل آیا قبل از حفاری چاه، بررسی های لازم در رابطه با احتمال ب آمده و در صورت لزوم با سازمان های مربوطه تماس گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  6 => 
  array (
    'title' => 'ایمنی کارهای برقی',
    'category' => 'ایمنی برق',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا پرسنل واجد شرایط کارهای برقی هستند و دوره های آموزشی مربوطه را گذرانده و از مهارت و تجربه برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا کارگران معنی علائم و برچسب ها، موانع و هشدارهای مربوط به خطرات الکتریکی را می‌دانند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا کارگران به اصول ایمنی برق آشنا هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا پرسنل برقکار با دستورالعمل‌های قفل‌گذاری، برچسب‌زنی، قواعد و محدودیت های کارگران آشنا هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا کارگران، عملیات ایمن کاری اطراف تجهیزات برقی را می‌دانند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا کارگران اقدامات لازم در شرایط اضطراری و کمک های اولیه در موارد شوک الکتریکی، سوختگی و حریق را می‌دانند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'فضاها ی محدود که ممکن است بخشهای برقدار داشته آیا کارگران استفاده از روشنایی مناسب و حفاظت در هنگام وارد شدن به باشد را به خوبی درک کرده اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا کارگران اقدامات خاص مربوط به قطع برق و آزادسازی انرژی ذخیره شده را می‌دانند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا فواصل ایمن لازم شده برای کارگران و وسایل نقلیه از سیم های هوایی انتقال برق رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا پرسنل برقکار استفاده از ابزار عایق یا ایزوله شده برای کار با سیم های هوایی انتقال برق انجام می دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا پرسنل برقکار عدم استفاده و دور انداختن ابزار و سیم های آسیب دیده و معیوب را انجام می دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا پرسنل برقکار از لباس‌های رسانا، جواهر آلات یا مواد پاک کننده در نزدیک بخش های برقدار استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا پرسنل برقکار برای کار در ارتفاع از نردبان دارای پله های عایق دار در بخش های برقدار استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا پرسنل برقکار از ابزار عایق و نارسانا هنگام کار کردن با تجهیزات برقی استفاده می نمایند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا پرسنل برقکار قبل از استفاده از ابزار و تجهیزات برقی آنها را کنترل می نمایند تا اتصالی و ایرادی نداشته باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا کارگران بازرسی سیم ها برای اطمینان از سالم بودن عایق آنها را به‌طور مرتب انجام می دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا بازرسی اتصالات از نظر محکم بودن بست ها و پریزها و کلیدها انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا پرسنل برقکار مطالعه و رعایت دستورالعمل‌های شرکت سازنده در مورد کار با تجهیزات الکتریکی مربوط را انجام می دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا کارگران از کار با تجهیزات برقدار بدون حضور افراد مسئول و متخصص پرهیز می نمایند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا پرسنل برقکار از دستکش‌های لاستیکی و سایر وسایل و تجهیزات اختصاصی استفاده می نمایند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا سر راه جریان برق دستگاه ها فیوزهای مناسب و سالم قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا پرسنل برقکار بازرسی ابزار برقی پیش از استفاده را انجام می دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا پرسنل برقکار روغنکاری ماشین ها و ابزار و تمیز نگهداشتن تجهیزات برقی را به خوبی انجام می دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا پرسنل برقکار انطباق دوشاخه با پریزهای برقی را رعایت می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا کارگران گزارش فوری هر گونه مشکل در ارتباط با ابزار برقی، تجهیزات و سیم ها را به مسئول مربوطه ارائه می دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا کارگران از عدم پیچاندن و گره زدن سیم ها و عدم استفاده از سیم‌کشی موقت اطلاع دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا کارگران پرهیز از دسترسی غیرمجاز به فضاهایی که ممکن است دارای تجهیزات برقی باشند آگاهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا سوئیچ ها، پریزها، وسایل و جعبه های تقسیم دارای اندازه کافی هستند تا فضای کافی برای تماس رسانه های وصل شده به جعبه تقسیم وجود داشته باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا کارگران از عدم تماس دست مرطوب با بخش های برقدار آگاهی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'تجهیزات برقی نظیر جعبه های فرمان، جعبه های فرمان، تابلوهای برق، سوئیچ های آیا فضای کاری و دسترسی کافی در اطراف برقی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => '؟ رد در داخل ساختمان وجود دا لوهای فرمان یا مرکز کنترل موتور تاب، تمامی فضاهای کاری اطراف تجهیزات آیا روشنایی کافی برای؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا تجهیزات برقی از خطر برق دار شدن دور نگهداشته شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا بخش هایی از تجهیزات برقی که در عملیات کاری معمول قوس الکتریکی، شعله، جرقه یا فلزات ذوب شده ایجاد می‌کند ) به ان برق ( نسبت به تمامی مواد قابل احتراق و قابل اشتعال محصور، جدا یا ایزوله شده‌اند؟ استثنای جوشکار؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا بخش های برقدار تجهیزات برقی که با ولتاژ ۵۳ ولت یا بیشتر کار می‌کنند در برابر تماس های احتمالی حفاظ گذاری شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا نام شرکت سازنده یا نام تجاری آن، جریان، ۶۳ ولتاژ، توان، تجهیزات برقی به طور واضح روی آن مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا فیوزها و قطع کننده های مدار در محلی قرار داده شده‌اند که کارگران به خاطر کار آنها دچار سوختگی یا سایر صدمات ناشی از آنها نشوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا تمام مسیر شبکه اتصال به زمین، تجهیزات دائمی و پیوسته می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا بخش های فلزی بدون جریان و بدون حفاظ تجهیزات ثابتی که ممکن است برقدار شوند به سیستم اتصال به زمین (ارت) متصل شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا سیم ها سالم و فاقد ساییدگی هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'لهای فشاری، کالمپها ) گیره ها ( یا وسایل آیا رسانه های اتصال به زمین و قسمت‌های مربوطه توسط جوشکاری اگزوترمیک، اتصا معادل آن اتصال داده شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا شاخک های اتصال به زمین وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا المپ های روشنایی قابل حمل به مواد عایق کننده و حفاظ مجهز شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا وسایل برقی گرم شونده دور از مواد قابل احتراق نگهداشته می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'یا تمامی تابلوها و حصارها محکم بسته شده‌اند؟ آ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا محل قرار گرفتن تابلوهای برق در کارگاه مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا سیم ها از داخل لوله عایق عبور داده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا سر راه جریان برق دستگاه ها فیوزهای ایمنی مناسب و سالم قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا تابلوهای برق سالمند و در محفظه ق فل دار قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا نکات ایمنی در مورد چراغ های گردان و شب گرد رعایت می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا کلیه دستگاه های برقی با بدنه فلزی دارای سیم ارت (اتصال به زمین) هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا مقاومت چاه ارت به‌طور مرتب مورد ارزیابی قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا فاصله مجاز بین دستگاه ه ای برقی و تابلوهای برق رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'آیا موتور دیزل ژنراتور قفل دارد و کلید آن فقط دست مسئول برق کارگاه و یا متصدی آن است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا اتاق دیزل ژنراتور قفل دارد و کلید آن فقط دست مسئول برق کارگاه و یا متصدی آن است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'آیا کپسول اطفای حریق د ر اتاق موتور دیزل وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'آیا هنگام تعمیرات دستگاه های برقی فیوزهای تابلوهای برق مربوط به آن دستگاه برداشته می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'آیا در مکان های مرطوب و خیس کار برقی صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'آیا هنگام تعمیرات دستگاه های زیر پایی عایق افراد وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'آیا در موقع سیم‌کشی و یا کار با مدار الکتریکی از نردبان های فلزی استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'آیا توصیه های ایمنی و علائم هشداردهنده ایمنی در جلوی تابلوی برق نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'آیا کارکنانی که با برق سروکار دارند از کفش های لاستیکی که عایق الکتریسیته می‌باشند، می پوشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'آیا جهت تغذیه برق دس تگاه های سیار نظیر دستگاه های جوشکاری مجهز به سیم ارت است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'آیا از تعمیر این دستگاه های برق دار توسط افراد غیر مسئول جلوگیری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'آیا تجهیزات و وسایل الکتریکی مرتبا توسط مسئولین ایمنی بازدید می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'دانند؟ گرفتگی را افراد برقکار می آیا آموزش‌های کمک های اولیه به هنگام برق؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'آیا مسئول ایمنی کارگاه کمک های اولیه در برابر برق گرفتگی را میداند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'آیا تمهیدات امداد و نجات به هنگام برق گرفتگی در کارگاه فراهم شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'آیا کارگران با خطر برق گرفتگی آشنایی دارند و آموزش‌های لازم را در این خصوص دیده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'آیا مسیر کابل‌های اصلی برق، طوری تعیین شده که در محل های عبور و مرور عمومی، راه‌پله ها، نردبان های فلزی و سکوهای کاری خصوصا داربست ها خطر ساز نباشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'آیا کابل‌های برقی که از زیر سطح زمین عبور می‌کند، در مقابل ضربات فیزیکی و نفوذ آب و یا رطوبت زمین حفاظت شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'آیا مسیر عبور کابل‌ها وسیم‌کشی ها طوری انتخاب شده‌اند که از آسیب و صدمه فیزیکی به پوشش عایق ها جلوگیری به عمل در صورت حرکت و تردد ماشین االت نباشد (؟ آید )؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'آیا از یک سیم‌کشی فقط در مورد طارحی شده استفاده می‌شود ) مثال فقط باید مطمئن بود که از سیم‌کشی که برای روشنایی استفاده می‌گردد برای برق رسانی ماشین‌آلات و یا لوازم با توان بالاتر استفاده نشود ( د هرگونه تغییر و یا تعویض در سیستم برقی جریان برق قطع می‌شود؟ آیا قبل از ایجا؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'آیا وسایل و ادوات برقی به کمک کابل برق متصل به آنها حمل می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'می‌شود؟ متر رعایت تا خطوط برق فشار قوی آیا حداقل فاصله ایمن کار بر روی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      74 => 
      array (
        'question' => 'ه از زیر زمین عبور داده شده‌اند توسط علائم، مشخص گردیده‌اند؟ های برق ک آیا مسیر کابل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      75 => 
      array (
        'question' => 'آیا نکات ایمنی در مورد چراغ های دوره گرد ) سیار ( به خوبی رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  7 => 
  array (
    'title' => 'ایمنی داربست و نردبان',
    'category' => 'کار در ارتفاع',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا برای نصب داربست مجوز اخذ شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا اشخاص با تجربه و ماهر مسئول برپایی داربست بوده اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا داربست ایراد در نصب دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا داربست دچار صدمه بعد از نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا داربست بندها از کمربند ایمنی و طناب نجات استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا اجزاء تشکیل دهنده داربست در شرایط مطمئن و ایمنی برای استفاده قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا از صفحات پایه داربست یا تخته های منفرد استفاده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا داربست تراز افقی و عمودی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا برای تراز شدن افقی و عمودی داربست به جای اشیا ء نامطمئن و ناپایدار مثل بلوک ها، آجرهای لق و غیره از جک های پیچی استفاده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا صفحات پایه و یا جک های پیچی اتصال محکمی با لوله های استاندارد و فریم ها دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا همه پایه های داربست به خوبی با مهار ها محکم شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => '۳۱ متر بالای سکوی کار نصب شده‌اند؟ و ۵.آیا نرده‌های حفاظتی در ارتفاع؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا لبه‌های پاخور حفاظتی قسمت پایین سکو نصب شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا بازرسی از داربست بعد از شرایط جوی نامناسب و حداقل هفته ای یک بار انجام می‌شود و نتایج بازرسی ها ثبت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا برای دسترسی و ورود و خروج از داربست، نردبان تهیه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا سطح کار با استفاده از الوار یا ورق های فلزی مشبک مناسب پوشانده و مهار شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا در سکوهای سطح کار، بین ریل های حفاظتی به خوبی الوار گذاری و تخته بندی شده و تخته ها مهار شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'سانتی متر جلوتر از تکیه گاه ها تا ۷ سانتی متر در جهت طولی روی هم افتادگی دارند و به اندازه آیا الوارها حداقل ۹۱ میلی متر محکم بسته شده است؟ انتهای الوار با سیم های گالوانیزه به ضخامت امتداد یافته اند . و؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا داربست برای تردد آسان وسایل نقلیه مزاحمت ایجاد کرده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا شرایط مخاطره آمیز به لحاظ نزدیکی به ساختمان در حال تخریب و یا ….. وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => '۲۲ متر ارتفاع به سازه چفت و بست شده است؟ ول و متر ط آیا داربست ها، حداقل هر؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا فاصله مجاز با خطوط برق رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا داربست متحرک مجهز به ترمز چرخ است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا از گاردریل یا عضو محافظت کننده داربست در طبقات کاری که بیش از ۵۲ متر ارتفاع دارند استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا محکم و قابل قبول سازه اصلی را به داربست متصل می‌کند؟ به صورت؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا یا باد بند عرضی در داربست از کف تا بالای داربست استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا مصالح دپو شده دارای حفاظ مناسب به منظور جلوگیری از سقوط ارتفاع است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'و چهار تخته رعایت می‌شود؟ و سه تخته و برای مصالح شخص برای آیا حداقل عرض طبقات؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'بسته به نوع کار و ظرفیت باربری داربست بین یا آیا ضخامت الوار و تخته های استفاده شده روی است؟ تا؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => '۱۳ متر کاهش یابد. ۸.۱ رهای سنگین باید به متر تجاوز کند و برای کا ۷.۲ در هر حال نباید از یا ی آیا فاصله آیا شرایط روبرو برای برای زمین های سخت برقرار است؟ و برای زمین های نرم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'برای زمین های سخت حداقل سطح زیر است؟ و برای زمین های نرم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'به گونه ای قرار گرفته اند تا بار را پخش نموده و همچنین و یا پایه های داربست آیا جابه جا نشوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا برای مهار باد از باد بند طولی در داربست از کف تا بالای داربست استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'برای داربست ها وجود دارد؟ و آیا علائم هشداردهنده ایمنی بر روی داربست نصب شده‌اند؟ و آیا از سیستم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا بعد از وقوع هر حادثه یا موردی که بر روی داربست اتفاق می افتد داربست مورد بازرسی مجدد قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا میزان بیرون زدگی تخته ها بین است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'درجه است؟ ) به استثناء بادبندها ( آیا زاویه کوپلینگ ) جفت شدن دو عضو ( با یکدیگر؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا اعضاء داربست آسیب دیدگی، پوسیدگی، زنگ زدگی و دیگر عواملی که بر روی پایداری آ نها تاثیر می گذارد هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا حفاظ‌های توری در صورت نیاز ذر بالای جایگاه و زیر آن نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا تعداد و نوع نردبان های سایت به شکل کاملاً مشخص در محلی ثبت گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا نردبان ها در محل های مناسبی بر روی زمین سفت قرار گرفته اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا نردبان ها به شکل ایمن مهار می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'درجه ( زاویه نردبان نسبت به سطح افق در مورد محل استقرار نردبان ها رعایت می‌گردد؟ ) به آیا شیب؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا طول نردبان ۶ متر بالاتر از سکوی کار در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا برای برق کاران فقط از نردبان چوبی که رنگ نشده باشد استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'مهار می‌شوند؟ ن از میانه نردبان م دادن و شکست آیا نردبان های بلند جهت جلوگیری از شک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا فواصل بین پله های نردبان با یکدیگر مساوی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا در هر زمان حداکثر یک نفر روی نردبان کار می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا اطراف محل استقرار نردبان عاری از گودال و چاله است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا پله و سکوی نردبان عاری از مواد لغزنده مانند روغن و گریس است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا اطراف محل استقرار نردبان عاری از مواد زائد است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا نردبان های تلسکوپی میزان هم پوشانی بخش های مختلف به اندازه کافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'آیا روش‌های بلند کردن ابزار و تجهیزات ایمن است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا پایه های نردبان دارای شرایط مناسب جهت جلوگیری از لغزش بر روی سطوح مختلف است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'خودداری گردد ( آیا تکیه گاه نردبان شی و یا مکان مناسبی است؟ ) از تکیه دادن آن به اجسام شکننده و لغزنده و….',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'آیا تمام تسمه ها، ریسمان ها و کابل‌های برق مورد استفاده از جنس مرغوب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'آیا نردبان در جایی نصب شده که بهترین محل دسترسی به کار است و شخص استفاده کننده برای رسیدن به جبهه کار مجبور به انجام اعمال خطرناک نیست؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  8 => 
  array (
    'title' => 'ایمنی بالابرها',
    'category' => 'بالابر',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا اپراتور تجربه و سابقه کافی برای کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا اپراتور نکات ایمنی و فنی دستگاه را به خوبی می داند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا دستگاه دارای شناسنامه ومشخصات سازنده آن از قبیل ) مدل، تیپ، شماره سریال، ظرفیت و… ( را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'کنترل پوشش و آببندی موتور ها در زمان بارندگی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'کنترل بسته بودن درب، قبل از استارت حرکت توسط اپراتور دستگاه .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا اپراتور از تجهیزا ت ایمنی استفاده می‌کند . ) کلاه، کفش، کمربند ایمنی (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا میکروسوییچ قسمت‌های مختلف دستگاه به موقع و مناسب عمل می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا کپسول اطفا ء حریق مناسب در بالابر وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا درب بالا و پایین ریل درها و وزنه درهای آسانسور وضعیت مناسبی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا حفاظ با پوشش مناسب مسقف جهت ورود افراد به محوطه وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا در زمان قطع برق به طور ناگهانی دستگاه به سیستم برق اضطراری وصل است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا سیستم ارت دستگاه برقرار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا گریسکاری و روانکاری قسمت‌های مورد نیاز انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا اتصالات شاسی و ضربه گیرهای زیر شاسی عملکرد مناسب و سالم دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا آچارکشی پیچ‌های ) راک، سکشن، مهاری ها ( هر هفته انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا سطح مقطع سیم کابل ارتفاعی با آمپر دستگاه تناسب دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا مهاری کابل‌ها وضعیت مناسب و با فاصله هر ۸۱ متر نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا تابلوهای برق دستگاه پوشش مناسب دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا کابل ارتفاعی زدگی، فرسودگی، شکستگی ندارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا سیم بکسل محافظ کابل ارتفاعی نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'کنترل اتصال کابل ارتفاعی با سیم بکسل محافظ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا گیربکس موتورهای بالابر از لحاظ روغن هیدرولیک و وضعیت دنده‌ها مناسب هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کنترل چرخ دنده‌های الکتروموتور با راک سکشن ها به لحاظ هماهنگ بودن .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'کنترل سکشن ها از لحاظ راک‌ها و پیچ و مهره های مونتاژ .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'کنترل رولیک‌ها وغلطک‌ها به لحاظ روانکاری و تنظیم .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => '۸۲ متر ( ۳ متر و بتن بر هر ۵.۴ کنترل فاصله مهاری سکشن ها با سازه ) نفر بر هر؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'کنترل پارشوت و روانکاری و تمیزکاری آن در هر شیفت کاری در بالابرهای بتن بر .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'کنترل لنت ترمز و دیسک ترمز .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'کنترل مدار فرمان و مدار قدرت در تابلو برق دستگاه .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا بالایی اتاق آسانسور و حفاظ، پوشش تابلو برق بالای اتاق آسانسور .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'کنترل محل دستیابی مناسب جهت ورود و خروج نفرات از آسانسور ) قسمت ورودی و خروجی بالا و پایین آسانسور (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'کنترل موارد ایمنی محیطی کار با دستگاه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'کنترل چرخ دنده‌های اصلی درگیر با راک به لحاظ سایش و خوردگی .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا شاقول بودن سکشن ها بعد از نصب سکشن جدید کنترل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'چنانچه درب ورودی به آسانسور لوالیی می‌باشد می باید درب به طرف داخل باز شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا کلید اصلی قطع کلی مدار برقرار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'ورود افراد ذیصالح به محل استقرار اپراتور اکیدا ممنوع است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا کلید اصلی قطع کلی مدار برقرار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا قطع کن اضطراری داخل آسانسور فعال است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا نفرات در حد ظرفیت آسانسور می‌باشد ) ۲۴ نفر(؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'اتصال مهارهای اصلی ) سکشن ها ( با اتصال های جوشی ممنوع است .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'کنترل سیستم ایمنی توقف اضطراری پس از دمونتاژ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا فیوزهای مدار فرمان و قدرت آمپر مناسب را دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا کنترل فاز در تابلو برق عملکرد مناسب را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا کلید اضطراری دستی جهت توقف دستگاه در صورت عمل نکردن سیستم های قطع کن فرعی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا پیچ و مهره های سکشن از نظر آلیاژ مناسب هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'به صورت صحیح ) پیچ از پایین و مهره از بالا ( کنترل پیچ و مهره ها در زمان نصب سکشن؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'کنترل، مهار سکشن آخر با قالب در آسانسور بتن بر .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا دستگاه به لحاظ عملیاتی گواهی سالمت اخذ کرده و دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'مکانیزم عملیاتی: آیا زنجیرها، چرخ‌دنده‌ها و بلبرینگ‌ها از نظر عملکرد صحیح، تنظیم و تولید صدای غیرعادی بررسی شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'سیستم هوا یا هیدرولیک: آیا نشتی هوا یا روغن، مخازن هوا و روغن، شیرها، پمپ‌ها، شیلنگ‌ها و لوله‌ها بررسی شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'دهانه قالب: آیا قالب از نظر تغییر شکل، بازشدگی بیش از حد دهانه، خمیدگی و چرخش آزاد بررسی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'ضامن ایمنی قالب: آیا ضامن از نظر بسته‌شدن کامل دهانه قالب، تغییر شکل و آسیب‌دیدگی بررسی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'زنجیر باربرداری: آیا زنجیر از نظر کشیدگی، خوردگی، بریدگی، تغییر شکل و هرگونه آسیب‌دیدگی بررسی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'تسمه مصنوعی: آیا تسمه از نظر سوختگی، بریدگی، تغییر شکل، سائیدگی، گره‌خوردگی و آسیب اتصالات انتهایی بررسی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'سیم‌بکسل: آیا سیم از نظر شکستگی، خمیدگی، خوردگی و سائیدگی بررسی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'سیستم پیچش: آیا عملکرد سیستم پیچش اسلینگ‌ها و سایر قطعات صحیح است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'کابل‌های برق حلقه‌ای آویزان: آیا جمع‌شدن یکنواخت کابل‌ها و نبود اتصالی و خوردگی بررسی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  9 => 
  array (
    'title' => 'ایمنی در عملیات بلاستیک',
    'category' => 'سندبلاست',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا محدوده بلاستینگ کاملاً محصور و عالمت گذاری شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا روشی جهت جلوگیری از ورود افراد متفرقه به محل کار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا مصالح بلاست در محل مناسب و دور از سایر مواد نگهداری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا جهت پرسنل درگیر کار سیستم تهویه مناسب در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا جهت پرسنل درگیر کار وسایل حفاظت فردی کامل در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا افرادی که مواد زائد بلاست را جمع‌آوری می‌کنند دارای وسایل حفاظت فردی مناسب هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا مواد زائد بلاست طبق اصول مواد خطرناک جمع‌آوری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا اتصالات و قطعات فلزی تجهیزات بلاست اتصال زمین شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا کپی برگه اطلاعات ایمنی مواد شیمیایی در دسترس است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا رنگ و مواد قابل اشتعال در ظروف درب‌دار نگهداری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا تعداد کافی خاموش‌کننده مناسب در محل وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا روش مناسب نگهداری از سیستم تهویه و هوارسان و وسایل حفاظت فردی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا افراد سند بلاست کار از ماسک متصل به سیستم اکسیژن‌رسانی استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا به‌جای سیلیس در عملیات بلاستینگ از مواد دیگری که آلودگی کمتری دارد ) نظیر مس باره ( استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا عملیات بلاستینگ در محیط روباز انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا محل انتخاب بلاستیک در دورترین نقطه کارگاه بدون اینکه سایر مناطق عملیاتی را آلوده کند قرار گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا محیط بلاستینگ از سیستم تهویه مناسب و استانداردی برخوردار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا پرسنل سند بلاست کار از خطرات محیط کار خود مطلع و آگاه هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا مسئول ایمنی سایت ارزیابی ریسک عملیات بلاستیک را انجام داده و آموزش‌های لازم را به پرسنل بلاست کار داده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  10 => 
  array (
    'title' => 'ایمنی جرثقیل',
    'category' => 'جرثقیل',
    'description' => 'چک‌لیست واردشده از فایل‌های PDF مرحله اول HSE.',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'وضعیت نصب قطعات روی بدنه موتور، دیزل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'روغن موتور / گریس کاری موتور، دیزل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'تمیز بودن صافی / فیلترها موتور، دیزل ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'گریس کاری موتور ٬ دیزل ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'صدای غیر عادی موتور، دیزل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'ارتعاش غیر عادی موتور، دیزل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'وضعیت نصب قطعات روی بدنه سیستم انتقال قدرت؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'روغن گیربکس سیستم انتقال قدرت؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'گریس کاری سیستم انتقال قدرت؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'ترک در شیلنگ شیرهای هیدرولیک و پنوماتیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'برگشت نامناسب قرقره به حالت طبیعی شیرهای هیدرولیک و پنوماتیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'نشتی در قرقره ها واتصالات شیرهای هیدرولیک و پنوماتیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'گیر کردن قرقره شیرهای هیدرولیک و پنوماتیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'نقص شیر ایمنی شیرهای هیدرولیک و پنوماتیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'وضعیت فشار شیر ایمنی شیرهای هیدرولیک و پنوماتیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'اختالف ناشی از نشتی جریان؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'نشتی در اتصالات جوش؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'تو رفتگی در میله سیلندر؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'سیلندرهای هیدرولیک و پنوماتیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'شکستگی در میله سیلندر؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'ابعاد میله سیلندر؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'تو رفتگی قاب ) بسته (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'تغییر شکل یا شل بودن میله های چشمی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'تغییر شکل یا شل بودن اتصالات؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'میزان سوخت مصرفی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آب رادیاتور / آب باطری؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'وضعیت ظاهری بدنه و کابین؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => '( بدنه دستگاه )؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'گریس کاری و روغن کاری قطعات محرک و متحرک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'وضعیت نصب اجزاء نیوماتیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'سیستم روشنائی و المپ ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'وضعیت برف پاک کن؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'بدنه دستگاه ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => '۰۱ سالمت بوق و آژیر؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => '( ادامه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'وضعیت شیشه ها و آینه ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => '۲۱ سالمت لاستیک ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'میزان باد چرخ ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'خوردگی و ترک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'تغییر شکل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'میزان روغن هیدرولیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'وضعیت قطعات نصب شده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'مخزن هیدرولیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'نشتی از قطعات و اتصالات؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'نشتی از مخزن؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'نوع روغن هیدرولیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'تمیز کاری صافی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'وضعیت تابلو؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'وضعیت شیلنگ ها و اتصالات هیدرولیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'عملکرد ترمزها ) عدم لغزش (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => '( سیستم چرخش؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'شل بودن پیچ و پرچ ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'فیلتر سیستم هیدرولیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'وضعیت قطعات محرک و متحرک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'ارتعاش؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'نشتی از اتصالات؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'سایش بدنه بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'دفرمگی بدنه بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => ') سیستم بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'ترک بدنه بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'پین های نگهدارنده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'باز و بسته شدن بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'ضامن های نگهدارنده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'باز و بسته شدن سیلندرها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'نشتی از شیلنگ ها و نشت (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'سایش رولرهای روی بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'روان بودن رولرهای روی بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'پین ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'محورها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'باز و بسته شدن جک ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'اتصالات و شیلنگ های ارتباطی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'دفرمگی صفحات شناور؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'سایش صفحات شناور جک های تعادلی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'ترک در صفحات شناور؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      74 => 
      array (
        'question' => 'دفرمگی بدنه جک ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      75 => 
      array (
        'question' => 'سایش بدنه جک ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      76 => 
      array (
        'question' => 'ترک در بدنه جک ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      77 => 
      array (
        'question' => 'دفرمگی پوسته تلسکوپ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      78 => 
      array (
        'question' => 'سایش پوسته تلسکوپ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      79 => 
      array (
        'question' => '( جک های تعادلی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      80 => 
      array (
        'question' => 'ترک در پوسته تلسکوپ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      81 => 
      array (
        'question' => 'نشتی اتصالات / شیلنگها / نشت بند ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      82 => 
      array (
        'question' => 'روانکاری؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      83 => 
      array (
        'question' => 'عدم بازگشت به حالت اولیه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      84 => 
      array (
        'question' => 'کفشک زیر جک ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      85 => 
      array (
        'question' => 'قفل وضعیت؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      86 => 
      array (
        'question' => 'قطر طناب سیمی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      87 => 
      array (
        'question' => 'وضعیت دفرمه شدن؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      88 => 
      array (
        'question' => 'وضعیت شکستگی ) طناب سیمی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      89 => 
      array (
        'question' => 'وضعیت خوردگی (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      90 => 
      array (
        'question' => 'پیچش؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      91 => 
      array (
        'question' => 'اتصال انتهای طناب سیمی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      92 => 
      array (
        'question' => 'خمیدگی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      93 => 
      array (
        'question' => 'لهیدگی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      94 => 
      array (
        'question' => '( طناب سیمی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      95 => 
      array (
        'question' => 'بریدگی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      96 => 
      array (
        'question' => 'وضعیت روانکاری؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      97 => 
      array (
        'question' => 'عبور طناب از قرقره ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      98 => 
      array (
        'question' => 'چرخش قالب حول محور عمودی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      99 => 
      array (
        'question' => 'وضعیت قالب از نظر ترک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      100 => 
      array (
        'question' => 'وضعیت قالب از نظر دفرمه شدن؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      101 => 
      array (
        'question' => 'سایش قالب؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      102 => 
      array (
        'question' => 'قالب و قرقره ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      103 => 
      array (
        'question' => 'وضعیت روغن کاری قرقره ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      104 => 
      array (
        'question' => 'بد عمل کردن و خرابی زباله؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      105 => 
      array (
        'question' => 'وضعیت قطر قرقره ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      106 => 
      array (
        'question' => 'وضعیت میله های محافظ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      107 => 
      array (
        'question' => 'وضعیت پین ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      108 => 
      array (
        'question' => 'محور؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      109 => 
      array (
        'question' => 'روانکاری؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      110 => 
      array (
        'question' => 'ترک در قرقره؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      111 => 
      array (
        'question' => 'فرورفتگی در قرقره؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      112 => 
      array (
        'question' => 'قالب و قرقره؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      113 => 
      array (
        'question' => 'سایش قرقره؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      114 => 
      array (
        'question' => 'تغییر شکل قرقره؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      115 => 
      array (
        'question' => 'روانکاری قرقره؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      116 => 
      array (
        'question' => 'وضعیت نصب پمپ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      117 => 
      array (
        'question' => 'ارتعاش غیر عادی پمپ هیدرولیک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      118 => 
      array (
        'question' => 'افت فشار؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      119 => 
      array (
        'question' => 'سوئیچ های قطع کن خودکار؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      120 => 
      array (
        'question' => 'سوئیچ های دستی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      121 => 
      array (
        'question' => 'گیج های جریان و فشار روغن سیستم های ایمنی کنترلی و برقی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      122 => 
      array (
        'question' => 'اهرام ها و پدال های کنترلی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      123 => 
      array (
        'question' => 'چراغ های چشمک زن دستگاه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      124 => 
      array (
        'question' => 'سیستم روشنائی دستگاه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      125 => 
      array (
        'question' => 'روشنائی روی بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      126 => 
      array (
        'question' => 'برف پاک کن روی کابین؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      127 => 
      array (
        'question' => 'سیستم های ایمنی کنترلی و برقی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      128 => 
      array (
        'question' => 'شیشه های روی کابین؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      129 => 
      array (
        'question' => 'آینه های روی کابین؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      130 => 
      array (
        'question' => 'آژیر روی کابین؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      131 => 
      array (
        'question' => 'گویه سنج بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      132 => 
      array (
        'question' => 'هم راستایی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      133 => 
      array (
        'question' => 'اتصالات؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      134 => 
      array (
        'question' => 'شبکه ها بوم خشک افزایشی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      135 => 
      array (
        'question' => 'انتهای اتصالات؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      136 => 
      array (
        'question' => 'لوازم یدکی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      137 => 
      array (
        'question' => 'قرقره ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      138 => 
      array (
        'question' => 'نگهدارنده سیم بکسل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      139 => 
      array (
        'question' => 'ساختار بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      140 => 
      array (
        'question' => 'نگهدارنده اصلی و نگهدارنده سیم بکسل ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      141 => 
      array (
        'question' => 'بازوی کمکی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      142 => 
      array (
        'question' => 'ساختار بازو؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      143 => 
      array (
        'question' => '۲ سالم بودن شکل ظاهری چارت جرثقیل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      144 => 
      array (
        'question' => 'با دوام بودن؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      145 => 
      array (
        'question' => 'جدول بار و تجهیزات ایمنی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      146 => 
      array (
        'question' => 'تمیز و خوانا بودن؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      147 => 
      array (
        'question' => 'در معرض دید راننده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      148 => 
      array (
        'question' => 'نشانگر زاویه بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      149 => 
      array (
        'question' => 'نشانگر زاویه طول؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      150 => 
      array (
        'question' => 'نشانگر چرخش درام اصلی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      151 => 
      array (
        'question' => 'نشانگر چرخش درام کمکی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      152 => 
      array (
        'question' => 'نشانگر وضعیت بار؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      153 => 
      array (
        'question' => 'نشانگر شعاع عملیاتی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      154 => 
      array (
        'question' => 'نشانگر تراز بودن دستگاه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      155 => 
      array (
        'question' => 'قطع کن الکتریکی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      156 => 
      array (
        'question' => 'آژیر قطع کن الکتریکی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      157 => 
      array (
        'question' => 'وضعیت عملکرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      158 => 
      array (
        'question' => 'سیستم اگزوز ) حفاظ و عایق بندی ( سیستم قدرت؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      159 => 
      array (
        'question' => 'تسمه ها و شیلنگ ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      160 => 
      array (
        'question' => 'حفاظ ها و پوشش‌های اجزاء گردننده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      161 => 
      array (
        'question' => 'وضعیت ارزیابی موارد بررسی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      162 => 
      array (
        'question' => 'آیا جرثقیل دارای لود چارت مخصوص بار می‌باشد وقبل از شروع به‌کار٬ دستور کار با جرثقیل ارائه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      163 => 
      array (
        'question' => 'آیا اپراتور دارای گواهینامه ویژه و تجربه کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      164 => 
      array (
        'question' => 'آیا اپراتور توانایی و تجربه استفاده از لود چارت را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      165 => 
      array (
        'question' => 'آیا در بدنه جرثقیل اشکال آشکاری مشاهده می‌شود )در صورت مثبت بودن توضیح دهید (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      166 => 
      array (
        'question' => 'آیا داخل کابین فاقد اشیاء و ابزار اضافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      167 => 
      array (
        'question' => 'کنترل کابین درعدم برخورد به هنگام چرخش؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      168 => 
      array (
        'question' => 'آیا اهرم های کنترلی در شرایط سالمت کامل و دارای مشخصه جهت حرکت هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      169 => 
      array (
        'question' => 'آیا کابین و پله ها عاری از آلودگی به روغن می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      170 => 
      array (
        'question' => 'بوم )لاستیک های نگهدارنده ٬گریسکاری ٬ سایش ٬ دفرمرگی ٬ ترک و خوردگی ( . کنترل وضعیت بدنه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      171 => 
      array (
        'question' => 'کنترل دقت و کالیبراسیون زاویه سنج روی بوم و روی صفحه مانیتور داخل کابین .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      172 => 
      array (
        'question' => 'کنترل دقت و کالیبراسیون زاویه سنج روی بوم و روی صفحه مانتیتور داخل کابین .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      173 => 
      array (
        'question' => 'کنترل قرقره ها و رولرها ) دفرمگی ٬ عدم سایش ٬ گریسکاری ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      174 => 
      array (
        'question' => 'کنترل سیم بکسل درام و قالب ) گریسکاری ٬ عدم زدگی ٬ قطر مناسب ٬ عدم تاب و شکستگی ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      175 => 
      array (
        'question' => 'کنترل آالرم و قطع کن اضافه بار .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      176 => 
      array (
        'question' => '( . کنترل ترازهای افقی و عمودی روی جکهای تعادل )؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      177 => 
      array (
        'question' => 'کنترل جک های زیر دکل ) عدم نشتی ٬ ارتعاش ٬ صدای غیر عادی ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      178 => 
      array (
        'question' => 'کنترل جکهای درون بوم و تلسکوپ ها ) عدم نشتی ٬ ارتعاش ٬ صدای غیر طبیعی (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      179 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک ) عدم نشتی ٬ ارتعاش ٬ صدای غیرعادی ٬ فشار و قدرت کافی ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      180 => 
      array (
        'question' => 'کنترل لیورجک های تعادل به لحاظ عدم نشتی .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      181 => 
      array (
        'question' => 'آیا آژیرها و چراق ها سالم هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      182 => 
      array (
        'question' => 'آیا آخرین بازدید صحت کارکرد و ایمنی صورت گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      183 => 
      array (
        'question' => 'آیا جرثقیل متناسب با نوع کاربه لحاظ تناژ انتخاب و اطلاعات کامل در مورد عملکرد آن موجود است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      184 => 
      array (
        'question' => 'آیا زمین محلی که جرثقیل برای انجام کار در آنجا مستقر شده به لحاظ سفت بودن مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      185 => 
      array (
        'question' => 'آیا جرثقیل فضای کافی برای چرخش دارد ومانعی سر راهش قرار نگرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      186 => 
      array (
        'question' => 'آیاسازنده دستگاه اطلاعات کافی در خصوص موارد ایمنی و نکات فنی مربوطه را در اختیار گذاشته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      187 => 
      array (
        'question' => '۷۲ متر( قرار دارد؟ اندازه مناسب ) آیا فاصله بازوی جرثقیل از کابلهای فشار قوی به؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      188 => 
      array (
        'question' => 'آشنایی دارد و به اپراتوردرست عالمت می دهد؟ ( با تمام علائم به درستی آیا شخص عالمت دهنده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      189 => 
      array (
        'question' => 'آیا ساپورت کافی برای پایه های متعادل کننده ) ( وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      190 => 
      array (
        'question' => 'آیا جرثقیل در فاصله مناسب از محل حفاری شده مستقر گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      191 => 
      array (
        'question' => 'آیا هنگام حمل بار حداقل فاصله ایمن تا سطح زمین رعایت می‌شود؟ )خصوصا برای جرثقیل های کارگاهی (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      192 => 
      array (
        'question' => 'آیا به هنگام بلند کردن بار ٬ وضعیت بار از لحاظ تعادل ارزیابی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      193 => 
      array (
        'question' => 'آیا به هنگام بلند کردن بار تست اولیه ) ( انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      194 => 
      array (
        'question' => 'آیا به هنگام حمل بار افراد در زیر آن مشغول به‌کار یا در حال تردد می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      195 => 
      array (
        'question' => 'کنترل سیستم خنک کننده موتور ) آب رادیاتور ٬ شیلنگ ها ٬ عدم نشتی ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      196 => 
      array (
        'question' => 'کنترل سیستم سوخت رسانی ) باک و لوله های ارتباطی باک و انژکتور / کاربراتور ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      197 => 
      array (
        'question' => 'غیر عادی کنترل موتور٬ گیربکس ٬ دیفرانسیل ٬ کالچ ٬ از لحاظ عملکرد مناسب ٬ عدم نشتی ٬ ارتعاش ٬ صدای؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      198 => 
      array (
        'question' => 'سیستم روشنایی ) چراغ های جلو وعقب ٬ چراغ های بوم ٬ چراغ های خطر و چراغ های راهنما ( . کنترل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      199 => 
      array (
        'question' => 'کنترل صفحه نمایشگر کامپیوتری و کلیدهای کنترل .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      200 => 
      array (
        'question' => 'کنترل شیشه های طرفین ٬ سقف ٬ جلو و آینه ها و تیغه های برف پاک کن از لحاظ دید اپراتور و راننده .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      201 => 
      array (
        'question' => 'کنترل و بازدید از لاستیک ها و چرخ ها ) عدم فرسودگی و باد مناسب لاستیک ها ٬ عدم نشتی چرخ ها (.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      202 => 
      array (
        'question' => 'کنترل سیستم ترمز و قفل کن ترمز چرخ ها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      203 => 
      array (
        'question' => 'کنترل علائم هشداردهنده ) بوق ٬ آالرم دنده عقب ٬ آالرم اضافه بار ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      204 => 
      array (
        'question' => 'آیا روانکاری و گریسکاری در کلیه قسمت ها انجام شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      205 => 
      array (
        'question' => '( . کنترل سیستم درگیر کننده کامیون با جرثقیل )؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      206 => 
      array (
        'question' => 'هیدرولیک ٬ بلوک تقسیم هیدرولیک از لحاظ نشتی و قدرت لازم و صدای غیر عادی و ارتعاش . کنترل پمپ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      207 => 
      array (
        'question' => 'کنترل مفصل ها ٬ پینها ٬ اشپیل های پین ها و عدم لقی آنها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      208 => 
      array (
        'question' => 'کنترل تناژ دستگاه با سیم بکسل قالب و هم خوانی تناژ با قالب .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      209 => 
      array (
        'question' => 'کنترل سیستم قطع کن قالب .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      210 => 
      array (
        'question' => 'کنترل گیربکس گردان و دنده‌های گردان و روانکاری گردان .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      211 => 
      array (
        'question' => 'کنترل مخزن روغن هیدرولیک از لحاظ نشتی ٬ نشانگر میزان روغن مخزن و فیلتر آن .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      212 => 
      array (
        'question' => 'کنترل وضعیت بدنه بوم ٬ سایش ٬ دفرمگی ٬ ترک خوردگی و کفشک های بوم .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      213 => 
      array (
        'question' => 'کنترل رولرها و قرقره های روی بوم به لحاظ سایش و دفرمگی و روان بودن .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      214 => 
      array (
        'question' => 'کنترل وضعیت بازو و شفت سیستم جک ها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      215 => 
      array (
        'question' => 'کنترل عدم پیچش و حرکت روان سیم بکسل روی قرقره ها و کنترل میله های محافظ روی پالک قرقره ها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      216 => 
      array (
        'question' => 'کنترل چرخش قالب حول محور عمودی و عدم سایش قالب )قطر قالب ( و پین ها و ضامن ها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      217 => 
      array (
        'question' => 'کنترل سوییچ قطع کن خودکار و دستی و پالک های کنترل اهرم ها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      218 => 
      array (
        'question' => 'آیا بار در حال حمل شدن دچار حرکات ارتعاشی ٬ آونگی و شناوری است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      219 => 
      array (
        'question' => 'کنترل تعداد رشته های قطع شده در البه الی سیم بکسل ها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      220 => 
      array (
        'question' => 'کنترل قطر سیم بکسل با قطر قرقره ها و عدم دفرمگی و سایش و تاب آنها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      221 => 
      array (
        'question' => 'کنترل جک های تعادل به لحاظ پوسته و سیلندر و صدای غیر عادی و لرزش و عدم نشتی .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      222 => 
      array (
        'question' => 'کنترل گیربکس وینچ از لحاظ عدم نشتی و صدای غیرعادی .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      223 => 
      array (
        'question' => 'کنترل لنت های ترمز وینچ .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      224 => 
      array (
        'question' => 'کنترل وینچ ٬ درام وینچ و چینش مرتب سیم بکسل بر روی درام .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      225 => 
      array (
        'question' => 'زمین قرار گیرد ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      226 => 
      array (
        'question' => 'کنترل سیم بکسل درام ) اندازه سیم بکسل در زمان باز بودن کامل تلسکوپ ها صورتی که قالب روی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      227 => 
      array (
        'question' => 'کنترل روغن موتور ٬ گیربکس ٬ صدای غیر عادی و ارتعاش .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      228 => 
      array (
        'question' => 'کنترل سیستم نگهدارنده بار ) آکوموالتور ( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      229 => 
      array (
        'question' => 'کنترل سیستم نگهدارنده بار ) آکوموالتور( .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      230 => 
      array (
        'question' => 'کنترل تابلو برق جرثقیل از نظر پوشش کنتاکتور ٬ قطع کن ها ٬ سنسورها ٬ فیوزها .',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      231 => 
      array (
        'question' => 'آیا ریگر )راهنما ( دارای تجربه و آشنایی کافی کار با جرثقیل را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      232 => 
      array (
        'question' => 'آیا جک های تعادلی شرایط قابل قبولی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      233 => 
      array (
        'question' => 'آیا تراکم خاک زیر پایه های جک های تعادل انجام شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      234 => 
      array (
        'question' => 'دارای نشانگر زاویه است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      235 => 
      array (
        'question' => 'آیا بوم جرثقیل به لحاظ پین ها و مفصل ها و کفشک ها وضعیت مناسبی دارند و هم چنین بوم؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      236 => 
      array (
        'question' => 'آیا قالب بدون سایش و دارای ضامن ایمنی ) ( است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      237 => 
      array (
        'question' => 'آیا قالب حول محورش در هوک به سهولت چرخش دارد و هم چنین اتصالات آن سالم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      238 => 
      array (
        'question' => 'جرثقیل های سقفی قبل از شروع به‌کار ( کاملاً جدا است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      239 => 
      array (
        'question' => 'آیا سیم بکسل فعال ) سیم بکسل زنده خارج شده از نگهدارنده بعد از هوک ( با قسمت غیرفعال )مرده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      240 => 
      array (
        'question' => 'آیا زیر بنا و فونداسیون جرثقیل مناسب و محکم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      241 => 
      array (
        'question' => 'آیا راه های دسترسی به خوبی مشخص شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      242 => 
      array (
        'question' => 'آیا بخش های مختلف جرثقیل محکم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      243 => 
      array (
        'question' => 'آیا راهروها و حفاظ ها مناسب و کنترل شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      244 => 
      array (
        'question' => 'آیا پل و موتور حرکت مناسب وکنترل شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      245 => 
      array (
        'question' => 'آیا ترمز پل به خوبی کار می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      246 => 
      array (
        'question' => 'سیستم هیدرولیک کنترل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      247 => 
      array (
        'question' => 'بست ها و میله ها ی اتصال؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      248 => 
      array (
        'question' => 'انتهای مسیر کنترل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      249 => 
      array (
        'question' => 'گوه ها ٬ نگهدارنده ها و قفل کن ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      250 => 
      array (
        'question' => 'نظم و ترتیب کارگاه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      251 => 
      array (
        'question' => 'بازرسی از اجزای ماشینی جرثقیل تمیزی ریل ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      252 => 
      array (
        'question' => 'ترمز نگهدارنده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      253 => 
      array (
        'question' => 'ترمز کنترل بار؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      254 => 
      array (
        'question' => 'محکم بودن پوشش‌ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      255 => 
      array (
        'question' => 'قرقره های بالایی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      256 => 
      array (
        'question' => 'سیم بکسل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      257 => 
      array (
        'question' => '( قالب و شگل ها )؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      258 => 
      array (
        'question' => 'نشت مایعات ) روغن و آب (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      259 => 
      array (
        'question' => 'باتری ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      260 => 
      array (
        'question' => 'موتورهای الکتریکی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      261 => 
      array (
        'question' => 'تابلوهای برق؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      262 => 
      array (
        'question' => 'کابل‌های برق و کنترل هلالی شکل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      263 => 
      array (
        'question' => 'علائم و برچسب های هشداردهنده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      264 => 
      array (
        'question' => 'خطرات الکتریکی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      265 => 
      array (
        'question' => 'بازرسی از اتاق راننده نگهدارنده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      266 => 
      array (
        'question' => 'نظم و ترتیب؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      267 => 
      array (
        'question' => 'علائم هشداردهنده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      268 => 
      array (
        'question' => 'درب اتاق؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      269 => 
      array (
        'question' => 'کپسول های اطفای حریق؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      270 => 
      array (
        'question' => 'شناسایی کنترل ها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      271 => 
      array (
        'question' => 'محصور بودن سیستم های برقی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      272 => 
      array (
        'question' => 'سیم نگهدارنده صفحه کلید آویزان؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      273 => 
      array (
        'question' => 'شیشه ای قابل دید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      274 => 
      array (
        'question' => 'تجهیزات ایمنی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      275 => 
      array (
        'question' => 'چراغ خطرها؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      276 => 
      array (
        'question' => 'بازرسی عملکرد جرثقیل آالرم و آژیرهای جرثقیل سقفی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      277 => 
      array (
        'question' => 'برق رله تغذیه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      278 => 
      array (
        'question' => 'ریست دستی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      279 => 
      array (
        'question' => 'دکمه کنترل و توقف؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      280 => 
      array (
        'question' => 'دکمه های فشاری صفحه کلید آویزان؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      281 => 
      array (
        'question' => 'دکمه قطع کن حرکت بالا ) اصلی (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      282 => 
      array (
        'question' => 'دکمه قطع کن حرکت بالا ) کمکی (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      283 => 
      array (
        'question' => 'دکمه قطع کن حرکت پایین ) اصلی (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      284 => 
      array (
        'question' => 'دکمه قطع کن حرکت پایین ) کمکی (؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      285 => 
      array (
        'question' => 'کنترل پل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      286 => 
      array (
        'question' => 'ترمز پل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      287 => 
      array (
        'question' => 'قالب بزرگ؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      288 => 
      array (
        'question' => 'قالب کوچک؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      289 => 
      array (
        'question' => 'منطقه کاری؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      290 => 
      array (
        'question' => 'نگهدارنده های مسیر حرکت؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      291 => 
      array (
        'question' => 'رله های محدود کننده حرکت؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      292 => 
      array (
        'question' => 'رله های سقفی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      293 => 
      array (
        'question' => 'رله های سقفی پل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      294 => 
      array (
        'question' => 'دکمه انگشتی؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      295 => 
      array (
        'question' => 'اجزای کنترل؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      296 => 
      array (
        'question' => 'کلکتورهای؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  11 => 
  array (
    'title' => 'مینی لودر (بابکت)',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا اپراتور تجربه کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا اپراتور اطلاعات کافی از نکات ایمنی کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا اپراتور از محلی که دستگاه باید در آنجا کار کند، اطلاعات مناسب و کافی دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا داخل کابین فاقد اشیاء و ابزار اضافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا کپسول اطفای حریق موجود و دارای شارژ است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا اپراتور از وسایل حفاظت فردی استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا با توجه به نوع عملکرد دستگاه (غلطک، لیفتراک، بابکت، بیل، پیکور) با نوع کار تناسب دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا صندلی اپراتور به لحاظ ارگونومی و تسلط مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا شیشه‌ها و آینه‌ها برای دید محیطی اپراتور به لحاظ شفافیت مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'کنترل موتور و سیستم خنک‌کننده (آب رادیاتور، شبکه رادیاتور، عدم نشتی، شیلنگ‌های ارتباطی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک و هیدروموتور چرخ‌ها به لحاظ عدم نشتی، قدرت لازم و عدم صدای غیرعادی (AB NORMAL).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'کنترل علائم هشداردهنده (بوق، آلارم دنده عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'کنترل اهرم‌ها و لیورهای کنترل و مشخصه حرکتی لیورها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل شیلنگ‌ها و لوله‌های ارتباطی سیستم هیدرولیک و سیستم سوخت‌رسانی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل مخزن روغن هیدرولیک و نمایشگر روغن مخزن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کنترل لاستیک‌ها و چرخ‌ها و زنجیر چرخ‌ها (باد مناسب، عدم فرسایش و فرسودگی، عدم نشتی چرخ‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'کنترل جک‌های افقی و عمودی به لحاظ عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'کنترل باکت، بیل و پیکور، لیفتراک، غلطک و اتصالات آن‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'کنترل سیستم برقی (سیم‌کشی، دینام، استارت، باتری).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'کنترل گریس‌کاری و روانکاری کلیه قسمت‌هایی که نیاز دارند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'کنترل محل عملیات اجرایی دستگاه به لحاظ لوله آب و گاز و خطوط کابلی و هوایی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'کنترل محل عملیات اجرایی دستگاه به لحاظ لوله آب و گاز و خطوط کابلی و هوایی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کنترل ماشین‌آلات به لحاظ بازدید و بررسی کلی دستگاه در هر ماه (براساس چک‌لیست فنی-ایمنی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  12 => 
  array (
    'title' => 'لودر',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا راننده گواهینامه ویژه و تجربه و سابقه کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا شیشه‌ها و آینه‌ها برای دید محیطی اپراتور به لحاظ شفافیت و عدم ترک و شکستگی مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا راننده نکات ایمنی و فنی دستگاه را می‌داند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'کنترل کپسول اطفای حریق و شارژ مناسب کپسول.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا بازدید روزانه روغن (موتور، نمایشگر مخزن هیدرولیک) انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا راننده از وسایل حفاظت فردی استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'اپراتور الزاماً در توقف‌های موقت و دائم، دستگاه را در حالت قفل‌کن دستی و استقرار پاکت روی زمین قرار دهد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'در زمان پایان کار روزانه، علاوه بر به‌کارگیری دو مورد فوق از قفل‌کن کمرشکن استفاده نماید.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا میدان دید راننده با توجه به ارتفاع دستگاه نسبت به جوانب دستگاه کافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'کنترل و ممانعت از عمل ناایمن بارگیری و حمل وسایل و اشیاء دیگر به وسیله پاکت و ناخن پاکت.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'کنترل و مراقبت به جهت جلوگیری از سوار شدن افراد دیگر در کابین راننده، مخصوصاً در پاکت.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا قبل از شروع گودبرداری محل عبور لوله‌های گاز، آب و کابل برق و تلفن بررسی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا اپراتور در زمان خاکبرداری، محل نرم و سستی خاک را جهت استقرار دستگاه و عدم سقوط آن مورد بررسی قرار داده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل نظافت و شست‌وشوی دستگاه از محل اتصالات.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل نظافت و شست‌وشوی دستگاه برای بازدیدهای روزانه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده موتور (شبکه رادیاتور، سطح آب رادیاتور، شیلنگ‌های ارتباطی، عدم نشتی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'کنترل موتور و دیفرانسیل (عدم نشتی، ارتعاش، قدرت لازم، صدای غیرعادی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'کنترل صدای ناهنجار و غیرعادی از کلیه قسمت‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'کنترل قفل‌کن ترمز، ترمزها، لنت و کاسه چرخ و عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'کنترل آمپرها (آب، روغن، سوخت، برق) و تهویه، برف‌پاک‌کن و پدال‌های درون کابین.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'کنترل سیستم هیدرولیک (شیلنگ‌ها، لوله‌های ارتباطی، عدم فرسودگی، عدم نشتی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'کنترل سیستم برق (باتری، دینام، استارت، سیم‌کشی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کنترل لاستیک‌ها و چرخ‌ها (تنظیم باد، عدم سایش و فرسودگی، عدم نشتی چرخ‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا نوع کار با ساختار عملکرد دستگاه همخوانی دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'کنترل بلوک تقسیم روغن (عدم نشتی، ارتعاش، قدرت و فشار لازم، صدای غیرعادی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'کنترل روانکاری و گریس‌کاری کلیه قسمت‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'بازدید و کنترل قسمت‌های مختلف دستگاه به صورت روزانه توسط اپراتور دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'کنترل جک‌های کمرشکن (عدم نشتی، ارتعاش، صدای غیرعادی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'کنترل سیستم سوخت‌رسانی (عدم نشتی، لوله‌های ارتباطی، فیلتر، مخزن سوخت).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'کنترل ناخن‌های پاکت (عدم لقی، عدم سایش، اتصال پیچ و مهره‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک (عدم نشتی، ارتعاش، صدای غیرعادی، قدرت و فشار لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'کنترل دیفرانسیل (عدم نشتی، ارتعاش، صدای غیرعادی، قدرت لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'کنترل لیورهای پاکت (حرکات بالا و پایین) و لیورهای حرکت (حرکت جلو و عقب) و علامت مشخصه آن‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'کنترل زیربندی و خلاصی فرمان.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'کنترل جک‌های پاکت (افقی و عمودی) به لحاظ عدم نشتی و فرار روغن، پوسته و شفت.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'کنترل بازوها و جک‌ها (پین‌ها، اشپیل‌ها و مفصل‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  13 => 
  array (
    'title' => 'غلتک',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا اپراتور توانایی و تجربه کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا اپراتور از تجهیزات فردی استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا اپراتور از وضعیت فنی و نکات ایمنی دستگاه اطلاعات کافی دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'کنترل موتور (ارتعاش، عدم نشتی، صدای غیرعادی، قدرت لازم و مناسب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک (عدم نشتی، صدای غیرعادی، ارتعاش، قدرت لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'کنترل ویبره سبک و سنگین درام غلطک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده موتور و روغن (شبکه رادیاتور آب یا روغن، شیلنگ‌ها، فن رادیاتور، سطح آب و روغن).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'کنترل شیلنگ‌ها و لوله‌های ارتباطی سیستم هیدرولیک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'کنترل درام (بازوها، اتصالات، محافظ).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'کنترل سیستم روشنایی و برقی (باتری، دینام، استارت، چراغ‌های جلو و عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'کنترل آلارم (بوق، آلارم دنده عقب) و کنترل مخزن سوخت و آب (عدم پوسیدگی، لوله‌های ارتباطی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'کنترل آمپرها (سوخت، روغن، آب، برق).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'کنترل شاسی و کمرشکن اتصال محور جلو با وسط غلطک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل زنجیر و پوشش فلزی، تسمه و بدنه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل مفصل و پین و لرزه‌گیرها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کنترل گیربکس حرکت (عدم نشتی، صدای غیرعادی، ارتعاش، قدرت لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'کنترل سیستم سوخت‌رسان (عدم نشتی انژکتور و لوله‌های ارتباطی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'کنترل کابین (لیورها، شیشه‌ها، درب و دستگیره درب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'کنترل لاستیک‌ها و چرخ‌ها (عدم نشتی چرخ، وضعیت مطلوب لاستیک‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'کنترل ترمز چرخ‌ها (لنت و لوله‌های ارتباطی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  14 => 
  array (
    'title' => 'کامیون کمپرسی',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا راننده گواهینامه پایه یک دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا راننده اطلاعات کافی از نکات ایمنی کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'کنترل ترمز و قفل‌کن ترمز به لحاظ لنت، روغن ترمز، لوله‌های ارتباطی و کاسه چرخ.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'کنترل روغن و عدم نشتی روغن موتور و فیلترهای هوای روغن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده موتور (شیلنگ‌ها، شبکه رادیاتور، میزان سطح آب، ترموستات، فن رادیاتور).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'کنترل علائم هشداردهنده (بوق، آلارم دنده عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'کنترل نشانگرها و آمپرها (باد، روغن، گازوئیل، برق، دور موتور).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'کنترل موتور و گیربکس به لحاظ صدای غیرعادی قسمت‌های متحرک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'کنترل شیشه و آینه‌ها به لحاظ دید مناسب راننده (عدم ترک و شکستگی و عدم تمیزی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'کنترل سیستم روشنایی (چراغ‌ها، راهنما، چراغ روشنایی عقب، چراغ خطر عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'کنترل سیستم PTO (سیستم ارتباط‌دهنده موتور و گیربکس با سیستم کمپرسی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'کنترل اتصالات اتاق کمپرسی با شاسی به لحاظ عدم ترک و شکستگی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'کنترل لاستیک و چرخ‌ها به لحاظ وضعیت مطلوب لاستیک‌ها و باد مناسب و عدم نشتی چرخ‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل جک‌های سیستم تخلیه کمپرسی به لحاظ پوسته سیلندر جک و عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل مفصل، بوش‌ها، پین‌ها و استقرار صحیح اتاق کمپرسی روی شاسی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کنترل درب تخلیه کمپرسی به بیرون هنگام تخلیه و عدم لقی درب.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'کنترل شیلنگ‌ها و لوله‌های ارتباطی به لحاظ عدم فرسودگی و عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'کنترل کف اتاق کمپرسی به لحاظ پوسیدگی و سوراخ بودن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'کنترل وضعیت درب‌ها و بدنه به لحاظ لقی و پوسیدگی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'کنترل زیربندی و فرمان دستگاه به لحاظ عدم خلاصی، تعادل در حرکت.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا مقدار بار خاک و نخاله بارگیری‌شده به لحاظ ایمنی و ظرفیت مجاز کامیون بارگیری شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا مسیر تردد دستگاه دارای شیب مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا بازدیدهای روزانه دستگاه و سرویس‌های نگهداشت انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا راننده سرعت مجاز برای تردد را رعایت می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'کنترل سیستم برق (باتری، استارت، دینام، فیوزها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  15 => 
  array (
    'title' => 'تراک میکسر',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا اپراتور گواهینامه پایه یکم و تجربه کافی برای کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا تردد دستگاه با سرعت مجاز در محوطه کارگاه انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا در محل‌های شیب‌دار و گود، محل استقرار دستگاه جهت عمل بتن‌ریزی ایمن است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا بازدیدهای روزانه، هفتگی و ماهانه دستگاه انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا بعد از اتمام کار روزانه عمل شست‌وشوی دیگ انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا اپراتور از وسایل حفاظت فردی استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا پساب عمل شست‌وشوی دیگ میکسر در محل خاصی جمع می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'کنترل بدنه (گلگیرها، درب‌ها، پوشش موتور، سقف، ستون‌ها، دستگیره‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده موتور میکسر (عدم نشتی، شیلنگ ارتباطی، سالم بودن شبکه و درب رادیاتور، سطح آب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده موتور کامیون (عدم نشتی، شیلنگ ارتباطی، سالم بودن شبکه و درب رادیاتور، سطح آب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'کنترل موتور کامیون (عدم نشتی، صدای غیرعادی، ارتعاش، عملکرد قطعات متحرک، سطح روغن).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'در محل‌های شیبدار، به دلیل عدم ریزش بتن، باید مقدار بتن از حد مجاز اسمی دستگاه کمتر باشد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'کنترل سیستم روشنایی کامیون (چراغ‌های جلو، چراغ‌های خطر عقب، چراغ عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل زیربندی، فنرها، کمک‌فنرها (عدم نشتی، ترک یا شکستگی، اتصالات).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل صدای غیرعادی و ناهنجار به لحاظ عملکرد کلیه قسمت‌های دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کنترل گیربکس و دیفرانسیل (عدم نشتی، چرخ‌ها، ارتعاش، صدای غیرعادی، قدرت لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'کنترل گریس‌کاری و روانکاری کلیه قسمت‌ها (Lubrication).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'کنترل ترمز و قفل‌کن ترمز (لنت‌ها، کاسه چرخ، عدم نشتی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'کنترل لاستیک‌ها و چرخ‌ها (عدم نشتی چرخ‌ها، وضعیت مطلوب و باد مناسب لاستیک‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'کنترل شیشه‌ها و آینه‌ها (بالابرها، عدم ترک و شکستگی، تمیزی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'کنترل شاسی سیستم میکسر از محل اتصال‌ها با شاسی کامیون (عدم ترک یا شکستگی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'کنترل موتور میکسر (عدم نشتی، صدای غیرعادی، ارتعاش، عملکرد قطعات متحرک، سطح روغن).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کنترل شاسی موتور میکسر (ضربه‌گیرها، اتصالات جوشی و پیچ و مهره‌ای).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'کنترل بوق، آلارم دنده عقب، تیغه برف‌پاک‌کن، صندلی راننده و آفتاب‌گیر.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'کنترل آمپرها (روغن، آب، سوخت، دور موتور، فشار باد، برق).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'کنترل مخزن آب (عدم نشتی، پوسیدگی، دفرمگی، شبکه خنک‌کن روغن درون مخزن) و شیلنگ شست‌وشوی دیگ.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'کنترل تابلو میکسر (آمپرها، سوئیچ).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'کنترل قیف شوت (عدم دفرمگی، سایش، پوسیدگی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'کنترل دیگ میکسر (عدم پوسیدگی، ترک و سایش، دفرمگی، عدم ریزش شیره بتن).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا لیورهای چپ‌گرد و راست‌گرد سیستم میکسر به‌خوبی عمل می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا جک دستی شوت به‌خوبی عملکرد دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'کنترل رولیک‌های دیگ (عدم سایش، اتصالات، روان بودن در چرخش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک (عدم نشتی، ارتعاش، صدای غیرعادی، فشار و قدرت لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'کنترل هیدروموتور (عدم نشتی، ارتعاش، صدای غیرعادی، فشار و قدرت لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'کنترل پمپ چپ‌گرد و راست‌گرد میکسر (عدم نشتی، ارتعاش، صدای غیرعادی، فشار و قدرت لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'کنترل گیربکس میکسر (عدم نشتی، ارتعاش، صدای غیرعادی، فشار و قدرت لازم).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'کنترل مخزن روغن هیدرولیک (عدم نشتی شیلنگ‌ها و لوله‌های ارتباطی، دفرمگی، نمایشگر مقدار روغن).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده روغن هیدرولیک (فن رادیاتور، رادیاتور روغن، شیلنگ‌های ارتباطی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا دیگ میکسر در راستای رولیک‌ها و طوقه حرکت می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا پلیت‌های میکسر درون دیگ میکسر به‌خوبی عمل تخلیه بتن را انجام می‌دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'کنترل پلیت‌های میکسر (عدم سایش، دفرمگی، اتصالات جوشی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'کنترل پمپ انژکتور سوخت، موتور کامیون و موتور میکسر (لوله‌های ارتباطی، عملکرد صحیح پمپ).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'کنترل اپراتور برای خنک کردن بتن در مناطق گرمسیری (استفاده از گونی چتایی و مهار کردن گونی چتایی با سیم مفتول تجاری و احتمال پیچیدن سیم و گونی به دور گیربکس میکسر).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  16 => 
  array (
    'title' => 'پمپ بتن',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا اپراتور گواهینامه پایه یکم و سابقه کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا اپراتور از وسایل ایمنی حفاظت فردی استفاده می‌کند و نکات ایمنی دستگاه را به‌خوبی می‌داند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا فاصله بوم با کابل‌های فشار قوی و ضعیف قبل از شروع به کار بررسی شده است (فاصله ۵ متر)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا اپراتور، محیط ایزوله برای استقرار جک‌های تعادل در نظر گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا مسیر حرکت بتن در لوله‌ها قبل از شروع به کار دستگاه، با دوغاب آب بتن چک شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا دانه‌بندی شن و ماسه و درجه عیار سیمان و غلظت بتن برای بتن‌ریزی مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا وان تغذیه بتن دارای شبکه فلزی محافظ است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا سایبان مناسب جهت عدم تابش نور مستقیم آفتاب و جلوگیری از دید برای اپراتور فراهم شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا سطح روی دستگاه، سیستم پمپ، عاری از آلودگی روغن و اشیاء اضافه است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا شست‌وشوی وان تغذیه و مسیر لوله‌ها توسط آب و توپ اسفنجی بعد از پایان کار انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'کنترل لوله‌های تزریق بتن (عدم سایش، ضخامت و کیفیت مناسب، ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا کنترل پانل (وایرلس) برای هدایت عملیات تزریق بتن، عمل هدایت را به‌خوبی انجام می‌دهد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'اپراتور الزاماً در زمان عملیات بتن‌ریزی به دستورات نفر اجرایی توجه کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل بست‌های لوله‌ها و زانوها (کیفیت و سایز مناسب، صحیح چفت شدن).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل زانویی لوله‌ها و زانوها (کیفیت و سایز مناسب، صحیح چفت شدن).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کنترل آب حوضچه جک‌های تزریق، جهت خنک کردن شفت و سیلندر تزریق.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'کنترل سیلندر و شفت جک‌های تزریق به لحاظ خش و انحنای شفت جک و عدم نشتی روغن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک (عدم نشتی، فشار لازم، صدای غیرعادی و ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'کنترل سه‌راهی، تی‌ری، شل‌تی‌ری، هم‌زن و وان به لحاظ عدم سایش و ریزش بتن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'کنترل گیربکس گردان و دنده‌ها و روانکاری سکوی گردان.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'کنترل گریس‌کاری و روانکاری قسمت‌های متحرک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'کنترل پین و مفصل‌ها و اشپیل‌های پین در تمامی قسمت‌های متحرک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کنترل شیلنگ‌ها و لوله‌های ارتباطی به لحاظ اتصالات سرشیلنگ و پوسیدگی و عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'کنترل پیستون‌ها تزریق (عدم سایش و نشتی، کیفیت مناسب، اتصال).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'کنترل سیم‌کشی برق هیدرولیک کلیه قسمت‌های دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'کنترل تانک روغن هیدرولیک، تانک سوخت، فیلترها و نمایشگر آن‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'کنترل موتور، گیربکس، دیفرانسیل، زیربندی فرمان (عملکرد مناسب، عدم نشتی، صدای غیرعادی، ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'کنترل شیشه‌ها و آینه‌ها برای دید مناسب محیط.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'کنترل شاسی سیستم دستگاه پمپ با شاسی کامیون از محل‌های اتصال.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'کنترل علائم هشداردهنده (بوق، آلارم دنده عقب، آمپرها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'کنترل سیستم روشنایی (چراغ خطر عقب، چراغ شست‌وشوی وان، چراغ‌های دکل، چراغ‌های جلو).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'کنترل شست‌وشوی وان هم‌زن و شیلنگ شست‌وشوی فشار قوی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده موتور (عدم ریزش، عدم نشتی شیلنگ‌های مرتبط، سطح آب رادیاتور، شبکه رادیاتور).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'کنترل ترمز، قفل‌کن دستی ترمز.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'کنترل لاستیک‌ها و چرخ‌ها (باد مناسب، عدم سایش، عدم فرسودگی و عدم نشتی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'کنترل جک A دکل (عدم نشتی، فرار روغن، عدم ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'کنترل جک B دکل (عدم نشتی، فرار روغن، عدم ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'کنترل جک C دکل (عدم نشتی، فرار روغن، عدم ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'کنترل جک D دکل (عدم نشتی، فرار روغن، عدم ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'کنترل جک زیر دکل (عدم نشتی، فرار روغن، عدم ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'کنترل هیدروموتور پمپ هیدرولیک (عدم نشتی، صدای غیرعادی، ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'کنترل میکروسوئیچ‌ها و سنسورهای کنترل فرمان دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'کنترل بلوک تقسیم هیدرولیک (عدم نشتی، صدای غیرعادی، ارتعاش).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'کنترل پایه‌ها و تراکم خاک برای استقرار جک‌های تعادل.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'کنترل تراز افقی و عمودی جک‌های تعادل.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'کنترل جک‌های ساطوری عوض کردن پیستون‌ها (شفت، سیلندر، پکینگ‌ها) از نظر عدم نشتی و عدم ارتعاش.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'کنترل گیربکس هم‌زن وان (گردگیرها، عدم نشتی، شفت گیربکس هم‌زن، تیغه‌های میله هم‌زن).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'کنترل تابلو برق (پوشش تابلو، کلیدها، کنتاکتورها و سنسورها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'کنترل لیورهای جک‌های تعادل.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا سیستم پمپ بر روی شاسی کامیون به‌طور صحیح مونتاژ شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'کنترل سه‌راهی، تی‌ری، شل‌تی‌ری، هم‌زن وان به لحاظ عدم سایش و ریزش مایع بتن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  17 => 
  array (
    'title' => 'تراکتور',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'کنترل موتور، گیربکس، دیفرانسیل‌ها به لحاظ عدم نشتی، ارتعاش و صدای غیرعادی (Abnormal).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'کنترل ترمز و قفل‌کن ترمز به لحاظ عملکرد و لوله‌های ارتباطی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک و پمپ فرمان به لحاظ عدم نشتی و صدای غیرعادی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'کنترل زیربندی و خلاصی فرمان و پدال‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'کنترل شاسی و مال‌بند به لحاظ اتصالات.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده موتور (شبکه رادیاتور آب، عدم نشتی، شیلنگ‌های مرتبط).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'کنترل سیستم روشنایی (چراغ‌های جلو، راهنما، چراغ عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'کنترل سیستم علائم هشداردهنده (بوق، آلارم دنده عقب، آمپرها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'کنترل سیستم برق (سیم‌کشی، باتری، استارت، دینام).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'کنترل شیشه‌ها (در صورت داشتن اتاق) و آینه‌ها به لحاظ شفافیت، دید کافی و عدم ترک یا شکستگی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'کنترل لاستیک‌ها و چرخ‌ها به لحاظ وضعیت عدم فرسودگی، باد مناسب، عدم نشتی، پین‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'کنترل پمپ و سیستم هیدرولیک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'کنترل شیلنگ‌ها و لوله‌های ارتباطی سیستم هیدرولیک و سیستم سوخت‌رسان (عدم فرسودگی و عدم نشتی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل پاکت، جک پاکت به لحاظ عدم نشتی اتصالات.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل بدنه و پوشش فلزی موتور و صندلی به لحاظ ارگونومی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا راننده توانایی و تجربه کار با تراکتور را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا راننده در زمان یدک کشیدن (تانکر، کمپرسور و دیگر وسایل) نکات ایمنی را رعایت می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا راننده از تجهیزات فردی مناسب استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا راننده با سرعت مجاز در محوطه حرکت می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'کنترل و بازدید راننده از وضعیت فنی و ظاهری دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'کنترل روانکاری و گریس‌کاری کلیه قسمت‌ها و کنترل فیلترها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'کنترل سیستم خنک‌کن روغن هیدرولیک (شبکه روغن، عدم نشتی و لوله‌های ارتباطی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کنترل ضامن و نگهدارنده مال‌بند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'کنترل مخزن روغن هیدرولیک و مخزن سوخت به لحاظ عدم نشتی، نمایشگر و لوله‌های ارتباطی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  18 => 
  array (
    'title' => 'مینی‌بوس',
    'category' => 'خودرو و حمل‌ونقل',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا تردد دستگاه در محوطه کارگاه و در راه‌های بین‌جاده‌ای با سرعت مجاز انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا سطح روغن موتور به صورت بازدید روزانه انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'کنترل موتور (عدم نشتی، صدای غیرعادی، ارتعاش، قطعات متحرک موتور).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'کنترل گیربکس (عدم نشتی، صدای غیرعادی، ارتعاش، قطعات متحرک موتور).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'کنترل ترمزها و قفل‌کن ترمز (لنت‌ها، لوله‌های ارتباطی، سطح روغن ترمز، کاسه چرخ‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'بررسی و بازدید سیستم خنک‌کننده موتور (شبکه رادیاتور، پروانه شبکه، شیلنگ‌های ارتباطی، عدم نشتی، سطح آب رادیاتور).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'کنترل لاستیک‌ها (عدم فرسودگی، وضعیت مطلوب و باد مناسب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'کنترل شیشه جلو و عقب و طرفین، دستگیره‌ها، شیشه‌بالابرها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'کنترل و بازدید بدنه (درب‌ها، طاق بین پوشش درب موتور، سقف، ستون‌های چپ و راست، سپر جلو و عقب، قفل درب‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'بازدید تودوزی صندلی‌ها و فرش زیر پا، روی درب‌ها و داخل اتاق و سقف و کمربند ایمنی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'بازدید داشبورد و دسته راهنما و تیغه برف‌پاک‌کن و کلیدها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'بازدید و کنترل سیستم فرمان و جلوبندی، فنرها و کمک‌فنرها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'بررسی و بازدید سیستم برقی (باتری، استارت، دینام، سیم‌کشی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'بررسی و بازدید سیستم روشنایی (چراغ‌های جلو، چراغ‌های خطر، راهنمای چپ و راست).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل و بازدید سیستم هشداردهنده (بوق، آلارم دنده عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کنترل و بازدید آمپرها (سوخت، روغن، آب، باد، دور موتور، برق).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'بازدید روانکاری و گریس‌کاری و کلیه فیلترها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'بازدید شست‌وشوی بدنه و نظافت درون اتاق.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'بررسی و بازدید شاسی و اتصالات آن‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'بازدید جک و آچار چرخ و لاستیک زاپاس، مثلث شبرنگ، زنجیر چرخ و آچارآلات مورد نیاز.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  19 => 
  array (
    'title' => 'بیل مکانیکی',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا اپراتور دارای گواهینامه ویژه و تجربه کار با بیل مکانیکی را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا اپراتور اطلاعات کافی از نکات ایمنی کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا اپراتور اطلاعات مناسب از وضعیت محلی که دستگاه باید در آنجا کار کند را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا منطقه خاک‌برداری نواربندی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا اپراتور از وسایل حفاظت فردی مناسب استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا با کنترل و نظارت جهت به‌کارگیری دستگاه به‌عنوان جرثقیل برای بارگیری و یا تخلیه بار انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا در کابین کپسول اطفای حریق موجود و همچنین دارای شارژ مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'کنترل لاستیک‌ها و چرخ‌های دستگاه و وضعیت مناسبی دارند؟ (بیل مکانیکی از نوع چرخ لاستیکی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا داخل کابین فاقد اشیاء و ابزار اضافی است و صندلی به لحاظ ارگونومی مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا اهرم‌های کنترل در شرایط کاملاً مناسب و همچنین دارای مشخصه جهت برای عملکرد دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا اهرم‌های کنترل در شرایط کاملاً مناسب و همچنین دارای مشخصه جهت برای عملکرد دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'کنترل بوم و مفصل‌ها و پین‌ها و اشپیل پین‌ها به لحاظ لقی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا جک‌های زیر بوم و جک‌های A و B دکل وضعیت مناسبی دارند و همچنین فرار روغن و نشتی روغن ندارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل شاسی به لحاظ اتصالات و وضعیت بدنه دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا سیستم روشنایی (لامپ‌ها، بلوری، چراغ خطر، چراغ روی بوم) سالم و دارای نور مناسب هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا علائم هشداردهنده (بوق، آلارم حرکت به عقب، آمپرها) سالم هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا صفحه نمایشگر کامپیوتر وضعیت عملکرد دستگاه و کلیدها سالم هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا در سیستم گردان روانکاری و گریس‌کاری دنده‌های گردان انجام شده است و گیربکس گردان نشتی ندارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا شیلنگ‌ها و لوله‌های ارتباطی دارای اتصال مناسب و بدون نشتی هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا پاکت و ناخن‌ها و تیغه پاکت پارگی و شکستگی و لقی ندارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا پیکور و سیستم اتصال پیکور سالم و مناسب عمل می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا وضعیت تعویض فیلترها طبق برنامه زمان تعریف‌شده سازنده دستگاه انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا موتور، باتری، استارت، دینام عملکرد مناسب دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک، هیدروموتور، چرخ‌ها، پمپ حرکت، فشار و قدرت لازم را دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'کنترل زیربندی (کفشک‌ها، زنجیر، خورشیدی یا دنده اسپراکت، رولیک‌ها، چرخ‌ها، پین‌های ارتباطی زنجیر).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'کنترل تانک، فیلتر نمایشگر درجه روغن هیدرولیک به لحاظ رسوبات و بخارات تانک و مقدار روغن تانک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'کنترل تانک گازوئیل، فیلتر گازوئیل، لوله‌های ارتباطی گازوئیل با انژکتور.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'کنترل گریس‌کاری و روانکاری کلیه قسمت‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا فاصله عملکرد بوم با کابل‌های فشار قوی قبل از شروع به کار مورد بررسی قرار گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا محل تخریب به لحاظ لوله‌های آب، گاز و خطوط کابلی قبلاً مورد بررسی قرار گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا اپراتور حضور کارگران در محل تخریب را به لحاظ ایمنی در نظر دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا مونتاژ دستگاه به‌خوبی انجام شده و شرکت سازنده اطلاعات کافی در خصوص موارد ایمنی دستگاه را در اختیار گذاشته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا اپراتور در هنگام چرخش به چپ و راست به لحاظ برخورد با موانع و افراد را در نظر دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  20 => 
  array (
    'title' => 'بلدوزر',
    'category' => 'ماشین‌آلات و تجهیزات',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا اپراتور دارای گواهینامه ویژه و تجربه کار با بلدوزر را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا اپراتور اطلاعات کافی از نکات ایمنی کار با دستگاه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا اپراتور از محلی که دستگاه باید در آنجا کار کند، اطلاعات مناسب و کافی را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا محل فعالیت دستگاه نواربندی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا اپراتور از وسایل حفاظت فردی استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا نوع دستگاه به لحاظ کیفیت و کارایی قدرت برای فعالیت انتخاب‌شده مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا داخل کابین فاقد اشیاء و ابزار اضافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا صندلی اپراتور به لحاظ ارگونومی و تسلط مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا کپسول اطفای حریق در کابین موجود و شارژ مناسب را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا شیشه‌ها و آینه‌ها برای دید اپراتور به لحاظ شفافیت و عدم ترک و شکستگی مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا اهرم‌ها و لیورهای کنترل دارای علامت مشخصه عملکرد دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'کنترل سیستم روشنایی (چراغ روشنایی جلو و عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'کنترل علائم هشداردهنده (بوق، آلارم حرکت به عقب) و آمپرها و کلیدهای کنترل.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'کنترل شیلنگ‌ها و لوله‌های ارتباط سیستم هیدرولیک و سیستم سوخت‌رسانی به لحاظ نشتی و عدم فرسودگی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'کنترل جک‌های انگل تیغه جلو به لحاظ پوسته جک، شفت جک و عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کنترل جک‌های بالا و پایین ریپر عقب به لحاظ پوسته و شفت جک و عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'کنترل موتور، توربین به لحاظ عدم نشتی، ارتعاش، صدای غیرعادی، فشار و قدرت لازم.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'کنترل پمپ هیدرولیک، پمپ فرمان، هیدروموتور، چرخ‌ها به لحاظ عدم نشتی، فشار و قدرت لازم، ارتعاش، صدای غیرعادی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'کنترل سیستم خنک‌کننده موتور و روغن هیدرولیک (شبکه رادیاتور آب، شیلنگ‌ها، عدم نشتی، فن رادیاتور).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'کنترل سیستم برق، باتری، دینام، استارت و سیم‌کشی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'کنترل کمان، بیل، زاویه بیل و جک‌های افقی بیل، ناخن‌های ریپر به لحاظ سایش و دفرمگی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'کنترل زیربندی و جک‌های سفت‌کن زنجیر به لحاظ عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کنترل کفشک‌ها، زنجیر، پین زنجیر، رولیک‌ها، خورشیدی‌ها (اسپراکت).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'کنترل مخزن هیدرولیک، فیلتر، نمایشگر مخزن روغن هیدرولیک، لوله‌های ارتباطی و عدم نشتی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'کنترل نقشه محل تخریب به لحاظ لوله آب، گاز و خطوط کابلی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'کنترل ماشین‌آلات و کارگران مشغول به کار در کنار دستگاه و رعایت نکات ایمنی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'کنترل مفصل‌ها، پین‌ها، اشپیل‌ها به لحاظ عدم لقی و عدم سایش و خوردگی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'کنترل روانکاری و گریس‌کاری و فیلترها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'کنترل قسمت‌های مختلف دستگاه به صورت روزانه توسط اپراتور.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'کنترل قفل‌کن و استقرار تیغه پس از توقف پایان کار.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  21 => 
  array (
    'title' => 'تاور کرین',
    'category' => 'جرثقیل و تجهیزات بالابری',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا تاور کرین با توجه به استقرار آن بر روی پایه تثبیت شاقول است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا تاور کرین گواهی سلامت کار (Certification) از مراجع ذی‌صلاح دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا وزنه‌های تعادل شاسی و کنفلش (مقدار تناژ هر وزنه) مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا وزنه‌های کافی (بتنی یا فلزی) برای تعادل تاور کرین (شاسی و کنفلش) چیدمان مناسب را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا تابلو شناسایی تاور کرین (ظرفیت، ارتفاع خودایستایی، مدل، شماره سریال) کارخانه سازنده بر روی دستگاه نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا جرثقیل دارای قطع و یا سیستم هشداردهنده در زمان اضافه‌بار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا جرثقیل از برق با آمپر مناسب استفاده می‌نماید (برق اضطراری)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا تمام سازه فلزی نصب‌شده تاور کرین، ایمنی را در زمان حمل بار تضمین می‌نماید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا تاور به‌درستی و با در نظر گرفتن نقشه‌های مونتاژ شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا ریل‌های دستگاه به‌درستی نصب شده و مسیر حرکت آن توسط حفاظ و با فاصله ایمن از کارگاه جدا شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا تراورس‌های زیر ریل تاور کرین و پیچ و مهره‌ها مورد بازرسی قرار می‌گیرند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا فونداسیون زیر ریل‌ها، ترازو مقاومت بتنی مناسب را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا بوژی‌ها (Bogie) در زمان توقف کار قفل و یا ثابت شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا سازه تاور کرین کاملاً قفل و ثابت شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا در توقف‌های موقت و یا پس از اتمام کار روزانه، قلاب و کابل‌ها و شاریوت به بالاترین حد برده شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا سرعت مجاز باد برای عملکرد تاور کرین (وزش بادهای منطقه) مشخص شده است و دستگاه دارای باد نما است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا تابلوی لود چارت در کابین اپراتور قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا اپراتور در زمانی که بار و محموله روی قلاب قرار دارد به هنگام توقف‌های کوتاه کابین را ترک می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا اپراتور توانایی استفاده از لود چارت را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا میزان بار ایمن در شعاع‌های مختلف عملیاتی بازوی تاور کرین در چرخش‌ها و تاور کرین مجاور مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا در زمان وجود بار روی تاور کرین و توقف عملیات در مدت زمان کوتاه، اپراتور کنترل و تسلط کامل بر روی تاور را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا شعاع فاصله فلش و قلاب تاور کرین از کابل‌های فشار ضعیف و قوی هوایی مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا بار در روی زمین سفت و محکم تخلیه می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا پس از تخلیه بار، راه دسترسی برای جابه‌جایی و یا برداشتن مجدد بار امکان دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا کابین دارای سیستم تهویه هوا، دید محیطی کافی برای عملیات و کپسول اطفای حریق است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا زنجیرها، قلاب‌ها و یا قسمتی از بار بر روی زمین کشیده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا قلاب تاور کرین به صورت تراز در وسط کابل‌های قلاب قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'کنترل کابل‌های باربردار (زدگی، خمش، طول و قطر مناسب، کلیپس‌ها، پرس‌ها، لوپ‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا زنجیرها توسط اتصالات پیچی (شگل) و یا کابلی به یکدیگر متصل شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا کابل‌ها و زنجیرها از برخورد با لبه‌های تیز محافظت می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا برای سنجش فاصله شاریوت، روی فلش در هر ۱۰ متر یک تابلوی تعیین متراژ فاصله نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'کنترل ایمن بودن و پوشش تابلوی برق مستقر بر روی کنفلش و در پایین تاور کرین.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'سالم بودن کلید قطع اضطراری برق.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'کنترل قطع‌کن در زمان انتقال بار بیش از حد مجاز در طول حرکت شاریوت در مسیر فلش.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'کنترل سالم بودن قرقره هدایت‌کننده (راهنما) جهت چیدمان مناسب سیم‌بکسل بر روی درام.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'کنترل تابلوی مدار قدرت و فرمان (کنتاکتورها، رله‌های حرارتی، تایمرها، کلیدهای مینیاتوری، فیوزها، کلید اتوماتیک، کلید اصلی قطع جریان برق) از لحاظ آمپراژ لازم و سالم بودن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'کنترل اپراتور جهت استفاده از وسایل حفاظت فردی (کمربند، کفش و کلاه ایمنی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا تاور کرین از حد خودایستایی تعریف‌شده توسط سازنده دستگاه تجاوز نکرده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'کنترل و سنجش فازهای R.S.T، آمپرمتر، ولت‌متر، نمراتور.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا پس از نصب تاور و خودایستایی مجاز تاور کرین برای ارتفاع‌دهی بیشتر در کنار سازه و یا وسط سازه، مهاری زده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا در تاور کرین نصب‌شده در وسط سازه به ازای هر ۱۰ متر ارتفاع تاور کرین مهاری برای آن زده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'سالم بودن Stoppage نگهدارنده انتهایی ریل‌های تاور کرین.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'تمیز بودن و عدم ساییدگی در سطوح مختلف ریل‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'کنترل سیستم گردان (سایش دنده‌های گردان، خلاصی، روانکاری).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'کنترل الکتروموتور و گیربکس گردان (عدم نشتی، سایش دنده‌های سر گیربکس).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'کنترل اتصالات شاسی (پیچ و مهره، محل جوش‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'کنترل الکتروموتور و گیربکس گردان (عدم نشتی، سایش دنده‌های سر گیربکس).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'کنترل الکتروموتور و گیربکس شاریوت (عدم نشتی، سایش دنده‌های سر گیربکس).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'کنترل الکتروموتور و گیربکس وینچ (عدم نشتی، سایش دنده‌های سر گیربکس).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'کنترل الکتروموتور و گیربکس ریل (عدم نشتی، سایش دنده‌های سر گیربکس).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'کنترل سالم بودن کلید اصلی برق بر روی کالسکه و کابل تغذیه‌کننده.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'کنترل عملکرد صحیح مگنت و لنت‌های ترمز در حرکات مختلف تاور کرین (گردان، شاریوت، ریل، وینچ، قلاب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'کنترل تمیزی و عدم سایش مسیر ریل و مسدودکننده ابتدا و انتهای ریل شاسی (تاور ریلی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'کنترل تمیزی و عدم سایش مسیر ریل و مسدودکننده ابتدا و انتهای ریل شاریوت (کالسکه).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'کنترل شیلنگ‌های پمپ و جک هیدرولیک (عدم پوسیدگی، عدم نشتی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'کنترل عملکرد قطع‌کن‌های قلاب و شاریوت.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'کنترل عملکرد قطع‌کن‌های گردان و وینچ.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'کنترل قلاب، اتصالات و عدم سایش دهانه قلاب.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'کنترل قلاب، سهولت در چرخش و ضامن ایمنی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'کنترل سیم‌بکسل درام و شاریوت، روانکاری و گریس‌کاری.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'کنترل آلیاژ استاندارد و مناسب پیچ‌ها و مهره‌ها و واشرها، پین‌ها، اشپیل‌ها و مفصل‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'کنترل سیم‌بکسل، قطر مناسب، عدم زدگی، عدم پیچش و خمش.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'کنترل کابل‌های برق متحرک و ثابت، عدم فرسودگی، عدم زدگی و اتصال.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'کنترل سنجش مقدار فاصله شاریوت بر روی فلش.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'کنترل سکشن‌ها (محل پیچ و جوش‌ها، عدم دفرمگی، آلیاژ استاندارد نبشی و پلیت سکشن‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'کنترل سکشن‌ها (نردبان، حفاظ نردبان، اتصالات حفاظ و نردبان).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'کنترل پاگرد و سبدهای حفاظ‌دار مناسب برای بررسی قسمت‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'کنترل تابلوی برق (پوشش ایمن، استقرار، عدم دست‌یابی افراد متفرقه).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'کنترل تابلوی برق (کنتاکتورها، رله‌ها، کلیدهای مینیاتوری، فیوزها، تایمرها، کلید گردان).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'مطلع بودن اپراتور از وضعیت جابه‌جایی بار و نفرات توسط سیم و آیفون.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'اپراتور الزاماً پس از پایان کار روزانه، گردان تاور را در حالت آزاد قرار دهد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'کنترل فلش‌ها (عدم دفرمگی، عدم پوسیدگی، محل اتصال).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'کنترل کنفلش‌ها (عدم دفرمگی، عدم پوسیدگی، محل اتصال).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'کنترل مهاری‌های فلش و کنفلش (مفصل‌ها، پین‌ها و اشپیل‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      74 => 
      array (
        'question' => 'کنترل برقراری سیستم اتصال به زمین (ارت) تاور کرین.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      75 => 
      array (
        'question' => 'کنترل سیم‌بکسل‌ها و زنجیرها و شگل‌های بارانداز از نظر عدم زدگی، سایش و ترک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      76 => 
      array (
        'question' => 'کنترل کاج ارتفاعی (عدم دفرمگی و محل اتصال‌ها).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      77 => 
      array (
        'question' => 'کنترل کابین (شیشه‌ها، سالم بودن درب و دستگیره درب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      78 => 
      array (
        'question' => 'کنترل بار هنگام جابه‌جایی از حرکات ارتعاشی، آونگی و شناوری.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      79 => 
      array (
        'question' => 'کلید محافظ جان GFCI.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      80 => 
      array (
        'question' => 'نظم و ترتیب محوطه اطراف جرثقیل و داخل جرثقیل.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  22 => 
  array (
    'title' => 'آمبولانس',
    'category' => 'خودرو و حمل‌ونقل',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'روغن موتور.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آب ضدیخ رادیاتور.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آب باتری.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'دینام و تسمه پروانه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'تنظیم موتور.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آمپر دما و سوخت (آمپر روغن و باد در مورد بنز آتش‌نشانی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'عملکرد کلاچ و ترمزها و شمارگان کیلومتر خودرو.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'وضعیت چرخ‌ها و باد لاستیک‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'چراغ‌ها (نور بالا، نور پایین، ترمز و دنده عقب).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'بدنه ظاهری.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'بوق، آژیر و چراغ‌های گردان.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'جک، آچارها و ابزارآلات.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'نظافت و تمیزکاری.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'تعداد و آماده‌به‌کاری کپسول‌های اطفای حریق.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'جعبه کمک‌های اولیه و تجهیزات آن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'ماسک، کپسول اکسیژن، گیج، مانومتر کپسول اکسیژن (پر یا خالی بودن کپسول اکسیژن) و به‌طور کلی سیستم اکسیژن‌رسانی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'برانکارد و پتو و تخت چرخ‌دار.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'کیف اورژانس و تجهیزات آن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'سیستم خنک‌کننده کابین آمبولانس.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'سیستم روشنایی داخل کابین.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'تجهیزات احیاء (CPR).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'سیستم ساکشن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'سیستم تهویه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  23 => 
  array (
    'title' => 'خودرو آتش‌نشانی',
    'category' => 'حریق و واکنش اضطراری',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'دیلم، سیم‌بُر، کارد، تبر و چراغ‌قوه ایمنی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آچار هیدرانت و دستکش آتش‌نشانی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'ماسک، کلاه و لباس آتش‌نشانی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'پر بودن مخزن آب و کف و کپسول ۲۵۰ کیلوگرمی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'شیلنگ‌ها، آچارها و نازل‌های آتش‌نشانی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'سالم بودن و عملکرد صحیح پمپ.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'هورریل و مانیتور آتش‌نشانی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'سایر متعلقات و ادوات آتش‌نشانی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'لباس مخصوص ضد حریق.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا کپسول‌های اکسیژن یک‌نفره پر هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'کپسول‌های مختلف اطفای حریق (CO2، پودر خشک و آب) در ماشین پیشرو آتش‌نشانی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا کپسول‌های اطفای حریق تاریخ اعتبار و شارژ دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  24 => 
  array (
    'title' => 'خودروهای سبک واحد نقلیه',
    'category' => 'خودرو و حمل‌ونقل',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'راهنماها و فلاشرها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'کلیه نشانگرهای جلوی آمپر.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'مه‌شکن جلو و عقب.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'چراغ‌های جلو و عقب.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'چراغ دنده عقب.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'سیستم هشداردهنده و آنتن برقی (در صورت وجود).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'اگزوز.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'زاپاس.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'بوق.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'کولر و بخاری.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'برف‌پاک‌کن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'فندک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'بالابر شیشه (دستی و برقی).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'سیستم فن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'قفل مرکزی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آب باتری و اتصالات مربوطه (باتری اتمی نیازی ندارد).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'سطح روغن موتور (بررسی عدم هرگونه نشتی، بازدید سر زیر موتور).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'سطح روغن هیدرولیک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'سطح روغن ترمز.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'مایع سیستم خنک‌کننده.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'روغن گیربکس.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'بررسی هرگونه نشتی و روغن‌ریزی از سیستم هیدرولیک فرمان، ترمز و غیره.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'بررسی عدم هرگونه نشتی از سیستم سوخت‌رسانی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'بررسی عدم نشتی از بست‌ها و شیلنگ‌های سیستم خنک‌کننده.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'کشش کلیه تسمه‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'رگلاژ ترمز دستی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'وضعیت پدال‌های کلاچ، ترمز و گاز.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'میزان فرمان و آچارکشی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'بررسی شرایط و فشار باد لاستیک.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'زاپاس.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آچار چرخ.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'مثلث خودرو.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'دفترچه خودرو.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'رادیو پخش.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'کلید یدکی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'کیف ابزار.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'صندلی جلو و عقب.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'لاستیک‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'زه‌های اطراف خودرو و ضربه‌گیرها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آینه‌های جانبی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آینه مرکزی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'جلو آمپر.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'کمربندهای ایمنی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'دستگیره‌های داخلی درب‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'رودری‌ها و نظافت درون خودرو.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'زیرپایی‌ها و موکت کف.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'دستگیره‌های سقف.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'قالپاق‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'قفل و دستگیره درب‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'گلگیرها و سپرهای جلو و عقب.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'درب موتور (کاپوت جلو)، درب صندوق و درب‌های خودرو.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'شیشه‌های جلو و عقب و شیشه‌های درب‌های جلویی و عقبی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  25 => 
  array (
    'title' => 'ایمنی در پرتونگاری، جوشکاری و حمل و نگهداری کپسول‌های هوا و گاز',
    'category' => 'پرتونگاری و جوشکاری',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا پرمیت‌های لازم قبل از شروع پرتونگاری تهیه شده و برای شیفت کاری مذکور معتبر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا هنگام پرتونگاری فاصله استاندارد با منطقه ممنوعه رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا قبل از شروع به کار، نفرات غیرمرتبط با پرتونگاری از منطقه خارج می‌گردند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا دستگاه پرتونگاری دارای مشخصات فنی و شماره چک‌شده روی دستگاه می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا در حمل و نقل دوربین نکات ایمنی توسط پرتونگار رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا نفرات پرتونگار مشخصات دستگاه چشمه و جدول شارژ را به واحد HSE کارگاه گزارش می‌دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'در صورت استفاده از دستگاه X-RAY آیا دستگاه در محل مناسب و ایمن نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا نفرات پرتونگار هنگام کار از فیلم‌بج، دوزیمتر و یا رادیومتر استفاده می‌نمایند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا این دتکتورها کالیبره شده و نتایج آن نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا هنگام پرتونگاری از وسایل هشداردهنده، چراغ گردان، نوار خطر و تابلو خطر استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا محل پرتونگاری طبق نقشه و کروکی محل دقیق انجام آن، به اطلاع کلیه پرسنل رسیده است (نصب در تابلوی اعلانات)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا جوشکار از خطرات اشعه IR و UV مطلع هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا سایر افراد با خطرات پرتونگاری آشنایی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا در هنگام جوشکاری علائم هشداردهنده نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا در هنگام جوشکاری در مکان‌هایی مثل SHOP امکان تهویه مناسب وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا فاصله انبر اتصال جوشکاری تا محل جوشکاری کمتر از سه متر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا جهت جوشکاری در مخازن تجهیزات لازم اندیشیده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا هنگام جوشکاری برای جلوگیری از پرتاب ذرات راهکاری پیش‌بینی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا کابل‌ها و سیم‌های جوشکاری به‌طور ایمن نگهداری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا در هنگام جوشکاری ایمنی سیلندرهای اکسیژن و آرگون رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا ترانس جوشکاری سالم و دارای سیم ارت است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا جوشکار با نحوه کارکرد کپسول‌ها آشنایی دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا قبل از شروع کار، دستگاه‌ها و تجهیزات توسط سرپرستان کنترل می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا بست‌ها، شیلنگ‌ها و تجهیزات برشکاری سالم و عاری از نقص می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا عملیات برشکاری و سنگ‌زنی دور از مواد قابل اشتعال صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا اقدامات لازم برای جلوگیری از پرتاب ذرات ذوب کابل‌ها و مواد دیگر صورت گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا هنگام عملیات برشکاری و سنگ‌زنی در ارتفاع از کمربند ایمنی استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا سنگ دستگاه فرز متناسب با دستگاه فرز می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا دستگاه سنگ‌زنی قبل از شروع به کار کنترل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا سنگ‌های فرز دارای حفاظ مناسب می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا سنگ‌های فرز از کیفیت مناسب برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا هنگام سنگ‌زنی و برش‌کاری در ارتفاع جهت جلوگیری از آتش‌سوزی از پتوی نسوز استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا کپسول‌های گاز و اکسیژن و آرگون دارای اتصالات مناسب و شیلنگ‌های سالم می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا قسمت‌های متحرک کپسول اکسیژن مثل تنظیم‌ها، شیرها و سایر قسمت‌ها عاری از هر نوع مواد روغنی می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا سیلندرهای اکسیژن از جاهای گرم و مواد محترقه فاصله دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا سیلندرهای اکسیژن دارای تنظیم‌کننده می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا در محل انبار شدن سیلندرها از کپسول اطفای حریق مناسب استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا از سیلندرها در برابر شرایط جوی محافظت شده و از تابش مستقیم آفتاب به دور می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا جهت جابه‌جایی کپسول‌ها از چرخ‌دستی مناسب استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا جهت اتصال شیلنگ به کپسول‌ها از بست مناسب استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا شیلنگ‌ها سالم بوده و عاری از ترک‌خوردگی می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا کپسول‌ها هنگام انبار و حمل دارای کلاهک می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا نفرات از خطرات کپسول‌ها هنگام بارگیری و تخلیه آگاه هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا کپسول‌های پر و خالی هنگام انبار شدن مشخص می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا کپسول‌ها هنگام استفاده مهار شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا کپسول‌ها هنگام استفاده یا در انبار به‌صورت ایستاده قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا محل استقرار و نگهداری سیلندرها از نظر دور بودن از حرارت، شرایط جوی و گرمازا و ثابت بودن به دیوار از طریق زنجیر یا بست محکم مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا وضعیت ظاهری سیلندر به لحاظ نام گاز محتوی سیلندر و فرمول شیمیایی و سال ساخت مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا آخرین تست هیدرولیکی سیلندر، فشار کار سیلندر، ظرفیت سیلندر و فشار آزمون سیلندر مشخص و مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا وضعیت شیر فلکه سیلندر و وضعیت رگلاتور مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا وضعیت رزوه گلوگاه سیلندر و وضعیت مانومتر یا فشارسنج‌های سیلندر مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا وضعیت شیلنگ‌ها و سایر اتصالات مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'آیا وضعیت شیر تنظیمی خروجی گاز به طرف شیلنگ مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا وضعیت شیر یک‌طرف سیلندر بعد از مشعل و روی گاز یا اکسیژن مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'آیا درپوش یا محافظ سیلندر منفذدار (جهت جلوگیری از آسیب و تراکم گاز) مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'آیا وضعیت کفشک سیلندر مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'آیا در قسمت محل نگهداری سیلندرها کپسول‌های اطفای حریق وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'آیا وضعیت تفکیک سیلندر (جدا کردن پر از خالی، نوع گاز و انبار کردن جداگانه) مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'آیا آلوده نبودن شیر و متعلقات سیلندر به روغن و گریس و ... (ترجیحاً اکسیژن) رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'آیا به‌طور صحیح کنترل فشار استاندارد هر نوع سیلندر در زمان مصرف انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'آیا سیلندرها به طرز صحیحی در کارگاه حمل و نقل می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'آیا کارگران پس از اتمام کار کلیه شیرهای سیلندر را می‌بندند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'آیا کارگران از وسایل حفاظت فردی مناسب نظیر دستکش چرمی جوشکاری استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'آیا در کارگاه از جوش کاربید استفاده می‌شود؟ در صورت مثبت بودن، اصول ایمنی رعایت می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'آیا دستورالعمل‌های مربوطه نصب شده است و کارگران رعایت می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'آیا برای وسایل برقی قابل حمل از پریزهای ارت‌دار استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'آیا قبل از استفاده وسایل برقی کنترل آن‌ها صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'آیا قبل از استفاده از دستگاه برقی ولتاژ آن کنترل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'آیا هنگام تعمیرات دستگاه‌ها زیر پای عایق برای افراد وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'آیا هنگام تعمیرات از ابزار و وسایل ایمنی (عایق) استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'آیا هنگام تعمیرات دستگاه‌های برقی فیوزهای تابلوهای برق مربوطه به دستگاه برداشته می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'آیا هنگام قطع جریان برق شخص مسئول فیوز را با خود می‌برد و اخطار لازم را روی کلید نصب می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'آیا موقعیت کلیدها و نشانگر در تابلو جهت ایجاد فاصله لازم هنگام کار مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'آیا بین موتورهای نیروی محرکه و تابلوهای برق فاصله مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      74 => 
      array (
        'question' => 'آیا فیوزها و کلیدهای خودکار مناسب با ولتاژ جریان عبوری شبکه است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      75 => 
      array (
        'question' => 'آیا فاصله مجاز بین دستگاه‌ها و تابلوهای برق رعایت شده؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      76 => 
      array (
        'question' => 'آیا برای پیشگیری از صدمات فیزیکی، تسهیلات موجود کافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      77 => 
      array (
        'question' => 'آیا کلیدهای استارت دستگاه‌ها طوری قرار دارد که از راه افتادن تصادفی دستگاه‌ها جلوگیری کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      78 => 
      array (
        'question' => 'آیا پریزها به تعداد کافی در همه‌جا هستند تا از سیم‌کشی‌های سیار جلوگیری کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      79 => 
      array (
        'question' => 'آیا از تعمیر این دستگاه‌ها توسط افراد غیرمسئول جلوگیری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  26 => 
  array (
    'title' => 'ایمنی ماشین‌های ابزار',
    'category' => 'ماشین‌آلات و ابزار',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'حفاظ مته (حفاظ تلسکوپی / عقب‌رونده).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'وضعیت فک‌های گیره رومیزی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'وضعیت مرغک جا مته‌ای.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'وضعیت آچار سه‌نظام جهت تعویض مته.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'وضعیت سالم بودن فک‌های سه‌نظام.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'وضعیت لوله هدایت‌کننده مایع خنک‌کننده.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'وضعیت حفاظ قسمت انتقال‌دهنده نیرو.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'وضعیت دکمه توقف اضطراری دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'وضعیت روشنایی موضعی.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'وضعیت تابلو برق دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'وضعیت نحوه اتصال دستگاه به شبکه برق دارای سیستم اتصال به زمین (ارتینگ) مناسب.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'وضعیت دسته پایین‌آورنده مته.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'وضعیت اهرم تنظیم سرعت چرخشی به صورت دورانی ـ محوری.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'وضعیت اهرم قطع و وصل دستی جهت بار دادن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'وضعیت کلید دور برگردون (چپ‌گرد ـ راست‌گرد).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'وضعیت اهرم تنظیم سرعت بار دادن.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'برس جهت جمع‌آوری براده‌ها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'محل قرارگیری دستگاه.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'دستورالعمل ایمنی کار با دستگاه موجود و نصب در محل.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'وضعیت ایمنی تجهیزات حفاظت فردی (PPE).',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا کاربران دستگاه‌های تراش و فرز و سنگ سمباده دوره‌های آموزشی مناسب را گذرانده‌اند و دارای گواهینامه آموزشی می‌باشند و همچنین راهنمای استفاده از این وسایل را در اختیار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا نکات ایمنی و پیشنهادات سازنده دستگاه‌های فرز و تراش مورد توجه قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا هشدارها و علائم ایمنی بر روی قسمت‌های خطرناک دستگاه به منظور توجه بیشتر کاربران نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا دستگاه فرز و تراش توسط افراد با صلاحیت نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا سرعت چرخش حداکثر برای دستگاه‌های فرز با ضخامت بیش از ۵۵ میلی‌متر مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا فرد ماهر و باتجربه و محل مناسب برای کار با دستگاه‌ها و ماشین‌ها توسط مدیریت کارگاه در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا حفاظ‌های ایمنی دستگاه‌های تراش با نوع دستگاه سازگار بوده و تعویض نگردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا ماشین‌های ساینده و فرزها با حفاظ‌های مناسب و با اندازه صحیح تجهیز گردیده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا اصول ایمنی در مورد محافظت از چشم‌ها برای کاربران به‌کار می‌رود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا مواد و وسایل به‌جای‌مانده از تراشکاری‌ها و سایـش سریعاً از کف محیط جمع‌آوری می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا محافظ ایمنی برای افرادی که در مجاورت آسیاب‌ها و دستگاه‌های تراش کار می‌کنند در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا امکانات انبارداری و نگهداری وسایل تراش و فرز کافی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا به کارگران در مورد ایمنی عملیات اجرایی که استفاده از محافظ چشم در آن الزامی می‌باشد، آموزش داده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا کاربران به وسایل ایمنی شخصی مناسب از قبیل عینک، گوشی و سایر وسایل ایمنی مورد نیاز تجهیز شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا حفاظ به‌طور کامل تیغه دستگاه را پوشش داده و طول و ضخامت مناسب را دارا می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا فاصله بین میز کار و تیغه برش کمتر از ۶ میلی‌متر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا میز انتقال الوار ۱۲۰۰ میلی‌متر بعد از تیغه اره ادامه دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا وسیله‌ای مناسب جهت فشار دادن کنده‌ها و الوارها به داخل وجود دارد و از آن استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا Riving Knife ایمن و قابل تنظیم بوده و از ضخامت مناسب برخوردار می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  27 => 
  array (
    'title' => 'ایمنی ماشین‌های برش چوب و نجاری',
    'category' => 'ماشین‌آلات و ابزار',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا افراد مجاز به استفاده از دستگاه‌های برش چوب و نجاری مشخص هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا آموزش‌های مناسب به منظور استفاده از ماشین‌های برش چوب و روش‌های کار به کاربران توسط مسئول مربوطه داده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا کاربران به وسایل ایمنی شخصی از قبیل عینک، گوشی و ماسک ایمنی مجهز می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا کلید قطع و وصل دستگاه در محل مناسب که به راحتی قابل دسترس کاربر باشد نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا تمام قسمت‌های دستگاه ایمن نصب شده و از محکم بودن ماشین اطمینان حاصل شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا فضای کافی و مناسب در اطراف دستگاه به منظور کار ایمن در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا صدای محیط تا حد ممکن و قابل قبول کاهش یافته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا گوشی‌های محافظ در مواقع مورد نیاز در دسترس است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا نور کافی و طبیعی یا مصنوعی در محیط کار در نظر گرفته شده است؟ آیا این نور فاقد درخشندگی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا کف کارگاه به‌طور طبیعی ساخته شده و مواد به‌جای‌مانده از برش چوب و مواد لغزنده پاک گشته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا وسایل اطفای حریق مناسب و قابل دسترس در کارگاه نجاری وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا دستگاه‌ها دارای حفاظ سالم و راحت قابل نصب می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا حفاظ جلوی دستگاه به‌طور کامل از دندانه‌های اره حفاظت می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا وسیله مناسب جهت فشار دادن کنده‌ها و الوارها به داخل وجود دارد و از آن استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا دستگیره‌های مناسب در موقع برش عرضی استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  28 => 
  array (
    'title' => 'ایمنی ماشین‌های سنگ ساب، فرز و تراش',
    'category' => 'ماشین‌آلات و ابزار',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز دوم HSE (بخش ایمنی).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا جنس سنگ با نوع کار مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا وضعیت ظاهری سنگ مناسب است (از نظر ترک‌خوردگی)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا واشر مخصوص سنگ سمباده مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا حفاظ جانبی سنگ مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا تکیه‌گاه قطعه کار مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا فاصله ۳ میلی‌متری سنگ با تکیه‌گاه مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا حفاظ پشت‌نمای سنگ مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا سنگ هنگام کار بدون لغزش و ارتعاش است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا ماشین سنگ دارای سیستم ارتینگ مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا محل نگهداری سنگ خشک است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'وضعیت کلید خاموش و روشن دستگاه مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا کابل برق رابط دستگاه ساب فیبری سالم و دارای دوشاخه مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا دستگاه‌های فرسوده به موقع تعویض می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا محل استقرار سنگ ساب مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا اپراتور از وسایل حفاظت فردی مناسب و متناسب با کار خود استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا آچار مخصوص جهت تعویض سنگ فیبری وجود دارد و مناسب و سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا کاربران دستگاه‌های سنگ ساب و فرز و ... دوره‌های آموزشی مناسب را گذرانده‌اند و راهنمای استفاده از این وسایل را در اختیار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا هشدارها و علائم ایمنی بر روی قسمت‌های خطرناک دستگاه به منظور توجه دادن کاربران نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا سرعت حداکثر مجاز برای ماشین‌های سنگ ساب و تراش به‌طور واضح مشخص و بر روی دستگاه نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا در استفاده از دستگاه فرز از لبه‌های صحیح دستگاه استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا حفاظ‌های ایمنی دستگاه‌های تراش با نوع دستگاه سازگار بوده و تعویض نگردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا آسیاب‌ها و دستگاه‌های تراش به صورت صحیح تنظیم و محافظت می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا اصول ایمنی در مورد محافظت از چشم‌ها برای کاربران به‌کار می‌رود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا بر افرادی که مشغول آموزش دیدن می‌باشند به‌طور دائم نظارت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا میزان صدای دستگاه‌ها از حد مجاز بیشتر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا محافظ ایمنی برای افرادی که در مجاورت آسیاب‌ها، دستگاه‌های فرز و دستگاه‌های تراش کار می‌کنند در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا صفحه‌های تقویت‌شده فقط برای دستگاه‌های قابل حمل دستی استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا ارزیابی عملیات اجرایی از لحاظ خطرهای محتمل برای چشم‌ها و پرتاب براده‌ها صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا اپراتور از لباس کار یکسره و بدون دستکش استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا دستگاه‌های سنگ ساب با محافظ با اندازه‌های مناسب تجهیز گردیده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا از مهره‌های قفل‌کننده مناسب برای دستگاه‌های فرز استفاده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا سرعت چرخش حداکثر برای دستگاه‌های سنگ فرز با ضخامت بیش از ۵۵ میلی‌متر مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  29 => 
  array (
    'title' => 'ارزیابی وضعیت HSE و کیفیت کار پیمانکاران',
    'category' => 'مدیریت HSE',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'رعایت روش های اجرایی و دستورالعمل های کارفرما',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'ثبت کامل رویدادها و ارائه به کارفرما',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'عدم وجود حوادث ناتوان کننده مشابه',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'عدم وجود حادثه منجر به نقص عضو و فوت',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'معرفی پرسنل به واحد HSE کارفرما جهت آموزش',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'شرکت منظم در Meeting HSE',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'توجه سرپرست پیمانکار به رفع نواقص اعلام شده از کارفرما',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'استفاده مداوم پرسنل از PPE و تعویض به‌موقع آن‌ها',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'رعایت پرمیت های کاری',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'رعایت موارد ایمنی کار با جرثقیل ها (نحوه نگهداری و انتقال سیلندرها به روش ایمن و وضعیت شیلنگ‌های ارتباطی)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'رعایت موارد ایمنی جوشکاری و برشکاری (نحوه نگهداری و انتقال سیلندرها به روش ایمن و وضعیت شیلنگ‌های ارتباطی)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'پیشگیری و مقابله با آتش‌سوزی (انتخاب نفرات آموزش دیده جهت تیم امداد و نجات، وجود تجهیزات و کپسول‌های آتش‌نشانی)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'رعایت موارد ایمنی کار با وسایل برقی و تجهیزات الکتریکی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'رعایت موارد ایمنی کار در ارتفاع',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'رعایت موارد ایمنی کار در هنگام گودبرداری',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'معرفی پرسنل جهت انجام معاینات پیش از استخدام',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'معرفی پرسنل جهت انجام معاینات دوره‌ای',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'رعایت بهداشت عمومی در کارگاه، کمپ کارگری و رستوران',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'رعایت امور مربوط به مدیریت پسماند در کارگاه',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'رعایت موارد MSDS در نگهداری مواد شیمیایی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'کنترل هر گونه نشتی مواد در محیط کار',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'وجود علائم هشداردهنده در محل (شب، روز)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کنترل مستمر و ادواری تجهیزات آتش‌نشانی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آمادگی و واکنش در شرایط اضطراری',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا پیمانکار شخصی را به عنوان مسئول HSE در اختیار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا دستورالعمل‌هایی که در اختیار پیمانکار قرار داده می‌شود اجرا می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا پرسنل پیمانکار در کلاس های آموزشی HSE حضور فعال دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا مسئول HSE پیمانکار همکاری لازم را در جهت جلوگیری از بروز حوادث با مدیر HSE کارگاه دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا مسئول HSE پیمانکار گزارش عملکرد خود را به مدیر HSE کارگاه ارسال می دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا مدیران پیمانکار در جلسات HSE کارگاه حضور دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا پیمانکار از قوانین و الزامات HSE مرتبط با سایت و فعالیت ابلاغ شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا شناسایی خطرات و نحوه کنترل آن‌ها به صورت کتبی به پیمانکار ابلاغ شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا معاینات بدو استخدام و دوره‌ای برای کلیه پرسنل پیمانکار انجام شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا کلیه پرسنل پیمانکار در بدو ورود آموزش دیده و مجهز به PPE می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا کارگاه و سایت پیمانکار به تجهیزات ایمنی مجهز است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا نظارت بر تمیزکاری سایت و House Keeping انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا پیگیری های لازم در خصوص CERTIFICATE آب / یخ صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا جایگاه موقت زباله (پسماند) / قبض ها و فاکتورهای مربوط وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا آموزش به پرسنل جدیدالورود و اخذ تعهد نامه از ایشان صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا مسیرهای خروج عاری از هرگونه مانع می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا کپسول‌های اطفای حریق موجود، شارژ و دارای اعتبار می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا جداسازی کاغذ و سایر زباله در ظروف مختلف انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا سیم ها و کابل‌های برق از هرگونه آسیب فیزیکی محافظت شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا اقالم داخل جعبه کمک‌های اولیه کامل است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا تاریخ مصرف اقالم داخل جعبه کمک‌های اولیه معتبر است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا به بازدید کنندگان کتابچه راهنما HSE، بروشور و نقشه ایمنی در شرایط اضطراری تحویل و هنگام خروج پس گرفته می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا لوازم، مواد شوینده و ضدعفونی کننده در محل به تعداد و مقدار مناسب وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا آبدارچی و نظافتچی ها معاینات دوره‌ای خود را انجام داده اند و دارای کارت سلامت می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'در انتخاب پیمانکار به سوابق فنی از نظر ایمنی توجه می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا دستورالعملی برای فعالیت پیمانکاران جزء وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا واحد ایمنی بر فعالیت پیمانکاران نظارت دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا جلسات هماهنگی برای رعایت مقررات ایمنی با نماینده پیمانکار برگزار می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'صورتجلسات مربوط تهیه و پیگیری های لازم انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا سوابقی در مورد جلوگیری از فعالیت پیمانکار به دلیل عدم رعایت مقررات ایمنی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'ارائه نمودن MSDS مواد شیمیایی به شرکت',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'رعایت نمودن موارد HSE مطابق با قرار داد فی مابین',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'ارزیابی وضعیت کیفیت کار پیمانکاران',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'آیا برنامه زمان بندی منظمی جهت بازدیدهای دوره‌ای اجرا می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'آیا از بازدیدها گزارش تهیه و به ناظر و کارفرما ارجاع می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'کیفیت کالا/ کالاهای ارائه شده',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'ارائه کالا/ خدمت با قیمت مناسب و قابل رقابت',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'قبول دریافت وجه پس از تائید کالا توسط شرکت',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'حسن همکاری عالی در مورد قرارداد فیمابین',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'تحویل به‌موقع خدمات / کالاهای ارائه شده',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'موجود بودن استانداردهای فنی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'ارائه خدمات پس از فروش',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'دارا بودن سیستم مدیریت بین المللی به رسمیت شناخته شده',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'به‌موقع ارائه شدن برنامه زمانبندی مصوب اولیه',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'انطباق پیشرفت کار با برنامه زمان بندی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'ارائه گزارشات روزانه زمان بندی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'درصد پیشرفت مهندسی پروژه (طبق شاخص فرایند طراحی و مهندسی) متناسب با هدف تعریف شده دالیل انحراف',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'لحاظ شدن داده های طراحی پایه در طراحی های تفصیلی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'مطابقت شماره بازنگری مدارک ارسال شده (مطابق با شاخص فرایند طراحی مهندسی) با هدف تعریف شده علت',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'داشتن نرم افزار تخصصی و توانایی استفاده از آن',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      74 => 
      array (
        'question' => 'برخوردار بودن از بانک اطلاعاتی مناسب برای پیگیری زمان بندی مدارک',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      75 => 
      array (
        'question' => 'مقید بودن پیمانکار در پیگیری مدارک مهندسی از مهندس پروژه',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      76 => 
      array (
        'question' => 'تهیه و ارائه به‌موقع مدارک مهندسی و نقشه های اجرایی در طول اجرای پروژه',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      77 => 
      array (
        'question' => 'برخوردار بودن تامین کننده در کارخانه از کادر کنترل کیفی مجرب مکفی و مستقل',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      78 => 
      array (
        'question' => 'ارائه مدارک کنترل کیفی مکفی و مناسب از طرف پیمانکار در بخش تامین تجهیزات',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      79 => 
      array (
        'question' => 'مورد قبول بودن کیفیت فنی کار در بخش تامین تجهیزات',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      80 => 
      array (
        'question' => 'برخوردار بودن تجهیزات (ابزار و ماشین‌آلات) مورد استفاده در کارخانه از کیفیت و گواهینامه کالیبراسیون معتبر',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      81 => 
      array (
        'question' => 'رعایت نکات زیست محیطی و بهداشت و ایمنی شغلی در محل کار',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      82 => 
      array (
        'question' => 'رعایت ایمنی در کارگاه (آیا لوازم ایمنی به تعداد کافی برای کارکنان وجود دارد)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      83 => 
      array (
        'question' => 'ارائه مدارک کنترل کیفی مکفی و مناسب از طرف پیمانکار در کارگاه',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      84 => 
      array (
        'question' => 'مورد قبول بودن کیفیت فنی کار در کارگاه',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      85 => 
      array (
        'question' => 'برخوردار بودن تجهیزات (ابزار و ماشین‌آلات) مورد استفاده در کارخانه از کیفیت و گواهینامه کالیبراسیون معتبر',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      86 => 
      array (
        'question' => 'به‌موقع انجام شدن تجهیز کارگاه علت تاخیر:',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      87 => 
      array (
        'question' => 'وجود کادر فنی مرتبط و نیروی انسانی کافی در ستاد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      88 => 
      array (
        'question' => 'رفع شدن مشکلات دوره ارزیابی قبلی شرح کلی از رفع مشکلات:',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      89 => 
      array (
        'question' => 'پیگیر بودن تامین کننده در اجرای وظائف محوله (در صورت مواجهه شدن با مشکل و یا مغایرت)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      90 => 
      array (
        'question' => 'توانایی مالی تامین کننده',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      91 => 
      array (
        'question' => 'توان مدیریتی مدیر کارگاه پیمانکار',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      92 => 
      array (
        'question' => 'همکاری پیمانکار با دیگر شرکت های فعال در پروژه',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  30 => 
  array (
    'title' => 'آموزش ایمنی محیط کار',
    'category' => 'آموزش ایمنی',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا پرسنل آموزش‌های مختلف ایمنی را متناسب با کار دیده اند و آیا پرسنل کارگاه‌ها پرونده آموزشی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا ارائه پوسترهای ایمنی با کار متناسب بوده و آیا تعویض پوسترها در هر شش ماه یکبار صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا در کارگاه‌ها پمفلت‌های آموزشی و توصیه‌های ایمنی توزیع می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا روش ایمن و صحیح انجام کارها نوشته شده و در دسترس افراد می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا ارائه فیلم‌های ایمنی برای کلیه پرسنل به صورت مدام انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا مسئولین و سرکارگران بر نحوه صحیح و ایمن به انجام کار نظارت دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا در تمامی مشاغل نحوه انجام کار از دیدگاه ایمنی به صورت عملی نظارت دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا از تبلیغات برای ایمنی قبل از کار استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا کارگران در رابطه با نحوه کار ماشین‌آلات آموزش می‌بینند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا مشخصات مواد، موارد کاربرد و خطرات آن در دسترس می‌باشد؟ (MSDS مواد تهیه شده است)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا آموزش‌های خاص برای اپراتور یا راننده در نظر گرفته شده و افرادی که با جرثقیل‌ها کار می‌کنند از تخصص کافی برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا تیم آموزش دیده جهت کمک‌های اولیه وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا توصیه ها و راهنمایی های لازم در خصوص کاهش حوادث به پرسنل داده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا از تجزیه و تحلیل حوادث در آموزش ها به‌وسیله سرکارگران و مسئولین استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا افراد در زمینه چگونگی حمل بار آموزش دیده اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا پرسنل آموزش اطفای حریق دیده اند و آیا در کارگاه مانورهای اطفای حریق برگزار شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا پرسنل آموزش دیده در خصوص شرایط بحرانی و امداد و نجات وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا افراد در رابطه با چگونگی حمل بار آموزش دیده اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا آموزش صحیح استفاده از وسایل حفاظت فردی به افراد داده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا مسئولین ایمنی و بهداشت آموزش‌های ایمنی عمومی را قبل از شروع به‌کار افراد انجام می‌دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا در پروژه‌ها محلی برای آموزش‌های فردی چهره‌به‌چهره و Tool Box Meeting وجود دارد و آیا به‌موقع برگزار می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  31 => 
  array (
    'title' => 'ایمنی و بهداشت عمومی',
    'category' => 'ایمنی و بهداشت عمومی',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا شما دارای یک برنامه فعال ایمنی و بهداشت و نیز مدیریت خطرات خاص در محیط کارتان هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا شما یک کمیته ایمنی یا گروه مشخصی می باشید که به‌طور منظم تشکیل جلسه بدهد و فعالیت هایش را کتبا به مدیریت و ارگان های ذی‌ربط گزارش نمایید.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا شما دارای پروسه ای هستند که کارکنان مشکلات ایمنی و بهداشتی را به مسئولین مربوطه انتقال دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا شما به طور مستمر توصیه‌های ایمنی و بهداشتی را به کارکنان می‌نمایید و اطمینان لازم از شرایط ایمنی و بهداشتی را به کارکنان ارائه می دهید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا شما تشویق هایی را برای کارکنان یا گروه های کاری که در کاهش حوادث، آسیب ها و بیماری های ناشی از کار تلاش بیشتری نموده‌اند در نظر گرفته اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا پوسترهای ایمنی در جاهای مهم که همه کارگران بتوانند آن را ببینند نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا شماره تلفن اورژانس به دیوار زده شده است در جایی که کارگران بتوانند در مواقع اضطراری از آن استفاده نمایند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا در جایی که کارگران ممکن است در تماس با مواد سمی یا عوامل فیزیکی مضر باشند اطلاعات مربوط به نحوه دسترسی کارگران به خدمات پزشکی و ثبت تماس و ورقه های اطلاعات ایمنی (MSDS) مواد به آسانی در دسترس کارگران می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا علائم هشداردهنده ایمنی در جاهایی که نیاز است نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا همه آسیب ها و بیماری های شغلی ثبت می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا ثبت های پزشکی و تماس کارگران با مواد خطرناک یا عوامل فیزیکی مضر به‌روز و مطابق با استاندارد ایران می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا مستندات مربوط به آموزش کارگران، نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا مستندات مربوط به آسیب ها، تماس ها برای مدت زمان قانونی نگهداری می‌شوند (به طور مثال بعضی از ثبت ها حداقل بایستی 40 سال نگهداری شوند)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا مجوزهای کاری برای فعالیت هایی چون کار با بالابرها، مخازن تحت فشار، مخازن گاز مایع و... به‌روز می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا یک بیمارستان، کلینیک یا درمانگاه برای مراقبت های پزشکی در نزدیکی محل کار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'اگر امکانات پزشکی وجود ندارد آیا در هر شیفت حداقل یک نفر مسئول انجام خدمات کمک‌های اولیه می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا وسایل کمک‌های اولیه بحد کافی وجود دارد و به آسانی در دسترس شاغلین قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا از همه کارگران انتظار می رود به اورژانس های پزشکی بعنوان بخشی از کارشان پاسخ دهند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا در جایی که شاغلین در تماس با عوامل زیان آور و پاتوژنها هستند، ارزیابی پزشکی بعد از تماس و همچنین پیگیری لازم صورت می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا فردی برای انجام توصیه و مشاوره در خصوص مشکلات بهداشتی شاغلین قابل دسترسی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا محیط کار کارکنان از نظر تعیین نوع خطر خطرات موجود و وسایل حفاظت فردی مورد نیاز (کفش، دستکش، ماسک، گوشی و...) ارزیابی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا خطرات یا بروز احتمالی خطرات مشخص گردیده آیا جهت پیشگیری از حوادث، وسایل حفاظت فردی مناسب مناسب در اختیار کارکنان قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا کارکنان آموزش‌های لازم را در زمینه به‌کارگیری صحیح و مناسب وسایل حفاظت فردی و این که چه وسیله ای برای چه کاری لازم است، چه وقت نیاز است و چطور استفاده می‌گردد را دیده اید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا در جاهای که خطر سقوط اشیاء وجود دارد کلاه ایمنی تهیه و از آن استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا در جاهایی که خطر آسیب های چشمی از قبیل کوفتگی، پارگی و سوختگی وجود دارد عینک های ایمنی مناسب تامین گردیده است؟ (خصوصا در کارهای جوشکاری و برشکاری)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا در جاهایی که خطر سقوط اشیا وجود دارد کلاه ایمنی تهیه و از آن استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا در جاهایی که خطر جراحت پا در اثر حرارت، مواد خوردنده، مواد سمی، سقوط اشیاء وجود دارد کفش و پوتین ایمنی مناسب تهیه گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا در جاهایی که تراز صدا بیشتر از حد مجاز توصیه شده OSHA می‌باشد اقدامات حفاظتی برای جلوگیری از اثرات آن به‌کار گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا کلاه ایمنی به طور مرتب از نظر آسیب بدنه و ملحقاتش بازرسی می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا طرح و برنامه ای برای کمیته بحران با در نظر گرفتن مراحل 3 گانه (قبل از وضعیت اضطراری و برگشت به شرایط عادی) به صورت مکتوب و متناسب با منابع سازمانی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا اعضا تدوین این برنامه ها و بازنگری ان مشخص شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا جلسات ارزیابی این برنامه ها به طور منظم برگزار می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا روش کار مستند و در دسترس می‌باشد و مورد استفاده قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا چک‌لیست های ایمنی در برنامه ایمنی وجود دارد و رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا آموزش‌های خاص و مستمر برای کارگران وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'شرایط ظاهری و فیزیکی ابزارهای دستی مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'انبار کردن و نگهداری ابزارهای دستی به طور متناسب صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'سرپرست مربوط بررسی های منظم مناسب صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'بالابرها و وسایل مشابه ها دارای گواهی تست می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'قسمت‌های مختلف بالابرهای مطابق با دستورالعمل، بازدید و در دفتر مربوطه ثبت گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'مقدار بار مجاز و ایمن قابل حمل و کد رنگ آن مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'قالبها از نظر بازشدگی تست و مورد بازرسی قرار می‌گیرند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا کابل ها و سایر ملحقات به صورت ادواری مورد بازرسی و آزمایش قرار می‌گیرند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'وسیله دسترسی ایمن و مناسب برای صعود به جرثقیل وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'اپراتورها دارای گواهینامه تخصصی هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'کلید توقف فوری بای تجهیزات بالابر موجود می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا دستورالعمل سازندگان به صورت کامل مورد استفاده قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا چک‌لیست ایمنی وسایل بالابرنده در برنامه ایمنی وجود داردو رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'تجهیزات الکتریکی توسط وسایل دائمی یا موقت حفاظت در مقابل نشتی جریان محافظت می گردند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آزمایش عملکرد، نگهداری نتایج و بازدید از سیستم چاه اتصال زمین انجام و ثبت می گردند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'تجهیزات الکتریکی دارای عایق بندی سالم هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'اتصال زمین و خصوصیات عایق و ضد حریق بدون آن بررسی می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'تمام تجهیزات الکتریکی ضد حریق مطابق دستورالعمل سازنده می گردند و نتایج در دفاتر ثبت می گردند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا مخازن تحت فشار، بست ها، شیرها و شیلینگ ها تست شده‌اند و طبق مقررات و استاندارد بازرسی و آزماییش می گردند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'تست های مربوطه انجام شده دارای گواهی تست می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'خط قرمز در فشار سنج ها وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'شیرهای اطمینان به طور مناسب بازرسی و تنظیم می گردند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'آیا آموزش‌های خاص و مستمر برای کارگران وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'آیا موانع لازم به تعداد کافی در اطراف نقاط و محل های خطرناک نصب شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'آیا موانع کافی برای جداسازی ترافیک عبوری از ترافیک کارگاه استفاده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'به منظور تقسیم جریان های ترافیکی در مسیرهای مورد استفاده مشترک افراد و ماشین ها موانع ممناسب قرار گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'علائم هشداردهنده استاندارد در محل های مورد نیاز وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'علائم هشداردهنده لازم برای اطلاع رسانی و آموزش وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'علائم هشداردهنده برای خطوط برق و پست های برق وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'حوادث به مراجع مربوط (کارفرما، ناظر، اداره کار، سازمان تامین اجتماعی) گزارش می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'بررسی حادثه و گزارش ان انجام گرفته و در دفتر ثبت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'گزارش حوادث، ثبت گزارش مصدومیت بر اساس مقررات و قوانین جاری انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'گزارش داخلی تمام مصدومیت ها طبق فرم مربوط انجام می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'علل حادثه مشخص شده. ارتباط موضوعی با سوابق امر مورد توجه قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'بررسی حادثه به وسیله یک تیم مشخص و ذی‌صلاح، انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'اقدامات به عمل آمده مستند می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'محل‌هایی که نیاز به تعمیرات، بازسازی و اصلاح دارند در کارگاه وجود داشته و مشخص شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'نظم و ترتیب و نظافت کارگاه و محوطه آن مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'محل رفت و امد وسایل نقلیه و افراد مشخص می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      74 => 
      array (
        'question' => 'از کدهای رنگی راهنما به صورت یکنواخت و مشخص استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      75 => 
      array (
        'question' => 'گزارش چراغ‌های خاموش و صدمه دیده به وسیله سرپرستان و به طور مستمر صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      76 => 
      array (
        'question' => 'روشنایی تمام مکان ها مناسب و در حد استاندارد می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      77 => 
      array (
        'question' => 'نگهداری و سرویس تجهیزات تهویه مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      78 => 
      array (
        'question' => 'کنترل ورود و خروج افراد، ماشین‌آلات و غیره به‌طور مناسب صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      79 => 
      array (
        'question' => 'علائم راهنما و هشداردهنده در این مسیرها نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      80 => 
      array (
        'question' => 'هماهنگی کننده، آموزش لازم را برای کنترل وضعیت اضطراری دیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      81 => 
      array (
        'question' => 'تیم های لازم برای کمک‌های اولیه، خدماتی و پشتیبانی، همگی اموزش دیده و در تمرین های اضطراری گنجانده شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      82 => 
      array (
        'question' => 'آیا چارت سازمانی بهداشتی حداقل نیازها را برآورد می سازد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      83 => 
      array (
        'question' => 'آیا نحوه ارتباط کارکنان شفاف و شرح وظایف آن‌ها تعریف شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      84 => 
      array (
        'question' => 'آیا اقداماتی جهت پیشرفت برنامه های بهداشتی صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      85 => 
      array (
        'question' => 'آیا اعضای کمیته های بهداشتی مشخص و شرح وظایفشان به آن‌ها ابلاغ شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      86 => 
      array (
        'question' => 'آیا بازدید های دوره‌ای فعالیت های واحد بهداشتی صورت می‌گیرد و سوابق مربوط نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      87 => 
      array (
        'question' => 'آیا در صورتی که فعالیت های واحد بهداشت به پیمانکار واگذار گردیده است موارد زیر رعایت شده است؟ · سوابق بهداشتی پیمانکار · دستورالعمل برای فعالیت پیمانکار · نظارت واحد بر فعالیت های پیمانکار · ارسال تمام گزارشات حوادث ناظر و کارفرما · برگزاری جلسات هماهنگی به طور منظم و نگهداری سوابق',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      88 => 
      array (
        'question' => 'آیا فعالیت هایی برای تشخیص خطرات و بهداشت بر سلامت افراد انجام شده است؟ فعالیت هایی که با ریسک‌های بالا همراه هستند(کار با پرتوها، میدان های مغناطیسی و...)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      89 => 
      array (
        'question' => 'آیا پرسنل در زمینه فعالیت های خود آموزش لازم را دیده اند؟ · شروع به کار · آموزش‌های حین خدمت · آموزش‌های خاص',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      90 => 
      array (
        'question' => 'آیا برنامه های بازآموزی بهداشت به صورت برنامه زمانی برای تمام کارکنان اجرا می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      91 => 
      array (
        'question' => 'سوابق آموزشی پرسنل نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      92 => 
      array (
        'question' => 'آیا فاصله آشپز خانه از محل های آلوده کننده رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      93 => 
      array (
        'question' => 'آیا فضای آشپز خانه از محل های آلوده کننده رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      94 => 
      array (
        'question' => 'آیا فضای آشپزخانه مناسب با حجم کار می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      95 => 
      array (
        'question' => 'آیا سقف آشپزخانه به رنگ روشن بدون ترک خوردگی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      96 => 
      array (
        'question' => 'آیا دیوارهای آشپزخانه تا سقف کاشی می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      97 => 
      array (
        'question' => 'آیا کف آشپزخانه بدون ترک قابل شستشو از جنس موزاییک با سنگ غیرلغزنده با شیب مناسب همراه با کف شو می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      98 => 
      array (
        'question' => 'آیا آشپزخانه دارای تهویه مناسب و هود کافی برای اجاقهای و سیستم گرمایشی و سرمایشی متناسب با فصل می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      99 => 
      array (
        'question' => 'آیا یخچال و فریز مناسب با حجم کار و منطبق با شرایط و ضوابط بهداشتی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      100 => 
      array (
        'question' => 'دمای محیط آشپزخانه متناسب با فصل، تنظیم می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      101 => 
      array (
        'question' => 'آیا محل شستشو و نگهداری ظروف مجزا و مستقل از محل پخت می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      102 => 
      array (
        'question' => 'آیا ظرفشویی سه مرحله ای، (جمع‌آوری، شستشو و آب کشی) دارای شیر آب گرم و سرد مشترک می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      103 => 
      array (
        'question' => 'آیا ظروف سالم بدون لب پریدگی از جنس شیشه، چینی یا استیل می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      104 => 
      array (
        'question' => 'آیا ابزار و وسایل پوست کن و خردکن بدون درز و شکاف بوده و به آسانی قابل جدا کردن و شستشو می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      105 => 
      array (
        'question' => 'آیا نظافت وسایل فوق به صورت کامل انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      106 => 
      array (
        'question' => 'آیا میزها، پیشخوان ها، کمدها، قفسه ها قابل شستشو بوده و کف آن‌ها از زمین فاصله دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      107 => 
      array (
        'question' => 'آیا تدابیر لازم برای مقابله با حشرات و جوندگان اتخاذ گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      108 => 
      array (
        'question' => 'آیا سطوح و میز کار صاف و قابل شستشو و دارای روکش ضد زنگ می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      109 => 
      array (
        'question' => 'آیا کف آشپزخانه پساز هر ریخت و پز با آب و شوینده ها و محلول های ضدعفونی، شستشو و ضد عفونی می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      110 => 
      array (
        'question' => 'آیا نور آشپزخانه کافی بوده و در و پنجره ها و شیشه ها مرتبا نظافت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      111 => 
      array (
        'question' => 'آیا تمام درها و پنجره‌های انبار سالم، قابل شست‌وشو و مجهز به توری زنگ‌نزن، درب‌بند و فنر هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      112 => 
      array (
        'question' => 'آیا شعله ها به هنگام استفاده به رنگ آبی می سوزد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      113 => 
      array (
        'question' => 'آیا کیفیت آب مطابق استاندارد های بهداشتی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      114 => 
      array (
        'question' => 'آیا سیستم جمع‌آوری و دفع بهداشتی فاضلاب به طور کامل انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      115 => 
      array (
        'question' => 'آیا تعداد زباله‌دان‌ها کافی و دارای شرایط بهداشتی بوده به طوریکه نظافت کاملاً رعایت شده و جمع‌آوری و دفع زباله کاملاً بهداشتی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      116 => 
      array (
        'question' => 'آیا عدم استفاده از روغن جامد در تهیه غذا رعایت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      117 => 
      array (
        'question' => 'آیا در برنامه غذایی استفاده از حبوبات و سبزیجات به همراه غذا رعایت گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      118 => 
      array (
        'question' => 'آیا در برنامه غذایی، رژیمی (دیابت، فشار خون بالا، چربی خون بالا، ناراحتی قلبی) در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      119 => 
      array (
        'question' => 'آیا کارکنان آشپزخانه قبل از شروع به کار استحمام می‌نمایند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      120 => 
      array (
        'question' => 'آیا کارکنان آشپزخانه لباس کار مخصوص دارند؟ (روپوش- کلاه سفید – پیش بند – کفش)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      121 => 
      array (
        'question' => 'آیا لباس کار و وسایل نظافت و استحمام به تعداد کافی در اختیار کارکنان آشپرخانه قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      122 => 
      array (
        'question' => 'آیا شستشوی لباس کارکنان آشپزخانه مجزا از سایر کارکنان انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      123 => 
      array (
        'question' => 'آیا تمام کارکنان تهیه پخت و توزیع مواد غذایی دارای کارت بهداشتی معتبر می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      124 => 
      array (
        'question' => 'آیا کارکنان بهداشت فردی را رعایت می‌نمایند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      125 => 
      array (
        'question' => 'آیا جعبه کمک‌های اولیه با حداقل وسایل (چسب گاز استریل، قیچی، پنس، پماد سوختگی، ماده ضدعفونی کننده، پسب زخم) در محل مناسبی نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      126 => 
      array (
        'question' => 'آیا نکات بهداشتی به صورت پوستر و تابلو در معرض دید افراد قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      127 => 
      array (
        'question' => 'آیا افراد با علامت نکشیدن سیگار در محیط کار توجه می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      128 => 
      array (
        'question' => 'آیا آشپزخانه به سیستم لعالم و اطفاء حریق مجهز می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      129 => 
      array (
        'question' => 'آیا ایمنی وسایل برقی در آشپزخانه رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      130 => 
      array (
        'question' => 'آیا کپسول آتش‌نشانی در محل نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      131 => 
      array (
        'question' => 'آیا اجاقها مجهز به ترموکوپل می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      132 => 
      array (
        'question' => 'تعداد شاغلینی که در امر تهیه و پخت مواد غذایی دخالت دارند.... نفر',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      133 => 
      array (
        'question' => 'تعداد شاغلینی که در امر توزیع دخالت دارند... نفر',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      134 => 
      array (
        'question' => 'آیا حمل و نقل مواد مصرفی به طریق بهداشتی انجام می‌گیرد؟ (مجهز بودن ماشین حمل و نقل به سیستم سردخانه)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      135 => 
      array (
        'question' => 'آیا عدم استفاده از مرغ با پوست در پخت غذا رعایت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      136 => 
      array (
        'question' => 'آیا تمام گوشت های مصرفی اعم از گوسفند، گوساله، مرغ و ماهی دارای مجوز بهداشتی بوده و از منابع معتبر تامین می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      137 => 
      array (
        'question' => 'آیا میز کار گوشت و مرغ از جنس تفلون بوده و پس از پایان کار تمیز و ضد عفونی می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      138 => 
      array (
        'question' => 'آیا مواد غذایی منجمد به طریق بهداشتی از انجماد خارج می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      139 => 
      array (
        'question' => 'آیا نگهداری تمام ضایعات گوشت های مصرفی در یخچال ممنوع است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      140 => 
      array (
        'question' => 'آیا شرایط نگهداری گوشت و مرغ مصرفی مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      141 => 
      array (
        'question' => 'آیا یخچال و سرد خانه مجهز به دماسنج سالم بوده و به طور منظم برودت ان کنترل می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      142 => 
      array (
        'question' => 'آیا نظافت داخل یخچال و سردخانه به طور منظم انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      143 => 
      array (
        'question' => 'آیا یخچال و سردخانه مجهز به برق اضطرای می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      144 => 
      array (
        'question' => 'آیا نگهداری الشه های گوشت به طور صحیح انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      145 => 
      array (
        'question' => 'آیا تمام مواد غذایی در ظروف مناسب در یخچال نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      146 => 
      array (
        'question' => 'آیا کارکنان در موقع ورود به سردخانه از کفش مخصوص استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      147 => 
      array (
        'question' => 'آیا نگهداری سبزیجات و میوه جات در یخچال به طریقه بهداشتی و بعد از شستن و ضدعفونی کردن آن‌ها انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      148 => 
      array (
        'question' => 'آیا در تمام قسمت‌های نگهداری، پخت و توزیع غذا به نکات ایمنی و بهداشتی (به صورت تابلو یا پوستر) توجه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      149 => 
      array (
        'question' => 'آیا نگهداری مواد غذایی به طور جداگانه طبقه بندی مشخص می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      150 => 
      array (
        'question' => 'آیا حجم مواد غذایی نگهداری شده متناسب با فضای یخچال و فریزر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      151 => 
      array (
        'question' => 'آیا مواد خام و مواد پخته جدا از هم نگهداری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      152 => 
      array (
        'question' => 'نگهداری مواد غذایی پخته بیش از یک روز مجاز نمی‌باشد، آیا به این نکته توجه می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      153 => 
      array (
        'question' => 'آیا عدم استفاده از مواد افرودنی غیرمجاز (اسانسها، جوش شیرین و رنگ ها) رعایت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      154 => 
      array (
        'question' => 'آیا جابجا کردن مواد یخ زده رعایت می‌گردد؟ (عدم ذوب و انجماد مجدد)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      155 => 
      array (
        'question' => 'آیا طبقه بندی مواد یخ زده رعایت می‌گردد؟ (به تفکیک گوشت، سبزیجات و...)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      156 => 
      array (
        'question' => 'آیا تاریخ انجماد روی بسته های مواد غذایی ثبت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      157 => 
      array (
        'question' => 'آیا انبار در محل مناسبی واقع شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      158 => 
      array (
        'question' => 'آیا سطح و فضای آنبار متناسب با نوع و میزان مواد ذخیره شده می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      159 => 
      array (
        'question' => 'آیا مواد به گونه ای چیده شده‌اند که خطر سقوط و مزاحمت تردد نداشته باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      160 => 
      array (
        'question' => 'آیاساختمان انبار از مصالح مقاوم، صاف و بدون ترک خوردگی و قابل نظافت است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      161 => 
      array (
        'question' => 'آیا تا ارتفاع مناسب درب ورودی ورق الومینیوم نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      162 => 
      array (
        'question' => 'آیا تمام در و پنجره ها ی انبار سالم، قابل شستشو و مجهز به توری و فنر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      163 => 
      array (
        'question' => 'آیا درجه حرارت انبار متناسب با نوع ماده ذخیره شده می‌باشد و از تابش مستقیم نور خورشید بر روی مواد غذایی جلوگیری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      164 => 
      array (
        'question' => 'آیا مواد غذایی فاسد نشدنی (حبوبات، سبزیجات و...(در ظروف در دار و به ارتفاع 02CM از زمین، روی پالت نگهداری می‌شود؟)نگهداری این مواد به صورت فله ای ممنوع است)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      165 => 
      array (
        'question' => 'آیا به این نکته که نباید ظروف خالی و وسایل اسقاطی را در انبار نگهداری نمود توجه می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      166 => 
      array (
        'question' => 'ورود افراد متفرقه به داخل انبار ممنوع می‌باشد، آیا به این نکته توجه می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      167 => 
      array (
        'question' => 'آیا دیوارها از جنس کاشی بدون ترک خوردگی و مقاوم ورود حشرات و جوندگان می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      168 => 
      array (
        'question' => 'آیا محل غذا خوری دارای میز و صندلی به تعداد کافی برای کارکنانی که در یک زمان غذا می خورند وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      169 => 
      array (
        'question' => 'آیا کف قابل شستشو با شیب مناسب به سمت کف شو می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      170 => 
      array (
        'question' => 'آیا محل غذاخوری دارای تهویه مناسب و مجهز به وسایل گرمایشی و سرمایشی مناسب با فصل می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      171 => 
      array (
        'question' => 'آیا نظافت رومیزها مناسب می‌باشد؟ دستمال کاغذی برای هر میز وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      172 => 
      array (
        'question' => 'آیا در مسیر ورود کارکنان به محل غذاخوری، دستشویی مجهز به آب گرم و سرد، صابون و وسایل خشک کن دست و صورت وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      173 => 
      array (
        'question' => 'آیا قبل از ورود به غذاخوری به تعویض لباس کارگرانی که به مواد سمی و عفونت زا سروکار دارند نظارت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      174 => 
      array (
        'question' => 'آیا در و پنجره های غذا خوری مجهز به توری و فنر و وسایل مبارزه با حشرات می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      175 => 
      array (
        'question' => 'ارائه خدمت توسط پیش خدمت ها به سرعت و دقت کافی انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      176 => 
      array (
        'question' => 'آیا نحوه توزیع مخلفات غذا مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      177 => 
      array (
        'question' => 'وسایل سرو غذا (سینی، بشقاب و لیوان و...) کاملاً تمیز است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      178 => 
      array (
        'question' => 'حمام آیا به ازای هر 15 نفر کارگر یک دوش آب گرم و سرد وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      179 => 
      array (
        'question' => 'در سالن غذاخوری جعبه کمک‌های اولیه وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      180 => 
      array (
        'question' => 'در کارگاههایی که شاغلین آن‌ها با سموم و مواد عفونت یا مواد غذایی سروکار دارند برای یک الی ده نفر کارگر یک دوش آی گرم و سرد و به ازاء هر 10 نفر اضافی یک دوش آب سرد و گرم دیگر در نظر گرفته می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      181 => 
      array (
        'question' => 'آیا محل دوش ها مقاوم، قابل شستشو، غیرلغزنده و دارای شیب کافی به سمت کفشوی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      182 => 
      array (
        'question' => 'آیا سقف حمام صاف یا رنگ روغنی روشن و بدون ترک خوردگی و دیوارها تا سقف کاشی به رنگ روشن می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      183 => 
      array (
        'question' => 'حمام و محل دوش به طور مرتب تمیز و با مواد مناسب گندزدایی می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      184 => 
      array (
        'question' => 'آیا مساحت کف محل دوش 120 سانتی‌متر رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      185 => 
      array (
        'question' => 'آیا محوطه حمام دارای هواکش متناسب فضای آن می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      186 => 
      array (
        'question' => 'چنانچه برای گرم کردن حمام از منابع حرارتی غیر مرکزی استفاده می‌شود. آیا این منابه در محل مناسب قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      187 => 
      array (
        'question' => 'آیا در داخل حمام از المپ های ایمنی با حباب شیشه ای استفاده می‌شود و تمام کلیدها و پریزها در خارج از حمام قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      188 => 
      array (
        'question' => 'آیا حمام ها دارای محل مناسبی بعنوان رختکن برای تعویض لباس می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      189 => 
      array (
        'question' => 'شستشوی هر نوع البسه کاری در حمام ممنوع می‌باشد. آیا به این نکته توجه می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      190 => 
      array (
        'question' => 'آیا حمام ها دارای سطح زباله ضد رنگ با کیسه می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      191 => 
      array (
        'question' => 'آیا کارکنان دارای قفسه های انفرادی برای تعویض لباس شخصی می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      192 => 
      array (
        'question' => 'آیا قفسه ها به گونه ای ساخته شده‌اند که دارای محل نگهداری مجزا برای لباس بیرون، وسایل حفاظت فردی و کفش ایمنی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      193 => 
      array (
        'question' => 'آیا قفسه ها شیبدار، قابل شستشو و دارای کرکره ثابت ورود و خروج هوا و قفل می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      194 => 
      array (
        'question' => 'آیا در قسمت‌هایی که مواد سمی و عفونت زا سروکاردارند ماشین لباس شویی و پودر پاک کننده در دسترس می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      195 => 
      array (
        'question' => 'آیا فاصله و محل توالت ها از محل کارگاه مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      196 => 
      array (
        'question' => 'آیا دیوارها تا سقف کاشی بدون ترک خوردگی به رنگ روشن و قابل شستشو می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      197 => 
      array (
        'question' => 'آیا کف مقاوم، صاف، قابل شستشو و گندزدایی و ترجیحا از جنس موازییک سنگ می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      198 => 
      array (
        'question' => 'آیا کاسه توالت به رنگ روشن، صاف و بدون ترک خوردگی به رنگ روشن و قابل شستشو و گندزدایی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      199 => 
      array (
        'question' => 'آیا حداقل عرض توالت 80 سانتی‌متر و حداقل طول آن 1 متر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      200 => 
      array (
        'question' => 'آیا توالت دارای شیر اب با شیلنگ برداشت آب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      201 => 
      array (
        'question' => 'آیا شستشو و ضدعفونی کردن توالت هابه‌طور مجهز انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      202 => 
      array (
        'question' => 'آیا درب توالت مجهز به پشت بند درب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      203 => 
      array (
        'question' => 'آیا توالت دارای تهویه و روشنایی مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      204 => 
      array (
        'question' => 'آیا توالت ها مجهز به سطل زباله درب دار، زنگ نزن و قابل شستشو می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      205 => 
      array (
        'question' => 'آیا توالت ها مجهز به سیفون می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      206 => 
      array (
        'question' => 'دستشویی آیا تعداد دستشویی ها متناسب با تعداد کارکنان می‌باشد؟ برای 1 تا 15 نفر شاغل حداقل 1 دستشویی، برای 16 تا 30 نفر شاغل حداقل 2 دستشویی، برای 31 تا 50 نفر شاغل حداقل 3 دستشویی، برای 51 تا 75 نفر شاغل حداقل 4 دستشویی، برای 76 تا 100 نفر شاغل حداقل 5 دستشویی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      207 => 
      array (
        'question' => 'آیا محل دستشویی ها در مجاورت نماز خونه، غذاخوری و توالت می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      208 => 
      array (
        'question' => 'آیا دستشویی ها دارای شیر آب گرم و سرد می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      209 => 
      array (
        'question' => 'آیا کاسه دستشویی به رنگ روشن، صاف و بدون ترک و قابل شستشو می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      210 => 
      array (
        'question' => 'آیا عرض دستشویی حداقل 60 سانتی‌متر و طول آن 1 متر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      211 => 
      array (
        'question' => 'آیا وسایل خشک کن مناسب در دستشویی وجود دارد؟ (خشک کن الکتریکی، حوله کاغذی)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      212 => 
      array (
        'question' => 'آیا دستشویی به طور مرتب شستشو و گندزدایی می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      213 => 
      array (
        'question' => 'آیا ساختمان خوابگاه دارای شرایط بهداشتی مناسب می‌باشد؟ (در و دیوار و سقف)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      214 => 
      array (
        'question' => 'آیا تخت سالم به تعداد افراد وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      215 => 
      array (
        'question' => 'آیا پتو، بالش و تشک مناسب برای تمام افراد ساکن موجود موجود است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      216 => 
      array (
        'question' => 'آیا تهویه خوابگاه مناسب است؟ (طبیعی و مصنوعی)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      217 => 
      array (
        'question' => 'آیا کمد لباس با کرکره ثابت (بری تهویه) با محل مجزا و جا کفشیبرای هر نفر به‌طور جداگانه در نظرگرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      218 => 
      array (
        'question' => 'آیا نظافت و گردگیری خوابگاه ها، نظافت پنجره ها، سم‌پاشی و ضد عفونی محوطه به‌طور مرتب انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      219 => 
      array (
        'question' => 'آیا سرویس های بهداشتی(با شرایط ذکر شده) متناسب با تعداد ساکنین خوابگاه می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      220 => 
      array (
        'question' => 'آیا اقدامات لازم برای زیباسازی خوابگاه و محوطه اطراف انجام شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      221 => 
      array (
        'question' => 'آیا رخشوی خانه با تمام امکانات و خشک کن در محل استراحتگاه وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      222 => 
      array (
        'question' => 'آیا سطل زباله بهداشتی در قسمتهایی مختلف خوابگاه وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      223 => 
      array (
        'question' => 'آیا دسترسی افراد به آب آشامیدنی گوارا به راحتی امکان پذیر است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      224 => 
      array (
        'question' => 'آیا یخچال با فضای کافی برای تمام در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      225 => 
      array (
        'question' => 'آیا البسه و ملحفه ها به طور مرتب ضدعفونی می گردند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      226 => 
      array (
        'question' => 'آیا از گذاردن البسه و ملحفه بر روی زمین بدون استفاده از پالت خودداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      227 => 
      array (
        'question' => 'آیا البسه آلوده به مواد خونی و عفونی (بیمارستانی یا درمانگاهی) از سایر البسه ها جدا گردیده و شستشوی آن‌ها مجزا صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      228 => 
      array (
        'question' => 'آیا مواد شوینده استاندارد به میزان مورد نیاز در دسترس می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      229 => 
      array (
        'question' => 'آیا آب آشامیدنی کارکنان تصفیه شده می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      230 => 
      array (
        'question' => 'آیا مخازن آب، استاندارد بوده و به طریقه اصولی نگهداری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      231 => 
      array (
        'question' => 'آیا وضعیت آب آشیمیدنی از لحاظ امکان الودگی به عوامل بیولوژیک (قارچ‌ها، انگل‌ها و...) به طور مرتب مورد بازبینی و آزمایش قرار می‌گیرند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      232 => 
      array (
        'question' => 'آیا سیستمی برای آنالیز و مشخص نمودن ترکیب فاضلاب خروجی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      233 => 
      array (
        'question' => 'آیا به طور منظم آنالیز دقیقی بر روی فاضلاب صنعتی خروجی انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      234 => 
      array (
        'question' => 'آیا ترکیب فاضلاب خروجی (صنعتی بهداشتی) در یک محدوده استاندارد قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      235 => 
      array (
        'question' => 'آیا سیستم تصفیه مناسبی برای تصفیه فاضلاب بهداشتی واحد وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      236 => 
      array (
        'question' => 'در صورت وجود سیستم مناسب برای تصفیه فاضلاب بهداشتی، ترکیب فاضلاب بهداشتی پس از تصفیه با توجه به منبع پذیرنده در یک محدوده استاندارد قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      237 => 
      array (
        'question' => 'در صورتی که سیستم تصفیه مناسبی برای فاضلاب های بهداشتی وجود ندارد آیا دفع ان با استفاده از چاه های جذبی صورت می‌گیرد؟ (آیا قانون ممنوعیت استفاده از چاه های جذبی رعایت می‌شود؟)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      238 => 
      array (
        'question' => 'آیا فاضلاب بهداشتی به سمت نزدیک ترین تصفیه خانه شهری هدایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      239 => 
      array (
        'question' => 'در صورتی که سیستم تصفیه مناسبی برای فاضلاب ها وجود ندارد آیا دفع ان به روش مناسبی صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      240 => 
      array (
        'question' => 'آیا دفع فاضلاب صنعتی در محل تولید در گودالهای جمع‌آوری و نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      241 => 
      array (
        'question' => 'آیا دفع فاضلاب صنعتی دور از زمین‌های کشاورزی صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      242 => 
      array (
        'question' => 'آیا گودال های مذکور در صورت وجود پوشش تحتانی مناسبی برای جلوگیری از آلودگی آب های زیر زمینی دارند و دور از مسیر رودخانه هدایت می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      243 => 
      array (
        'question' => 'در صورتی که فاضلاب صنعتی به سمت رودخانه هدایت می‌شود آیا از آب رودخانه برای مصارف آشامیدنی استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      244 => 
      array (
        'question' => 'میزان زباله های جامد تولیدی واحد مشخص می‌باشد؟ (مقدار ان برحسب Kg/d یا Ton/Year)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      245 => 
      array (
        'question' => 'دفع زباله های جامد به کدام روش های زیر صورت می‌گیرد؟ 1- جمع‌آوری شده از محل دور می‌شود، 2- سیستم تفع بهداشتی وجود دارد 3- سیستم جمع‌آوری و دفع خاصی وجود ندارد و در محیط رها می‌شوند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      246 => 
      array (
        'question' => 'در صورت وجود سیستم دفع بهداشتی )( آیا مجهز به سیستم جمع‌آوری شیرابه می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      247 => 
      array (
        'question' => 'در صورت وجود سیستم های دفع بهداشتی آیا مجهز به سیستم کنترل و جمع‌آوری گاز می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      248 => 
      array (
        'question' => 'در صورت وجود سیستم دفع بهداشتی )( این سیستم برای چه مدتی طراحی شده است و عمر فعلی آن چقدر است؟( بر حسب سال',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      249 => 
      array (
        'question' => 'نوع مواد شیمیایی دفعی را مشخص کنید؟ 1- اسید، 2- باز سایر مواد شیمیایی نظیر ممانعت کننده ها در برابر خوردگی و خنثی ها و...',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      250 => 
      array (
        'question' => 'آیا مقدار مواد دفعی واحد مشخص می‌باشد؟ (مقدار ان را مشخص کنید بر حسب)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      251 => 
      array (
        'question' => 'نحوه دفع مواد شیمیایی مذکور مشخص و بر اساس یکی از روش های زیر می‌باشد؟ · در گودالهایی دفن می‌شود. · آیا گودالهایی دفن می‌شود · آیا گودال ها پوشش مناسبی جهت جلوگیری از الودگی ابهای زیرزمینی دارد · در مخازنی ذخیره و از محل دور می‌شود · سایر روش ها',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      252 => 
      array (
        'question' => 'آیا روانسنجی دوره‌ای از کارکنان به عمل می آید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      253 => 
      array (
        'question' => 'آیا عوامل زیان اور محیط کار شناسایی شده‌اند و نقاط بحرانی ان را مشخص می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      254 => 
      array (
        'question' => 'آیا روش هایی برای پیشگیری از بروز استرسهای روانی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      255 => 
      array (
        'question' => 'آیا نظرات اصلاحی کارکنان استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      256 => 
      array (
        'question' => 'آیا کارکنان از محیط کار خود، ارتباط با همکاران و سایر موادریاضی هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      257 => 
      array (
        'question' => 'آیا برای اوقات فراغت کارکنان تدابیری اندیشیده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      258 => 
      array (
        'question' => 'آیا گرد و خاک در محیط کار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      259 => 
      array (
        'question' => 'آیا راه‌های کنترل گرد و غبار (نظیر جمع‌آوری ذرات تهویه، استفاده از سیکلونها و...) اعمال می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      260 => 
      array (
        'question' => 'آیا لوازم حفاظت فردی برای مقابله با گرد و غبار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      261 => 
      array (
        'question' => 'بیشتر بیماری های تولید شده مربوط به کدام یک از عوامل بیولوژیک می‌باشد؟ 1- انگل ها 2- ویروس ها 3- قارچ‌ها 4- باکتری ها 5- سایر موارد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      262 => 
      array (
        'question' => 'آیا بیماری شغلی ناشی از باکتری، ویروس‌ها و سایر عوامل بیولوژیک تاکنون وجود داشته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      263 => 
      array (
        'question' => 'آیا تدابیر برای از بین رفتن جانوران موذی (سم‌پاشی، تله‌گذاری و...) اندیشیده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      264 => 
      array (
        'question' => 'آیا مواد پرتوزا وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      265 => 
      array (
        'question' => 'آیا تعداد منابع پرتوزا زیاد می‌باشد؟ تعداد.....',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      266 => 
      array (
        'question' => 'آیا تاکنون اندازه گیری هایی در این زمینه انجام شده است؟ و آیا گزارش مربوطه موجود می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      267 => 
      array (
        'question' => 'آیا اندازه گیری در زمینه پرتوها به بوصرت دوره‌ای انجام می‌گیرد؟ تاریخ اخرین اندازه گیری...',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      268 => 
      array (
        'question' => 'آیا کارکنان اطلاعات کافی در زمینه خطرات کار با مواد پرتوزا را دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      269 => 
      array (
        'question' => 'آیا کارکنان مجهز به لوازم حفاظت فردی مناسب می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  32 => 
  array (
    'title' => 'ایمنی ساختمان',
    'category' => 'ایمنی ساختمان',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا برای هر کارگر حداقل 12 مترمکعب فضا در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا روغن و زوائد تراشکاری شده و گرد و خاک روی کف کارگاه ریخته‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا دیوارها و کف و سقف طوری طراحی شده که از رطوبت و گرما و سرما جلوگیری کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا کف کارگاه هموار و بدون حفره است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا کف کارگاه طوری طراحی شده که قابل شستشو است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا کف کارگاه موجب لغزیدن کارگران می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا محل‌هایی را که دارای دریچه هایی در کف است به‌وسیله درپوش هایی پوشیده شده است که کارگر به داخل آن سقوط نکند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا دستگیره پوشش دهانه ها به سمت بیرون قرار ندارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا در اطراف دهانه ها نرده که ارتفاع آن 90 سانتی‌متر است قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا حداقل عرض پلکان عمومی 120 است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا در سقف کارگاه حداقل ارتفاع 3 رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا در اطراف پلکان هایی که بیش از 4 پله دارند در طرف باز آن نرده محکم نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا در کارگاه‌ها به اندازه کافی در و پنجره برای ورود نور وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا درب‌های خروج اضطراری برای مواقع خطر در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا داربست ها زیر نظر فردی ذی‌صلاح نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا چرخ های داربست قفل شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا داربست توانایی نگه داشتن بار بیش از ظرفیت را تا چهار دقیقه دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا سکو ها به طور کامل از روبرو – عقب و کناره ها به‌وسیله دیوارها و الوارها پوشیده شده‌اند که شکاف های بزرگتر از 1 اینچ نداشته باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا الوارها بدون ترک – شکاف – گره و یا آسیب هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'داربست ها هم سطح (تراز) هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا برای تشخیص قطعات خورده شده و قفل های گم شده و زنجیر صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا تمام بست ها وگیره ها لازم برای قسمت‌های مختلف لوال ها را فراهم می‌نماید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا راه ایمنی برای بالا رفتن و پایین آمدن از داربست مثل نردبان وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'بدون بالا رفتن از مهار کننده های عرضی (باد بند چپ و راست)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا در جلوی داربست ارتفاعی کمتر از 14 in دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا داربست ارتفاعی کمتر از 125 فوت دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا مهار کننده های (X) در انتهای داربست نصب شده‌اند در 3 سمت افقی و 4 میله قائم.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا قوانین سختگیرانه در رابطه با آب و هوای محیط نظیر در طول طوفان، بارندگی، برف و شرایط بد آب و هوایی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا نسبت بلندی به عرض داربست 4 به 1 است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا تخته های پهن ساختار داربست را برای جلوگیری از افتادن آن‌ها در مقابل باد های قوی ایجاد می‌نماید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'هرجا که اشخاصی بر روی داربست کار می‌کند تورهای محافظی با قطر منفذ inch 2.1 بین قسمت گاردریل تا بخش پایین قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'برچسب های مشخص کننده ظرفیت داربست بر روی آن در دسترس است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'وقتی که کارگران به‌طور مطلق در روی داربست کار می‌کنند طناب های نجات به‌طور محکم به تکیه گاه بالای سر به غیر از داربست متصل هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا نرده میانی و محل های کار با هم برابرند (در یک راستا هستند)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا گاردیل ها 38 اینچی، بلندی دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا نردبان متناسب با نوع کار استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا انتهای نردبان همیشه یک متر بالاتر از سطح دسترسی قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا نردبان از بالا و پایین به صورت مناسب مهار شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا فاصله 4 به 1 ارتفاع و فاصله پایه نردبان تا دیوار رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا نردبان به صورت مناسب و ایمن نگهداری، انبار و حمل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا نردبان های چوبی سالم، بدون پوسیدگی، ترک خوردگی و رنگ شدگی می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا فاصله 30 سانتی‌متری بین پله‌ها رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا نردبان قدرت تحمل وزن شخص و بار همراه را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا بر روی نردبان بیش از یک نفر تردد دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا در نزدیکی خطوط و کابل‌های برق از نردبان چوبی مناسب استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا پایه های نردبان روی سطح محکم و تراز می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا هنگام کار در ارتفاع روی سکوی ناایمن از کمربند ایمنی استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا کمربند از نظر کیفی و استاندارد مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا در محلی که خطر سقوط اشیاء وجود دارد محوطه زیرین محصور شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا در محل های کار در ارتفاع از تابلوها و علائم هشداردهنده مناسب استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا در صورت استفاده از داربست، راه دسترسی آن و تخته ریزی و سایر الزامات مطابق با دستورالعمل داربست رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا خروجی های اضطراری مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'آیا خروجی های اضطراری عاری از هرگونه مانع می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا روشنایی محیط کار مناسب است؟ چنانچه کار در شب باشد تمهیدات لازم پیش بینی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'آیا در طبقات و ارتفاع چیدمان تجهیزات و ابزار به‌طور ایمن انجام شده و جهت جلوگیری از سقوط مهار شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'آیا گروه های اجرایی و پیمانکاران پس از اتمام کار محیط فعالیت خود را مرتب و ایمن کرده اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'آیا چیدمان کانکس ها در محوطه سایت به‌طور صحیح انجام شده و تردد به راحتی انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'آیا ظروف حاوی مواد خطرناک دارای برچسب می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'آیا محل قرار دادن تجهیزات در سایت محصور شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'آیا مناطقی که مشکل تردد دارند، محصور شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'آیا جداسازی مواد زائد به‌موقع در ظروف مختلف انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'آیا ظروف دفع مواد زائد به‌موقع تخلیه می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'آیا برای دفع مواد زائد سطل زباله مناسب موجود است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'آیا تمام پرتگاه هایی که ارتفاع آن‌ها بیش از 2 متر می‌باشد به طریق مناسب در مقابل سقوط افراد و مصالح محافظت می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'آیا حداقل ارتفاع نرده محافظ (Guard Rail) نصب شده در اطراف پشت بام، بازشوها، لبه های بالکن، بازشوهای آسانسور و بازشوهایی که با مصالح غیر مقاوم مثل شیشه، نایلون و برزنت پوشانده شده است، 90 سانتی‌متر می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'آیا فاصله حداقل 470میلی‌متر بین اعضای افقی نرده محافظ رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'آیا قرنیزه چوبی به پنهای 150 میلی‌متر در قسمت اتصال نرده محفظ به لبه پرتگاه نصب گردیده است؟ (به منظور جلوگیری از سقوط اشیاء از لبه پرتگاه به پایین)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'آیا در مواقعی که امکان نصب نرده محافظ )( به صورت قائم نمی‌باشد، از نرده‌های محافظتی فلزی یا بتنی قابل حمل و نقل استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'آیا تعداد پرسنل استفاده کننده از سکو در آن واحد در حد مجاز می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'آیا زمین محل استقرار سکو به اندازه کافی سخت می‌باشد و آیا پایه های سکوی موقت در زمین فرو می رود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'آیا محل استقرار سکو به اندازه کافی مسطح می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'آیا دستورالعمل سازنده سکو در مورد سکوی موقت کار رعایت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'آیا شخص (اشخاص(استفاده کننده از سکو از لحاظ فیزیکی در شرایط مناسبی قرار دارند؟)توانایی انجام کار در ارتفاع را دارند)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'آیا در محل‌هایی که امکان نصب حفاظ نمی‌باشد، کارگران از کمربند ایمنی در مقابل سقوط استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      74 => 
      array (
        'question' => 'آیا در محل‌هایی که امکان سقوط اشیاء به پایین وجود دارد؟ تور محافظ (برزنت یا گونی) در اطراف پرتگاه نصب می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      75 => 
      array (
        'question' => 'آیا تور محافظ، مقاومت کافی به منظور جلوگیری از سقوط افراد و مصالح مورد استفاده در کارگاه به پایین را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      76 => 
      array (
        'question' => 'آیا علائم هشداردهنده نزدیک تمام بازشوها نصب گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  33 => 
  array (
    'title' => 'ایمنی و حفاظت در حین اجرا',
    'category' => 'ایمنی عملیات اجرایی',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'نقشه های اجرایی بررسی و روشن اجرا مشخص و به ناظر اعلام شده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'برنامه زمان بندی کارهای اجرایی تهیه و کتبا به مهندس ناظر اعلام گردیده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'بیمه مسئولیت مدنی و شخص ثالث کارگاه برقرار گردیده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'اخذ تایید مرجع رسمی ساختمان و سایر مراجع مربوطه در رابطه با موارد زیر اخذ گردیده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'حریم خطوط برق عبوری از مجاور ملک مورد بررسی قرار گرفته و با نظر مراجع ذی‌ربط اقدامات احتیاطی لازم به عمل آمده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'کارگران و سایر عوامل اجرایی در عملیات ساختمانی دارای پروانه اشتغال یا مهارت فنی و یا گواهی ویژه در حدود صلاحیت مربوطه می‌باشند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا برای تامین سلامت و بهداشت کارگران وسایل و تجهیزات لازم در اختیار انان قرار داده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا بر کاربرد وسایل و تجهیزات و رعایت مقررات مربوطه نظارت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'در صورتی که کارگاه دارای شرایط لازم می‌باشد آیا مسئول ایمنی تعیین و معرفی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا حادثه منجر به خسارات، جراحت یا فوت به وقوع پیوسته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا کارگران در خارج از ساعت عادی به‌کار مشغولند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا در صورت انجام کار در ساعات غیر عادی روشنایی کافی و امکان برقراری تماس و خدمات مورد نیاز کارگران فراهم می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'مهندس ناظر موارد خلاف را به مجری و مرجع رسمی ساختمان گزارش داده شده است (12-5-8)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'به منظور نظارت برعملکرد مجری و مهندس ناظر و کنترل گزارش مربوطه نماینده فنی شهرداری مراجعه نموده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا نماینده سازمان نظام مهندسی به منظور نظارت بر عملکرد مجری و مهندس ناظر مراجعه نموده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'کارگاه ساختمانی به طور مطمئن و ایمن محصور و در اطراف آن تابلوها و علائم هشداردهنده که در شب و روز قابل رویت باشد نصب گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'اقدامات لازم در رابط با مسدود و محدود نمودن پیاده روها و سایر معابر و فضاهای عمومی به عمل آمده است (12-2-2-1)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'در صورتی که در اثر عملیات ساختمانی خطری متوجه رفت و آمد عابران و یا خودروها می‌باشد آیا اقدامات لازم و ضروری برای رفع خطر به عمل آمده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'با توجه به فاصله بنای در دست تخریب، احداث، تعمیر و بازسازی از معابر عمومی راهرو سرپوشیده احداث گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'در صورت احداث، چک‌لیست مربوطه تکمیل گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'سازه های موقت از قبیل حصار حفاظتی کارگاه، سرپوش حفاظتی، داربست و... از محدوده بنای تخریب و یا ساخ بیرون زدگی دارد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'در صورت بیرون زدگی رعایت ضوابط و مقررات مربوطه شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'کلیه قسمت‌های مختلف کارگاه ساختمانی و محوطه اطراف آن که احتمال خطر سقوط افراد را در بر دارد با پوشش ها و نرده‌های حفاظتی محکم و مناسب محافظت گردیده است (12-3-1)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'قسمت‌های مختلف کارگاه ساختمانی و محوطه اطراف آن که احتمال خطر سقوط افراد وجود دارد آیا حسب مورد استفاده از شبرنگ ها، چراغ ها و تابلوهای هشداردهنده مناسب و قابل رویت حسب مورد، در طول روز و شب به طور موقت محافظت گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'در قسمت‌های مختلف کارگاه ساختمانی و محوطه اطراف آن احتمال سقوط و ریزش ابزار کار و یا مصالح ساختمانی وجود دارد پاخورهای مناسب نصب گردیده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'برای جلوگیری از بروز خطرهای که نمی‌توان به طرق دیگر ایمنی را تامین نمود و همچنین جلوگیری از ورود افراد متفرقه به محوطه محصور شده از منطقه خطر و نیز برای حفظ علائم نصب شده مراقب در تمام طول روز و شب گمارده شده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'در محل‌هایی که خطر اتش سوزی وجود دارد کشیدن سیگار و روشن کردن آتش روباز به‌وسیله تابلوهای هشداردهنده ممنوع شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا در نگهداری موقت مواد قابل استعمال (از قبیل تینر، چسب، کاغذ دیواری، گونی و...) مقررات حفاظت ساختمان‌ها در برابر حریق رعایت گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا ضایعات مصالح قابل احتراق در جای مناسب جمع‌آوری و روزانه از محل کار خارج و به محل های مجاز حمل می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'در جاهایی که بخار مایعات قابل اشتعال وجود دارد استفاده از وسایل مولد جرقه یا شعله منع شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'در سوخت گیری ماشین‌آلات و همچنین در نگهداری مایعات قابل اشتعال و به خصوص سریع اشتعال موارد ایمنی رعایت می‌گردد(12-2-4-2)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا پخت قیر و آسفالت و همچنین حمل و بخش آن‌ها با رعایت موارد ایمنی انجام می‌شود؟ (12-2-4-4)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'دیگ های بخار و آب گرم اعم از موقت و یا دائم توسط ذی‌صلاح و با رعایت مقررات بحث مربوطه نصب و راه‌اندازی شده است (12-2-4-5)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'هنگام برشکاری و جوشکاری با گاز و برق موارد ایمنی رعایت می‌گردد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'مراقبت و نگهداری از سیلندرهای تحت فشار و همچنین در استفاده از آن‌ها مقررات ایمنی رعایت شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'قبل از هر گونه گودبرداری و حفاری در مورد وجود و عدم وجود کابل‌های زیرزمینی اطمینان حاصل کنید',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'سیم کشی های موقت و دلیم و نصب تجهیزات برقی با رعایت مقررات مربوطه صورت گرفته است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'وسایل اطفای حریق مناسب و کافی در قسمت‌های مختلف کارگاه ساختمانی آماده استفاده و در دسترس می‌باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'کمک‌های اولیه متناسب با نوع کار و تعداد کارگران تهیه و در جای مناسب نگهداری و در دسترس می‌باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'افراد در رابطه با استفاده از وسایل کمک‌های اولیه آموزش لازم را دیده اند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'برای انتقال فوری کارگران آسیب‌دیده به مراکز بهداشتی، تمهیدات لازم به عمل آمده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'وسایل ارتباطی برای تماس فوری با مراکز اورژانس و آتش‌نشانی ضروری می‌باشد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'به کارگرانی که به طور مستمر با گچ و سیمان و سایر موارد و مصالح آالینده تماس مستقیم دارند شیر داده شود',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آب آشامیدنی سالم و کافی در اختیار کارگران قرار داده شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'بر روی مخازن و شیرهای برداشت آب آشامیدنی تابلوی آب غیرقابل شرب نصب شده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'به ازای هر 25 کارگر حداقل یک چشمه توالت و دستشویی بهداشتی و محصور دارای آب و وسایل کافی شستشو وجود دارد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'فضای سرپوشیده کافی برای اقامت و استراحت موقت کارگرانی که به دلیل شرایط کار مجبور به اقامت در کارگاه هستند فراهم شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'نور و روشنایی طبیعی و مصنوعی کافی م تناسب ثابت و قابل حمل در محل های کار، عبور و مرور، غذاخوری، اقامت و استراحت کارگران فراهم شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'محل مناسب کافی برای اقامت و استراحت موقت کارگرانی که به دلیل شرایط کار مجبور به اقامت در کارگاه هستند فراهم شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا محل کار، اقامت، استراحت و غذا خوری کارگران، از هوای کافی و سالم به طور طبیعی و یا تهویه مصنوعی برخوردار می‌باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'کارگران، افراد خویش فرما و سایر کسانی که در کارگاه ساختمانی فعالیت و یا به دلیلی وارد می‌شوند متناسب با نوع کار از وسایل حفاظت فردی استفاده می‌کنند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'وسایل حفاظت فردی از نظر کیفیت مواد و مشخصات فنی از نوع استاندارد می‌باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'وسایل حفاظت فردی قبل از اینکه در اختیار کارگران قرار گیرند توسط اشخاص ذی‌صلاح کنترل می‌شوند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'در تهیه و کاربرد وسایل حفاظت فردی ضوابط مندرج در ایین نامه وسایل حفاظت افرادی لحاظ گردیده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'در صورتی که احتمال وارد امدن صدماتی به سر افراد در اثر سقوط فرد از ارتفاع یا سقوط، تجهیزات و مصالح و یا برخورد موانع وجود دارد از کلاه ایمنی استاندارد استفاده می‌شود',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'برای انجام دادم کار در ارتفاع که امکان تعبیه سازی حفاظتی برای جلوگیری از سقوط کارگران وجود ندارد از کمربند ایمنی و طناب مهار از نوع استاندارد استفاده می‌شود.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'قبل از هر بار استفاده از کمذبند ایمنی و طناب مهار کلیه قسمت ها و اجزای آن‌ها مورد بازدید و کنترل شخص ذی‌صلاح قرار می‌گیرد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'کارگران مقنی که در عمق چاه کار می‌کنند از کمربند ایمنی و طناب نجات استفاده می‌کند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'هنگام جوشکاری، برشکاری، آهنگری، مامسه پاشی، بتن پاشی و نظایر آن از عینک و نقاب حفاظتی استاندارد مناسب با نوع کار استفاده می‌شود.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'در صورتی که به لحاظ فنی امکان تهویه محیط آلوده به گردو غبار، گازها و بخارهای شیمیایی و زیان آور وجود ندارد آیا کارگران از ماسک تنفسی استاندارد مناسب استفاده می‌کنند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'کارگرانی که هنگام کار پایشان در معرض خطر برخورد با اجسام داغ و برنده و یا سقوط اجسام و همچنین خطر برق گرفتگی قرار دارند از کفش و پوتین استاندارد متناسب با نوع کار و خطرهای مربوطه استفاده می‌کنند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'کارگران برق کار و همچنین کارگرانی که به اشیا داغ و برنده و همچنین مواد خورنده و تحریک کننده پوست سر و کار دارند از دستکش حفاظتی استاندارد متناسب با نوع کار و خطرهای مربوطه استفاده می‌کنند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'کارگران در محل های کاراز لباس تمیز و متناسب با نوع کار و خطرهایی که کارگر با آن مواجه است استفاده می‌کنند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'برای جلوگیری از سقوط افراد در محل‌هایی که ارتفاع سقوط بیش از 120 سانتی‌متر است نرده حفاظتی موقت نصب گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'در صورت نصب نرده حفاظتی موقت ارتفاع آن از کف طبقه بین 9 تا 110 سانتی‌متر می‌باشد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'نرده حفاظتی موقت در فاصله هر 2 متر دارای پایه عمودی می‌باشد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'نرده حفاظتی موقت در مقابل نیروهای افقی و ضربه وارده در تمام جهات مقاوم است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'در صورتی که نرده حفاظتی موقت در معرض برخورد با وسایل نقلیه و وسایل متحرک می‌باشد آیا در مقابل نیرو و ضربه وارد مقاوم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'برای جلوگیری از لغزش و ریزش مصالح و ابزار کار در طرف باز سکوهای کار، پلکان‌ها، سطوح شیب‌دار و سایر محل‌های مورد نیاز، پاخور چوبی یا فلزی نصب گردیده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'در صورت پاخور چوبی ارتفاع آن 15 سانتی‌متر و ضخامت آن 5.3 سانتی‌متر می‌باشد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'برای جلوگیری از خطرهای ناشی از پرتاب شدن مصالح، وسایل و تجهیزات ساختمانی راهرو پوشیده موقت در پیاده روها و یا سایر معابر عمومی ساخته شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'ارتفاع راهرو سرپوشیده حداقل 5.2 متر عرض آن حداقل 5.1 متر و یا عرض پیاده روی موجود می‌باشد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'راهرو سرپوشیده موقت فاقد هرگونه مانع و دارای نور کافی در تمام اوقات می‌باشد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'مقاومت و استحکام سقف، پایه ها و سایر اجزاء راهرو و سرپوشیده در مقابل هرگونه ریزش و سقوط احتمالی مصالح و ابزار به تایید شخص ذی‌صلاح و مراجع و مراجع مربوطه رسیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      74 => 
      array (
        'question' => 'در صورت استفاده از تخته برای پوشش سقف راهرو و حداقل ضخامت تخته ها 5 سانتی‌متر می‌باشد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      75 => 
      array (
        'question' => 'از ریزش هر گونه مواد و مصالح، آب و ضایعاتاز سقف و دیواره بیرونی راهرو سرپوشیده موقت جلوگیری شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      76 => 
      array (
        'question' => 'اطراف راهرو سرپوشیده موقت که در مجاورت کارگه ساختمانی قرار دارد با رعایت مقررات مربوطه حفاظت شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      77 => 
      array (
        'question' => 'برای جلوگیری از سقوط اشیاء و ریزش مصالح و یا ابزار کار در دیواره اطراف بنای در حال احداث سرپوش حفاظتی ایجاد گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      78 => 
      array (
        'question' => 'سقف و سازنده نگهدارنده سرپوش حفاظتی دارای مقاومت کافی در مقابل نیروهای وارده می‌باشد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      79 => 
      array (
        'question' => 'دهانه های موقت باز که احتمال سقوط افراد را دارد به نحوی مناسبی پوشانیده شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      80 => 
      array (
        'question' => 'دهانه های باز با ابعاد کمتر از 45 سانتی‌متر یا تخته چوبی به ضخامت حداقل 5.2 سانتی‌متر و بیشتر از 45 سانتی‌متر با تخته های چوبی با ضخامت حداقل 5 سانتی‌متر پوشانیده شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      81 => 
      array (
        'question' => 'برای جلوگری از ریزش مصالح و ابزار و همچنین حفظ محیط زیست جداره خارجی بنای در دست ساخت با استفاده از پرده های بتنی یا پلاستیکی مقاوم پوشانیده شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      82 => 
      array (
        'question' => 'تخته های چوبی مورد استفاده در سقف های موقت که به صورت سکوهای کار مورد استفاده قرار می‌گیرند دارای حداقل 5 سانتی‌متر ضخامت 25 سانتی‌متر عرض 250 سانتی‌متر طول می‌باشند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      83 => 
      array (
        'question' => 'در مواردی که نصب سکوهای کار و نزده های حفاظتی در ارتفاع بیشاز 5.3 متر امکان پذیر نباشد برای جلوگیری از سقوط افراداز تورهای ایمنی استفاده شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      84 => 
      array (
        'question' => 'ارتفاعایمنی در جایی نصب شده است که ارتفاع سقوط احتمالی کارگر کمتر از 6 متر و امکان اصابت اجسام وجود نداشته باشد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      85 => 
      array (
        'question' => 'ماشین‌آلات و تجهیزات ساختمانی در فاصله کمتر از 15 متر از تقاطع متوقف نشده و مانع از دیده شدن علائم راهنمایی و رانندگی و یا محدودیتی در انجام وظایف سازمان آتش‌نشانی و سایر واحدهای خدماتی نشده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      86 => 
      array (
        'question' => 'کلیه رانندگان و متصدیان ماشین‌آلات و تجهیزات ساختمانی دارای پروانه فنی یا گواهینامه ویژه از مراجع ذی‌ربط می‌باشد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      87 => 
      array (
        'question' => 'نصب و راه‌اندازی، تعمیر، آزمایش و تنظیم ماشین‌آلات و تجهیزات ساختمانی توسط اشخاص ذی‌صلاح انجام شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      88 => 
      array (
        'question' => 'دستگاه مولد برق و تهیه هوای فشرده به محافظ تعدیل صدا و دود مجهز شده‌اند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      89 => 
      array (
        'question' => 'ماشین‌آلات و تجهیزات ساختمانی در نزدیکی خطوط فشار قوی و یا در نقاطی که خطر لغزش دستگاه و ریزش دیوار محلی گودبرداری وجود دارد پارک نشده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      90 => 
      array (
        'question' => 'ماشین‌آلات و تجهیزات ساختمانی با رعایت آیین‌نامه های حفاظتی مربوطه استفاده قرار گرفته است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      91 => 
      array (
        'question' => 'کلیه قسمت‌های تشکیل دهنده دستگاه ها و وسایل بالاتر و اجزاء آن‌ها با رعایت اصول و قواعد فنی و دستورالعمل ها و توصیه‌های سازندگان آن‌ها توسط اشخاص دیصالح نصب و آماده به‌کار شده‌اند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      92 => 
      array (
        'question' => 'کابین و محل کار متصدی دستگاه ها و وسایل بالاتر دارای سقف محکم و مطمئن با میدان دید کافی برای متصدی و هم چین ارتباط صوتی با خارج کابین و وسایل اطفاء حریق می‌باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      93 => 
      array (
        'question' => 'استحکام و مقاومت زمین محل استقرار جرثقیل های ثابت و متحرک قبل از استقرار و شروع عملیات نصب و مونتاژ مورد بررسی قرار گرفته است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      94 => 
      array (
        'question' => 'قسمت‌های مختلف دستگاه ها و وسایل بالابر طبق مقرات مربوطه مورد بازدیدهای دوره‌ای با معاینه فنی و آزمایش قرار می‌گیرند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      95 => 
      array (
        'question' => 'رانندگان یا متصدیان دستگاه ها و وسایل بالابر عالوه بر پروانه مهارت و یا گواهینامه ویژه از مراجع مربوطه از لحاظ جسمی و روانی در سلامت کامل بوده و دارا گواهینامه بهداشتی از مراجع ذی‌ربط می‌باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      96 => 
      array (
        'question' => 'ارتفاع تاورکرین در هوای مناسب و با رعایت ایمنی کامل و بدون توقف تا ارتفاع مورد نظر افزایش می یابد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      97 => 
      array (
        'question' => 'قبل از شروع کار روزانه، ترمز[ جعبه فرمان، لاستیک، چراغ و سایر قسمت‌های عمل کننده وسایل موتوری نقل و انتقال و گودبرداری و جابجایی مصالح مورد بازدید و بررسی قرار می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      98 => 
      array (
        'question' => 'راه‌های ورود و خروج مطمئن و بی خطر و مناسب وسایل موتوری گودبرداری و جابجایی مصالح ایجاد گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      99 => 
      array (
        'question' => 'بارگیری وسایل موتوری نقل و انتقال و گودبرداری و جابجایی مصالح با رعایت ظرفیت مجاز آن‌ها صورت می‌گیرد.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      100 => 
      array (
        'question' => 'کلیه قسمت‌های داربست توسط شخص ذی‌صلاحطوری طراحی، ساخته و آماده به‌کار شده است که داربست در مقابل چهار برابر بار وارده ایستایی لازم را داشته باشد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      101 => 
      array (
        'question' => 'جایگاه داربست به عرض حداقل 50 سانتی‌متر و ضخامت حداقل 5 سانتی‌متر و همچنین فاصله تکیه گاه های تخته ها حداکثر 250 سانتی‌متر ساخته شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      102 => 
      array (
        'question' => 'کلیه عملیات مربوط به نصب، تعمیر و یا پیاده کردن داربست توسط اشخاص ذی‌صلاح انجام می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      103 => 
      array (
        'question' => 'برای تامین ایستایی و جلوگیری از واژگون شدن داربست مقررات مربوطه رعایت شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      104 => 
      array (
        'question' => 'داربست با توجه به مقررات مربوطه در موارد تعیین شده توسط اشخاص ذی‌صلاح بازدید، کنترل و مورد تایید قرار می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      105 => 
      array (
        'question' => 'برای جلوگیری از خطر سقوط کارگران و همچنین پیشگیری از افتادن مصالح و ابزار کار از روی کف جایگاه، طرف باز جایگاه با نرده حفاظتی و پاخورهای مناسب محافظت شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      106 => 
      array (
        'question' => 'در موقع استفاده از نردبان پایه ها و تکییه گاه ها در جایی ثابت قرار گرفته تا امکان لغزش وجود نداشته باشد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      107 => 
      array (
        'question' => 'آیا کارگران در هنگام بالا رفتن و یا پایین امدن از نردبان از حمل با با دست منع شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      108 => 
      array (
        'question' => 'آیا طول نردبان حداقل یک متر از کفی که برای رسیدن به آن مورد استفاده قرار می‌گیرد بلندتر و این قسمت اضافی فاقد پله می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      109 => 
      array (
        'question' => 'در نردبان های ثابت حداکثر در هر 9 متر یک پادگرد تعبیه شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      110 => 
      array (
        'question' => 'نردبان دو طرفه مجهز به قید یا ضامن می‌باشد تا از به هم خوردن شیب ان جلوگیری کند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      111 => 
      array (
        'question' => 'برای حمل مصالح رفت و آمد کارگران و دسترسی به طبقات حداقل یک راه پله موقت نصب گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      112 => 
      array (
        'question' => 'راه پله‌های موقت با طول و حداقل یک متر، عرض حداقل 25 سانتی‌متر و ارتفاع حداکثر 22 سانتی‌متر و همچنین اختالف سطح بین دو پاگرد حداکثر 4 متر ساخته شده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      113 => 
      array (
        'question' => 'پله و کلیه اجزا راه پله‌های موقت و اجد استحکام و مقاومت کافی بوده و دارای ایمنی بارگزاری حداقل 5.2 نسبت حداکثر بارهای وارده می‌باشند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      114 => 
      array (
        'question' => 'راه‌های شیب دار و معابر واجد استحکام و مقاومت کافی و دارای ضریب ایمنی بارگزاری حداقل 5.2 سانتی‌متر به حداکثر بارهای وارده می‌باشند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      115 => 
      array (
        'question' => 'راه‌های شیب دار و معابر مخصوص عبور افراد دارای حداقل 60 سانتی‌متر می‌باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      116 => 
      array (
        'question' => 'راه‌های شیبدار و معابر مخصوص حمل و جابجایی وسایل سنگین یا وسایل نقلیه کمتر از 350 سانتی‌متر می‌باشند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      117 => 
      array (
        'question' => 'مجوز لازم از مرجع رسمی ساختمان گرفته شده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      118 => 
      array (
        'question' => 'جریان آب و برق و گاز و غیره با اطلاع و همکاری موسسات ذی‌ربط قطع و یا سالم سازی، محدود و نگهداری شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      119 => 
      array (
        'question' => 'زمان و مدت قطع سرویس های فوق و همچنین شروع عملیات تخریب یک هفته قبل از تخریب به اطلاع ساکنین ساختمان‌های مجاور رسیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      120 => 
      array (
        'question' => 'پیادهروها و معابر عمومی مجاور بنای مورد تخریب محافظت گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      121 => 
      array (
        'question' => 'اثرات ناشی از تخریب بنا در پایداری سازه های همجوار توسط شخص ذی‌صلاح بررسی و تدابیر لازم در جهت پایداری آن‌ها به عمل آمده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      122 => 
      array (
        'question' => 'هیچ یک از اجزای بنای مورد تخریب و تجهیزات مورد استفاده از قبیل چوب بست، پله‌های موقت، سقف و سایر اجزای راهروهای سرپوشیده بیش از دو سوم مقاومت خود بارگزاری نشده‌اند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      123 => 
      array (
        'question' => 'انباشتن مصالح و ضایعات جدا شده از ساختمان مورد تخریب در پیاده رو و دیگر معابر و فضاهای عمومی با کیب مجوز از مرجع رسمی ساختمان می‌باشد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      124 => 
      array (
        'question' => 'در تخریب سقف هایی که از بتن پیش یا پی تنیده تشکیل یافته اند توجه کافی به انرژی ذخیره شده در بتن و خطرهای ناشی از آن شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      125 => 
      array (
        'question' => 'تخریب دیوارهایی که برای نگهداری خاک زمین یا ساختمان مجاور ساخته شده‌اند، پس از اجرای سازه نگهبان انجام شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      126 => 
      array (
        'question' => 'زمین محل عملیات خاکی از نظر استحکام و جنس خاک و همچنین پایداری ابنیه مجاور توسط شخص ذی‌صلاح مورد بررسی قرار گرفته است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      127 => 
      array (
        'question' => 'نقشه گودبرداری، پایدارسازی جداره های گود و همچنین برنامه گودبرداری به تایید مرجع رسمی ساختمان رسیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      128 => 
      array (
        'question' => 'موقعیت تاسیسات زیرزمینی از قبیل کانال های فاضلاب، قنوات قدیمی، کابلهای برق و تلفن، لوله کشی آب و گاز و غیره مورد بررسی',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      129 => 
      array (
        'question' => 'در صورت قرار گرفتن محل گودبرداری در نزدیکی و یا مجاورت یکی از ایستگاه های خدمات عمومی از قبیل آتش‌نشانی، اورژانس و غیره و یا در مسیرهای اتومبیل های مربوطه، مراتب قبال به اطلاع مسئول ذی‌ربط رسیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      130 => 
      array (
        'question' => 'در گودبرداری های با عمق بیش از 120 سانتی‌متر برای جلوگیری از لغزش دیواره های گود اقدامات حفاظتی لازم به عمل آمده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      131 => 
      array (
        'question' => 'گودبرداری مجاور معابر و فضاهای عمومی با رعایت حداقل 150 سانتی‌متر فاصله تا لبه گود و با نصب علائم هشداردهنده صورت می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      132 => 
      array (
        'question' => 'فاصله تعیین شده استقرار ماشین‌آلات و وسایل مکانیکی و خاک های حاصل از گودبرداری از لبه گود رعایت گردیده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      133 => 
      array (
        'question' => 'قبل از حفاری چاه ها و مجاری آب و فاضلاب بررسی های لازم در خصوص کیفیت موانعی از قبیل قنات های قدیمی، فاضلاب ها، جنس زمین و... به عمل آمده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      134 => 
      array (
        'question' => 'در عملیات حفاری چاه ها و مجاری آب و فاضلاب تهویه کافی فراهم گردیده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      135 => 
      array (
        'question' => 'کلیه افرادی که با عملیات حفاری و مجاری آب و فاضلاب سروکار دارند متناسب با نوع کار از وسایل حفاظت فردی استفاده می‌کنند',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      136 => 
      array (
        'question' => 'حفاری چاه ها و مجاری آب و فاضلاب با رعایت ضوابط مندرج در آیین‌نامه و مقررات حفاظتی چاه های دستی صورت گرفته است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      137 => 
      array (
        'question' => 'ساخت و نصب اسکلت فلزی توسط اشخاص ذی‌صلاح انجام می‌شود',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      138 => 
      array (
        'question' => 'موقع نصب و برپایی اعضای فلزی سازه از قبیل ستونها، تیرها و خرپاها حداقل نیمی از پیچ و مهره ها بسته شده یا حداقل نیمیی از جوشکاری لازم انجام گرفته و سپس جدا کردن و نگهداری ها و رها کردن آن‌ها صورت می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      139 => 
      array (
        'question' => 'قبل از نصب هر عضو سازه فلزی بر روی سازه دیگر، عضو زیرین صد در صد پیچ و مهره و یا جوشکاری شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      140 => 
      array (
        'question' => 'موقع نصب ستون ها، برای جلوگیری از سقوط ستونهای نصب شده، این ستونها به وسیله تیرهای واسط یا سایر ستونها مهار شده و یا',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      141 => 
      array (
        'question' => 'در شرایط نامساعد جوی (باد و طوفان) و یا ناکافی بودن روشنایی و محدود بودن میدان دید از ادامه کار روی اسکلت فلزی جلوگیری شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      142 => 
      array (
        'question' => 'در عملیات برپا نبودن و نصب اعضای فلزی سازه، وسایل حفاظت فردی مورد استفاده قرار می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      143 => 
      array (
        'question' => 'تخلیه آهن االت از تریلر، کامیون و کامیونت با استفاده از وسایل بالابر و جرثقیل صورت می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      144 => 
      array (
        'question' => 'اجرای سازه های بتنی از قبیل قالب بندی، آرماتوربندی، ساختن و ریختن بتن توسط اشخاص ذی‌صلاح صورت می‌گیرد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      145 => 
      array (
        'question' => 'کلیه اجزای قالبها توسط شخص ذی‌صلاح و با ضریب اطمینان حداقل 5.2 نسبت به بارهای وارده طراحی و ساخته شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      146 => 
      array (
        'question' => 'قبل از برداشتن قالب بتن از گرفتن و استحکام کافی بتن اطمینان حاصل گردیده است.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      147 => 
      array (
        'question' => 'کارگرانی که در امر ساختن و حمل بتن اشتغال دارند از وسایل حفاظت فردی متناسب با نوع کار خود استفاده می‌کنند.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      148 => 
      array (
        'question' => 'میخ های موجود در تخته ها و سایر اجزای قالب های چوبی با فاصله بعد از باز شدن قالب به داخل چوب فرو، کوبیده یا کشیده شده است',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  34 => 
  array (
    'title' => 'بازدید از واحد آهنگری',
    'category' => 'بازدید واحدها',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا راه پله دارای پلتفرم سالم و حفاظ مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا کابل برق دستگاه حدیده سالم و یکپارچه است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا دوشاخه برق دستگاه حدیده سالم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا کابل برق دریل هیلتی سالم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا دوشاخه برق و بدنه (پوسته) دریل هیلتی سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا کلید روشن و خاموش دستگاه‌های برقی دستی (دریلها، سنگ سمباده، سنگ فرز و......) سالم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا پله‌ها ضامن ها، کفشکها، بدنه و..... نردبان تاشو سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا کابلهای برق دستگاه ها اره آتشین، نقطه جوش، گیوتین و دستگاه نورد سالم و یکپارچه می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا سوکت برق و تابلوی برق دستگاه گیوتین سالم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا کلید پدالی دستگاه گیوتین سالم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا جعبه تسمه و تیغه اره آتشی حفاظ دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا چرخ دنده و چرخ تسمه دستگاه نورد دارای حفاظ مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا جعبه فیوز دستگاه اره آتش دارای درب بوده و سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا کابل برق و دوشاخه آبسردکن سالم می‌باشد؟ آیا آبسردکن به سیستم ارت متصل است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا کلیه ابزار و وسایل برقی با دوشاخه به پریز نصب می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا کابل برق و دوشاخه دستگاه تهویه سیار سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا کارگاه آهنگری از روشنایی مناسبی برخوردار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا پرسنل جوشکار از ماسک حفاظتی مناسب صورت در برابر پرتوها، اشعه متصاعد شده از فرایند جوشکاری استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا پرسنل جوشکار دارای کارت ویژه جوشکاری، گواهینامه می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا پرسنل واحد آهنگری آموزش‌های ایمنی با توجه به نوع فعالیتشان گذرانیده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  35 => 
  array (
    'title' => 'بازدید از واحد تعمیرگاه',
    'category' => 'بازدید واحدها',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا نرده‌ها ی محافظ پلتفرم موجود در کارگاه سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا کلید روشن و خاموش دستگاه‌های برقی دستی (دریل ها، سنگ فرز و سنگ دوقلو و غیره) سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا پله‌ها و دیواره چاله سرویس ها سالم و فاقد ترک، شکستگی، ریختگی و غیره می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا پله‌های چاله سرویس تمیز، خشک و بدون لغزندگی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا شیشه های نورگیر سالمند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا پمپ کارواش فاقد نشتی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا شیلنگ آب کارواش سالم و یکپارچه و دارای حفاظ مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا کابل برق پمپ کارواش سالم و یکپارچه و دارای حفاظ مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا کابل برق دستگاه شارژ سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا کلید و پریز پمپ کارواش سالم و به دیوار فیکس شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا آمپرمترها و سایر نمایشگرهای دستگاه شارژ سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا دوشاخه برق دستگاه آپارات سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا شیلنگ هوا سالم و یکپارچه و فاقد نشتی و با بست مناسب به شیر هوا وصل شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا بشکه‌های حاوی روغن بر روی چهارپایه مناسب به صورت اصولی مهار شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا بشکه‌های حاوی روغن بر روی چهارپایه مناسب به صورت اصولی مهار شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا چرخ های جک‌های سوسماری سالمند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا اهرم خالص کن جک‌های سوسماری سالمند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا دستگیره جک‌های سوسماری سالمند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا شیلنگ‌های گریس پمپ بادی سالم و با بست مناسب وصل گردیده اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا نازل گریس خور و دستگیره پمپ بادی سالم و به خوبی بسته شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا جک‌های سوسماری روغن ریزی ندارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا درب گریس پمپ بادی سالم و به خوبی بسته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا فشار شکن نصب شده بر روی شیر هوا سالم و برچسب کالیبره بر روی آن الصاق شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا شیلنگ اجاق گاز سالم و دو سر آن با بست مناسب وصل شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا شیرهای گاز دارای دستگیره می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا خطرات چاله سرویس شناسایی شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا مواد شیمیایی (روغن، بنزین، واسکازین و گریس) در تعمیرگاه وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا کف تعمیرگاه فاقد روغن ریزی و گازوئیل می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا تعمیرکار روغن سوخته و گازوئیل را روی زمین دفع می‌کند و یا به شکل دیگری انجام می‌دهد؟ (استانداردهای زیست محیطی رعایت می‌شود)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا تعمیرکار از دستکش و کفش ایمنی استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا داخل تعمیرگاه ابزار و وسایل به شیوه ای صحیح مرتب و منظم چیده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا تعمیرکار به هنگام استفاده از سنگ فرز یا سنگ دوقلو از عینک حفاظتی استفاده می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  36 => 
  array (
    'title' => 'بازدید از واحد تأسیسات و فنی',
    'category' => 'بازدید واحدها',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا درب تابلوهای برق سالم و دارای قفل می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا کابل‌های برق ورودی و خروجی از تابلوهای برق دارای حفاظ مناسب بوده و به صورت اصولی مهار شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا فیوزهای برق سالم و شکستگی ندارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا سیم کشی موقت و آویزان در کارگاه وجود ندارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا کابل‌های برق موجود در کارگاه دارای حفاظ مناسب بوده و به صورت اصولی مهار شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا کلید و پریز و سوکت های برق سالم و به دیوار فیکس شده‌اند؟ درپوش مناسب دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا کلیه جعبه تقسیم های برق درپوش مناسب دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا روشنایی عمومی کارگاه سالم و مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا کف کارگاه صاف و بدون چاله است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا دیوارها وسقف کارگاه شکستگی و ترک ندارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا مواد زائد و آغشته به روغن در ظروف مناسب جمع‌آوری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا علائم ایمنی و هشداردهنده در واحد نصب شده و سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا پرسنل هنگام کار از وسایل حفاظت فردی نظیر (کفش ایمنی، لباس کار، عینک حفاظتی و.....) استفاده می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا وسایل و ابزار کار تمیز و مرتب در محل مربوط قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا کلیه آبراه‌ها باز و بدون گرفتگی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا کابل برق دستگاه جوشکاری سالم و یکپارچه می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا عایق انبر دستگاه‌های جوشکاری سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا بدنه، شیشه و دستگیره ماسک جوشکاری سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا سوکت برق دستگاه‌های جوش سالم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا کارگاه دارای فن تهویه هوا می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'با توجه به فصل سال آیا دستگاه‌های گرمایشی، سرمایشی سالم هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا کابل برق چراغ‌های سیار سالم و یکپارچه هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا چراغ‌های سیار موجود در قسمت حفاظ دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا دوشاخه برق چراغ‌های سیار سالم هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا کپسول ها (سیلندرهای) دستگاه برشکاری به صورت قائم و اصولی و در محل مناسبی مهار شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا شیلنگ‌های گاز و هوا دستگاه برشکاری سالم هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا سیلندرها (کپسول‌های(هوا و گاز دارای ولو)شیر) مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا مانومتر فشار شکن دستگاه هوا برش سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا سیلندرهای پرو خالی جدا از یکدیگر نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا شیلنگ‌های هادی گاز و هوا، فشارسنج و شیر آلات دستگاه استیلن سالم و یکپارچه و دارای بست مناسب می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا چرخ تسمه دریل رومیزی (ثابت) دارای حفاظ می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا دوشاخه و کلید خاموش / روشن دریل رومیزی سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا دریل رومیزی دارای سیستم ارت می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا قالبها و زنجیرهای جرثقیل دستی سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا قفل زنجیر جرثقیل ها سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا دستگاه‌های سنگ فیبری (فرز) دارای حفاظ سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا دستگیره و بدنه (پوسته(دستگاه سنگ فیبری)فرز) سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا کابل برق و دوشاخه دستگاه دریل دستی سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا دستگاه سنگ سمباده دارای حفاظ مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا صفحه سنگ سمباده سالم و فاقد ترک و یا شکستگی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا کابل برق و دوشاخه دستگاه سنگ سمباده سالم است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا شیلنگ اجاق گاز سالم و دو سر آن با بست مناسب وصل شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا شیرهای گاز دارای دستگیره می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا لوله های آب و بخار و..... موجود در کارگاه سالم و فاقد نشتی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا نرده‌های محافظ پلتفرم موجود در کارگاه سالم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  37 => 
  array (
    'title' => 'بازدید از بخش‌های اداری',
    'category' => 'بازدید واحدها',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا تابلو اعلانات و علائم ویژه تمیز و قابل خواندن هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا مطالب تابلو اعلانات و علائم ویژه مرتبا تعویض می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا شعارها، پوسترها و پیام های ایمنی و بهداشتی در تابلو نصب می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا کف اتاق ها اشغال و خرده ریزه وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا کف اتاق ها لغزنده، روغنی و مرطوب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا پرسنل خدماتی به‌موقع اتاق ها را تمیز می‌کنند؟ (کف اتاق ها را تی می‌کشند)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا مسئول ایمنی سازمان کنترل بر نحوه نظافت اتاق ها توسط پرسنل خدماتی را دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا تمیز و غیر مسدود می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا راه پله‌ها از روشنایی مناسب برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا راهروها دارای علامت خروج اضطراری می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا پرسنل خدماتی راهروها را تی می‌کشند و به‌موقع تمیز می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا حفاظ، حائل و وسایل مانع صدا در محیط کار وجود دارد و از کارایی مناسب برخوردار می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا اسباب و وسایل ایمن می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا صندلی ها دارای طراحی مناسب (ارگونومی) می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا میزها و قفسه ها دارای لبه های تیز می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا تجمع وسایل و تجهیزات به شکل مناسب می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا نردبان ها ایمن می‌باشند و به خوبی نگهداری شده و جایگاه آن‌ها محکم می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا وسایل اطفای حریق به شکل مداوم کنترل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا وسایل اطفای حریق با توجه به نوع حریق احتمالی، مناسب اطفای حریق می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا در سازمان سیستم اعلام حریق وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا سیستم اعلام حریق کنترل شده و به خوبی کار می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا وسایل روشنایی اضطراری موجود بوده و متوالیاً کنترل می‌شود؟ (چراغ قوه، چراغ اضطراری و....)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا تجهیزات جانبی واکنش در شرایط اضطراری در سازمان وجود دارد؟ (طناب، تبر، دیلم و.....)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا ساختمان از نظر کاربرد، استقرار و سایل، سرویس ها و لوله کشی مناسب است و استاندارد های مربوط رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا بخش های زیر در ساختمان ایمن می‌باشند؟ (درهای چرخان، نرده‌های محافظ راه پله‌ها، شکاف ها و محل های باز موجود در کف و دیوار، آسانسورها و تجهیزات و و سایل مربوطه، نردبان ها، راه پله‌ها و پلکان متحرک و...... )',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا ساختمان سیستم اتصال به زمین (ارت) مناسبی دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا مقاومت چاه ارت اندازه گیری می‌شود و آیا از مقاومت مطلوب مطابق با استاندارد برخوردار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا ترمز اضطراری و سیستم الکترونیکی در آسانسورها فعال بوده و به خوبی کار می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا آژیر خطر و اعلام شرایط اضطراری در آسانسور به خوبی کار می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا سرعت جابجایی هوا مطابق با شرایط استاندارد است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا سیستم، عاری از منابع آلودگی (آزبست، میکرو ارگانیسم ها و ذرات فیوم) می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا دما و رطوبت محیط کار مناسب می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا در کارگاه دماسنج کالیبره بوده و دمای محیط کار را به درستی نشان می‌دهد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا در کارگاه سرعت سنج وجود داشته و به خوبی کار می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا فاکتورهای ذیل در مورد کلیه مواد خطرناک تعیین شده است؟ · خواص شیمیایی، فیزیکی و بیولوژییکی · اثرات مضر آن‌ها بر سلامتی افراد · میزان تماس مجاز برای کارگران · روش های صحیح جابجا کردن آن‌ها',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا آزمایشات لازم جهت تشخیص ماهیت حقیقی این مواد توسط مراجع ذی‌صلاح انجام می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا نتایج این آزمایشات قابل دسترس تمامی اعضای کمیته ایمنی و بهداشت می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا مواد جایگزین جهت مصرف درخواست شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا مواد خطرناک به شکل مناسب برچسب گذاری شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا دستشویی ها به‌موقع تمیز می‌شوند؟ (حداقل روزانه 2 بار)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا مایع صابون، صابون و دستمال کاغذی در دستشویی ها موجود است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا در دستشویی ها چراغ اضطراری در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا محوطه آبدارخانه تمیز می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا مسئول آبدارخانه به‌موقع ظروف را مورد شستشو قرار می‌دهد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا تمهیداتی برای جلوگیری از شیوع بیماری ها، در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا تشریفات ورود و خروج به شکلی است که امنیت شخصی کارگران را در شب تامین نماید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا تمهیداتی جهت موقع اضطراری نظیر انتقال افراد و تخلیه فوری محل در هنگام آتش‌سوزی، زلزله و..... وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا از ورود افراد بیگانه به سازمان خودداری می‌شود؟ (در صورت ورود به شیوه صحیح با آن‌ها برخوردار می‌شود)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا بعد از پایان وقت اداری و تعطیل شدن سازمان، درب ورودی (اصلی) و درب پارکینگ قفل می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا رفلکتور المپ ها تمیز است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا المپ های سوخته تعویض نشده وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا محوطه ای تاریک وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'آیا مواد به شکل مناسب و ایمن روی هم انبار شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا در راهروها و محوطه های کاری انبارها موانع مزاحم رفت و آمد افراد قرار گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'آیا تعداد سیم های اتصال به برق زیاد است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'آیا سیم های برق و تلفن در محل های رفت و آمد کارکنان قرار گرفته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'آیا دستگاه ها حفاظ مناسب دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'آیا سیم های برق دارای پوشش مناسب می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'آیا وسایل دارای قسمت‌های بیرون زده و تیز می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'آیا چیدمان صندلی های محیط کار به خوبی انجام شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'آیا وسایل اضافی و غیر ضروری در محدوده فعالیت کارکنان وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'آیا تابلوهای خروج اضطراری در ورودی طبقات نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'آیا تابلوی خط مشی در طبقات نصب شده و کارکنان از مفاد آن اطلاع دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'آیا در داخل سازمان سیستم پیچینگ (بلند گوی صوتی) وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'آیا در مواقع بروز شرایط اضطراری می‌توان از سیستم پیچینگ استفاده نمود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'آیا کارکنان به‌طور مستمر در محل خود می‌نشینند و یا در فواصل مشخصی ورزش و نرمش و استراحت می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  38 => 
  array (
    'title' => 'بازدید واحد ایمنی',
    'category' => 'مدیریت HSE',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا در شرکت آیین‌نامه مکتوبی که در آن وظایف افراد و قوانین ایمنی ذکر شده باشد وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا وظیفه تشکیل کمیته حفاظت و بهداشت کار به عهده واحد HSE است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا تعداد دفعات تشکیل کمیته، طبق برنامه ریزی زمانبندی شده مشخص شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا طبق آیین‌نامه حضور مدیریت ارشد یا نماینده مدیریت در جلسات کمیته مذکور ضروری است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا پیگیری و اجرای دستور جلسات کمیته بر عهده واحد HSE است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا وظایف کمیته شامل موارد زیر نیز می‌شود: بررسی علل حوادث، گزارش و ثبت حوادث، انجام بازرسی های دوره‌ای، تدوین مقررات ایمنی و بهداشت، استقرار سیستم HSE MS/OHSAS، برنامه ریزی آموزشی، واکنش در شرایط اضطراری و مانورها.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا نماینده یا نمایندگانی از کارگران، پیمانکاران و کارفرمآیان در جلسه (HSE) حضور دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا واحد ایمنی و بهداشت پیمانکار در جلسات HSE کارفرما / مشاور / دستگاه نظارت شرکت می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا واحد ایمنی، بهداشت و محیط زیست (HSE) عوامل زیان آور محیط کار را شناسایی کرده و به صورت مکتوب نگهداری می‌کند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا عوامل زیان آور شناسایی شده در اختیار واحدها و بخش های مختلف کارگاه قرار می‌گیرد؟ (اطلاع رسانی لازم توسط مسئول HSE کارگاه صورت می‌گیرد)؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا دستورالعملی برای شناسایی و ارزیابی ریسک خطرات محیط کار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا ارزیابی ریسک خطرات محیط کار صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا ارزیابی ریسک خطرات به صورت دوره‌ای مورد بازنگری و تجدید نظر قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا برای ارزیابی ریسک خطراتی که از شدت و احتمال بالایی برخوردار می‌باشند، اقدام اصلاحی یا پیشگیرانه ای انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا اثر بخشی اقدامات اصلاحی یا پیشگیرانه در خصوص ارزیابی ریسک‌ها مورد پایش و اندازه گیری قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا اسناد و مدارک ارزیابی ریسک خطرات به صورت مکتوب / فایل الکترونیکی موجود می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا برنامه های آموزشی (نیاز سنجی آموزشی، زمان بندی آموزشی، اجرای آموزش) تدوین شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا کلاس های آموزشی نحوه آمادگی و واکنش در شرایط اضطراری، کمک‌های اولیه، نحوه تخلیه اضطراری، اطفاء حریق، نحوه توقف اضطراری، وسایل حفاظت فردی برای پرسنل کارگاه برگزار می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا اثر بخشی دوره‌های برگزار شده مورد پایش و اندازه گیری قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا در حین اجرای مانورهای واکنش در شرایط اضطراری نقاط ضعف و نیاز به اصلاح و تمرین بیشتر، ثبت می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا برای نقاط ضعف ها اقدام اصلاحی و یا پیشگیرانه صادر شده و مجددا مورد پایش و اندازه گیری قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا در سایت مدیریت بحران آموزش داده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا کارگران آموزش‌های واکنش در شرایط اضطراری به هنگام مواجهه با بلایای طبیعی از قبیل سیل، زلزله را فرا گرفته‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا مسئول ایمنی و بهداشت (HSE) کارگاه لوازم و تجهیزات امداد و نجات و کیف کمک‌های اولیه را مورد بازرسی قرار می‌دهد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا تاریخ مصرف داروهای مورد نیاز و مصرفی در سایت به پایان رسیده و یا از اعتبار لازم برخوردار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا کپسول‌های اطفاء حریق تاریخ شارژ دارند و یا از زمان شارژ آن‌ها گذشته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا کپسول‌های دستی اطفاء حریق در مکان های مناسب و در دسترس قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا واحد ایمنی و بهداشت کارگاه امکانات ویژه از قبیل تجهیزات و ملزومات پزشکی مورد نیاز کمک‌های اولیه را دارا می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا مدرک مستندی در رابطه با دوره‌های کمک‌های اولیه و فوریت های پزشکی توسط بهداشت یار، مسئول ایمنی و بهداشت دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا کیت یا جعبه کمک‌های اولیه تمام وسایل ذیل را دارا می‌باشد: باندهای کشی، گاز استریل، مواد ضد عفونی کننده، نوار چسب، پنس، شریان بند، قیچی مخصوص برش باند، تخته های شکسته بندی (آتل)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا در کارگاه برانکارد وجود داشته و دارای دو پتوی تمیز می‌باشد؟ (برانکارد تاشو موجود است)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا جعبه کمک‌های اولیه در نقاط مختلف سایت نصب شده و در معرض دید همه پرسنل قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا در کارگاه پزشک معتمد وجود دارد و آیا کارگران توسط پزشک معتمد تحت معاینات پزشکی قرار می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا برای کلیه کارگران در بدو استخدام پرونده پزشکی تشکیل شده و معاینات و آزمایشات دوره‌ای انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا معانیات پزشکی به دلیل حادثه یا بیماری کارگر پس از برگشت به‌کار انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا برای مشاغل خاص (کار در ارتفاع، کار گرم، کار با پرتو ها) و به هنگام تغییر شغل معاینات اختصاصی انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا معاینات پزشکی بدو استخدام و دوره‌ای موارد ذیل را شامل می‌شود: رادیولوژی، اسپیرومتری، ادیومتری، اپتومتری، آزمایش خون، نوار قلب، آزمایش ادار و در صورت نیاز آزمایش مدفوع',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا غربالگری پرسنل بر اساس گزارش تفکیکی پرونده پزشکی آن‌ها توسط مسئول (HSE) سایت انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'آیا سوابق پزشکی افراد از جمله بیماریهای قلبی، بیماری های ارثی، بیماری های قند و دیابت، بیماری صرع، بیماری های روانی، بیماری آرولوژی، سرطان ها در پرونده پزشکی آن‌ها درج گردیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا مدارک مستندی وجود دارد که نشانگر مراقبت ویژه پزشکی افراد زیر 21 سال و بالای 40 سال سن باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا خصوصیات ویژه مورد نیاز هر شغل، مشخص شده و کتبا در اختیار پزشک می‌باشند که با توجه به معاینات پزشکی، افراد مناسب جهت شغل مورد نظر مشخص شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا برای اعضای کمیته بحران و واکنش در شرایط اضطراری آزمایشات خاص و تخصصی از قبیل قدرت فیزیکی بالا، قدرت تصمیم گیری سریع، دقت زیاد، بینایی سالم، شنوایی سالم، قلب سالم، تنفسی سالم، حرکات سریع و مداوم انجام می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا سوابق و پرونده های پزشکی افراد در جای مشخص و مناسبی نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا همه افراد به سوابق پزشکی دسترسی دارند یا فقط در اختیار مسئول HSE، بهداشت یار و پزشک کارگاه می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا پس از نظر پزشک معتمد کارشناس HSE / بهداشت حرفه ای نیز در پرونده پزشکی فرد با توجه به شغل وی نظر می‌دهد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا دستورالعمل مکتوبی از طرف مدیریت ارشد سازمان وجود دارد که استخدام کارگران جدید را منوط به نظر پزشک و کارشناس HSE بداند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا چارت سازمانی بهداشتی حداقل نیازها را برآورد می سازد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا نحوه ارتباط کارکنان شفاف و شرح وظایف آن‌ها تعریف شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا اقداماتی جهت پیشرفت برنامه های بهداشتی صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا اعضای کمیته های بهداشتی مشخص و شرح وظایفشان به آن‌ها ابلاغ شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا بازدیدهای دوره‌ای فعالیت های واحد بهداشتی صورت می‌گیرد و سوابق مربوط نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا در صورتی که فعالیت های واحد بهداشت به پیمانکار واگذار گردیده است موارد زیر رعایت شده است؟ · سوابق بهداشتی پیمانکار · دستورالعمل برای فعالیت پیمانکار · نظارت واحد بر فعالیت های پیمانکار · ارسال تمام گزارشات حوادث ناظر و کارفرما',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'آیا فعالیت هایی برای تشخیص خطرات و بهداشت بر سلامت افراد انجام شده است؟ فعالیت هایی که با ریسک‌های بالا همراه هستند (کار با پرتوها، میدآن‌های مغناطیسی و......)',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا پرسنل در زمینه فعالیت های خود آموزش‌های لازم را دیده اند؟ · شروع به کار · آموزش‌های حین خدمت · آموزش‌های خاص',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'آیا برنامه های بازآموزی بهداشت به صورت برنامه زمانی برای تمام کارکنان اجرا می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'سوابق آموزشی پرسنل نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'آیا کارکنان از وضعیت بهداشتی و رفاهی درمانگاه رضایت دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'مسافت اولین مرکز درمانی تا محل کار رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'آیا گرد و خاک در محیط کار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'آیا راه‌های کنترل گرد و غبار (نظیر جمع‌آوری ذرات تهویه، استفاده از سیکلون ها و......) اعمال می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'آیا لوازم حفاظت فردی برای مقابله با گرد و غبار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'بیشتر بیماری های تولید شده مربوط به کدام یک از عوامل بیولوژیک می‌باشد؟ انگل‌ها ویروس‌ها قارچ‌ها باکتری ها و سایر موارد',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'آیا بیماری های شغلی ناشی از باکتری‌ها، ویروس‌ها و سایر عوامل بیولوژیک تاکنون وجود داشته است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'آیا تدابیری برای از بین بردن جانوران موذی (سم‌پاشی، تله‌گذاری و........) اندیشیده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'آیا برای اوقات فراغت کارکنان تدابیری اندیشیده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'آیا کارکنان از محیط کار خود، ارتباط با همکاران و سایر موارد راضی هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'آیا روان‌سنجی دوره‌ای از کارکنان به عمل می آید؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'آیا عوامل زیان آور محیط کار شناسایی شده‌اند و نقاط بحرانی آن مشخص می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'آیا روش هایی برای پیشگیری از بروز استرس های روانی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'آیا از نظرات اصلاحی کارکنان استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'آیا در محیط کار به تطابق کار با فعالیت انسان توجه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'در چه مکان هایی و کدام گروه از کارکنان با ماشین یا ابزار کار خود مشکل دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'آیا تاکنون سعی شده است از بروز حرکات تکراری بدنی در محیط کار جلوگیری شود؟ گزارشی در این خصوص در دسترس می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'آیا آموزش‌هایی برای پیشگیری از بروز خستگی های اضافی و زودرس به کارکنان داده می‌شود؟ مانند تنظیم ساعت کار، تنظیم ساعت استراحت، تامین محل استراحت، انتخاب کارکنان مناسب با آموزش صحیح، تامین امکانات مورد نیاز.',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
  39 => 
  array (
    'title' => 'چک‌لیست انبار',
    'category' => 'انبار',
    'description' => 'چک‌لیست بازبینی‌شده و واردشده از فایل‌های PDF فاز سوم HSE (اولویت‌دار).',
    'version' => '1.0',
    'items' => 
    array (
      0 => 
      array (
        'question' => 'آیا از ورود افراد متفرقه به انبار جلوگیری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      1 => 
      array (
        'question' => 'آیا علائم هشداردهنده مانند (کشیدن سیگار ممنوع) وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      2 => 
      array (
        'question' => 'آیا تهویه در انبارها به خوبی صورت می‌گیرد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      3 => 
      array (
        'question' => 'آیا انبار دارای انتظامات 24 ساعته می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      4 => 
      array (
        'question' => 'آیا انبار در اطراف خود دارای حصار می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      5 => 
      array (
        'question' => 'آیا در انبار کردن مواد از پالت استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      6 => 
      array (
        'question' => 'آیا راه‌های عبور به وضوح علامت گذاری و قابل دسترسی هستند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      7 => 
      array (
        'question' => 'آیا مواد ریخته شده در فاصله ایمن از وسائل برقی قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      8 => 
      array (
        'question' => 'آیا کالاهای انبار شده در فاصله ایمن از وسائل برقی قرار دارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      9 => 
      array (
        'question' => 'آیا تعداد وسائل خاموش کننده دستی در انبار کافی است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      10 => 
      array (
        'question' => 'آیا نوع خاموش‌کننده‌های دستی مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      11 => 
      array (
        'question' => 'آیا مواد کد بندی و از قوانین fifo و lifo استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      12 => 
      array (
        'question' => 'آیا مواد اشتعال زا و خطرناک از یکدیگر و دیگر مواد جدا شده و علامت مخصوص مشخص شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      13 => 
      array (
        'question' => 'آیا مایعات قابل اشتعال در ظروف سربسته نگهداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      14 => 
      array (
        'question' => 'آیا انبار از نقطه نظر ساختمان در مقابل حریق مقاومت دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      15 => 
      array (
        'question' => 'آیا در ساختمان در و پنجره انبار از شیشه مات استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      16 => 
      array (
        'question' => 'آیا اجناس که به فرم کارتن یا مکعب می‌باشند به شکل آجری چیده شده‌اند که نریزند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      17 => 
      array (
        'question' => 'آیا کالاها به صورت توده های جدا از یکدیگر چیده شده‌اند که در موقع آتش‌سوزی قابل مهار کردن باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      18 => 
      array (
        'question' => 'آیا ارتفاع کالا در انبار مناسب می‌باشد و یا زیاد است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      19 => 
      array (
        'question' => 'آیا کف انبار تمیز و خشک است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      20 => 
      array (
        'question' => 'آیا MSDS مواد در انبار موجود بوده و انباردار اطلاعات ایمنی و نحوه نگهداری آن‌ها شناخت دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      21 => 
      array (
        'question' => 'آیا انباردار آموزش دوره اطفای حریق و امداد و نجات را طی کرده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      22 => 
      array (
        'question' => 'آیا در کارگاه انبارهای روباز از انبارهای روبسته جدا می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      23 => 
      array (
        'question' => 'آیا انباردار آموزش‌های لازم در خصوص چیدن مواد را دیده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      24 => 
      array (
        'question' => 'آیا کپسول‌های هوا و بوتان در انبارهای دیگری نگهداری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      25 => 
      array (
        'question' => 'آیا تمهیدات لازم برای نگهداری کپسول‌های هوا و بوتان از قبیل داشتن زنجیر و حفاظ مناسب جهت جلوگیری از سقوط آن‌ها وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      26 => 
      array (
        'question' => 'آیا در محل نگهداری کپسول‌های هوا، کپسول‌های اطفای حریق تعبیه شده و آیا تعداد آن‌ها کافی و در محل مناسب قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      27 => 
      array (
        'question' => 'آیا در محل نگهداری کپسول‌های هوا و بوتان کپسول‌های پر از خالی به‌طور مجزا نگهداری شده و محل آن‌ها مشخص است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      28 => 
      array (
        'question' => 'آیا کالا و مواد موجود در انبار بیمه شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      29 => 
      array (
        'question' => 'آیا موقعیت ساختمان انبارها برای عبور و مرور وسایل نقلیه موتوری و غیر موتوری مورد لزوم بدون برخورد با موانع تا جلوی درب ورودی انبار مناسب است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      30 => 
      array (
        'question' => 'آیا کف انبار از جنس بتون یا سنگ فرش می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      31 => 
      array (
        'question' => 'آیا محوطه انبار از پوشال، خاشاک و خرده چوب و کاغذ و سایر مواد پاک کننده می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      32 => 
      array (
        'question' => 'آیا وسایل موتوری مخصوص رفت و آمد در انبار هر کدام مجهز به کپسول آتش‌نشانی می‌باشند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      33 => 
      array (
        'question' => 'آیا در انبار جعبه کمک‌های اولیه نصب شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      34 => 
      array (
        'question' => 'آیا در اطراف بارانداز و انبار روشنایی مناسبی پیش بینی شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      35 => 
      array (
        'question' => 'آیا همه روزه مقارن با آیام تعطیل هم، انبار محوطه از نظر ایمنی به وسیله مسئول ایمنی (HSE) به طوردقیق بازدید و در نتیجه در دفتر مخصوص ثبت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      36 => 
      array (
        'question' => 'آیا به محض ورود و خروج محموله مشخصات کامل محموله توسط انباردار ثبت می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      37 => 
      array (
        'question' => 'آیا انبار به سیستم ثبت ورود و خروج مواد برچسب فرم های استاندارد مجهز است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      38 => 
      array (
        'question' => 'در صورتی که کف انبار فاقد شیب و آب رو باشد آیا کالا حداقل 5 سانتی‌متر با سطح زمین فاصله دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      39 => 
      array (
        'question' => 'آیا اطراف انبار فضای باز برای دور زدن خودروهای آتش‌نشانی وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      40 => 
      array (
        'question' => 'آیا فاصله مناسب بین سقف انبار و مرتفع ترین کالای چیده شده رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      41 => 
      array (
        'question' => 'آیا حداکثر سطح اشتغال شده هر قسمت کالا و فاصله آن با قسمت‌های دیگر با توجه به عرض انبار رعایت شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      42 => 
      array (
        'question' => 'آیا از نگهداری سایر کالاها و مواد و انبار مواد شیمیا یی خودداری می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      43 => 
      array (
        'question' => 'آیا کالاها در انبار طبقه بندی شده و دارای محل انبار اختصاصی می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      44 => 
      array (
        'question' => 'آیا کف انبار دارو و مایعات قابل اشتعال به طور مرتب شستشو می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      45 => 
      array (
        'question' => 'آیا ظرفیت انبار با میزان کالاها و مواد شیمیایی مورد نگهداری مطابقت دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      46 => 
      array (
        'question' => 'آیا گذرگاه های شیبدار در مبادی ورودی های انبار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      47 => 
      array (
        'question' => 'آیا برای نگهداری مواد، کالا، ظروف محتوی مواد و مایعات از قفسه بندی فلزی مناسب استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      48 => 
      array (
        'question' => 'آیا دسترسی به انبار مستقیم و بدون عبور از سایر ساختمآن‌ها است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      49 => 
      array (
        'question' => 'آیا دفتر انباردار جدا از منطقه نگهداری سموم و مواد شیمیایی قرار دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      50 => 
      array (
        'question' => 'آیا دیواره های داخلی صاف و صیقل و عاری از ترک و لبه می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      51 => 
      array (
        'question' => 'آیا عالوه بر درب اصلی درب‌های اضطراری نیز در نظر گرفته شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      52 => 
      array (
        'question' => 'آیا درب مجهز به قفل ایمنی بوده تا از ورود افراد غیرمسئول ممانعت گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      53 => 
      array (
        'question' => 'آیا از علائم هشداردهنده خطر سموم، آتش زایی و عدم اجازه ورود به افراد غیرمسئول استفاده شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      54 => 
      array (
        'question' => 'آیا سیستم خنک کننده و گرم کننده به گونه ای طراحی شده‌اند که موجب گرم شدن و سرد شدن مستقیم مواد انبار نگردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      55 => 
      array (
        'question' => 'آیا دما و رطوبت در انبار کنترل می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      56 => 
      array (
        'question' => 'آیا دماسنج موجود در انبار کالیبره می‌باشد و دمایی که نشان می‌دهد درست است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      57 => 
      array (
        'question' => 'آیا ظروف آسیب دیده و نشت نموده فورا بسته بندی و برچسب گذاری می‌شوند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      58 => 
      array (
        'question' => 'آیا از خوردن، آشامیدن، استعمال دخانیات در حین کار در انبار خودداری می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      59 => 
      array (
        'question' => 'آیا انباردار و کارگران آموزش‌های لازم را در خصوص انبارداری، ثبت و محل جابجایی و خطرات مواد شیمیایی و شناخت آن‌ها و عملکرد در حین بروز حوادث احتمالی را دیده اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      60 => 
      array (
        'question' => 'آیا از وسایل حفاظتی بر حسب نوع کار در انبار استفاده می‌گردد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      61 => 
      array (
        'question' => 'آیا ظروف و بسته بندی های مواد شیمیایی و سموم به طور هفتگی از نظر محل نگهداری، نشت مواد، و ضعیت ایمنی، وسایل حفاظت فردی شاغلین در انبارها و محیط انبار و همچنین عملیات پاکسازی مورد بازدید قرار می‌گیرند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      62 => 
      array (
        'question' => 'آیا مواد شیمیایی و سموم ناسازگار از هم جدا شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      63 => 
      array (
        'question' => 'آیا مواد شیمیایی با قابلیت اشتعال بالا و میل ترکیبی زیاد با حداقل 15 متر از سایر مواد قرار گرفته اند و با علامت مخصوص مشخص شده‌اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      64 => 
      array (
        'question' => 'آیا در انبارها ظروف و بشکه‌های خالی برای انتقال محتویات ظروف آسیب دیده موجود می‌باشد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      65 => 
      array (
        'question' => 'آیا پرسنل انبار از آموزش‌های لازم در حین کار خصوصا شیوه صحیح بلند کردن بار برخوردارند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      66 => 
      array (
        'question' => 'آیا کارگران انبار آموزش‌های ارگونومی محیط کار را دیده اند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      67 => 
      array (
        'question' => 'آیا مسئول انبار ممانعت لازم در حین بلند کردن بارهای سنگین توسط یک نفر را به عمل می آورد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      68 => 
      array (
        'question' => 'آیا در انبار جرثقیل و یا هر وسیله کمکی دیگری برای بلند کردن بارهای سنگین تعبیه شده است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      69 => 
      array (
        'question' => 'آیا کارگران بارهای سنگین را با کمک یکدیگر به صورت دو نفری به‌طور همزمان بلند می‌کنند؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      70 => 
      array (
        'question' => 'آیا در انبار از لیفتراک برای کمک کردن بارهای سنگین استفاده می‌شود؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      71 => 
      array (
        'question' => 'آیا پالت های مخصوص حمل لیفتراک در انبار وجود دارد؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      72 => 
      array (
        'question' => 'آیا راننده لیفتراک از مهارت و تجربه کافی برخوردار است؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
      73 => 
      array (
        'question' => 'آیا هنگام بلند کردن بارهای سنگین توسط لیفتراک قبل از بلند کردن، بارها مورد آزمایش نیروی وزن قرار می‌گیرند تا معلوم شود لیفتراک می‌تواند بار(های) مربوط را بلند کند یا نه؟',
        'guidance' => NULL,
        'weight' => 1,
        'is_critical' => false,
        'is_active' => true,
      ),
    ),
  ),
);

        DB::transaction(function () use ($checklists, $createdBy): void {
            foreach ($checklists as $data) {
                $checklistId = DB::table('checklists')
                    ->where('title', $data['title'])
                    ->where('category', $data['category'])
                    ->value('id');

                $values = [
                    'description' => $data['description'],
                    'version' => $data['version'],
                    'is_active' => 1,
                    'created_by' => $createdBy,
                    'updated_at' => now(),
                ];

                if ($checklistId) {
                    DB::table('checklists')->where('id', $checklistId)->update($values);
                } else {
                    $values['title'] = $data['title'];
                    $values['category'] = $data['category'];
                    $values['created_at'] = now();
                    $checklistId = DB::table('checklists')->insertGetId($values);
                }

                foreach ($data['items'] as $sortOrder => $item) {
                    DB::table('checklist_items')->updateOrInsert(
                        ['checklist_id' => $checklistId, 'sort_order' => $sortOrder],
                        [
                            'question' => $item['question'],
                            'guidance' => $item['guidance'],
                            'weight' => $item['weight'],
                            'is_critical' => $item['is_critical'],
                            'is_active' => $item['is_active'],
                            'updated_at' => now(),
                            'created_at' => now(),
                        ]
                    );
                }
            }
        });
    }
}