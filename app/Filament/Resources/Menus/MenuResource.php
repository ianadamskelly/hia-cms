<?php

namespace App\Filament\Resources\Menus;

use App\Models\Menu;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-bars-3';

    protected static \UnitEnum|string|null $navigationGroup = 'Site Management';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Menu Information')
                ->components([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('location')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Use: main_navigation, header_actions, footer_quick_links, footer_company'),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('name', 'asc')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Items'),

                TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->label('Updated'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage menus') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage menus') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage menus') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage menus') ?? false;
    }
}
