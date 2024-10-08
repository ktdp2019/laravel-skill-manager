<?php

namespace App\Http\Controllers;

use App\Constants\StringConstant;
use App\Models\Skill;
use App\Models\Sprint;
use App\Models\Task;
use App\Traits\AppControllerTrait;
use App\Utils\RequestHelper;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    use AppControllerTrait;
    
    public function index(Request $request)
    {
        $userId = $request->get('user_id');
        $allSkill = Skill::where(["user_id" => $userId])->get();
        return ResponseHelper::appResponse([
            "data" => $allSkill,
            "status" => 201,
            "msg" => "",
            "success" => true,
        ]);
    }

    public function getSkillTask($skillId) {
        $allSkill = Skill::where(["id" => $skillId])->first();
        $allTask = Task::all();
        $allSkill['allTask'] = $allTask;
        return ResponseHelper::appResponse([
            "data" => $allSkill,
            "status" => 201,
            "msg" => "",
            "success" => true,
        ]);
    }

    public function create(Request $request)
    {
        $rBody = [
            'title' => 'required',
            'description' => 'required',
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
        $newSkill = new Skill();
        $newSkill->createSkill($request);
        return ResponseHelper::appResponse([
            "data" => ['id' => $newSkill->id],
            "status" => 201,
            "msg" => "Skill created successfully",
            "success" => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {   
        $allSprint = Sprint::where(["skill_id" => $skill->id])->get();
        $skill['allSprint'] = $allSprint;
        return ResponseHelper::appResponse([
            "data" => $skill,
            "status" => 201,
            "msg" => "",
            "success" => true,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
