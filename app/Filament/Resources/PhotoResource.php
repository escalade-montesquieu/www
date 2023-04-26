<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\RelationManagers\PhotosRelationManager;
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
use Livewire\TemporaryUploadedFile;

class PhotoResource extends Resource
{
    protected static ?string $model = Photo::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->translateLabel()
                    ->required()
                    ->helperText('Format png ou jpg, max 100 Mo')
                    ->directory(Photo::getStorageFolder())
                    ->afterStateUpdated(static function (TemporaryUploadedFile $state, Closure $get, Closure $set) {
                        $folder = Photo::getStorageFolder();
                        $oldImagePath = $folder . '/' . $get('src');
                        Storage::delete($oldImagePath);

                        $img = Image::make($state);
                        $img->orientate()->save();
                        $set('src', $state->getFilename());
                    }),
                Forms\Components\Select::make('gallery_id')
                    ->relationship('gallery', 'title')
                    ->required()
                    ->hiddenOn(PhotosRelationManager::class)
                    ->label('Galerie'),
                Forms\Components\TextInput::make('title')
                    ->translateLabel(),
                Forms\Components\Toggle::make('display_homepage')
                    ->required()
                    ->translateLabel(),
                Forms\Components\Hidden::make('src'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('tiny_image')
                    ->label('Image')
                    ->height(100),
                Tables\Columns\TextColumn::make('gallery.title')
                    ->label('Galerie')
                    ->sortable(),
                Tables\Columns\IconColumn::make('display_homepage')
                    ->translateLabel()
                    ->boolean()
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePhotos::route('/'),
        ];
    }
}
