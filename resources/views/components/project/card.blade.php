@props([
    'project' => [],
])

<div class="bg-white border-neo rounded-lg overflow-hidden shadow-neo shadow-neo-hover flex flex-col h-full transition-all duration-200">
    
    <!-- Header Badge & Client Info -->
    <div class="border-neo-b bg-slate-50 px-4 py-3 flex items-center justify-between font-mono text-xs font-bold gap-2">
        <span class="bg-[#2563EB] text-white px-2.5 py-1 rounded border-neo text-[11px] uppercase tracking-wider flex-shrink-0">
            {{ $project['category'] }}
        </span>

        <!-- Client Logo & Name -->
        <div class="flex items-center gap-2 truncate text-right">
            @if($project['client_logo'])
                <img src="{{ $project['client_logo'] }}" alt="{{ $project['client_name'] }}" class="w-5 h-5 object-contain rounded border-neo bg-white flex-shrink-0" onerror="this.onerror=null; this.style.display='none';">
            @endif
            <span class="text-slate-700 font-bold truncate max-w-[140px]" title="{{ $project['client_name'] }}">
                {{ $project['client_name'] }}
            </span>
        </div>
    </div>

    <!-- Thumbnail Image -->
    <div class="p-4 bg-slate-100 border-neo-b">
        <x-common.image-card :src="$project['thumbnail_url']" :alt="$project['name']" aspect="aspect-video" />
    </div>

    <!-- Body Info -->
    <div class="p-5 flex-grow space-y-3">
        <h3 class="font-heading font-extrabold text-lg sm:text-xl text-[#0F172A] leading-snug hover:text-[#2563EB] transition-colors">
            {{ $project['name'] }}
        </h3>
        
        <p class="font-sans text-sm text-slate-600 line-clamp-2 leading-relaxed font-medium">
            {{ $project['short_description'] }}
        </p>

        <!-- Tech Stack Chips -->
        @if(!empty($project['tech_stack']))
            <div class="pt-2 flex flex-wrap gap-1.5 font-mono text-xs font-bold">
                @foreach($project['tech_stack'] as $tech)
                    <span class="bg-slate-100 text-[#0F172A] border-neo px-2 py-0.5 rounded text-[11px]">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Footer Action Buttons -->
    <div class="border-neo-t bg-slate-50 px-5 py-4 flex items-center justify-between font-mono text-xs font-bold gap-2">
        @if($project['demo_url'])
            <a href="{{ $project['demo_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-[#2563EB] hover:underline">
                <span>PREVIEW</span> ↗
            </a>
        @else
            <span class="text-slate-400 font-normal">PROJECT PREVIEW</span>
        @endif

        @if($project['detail_url'])
            <a href="{{ $project['detail_url'] }}" class="inline-flex items-center bg-[#0F172A] text-white px-3 py-1.5 rounded border-neo hover:bg-[#2563EB] transition-colors">
                <span>DETAIL</span> →
            </a>
        @endif
    </div>
</div>
