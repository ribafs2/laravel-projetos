<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\FormController;
  
Route::get('users/create', [ FormController::class, 'create' ]);
Route::post('users/create', [ FormController::class, 'store' ])->name('users.store');
