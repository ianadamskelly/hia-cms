<?php

namespace App\Filament\Resources\MenuItems;

use App\Models\Menu;
use App\Models\MenuItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $model = MenuItem::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-link';

    protected static \UnitEnum|string|null $navigationGroup = 'Site Management';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Menu Item Information')
                ->components([
                    Forms\Components\Select::make('menu_id')
                        ->label('Menu')
                        ->options(Menu::query()->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\Select::make('parent_id')
                        ->label('Parent Item')
                        ->options(MenuItem::query()->pluck('label', 'id'))
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Forms\Components\TextInput::make('label')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('url')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Example: /news or /about-us'),

                    Forms\Components\Select::make('target')
                        ->options([
                            '_self' => 'Same Tab',
                            '_blank' => 'New Tab',
                        ])
                        ->default('_self')
                        ->required(),

                    Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->required(),

                    Forms\Components\Toggle::make('is_active')
                        ->default(true),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order', 'asc')
            ->columns([
                TextColumn::make('menu.name')
                    ->label('Menu')
                    ->badge(),

                TextColumn::make('parent.label')
                    ->label('Parent')
                    ->default('-'),

                TextColumn::make('label')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('url')
                    ->limit(40),

                TextColumn::make('sort_order')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
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
