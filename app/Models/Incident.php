<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Incident extends Model {
 protected $fillable=['code','type','title','description','department_id','reported_by','occurred_at','location','injury_level','lost_days','immediate_actions','root_cause','status'];
 protected function casts():array{return['occurred_at'=>'datetime'];} public function department(){return $this->belongsTo(Department::class);} public function reporter(){return $this->belongsTo(User::class,'reported_by');} public function actions(){return $this->morphMany(CorrectiveAction::class,'actionable');} public function attachments(){return $this->morphMany(Attachment::class,'attachable');}
}
