<?php

namespace App\Filament\Actions;

use App\Services\RateUpdateService;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Collection;

class UpdateHourlyRatesAction extends BulkAction
{
    public function __construct(readonly RateUpdateService $rateUpdateService)
    {
        parent::__construct('update_hourly_rates');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Update Hourly Rates')
            ->action(function (Collection $records, array $data) {
                $percentageChange = $data['percentage_change'];

                $service = app(RateUpdateService::class);
                $service->updateRates($records->pluck('id')->toArray(), $percentageChange);

                Notification::make()
                    ->title('Hourly rates updated successfully.')
                    ->success()
                    ->send();
            })
            ->requiresConfirmation()
            ->form([
                TextInput::make('percentage_change')
                    ->label('Percentage Change')
                    ->numeric()
                    ->required()
                    ->placeholder('Enter percentage change (e.g., 10 for +10%, -5 for -5%)')
                    ->helperText('Positive values increase the rate, negative values decrease it.'),
            ]);
    }
}
