<?php

namespace App\Filament\Resources\EventCategoryResource\RelationManagers;

use App\Filament\Resources\EventResource;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class EventsRelationManager extends RelationManager
{
    protected static string $relationship = 'events';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = "Évènement";
    protected static ?string $pluralModelLabel = "Évènements";
    protected static ?string $navigationLabel = "Évènements";
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return EventResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return EventResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
}
