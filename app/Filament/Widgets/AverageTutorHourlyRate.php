<?php

namespace App\Filament\Widgets;

use App\Models\Tutor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AverageTutorHourlyRate extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static bool $isLazy = true;

    protected int|string|array $columnSpan = '3'; // Set to span the entire width

    protected function getStats(): array
    {
        return [
            Stat::make('Average Tutor Hourly Rate', 'hourly_rate')
                ->icon('heroicon-s-currency-dollar')
                ->value(
                    number_format(Tutor::query()->avg('hourly_rate'), 2)
                ),
        ];
    }
}
