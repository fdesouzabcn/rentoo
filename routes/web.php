<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContractController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Owners Routes
// Route::resource('owners', OwnerController::class);
Route::get('/owners', [OwnerController::class, 'index'])->name('owners.index');
Route::get('/owners/create', [OwnerController::class, 'create'])->name('owners.create');
Route::post('/owners', [OwnerController::class, 'store'])->name('owners.store');
Route::get('/owners/{owner}', [OwnerController::class, 'show'])->name('owners.show');
Route::get('/owners/{owner}/edit', [OwnerController::class, 'edit'])->name('owners.edit');
Route::put('/owners/{owner}', [OwnerController::class, 'update'])->name('owners.update');
Route::delete('/owners/{owner}', [OwnerController::class, 'destroy'])->name('owners.destroy');

// Properties Routes
// Route::resource('properties', PropertyController::class);
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');


// Contracts Routes
// Route::resource('contracts', ContractController::class);
Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
Route::get('/contracts/{contract}', [ContractController::class, 'show'])->name('contracts.show');
Route::get('/contracts/{contract}/edit', [ContractController::class, 'edit'])->name('contracts.edit');
Route::put('/contracts/{contract}', [ContractController::class, 'update'])->name('contracts.update');
Route::delete('/contracts/{contract}', [ContractController::class, 'destroy'])->name('contracts.destroy');

// Note: Resource routes moved to routes/api.php
