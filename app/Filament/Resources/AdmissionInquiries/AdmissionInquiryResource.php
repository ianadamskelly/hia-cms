<?php

namespace App\Filament\Resources\AdmissionInquiries;

use App\Filament\Resources\AdmissionInquiries\Pages\CreateAdmissionInquiry;
use App\Filament\Resources\AdmissionInquiries\Pages\EditAdmissionInquiry;
use App\Filament\Resources\AdmissionInquiries\Pages\ListAdmissionInquiries;
use App\Models\AdmissionInquiry;
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

class AdmissionInquiryResource extends Resource
{
    protected static ?string $model = AdmissionInquiry::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static \UnitEnum|string|null $navigationGroup = 'Inquiries';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Admission Inquiry')
                ->components([
                    Forms\Components\TextInput::make('parent_name')->disabled(),
                    Forms\Components\TextInput::make('student_name')->disabled(),
                    Forms\Components\TextInput::make('email')->disabled(),
                    Forms\Components\TextInput::make('phone')->disabled(),
                    Forms\Components\TextInput::make('programme_interest')->disabled(),
                    Forms\Components\TextInput::make('campus_interest')->disabled(),

                    Forms\Components\Textarea::make('message')
                        ->rows(5)
                        ->disabled()
                        ->columnSpanFull(),

                    Forms\Components\Select::make('status')
                        ->options([
                            'new' => 'New',
                            'in_progress' => 'In Progress',
                            'contacted' => 'Contacted',
                            'enrolled' => 'Enrolled',
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
                TextColumn::make('parent_name')->searchable()->sortable(),
                TextColumn::make('student_name')->searchable()->toggleable(),
                TextColumn::make('programme_interest')->label('Programme')->toggleable(),
                TextColumn::make('campus_interest')->label('Campus')->toggleable(),
                BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'danger' => 'new',
                        'warning' => 'in_progress',
                        'info' => 'contacted',
                        'success' => 'enrolled',
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
            'index' => ListAdmissionInquiries::route('/'),
            'create' => CreateAdmissionInquiry::route('/create'),
            'edit' => EditAdmissionInquiry::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
