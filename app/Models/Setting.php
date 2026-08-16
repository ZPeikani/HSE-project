<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Setting extends Model { public $timestamps=false; protected $fillable=['key','value']; public static function valueOf(string $key,mixed $default=null):mixed{return static::where('key',$key)->value('value')??$default;} }
