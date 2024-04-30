<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_number',
        'schedule',
        'room',
        'capacity',
        'offering_id',
        'teacher_id',
    ];

    public function offering()
    {
        return $this->belongsTo(SubjectOffering::class, 'offering_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
