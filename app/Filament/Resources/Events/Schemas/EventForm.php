<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('excerpt')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('location')
                    ->default(null),
                DateTimePicker::make('start_at')
                    ->required(),
                DateTimePicker::make('end_at'),
                Toggle::make('all_day')
                    ->required(),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_published')
                    ->required(),
                TextInput::make('seo_title')
                    ->default(null),
                Textarea::make('seo_description')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
