<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Parent;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ParentController extends Controller
{
    protected $genders = [ 'Male', 'Female', 'Other'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Parent::with(['media'])->paginate(10)->get();

        return view('admin.parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = $this->genders;

        return view('admin.parents.create', compact('genders'));
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
            'email' => ['required', 'unique:parents,email'],
            'password' => ['required', 'min:6', 'max:100', 'confirmed'],
            'phone' => ['required','unique:teachers,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)]
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "users");
        }

        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->parent()->create([
            'phone' => $request->phone,
            'media_id' => $media_id ?? null,
            'address' => $request->address,
            'gender'    => $request->gender,
            'role'  =>  'Parent'
        ]);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'New Parent Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Parent $parent)
    {
        return view('admin.parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Parent $parent)
    {
        $genders = $this->genders;

        return view('admin.parents.create', compact('genders', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parent $parent)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'unique:parents,email'],
            'password' => ['required', 'min:6', 'max:100', 'confirmed'],
            'phone' => ['required','unique:teachers,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)]
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "users");
        }

        $parent->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $parent->update([
            'phone' => $request->phone,
            'media_id' => $media_id ?? $parent->media_id,
            'address' => $request->address,
            'gender'    => $request->gender,
            'role'  =>  'Parent'
        ]);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Parent Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parent $parent)
    {
        $parent->delete();

        return redirect()->route('admin.parents.index')
            ->with('success', 'Parent Deleted Successfully !!');
    }
}
