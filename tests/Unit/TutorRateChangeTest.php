<?php

namespace Tests\Unit;

use App\Models\Tutor;
use App\Models\TutorRateChange;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TutorRateChangeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_can_create_a_tutor_rate_change()
    {
        $tutor = Tutor::factory()->create();
        TutorRateChange::factory()->create([
            'tutor_id' => $tutor->id,
            'old_hourly_rate' => 50,
            'new_hourly_rate' => 75,
        ]);

        $this->assertDatabaseHas('tutor_rate_changes', [
            'tutor_id' => $tutor->id,
            'old_hourly_rate' => 50,
            'new_hourly_rate' => 75,
        ]);
    }

    #[Test]
    public function test_can_update_a_tutor_rate_change()
    {
        $rateChange = TutorRateChange::factory()->create([
            'old_hourly_rate' => 50,
            'new_hourly_rate' => 75,
        ]);

        $rateChange->update(['new_hourly_rate' => 100]);

        $this->assertDatabaseHas('tutor_rate_changes', [
            'id' => $rateChange->id,
            'new_hourly_rate' => 100,
        ]);
    }

    #[Test]
    public function test_can_delete_a_tutor_rate_change()
    {
        $rateChange = TutorRateChange::factory()->create();

        $rateChange->delete();

        $this->assertDatabaseMissing('tutor_rate_changes', [
            'id' => $rateChange->id,
        ]);
    }

    #[Test]
    public function test_tutor_rate_change_belongs_to_tutor()
    {
        $tutor = Tutor::factory()->create();
        $rateChange = TutorRateChange::factory()->create([
            'tutor_id' => $tutor->id,
        ]);

        $this->assertTrue($rateChange->tutor->is($tutor));
    }
}
