<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Models\Task;
use App\Traits\AppControllerTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use AppControllerTrait;
    
    public function createSprint(Request $request) {
        $inValidResponse = $this->isInvalidRequest($request, [
            'skillId' => 'required',
            'detail' => 'required',
        ]);
        if (!$inValidResponse) {
            $task = new Task();
            $task = $task->createTask($request);
            return $this->appResponse(['data' => $task, 'success' => true,  'status' => ResStatus::$Status201]);
        }
        return $inValidResponse;
    }

    public function getAllSprint($skillId) {
        $allSprint = Task::where(['skill_id' => $skillId])->get();
        return $this->appResponse(['data' => $allSprint, 'success' => true,  'status' => ResStatus::$Status201]);
    }

}
