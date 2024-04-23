<?php

namespace App\Http\Controllers;
use App\Models\Teacher; // Correct import for the Student model
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index(){
    return view(
        'manage_teacher_page',
        [
            'teachers' => Teacher::all()
        ]
    );
}
}
