<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChecklistItem extends Model { protected $fillable=['checklist_id','question','guidance','weight','is_critical','sort_order']; protected function casts():array{return['is_critical'=>'boolean'];} }
