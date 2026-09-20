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
        return [];
    }
}
