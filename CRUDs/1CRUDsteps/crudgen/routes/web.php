<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/cruds', 'App\Http\Controllers\CrudsController');
Route::resource('/products', 'App\Http\Controllers\ProductsController');
