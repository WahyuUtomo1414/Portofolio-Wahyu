<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ClientInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        ImageEntry::make('logo')->label('Logo')->disk('public'),
                        TextEntry::make('name')->label('Nama Client'),
                        TextEntry::make('desc')->label('Deskripsi')->columnSpanFull(),
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
