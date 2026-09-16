@props([
    'profile' => [],
    'hero' => [],
])

<section class="relative py-10 sm:py-16 lg:py-24 overflow-hidden border-neo-b bg-[#FAF8F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            
            <!-- Left Column: Hero Intro (7 Cols) -->
            <div class="lg:col-span-7 space-y-5 sm:space-y-6 text-left">
                
                <!-- Availability Status Badge (Responsive text size for mobile) -->
                <div class="inline-flex items-center gap-2 bg-[#ECFDF5] text-[#047857] border-neo px-3 sm:px-4 py-1.5 rounded-full shadow-neo-sm font-mono text-[11px] sm:text-xs font-bold transition-all hover:shadow-neo hover:-translate-y-0.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#059669] animate-pulse flex-shrink-0"></span>
                    <span class="truncate sm:whitespace-normal">{{ $profile['availability_badge'] ?? 'TERBUKA UNTUK PROJECT FREELANCE & FULL-TIME' }}</span>
                </div>

                <!-- Clean, High-Impact 2-Line Headline (Responsive scaling for mobile screens) -->
                <h1 class="font-heading font-extrabold text-2xl sm:text-4xl lg:text-6xl text-[#0F172A] tracking-tight uppercase leading-tight select-none">
                    SOFTWARE ENGINEER<br>
                    <span id="hero-headline-rotator" data-rotator="{{ $hero['rotator_json'] ?? '[]' }}" class="inline-block text-[#2563EB] font-black text-stroke-dark transition-all duration-300 transform min-h-[1.2em]">{{ $hero['rotator_words'][0] ?? 'SOLUSI DIGITAL_' }}</span>
                </h1>

                <!-- Subtitle Description -->
                <p class="font-sans text-slate-700 text-sm sm:text-base lg:text-lg leading-relaxed max-w-xl font-medium">
                    {{ $hero['subtitle'] ?? 'Membangun produk digital yang rapi, scalable, mudah dirawat, dan nyaman digunakan.' }}
                </p>

                <!-- CTA Action Buttons: Primary WhatsApp Direct + Secondary Studi Kasus -->
                <div class="pt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5 sm:gap-4">
                    <x-common.button-primary href="{{ $profile['wa_direct_url'] ?? '#' }}" target="_blank" rel="noopener" class="group justify-center bg-[#059669] hover:bg-[#047857] border-neo shadow-neo shadow-neo-hover">
                        <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.754zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l.24.384-1.03 3.762 3.842-1.007.391.232z"/>
                        </svg>
                        <span>{{ $hero['cta_primary_label'] ?? 'DISKUSI PROJECT' }}</span>
                    </x-common.button-primary>

                    <x-common.button-secondary href="#projects" class="group justify-center">
                        <span>{{ $hero['cta_secondary_label'] ?? 'LIHAT STUDI KASUS' }}</span>
                        <svg class="w-5 h-5 ml-2 transition-transform duration-200 group-hover:translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </x-common.button-secondary>
                </div>

                <!-- Ghost link + Micro copy for trust -->
                <div class="pt-1 flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4 font-mono text-xs">
                    <a href="{{ $profile['email_direct_url'] ?? '#' }}" class="inline-flex items-center gap-1.5 text-slate-600 hover:text-[#2563EB] font-bold underline underline-offset-4 decoration-slate-300 hover:decoration-[#2563EB] transition">
                        <span>✉️ {{ $hero['ghost_link_label'] ?? 'atau email langsung' }} →</span>
                    </a>
                    <span class="hidden sm:inline text-slate-300">·</span>
                    <span class="text-slate-500 font-medium">
                        ⚡ {{ $hero['micro_copy'] ?? 'Biasanya balas WhatsApp dalam 24 jam kerja.' }}
                    </span>
                </div>
            </div>

            <!-- Right Column: Profile Photo Card with Responsive Floating Badges (5 Cols) -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md my-4 sm:my-6 px-2 sm:px-0">
                    
                    <!-- Floating Badge 1: Top-Left (S.Kom BSI - Unique & Verifiable) -->
                    <div class="absolute -top-4 left-1 sm:-top-6 sm:-left-4 z-20 bg-white border-neo px-2.5 sm:px-3.5 py-1 sm:py-1.5 rounded-lg shadow-neo text-[10px] sm:text-xs font-mono font-bold flex items-center gap-1.5 sm:gap-2 animate-float-slow select-none">
                        <span class="text-[#2563EB]">{{ $hero['badges'][0]['icon'] ?? '🎓' }}</span>
                        <span>{{ $hero['badges'][0]['label'] ?? 'S.Kom · BSI 2025' }}</span>
                    </div>

                    <!-- Floating Badge 2: Bottom-Right (Current Role - Kredibilitas) -->
                    <div class="absolute -bottom-4 right-1 sm:-bottom-6 sm:-right-4 z-20 bg-[#2563EB] text-white border-neo px-2.5 sm:px-3.5 py-1 sm:py-1.5 rounded-lg shadow-neo text-[10px] sm:text-xs font-mono font-bold flex items-center gap-1.5 sm:gap-2 animate-float-reverse select-none">
                        <span>{{ $hero['badges'][1]['icon'] ?? '💼' }}</span>
                        <span>{{ $hero['badges'][1]['label'] ?? 'Fullstack SE · Keysoft' }}</span>
                    </div>

                    <!-- Profile Card Container -->
                    <div class="bg-white border-neo rounded-2xl p-4 sm:p-6 shadow-neo shadow-neo-hover space-y-3 sm:space-y-4 relative z-10">
                        
                        <!-- Top Bar Signature -->
                        <div class="flex items-center justify-between font-mono text-xs font-bold border-neo-b pb-2.5 sm:pb-3">
                            <span class="bg-[#0F172A] text-white px-2.5 py-0.5 sm:px-3 sm:py-1 rounded border-neo text-[10px] sm:text-xs">
                                {{ $hero['profile_label'] ?? 'PROFIL DEVELOPER' }}
                            </span>
                            <img src="/images/brand/wdu-logo.svg" alt="Wahyu Dwi Utomo" class="h-8 w-auto">
                        </div>

                        <!-- Photo Frame -->
                        <div class="relative rounded-xl border-neo overflow-hidden bg-slate-100 aspect-square group">
                            <img src="{{ $profile['image_profile'] ?? asset('images/profile/wahyu.png') }}" 
                                 alt="{{ $profile['name'] ?? 'Wahyu Dwi Utomo' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                 onerror="this.onerror=null; this.src='https://placehold.co/600x600/0F172A/FFFFFF?text=Wahyu+Dwi+Utomo';">
                            
                            <div class="absolute bottom-2.5 left-2.5 right-2.5 sm:bottom-3 sm:left-3 sm:right-3 bg-[#0F172A]/90 backdrop-blur-sm text-white p-2.5 sm:p-3 rounded-lg border-neo text-[11px] sm:text-xs font-mono font-bold flex items-center justify-between">
                                <span class="truncate">{{ $profile['name'] ?? 'Wahyu Dwi Utomo' }}</span>
                                <span class="text-[#059669] flex items-center gap-1.5 flex-shrink-0">
                                    <span class="w-2 h-2 rounded-full bg-[#059669] animate-pulse"></span>
                                    <span>{{ $hero['status_label'] ?? 'AVAILABLE' }}</span>
                                </span>
                            </div>
                        </div>

                        <!-- Clean Info Chips -->
                        <div class="flex items-center justify-between font-mono text-[11px] sm:text-xs font-bold pt-0.5 sm:pt-1 gap-2">
                            <span class="bg-slate-100 border-neo px-2.5 sm:px-3 py-1 sm:py-1.5 rounded text-[#0F172A] truncate">
                                📍 {{ $profile['location'] ?? 'Jakarta, Indonesia' }}
                            </span>
                            <span class="bg-[#EFF6FF] text-[#2563EB] border-neo px-2.5 sm:px-3 py-1 sm:py-1.5 rounded flex-shrink-0">
                                💻 {{ $hero['skill_chip'] ?? 'Software Engineer' }}
                            </span>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Rotator Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let wordIndex = 0;
        const rotatorEl = document.getElementById('hero-headline-rotator');

        if (!rotatorEl) return;
        const words = JSON.parse(rotatorEl.dataset.rotator || '[]');
        if (!words.length) return;

        setInterval(() => {
            rotatorEl.style.opacity = '0';
            rotatorEl.style.transform = 'translateY(-8px)';

            setTimeout(() => {
                wordIndex = (wordIndex + 1) % words.length;
                rotatorEl.textContent = words[wordIndex];
                rotatorEl.style.opacity = '1';
                rotatorEl.style.transform = 'translateY(0)';
            }, 250);
        }, 3000);
    });
</script>
