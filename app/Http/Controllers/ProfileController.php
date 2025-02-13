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
            "success" => true,
        ]);
    }

    // Update fcm token
    public function updateUserId(Request $request) {
        $rBody = [
            'uuid' => 'required',
        ];
        $this->isInvalidRequest($request, $rBody);
        $userId = $request->get('user_id');
        $profile = Profile::where('uuid', $request->uuid)->first();
        $profile->user_id = $userId;
        $profile->save();
        return $this->appResponse([
            "data" => $profile,
            "success" => true,
        ]);
    }
}
