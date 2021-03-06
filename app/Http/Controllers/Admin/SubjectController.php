<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate(10);

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
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
            'name'  => ['required', 'max:100'],
            'code'  =>  [ 'required', 'integer']
        ]);

        Subject::create([
            'name'  => $request->name,
            'code'  =>  $request->code
        ]);

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject Created Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $rooms = Room::select(['id', 'name'])->get();

        return view('admin.subjects.show' , compact('subject', 'rooms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit' , compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name'  => ['required', 'max:100'],
            'code'  =>  [ 'required', 'integer']
        ]);

        $subject->update([
            'name'  => $request->name,
            'code'  =>  $request->code
        ]);

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject Updated Successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('admin.subjects.index')
            ->with('success', 'Subject Deleted Successfully !!');
    }

    public function teachers(Subject $subject)
    {
        $teachers = Teacher::all();

        return view('admin.subjects.teachers', compact('subject', 'teachers'));
    }

    public function addTeacher(Request $request, Subject $subject)
    {
        $request->validate([
            'teacher_id'    => ['required', 'exists:teachers,id'],
        ]);

        if(!in_array($request->teacher_id, $subject->teachers->pluck('id')->toArray()))
            $subject->teachers()->attach($request->teacher_id);

        return redirect()->route('admin.subjects.teachers', $subject->id)
            ->with('success', 'Teacher has been added to Subject successfully !!');
    }

    public function removeTeacher(Request $request, Subject $subject)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $subject->teachers()->detach($request->teacher_id);

        return redirect()->route('admin.subjects.teachers', $subject->id)
            ->with('success', 'Teacher has been removed from Subject successfully !!');
    }

}
