<?php
namespace App\Enums;
enum UserRole: string {
 case Admin='admin'; case HseManager='hse_manager'; case UnitManager='unit_manager'; case Inspector='inspector';
 public function label(): string { return match($this){self::Admin=>'مدیر سامانه',self::HseManager=>'مدیر / مسئول HSE',self::UnitManager=>'مدیر واحد / کاربر اجرایی',self::Inspector=>'بازرس'}; }
}
