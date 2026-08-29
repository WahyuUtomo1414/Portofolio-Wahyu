<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Journey;
use App\Models\Project;
use App\Models\Tools;
use App\Support\PortfolioData;
use App\Support\PublicProfileData;
use App\Support\PublicStorageUrl;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function index(): View
    {
        $profile = PublicProfileData::get();
        $skills = $this->skillsData();
        $clients = $this->clientsData();
        $education = $this->journeyData(['education']);
        $experience = $this->journeyData(['experience']);
        $featuredProjects = $this->featuredProjectData();
        $totalProjects = $this->totalProjects();

        return view('pages.home', [
            'profile' => $profile,
            'footer_profile' => $profile,
            'home_title' => 'Wahyu Dwi Utomo — Software Engineer Fullstack | Portofolio & Studi Kasus Project',
            'home_description' => 'Portofolio Wahyu Dwi Utomo, software engineer Indonesia yang membangun website, backend API, dashboard, aplikasi mobile, dan sistem digital untuk kebutuhan bisnis.',
            'hero' => $this->heroData(),
            'stats' => $this->statsData(),
            'skills' => $skills,
            'clients' => $clients,
            'client_chunks' => array_chunk($clients, 8),
            'education' => $education,
            'experience' => $experience,
            'journey' => array_merge($education, $experience),
            'featured_projects' => $featuredProjects,
            'total_projects' => $totalProjects,
            'values' => $this->valuesData(),
            'sections' => $this->sectionData(),
        ]);
    }

    private function skillsData(): array
    {
        $fallback = [
            ['id' => 1, 'name' => 'Laravel', 'category' => 'Backend', 'logo' => asset('images/tools/laravel.svg'), 'desc' => 'PHP Framework'],
            ['id' => 2, 'name' => 'Vue.js', 'category' => 'Frontend', 'logo' => asset('images/tools/vue.svg'), 'desc' => 'JS Framework'],
            ['id' => 3, 'name' => 'Tailwind CSS', 'category' => 'Styling', 'logo' => asset('images/tools/tailwind.svg'), 'desc' => 'Utility CSS'],
            ['id' => 4, 'name' => 'Flutter', 'category' => 'Mobile', 'logo' => asset('images/tools/flutter.svg'), 'desc' => 'Cross-Platform'],
            ['id' => 5, 'name' => 'MySQL / PostgreSQL', 'category' => 'Database', 'logo' => asset('images/tools/mysql.svg'), 'desc' => 'RDBMS'],
            ['id' => 6, 'name' => 'Docker', 'category' => 'DevOps', 'logo' => asset('images/tools/docker.svg'), 'desc' => 'Container'],
            ['id' => 7, 'name' => 'RESTful API', 'category' => 'Architecture', 'logo' => asset('images/tools/api.svg'), 'desc' => 'API Design'],
            ['id' => 8, 'name' => 'Git & GitHub', 'category' => 'VCS', 'logo' => asset('images/tools/git.svg'), 'desc' => 'Version Control'],
        ];

        if (! $this->tableExists('tools')) {
            return $fallback;
        }

        $tools = Tools::query()
            ->where('active', true)
            ->latest()
            ->get();

        return $tools->isEmpty()
            ? $fallback
            : $tools->map(fn (Tools $tool): array => $this->toolData($tool))->all();
    }

    private function clientsData(): array
    {
        $fallback = [
            ['id' => 1, 'name' => 'PT Keysoft ERP Indonesia', 'logo' => asset('images/clients/keysoft.png'), 'desc' => 'Enterprise ERP Provider'],
            ['id' => 2, 'name' => 'Universitas BSI', 'logo' => asset('images/clients/ubsi.png'), 'desc' => 'Perguruan Tinggi Bina Sarana Informatika'],
            ['id' => 3, 'name' => 'AgroSupply Co.', 'logo' => asset('images/clients/agrosupply.png'), 'desc' => 'Supply Chain Tech & Distribution'],
            ['id' => 4, 'name' => 'EduTech Learning Center', 'logo' => asset('images/clients/edutech.png'), 'desc' => 'SaaS E-Learning & Kampus Digital'],
            ['id' => 5, 'name' => 'Fintech Solution Tech', 'logo' => asset('images/clients/fintech.png'), 'desc' => 'Digital Payment & Banking'],
            ['id' => 6, 'name' => 'Logistics Express App', 'logo' => asset('images/clients/logistics.png'), 'desc' => 'Freight & Courier Management'],
            ['id' => 7, 'name' => 'Healthcare Medical Portal', 'logo' => asset('images/clients/health.png'), 'desc' => 'Sistem Informasi Rumah Sakit & Klinik'],
            ['id' => 8, 'name' => 'Retail POS Network', 'logo' => asset('images/clients/retail.png'), 'desc' => 'Omnichannel Retail Store System'],
            ['id' => 9, 'name' => 'Pesona Media Creative', 'logo' => asset('images/clients/pesona.png'), 'desc' => 'Digital Agency & Branding'],
            ['id' => 10, 'name' => 'PT Arta Maju Sentosa', 'logo' => asset('images/clients/arta.png'), 'desc' => 'General Trading & Supplier'],
            ['id' => 11, 'name' => 'SMA Negeri Jakarta', 'logo' => asset('images/clients/sman.png'), 'desc' => 'Instansi Pendidikan Negeri'],
            ['id' => 12, 'name' => 'Arthur Teknik Indonesia', 'logo' => asset('images/clients/arthur.png'), 'desc' => 'Engineering & Generator Service'],
            ['id' => 13, 'name' => 'GrowthDigital Marketing', 'logo' => asset('images/clients/growth.png'), 'desc' => 'Performance Growth Partner'],
            ['id' => 14, 'name' => 'PT Charlyn Jaya', 'logo' => asset('images/clients/charlyn.png'), 'desc' => 'Industrial Equipment & Parts'],
            ['id' => 15, 'name' => 'HIMSI BSI Official', 'logo' => asset('images/clients/himsi.png'), 'desc' => 'Himpunan Mahasiswa Sistem Informasi'],
            ['id' => 16, 'name' => 'Dinas Pertamanan & Hutan Kota', 'logo' => asset('images/clients/dinas.png'), 'desc' => 'Instansi Pemerintah Daerah'],
        ];

        if (! $this->tableExists('client')) {
            return $fallback;
        }

        $clients = Client::query()
            ->where('active', true)
            ->latest()
            ->get();

        return $clients->isEmpty()
            ? $fallback
            : $clients->map(fn (Client $client): array => $this->clientData($client))->all();
    }

    private function journeyData(array $keys): array
    {
        if (! $this->tableExists('journey')) {
            return $this->fallbackJourneyData($keys);
        }

        $journey = Journey::query()
            ->where('active', true)
            ->whereIn('key', $keys)
            ->orderBy('sort', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return $journey->isEmpty()
            ? $this->fallbackJourneyData($keys)
            : $journey->map(fn (Journey $item): array => $this->journeyItemData($item))->all();
    }

    private function featuredProjectData(): array
    {
        if (! $this->projectTablesReady()) {
            return PortfolioData::projects()
                ->where('is_featured', true)
                ->map(fn (array $project): array => $this->fallbackProjectData($project))
                ->values()
                ->all();
        }

        $projects = Project::query()
            ->with(['category', 'client', 'tools'])
            ->where('active', true)
            ->where('is_featured', true)
            ->latest()
            ->limit(6)
            ->get();

        return $projects->isEmpty()
            ? PortfolioData::projects()
                ->where('is_featured', true)
                ->map(fn (array $project): array => $this->fallbackProjectData($project))
                ->values()
                ->all()
            : $this->projectCollectionData($projects);
    }

    private function statsData(): array
    {
        $stats = [
            ['number' => '3+', 'label' => 'TAHUN PENGALAMAN', 'desc' => 'Pengalaman sejak 2023 di berbagai stack dan industri', 'icon' => 'code'],
            ['number' => '20+', 'label' => 'PROJECT SELESAI', 'desc' => 'Project kuliah, freelance, joki, dan pekerjaan profesional', 'icon' => 'folder-check'],
            ['number' => '10+', 'label' => 'MITRA & CLIENT', 'desc' => 'Bisnis, organisasi, instansi, dan klien personal', 'icon' => 'users'],
            ['number' => '100%', 'label' => 'FOKUS KUALITAS', 'desc' => 'Kode bersih, komunikasi jelas, dan hasil siap digunakan', 'icon' => 'shield-check'],
        ];

        return collect($stats)
            ->map(fn (array $stat): array => array_replace($stat, $this->counterData($stat['number'])))
            ->all();
    }

    private function valuesData(): array
    {
        return [
            ['code' => '⚡', 'title' => 'KODE BERSIH & TERSTRUKTUR', 'desc' => 'Penulisan kode yang rapi berstandar PSR, terstruktur modular, serta mudah dirawat dan dikembangkan di masa mendatang.'],
            ['code' => '🎯', 'title' => 'RESPONSIF & CEPAT DIAKSES', 'desc' => 'Desain berpola mobile-first yang responsif, cepat diakses dari perangkat apapun, serta memenuhi standar aksesibilitas.'],
            ['code' => '🛡️', 'title' => 'AMAN & SIAP TUMBUH', 'desc' => 'Penerapan praktik keamanan terbaik, proteksi dari celah umum web, serta arsitektur database yang siap tumbuh.'],
            ['code' => '💬', 'title' => 'KOMUNIKASI TRANSPARAN', 'desc' => 'Proses pengerjaan yang transparan, pembaruan kemajuan berkala, serta komitmen penyelesaian tepat waktu.'],
        ];
    }

    private function heroData(): array
    {
        return [
            'subtitle' => 'Membangun sistem digital dari backend, web, hingga mobile dengan arsitektur bersih dan pengalaman pengguna yang solid.',
            'rotator_words' => ['SOLUSI DIGITAL_', 'WEB & MOBILE_', 'SISTEM SCALABLE_', 'CLEAN ARCHITECTURE_'],
            'rotator_json' => json_encode(['SOLUSI DIGITAL_', 'WEB & MOBILE_', 'SISTEM SCALABLE_', 'CLEAN ARCHITECTURE_'], JSON_THROW_ON_ERROR),
            'badges' => [
                ['theme' => 'white-blue', 'icon' => '⚡', 'label' => 'Kode Bersih'],
                ['theme' => 'blue-white', 'icon' => '🔥', 'label' => 'Scalable'],
                ['theme' => 'yellow', 'icon' => '⭐', 'label' => 'Fokus Kualitas'],
                ['theme' => 'green', 'icon' => '🎯', 'label' => '3+ Thn Exp'],
            ],
            'profile_label' => 'PROFIL DEVELOPER',
            'status_label' => 'AVAILABLE',
            'skill_chip' => 'Software Engineer',
        ];
    }

    private function sectionData(): array
    {
        return [
            'about' => [
                'number' => '01',
                'tag' => 'TENTANG SAYA & KEUNGGULAN',
                'title' => 'FILOSOFI & KEUNGGULAN KERJA',
                'subtitle' => 'Prinsip utama yang saya terapkan saat membangun kode, arsitektur sistem, dan pengalaman pengguna.',
                'chips' => ['Kode Bersih', 'Arsitektur Bersih', 'Performa Tinggi'],
            ],
            'experience' => [
                'number' => '02',
                'tag' => 'RIWAYAT KARIER & PENDIDIKAN',
                'title' => 'PERJALANAN PENDIDIKAN & KARIER',
                'subtitle' => 'Jejak pendidikan dan pengalaman kerja profesional di bidang pengembangan perangkat lunak.',
            ],
            'clients' => [
                'number' => '03',
                'tag' => 'MITRA & CLIENT',
                'title' => 'DIPERCAYA BERBAGAI BISNIS DAN INSTITUSI',
                'subtitle' => 'Pengalaman membangun website, backend API, sistem internal, dan aplikasi digital untuk berbagai kebutuhan.',
            ],
            'projects' => [
                'number' => '04',
                'tag' => 'KATALOG PROJECT',
                'title' => 'PROJECT PILIHAN & KARYA TERBARU',
                'subtitle' => 'Koleksi studi kasus, sistem web, dashboard, aplikasi mobile, dan solusi digital yang pernah dikembangkan.',
            ],
            'contact' => [
                'number' => '05',
                'tag' => 'HUBUNGI SAYA',
                'title' => 'MARI DISKUSIKAN PROJECT BERIKUTNYA',
                'subtitle' => 'Punya ide project menarik, butuh developer, atau ingin berkonsultasi teknis? Silakan hubungi saya.',
            ],
        ];
    }

    private function fallbackJourneyData(array $keys): array
    {
        $items = [
            ['id' => 1, 'key' => 'education', 'title' => 'Sistem Informasi (S.Kom)', 'institute' => 'Universitas BSI', 'description' => 'Lulus dengan IPK 3.6. Fokus studi pada software engineering, database, dan arsitektur sistem.', 'date_range' => '2021 - 2025', 'logo' => asset('images/journey/ubsi.png'), 'sort' => 1],
            ['id' => 2, 'key' => 'education', 'title' => 'MSIB Batch 6', 'institute' => 'Startup Campus', 'description' => 'Fokus pada software engineering, database, analisis sistem, dan pengembangan aplikasi web.', 'date_range' => 'Feb 2024 - Juni 2024', 'logo' => asset('images/journey/startup.png'), 'sort' => 2],
            ['id' => 3, 'key' => 'education', 'title' => 'Teknik Komputer & Jaringan', 'institute' => 'SMK Negeri Indonesia', 'description' => 'Mempelajari dasar-dasar pemrograman, jaringan komputer, server Linux, & troubleshooting hardware.', 'date_range' => '2018 - 2021', 'logo' => asset('images/journey/smk.png'), 'sort' => 3],
            ['id' => 4, 'key' => 'experience', 'title' => 'Senior Fullstack Web Developer', 'institute' => 'PT Keysoft ERP Indonesia', 'description' => 'Memimpin pengembangan modul ERP manufaktur & keuangan, optimasi query database SQL Server, dan integrasi API.', 'date_range' => '2025 - Sekarang', 'logo' => asset('images/journey/keysoft.png'), 'sort' => 1],
            ['id' => 5, 'key' => 'experience', 'title' => 'Fullstack Developer', 'institute' => 'PT Pesona Trip Travel Indonesia', 'description' => 'Mengembangkan aplikasi travel booking, manajemen sistem, REST API, dan integrasi payment gateway.', 'date_range' => 'Sept 2024 - Jan 2025', 'logo' => asset('images/journey/pesona.png'), 'sort' => 2],
            ['id' => 6, 'key' => 'experience', 'title' => 'Fullstack Developer', 'institute' => 'PT Jasanya Teknologi Indonesia', 'description' => 'Mengembangkan modul ERP, REST API, dashboard operasional, dan integrasi sistem internal.', 'date_range' => '2023 - Present', 'logo' => asset('images/journey/jasanya.png'), 'sort' => 3],
            ['id' => 7, 'key' => 'experience', 'title' => 'Koordinator Komite Kominfo', 'institute' => 'HIMSI Universitas BSI', 'description' => 'Mengelola portal web organisasi dan mengadakan pelatihan coding web untuk 200+ mahasiswa.', 'date_range' => '2023 - 2025', 'logo' => asset('images/journey/himsi.png'), 'sort' => 4],
        ];

        return collect($items)
            ->whereIn('key', $keys)
            ->sortBy('sort')
            ->values()
            ->all();
    }

    private function projectCollectionData(EloquentCollection $projects): array
    {
        return $projects->map(fn (Project $project): array => $this->projectData($project))->all();
    }

    private function projectData(Project $project): array
    {
        return [
            'id' => $project->id,
            'name' => $project->name,
            'slug' => $project->slug,
            'category' => $project->category?->name ?? 'Web App',
            'client_name' => $project->client?->name ?? 'Personal Project',
            'client_logo' => $this->imageUrl($project->client?->logo),
            'thumbnail_url' => $this->imageUrl($project->thumbnail),
            'short_description' => str(strip_tags($project->body))->limit(160)->toString(),
            'body' => strip_tags($project->body),
            'tech_stack' => $project->tools->pluck('name')->all(),
            'demo_url' => $project->url,
            'github_url' => null,
            'detail_url' => route('projects.show', $project->slug),
            'is_featured' => $project->is_featured,
        ];
    }

    private function fallbackProjectData(array $project): array
    {
        return [
            'id' => $project['id'],
            'name' => $project['name'],
            'slug' => $project['slug'],
            'category' => $project['category'],
            'client_name' => $project['client_name'] ?? 'Personal Project',
            'client_logo' => $this->imageUrl($project['client_logo'] ?? null),
            'thumbnail_url' => $this->imageUrl($project['thumbnail_url'] ?? null),
            'short_description' => $project['short_description'],
            'body' => $project['body'],
            'tech_stack' => $project['tech_stack'],
            'demo_url' => $project['demo_url'] ?? null,
            'github_url' => $project['github_url'] ?? null,
            'detail_url' => route('projects.show', $project['slug']),
            'is_featured' => $project['is_featured'],
        ];
    }

    private function toolData(Tools $tool): array
    {
        return [
            'id' => $tool->id,
            'name' => $tool->name,
            'category' => 'Tools',
            'logo' => $this->imageUrl($tool->logo),
            'desc' => $tool->desc,
        ];
    }

    private function clientData(Client $client): array
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'logo' => $this->imageUrl($client->logo),
            'desc' => $client->desc,
        ];
    }

    private function journeyItemData(Journey $journey): array
    {
        return [
            'id' => $journey->id,
            'key' => $journey->key,
            'title' => $journey->title,
            'institute' => $journey->institute,
            'description' => $journey->description,
            'date_range' => $journey->date_range,
            'logo' => $this->imageUrl($journey->logo),
            'sort' => $journey->sort,
        ];
    }

    private function counterData(string $number): array
    {
        preg_match('/^(\d+)(.*)$/', $number, $matches);

        return [
            'target_number' => isset($matches[1]) ? (int) $matches[1] : 0,
            'suffix' => $matches[2] ?? '',
        ];
    }

    private function totalProjects(): int
    {
        if (! $this->projectTablesReady()) {
            return PortfolioData::projects()->count();
        }

        return Project::query()
            ->where('active', true)
            ->count();
    }

    private function projectTablesReady(): bool
    {
        return $this->tableExists('project')
            && $this->tableExists('category')
            && $this->tableExists('client')
            && $this->tableExists('tools')
            && $this->tableExists('project_tool');
    }

    private function tableExists(string $table): bool
    {
        try {
            return Schema::hasTable($table);
        } catch (Throwable) {
            return false;
        }
    }

    private function imageUrl(?string $path, ?string $fallback = null): ?string
    {
        return PublicStorageUrl::image($path, $fallback);
    }
}
