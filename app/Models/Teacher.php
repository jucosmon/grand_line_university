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
        'degree',
        'birthday',
        'sex',
        'password'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Override the boot method to add an event listener
    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event to set the default password and email
        static::creating(function ($teacher) {
            $lastNameLowercase = strtolower($teacher->last_name);
            $firstNameLowercase = strtolower($teacher->first_name); // Convert first name to lowercase
            $firstName = str_replace(' ', '_', $firstNameLowercase); // Replace spaces with underscores
            $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
            $teacher->email = $email;
            $teacher->password = bcrypt($lastNameLowercase . $teacher->id);
        });
    }
}
