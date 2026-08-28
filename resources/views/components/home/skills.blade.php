@props([
    'skills' => [],
])

<div class="bg-[#1E293B] border-neo-b py-3.5 overflow-hidden select-none">
    <div class="animate-marquee font-mono text-sm sm:text-base font-bold tracking-wider uppercase items-center gap-6">

        <!-- First Loop -->
        @foreach ($skills as $skill)
            <div class="flex items-center gap-3 bg-white border-neo px-4 py-1.5 rounded-lg shadow-neo-sm">
                @if ($skill['logo'])
                    <img src="{{ $skill['logo'] }}" alt="{{ $skill['name'] }}" class="w-5 h-5 object-contain"
                        onerror="this.onerror=null; this.style.display='none';">
                @else
                    <span class="text-[#2563EB]">⚡</span>
                @endif
                <span class="text-[#0F172A] font-extrabold">{{ $skill['name'] }}</span>
            </div>
        @endforeach

        <!-- Second Duplicate Loop for Infinite Marquee Effect -->
        @foreach ($skills as $skill)
            <div class="flex items-center gap-3 bg-white border-neo px-4 py-1.5 rounded-lg shadow-neo-sm">
                @if ($skill['logo'])
                    <img src="{{ $skill['logo'] }}" alt="{{ $skill['name'] }}" class="w-5 h-5 object-contain"
                        onerror="this.onerror=null; this.style.display='none';">
                @else
                    <span class="text-[#2563EB]">⚡</span>
                @endif
                <span class="text-[#0F172A] font-extrabold">{{ $skill['name'] }}</span>
            </div>
        @endforeach

    </div>
</div>
