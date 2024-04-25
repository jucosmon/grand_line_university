<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    //
    public function index(){
        return view(
            'pages.subject.manage',
            [
                'subjects' => Subject::all()
            ]
        );
    }

    public function addForm(){
        return view('pages.subject.add');
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
    return redirect()->route('subject.manage');
    }
}
