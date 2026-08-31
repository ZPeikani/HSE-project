<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * AiActionService — اجرای عملیات سامانه از طریق دستیار هوش مصنوعی.
 *
 * هر action یک آرایه با کلیدهای زیر برمی‌گرداند:
 *   ok      : bool
 *   message : string   — پیام نمایش به کاربر
 *   data    : array    — داده‌های اضافی (اختیاری)
 *
 * برای افزودن عملیات جدید، متد جدیدی با الگوی handle_<action_name> اضافه کنید
 * و آن را در dispatch() ثبت کنید.
 */
class AiActionService
{
    /**
     * @param  string  $action   نام عملیات (مثلاً: create_user)
     * @param  array   $params   پارامترهای عملیات
     * @param  User    $actorUser کاربر درخواست‌دهنده
     */
    public function dispatch(string $action, array $params, User $actorUser): array
    {
        return match ($action) {
            'create_user' => $this->handleCreateUser($params, $actorUser),
            default       => ['ok' => false, 'message' => 'عملیات ناشناخته: ' . $action],
        };
    }

    // ─────────────────────────────────────────────────────────────
    // ایجاد کاربر جدید
    // ─────────────────────────────────────────────────────────────
    private function handleCreateUser(array $params, User $actor): array
    {
        // فقط admin می‌تواند کاربر ایجاد کند
        if ($actor->role !== UserRole::Admin) {
            return ['ok' => false, 'message' => 'فقط مدیر سامانه می‌تواند کاربر جدید ایجاد کند.'];
        }

        $name          = trim($params['name'] ?? '');
        $email         = trim($params['email'] ?? '');
        $personnelCode = trim($params['personnel_code'] ?? '') ?: null;
        $phone         = trim($params['phone'] ?? '') ?: null;
        $roleValue     = trim($params['role'] ?? '');
        $departmentId  = $params['department_id'] ?? null;

        // اعتبارسنجی
        if (!$name)  return ['ok' => false, 'message' => 'نام کاربر الزامی است.'];
        if (!$email) return ['ok' => false, 'message' => 'ایمیل کاربر الزامی است.'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return ['ok' => false, 'message' => 'فرمت ایمیل نامعتبر است.'];

        $role = UserRole::tryFrom($roleValue);
        if (!$role) {
            $valid = implode(', ', array_map(fn($r) => $r->value . ' (' . $r->label() . ')', UserRole::cases()));
            return ['ok' => false, 'message' => "نقش نامعتبر است. مقادیر مجاز: {$valid}"];
        }

        // بررسی تکراری‌نبودن
        if (User::where('email', $email)->exists()) {
            return ['ok' => false, 'message' => "کاربری با ایمیل «{$email}» از قبل وجود دارد."];
        }
        if ($personnelCode && User::where('personnel_code', $personnelCode)->exists()) {
            return ['ok' => false, 'message' => "کاربری با کد پرسنلی «{$personnelCode}» از قبل وجود دارد."];
        }
        if ($phone && User::where('phone', $phone)->exists()) {
            return ['ok' => false, 'message' => "کاربری با شماره تلفن «{$phone}» از قبل وجود دارد."];
        }

        // بررسی واحد
        $department = null;
        if ($departmentId) {
            $department = Department::find($departmentId);
            if (!$department) return ['ok' => false, 'message' => "واحد سازمانی با ID «{$departmentId}» یافت نشد."];
        }

        // رمز عبور تصادفی
        $rawPassword = Str::random(12);

        $user = User::create([
            'name'           => $name,
            'email'          => $email,
            'personnel_code' => $personnelCode,
            'phone'          => $phone,
            'role'           => $role,
            'department_id'  => $department?->id,
            'password'       => Hash::make($rawPassword),
            'is_active'      => true,
        ]);

        $deptName = $department?->name ?? '—';

        return [
            'ok'      => true,
            'message' => "✅ کاربر جدید با موفقیت ایجاد شد.\n\n"
                . "**نام:** {$user->name}\n"
                . "**ایمیل:** {$user->email}\n"
                . "**کد پرسنلی:** " . ($user->personnel_code ?? '—') . "\n"
                . "**نقش:** " . $user->role->label() . "\n"
                . "**واحد:** {$deptName}\n"
                . "**رمز عبور اولیه:** `{$rawPassword}`\n\n"
                . "⚠️ رمز عبور را برای کاربر ارسال کنید و از او بخواهید پس از اولین ورود آن را تغییر دهد.",
            'data' => ['user_id' => $user->id],
        ];
    }
}
