<?php
namespace App\Http\Controllers;
use App\Models\{MedicalExamination,OccupationalHealthProfile};
use Illuminate\Http\Request;
class HealthDashboardController extends Controller {
 public function __invoke(Request $r){
  $u=$r->user(); $profiles=OccupationalHealthProfile::query()->with('user.department');
  if($u->hasRole('unit_manager'))$profiles->whereHas('user',fn($q)=>$q->where('department_id',$u->department_id));
  $exams=MedicalExamination::query()->whereHas('profile',fn($q)=>$u->hasRole('unit_manager')?$q->whereHas('user',fn($x)=>$x->where('department_id',$u->department_id)):$q);
  $stats=['profiles'=>(clone $profiles)->count(),'valid'=>(clone $profiles)->whereDate('next_examination_date','>',today()->addDays(30))->count(),'upcoming'=>(clone $profiles)->whereBetween('next_examination_date',[today(),today()->addDays(30)])->count(),'expired'=>(clone $profiles)->whereDate('next_examination_date','<',today())->count(),'restrictions'=>(clone $profiles)->whereIn('fitness_status',['fit_with_restrictions','temporarily_unfit','unfit'])->count(),'followups'=>(clone $profiles)->where('follow_up_required',true)->count()];
  $fitness=(clone $profiles)->selectRaw('fitness_status, COUNT(*) total')->groupBy('fitness_status')->pluck('total','fitness_status');
  $recent=(clone $exams)->with('profile.user.department')->latest('examination_date')->limit(6)->get();
  $attention=(clone $profiles)->with('user.department')->where(fn($q)=>$q->whereDate('next_examination_date','<=',today()->addDays(30))->orWhere('follow_up_required',true)->orWhereIn('fitness_status',['fit_with_restrictions','temporarily_unfit','unfit']))->orderBy('next_examination_date')->limit(8)->get();
  return view('health.dashboard',compact('stats','fitness','recent','attention'));
 }
}
