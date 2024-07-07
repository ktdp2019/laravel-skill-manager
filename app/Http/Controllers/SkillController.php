<?php

namespace App\Http\Controllers;

use App\Constants\StringConstant;
use App\Models\Skill;
use App\Utils\RequestHelper;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    
    public function index($userId)
    {
        $allSkill = Skill::where(["user_id" => $userId])->get();
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
        //
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
