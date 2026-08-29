@props([
    'clientsJson' => '[]',
    'visibleClients' => [],
    'section' => [],
])

<section id="clients" class="py-16 lg:py-24 border-neo-b bg-white select-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        <!-- Header Section -->
        <x-common.section-header 
            :number="$section['number'] ?? '03'"
            :tag="$section['tag'] ?? 'MITRA & CLIENT'"
            :title="$section['title'] ?? 'DIPERCAYA BERBAGAI BISNIS DAN INSTITUSI'"
            :subtitle="$section['subtitle'] ?? 'Pengalaman membangun website, backend API, sistem internal, dan aplikasi digital untuk berbagai kebutuhan.'" />

        <!-- Multi-Directional 3D Flip Cards Grid (Mobile: 4 Cards 2x2 | Desktop: 8 Cards 4x2) -->
        <div id="clients-card-grid" data-clients="{{ $clientsJson }}" class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @foreach($visibleClients as $client)
                <div class="client-flip-card perspective-1000 h-40 sm:h-44 {{ $loop->index >= 4 ? 'hidden md:block' : '' }}" data-card-slot="{{ $loop->index }}" data-direction-type="{{ $client['direction_type'] ?? 0 }}">
                    <div class="client-card-inner relative w-full h-full transition-transform duration-1000 ease-in-out transform-style-3d">
                        
                        <!-- Front Card Face (Direct Original Colors & Logo + Title Only) -->
                        <div class="client-card-front absolute inset-0 bg-[#FAF8F5] border-neo p-4 sm:p-5 rounded-xl shadow-neo flex flex-col items-center justify-center text-center space-y-2.5 backface-hidden">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg border-neo bg-white p-2.5 flex items-center justify-center shadow-neo-sm">
                                <img src="{{ $client['logo'] }}" 
                                     alt="{{ $client['name'] }}" 
                                     class="card-logo-img w-full h-full object-contain" 
                                     onerror="this.onerror=null; this.src='https://placehold.co/120x120/0F172A/FFFFFF?text=CLIENT';">
                            </div>
                            <div>
                                <h4 class="card-name-text font-heading font-extrabold text-sm sm:text-base text-[#0F172A] leading-snug line-clamp-2">
                                    {{ $client['name'] }}
                                </h4>
                            </div>
                        </div>

                        <!-- Back Card Face (Pre-rotated according to direction) -->
                        <div class="client-card-back absolute inset-0 bg-[#FAF8F5] border-neo p-4 sm:p-5 rounded-xl shadow-neo flex flex-col items-center justify-center text-center space-y-2.5 backface-hidden {{ $client['direction_class'] ?? 'rotate-y-180' }}">
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg border-neo bg-white p-2.5 flex items-center justify-center shadow-neo-sm">
                                <img src="" alt="" class="card-logo-img w-full h-full object-contain">
                            </div>
                            <div>
                                <h4 class="card-name-text font-heading font-extrabold text-sm sm:text-base text-[#0F172A] leading-snug line-clamp-2"></h4>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
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

<!-- Multi-Directional 3D Card Flip Animation Script (Smart Visibility Awareness) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const grid = document.getElementById('clients-card-grid');
        const clientsData = JSON.parse(grid?.dataset.clients || '[]');
        if (!clientsData || clientsData.length <= 4) return;

        const cards = document.querySelectorAll('.client-flip-card');
        let currentIndex = 8;

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

                // Populate back face with new client logo and name
                const backLogo = back.querySelector('.card-logo-img');
                const backName = back.querySelector('.card-name-text');

                if (backLogo) {
                    backLogo.src = newClientData.logo || '';
                    backLogo.alt = newClientData.name || '';
                }
                if (backName) backName.textContent = newClientData.name || '';

                // Apply multi-directional 3D flip transform with 1.1s duration
                inner.style.transition = 'transform 1.1s cubic-bezier(0.4, 0, 0.2, 1)';
                inner.style.transform = directionTransforms[dirType];

                // After 3D flip animation finishes (1100ms), copy back content to front face and reset rotation seamlessly
                setTimeout(() => {
                    const frontLogo = front.querySelector('.card-logo-img');
                    const frontName = front.querySelector('.card-name-text');

                    if (frontLogo) {
                        frontLogo.src = newClientData.logo || '';
                        frontLogo.alt = newClientData.name || '';
                    }
                    if (frontName) frontName.textContent = newClientData.name || '';

                    inner.style.transition = 'none';
                    inner.style.transform = 'rotateY(0deg) rotateX(0deg)';

                    setTimeout(() => {
                        inner.style.transition = 'transform 1.1s cubic-bezier(0.4, 0, 0.2, 1)';
                    }, 50);
                }, 1100);

            }, delayMs);
        }

        // Trigger multi-directional card flip wave every 6.0 seconds for visible cards
        setInterval(() => {
            let visibleSlotCount = 0;
            cards.forEach((card) => {
                // Check if card is currently visible on the screen
                if (card.offsetWidth === 0 && card.offsetHeight === 0) return;

                const nextClient = clientsData[currentIndex % clientsData.length];
                currentIndex++;
                const staggeredDelay = visibleSlotCount * 110;
                visibleSlotCount++;
                flipCardSlot(card, nextClient, staggeredDelay);
            });
        }, 6000);
    });
</script>
