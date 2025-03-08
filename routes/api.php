<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Api\Classrooms\ApiClassroomController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// *************************************** Routes for Classroom API ***************************************
// Route for store,update
Route::apiResource('classrooms', ApiClassroomController::class);

// Route for delete
Route::delete('classrooms/{id}', [ApiClassroomController::class, 'destroy']);

// Route for delete_all
Route::delete('classrooms/delete-all', [ApiClassroomController::class, 'delete_all']);

// Route for Filter_Classes
Route::get('/classrooms/filter', [ApiClassroomController::class, 'Filter_Classes']);