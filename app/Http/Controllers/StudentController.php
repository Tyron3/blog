<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;

class StudentController extends Controller
{
    public function index(){
        $students = Students::paginate(5);
        return view('welcome', compact('students'));
    }

    public function create(){
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $student = new Students;
        $student->first_name = $request->firstname;
        $student->last_name = $request->lastname;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();

        return redirect(route('home'))->with('successMsg', 'Student Successfully Added.');
    }

    public function edit($id){
        $student = Students::find($id);
        return view('edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        $student = Students::find($id);
        $student->first_name = $request->firstname;
        $student->last_name = $request->lastname;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();

        return redirect(route('home'))->with('successMsg', 'Student Successfully Updated.');
    }

    public function delete($id)
    {
        Students::find($id)->delete();
        return redirect(route('home'))->with('successMsg', 'Student Successfully Deleted.');
    }
}
