<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Parents;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ParentsController extends Controller
{
    protected $genders = [ 'Male', 'Female', 'Other'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = Parents::with(['media'])->paginate(10);

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
            'email' => ['required', 'unique:users,email'],
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
            'role'  =>  'Parent'
        ]);

        $user->parents()->create([
            'phone' => $request->phone,
            'media_id' => $media_id ?? null,
            'address' => $request->address,
            'gender'    => $request->gender,
            'role'  =>  'Parent'
        ]);

        return redirect()->route('admin.parents.index')
            ->with('success', 'New Parent Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Parents $parent)
    {
        return view('admin.parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Parents $parent)
    {
        $genders = $this->genders;

        return view('admin.parents.edit', compact('genders', 'parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parents $parent)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'unique:users,email, '.$parent->user->id],
            'phone' => ['required','unique:teachers,phone'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)]
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "users");
        }

        $parent->user()->update([
            'name' => $request->name ?? $parent->user->name,
            'email' => $request->email ?? $parent->user->email,
            'role'  =>  'Parent'
        ]);

        $parent->update([
            'phone' => $request->phone,
            'media_id' => $media_id ?? $parent->media_id,
            'address' => $request->address,
            'gender'    => $request->gender,
            'role'  =>  'Parent'
        ]);

        return redirect()->route('admin.parents.index')
            ->with('success', 'Parent Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parents $parent)
    {
        return redirect()->route('admin.parents.index')
            ->with('error', 'You cannot delete an parent!');
    }
}
