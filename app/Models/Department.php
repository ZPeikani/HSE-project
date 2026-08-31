<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Department extends Model { protected $fillable=['name','code','manager_id','location','is_active']; protected function casts():array{return['is_active'=>'boolean'];} public function manager(){return $this->belongsTo(User::class,'manager_id');} public function users(){return $this->hasMany(User::class);} public function risks(){return $this->hasMany(Risk::class);} public function incidents(){return $this->hasMany(Incident::class);} public function inspections(){return $this->hasMany(Inspection::class);} public function actions(){return $this->hasMany(CorrectiveAction::class);} }
