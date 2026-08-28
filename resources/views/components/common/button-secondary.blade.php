@props([
    'href' => null,
    'type' => 'button',
    'classes' => 'inline-flex items-center justify-center font-mono font-bold text-sm sm:text-base bg-white hover:bg-slate-100 text-[#0F172A] px-6 py-3 rounded-md border-neo shadow-neo shadow-neo-hover cursor-pointer transition-all duration-200',
])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
