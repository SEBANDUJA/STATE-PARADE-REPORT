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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'gender' => 'required|string',
            'company' => 'nullable|string|max:255',
            'company_no' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('fail', 'Failed to send recommendation.');
        }
        try {
            $student = new Student();
            $student->name = $request->get('name');
            $student->gender = $request->get('gender');
            $student->company = $request->get('company');
            $student->s_id = $request->get('company_no');

            // Handle the file upload
            // if ($request->hasFile('photo')) {
            //     $file = $request->file('photo');
            //     // $file = Image::make($file)->resize(300, 300);
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $file->move(public_path('uploads/products'), $fileName); // Move the file to a public directory
            //     $product->p_fphoto = json_encode($fileName);
            //  }

            $student->save();

            return redirect()->back()->with('success', __('Student Informations has been created successful '));
        }catch (\Exception $e) {
                return redirect()->back()->with('fail', 'Something went wrong. Please try again.');
            }
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
    public function update(Request $request, string $id)
    {
            $student = Student::findOrFail($id);
            $student->update($request->all());

            return redirect()->back()->with('success', 'Student updated successfully');
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
