<?php

namespace App\Filament\Resources\Abouts\Pages;

use App\Filament\Resources\Abouts\AboutResource;
use App\Models\About;
use Filament\Resources\Pages\ListRecords;

class ListAbouts extends ListRecords
{
    protected static string $resource = AboutResource::class;

    public function mount(): void
    {
        $about = About::query()->withoutGlobalScopes()->first();

        $this->redirect(
            $about
                ? AboutResource::getUrl('view', ['record' => $about])
                : AboutResource::getUrl('create'),
            navigate: true,
        );
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
