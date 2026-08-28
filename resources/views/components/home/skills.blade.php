@props([
    'skills' => [],
])

<div class="bg-[#1E293B] text-white border-neo-b border-[#0F172A] py-3.5 overflow-hidden select-none">
    <div class="animate-marquee font-mono text-sm sm:text-base font-bold tracking-widest uppercase items-center gap-6">

        <!-- First Loop -->
        @foreach ($skills as $skill)
            <div class="flex items-center gap-3 bg-slate-800 border border-slate-700 px-4 py-1.5 rounded">
                @if ($skill['logo'])
                    <img src="{{ $skill['logo'] }}" alt="{{ $skill['name'] }}" class="w-5 h-5 object-contain"
                        onerror="this.onerror=null; this.style.display='none';">
                @else
                    <span class="text-[#F59E0B]">⚡</span>
                @endif
                <span class="text-white">{{ $skill['name'] }}</span>
                {{-- <span class="text-xs text-slate-400 font-semibold">[{{ $skill['category'] }}]</span> --}}
            </div>
        @endforeach

        <!-- Second Duplicate Loop for Infinite Marquee Effect -->
        @foreach ($skills as $skill)
            <div class="flex items-center gap-3 bg-slate-800 border border-slate-700 px-4 py-1.5 rounded">
                @if ($skill['logo'])
                    <img src="{{ $skill['logo'] }}" alt="{{ $skill['name'] }}" class="w-5 h-5 object-contain"
                        onerror="this.onerror=null; this.style.display='none';">
                @else
                    <span class="text-[#F59E0B]">⚡</span>
                @endif
                <span class="text-white">{{ $skill['name'] }}</span>
                {{-- <span class="text-xs text-slate-400 font-semibold">[{{ $skill['category'] }}]</span> --}}
            </div>
        @endforeach

    </div>
</div>
