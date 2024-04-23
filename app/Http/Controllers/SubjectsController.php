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
}
