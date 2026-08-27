@props([
    'number' => '01',
    'tag' => 'SECTION TITLE',
    'title' => 'Main Heading Title',
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'space-y-3 mb-10 sm:mb-12']) }}>
    <!-- Section Index Badge -->
    <div class="inline-flex items-center gap-2 bg-white border-neo px-3.5 py-1.5 rounded-md shadow-neo-sm">
        <span class="font-mono font-extrabold text-sm text-[#2563EB]">{{ $number }}</span>
        <span class="font-mono text-slate-400 text-xs">/</span>
        <span class="font-mono font-bold text-xs text-[#0F172A] tracking-wider uppercase">{{ $tag }}</span>
    </div>

    <!-- Main Title -->
    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-[#0F172A] uppercase tracking-tight leading-tight">
        {{ $title }}
    </h2>

    <!-- Optional Subtitle -->
    @if($subtitle)
        <p class="font-sans text-slate-600 max-w-2xl text-sm sm:text-base leading-relaxed">
            {{ $subtitle }}
        </p>
    @endif
</div>
