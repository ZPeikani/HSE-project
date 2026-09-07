<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\HseNotification;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useTailwind();
        Carbon::setLocale(config('app.locale'));

        View::composer('layouts.app', function ($view): void {
            $notifications = auth()->check()
                ? HseNotification::where('user_id', auth()->id())->whereNull('read_at')->latest()->limit(5)->get()
                : collect();

            $view->with([
                'unreadNotifications' => $notifications->count(),
                'unreadNotificationItems' => $notifications,
            ]);
        });

        // Blade directive: @jdate($carbonDate) — outputs 'Y/m/d'
        Blade::directive('jdate', function ($expression) {
            return "<?php echo \\Morilog\\Jalali\\Jalalian::fromCarbon($expression)->format('Y/m/d'); ?>";
        });

        // Blade directive: @jdatetime($carbonDate) — outputs 'Y/m/d H:i'
        Blade::directive('jdatetime', function ($expression) {
            return "<?php echo \\Morilog\\Jalali\\Jalalian::fromCarbon($expression)->format('Y/m/d H:i'); ?>";
        });

    }
}
