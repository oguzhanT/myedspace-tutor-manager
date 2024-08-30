<?php

namespace Tests\Feature;

use App\Models\Tutor;
use App\Services\RateUpdateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateHourlyRatesActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_bulk_update_hourly_rates()
    {
        $tutors = Tutor::factory()->count(3)->create(['hourly_rate' => 50]);

        $percentageChange = 10; // Example: Increase by 10%

        $service = new RateUpdateService;
        $service->updateRates($tutors->pluck('id')->toArray(), $percentageChange);

        foreach ($tutors as $tutor) {
            $this->assertEquals(55, $tutor->fresh()->hourly_rate); // 50 + (50 * 10 / 100) = 55

            $this->assertDatabaseHas('tutor_rate_changes', [
                'tutor_id' => $tutor->id,
                'old_hourly_rate' => 50,
                'new_hourly_rate' => 55,
            ]);
        }
    }
}
