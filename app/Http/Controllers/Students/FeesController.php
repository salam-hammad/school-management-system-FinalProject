<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFeesRequest;
use App\Repository\FeesRepositoryInterface;

class FeesController extends Controller
{
    protected $Fees;

    public function __construct(FeesRepositoryInterface $Fees)
    {
        $this->Fees = $Fees;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->Fees->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Fees->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeesRequest $request)
    {
        return $this->Fees->store($request);
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
        return $this->Fees->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFeesRequest $request)
    {
        return $this->Fees->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Fees->destroy($request);
    }
}
