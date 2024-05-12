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
        'subject_offering_id',
        'teacher_id',
    ];

    public function subject_offering()
    {
        return $this->belongsTo(SubjectOffering::class);
    }
    public function subjectOffering()
    {
        return $this->belongsTo(SubjectOffering::class);
    }


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function enrollment()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'section_id', 'student_id');
    }

}
