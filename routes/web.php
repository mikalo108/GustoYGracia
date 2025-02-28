<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

Route::post('/change-language', function (Request $request) {
    $language = $request->input('language'); // Obtiene el idioma seleccionado
    Session::put('locale', $language); // Guarda el idioma en la sesión
    App::setLocale($language); // Establece el idioma para la aplicación
    return redirect()->back();
})->name('changeLanguage');

Route::get('/', function () {
    return view('home');
});
Route::get('/admin', function () {
    return view('adminHome');
});

Route::resource('category', 'CategoryController');
Route::get('/category/delete/{category}', 'CategoryController@destroy')->name('category.myDestroy');

Route::get('/comment/index', 'CommentController@index')->name('comment.index');
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

Route::resource('recipeDetail', 'RecipeDetailController');
Route::get('/recipeDetail/delete/{recipeDetail}', 'RecipeDetailController@destroy')->name('recipeDetail.myDestroy');

Route::resource('recipeIngredient', 'RecipeIngredientController');
Route::get('/recipeIngredient/delete/{recipeIngredient}', 'RecipeIngredientController@destroy')->name('recipeIngredient.myDestroy');

Route::resource('user', 'UserController');