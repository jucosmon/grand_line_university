<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    //
    public function index(){
        return view(
            'pages.program.manage',
            [
                'programs' => Program::all()
            ]
        );
    }


    //ADD Form
    public function addForm(){
        $departments = Department::all();
        return view('pages.program.add', compact('departments'));
    }
    //adding to database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:10|unique:programs,code,' . ($request->route('id') ?? 'NULL') . ',id',
            'name' => 'required|string',
            'department_id' => 'required|exists:departments,id',
        ]);


        Program::create($validatedData);

    return redirect()->route('program.manage')->with('success', 'Program added successfully.');
    }


    //UPDATE Form

    public function editForm($id){
        $program = Program::findOrFail($id);
        $departments = Department::all();

        return view('pages.program.edit', compact('program', 'departments'));
    }


    //UPDATE in database

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required|string|max:10|unique:programs,code,' . ($request->route('id') ?? 'NULL') . ',id',
            'name' => 'required|string',
            'is_active' => 'required|integer|in:0,1',
            'department_id' => 'required|exists:departments,id',
        ]);

        $program->update($validatedData);

        return redirect()->route('program.manage')->with('success', 'Program updated successfully.');
    }

    // DELETING in database
    public function destroy($id)
    {
        $program = Program::findOrFail($id);

        $program->delete();

        return redirect()->route('program.manage')->with('success', 'Program deleted successfully.');
    }
}
