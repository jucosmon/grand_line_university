<?php

namespace App\Http\Controllers;
use App\Models\Student; // Correct import for the Student model
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function showHomePage(){

        return view('student.home_page');
    }
    public function index(){

        return view(
            'manage_student_page',
            [
                'students' => Student::all()
            ]
        );
    }


    public function addForm(){

        return view('add_student_page');
    }

    public function store()
    {
    $student =  Student::create ([

        'id' => request()->get('id',''),
        'first_name' => request()->get('first_name',''),
        'last_name' => request()->get('last_name',''),
        'middle_initial' => request()->get('middle_initial',''),
        'program' => request()->get('program',''),
        'year' => request()->get('year',''),
        'birthday' => request()->get('birthday',''),
        'sex' => request()->get('sex','')
    ]);
    return redirect()->route('manage_student_page');
    }
}
