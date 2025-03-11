<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Api\Classrooms\ApiClassroomController;
use App\Http\Controllers\backend\Api\Grades\ApiGradeController;
use App\Http\Controllers\backend\Api\Quizzes\ApiQuizzController;
use App\Http\Controllers\backend\Api\Questions\ApiQuestionController;
use App\Http\Controllers\backend\Api\Sections\ApiSectionController;
use App\Http\Controllers\backend\Api\Subjects\ApiSubjectController;
use App\Http\Controllers\backend\Api\Students\Attendances\ApiAttendanceController;
use App\Http\Controllers\backend\Api\Students\Fees\ApiFeesController;
use App\Http\Controllers\backend\Api\Students\FeesInvoices\ApiFeesInvoicesController;


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


// ***************************************Start Routes for Classroom API ************************************
// Route for store,update
Route::apiResource('classrooms', ApiClassroomController::class);
// Route for delete
Route::delete('classrooms/{id}', [ApiClassroomController::class, 'destroy']);
// Route for delete_all
Route::delete('classrooms/delete-all', [ApiClassroomController::class, 'delete_all']);
// Route for Filter_Classes
Route::get('/classrooms/filter', [ApiClassroomController::class, 'Filter_Classes']);
// ***************************************End Routes for Classroom API **************************************


// ***************************************Start Routes for Grades API ************************************
Route::apiResource('/grades', ApiGradeController::class);
Route::delete('/grades/{id}', [ApiGradeController::class, 'destroy']);
// ***************************************End Routes for Grades API **************************************


// ***************************************Start Routes for Quizz API ************************************
Route::apiResource('/quizzes', ApiQuizzController::class);
Route::delete('/quizzes/{id}', [ApiQuizzController::class, 'destroy']);
// ***************************************End Routes for Quizz API **************************************

// ***************************************Start Routes for Question API ************************************
Route::apiResource('/questions', ApiQuestionController::class);
Route::delete('/questions/{id}', [ApiQuestionController::class, 'destroy']);
// ***************************************End Routes for Question API **************************************

// ***************************************Start Routes for sections API ************************************
Route::apiResource('/sections', ApiSectionController::class);
Route::get('/sections/classrooms/{id}', [ApiSectionController::class, 'getClassrooms']);
Route::delete('/sections/{id}', [ApiSectionController::class, 'destroy']);
// ***************************************End Routes for sections API **************************************

// ***************************************Start Routes for subjects API ************************************
Route::apiResource('/subjects', ApiSubjectController::class);
Route::delete('/subjects/{id}', [ApiSubjectController::class, 'destroy']);
// ***************************************End Routes for subjects API **************************************

// *************************************** Start Routes for Attendance API [Student Dashboard] ************************************
Route::prefix('attendances')->group(function () {
    Route::get('/', [ApiAttendanceController::class, 'index']); 
    Route::post('/', [ApiAttendanceController::class, 'store']); 
    Route::get('/{id}', [ApiAttendanceController::class, 'show']); 
    Route::put('/{id}', [ApiAttendanceController::class, 'update']);  
    Route::delete('/{id}', [ApiAttendanceController::class, 'destroy']);  
});
// *************************************** End Routes for Attendance API [Student Dashboard] **************************************


// *************************************** Start Routes for Fees API [Student Dashboard]************************************
Route::prefix('fees')->group(function () {
    Route::get('/', [ApiFeesController::class, 'index']);   
    Route::post('/', [ApiFeesController::class, 'store']);   
    Route::get('/{id}', [ApiFeesController::class, 'show']);  
    Route::put('/{id}', [ApiFeesController::class, 'update']); 
    Route::delete('/{id}', [ApiFeesController::class, 'destroy']); 
});
// *************************************** End Routes for Fees API [Student Dashboard] **************************************

// *************************************** Start Routes for Fees Invoices API [Student Dashboard] ************************************
Route::prefix('fees-invoices')->group(function () {
    Route::get('/', [ApiFeesInvoicesController::class, 'index']);   
    Route::post('/', [ApiFeesInvoicesController::class, 'store']);   
    Route::get('/{id}', [ApiFeesInvoicesController::class, 'show']);  
    Route::put('/{id}', [ApiFeesInvoicesController::class, 'update']); 
    Route::delete('/{id}', [ApiFeesInvoicesController::class, 'destroy']); 
});
// *************************************** End Routes for Fees Invoices API [Student Dashboard] **************************************