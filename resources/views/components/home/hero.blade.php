@props([
    'profile' => [],
])

<section class="relative py-12 lg:py-20 overflow-hidden border-neo-b bg-[#FAF8F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            
            <!-- Left Column: Hero Intro (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Availability Status Badge -->
                <div class="inline-flex items-center gap-2 bg-[#ECFDF5] text-[#047857] border-neo px-3.5 py-1.5 rounded-full shadow-neo-sm font-mono text-xs font-bold">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#059669] animate-pulse"></span>
                    <span>{{ $profile['availability_badge'] ?? '● TERSEDIA UNTUK PROJECT FREELANCE & FULL-TIME' }}</span>
                </div>

                <!-- Main Big Headline -->
                <h1 class="font-heading font-extrabold text-3xl sm:text-5xl lg:text-6xl text-[#0F172A] tracking-tight uppercase leading-[1.08]">
                    BUILDING SCALABLE<br>
                    <span class="text-stroke-dark text-[#2563EB]">FULLSTACK_</span><br>
                    WEB APPLICATIONS!
                </h1>

                <!-- Subtitle Description -->
                <p class="font-sans text-slate-700 text-base sm:text-lg leading-relaxed max-w-2xl font-medium">
                    {{ $profile['bio'] ?? 'Mengembangkan aplikasi web modern dari arsitektur backend Laravel yang kokoh hingga antarmuka pengguna frontend yang responsif, cepat, dan intuitif.' }}
                </p>

                <!-- CTA Action Buttons -->
                <div class="pt-2 flex flex-wrap items-center gap-4">
                    <x-common.button-primary href="#projects">
                        <span>EXPLORE PROJECTS</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </x-common.button-primary>

                    <x-common.button-secondary href="{{ $profile['cv_url'] ?? '#' }}" target="_blank" rel="noopener">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>UNDUH CV</span>
                    </x-common.button-secondary>
                </div>
            </div>

            <!-- Right Column: Framed Profile Photo Card (5 Cols) -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-full max-w-md">
                    
                    <!-- Profile Card Container -->
                    <div class="bg-white border-neo rounded-2xl p-4 sm:p-5 shadow-neo shadow-neo-hover space-y-4">
                        
                        <!-- Top Bar Signature -->
                        <div class="flex items-center justify-between font-mono text-xs font-bold border-neo-b pb-3">
                            <span class="bg-[#0F172A] text-white px-3 py-1 rounded border-neo">
                                PORTFOLIO OWNER
                            </span>
                            <span class="text-[#2563EB] font-extrabold tracking-wider">
                                WAHYU.DEV
                            </span>
                        </div>

                        <!-- Photo Frame -->
                        <div class="relative rounded-xl border-neo overflow-hidden bg-slate-100 aspect-square group">
                            <img src="{{ $profile['image_profile'] ?? asset('images/profile/wahyu.png') }}" 
                                 alt="{{ $profile['name'] ?? 'Wahyu Dwi Utomo' }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                 onerror="this.onerror=null; this.src='https://placehold.co/600x600/0F172A/FFFFFF?text=Wahyu+Dwi+Utomo';">
                            
                            <div class="absolute bottom-3 left-3 right-3 bg-[#0F172A]/90 backdrop-blur-sm text-white p-3 rounded-lg border-neo text-xs font-mono font-bold flex items-center justify-between">
                                <span class="truncate">{{ $profile['name'] ?? 'Wahyu Dwi Utomo' }}</span>
                                <span class="text-[#059669]">● ONLINE</span>
                            </div>
                        </div>

                        <!-- Floating Info Chips -->
                        <div class="flex flex-wrap gap-2 font-mono text-xs font-bold pt-1">
                            <span class="bg-slate-100 border-neo px-3 py-1 rounded text-[#0F172A]">
                                📍 {{ $profile['location'] ?? 'Bekasi / Jakarta' }}
                            </span>
                            <span class="bg-[#EFF6FF] text-[#2563EB] border-neo px-3 py-1 rounded">
                                💻 Fullstack Web Dev
                            </span>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
