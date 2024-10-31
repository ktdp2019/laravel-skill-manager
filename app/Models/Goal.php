<?php

namespace App\Models;

use App\Utils\TimeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $table = "goal";

    public function createGoal($data) {
        $this->title = $data['title'];
        $this->start_date = TimeHelper::getDateFromEpochTime($data['start_date']);
        $this->end_date = TimeHelper::getDateFromEpochTime($data['end_date']);
        $this->skill_id = $data['skill_id'];
        $this->save();
    }
}
