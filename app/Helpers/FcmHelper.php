<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use App\Models\User;

class FcmHelper
{
    /**
     * Send FCM Notification to a single user
     */
    public static function sendToUser(User $user, string $title, string $body, array $data = []): bool
    {
        if (!$user->fcm_token) {
            return false;
        }

        return self::send($user->fcm_token, $title, $body, $data);
    }

    /**
     * Send FCM Notification to multiple users
     */
    public static function sendToUsers(array $users, string $title, string $body, array $data = []): int
    {
        $count = 0;
        foreach ($users as $user) {
            if (self::sendToUser($user, $title, $body, $data)) {
                $count++;
            }
        }
        return $count;
    }

    /**
     * Send FCM Notification directly
     */
    public static function send(string $token, string $title, string $body, array $data = []): bool
    {
        $serverKey = config('services.fcm.server_key');
        
        if (!$serverKey) {
            return false;
        }

        $payload = [
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            ],
            'data' => array_merge([
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'status' => 'done',
            ], $data),
            'to' => $token,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', $payload);

            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }
}
