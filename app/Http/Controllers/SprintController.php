<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Models\Practical;
use App\Models\Sprint;
use App\Models\Theory;
use App\Traits\AppRequestTrait;
use App\Utils\RequestHelper;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class SprintController extends Controller
{

    use AppRequestTrait;

    /**
     * Display a listing of the resource.
     */
    public function index($skillId)
    {
        $allSprint = Sprint::where(["skill_id" => $skillId])->get();
        return ResponseHelper::appResponse([
            "data" => $allSprint,
            "status" => 201,
            "msg" => "",
            "success" => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function createSprintFinalizer(Request $request)
    {
        $rBody = [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            "sectionList" => 'required',
            'goal_id' => 'required'
        ];
        $this->isInvalidRequest($request, $rBody);
        $newSprint = new Sprint();
        $newSprint->createSprint($request);
        $sprintId = $newSprint->id;
        $count = 0;

        // Create theory
        foreach( $request['sectionList'] as $key => $section) {
            $count = $count + 1;
            $theory = $section['theory'];
            $practical = $section['practical'];
            $tData = [
                'sprint_id' => $sprintId,
                'title' => $theory['title'],
                'serial_number' => $count
            ];
            $theory = new Theory();
            $theory = $theory->createTheory($tData);
            $pData = [
                'sprint_id' => $sprintId,
                'title' => $practical['title'],
                'serial_number' => $count
            ];
            $theory = new Practical();
            $theory->createPractical($pData);
        }

        return ResponseHelper::appResponse([
            "data" => ['id' => $newSprint->id],
            "status" => 201,
            "msg" => "Sprint created successfully",
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function fetchSprint(Sprint $sprint)
    {
        $sprintId = $sprint->id;
        $allTheory = Theory::where(["sprint_id" => $sprintId])->get();
        $allPractical = Practical::where(["sprint_id" => $sprintId])->get();
       
        $datail = [
            "id" => $sprint->id,
            "title" => $sprint->title,
        ];
        $datail['section'] = [];
        foreach ($allTheory as $theory) {
            $index = 0;
            $datail['section'][] = [
                'theory' => [
                    'title' => $allTheory[$index]['title'],
                    'id' => $allTheory[$index]['id']
                ],
                'practical' => [
                    'title' => $allPractical[$index]['title'],
                    'id' => $allPractical[$index]['id']
                ],
            ];
            $index++;
        }
        
        return ResponseHelper::appResponse([
            "data" => $datail,
            "status" => 201,
            "msg" => "",
            "success" => true,
        ]);
    }

    public function sprintDeleteFinalizer(Request $request)
    {   
        $rBody = [
            'sprint_id' => 'required', 
        ];
        $this->isInvalidRequest($request, $rBody);
        Sprint::where(['id' => $request['sprint_id']])->delete();
        return $this->appResponse([
            "status" => ResStatus::$Status204,
            "msg" => StringConstant::$SPRINT_DELETED,
            "success" => true,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sprint $sprint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sprint $sprint)
    {
        //
    }
}
