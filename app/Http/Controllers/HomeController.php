<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Journey;
use App\Models\Project;
use App\Models\Tools;
use App\Support\PortfolioData;
use App\Support\PublicProfileData;
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
        $experience = $this->journeyData(['experience', 'organization']);
        $featuredProjects = $this->featuredProjectData();
        $totalProjects = $this->totalProjectsData();
        $totalClients = $this->totalClientsData();

        return view('pages.home', [
            'profile' => $profile,
            'footer_profile' => $profile,
            'stats' => $this->statsData($totalProjects, $totalClients),
            'skills' => $skills,
            'clients' => $clients,
            'visible_clients' => array_slice($clients, 0, 8),
            'client_chunks' => array_chunk($clients, 8),
            'education' => $education,
            'experience' => $experience,
            'journey' => array_merge($education, $experience),
            'featured_projects' => $featuredProjects,
            'total_projects' => $totalProjects,
            'values' => $this->valuesData(),
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
            ['id' => 1, 'name' => 'Keysoft ERP', 'logo' => asset('images/clients/keysoft.png'), 'desc' => 'Penyedia solusi ERP untuk operasional, inventory, accounting, dan proses bisnis perusahaan.'],
            ['id' => 2, 'name' => 'Pesona Trip Travel Indonesia', 'logo' => asset('images/clients/pesona-trip.png'), 'desc' => 'Perusahaan travel dengan kebutuhan sistem digital untuk promosi, paket trip, dan operasional booking.'],
            ['id' => 3, 'name' => 'Dinas Pertamanan Dan Pemakanan DKI Jakarta', 'logo' => asset('images/clients/dinas.png'), 'desc' => 'Instansi pemerintahan daerah yang mengelola layanan pertamanan, pemakaman, data aset, dan informasi publik.'],
            ['id' => 4, 'name' => 'Himpunan Mahasiswa Sistem Informasi', 'logo' => asset('images/clients/himsi.png'), 'desc' => 'Organisasi mahasiswa sistem informasi yang mengelola kegiatan, publikasi, dan informasi organisasi.'],
            ['id' => 5, 'name' => 'SMA Harapan Jaya', 'logo' => asset('images/clients/sma-harapan-jaya.png'), 'desc' => 'Institusi pendidikan dengan kebutuhan sistem informasi sekolah dan publikasi digital.'],
            ['id' => 6, 'name' => 'PT. Charlyn Jaya', 'logo' => asset('images/clients/charlyn.png'), 'desc' => 'Perusahaan swasta dengan kebutuhan digitalisasi proses bisnis dan administrasi internal.'],
            ['id' => 7, 'name' => 'Gereja Protestan Maluku', 'logo' => asset('images/clients/gpm.png'), 'desc' => 'Lembaga keagamaan dengan kebutuhan media informasi digital untuk kegiatan dan pelayanan.'],
            ['id' => 8, 'name' => 'PT. Arthur Teknik Indoprima', 'logo' => asset('images/clients/arthur.png'), 'desc' => 'Perusahaan teknik dan konstruksi dengan kebutuhan sistem administrasi project dan operasional lapangan.'],
            ['id' => 9, 'name' => 'SMK Partriot Nusantara', 'logo' => asset('images/clients/smk-partriot.png'), 'desc' => 'Institusi pendidikan kejuruan dengan kebutuhan sistem informasi sekolah dan profil digital.'],
            ['id' => 10, 'name' => 'PT. Intikarya Baja Lestari', 'logo' => asset('images/clients/intikarya.png'), 'desc' => 'Perusahaan industri baja dengan kebutuhan sistem operasional, inventory, produksi, dan pelaporan bisnis.'],
            ['id' => 11, 'name' => 'Roda Nurmala', 'logo' => asset('images/clients/roda-nurmala.png'), 'desc' => 'Bisnis lokal dengan kebutuhan website profil, katalog informasi, dan dukungan digital.'],
            ['id' => 12, 'name' => 'Hepiso', 'logo' => asset('images/clients/hepiso.png'), 'desc' => 'Brand digital dengan kebutuhan pengembangan aplikasi, website, dan sistem pendukung operasional produk.'],
            ['id' => 13, 'name' => 'DLDK Kabupaten Lamandau', 'logo' => asset('images/clients/dldk-lamandau.png'), 'desc' => 'Instansi daerah dengan kebutuhan aplikasi, website, dan sistem pendukung layanan publik.'],
        ];

        if (! $this->tableExists('client')) {
            return $this->withClientDisplayData($fallback);
        }

        $clients = Client::query()
            ->where('active', true)
            ->latest()
            ->get();

        $clientData = $clients->isEmpty()
            ? $fallback
            : $clients->map(fn (Client $client): array => $this->clientData($client))->all();

        return $this->withClientDisplayData($clientData);
    }

    private function journeyData(array $keys): array
    {
        if (! $this->tableExists('journey')) {
            return $this->fallbackJourneyData($keys);
        }

        $journey = Journey::query()
            ->where('active', true)
            ->whereIn('key', $keys)
            ->orderBy('sort')
            ->latest('id')
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

    private function statsData(int $totalProjects, int $totalClients): array
    {
        return [
            ['number' => '5+', 'label' => 'TAHUN PENGALAMAN', 'desc' => 'Pengalaman di berbagai stack & industri', 'icon' => 'code'],
            ['number' => $this->counterLabel($totalProjects), 'label' => 'PROJECT SELESAI', 'desc' => 'Enterprise, SaaS, web, & mobile', 'icon' => 'folder-check'],
            ['number' => $this->counterLabel($totalClients), 'label' => 'MITRA & CLIENT', 'desc' => 'Perusahaan & Klien Freelance', 'icon' => 'users'],
            ['number' => '100%', 'label' => 'KOMITMEN KUALITAS', 'desc' => 'Kode Bersih & Tepat Waktu', 'icon' => 'shield-check'],
        ];
    }

    private function valuesData(): array
    {
        return [
            ['code' => '⚡', 'title' => 'KODE BERSIH & TERSTRUKTUR', 'desc' => 'Penulisan kode yang rapi, modular, serta mudah dirawat dan dikembangkan di masa mendatang.'],
            ['code' => '🎯', 'title' => 'RESPONSIF & CEPAT DIAKSES', 'desc' => 'Desain berpola mobile-first yang responsif, cepat diakses dari perangkat apapun, serta memenuhi standar aksesibilitas.'],
            ['code' => '🛡️', 'title' => 'AMAN & READY FOR SCALE', 'desc' => 'Praktik keamanan terbaik, proteksi celah umum, serta arsitektur database yang siap tumbuh.'],
            ['code' => '💬', 'title' => 'KOMUNIKASI TRANSPARAN', 'desc' => 'Proses pengerjaan yang transparan, pembaruan kemajuan berkala, serta komitmen penyelesaian tepat waktu.'],
        ];
    }

    private function fallbackJourneyData(array $keys): array
    {
        $items = [
            ['id' => 1, 'key' => 'education', 'title' => 'Sistem Informasi (S.Kom)', 'institute' => 'Universitas BSI', 'description' => 'Lulus Predikat Cumlaude. Fokus studi pada Software Engineering, Database Systems, & System Architecture.', 'date_range' => '2021 - 2025', 'logo' => asset('images/journey/ubsi.png'), 'sort' => 1],
            ['id' => 2, 'key' => 'education', 'title' => 'Teknik Komputer & Jaringan', 'institute' => 'SMK Negeri Indonesia', 'description' => 'Mempelajari dasar-dasar pemrograman, jaringan komputer, server Linux, & troubleshooting hardware.', 'date_range' => '2018 - 2021', 'logo' => asset('images/journey/smk.png'), 'sort' => 2],
            ['id' => 3, 'key' => 'experience', 'title' => 'Software Engineer', 'institute' => 'PT Keysoft ERP Indonesia', 'description' => 'Memimpin pengembangan modul ERP manufaktur & keuangan, optimasi query database SQL Server, dan integrasi API.', 'date_range' => '2025 - Sekarang', 'logo' => asset('images/journey/keysoft.png'), 'sort' => 1],
            ['id' => 4, 'key' => 'experience', 'title' => 'Fullstack Developer Freelance', 'institute' => 'Independent / Project-Based', 'description' => 'Membangun 15+ sistem kustom, e-commerce, LMS, dan aplikasi POS untuk UMKM dan perusahaan lokal.', 'date_range' => '2022 - 2025', 'logo' => asset('images/journey/freelance.png'), 'sort' => 2],
            ['id' => 5, 'key' => 'organization', 'title' => 'Koordinator Komite Kominfo', 'institute' => 'HIMSI Universitas BSI', 'description' => 'Mengelola portal web organisasi dan mengadakan pelatihan coding web untuk 200+ mahasiswa.', 'date_range' => '2023 - 2025', 'logo' => asset('images/journey/himsi.png'), 'sort' => 3],
        ];

        return collect($items)->whereIn('key', $keys)->values()->all();
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

    private function withClientDisplayData(array $clients): array
    {
        $directionClasses = ['rotate-y-180', 'rotate-x-180', 'rotate-y-neg-180', 'rotate-x-neg-180'];

        return collect($clients)
            ->values()
            ->map(fn (array $client, int $index): array => array_replace($client, [
                'direction_class' => $directionClasses[$index % count($directionClasses)],
                'direction_type' => $index % count($directionClasses),
            ]))
            ->all();
    }

    private function totalProjectsData(): int
    {
        if ($this->tableExists('project')) {
            return Project::query()
                ->where('active', true)
                ->count();
        }

        return PortfolioData::projects()->count();
    }

    private function totalClientsData(): int
    {
        if ($this->tableExists('client')) {
            return Client::query()
                ->where('active', true)
                ->count();
        }

        return count($this->clientsData());
    }

    private function counterLabel(int $count): string
    {
        return $count > 0 ? $count.'+' : '0';
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
        if (blank($path)) {
            return $fallback;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset(ltrim($path, '/'));
    }
}
