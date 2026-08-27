<?php

namespace App\Http\Controllers;

use App\Support\PortfolioData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.contact', [
            'profile' => PortfolioData::profile(),
            'title' => 'Kontak — Wahyu Dwi Utomo',
            'description' => 'Hubungi Wahyu Dwi Utomo untuk diskusi project, kerja sama, atau kebutuhan pengembangan aplikasi web.',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'email' => ['required', 'email', 'max:128'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        return back()
            ->withInput($validated)
            ->with('status', 'Pesan berhasil divalidasi. Integrasi penyimpanan atau email bisa ditambahkan setelah tabel kontak tersedia.');
    }
}
