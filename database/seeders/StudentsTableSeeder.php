<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentsTableSeeder extends Seeder
{
    public function run(): void
    {
        // 🔥 Clear existing data to avoid duplicate s_id errors
        DB::table('students')->truncate();

        $students = [];
        $genders = ['Male', 'Female'];

        for ($i = 1; $i <= 50; $i++) {
            $students[] = [
                's_id' => 'A' . $i,
                'name' => 'Student ' . $i,
                'gender' => $genders[array_rand($genders)],
                'company' => chr(65 + ($i % 5)), // A-E
                'ed' => rand(1, 4),
                'ld' => (bool)rand(0, 1),
                'sick_in' => (bool)rand(0, 1),
                'sick_out' => (bool)rand(0, 1),
                'permission' => rand(0, 5),
                'centry' => (bool)rand(0, 1),
                'special_duty' => (bool)rand(0, 1),
                'pass' => rand(0, 5),
                'guard' => ['N', 'Y'][rand(0, 1)],
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('students')->insert($students);
    }
}