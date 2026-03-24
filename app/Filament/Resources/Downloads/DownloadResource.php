<?php

namespace App\Filament\Resources\Downloads;

use App\Filament\Resources\Downloads\Pages\CreateDownload;
use App\Filament\Resources\Downloads\Pages\EditDownload;
use App\Filament\Resources\Downloads\Pages\ListDownloads;
use App\Models\Category;
use App\Models\Download;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-down-tray';

    protected static \UnitEnum|string|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Download Information')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, callable $set) {
                            $set('slug', Str::slug($state));
                        }),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->options(
                            Category::query()
                                ->where('type', 'download')
                                ->pluck('name', 'id')
                        )
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Forms\Components\Textarea::make('description')
                        ->rows(3)
                        ->columnSpanFull(),

                    Forms\Components\FileUpload::make('file_path')
                        ->label('Document')
                        ->disk('public')
                        ->directory('downloads')
                        ->downloadable()
                        ->openable()
                        ->preserveFilenames()
                        ->acceptedFileTypes([
                            'application/pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            'application/vnd.ms-powerpoint',
                            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                            'image/png',
                            'image/jpeg',
                            'text/plain',
                        ])
                        ->maxSize(20480)
                        ->required()
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('original_name')
                        ->label('Original File Name')
                        ->disabled()
                        ->dehydrated(false),

                    Forms\Components\TextInput::make('file_type')
                        ->disabled()
                        ->dehydrated(false),

                    Forms\Components\TextInput::make('file_size')
                        ->disabled()
                        ->dehydrated(false),

                    Forms\Components\Toggle::make('is_featured')
                        ->label('Featured')
                        ->default(false),

                    Forms\Components\Toggle::make('is_published')
                        ->label('Published')
                        ->default(false),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->seconds(false),

                    Forms\Components\TextInput::make('seo_title')
                        ->maxLength(255),

                    Forms\Components\Textarea::make('seo_description')
                        ->rows(3),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge(),

                TextColumn::make('file_type')
                    ->label('Type')
                    ->badge(),

                TextColumn::make('file_size')
                    ->label('Size')
                    ->formatStateUsing(fn ($state) => $state ? number_format($state / 1024, 1).' KB' : '-'),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->label('Updated'),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Published'),

                TernaryFilter::make('is_featured')
                    ->label('Featured'),
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
            'index' => ListDownloads::route('/'),
            'create' => CreateDownload::route('/create'),
            'edit' => EditDownload::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage downloads') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage downloads') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage downloads') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage downloads') ?? false;
    }
}
