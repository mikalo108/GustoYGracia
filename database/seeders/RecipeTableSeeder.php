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
            'name' => 'Spaghetti Carbonara',
            'description' => 'A classic Italian pasta dish.',
            'instructions' => 'Cook pasta, fry pancetta, mix with eggs and cheese.',
            'user_id' => $users->random()->id
        ]);

    }
}
