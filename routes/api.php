<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContractController;


// Resource Routes (CRUD operations)
Route::resource('owners', OwnerController::class);
Route::resource('properties', PropertyController::class);
Route::resource('contracts', ContractController::class);
