<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('category', 'CategoryController');
Route::get('/category/delete/{category}', 'CategoryController@destroy')->name('category.myDestroy');

Route::resource('comment', 'CommentController');
Route::get('/comment/delete/{comment}', 'CommentController@destroy')->name('comment.myDestroy');