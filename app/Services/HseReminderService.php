<?php
namespace App\Services;
use App\Models\{CorrectiveAction,HseNotification,User};
class HseReminderService {
 public function syncFor(User $user):void {
  $query=CorrectiveAction::query()->whereNotIn('status',['verified','closed']);
  if($user->hasRole('unit_manager'))$query->where('department_id',$user->department_id);
  elseif(!$user->hasRole(['admin','hse_manager']))$query->where('assignee_id',$user->id);
  foreach($query->whereDate('due_date','<=',today()->addDays(7))->get() as $action){
   $days=today()->diffInDays($action->due_date,false);
   $type=$days<0?'overdue':($days===0?'due_today':'upcoming');
   $title=$days<0?'اقدام اصلاحی معوق':($days===0?'سررسید اقدام اصلاحی':'نزدیک‌شدن سررسید اقدام');
   HseNotification::firstOrCreate(['notification_key'=>"capa:{$action->id}:{$type}:{$user->id}"],[
    'user_id'=>$user->id,'type'=>$type,'title'=>$title,'message'=>"{$action->code} — {$action->title}",
    'notifiable_type'=>$action::class,'notifiable_id'=>$action->id,'due_at'=>$action->due_date,
   ]);
  }
 }
}
