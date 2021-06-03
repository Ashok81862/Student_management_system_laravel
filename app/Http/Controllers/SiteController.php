<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        if(auth()->user()->role == 'Admin')
            return redirect('/admin');

        if(auth()->user()->role == 'Parent')
            return redirect('/guardians');

        if(auth()->user()->role == 'Student')
            return redirect('/students');

        if(auth()->user()->role == 'Teacher')
            return redirect('/teachers');

        return redirect('/');
    }
}
