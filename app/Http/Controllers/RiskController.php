<?php
namespace App\Http\Controllers;
use App\Models\{Department,Risk}; use Illuminate\Http\Request;
class RiskController extends Controller {
 public function index(Request $r){$q=Risk::with('department','reporter')->latest();if($r->user()->hasRole('unit_manager'))$q->where('department_id',$r->user()->department_id);if($r->user()->hasRole('inspector'))$q->where('identified_by',$r->user()->id);if($r->filled('level'))$q->where('risk_level',$r->level);return view('risks.index',['risks'=>$q->paginate(15)]);}
 public function create(){return view('risks.create',['departments'=>Department::where('is_active',true)->get()]);}
 public function store(Request $r){$d=$r->validate(['title'=>'required|max:190','description'=>'required','category'=>'required|max:100','department_id'=>'required|exists:departments,id','likelihood'=>'required|integer|between:1,5','severity'=>'required|integer|between:1,5','existing_controls'=>'nullable','proposed_controls'=>'nullable']);if($r->user()->hasRole('unit_manager'))$d['department_id']=$r->user()->department_id;$d+=['code'=>$this->code('RSK'),'identified_by'=>$r->user()->id,'risk_score'=>$d['likelihood']*$d['severity'],'risk_level'=>Risk::level($d['likelihood']*$d['severity']),'status'=>'open'];$risk=Risk::create($d);$this->log('created',$risk,'خطر جدید شناسایی و ارزیابی شد.');return redirect()->route('risks.show',$risk)->with('success','خطر ثبت شد.');}
 public function show(Risk $risk){$u=auth()->user();abort_if($u->hasRole('unit_manager')&&$risk->department_id!==$u->department_id,403);abort_if($u->hasRole('inspector')&&$risk->identified_by!==$u->id,403);$risk->load('department','reporter','actions.assignee');return view('risks.show',compact('risk'));}
}
