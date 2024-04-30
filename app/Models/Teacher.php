<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_initial',
        'email',
        'password',
        'birthday',
        'sex',
        'degree',
        'is_active',
        'department_id'


    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }


    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event to set the default email
        static::creating(function ($teacher) {
            $lastNameLowercase = strtolower($teacher->last_name);
            $firstNameLowercase = strtolower($teacher->first_name);
            $firstName = str_replace(' ', '_', $firstNameLowercase);
            $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
            $teacher->email = $email;
        });

        // Listen for the created event to set the default password
        static::created(function ($teacher) {
            $teacher->password = $teacher->last_name . $teacher->id; // Set password as lastname + id
            $teacher->save(); // Save the model to update the password field
        });
    }

}
