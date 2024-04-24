<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_initial',
        'email',
        'program',
        'year',
        'birthday',
        'sex',
        'password'
    ];

    // Define mutator to automatically hash password when setting it
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Override the boot method to add an event listener
    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event to set the default password and email
        static::creating(function ($student) {
            $lastNameLowercase = strtolower($student->last_name);
            $firstNameLowercase = strtolower($student->first_name); // Convert first name to lowercase
            $firstName = str_replace(' ', '_', $firstNameLowercase); // Replace spaces with underscores
            $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
            $student->email = $email;
            $student->password = bcrypt($lastNameLowercase . $student->id);
        });
    }
}
