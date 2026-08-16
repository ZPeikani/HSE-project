<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class CorrectiveAction extends Model {
 protected $fillable=['code','title','description','actionable_type','actionable_id','department_id','assignee_id','assigned_by','priority','due_date','status','result','completed_at','verified_by','verified_at','rejection_reason'];
 protected function casts():array{return['due_date'=>'date','completed_at'=>'datetime','verified_at'=>'datetime'];} public function actionable(){return $this->morphTo();} public function department(){return $this->belongsTo(Department::class);} public function assignee(){return $this->belongsTo(User::class,'assignee_id');} public function attachments(){return $this->morphMany(Attachment::class,'attachable');} public function getIsOverdueAttribute():bool{return !in_array($this->status,['verified','closed'])&&$this->due_date?->isPast();}
}
