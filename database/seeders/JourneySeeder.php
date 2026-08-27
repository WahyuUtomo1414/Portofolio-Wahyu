<?php

namespace Database\Seeders;

use App\Models\Journey;
use Illuminate\Database\Seeder;

class JourneySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->journeys() as $journey) {
            Journey::query()->updateOrCreate(
                [
                    'key' => $journey['key'],
                    'title' => $journey['title'],
                    'institute' => $journey['institute'],
                ],
                $journey + ['active' => true],
            );
        }
    }

    private function journeys(): array
    {
        return [
            [
                'key' => 'education',
                'title' => 'Sistem Informasi',
                'logo' => 'https://picsum.photos/seed/ubsi-logo/240/240',
                'institute' => 'Universitas Bina Sarana Informatika',
                'description' => 'Fokus pada software engineering, database, analisis sistem, dan pengembangan aplikasi web.',
                'date_range' => '2021 - 2025',
                'sort' => 1,
            ],
            [
                'key' => 'experience',
                'title' => 'Fullstack Web Developer',
                'logo' => 'https://picsum.photos/seed/keysoft-logo/240/240',
                'institute' => 'PT Keysoft ERP Indonesia',
                'description' => 'Mengembangkan modul ERP, REST API, dashboard operasional, dan integrasi sistem internal.',
                'date_range' => '2025 - Present',
                'sort' => 2,
            ],
            [
                'key' => 'organization',
                'title' => 'Koordinator Kominfo',
                'logo' => 'https://picsum.photos/seed/himsi-logo/240/240',
                'institute' => 'HIMSI UBSI',
                'description' => 'Mengelola publikasi digital, dokumentasi kegiatan, dan pengembangan website organisasi.',
                'date_range' => '2023 - 2025',
                'sort' => 3,
            ],
        ];
    }
}
