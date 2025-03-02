<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;

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
Route::post('/category/update/{category}', 'CategoryController@update')->name('category.update');
Route::get('/category/show/{category}', 'CategoryController@show');

Route::resource('comment', 'CommentController');
Route::post('/comment/update/{comment}', 'CommentController@update')->name('comment.update');
Route::get('/comment/show/{comment}', 'CommentController@show')->name('comment.show');

Route::resource('contact', 'ContactController');
Route::post('/contact/update/{contact}', 'ContactController@update')->name('contact.update');
Route::get('/contact/show/{contact}', 'ContactController@show')->name('contact.show');

Route::resource('ingredient', 'IngredientController');
Route::post('/ingredient/update/{ingredient}', 'IngredientController@update')->name('ingredient.update');
Route::get('/ingredient/show/{ingredient}', 'IngredientController@show')->name('ingredient.show');

Route::resource('recipe', 'RecipeController');
Route::post('/recipe/update/{recipe}', 'RecipeController@update')->name('recipe.update');
Route::get('/recipe/show/{recipe}', 'RecipeController@show')->name('recipe.show');

// Búsqueda de usuarios
Route::get('/users/search', function (Request $request) {
    $search = $request->input('query');
    $users = User::where('name', 'LIKE', "%{$search}%")->take(5)->get();
    return response()->json($users);
});

Route::resource('user', 'UserController');

require __DIR__.'/auth.php';