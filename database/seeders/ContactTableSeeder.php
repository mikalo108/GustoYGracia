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

        DB::table('contacts')->insert([
            'name' => 'Ana',
            'surname' => 'Pérez',
            'bio' => 'Diseñadora gráfica con 10 años de experiencia.',
            'phone' => '555-987-6543',
            'country' => 'España',
            'city' => 'Madrid',
        ]);

        DB::table('contacts')->insert([
            'name' => 'Carlos',
            'surname' => 'González',
            'bio' => 'Abogado especializado en derecho corporativo.',
            'phone' => '555-123-4567',
            'country' => 'México',
            'city' => 'Ciudad de México',
        ]);
        
        DB::table('contacts')->insert([
            'name' => 'Laura',
            'surname' => 'Rodríguez',
            'bio' => 'Profesora de matemáticas en secundaria.',
            'phone' => '555-234-5678',
            'country' => 'Argentina',
            'city' => 'Buenos Aires',
        ]);        
        
    }
}
