<?php
namespace App\Models;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable {
 use HasFactory, Notifiable;
 protected $fillable=['name','personnel_code','phone','email','password','role','department_id','is_active','last_login_at'];
 protected $hidden=['password','remember_token'];
 protected function casts(): array { return ['password'=>'hashed','role'=>UserRole::class,'is_active'=>'boolean','last_login_at'=>'datetime']; }
 public function department(){return $this->belongsTo(Department::class);} public function actions(){return $this->hasMany(CorrectiveAction::class,'assignee_id');}
 public function hasRole(string|array $roles): bool { $roles=(array)$roles; return in_array($this->role?->value,$roles,true); }
}
