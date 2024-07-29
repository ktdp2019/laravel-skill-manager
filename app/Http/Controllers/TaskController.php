<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Models\Task;
use App\Traits\AppControllerTrait;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    use AppControllerTrait;
    
    public function createTask(Request $request) {
        $inValidResponse = $this->inValidateRequest($request, [
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
}
