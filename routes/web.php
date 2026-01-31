<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// Test route (temporary - for testing layout)
// Route::get('/test', function () {
//     return view('test');
// })->name('test');

// Note: Resource routes moved to routes/api.php
