<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    protected  $genders = ['Male', 'Female', 'Other'];
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
        $genders = $this->genders;
        return view('admin.teachers.create', compact('genders'));
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
            'email' =>  ['required','unique:users,email'],
            'password' => ['required', 'min:6', 'max:100', 'confirmed'],
            'phone' => ['required','unique:teachers,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)],
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "users");
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role'  =>  'Teacher',
            'phone' => $request->phone,
            'media_id' => $media_id ?? null,
        ]);

        $user->teachers()->create([
            'phone' => $request->phone,
            'media_id' => $media_id ?? null,
            'address' => $request->address,
            'gender'    => $request->gender,
            'role'  =>  'Teacher'
        ]);

        return redirect()->route('admin.teachers.index')
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
        $genders = $this->genders;
        return view('admin.teachers.edit', compact('teacher', 'genders'));
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
            'email' =>  ['required','unique:users,email,'. $teacher->user->id],
            'phone' => ['required','unique:teachers,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)]
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "users");
        }

        $teacher->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'role'  =>  'Teacher',
            'phone' => $request->phone,
            'media_id' => $media_id ?? $teacher->media_id,
        ]);

        $teacher->update([
            'phone' => $request->phone,
            'media_id' => $media_id ?? $teacher->media_id,
            'address' => $request->address,
            'gender'    => $request->gender,
            'role'  =>  'Teacher'
        ]);

        return redirect()->route('admin.teachers.index')
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
        return redirect()->route('admin.parents.index')
        ->with('error', 'You cannot delete an teacher !!');
    }

}
