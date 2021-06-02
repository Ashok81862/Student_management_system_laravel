<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Parents;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    protected $genders = [ 'Male', 'Female', 'Other'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with(['media'])->paginate(10);

        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = $this->genders;

        $rooms = Room::select(['id', 'name'])->get();

        $parents = Parents::all();


        return view('admin.students.create', compact('genders','rooms','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:100', 'confirmed'],
            'phone' => ['required','unique:students,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)],
            'room_id' => ['required'],
            'parent_id' => ['required'],
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "students");
        }

        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role'  =>  'Student',
            'media_id' => $media_id ?? null,
        ]);

        $user->students()->create([
            'phone' => $request->phone,
            'media_id' => $media_id ?? null,
            'address' => $request->address,
            'gender'    => $request->gender,
            'parent_id' => $request->parent_id,
            'room_id'   =>  $request->room_id,
            'role'  =>  'Student'
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'New Student Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $genders = $this->genders;

        $rooms = Room::select(['id', 'name'])->get();

        $parents = Parents::all();

        return view('admin.students.edit', compact('genders', 'student' ,'rooms' , 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'unique:users,email, '.$student->user->id],
            'phone' => ['required','unique:teachers,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)],
            'room_id' => ['required'],
            'parent_id' => ['required'],
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "students");
        }

        $student->user()->update([
            'name' => $request->name ?? $student->user->name,
            'email' => $request->email ?? $student->user->email,
            'role'  =>  'Student',
            'media_id' => $media_id ?? $student->media_id,
        ]);

        $student->update([
            'phone' => $request->phone,
            'media_id' => $media_id ?? $student->media_id,
            'address' => $request->address,
            'gender'    => $request->gender,
            'parent_id' =>  $request->parent_id,
            'room_id'   =>  $request->room_id,
            'role'  =>  'Student'
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Parent Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        return redirect()->route('admin.students.index')
        ->with('error', 'You cannot delete an student !!');
    }
}
