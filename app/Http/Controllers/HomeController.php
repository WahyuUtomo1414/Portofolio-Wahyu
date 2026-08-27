<?php

namespace App\Http\Controllers;

use App\Support\PortfolioData;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan Halaman Utama Portofolio (Home Page).
     *
     * Data disiapkan secara terstruktur sesuai skema database di docs/database.md.
     */
    public function index(): View
    {
        // 1. Data About (Sesuai Skema Tabel `about` di docs/database.md)
        $profile = [
            'name' => 'Wahyu Dwi Utomo',
            'role' => 'Senior Fullstack Web Developer',
            'availability_badge' => '● TERSEDIA UNTUK FREELANCE & FULL-TIME',
            'tagline' => 'Building Scalable Fullstack Web Applications!',
            'bio' => 'Mengembangkan aplikasi web modern dari arsitektur backend Laravel yang kokoh hingga antarmuka pengguna frontend yang responsif, cepat, dan intuitif.',
            'description' => 'Mengembangkan aplikasi web modern dari arsitektur backend Laravel yang kokoh hingga antarmuka pengguna frontend yang responsif, cepat, dan intuitif.',
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
        $profile = array_replace($profile, PortfolioData::profile());

        // 2. Data Stats (Pencapaian Ringkas dalam Section Terpisah)
        $stats = [
            [
                'number' => '5+',
                'label' => 'TAHUN PENGALAMAN',
                'desc' => 'Spesialis Laravel & Web Development',
                'icon' => 'code',
            ],
            [
                'number' => '20+',
                'label' => 'PROJECT SELESAI',
                'desc' => 'Enterprise, SaaS, & Web Apps',
                'icon' => 'folder-check',
            ],
            [
                'number' => '10+',
                'label' => 'MITRA & CLIENT',
                'desc' => 'Perusahaan & Klien Freelance',
                'icon' => 'users',
            ],
            [
                'number' => '100%',
                'label' => 'KOMITMEN KUALITAS',
                'desc' => 'Kode Bersih & Tepat Waktu',
                'icon' => 'shield-check',
            ],
        ];

        // 3. Data Tools / Skills (Sesuai Skema Tabel `tools` di docs/database.md)
        $skills = [
            ['id' => 1, 'name' => 'Laravel 13', 'category' => 'Backend', 'logo' => 'images/tools/laravel.svg', 'desc' => 'PHP Framework'],
            ['id' => 2, 'name' => 'Vue.js 3', 'category' => 'Frontend', 'logo' => 'images/tools/vue.svg', 'desc' => 'JS Framework'],
            ['id' => 3, 'name' => 'Tailwind CSS v4', 'category' => 'Styling', 'logo' => 'images/tools/tailwind.svg', 'desc' => 'Utility CSS'],
            ['id' => 4, 'name' => 'Flutter', 'category' => 'Mobile', 'logo' => 'images/tools/flutter.svg', 'desc' => 'Cross-Platform'],
            ['id' => 5, 'name' => 'MySQL / PostgreSQL', 'category' => 'Database', 'logo' => 'images/tools/mysql.svg', 'desc' => 'RDBMS'],
            ['id' => 6, 'name' => 'Docker', 'category' => 'DevOps', 'logo' => 'images/tools/docker.svg', 'desc' => 'Container'],
            ['id' => 7, 'name' => 'RESTful API', 'category' => 'Architecture', 'logo' => 'images/tools/api.svg', 'desc' => 'API Design'],
            ['id' => 8, 'name' => 'Git & GitHub', 'category' => 'VCS', 'logo' => 'images/tools/git.svg', 'desc' => 'Version Control'],
        ];

        // 4. Data Clients (Simulasi > 4 Client untuk mengaktifkan Running Marquee Slider Ticker)
        $clients = [
            [
                'id' => 1,
                'name' => 'PT Keysoft ERP Indonesia',
                'logo' => 'images/clients/keysoft.png',
                'desc' => 'Enterprise ERP Provider',
            ],
            [
                'id' => 2,
                'name' => 'Universitas BSI',
                'logo' => 'images/clients/ubsi.png',
                'desc' => 'Perguruan Tinggi Bina Sarana Informatika',
            ],
            [
                'id' => 3,
                'name' => 'AgroSupply Co.',
                'logo' => 'images/clients/agrosupply.png',
                'desc' => 'Supply Chain Tech & Distribution',
            ],
            [
                'id' => 4,
                'name' => 'EduTech Learning Center',
                'logo' => 'images/clients/edutech.png',
                'desc' => 'SaaS E-Learning & Digital Campus',
            ],
            [
                'id' => 5,
                'name' => 'Fintech Solution Tech',
                'logo' => 'images/clients/fintech.png',
                'desc' => 'Digital Payment & Banking',
            ],
            [
                'id' => 6,
                'name' => 'Logistics Express App',
                'logo' => 'images/clients/logistics.png',
                'desc' => 'Freight & Courier Management',
            ],
            [
                'id' => 7,
                'name' => 'Healthcare Medical Portal',
                'logo' => 'images/clients/health.png',
                'desc' => 'Hospital & Clinic Information System',
            ],
            [
                'id' => 8,
                'name' => 'Retail POS Network',
                'logo' => 'images/clients/retail.png',
                'desc' => 'Omnichannel Retail Store System',
            ],
        ];

        // 5. Data Journey - Education & Experience (Sesuai Skema Tabel `journey` di docs/database.md)
        $education = [
            [
                'id' => 1,
                'key' => 'education',
                'title' => 'Sistem Informasi (S.Kom)',
                'institute' => 'Universitas BSI',
                'description' => 'Lulus Predikat Cumlaude. Fokus studi pada Software Engineering, Database Systems, & System Architecture.',
                'date_range' => '2021 - 2025',
                'logo' => 'images/journey/ubsi.png',
                'sort' => 1,
            ],
            [
                'id' => 2,
                'key' => 'education',
                'title' => 'Teknik Komputer & Jaringan',
                'institute' => 'SMK Negeri Indonesia',
                'description' => 'Mempelajari dasar-dasar pemrograman, jaringan komputer, server Linux, & troubleshooting hardware.',
                'date_range' => '2018 - 2021',
                'logo' => 'images/journey/smk.png',
                'sort' => 2,
            ],
        ];

        $experience = [
            [
                'id' => 1,
                'key' => 'experience',
                'title' => 'Senior Fullstack Web Developer',
                'institute' => 'PT Keysoft ERP Indonesia',
                'description' => 'Memimpin pengembangan modul ERP manufaktur & keuangan, optimasi query database SQL Server, dan integrasi API.',
                'date_range' => '2025 - Sekarang',
                'logo' => 'images/journey/keysoft.png',
                'sort' => 1,
            ],
            [
                'id' => 2,
                'key' => 'experience',
                'title' => 'Fullstack Web Developer Freelance',
                'institute' => 'Independent / Project-Based',
                'description' => 'Membangun 15+ sistem web kustom, e-commerce, LMS, dan aplikasi POS untuk UMKM dan perusahaan lokal.',
                'date_range' => '2022 - 2025',
                'logo' => 'images/journey/freelance.png',
                'sort' => 2,
            ],
            [
                'id' => 3,
                'key' => 'organization',
                'title' => 'Koordinator Komite Kominfo',
                'institute' => 'HIMSI Universitas BSI',
                'description' => 'Mengelola portal web organisasi dan mengadakan pelatihan coding web untuk 200+ mahasiswa.',
                'date_range' => '2023 - 2025',
                'logo' => 'images/journey/himsi.png',
                'sort' => 3,
            ],
        ];

        $journey = array_merge($education, $experience);

        // 6. Data Project (Sesuai Skema Tabel `project` & Relasinya di docs/database.md)
        $featured_projects = [
            [
                'id' => 1,
                'name' => 'Keysoft ERP Enterprise System',
                'slug' => 'keysoft-erp-enterprise-system',
                'category' => 'Enterprise Web App',
                'client_name' => 'PT Keysoft ERP Indonesia',
                'client_logo' => 'images/clients/keysoft.png',
                'thumbnail_url' => asset('images/projects/project-erp.jpg'),
                'short_description' => 'Sistem ERP manufaktur dan akuntansi terintegrasi untuk mengelola inventaris, pembelian, dan keuangan secara realtime.',
                'body' => 'Sistem ERP berkonsep enterprise berbasis web yang dikembangkan menggunakan Laravel 13 dan Vue.js. Dilengkapi dengan kontrol akses peran (RBAC), laporan audit trail, dan optimasi performa tinggi.',
                'tech_stack' => ['Laravel 13', 'Vue 3', 'SQL Server', 'Tailwind CSS'],
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
                'short_description' => 'Platform pembelajaran online interaktif dilengkapi ujian online otomatis, manajemen materi video, dan sertifikat digital.',
                'body' => 'LMS interaktif yang mendukung ribuan pengguna aktif bersamaan dengan fitur ujian otomatis, forum diskusi, serta integrasi gateway pembayaran otomatis.',
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
                'body' => 'Aplikasi POS multi-platform menggunakan Flutter di bagian depan dan RESTful API Laravel di bagian belakang untuk menjamin ketersediaan transaksi offline dan sinkronisasi otomatis.',
                'tech_stack' => ['Flutter', 'Laravel REST API', 'PostgreSQL'],
                'demo_url' => 'https://pos.wahyu.dev',
                'github_url' => 'https://github.com/WahyuUtomo1414/agrosupply-pos',
                'is_featured' => true,
            ],
        ];
        $featured_projects = PortfolioData::projects()
            ->where('is_featured', true)
            ->values()
            ->all();

        // 7. Data Values (Nilai Tambah Pengembangan)
        $values = [
            [
                'code' => '⚡',
                'title' => 'CLEAN & MAINTAINABLE CODE',
                'desc' => 'Penulisan kode yang rapi berstandar PSR, terstruktur modular, serta mudah dirawat dan dikembangkan di masa mendatang.',
            ],
            [
                'code' => '🎯',
                'title' => 'RESPONSIVE & ACCESSIBLE',
                'desc' => 'Desain berpola mobile-first yang responsif, cepat diakses dari perangkat apapun, serta memenuhi standar aksesibilitas.',
            ],
            [
                'code' => '🛡️',
                'title' => 'SECURE & SCALABLE',
                'desc' => 'Penerapan praktik keamanan terbaik Laravel, proteksi dari celah umum web, serta arsitektur database yang siap tumbuh.',
            ],
            [
                'code' => '💬',
                'title' => 'TRANSPARENT COMMUNICATION',
                'desc' => 'Proses pengerjaan yang transparan, pembaruan kemajuan berkala, serta komitmen penyelesaian tepat waktu.',
            ],
        ];

        return view('pages.home', compact(
            'profile',
            'stats',
            'skills',
            'clients',
            'education',
            'experience',
            'journey',
            'featured_projects',
            'values'
        ));
    }
}
