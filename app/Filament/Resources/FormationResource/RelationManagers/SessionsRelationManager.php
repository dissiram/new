<?php

namespace App\Filament\Resources\FormationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Session;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tables\Actions\EmptyStateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Filament\Resources\RelationManagers\RelationManager;

class SessionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sessions';
    
    public function form(Form $form): Form
    {
    
        return $form
            ->schema([
                TextInput::make('titre')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('sous-titre')
                    ->label('Sous-titre')
                    ->required()
                    ->maxLength(255),
                
                RichEditor::make('contenu')
                    ->label('contenu')
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('ressources')
                    ->label('Fichier ressources')
                    ->multiple()
                    ->disk('public')
                    ->directory('ressources')
                    ->hiddenLabel()
                    ->preserveFilenames()
                    ->columnSpanFull(),
                
            ])->columns(2);
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titre')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->prefix('SESS-')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('titre')
                    ->label('Titre')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('sous-titre')
                    ->label('Sous-Titre')
                    ->limit(30)
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('contenu')
                    ->label('Contenu')
                    ->markdown()
                    ->limit(50),
                
            ])
            ->filters([
                //
            ])->headerActions([
                Tables\Actions\CreateAction::make('create_new_card')
                    ->authorize(true)
            ])
            ->actions([
                Tables\Actions\EditAction::make()->authorize(true),
                Tables\Actions\DeleteAction::make()->authorize(true),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make('create_new_card')->icon('heroicon-o-plus')->authorize(true),
            ]);
    }
}
