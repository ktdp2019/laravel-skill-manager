<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function createTask($payload) {
        $this->skill_id = $payload['skillId'];
        $this->detail = $payload['detail'];
        $this->save();
        return $this;
    }
}
