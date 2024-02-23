<?php

namespace App\Filament\Formator\Resources\FichierResource\Pages;

use App\Filament\Formator\Resources\FichierResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFichier extends ViewRecord
{
    protected static string $resource = FichierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
