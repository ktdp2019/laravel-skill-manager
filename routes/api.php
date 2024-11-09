<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\PracticalController;
use App\Http\Controllers\PracticalNoteController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TheoryController;
use App\Http\Controllers\TheoryNoteController;
use App\Models\Practical;
use App\Models\PracticalNote;
use App\Models\Theory;
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
    Route::post('skill/between/date/get', [SkillController::class, 'getSkillBetweenDateFinalizer']);
    Route::post('skill/delete', [SkillController::class, 'skillDeleteFinalizer']);

    // Skill category
    Route::post('skill/category/create', [SkillController::class, 'addSkillCategory']);
    Route::get('skill/category/all/get', [SkillController::class, 'getAllSkillCategory']);

    // Goal
    Route::post('goal/create', [GoalController::class, 'createGoalFinalizer']);
    Route::get('goal/detail/get/{goal}', [GoalController::class, 'fetchGoalDetail']);
    Route::post('goal/delete', [GoalController::class, 'goalDeleteFinalizer']);


    // Sprint
    Route::post('sprint/create', [SprintController::class, 'createSprintFinalizer'],);
    Route::get('sprint/detail/{sprint}', [SprintController::class, 'fetchSprint'],);
    Route::post('sprint/delete', [SprintController::class, 'sprintDeleteFinalizer'],);

    // Theory
    Route::post('theory/delete/{theory}', [TheoryController::class, 'destroy'],); 
    
    // Theory
    Route::post('practical/delete/{practical}', [PracticalController::class, 'destroy'],);


    // Theory notes
    Route::post('theory/note/create', [TheoryNoteController::class, 'store'],);
    Route::get('theory/note/all/{theoryId}', [TheoryNoteController::class, 'index'],);
    Route::post('theory/note/delete/{theoryNote}', [TheoryNoteController::class, 'destroy'],);

    // Practical notes
    Route::post('practical/note/create', [PracticalNoteController::class, 'store'],);
    Route::get('practical/note/all/{practicalId}', [PracticalNoteController::class, 'index'],);
    Route::post('practical/note/delete/{practicalNote}', [PracticalNote::class, 'destroy'],);

    
   
});