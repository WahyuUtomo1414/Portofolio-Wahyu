@props([
    'clients' => [],
])

<section id="clients" class="py-16 lg:py-24 border-neo-b bg-white select-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Header Section -->
        <x-common.section-header 
            number="04" 
            tag="MITRA & CLIENT" 
            title="DIPERCAYA OLEH BERBAGAI BISNIS DAN INSTITUSI" 
            subtitle="Membantu pengembangan website, sistem enterprise, dan aplikasi digital untuk berbagai kebutuhan bisnis dan organisasi." />

        <!-- 8 Individual Multi-Directional 3D Flip Cards Grid (4 Cols x 2 Rows) -->
        <div id="clients-card-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @for($i = 0; $i < 8; $i++)
                @php
                    $client = $clients[$i] ?? null;
                    $name = data_get($client, 'name', 'Client Partner');
                    $logo = data_get($client, 'logo');
                    $desc = data_get($client, 'desc', 'Mitra Kerja');

                    // Tentukan arah rotasi 3D yang berbeda-beda untuk tiap slot card (Y-Axis, X-Axis, -Y-Axis, -X-Axis)
                    $directionTypes = ['rotate-y-180', 'rotate-x-180', 'rotate-y-neg-180', 'rotate-x-neg-180'];
                    $cardDirectionClass = $directionTypes[$i % 4];
                @endphp

                <div class="client-flip-card perspective-1000 h-44 sm:h-48" data-card-slot="{{ $i }}" data-direction-type="{{ $i % 4 }}">
                    <div class="client-card-inner relative w-full h-full transition-transform duration-1000 ease-in-out transform-style-3d">
                        
                        <!-- Front Card Face (Direct Original Colors) -->
                        <div class="client-card-front absolute inset-0 bg-[#FAF8F5] border-neo p-5 sm:p-6 rounded-xl shadow-neo flex flex-col items-center justify-center text-center space-y-3 backface-hidden">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg border-neo bg-white p-2.5 flex items-center justify-center shadow-neo-sm">
                                <img src="{{ Str::startsWith($logo, 'http') ? $logo : asset($logo) }}" 
                                     alt="{{ $name }}" 
                                     class="card-logo-img w-full h-full object-contain" 
                                     onerror="this.onerror=null; this.src='https://placehold.co/120x120/0F172A/FFFFFF?text=CLIENT';">
                            </div>
                            <div>
                                <h4 class="card-name-text font-heading font-extrabold text-sm sm:text-base text-[#0F172A] leading-snug">
                                    {{ $name }}
                                </h4>
                                @if($desc)
                                    <p class="card-desc-text font-sans text-xs text-slate-500 font-medium mt-1 line-clamp-1">
                                        {{ $desc }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Back Card Face (Pre-rotated according to direction) -->
                        <div class="client-card-back absolute inset-0 bg-[#FAF8F5] border-neo p-5 sm:p-6 rounded-xl shadow-neo flex flex-col items-center justify-center text-center space-y-3 backface-hidden {{ $cardDirectionClass }}">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg border-neo bg-white p-2.5 flex items-center justify-center shadow-neo-sm">
                                <img src="" alt="" class="card-logo-img w-full h-full object-contain">
                            </div>
                            <div>
                                <h4 class="card-name-text font-heading font-extrabold text-sm sm:text-base text-[#0F172A] leading-snug"></h4>
                                <p class="card-desc-text font-sans text-xs text-slate-500 font-medium mt-1 line-clamp-1"></p>
                            </div>
                        </div>

                    </div>
                </div>
            @endfor
        </div>

    </div>
</section>

<!-- Inline Styles for Multi-Directional 3D Card Flip -->
<style>
    .perspective-1000 {
        perspective: 1000px;
    }
    .transform-style-3d {
        transform-style: preserve-3d;
        -webkit-transform-style: preserve-3d;
    }
    .backface-hidden {
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }
    .rotate-y-180 {
        transform: rotateY(180deg);
        -webkit-transform: rotateY(180deg);
    }
    .rotate-x-180 {
        transform: rotateX(180deg);
        -webkit-transform: rotateX(180deg);
    }
    .rotate-y-neg-180 {
        transform: rotateY(-180deg);
        -webkit-transform: rotateY(-180deg);
    }
    .rotate-x-neg-180 {
        transform: rotateX(-180deg);
        -webkit-transform: rotateX(-180deg);
    }
</style>

<!-- Multi-Directional 3D Card Flip Animation Script (Slower Duration: 1.1s, Interval: 6.0s) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clientsData = @json($clients);
        if (!clientsData || clientsData.length <= 8) return;

        const cards = document.querySelectorAll('.client-flip-card');
        let currentIndex = 8;

        // Transform CSS strings per direction type (0: Horizontal Y, 1: Vertical X, 2: Reverse Horizontal -Y, 3: Reverse Vertical -X)
        const directionTransforms = [
            'rotateY(180deg)',
            'rotateX(180deg)',
            'rotateY(-180deg)',
            'rotateX(-180deg)'
        ];

        function flipCardSlot(card, newClientData, delayMs) {
            setTimeout(() => {
                const inner = card.querySelector('.client-card-inner');
                const front = card.querySelector('.client-card-front');
                const back = card.querySelector('.client-card-back');
                const dirType = parseInt(card.getAttribute('data-direction-type') || '0', 10);

                if (!inner || !front || !back) return;

                // Populate back face with new client logo and text
                const backLogo = back.querySelector('.card-logo-img');
                const backName = back.querySelector('.card-name-text');
                const backDesc = back.querySelector('.card-desc-text');

                if (backLogo) {
                    backLogo.src = newClientData.logo || '';
                    backLogo.alt = newClientData.name || '';
                }
                if (backName) backName.textContent = newClientData.name || '';
                if (backDesc) backDesc.textContent = newClientData.desc || '';

                // Apply multi-directional 3D flip transform with 1.1s duration
                inner.style.transition = 'transform 1.1s cubic-bezier(0.4, 0, 0.2, 1)';
                inner.style.transform = directionTransforms[dirType];

                // After 3D flip animation finishes (1100ms), copy back content to front face and reset rotation seamlessly
                setTimeout(() => {
                    const frontLogo = front.querySelector('.card-logo-img');
                    const frontName = front.querySelector('.card-name-text');
                    const frontDesc = front.querySelector('.card-desc-text');

                    if (frontLogo) {
                        frontLogo.src = newClientData.logo || '';
                        frontLogo.alt = newClientData.name || '';
                    }
                    if (frontName) frontName.textContent = newClientData.name || '';
                    if (frontDesc) frontDesc.textContent = newClientData.desc || '';

                    inner.style.transition = 'none';
                    inner.style.transform = 'rotateY(0deg) rotateX(0deg)';

                    setTimeout(() => {
                        inner.style.transition = 'transform 1.1s cubic-bezier(0.4, 0, 0.2, 1)';
                    }, 50);
                }, 1100);

            }, delayMs);
        }

        // Trigger multi-directional card flip wave every 6.0 seconds with longer 110ms staggered delay
        setInterval(() => {
            cards.forEach((card, slotIndex) => {
                const nextClient = clientsData[currentIndex % clientsData.length];
                currentIndex++;
                const staggeredDelay = slotIndex * 110; // 110ms staggered delay per card slot
                flipCardSlot(card, nextClient, staggeredDelay);
            });
        }, 6000);
    });
</script>
