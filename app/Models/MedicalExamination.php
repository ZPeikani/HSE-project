<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class MedicalExamination extends Model {
 protected $fillable=['occupational_health_profile_id','examination_type','examination_date','health_center','physician','result','fitness_status','restrictions','follow_up_required','follow_up_date','next_examination_date','notes','attachment_path','attachment_name','data_source','external_id','last_synced_at','created_by','updated_by'];
 protected function casts():array{return['examination_date'=>'date','follow_up_required'=>'boolean','follow_up_date'=>'date','next_examination_date'=>'date','last_synced_at'=>'datetime'];}
 public function profile(){return $this->belongsTo(OccupationalHealthProfile::class,'occupational_health_profile_id');} public function creator(){return $this->belongsTo(User::class,'created_by');}
 public function getTypeLabelAttribute():string{return match($this->examination_type){'pre_employment'=>'بدو استخدام','periodic'=>'دوره‌ای','return_to_work'=>'بازگشت به کار','job_change'=>'تغییر شغل','special'=>'موردی','exit'=>'پایان خدمت',default=>$this->examination_type};}
 public function getFitnessLabelAttribute():string{return match($this->fitness_status){'fit'=>'مجاز به کار','fit_with_restrictions'=>'مجاز با محدودیت','temporarily_unfit'=>'عدم صلاحیت موقت','unfit'=>'عدم صلاحیت','pending'=>'در انتظار ارزیابی',default=>'ثبت نشده'};}
}
