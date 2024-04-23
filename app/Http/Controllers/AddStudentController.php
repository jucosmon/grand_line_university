<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class AddStudentController extends Controller
{
    //

    public function store()
    {
    $student =  Student::create ([

        'id' => request()->get('id',''),
        'first_name' => request()->get('first_name',''),
        'last_name' => request()->get('last_name',''),
        'middle_initial_name' => request()->get('middle_initial',''),
        'email' => request()->get('email',''),
        'program' => request()->get('program',''),
        'year' => request()->get('year',''),
        'birthday' => request()->get('birthday',''),
        'sex' => request()->get('sex','')
    ]);
    return redirect()->route('manage_student_page');
    }
}
