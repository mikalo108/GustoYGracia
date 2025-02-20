<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('category', 'CategoryController');
Route::get('/categories/delete/{category_id}', 'CategoryController@destroy')->name('category.myDestroy');