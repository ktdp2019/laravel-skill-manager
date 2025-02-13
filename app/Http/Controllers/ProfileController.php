<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AppControllerTrait;
use App\Models\Profile;

class ProfileController extends Controller
{

    use AppControllerTrait;

    // To Register FCM Token
    public function registerFCMToken(Request $request) {
        $rBody = [
            'fcm_token' => 'required',
            'uuid' => 'required',
        ];
        $this->isInvalidRequest($request, $rBody);
        $profile = new Profile();
        $profile->createProfile($request->all());
        return $this->appResponse([
            "data" => $profile,
            "status" => 201,
        ]);
    }
}
