<?php

use App\Http\Controllers\RfidCardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/rfid')->group(function () {
    Route::controller(RfidCardController::class)->group(function () {
        Route::get('/get_id', 'getId')->name('rfid.getId');
    });
});
