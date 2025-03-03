<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please create users first.');
            return;
        }

        DB::table('recipes')->insert([
            [
                'name' => 'Espaguetis a la Carbonara',
                'image' => 'recipes/spaghetti_carbonara.jpg',
                'description' => 'Un plato clásico de Italia.',
                'instructions' => 'Cocinar la pasta, freír la panceta y mezclar con huevo.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pollo al Curry con Arroz Basmati',
                'image' => 'recipes/pollo_curry.jpg',
                'description' => 'Un plato aromático y especiado de la India.',
                'instructions' => 'Saltear pollo con cebolla, ajo y especias de curry. Cocinar a fuego lento con leche de coco y servir con arroz basmati.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ensalada Caprese',
                'image' => 'recipes/ensalada_caprese.jpg',
                'description' => 'Una ensalada italiana sencilla y refrescante.',
                'instructions' => 'Intercalar rodajas de tomate y mozzarella fresca. Rociar con aceite de oliva y hojas de albahaca.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Salmón al Horno con Espárragos',
                'image' => 'recipes/salmon_esparragos.jpg',
                'description' => 'Una comida saludable y deliciosa.',
                'instructions' => 'Sazonar filetes de salmón con sal, pimienta y limón. Hornear junto con espárragos hasta que estén tiernos.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lasaña de Carne',
                'image' => 'recipes/lasaña_carne.jpg',
                'description' => 'Un clásico plato italiano de pasta al horno.',
                'instructions' => 'Alternar capas de pasta, salsa de carne, queso ricotta y mozzarella. Hornear hasta que esté dorado y burbujeante.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Guacamole con Totopos',
                'image' => 'recipes/guacamole_totopos.jpg',
                'description' => 'Un aperitivo mexicano popular.',
                'instructions' => 'Machacar aguacate con cebolla, tomate, cilantro, jalapeño y lima. Servir con totopos de maíz.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
