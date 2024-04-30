<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Department;

class TeachersController extends Controller
{
    public function index(){
        return view('pages.teacher.manage', [
            'teachers' => Teacher::all()
        ]);
    }

    // ADDING A NEW TEACHER INTO THE DATABASE
    public function addForm(){
        $departments = Department::all();
        return view('pages.teacher.add', compact('departments'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:255',
            'degree' => 'required|string|max:255',
            'birthday' => 'required|date',
            'sex' => 'required|string|in:F,M,O',
            'department_id' => 'required|exists:departments,id',
        ]);

        $teacher = Teacher::create($validatedData);

        // Update the email based on the updated first name and last name
        $lastNameLowercase = strtolower($teacher->last_name);
        $firstNameLowercase = strtolower($teacher->first_name);
        $firstName = str_replace(' ', '_', $firstNameLowercase);
        $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
        $teacher->email = $email;
        $teacher->save();

        return redirect()->route('teacher.manage')->with('success', 'Teacher added successfully.');
    }

    // UPDATE THE TEACHER'S INFO INTO THE DATABASE
    public function editForm($id){
        $teacher = Teacher::findOrFail($id);
        $departments = Department::all();

        return view('pages.teacher.edit', compact('teacher', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:255',
            'degree' => 'required|string|max:255',
            'birthday' => 'required|date',
            'sex' => 'required|string|in:F,M,O',
            'is_active' => 'required|integer|in:0,1',
            'department_id' => 'required|exists:departments,id',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->update($validatedData);

        // Update the email based on the updated first name and last name
        $lastNameLowercase = strtolower($teacher->last_name);
        $firstNameLowercase = strtolower($teacher->first_name);
        $firstName = str_replace(' ', '_', $firstNameLowercase);
        $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
        $teacher->email = $email;
        $teacher->save();

        return redirect()->route('teacher.manage')->with('success', 'Teacher updated successfully.');
    }

    // DELETING TEACHER IN THE DATABASE
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect()->route('teacher.manage')->with('success', 'Teacher deleted successfully.');
    }
}
