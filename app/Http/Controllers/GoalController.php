<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Models\Goal;
use App\Traits\AppControllerTrait;
use Illuminate\Http\Request;

class GoalController extends Controller
{

    use AppControllerTrait;

    public function createGoalFinalizer(Request $request) {
        $payload = [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'skill_id' => 'required'
        ];
        $this->isInvalidRequest($request, $payload);
        $goal = new Goal();
        $goal->createGoal($request);
        $this->appResponse([
            'status' => ResStatus::$Status201,
            'msg' => StringConstant::$GOAL_CREATED,
            'data' => $goal,
        ]);
    }
}
