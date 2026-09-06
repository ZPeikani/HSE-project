<?php
namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use App\Models\HseNotification;
use App\Services\HseReminderService;
class NotificationController extends Controller {
 public function index(HseReminderService $service){$service->syncFor(auth()->user());return view('notifications.index',['notifications'=>HseNotification::where('user_id',auth()->id())->latest()->paginate(20)]);}
 public function poll(HseReminderService $service):JsonResponse {
  $service->syncFor(auth()->user());
  $since=(int)request()->query('since',0);
  $new=HseNotification::where('user_id',auth()->id())->whereNull('read_at')->where('id','>',$since)->latest()->get(['id','title','message','type']);
  return response()->json(['unread_count'=>HseNotification::where('user_id',auth()->id())->whereNull('read_at')->count(),'notifications'=>$new->values()]);
 }
 public function read(HseNotification $notification){abort_unless($notification->user_id===auth()->id(),403);$notification->update(['read_at'=>now()]);return $notification->notifiable_type===\App\Models\CorrectiveAction::class?redirect()->route('actions.show',$notification->notifiable_id):back();}
}
