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
            [
                'name' => 'Bizcocho',
                'image' => 'recipes/bizcocho.png',
                'description' => 'Un postre esponjoso y delicioso.',
                'instructions' => 'Batir huevos, azúcar y aceite. Añadir harina y levadura. Hornear a 180°C durante 30 minutos.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Crepés de Pollo y Champiñones',
                'image' => 'recipes/crepes.png',
                'description' => 'Crepés rellenos de pollo y champiñones en salsa cremosa.',
                'instructions' => 'Preparar la masa de crepés. Rellenar con pollo y champiñones salteados en salsa de crema. Doblar y servir caliente.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cupcakes',
                'image' => 'recipes/cupcakes.png',
                'description' => 'Pequeños pasteles individuales decorados.',
                'instructions' => 'Mezclar harina, azúcar, huevos y mantequilla. Hornear en moldes para cupcakes. Decorar con crema y toppings.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ensalada César',
                'image' => 'recipes/ensalada_cesar.png',
                'description' => 'Una ensalada clásica con lechuga, crutones y aderezo César.',
                'instructions' => 'Mezclar lechuga romana, crutones, queso parmesano y aderezo César. Servir fría.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Fabada Asturiana',
                'image' => 'recipes/fabada_asturiana.png',
                'description' => 'Un plato tradicional asturiano con fabes y embutidos.',
                'instructions' => 'Cocer fabes con chorizo, morcilla y panceta. Servir caliente.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Flan de Huevo',
                'image' => 'recipes/flan.png',
                'description' => 'Un postre cremoso y dulce.',
                'instructions' => 'Preparar caramelo líquido. Mezclar huevos, leche y azúcar. Hornear al baño María durante 45 minutos.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Paella',
                'image' => 'recipes/paella.png',
                'description' => 'Un plato de arroz típico de la cocina española.',
                'instructions' => 'Sofreír arroz con azafrán, pollo, mariscos y verduras. Cocinar con caldo hasta que el arroz esté listo.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Sopa de Tomate',
                'image' => 'recipes/sopa_tomate.png',
                'description' => 'Una sopa cremosa y reconfortante.',
                'instructions' => 'Cocer tomates con cebolla, ajo y hierbas. Triturar y servir caliente con un toque de crema.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tarta de Chocolate',
                'image' => 'recipes/tarta_chocolate.png',
                'description' => 'Un postre rico y decadente.',
                'instructions' => 'Derretir chocolate y mezclar con mantequilla, huevos y azúcar. Hornear y dejar enfriar antes de servir.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tarta de Queso',
                'image' => 'recipes/tarta_queso.png',
                'description' => 'Un clásico postre cremoso.',
                'instructions' => 'Mezclar queso crema, huevos, azúcar y vainilla. Hornear sobre una base de galletas trituradas.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Tartaletas de Aperitivo',
                'image' => 'recipes/tartaletas.png',
                'description' => 'Pequeñas tartaletas saladas para aperitivos.',
                'instructions' => 'Rellenar tartaletas con queso, jamón, verduras o cualquier ingrediente salado. Hornear y servir.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Verduras a la Parrilla',
                'image' => 'recipes/verduras.png',
                'description' => 'Verduras asadas con un toque de aceite y especias.',
                'instructions' => 'Cortar verduras. Asar a la parrilla con aceite de oliva y sal.',
                'user_id' => $users->random()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
