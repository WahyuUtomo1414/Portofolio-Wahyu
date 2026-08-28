<?php

namespace Database\Seeders;

use App\Models\Tools;
use Illuminate\Database\Seeder;

class ToolsSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->tools() as $tool) {
            Tools::query()->updateOrCreate(
                ['name' => $tool['name']],
                $tool + ['active' => true],
            );
        }
    }

    private function tools(): array
    {
        return [
            ['name' => 'Laravel', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg', 'desc' => 'PHP framework untuk backend dan aplikasi web.'],
            ['name' => 'Filament', 'logo' => 'https://picsum.photos/seed/tool-filament/240/240', 'desc' => 'Admin panel berbasis Laravel.'],
            ['name' => 'Tailwind CSS', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg', 'desc' => 'Utility-first CSS framework.'],
            ['name' => 'Vue.js', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'desc' => 'Frontend framework untuk interface interaktif.'],
            ['name' => 'Flutter', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg', 'desc' => 'Framework mobile cross-platform.'],
            ['name' => 'PostgreSQL', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg', 'desc' => 'Relational database untuk aplikasi production.'],
            ['name' => 'SQL Server', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/microsoftsqlserver/microsoftsqlserver-original.svg', 'desc' => 'Relational database untuk sistem enterprise dan reporting operasional.'],
            ['name' => 'MySQL', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg', 'desc' => 'Relational database untuk aplikasi web dan sistem bisnis.'],
            ['name' => 'Golang', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/go/go-original.svg', 'desc' => 'Bahasa pemrograman untuk service backend, API, dan sistem performa tinggi.'],
            ['name' => 'Firebase', 'logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-original.svg', 'desc' => 'Platform backend-as-a-service untuk autentikasi, database realtime, dan push notification.'],
        ];
    }
}
