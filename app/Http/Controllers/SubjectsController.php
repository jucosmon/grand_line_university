<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    //
    public function index(){
        return view(
            'manage_subject_page',
            [
                'subjects' => Subject::all()
            ]
        );
    }

    public function addForm(){
        return view('add_subject_page');
    }

    public function store()
    {
    $subject =  Subject::create ([

        'code' => request()->get('code',''),
        'name' => request()->get('name',''),
        'description' => request()->get('description',''),
        'credits' => request()->get('credits',''),
        'prerequisites' => request()->get('prerequisites',''),
        'status' => request()->get('status',''),

    ]);
    return redirect()->route('manage_subject_page');
    }
}
