<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::post('/change-language', function (Request $request) {
    $language = $request->input('language');
    Session::put('locale', $language);
    App::setLocale($language);
    return redirect()->back();
})->name('changeLanguage');

Route::get('/', 'CategoryController@index');

Route::get('/e', function () {
    return redirect('http://localhost/laravel/GustoYGracia/public/');
})->name('e');

Route::get('/admin', function () {
    return view('adminHome');
});

Route::get('/categories', 'CategoryController@showCategories');  // Esta ruta es para ver todas las categorías en otra vista
Route::resource('category', 'CategoryController');
Route::get('/category/delete/{category}', 'CategoryController@destroy')->name('category.myDestroy');

Route::get('/comment', 'CommentController@index')->name('comment.index');
Route::get('/comment/show/{comment}', 'CommentController@show')->name('comment.show');
Route::get('/comment/delete/{comment}', 'CommentController@destroy')->name('comment.myDestroy');

Route::resource('contact', 'ContactController');
Route::get('/contact/delete/{contact}', 'ContactController@destroy')->name('contact.myDestroy');

Route::resource('ingredient', 'IngredientController');
Route::get('/ingredient/delete/{ingredient}', 'IngredientController@destroy')->name('ingredient.myDestroy');

Route::resource('recipeCategory', 'RecipeCategoryController');
Route::get('/recipeCategory/delete/{recipeCategory}', 'RecipeCategoryController@destroy')->name('recipeCategory.myDestroy');

Route::resource('recipe', 'RecipeController');
Route::get('/recipe/delete/{recipe}', 'RecipeController@destroy')->name('recipe.myDestroy');
Route::get('/admin/recipe', 'RecipeController@index')->name('recipe.index');
Route::get('/admin/recipe/show/{recipe}', 'RecipeController@show')->name('recipe.show');
Route::get('/admin/recipe/create', 'RecipeController@create')->name('recipe.create');
Route::get('/admin/recipe/edit/{recipe}', 'RecipeController@edit')->name('recipe.edit');


Route::resource('recipeDetail', 'RecipeDetailController');
Route::get('/recipeDetail/delete/{recipeDetail}', 'RecipeDetailController@destroy')->name('recipeDetail.myDestroy');

Route::resource('recipeIngredient', 'RecipeIngredientController');
Route::get('/recipeIngredient/delete/{recipeIngredient}', 'RecipeIngredientController@destroy')->name('recipeIngredient.myDestroy');

Route::resource('user', 'UserController');