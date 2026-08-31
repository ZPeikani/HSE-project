<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HseNotification extends Model { protected $fillable=['notification_key','user_id','type','title','message','notifiable_type','notifiable_id','due_at','read_at']; protected function casts():array{return['due_at'=>'datetime','read_at'=>'datetime'];} public function user(){return $this->belongsTo(User::class);} public function notifiable(){return $this->morphTo();} }
