<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengirim')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(128),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(128),
                        TextInput::make('subject')
                            ->label('Subjek')
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Isi Pesan')
                    ->schema([
                        Textarea::make('message')
                            ->label('Pesan')
                            ->required()
                            ->rows(7)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                Section::make('Status Pesan')
                    ->schema([
                        DateTimePicker::make('read_at')
                            ->label('Dibaca Pada')
                            ->seconds(false),
                        DateTimePicker::make('replied_at')
                            ->label('Dibalas Pada')
                            ->seconds(false),
                        Toggle::make('active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
