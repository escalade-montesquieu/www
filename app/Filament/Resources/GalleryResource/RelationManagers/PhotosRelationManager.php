<?php

namespace App\Filament\Resources\GalleryResource\RelationManagers;

use App\Filament\Resources\PhotoResource;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    protected static ?string $recordTitleAttribute = 'src';

    public static function form(Form $form): Form
    {
        return PhotoResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return PhotoResource::table($table);
    }
}
