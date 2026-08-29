@extends('layouts.public')

@section('title', $title)
@section('description', $description)

@section('content')
    <article class="py-12 sm:py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- 1. Top Editorial Header Bar & Navigation -->
            <div class="flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 font-mono text-xs sm:text-sm font-extrabold text-[#2563EB] hover:underline bg-white border-neo px-4 py-2 rounded-md shadow-neo-sm">
                    <span>←</span>
                    <span>KEMBALI KE KATALOG PROJECT</span>
                </a>

                <div class="flex items-center gap-2 font-mono text-xs font-bold text-slate-500">
                    <span class="bg-white border-neo px-3 py-1 rounded text-[#0F172A] shadow-neo-sm">// CASE STUDY EDITORIAL</span>
                </div>
            </div>

            <!-- 2. News/Editorial Headline Banner -->
            <div class="bg-white border-neo p-6 sm:p-10 rounded-2xl shadow-neo space-y-5">
                
                <!-- Category & Client Badges -->
                <div class="flex flex-wrap items-center gap-2.5 font-mono text-xs font-bold">
                    <span class="bg-[#2563EB] text-white border-neo px-3.5 py-1 rounded-md shadow-neo-sm">
                        {{ $project['category_label'] ?? strtoupper($project['category']) }}
                    </span>
                    <span class="bg-[#FAF8F5] text-[#0F172A] border-neo px-3.5 py-1 rounded-md shadow-neo-sm">
                        🏢 {{ $project['client_name'] }}
                    </span>
                    @if(!empty($project['period']))
                        <span class="bg-[#ECFDF5] text-[#047857] border-neo px-3.5 py-1 rounded-md shadow-neo-sm">
                            📅 {{ $project['period'] }}
                        </span>
                    @endif
                </div>

                <!-- Main Editorial Headline -->
                <h1 class="font-heading text-3xl sm:text-5xl lg:text-6xl font-extrabold uppercase leading-tight text-[#0F172A]">
                    {{ $project['name'] }}
                </h1>

                <!-- Article Byline / Author Bar -->
                <div class="flex items-center gap-4 pt-3 border-t border-slate-200 font-mono text-xs font-bold text-slate-600">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-[#0F172A] text-white flex items-center justify-center text-[10px] border-neo">W</span>
                        <span>WAHYU DWI UTOMO</span>
                    </div>
                    <span>•</span>
                    <span class="text-[#2563EB]">PROJECT PORTFOLIO</span>
                </div>

            </div>

            <!-- 3. Featured Hero Image Cover (Article Cover Photo) -->
            <div class="bg-white border-neo p-3 rounded-2xl shadow-neo overflow-hidden">
                <div class="relative rounded-xl border-neo overflow-hidden bg-slate-100 aspect-[16/9]">
                    <img src="{{ $project['thumbnail_url'] }}" 
                         alt="{{ $project['name'] }}" 
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null; this.src='https://placehold.co/1200x675/0F172A/FFFFFF?text=PROJECT+PREVIEW';">
                </div>
            </div>

            <!-- 4. 2-Column Article Body & Spec Sidebar -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- Main Article Content Column (8 Cols) -->
                <div class="lg:col-span-8 space-y-8">
                    
                    <!-- Article Lead & Body Container (Supports Full Filament RichEditor HTML) -->
                    <div class="bg-white border-neo p-6 sm:p-10 rounded-2xl shadow-neo space-y-6">
                        <h2 class="font-heading font-extrabold text-xl text-[#0F172A] border-neo-b pb-3 uppercase flex items-center gap-2">
                            <span>📰 DESKRIPSI & ULASAN PROYEK</span>
                        </h2>
                        
                        <div class="prose max-w-none font-sans text-slate-800 text-base sm:text-lg leading-relaxed font-medium space-y-4 prose-headings:font-heading prose-headings:font-extrabold prose-a:text-[#2563EB] prose-img:rounded-xl prose-img:border-neo">
                            {!! $project['body'] !!}
                        </div>
                    </div>

                    <!-- Project Gallery Section -->
                    @if(!empty($project['images']))
                        <div class="bg-white border-neo p-6 sm:p-8 rounded-2xl shadow-neo space-y-4">
                            <h3 class="font-heading font-extrabold text-lg text-[#0F172A] border-neo-b pb-3 uppercase">
                                📸 GALERI ANTAARMUKA SYSTEM
                            </h3>
                            <x-project.gallery :images="$project['images']" />
                        </div>
                    @endif

                </div>

                <!-- Right Sidebar Column (4 Cols Sticky Spec Box) -->
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                    
                    <div class="bg-white border-neo p-6 rounded-2xl shadow-neo space-y-6">
                        <h3 class="font-heading font-extrabold text-lg text-[#0F172A] border-neo-b pb-3 uppercase flex items-center justify-between">
                            <span>SPESIFIKASI SISTEM</span>
                            <span class="text-xs font-mono font-bold text-[#2563EB]">INFO</span>
                        </h3>

                        <!-- Meta Info List -->
                        <div class="space-y-4 font-mono text-xs font-bold">
                            <div class="flex flex-col gap-1 border-b border-slate-200 pb-3">
                                <span class="text-slate-400 uppercase">Kategori System</span>
                                <span class="text-[#0F172A] text-sm">{{ $project['category'] }}</span>
                            </div>

                            <div class="flex flex-col gap-1 border-b border-slate-200 pb-3">
                                <span class="text-slate-400 uppercase">Client / Perusahaan</span>
                                <span class="text-[#0F172A] text-sm">{{ $project['client_name'] }}</span>
                            </div>

                            @if(!empty($project['period']))
                                <div class="flex flex-col gap-1 border-b border-slate-200 pb-3">
                                    <span class="text-slate-400 uppercase">Periode Pengerjaan</span>
                                    <span class="text-[#0F172A] text-sm">{{ $project['period'] }}</span>
                                </div>
                            @endif

                            <!-- Tech Stack List -->
                            <div class="space-y-2 pt-1">
                                <span class="text-slate-400 uppercase block">// Tech Stack Utama</span>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($project['tech_stack'] as $tech)
                                        @php
                                            $techName = is_array($tech) ? ($tech['name'] ?? '') : $tech;
                                        @endphp
                                        <span class="bg-[#EFF6FF] text-[#2563EB] border-neo px-3 py-1 rounded text-xs">
                                            {{ $techName }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 border-t border-slate-300 space-y-3 font-mono text-xs font-bold">
                            @if(!empty($project['demo_url']))
                                <a href="{{ $project['demo_url'] }}" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center bg-[#2563EB] hover:bg-[#1D4ED8] text-white border-neo shadow-neo-sm px-5 py-3 rounded-lg transition-all">
                                    <span>LIHAT DEMO PROJECT</span>
                                    <span class="ml-2">↗</span>
                                </a>
                            @endif

                            @if(!empty($project['github_url']))
                                <a href="{{ $project['github_url'] }}" target="_blank" rel="noopener" class="w-full inline-flex items-center justify-center bg-white hover:bg-slate-100 text-[#0F172A] border-neo shadow-neo-sm px-5 py-3 rounded-lg transition-all">
                                    <span>LIHAT REPOSITORY</span>
                                    <span class="ml-2">↗</span>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>

            </div>

            <!-- Related Projects Grid Section -->
            @if($relatedProjects->isNotEmpty())
                <section class="pt-14 border-t-2 border-[#0F172A]">
                    <x-common.section-header
                        number="02"
                        tag="PROJECT TERKAIT"
                        title="PROJECT DENGAN KATEGORI SERUPA"
                        subtitle="Referensi project lain dalam kategori sistem yang sama." />

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pt-6">
                        @foreach($relatedProjects as $relatedProject)
                            <x-project.card :project="$relatedProject" />
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </article>
@endsection
