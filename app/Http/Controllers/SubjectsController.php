<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    //
    public function index(Request $request){
        $departments = Department::pluck('code', 'id'); // Retrieve department codes
        $selectedDepartment = $request->input('department'); // Get selected department from request

        $subjectsQuery = Subject::query();

        // Check if "View All" is selected or a specific department is selected
        if ($selectedDepartment && $selectedDepartment !== 'view_all') {
            // Filter by specific department
            $subjectsQuery->whereHas('department', function ($query) use ($selectedDepartment) {
                $query->where('id', $selectedDepartment);
            });
        }

        $subjects = $subjectsQuery->get();

        return view('pages.subject.manage', compact('departments', 'selectedDepartment', 'subjects'));
    }


    //ADDING NEW SUBJECT
    public function addForm(){
        $departments = Department::all();

        return view('pages.subject.add', compact('departments'));
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'code' => 'required|string|max:10|unique:subjects,code,' . ($request->route('id') ?? 'NULL') . ',id',
            'name' => 'required|string',
            'description' => 'required|string',
            'credits' => 'required|string',
            'prerequisites' => 'nullable|string', // Make prerequisite optional
            'department_id' => 'required|exists:departments,id',


        ]);

    Subject::create ($validatedData);

    return redirect()->route('subject.manage')->with('success', 'Subject added successfully.');
    }


    //UPDATING A SUBJECT INFO
    public function editForm($id){

        $subject = Subject::findOrFail($id);
        $departments = Department::all();

        return view('pages.subject.edit', compact('subject', 'departments'));
    }
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required|string|max:10|unique:subjects,code,' . ($request->route('id') ?? 'NULL') . ',id',
            'name' => 'required|string',
            'description' => 'required|string',
            'credits' => 'required|string',
            'is_active' => 'required|integer|in:0,1',
            'prerequisites' => 'nullable|string', // Make prerequisite optional
            'department_id' => 'required|exists:departments,id',



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
