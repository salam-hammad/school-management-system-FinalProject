<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\Api\Auth\ApiLoginController;
use App\Http\Controllers\backend\Api\Auth\ApiRegisterController;
use App\Http\Controllers\backend\Api\Classrooms\ApiClassroomController;
use App\Http\Controllers\backend\Api\Grades\ApiGradeController;
use App\Http\Controllers\backend\Api\Quizzes\ApiQuizzController;
use App\Http\Controllers\backend\Api\Questions\ApiQuestionController;
use App\Http\Controllers\backend\Api\Sections\ApiSectionController;
use App\Http\Controllers\backend\Api\Subjects\ApiSubjectController;
use App\Http\Controllers\backend\Api\Students\Attendances\ApiAttendanceController;
use App\Http\Controllers\backend\Api\Students\Fees\ApiFeesController;
use App\Http\Controllers\backend\Api\Students\FeesInvoices\ApiFeesInvoicesController;
use App\Http\Controllers\backend\Api\Students\Graduates\ApiGraduatedController;
use App\Http\Controllers\backend\Api\Students\Libraries\ApiLibraryController;
use App\Http\Controllers\backend\Api\Students\OnlineClasses\ApiOnlineClasseController;
use App\Http\Controllers\backend\Api\Students\Payments\ApiPaymentController;
use App\Http\Controllers\backend\Api\Students\ProcessingFees\ApiProcessingFeeController;

use App\Http\Controllers\backend\Api\Students\dashboard\Exams\ApiExamController;



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


// *************************************** Start Routes for Graduates API [Student Dashboard] ************************************
Route::prefix('graduates')->group(function () {
    // عرض جميع الطلاب الخريجين (المحذوفين بشكل مؤقت)
    Route::get('/', [ApiGraduatedController::class, 'index']);
    // عرض بيانات المراحل الدراسية (لإنشاء خريجين)
    Route::get('/create', [ApiGraduatedController::class, 'create']);
    // حذف الطلاب بشكل مؤقت (Soft Delete)
    Route::post('/soft-delete', [ApiGraduatedController::class, 'SoftDelete']);
    // استعادة طالب محذوف
    Route::post('/restore', [ApiGraduatedController::class, 'ReturnData']);
    // حذف طالب بشكل نهائي (Force Delete)
    Route::delete('/destroy', [ApiGraduatedController::class, 'destroy']);
});
// *************************************** End Routes for Graduates API [Student Dashboard] **************************************

// *************************************** Start Routes for OnlineClasse API [Student Dashboard] ************************************
Route::prefix( 'online-classes')->group(function () {
    Route::get('/', [ApiOnlineClasseController::class, 'index']); // عرض جميع الحصص
    Route::post('/', [ApiOnlineClasseController::class, 'store']); // إنشاء حصة جديدة
    Route::get('/{id}', [ApiOnlineClasseController::class, 'show']); // عرض حصة محددة
    Route::put('/{id}', [ApiOnlineClasseController::class, 'update']); // تحديث بيانات الحصة
    Route::delete('/{id}', [ApiOnlineClasseController::class, 'destroy']); // حذف الحصة
});
// *************************************** End Routes for OnlineClasse API [Student Dashboard] **************************************


// *************************************** Start Routes for Libraries API [Student Dashboard] ************************************
Route::prefix('library')->group(function () {
    Route::get('/', [ApiLibraryController::class, 'index']);
    Route::post('/', [ApiLibraryController::class, 'store']);
    Route::put('/{id}', [ApiLibraryController::class, 'update']);
    Route::delete('/{id}', [ApiLibraryController::class, 'destroy']);
    Route::get('/download/{filename}', [ApiLibraryController::class, 'downloadAttachment']);
});
// *************************************** End Routes for Libraries API [Student Dashboard] **************************************


// *************************************** Start Routes for Payments API [Student Dashboard] ************************************
Route::prefix('payments')->group(function () {
    Route::get('/', [ApiPaymentController::class, 'index']); // عرض جميع المدفوعات
    Route::post('/store', [ApiPaymentController::class, 'store']); // إنشاء مدفوع جديد
    Route::put('/update/{id}', [ApiPaymentController::class, 'update']); // تحديث مدفوع معين
    Route::delete('/delete/{id}', [ApiPaymentController::class, 'destroy']); // حذف مدفوع معين
});
// *************************************** End Routes for Payments API [Student Dashboard] **************************************


// *************************************** Start Routes for ProcessingFees API [Student Dashboard] ************************************
Route::prefix('processing-fees')->group(function () {
    Route::get('/', [ApiProcessingFeeController::class, 'index']); // جلب جميع رسوم المعالجة
    Route::post('/store', [ApiProcessingFeeController::class, 'store']); // إنشاء رسوم معالجة جديدة
    Route::put('/update/{id}', [ApiProcessingFeeController::class, 'update']); // تحديث رسوم معالجة
    Route::delete('/delete/{id}', [ApiProcessingFeeController::class, 'destroy']); // حذف رسوم معالجة
});
// *************************************** End Routes for ProcessingFees API [Student Dashboard] **************************************




// *************************************** Start Routes for Student Dashboard Exam API ************************************
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('students/dashboard/exams')->group(function () {
        Route::get('/', [ApiExamController::class, 'index'])->name('exams.index');
        Route::get('/{quizze_id}', [ApiExamController::class, 'show'])->name('exams.show');
        Route::post('/', [ApiExamController::class, 'store'])->name('exams.store');
        Route::put('/{quizze_id}', [ApiExamController::class, 'update'])->name('exams.update');
        Route::delete('/{quizze_id}', [ApiExamController::class, 'destroy'])->name('exams.destroy');
    });
});

// *************************************** End Routes for Student Dashboard Exam API**************************************





// تسجيل الدخول
Route::post('/login', [ApiLoginController::class, 'login']);
// تسجيل الخروج
Route::post('/logout', [ApiLoginController::class, 'logout'])->middleware('auth:sanctum');
// تسجيل مستخدم جديد
Route::post('/register', [ApiRegisterController::class, 'register']);
