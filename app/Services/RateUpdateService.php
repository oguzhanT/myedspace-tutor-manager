<?php

namespace App\Services;

use App\Models\Tutor;
use App\Models\TutorRateChange;

class RateUpdateService
{
    public function updateRates(array $tutorIds, int $percentageChange): void
    {
        foreach ($tutorIds as $tutorId) {
            $tutor = Tutor::find($tutorId);

            if ($tutor) {
                $oldRate = $tutor->hourly_rate;
                $newRate = $oldRate + ($oldRate * $percentageChange / 100);

                TutorRateChange::create([
                    'tutor_id' => $tutor->id,
                    'old_hourly_rate' => $oldRate,
                    'new_hourly_rate' => $newRate,
                ]);

                $tutor->update(['hourly_rate' => $newRate]);
            }
        }
    }
}
