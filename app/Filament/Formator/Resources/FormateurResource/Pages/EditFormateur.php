<?php

namespace App\Filament\Formator\Resources\FormateurResource\Pages;

use App\Filament\Formator\Resources\FormateurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormateur extends EditRecord
{
    protected static string $resource = FormateurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
