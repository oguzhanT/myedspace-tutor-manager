<?php

namespace Tests\Unit;

use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_can_create_a_student()
    {
        $student = Student::factory()->create();

        $this->assertDatabaseHas('students', [
            'name' => $student->name,
            'email' => $student->email,
        ]);
    }

    #[Test]
    public function test_can_update_a_student()
    {
        $student = Student::factory()->create();

        $student->update([
            'name' => 'student-update Name',
            'email' => 'student-updated@example.com',
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'student-update Name',
            'email' => 'student-updated@example.com',
        ]);
    }

    #[Test]
    public function test_can_delete_a_student()
    {
        $student = Student::factory()->create();

        $student->delete();

        $this->assertSoftDeleted('students', [
            'name' => $student->name,
            'email' => $student->email,
        ]);
    }

    #[Test]
    public function test_can_attach_tutors_to_a_student()
    {
        $student = Student::factory()->create();
        $tutors = Tutor::factory(3)->create();

        $student->tutors()->attach($tutors->pluck('id')->toArray());

        $this->assertCount(3, $student->tutors);
        $this->assertTrue($student->tutors->contains($tutors->first()));
    }
}
