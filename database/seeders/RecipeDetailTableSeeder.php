<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\RecipeDetail;
use Illuminate\Support\Facades\DB;

class RecipeDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipes = Recipe::all();

        if ($recipes->isEmpty()) {
            $this->command->warn('No recipes found. Please create recipes first.');
            return;
        }

        DB::table('recipe_details')->insert([
            'recipe_id' => 1,
            'prep_time' => 30,
            'difficulty_level' => 'Medio',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 2,
            'prep_time' => 40,
            'difficulty_level' => 'Bajo',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 3,
            'prep_time' => 40,
            'difficulty_level' => 'Bajo',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 4,
            'prep_time' => 15,
            'difficulty_level' => 'Alto',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 5,
            'prep_time' => 40,
            'difficulty_level' => 'Bajo',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 6,
            'prep_time' => 25,
            'difficulty_level' => 'Medio',
        ]);
    }
}
