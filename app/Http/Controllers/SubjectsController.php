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
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'code' => 'required|string|max:10|unique:subjects,code,' . ($request->route('id') ?? 'NULL') . ',id',
            'name' => 'required|string',
            'description' => 'required|string',
            'credits' => 'required|string',
            'prerequisites' => 'required|string',

        ]);

    Subject::create ($validatedData);

    return redirect()->route('subject.manage')->with('success', 'Subject added successfully.');
    }


    //UPDATING A SUBJECT INFO
    public function editForm($id){

        $subject = Subject::findOrFail($id);
        return view('pages.subject.edit', compact('subject'));
    }
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required|string|max:10|unique:subjects,code,' . ($request->route('id') ?? 'NULL') . ',id',
            'name' => 'required|string',
            'description' => 'required|string',
            'credits' => 'required|string',
            'prerequisites' => 'required|string',
            'is_active' => 'required|integer|in:0,1',

        ]);

        $subject->update($validatedData);

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
