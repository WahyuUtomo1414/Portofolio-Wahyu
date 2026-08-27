@props([
    'project' => [],
])

<div class="bg-white border-neo rounded-lg overflow-hidden shadow-neo shadow-neo-hover flex flex-col h-full transition-all duration-200">
    
    <!-- Header Badge & Category -->
    <div class="border-neo-b bg-slate-50 px-4 py-3 flex items-center justify-between font-mono text-xs font-bold">
        <span class="bg-[#2563EB] text-white px-2.5 py-1 rounded border-neo text-[11px] uppercase tracking-wider">
            {{ $project['category'] ?? 'WEB APP' }}
        </span>
        <span class="text-slate-500 font-semibold truncate max-w-[150px]">
            {{ $project['client'] ?? 'Personal Project' }}
        </span>
    </div>

    <!-- Thumbnail Image -->
    <div class="p-4 bg-slate-100 border-neo-b">
        <x-common.image-card :src="$project['thumbnail_url'] ?? null" :alt="$project['name'] ?? 'Project Image'" aspect="aspect-video" />
    </div>

    <!-- Body Info -->
    <div class="p-5 flex-grow space-y-3">
        <h3 class="font-heading font-extrabold text-lg sm:text-xl text-[#0F172A] leading-snug hover:text-[#2563EB] transition-colors">
            {{ $project['name'] ?? 'Project Name' }}
        </h3>
        
        <p class="font-sans text-sm text-slate-600 line-clamp-2 leading-relaxed">
            {{ $project['short_description'] ?? 'Deskripsi singkat mengenai solusi dan fitur project.' }}
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
        @if(!empty($project['demo_url']))
            <a href="{{ $project['demo_url'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-[#2563EB] hover:underline">
                <span>LIVE DEMO</span> ↗
            </a>
        @else
            <span class="text-slate-400 font-normal">NO LIVE DEMO</span>
        @endif

        <span class="inline-flex items-center bg-[#0F172A] text-white px-3 py-1.5 rounded border-neo hover:bg-[#2563EB] transition-colors cursor-pointer">
            <span>DETAIL</span> →
        </span>
    </div>
</div>
