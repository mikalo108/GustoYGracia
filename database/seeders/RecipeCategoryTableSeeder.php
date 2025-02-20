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
            'recipe_id' => $recipes->random()->id,
            'category_id' => $categories->random()->id,
        ]);

        DB::table('recipe_categories')->insert([
            'recipe_id' => $recipes->random()->id,
            'category_id' => $categories->random()->id,
        ]);
    }
}
