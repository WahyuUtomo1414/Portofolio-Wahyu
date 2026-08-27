@props([
    'images' => [],
])

@if(!empty($images))
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($images as $image)
            <x-common.image-card :src="$image['image_url'] ?? $image['image'] ?? null" :alt="$image['description'] ?? 'Gambar project'" />
        @endforeach
    </div>
@endif
