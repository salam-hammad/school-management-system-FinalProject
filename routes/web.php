<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\FeesInvoicesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Livewire\Livewire;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// 

Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        // return view('auth.login');
        return view('dashboard');
        // return view('empty');

    });
});
Route::get('/', function () {
    return view('auth.login');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    // Route::get('/', function () {
    //     return view('dashboard');
    // });
    Route::get('/dashboard', action: [HomeController::class, 'index'])->name('dashboard');


    //==============================Start dashboard page of Grades============================
    Route::group(['prefix' => 'Grades'], function () {
        Route::get('/Grades', [GradeController::class, 'index'])->name('Grades.index');
        Route::post('/grades', [GradeController::class, 'store'])->name('Grades.store');
        Route::patch('/update/{id}', [GradeController::class, 'update'])->name('Grades.update');
        Route::delete('/destroy/{id}', [GradeController::class, 'destroy'])->name('Grades.destroy');
    });
    //==============================End dashboard page of Grades============================

    //==============================Start dashboard page of Classes_Room============================
    Route::group(['prefix' => 'Classrooms'], function () {
        Route::get('/Classrooms', [ClassroomController::class, 'index'])->name('Classrooms.index');
        Route::post('/Classrooms/store', [ClassroomController::class, 'store'])->name('Classrooms.store');
        Route::post('/Classrooms', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
        Route::patch('/Classrooms/update/{id}', [ClassroomController::class, 'update'])->name('Classrooms.update');
        Route::delete('/Classrooms/destroy', [ClassroomController::class, 'destroy'])->name('Classrooms.destroy'); //name('delete_all');
        Route::post('/Classrooms/delete_all', [ClassroomController::class, 'delete_all'])->name('Classrooms.delete_all');
        Route::post('/Classrooms/filter_classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
    });
    //==============================End dashboard page of Classes_Room============================

    //==============================Start dashboard page of Sections============================
    Route::group(['prefix' => 'Sections'], function () {
        Route::get('/Sections', [SectionController::class, 'index'])->name('Sections.index');
        Route::get('/classes/{id}',  [SectionController::class, 'getClassrooms'])->name('classes');
        Route::post('/Sections/store', [SectionController::class, 'store'])->name('Sections.store');
        Route::patch('/Sections/update', [SectionController::class, 'update'])->name('Sections.update');
        Route::delete('/Sections/destroy', [SectionController::class, 'destroy'])->name('Sections.destroy');
    });
    //==============================End dashboard page of Sections============================

    //==============================Start dashboard page of Parents============================
    // Route::view('add_parent','livewire.show_Form');
 
        Route::view('add_parent','livewire.show_Form');
    
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/en/livewire/update', $handle);
        }); 
    //==============================End dashboard page of Parents============================


    //==============================Start dashboard page of Teachers============================
        Route::group(['prefix' => 'teachers', 'namespace' => 'Teachers'], function () {
            Route::get('/Teachers', [TeacherController::class, 'index'])->name('Teachers.index'); 
            Route::get('/Teachers/create', [TeacherController::class, 'create'])->name('Teachers.create');
            Route::post('/Teachers/store', [TeacherController::class, 'store'])->name('Teachers.store');
            Route::get('/Teachers/edit/{id}', [TeacherController::class, 'edit'])->name('Teachers.edit');
            Route::patch('/Teachers/update/{id}', [TeacherController::class, 'update'])->name('Teachers.update');
            Route::delete('/Teachers/destroy', [TeacherController::class, 'destroy'])->name('Teachers.destroy');
    });
    //==============================End dashboard page of Parents============================
    
    //==============================Start dashboard page of Students============================

    Route::group(['prefix' => 'Students'], function () {
        Route::get('/Students', [StudentController::class, 'index'])->name('Students.index');
        Route::get('/Students/create',  [StudentController::class, 'create'])->name('Students.create');
        Route::get('/Get_classrooms/{id}',  [StudentController::class, 'Get_classrooms']);
        Route::get('/Get_Sections/{id}',  [StudentController::class, 'Get_Sections']);
        Route::post('/Students/store', [StudentController::class, 'store'])->name('Students.store');
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('Students.edit');
        Route::get('/students/{id}', [StudentController::class, 'show'])->name('Students.show');
        Route::put('/Students/update', [StudentController::class, 'Update'])->name('Students.update');
        Route::delete('/Students/destroy', [StudentController::class, 'destroy'])->name('Students.destroy');
        Route::post('Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('Upload_attachment');
        Route::post('Delete_attachment', [StudentController::class , 'Delete_attachment'])->name('Delete_attachment');
    });
    Route::get('/Download_attachment/{studentsname}/{filename}', [StudentController::class, 'Download_attachment'])->name('Download_attachment');

    //==============================End dashboard page of Students============================ 

    //==============================Start Pormotion page of Students============================
    Route::group(['prefix' => 'Promotion'], function () {
        Route::get('/Promotion', [PromotionController::class, 'index'])->name('Promotion.index');
        Route::post('/Promotion/store', [PromotionController::class, 'store'])->name('Promotion.store');
        Route::get('/Promotion/create',  [PromotionController::class, 'create'])->name('Promotion.create');
        Route::delete('/Promotion/destroy', [PromotionController::class, 'destroy'])->name('Promotion.destroy');
    });
    //==============================End Pormotion page of Students============================
    

    //==============================Start Graduated page of Students============================
    Route::group(['prefix' => 'Graduated'], function () {
        Route::get('/Graduated', [GraduatedController::class, 'index'])->name('Graduated.index');
        Route::post('/Graduated/store', [GraduatedController::class, 'store'])->name('Graduated.store');
        Route::get('/Graduated/create',  [GraduatedController::class, 'create'])->name('Graduated.create');
        Route::put('/Graduated/update', [GraduatedController::class, 'Update'])->name('Graduated.update');
        Route::delete('/Graduated/destroy', [GraduatedController::class, 'destroy'])->name('Graduated.destroy');

    });    
    //==============================End Graduated page of Graduated============================


    //==============================Start dashboard page of Fees============================
    Route::group(['prefix' => 'Fees'], function () {
        Route::get('/Fees', [FeesController::class, 'index'])->name('Fees.index');
        Route::post('/Fees/store', [FeesController::class, 'store'])->name('Fees.store');
        Route::get('/Fees/create',  [FeesController::class, 'create'])->name('Fees.create');
        Route::get('/edit/{id}', [FeesController::class, 'edit'])->name('Fees.edit');
        Route::put('/Fees/update', [FeesController::class, 'Update'])->name('Fees.update');
        Route::delete('/Fees/destroy', [FeesController::class, 'destroy'])->name('Fees.destroy');

    });    
    //==============================End dashboard page of Fees============================    


    //==============================Start Fees Invoices page of Students============================
    Route::group(['prefix' => 'Fees_Invoices'], function () {
        Route::get('/Fees_Invoices', [FeesInvoicesController::class, 'index'])->name('Fees_Invoices.index');
        Route::post('/Fees_Invoices/store', [FeesInvoicesController::class, 'store'])->name('Fees_Invoices.store');
        Route::get('/Fees_Invoices/{id}', [FeesInvoicesController::class, 'show'])->name('Fees_Invoices.show');
        // Route::get('/Fees_Invoices/create',  [FeesInvoicesController::class, 'create'])->name('Fees_Invoices.create');
        // Route::get('/edit/{id}', [FeesInvoicesController::class, 'edit'])->name('Fees_Invoices.edit');
        // Route::put('/Fees_Invoices/update', [FeesInvoicesController::class, 'Update'])->name('Fees_Invoices.update');
        // Route::delete('/Fees_Invoices/destroy', [FeesInvoicesController::class, 'destroy'])->name('Fees_Invoices.destroy');

    });    
    //==============================End Fees Invoices page of Students============================
});
