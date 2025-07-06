<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentBasicFiremanshipController extends Controller
{
    public function index()
    {
        $studentsPaginated = Student::paginate(25);      
        $allStudents = Student::all();                       
        return view('admin.studentbasicfiremanship', [
            'students' => $studentsPaginated,
            'allStudents' => $allStudents
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            's_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'company' => 'required|string',
            's_id' => 'required|string|unique:students|max:50',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'gender', 'company', 's_id',
            'sick_in','sick_out','ed','ld','absent','permission','centry','special_duty','pass','guard'
        ]);
        $data['name'] = $request->input('s_name');

        foreach (['sick_in','sick_out','ed','ld','absent','permission','centry','special_duty','pass','guard'] as $field) {
            $data[$field] = $request->input($field, 0);
        }

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->back()->with('success', 'Student added successfully.');
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            's_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'company' => 'required|string',
            's_id' => 'required|string|max:50|unique:students,s_id,' . $id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $student->name = $request->s_name;
        $student->gender = $request->gender;
        $student->company = $request->company;
        $student->s_id = $request->s_id;

        foreach (['sick_in','sick_out','ed','ld','absent','permission','centry','special_duty','pass','guard'] as $field) {
            $student->$field = $request->input($field, 0);
        }

        if ($request->hasFile('photo')) {
            $student->photo = $request->file('photo')->store('students', 'public');
        }

        $student->save();

        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
