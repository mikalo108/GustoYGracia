<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            'name' => 'John',
            'surname' => 'Doe',
            'bio' => 'A software developer.',
            'phone' => '123-456-7890',
            'country' => 'USA',
            'city' => 'New York',
        ]);
    }
}
