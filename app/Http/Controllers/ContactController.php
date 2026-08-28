<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Support\PortfolioData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.contact', [
            'profile' => $this->profileData(),
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

    private function profileData(): array
    {
        $fallback = PortfolioData::profile();

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
            'bio' => $about->description,
            'email' => $about->email,
            'no_wa' => $about->no_wa,
            'location' => $about->address ?: $fallback['location'],
            'address' => $about->address ?: $fallback['address'],
            'image_profile' => $this->imageUrl($about->image_profile, $fallback['image_profile']),
            'cv_url' => $fallback['cv_url'],
            'social_media' => array_replace($socials, ['whatsapp' => $whatsapp]),
        ];
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

    private function tableExists(string $table): bool
    {
        try {
            return Schema::hasTable($table);
        } catch (Throwable) {
            return false;
        }
    }
}
