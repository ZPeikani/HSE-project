<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Inspection extends Model {
 protected $fillable=['code','title','checklist_id','department_id','inspector_id','scheduled_at','started_at','completed_at','status','location','summary','score'];
 protected function casts():array{return['scheduled_at'=>'datetime','started_at'=>'datetime','completed_at'=>'datetime','score'=>'decimal:2'];}
 public function checklist(){return $this->belongsTo(Checklist::class);} public function department(){return $this->belongsTo(Department::class);} public function inspector(){return $this->belongsTo(User::class,'inspector_id');} public function responses(){return $this->hasMany(InspectionResponse::class);} public function risks(){return $this->hasMany(Risk::class);} public function actions(){return $this->morphMany(CorrectiveAction::class,'actionable');}
}
