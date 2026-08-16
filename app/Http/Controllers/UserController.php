<?php
namespace App\Http\Controllers;
use App\Enums\UserRole; use App\Models\{Department,User}; use Illuminate\Http\Request; use Illuminate\Validation\Rules\Password; use Illuminate\Validation\Rule;
class UserController extends Controller {
 public function index(){return view('users.index',['users'=>User::with('department')->latest()->paginate(15)]);}
 public function create(){return view('users.form',['user'=>new User,'roles'=>UserRole::cases(),'departments'=>Department::where('is_active',true)->get()]);}
 public function store(Request $r){$d=$this->validated($r);$u=User::create($d);$this->log('created',$u,'حساب کاربری ایجاد شد.');return redirect()->route('users.index')->with('success','کاربر ایجاد شد.');}
 public function edit(User $user){return view('users.form',compact('user'),['roles'=>UserRole::cases(),'departments'=>Department::where('is_active',true)->get()]);}
 public function update(Request $r,User $user){$d=$this->validated($r,$user);if(empty($d['password']))unset($d['password']);$user->update($d);$this->log('updated',$user,'حساب کاربری ویرایش شد.');return redirect()->route('users.index')->with('success','اطلاعات کاربر به‌روزرسانی شد.');}
 public function toggle(User $user){abort_if($user->is(auth()->user()),422,'امکان غیرفعال‌کردن حساب خودتان وجود ندارد.');$user->update(['is_active'=>!$user->is_active]);return back()->with('success','وضعیت حساب تغییر کرد.');}
 private function validated(Request $r,?User $u=null):array{return $r->validate(['name'=>'required|max:190','personnel_code'=>['nullable','max:50',Rule::unique('users')->ignore($u)],'phone'=>['nullable','max:20',Rule::unique('users')->ignore($u)],'email'=>['required','email',Rule::unique('users')->ignore($u)],'password'=>[$u?'nullable':'required',Password::min(8)],'role'=>['required',Rule::enum(UserRole::class)],'department_id'=>'nullable|exists:departments,id','is_active'=>'nullable|boolean']);}
}
