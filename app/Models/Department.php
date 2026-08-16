<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Department extends Model { protected $fillable=['name','code','manager_id','location','is_active']; protected function casts():array{return['is_active'=>'boolean'];} public function manager(){return $this->belongsTo(User::class,'manager_id');} public function users(){return $this->hasMany(User::class);} }
