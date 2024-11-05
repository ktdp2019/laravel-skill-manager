<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\PracticalNoteController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TheoryNoteController;
use App\Models\TheoryNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['verify.jwt'])->group(function () {

    // Skill
    Route::post('skill/create/without/test', [SkillController::class, 'createSkillWithoutTest']);
    Route::get('skill/get/all', [SkillController::class, 'index']);
    Route::get('skill/detail/{skill}', [SkillController::class, 'show']);
    Route::get('get/sprint/{skillId}', [TaskController::class, 'getAllSprint']);
    Route::post('create/task', [TaskController::class, 'createSprint']);
    Route::post('skill/category/create', [SkillController::class, 'addSkillCategory']);
    Route::get('skill/category/all/get', [SkillController::class, 'getAllSkillCategory']);

    // Goal
    Route::post('goal/create', [GoalController::class, 'createGoalFinalizer']);
    Route::get('goal/detail/get/{goal}', [GoalController::class, 'fetchGoalDetail']);


    // Sprint
    Route::post('sprint/create', [SprintController::class, 'store'],);
    Route::get('sprint/detail/{sprint}', [SprintController::class, 'show'],);

    // Theory notes
    Route::post('theory/note/create', [TheoryNoteController::class, 'store'],);
    Route::get('theory/note/all/{theoryId}', [TheoryNoteController::class, 'index'],);

    // Practical notes
    Route::post('practical/note/create', [PracticalNoteController::class, 'store'],);
    Route::get('practical/note/all/{practicalId}', [PracticalNoteController::class, 'index'],);

    
   
});