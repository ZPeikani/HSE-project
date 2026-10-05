<?php
namespace App\Http\Controllers;
use App\Models\{CorrectiveAction,Incident,Risk,SafetyEquipment,WorkPermit,OccupationalHealthProfile,HseNotification};
use App\Services\HseReminderService;
class DashboardController extends Controller {
 public function __invoke(HseReminderService $reminders){
  $u=auth()->user();$department=$u->hasRole('unit_manager')?$u->department_id:null;$reminders->syncFor($u);
  $actions=CorrectiveAction::query()->when($department,fn($q)=>$q->where('department_id',$department))->when($u->hasRole('inspector'),fn($q)=>$q->where('assignee_id',$u->id));
  $risks=Risk::query()->when($department,fn($q)=>$q->where('department_id',$department))->when($u->hasRole('inspector'),fn($q)=>$q->where('identified_by',$u->id));
  $incidents=Incident::query()->when($department,fn($q)=>$q->where('department_id',$department))->when($u->hasRole('inspector'),fn($q)=>$q->where('reported_by',$u->id));
  $profiles=OccupationalHealthProfile::query()->when($department,fn($q)=>$q->whereHas('user',fn($x)=>$x->where('department_id',$department)));
  $safety=['open_actions'=>(clone $actions)->whereNotIn('status',['verified','closed'])->count(),'overdue_actions'=>(clone $actions)->whereDate('due_date','<',today())->whereNotIn('status',['verified','closed'])->count(),'high_risks'=>(clone $risks)->whereIn('risk_level',['زیاد','بحرانی'])->where('status','open')->count(),'incidents_month'=>(clone $incidents)->where('occurred_at','>=',now()->startOfMonth())->count(),'equipment_due'=>SafetyEquipment::when($department,fn($q)=>$q->where('department_id',$department))->where(fn($q)=>$q->whereDate('next_inspection_at','<=',today())->orWhereDate('next_service_at','<=',today())->orWhereDate('expiry_date','<=',today()))->count(),'permits_active'=>WorkPermit::when($department,fn($q)=>$q->where('department_id',$department))->whereIn('status',['approved','active'])->count()];
  $health=['profiles'=>(clone $profiles)->count(),'expired'=>(clone $profiles)->whereDate('next_examination_date','<',today())->count(),'upcoming'=>(clone $profiles)->whereBetween('next_examination_date',[today(),today()->addDays(30)])->count(),'restrictions'=>(clone $profiles)->whereIn('fitness_status',['fit_with_restrictions','temporarily_unfit','unfit'])->count(),'followups'=>(clone $profiles)->where('follow_up_required',true)->count()];
  $alerts=HseNotification::where('user_id',$u->id)->whereNull('read_at')->latest()->limit(6)->get();
  return view('dashboard.index',compact('safety','health','alerts'));
 }
}
