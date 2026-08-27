@props([
    'src' => null,
    'alt' => 'Gambar',
    'aspect' => 'aspect-video',
])

<div {{ $attributes->merge(['class' => "overflow-hidden border-neo bg-slate-100 relative {$aspect} rounded-md shadow-neo-sm"]) }}>
    @if($src)
        <img src="{{ $src }}" alt="{{ $alt }}" class="w-full h-full object-cover" loading="lazy" onerror="this.onerror=null; this.src='https://placehold.co/800x450/0F172A/FFFFFF?text=Project+Preview';">
    @else
        <div class="w-full h-full flex flex-col items-center justify-center bg-slate-800 text-white p-4 font-mono text-center">
            <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span class="text-xs uppercase font-bold tracking-wider opacity-75">{{ $alt }}</span>
        </div>
    @endif
</div>
