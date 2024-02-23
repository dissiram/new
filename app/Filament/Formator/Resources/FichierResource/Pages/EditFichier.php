<?php

namespace App\Filament\Formator\Resources\FichierResource\Pages;

use App\Filament\Formator\Resources\FichierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFichier extends EditRecord
{
    protected static string $resource = FichierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
