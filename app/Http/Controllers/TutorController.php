<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class TutorController extends Controller
{
    public function index(): View
    {
        return view('tutors');
    }
}
