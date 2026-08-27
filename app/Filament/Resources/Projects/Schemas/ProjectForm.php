<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Project')
                            ->required()
                            ->maxLength(128)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(128),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('client_id')
                            ->label('Client')
                            ->relationship('client', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        DatePicker::make('start_project')
                            ->label('Tanggal Mulai'),
                        DatePicker::make('end_project')
                            ->label('Tanggal Selesai'),
                        TextInput::make('url')
                            ->label('URL Project')
                            ->url()
                            ->maxLength(255),
                        Select::make('tools')
                            ->label('Tools')
                            ->relationship('tools', 'name')
                            ->multiple()
                            ->searchable()
                            ->preload(),
                        RichEditor::make('body')
                            ->label('Deskripsi Lengkap')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Media')
                    ->schema([
                        FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->disk('public')
                            ->directory('project/thumbnail')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(2048),
                    ])
                    ->columnSpanFull(),
                Section::make('Status')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Project Unggulan')
                            ->default(false),
                        Toggle::make('active')
                            ->label('Aktif')
                            ->default(true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
