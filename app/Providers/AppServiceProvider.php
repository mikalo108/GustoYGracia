<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Recipe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $categoryList = Category::all();
        $recipeList = Recipe::all();
        $recipeListLatest = Recipe::orderBy('id', 'desc')->take(3)->get();
        $recipeListRandom = Recipe::inRandomOrder()->take(3)->get();
        View::share('categoryList', $categoryList);
        View::share('recipeListLatest', $recipeListLatest);
        View::share('recipeListRandom', $recipeListRandom);
        View::share('recipeList', $recipeList);
    }
}
