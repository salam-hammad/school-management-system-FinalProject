<?php

namespace App\Http\Controllers\backend\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\LibraryRepositoryInterface;

class LibraryController extends Controller
{
    protected $library;

    public function __construct(LibraryRepositoryInterface $library)
    {
        $this->library = $library;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->library->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->library->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->library->store($request);
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
        return $this->library->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->library->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->library->destroy($request);
    }

    public function downloadAttachment($filename)
    {
        return $this->library->download($filename);
    }
}    