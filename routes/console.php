<?php
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Services\HseReminderService;
Artisan::command('inspire', fn () => $this->comment('ایمنی، نتیجه تصمیم‌های درست روزانه است.'))->purpose('نمایش پیام HSE');
Artisan::command('hse:sync-reminders', function (HseReminderService $service): void {
	User::query()->where('is_active', true)->each(fn (User $user) => $service->syncFor($user));
	$this->info('HSE reminders synchronized.');
})->purpose('ساخت اعلان‌های سررسید HSE');
