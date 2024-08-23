<?php

namespace App\Http\Controllers;

use App\Constants\StringConstant;
use App\Models\Sprint;
use App\Utils\RequestHelper;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return ResponseHelper::appResponse([
            "data" => ['id' => $newSprint->id],
            "status" => 201,
            "msg" => "Skill created successfully",
            "success" => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sprint $sprint)
    {
        //
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
