<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseNotifications
{
    /**
     * Check if a value is null or empty.
     *
     * @param mixed $value
     * @return bool
     */
    public static function sendNotification($title, $body, $fcmTokens)
    {
        $SERVER_API_KEY = 'AIzaSyBLRIxATX8TWVYRSUv_sIBRyQAocaVcEf8';
        
        $data = [
            "registration_ids" => $fcmTokens,
            "notification" => [
                "title" => $title,
                "body" => $body,  
            ]
        ];
    
        $response = Http::withHeaders([
            'Authorization' => 'key=' . $SERVER_API_KEY,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/fcm/send', $data);
    
        // Log response status and body
        Log::info('FCM Response Status:', ['status' => $response->status()]);
        Log::info('FCM Response Body:', ['body' => $response->body()]);
        return $response->json();
    }
}