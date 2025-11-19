<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CanchaResource\Pages;
use App\Filament\Resources\CanchaResource\RelationManagers;
use App\Models\Cancha;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CanchaResource extends Resource
{
    protected static ?string $model = Cancha::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre de la Cancha')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type')
                    ->label('Tipo de Cancha')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('location')
                    ->label('Ubicación')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('precio')
                    ->label('Precio por Turno')
                    ->numeric()
                    ->required()
                    ->default(150)
                    ->step(0.01)
                    ->prefix('$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->label('Ubicación')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio')
                    ->label('Precio')
                    ->money('ARS')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCanchas::route('/'),
            'create' => Pages\CreateCancha::route('/create'),
            'view' => Pages\ViewCancha::route('/{record}'),
            'edit' => Pages\EditCancha::route('/{record}/edit'),
        ];
    }

}
