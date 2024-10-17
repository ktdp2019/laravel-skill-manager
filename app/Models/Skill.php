<?php

namespace App\Models;

use App\Utils\TimeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    public function createSkill($skillData) {
        $this->title = $skillData['title'];
        $this->start_date = TimeHelper::getDateFromEpochTime($skillData['start_date']);
        $this->end_date = TimeHelper::getDateFromEpochTime($skillData['end_date']);
        $this->user_id = $skillData['userId'];
        $this->category_id = $skillData['category_id'];
        $this->save();
        return $this;
    }
}
