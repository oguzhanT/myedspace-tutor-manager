<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Tutor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $students = Student::factory(50)->create();
        $tutors = Tutor::factory(10)->create();

        $tutors->each(function ($tutor) use ($students) {
            $tutor->students()->attach(
                $students->random(rand(1, 10))->pluck('id')->toArray()
            );
        });
    }
}
