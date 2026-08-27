<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Category;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Journey;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Tools;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        About::query()->updateOrCreate(
            ['email' => 'wahyudwiutomo1414@gmail.com'],
            [
                'name' => 'Wahyu Dwi Utomo',
                'no_wa' => '+62 812-3456-7890',
                'sosial_media' => [
                    'github' => 'https://github.com/WahyuUtomo1414',
                    'linkedin' => 'https://linkedin.com/in/wahyu-dwi-utomo',
                    'instagram' => 'https://instagram.com/wahyudwi',
                    'website' => 'https://wahyu.dev',
                ],
                'description' => 'Fullstack web developer yang fokus membangun aplikasi Laravel, dashboard admin, API, dan frontend yang rapi untuk kebutuhan bisnis.',
                'image_profile' => 'https://picsum.photos/seed/wahyu-profile/900/900',
                'tagline' => 'Building scalable fullstack web applications.',
                'address' => 'Bekasi / Jakarta, Indonesia',
                'active' => true,
            ],
        );

        $journeys = [
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

        foreach ($journeys as $journey) {
            Journey::query()->updateOrCreate(
                [
                    'key' => $journey['key'],
                    'title' => $journey['title'],
                    'institute' => $journey['institute'],
                ],
                $journey + ['active' => true],
            );
        }

        $categories = collect([
            ['name' => 'Web Development', 'desc' => 'Project website, dashboard, CMS, dan aplikasi bisnis berbasis web.', 'type' => 'project'],
            ['name' => 'Enterprise App', 'desc' => 'Project sistem internal, ERP, dan aplikasi operasional perusahaan.', 'type' => 'project'],
            ['name' => 'Mobile App', 'desc' => 'Project aplikasi mobile dan integrasi API backend.', 'type' => 'project'],
        ])->mapWithKeys(fn (array $category) => [
            $category['name'] => Category::query()->updateOrCreate(
                ['name' => $category['name']],
                $category + ['active' => true],
            ),
        ]);

        $clients = collect([
            ['name' => 'PT Keysoft ERP Indonesia', 'logo' => 'https://picsum.photos/seed/client-keysoft/320/320', 'desc' => 'Perusahaan penyedia solusi ERP dan sistem bisnis.'],
            ['name' => 'Universitas BSI', 'logo' => 'https://picsum.photos/seed/client-ubsi/320/320', 'desc' => 'Institusi pendidikan tinggi berbasis teknologi informasi.'],
            ['name' => 'Personal Project', 'logo' => 'https://picsum.photos/seed/client-personal/320/320', 'desc' => 'Project pribadi untuk eksplorasi produk digital.'],
        ])->mapWithKeys(fn (array $client) => [
            $client['name'] => Client::query()->updateOrCreate(
                ['name' => $client['name']],
                $client + ['active' => true],
            ),
        ]);

        $tools = collect([
            ['name' => 'Laravel', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg', 'desc' => 'PHP framework untuk backend dan aplikasi web.'],
            ['name' => 'Filament', 'logo' => 'https://picsum.photos/seed/tool-filament/240/240', 'desc' => 'Admin panel berbasis Laravel.'],
            ['name' => 'Tailwind CSS', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg', 'desc' => 'Utility-first CSS framework.'],
            ['name' => 'Vue.js', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'desc' => 'Frontend framework untuk interface interaktif.'],
            ['name' => 'Flutter', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg', 'desc' => 'Framework mobile cross-platform.'],
            ['name' => 'PostgreSQL', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg', 'desc' => 'Relational database untuk aplikasi production.'],
        ])->mapWithKeys(fn (array $tool) => [
            $tool['name'] => Tools::query()->updateOrCreate(
                ['name' => $tool['name']],
                $tool + ['active' => true],
            ),
        ]);

        $projects = [
            [
                'data' => [
                    'thumbnail' => 'https://picsum.photos/seed/project-erp/1200/720',
                    'name' => 'Keysoft ERP Enterprise System',
                    'slug' => 'keysoft-erp-enterprise-system',
                    'category_id' => $categories['Enterprise App']->id,
                    'body' => 'Sistem ERP berbasis Laravel untuk mengelola modul inventory, purchase, sales, finance, reporting, dan hak akses user internal.',
                    'client_id' => $clients['PT Keysoft ERP Indonesia']->id,
                    'start_project' => '2025-01-10',
                    'end_project' => null,
                    'url' => 'https://example.com/keysoft-erp',
                    'is_featured' => true,
                    'active' => true,
                ],
                'tools' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'PostgreSQL'],
                'images' => [
                    ['image' => 'https://picsum.photos/seed/project-erp-dashboard/1400/900', 'description' => 'Dashboard ringkasan modul ERP.'],
                    ['image' => 'https://picsum.photos/seed/project-erp-report/1400/900', 'description' => 'Tampilan laporan operasional.'],
                ],
            ],
            [
                'data' => [
                    'thumbnail' => 'https://picsum.photos/seed/project-portfolio/1200/720',
                    'name' => 'Personal Portfolio CMS',
                    'slug' => 'personal-portfolio-cms',
                    'category_id' => $categories['Web Development']->id,
                    'body' => 'Website portofolio pribadi berbasis Laravel 13, Blade, Tailwind CSS, dan Filament untuk mengelola profil, journey, project, client, tools, dan pesan kontak.',
                    'client_id' => $clients['Personal Project']->id,
                    'start_project' => '2026-08-01',
                    'end_project' => null,
                    'url' => 'https://example.com/portfolio',
                    'is_featured' => true,
                    'active' => true,
                ],
                'tools' => ['Laravel', 'Filament', 'Tailwind CSS'],
                'images' => [
                    ['image' => 'https://picsum.photos/seed/project-portfolio-home/1400/900', 'description' => 'Halaman utama portofolio.'],
                    ['image' => 'https://picsum.photos/seed/project-portfolio-admin/1400/900', 'description' => 'Panel admin konten portofolio.'],
                ],
            ],
            [
                'data' => [
                    'thumbnail' => 'https://picsum.photos/seed/project-mobile/1200/720',
                    'name' => 'Mobile Field Reporting App',
                    'slug' => 'mobile-field-reporting-app',
                    'category_id' => $categories['Mobile App']->id,
                    'body' => 'Aplikasi mobile untuk laporan aktivitas lapangan, upload dokumentasi, sinkronisasi data, dan dashboard monitoring berbasis API.',
                    'client_id' => $clients['Universitas BSI']->id,
                    'start_project' => '2024-09-15',
                    'end_project' => '2025-02-20',
                    'url' => 'https://example.com/mobile-reporting',
                    'is_featured' => false,
                    'active' => true,
                ],
                'tools' => ['Flutter', 'Laravel', 'PostgreSQL'],
                'images' => [
                    ['image' => 'https://picsum.photos/seed/project-mobile-form/1400/900', 'description' => 'Form laporan aktivitas lapangan.'],
                    ['image' => 'https://picsum.photos/seed/project-mobile-dashboard/1400/900', 'description' => 'Dashboard monitoring laporan.'],
                ],
            ],
        ];

        foreach ($projects as $projectItem) {
            $project = Project::query()->updateOrCreate(
                ['slug' => $projectItem['data']['slug']],
                $projectItem['data'],
            );

            $project->tools()->sync(
                collect($projectItem['tools'])
                    ->mapWithKeys(fn (string $toolName) => [
                        $tools[$toolName]->id => [
                            'active' => true,
                            'created_by' => 1,
                        ],
                    ])
                    ->all(),
            );

            foreach ($projectItem['images'] as $image) {
                ProjectImage::query()->updateOrCreate(
                    [
                        'project_id' => $project->id,
                        'image' => $image['image'],
                    ],
                    $image + [
                        'project_id' => $project->id,
                        'active' => true,
                    ],
                );
            }
        }

        foreach ([
            ['name' => 'Raka Pratama', 'email' => 'raka@example.com', 'subject' => 'Diskusi website company profile', 'message' => 'Halo, saya ingin berdiskusi tentang kebutuhan website company profile untuk bisnis saya.'],
            ['name' => 'Nadia Putri', 'email' => 'nadia@example.com', 'subject' => 'Pembuatan dashboard admin', 'message' => 'Saya butuh dashboard admin untuk mengelola data internal dan laporan bulanan.'],
            ['name' => 'Fajar Nugroho', 'email' => 'fajar@example.com', 'subject' => 'Integrasi API Laravel', 'message' => 'Apakah bisa bantu integrasi API Laravel dengan aplikasi mobile yang sudah ada?'],
        ] as $contact) {
            Contact::query()->updateOrCreate(
                [
                    'email' => $contact['email'],
                    'subject' => $contact['subject'],
                ],
                $contact + ['active' => true],
            );
        }
    }
}
