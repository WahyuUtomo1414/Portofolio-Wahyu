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

            $category = Category::withTrashed()->updateOrCreate(
                ['name' => $data['category']],
                ['active' => true, 'type' => 'project', 'deleted_at' => null],
            );

            $client = Client::withTrashed()->updateOrCreate(
                ['name' => $data['client']],
                ['active' => true, 'deleted_at' => null],
            );

            $project = Project::withTrashed()->updateOrCreate(
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
                    'deleted_at' => null,
                ],
            );

            if (! empty($data['tools'])) {
                $toolIds = collect($data['tools'])
                    ->map(fn (string $name) => Tools::withTrashed()->updateOrCreate(
                        ['name' => $name],
                        ['active' => true, 'deleted_at' => null],
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
