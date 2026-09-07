<?php

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

if (! function_exists('jalaliToCarbon')) {
    function jalaliToCarbon(?string $value): ?Carbon
    {
        if (blank($value)) {
            return null;
        }

        $value = strtr($value, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);

        $parts = preg_split('/\s+/', trim($value), 2);
        $datePart = $parts[0];
        $timePart = $parts[1] ?? '00:00';
        [$year, $month, $day] = explode('/', $datePart) + [null, null, null];

        if (! $year || ! $month || ! $day) {
            return null;
        }

        return Jalalian::fromFormat('Y/m/d H:i', "{$year}/{$month}/{$day} {$timePart}")->toCarbon();
    }
}