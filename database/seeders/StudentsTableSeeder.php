<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('students')->truncate();

        $firstNames = [
            'John', 'Peter', 'Grace', 'Maria', 'James', 'Neema', 'Joseph', 'Salma',
            'Michael', 'Elizabeth', 'Daniel', 'Asha', 'David', 'Fatma', 'George', 'Rose',
            'Francis', 'Zainabu', 'Victor', 'Anna', 'Edward', 'Lilian', 'Dennis', 'Janeth',
            'Brian', 'Stella', 'Samuel', 'Caroline', 'Eric', 'Nuru'
        ];

        $lastNames = [
            'Mushi', 'Kimaro', 'Mbwana', 'Kassim', 'Juma', 'Nyambura', 'Chacha', 'Mwakyusa',
            'Maganga', 'Mwakalinga', 'Mgaya', 'Nassor', 'Ngowi', 'Mwaipopo', 'Shabani', 'Selemani',
            'Ayo', 'Mwasongwe', 'Mutalemwa', 'Ndunguru'
        ];

        $genders = ['Male', 'Female'];
        $companies = ['A', 'B', 'C', 'D'];

        $students = [];

        for ($i = 1; $i <= 50; $i++) {
            $first = $firstNames[array_rand($firstNames)];
            $last = $lastNames[array_rand($lastNames)];
            $gender = $genders[array_rand($genders)];

            $students[] = [
                's_id' => 'A' . $i,
                'name' => "$first $last",
                'gender' => $gender,
                'company' => $companies[array_rand($companies)],

                'ed' => rand(0, 1),
                'ld' => rand(0, 1),
                'sick_in' => rand(0, 1),
                'sick_out' => rand(0, 1),
                'permission' => rand(0, 1),
                'centry' => rand(0, 1),
                'special_duty' => rand(0, 1),
                'pass' => rand(0, 1),

                'guard' => rand(0, 1),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('students')->insert($students);
    }
}
