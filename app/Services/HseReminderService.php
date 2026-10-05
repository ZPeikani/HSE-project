<?php
namespace App\Services;
use App\Models\{CorrectiveAction,HseNotification,SafetyEquipment,User,OccupationalHealthProfile};
class HseReminderService {
 public function syncFor(User $user):void {
    $this->syncCorrectiveActions($user);
    $this->syncEquipment($user);
    $this->syncHealth($user);
 }

 private function syncCorrectiveActions(User $user):void {
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

 private function syncEquipment(User $user):void {
    if($user->hasRole('inspector'))return;
    $query=SafetyEquipment::query()->where('status','active');
    if($user->hasRole('unit_manager'))$query->where('department_id',$user->department_id);
    foreach($query->get() as $equipment){
     $deadlines=collect([
      ['field'=>'next_inspection_at','label'=>'بازرسی تجهیز'],
      ['field'=>'next_service_at','label'=>'سرویس تجهیز'],
      ['field'=>'next_recharge_at','label'=>'شارژ تجهیز'],
      ['field'=>'expiry_date','label'=>'انقضای تجهیز'],
     ])->filter(fn($item)=>$equipment->{$item['field']})->map(fn($item)=>$item+['date'=>$equipment->{$item['field']}])->sortBy('date');
     $deadline=$deadlines->first(fn($item)=>today()->diffInDays($item['date'],false)<=7);
     $key="equipment:{$equipment->id}:{$user->id}";
     HseNotification::where('user_id',$user->id)->where('notifiable_type',$equipment::class)->where('notifiable_id',$equipment->id)->where('notification_key','!=',$key)->delete();
     if(!$deadline){HseNotification::where('notification_key',$key)->delete();continue;}
     $days=today()->diffInDays($deadline['date'],false);
     $type=$days<0?'overdue':($days===0?'due_today':'upcoming');
     $title=$days<0?"{$deadline['label']} معوق":($days===0?"{$deadline['label']} امروز است":"نزدیک‌شدن {$deadline['label']}");
     HseNotification::updateOrCreate(['notification_key'=>$key],[
      'user_id'=>$user->id,'type'=>$type,'title'=>$title,
      'message'=>"{$equipment->code} — {$equipment->name}",
      'notifiable_type'=>$equipment::class,'notifiable_id'=>$equipment->id,'due_at'=>$deadline['date'],
     ]);
    }
 }
 private function syncHealth(User $user):void {
    if($user->hasRole('inspector'))return;
    $query=OccupationalHealthProfile::with('user');
    if($user->hasRole('unit_manager'))$query->whereHas('user',fn($q)=>$q->where('department_id',$user->department_id));
    foreach($query->get() as $profile){
      if($profile->next_examination_date){
       $days=today()->diffInDays($profile->next_examination_date,false);
       if($days<=30){
       $type=$days<0?'overdue':($days===0?'due_today':'upcoming');
       $key="health-exam:{$profile->id}:{$type}:{$user->id}";
       HseNotification::firstOrCreate(['notification_key'=>$key],[
        'user_id'=>$user->id,'type'=>$type,
        'title'=>$days<0?'معاینه طب کار منقضی شده':($days===0?'سررسید معاینه طب کار':'نزدیک‌شدن موعد معاینه طب کار'),
        'message'=>($profile->user?->name??'کارمند').' — '.($profile->job_title??'پرونده سلامت'),
        'notifiable_type'=>$profile::class,'notifiable_id'=>$profile->id,'due_at'=>$profile->next_examination_date,
       ]);
       }
      }
      if($profile->follow_up_required && $profile->follow_up_date && today()->diffInDays($profile->follow_up_date,false)<=7){
       $d=today()->diffInDays($profile->follow_up_date,false);$type=$d<0?'overdue':($d===0?'due_today':'upcoming');
       HseNotification::firstOrCreate(['notification_key'=>"health-followup:{$profile->id}:{$type}:{$user->id}"],[
        'user_id'=>$user->id,'type'=>$type,'title'=>$d<0?'پیگیری پزشکی معوق':'پیگیری پزشکی نزدیک است',
        'message'=>($profile->user?->name??'کارمند').' — پیگیری پرونده سلامت','notifiable_type'=>$profile::class,'notifiable_id'=>$profile->id,'due_at'=>$profile->follow_up_date,
       ]);
      }
    }
 }

}
