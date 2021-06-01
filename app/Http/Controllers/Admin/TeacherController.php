<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with(['media'])->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teachers.create');
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
            'name'  =>  ['required', 'max:100'],
            'email' =>  ['required','unique:teachers,email'],
            'password' => ['required', 'min:6', 'max:100', 'confirmed'],
            'phone' => ['required','unique:teachers,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required']
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "users");
        }

        Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'media_id' => $media_id ?? null,
            'address' => $request->address,
            'gender'    => $request->gender,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'New Teacher Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'  =>  ['required', 'max:100'],
            'email' =>  ['required','unique:teachers,email'. $teacher->id],
            'password' => ['required', 'min:6', 'max:100', 'confirmed'],
            'phone' => ['required','unique:teachers,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required']
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "users");
        }

        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'media_id' => $media_id ?? null,
            'address' => $request->address,
            'gender'    => $request->gender,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Teacher Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher Deleted Successfully !!');
    }
}
