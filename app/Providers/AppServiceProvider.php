<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        // Verifica si la tabla 'categories' existe antes de consultarla
        if (Schema::hasTable('categories')) {
            $categoryList = Category::all();
            View::share('categoryList', $categoryList);
        }

        // Verifica si la tabla 'recipes' existe antes de consultarla
        if (Schema::hasTable('recipes')) {
            $recipeListLatest = Recipe::orderBy('id', 'desc')->take(3)->get();
            $recipeListRandom = Recipe::inRandomOrder()->take(3)->get();

            View::share('recipeListLatest', $recipeListLatest);
            View::share('recipeListRandom', $recipeListRandom);
        }
    }
}
