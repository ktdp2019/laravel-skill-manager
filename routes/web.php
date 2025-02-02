<?php

use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Messaging\CloudMessage;

Route::get('/', function () {
    $firebase = app('firebase');
    $messaging = $firebase->createMessaging();

    $message = CloudMessage::fromArray([
        'token' => 'd2uwLEvWSKmvTxqtuNs9Vn:APA91bED-Sfc7EUqhafSlt2mOqSeWthmkJfUPtzHxPbw0Xbd0DC2cxKOg27irsy6hV4yIJnR_GQFwGfqDiHpASsZfQQJUXQ4lUEQbVwyQR38Nj2d72vKv5g',
        'notification' => [
            'title' => 'New Message in server',
            'body' => 'You have a new notification!',
        ],
    ]);

    $messaging->send($message);
    return view('welcome');
});
