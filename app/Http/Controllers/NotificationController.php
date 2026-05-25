<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsNotified(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $notification = Notification::find($id);
            if ($notification) {
                // Use 'is_notified' so it doesn't get marked as read automatically
                $notification->update(['is_notified' => true]);
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false], 404);
    }

    public function markAllRead()
    {
        Notification::where('user_id', \Auth::id())->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function getNotifications()
    {
        $user = \Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $notifications = Notification::where('user_id', (string)$user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $notifications
        ]);
    }
}
