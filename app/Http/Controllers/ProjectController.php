<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Support\PortfolioData;
use App\Support\PublicProfileData;
use App\Support\PublicStorageUrl;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->string('q')->toString());
        $selectedCategory = trim($request->string('category')->toString());

        if ($this->projectTablesReady()) {
            $projects = $this->databaseProjects($request, $search, $selectedCategory);
            $categories = $this->databaseCategoryFilters($search);
            $totalProjects = Project::query()->where('active', true)->count();
        } else {
            $fallback = $this->fallbackProjects($request, $search, $selectedCategory);
            $projects = $fallback['projects'];
            $categories = $fallback['categories'];
            $totalProjects = $fallback['totalProjects'];
        }

        return view('pages.projects.index', [
            'projects' => $projects,
            'footer_profile' => PublicProfileData::get(),
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'search' => $search,
            'totalProjects' => $totalProjects,
            'clearSearchUrl' => route('projects.index', $selectedCategory !== '' ? ['category' => $selectedCategory] : []),
            'allProjectsUrl' => route('projects.index', $search !== '' ? ['q' => $search] : []),
            'title' => 'Katalog Project — Wahyu Dwi Utomo',
            'description' => 'Katalog lengkap project portofolio, sistem bisnis, dan aplikasi web karya Wahyu Dwi Utomo.',
        ]);
    }

    public function show(string $slug): View
    {
        if ($this->projectTablesReady()) {
            $project = Project::query()
                ->with(['category', 'client', 'tools', 'images' => function ($query) {
                    $query->where('active', true)->latest();
                }])
                ->where('active', true)
                ->where('slug', $slug)
                ->first();

            abort_if($project === null, 404);

            $projectData = $this->projectData($project);
            $relatedProjects = Project::query()
                ->with(['category', 'client', 'tools'])
                ->where('active', true)
                ->whereKeyNot($project->getKey())
                ->where('category_id', $project->category_id)
                ->latest()
                ->limit(3)
                ->get();

            $relatedProjectData = collect($this->projectCollectionData($relatedProjects));
        } else {
            $fallbackProject = PortfolioData::projectBySlug($slug);

            abort_if($fallbackProject === null, 404);

            $projectData = $this->fallbackProjectData($fallbackProject);

            $relatedProjectData = PortfolioData::projects()
                ->where('slug', '!=', $slug)
                ->where('category', $projectData['category'])
                ->map(fn (array $project): array => $this->fallbackProjectData($project))
                ->take(3)
                ->values();
        }

        return view('pages.projects.show', [
            'project' => $projectData,
            'relatedProjects' => $relatedProjectData,
            'footer_profile' => PublicProfileData::get(),
            'title' => $projectData['name'].' — Project Wahyu Dwi Utomo',
            'description' => $projectData['short_description'],
        ]);
    }

    private function databaseProjects(Request $request, string $search, string $selectedCategory): LengthAwarePaginator
    {
        $paginator = Project::query()
            ->with(['category', 'client', 'tools'])
            ->where('active', true)
            ->when($selectedCategory !== '', function (Builder $query) use ($selectedCategory): void {
                $query->whereHas('category', function (Builder $categoryQuery) use ($selectedCategory): void {
                    $categoryQuery->where('name', $selectedCategory);
                });
            })
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('body', 'like', "%{$search}%")
                        ->orWhereHas('client', function (Builder $clientQuery) use ($search): void {
                            $clientQuery->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('tools', function (Builder $toolQuery) use ($search): void {
                            $toolQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        $paginator->setCollection(
            $paginator->getCollection()
                ->map(fn (Project $project): array => $this->projectData($project)),
        );

        return $paginator;
    }

    private function databaseCategoryFilters(string $search): array
    {
        return Category::query()
            ->where('active', true)
            ->withCount(['projects' => fn (Builder $query) => $query->where('active', true)])
            ->orderBy('name')
            ->get()
            ->map(fn (Category $category): array => [
                'name' => $category->name,
                'label' => mb_strtoupper($category->name),
                'count' => $category->projects_count,
                'url' => route('projects.index', array_filter([
                    'category' => $category->name,
                    'q' => $search,
                ])),
            ])
            ->all();
    }

    private function fallbackProjects(Request $request, string $search, string $selectedCategory): array
    {
        $projectsCollection = PortfolioData::projects()
            ->map(fn (array $project): array => $this->fallbackProjectData($project));
        $totalProjects = $projectsCollection->count();

        if ($selectedCategory !== '') {
            $projectsCollection = $projectsCollection->where('category', $selectedCategory);
        }

        if ($search !== '') {
            $searchLower = mb_strtolower($search);
            $projectsCollection = $projectsCollection->filter(function (array $item) use ($searchLower): bool {
                $nameMatch = str_contains(mb_strtolower($item['name']), $searchLower);
                $descMatch = str_contains(mb_strtolower($item['short_description']), $searchLower);
                $clientMatch = str_contains(mb_strtolower($item['client_name'] ?? ''), $searchLower);
                $techMatch = collect($item['tech_stack'] ?? [])->contains(function (string $tech) use ($searchLower): bool {
                    return str_contains(mb_strtolower($tech), $searchLower);
                });

                return $nameMatch || $descMatch || $clientMatch || $techMatch;
            });
        }

        $currentPage = $request->integer('page', 1);
        $perPage = 6;
        $pagedItems = $projectsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return [
            'projects' => new LengthAwarePaginator(
                $pagedItems,
                $projectsCollection->count(),
                $perPage,
                $currentPage,
                [
                    'path' => $request->url(),
                    'query' => $request->query(),
                ],
            ),
            'categories' => $this->fallbackCategoryFilters($search),
            'totalProjects' => $totalProjects,
        ];
    }

    private function fallbackCategoryFilters(string $search): array
    {
        return PortfolioData::projects()
            ->groupBy('category')
            ->map(fn (Collection $projects, string $category): array => [
                'name' => $category,
                'label' => mb_strtoupper($category),
                'count' => $projects->count(),
                'url' => route('projects.index', array_filter([
                    'category' => $category,
                    'q' => $search,
                ])),
            ])
            ->values()
            ->all();
    }

    private function projectCollectionData(EloquentCollection $projects): array
    {
        return $projects
            ->map(fn (Project $project): array => $this->projectData($project))
            ->all();
    }

    private function projectData(Project $project): array
    {
        return [
            'id' => $project->id,
            'name' => $project->name,
            'slug' => $project->slug,
            'category' => $project->category?->name ?? 'Web App',
            'category_label' => mb_strtoupper($project->category?->name ?? 'Web App'),
            'client_name' => $project->client?->name ?? 'Project Pribadi',
            'client_logo' => $this->imageUrl($project->client?->logo),
            'thumbnail_url' => $this->imageUrl($project->thumbnail),
            'short_description' => str(strip_tags($project->body))->limit(160)->toString(),
            'body' => $project->body, // Menyimpan HTML mentah dari RichEditor Filament
            'period' => $this->projectPeriod($project->start_project, $project->end_project),
            'tech_stack' => $project->tools->pluck('name')->all(),
            'tech_stack_labels' => $project->tools->pluck('name')->all(),
            'demo_url' => $project->url,
            'github_url' => null,
            'detail_url' => route('projects.show', $project->slug),
            'is_featured' => $project->is_featured,
            'images' => $project->relationLoaded('images')
                ? $project->images->map(fn ($image): array => [
                    'image_url' => $this->imageUrl($image->image),
                    'description' => $image->description,
                ])->all()
                : [],
        ];
    }

    private function fallbackProjectData(array $project): array
    {
        return [
            'id' => $project['id'],
            'name' => $project['name'],
            'slug' => $project['slug'],
            'category' => $project['category'],
            'category_label' => mb_strtoupper($project['category']),
            'client_name' => $project['client_name'] ?? 'Project Pribadi',
            'client_logo' => $this->imageUrl($project['client_logo'] ?? null),
            'thumbnail_url' => $this->imageUrl($project['thumbnail_url'] ?? null),
            'short_description' => $project['short_description'],
            'body' => $project['body'],
            'period' => $project['period'] ?? null,
            'tech_stack' => $project['tech_stack'],
            'tech_stack_labels' => $this->techStackLabels($project['tech_stack'] ?? []),
            'demo_url' => $project['demo_url'] ?? null,
            'github_url' => $project['github_url'] ?? null,
            'detail_url' => route('projects.show', $project['slug']),
            'is_featured' => $project['is_featured'],
            'images' => $project['images'] ?? [],
        ];
    }

    private function projectTablesReady(): bool
    {
        return $this->tableExists('project')
            && $this->tableExists('category')
            && $this->tableExists('client')
            && $this->tableExists('tools')
            && $this->tableExists('project_tool')
            && $this->tableExists('project_image');
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

    private function projectPeriod(mixed $startProject, mixed $endProject): ?string
    {
        if (blank($startProject) && blank($endProject)) {
            return null;
        }

        $start = blank($startProject) ? null : $startProject->translatedFormat('M Y');
        $end = blank($endProject) ? 'Sekarang' : $endProject->translatedFormat('M Y');

        return trim(($start ?? 'Mulai').' - '.$end);
    }

    private function techStackLabels(array $items): array
    {
        return collect($items)
            ->map(fn (mixed $item): string => is_array($item) ? (string) ($item['name'] ?? '') : (string) $item)
            ->filter()
            ->values()
            ->all();
    }
}
