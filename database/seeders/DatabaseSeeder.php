<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        $this->call(CategoryTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(IngredientTableSeeder::class);
        $this->call(RecipeCategoryTableSeeder::class);
        $this->call(RecipeIngredientTableSeeder::class);
        $this->call(RecipeDetailTableSeeder::class);
        $this->call(RecipeTableSeeder::class);
        $this->call(UserTableSeeder::class);
    }
}
