<?php

namespace App\Http\Controllers;

use App\Constants\StringConstant;
use App\Models\Practical;
use App\Models\Sprint;
use App\Models\Theory;
use App\Utils\RequestHelper;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class SprintController extends Controller
{
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
    public function store(Request $request)
    {
        $rBody = [
            'skill_id' => "required",
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'theory' => 'required',
            'practical' => 'required',
        ];
        $validator = RequestHelper::validateRequest($request, $rBody);
        if ($validator->fails()) {
            return ResponseHelper::appResponse([
                "data" => null,
                "status" => 400,
                "error" => $validator->errors(),
                "msg" => StringConstant::$incompletePayload,
            ]);
        }
        $newSprint = new Sprint();
        $newSprint->createSprint($request);
        $sprintId = $newSprint->id;
        $count = 0;

        // Create theory
        foreach( $request['theory'] as $key => $value) {
            $count = $count + 1;
            $data = [
                'sprint_id' => $sprintId,
                'title' => $value['title'],
                'serial_number' => $count
            ];
            $theory = new Theory();
            $theory = $theory->createTheory($data);
        }
        
        $count = 0;

        // Create practical
        foreach( $request['practical'] as $key => $value) {
            $count = $count + 1;
            $data = [
                'sprint_id' => $sprintId,
                'title' => $value['title'],
                'serial_number' => $count
            ];
            $theory = new Practical();
            $theory->createPractical($data);
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
    public function show(Sprint $sprint)
    {
        $sprintId = $sprint->id;
        $allTheory = Theory::where(["sprint_id" => $sprintId])->get();
        $allPractical = Practical::where(["sprint_id" => $sprintId])->get();
        return ResponseHelper::appResponse([
            "data" => [
                'theory' => $allTheory,
                'practical' => $allPractical,
            ],
            "status" => 201,
            "msg" => "",
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
