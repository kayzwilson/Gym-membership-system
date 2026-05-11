<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }

    public function markRead(Notification $notification)
    {
        $notification->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
        return back()->with('success', 'Notification marked as read!');
    }

    public function markAllRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        return back()->with('success', 'All notifications marked as read!');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return back()->with('success', 'Notification deleted!');
    }
}