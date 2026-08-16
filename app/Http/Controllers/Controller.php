<?php
namespace App\Http\Controllers;
abstract class Controller { protected function code(string $prefix):string{return $prefix.'-'.now()->format('ymd').'-'.str_pad((string)random_int(1,9999),4,'0',STR_PAD_LEFT);} protected function log(string $event,object $subject,string $description):void{\App\Models\ActivityLog::create(['user_id'=>auth()->id(),'event'=>$event,'subject_type'=>$subject::class,'subject_id'=>$subject->id,'description'=>$description,'ip_address'=>request()->ip()]);} }
