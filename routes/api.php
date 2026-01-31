<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContractController;


// Resource Routes (CRUD operations)
// Route::resource('owners', OwnerController::class);
// Route::resource('properties', PropertyController::class);
// Route::resource('contracts', ContractController::class);

Route::resource('owners', OwnerController::class)->names([
    'index' => 'api.owners.index',
    'show' => 'api.owners.show',
    'store' => 'api.owners.store',
    'update' => 'api.owners.update',
    'destroy' => 'api.owners.destroy',
    'create' => 'api.owners.create',
    'edit' => 'api.owners.edit',
]);

Route::resource('properties', PropertyController::class)->names([
    'index' => 'api.properties.index',
    'show' => 'api.properties.show',
    'store' => 'api.properties.store',
    'update' => 'api.properties.update',
    'destroy' => 'api.properties.destroy',
    'create' => 'api.properties.create',
    'edit' => 'api.properties.edit',
]);

Route::resource('contracts', ContractController::class)->names([
    'index' => 'api.contracts.index',
    'show' => 'api.contracts.show',
    'store' => 'api.contracts.store',
    'update' => 'api.contracts.update',
    'destroy' => 'api.contracts.destroy',
    'create' => 'api.contracts.create',
    'edit' => 'api.contracts.edit',
]);
