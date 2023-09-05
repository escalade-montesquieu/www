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
use Illuminate\Support\Str;

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
                        'bulletList',
                        'orderedList',
                        'redo',
                        'undo',
                    ])
                    ->translateLabel()
                    ->maxLength(16777215)
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('link')
                    ->label('Lien vers la ressource')
                    ->placeholder('Ex: https://planetgrimpe.com/...')
                    ->translateLabel()
                    ->maxLength(255)
                    ->columnSpan('full')
                    ->reactive()
                    ->afterStateUpdated(function (Closure $get, Closure $set, ?string $state) {
                        if (!$state || !getYoutubeIdFromUrl($state)) {
                            return;
                        }

                        $resources = $get('resources');

                        foreach ($resources as $uuid => $resource) {
                            if ($resource['type'] === ArticleResourceType::YOUTUBE_VIDEO->value) {
                                $resources[$uuid]['data']['url'] = $state;
                                $set('resources', $resources);
                                return;
                            }
                        }

                        $newUuid = (string)Str::uuid();
                        $resources[$newUuid] = [
                            'type' => ArticleResourceType::YOUTUBE_VIDEO->value,
                            'data' => [
                                'title' => null,
                                'url' => $state
                            ]
                        ];

                        $set('resources', $resources);
                    }),
                Forms\Components\Builder::make('resources')
                    ->blocks([
                        Forms\Components\Builder\Block::make(ArticleResourceType::LINK->value)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->translateLabel()
                                    ->default('Article')
                                    ->placeholder('Ex: Interview de Micka Mawem')
                                    ->required(),
                                Forms\Components\TextInput::make('url')
                                    ->translateLabel()
                                    ->placeholder('Ex: https://example.com/...')
                                    ->required(),
                            ]),
                        Forms\Components\Builder\Block::make(ArticleResourceType::YOUTUBE_VIDEO->value)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->translateLabel()
                                    ->default('Vidéo')
                                    ->placeholder('Ex: Vidéo'),
                                Forms\Components\TextInput::make('url')
                                    ->translateLabel()
                                    ->placeholder('Ex: https://youtube.com/watch?v=dQw4w9WgXcQ')
                                    ->required(),
                            ]),
                        Forms\Components\Builder\Block::make(ArticleResourceType::INTERNAL_PHOTO->value)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->placeholder('Ex: Photo')
                                    ->default('Photo')
                                    ->translateLabel(),
                                Forms\Components\Select::make('gallery_id')
                                    ->label('Galerie photo')
                                    ->options(Gallery::all()->pluck('title', 'id'))
                                    ->searchable()
                                    ->reactive(),
                                ThumbnailSelection::make('photo_id')
                                    ->label('Photo')
                                    ->options(function (Closure $get) {
                                        if (!$get('gallery_id')) {
                                            return collect([]);
                                        }
                                        return Gallery::find($get('gallery_id'))->photos->pluck('tiny_image', 'id')->map(fn($photo) => asset('storage/' . $photo));
                                    }),
                            ]),
                        Forms\Components\Builder\Block::make(ArticleResourceType::EXTERNAL_PHOTO->value)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->placeholder('Ex: Photo')
                                    ->default('Photo')
                                    ->translateLabel(),
                                Forms\Components\TextInput::make('url')
                                    ->placeholder('Ex: https://picsum.photos/200/300')
                                    ->translateLabel()
                                    ->required(),
                            ]),
                        Forms\Components\Builder\Block::make(ArticleResourceType::EMBED->value)
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->placeholder('Ex: Vidéo Redbull')
                                    ->translateLabel(),
                                Forms\Components\TextInput::make('content')
                                    ->placeholder('Ex: <iframe src=https://></iframe>')
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
                Tables\Columns\IconColumn::make('is_pinned')
                    ->options([
                        'heroicon-s-star' => true,
                    ])
                    ->color('primary'),
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
            ->reorderable('order_column')
            ->defaultSort('order_column');
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
