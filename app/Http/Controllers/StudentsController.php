<?php

namespace App\Http\Controllers;
use App\Models\Student; // Correct import for the Student model
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //

    public function index(){

        return view(
            'manage_student_page',
            [
                'students' => Student::all()
            ]
        );
    }
}
