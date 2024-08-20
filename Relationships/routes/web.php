<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['name' => 'Riba']);
});

Route::resource('/posts', 'App\Http\Controllers\PostsController');
Route::resource('/comments', 'App\Http\Controllers\CommentsController');
