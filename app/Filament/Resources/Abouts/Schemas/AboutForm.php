<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(128),
                        TextInput::make('no_wa')
                            ->label('Nomor WhatsApp')
                            ->required()
                            ->maxLength(18),
                        TextInput::make('tagline')
                            ->label('Tagline')
                            ->maxLength(255),
                        TextInput::make('address')
                            ->label('Alamat')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Media')
                    ->schema([
                        FileUpload::make('image_profile')
                            ->label('Foto Profil')
                            ->image()
                            ->disk('public')
                            ->directory('about')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(2048),
                    ])
                    ->columnSpanFull(),
                Section::make('Sosial Media')
                    ->schema([
                        TextInput::make('sosial_media.github')
                            ->label('GitHub')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('sosial_media.linkedin')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('sosial_media.instagram')
                            ->label('Instagram')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('sosial_media.website')
                            ->label('Website')
                            ->url()
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Status')
                    ->schema([
                        Toggle::make('active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
