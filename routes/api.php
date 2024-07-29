<?php

use App\Http\Controllers\SkillController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('create/skill/without/test', [SkillController::class, 'create']);

Route::middleware(['verify.jwt'])->group(function () {
    Route::get('get/skill/{skillId}', [SkillController::class, 'getSkillTask']);
    Route::get('get/skill', [SkillController::class, 'index']);
    Route::post('create/task', [TaskController::class, 'createTask']);
   
});