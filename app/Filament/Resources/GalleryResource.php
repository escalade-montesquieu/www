<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Forms\Components\ThumbnailSelection;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Collection;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $modelLabel = "Galerie photo";
    protected static ?string $pluralModelLabel = "Galeries photo";
    protected static ?string $navigationLabel = "Galeries photo";
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ThumbnailSelection::make('photo_id')
                    ->label('Image')
                    ->hidden(static function (?Gallery $record) {
                        return !$record;
                    })
                    ->options(static function (?Gallery $record): Collection {
                        if (!$record) {
                            return collect([]);
                        }
                        return $record->photos->pluck('small_image', 'id')->map(fn($photo) => asset('storage/' . $photo));
                    }),
                Forms\Components\TextInput::make('title')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                Forms\Components\Textarea::make('description')
                    ->translateLabel()
                    ->maxLength(65535)
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo.tiny_image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('title')
                    ->translateLabel()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->translateLabel()
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column contents exceeds the length limit.
                        return $state;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PhotosRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
