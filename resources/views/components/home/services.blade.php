@props([
    'services' => [],
    'section' => [],
    'profile' => [],
])

<section id="services" class="py-16 lg:py-24 border-neo-b bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <x-common.section-header
            :number="$section['number'] ?? '02'"
            :tag="$section['tag'] ?? 'YANG BISA SAYA BANTU'"
            :title="$section['title'] ?? 'LAYANAN PENGEMBANGAN CUSTOM UNTUK BISNIS ANDA'"
            :subtitle="$section['subtitle'] ?? 'Pilih jenis project sesuai kebutuhan. Semua paket sudah termasuk hosting setup, SSL, dokumentasi, dan support 30 hari.'" />

        <!-- 4 Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
            @foreach($services as $service)
                <div class="bg-[#FAF8F5] border-neo rounded-xl p-6 sm:p-8 shadow-neo shadow-neo-hover flex flex-col justify-between space-y-5 transition-all">
                    <div class="space-y-4">
                        <div class="flex items-start justify-between gap-4">
                            <div class="inline-flex items-center justify-center w-14 h-14 bg-white border-neo rounded-lg text-3xl shadow-neo-sm flex-shrink-0">
                                {{ $service['icon'] }}
                            </div>
                            <div class="font-mono text-[10px] sm:text-xs font-bold text-[#059669] bg-[#ECFDF5] border-neo rounded px-2.5 py-1.5 text-right leading-tight">
                                ⏱ {{ $service['timeline'] }}
                            </div>
                        </div>
                        <h3 class="font-heading font-extrabold text-lg sm:text-xl text-[#0F172A] leading-snug uppercase">
                            {{ $service['title'] }}
                        </h3>
                        <p class="font-sans text-sm text-slate-700 leading-relaxed font-medium">
                            {{ $service['desc'] }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-300 flex items-center justify-between font-mono text-[11px] sm:text-xs">
                        <span class="text-slate-500 font-bold uppercase tracking-wider">
                            👉 Cocok untuk
                        </span>
                        <span class="text-[#0F172A] font-bold text-right">
                            {{ $service['fit_for'] }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- CTA Bawah Section -->
        <div class="bg-[#0F172A] border-neo rounded-xl p-6 sm:p-8 shadow-neo text-center space-y-4">
            <div class="font-mono text-xs font-bold text-[#059669] tracking-wider">
                ● BUTUH LAYANAN LAIN YANG BELUM TERSEBUT?
            </div>
            <h3 class="font-heading font-extrabold text-xl sm:text-2xl text-white uppercase max-w-2xl mx-auto leading-tight">
                Diskusikan kebutuhan project kamu, saya bantu cari solusi terbaik.
            </h3>
            <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ $profile['wa_direct_url'] ?? '#' }}" target="_blank" rel="noopener"
                   class="inline-flex items-center justify-center gap-2 bg-[#059669] hover:bg-[#047857] text-white font-mono font-bold text-sm px-6 py-3 rounded-md border-neo shadow-neo shadow-neo-hover transition-all">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.754zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l.24.384-1.03 3.762 3.842-1.007.391.232z"/>
                    </svg>
                    <span>KONSULTASI GRATIS VIA WHATSAPP</span>
                </a>
                <span class="font-mono text-xs text-slate-400">
                    ⚡ Balas dalam &lt;24 jam kerja
                </span>
            </div>
        </div>

    </div>
</section>
