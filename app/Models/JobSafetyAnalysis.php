<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JobSafetyAnalysis extends Model { protected $table='job_safety_analyses'; protected $fillable=['risk_id','activity','location','department_id','owner_id','review_due_at','status']; protected function casts():array{return['review_due_at'=>'date'];} public function risk(){return $this->belongsTo(Risk::class);} public function department(){return $this->belongsTo(Department::class);} public function owner(){return $this->belongsTo(User::class,'owner_id');} public function steps(){return $this->hasMany(JsaStep::class,'jsa_id')->orderBy('sort_order');} }
