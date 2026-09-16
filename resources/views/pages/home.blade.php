@extends('layouts.public')

@section('title', $home_title)
@section('description', $home_description)

@section('content')

    <!-- HERO -->
    <x-home.hero :profile="$profile" :hero="$hero" />

    <!-- TECH STACK MARQUEE -->
    <x-home.skills :skills="$skills" />

    <!-- STATS COUNTER BANNER -->
    <x-home.stats :stats="$stats" />

    <!-- 01. KENAPA HIRE SAYA (Values reframed → client concern) -->
    <x-home.about-preview :values="$values" :profile="$profile" :section="$sections['about']" />

    <!-- 02. YANG BISA SAYA BANTU (Services) -->
    <x-home.services :services="$services" :section="$sections['services']" :profile="$profile" />

    <!-- 03. CARA KERJA SAYA (Workflow) -->
    <x-home.workflow :workflow="$workflow" :section="$sections['workflow']" />

    <!-- 04. STUDI KASUS (Featured Projects) -->
    <x-home.featured-projects :projects="$featured_projects" :totalProjects="$total_projects" :section="$sections['projects']" />

    <!-- 05. MITRA & CLIENT -->
    <x-home.clients :clientsJson="$clients_json" :visibleClients="$visible_clients" :section="$sections['clients']" />

    <!-- 06. LATAR BELAKANG (Journey) -->
    <x-home.experience :education="$education" :experience="$experience" :section="$sections['experience']" />

    <!-- 07. DISKUSI PROJECT (Contact CTA + Form) -->
    <x-home.contact-cta :profile="$profile" :section="$sections['contact']" />

@endsection
