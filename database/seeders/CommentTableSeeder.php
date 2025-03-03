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
    }
}
