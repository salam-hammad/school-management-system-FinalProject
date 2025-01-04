<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\QuizzRepositoryInterface;

class QuizzController extends Controller
{
    protected $Quizz;

    public function __construct(QuizzRepositoryInterface $Quizz)
    {
        $this->Quizz =$Quizz;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Quizz->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Quizz->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Quizz->store($request);
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
        return $this->Quizz->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Quizz->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Quizz->destroy($request);
    }
}
