<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $fillable = [
        'academic_year',
        'semester',
        'start_date',
        'end_date',
        'enroll_start',
        'enroll_end',
        'status'
    ];
}
