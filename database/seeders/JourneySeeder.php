<?php

namespace Database\Seeders;

use App\Models\Journey;
use Illuminate\Database\Seeder;

class JourneySeeder extends Seeder
{
    public function run(): void
    {
        // Truncate existing records to eliminate duplicate entries
        Journey::query()->truncate();

        foreach ($this->journeys() as $journey) {
            Journey::query()->create($journey + ['active' => true]);
        }
    }

    private function journeys(): array
    {
        return [
            // EDUCATION (Key: education)
            [
                'key' => 'education',
                'title' => 'Sistem Informasi (S.Kom)',
                'logo' => 'images/journey/ubsi.png',
                'institute' => 'Universitas Bina Sarana Informatika',
                'description' => 'Lulus dengan IPK 3.6. Fokus pada software engineering, database architecture, dan pengembangan sistem enterprise.',
                'date_range' => '2021 - 2025',
                'sort' => 1,
            ],
            [
                'key' => 'education',
                'title' => 'MSIB Batch 6',
                'logo' => 'images/journey/startup.png',
                'institute' => 'Startup Campus',
                'description' => 'Program Magang & Studi Independen Bersertifikat Kemendikbudristek bidang Fullstack Web Development.',
                'date_range' => 'Feb 2024 - Juni 2024',
                'sort' => 2,
            ],
            [
                'key' => 'education',
                'title' => 'Teknik Komputer & Jaringan',
                'logo' => 'images/journey/smk.png',
                'institute' => 'SMA / SMK Negeri',
                'description' => 'Mempelajari dasar-dasar algoritma pemrograman, jaringan komputer, server Linux, & troubleshooting hardware.',
                'date_range' => '2018 - 2021',
                'sort' => 3,
            ],

            // EXPERIENCE & WORK (Key: experience)
            [
                'key' => 'experience',
                'title' => 'Senior Fullstack Web Developer',
                'logo' => 'images/journey/keysoft.png',
                'institute' => 'PT Keysoft ERP Indonesia',
                'description' => 'Memimpin pengembangan modul ERP manufaktur & keuangan, optimasi query database SQL Server, dan integrasi REST API.',
                'date_range' => '2025 - Sekarang',
                'sort' => 1,
            ],
            [
                'key' => 'experience',
                'title' => 'Fullstack Web Developer',
                'logo' => 'images/journey/pesona.png',
                'institute' => 'PT Pesona Trip Travel Indonesia',
                'description' => 'Mengembangkan sistem reservasi online, arsitektur backend, integrasi API, dan antarmuka pengguna frontend.',
                'date_range' => 'Sept 2024 - Jan 2025',
                'sort' => 2,
            ],
            [
                'key' => 'experience',
                'title' => 'Fullstack Web Developer',
                'logo' => 'images/journey/jasanya.png',
                'institute' => 'PT Jasanya Teknologi Indonesia',
                'description' => 'Mengembangkan modul ERP, REST API, dashboard operasional, dan integrasi sistem internal.',
                'date_range' => '2023 - Present',
                'sort' => 3,
            ],
            [
                'key' => 'experience',
                'title' => 'Koordinator Komite Kominfo',
                'logo' => 'images/journey/himsi.png',
                'institute' => 'HIMSI UBSI',
                'description' => 'Mengelola publikasi digital, dokumentasi kegiatan, dan pengembangan website organisasi.',
                'date_range' => '2023 - 2025',
                'sort' => 4,
            ],
        ];
    }
}
