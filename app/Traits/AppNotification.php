<?php

namespace App\Traits;

use Kreait\Firebase\Messaging\CloudMessage;

trait AppNotification {
    public function sendFcmMessage($token, $title, $body) {
        $firebase = app('firebase');
        $messaging = $firebase->createMessaging();
        $message = CloudMessage::fromArray([
            'token' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
        ]);
        echo "Sending message...";
        $messaging->send($message);
    }
}