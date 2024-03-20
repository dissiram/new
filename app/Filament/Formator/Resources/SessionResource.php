<?php

namespace App\Filament\Formator\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Session;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Formator\Resources\SessionResource\Pages;
use App\Filament\Formator\Resources\SessionResource\RelationManagers;
use Filament\Forms\Components\Select;

class SessionResource extends Resource
{
    protected static ?string $model = Session::class;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static ?string $navigationGroup = 'E-Learn';

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('titre')
                    ->required()
                    ->maxLength(255),

                TextInput::make('sous-titre')
                    ->label('Sous-titre')
                    ->required(),
                
                Select::make('formation_id')
                    ->label('Formation')
                    ->relationship('formation', 'titre'),

                MarkdownEditor::make('contenu')
                    ->label('Contenu de la session')
                    ->reactive()
                    ->columnSpanFull()
                    ->required(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->prefix('SESS-')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('titre')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('sous-titre')
                    ->label('Sous-titre')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('contenu')
                    ->label('Contenu')
                    ->markdown()
                    ->limit(50)
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSessions::route('/'),
            'create' => Pages\CreateSession::route('/create'),
            'edit' => Pages\EditSession::route('/{record}/edit'),
        ];
    }
}
