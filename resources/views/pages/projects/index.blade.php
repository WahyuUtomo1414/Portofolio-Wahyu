@extends('layouts.public')

@section('title', $title)
@section('description', $description)

@section('content')
    <section class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <!-- Header Section -->
            <x-common.section-header
                number="01"
                tag="KATALOG PROJECT"
                title="SEMUA PROJECT PORTOFOLIO"
                subtitle="Kumpulan project web, sistem bisnis enterprise, aplikasi mobile POS, dan solusi digital yang pernah dikembangkan." />

            <!-- Search Bar & Filter Controls Container -->
            <div class="bg-white border-neo p-6 rounded-xl shadow-neo space-y-6">
                
                <!-- Search Form -->
                <form action="{{ route('projects.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    @if($selectedCategory !== '')
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif
                    
                    <div class="relative flex-grow font-mono text-sm">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            🔍
                        </div>
                        <input type="text" 
                               name="q" 
                               value="{{ $search }}" 
                               placeholder="Cari nama project, client, atau tech stack (contoh: ERP, Laravel, Vue, POS)..." 
                               class="w-full bg-[#FAF8F5] border-neo rounded-lg pl-10 pr-10 py-3 text-[#0F172A] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#2563EB] font-sans font-medium">
                        
                        @if($search !== '')
                            <a href="{{ route('projects.index', array_filter(['category' => $selectedCategory])) }}" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-red-500 font-bold">
                                ✕
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="inline-flex items-center justify-center font-mono font-bold text-sm bg-[#2563EB] hover:bg-[#1D4ED8] text-white px-6 py-3 rounded-lg border-neo shadow-neo-sm hover:shadow-neo cursor-pointer transition-all">
                        <span>CARI PROJECT</span>
                    </button>
                </form>

                <!-- Category Chips Filter -->
                <div class="space-y-2">
                    <div class="font-mono text-xs font-bold text-slate-500 uppercase">// FILTER KATEGORI</div>
                    <div class="flex flex-wrap gap-2.5 font-mono text-xs font-bold">
                        <a href="{{ route('projects.index', array_filter(['q' => $search])) }}" 
                           class="border-neo px-3.5 py-1.5 rounded-md transition-all shadow-neo-sm {{ $selectedCategory === '' ? 'bg-[#2563EB] text-white' : 'bg-[#FAF8F5] hover:bg-slate-100 text-[#0F172A]' }}">
                            SEMUA ({{ \App\Support\PortfolioData::projects()->count() }})
                        </a>
                        
                        @foreach($categories as $category)
                            @php
                                $count = \App\Support\PortfolioData::projects()->where('category', $category)->count();
                            @endphp
                            <a href="{{ route('projects.index', array_filter(['category' => $category, 'q' => $search])) }}" 
                               class="border-neo px-3.5 py-1.5 rounded-md transition-all shadow-neo-sm {{ $selectedCategory === $category ? 'bg-[#2563EB] text-white' : 'bg-[#FAF8F5] hover:bg-slate-100 text-[#0F172A]' }}">
                                {{ strtoupper($category) }} ({{ $count }})
                            </a>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- Active Search Summary Filter Bar -->
            @if($search !== '' || $selectedCategory !== '')
                <div class="flex items-center justify-between font-mono text-xs font-bold bg-[#EFF6FF] border-neo p-4 rounded-lg text-[#2563EB]">
                    <div>
                        <span>MENAMPILKAN HASIL UNTUK: </span>
                        @if($search !== '')
                            <span class="bg-white border-neo px-2 py-0.5 rounded text-[#0F172A]">Pencarian: "{{ $search }}"</span>
                        @endif
                        @if($selectedCategory !== '')
                            <span class="bg-white border-neo px-2 py-0.5 rounded text-[#0F172A]">Kategori: {{ $selectedCategory }}</span>
                        @endif
                    </div>
                    <a href="{{ route('projects.index') }}" class="underline hover:text-red-600">RESET FILTER ✕</a>
                </div>
            @endif

            <!-- Project Cards Grid -->
            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <x-project.card :project="$project" />
                    @endforeach
                </div>

                <!-- Neo-Brutalist Pagination Links -->
                <div class="pt-10 flex flex-col sm:flex-row items-center justify-between gap-4 border-t-2 border-[#0F172A] pt-8">
                    <div class="font-mono text-xs font-bold text-slate-600">
                        MENAMPILKAN {{ $projects->firstItem() }} - {{ $projects->lastItem() }} DARI {{ $projects->total() }} PROJECT
                    </div>

                    <div class="flex items-center gap-2 font-mono text-xs font-bold">
                        <!-- Previous Page Link -->
                        @if ($projects->onFirstPage())
                            <span class="bg-slate-200 text-slate-400 border-neo px-4 py-2 rounded-md cursor-not-allowed">
                                « PREV
                            </span>
                        @else
                            <a href="{{ $projects->previousPageUrl() }}" class="bg-white text-[#0F172A] hover:bg-[#2563EB] hover:text-white border-neo px-4 py-2 rounded-md shadow-neo-sm transition-all">
                                « PREV
                            </a>
                        @endif

                        <!-- Page Number Links -->
                        @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                            <a href="{{ $url }}" class="border-neo px-3.5 py-2 rounded-md shadow-neo-sm transition-all {{ $page == $projects->currentPage() ? 'bg-[#2563EB] text-white font-extrabold' : 'bg-white text-[#0F172A] hover:bg-slate-100' }}">
                                {{ $page }}
                            </a>
                        @endforeach

                        <!-- Next Page Link -->
                        @if ($projects->hasMorePages())
                            <a href="{{ $projects->nextPageUrl() }}" class="bg-white text-[#0F172A] hover:bg-[#2563EB] hover:text-white border-neo px-4 py-2 rounded-md shadow-neo-sm transition-all">
                                NEXT »
                            </a>
                        @else
                            <span class="bg-slate-200 text-slate-400 border-neo px-4 py-2 rounded-md cursor-not-allowed">
                                NEXT »
                            </span>
                        @endif
                    </div>
                </div>
            @else
                <x-common.empty-state
                    title="Project Tidak Ditemukan"
                    message="Tidak ditemukan project yang sesuai dengan kata kunci pencarian atau kategori yang Anda pilih." />
            @endif

        </div>
    </section>
@endsection
