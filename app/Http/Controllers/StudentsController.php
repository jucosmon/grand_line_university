<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Program;
use App\Models\Section;
use App\Models\SubjectOffering;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    //
    public function enrollmentPage()
    {
        // Get the current authenticated student
        $student = Student::find(Auth::id());

        // Fetch enrolled sections, active enrollments, and available enrollments
        $enrolledSections = $student->sections ?? collect(); // Initialize as an empty collection if null

        $activeTermId = Term::where('status', 'active')->pluck('id');

        $availableSubjectOfferings = SubjectOffering::where('program_id', $student->program_id)
            ->where('year_level', $student->year_level)
            ->whereIn('term_id', $activeTermId)
            ->get();

        $availableSubjectOfferings->load('sections');

        $availableSections = collect();

        foreach ($availableSubjectOfferings as $subjectOffering) {
            $sections = $subjectOffering->sections()->whereNotIn('id', $enrolledSections->pluck('id'))->get();
            $availableSections[$subjectOffering->id] = $sections;
        }

        return view('pages.student.enrollment', compact('student', 'enrolledSections', 'availableSubjectOfferings', 'availableSections'));
    }

    public function enroll(Request $request)
    {
        // Get the current authenticated student
        $student = Student::find(Auth::id());

        // Logic to enroll the student in the selected section
        $section = Section::find($request->section_id);
        $subject_offering = $section->subject_offering;

        // Check if the student is already enrolled in a section for the same subject offering
        $enrolledSection = $student->sections()->whereHas('subject_offering', function ($query) use ($subject_offering) {
            $query->where('id', $subject_offering->id);
        })->first();

        if ($enrolledSection) {
            return redirect()->back()->with('error', 'Student is already enrolled for this subject but in another section.');
        }

        $student->sections()->attach($section);

        return redirect()->back()->with('success', 'Enrollment successful.');
    }

    public function deleteEnrollment($sectionId)
    {
        // Get the current authenticated student
        $student = Student::find(Auth::id());

        // Find the enrollment record for the given student ID and section ID
        $enrollment = Enrollment::where('student_id', $student->id)->where('section_id', $sectionId)->first();

        if ($enrollment) {
            // Delete the enrollment record
            $enrollment->delete();
            return redirect()->back()->with('success', 'Enrollment deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Enrollment not found.');
        }
    }

    public function academics()
    {
        // Get the current authenticated student
        $student = Student::find(Auth::id());

        // Fetch enrolled sections, active enrollments, and available enrollments
        $enrolledSections = $student->sections ?? collect(); // Initialize as an empty collection if null


        return view('pages.student.academics', compact('student', 'enrolledSections'));
    }



    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('student.manage')->with('success', 'Student deleted successfully.');
    }

    //profile
    public function showProfile()
    {
        $student = Student::find(Auth::id());// Assuming the authenticated user is the student
        return view('pages.student.profile', compact('student'));
    }

    public function editProfileForm()
    {
        $student = Student::find(Auth::id()); // Assuming the authenticated user is the student
        $programs = Program::all(); // Assuming you have a Program model
        return view('pages.student.edit_profile', compact('student', 'programs'));
    }

    public function editProfile(Request $request)
    {
        $student = Student::find(Auth::id()); // Assuming the authenticated user is the student

        $validatedData = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_initial' => 'nullable|string',
            'birthday' => 'required|date',
            'sex' => 'required|string|in:F,M,O',
            'password' => 'required|string', // Add password validation
        ]);

        // Update profile fields
        $student->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'middle_initial' => $validatedData['middle_initial'],
            'birthday' => $validatedData['birthday'],
            'sex' => $validatedData['sex'],
        ]);

        // Update the email based on the updated first name and last name
        $lastNameLowercase = strtolower($student->last_name);
        $firstNameLowercase = strtolower($student->first_name);
        $firstName = str_replace(' ', '_', $firstNameLowercase);
        $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
        $student->email = $email;
        $student->save();

        // Update password without hashing
        $student->password = $validatedData['password'];
        $student->save();

        return redirect()->route('student.profile')->with('success', 'Profile updated successfully.');
    }

}
