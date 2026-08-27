<?php

namespace App\Support;

use Illuminate\Support\Collection;

class PortfolioData
{
    public static function profile(): array
    {
        return [
            'name' => 'Wahyu Dwi Utomo',
            'role' => 'Senior Fullstack Web Developer',
            'bio' => 'Mengembangkan aplikasi web modern dari arsitektur backend Laravel yang kokoh hingga antarmuka pengguna frontend yang responsif, cepat, dan intuitif.',
            'email' => 'wahyudwiutomo1414@gmail.com',
            'no_wa' => '+62 812-3456-7890',
            'location' => 'Bekasi / Jakarta, Indonesia',
            'address' => 'Bekasi / Jakarta, Indonesia',
            'image_profile' => asset('images/profile/wahyu.png'),
            'cv_url' => asset('files/cv-wahyu-dwi-utomo.pdf'),
            'social_media' => [
                'github' => 'https://github.com/WahyuUtomo1414',
                'linkedin' => 'https://linkedin.com/in/wahyu-dwi-utomo',
                'instagram' => 'https://instagram.com/wahyudwi',
                'whatsapp' => 'https://wa.me/6281234567890',
            ],
        ];
    }

    public static function projects(): Collection
    {
        return collect([
            [
                'id' => 1,
                'name' => 'Keysoft ERP Enterprise System',
                'slug' => 'keysoft-erp-enterprise-system',
                'category' => 'Enterprise Web App',
                'client_name' => 'PT Keysoft ERP Indonesia',
                'client_logo' => 'images/clients/keysoft.png',
                'thumbnail_url' => asset('images/projects/project-erp.jpg'),
                'short_description' => 'Sistem ERP manufaktur dan akuntansi terintegrasi untuk mengelola inventaris, pembelian, dan keuangan secara realtime.',
                'body' => 'Sistem ERP berkonsep enterprise berbasis web yang dikembangkan menggunakan Laravel dan Vue.js. Dilengkapi kontrol akses peran, laporan audit trail, dan optimasi performa query untuk kebutuhan operasional bisnis.',
                'tech_stack' => ['Laravel', 'Vue.js', 'SQL Server', 'Tailwind CSS'],
                'demo_url' => 'https://demo-erp.wahyu.dev',
                'github_url' => 'https://github.com/WahyuUtomo1414/keysoft-erp',
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'name' => 'Smart Edu Portal & Learning LMS',
                'slug' => 'smart-edu-portal-lms',
                'category' => 'Education SaaS',
                'client_name' => 'Universitas BSI',
                'client_logo' => 'images/clients/ubsi.png',
                'thumbnail_url' => asset('images/projects/project-lms.jpg'),
                'short_description' => 'Platform pembelajaran online interaktif dilengkapi ujian online otomatis, manajemen materi, dan sertifikat digital.',
                'body' => 'LMS interaktif untuk mengelola materi, kelas, ujian, diskusi, dan laporan perkembangan belajar. Fokus utama project ini adalah pengalaman pengguna yang ringkas dan panel pengelolaan yang mudah dipakai.',
                'tech_stack' => ['Laravel', 'Livewire', 'MySQL', 'Alpine.js'],
                'demo_url' => 'https://lms.wahyu.dev',
                'github_url' => 'https://github.com/WahyuUtomo1414/smart-edu-lms',
                'is_featured' => true,
            ],
            [
                'id' => 3,
                'name' => 'AgroSupply Distribution & POS App',
                'slug' => 'agrosupply-distribution-pos',
                'category' => 'Mobile & Web POS',
                'client_name' => 'AgroSupply Co.',
                'client_logo' => 'images/clients/agrosupply.png',
                'thumbnail_url' => asset('images/projects/project-pos.jpg'),
                'short_description' => 'Aplikasi kasir multi-cabang dan manajemen rantai pasok dengan sinkronisasi data offline-to-online.',
                'body' => 'Aplikasi POS multi-platform memakai Flutter dan REST API Laravel. Sistem dirancang agar transaksi tetap bisa dicatat saat koneksi tidak stabil, lalu disinkronkan kembali saat online.',
                'tech_stack' => ['Flutter', 'Laravel REST API', 'PostgreSQL'],
                'demo_url' => 'https://pos.wahyu.dev',
                'github_url' => 'https://github.com/WahyuUtomo1414/agrosupply-pos',
                'is_featured' => true,
            ],
            [
                'id' => 4,
                'name' => 'Personal Portfolio Admin CMS',
                'slug' => 'personal-portfolio-admin-cms',
                'category' => 'Portfolio CMS',
                'client_name' => 'Personal Project',
                'client_logo' => null,
                'thumbnail_url' => asset('images/projects/project-portfolio.jpg'),
                'short_description' => 'Website portofolio pribadi dengan admin Filament untuk mengelola profil, journey, project, client, dan tools.',
                'body' => 'Sistem portofolio berbasis Laravel dengan struktur database domain, resource Filament, dan frontend Blade mobile-first. Project ini disiapkan agar konten bisa tumbuh dari data statis ke database.',
                'tech_stack' => ['Laravel 13', 'Filament 5', 'Blade', 'Tailwind CSS'],
                'demo_url' => null,
                'github_url' => null,
                'is_featured' => false,
            ],
        ]);
    }

    public static function projectBySlug(string $slug): ?array
    {
        return static::projects()
            ->firstWhere('slug', $slug);
    }

    public static function projectCategories(): array
    {
        return static::projects()
            ->pluck('category')
            ->unique()
            ->values()
            ->all();
    }
}
