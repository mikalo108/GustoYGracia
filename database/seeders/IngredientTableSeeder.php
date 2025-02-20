<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;

class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            'name' => 'Chicken Breast',
            'description' => 'Lean protein source',
            'calories_per_100g' => 165,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Brown Rice',
            'description' => 'Healthy carbohydrate',
            'calories_per_100g' => 111,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Broccoli',
            'description' => 'Nutritious vegetable',
            'calories_per_100g' => 34,
        ]);

    }
}
