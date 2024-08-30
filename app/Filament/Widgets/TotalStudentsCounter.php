<?php

namespace App\Filament\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalStudentsCounter extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static bool $isLazy = true;

    protected int|string|array $columnSpan = '3';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', 'students')
                ->icon('heroicon-s-user-group')
                ->value(
                    Student::query()->count()
                ),
        ];
    }
}
