<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*DB::table('users')->insert([
            'name' => 'John Doe',
            'username' => 'ZM 0078',
            'email' => 'johndoe@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ZM0078'), // Securely hashed
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);*/
        User::factory()->count(20)->create();
    }

}
