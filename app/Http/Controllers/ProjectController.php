<?php

namespace App\Http\Controllers;

use App\Support\PortfolioData;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $selectedCategory = $request->string('category')->toString();
        $projects = PortfolioData::projects();

        if ($selectedCategory !== '') {
            $projects = $projects->where('category', $selectedCategory)->values();
        }

        return view('pages.projects.index', [
            'projects' => $projects,
            'categories' => PortfolioData::projectCategories(),
            'selectedCategory' => $selectedCategory,
            'title' => 'Project — Wahyu Dwi Utomo',
            'description' => 'Katalog project portofolio Wahyu Dwi Utomo.',
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
