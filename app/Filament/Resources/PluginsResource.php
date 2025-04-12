<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Plugin;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\PluginsResource\Pages;

class PluginsResource extends Resource
{
    protected static ?string $model = Plugin::class; // No model needed for static data
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Plugin Status';
    protected static ?string $modelLabel = 'Plugin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Plugin::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => ucfirst($state)), // Capitalize the first character
                Tables\Columns\TextColumn::make('version'),
                Tables\Columns\ToggleColumn::make('active') // Use ToggleColumn for status
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger'),
            ])
            ->filters([
                // Filters can be added here
            ])
            ->actions([
                // No actions needed for static data
            ])
            ->bulkActions([
                // No bulk actions needed
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePlugins::route('/'),
        ];
    }
}
