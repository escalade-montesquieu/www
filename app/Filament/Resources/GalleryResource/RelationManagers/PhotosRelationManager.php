<?php

namespace App\Filament\Resources\GalleryResource\RelationManagers;

use App\Filament\Resources\PhotoResource;
use App\Forms\Components;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    protected static ?string $recordTitleAttribute = 'src';

    public static function table(Table $table): Table
    {
        return PhotoResource::table($table)
            ->headerActions([
                Tables\Actions\Action::make('import-folder')
                    ->action(static function () {
                    })
                    ->form([
                        Components\ImportFolder::make('folder'),
                    ])
                    ->label('Importer un dossier')
                    ->icon('heroicon-o-folder'),
                Tables\Actions\CreateAction::make()
                    ->label('Ajouter une photo')
                    ->icon('heroicon-o-plus'),
            ]);
    }

    public static function form(Form $form): Form
    {
        return PhotoResource::form($form);
    }
}
