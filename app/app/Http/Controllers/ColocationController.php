<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Http\Requests\StoreColocationRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('colocation');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-join-colocation');
        $user=Auth::user();
        return index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColocationRequest $request)
    {
        $user=Auth::user();
        $name=$request->validated();
        $colocation=Colocation::create($name);
        $colocation->users()->attach($user->id,['role'=>'owner']);
        $user->update(['is_owner'=>true]);
        return redirect()->route('colocation.index');
    }

    /**
     * Display the specified resource.
     */

    public function joinColocation(Request $request){
        Gate::authorize('create-join-colocation');
        $user=Auth::user();
        $request->validate(['token'=>['required','uuid']]);
        $colocation=Colocation::where('token',$request->token)->first();
        $colocation->users()->attach($user->id,['role'=>'member']);
        return redirect()->route('colocation.index');
    }
    
    public function join(){
        return view('join-colocation');
    }

    public function quitColocation(){
        $user=Auth::user();
        $colocation=$user->colocations->where('is_active',true)->first();
        $colocation->users()->detach($user_id);
        $expenses=$user->expenses()->get();
        $membership=$user->memberships->where('colocation_id',$colocation_id)->first();
        if ($membership->role==='admin'){
             return back()->with('error', 'Owner of expense cannot quit.');
        }
        $user->expenses()->detach();
        $owner=
    }

    public function show(Colocation $colocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Colocation $colocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColocationRequest $request, Colocation $colocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Colocation $colocation)
    {
        //
    }
}
