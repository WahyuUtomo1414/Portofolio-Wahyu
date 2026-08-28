<?php

namespace App\Filament\Resources\Journeys\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JourneyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        Select::make('key')
                            ->label('Jenis / Kategori')
                            ->options([
                                'education' => 'Pendidikan',
                                'experience' => 'Pengalaman & Kerja',
                            ])
                            ->required(),
                        TextInput::make('title')
                            ->label('Judul / Peran')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('institute')
                            ->label('Institusi / Perusahaan')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('date_range')
                            ->label('Periode')
                            ->required()
                            ->maxLength(128),
                        TextInput::make('sort')
                            ->label('Urutan')
                            ->numeric()
                            ->default(1)
                            ->required(),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Media')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo')
                            ->image()
                            ->disk('public')
                            ->directory('journey')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(2048),
                    ])
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
