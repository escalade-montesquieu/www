<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $modelLabel = "Évènement";
    protected static ?string $pluralModelLabel = "Évènements";
    protected static ?string $navigationLabel = "Évènements";
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_category_id')
                    ->label(__('Event category'))
                    ->relationship('eventCategory', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('max_places')
                    ->translateLabel()
                    ->numeric()
                    ->placeholder("Illimité")
                    ->helperText("Laissez vide pour un nombre de places illimité")
                    ->minValue(0)
                    ->maxValue(200),
                Forms\Components\DateTimePicker::make('datetime')
                    ->translateLabel(),
                Forms\Components\TextInput::make('location')
                    ->translateLabel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->translateLabel()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('eventCategory.title')
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_places')
                    ->translateLabel()
                    ->default('Illimité')
                    ->sortable(),
                Tables\Columns\TextColumn::make('datetime')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEvents::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
