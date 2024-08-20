<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiariosController;

Route::resource('diarios', DiariosController::class);

Route::get('/', function () {
    return redirect()->route('diarios.index');
});

