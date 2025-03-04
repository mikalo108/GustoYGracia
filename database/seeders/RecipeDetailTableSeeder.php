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
            'difficulty_level' => 'Media',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 2,
            'prep_time' => 40,
            'difficulty_level' => 'Baja',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 3,
            'prep_time' => 40,
            'difficulty_level' => 'Baja',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 4,
            'prep_time' => 15,
            'difficulty_level' => 'Alta',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 5,
            'prep_time' => 40,
            'difficulty_level' => 'Baja',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 6,
            'prep_time' => 25,
            'difficulty_level' => 'Media',
        ]);

        DB::table('recipe_details')->insert([
            'recipe_id' => 7,
            'prep_time' => 20,
            'difficulty_level' => 'Alta',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 8,
            'prep_time' => 45,
            'difficulty_level' => 'Baja',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 9,
            'prep_time' => 30,
            'difficulty_level' => 'Media',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 10,
            'prep_time' => 50,
            'difficulty_level' => 'Alta',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 11,
            'prep_time' => 25,
            'difficulty_level' => 'Media',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 12,
            'prep_time' => 35,
            'difficulty_level' => 'Baja',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 13,
            'prep_time' => 40,
            'difficulty_level' => 'Alta',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 14,
            'prep_time' => 55,
            'difficulty_level' => 'Media',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 15,
            'prep_time' => 30,
            'difficulty_level' => 'Baja',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 16,
            'prep_time' => 60,
            'difficulty_level' => 'Alta',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 17,
            'prep_time' => 20,
            'difficulty_level' => 'Media',
        ]);
        
        DB::table('recipe_details')->insert([
            'recipe_id' => 18,
            'prep_time' => 45,
            'difficulty_level' => 'Baja',
        ]);
        
    }
}
