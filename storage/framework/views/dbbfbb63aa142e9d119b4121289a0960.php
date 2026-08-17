<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ورود | سامانه HSE</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
</head>
<body class="min-h-screen bg-slate-950 text-slate-800">

<div class="relative grid min-h-screen place-items-center overflow-hidden p-5">
    
    <div class="absolute -right-40 -top-40 h-96 w-96 rounded-full bg-emerald-500/20 blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 h-96 w-96 rounded-full bg-cyan-500/20 blur-3xl"></div>

    <div class="relative grid w-full max-w-5xl overflow-hidden rounded-[32px] bg-white shadow-2xl lg:grid-cols-2">

        
        <section class="hidden bg-gradient-to-br from-emerald-600 to-teal-800 p-12 text-white lg:flex lg:flex-col lg:justify-between">
            <div>
                <div class="grid h-16 w-16 place-items-center rounded-2xl bg-white/15">
                    <svg class="h-9 w-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4zM9 12l2 2 4-5"/>
                    </svg>
                </div>
                <h1 class="mt-8 text-3xl font-black leading-relaxed">محیط کار ایمن،<br>با تصمیم‌های داده‌محور</h1>
                <p class="mt-4 text-sm leading-7 text-emerald-100">مدیریت یکپارچه بازرسی، ریسک، رویداد و اقدامات اصلاحی سازمان</p>
            </div>
            <div class="grid grid-cols-3 gap-3 text-center text-xs">
                <div class="rounded-2xl bg-white/10 p-3">بازرسی<br><b class="mt-1 block text-lg">دقیق</b></div>
                <div class="rounded-2xl bg-white/10 p-3">ریسک<br><b class="mt-1 block text-lg">کنترل‌شده</b></div>
                <div class="rounded-2xl bg-white/10 p-3">اقدام<br><b class="mt-1 block text-lg">قابل پیگیری</b></div>
            </div>
        </section>

        
        <section class="p-7 sm:p-12">

            <div class="mb-10">
                <div class="text-sm font-bold text-emerald-600">خوش آمدید</div>
                <h2 class="mt-2 text-2xl font-black text-slate-900">ورود به سامانه مدیریت HSE</h2>
                <p class="mt-2 text-sm text-slate-500">برای ادامه، اطلاعات حساب سازمانی خود را وارد کنید.</p>
            </div>

            <form method="post" action="<?php echo e(route('login.store')); ?>" class="space-y-5" novalidate>
                <?php echo csrf_field(); ?>

                
                <?php $emailError = $errors->first('email') ?>
                <div>
                    <label for="email" class="mb-2 block text-sm font-bold
                        <?php echo e($emailError ? 'text-rose-600' : 'text-slate-800'); ?>">
                        ایمیل سازمانی
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="<?php echo e(old('email')); ?>"
                        autofocus
                        autocomplete="email"
                        placeholder="name@company.com"
                        class="w-full rounded-xl border bg-slate-50 px-4 py-3 outline-none transition
                            <?php echo e($emailError
                                ? 'border-rose-400 bg-rose-50 focus:border-rose-500 focus:ring-4 focus:ring-rose-100'
                                : 'border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100'); ?>"
                    >
                    <?php if($emailError): ?>
                        <p class="mt-1.5 text-xs text-rose-600"><?php echo e($emailError); ?></p>
                    <?php endif; ?>
                </div>

                
                <?php $passwordError = $errors->first('password') ?>
                <div>
                    <label for="password" class="mb-2 block text-sm font-bold
                        <?php echo e($passwordError ? 'text-rose-600' : 'text-slate-800'); ?>">
                        رمز عبور
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="current-password"
                        class="w-full rounded-xl border bg-slate-50 px-4 py-3 outline-none transition
                            <?php echo e($passwordError
                                ? 'border-rose-400 bg-rose-50 focus:border-rose-500 focus:ring-4 focus:ring-rose-100'
                                : 'border-slate-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100'); ?>"
                    >
                    <?php if($passwordError): ?>
                        <p class="mt-1.5 text-xs text-rose-600"><?php echo e($passwordError); ?></p>
                    <?php endif; ?>
                </div>

                
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-600">
                    مرا به خاطر بسپار
                </label>

                
                <button class="w-full rounded-xl bg-emerald-600 px-5 py-3.5 font-black text-white shadow-lg shadow-emerald-200 transition hover:bg-emerald-700">
                    ورود به سامانه
                </button>
            </form>

            <p class="mt-8 text-center text-xs text-slate-400">نسخه ۱.۰ — دسترسی فقط برای کاربران مجاز</p>

        </section>
    </div>
</div>

</body>
</html>
<?php /**PATH E:\HSE\hse-manager\resources\views/auth/login.blade.php ENDPATH**/ ?>