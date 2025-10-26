<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PendingRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/persons', [PersonController::class, 'index'])->name('persons.index');
Route::get('/persons/create', [PersonController::class, 'create'])->name('persons.create');
Route::post('/persons', [PersonController::class, 'store'])->name('persons.store');
Route::get('/persons/{person}/edit', [PersonController::class, 'edit'])->name('persons.edit');
Route::put('/persons/{person}', [PersonController::class, 'update'])->name('persons.update');
Route::delete('/persons/{person}', [PersonController::class, 'destroy'])->name('persons.destroy');
Route::get('/api/ranks/{typeId}', [PersonController::class, 'getRanksByType'])->name('ranks.by.type');

Route::get('/pending', [PendingRequestController::class, 'index'])->name('pending.index');
Route::post('/pending/{id}/approve', [PendingRequestController::class, 'approve'])->name('pending.approve');
Route::post('/pending/{id}/reject', [PendingRequestController::class, 'reject'])->name('pending.reject');


