<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RecipeIngredient;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

class RecipeIngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = Recipe::all();
        $ingredients = Ingredient::all();

        if ($recipes->isEmpty() || $ingredients->isEmpty()) {
            $this->command->warn('No recipes or ingredients found. Please create them first.');
            return;
        }

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '200g',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '20g',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '4g',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '54g',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '100g',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '1 taza',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '2 tazas',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '1/2 taza',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '34g cup',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '3 tazas',
        ]);

        DB::table('recipe_ingredients')->insert([
            'recipe_id' => $recipes->random()->id,
            'ingredient_id' => $ingredients->random()->id,
            'quantity' => '50g',
        ]);
    }
}
