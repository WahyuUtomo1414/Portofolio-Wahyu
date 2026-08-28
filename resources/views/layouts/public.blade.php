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
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $title ?? 'Wahyu Dwi Utomo — Software Engineer & Fullstack Developer')">
    <meta property="og:description" content="@yield('description', $description ?? 'Portofolio profesional Wahyu Dwi Utomo. Spesialis membangun aplikasi web dan sistem digital scalable untuk berbagai kebutuhan bisnis.')">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', $title ?? 'Wahyu Dwi Utomo — Software Engineer & Fullstack Developer')">
    <meta property="twitter:description" content="@yield('description', $description ?? 'Portofolio profesional Wahyu Dwi Utomo.')">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

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
    <x-layout.footer />

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
