<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Models\Goal;
use App\Models\Sprint;
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
        return $this->appResponse([
            'status' => ResStatus::$Status201,
            'msg' => StringConstant::$GOAL_CREATED,
            'data' => $goal,
            'success' => true,
        ]);
    }

    public function fetchGoalDetail(Goal $goal) {
        $allGoal = [];
        if ($goal->id) {
            $allGoal = Sprint::where(["goal_id" => $goal->id])->get();
        }
        $goal['allGoal'] = $allGoal;
        return $this->appResponse([
            'status' => ResStatus::$Status200,
            'msg' => StringConstant::$REQUEST_SUCCESS,
            'data' => $goal,
            'success' => true,
        ]);
    }
}
