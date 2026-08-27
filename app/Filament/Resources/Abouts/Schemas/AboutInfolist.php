<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AboutInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        ImageEntry::make('image_profile')->label('Foto Profil')->disk('public'),
                        TextEntry::make('name')->label('Nama'),
                        TextEntry::make('email')->label('Email'),
                        TextEntry::make('no_wa')->label('Nomor WhatsApp'),
                        TextEntry::make('tagline')->label('Tagline'),
                        TextEntry::make('address')->label('Alamat'),
                        TextEntry::make('description')->label('Deskripsi')->columnSpanFull(),
                        TextEntry::make('sosial_media')
                            ->label('Sosial Media')
                            ->formatStateUsing(fn ($state) => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $state)
                            ->columnSpanFull(),
                        IconEntry::make('active')->label('Aktif')->boolean(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Audit Data')
                    ->schema([
                        TextEntry::make('createdBy.name')->label('Dibuat Oleh'),
                        TextEntry::make('created_at')->label('Tanggal Dibuat')->dateTime('d M Y H:i'),
                        TextEntry::make('updatedBy.name')->label('Diubah Oleh'),
                        TextEntry::make('updated_at')->label('Tanggal Diubah')->dateTime('d M Y H:i'),
                        TextEntry::make('deletedBy.name')->label('Dihapus Oleh'),
                        TextEntry::make('deleted_at')->label('Tanggal Dihapus')->dateTime('d M Y H:i'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
