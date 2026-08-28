@props([
    'education' => [],
    'experience' => [],
])

<section id="experience" class="py-16 lg:py-24 border-neo-b bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <x-common.section-header 
            number="02" 
            tag="RIWAYAT KARIER & PENDIDIKAN" 
            title="MY JOURNEY: EDUCATION & EXPERIENCE" 
            subtitle="Jejak langkah perjalanan pendidikan dan pengalaman kerja profesional dalam industri pengembangan perangkat lunak." />

        <!-- 2 Column Grid Layout (Left: Education, Right: Experience) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-12 relative font-sans">
            
            <!-- Left Column: Education -->
            <div class="space-y-6">
                
                <!-- Column Sub-Header Badge -->
                <div class="flex items-center justify-between pb-2 border-b-2 border-[#0F172A]">
                    <div class="inline-flex items-center gap-2 bg-[#EFF6FF] border-neo px-4 py-2 rounded-full font-mono text-sm font-bold text-[#2563EB] shadow-neo-sm">
                        <div class="relative flex items-center justify-center w-3.5 h-3.5">
                            <span class="absolute inline-flex w-full h-full animate-ping rounded-full bg-[#2563EB] opacity-75"></span>
                            <span class="relative inline-flex w-2.5 h-2.5 rounded-full bg-[#2563EB]"></span>
                        </div>
                        <span>EDUCATION</span>
                    </div>
                    <span class="font-mono text-xs font-bold text-slate-400">// ACADEMIC BACKGROUND</span>
                </div>

                <!-- Vertical Timeline Container -->
                <div class="relative pt-4 space-y-8">
                    <!-- Vertical Timeline Line (Centered exactly at left-4) -->
                    <div class="absolute left-4 top-4 bottom-4 w-1 bg-[#0F172A] -translate-x-1/2 z-0"></div>

                    @foreach($education as $edu)
                        <div class="relative group">
                            <!-- Timeline Bullet Dot (Centered exactly at left-4 over the vertical line) -->
                            <div class="absolute left-4 top-1.5 -translate-x-1/2 z-10 w-5 h-5 rounded-full bg-[#2563EB] border-neo shadow-neo-sm"></div>

                            <!-- Content with margin-left for spacing -->
                            <div class="ml-9 space-y-3">
                                <!-- Date Badge -->
                                <div>
                                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-md bg-[#FAF8F5] border-neo shadow-neo-sm font-mono text-xs font-bold text-[#0F172A]">
                                        <span class="text-[#2563EB]">🎓</span>
                                        <span>{{ $edu['date_range'] }}</span>
                                    </div>
                                </div>

                                <!-- Timeline Card -->
                                <div class="bg-white p-5 rounded-lg border-neo shadow-neo shadow-neo-hover space-y-3">
                                    <div class="flex items-start gap-4">
                                        @if($edu['logo'])
                                            <div class="w-12 h-12 rounded border-neo bg-slate-100 p-1 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                                <img src="{{ $edu['logo'] }}" alt="{{ $edu['institute'] }}" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='https://placehold.co/100x100/0F172A/FFFFFF?text=EDU';">
                                            </div>
                                        @else
                                            <div class="w-12 h-12 rounded border-neo bg-[#2563EB] text-white flex-shrink-0 flex items-center justify-center font-mono font-bold text-base shadow-neo-sm">
                                                EDU
                                            </div>
                                        @endif

                                        <div class="space-y-1">
                                            <h4 class="font-heading font-extrabold text-lg sm:text-xl text-[#0F172A] leading-snug group-hover:text-[#2563EB] transition-colors">
                                                {{ $edu['institute'] }}
                                            </h4>
                                            <p class="font-mono text-xs font-bold text-[#2563EB]">
                                                {{ $edu['title'] }}
                                            </p>
                                            @if($edu['description'])
                                                <p class="font-sans text-xs sm:text-sm text-slate-600 leading-relaxed font-medium pt-1">
                                                    {{ $edu['description'] }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

            <!-- Right Column: Experience / Work -->
            <div class="space-y-6">
                
                <!-- Column Sub-Header Badge -->
                <div class="flex items-center justify-between pb-2 border-b-2 border-[#0F172A]">
                    <div class="inline-flex items-center gap-2 bg-[#ECFDF5] border-neo px-4 py-2 rounded-full font-mono text-sm font-bold text-[#059669] shadow-neo-sm">
                        <div class="relative flex items-center justify-center w-3.5 h-3.5">
                            <span class="absolute inline-flex w-full h-full animate-ping rounded-full bg-[#059669] opacity-75"></span>
                            <span class="relative inline-flex w-2.5 h-2.5 rounded-full bg-[#059669]"></span>
                        </div>
                        <span>EXPERIENCE & WORK</span>
                    </div>
                    <span class="font-mono text-xs font-bold text-slate-400">// WORK HISTORY</span>
                </div>

                <!-- Vertical Timeline Container -->
                <div class="relative pt-4 space-y-8">
                    <!-- Vertical Timeline Line (Centered exactly at left-4) -->
                    <div class="absolute left-4 top-4 bottom-4 w-1 bg-[#0F172A] -translate-x-1/2 z-0"></div>

                    @foreach($experience as $exp)
                        <div class="relative group">
                            <!-- Timeline Bullet Dot (Centered exactly at left-4 over the vertical line) -->
                            <div class="absolute left-4 top-1.5 -translate-x-1/2 z-10 w-5 h-5 rounded-full bg-[#059669] border-neo shadow-neo-sm"></div>

                            <!-- Content with margin-left for spacing -->
                            <div class="ml-9 space-y-3">
                                <!-- Date Badge -->
                                <div>
                                    <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-md bg-[#FAF8F5] border-neo shadow-neo-sm font-mono text-xs font-bold text-[#0F172A]">
                                        <span class="text-[#059669]">⚡</span>
                                        <span>{{ $exp['date_range'] }}</span>
                                    </div>
                                </div>

                                <!-- Timeline Card -->
                                <div class="bg-white p-5 rounded-lg border-neo shadow-neo shadow-neo-hover space-y-3">
                                    <div class="flex items-start gap-4">
                                        @if($exp['logo'])
                                            <div class="w-12 h-12 rounded border-neo bg-slate-100 p-1 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                                <img src="{{ $exp['logo'] }}" alt="{{ $exp['institute'] }}" class="w-full h-full object-contain" onerror="this.onerror=null; this.src='https://placehold.co/100x100/0F172A/FFFFFF?text=WORK';">
                                            </div>
                                        @else
                                            <div class="w-12 h-12 rounded border-neo bg-[#059669] text-white flex-shrink-0 flex items-center justify-center font-mono font-bold text-base shadow-neo-sm">
                                                WORK
                                            </div>
                                        @endif

                                        <div class="space-y-1">
                                            <h4 class="font-heading font-extrabold text-lg sm:text-xl text-[#0F172A] leading-snug group-hover:text-[#059669] transition-colors">
                                                {{ $exp['title'] }}
                                            </h4>
                                            <p class="font-mono text-xs font-bold text-[#059669]">
                                                @ {{ $exp['institute'] }}
                                            </p>
                                            @if($exp['description'])
                                                <p class="font-sans text-xs sm:text-sm text-slate-600 leading-relaxed font-medium pt-1">
                                                    {{ $exp['description'] }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>
</section>
