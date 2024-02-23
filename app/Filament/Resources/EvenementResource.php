<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Evenement;
use Filament\Tables\Table;
use Filament\Support\Markdown;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\EvenementResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EvenementResource\RelationManagers;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class EvenementResource extends Resource
{
    protected static ?string $model = Evenement::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Evenements';

    protected static ?string $navigationGroup = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make("Détails de l'évènement")
                    ->schema([
                        TextInput::make('libelle')
                            ->label("Titre de l'événement")
                            ->required()
                            ->unique(ignoreRecord: true),

                        DatePicker::make('start_at')
                            ->label('Date de début')
                            ->native(false)
                            ->required(),

                        RichEditor::make('description')
                            ->label('Description de  l\'événement')
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpan(2),


                Section::make("Suppléments")
                    ->schema([
                        FileUpload::make('image')
                            ->label('Images pour  l\'événement')
                            ->placeholder('Vous pouvez choisir plusieurs images')
                            ->image()
                            ->multiple()
                            ->disk('public')
                            ->directory('images/evenement')
                            ->hiddenLabel(),

                        Select::make('categorie_id')
                            ->relationship('categorie', 'libelle')
                            ->native(false)
                            ->required(),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('start_at')
                    ->label('Date')
                    ->date()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->markdown()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('categorie.libelle')
                    ->label('Catégorie')
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                ImageColumn::make('image')
                    ->label('Images')
                    ->stacked()
                    ->limit(3)
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('created_at')
                    ->label('Ajouté le')
                    ->since()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-o-plus')
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
            'index' => Pages\ListEvenements::route('/'),
            'create' => Pages\CreateEvenement::route('/create'),
            'edit' => Pages\EditEvenement::route('/{record}/edit'),
        ];
    }
}
