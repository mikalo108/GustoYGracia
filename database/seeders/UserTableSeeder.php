<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
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
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'contact_id' => Contact::all()->random()->id
        ]);
        
        DB::table('users')->insert([
            'name' => 'ADMIN',
            'email' => 'admin@gustoygracia.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);

        DB::table('users')->insert([
            'name' => 'Andrea',
            'email' => 't@test.com',
            'password' => Hash::make('test'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
    }
}
