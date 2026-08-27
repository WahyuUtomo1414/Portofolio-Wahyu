<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengirim')
                    ->schema([
                        TextEntry::make('name')->label('Nama Lengkap'),
                        TextEntry::make('email')
                            ->label('Email')
                            ->copyable(),
                        TextEntry::make('subject')
                            ->label('Subjek')
                            ->placeholder('-')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('Isi Pesan')
                    ->schema([
                        TextEntry::make('message')
                            ->label('Pesan')
                            ->prose()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
                Section::make('Status Pesan')
                    ->schema([
                        IconEntry::make('active')->label('Aktif')->boolean(),
                        TextEntry::make('read_at')->label('Dibaca Pada')->dateTime('d M Y H:i')->placeholder('-'),
                        TextEntry::make('replied_at')->label('Dibalas Pada')->dateTime('d M Y H:i')->placeholder('-'),
                    ])
                    ->columns(3)
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
