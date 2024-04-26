<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use Illuminate\Http\Request;


class TeachersController extends Controller
{
    public function index(){
        return view(
            'pages.teacher.manage',
            [
                'teachers' => Teacher::all()
            ]
        );
    }

    //ADDING A NEW TEACHER INTO THE DATABASE
    public function addForm(){
        return view('pages.teacher.add');
    }

    public function store()
    {
    $teacher =  Teacher::create ([

        'id' => request()->get('id',''),
        'first_name' => request()->get('first_name',''),
        'last_name' => request()->get('last_name',''),
        'middle_initial' => request()->get('middle_initial',''),
        'degree' => request()->get('degree',''),
        'birthday' => request()->get('birthday',''),
        'sex' => request()->get('sex','')
    ]);
    return redirect()->route('teacher.manage');
    }

    //UPDATE THE TEACHER'S INFO INTO THE DATABASE
    public function editForm($id){

        $teacher = Teacher::findOrFail($id);
        return view('pages.teacher.edit', compact('teacher'));
    }
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $teacher->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'middle_initial' => $request->input('middle_initial'),
            'degree' => $request->input('degree'),
            'birthday' => $request->input('birthday'),
            'sex' => $request->input('sex'),
        ]);

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
