<?php

namespace App\Http\Controllers;

use App\Constants\ResStatus;
use App\Constants\StringConstant;
use App\Models\Goal;
use App\Models\Skill;
use App\Models\Profile;
use App\Models\SkillCategory;
use App\Models\Sprint;
use App\Models\Task;
use App\Traits\AppControllerTrait;
use App\Traits\AppNotification;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    use AppControllerTrait;
    use AppNotification;
    
    public function index(Request $request)
    {
        $userId = $request->get('user_id');
        $allSkill = Skill::where(["user_id" => $userId])->get();
        echo $userId;
        return ResponseHelper::appResponse([
            "data" => $allSkill,
            "status" => 201,
            "msg" => "",
            "success" => true,
        ]);
    }
    
    public function getSkillBetweenDateFinalizer(Request $request)
    {
        $rBody = [
            'start_date' => 'required',
            'end_date' => 'required',
        ];
        $this->isInvalidRequest($request, $rBody);
        $userId = $request->get('user_id');
        $allSkill = Skill::where('id', $userId)
                            ->where('start_date', '<=', $rBody['start_date'])
                            ->where('end_date', '>=', $rBody['end_date'])
                            ->get();
        return  $this->appResponse([
            'status' => ResStatus::$Status200, 
            'data' => $allSkill,
            'msg' => StringConstant::$REQUEST_SUCCESS,
            'success' => true,
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
        $skillCatogory->createVerifiedCategory($request);
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

    public function createSkillWithoutTest(Request $request)
    {
        $rBody = [
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'category_name' => 'required',
        ];
        $this->isInvalidRequest($request, $rBody);

        $userId = $request->get('user_id');
        $request['userId'] = $userId;

        // Last Category
        $lastCatogory = SkillCategory::all()->last();
        $request['skill_category_id'] = ($lastCatogory ? $lastCatogory->skill_category_id : 0) + 1;

        // CreateSkill Category
        $skillCategory = new SkillCategory();
        $category = $skillCategory->createUnVerifiedCategory($request);
        $request['category_id'] = $category->skill_category_id;

        // Create Skill
        $newSkill = new Skill();
        $newSkill->createSkill($request);

        // Send Notification
        $profile = Profile::where('user_id', $userId)->first();
        $this->sendFcmMessage($profile->firebase_token, "Lead Create Successfully", $newSkill->title);
        
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
        $allGoal = Goal::where(["skill_id" => $skill->id])->get();
        $skill['allGoal'] = $allGoal;
        return ResponseHelper::appResponse([
            "data" => $skill,
            "status" => 201,
            "msg" => "",
            "success" => true,
        ]);
    } 


    public function skillDeleteFinalizer(Request $request)
    {   
        $rBody = [
            'skill_id' => 'required', 
        ];
        $userId = $request->get('user_id');
        $this->isInvalidRequest($request, $rBody);
        Skill::where(['id' => $request['skill_id'], 'user_id' => $userId])->delete();
        return $this->appResponse([
            "status" => ResStatus::$Status204,
            "msg" => StringConstant::$SKILL_DELETED,
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
