<?php

namespace App\Helpers;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseNotifications
{
    /**
     * Send notification via Firebase Cloud Messaging using Google Auth.
     *
     * @param string $fcmToken
     * @param array $payload This includes [title, body, click_action]
     * @return array
     */
    public static function sendNotification($fcmToken, $payload)
    {
        // Get the path to the service account file from .env
        $serviceAccountPath = base_path(env('FIREBASE_CREDENTIALS'));
        $projectId = 'crmanagement-7a4dc';

        // Define the required scopes for Firebase Cloud Messaging
        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];

        try {
            // Create a credentials object using the service account JSON file and the required scopes
            $credentials = new ServiceAccountCredentials($scopes, $serviceAccountPath);
        } catch (\Exception $e) {
            Log::error("Error initializing Firebase credentials: " . $e->getMessage());
            return; // or handle it accordingly
        }

        // Fetch the access token
        $accessToken = $credentials->fetchAuthToken()['access_token'];

        // Define the notification payload
        $data = [
            "message" => [
                "token" => $fcmToken,
                "notification" => [
                    "title" => $payload['title'],
                    "body" => $payload['body']
                ],
                "data" => [
                    "click_action" => isset($payload['click_action']) ? $payload['click_action'] : "/dashboard", // Redirect URL
                    "icon" => isset($payload['icon']) ? $payload['icon'] : asset('assets/media/logos/favicon.ico'), // Icon
                ]
            ]
        ];

        // Make the HTTP request to Firebase Cloud Messaging using the generated access token
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Content-Type' => 'application/json',
        ])->post('https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send', $data);

        // Log the FCM token, response status and body
        Log::info('FCM Response:', ['token' => $fcmToken, 'status' => $response->status(), 'response' => $response->json()]);

        return $response->json();
    }
}