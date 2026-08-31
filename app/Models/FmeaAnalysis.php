<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class FmeaAnalysis extends Model { protected $table='fmea_analyses'; protected $fillable=['risk_id','process','function','department_id','owner_id','review_due_at','status']; protected function casts():array{return['review_due_at'=>'date'];} public function risk(){return $this->belongsTo(Risk::class);} public function department(){return $this->belongsTo(Department::class);} public function owner(){return $this->belongsTo(User::class,'owner_id');} public function items(){return $this->hasMany(FmeaItem::class,'fmea_id')->orderBy('sort_order');} }
