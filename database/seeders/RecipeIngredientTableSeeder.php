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
            'recipe_id' => 1,
            'ingredient_id' => 14,
            'quantity' => '200g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 1,
            'ingredient_id' => 16,
            'quantity' => '50g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 1,
            'ingredient_id' => 9,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 2,
            'ingredient_id' => 12,
            'quantity' => '250g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 2,
            'ingredient_id' => 1,
            'quantity' => '150g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 2,
            'ingredient_id' => 17,
            'quantity' => '1 cucharadita',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 3,
            'ingredient_id' => 8,
            'quantity' => '2 unidades',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 3,
            'ingredient_id' => 16,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 3,
            'ingredient_id' => 18,
            'quantity' => '2 cucharadas',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 4,
            'ingredient_id' => 20,
            'quantity' => '200g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 4,
            'ingredient_id' => 19,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 5,
            'ingredient_id' => 10,
            'quantity' => '500g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 5,
            'ingredient_id' => 16,
            'quantity' => '200g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 5,
            'ingredient_id' => 4,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 6,
            'ingredient_id' => 12,
            'quantity' => '2 unidades',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 6,
            'ingredient_id' => 8,
            'quantity' => '1 unidad',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 6,
            'ingredient_id' => 11,
            'quantity' => '1/4 de unidad',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 7,
            'ingredient_id' => 5,
            'quantity' => '150g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 7,
            'ingredient_id' => 13,
            'quantity' => '200g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 7,
            'ingredient_id' => 15,
            'quantity' => '3 unidades',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 8,
            'ingredient_id' => 12,
            'quantity' => '200g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 8,
            'ingredient_id' => 16,
            'quantity' => '50g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 8,
            'ingredient_id' => 9,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 9,
            'ingredient_id' => 13,
            'quantity' => '250g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 9,
            'ingredient_id' => 5,
            'quantity' => '150g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 9,
            'ingredient_id' => 15,
            'quantity' => '2 unidades',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 10,
            'ingredient_id' => 8,
            'quantity' => '1 unidad',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 10,
            'ingredient_id' => 16,
            'quantity' => '50g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 10,
            'ingredient_id' => 4,
            'quantity' => '50g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 11,
            'ingredient_id' => 14,
            'quantity' => '250g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 11,
            'ingredient_id' => 11,
            'quantity' => '150g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 11,
            'ingredient_id' => 16,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 12,
            'ingredient_id' => 16,
            'quantity' => '50g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 12,
            'ingredient_id' => 17,
            'quantity' => '3 unidades',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 13,
            'ingredient_id' => 14,
            'quantity' => '300g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 13,
            'ingredient_id' => 12,
            'quantity' => '250g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 13,
            'ingredient_id' => 9,
            'quantity' => '200g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 14,
            'ingredient_id' => 8,
            'quantity' => '4 unidades',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 14,
            'ingredient_id' => 18,
            'quantity' => '1 unidad',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 15,
            'ingredient_id' => 16,
            'quantity' => '200g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 15,
            'ingredient_id' => 17,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 16,
            'ingredient_id' => 16,
            'quantity' => '400g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 16,
            'ingredient_id' => 5,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 17,
            'ingredient_id' => 19,
            'quantity' => '100g',
        ]);
        
        DB::table('recipe_ingredients')->insert([
            'recipe_id' => 17,
            'ingredient_id' => 5,
            'quantity' => '50g',
        ]);
        
    }
}
