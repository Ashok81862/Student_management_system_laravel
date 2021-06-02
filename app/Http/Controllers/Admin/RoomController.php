<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use GrahamCampbell\ResultType\Result;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::paginate(10);

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rooms.create');
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
            'name' => ['required', 'max:20']
        ]);

        Room::create([
            'name'  =>  $request->name
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'New Room Created Successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
         return view('admin.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => ['required', 'max:20']
        ]);

        $room->update([
            'name'  =>  $request->name
        ]);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room Updated Successfully !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room Deleted Successfully !!');
    }

    public function teachers(Room $room)
    {
        $teachers = Teacher::all();

        return view('admin.rooms.teachers', compact('room' , 'teachers'));
    }

    public function addTeacher(Request $request , Room $room)
    {
        $request->validate([
            'teacher_id'  => ['required', 'exists:teachers,id'],
        ]);

        if  (!in_array($request->teacher_id , $room->teachers->pluck('id')->toArray()))
                $room->teachers()->attach($request->teacher_id);

        return redirect()->route('admin.rooms.teachers', $room->id)
            ->with('success', 'Teacher has been added to Room successfully !!');

    }

    public function removeTeacher(Request $request, Room $room)
    {
        $request->validate([
            'teacher_id' => 'required|exists:rooms,id',
        ]);

        $room->teachers()->detach($request->teacher_id);

        return redirect()->route('admin.rooms.teachers', $room->id)
            ->with('success', 'Teacher has been removed from Room successfully !!');
    }

    public function subjects(Room $room)
    {
        $subjects = Subject::select(['id', 'name'])->get();

        return view('admin.rooms.subjects', compact('subjects', 'room'));
    }

    public function addSubject(Request $request, Room $room)
    {
        $request->validate([
            'subject_id'    => ['required', 'exists:subjects,id'],
        ]);

        if(!in_array($request->subject_id, $room->subjects->pluck('id')->toArray()))
            $room->subjects()->attach($request->subject_id);

        return redirect()->route('admin.rooms.subjects', $room->id)
            ->with('success', 'Subject has been added to Room successfully !!');
    }

    public function removeSubject(Request $request, Room $room)
    {
        $request->validate([
            'subject_id' => 'required|exists:rooms,id',
        ]);

        $room->subjects()->detach($request->subject_id);

        return redirect()->route('admin.rooms.subjects', $room->id)
            ->with('success', 'Subject has been removed from Room successfully !!');
    }


}
