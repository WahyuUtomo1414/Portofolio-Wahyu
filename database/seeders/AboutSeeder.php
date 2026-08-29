<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::query()->updateOrCreate(
            ['name' => 'Wahyu Dwi Utomo'],
            [
                'email' => 'wahyuxd14@gmail.com',
                'no_wa' => '6285891514812',
                'sosial_media' => [
                    'github' => 'https://github.com/WahyuUtomo1414',
                    'linkedin' => 'https://www.linkedin.com/in/wahyutomo/',
                    'instagram' => 'https://www.instagram.com/waahyutomo/',
                    'cv' => '#',
                ],
                'description' => 'Software engineer yang fokus membangun produk digital yang rapi, scalable, mudah dirawat, dan nyaman digunakan.',
                'image_profile' => 'https://picsum.photos/seed/wahyu-profile/900/900',
                'tagline' => 'Membangun produk digital yang scalable.',
                'address' => 'Jakarta, Indonesia',
                'active' => true,
            ],
        );
    }
}
