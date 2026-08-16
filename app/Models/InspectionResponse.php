<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class InspectionResponse extends Model { protected $fillable=['inspection_id','checklist_item_id','answer','note','evidence_path']; public function item(){return $this->belongsTo(ChecklistItem::class,'checklist_item_id');} }
