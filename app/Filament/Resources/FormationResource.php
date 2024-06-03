<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Formation;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\FormationResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FormationResource\RelationManagers;
use App\Filament\Resources\FormationResource\RelationManagers\SessionsRelationManager;

class FormationResource extends Resource
{
    protected static ?string $model = Formation::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Formations';

    protected static ?string $navigationGroup = 'E-Learn';

    public static function getEloquentQuery(): Builder
    {
        $user_id = auth()->user()['id'];
        return parent::getEloquentQuery()->where('user_id', $user_id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('titre')
                    ->unique(ignoreRecord: true)
                    ->nullable(false)
                    ->required()
                    ->label('Titre de la formation'),

                TextInput::make('tarif')->numeric()
                    ->label('Tarif de la formation (0 si gratuit)')
                    ->required(),

                MarkdownEditor::make('description')
                    ->label('Description courte')
                    ->maxLength(250),

                Select::make('user_id')
                    ->label('Créée par')
                    ->relationship('proprio', 'name')
                    ->native(false)
                    ->searchable()
                    ->required(),

                Select::make('categorie_id')
                    ->label('catégorie')
                    ->relationship('categorie', 'libelle')
                    ->native(false)
                    ->searchable()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id')
                ->label("ID")
                ->searchable()
                ->sortable()
                ->toggleable()
                ->numeric()
                ->prefix("FORM-"),
            
            TextColumn::make('categorie.libelle')
                ->label('Categorie')
                ->searchable()
                ->sortable()
                ->toggleable()
                ->badge(),

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
            SessionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormations::route('/'),
            'create' => Pages\CreateFormation::route('/create'),
            'view' => Pages\ViewFormation::route('/{record}'),
            'edit' => Pages\EditFormation::route('/{record}/edit'),
        ];
    }
}
