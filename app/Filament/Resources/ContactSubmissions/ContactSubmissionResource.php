<?php

namespace App\Filament\Resources\ContactSubmissions;

use App\Filament\Resources\ContactSubmissions\Pages\CreateContactSubmission;
use App\Filament\Resources\ContactSubmissions\Pages\EditContactSubmission;
use App\Filament\Resources\ContactSubmissions\Pages\ListContactSubmissions;
use App\Models\ContactSubmission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactSubmissionResource extends Resource
{
    public static function canCreate(): bool
    {
        return false;
    }

    protected static ?string $model = ContactSubmission::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-envelope';

    protected static \UnitEnum|string|null $navigationGroup = 'Inquiries';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact Submission')
                ->components([
                    Forms\Components\TextInput::make('name')
                        ->disabled(),

                    Forms\Components\TextInput::make('email')
                        ->disabled(),

                    Forms\Components\TextInput::make('phone')
                        ->disabled(),

                    Forms\Components\TextInput::make('subject')
                        ->disabled(),

                    Forms\Components\Textarea::make('message')
                        ->rows(6)
                        ->disabled()
                        ->columnSpanFull(),

                    Forms\Components\Select::make('status')
                        ->options([
                            'new' => 'New',
                            'in_progress' => 'In Progress',
                            'resolved' => 'Resolved',
                            'closed' => 'Closed',
                        ])
                        ->required(),

                    Forms\Components\Textarea::make('notes')
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->toggleable(),
                TextColumn::make('phone')->toggleable(),
                TextColumn::make('subject')->limit(30),
                BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'danger' => 'new',
                        'warning' => 'in_progress',
                        'success' => 'resolved',
                        'gray' => 'closed',
                    ]),
                TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => ListContactSubmissions::route('/'),
            'create' => CreateContactSubmission::route('/create'),
            'edit' => EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
