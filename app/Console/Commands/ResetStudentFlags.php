<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;

class ResetStudentFlags extends Command
{
    protected $signature = 'students:reset-flags';
    protected $description = 'Reset ed, ld, sick_in, sick_out, permission, centry, special_duty, pass, and guard to 0 every 12 hours';

    public function handle()
    {
        Student::query()->update([
            'ed' => 0,
            'ld' => 0,
            'sick_in' => 0,
            'sick_out' => 0,
            'permission' => 0,
            'centry' => 0,
            'special_duty' => 0,
            'pass' => 0,
            'guard' => 0,
        ]);

        $this->info('Student flags have been reset to 0.');
    }
}
