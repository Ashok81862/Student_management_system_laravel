<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Guardian;
use Illuminate\Http\Request;
use App\Services\MediaService;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class GuardianController extends Controller
{
    protected $genders = [ 'Male', 'Female', 'Other'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guardians = Guardian::with(['media'])->paginate(10);

        return view('admin.guardians.index', compact('guardians'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = $this->genders;

        return view('admin.guardians.create', compact('genders'));
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
            'phone' => ['required'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)]
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "guardians");
        }

        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role'  =>  'Parent',
            'media_id' => $media_id ?? null,
        ]);

        $user->guardians()->create([
            'phone' => $request->phone,
            'media_id' => $media_id ?? null,
            'address' => $request->address,
            'gender'    => $request->gender,
            'role'  =>  'Parent'
        ]);

        return redirect()->route('admin.guardians.index')
            ->with('success', 'New guardian Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guardian $guardian)
    {

        return view('admin.guardians.show', compact('guardian'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guardian $guardian)
    {
        $genders = $this->genders;

        return view('admin.guardians.edit', compact('genders', 'guardian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guardian $guardian)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'unique:users,email, '.$guardian->user->id],
            'phone' => ['required'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif'],
            'address' => ['required'],
            'gender' => ['required',Rule::in($this->genders)]
        ]);

        if ($request->has('image') && !empty($request->file('image'))) {
            $media_id = MediaService::upload($request->file('image'), "guardians");
        }

        $guardian->user()->update([
            'name' => $request->name ?? $guardian->user->name,
            'email' => $request->email ?? $guardian->user->email,
            'role'  =>  'Parent',
            'media_id' => $media_id ?? $guardian->media_id,
        ]);

        $guardian->update([
            'phone' => $request->phone,
            'media_id' => $media_id ?? $guardian->media_id,
            'address' => $request->address,
            'gender'    => $request->gender,
            'role'  =>  'Parent'
        ]);

        return redirect()->route('admin.guardians.index')
            ->with('success', 'guardian Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guardian $guardian)
    {
        return redirect()->route('admin.guardians.index')
            ->with('error', 'You cannot delete an guardian!');
    }
}
