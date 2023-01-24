<?php

namespace App\Filament\Resources;

use App\Enums\ArticleResourceType;
use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Forms\Components\ThumbnailSelection;
use App\Models\Article;
use App\Models\Gallery;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255)
                    ->columnSpan('full'),
                Forms\Components\MarkdownEditor::make('content')
                    ->toolbarButtons([
                        'italic',
                        'bold',
                        'strike',
                        'link',
                        'bulletList',
                        'orderedList',
                        'redo',
                        'undo',
                    ])
                    ->translateLabel()
                    ->required()
                    ->maxLength(16777215)
                    ->columnSpan('full'),

                Forms\Components\Builder::make('resources')
                    ->blocks([
                        Forms\Components\Builder\Block::make(ArticleResourceType::YOUTUBE_VIDEO->value)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->translateLabel()
                                    ->placeholder('Petit rick roll'),
                                Forms\Components\TextInput::make('url')
                                    ->translateLabel()
                                    ->placeholder('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
                                    ->required(),
                            ]),
                        Forms\Components\Builder\Block::make(ArticleResourceType::INTERNAL_PHOTO->value)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->placeholder('Photos')
                                    ->translateLabel(),
                                Forms\Components\Select::make('gallery_id')
                                    ->label('Gallerie photo')
                                    ->options(Gallery::all()->pluck('title', 'id'))
                                    ->searchable()
                                    ->reactive(),
                                ThumbnailSelection::make('photo_id')
                                    ->label('Photo')
                                    ->options(function (Closure $get) {
                                        return $get('gallery_id') ?
                                            Gallery::find($get('gallery_id'))->photos->pluck('assetSrc', 'id')
                                            : [];
                                    }),
                            ]),
                        Forms\Components\Builder\Block::make(ArticleResourceType::EXTERNAL_PHOTO->value)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->placeholder('Photos')
                                    ->translateLabel(),
                                Forms\Components\TextInput::make('url')
                                    ->placeholder('https://picsum.photos/200/300')
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan('full')
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->translateLabel()
                    ->sortable()
                    ->limit(40)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }

                        // Only render the tooltip if the column contents exceeds the length limit.
                        return $state;
                    }),
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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageArticles::route('/'),
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
