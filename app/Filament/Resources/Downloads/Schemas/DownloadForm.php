<?php

namespace App\Filament\Resources\Downloads\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DownloadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Download Details')
                    ->components([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload(),

                        RichEditor::make('description')
                            ->columnSpanFull(),

                        FileUpload::make('file_path')
                            ->label('File')
                            ->directory('downloads')
                            ->storeFileNamesIn('original_name')
                            ->columnSpanFull(),

                        Toggle::make('is_published')
                            ->default(false),

                        Toggle::make('is_featured')
                            ->default(false),
                    ])->columns(2),

                Section::make('SEO Settings')
                    ->components([
                        TextInput::make('seo_title')
                            ->maxLength(255),

                        Textarea::make('seo_description')
                            ->rows(3),
                    ])->collapsible(),
            ]);
    }
}
