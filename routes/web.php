<?php

use App\Http\Controllers\RfidCardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::controller(RfidCardController::class)->group(function () {
    Route::get('/rfid', 'index');
    Route::get('/rfid/show_data', 'showRfidData')->name('rfid.showData');
    Route::get('/rfid/truncate_data', 'truncateData')->name('rfid.truncateData');
    Route::get('/rfid/get_id', 'getId')->name('rfid.getId');
});
