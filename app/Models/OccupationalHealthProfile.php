<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OccupationalHealthProfile extends Model {
 protected $fillable=['user_id','job_title','employment_start_date','fitness_status','medical_restrictions','follow_up_required','follow_up_date','occupational_disease_status','notes','last_examination_date','next_examination_date','last_examination_type','created_by','updated_by'];
 protected function casts():array{return['employment_start_date'=>'date','follow_up_required'=>'boolean','follow_up_date'=>'date','last_examination_date'=>'date','next_examination_date'=>'date'];}
 public function user(){return $this->belongsTo(User::class);} public function examinations(){return $this->hasMany(MedicalExamination::class,'occupational_health_profile_id');}
 public function creator(){return $this->belongsTo(User::class,'created_by');}
 public function getFitnessLabelAttribute():string{return match($this->fitness_status){'fit'=>'مجاز به کار','fit_with_restrictions'=>'مجاز با محدودیت','temporarily_unfit'=>'عدم صلاحیت موقت','unfit'=>'عدم صلاحیت','pending'=>'در انتظار ارزیابی',default=>'ثبت نشده'};}
}
