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


    //ADDING NEW SUBJECT
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

    ]);
    return redirect()->route('subject.manage');
    }


    //UPDATING A SUBJECT INFO
    public function editForm($id){

        $subject = Subject::findOrFail($id);
        return view('pages.subject.edit', compact('subject'));
    }
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->update([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'credits' => $request->input('credits'),
            'prerequisites' => $request->input('prerequisites'),
            'is_active' => $request->input('is_active'),
        ]);

        return redirect()->route('subject.manage')->with('success', 'Subject updated successfully.');
    }


    // DELETING A SUBJECT
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);

        $subject->delete();

        return redirect()->route('subject.manage')->with('success', 'Subject deleted successfully.');
    }


}
