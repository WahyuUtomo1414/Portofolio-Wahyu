<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->categories() as $category) {
            Category::query()->updateOrCreate(
                ['name' => $category['name']],
                $category + ['active' => true],
            );
        }
    }

    private function categories(): array
    {
        return [
            ['name' => 'Web Development', 'desc' => 'Project website, dashboard, CMS, dan aplikasi bisnis berbasis web.', 'type' => 'project'],
            ['name' => 'Enterprise App', 'desc' => 'Project sistem internal, ERP, dan aplikasi operasional perusahaan.', 'type' => 'project'],
            ['name' => 'Mobile App', 'desc' => 'Project aplikasi mobile dan integrasi API backend.', 'type' => 'project'],
        ];
    }
}
