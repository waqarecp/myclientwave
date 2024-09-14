<?php

namespace App\Jobs;

use App\Helpers\FirebaseNotifications;
use App\Models\FirebaseToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendFirebaseNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userIds;
    protected $notificationData;

    /**
     * Create a new job instance.
     *
     * @param array $userIds
     * @param array $notificationData
     */
    public function __construct($userIds, $notificationData)
    {
        $this->userIds = $userIds;
        $this->notificationData = $notificationData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Retrieve FCM tokens for the given user IDs
        $fcmTokensData = FirebaseToken::whereIn('user_id', $this->userIds)->pluck('fcm_token', 'user_id')->toArray();
 
        // Check if there are any tokens to send notifications to
        if (!empty($fcmTokensData)) {
            foreach ($fcmTokensData as $userId => $token) {
                if ($token) {
                    $response = FirebaseNotifications::sendNotification(
                        $token,
                        [
                            'title' => $this->notificationData['title'],
                            'body' => $this->notificationData['body'],
                            'click_action' => $this->notificationData['click_action']
                        ]
                    );
                    
                    // Check for 'UNREGISTERED' error and remove the token
                    if (isset($response['error']) && $response['error']['status'] === 'NOT_FOUND') {
                        FirebaseToken::where('fcm_token', $token)->delete();
                        Log::info("Deleted unregistered FCM token {$token}");
                    }
                }
            }
        }
    }
}

