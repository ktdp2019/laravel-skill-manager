<?php

namespace App\Models;

use App\Utils\TimeHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;

    protected $table = 'sprint';

    function createSprint($data) {
        $this->skill_id = $data['skill_id'];
        $this->start_date = TimeHelper::getDateFromEpochTime($data['start_date']);
        $this->end_date = TimeHelper::getDateFromEpochTime($data['end_date']);
        $this->title = $data['title'];
        $this->save();
        return $this;

    }
}
