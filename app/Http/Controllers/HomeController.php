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
        $visibleClients = $this->visibleClientsData($clients);
        $education = $this->journeyData(['education']);
        $experience = $this->journeyData(['experience']);
        $featuredProjects = $this->featuredProjectData();
        $totalProjects = $this->totalProjects();

        return view('pages.home', [
            'profile' => $this->augmentProfileForFreelance($profile),
            'footer_profile' => $profile,
            'home_title' => 'Wahyu Dwi Utomo — Software Engineer Freelance | Website, Sistem, & Aplikasi Custom',
            'home_description' => 'Jasa pembuatan website, dashboard admin, sistem internal, dan aplikasi mobile custom oleh Wahyu Dwi Utomo. Dikerjakan langsung tanpa perantara, transparan, dan tepat waktu.',
            'hero' => $this->heroData(),
            'stats' => $this->statsData(),
            'skills' => $skills,
            'clients' => $clients,
            'clients_json' => json_encode($clients, JSON_THROW_ON_ERROR),
            'visible_clients' => $visibleClients,
            'education' => $education,
            'experience' => $experience,
            'journey' => array_merge($education, $experience),
            'featured_projects' => $featuredProjects,
            'total_projects' => $totalProjects,
            'values' => $this->valuesData(),
            'services' => $this->servicesData(),
            'workflow' => $this->workflowData(),
            'sections' => $this->sectionData(),
        ]);
    }

    private function augmentProfileForFreelance(array $profile): array
    {
        $waNumber = preg_replace('/\D+/', '', $profile['no_wa'] ?? '');
        $prefilled = rawurlencode('Halo Wahyu, saya '.'[nama]'.' dari '.'[bisnis/perusahaan]'.'. Saya tertarik diskusi project [website/sistem/aplikasi] untuk kebutuhan [tujuan]. Bisa infokan slot diskusi awal?');

        return array_replace($profile, [
            'availability_badge' => 'TERSEDIA UNTUK PROJECT FREELANCE — SLOT TERBATAS BULAN INI',
            'wa_direct_url' => $waNumber !== '' ? 'https://wa.me/'.$waNumber.'?text='.$prefilled : ($profile['social_whatsapp'] ?? '#'),
            'email_direct_url' => 'mailto:'.($profile['email'] ?? '').'?subject='.rawurlencode('Diskusi Project Baru').'&body='.rawurlencode("Halo Wahyu,\n\nSaya tertarik diskusi project. Berikut kebutuhan awal:\n\n- Jenis project: \n- Timeline harapan: \n- Ringkasan kebutuhan: \n\nTerima kasih."),
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

    private function visibleClientsData(array $clients): array
    {
        $directionClasses = ['rotate-y-180', 'rotate-x-180', 'rotate-y-neg-180', 'rotate-x-neg-180'];

        return collect($clients)
            ->take(8)
            ->values()
            ->map(fn (array $client, int $index): array => array_replace($client, [
                'direction_type' => $index % count($directionClasses),
                'direction_class' => $directionClasses[$index % count($directionClasses)],
            ]))
            ->all();
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
            ['number' => '20+', 'label' => 'PROJECT TERSELESAIKAN', 'desc' => 'Kuliah, freelance, joki, dan pekerjaan profesional sejak 2023', 'icon' => 'folder-check'],
            ['number' => '15+', 'label' => 'CLIENT DIPERCAYA', 'desc' => 'Instansi, UMKM, startup, dan organisasi dari berbagai industri', 'icon' => 'users'],
            ['number' => '24', 'label' => 'JAM RESPON WHATSAPP', 'desc' => 'Balas pertanyaan project maksimal 1 hari kerja', 'icon' => 'message'],
            ['number' => '5+', 'label' => 'TECH STACK AKTIF', 'desc' => 'Laravel, Filament, Flutter, Vue, PostgreSQL, SQL Server, dan lainnya', 'icon' => 'stack'],
        ];

        return collect($stats)
            ->map(fn (array $stat): array => array_replace($stat, $this->counterData($stat['number'])))
            ->all();
    }

    private function valuesData(): array
    {
        return [
            ['code' => '💬', 'title' => 'RESPONSIF & KOMUNIKATIF', 'desc' => 'Balas pertanyaan dan update progress lewat WhatsApp maksimal 1 hari kerja, tanpa ghosting di tengah project.', 'badge' => 'RESPONS < 24 JAM'],
            ['code' => '⏱️', 'title' => 'TEPAT WAKTU', 'desc' => 'Timeline yang disepakati di awal dipenuhi dengan update mingguan. Kalau meleset karena kesalahan saya, ada kompensasi.', 'badge' => 'ON-TIME DELIVERY'],
            ['code' => '👀', 'title' => 'TRANSPARAN', 'desc' => 'Akses ke staging server kapan saja, update progress rutin, dan breakdown biaya yang jelas tanpa hidden cost.', 'badge' => 'STAGING ACCESS'],
            ['code' => '📦', 'title' => 'SIAP DELIVER', 'desc' => 'Handover lengkap: source code, dokumentasi teknis, video walkthrough, dan support gratis 30 hari setelah launch.', 'badge' => 'HANDOVER LENGKAP'],
        ];
    }

    private function heroData(): array
    {
        $rotatorWords = ['PROJECT BISNIS_', 'SISTEM CUSTOM_', 'APLIKASI MOBILE_', 'DASHBOARD ADMIN_'];

        return [
            'subtitle' => 'Bantu kamu bangun website, dashboard admin, sistem internal, dan aplikasi mobile custom sesuai kebutuhan bisnis. Dikerjakan langsung tanpa perantara agency, komunikasi transparan, dan delivery tepat waktu.',
            'micro_copy' => 'Biasanya balas WhatsApp dalam 24 jam kerja.',
            'rotator_words' => $rotatorWords,
            'rotator_json' => json_encode($rotatorWords, JSON_THROW_ON_ERROR),
            'badges' => [
                ['theme' => 'white-blue', 'icon' => '🎓', 'label' => 'S.Kom · BSI 2025'],
                ['theme' => 'blue-white', 'icon' => '💼', 'label' => 'Fullstack SE · Keysoft'],
            ],
            'profile_label' => 'PROFIL DEVELOPER',
            'status_label' => 'AVAILABLE',
            'skill_chip' => 'Software Engineer',
            'cta_primary_label' => 'DISKUSI PROJECT',
            'cta_secondary_label' => 'LIHAT STUDI KASUS',
            'ghost_link_label' => 'atau email langsung',
        ];
    }

    private function servicesData(): array
    {
        return [
            [
                'icon' => '🌐',
                'title' => 'WEBSITE BISNIS & COMPANY PROFILE',
                'desc' => 'Landing page profesional, company profile, katalog produk, atau microsite kampanye. SEO-ready dan mobile-first.',
                'timeline' => '1–3 minggu',
                'fit_for' => 'UMKM, startup, personal brand',
            ],
            [
                'icon' => '⚙️',
                'title' => 'DASHBOARD ADMIN & SISTEM INTERNAL',
                'desc' => 'Sistem custom untuk kelola data operasional, laporan bisnis, manajemen user, dan proses internal perusahaan.',
                'timeline' => '2–8 minggu',
                'fit_for' => 'Perusahaan yang mau digitalisasi',
            ],
            [
                'icon' => '📱',
                'title' => 'APLIKASI MOBILE FLUTTER',
                'desc' => 'Aplikasi mobile cross-platform untuk field operation, delivery, absensi lapangan, atau consumer app dengan API backend.',
                'timeline' => '1–3 bulan',
                'fit_for' => 'Bisnis yang butuh solusi mobile',
            ],
            [
                'icon' => '🔗',
                'title' => 'INTEGRASI API & MODUL BACKEND',
                'desc' => 'REST API, integrasi payment gateway, modul ERP tambahan, atau maintenance sistem existing yang butuh optimasi.',
                'timeline' => '1–4 minggu',
                'fit_for' => 'Sistem existing yang mau di-upgrade',
            ],
        ];
    }

    private function workflowData(): array
    {
        return [
            [
                'step' => '01',
                'title' => 'DISKUSI KEBUTUHAN',
                'desc' => 'Ngobrol tentang problem bisnis yang mau di-solve. Konsultasi awal gratis via WhatsApp atau Zoom, tanpa komitmen.',
                'duration' => 'Gratis · 30 menit',
            ],
            [
                'step' => '02',
                'title' => 'PROPOSAL & QUOTATION',
                'desc' => 'Breakdown scope, timeline, milestone, dan harga transparan. Kalau setuju, mulai dengan DP dan sisa dibayar bertahap per milestone.',
                'duration' => '1–3 hari kerja',
            ],
            [
                'step' => '03',
                'title' => 'DEVELOPMENT + UPDATE MINGGUAN',
                'desc' => 'Progress update rutin via WhatsApp, akses staging server 24/7 untuk review real-time. Feedback bisa masuk tiap milestone.',
                'duration' => 'Sesuai scope project',
            ],
            [
                'step' => '04',
                'title' => 'DELIVERY & SUPPORT',
                'desc' => 'Deploy ke server production, handover source code + dokumentasi + video walkthrough, dan support gratis 30 hari setelah launch.',
                'duration' => '30 hari support gratis',
            ],
        ];
    }

    private function sectionData(): array
    {
        return [
            'about' => [
                'number' => '01',
                'tag' => 'KENAPA HIRE SAYA',
                'title' => 'KENAPA BISNIS MEMILIH FREELANCE, BUKAN AGENCY',
                'subtitle' => 'Empat komitmen kerja yang saya pegang untuk semua project client, dari UMKM sampai perusahaan enterprise.',
                'chips' => ['Personal', 'Transparan', 'On-time'],
            ],
            'services' => [
                'number' => '02',
                'tag' => 'YANG BISA SAYA BANTU',
                'title' => 'LAYANAN PENGEMBANGAN CUSTOM UNTUK BISNIS ANDA',
                'subtitle' => 'Pilih jenis project sesuai kebutuhan. Semua paket sudah termasuk hosting setup, SSL, dokumentasi, dan support 30 hari.',
            ],
            'workflow' => [
                'number' => '03',
                'tag' => 'CARA KERJA SAYA',
                'title' => 'ALUR KERJA TRANSPARAN DARI DISKUSI HINGGA DELIVERY',
                'subtitle' => 'Empat langkah sederhana yang memastikan project berjalan on-track, komunikasi lancar, dan hasil sesuai ekspektasi.',
            ],
            'projects' => [
                'number' => '04',
                'tag' => 'STUDI KASUS',
                'title' => 'PROJECT YANG PERNAH SAYA KERJAKAN',
                'subtitle' => 'Beberapa project pilihan dari berbagai industri: enterprise ERP, sistem operasional, hingga aplikasi mobile.',
            ],
            'clients' => [
                'number' => '05',
                'tag' => 'MITRA & CLIENT',
                'title' => 'MITRA YANG PERNAH SAYA KERJAKAN PROJECT-NYA',
                'subtitle' => 'Berbagai bisnis, instansi, dan organisasi yang pernah mempercayakan project digital mereka.',
            ],
            'experience' => [
                'number' => '06',
                'tag' => 'LATAR BELAKANG',
                'title' => 'PENDIDIKAN & PENGALAMAN PROFESIONAL',
                'subtitle' => 'Jejak pendidikan dan pengalaman kerja sebagai konteks tambahan tentang latar belakang teknis saya.',
            ],
            'contact' => [
                'number' => '07',
                'tag' => 'DISKUSI PROJECT',
                'title' => 'SIAP DISKUSI PROJECT BARU KAMU?',
                'subtitle' => 'Ceritakan kebutuhan project via WhatsApp untuk respon cepat, atau kirim email dengan detail lengkap lewat form di bawah.',
            ],
        ];
    }

    private function fallbackJourneyData(array $keys): array
    {
        $items = [
            ['id' => 1, 'key' => 'education', 'title' => 'Sistem Informasi (S.Kom)', 'institute' => 'Universitas BSI', 'description' => 'Lulus dengan IPK 3.6. Fokus studi pada software engineering, database, dan arsitektur sistem.', 'date_range' => '2021 - 2025', 'logo' => asset('images/journey/ubsi.png'), 'sort' => 1],
            ['id' => 2, 'key' => 'education', 'title' => 'MSIB Batch 6', 'institute' => 'Startup Campus', 'description' => 'Fokus pada software engineering, database, analisis sistem, dan pengembangan perangkat lunak.', 'date_range' => 'Feb 2024 - Juni 2024', 'logo' => asset('images/journey/startup.png'), 'sort' => 2],
            ['id' => 3, 'key' => 'education', 'title' => 'Teknik Komputer & Jaringan', 'institute' => 'SMK Negeri Indonesia', 'description' => 'Mempelajari dasar-dasar pemrograman, jaringan komputer, server Linux, & troubleshooting hardware.', 'date_range' => '2018 - 2021', 'logo' => asset('images/journey/smk.png'), 'sort' => 3],
            ['id' => 4, 'key' => 'experience', 'title' => 'Software Engineer', 'institute' => 'PT Keysoft ERP Indonesia', 'description' => 'Mengembangkan modul ERP manufaktur dan keuangan, optimasi query database, serta integrasi API.', 'date_range' => '2025 - Sekarang', 'logo' => asset('images/journey/keysoft.png'), 'sort' => 1],
            ['id' => 5, 'key' => 'experience', 'title' => 'Software Engineer', 'institute' => 'PT Pesona Trip Travel Indonesia', 'description' => 'Mengembangkan aplikasi travel booking, manajemen sistem, API, dan integrasi payment gateway.', 'date_range' => 'Sept 2024 - Jan 2025', 'logo' => asset('images/journey/pesona.png'), 'sort' => 2],
            ['id' => 6, 'key' => 'experience', 'title' => 'Software Engineer', 'institute' => 'PT Jasanya Teknologi Indonesia', 'description' => 'Mengembangkan modul ERP, API, dashboard operasional, dan integrasi sistem internal.', 'date_range' => '2023 - Present', 'logo' => asset('images/journey/jasanya.png'), 'sort' => 3],
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
