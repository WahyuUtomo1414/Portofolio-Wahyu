<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        return view('pages.blog.index', [
            'posts' => collect(),
            'title' => 'Blog — Wahyu Dwi Utomo',
            'description' => 'Tulisan teknis dan catatan pengembangan Wahyu Dwi Utomo.',
        ]);
    }

    public function show(string $slug): View
    {
        abort(404);
    }
}
