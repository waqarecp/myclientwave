<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; // <-- Make sure this is imported
use Illuminate\Http\Request;
use App\Models\FirebaseToken;
use App\Helpers\FirebaseNotifications;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        // Validate input (e.g., user ID or token)
        $request->validate([
            'user_id' => 'required|integer',
        ]);

        // Retrieve FCM tokens for the user from the database
        $fcmTokens = FirebaseToken::where('user_id', $request->input('user_id'))
            ->pluck('fcm_token')
            ->toArray();

        // Check if there are any tokens to send notifications to
        if (!empty($fcmTokens)) {
            FirebaseNotifications::sendNotification(
                'New Lead Created',
                'A new lead has been assigned to you.',
                $fcmTokens
            );
            return response()->json(['status' => 'Notification sent successfully'], 200);
        } else {
            return response()->json(['status' => 'No tokens found'], 404);
        }
    }
}
