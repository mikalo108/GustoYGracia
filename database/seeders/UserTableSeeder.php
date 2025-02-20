<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'), // ¡Encripta la contraseña!
            'email_verified_at' => now(), // O null si no se ha verificado
            'remember_token' => Str::random(10), // O null
            'contact_id' => '1', // Asigna un contact_id aleatorio
        ]);

    }
}
