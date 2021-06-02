<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuardianController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        //dd($user);

        return view('guardians' , compact('user'));
    }
}
