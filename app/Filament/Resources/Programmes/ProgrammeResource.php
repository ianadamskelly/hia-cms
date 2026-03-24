<?php

namespace App\Filament\Resources\Programmes;

use App\Filament\Resources\Programmes\Pages\CreateProgramme;
use App\Filament\Resources\Programmes\Pages\EditProgramme;
use App\Filament\Resources\Programmes\Pages\ListProgrammes;
use App\Models\Programme;
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
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProgrammeResource extends Resource
{
    protected static ?string $model = Programme::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static \UnitEnum|string|null $navigationGroup = 'School Content';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Programme Information')
                ->components([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true),

                    Forms\Components\TextInput::make('short_name')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('age_range')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('curriculum_type')
                        ->maxLength(255),

                    Forms\Components\Textarea::make('excerpt')
                        ->rows(3)
                        ->columnSpanFull(),

                    SpatieMediaLibraryFileUpload::make('featured_image')
                        ->collection('featured_image')
                        ->image()
                        ->imageEditor()
                        ->columnSpanFull(),

                    Forms\Components\RichEditor::make('description')
                        ->columnSpanFull(),

                    Forms\Components\TextInput::make('sort_order')
                        ->numeric()
                        ->default(0)
                        ->required(),

                    Forms\Components\Toggle::make('is_featured')->default(false),
                    Forms\Components\Toggle::make('is_published')->default(false),

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
            ->defaultSort('sort_order', 'asc')
            ->columns([
                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('featured_image')
                    ->label('Image')
                    ->square(),

                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('short_name')->toggleable(),
                TextColumn::make('age_range')->toggleable(),
                TextColumn::make('curriculum_type')->badge(),
                TextColumn::make('sort_order')->sortable(),
                IconColumn::make('is_featured')->boolean(),
                IconColumn::make('is_published')->boolean(),
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
            'index' => ListProgrammes::route('/'),
            'create' => CreateProgramme::route('/create'),
            'edit' => EditProgramme::route('/{record}/edit'),
        ];
    }
}
