<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function showHomePage(){

        return view('student.home_page');
    }
    public function index(){

        return view(
            'pages.student.manage',
            [
                'students' => Student::all()
            ]
        );
    }


    //ADDING NEW STUDENT
    public function addForm(){

        return view('pages.student.add');
    }

    public function store()
    {
    $student =  Student::create ([

        'id' => request()->get('id',''),
        'first_name' => request()->get('first_name',''),
        'last_name' => request()->get('last_name',''),
        'middle_initial' => request()->get('middle_initial',''),
        'program' => request()->get('program',''),
        'year' => request()->get('year',''),
        'birthday' => request()->get('birthday',''),
        'sex' => request()->get('sex','')
    ]);
        return redirect()->route('student.manage');
    }

    //UPDATING A STUDENT'S INFO
    public function editForm($id){

        $student = Student::findOrFail($id);
        return view('pages.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $student->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_initial' => $request->input('middle_initial'),
            'program' => $request->input('program'),
            'year' => $request->input('year'),
            'birthday' => $request->input('birthday'),
            'sex' => $request->input('sex'),
        ]);

        // Update the email based on the updated first name and last name
        $lastNameLowercase = strtolower($student->last_name);
        $firstNameLowercase = strtolower($student->first_name);
        $firstName = str_replace(' ', '_', $firstNameLowercase);
        $email = $lastNameLowercase . '.' . $firstName . '@glu.edu.ph';
        $student->email = $email;
        $student->save();

        return redirect()->route('student.manage')->with('success', 'Student updated successfully.');
    }

    //DELETING A STUDENT IN THE DATABASE
    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()->route('student.manage')->with('success', 'Student deleted successfully.');
    }


}
