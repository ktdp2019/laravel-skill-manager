<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'firebase_token'];
    protected $table = 'user_profile';

    // Create Profile
    public function createProfile($data ) {
        $this->firebase_token = $data['fcm_token'];
        $this->uuid = $data['uuid'];
        $this->save();
    }
}
