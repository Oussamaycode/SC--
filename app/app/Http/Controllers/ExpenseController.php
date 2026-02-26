<?php

namespace App\Http\Controllers;

use App\Models\expense;
use App\Models\Colocation;
use App\Models\Membership;
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
        $expenses=Expense::all();     
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
        $user=auth()->user();
        Gate::authorize('add-expense');
        $expense=Expense::create(['amount'=>$request->amount,
        'description'=>$request->description,
        'user_id'=>$user->id,
        'categorie_id'=>$request->categorie_id]);

        $membership=Membership::where('user_id',$user->id)->first();
        $colocation=Colocation::where('id',$membership->colocation_id)->where('is_active',true)->first();
        $members=$colocation->users;
        $numberofmembers=$colocation->users()->count();
        $amount=$expense->amount/$numberofmembers;

        foreach($members as $member)

        if($member->id!=$user->id) {
          $expense->users()->attach($member->id,['amount'=>$amount]);
        } 
        
        return redirect()->route('expense.index');
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
