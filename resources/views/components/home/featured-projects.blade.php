@props([
    'projects' => [],
])

<section id="projects" class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <x-common.section-header 
            number="04" 
            tag="KATALOG PROJECT" 
            title="PROJECT PILIHAN & KARYA TERBARU" 
            subtitle="Koleksi studi kasus dan sistem web yang dikembangkan menggunakan arsitektur bersih, performa optimal, dan antarmuka modern." />

        <!-- Cards Grid -->
        @if(!empty($projects))
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <x-project.card :project="$project" />
                @endforeach
            </div>

            <!-- View All Projects Button -->
            <div class="pt-12 text-center">
                <x-common.button-secondary href="{{ route('projects.index') }}">
                    <span>LIHAT SEMUA PROJECT (20+)</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </x-common.button-secondary>
            </div>
        @else
            <x-common.empty-state 
                title="Belum Ada Project Pilihan" 
                message="Daftar project pilihan sedang dalam proses sinkronisasi data." />
        @endif

    </div>
</section>
