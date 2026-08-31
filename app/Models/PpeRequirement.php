<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PpeRequirement extends Model { protected $fillable=['department_id','job_title','ppe_type_id','quantity','notes']; public function department(){return $this->belongsTo(Department::class);} public function type(){return $this->belongsTo(PpeType::class,'ppe_type_id');} }
