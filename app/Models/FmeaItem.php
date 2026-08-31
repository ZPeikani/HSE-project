<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FmeaItem extends Model { protected $fillable=['fmea_id','sort_order','failure_mode','effect','cause','existing_control','severity','occurrence','detection','rpn','recommended_action']; public function analysis(){return $this->belongsTo(FmeaAnalysis::class,'fmea_id');} }
