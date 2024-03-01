<?php

namespace App\Filament\Formator\Resources\FormationResource\Pages;

use App\Filament\Formator\Resources\FormationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormation extends EditRecord
{
    protected static string $resource = FormationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
