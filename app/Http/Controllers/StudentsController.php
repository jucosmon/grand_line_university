<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Student;
use App\Models\Program;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function showHomePage()
    {
        return view('student.home_page');
    }

    public function index(Request $request)
{
    $years = [1,2,3,4,5];
    $programs = Program::pluck('code', 'id');
    $selectedProgram = $request->input('program');

    $selectedYear = $request->input('year');

    $studentsQuery = Student::query();

    // Check if "View All" is selected or a specific program is selected
    if ($selectedProgram && $selectedProgram !== 'view_all') {
        // Filter by specific program
        $studentsQuery->where('program_id', $selectedProgram);
    }

    if ($selectedYear && $selectedYear !== 'view_all') {
        // Filter by specific year level
        $studentsQuery->where('year_level', $selectedYear);
    }

    $students = $studentsQuery->get();

    return view('pages.student.manage', compact('programs', 'selectedProgram', 'selectedYear','years', 'students'));
}



    public function addForm()
    {
        $programs = Program::all();
        return view('pages.student.add', compact('programs'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:255',
            'year_level' => 'required|integer',
            'birthday' => 'required|date',
            'sex' => 'required|string|in:F,M,O',
            'program_id' => 'required|exists:programs,id',
        ]);


        $validatedData['password'] = uniqid();

        Student::create($validatedData);
        return redirect()->route('student.manage')->with('success', 'Student added successfully.');
    }



    public function editForm($id)
    {
        $student = Student::findOrFail($id);
        $programs = Program::all();
        return view('pages.student.edit', compact('student', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_initial' => 'nullable|string',
            'year_level' => 'required|integer',
            'birthday' => 'required|date',
            'sex' => 'required|string|in:F,M,O',
            'program_id' => 'required|exists:programs,id',
            'is_active' => 'required|integer|in:0,1',

        ]);

        $student->update($validatedData);

        // Update the email based on the updated first name and last name
        $lastNameLowercase = strtolower($student->last_name);
        $firstNameLowercase = strtolower($student->first_name);
        $firstName = str_replace(' ', '_', $firstNameLowercase);
        $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
        $student->email = $email;
        $student->save();

        return redirect()->route('student.manage')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('student.manage')->with('success', 'Student deleted successfully.');
    }
}
