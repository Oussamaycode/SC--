<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DetteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/dashboard',[ColocationController::class,'store'])->name('colocation.store');
    Route::get('/colocation',[ColocationController::class,'index'])->name('colocation.index');
    Route::get('/join',[ColocationController::class,'join'])->name('colocation.join.show');
    Route::post('/join',[ColocationController::class,'joinColocation'])->name('colocation.join');
    Route::get('/expense',[ExpenseController::class,'index'])->name('expense.index');
    Route::post('/expense',[ExpenseController::class,'store'])->name('expense.store');
    Route::get('/dette',[DetteController::class,'index'])->name('dette.index');
});

require __DIR__.'/auth.php';
