<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Checklist extends Model { protected $fillable=['title','category','description','version','is_active','created_by']; protected function casts():array{return['is_active'=>'boolean'];} public function items(){return $this->hasMany(ChecklistItem::class)->orderBy('sort_order');} }
