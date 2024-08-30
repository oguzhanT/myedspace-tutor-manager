<?php

namespace Tests\Unit\Models;

use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TutorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_tutor_can_be_created()
    {
        Tutor::factory()->create([
            'name' => 'tutor 1',
            'email' => 'tutor1@test.com',
            'hourly_rate' => 50,
        ]);

        $this->assertDatabaseHas('tutors', [
            'name' => 'tutor 1',
            'email' => 'tutor1@test.com',
        ]);
    }

    #[Test]
    public function test_tutor_can_be_updated()
    {
        $tutor = Tutor::factory()->create();
        $tutor->update(['hourly_rate' => 75]);

        $this->assertEquals(75, $tutor->fresh()->hourly_rate);
    }

    #[Test]
    public function test_tutor_can_be_deleted()
    {
        $tutor = Tutor::factory()->create();
        $tutor->delete();

        $this->assertSoftDeleted($tutor);
    }

    #[Test]
    public function test_tutor_has_students_relationship()
    {
        $tutor = Tutor::factory()->create();
        $student = Student::factory()->create();
        $tutor->students()->attach($student->id);

        $this->assertTrue($tutor->students->contains($student));
    }
}
