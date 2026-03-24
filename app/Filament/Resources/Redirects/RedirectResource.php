<?php

namespace App\Filament\Resources\Redirects;

use App\Filament\Resources\Redirects\Pages\CreateRedirect;
use App\Filament\Resources\Redirects\Pages\EditRedirect;
use App\Filament\Resources\Redirects\Pages\ListRedirects;
use App\Models\Redirect;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-arrow-path';

    protected static \UnitEnum|string|null $navigationGroup = 'Site Management';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Redirect')
                ->components([
                    TextInput::make('from_url')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Example: /old-page'),

                    TextInput::make('to_url')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Example: /new-page'),

                    Select::make('status_code')
                        ->options([
                            301 => '301 Permanent',
                            302 => '302 Temporary',
                        ])
                        ->default(301)
                        ->required(),

                    Toggle::make('is_active')
                        ->default(true),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('updated_at', 'desc')
            ->columns([
                TextColumn::make('from_url')->searchable()->sortable(),
                TextColumn::make('to_url')->searchable()->sortable(),
                TextColumn::make('status_code')->badge(),
                IconColumn::make('is_active')->boolean(),
                TextColumn::make('updated_at')->since()->sortable()->label('Updated'),
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
            'index' => ListRedirects::route('/'),
            'create' => CreateRedirect::route('/create'),
            'edit' => EditRedirect::route('/{record}/edit'),
        ];
    }
}
