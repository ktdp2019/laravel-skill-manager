<?php

namespace App\Traits;

use Kreait\Firebase\Messaging\CloudMessage;

trait AppNotification {
    public function sendMessage() {
        $firebase = app('firebase');
        $messaging = $firebase->createMessaging();
        $message = CloudMessage::fromArray([
            'token' => 'eeHED2D0S32VZ-i-IOh4nU:APA91bHr6EIhmZQsf7k-hLFa7cMZdYbwkjH3fKr4xTJ-shbBg_QEwxhzzLyanaXC1Le_OMW15u5-zpCTotoqGJ4jbOeL8soYArsm_iLa6hBFSj2yZtGpt30',
            'notification' => [
                'title' => 'New Message in server',
                'body' => 'You have a new notification!',
            ],
        ]);
        echo "Sending message...";
        $messaging->send($message);
    }
}