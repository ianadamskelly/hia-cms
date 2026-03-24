<?php

namespace App\Filament\Resources\Posts;

use App\Models\Category;
use App\Models\Post;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-newspaper';

    protected static \UnitEnum|string|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Post Information')
                ->components([
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
                        ->options(Category::query()->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->nullable(),

                    Forms\Components\Textarea::make('excerpt')
                        ->rows(3)
                        ->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->collection('featured_image')
                        ->label('Featured Image')
                        ->disk('public')
                        ->directory('posts/featured')
                        ->imagePreviewHeight('150px')
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('1200')
                        ->imageResizeTargetHeight('675')
                        ->imageResizeMode('crop')
                        ->imageResizeUpscale(false)
                        ->preserveFilenames(false)
                        ->visibility('public')
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('content')
                        ->columnSpanFull(),

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
            ->defaultSort('published_at', 'desc')
            ->columns([

                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('featured_image')
                    ->label('Image')
                    ->disk('public')
                    ->width(80)
                    ->height(50)
                    ->circular(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->label('Updated'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Published'),

                Tables\Filters\TernaryFilter::make('is_featured')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage posts') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage posts') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage posts') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage posts') ?? false;
    }
}
