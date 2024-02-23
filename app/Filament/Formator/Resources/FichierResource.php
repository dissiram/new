<?php

namespace App\Filament\Formator\Resources;

use App\Filament\Formator\Resources\FichierResource\Pages;
use App\Filament\Formator\Resources\FichierResource\RelationManagers;
use App\Models\Fichier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FichierResource extends Resource
{
    protected static ?string $model = Fichier::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFichiers::route('/'),
            'create' => Pages\CreateFichier::route('/create'),
            'view' => Pages\ViewFichier::route('/{record}'),
            'edit' => Pages\EditFichier::route('/{record}/edit'),
        ];
    }
}
