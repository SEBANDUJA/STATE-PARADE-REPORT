<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyTotal extends Model
{
    protected $fillable = [
        'report_date',
        'present',
        'absent',
        'sick_in',
        'sick_out',
        'ed',
        'ld',
        'pass',
        'permission',
    ];
}
