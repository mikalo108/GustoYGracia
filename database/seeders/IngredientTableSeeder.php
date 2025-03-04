<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;
use Carbon\Carbon;
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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Arroz blanco',
            'description' => 'Carbohidratos sanos',
            'calories_per_100g' => 111,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Brócoli',
            'description' => 'Una verdura nutritiva',
            'calories_per_100g' => 34,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Queso',
            'description' => 'Leche fermentada',
            'calories_per_100g' => 244,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Aceite de oliva',
            'description' => 'El mejor aceite para cocinar',
            'calories_per_100g' => 324,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pan rallado',
            'description' => 'Como el pan, pero con un mal día',
            'calories_per_100g' => 34,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Tomate',
            'description' => 'Hortaliza roja',
            'calories_per_100g' => 34,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Leche',
            'description' => 'De la vaca',
            'calories_per_100g' => 34,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pimienta',
            'description' => 'Especia que pica un poco',
            'calories_per_100g' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Azúcar',
            'description' => 'Sustancia dulce utilizada en la repostería y cocina.',
            'calories_per_100g' => 387,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Harina',
            'description' => 'Polvo obtenido al moler diversos granos, utilizado para cocinar.',
            'calories_per_100g' => 364,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Huevo',
            'description' => 'Producto de las aves, especialmente utilizado en la cocina para diversas preparaciones.',
            'calories_per_100g' => 155,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Fresa',
            'description' => 'Fruto pequeño, jugoso y de color rojo, utilizado en postres y ensaladas.',
            'calories_per_100g' => 32,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Judías Blancas',
            'description' => 'Legumbres de color blanco, utilizadas en sopas y guisos.',
            'calories_per_100g' => 127,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Langostino',
            'description' => 'Marisco de gran tamaño, comúnmente utilizado en platos como paellas o mariscadas.',
            'calories_per_100g' => 106,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pollo',
            'description' => 'Carne de ave, versátil y comúnmente utilizada en diversas recetas.',
            'calories_per_100g' => 165,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Curry',
            'description' => 'Mezcla de especias aromáticas, utilizada principalmente en la cocina india.',
            'calories_per_100g' => 325,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Aguacate',
            'description' => 'Fruto de la palta, rico en grasas saludables y utilizado en ensaladas y salsas.',
            'calories_per_100g' => 160,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Salmón',
            'description' => 'Pescado de agua fría, conocido por su sabor suave y alto contenido en ácidos grasos omega-3.',
            'calories_per_100g' => 208,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Espárragos',
            'description' => 'Verdura de tallos largos y delgados, utilizada en guisos y como acompañamiento.',
            'calories_per_100g' => 20,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pasta',
            'description' => 'Producto alimenticio hecho de harina y agua, utilizado en una amplia variedad de platos.',
            'calories_per_100g' => 131,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Champiñón',
            'description' => 'Hongo comestible que se utiliza en sopas, ensaladas y como acompañamiento.',
            'calories_per_100g' => 22,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Calabacín',
            'description' => 'Verdura de color verde y forma alargada, utilizada en guisos y ensaladas.',
            'calories_per_100g' => 17,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Pimiento Verde',
            'description' => 'Variedad de pimiento con un sabor algo más amargo, utilizado en ensaladas y guisos.',
            'calories_per_100g' => 20,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Cebolla',
            'description' => 'Bulbo de planta comestible, utilizado en una gran variedad de preparaciones culinarias.',
            'calories_per_100g' => 40,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Chocolate',
            'description' => 'Producto derivado del cacao, utilizado en postres, bebidas y otros platos.',
            'calories_per_100g' => 546,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Jamón Serrano',
            'description' => 'Jamón curado de cerdo, típicamente de la gastronomía española.',
            'calories_per_100g' => 241,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('ingredients')->insert([
            'name' => 'Maicena',
            'description' => 'Almidón de maíz, utilizado como espesante en salsas, sopas y postres.',
            'calories_per_100g' => 381,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
