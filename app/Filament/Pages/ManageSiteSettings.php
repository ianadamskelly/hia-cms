<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageSiteSettings extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static \UnitEnum|string|null $navigationGroup = 'Site Management';

    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'site_name' => Setting::getValue('site_name', 'Hilal International Academy'),
            'site_tagline' => Setting::getValue('site_tagline', 'A modern learning community'),
            'site_description' => Setting::getValue('site_description', 'A modern learning community committed to academic excellence, character development, and global mindedness.'),
            'contact_email' => Setting::getValue('contact_email', 'info@hia.edu.so'),
            'phone_primary' => Setting::getValue('phone_primary', '+252 61 6997840'),
            'phone_secondary' => Setting::getValue('phone_secondary', ''),
            'address' => Setting::getValue('address', 'Mogadishu, Somalia'),
            'footer_text' => Setting::getValue('footer_text', 'Hilal International Academy. All rights reserved.'),
            'facebook_url' => Setting::getValue('facebook_url', ''),
            'instagram_url' => Setting::getValue('instagram_url', ''),
            'linkedin_url' => Setting::getValue('linkedin_url', ''),
            'youtube_url' => Setting::getValue('youtube_url', ''),
            'header_cta_label' => Setting::getValue('header_cta_label', 'Apply Now'),
            'header_cta_url' => Setting::getValue('header_cta_url', '/admissions'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('General')
                ->components([
                    Forms\Components\TextInput::make('site_name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('site_tagline')
                        ->maxLength(255),

                    Forms\Components\Textarea::make('site_description')
                        ->rows(4)
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Contact Information')
                ->components([
                    Forms\Components\TextInput::make('contact_email')
                        ->email()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('phone_primary')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('phone_secondary')
                        ->maxLength(255),

                    Forms\Components\Textarea::make('address')
                        ->rows(3),
                ])
                ->columns(2),

            Section::make('Header CTA')
                ->components([
                    Forms\Components\TextInput::make('header_cta_label')
                        ->maxLength(255),

                    Forms\Components\TextInput::make('header_cta_url')
                        ->maxLength(255),
                ])
                ->columns(2),

            Section::make('Footer')
                ->components([
                    Forms\Components\Textarea::make('footer_text')
                        ->rows(3),
                ]),

            Section::make('Social Links')
                ->components([
                    Forms\Components\TextInput::make('facebook_url')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('instagram_url')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('linkedin_url')
                        ->url()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('youtube_url')
                        ->url()
                        ->maxLength(255),
                ])
                ->columns(2),
        ])->statePath('data');
    }

    public function save(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            Setting::setValue($key, $value, 'general', 'text');
        }

        Notification::make()
            ->title('Settings saved successfully.')
            ->success()
            ->send();
    }

    public static function canAccess(): bool
    {
        return auth()->user()?->can('manage settings') ?? false;
    }
}
