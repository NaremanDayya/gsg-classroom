<?php

use App\Http\Controllers\Api\ClassroomMessagesController;
use App\Http\Controllers\Api\DevicesController;
use App\Http\Controllers\Api\V1\AccessTokensController;
use App\Http\Controllers\Api\V1\ClassroomsController;
use App\Http\Controllers\Api\V1\ClassworksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group(function ()
{
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('devices',[DevicesController::class,'store']);
    Route::apiResource('classrooms.messages',ClassroomMessagesController::class);
    Route::apiResource('/classrooms', ClassroomsController::class);
    Route::apiResource('classrooms.classworks', ClassworksController::class);
    Route::get('auth/access-tokens',[AccessTokensController::class, 'index']);
    Route::delete('auth/access-tokens/{id?}',[AccessTokensController::class, 'destroy']);
});

Route::middleware('guest:sanctum')->group(function ()
{
       Route::post("/auth/access-tokens", [AccessTokensController::class, 'store']);

});

