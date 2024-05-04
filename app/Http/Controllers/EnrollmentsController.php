<?php
// app/Http/Controllers/EnrollmentsController.php
namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Section;
use App\Models\SubjectOffering;
use App\Models\Term;
use Illuminate\Http\Request;

class EnrollmentsController extends Controller
{
    public function index()
    {
        return view('pages.enrollment.index');
    }

    public function search(Request $request)
    {
        // Fetch student data and enrolled sections
        $student = Student::find($request->student_id);

        if (!$student) {
            return redirect()->route('enrollment.index')->with('error', 'Student ID not found.');
        }

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
        $section = Section::find($request->section_id);
        $subject_offering = $section->subject_offering;

        // Check if the student is already enrolled in a section for the same subject offering
        $enrolledSection = $student->sections()->whereHas('subject_offering', function ($query) use ($subject_offering) {
            $query->where('id', $subject_offering->id);
        })->first();

        if ($enrolledSection) {
            return redirect()->back()->with('error', 'Student is already enrolled for this subject but in another section .');
        }

        $student->sections()->attach($section);

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
