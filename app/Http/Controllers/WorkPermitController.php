<?php
namespace App\Http\Controllers;
use App\Models\{Department,WorkPermit};
use Illuminate\Http\Request;
class WorkPermitController extends Controller {
 public function index(Request $r){$q=WorkPermit::with('department','requester','approver')->latest();if($r->user()->hasRole('unit_manager'))$q->where('department_id',$r->user()->department_id);if($r->filled('q'))$q->where(fn($x)=>$x->where('title','like','%'.$r->q.'%')->orWhere('code','like','%'.$r->q.'%'));if($r->filled('status'))$q->where('status',$r->status);return view('permits.index',['permits'=>$q->paginate(15)->withQueryString()]);}
 public function create(){return view('permits.create',['departments'=>Department::where('is_active',true)->get()]);}
 public function store(Request $r){
  foreach(['starts_at','ends_at'] as $field)if($r->filled($field))$r->merge([$field=>optional(jalaliToCarbon($r->input($field)))?->toDateTimeString()??$r->input($field)]);
  $d=$r->validate(['title'=>'required|max:190','type'=>'required|in:hot_work,confined_space,electrical,height,excavation,lifting,general','department_id'=>'required|exists:departments,id','location'=>'required|max:190','description'=>'required|max:5000','hazards'=>'required|max:5000','controls'=>'required|max:5000','starts_at'=>'required|date','ends_at'=>'required|date|after:starts_at']);
  if($r->user()->hasRole('unit_manager'))$d['department_id']=$r->user()->department_id;
  $d+=['code'=>$this->code('PTW'),'requester_id'=>$r->user()->id,'status'=>'requested'];$p=WorkPermit::create($d);$this->log('created',$p,'درخواست مجوز کار ثبت شد.');return redirect()->route('permits.show',$p)->with('success','درخواست PTW ثبت شد.');
 }
 public function show(WorkPermit $permit){$u=auth()->user();abort_if($u->hasRole('unit_manager')&&$permit->department_id!==$u->department_id,403);$permit->load('department','requester','approver');return view('permits.show',compact('permit'));}
 public function transition(Request $r,WorkPermit $permit){
  $d=$r->validate(['status'=>'required|in:assessed,approved,active,rejected,closed','closure_notes'=>'nullable|required_if:status,closed|max:2000']);$allowed=['requested'=>['assessed','rejected'],'assessed'=>['approved','rejected'],'approved'=>['active','rejected'],'active'=>['closed']];
  abort_unless(in_array($d['status'],$allowed[$permit->status]??[],true),422,'این انتقال وضعیت مجاز نیست.');
  if(in_array($d['status'],['assessed','approved','rejected']))abort_unless($r->user()->hasRole(['admin','hse_manager']),403);
  if(in_array($d['status'],['active','closed']))abort_unless($r->user()->hasRole(['admin','hse_manager'])||$permit->requester_id===$r->user()->id||($r->user()->hasRole('unit_manager')&&$permit->department_id===$r->user()->department_id),403);
  $permit->update(['status'=>$d['status'],'approver_id'=>in_array($d['status'],['approved','rejected'])?$r->user()->id:$permit->approver_id,'closed_at'=>$d['status']==='closed'?now():null,'closure_notes'=>$d['closure_notes']??null]);$this->log('status_changed',$permit,'وضعیت مجوز کار به '.$d['status'].' تغییر یافت.');return back()->with('success','وضعیت مجوز کار به‌روزرسانی شد.');
 }
}
