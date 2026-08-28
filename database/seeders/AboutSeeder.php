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
                'no_wa' => '6285891514812',
                'sosial_media' => [
                    'github' => 'https://github.com/WahyuUtomo1414',
                    'linkedin' => 'https://www.linkedin.com/in/wahyutomo/',
                    'instagram' => 'https://www.instagram.com/waahyutomo/',
                ],
                'description' => 'Fullstack web developer yang fokus membangun aplikasi Laravel, dashboard admin, API, dan frontend yang rapi untuk kebutuhan bisnis.',
                'image_profile' => 'https://picsum.photos/seed/wahyu-profile/900/900',
                'tagline' => 'Building scalable fullstack web applications.',
                'address' => 'Jakarta, Indonesia',
                'active' => true,
            ],
        );
    }
}
