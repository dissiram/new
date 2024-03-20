<?php

namespace App\Filament\Formator\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Formation;
use Filament\Tables\Table;
use Filament\Support\Markdown;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Formator\Resources\FormationResource\Pages;
use App\Filament\Formator\Resources\FormationResource\RelationManagers;
use App\Filament\Resources\FormationResource\RelationManagers\SessionsRelationManager;
use App\Filament\Resources\FormationResource\RelationManagers\SouscritRelationManager;
use Filament\Forms\Components\RichEditor;

class FormationResource extends Resource
{
    protected static ?string $model = Formation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
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
                    ->required()
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

                TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
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
            ])->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-o-plus')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SessionsRelationManager::class,
            SouscritRelationManager::class
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
