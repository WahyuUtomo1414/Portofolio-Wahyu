<?php

namespace App\Http\Controllers;

use App\Support\PortfolioData;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->string('q')->toString());
        $selectedCategory = trim($request->string('category')->toString());

        $projectsCollection = PortfolioData::projects();

        // 1. Filter Berdasarkan Kategori jika dipilih
        if ($selectedCategory !== '') {
            $projectsCollection = $projectsCollection->where('category', $selectedCategory);
        }

        // 2. Filter Berdasarkan Kata Kunci Pencarian (Search Input)
        if ($search !== '') {
            $searchLower = mb_strtolower($search);
            $projectsCollection = $projectsCollection->filter(function ($item) use ($searchLower) {
                $nameMatch = str_contains(mb_strtolower($item['name']), $searchLower);
                $descMatch = str_contains(mb_strtolower($item['short_description']), $searchLower);
                $clientMatch = str_contains(mb_strtolower($item['client_name'] ?? ''), $searchLower);
                $techMatch = collect($item['tech_stack'] ?? [])->contains(function ($tech) use ($searchLower) {
                    return str_contains(mb_strtolower(is_array($tech) ? ($tech['name'] ?? '') : $tech), $searchLower);
                });
                return $nameMatch || $descMatch || $clientMatch || $techMatch;
            });
        }

        // 3. Paginasi Data (6 Item per Halaman)
        $currentPage = $request->integer('page', 1);
        $perPage = 6;
        $total = $projectsCollection->count();
        $pagedItems = $projectsCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginator = new LengthAwarePaginator(
            $pagedItems,
            $total,
            $perPage,
            $currentPage,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        return view('pages.projects.index', [
            'projects' => $paginator,
            'categories' => PortfolioData::projectCategories(),
            'selectedCategory' => $selectedCategory,
            'search' => $search,
            'title' => 'Katalog Project — Wahyu Dwi Utomo',
            'description' => 'Katalog lengkap project portofolio, sistem bisnis, dan aplikasi web karya Wahyu Dwi Utomo.',
        ]);
    }

    public function show(string $slug): View
    {
        $project = PortfolioData::projectBySlug($slug);

        abort_if($project === null, 404);

        $relatedProjects = PortfolioData::projects()
            ->where('slug', '!=', $slug)
            ->where('category', $project['category'])
            ->take(3)
            ->values();

        return view('pages.projects.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'title' => $project['name'] . ' — Project Wahyu Dwi Utomo',
            'description' => $project['short_description'],
        ]);
    }
}
