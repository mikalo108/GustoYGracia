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
            'recipe_id' => $recipes->random()->id,
            'prep_time' => 30,
            'difficulty_level' => 'Medium',
        ]);
    }
}
