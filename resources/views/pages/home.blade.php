@extends('layouts.public')

@section('title', $profile['name'] . ' — ' . $profile['role'])
@section('description', $profile['bio'])

@section('content')

    <!-- 1. HERO -->
    <x-home.hero :profile="$profile" />

    <!-- 2. SKILL (Tech Stack Marquee Running Banner) -->
    <x-home.skills :skills="$skills" />

    <!-- 3. COUNT (Dedicated Stats Counter Banner) -->
    <x-home.stats :stats="$stats" />

    <!-- 4. ABOUT (Section 01: About Me Bio & Core Values) -->
    <x-home.about-preview :values="$values" :profile="$profile" />

    <!-- 5. JOURNEY (Section 02: Education & Experience 2-Column Timeline) -->
    <x-home.experience :education="$education" :experience="$experience" />

    <!-- 6. CLIENT (Section 03: Dedicated Clients & Partners Section) -->
    <x-home.clients :clients="$clients" />

    <!-- 7. PROJECT (Section 04: Featured Projects) -->
    <x-home.featured-projects :projects="$featured_projects" />

    <!-- 8. CONTACT (Section 05: Contact CTA & Direct Form) -->
    <x-home.contact-cta :profile="$profile" />

@endsection
