@props([
    'profile' => [],
])

<section class="relative py-16 lg:py-24 overflow-hidden border-neo-b bg-[#FAF8F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left Column: Hero Intro (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Availability Status Badge with Pulsing Light -->
                <div class="inline-flex items-center gap-2 bg-[#ECFDF5] text-[#047857] border-neo px-4 py-1.5 rounded-full shadow-neo-sm font-mono text-xs font-bold transition-all hover:shadow-neo hover:-translate-y-0.5">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#059669] animate-pulse"></span>
                    <span>{{ $profile['availability_badge'] ?? '● TERSEDIA UNTUK PROJECT FREELANCE & FULL-TIME' }}</span>
                </div>

                <!-- Clean, High-Impact 2-Line Headline (No Crop & No Layout Shift) -->
                <h1 class="font-heading font-extrabold text-3xl sm:text-5xl lg:text-6xl text-[#0F172A] tracking-tight uppercase leading-tight select-none">
                    SOFTWARE ENGINEER<br>
                    <span id="hero-headline-rotator" class="inline-block text-[#2563EB] font-black text-stroke-dark transition-all duration-300 transform min-h-[1.2em]">SOLUSI DIGITAL_</span>
                </h1>

                <!-- Crisp Subtitle Description -->
                <p class="font-sans text-slate-700 text-base sm:text-lg leading-relaxed max-w-xl font-medium">
                    Membangun sistem digital dari backend, web, hingga mobile dengan arsitektur bersih dan pengalaman pengguna yang solid.
                </p>

                <!-- CTA Action Buttons with Micro-Animations -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <x-common.button-primary href="#projects" class="group">
                        <span>JELAJAHI PROJECT</span>
                        <svg class="w-5 h-5 ml-2 transition-transform duration-200 group-hover:translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </x-common.button-primary>

                    <x-common.button-secondary href="{{ $profile['cv_url'] ?? '#' }}" target="_blank" rel="noopener" class="group">
                        <svg class="w-5 h-5 mr-2 transition-transform duration-200 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>UNDUH CV</span>
                    </x-common.button-secondary>
                </div>
            </div>

            <!-- Right Column: Profile Photo Card with Floating Badges (5 Cols) -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md my-6">
                    
                    <!-- Floating Badge 1: Top-Left -->
                    <div class="absolute -top-6 -left-4 z-20 bg-white border-neo px-3.5 py-1.5 rounded-lg shadow-neo text-xs font-mono font-bold flex items-center gap-2 animate-float-slow select-none">
                        <span class="text-[#2563EB]">⚡</span>
                        <span>Clean Code</span>
                    </div>

                    <!-- Floating Badge 2: Top-Right -->
                    <div class="absolute -top-6 -right-4 z-20 bg-[#2563EB] text-white border-neo px-3.5 py-1.5 rounded-lg shadow-neo text-xs font-mono font-bold flex items-center gap-2 animate-float-reverse select-none">
                        <span>🔥</span>
                        <span>Scalable</span>
                    </div>

                    <!-- Floating Badge 3: Bottom-Left (100% Kualitas) -->
                    <div class="absolute -bottom-6 -left-4 z-20 bg-[#FEF3C7] text-[#D97706] border-neo px-3.5 py-1.5 rounded-lg shadow-neo text-xs font-mono font-bold flex items-center gap-2 animate-float-reverse select-none">
                        <span>⭐</span>
                        <span>100% Kualitas</span>
                    </div>

                    <!-- Floating Badge 4: Bottom-Right (5+ Thn Exp) -->
                    <div class="absolute -bottom-6 -right-4 z-20 bg-[#ECFDF5] text-[#059669] border-neo px-3.5 py-1.5 rounded-lg shadow-neo text-xs font-mono font-bold flex items-center gap-2 animate-float-slow select-none">
                        <span>🎯</span>
                        <span>5+ Thn Exp</span>
                    </div>

                    <!-- Profile Card Container -->
                    <div class="bg-white border-neo rounded-2xl p-5 sm:p-6 shadow-neo shadow-neo-hover space-y-4 relative z-10">
                        
                        <!-- Top Bar Signature -->
                        <div class="flex items-center justify-between font-mono text-xs font-bold border-neo-b pb-3">
                            <span class="bg-[#0F172A] text-white px-3 py-1 rounded border-neo">
                                PROFIL DEVELOPER
                            </span>
                            <img src="/images/brand/wdu-logo.svg" alt="Wahyu Dwi Utomo" class="h-8 w-auto">
                        </div>

                        <!-- Photo Frame -->
                        <div class="relative rounded-xl border-neo overflow-hidden bg-slate-100 aspect-square group">
                            <img src="{{ $profile['image_profile'] ?? asset('images/profile/wahyu.png') }}" 
                                 alt="{{ $profile['name'] ?? 'Wahyu Dwi Utomo' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                 onerror="this.onerror=null; this.src='https://placehold.co/600x600/0F172A/FFFFFF?text=Wahyu+Dwi+Utomo';">
                            
                            <div class="absolute bottom-3 left-3 right-3 bg-[#0F172A]/90 backdrop-blur-sm text-white p-3 rounded-lg border-neo text-xs font-mono font-bold flex items-center justify-between">
                                <span class="truncate">{{ $profile['name'] ?? 'Wahyu Dwi Utomo' }}</span>
                                <span class="text-[#059669] flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-[#059669] animate-pulse"></span>
                                    <span>ONLINE</span>
                                </span>
                            </div>
                        </div>

                        <!-- Clean Info Chips -->
                        <div class="flex items-center justify-between font-mono text-xs font-bold pt-1 gap-2">
                            <span class="bg-slate-100 border-neo px-3 py-1.5 rounded text-[#0F172A] truncate">
                                📍 {{ $profile['location'] ?? 'Bekasi / Jakarta' }}
                            </span>
                            <span class="bg-[#EFF6FF] text-[#2563EB] border-neo px-3 py-1.5 rounded flex-shrink-0">
                                💻 Software Dev
                            </span>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- Rotator Script (Single-line Concise Phrases) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const words = ['SOLUSI DIGITAL_', 'WEB & MOBILE_', 'SISTEM SCALABLE_', 'CLEAN ARCHITECTURE_'];
        let wordIndex = 0;
        const rotatorEl = document.getElementById('hero-headline-rotator');

        if (!rotatorEl) return;

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
