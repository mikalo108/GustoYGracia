<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;
use App\Models\Recipe;
use Carbon\Carbon;
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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'I love this recipe!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'La tengo que probar.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'A mis hijos les encanta :)',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Muchas gracias!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Qué buena pinta! Tengo que intentarlo.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Una receta fácil y deliciosa, la haré este fin de semana.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Perfecta para una comida rápida, ¡me encanta!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Qué receta tan rica! A mis amigos les va a encantar.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Me encanta la combinación de sabores, la probaré.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Gracias por la receta, me quedo con las instrucciones.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Es una excelente opción para los niños, ¡gracias!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Me gusta mucho este platillo, lo hice ayer y quedó perfecto.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Excelente! Fácil y muy sabroso.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Una receta que siempre quise hacer, gracias por compartirla.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Me ha encantado! Definitivamente lo haré más seguido.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Probé esta receta y la amé, la hice con mi familia.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => '¡Qué delicia! Lo preparé para una fiesta y todos quedaron encantados.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('comments')->insert([
            'user_id' => $users->random()->id,
            'recipe_id' => $recipes->random()->id,
            'content' => 'Muy fácil de hacer y con un sabor increíble.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
