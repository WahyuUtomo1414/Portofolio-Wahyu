@props([
    'experiences' => [],
])

<section id="experience" class="py-16 lg:py-24 border-neo-b bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <x-common.section-header 
            number="02" 
            tag="RIWAYAT KARIER" 
            title="PENGALAMAN KERJA & PENDIDIKAN" 
            subtitle="Jejak langkah profesional dalam industri teknologi informasi, mulai dari pendidikan akademis hingga posisi rekayasa perangkat lunak." />

        <!-- Bento Box Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($experiences as $item)
                <div class="bg-[#FAF8F5] border-neo p-6 rounded-lg shadow-neo shadow-neo-hover space-y-4 flex flex-col justify-between">
                    <div class="space-y-3">
                        
                        <!-- Top Header: Badge & Date -->
                        <div class="flex items-center justify-between font-mono text-xs font-bold gap-2">
                            <span class="bg-[#0F172A] text-white px-3 py-1 rounded border-neo text-[11px] uppercase tracking-wider">
                                {{ strtoupper($item['key'] ?? 'EXPERIENCE') }}
                            </span>
                            <span class="bg-white border-neo px-3 py-1 rounded text-[#2563EB] shadow-neo-sm">
                                📅 {{ $item['date_range'] }}
                            </span>
                        </div>

                        <!-- Title & Institute -->
                        <div>
                            <h3 class="font-heading font-extrabold text-xl text-[#0F172A]">
                                {{ $item['title'] }}
                            </h3>
                            <div class="font-mono text-sm text-[#2563EB] font-bold mt-0.5">
                                @ {{ $item['institute'] }}
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="font-sans text-sm text-slate-600 leading-relaxed font-medium">
                            {{ $item['description'] }}
                        </p>
                    </div>

                    <!-- Bottom Accent Bar -->
                    <div class="pt-3 border-t border-slate-300 font-mono text-xs text-slate-500 font-bold flex items-center justify-between">
                        <span>STATUS: COMPLETED / ONGOING</span>
                        <span>PERFORMED</span>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
