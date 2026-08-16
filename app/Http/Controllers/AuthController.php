<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller {
 public function create(){return view('auth.login');}

 public function store(Request $r){
  // مرحله ۱: اعتبارسنجی فرمت
  $r->validate([
   'email'    => ['required','email'],
   'password' => ['required'],
  ],[
   'email.required'    => 'وارد کردن ایمیل الزامی است.',
   'email.email'       => 'فرمت ایمیل صحیح نیست.',
   'password.required' => 'وارد کردن رمز عبور الزامی است.',
  ]);

  // مرحله ۲: وجود کاربر با این ایمیل
  $user = User::where('email', $r->email)->first();
  if (!$user) {
   return back()
    ->withErrors(['email' => 'این ایمیل در سیستم ثبت نشده است.'])
    ->onlyInput('email');
  }

  // مرحله ۳: صحت رمز عبور
  if (!Hash::check($r->password, $user->password)) {
   return back()
    ->withErrors(['password' => 'رمز عبور صحیح نیست.'])
    ->onlyInput('email');
  }

  // مرحله ۴: فعال بودن حساب
  if (!$user->is_active) {
   return back()
    ->withErrors(['email' => 'حساب کاربری شما غیرفعال است.'])
    ->onlyInput('email');
  }

  // مرحله ۵: ورود
  Auth::login($user, $r->boolean('remember'));
  $r->session()->regenerate();
  $user->update(['last_login_at' => now()]);
  return redirect()->intended(route('dashboard'));
 }
 public function destroy(Request $r){Auth::logout();$r->session()->invalidate();$r->session()->regenerateToken();return redirect()->route('login');}
}
