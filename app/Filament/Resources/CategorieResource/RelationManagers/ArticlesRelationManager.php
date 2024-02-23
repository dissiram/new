<?php

namespace App\Filament\Resources\CategorieResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Article;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Symfony\Component\Console\Helper\TableStyle;

class ArticlesRelationManager extends RelationManager
{
    protected static string $relationship = 'articles';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make()
                ->schema([
                    TextInput::make('titre')
                        ->required()
                        ->live(onBlur: true)
                        ->maxLength(255)
                        ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    TextInput::make('slug')
                        ->disabled()
                        ->dehydrated()
                        ->required()
                        ->maxLength(255)
                        ->unique(Article::class, 'slug', ignoreRecord: true),

                    MarkdownEditor::make('contenu')
                        ->required()
                        ->columnSpan('full'),

                    Select::make('user_id')
                        ->relationship('auteur', 'name')
                        ->native(false)
                        ->searchable()
                        ->required(),
                ])
                ->columns(2),

            Section::make('Image')
                ->schema([
                    FileUpload::make('image')
                        ->image()
                        ->disk('public')
                        ->directory('images')
                        ->hiddenLabel(),
                ])
                ->collapsible(),
            
            Checkbox::make('published')
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titre')
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),

                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('public'),

                TextColumn::make('titre')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('slug')
                    ->sortable()
                    ->searchable(),

                CheckboxColumn::make('published')
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
                    Tables\Actions\ExportBulkAction::make()
                ]),
            ]);
    }
}
