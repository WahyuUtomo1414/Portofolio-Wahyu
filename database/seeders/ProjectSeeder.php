<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->projects() as $project) {
            Project::query()->updateOrCreate(
                ['slug' => $project['slug']],
                [
                    'thumbnail' => $project['thumbnail'],
                    'name' => $project['name'],
                    'category_id' => Category::query()->where('name', $project['category'])->value('id'),
                    'body' => $project['body'],
                    'client_id' => 1,
                    'start_project' => $project['start_project'],
                    'end_project' => $project['end_project'],
                    'url' => $project['url'],
                    'is_featured' => $project['is_featured'],
                    'active' => true,
                ],
            );
        }
    }

    private function projects(): array
    {
        return [
            [
                'thumbnail' => 'https://picsum.photos/seed/project-erp/1200/720',
                'name' => 'Keysoft ERP Enterprise System',
                'slug' => 'keysoft-erp-enterprise-system',
                'category' => 'Enterprise App',
                'body' => 'Sistem ERP enterprise untuk mengelola modul inventory, purchase, sales, finance, reporting, dan hak akses user internal. Dirancang untuk mendukung operasional multi-departemen dengan audit trail dan optimasi performa query.',
                'start_project' => '2025-01-10',
                'end_project' => null,
                'url' => 'https://example.com/keysoft-erp',
                'is_featured' => true,
            ],
            [
                'thumbnail' => 'https://picsum.photos/seed/project-portfolio/1200/720',
                'name' => 'Personal Portfolio CMS',
                'slug' => 'personal-portfolio-cms',
                'category' => 'Web Development',
                'body' => 'Website portofolio pribadi dengan CMS internal untuk mengelola profil, journey, project, client, tools, dan pesan kontak. Dibangun dengan struktur database domain-driven dan admin panel yang scalable.',
                'start_project' => '2026-08-01',
                'end_project' => null,
                'url' => 'https://example.com/portfolio',
                'is_featured' => true,
            ],
            [
                'thumbnail' => 'https://picsum.photos/seed/project-mobile/1200/720',
                'name' => 'Mobile Field Reporting App',
                'slug' => 'mobile-field-reporting-app',
                'category' => 'Mobile App',
                'body' => 'Aplikasi mobile untuk laporan aktivitas lapangan, upload dokumentasi, sinkronisasi data, dan dashboard monitoring berbasis API.',
                'start_project' => '2024-09-15',
                'end_project' => '2025-02-20',
                'url' => 'https://example.com/mobile-reporting',
                'is_featured' => false,
            ],
        ];
    }
}
