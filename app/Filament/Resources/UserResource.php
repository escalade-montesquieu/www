<?php

namespace App\Filament\Resources;

use App\Enums\UserRole;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Tables\Columns\RentShoesColumn;
use Closure;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('role')
                    ->required()
                    ->options(UserRole::labelArray()),
                Forms\Components\Select::make('student_id')
                    ->searchable()
                    ->relationship('student', 'name'),
                Forms\Components\Section::make('Profil')
                    ->description('Données visibles sur le profil')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->helperText(static function(Closure $get) {
                                return $get('student_id') ? "Pour modifier le nom visible de cet utilisateur, modifiez le nom de l'élève associé" : null;
                            })
                            ->hint(static function(Closure $get) {
                                return $get('student_id') ? "Le nom de l'élève est affiché à la place" : null;
                            })
                            ->hintIcon(static function(Closure $get) {
                                return $get('student_id') ? 'heroicon-o-information-circle' : null;
                            })
                            ->hintColor("warning")
                            ->disabled(static function(Closure $get) {
                                return (bool)$get('student_id');
                            }),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('bio')
                            ->maxLength(16777215),
                        Forms\Components\Select::make('rent_shoes')
                            ->options(User::getShoesSizesAvailable())
                            ->searchable(),
                        Forms\Components\Toggle::make('rent_harness')
                            ->required()
                            ->inline(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\TextColumn::make('student.name'),
                RentShoesColumn::make('rent_shoes'),
                Tables\Columns\IconColumn::make('rent_harness')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
