<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Tools;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $files = glob(database_path('data/project/*.json'));

        foreach ($files as $file) {
            $data = json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);

            $category = Category::query()->firstOrCreate(
                ['name' => $data['category']],
                ['active' => true, 'type' => 'project'],
            );

            $client = Client::query()->firstOrCreate(
                ['name' => $data['client']],
                ['active' => true],
            );

            $project = Project::query()->updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'thumbnail' => $data['thumbnail'],
                    'name' => $data['name'],
                    'category_id' => $category->id,
                    'body' => $data['body'],
                    'client_id' => $client->id,
                    'start_project' => $data['start_project'],
                    'end_project' => $data['end_project'],
                    'url' => $data['url'],
                    'is_featured' => $data['is_featured'],
                    'active' => $data['active'],
                ],
            );

            if (! empty($data['tools'])) {
                $toolIds = collect($data['tools'])
                    ->map(fn (string $name) => Tools::query()->firstOrCreate(
                        ['name' => $name],
                        ['active' => true],
                    ))
                    ->mapWithKeys(fn (Tools $tool) => [
                        $tool->id => ['active' => true, 'created_by' => 1],
                    ])
                    ->all();

                $project->tools()->sync($toolIds);
            }

            if (! empty($data['images'])) {
                foreach ($data['images'] as $image) {
                    ProjectImage::query()->updateOrCreate(
                        ['project_id' => $project->id, 'image' => $image['image']],
                        ['description' => $image['description'] ?? null, 'active' => true],
                    );
                }
            }
        }
    }
}
