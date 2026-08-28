<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Support\PublicProfileData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function index(): View
    {
        $profile = PublicProfileData::get();

        return view('pages.contact', [
            'profile' => $profile,
            'footer_profile' => $profile,
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

        if ($this->tableExists('contact')) {
            Contact::create($validated);
        }

        return back()
            ->with('status', 'Pesan berhasil dikirim. Saya akan menghubungi Anda kembali melalui email atau WhatsApp.');
    }

    private function tableExists(string $table): bool
    {
        try {
            return Schema::hasTable($table);
        } catch (Throwable) {
            return false;
        }
    }
}
