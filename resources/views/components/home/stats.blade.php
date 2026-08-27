@props([
    'stats' => [],
])

<section class="py-12 bg-[#FAF8F5] border-neo-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @foreach($stats as $stat)
                <div class="bg-white border-neo p-5 sm:p-6 rounded-lg shadow-neo shadow-neo-hover space-y-2 text-center sm:text-left flex flex-col justify-between">
                    <div>
                        <div class="font-mono font-extrabold text-3xl sm:text-4xl lg:text-5xl text-[#0F172A]">
                            {{ $stat['number'] }}
                        </div>
                        <div class="font-mono font-bold text-xs sm:text-sm text-[#2563EB] tracking-wider uppercase mt-1">
                            {{ $stat['label'] }}
                        </div>
                    </div>
                    <div class="font-sans text-xs text-slate-500 font-medium pt-2 border-t border-slate-200">
                        {{ $stat['desc'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
