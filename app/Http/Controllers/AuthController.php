<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('vendor.filament.auth.login');
    }
}
