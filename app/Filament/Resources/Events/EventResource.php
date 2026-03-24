<?php

namespace App\Filament\Resources\Events;

use App\Models\Event;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static \UnitEnum|string|null $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 4;

    protected static ?string $model = Event::class;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Event Information')
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

                    Forms\Components\Select::make('type')
                        ->options([
                            'academic' => 'Academic',
                            'holiday' => 'Holiday',
                            'exam' => 'Exam',
                            'event' => 'Event',
                            'staff' => 'Staff/PD',
                        ])
                        ->required()
                        ->default('event'),

                    Forms\Components\Textarea::make('excerpt')
                        ->rows(3)
                        ->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->collection('featured_image')
                        ->label('Featured Image')
                        ->disk('public')
                        ->directory('events/featured')
                        ->imagePreviewHeight('150px')
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('1200')
                        ->imageResizeTargetHeight('675')
                        ->imageResizeMode('crop')
                        ->imageResizeUpscale(false)
                        ->preserveFilenames(false)
                        ->visibility('public')
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('description')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('location')
                        ->maxLength(255),

                    Forms\Components\DateTimePicker::make('start_at')
                        ->required()
                        ->seconds(false),

                    Forms\Components\DateTimePicker::make('end_at')
                        ->seconds(false),

                    Forms\Components\Toggle::make('all_day')
                        ->label('All Day')
                        ->default(false),

                    Forms\Components\Toggle::make('is_featured')
                        ->label('Featured')
                        ->default(false),

                    Forms\Components\Toggle::make('is_published')
                        ->label('Published')
                        ->default(false),

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
            ->defaultSort('start_at', 'desc')
            ->columns([

                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('featured_image')
                    ->label('Image')
                    ->disk('public')
                    ->width(80)
                    ->height(50)
                    ->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'academic' => 'blue',
                        'holiday' => 'danger',
                        'exam' => 'warning',
                        'event' => 'success',
                        'staff' => 'info',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('location')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('start_at')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('end_at')
                    ->dateTime()
                    ->sortable(),

                IconColumn::make('all_day')
                    ->label('All Day')
                    ->boolean(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

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

                TernaryFilter::make('all_day')
                    ->label('All Day'),

                \Filament\Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'academic' => 'Academic',
                        'holiday' => 'Holiday',
                        'exam' => 'Exam',
                        'event' => 'Event',
                        'staff' => 'Staff/PD',
                    ]),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage events') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage events') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage events') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage events') ?? false;
    }
}
