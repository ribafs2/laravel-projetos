<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('inventories.index');
});

Route::resource('/products', 'App\Http\Controllers\ProductsController');
Route::resource('/inventories', 'App\Http\Controllers\InventoriesController');
Route::resource('/buys', 'App\Http\Controllers\BuysController');
Route::resource('/sales', 'App\Http\Controllers\SalesController');

