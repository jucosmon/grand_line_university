<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_initial',
        'email',
        'password',
        'year_level',
        'birthday',
        'sex',
        'is_active',
        'program_id'

    ];
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    // Override the boot method to add event listeners
    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event to set the default email
        static::creating(function ($student) {
            $lastNameLowercase = strtolower($student->last_name);
            $firstNameLowercase = strtolower($student->first_name);
            $firstName = str_replace(' ', '_', $firstNameLowercase);
            $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
            $student->email = $email;
        });

        // Listen for the created event to set the default password
        static::created(function ($student) {
            $student->password = $student->last_name . $student->id; // Set password as lastname + id
            $student->save(); // Save the model to update the password field
        });
    }
}
