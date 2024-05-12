<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class TeachersController extends Controller
{
    public function index(Request $request){
        $departments = Department::pluck('code', 'id'); // Retrieve department codes
        $selectedDepartment = $request->input('department'); // Get selected department from request

        $teachersQuery = Teacher::query();

        // Check if "View All" is selected or a specific department is selected
        if ($selectedDepartment && $selectedDepartment !== 'view_all') {
            // Filter by specific department
            $teachersQuery->whereHas('department', function ($query) use ($selectedDepartment) {
                $query->where('id', $selectedDepartment);
            });
        }

        $teachers = $teachersQuery->get();

        return view('pages.teacher.manage', compact('departments', 'selectedDepartment', 'teachers'));
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

        // Generate a unique default password
        $validatedData['password'] = uniqid(); // Hash the default password

        Teacher::create($validatedData);

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


    public function viewLoads()
    {
        // Get the current authenticated teacher
        $teacher = Teacher::find(Auth::id());

        // Fetch current and past sections where the teacher is assigned
        $currentSections = $teacher->sections()->whereHas('subjectOffering.term', function ($query) {
            $query->where('status', 'active'); // Filter for active terms
        })->get();

        $pastSections = $teacher->sections()->whereHas('subjectOffering.term', function ($query) {
            $query->where('status', 'done'); // Filter for past terms
        })->get();

        // Retrieve the student count for each section
        foreach ($currentSections as $section) {
            $enrollment = Enrollment::where('section_id', $section->id)->get();
            $section->student_count = $enrollment->count();
        }

        foreach ($pastSections as $section) {
            $enrollment = Enrollment::where('section_id', $section->id)->get();
            $section->student_count = $enrollment->count();
        }

        return view('pages.teacher.loads', compact('currentSections', 'pastSections'));
    }


    public function viewStudents($section_id)
    {
        // Find the section
        $section = Section::find($section_id);

        if (!$section) {
            return redirect()->back()->with('error', 'Section not found.');
        }

        // Get the students enrolled in the specified section
        $enrollments = Enrollment::where('section_id', $section_id)->with('student')->get();

        $students = $enrollments->pluck('student');

        // Check if any students are found
        if ($students->isNotEmpty()) {
            return view('pages.teacher.view_students', compact('section', 'students'));
        } else {
            return redirect()->back()->with('error', 'No students enrolled in this section.');
        }
    }





}
