<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Appetizers',
            'description' => 'Small dishes served before the main course.',
        ]);

        DB::table('categories')->insert([
            'name' => 'Main Courses',
            'description' => 'The primary dishes of a meal.',
        ]);

        DB::table('categories')->insert([
            'name' => 'Desserts',
            'description' => 'Sweet dishes served at the end of a meal.',
        ]);
    }
}
