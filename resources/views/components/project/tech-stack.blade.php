@props([
    'items' => [],
])

@if(!empty($items))
    <div class="space-y-3">
        <h2 class="font-heading font-extrabold text-xl text-[#0F172A] uppercase">Tech Stack</h2>
        <div class="flex flex-wrap gap-2 font-mono text-xs font-bold">
            @foreach($items as $item)
                <span class="bg-slate-100 text-[#0F172A] border-neo px-3 py-1.5 rounded">
                    {{ is_array($item) ? ($item['name'] ?? 'Tech') : $item }}
                </span>
            @endforeach
        </div>
    </div>
@endif
