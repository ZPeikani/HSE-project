<?php
namespace App\Http\Controllers;
use App\Models\HseNotification;
use App\Services\HseReminderService;
class NotificationController extends Controller { public function index(HseReminderService $service){$service->syncFor(auth()->user());return view('notifications.index',['notifications'=>HseNotification::where('user_id',auth()->id())->latest()->paginate(20)]);} public function read(HseNotification $notification){abort_unless($notification->user_id===auth()->id(),403);$notification->update(['read_at'=>now()]);return $notification->notifiable_type===\App\Models\CorrectiveAction::class?redirect()->route('actions.show',$notification->notifiable_id):back();} }
