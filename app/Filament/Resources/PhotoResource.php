<?php

namespace App\Filament\Resources;

use App\Enums\ImageSize;
use App\Filament\Resources\PhotoResource\Pages;
use App\Filament\Resources\PhotoResource\RelationManagers;
use App\Models\Photo;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('gallery_id')
                    ->relationship('gallery', 'title')
                    ->required(),
                Forms\Components\TextInput::make('title'),
                Forms\Components\Toggle::make('pinned_homepage')
                    ->required(),
                Forms\Components\Hidden::make('src'),
                Forms\Components\FileUpload::make('image')
                    ->directory(Photo::getStorageFolder())
                    ->afterStateUpdated(static function (\Livewire\TemporaryUploadedFile $state, Closure $get, Closure $set) {
                        $folder = Photo::getStorageFolder();
                        $oldImagePath = $folder . '/' . $get('src');
                        Storage::delete($oldImagePath);

                        $img = Image::make($state);
                        $img->orientate()->save();
                        $set('src', $state->getFilename());
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('storageSrc')
                    ->getStateUsing(function (Photo $record): string {
                        return $record->getImagePathForSize(ImageSize::TINY);
                    })
                    ->label('Image'),
                Tables\Columns\TextColumn::make('gallery.name')
                    ->label('Galerie'),
                Tables\Columns\IconColumn::make('display_homepage')
                    ->translateLabel()
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->translateLabel()
                    ->dateTime(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePhotos::route('/'),
        ];
    }
}
