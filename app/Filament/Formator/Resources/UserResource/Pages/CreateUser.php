<?php

namespace App\Filament\Formator\Resources\UserResource\Pages;

use App\Filament\Formator\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
