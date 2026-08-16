<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Morilog\Jalali\Jalalian;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useTailwind();
        Carbon::setLocale(config('app.locale'));

        // Blade directive: @jdate($carbonDate) — outputs 'Y/m/d'
        Blade::directive('jdate', function ($expression) {
            return "<?php echo \\Morilog\\Jalali\\Jalalian::fromCarbon($expression)->format('Y/m/d'); ?>";
        });

        // Blade directive: @jdatetime($carbonDate) — outputs 'Y/m/d H:i'
        Blade::directive('jdatetime', function ($expression) {
            return "<?php echo \\Morilog\\Jalali\\Jalalian::fromCarbon($expression)->format('Y/m/d H:i'); ?>";
        });

        // Global helper: convert a Jalali string like "1403/01/15" or "1403/01/15 08:30"
        // to a Gregorian Carbon instance. Returns null if blank.
        if (! function_exists('jalaliToCarbon')) {
            function jalaliToCarbon(?string $value): ?Carbon {
                if (blank($value)) return null;
                // Normalise Persian/Arabic digits to ASCII
                $value = strtr($value, ['۰'=>'0','۱'=>'1','۲'=>'2','۳'=>'3','۴'=>'4','۵'=>'5','۶'=>'6','۷'=>'7','۸'=>'8','۹'=>'9','٠'=>'0','١'=>'1','٢'=>'2','٣'=>'3','٤'=>'4','٥'=>'5','٦'=>'6','٧'=>'7','٨'=>'8','٩'=>'9']);
                $value = trim($value);
                // Separate date and optional time
                $parts = preg_split('/\s+/', $value, 2);
                $datePart = $parts[0];
                $timePart = $parts[1] ?? '00:00';
                [$y, $m, $d] = explode('/', $datePart) + [null, null, null];
                if (!$y || !$m || !$d) return null;
                $gregorian = Jalalian::fromFormat('Y/m/d H:i', "{$y}/{$m}/{$d} {$timePart}")->toCarbon();
                return $gregorian;
            }
        }
    }
}
