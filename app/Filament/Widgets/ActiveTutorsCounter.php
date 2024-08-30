<?php

namespace App\Filament\Widgets;

use App\Models\Tutor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ActiveTutorsCounter extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static bool $isLazy = true;

    protected int|string|array $columnSpan = '3'; // Set to span the entire width

    protected function getStats(): array
    {
        return [
            Stat::make('Active Tutors', 'tutors')
                ->icon('heroicon-s-user-group')
                ->value(
                    Tutor::query()
                        ->where('subjects', '!=', null)
                        ->count()
                ),
        ];
    }
}
