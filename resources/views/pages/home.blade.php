@extends('layouts.public')

@section('title', $home_title)
@section('description', $home_description)

@section('content')

    <!-- 1. HERO -->
    <x-home.hero :profile="$profile" :hero="$hero" />

    <!-- 2. SKILL (Tech Stack Marquee Running Banner) -->
    <x-home.skills :skills="$skills" />

    <!-- 3. COUNT (Dedicated Stats Counter Banner) -->
    <x-home.stats :stats="$stats" />

    <!-- 4. TENTANG (Section 01: Profil & nilai kerja) -->
    <x-home.about-preview :values="$values" :profile="$profile" :section="$sections['about']" />

    <!-- 5. JOURNEY (Section 02: Education & Experience 2-Column Timeline) -->
    <x-home.experience :education="$education" :experience="$experience" :section="$sections['experience']" />

    <!-- 6. CLIENT (Section 03: Dedicated Clients & Partners Section) -->
    <x-home.clients :clients="$clients" :section="$sections['clients']" />

    <!-- 7. PROJECT (Section 04: Project pilihan) -->
    <x-home.featured-projects :projects="$featured_projects" :totalProjects="$total_projects" :section="$sections['projects']" />

    <!-- 8. KONTAK (Section 05: CTA & form kontak) -->
    <x-home.contact-cta :profile="$profile" :section="$sections['contact']" />

@endsection
