<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{   
    //get method
    public function index()
    {
        return response()->json(Student::all());
    }

    //store method
    public function store(Request $request)
    {
        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'course' => $request->course,
        ]);

        return response()->json([
            'message' => 'Student added successfully'
        ]);
    }

    //update method
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Studnet not found'
            ], 404);
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'course' => $request->course
        ]);
        return response()->json([
            'message'=> "student updated succesfully",
        ]);
    }
    
    //delete method
    public function destroy($id){
        $student = Student::find($id);

        if(!$student) {
            return response()->json([
                'message' => 'Studnent not found'
            ],404);
        }

        $student->delete();
        
        return response()->json([
            'message' => "Student deleted successfully"
        ]);
    }
}

