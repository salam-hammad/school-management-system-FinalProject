<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Teachers\TeacherController;
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
    
});
