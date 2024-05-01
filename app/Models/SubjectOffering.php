<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectOffering extends Model
{
    use HasFactory;

    protected $fillable = [
        'academic_year',
        'semester',
        'year_level',
        'program_id',
        'subject_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
