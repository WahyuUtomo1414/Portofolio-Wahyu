<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Client;
use App\Models\Journey;
use App\Models\Project;
use App\Models\Tools;
use App\Support\PortfolioData;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    public function index(): View
    {
        $profile = $this->profileData();
        $skills = $this->skillsData();
        $clients = $this->clientsData();
        $education = $this->journeyData(['education']);
        $experience = $this->journeyData(['experience', 'organization']);
        $featuredProjects = $this->featuredProjectData();

        return view('pages.home', [
            'profile' => $profile,
            'stats' => $this->statsData(),
            'skills' => $skills,
            'clients' => $clients,
            'client_chunks' => array_chunk($clients, 4),
            'education' => $education,
            'experience' => $experience,
            'journey' => array_merge($education, $experience),
            'featured_projects' => $featuredProjects,
            'values' => $this->valuesData(),
        ]);
    }

    private function profileData(): array
    {
        $base = PortfolioData::profile();
        $fallback = array_replace($base, [
            'availability_badge' => 'TERSEDIA UNTUK PROJECT FREELANCE & FULL-TIME',
            'tagline' => 'Mengembangkan Aplikasi Web Fullstack Scalable & Modern!',
            'description' => $base['bio'],
            'social_github' => $base['social_media']['github'],
            'social_linkedin' => $base['social_media']['linkedin'],
            'social_instagram' => $base['social_media']['instagram'],
            'social_whatsapp' => $base['social_media']['whatsapp'],
        ]);

        if (! $this->tableExists('about')) {
            return $fallback;
        }

        $about = About::query()
            ->where('active', true)
            ->latest()
            ->first();

        if (! $about) {
            return $fallback;
        }

        $socials = array_replace($fallback['social_media'], $about->sosial_media ?? []);
        $whatsapp = $socials['whatsapp'] ?? $this->whatsappUrl($about->no_wa);

        return [
            'name' => $about->name,
            'role' => $fallback['role'],
            'availability_badge' => $fallback['availability_badge'],
            'tagline' => $about->tagline ?: $fallback['tagline'],
            'bio' => $about->description,
            'description' => $about->description,
            'email' => $about->email,
            'no_wa' => $about->no_wa,
            'location' => $about->address ?: $fallback['location'],
            'address' => $about->address ?: $fallback['address'],
            'image_profile' => $this->imageUrl($about->image_profile, $fallback['image_profile']),
            'cv_url' => $fallback['cv_url'],
            'social_media' => array_replace($socials, ['whatsapp' => $whatsapp]),
            'social_github' => $socials['github'] ?? $fallback['social_github'],
            'social_linkedin' => $socials['linkedin'] ?? $fallback['social_linkedin'],
            'social_instagram' => $socials['instagram'] ?? $fallback['social_instagram'],
            'social_whatsapp' => $whatsapp,
        ];
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

    private function statsData(): array
    {
        return [
            ['number' => '5+', 'label' => 'TAHUN PENGALAMAN', 'desc' => 'Spesialis Laravel & Web Development', 'icon' => 'code'],
            ['number' => '20+', 'label' => 'PROJECT SELESAI', 'desc' => 'Enterprise, SaaS, & Aplikasi Web', 'icon' => 'folder-check'],
            ['number' => '10+', 'label' => 'MITRA & CLIENT', 'desc' => 'Perusahaan & Klien Freelance', 'icon' => 'users'],
            ['number' => '100%', 'label' => 'KOMITMEN KUALITAS', 'desc' => 'Kode Bersih & Tepat Waktu', 'icon' => 'shield-check'],
        ];
    }

    private function valuesData(): array
    {
        return [
            ['code' => '⚡', 'title' => 'KODE BERSIH & TERSTRUKTUR', 'desc' => 'Penulisan kode yang rapi berstandar PSR, terstruktur modular, serta mudah dirawat dan dikembangkan di masa mendatang.'],
            ['code' => '🎯', 'title' => 'RESPONSIF & CEPAT DIAKSES', 'desc' => 'Desain berpola mobile-first yang responsif, cepat diakses dari perangkat apapun, serta memenuhi standar aksesibilitas.'],
            ['code' => '🛡️', 'title' => 'AMAN & READY FOR SCALE', 'desc' => 'Penerapan praktik keamanan terbaik Laravel, proteksi dari celah umum web, serta arsitektur database yang siap tumbuh.'],
            ['code' => '💬', 'title' => 'KOMUNIKASI TRANSPARAN', 'desc' => 'Proses pengerjaan yang transparan, pembaruan kemajuan berkala, serta komitmen penyelesaian tepat waktu.'],
        ];
    }

    private function fallbackJourneyData(array $keys): array
    {
        $items = [
            ['id' => 1, 'key' => 'education', 'title' => 'Sistem Informasi (S.Kom)', 'institute' => 'Universitas BSI', 'description' => 'Lulus Predikat Cumlaude. Fokus studi pada Software Engineering, Database Systems, & System Architecture.', 'date_range' => '2021 - 2025', 'logo' => asset('images/journey/ubsi.png'), 'sort' => 1],
            ['id' => 2, 'key' => 'education', 'title' => 'Teknik Komputer & Jaringan', 'institute' => 'SMK Negeri Indonesia', 'description' => 'Mempelajari dasar-dasar pemrograman, jaringan komputer, server Linux, & troubleshooting hardware.', 'date_range' => '2018 - 2021', 'logo' => asset('images/journey/smk.png'), 'sort' => 2],
            ['id' => 3, 'key' => 'experience', 'title' => 'Senior Fullstack Web Developer', 'institute' => 'PT Keysoft ERP Indonesia', 'description' => 'Memimpin pengembangan modul ERP manufaktur & keuangan, optimasi query database SQL Server, dan integrasi API.', 'date_range' => '2025 - Sekarang', 'logo' => asset('images/journey/keysoft.png'), 'sort' => 1],
            ['id' => 4, 'key' => 'experience', 'title' => 'Fullstack Web Developer Freelance', 'institute' => 'Independent / Project-Based', 'description' => 'Membangun 15+ sistem web kustom, e-commerce, LMS, dan aplikasi POS untuk UMKM dan perusahaan lokal.', 'date_range' => '2022 - 2025', 'logo' => asset('images/journey/freelance.png'), 'sort' => 2],
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

    private function whatsappUrl(string $number): string
    {
        $digits = preg_replace('/\D+/', '', $number);

        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        }

        return 'https://wa.me/' . $digits;
    }
}
