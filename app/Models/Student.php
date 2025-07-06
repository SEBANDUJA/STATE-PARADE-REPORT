<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        's_id',
        'name',
        'photo',
        'gender',
        'company',
        'ed',
        'ld',
        'sick_in',
        'sick_out',
        'permission',
        'centry',
        'special_duty',
        'pass',
        'guard',
    ];
}
