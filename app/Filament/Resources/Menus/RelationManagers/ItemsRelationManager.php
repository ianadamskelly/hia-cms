<?php

namespace App\Filament\Resources\Menus\RelationManagers;

use App\Models\MenuItem;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Menu Items';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Menu Item Information')
                ->components([
                    Forms\Components\Select::make('parent_id')
                        ->label('Parent Item')
                        ->options(
                            MenuItem::query()
                                ->where('menu_id', $this->getOwnerRecord()->id)
                                ->pluck('label', 'id')
                        )
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

    public function table(Table $table): Table
    {
        return $table
            ->columns([
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
                    ->label('Updated'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
