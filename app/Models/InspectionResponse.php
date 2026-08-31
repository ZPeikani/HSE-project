<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class InspectionResponse extends Model { protected $fillable=['inspection_id','checklist_item_id','answer','note','evidence_path','is_nonconformity','corrective_action_id','risk_id']; protected function casts():array{return['is_nonconformity'=>'boolean'];} public function item(){return $this->belongsTo(ChecklistItem::class,'checklist_item_id');} public function action(){return $this->belongsTo(CorrectiveAction::class,'corrective_action_id');} public function risk(){return $this->belongsTo(Risk::class);} }
