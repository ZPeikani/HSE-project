<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Risk extends Model {
 protected $fillable=['code','title','description','category','department_id','inspection_id','identified_by','likelihood','severity','risk_score','risk_level','existing_controls','proposed_controls','status'];
 public function department(){return $this->belongsTo(Department::class);} public function reporter(){return $this->belongsTo(User::class,'identified_by');} public function inspection(){return $this->belongsTo(Inspection::class);} public function actions(){return $this->morphMany(CorrectiveAction::class,'actionable');}
 public static function level(int $score):string{return match(true){$score>=17=>'بحرانی',$score>=10=>'زیاد',$score>=5=>'متوسط',default=>'کم'};}
}
