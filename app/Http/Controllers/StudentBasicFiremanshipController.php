<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentBasicFiremanshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view ('admin.studentbasicfiremanship',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            's_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'company' => 'required|string',
            's_id' => 'required|string|unique:students|max:50',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            's_id' => $request->input('s_id'),
            'name' => $request->input('s_name'),
            'gender' => $request->input('gender'),
            'company' => $request->input('company'),
            
        ];
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }
        
        Student::create($data);
        
        return redirect()->back()->with('success', 'Student added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        $student->name = $request->name;
        $student->gender = $request->gender;
        $student->company = $request->company;
        $student->s_id = $request->company_no;

        // Boolean checkboxes
        $student->absent = $request->has('absent');
        $student->ed = $request->has('ed');
        $student->sick_in = $request->has('sick_in');
        $student->sick_out = $request->has('sick_out');
        $student->ld = $request->has('ld');
        $student->permission = $request->has('permission');
        $student->centry = $request->has('centry');
        $student->special_duty = $request->has('special_duty');
        $student->pass = $request->has('pass');
        $student->guard = $request->has('guard');

        // if ($request->hasFile('photo')) {
        //     $photoPath = $request->file('photo')->store('students', 'public');
        //     $student->photo = $photoPath;
        // }

        $student->update();

        return redirect()->back()->with('success', 'Student updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        
        return response()->json(['message' => 'Student deleted successfully']);
    }

}
