<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Checklist extends Model { protected $fillable=['title','category','description','version','is_active','created_by']; protected function casts():array{return['is_active'=>'boolean'];} public function items(){return $this->hasMany(ChecklistItem::class)->where('is_active',true)->orderBy('sort_order');} public function allItems(){return $this->hasMany(ChecklistItem::class)->orderBy('sort_order');} public function activeItems(){return $this->items();} public function inspections(){return $this->hasMany(Inspection::class); } }
