<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>{{ $title ?? 'Wahyu Dwi Utomo — Senior Fullstack Web Developer' }}</title>
    <meta name="description" content="{{ $description ?? 'Portofolio profesional Wahyu Dwi Utomo. Spesialis pengembangan aplikasi web modern, scalable, dan efisien menggunakan Laravel, Vue, Flutter, dan Tailwind CSS.' }}">
    <meta name="keywords" content="Wahyu Dwi Utomo, Fullstack Developer, Laravel Developer, Portofolio Software Engineer, Web Developer Indonesia">
    <meta name="author" content="Wahyu Dwi Utomo">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Wahyu Dwi Utomo — Senior Fullstack Web Developer' }}">
    <meta property="og:description" content="{{ $description ?? 'Portofolio profesional Wahyu Dwi Utomo. Spesialis aplikasi web scalable menggunakan Laravel & Vue.js.' }}">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title ?? 'Wahyu Dwi Utomo — Senior Fullstack Web Developer' }}">
    <meta property="twitter:description" content="{{ $description ?? 'Portofolio profesional Wahyu Dwi Utomo.' }}">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF8F5] text-[#0F172A] antialiased selection:bg-[#2563EB] selection:text-white flex flex-col min-h-screen">

    <!-- Global Header & Navbar -->
    <x-layout.navbar />

    <!-- Main Slot Konten -->
    <main class="flex-grow bg-dot-pattern">
        {{ $slot }}
    </main>

    <!-- Global Footer -->
    <x-layout.footer />

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
