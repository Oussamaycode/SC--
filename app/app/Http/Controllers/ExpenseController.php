<?php

namespace App\Http\Controllers;

use App\Models\expense;
use App\Models\Colocation;
use App\Models\Categorie;
use App\Http\Requests\StoreexpenseRequest;
use App\Http\Requests\UpdateexpenseRequest;

use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $categories=Categorie::all();     
        return view('expense',compact('categories'));
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
    public function store(StoreexpenseRequest $request)
    {
        $user_id=auth()->id();
        Gate::authorize('add-expense');
        $expense=Expense::create(['amount'=>$request->amount,
        'description'=>$request->description,
        'user_id'=>$user_id,
        'categorie_id'=>$request->categorie_id]);

        $colocation=$user->colocation;
        $members=$colocation->users;
        $numberofmembers=$members->count();
        $amount=$expenseamount

        foreach($members as $member)
        $expense->users()->attach($user_id);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateexpenseRequest $request, expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(expense $expense)
    {
        //
    }
}
