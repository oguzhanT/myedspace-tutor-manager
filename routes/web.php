<?php

use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/all-tutors', [TutorController::class, 'index'])->name('tutors');
