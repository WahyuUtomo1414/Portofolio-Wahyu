<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
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
    }
}
