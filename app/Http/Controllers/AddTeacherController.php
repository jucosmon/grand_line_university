<?php

namespace App\Http\Controllers;
use App\Models\Teacher; // Correct import for the Student model
use Illuminate\Http\Request;

class AddTeacherController extends Controller
{
    public function store()
    {
    $student =  Teacher::create ([

        'id' => request()->get('id',''),
        'first_name' => request()->get('first_name',''),
        'last_name' => request()->get('last_name',''),
        'middle_initial' => request()->get('middle_initial',''),
        'email' => request()->get('email',''),
        'degree' => request()->get('degree',''),
        'birthday' => request()->get('birthday',''),
        'sex' => request()->get('sex','')
    ]);
    return redirect()->route('manage_teacher_page');
    }
}
