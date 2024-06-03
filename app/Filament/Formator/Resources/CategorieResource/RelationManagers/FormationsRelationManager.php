<?php

namespace App\Filament\Formator\Resources\CategorieResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class FormationsRelationManager extends RelationManager
{
    protected static string $relationship = 'formations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('titre')
                    ->required()
                    ->maxLength(255),


                TextInput::make('tarif')->numeric()
                    ->label('Tarif de la formation (0 si gratuit)')
                    ->required()
                    ->suffix('F cfa'),

                RichEditor::make('description')
                    ->label('Description courte')
                    ->columnSpanFull(),

                Select::make('user_id')
                    ->label('Créée par')
                    ->relationship('proprio', 'name')
                    ->native(false)
                    ->searchable()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titre')
            ->columns([
                TextColumn::make('id')
                    ->label("ID")
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->numeric()
                    ->prefix("FORM-"),

                TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->markdown()
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->limit(40),

                TextColumn::make('proprio.name')
                    ->label('Auteur')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->badge(),

                TextColumn::make('tarif')
                    ->label('Tarif')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->money('fcfa', 1),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
