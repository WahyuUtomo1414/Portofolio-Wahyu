<?php

namespace App\Support;

use App\Models\About;
use Illuminate\Support\Facades\Schema;
use Throwable;

class PublicProfileData
{
    public static function get(): array
    {
        $fallback = self::fallback();

        if (! self::tableExists('about')) {
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
        $whatsapp = $socials['whatsapp'] ?? self::whatsappUrl($about->no_wa);

        return self::normalize(array_replace($fallback, [
            'name' => $about->name,
            'tagline' => $about->tagline ?: $fallback['tagline'],
            'bio' => $about->description,
            'description' => $about->description,
            'email' => $about->email,
            'no_wa' => $about->no_wa,
            'location' => $about->address ?: $fallback['location'],
            'address' => $about->address ?: $fallback['address'],
            'image_profile' => PublicStorageUrl::image($about->image_profile, $fallback['image_profile']),
            'social_media' => array_replace($socials, ['whatsapp' => $whatsapp]),
        ]));
    }

    private static function fallback(): array
    {
        $profile = PortfolioData::profile();

        return self::normalize(array_replace($profile, [
            'availability_badge' => 'TERSEDIA UNTUK PROJECT FREELANCE & FULL-TIME',
            'tagline' => 'Membangun Produk Digital Scalable & Modern!',
            'description' => $profile['bio'],
        ]));
    }

    private static function normalize(array $profile): array
    {
        $socials = $profile['social_media'] ?? [];

        return array_replace($profile, [
            'social_media' => $socials,
            'social_github' => $socials['github'] ?? '#',
            'social_linkedin' => $socials['linkedin'] ?? '#',
            'social_instagram' => $socials['instagram'] ?? '#',
            'social_whatsapp' => $socials['whatsapp'] ?? self::whatsappUrl($profile['no_wa'] ?? ''),
            'location_upper' => mb_strtoupper($profile['location'] ?? 'Bekasi / Jakarta, Indonesia'),
            'current_year' => now()->year,
        ]);
    }

    private static function whatsappUrl(string $number): string
    {
        $digits = preg_replace('/\D+/', '', $number);

        if (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        }

        return $digits !== '' ? 'https://wa.me/'.$digits : '#';
    }

    private static function tableExists(string $table): bool
    {
        try {
            return Schema::hasTable($table);
        } catch (Throwable) {
            return false;
        }
    }
}
