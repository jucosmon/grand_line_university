<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermsController extends Controller
{

    public function index(){
        return view(
            'pages.term.manage',
            [
                'terms' => Term::all()
            ]
        );
    }


    //ADD Form
    public function addForm(){
        return view('pages.term.add');
    }
    //adding to database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'enroll_start' => 'nullable|date',
            'enroll_end' => 'nullable|date',
            'status' => 'required|string'
        ]);
          // Check if term  already exists
          $existingTerm = Term::where([
            'academic_year' => $validatedData['academic_year'],
            'semester' => $validatedData['semester'],
        ])->exists();

        if ($existingTerm) {
            return redirect()->back()->withErrors(['term' => 'That term has already been created.'])->withInput();
        }
        // Check if there is already an active term
        $activeTerm = Term::where('status', 'active')->exists();

        if ($validatedData['status'] === 'active' && $activeTerm) {
            return redirect()->back()->withErrors(['term' => 'There is already an active term.'])->withInput();
        }

        Term::create ($validatedData);
         return redirect()->route('term.manage');
    }


    //UPDATE Form
    public function editForm($id){

        $term = Term::findOrFail($id);
        return view('pages.term.edit', compact('term'));
    }


    //UPDATE in database

    public function update(Request $request, $id)
    {
        $term = Term::findOrFail($id);

        $validatedData = $request->validate([
            'academic_year' => 'required|string',
            'semester' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'enroll_start' => 'nullable|date',
            'enroll_end' => 'nullable|date',
            'status' => 'required|string'
        ]);

         // Check if term  already exists
         $existingTerm = Term::where([
            'academic_year' => $validatedData['academic_year'],
            'semester' => $validatedData['semester'],
        ])->where('id', '!=', $id)->exists();


        if ($existingTerm) {
            return redirect()->back()->withErrors(['term' => 'That term already existed.'])->withInput();
        }

        $activeTerm = Term::where('status', 'active')->where('id', '!=', $id)->exists();

        if ($validatedData['status'] === 'active' && $activeTerm) {
            return redirect()->back()->withErrors(['term' => 'There is already an active term.'])->withInput();
        }

        $term->update($validatedData);
        return redirect()->route('term.manage')->with('success', 'term updated successfully.');
    }

    // DELETING in database
    public function destroy($id)
    {
        $term = Term::findOrFail($id);

        $term->delete();

        return redirect()->route('term.manage')->with('success', 'term deleted successfully.');
    }
}
