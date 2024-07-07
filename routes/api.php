<?php

use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('create/skill/without/test', [SkillController::class, 'create']);
Route::get('get/skill/{userId}', [SkillController::class, 'index']);