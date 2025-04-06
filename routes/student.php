<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\backend\Quizzes\QuizzController;
use App\Http\Controllers\backend\Students\dashboard\ExamsController;
use App\Http\Controllers\backend\Students\dashboard\StudentRegistrationController;
use App\Http\Controllers\backend\Students\dashboard\ProfileController;
use App\Http\Controllers\backend\Students\dashboard\LibraryController;
use App\Http\Controllers\backend\Students\dashboard\OnlineZoomClassesController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('pages.Students.dashboard');
        })->name('dashboard.Students');

        // Route::resource('student_exams', \App\Http\Controllers\Students\dashboard\ExamsController::class);
        Route::group(['namespace' => 'App\Http\Controllers\backend\Students\dashboard'], function () {
            Route::resource('student_exams', ExamsController::class);
        });

        Route::group(['prefix' => 'Quizzes'], function () {
            Route::get('/Quizzes', [QuizzController::class, 'index'])->name('Quizzes.index');
            Route::get('/Quizzes/create',  [QuizzController::class, 'create'])->name('Quizzes.create');
            Route::post('/Quizzes/store', [QuizzController::class, 'store'])->name('Quizzes.store');
            Route::get('/edit/{id}', [QuizzController::class, 'edit'])->name('Quizzes.edit');
            Route::put('/Quizzes/update', [QuizzController::class, 'update'])->name('Quizzes.update');
            Route::delete('/Quizzes/destroy', [QuizzController::class, 'destroy'])->name('Quizzes.destroy');
        });

        // Route::group(['prefix' => 'settings'], function () {
        //     Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        //     Route::put('/settings/update', [SettingController::class, 'update'])->name('settings.update');
        // });

        //============================== عرض المواد الدراسية ============================
        Route::get('/student/dashboard/subjects', [StudentRegistrationController::class, 'index'])->name('student.subjects.index');
        Route::get('/auto-register-student/{id}', [StudentRegistrationController::class, 'autoRegisterStudent']);

        Route::group(['prefix' => 'profile'], function () {
            Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('profile-student/{id}', [ProfileController::class, 'update'])->name('profile-student.update');
        });

        //============================== عرض المكتبة ============================
        Route::prefix('student')->group(function () {
            Route::get('/library', [LibraryController::class, 'index'])->name('student.library.index');

            Route::get('/library/downloaded', [LibraryController::class, 'downloaded'])->name('student.library.downloaded');
            Route::get('library/downloadAttachmentStudent/{file}', [LibraryController::class, 'downloadAttachmentStudent'])->name('downloadAttachmentStudent');
            Route::get('/library/search', [LibraryController::class, 'search'])->name('student.library.search');

        });




        //============================== عرض الحصص الاونلاين ============================
        Route::prefix('student')->middleware(['auth:student'])->group(function () {
            Route::get('/online-classes', [OnlineZoomClassesController::class, 'index'])
                 ->name('student.online_classes.index');
        });



    }
);