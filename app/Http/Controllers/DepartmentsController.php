<?php

namespace App\Http\Controllers;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    //
    public function index(){
        return view(
            'pages.department.manage',
            [
                'departments' => Department::all()
            ]
        );
    }


    //ADD Form
    public function addForm(){
        return view('pages.department.add');
    }
    //adding to database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|string|max:10|unique:departments,code,' . ($request->route('id') ?? 'NULL') . ',id',
            'name' => 'required|string',
        ]);

        Department::create ($validatedData);
    return redirect()->route('department.manage');
    }


    //UPDATE Form
    public function editForm($id){

        $department = Department::findOrFail($id);
        return view('pages.department.edit', compact('department'));
    }


    //UPDATE in database

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $validatedData = $request->validate([
            'code' => 'required|string|max:10|unique:departments,code,' . ($request->route('id') ?? 'NULL') . ',id',
            'name' => 'required|string',
            'is_active' => 'required|integer|in:0,1',

        ]);

        $department->update($validatedData);


        return redirect()->route('department.manage')->with('success', 'Department updated successfully.');
    }

    // DELETING in database
    public function destroy($id)
    {
        $department = Department::findOrFail($id);

        $department->delete();

        return redirect()->route('department.manage')->with('success', 'Department deleted successfully.');
    }
}
