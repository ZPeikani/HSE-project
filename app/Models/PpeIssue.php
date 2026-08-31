<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PpeIssue extends Model { protected $fillable=['user_id','ppe_type_id','quantity','issued_at','expires_at','returned_at','condition','status','issued_by','notes']; protected function casts():array{return['issued_at'=>'date','expires_at'=>'date','returned_at'=>'date'];} public function user(){return $this->belongsTo(User::class);} public function type(){return $this->belongsTo(PpeType::class,'ppe_type_id');} public function issuer(){return $this->belongsTo(User::class,'issued_by');} }
