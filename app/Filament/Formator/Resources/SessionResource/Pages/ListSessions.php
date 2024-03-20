<?php

namespace App\Filament\Formator\Resources\SessionResource\Pages;

use App\Filament\Formator\Resources\SessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSessions extends ListRecords
{
    protected static string $resource = SessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
