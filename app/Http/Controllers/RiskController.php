<?php
namespace App\Http\Controllers;
use App\Models\{Department,Risk,User};
use Illuminate\Http\Request;
class RiskController extends Controller {
 public function index(Request $r){$q=Risk::with('department','reporter')->latest();if($r->user()->hasRole('unit_manager'))$q->where('department_id',$r->user()->department_id);if($r->user()->hasRole('inspector'))$q->where('identified_by',$r->user()->id);if($r->filled('level'))$q->where('risk_level',$r->level);if($r->filled('method'))$q->where('assessment_method',$r->method);if($r->filled('q'))$q->where(fn($x)=>$x->where('title','like','%'.$r->q.'%')->orWhere('code','like','%'.$r->q.'%')->orWhere('category','like','%'.$r->q.'%'));return view('risks.index',['risks'=>$q->paginate(15)->withQueryString()]);}
 public function create(){return view('risks.create',['departments'=>Department::where('is_active',true)->get(),'users'=>User::where('is_active',true)->get()]);}
 public function store(Request $r){
  if($r->filled('review_due_at'))$r->merge(['review_due_at'=>optional(jalaliToCarbon($r->input('review_due_at')))?->toDateString()??$r->input('review_due_at')]);
  $d=$r->validate(['title'=>'required|max:190','description'=>'required','category'=>'required|max:100','department_id'=>'required|exists:departments,id','owner_id'=>'nullable|exists:users,id','likelihood'=>'required|integer|between:1,5','severity'=>'required|integer|between:1,5','residual_likelihood'=>'nullable|integer|between:1,5','residual_severity'=>'nullable|integer|between:1,5','existing_controls'=>'nullable','proposed_controls'=>'nullable','review_due_at'=>'nullable|date']);
  if($r->user()->hasRole('unit_manager'))$d['department_id']=$r->user()->department_id;$residual=isset($d['residual_likelihood'],$d['residual_severity'])?$d['residual_likelihood']*$d['residual_severity']:null;
  $d+=['code'=>$this->code('RSK'),'identified_by'=>$r->user()->id,'assessment_method'=>'matrix','risk_score'=>$d['likelihood']*$d['severity'],'risk_level'=>Risk::level($d['likelihood']*$d['severity']),'residual_score'=>$residual,'residual_level'=>$residual?Risk::level($residual):null,'status'=>'open'];$risk=Risk::create($d);$this->log('created',$risk,'خطر جدید شناسایی و ارزیابی شد.');return redirect()->route('risks.show',$risk)->with('success','خطر ثبت شد.');
 }
 public function show(Risk $risk){$u=auth()->user();abort_if($u->hasRole('unit_manager')&&$risk->department_id!==$u->department_id,403);abort_if($u->hasRole('inspector')&&$risk->identified_by!==$u->id,403);$risk->load('department','reporter','owner','actions.assignee','jsa.steps','fmea.items');return view('risks.show',compact('risk'),['users'=>User::where('is_active',true)->get()]);}
}
