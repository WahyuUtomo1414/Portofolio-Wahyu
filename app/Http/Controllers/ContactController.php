<?php

namespace App\Http\Controllers;

use App\Models\Contact;
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
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        Contact::create($validated);

        return back()
            ->with('status', 'Pesan berhasil dikirim. Saya akan menghubungi Anda kembali melalui email atau WhatsApp.');
    }
}
