@props([
    'values' => [],
])

<section class="py-16 lg:py-24 border-neo-b bg-[#FAF8F5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <x-common.section-header 
            number="03" 
            tag="KEUNGGULAN KERJA" 
            title="NILAI UTAMA DALAM PENGEMBANGAN" 
            subtitle="Prinsip utama yang selalu diterapkan dalam setiap baris kode dan arsitektur sistem yang dibangun." />

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
                        ✔ VERIFIED STANDARD
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
