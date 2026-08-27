@props([
    'title' => 'Belum ada data',
    'message' => 'Konten untuk bagian ini sedang dipersiapkan.',
])

<div {{ $attributes->merge(['class' => 'bg-white border-neo rounded-lg p-8 text-center shadow-neo-sm space-y-3']) }}>
    <div class="inline-flex items-center justify-center w-12 h-12 bg-slate-100 border-neo rounded-full font-mono text-xl font-bold text-slate-500">
        !
    </div>
    <h3 class="font-heading font-bold text-lg text-[#0F172A] uppercase">{{ $title }}</h3>
    <p class="font-sans text-sm text-slate-600 max-w-md mx-auto">{{ $message }}</p>
</div>
