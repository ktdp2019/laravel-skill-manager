<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Models\Skill;
use App\Models\SkillCategory;
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

    public function addSkillCategory(Request $request) {
        $rBody = [
            'title' => 'required',
            'skill_category_id' => 'required',
        ];
        if ($this->isInvalidRequest($request, $rBody)) {
            return  $this->incompleteRequest();
        }
        $skillCatogory = new SkillCategory();
        $skillCatogory->createCategory($request);
        return  $this->appResponse([
            'status' => ResStatus::$Status201, 
            'data' => $skillCatogory,
            'msg' => StringConstant::$SKILL_CATEGORY_ST,
            'success' => true,
        ]);
    }

    public function getAllSkillCategory() {
        return  $this->appResponse([
            'status' => ResStatus::$Status200, 
            'data' => SkillCategory::all(),
            'msg' => StringConstant::$REQUEST_SUCCESS,
            'success' => true,
        ]);
    }

    public function create(Request $request)
    {
        $rBody = [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'category_id' => 'required',
            'category_name' => 'required',
        ];
        $this->isInvalidRequest($request, $rBody);
        $userId = $request->get('user_id');
        $request['userId'] = $userId;
        $newSkill = new Skill();
        $newSkill->createSkill($request);
        return $this->appResponse([
            "data" => ['id' => $newSkill->id],
            "status" => ResStatus::$Status201,
            "msg" => StringConstant::$SKILL_CREATED,
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
