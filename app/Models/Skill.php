<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    public function createSkill($skillData) {
        $this->title = $skillData['title'];
        $this->description = $skillData['description'];
        $this->user_id = 1;
        $this->save();
        return $this;
    }
}
