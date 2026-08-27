<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->schema([
                        ImageEntry::make('thumbnail')->label('Thumbnail')->disk('public'),
                        TextEntry::make('name')->label('Nama Project'),
                        TextEntry::make('slug')->label('Slug'),
                        TextEntry::make('category.name')->label('Kategori'),
                        TextEntry::make('client.name')->label('Client'),
                        TextEntry::make('start_project')->label('Tanggal Mulai')->date('d M Y'),
                        TextEntry::make('end_project')->label('Tanggal Selesai')->date('d M Y'),
                        TextEntry::make('url')->label('URL Project')->url(fn ($state) => $state)->openUrlInNewTab(),
                        TextEntry::make('tools.name')->label('Tools')->badge()->separator(','),
                        IconEntry::make('is_featured')->label('Project Unggulan')->boolean(),
                        IconEntry::make('active')->label('Aktif')->boolean(),
                        TextEntry::make('body')->label('Deskripsi Lengkap')->html()->columnSpanFull(),
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
