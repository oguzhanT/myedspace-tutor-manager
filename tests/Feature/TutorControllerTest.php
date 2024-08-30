<?php

namespace Tests\Feature\Controllers;

use App\Models\Tutor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TutorControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index()
    {
        Tutor::factory()->count(3)->create();

        $response = $this->get(route('tutors'));

        $response->assertStatus(200)
            ->assertViewIs('tutors');
    }
}
