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
                ],
                'description' => 'Software engineer yang fokus membangun aplikasi web, backend API, dashboard admin, hingga mobile dengan penekanan pada arsitektur bersih dan pengalaman pengguna yang solid.',
                'image_profile' => 'https://picsum.photos/seed/wahyu-profile/900/900',
                'tagline' => 'Membangun produk digital yang scalable.',
                'address' => 'Jakarta, Indonesia',
                'active' => true,
            ],
        );
    }
}
