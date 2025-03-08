<?php

namespace App\Http\Controllers\backend\Teachers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeachers;
use App\Repository\TeacherRepositoryInterface;
use App\Models\Gender;
use App\Models\Specialization;

class TeacherController extends Controller
{
    protected $Teacher;
    
    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        //$Teachers = Teacher::all();
        return view('pages.Teachers.Teachers',compact('Teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $genders = Gender::all();
        // $specializations = specialization::all();

        $specializations = $this->Teacher->Getspecialization();
        $genders = $this->Teacher->GetGender();
        return view('pages.Teachers.create',compact('specializations','genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeachers $request)
    {
        return $this->Teacher->StoreTeachers($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Teachers = $this->Teacher->editTeachers($id);
        $specializations = $this->Teacher->Getspecialization();
        $genders = $this->Teacher->GetGender();
        return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Teacher->UpdateTeachers($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Teacher->DeleteTeachers($request);
    }
    
}
