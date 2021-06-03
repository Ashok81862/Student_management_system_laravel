<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('teachers', compact('user') );
    }

    public function students(Room $room)
    {
        $students = Student::all();
        $user = Auth::user();

        return view('rooms', compact('students', 'room', 'user'));
    }
}
