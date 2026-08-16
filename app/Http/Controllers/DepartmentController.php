<?php
namespace App\Http\Controllers;
use App\Models\{Department,User}; use Illuminate\Http\Request; use Illuminate\Validation\Rule;
class DepartmentController extends Controller {
 public function index(){return view('departments.index',['departments'=>Department::with('manager')->withCount('users')->paginate(15),'managers'=>User::whereIn('role',['admin','hse_manager','unit_manager'])->get()]);}
 public function store(Request $r){$d=$r->validate(['name'=>'required|max:190','code'=>'required|max:30|unique:departments','manager_id'=>'nullable|exists:users,id','location'=>'nullable|max:190']);Department::create($d);return back()->with('success','واحد سازمانی ایجاد شد.');}
 public function update(Request $r,Department $department){$d=$r->validate(['name'=>'required|max:190','code'=>['required','max:30',Rule::unique('departments')->ignore($department)],'manager_id'=>'nullable|exists:users,id','location'=>'nullable|max:190','is_active'=>'nullable|boolean']);$department->update($d);return back()->with('success','واحد سازمانی به‌روزرسانی شد.');}
}
