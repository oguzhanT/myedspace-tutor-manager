<?php

use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TutorController::class, 'index'])->name('tutors');
