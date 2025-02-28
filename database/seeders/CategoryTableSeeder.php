<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar categorías en la tabla 'categories'
        DB::table('categories')->insert([
            ['name' => 'Appetizers', 'description' => 'Small dishes served before the main course.'],
            ['name' => 'Main Courses', 'description' => 'The primary dishes of a meal.'],
            ['name' => 'Desserts', 'description' => 'Sweet dishes served at the end of a meal.'],
        ]);

        // Obtener los IDs de las categorías insertadas
        $appetizersId = DB::table('categories')->where('name', 'Appetizers')->first()->id;
        $mainCoursesId = DB::table('categories')->where('name', 'Main Courses')->first()->id;
        $dessertsId = DB::table('categories')->where('name', 'Desserts')->first()->id;

        // Insertar traducciones en la tabla 'category_translations'
        DB::table('category_translations')->insert([
            // Traducciones de 'Appetizers'
            ['category_id' => $appetizersId, 'locale' => 'es', 'name' => 'Aperitivos', 'description' => 'Pequeños platos servidos antes del plato principal.'],
            ['category_id' => $appetizersId, 'locale' => 'en', 'name' => 'Appetizers', 'description' => 'Small dishes served before the main course.'],

            // Traducciones de 'Main Courses'
            ['category_id' => $mainCoursesId, 'locale' => 'es', 'name' => 'Platos principales', 'description' => 'Los platos principales de una comida.'],
            ['category_id' => $mainCoursesId, 'locale' => 'en', 'name' => 'Main Courses', 'description' => 'The primary dishes of a meal.'],

            // Traducciones de 'Desserts'
            ['category_id' => $dessertsId, 'locale' => 'es', 'name' => 'Postres', 'description' => 'Platos dulces servidos al final de una comida.'],
            ['category_id' => $dessertsId, 'locale' => 'en', 'name' => 'Desserts', 'description' => 'Sweet dishes served at the end of a meal.'],
        ]);
    }
}
