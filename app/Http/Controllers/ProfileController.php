<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     * Display the user profile page.
     */
    public function index()
    {
        return view('profile');
    }
}
