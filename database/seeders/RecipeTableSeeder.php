<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Recipe;
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
                'name' => 'Spaghetti Carbonara',
                'image' => 'recipes/spaghetti_carbonara.jpg',
                'description' => 'Un plato clásico de Italia.',
                'instructions' => 'Cook pasta, fry pancetta, mix with eggs and cheese.',
                'user_id' => $users->random()->id,
            ],
            [
                'name' => 'Pollo al Curry con Arroz Basmati',
                'image' => 'recipes/pollo_curry.jpg',
                'description' => 'Un plato aromático y especiado de la India.',
                'instructions' => 'Saltear pollo con cebolla, ajo y especias de curry. Cocinar a fuego lento con leche de coco y servir con arroz basmati.',
                'user_id' => $users->random()->id,
            ],
            [
                'name' => 'Ensalada Caprese',
                'image' => 'recipes/ensalada_caprese.jpg',
                'description' => 'Una ensalada italiana sencilla y refrescante.',
                'instructions' => 'Intercalar rodajas de tomate y mozzarella fresca. Rociar con aceite de oliva y hojas de albahaca.',
                'user_id' => $users->random()->id,
            ],
            [
                'name' => 'Salmón al Horno con Espárragos',
                'image' => 'recipes/salmon_esparragos.jpg',
                'description' => 'Una comida saludable y deliciosa.',
                'instructions' => 'Sazonar filetes de salmón con sal, pimienta y limón. Hornear junto con espárragos hasta que estén tiernos.',
                'user_id' => $users->random()->id,
            ],
            [
                'name' => 'Lasaña de Carne',
                'image' => 'recipes/lasaña_carne.jpg',
                'description' => 'Un clásico plato italiano de pasta al horno.',
                'instructions' => 'Alternar capas de pasta, salsa de carne, queso ricotta y mozzarella. Hornear hasta que esté dorado y burbujeante.',
                'user_id' => $users->random()->id,
            ],
            [
                'name' => 'Guacamole con Totopos',
                'image' => 'recipes/guacamole_totopos.jpg',
                'description' => 'Un aperitivo mexicano popular.',
                'instructions' => 'Machacar aguacate con cebolla, tomate, cilantro, jalapeño y lima. Servir con totopos de maíz.',
                'user_id' => $users->random()->id,
            ],
        ]);

        

    }
}
