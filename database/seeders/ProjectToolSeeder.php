<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tools;
use Illuminate\Database\Seeder;

class ProjectToolSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->projectTools() as $projectSlug => $toolNames) {
            $project = Project::query()->where('slug', $projectSlug)->first();

            if (! $project) {
                continue;
            }

            $tools = Tools::query()
                ->whereIn('name', $toolNames)
                ->pluck('id')
                ->mapWithKeys(fn (int $id) => [
                    $id => [
                        'active' => true,
                        'created_by' => 1,
                    ],
                ])
                ->all();

            $project->tools()->sync($tools);
        }
    }

    private function projectTools(): array
    {
        return [
            'keysoft-erp-enterprise-system' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'PostgreSQL'],
            'personal-portfolio-cms' => ['Laravel', 'Filament', 'Tailwind CSS'],
            'mobile-field-reporting-app' => ['Flutter', 'Laravel', 'PostgreSQL'],
        ];
    }
}
