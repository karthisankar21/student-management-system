<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\View;

class StudentController extends Controller
{
    public function index()
    {
        Log::info("StudentController@index called");
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    public function payment($id)
    {
        $student = Student::findOrFail($id);
        return view('student.payment', ['studentId' => $id, 'student' => $student]);
    }

}
