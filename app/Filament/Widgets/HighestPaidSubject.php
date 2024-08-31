<?php

namespace App\Filament\Widgets;

use App\Enums\Subject;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class HighestPaidSubject extends BaseWidget
{
    protected static ?int $sort = 4;

    protected static bool $isLazy = false;

    protected int|string|array $columnSpan = '6';

    protected function getStats(): array
    {
        $allTutors = DB::table('tutors')->select('subjects', 'hourly_rate')->get();

        $subjectsRates = collect([]);

        foreach ($allTutors as $tutor) {
            $subjects = $tutor->subjects;
            $subjects = is_array($subjects) ? $subjects : explode(',', json_decode($tutor->subjects));
            foreach ($subjects as $subject) {

                if (! empty($subject)) {
                    $subjectsRates->push(['subject' => $subject, 'hourly_rate' => $tutor->hourly_rate]);
                }
            }
        }

        $highestPaidSubject = $subjectsRates
            ->groupBy('subject')
            ->map(function ($items, $subject) {
                return [
                    'subject' => $subject,
                    'avg_hourly_rate' => $items->avg('hourly_rate'),
                ];
            })
            ->sortByDesc('avg_hourly_rate')
            ->first();

        $subjectLabel = Subject::tryFrom($highestPaidSubject['subject'])?->getLabel() ?? null;

        return [

            Stat::make('Highest Paid Subject', 'subject')
                ->icon('heroicon-s-currency-dollar')
                ->value($subjectLabel.' - $'.number_format($highestPaidSubject['avg_hourly_rate'], 2)
                ),
        ];
    }
}
