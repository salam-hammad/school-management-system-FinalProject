<?php

namespace App\Http\Controllers\backend\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\ReceiptStudentsRepositoryInterface;

class ReceiptStudentController extends Controller
{

    protected $Receipt;

    public function __construct(ReceiptStudentsRepositoryInterface $Receipt)
    {
        $this->Receipt = $Receipt;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Receipt->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Receipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->Receipt->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->Receipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Receipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Receipt->destroy($request);
    }
}
