<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Subject;
use App\Models\SubjectOffering;
use Illuminate\Http\Request;


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
}
