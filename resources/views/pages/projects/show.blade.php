@extends('layouts.public')

@section('title', $title)
@section('description', $description)

@section('content')
    <article class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center mb-8 font-mono text-sm font-bold text-[#2563EB] hover:underline">
                ← KEMBALI KE PROJECT
            </a>

            <div class="bg-white border-neo rounded-lg shadow-neo overflow-hidden">
                <div class="p-4 bg-slate-100 border-neo-b">
                    <x-common.image-card :src="$project['thumbnail_url']" :alt="$project['name']" aspect="aspect-[16/8]" />
                </div>

                <div class="p-6 sm:p-8 space-y-6">
                    <div class="space-y-3">
                        <div class="flex flex-wrap gap-2 font-mono text-xs font-bold">
                            <span class="bg-[#2563EB] text-white border-neo px-3 py-1 rounded">{{ $project['category_label'] }}</span>
                            <span class="bg-slate-100 text-[#0F172A] border-neo px-3 py-1 rounded">{{ $project['client_name'] }}</span>
                            @if($project['period'])
                                <span class="bg-[#ECFDF5] text-[#047857] border-neo px-3 py-1 rounded">{{ $project['period'] }}</span>
                            @endif
                        </div>

                        <h1 class="font-heading text-3xl sm:text-5xl font-extrabold uppercase leading-tight text-[#0F172A]">
                            {{ $project['name'] }}
                        </h1>

                        <p class="text-slate-700 text-base sm:text-lg leading-relaxed font-medium">
                            {{ $project['short_description'] }}
                        </p>
                    </div>

                    <div class="prose max-w-none">
                        <p class="font-sans text-slate-700 leading-relaxed">{{ $project['body'] }}</p>
                    </div>

                    <x-project.tech-stack :items="$project['tech_stack']" />

                    <x-project.gallery :images="$project['images'] ?? []" />

                    <div class="flex flex-wrap gap-3 font-mono text-sm font-bold">
                        @if($project['demo_url'])
                            <a href="{{ $project['demo_url'] }}" target="_blank" rel="noopener" class="inline-flex items-center bg-[#2563EB] text-white border-neo shadow-neo-sm px-5 py-3 rounded-md hover:bg-[#1D4ED8]">
                                LIHAT DEMO PROJECT ↗
                            </a>
                        @endif

                        @if($project['github_url'])
                            <a href="{{ $project['github_url'] }}" target="_blank" rel="noopener" class="inline-flex items-center bg-white text-[#0F172A] border-neo shadow-neo-sm px-5 py-3 rounded-md hover:bg-slate-100">
                                LIHAT REPOSITORY ↗
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @if($relatedProjects->isNotEmpty())
                <section class="pt-14">
                    <x-common.section-header
                        number="02"
                        tag="PROJECT TERKAIT"
                        title="PROJECT DENGAN KATEGORI SERUPA"
                        subtitle="Referensi project lain dalam kategori yang sama." />

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($relatedProjects as $relatedProject)
                            <x-project.card :project="$relatedProject" />
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </article>
@endsection
