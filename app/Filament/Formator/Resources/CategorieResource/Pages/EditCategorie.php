<?php

namespace App\Filament\Formator\Resources\CategorieResource\Pages;

use App\Filament\Formator\Resources\CategorieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategorie extends EditRecord
{
    protected static string $resource = CategorieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
