<?php

namespace App\Filament\Resources\TutorResource\Pages;

use App\Filament\Resources\TutorResource;
use App\Models\Tutor;
use App\Models\TutorRateChange;
use Filament\Actions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkAction;

class ListTutors extends ListRecords
{
    protected static string $resource = TutorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getBulkActions(): array
    {
        return [
            BulkAction::make('updateHourlyRates')
                ->label('Update Hourly Rates')
                ->action(function (array $records, array $data) {
                    $percentageChange = $data['percentage_change'];

                    // Iterate through the selected records and update the hourly rate
                    foreach ($records as $record) {
                        $tutor = Tutor::find($record);

                        $oldRate = $tutor->hourly_rate;
                        $newRate = $oldRate + ($oldRate * $percentageChange / 100);

                        // Log the changes to the tutor_rate_changes table
                        TutorRateChange::query()->insert([
                            'tutor_id' => $tutor->id,
                            'old_hourly_rate' => $oldRate,
                            'new_hourly_rate' => $newRate,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        // Update the tutor's hourly rate
                        $tutor->update(['hourly_rate' => $newRate]);
                    }

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
                        ->placeholder('Enter the percentage increase or decrease (e.g., 10 for +10%, -5 for -5%)')
                        ->helperText('Positive values increase the rate, negative values decrease the rate.'),
                ]),
        ];
    }
}
