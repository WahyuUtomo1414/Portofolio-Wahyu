@props([
    'clients' => [],
])

@php
    $chunks = array_chunk($clients, 4);
@endphp

<section class="py-16 lg:py-20 border-neo-b bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header Section -->
        <x-common.section-header 
            number="03" 
            tag="MITRA & CLIENT" 
            title="DIPERCAYA OLEH PERUSAHAAN & CLIENT" 
            subtitle="Daftar perusahaan, instansi, dan klien yang telah mempercayakan pengembangan sistem web dan aplikasi mereka." />

        <!-- 4-Card Grid Container with Auto-Flipping Batch Animation -->
        <div id="client-slides-container" class="relative min-h-[180px]">
            @foreach($chunks as $index => $chunk)
                <div class="client-slide-batch {{ $index === 0 ? 'grid' : 'hidden' }} grid-cols-2 md:grid-cols-4 gap-6 transition-all duration-500 ease-in-out">
                    @foreach($chunk as $client)
                        @php
                            $name = data_get($client, 'name');
                            $logo = data_get($client, 'logo');
                            $desc = data_get($client, 'desc');
                        @endphp

                        <div class="bg-[#FAF8F5] border-neo p-6 rounded-lg shadow-neo shadow-neo-hover flex flex-col items-center justify-center text-center space-y-3 transition-all duration-300">
                            
                            <!-- Logo Frame -->
                            <div class="w-16 h-16 rounded border-neo bg-white p-2 flex items-center justify-center shadow-neo-sm">
                                @if($logo)
                                    <img src="{{ str_starts_with($logo, 'http') ? $logo : asset($logo) }}" alt="{{ $name }}" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='https://placehold.co/120x120/0F172A/FFFFFF?text=CLIENT';">
                                @else
                                    <span class="font-mono font-bold text-xs text-[#0F172A]">CLIENT</span>
                                @endif
                            </div>

                            <!-- Name & Description -->
                            <div>
                                <h4 class="font-heading font-extrabold text-sm sm:text-base text-[#0F172A] leading-snug">
                                    {{ $name }}
                                </h4>
                                @if($desc)
                                    <p class="font-sans text-xs text-slate-500 font-medium mt-1 line-clamp-1">
                                        {{ $desc }}
                                    </p>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Pagination Controls / Dots if total batches > 1 -->
        @if(count($chunks) > 1)
            <div class="flex items-center justify-center gap-2 pt-2 font-mono">
                @foreach($chunks as $index => $chunk)
                    <button type="button" 
                            data-slide-index="{{ $index }}"
                            class="client-dot h-3 rounded-full border-neo transition-all duration-300 cursor-pointer {{ $index === 0 ? 'bg-[#2563EB] w-8 shadow-neo-sm' : 'bg-slate-300 w-3' }}"
                            aria-label="Slide batch {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>
        @endif

    </div>
</section>

<!-- Auto Flip / Rotate Script for Client Batches -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.client-slide-batch');
        const dots = document.querySelectorAll('.client-dot');
        if (slides.length <= 1) return;

        let currentSlide = 0;
        let slideInterval = null;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('hidden');
                    slide.classList.add('grid');
                } else {
                    slide.classList.add('hidden');
                    slide.classList.remove('grid');
                }
            });

            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('bg-[#2563EB]', 'w-8', 'shadow-neo-sm');
                    dot.classList.remove('bg-slate-300', 'w-3');
                } else {
                    dot.classList.remove('bg-[#2563EB]', 'w-8', 'shadow-neo-sm');
                    dot.classList.add('bg-slate-300', 'w-3');
                }
            });

            currentSlide = index;
        }

        function startAutoSlide() {
            slideInterval = setInterval(() => {
                const nextSlide = (currentSlide + 1) % slides.length;
                showSlide(nextSlide);
            }, 4000);
        }

        startAutoSlide();

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                clearInterval(slideInterval);
                showSlide(i);
                startAutoSlide();
            });
        });
    });
</script>
