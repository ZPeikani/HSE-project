<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PpeType extends Model { protected $fillable=['name','category','standard','replacement_days','is_active']; protected function casts():array{return['is_active'=>'boolean'];} public function issues(){return $this->hasMany(PpeIssue::class);} }
