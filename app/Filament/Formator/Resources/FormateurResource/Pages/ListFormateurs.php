<?php

namespace App\Filament\Formator\Resources\FormateurResource\Pages;

use App\Filament\Formator\Resources\FormateurResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormateurs extends ListRecords
{
    protected static string $resource = FormateurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
