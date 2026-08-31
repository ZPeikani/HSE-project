<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Risk extends Model {
 protected $fillable=['code','title','description','category','department_id','inspection_id','identified_by','owner_id','assessment_method','likelihood','severity','risk_score','risk_level','residual_likelihood','residual_severity','residual_score','residual_level','existing_controls','proposed_controls','review_due_at','status'];
 protected function casts():array{return['review_due_at'=>'date'];}
 public function department(){return $this->belongsTo(Department::class);} public function reporter(){return $this->belongsTo(User::class,'identified_by');} public function owner(){return $this->belongsTo(User::class,'owner_id');} public function inspection(){return $this->belongsTo(Inspection::class);} public function actions(){return $this->morphMany(CorrectiveAction::class,'actionable');} public function jsa(){return $this->hasOne(JobSafetyAnalysis::class);} public function fmea(){return $this->hasOne(FmeaAnalysis::class);}
 public static function level(int $score):string{return match(true){$score>=17=>'بحرانی',$score>=10=>'زیاد',$score>=5=>'متوسط',default=>'کم'};}
}
