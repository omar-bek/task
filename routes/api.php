<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
route::get('user', [AuthController::class,'index']);
route::middleware('auth:sanctum')->group(function () {
    Route::apiResource("tasks", TaskController::class);


});
