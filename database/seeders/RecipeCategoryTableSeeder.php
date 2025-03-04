<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RecipeCategory;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class RecipeCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = Recipe::all();
        $categories = Category::all();

        if ($recipes->isEmpty() || $categories->isEmpty()) {
            $this->command->warn('No recipes or categories found. Please create them first.');
            return;
        }

        DB::table('recipe_categories')->insert([
            'recipe_id' => 1,
            'category_id' => 2,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 2,
            'category_id' => 2,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 3,
            'category_id' => 1,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 4,
            'category_id' => 2,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 5,
            'category_id' => 2,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 6,
            'category_id' => 1,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 7,
            'category_id' => 3,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 8,
            'category_id' => 2,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 9,
            'category_id' => 3,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 10,
            'category_id' => 1,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 11,
            'category_id' => 2,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 12,
            'category_id' => 3,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 13,
            'category_id' => 2,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 14,
            'category_id' => 1,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 15,
            'category_id' => 3,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 16,
            'category_id' => 3,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 17,
            'category_id' => 1,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => 18,
            'category_id' => 2,
        ]);
    }
}
