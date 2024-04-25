<?php

namespace App\Http\Controllers;
use App\Models\Teacher; // Correct import for the Student model
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index(){
        return view(
            'pages.teacher.manage',
            [
                'teachers' => Teacher::all()
            ]
        );
    }

    public function addForm(){
        return view('pages.teacher.add');
    }

    public function store()
    {
    $teacher =  Teacher::create ([

        'id' => request()->get('id',''),
        'first_name' => request()->get('first_name',''),
        'last_name' => request()->get('last_name',''),
        'middle_initial' => request()->get('middle_initial',''),
        'degree' => request()->get('degree',''),
        'birthday' => request()->get('birthday',''),
        'sex' => request()->get('sex','')
    ]);
    return redirect()->route('teacher.manage');
    }
}
