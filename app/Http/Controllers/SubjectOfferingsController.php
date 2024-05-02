<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SubjectOffering;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Department;

class SubjectOfferingsController extends Controller
{

    public function index()
    {
        $subject_offerings = SubjectOffering::all();
        return view('pages.subject_offering.manage', compact('subject_offerings'));
    }

    public function addForm()
    {
        $programs = Program::all();
        $subjects = Subject::all();
        return view('pages.subject_offering.add', compact('programs', 'subjects'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'academic_year' => 'required|string|max:255',
            'semester' => 'required|integer|max:3',
            'year_level' => 'required|integer',
            'program_id' => 'required|exists:programs,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        // Check if subject offering already exists
        $existingOffering = SubjectOffering::where([
            'academic_year' => $validatedData['academic_year'],
            'semester' => $validatedData['semester'],
            'year_level' => $validatedData['year_level'],
            'program_id' => $validatedData['program_id'],
            'subject_id' => $validatedData['subject_id'],
        ])->exists();

        if ($existingOffering) {
            return redirect()->back()->withErrors(['subject_offering' => 'The subject for that specific program, year level, academic year & semester has already been offered.'])->withInput();
        }

        SubjectOffering::create($validatedData);
        return redirect()->route('subject_offering.manage')->with('success', 'Offered Subject added successfully.');
    }


    public function editForm($id)
    {
        $subject_offering = SubjectOffering::findOrFail($id);
        $programs = Program::all();
        $subjects = Subject::all();

        return view('pages.subject_offering.edit', compact('subject_offering', 'programs', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $subject_offering = SubjectOffering::findOrFail($id);

        $validatedData = $request->validate([
            'academic_year' => 'required|string|max:255',
            'semester' => 'required|integer|max:3',
            'year_level' => 'required|integer',
            'program_id' => 'required|exists:programs,id',
            'subject_id' => 'required|exists:subjects,id',

        ]);

          // Check if subject offering already exists
          $existingOffering = SubjectOffering::where([
            'academic_year' => $validatedData['academic_year'],
            'semester' => $validatedData['semester'],
            'year_level' => $validatedData['year_level'],
            'program_id' => $validatedData['program_id'],
            'subject_id' => $validatedData['subject_id'],
        ])->exists();

        if ($existingOffering) {
            return redirect()->back()->withErrors(['subject_offering' => 'The subject for that specific program, year level, academic year & semester has already been offered.'])->withInput();
        }

        $subject_offering->update($validatedData);

        // Update the email based on the updated first name and last name
        return redirect()->route('subject_offering.manage')->with('success', 'Subject offered updated successfully.');
    }

    public function destroy($id)
    {
        $subject_offering = SubjectOffering::findOrFail($id);
        $subject_offering->delete();
        return redirect()->route('subject_offering.manage')->with('success', 'Subject offered deleted successfully.');
    }

    // FOR SECTION MANAGEMENT UNDER SPECIFIC SUBJECT OFFERED
    public function viewSections($id)
    {
        $subject_offering = SubjectOffering::findOrFail($id);
        $sections = Section::where('subject_offering_id', $id)->get();
        return view('pages.section.manage', compact('subject_offering', 'sections'));
    }

    public function addSectionForm($id)
    {
        $subject_offering = SubjectOffering::findOrFail($id);
        // You may need additional data for the form, like available teachers or rooms
        $programDepartmentId = $subject_offering->program->department_id;
        // Get teachers whose department matches the program's department
        $teachers = Teacher::where('department_id', $programDepartmentId)->get();
        return view('pages.section.add', compact('subject_offering','teachers'));
    }

    public function storeSection(Request $request, $id)
    {
        $subject_offering = SubjectOffering::findOrFail($id);

        // Validate the incoming data
        $validatedData = $request->validate([
            'schedule' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id', // Assuming you have a teachers table
        ]);

        // Generate the section number based on the existing sections count
        $sectionNumber = $subject_offering->sections()->count() + 1;

        // Add the generated section number to the validated data
        $validatedData['section_number'] = $sectionNumber;
        $validatedData['subject_offering_id'] = $id; // Associate the section with the subject offering

        // Create the new section
        Section::create($validatedData);

        return redirect()->route('subject_offering.section.manage', $id)->with('success', 'Section added successfully.');
    }


    public function editSectionForm($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $subject_offering = $section->subject_offering;
        $programDepartmentId = $subject_offering->program->department_id;

        // Get teachers whose department matches the program's department
        $teachers = Teacher::where('department_id', $programDepartmentId)->get();

        return view('pages.section.edit', compact('section', 'subject_offering', 'teachers'));
    }

    public function updateSection(Request $request, $sectionId)
    {
        $section = Section::findOrFail($sectionId);

        $validatedData = $request->validate([
            'schedule' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'capacity' => 'required|integer',
            'teacher_id' => 'required|exists:teachers,id', // Assuming you have a teachers table
        ]);

        $section->update($validatedData);

        return redirect()->route('subject_offering.section.manage', $section->subject_offering_id)->with('success', 'Section updated successfully.');
    }

    public function deleteSection($sectionId)
    {
        $section = Section::findOrFail($sectionId);
        $subjectOfferingId = $section->subject_offering_id;
        $section->delete();
        return redirect()->route('subject_offering.section.manage', $subjectOfferingId)->with('success', 'Section deleted successfully.');
    }
}
