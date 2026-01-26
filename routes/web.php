<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Owner Resource Routes
Route::resource('owners', OwnerController::class);
Route::resource('properties', PropertyController::class);
Route::resource('contracts', ContractController::class);
