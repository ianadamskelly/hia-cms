<?php

namespace App\Filament\Resources\Pages;

use App\Models\Page;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected static \UnitEnum|string|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage pages') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage pages') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage pages') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage pages') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Information')
                    ->components([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('template')
                            ->options([
                                'default' => 'Default',
                                'home' => 'Home',
                                'about' => 'About',
                                'contact' => 'Contact',
                            ])
                            ->default('default')
                            ->required(),

                        Textarea::make('excerpt')
                            ->rows(3),

                        SpatieMediaLibraryFileUpload::make('hero_image')
                            ->collection('hero_image')
                            ->label('Hero Image')
                            ->disk('public')
                            ->directory('pages/hero')
                            ->imagePreviewHeight('150px')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1200')
                            ->imageResizeTargetHeight('675')
                            ->imageResizeMode('crop')
                            ->imageResizeUpscale(false)
                            ->preserveFilenames(false)
                            ->visibility('public')
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->columnSpanFull(),

                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(false),

                        DateTimePicker::make('published_at')
                            ->seconds(false),

                        TextInput::make('seo_title')
                            ->maxLength(255),

                        Textarea::make('seo_description')
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

                SpatieMediaLibraryImageColumn::make('hero_image')
                    ->collection('hero_image')
                    ->label('Image')
                    ->disk('public')
                    ->width(80)
                    ->height(50)
                    ->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable(),

                TextColumn::make('template')
                    ->badge(),

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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
