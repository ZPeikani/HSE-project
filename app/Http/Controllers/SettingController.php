<?php
namespace App\Http\Controllers;
use App\Models\Setting; use Illuminate\Http\Request;
class SettingController extends Controller { public function edit(){return view('settings.edit',['settings'=>Setting::pluck('value','key')]);} public function update(Request $r){$d=$r->validate(['organization_name'=>'required|max:190','hse_manager_title'=>'required|max:100','action_reminder_days'=>'required|integer|between:1,30','risk_review_days'=>'required|integer|between:1,365','incident_code_prefix'=>'required|alpha_dash|max:10']);foreach($d as $key=>$value)Setting::updateOrCreate(['key'=>$key],['value'=>$value]);return back()->with('success','تنظیمات اصلی سامانه ذخیره شد.');} }
