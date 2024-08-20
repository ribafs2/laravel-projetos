<?php

use Illuminate\Support\Facades\Route;

Route::resource('/libs', 'App\Http\Controllers\LibsController');

Route::get('/', function () {
    return redirect()->route('libs.index');
});
