<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan Halaman Utama Portofolio (Home Page).
     *
     * Data disiapkan secara terstruktur dari controller tanpa melakukan query database
     * sesuai dengan pedoman docs/arsitektur.md.
     */
    public function index(): View
    {
        $profile = [
            'name' => 'Wahyu Dwi Utomo',
            'role' => 'Senior Fullstack Web Developer',
            'availability_badge' => '● TERSEDIA UNTUK FREELANCE & FULL-TIME',
            'tagline' => 'Building Scalable Fullstack Web Applications!',
            'bio' => 'Mengembangkan aplikasi web modern dari arsitektur backend Laravel yang kokoh hingga antarmuka pengguna frontend yang responsif, cepat, dan intuitif.',
            'email' => 'wahyudwiutomo1414@gmail.com',
            'no_wa' => '+62 812-3456-7890',
            'location' => 'Jakarta / Bekasi, Indonesia',
            'cv_url' => asset('files/cv-wahyu-dwi-utomo.pdf'),
            'image_profile' => asset('images/profile/wahyu.png'),
            'social_media' => [
                'github' => 'https://github.com/WahyuUtomo1414',
                'linkedin' => 'https://linkedin.com/in/wahyu-dwi-utomo',
                'instagram' => 'https://instagram.com/wahyudwi',
            ],
        ];

        $stats = [
            [
                'number' => '5+',
                'label' => 'TAHUN PENGALAMAN',
                'desc' => 'Spesialis Laravel & Web Development',
            ],
            [
                'number' => '20+',
                'label' => 'PROJECT SELESAI',
                'desc' => 'Enterprise, SaaS, & Web Apps',
            ],
            [
                'number' => '10+',
                'label' => 'MITRA & CLIENT',
                'desc' => 'Perusahaan & Klien Freelance',
            ],
            [
                'number' => '100%',
                'label' => 'KOMITMEN KUALITAS',
                'desc' => 'Kode Bersih & Tepat Waktu',
            ],
        ];

        $skills = [
            ['name' => 'Laravel 13', 'category' => 'Backend'],
            ['name' => 'Vue.js 3', 'category' => 'Frontend'],
            ['name' => 'Tailwind CSS v4', 'category' => 'Styling'],
            ['name' => 'Flutter', 'category' => 'Mobile'],
            ['name' => 'MySQL / PostgreSQL', 'category' => 'Database'],
            ['name' => 'Docker', 'category' => 'DevOps'],
            ['name' => 'RESTful API', 'category' => 'Architecture'],
            ['name' => 'Git & GitHub', 'category' => 'VCS'],
        ];

        $featured_projects = [
            [
                'id' => 1,
                'name' => 'Keysoft ERP Enterprise System',
                'slug' => 'keysoft-erp-enterprise-system',
                'category' => 'Enterprise Web App',
                'client' => 'PT Keysoft ERP Indonesia',
                'thumbnail_url' => asset('images/projects/project-erp.jpg'),
                'short_description' => 'Sistem ERP manufaktur dan akuntansi terintegrasi untuk mengelola inventaris, pembelian, dan keuangan secara realtime.',
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
                'client' => 'Universitas BSI',
                'thumbnail_url' => asset('images/projects/project-lms.jpg'),
                'short_description' => 'Platform pembelajaran online interaktif dilengkapi ujian online otomatis, manajemen materi video, dan sertifikat digital.',
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
                'client' => 'AgroSupply Co.',
                'thumbnail_url' => asset('images/projects/project-pos.jpg'),
                'short_description' => 'Aplikasi kasir multi-cabang dan manajemen rantai pasok dengan sinkronisasi data offline-to-online.',
                'tech_stack' => ['Flutter', 'Laravel REST API', 'PostgreSQL'],
                'demo_url' => 'https://pos.wahyu.dev',
                'github_url' => 'https://github.com/WahyuUtomo1414/agrosupply-pos',
                'is_featured' => true,
            ],
        ];

        $experiences = [
            [
                'key' => 'experience',
                'title' => 'Senior Fullstack Web Developer',
                'institute' => 'Keysoft ERP Indonesia',
                'date_range' => '2025 - Sekarang',
                'description' => 'Memimpin pengembangan modul utama sistem ERP enterprise, merancang arsitektur database, dan mengoptimalkan performa API backend.',
                'icon' => 'code-bracket',
            ],
            [
                'key' => 'experience',
                'title' => 'Fullstack Developer Freelance',
                'institute' => 'Independent / Project-Based',
                'date_range' => '2022 - 2025',
                'description' => 'Membangun 15+ aplikasi web & mobile untuk berbagai bisnis lokal dan startup, mulai dari e-commerce, CRM, hingga sistem manajemen.',
                'icon' => 'briefcase',
            ],
            [
                'key' => 'organization',
                'title' => 'Koordinator Komite Teknologi & Informasi',
                'institute' => 'HIMSI Universitas BSI',
                'date_range' => '2023 - 2025',
                'description' => 'Mengelola infrastruktur situs web organisasi dan menyelenggarakan workshop pemrograman web untuk 200+ mahasiswa.',
                'icon' => 'user-group',
            ],
            [
                'key' => 'education',
                'title' => 'Sarjana Komputer (S.Kom) - Sistem Informasi',
                'institute' => 'Universitas BSI',
                'date_range' => '2021 - 2025',
                'description' => 'Lulus dengan predikat Cumlaude. Fokus studi pada Rekayasa Perangkat Lunak, Arsitektur Sistem Informasi, dan Database.',
                'icon' => 'academic-cap',
            ],
        ];

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
            'featured_projects',
            'experiences',
            'values'
        ));
    }
}
