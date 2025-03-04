<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Recipe;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $recipes = Recipe::all();

        if ($users->isEmpty() || $recipes->isEmpty()) {
            $this->command->warn('No users or recipes found. Please create them first.');
            return;
        }
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'This recipe is amazing!',
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'I love this recipe!',
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'La tengo que probar.',
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'A mis hijos les encanta :)',
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Muchas gracias!',
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Qué buena pinta! Tengo que intentarlo.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Una receta fácil y deliciosa, la haré este fin de semana.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Perfecta para una comida rápida, ¡me encanta!',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Qué receta tan rica! A mis amigos les va a encantar.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Me encanta la combinación de sabores, la probaré.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Gracias por la receta, me quedo con las instrucciones.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Es una excelente opción para los niños, ¡gracias!',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Me gusta mucho este platillo, lo hice ayer y quedó perfecto.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Excelente! Fácil y muy sabroso.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Una receta que siempre quise hacer, gracias por compartirla.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Me ha encantado! Definitivamente lo haré más seguido.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Probé esta receta y la amé, la hice con mi familia.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Qué delicia! Lo preparé para una fiesta y todos quedaron encantados.',
        ]);
        
        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Muy fácil de hacer y con un sabor increíble.',
        ]);        
        
    }
}
