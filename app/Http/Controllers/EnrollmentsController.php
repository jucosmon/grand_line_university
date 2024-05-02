<?php
// app/Http/Controllers/EnrollmentsController.php
namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Section;
use App\Models\SubjectOffering;
use Illuminate\Http\Request;

class EnrollmentsController extends Controller
{
    public function index()
    {
        return view('pages.enrollment.index');
    }

    public function search(Request $request)
    {
        // Validate input
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);
    
        // Fetch student data and enrolled sections
        $student = Student::find($request->student_id);
        $enrolledSections = $student->sections ?? collect(); // Initialize as an empty collection if null
    
        // Fetch available subject offerings and sections for enrollment
        $availableSubjectOfferings = SubjectOffering::all();
        $availableSubjectOfferings->load('sections'); // Load sections for each subject offering
        $availableSections = collect();
    
        foreach ($availableSubjectOfferings as $subjectOffering) {
            $sections = $subjectOffering->sections()->whereNotIn('id', $enrolledSections->pluck('id'))->get();
            $availableSections[$subjectOffering->id] = $sections;
        }
    
        return view('pages.enrollment.index', compact('student', 'enrolledSections', 'availableSubjectOfferings', 'availableSections'));
    }
    

    public function enroll(Request $request)
    {
        // Validate input
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'section_id' => 'required|exists:sections,id', // Assuming you are enrolling by section
        ]);

        // Logic to enroll the student in the selected section
        $student = Student::find($request->student_id);
        $student->sections()->attach($request->section_id);

        return redirect()->back()->with('success', 'Enrollment successful.');
    }

    public function delete($studentId, $sectionId)
    {
        // Find the enrollment record for the given student ID and section ID
        $enrollment = Enrollment::where('student_id', $studentId)->where('section_id', $sectionId)->first();

        if ($enrollment) {
            // Delete the enrollment record
            $enrollment->delete();
            return redirect()->back()->with('success', 'Enrollment deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Enrollment not found.');
        }
    }
}
