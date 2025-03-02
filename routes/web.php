<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/change-language', function (Request $request) {
    $language = $request->input('language');
    Session::put('locale', $language);
    App::setLocale($language);
    return redirect()->back();
})->name('changeLanguage');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/myprofile', function () {
    return view('myprofile');
})->name('myprofile');

Route::resource('category', 'CategoryController');
Route::get('/category/show/{category}', 'CategoryController@show');
Route::get('/category/delete/{category}', 'CategoryController@destroy')->name('category.myDestroy');

Route::resource('comment', 'CategoryController');
Route::get('/comment/show/{comment}', 'CommentController@show')->name('comment.show');
Route::get('/comment/delete/{comment}', 'CommentController@destroy')->name('comment.myDestroy');

Route::resource('contact', 'ContactController');
Route::get('/category/show/{contact}', 'ContactController@show')->name('contact.show');
Route::get('/contact/delete/{contact}', 'ContactController@destroy')->name('contact.myDestroy');

Route::resource('ingredient', 'IngredientController');
Route::get('/ingredient/show/{ingredient}', 'IngredientController@show')->name('ingredient.show');
Route::get('/ingredient/delete/{ingredient}', 'IngredientController@destroy')->name('ingredient.myDestroy');

Route::resource('recipe', 'RecipeController');
Route::get('/recipe/show/{recipe}', 'RecipeController@show')->name('recipe.show');
Route::get('/recipe/delete/{recipe}', 'RecipeController@destroy')->name('recipe.myDestroy');

Route::resource('user', 'UserController');

require __DIR__.'/auth.php';