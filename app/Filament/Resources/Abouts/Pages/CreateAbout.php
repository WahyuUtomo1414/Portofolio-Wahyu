<?php

namespace App\Filament\Resources\Abouts\Pages;

use App\Filament\Resources\Abouts\AboutResource;
use App\Models\About;
use Filament\Resources\Pages\CreateRecord;

class CreateAbout extends CreateRecord
{
    protected static string $resource = AboutResource::class;

    public function mount(): void
    {
        $about = About::query()->withoutGlobalScopes()->first();

        if ($about) {
            $this->redirect(AboutResource::getUrl('view', ['record' => $about]), navigate: true);

            return;
        }

        parent::mount();
    }

    protected function getRedirectUrl(): string
    {
        return AboutResource::getUrl('view', ['record' => $this->record]);
    }
}
