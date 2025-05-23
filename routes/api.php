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
use App\Http\Controllers\backend\Api\Students\Promotions\ApiPromotionController;
use App\Http\Controllers\backend\Api\Students\ReceiptStudents\ApiReceiptStudentController;

use App\Http\Controllers\backend\Api\Students\dashboard\StudentAuthController;
use App\Http\Controllers\backend\Api\Students\dashboard\Exams\ApiExamController;
use App\Http\Controllers\backend\Api\Students\dashboard\Profiles\ApiProfileController;
use App\Http\Controllers\backend\Api\Students\dashboard\StudentRegistrations\ApiStudentRegistrationController;

use App\Http\Controllers\backend\Api\Teachers\dashboard\TeacherAuthController;
use App\Http\Controllers\backend\Api\Teachers\dashboard\ApiStudentController;
use App\Http\Controllers\backend\Api\Teachers\dashboard\TeacherApiQuizzController;
use App\Http\Controllers\backend\Api\Teachers\dashboard\ProfileApiController;
use App\Http\Controllers\backend\Api\Teachers\ApiTeacherController;
use App\Http\Controllers\backend\Api\Teachers\dashboard\TeacherApiQuestionController;

use App\Http\Controllers\backend\Api\Parents\dashboard\ParentAuthController;
use App\Http\Controllers\backend\Api\Parents\dashboard\ApiChildrenController;


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

// For Admin :
// تسجيل الدخول
Route::post('/login', [ApiLoginController::class, 'login']);
// تسجيل الخروج
Route::post('/logout', [ApiLoginController::class, 'logout'])->middleware('auth:sanctum');
// تسجيل مستخدم جديد
Route::post('/register', [ApiRegisterController::class, 'register']);





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
Route::prefix('online-classes')->group(function () {
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
    Route::post('/store', [ApiLibraryController::class, 'store']);
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


// *************************************** Start Routes for Promotions API [Student Dashboard] ************************************
Route::prefix('promotions')->group(function () {
    Route::get('/', [ApiPromotionController::class, 'index']); // عرض جميع الترقيات
    Route::post('/store', [ApiPromotionController::class, 'store']); // إضافة ترقية جديدة
    Route::delete('/delete/{id}', [ApiPromotionController::class, 'destroy']); // حذف ترقية معينة
});
// *************************************** End Routes for Promotions API [Student Dashboard] **************************************


// *************************************** Start Routes for Receipt Students API [Student Dashboard] ************************************
Route::prefix('receipt-students')->group(function () {
    Route::get('/', [ApiReceiptStudentController::class, 'index']); // عرض جميع سندات القبض
    Route::get('/{id}', [ApiReceiptStudentController::class, 'show']); // عرض سند قبض محدد
    Route::post('/store', [ApiReceiptStudentController::class, 'store']); // إنشاء سند قبض جديد
    Route::put('/{id}', [ApiReceiptStudentController::class, 'update']); // تحديث سند قبض
    Route::delete('/{id}', [ApiReceiptStudentController::class, 'destroy']); // حذف سند قبض
});
// *************************************** End Routes for Receipt Students API [Student Dashboard] **************************************


// *************************************** Start Routes for Student Dashboard API ************************************
Route::post('/student/login', [StudentAuthController::class, 'login']);
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->middleware('auth:sanctum');


// *************************************** Start Routes for Student Dashboard Exam API ************************************
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('students/dashboard/exams')->group(function () {
        Route::get('/', [ApiExamController::class, 'index'])->name('exams.index');
        Route::get('/{quizze_id}', [ApiExamController::class, 'show'])->name('exams.show');
        Route::post('/store', [ApiExamController::class, 'store'])->name('exams.store');
        Route::put('update/{quizze_id}', [ApiExamController::class, 'update'])->name('exams.update');
        Route::delete('delete/{quizze_id}', [ApiExamController::class, 'destroy'])->name('exams.destroy');
    });
});

// *************************************** End Routes for Student Dashboard Exam API**************************************


// *************************************** Start Routes for Profile Student Dashboard  ************************************
Route::prefix('students/profile')->group(function () {
    Route::get('/{id}', [ApiProfileController::class, 'show']);
    Route::put('update/{id}', [ApiProfileController::class, 'update']);
});
// *************************************** End Routes for Profile Student Dashboard **************************************


// *************************************** Start Routes for Student Dashboard Registrations API ************************************
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('students/dashboard/registrations')->group(function () {
        Route::get('/', [ApiStudentRegistrationController::class, 'index'])->name('registrations.index');
        Route::get('/{id}', [ApiStudentRegistrationController::class, 'show'])->name('registrations.show');
        Route::post('/store', [ApiStudentRegistrationController::class, 'store'])->name('registrations.store');
        Route::put('/update/{id}', [ApiStudentRegistrationController::class, 'update'])->name('registrations.update');
        Route::delete('/delete/{id}', [ApiStudentRegistrationController::class, 'destroy'])->name('registrations.destroy');
    });
});
// *************************************** End Routes for Student Dashboard Registrations API ************************************



// *************************************** Start Routes for Teacher Dashboard API ************************************
Route::post('/teacher/login', [TeacherAuthController::class, 'login']);
Route::post('/teacher/logout', [TeacherAuthController::class, 'logout'])->middleware('auth:sanctum');




// *************************************** Start Routes for Student API [Teacher Dashboard] ************************************
Route::middleware('auth:sanctum')->prefix('teacher')->group(function () {
    // جلب قائمة الطلاب الذين يدرسهم المعلم
    Route::get('/students', [ApiStudentController::class, 'index']);
    Route::get('/sections', [ApiStudentController::class, 'sections']);         // ✅ جلب الأقسام
    Route::post('/attendance', [ApiStudentController::class, 'attendance']);    // ✅ تسجيل الحضور
    Route::get('/attendance-report', [ApiStudentController::class, 'attendanceReport']); // ✅ تقرير الحضور
    Route::post('/attendance-search', [ApiStudentController::class, 'attendanceSearch']); // ✅ البحث عن الحضور
});
// *************************************** End Routes for Student API [Teacher Dashboard] ************************************


// *************************************** Start Routes for Student Quizzes API [Teacher Dashboard] ************************************
Route::middleware(['auth:sanctum'])->prefix('teacher')->group(function () {
    Route::get('/quizzes', [TeacherApiQuizzController::class, 'index']); // جلب جميع الاختبارات
    Route::post('/quizzes/store', [TeacherApiQuizzController::class, 'store']); // إنشاء اختبار جديد
    Route::get('/quizze/{id}', [TeacherApiQuizzController::class, 'show']);
    Route::put('/quizzes/update/{id}', [TeacherApiQuizzController::class, 'update']); // تحديث اختبار
    Route::delete('/quizzes/{id}', [TeacherApiQuizzController::class, 'destroy']); // حذف اختبار
    // جلب الطلاب الذين قاموا بحل الاختبار
    Route::get('/quizzes/{quizze_id}/students', [TeacherApiQuizzController::class, 'student_quizze']);
    // إعادة فتح الاختبار للطالب
    Route::post('/quizzes/repeat', [TeacherApiQuizzController::class, 'repeat_quizze']);
});
// *************************************** End Routes for Student Quizzes API [Teacher Dashboard] ************************************


// *************************************** Start Routes for Student Questions API [Teacher Dashboard] ************************************
Route::middleware(['auth:sanctum'])->prefix('teacher')->group(function () {
    Route::get('/questions', [TeacherApiQuestionController::class, 'index']); // جلب جميع الأسئلة
    Route::post('/questions/store', [TeacherApiQuestionController::class, 'store']); // إنشاء سؤال جديد
    Route::get('/show/{id}', [TeacherApiQuestionController::class, 'show']); // جلب تفاصيل سؤال معين
    Route::put('/update/{id}', [TeacherApiQuestionController::class, 'update']); // تحديث سؤال معين
    Route::delete('/delete/{id}', [TeacherApiQuestionController::class, 'destroy']); // حذف سؤال معين
});
// *************************************** End Routes for Student Questions API [Teacher Dashboard] ************************************


// *************************************** Start Routes for Student Questions API [Teacher Dashboard] ************************************
Route::middleware(['auth:sanctum'])->prefix('teacher')->group(function () {
    Route::get('/profile', [ProfileApiController::class, 'index']);  // جلب المعلومات الشخصية
    Route::put('/profile/update', [ProfileApiController::class, 'update']); // تحديث المعلومات الشخصية
});
// *************************************** End Routes for Student Questions API [Teacher Dashboard] ************************************


// *************************************** Start Routes for Parent Dashboard API ************************************
Route::prefix('parent')->group(function () {
    Route::post('/login', [ParentAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [ParentAuthController::class, 'logout']);
});



// *************************************** Start Routes for Children API [Parent Dashboard] ************************************
Route::middleware(['auth:sanctum'])->prefix('children')->group(function () {
    Route::get('/', [ApiChildrenController::class, 'index']);
    Route::get('/{id}/results', [ApiChildrenController::class, 'results']);
    Route::get('/attendances', [ApiChildrenController::class, 'attendances']);
    Route::post('/attendance-search', [ApiChildrenController::class, 'attendanceSearch']);
    Route::get('/fees', [ApiChildrenController::class, 'fees']);
    Route::get('/{id}/receipts', [ApiChildrenController::class, 'receiptStudent']);
    Route::get('/profile', [ApiChildrenController::class, 'profile']);
    Route::put('/profile/{id}', [ApiChildrenController::class, 'updateProfile']);
});
// *************************************** End Routes for Children API [Parent Dashboard] ************************************
