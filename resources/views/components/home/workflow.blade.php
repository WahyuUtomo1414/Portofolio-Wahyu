@props([
    'workflow' => [],
    'section' => [],
])

<section id="workflow" class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <x-common.section-header
            :number="$section['number'] ?? '03'"
            :tag="$section['tag'] ?? 'CARA KERJA SAYA'"
            :title="$section['title'] ?? 'ALUR KERJA TRANSPARAN DARI DISKUSI HINGGA DELIVERY'"
            :subtitle="$section['subtitle'] ?? 'Empat langkah sederhana yang memastikan project berjalan on-track, komunikasi lancar, dan hasil sesuai ekspektasi.'" />

        <!-- Workflow Timeline Steps -->
        <div class="relative">
            <!-- Connecting Line (Desktop) -->
            <div class="hidden lg:block absolute top-14 left-0 right-0 h-1 bg-[#0F172A] z-0" aria-hidden="true"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 relative z-10">
                @foreach($workflow as $step)
                    <div class="bg-white border-neo rounded-xl p-6 shadow-neo shadow-neo-hover space-y-4 flex flex-col justify-between">
                        <!-- Step Number Big -->
                        <div class="flex items-start justify-between gap-3">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#2563EB] text-white border-neo rounded-lg shadow-neo font-mono font-black text-2xl">
                                {{ $step['step'] }}
                            </div>
                            <span class="font-mono text-[10px] font-bold text-slate-500 bg-slate-100 border-neo rounded px-2 py-1 uppercase tracking-wider">
                                STEP {{ $step['step'] }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            <h3 class="font-heading font-extrabold text-base sm:text-lg text-[#0F172A] leading-snug uppercase">
                                {{ $step['title'] }}
                            </h3>
                            <p class="font-sans text-sm text-slate-600 leading-relaxed font-medium">
                                {{ $step['desc'] }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-200 font-mono text-xs font-bold text-[#059669] tracking-wider">
                            ⏱ {{ $step['duration'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Trust Note Bawah -->
        <div class="bg-white border-neo rounded-lg p-5 sm:p-6 shadow-neo-sm flex flex-col sm:flex-row items-start sm:items-center gap-4 justify-between">
            <div class="font-mono text-sm text-slate-700 font-medium">
                <span class="text-[#0F172A] font-bold">💡 Catatan:</span>
                Pembayaran bertahap per milestone. Kalau timeline meleset karena kesalahan saya, ada kompensasi diskon di project berikutnya.
            </div>
            <a href="#services" class="inline-flex items-center gap-1.5 font-mono text-xs font-bold text-[#2563EB] hover:text-[#1E40AF] underline underline-offset-4 whitespace-nowrap">
                LIHAT PAKET LAYANAN ↑
            </a>
        </div>

    </div>
</section>
