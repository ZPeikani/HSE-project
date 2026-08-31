<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JsaStep extends Model { protected $fillable=['jsa_id','sort_order','step','hazard','consequence','controls','likelihood','severity','risk_score','residual_likelihood','residual_severity','residual_score']; public function analysis(){return $this->belongsTo(JobSafetyAnalysis::class,'jsa_id');} }
