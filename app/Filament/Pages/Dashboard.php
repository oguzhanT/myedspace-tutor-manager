<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ActiveTutorsCounter;
use App\Filament\Widgets\AverageTutorHourlyRate;
use App\Filament\Widgets\HighestPaidSubject;
use App\Filament\Widgets\TotalStudentsCounter;

class Dashboard extends \Filament\Pages\Dashboard
{
    public static $icon = 'heroicon-o-home';

    public function getColumns(): int|string|array
    {
        return 4;
    }

    public function getWidgets(): array
    {
        return [
            ActiveTutorsCounter::class,
            TotalStudentsCounter::class,
            AverageTutorHourlyRate::class,
            HighestPaidSubject::class,
        ];
    }

    protected static ?string $title = 'MyEdSpace Dashboard';
}
