<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable()->copyable(),
                TextColumn::make('subject')->label('Subjek')->limit(35)->searchable()->placeholder('-'),
                TextColumn::make('message')->label('Pesan')->limit(50)->searchable(),
                IconColumn::make('active')->label('Aktif')->boolean()->sortable(),
                TextColumn::make('read_at')->label('Dibaca')->dateTime('d M Y H:i')->placeholder('-')->sortable(),
                TextColumn::make('replied_at')
                    ->label('Dibalas')
                    ->dateTime('d M Y H:i')
                    ->placeholder('-')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('createdBy.name')
                    ->label('Dibuat Oleh')
                    ->badge()
                    ->description(fn ($record) => $record->created_at?->format('d M Y H:i'))
                    ->sortable(),
                TextColumn::make('updatedBy.name')
                    ->label('Diubah Oleh')
                    ->badge()
                    ->description(fn ($record) => $record->updated_at?->format('d M Y H:i'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deletedBy.name')
                    ->label('Dihapus Oleh')
                    ->badge()
                    ->description(fn ($record) => $record->deleted_at?->format('d M Y H:i'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('active')->label('Aktif'),
                TernaryFilter::make('read_at')
                    ->label('Sudah Dibaca')
                    ->nullable(),
                TernaryFilter::make('replied_at')
                    ->label('Sudah Dibalas')
                    ->nullable(),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('markAsRead')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-eye')
                    ->visible(fn ($record): bool => blank($record->read_at))
                    ->action(fn ($record) => $record->update(['read_at' => now()])),
                Action::make('markAsReplied')
                    ->label('Tandai Dibalas')
                    ->icon('heroicon-o-check-circle')
                    ->visible(fn ($record): bool => blank($record->replied_at))
                    ->action(fn ($record) => $record->update([
                        'read_at' => $record->read_at ?? now(),
                        'replied_at' => now(),
                    ])),
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
