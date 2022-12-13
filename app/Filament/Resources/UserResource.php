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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('role')
                    ->translateLabel()
                    ->required()
                    ->options(UserRole::labelArray())
                    ->reactive(),
                Forms\Components\Select::make('student_id')
                    ->label("Nom du licencié")
                    ->hidden(static function (Closure $get) {
                        return $get('role') !== UserRole::STUDENT->value;
                    })
                    ->required(static function (Closure $get) {
                        return $get('role') === UserRole::STUDENT->value;
                    })
                    ->reactive()
                    ->searchable()
                    ->relationship('student', 'name'),

                Forms\Components\TextInput::make('name')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255)
                    ->hidden(static function (Closure $get) {
                        return $get('role') === UserRole::STUDENT->value;
                    }),
                Forms\Components\TextInput::make('email')
                    ->translateLabel()
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('bio')
                    ->translateLabel()
                    ->maxLength(16777215),
                Forms\Components\Select::make('rent_shoes')
                    ->translateLabel()
                    ->options(User::getShoesSizesAvailable())
                    ->searchable(),
                Forms\Components\Toggle::make('rent_harness')
                    ->translateLabel()
                    ->required()
                    ->inline(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('email')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('role')
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('student.name')
                    ->translateLabel(),
                RentShoesColumn::make('rent_shoes')
                    ->translateLabel(),
                Tables\Columns\IconColumn::make('rent_harness')
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
