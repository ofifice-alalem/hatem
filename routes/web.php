<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PendingRequestController;
use App\Http\Controllers\MilitaryInfoController;
use App\Http\Controllers\WorkInfoController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\NonCommissionedOfficerController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('welcome');
});

// الأشخاص
Route::resource('persons', PersonController::class);
Route::delete('/persons-delete-all', [PersonController::class, 'deleteAll'])->name('persons.delete.all');
Route::get('/api/ranks/{categoryId}', [PersonController::class, 'getRanksByCategory'])->name('ranks.by.category');
Route::get('/persons/{person}/change-rank', [PersonController::class, 'changeRank'])->name('persons.change-rank');
Route::put('/persons/{person}/update-rank', [PersonController::class, 'updateRank'])->name('persons.update-rank');
Route::get('/change-officer-rank', [PersonController::class, 'changeOfficerRank'])->name('persons.change-officer-rank');
Route::get('/change-nco-rank', [PersonController::class, 'changeNcoRank'])->name('persons.change-nco-rank');
Route::get('/change-employee-rank', [PersonController::class, 'changeEmployeeRank'])->name('persons.change-employee-rank');

// الضباط
Route::resource('officers', OfficerController::class);

// ضباط الصف
Route::resource('non-commissioned-officers', NonCommissionedOfficerController::class);

// الموظفين
Route::resource('employees', EmployeeController::class);

// المعلومات العسكرية
Route::get('/military-info/create/{nationalId}', [MilitaryInfoController::class, 'create'])->name('military-info.create');
Route::post('/military-info', [MilitaryInfoController::class, 'store'])->name('military-info.store');
Route::get('/military-info/{id}/edit', [MilitaryInfoController::class, 'edit'])->name('military-info.edit');
Route::put('/military-info/{id}', [MilitaryInfoController::class, 'update'])->name('military-info.update');

// معلومات العمل
Route::get('/work-info/create/{nationalId}', [WorkInfoController::class, 'create'])->name('work-info.create');
Route::post('/work-info', [WorkInfoController::class, 'store'])->name('work-info.store');
Route::get('/work-info/{id}/edit', [WorkInfoController::class, 'edit'])->name('work-info.edit');
Route::put('/work-info/{id}', [WorkInfoController::class, 'update'])->name('work-info.update');

// الإجازات
Route::resource('leaves', LeaveController::class);
Route::get('/leaves/create/{nationalId?}', [LeaveController::class, 'create'])->name('leaves.create.person');

// الطلبات المعلقة
Route::get('/pending', [PendingRequestController::class, 'index'])->name('pending.index');
Route::post('/pending/{id}/approve', [PendingRequestController::class, 'approve'])->name('pending.approve');
Route::post('/pending/{id}/reject', [PendingRequestController::class, 'reject'])->name('pending.reject');


