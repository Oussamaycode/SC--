<?php

namespace App\Http\Controllers;

use App\Models\dette;
use App\Http\Requests\StoredetteRequest;
use App\Http\Requests\UpdatedetteRequest;

class DetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $dettes=Dette::with('user','expense');
        return view('dette',compact('dettes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoredetteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(dette $dette)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(dette $dette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatedetteRequest $request, dette $dette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dette $dette)
    {
        //
    }
}
