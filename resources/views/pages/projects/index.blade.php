@extends('layouts.public')

@section('title', $title)
@section('description', $description)

@section('content')
    <section class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-common.section-header
                number="01"
                tag="KATALOG PROJECT"
                title="SEMUA PROJECT PORTOFOLIO"
                subtitle="Kumpulan project web, sistem bisnis, aplikasi mobile, dan eksperimen teknis yang pernah dikembangkan." />

            <div class="mb-8 flex flex-wrap gap-3 font-mono text-xs font-bold">
                <a href="{{ route('projects.index') }}" class="border-neo px-4 py-2 rounded-md shadow-neo-sm {{ $selectedCategory === '' ? 'bg-[#2563EB] text-white' : 'bg-white text-[#0F172A]' }}">
                    SEMUA
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('projects.index', ['category' => $category]) }}" class="border-neo px-4 py-2 rounded-md shadow-neo-sm {{ $selectedCategory === $category ? 'bg-[#2563EB] text-white' : 'bg-white text-[#0F172A]' }}">
                        {{ strtoupper($category) }}
                    </a>
                @endforeach
            </div>

            @if($projects->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <x-project.card :project="$project" />
                    @endforeach
                </div>
            @else
                <x-common.empty-state
                    title="Project Tidak Ditemukan"
                    message="Belum ada project untuk filter kategori ini." />
            @endif
        </div>
    </section>
@endsection
