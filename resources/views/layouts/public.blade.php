<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', $title ?? 'Wahyu Dwi Utomo — Software Engineer & Fullstack Developer')</title>
    <meta name="description" content="@yield('description', $description ?? 'Portofolio profesional Wahyu Dwi Utomo. Spesialis membangun aplikasi web, backend API, mobile, dan sistem digital scalable sesuai kebutuhan bisnis.')">
    <meta name="keywords" content="Wahyu Dwi Utomo, Software Engineer, Fullstack Developer, Backend Developer, Mobile Developer, Web Developer Indonesia">
    <meta name="author" content="Wahyu Dwi Utomo">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0F172A">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/svg+xml" href="/images/brand/favicon.svg">
    <link rel="shortcut icon" href="/images/brand/favicon.svg">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Wahyu Dwi Utomo">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="@yield('title', $title ?? 'Wahyu Dwi Utomo — Software Engineer & Fullstack Developer')">
    <meta property="og:description" content="@yield('description', $description ?? 'Portofolio profesional Wahyu Dwi Utomo. Spesialis membangun aplikasi web dan sistem digital scalable untuk berbagai kebutuhan bisnis.')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', $title ?? 'Wahyu Dwi Utomo — Software Engineer & Fullstack Developer')">
    <meta property="twitter:description" content="@yield('description', $description ?? 'Portofolio profesional Wahyu Dwi Utomo.')">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <script type="application/ld+json">
        {
            "@@context": "https://schema.org",
            "@@type": "Person",
            "name": "Wahyu Dwi Utomo",
            "url": "{{ url('/') }}",
            "image": "{{ $footer_profile['image_profile'] ?? asset('images/brand/wdu-mark.svg') }}",
            "jobTitle": "Software Engineer & Fullstack Developer",
            "email": "mailto:{{ $footer_profile['email'] ?? 'wahyuxd14@gmail.com' }}",
            "address": {
                "@@type": "PostalAddress",
                "addressLocality": "{{ $footer_profile['location'] ?? 'Jakarta, Indonesia' }}"
            },
            "sameAs": [
                "{{ $footer_profile['social_github'] ?? 'https://github.com/WahyuUtomo1414' }}",
                "{{ $footer_profile['social_linkedin'] ?? 'https://www.linkedin.com/in/wahyutomo/' }}",
                "{{ $footer_profile['social_instagram'] ?? 'https://www.instagram.com/waahyutomo/' }}"
            ]
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF8F5] text-[#0F172A] antialiased selection:bg-[#2563EB] selection:text-white flex flex-col min-h-screen">

    <!-- Global Header & Navbar -->
    <x-layout.navbar />

    <!-- Main Slot Konten -->
    <main class="flex-grow bg-dot-pattern">
        @yield('content')
    </main>

    <!-- Global Footer -->
    <x-layout.footer :profile="$footer_profile ?? []" />

    <!-- Back To Top Button Component (Pojok Kanan Bawah dengan Progress Indicator) -->
    <x-common.back-to-top />

    <!-- Alpine / Simple Script for Interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('mobile-menu-toggle');
            const menuContainer = document.getElementById('mobile-menu');

            if (toggleBtn && menuContainer) {
                toggleBtn.addEventListener('click', function () {
                    menuContainer.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
