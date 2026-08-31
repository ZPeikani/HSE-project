<?php
namespace App\Http\Controllers;
use App\Models\{CorrectiveAction,Incident,Inspection,Risk,ActivityLog,HseNotification,SafetyEquipment,WorkPermit,PpeIssue};
use App\Services\HseReminderService;
class DashboardController extends Controller {
 public function __invoke(HseReminderService $reminders){
  $u=auth()->user(); $department=$u->hasRole(['unit_manager'])?$u->department_id:null;
  $reminders->syncFor($u);
  $actions=CorrectiveAction::query()->when($u->hasRole('unit_manager'),fn($q)=>$q->where('department_id',$department))->when($u->hasRole('inspector'),fn($q)=>$q->where('assignee_id',$u->id));
  $risks=Risk::query()->when($department,fn($q)=>$q->where('department_id',$department))->when($u->hasRole('inspector'),fn($q)=>$q->where('identified_by',$u->id)); $incidents=Incident::query()->when($department,fn($q)=>$q->where('department_id',$department))->when($u->hasRole('inspector'),fn($q)=>$q->where('reported_by',$u->id));
  $stats=['open_actions'=>(clone $actions)->whereNotIn('status',['verified','closed'])->count(),'overdue_actions'=>(clone $actions)->whereDate('due_date','<',today())->whereNotIn('status',['verified','closed'])->count(),'high_risks'=>(clone $risks)->whereIn('risk_level',['زیاد','بحرانی'])->where('status','open')->count(),'incidents_month'=>(clone $incidents)->where('occurred_at','>=',now()->startOfMonth())->count(),'equipment_due'=>SafetyEquipment::when($department,fn($q)=>$q->where('department_id',$department))->where(fn($q)=>$q->whereDate('next_inspection_at','<=',today())->orWhereDate('next_service_at','<=',today())->orWhereDate('expiry_date','<=',today()))->count(),'permits_active'=>WorkPermit::when($department,fn($q)=>$q->where('department_id',$department))->whereIn('status',['approved','active'])->count(),'ppe_due'=>PpeIssue::where('status','issued')->whereDate('expires_at','<=',today()->addDays(30))->when($department,fn($q)=>$q->whereHas('user',fn($x)=>$x->where('department_id',$department)))->count()];
  return view('dashboard.index',compact('stats'),['actions'=>$actions->with('assignee','department')->orderBy('due_date')->limit(7)->get(),'recentRisks'=>$risks->with('department')->latest()->limit(5)->get(),'upcomingInspections'=>Inspection::with('department','inspector')->whereIn('status',['planned','in_progress'])->when($department,fn($q)=>$q->where('department_id',$department))->when($u->hasRole('inspector'),fn($q)=>$q->where('inspector_id',$u->id))->orderBy('scheduled_at')->limit(5)->get(),'activities'=>$u->hasRole(['admin','hse_manager'])?ActivityLog::with('user')->latest('created_at')->limit(6)->get():ActivityLog::with('user')->where('user_id',$u->id)->latest('created_at')->limit(6)->get(),'unreadNotifications'=>HseNotification::where('user_id',$u->id)->whereNull('read_at')->count()]);
 }
}
