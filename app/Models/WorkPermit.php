<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class WorkPermit extends Model { protected $fillable=['code','title','type','department_id','requester_id','approver_id','location','description','hazards','controls','starts_at','ends_at','status','closed_at','closure_notes']; protected function casts():array{return['starts_at'=>'datetime','ends_at'=>'datetime','closed_at'=>'datetime'];} public function department(){return $this->belongsTo(Department::class);} public function requester(){return $this->belongsTo(User::class,'requester_id');} public function approver(){return $this->belongsTo(User::class,'approver_id');} public function attachments(){return $this->morphMany(Attachment::class,'attachable');} }
