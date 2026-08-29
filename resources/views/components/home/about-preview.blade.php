@props([
    'values' => [],
    'profile' => [],
    'section' => [],
])

<section id="about" class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Header Section -->
        <x-common.section-header 
            :number="$section['number'] ?? '01'"
            :tag="$section['tag'] ?? 'TENTANG SAYA & KEUNGGULAN'"
            :title="$section['title'] ?? 'FILOSOFI & KEUNGGULAN KERJA'"
            :subtitle="$section['subtitle'] ?? 'Prinsip utama yang saya terapkan saat membangun kode, arsitektur sistem, dan pengalaman pengguna.'" />

        <!-- Kartu profil ringkas -->
        <div class="bg-white border-neo p-6 sm:p-8 rounded-xl shadow-neo grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            <div class="lg:col-span-4 flex flex-col items-center sm:items-start space-y-3 border-neo-b lg:border-neo-b-0 lg:border-neo-r lg:pr-8 pb-6 lg:pb-0">
                <div class="inline-flex items-center gap-2 bg-[#2563EB] text-white px-3 py-1 rounded border-neo font-mono text-xs font-bold">
                    <span>💡 TENTANG SAYA</span>
                </div>
                <h3 class="font-heading font-extrabold text-2xl text-[#0F172A]">
                    {{ $profile['name'] }}
                </h3>
                <p class="font-mono text-xs font-bold text-[#2563EB]">
                    {{ $profile['role'] }}
                </p>
                <div class="font-mono text-xs text-slate-500 font-bold">
                    📍 {{ $profile['location'] }}
                </div>
            </div>

            <div class="lg:col-span-8 lg:pl-4 space-y-3 font-sans">
                <h4 class="font-heading font-bold text-lg text-[#0F172A] uppercase">DESKRIPSI PROFIL:</h4>
                <p class="text-slate-700 text-sm sm:text-base leading-relaxed font-medium">
                    {{ $profile['description'] }}
                </p>
                <div class="pt-2 flex flex-wrap gap-2 font-mono text-xs font-bold">
                    @foreach($section['chips'] ?? [] as $chip)
                        <span class="bg-[#EFF6FF] text-[#2563EB] border-neo px-3 py-1 rounded">{{ $chip }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 4 Grid Box Values -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($values as $val)
                <div class="bg-white border-neo p-6 rounded-lg shadow-neo shadow-neo-hover space-y-3 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-[#FEF3C7] border-neo rounded-md text-2xl shadow-neo-sm">
                            {{ $val['code'] }}
                        </div>
                        <h3 class="font-heading font-extrabold text-base sm:text-lg text-[#0F172A] leading-snug">
                            {{ $val['title'] }}
                        </h3>
                        <p class="font-sans text-xs sm:text-sm text-slate-600 leading-relaxed font-medium">
                            {{ $val['desc'] }}
                        </p>
                    </div>

                    <div class="pt-2 font-mono text-[11px] font-bold text-[#059669] uppercase tracking-wider">
                        ✔ STANDAR TERUJI
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
