<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContractController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Owners Routes
Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
Route::get('/owners/{owner}', [OwnerController::class, 'show'])->name('owners.show');

// Properties Routes
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');

// Contracts Routes
Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
Route::get('/contracts/{contract}', [ContractController::class, 'show'])->name('contracts.show');


// Note: Resource routes moved to routes/api.php
