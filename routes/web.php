<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\DebterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomepageController::class, 'index'])->name('homepage.index')->middleware('guest');

Route::get('/user/login', [UserController::class, 'login'])->name('user.login')->middleware('guest');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login')->middleware('guest');
Route::get('/user/register', [UserController::class, 'register'])->name('user.register')->middleware('guest');
Route::post('/user/register', [UserController::class, 'register'])->name('user.register')->middleware('guest');
Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/debt', [DebtController::class, 'index'])->name('debt.index');
Route::get('/debt/create', [DebtController::class, 'create'])->name('debt.create');
Route::post('/debt/create', [DebtController::class, 'create'])->name('debt.create');
Route::get('/debt/update/{debt_id}', [DebtController::class, 'updateGET'])->name('debt.update');
Route::post('/debt/update/{debt_id}', [DebtController::class, 'updatePOST'])->name('debt.update');
Route::get('/debt/delete/{debt_id}', [DebtController::class, 'delete'])->name('debt.delete');
Route::get('/debt/mark-as-paid/{debt_id}', [DebtController::class, 'mark_as_paid'])->name('debt.mark_as_paid');