<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Contact;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortfolioStatsOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Ringkasan Portofolio';

    protected ?string $description = 'Statistik cepat dari data yang tampil di website publik.';

    protected function getStats(): array
    {
        return [
            Stat::make('Project Aktif', Project::query()->where('active', true)->count())
                ->description('Total project yang tampil di publik')
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('primary'),

            Stat::make('Project Pilihan', Project::query()->where('active', true)->where('is_featured', true)->count())
                ->description('Masuk section project pilihan')
                ->descriptionIcon('heroicon-o-star')
                ->color('warning'),

            Stat::make('Client Aktif', Client::query()->where('active', true)->count())
                ->description('Logo client/mitra publik')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Pesan Belum Dibaca', Contact::query()->where('active', true)->whereNull('read_at')->count())
                ->description('Inbox kontak yang perlu dicek')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('danger'),
        ];
    }
}
