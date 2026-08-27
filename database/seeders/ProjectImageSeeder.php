<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->projectImages() as $projectSlug => $images) {
            $project = Project::query()->where('slug', $projectSlug)->first();

            if (! $project) {
                continue;
            }

            foreach ($images as $image) {
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
    }

    private function projectImages(): array
    {
        return [
            'keysoft-erp-enterprise-system' => [
                ['image' => 'https://picsum.photos/seed/project-erp-dashboard/1400/900', 'description' => 'Dashboard ringkasan modul ERP.'],
                ['image' => 'https://picsum.photos/seed/project-erp-report/1400/900', 'description' => 'Tampilan laporan operasional.'],
            ],
            'personal-portfolio-cms' => [
                ['image' => 'https://picsum.photos/seed/project-portfolio-home/1400/900', 'description' => 'Halaman utama portofolio.'],
                ['image' => 'https://picsum.photos/seed/project-portfolio-admin/1400/900', 'description' => 'Panel admin konten portofolio.'],
            ],
            'mobile-field-reporting-app' => [
                ['image' => 'https://picsum.photos/seed/project-mobile-form/1400/900', 'description' => 'Form laporan aktivitas lapangan.'],
                ['image' => 'https://picsum.photos/seed/project-mobile-dashboard/1400/900', 'description' => 'Dashboard monitoring laporan.'],
            ],
        ];
    }
}
