<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChecklistItem extends Model { protected $fillable=['checklist_id','question','guidance','weight','is_critical','sort_order','is_active']; protected function casts():array{return['is_critical'=>'boolean','is_active'=>'boolean'];} public function responses(){return $this->hasMany(InspectionResponse::class,'checklist_item_id');} }
