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
            'name' => 'Sal',
            'description' => 'Sodio',
            'calories_per_100g' => 165,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Arroz blanco',
            'description' => 'Carbohidratos sanos',
            'calories_per_100g' => 111,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Brócoli',
            'description' => 'Una verdura nutritiva',
            'calories_per_100g' => 34,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Queso',
            'description' => 'Leche fermentada',
            'calories_per_100g' => 244,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Aceite de oliva',
            'description' => 'El mejor aceite para cocinar',
            'calories_per_100g' => 324,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pan rallado',
            'description' => 'Como el pan, pero con un mal día',
            'calories_per_100g' => 34,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Tomate',
            'description' => 'Hortaliza roja',
            'calories_per_100g' => 34,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Leche',
            'description' => 'De la vaca',
            'calories_per_100g' => 34,
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pimienta',
            'description' => 'Especia que pica un poco',
            'calories_per_100g' => 4,
        ]);

    }
}
