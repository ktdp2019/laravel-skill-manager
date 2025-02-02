<?php

namespace App\Models;

use App\Utils\TimeHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;

    protected $table = 'sprint';

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->timestamp * 1000 : null;
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->timestamp * 1000 : null;
    }

    function createSprint($data) {
        $this->goal_id = $data['goal_id'];
        $this->start_date = TimeHelper::getDateFromEpochTime($data['start_date']);
        $this->end_date = TimeHelper::getDateFromEpochTime($data['end_date']);
        $this->title = $data['title'];
        $this->save();
        return $this;

    }

}
