<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'description',
        'credits',
        'prerequisites',
        'status',
        'is_active',
        'department_id'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
