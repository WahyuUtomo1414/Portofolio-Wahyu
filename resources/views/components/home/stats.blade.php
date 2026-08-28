@props([
    'stats' => [],
])

<section id="stats-section" class="py-12 bg-[#FAF8F5] border-neo-b select-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @foreach($stats as $stat)
                @php
                    $rawString = (string) $stat['number'];
                    // Ekstrak nilai angka murni dan akhiran (misal "5+", "100%")
                    preg_match('/^(\d+)(.*)$/', $rawString, $matches);
                    $targetNumber = isset($matches[1]) ? (int) $matches[1] : 0;
                    $suffix = isset($matches[2]) ? $matches[2] : '';
                @endphp

                <div class="bg-white border-neo p-5 sm:p-6 rounded-lg shadow-neo shadow-neo-hover space-y-2 text-center sm:text-left flex flex-col justify-between">
                    <div>
                        <div class="font-mono font-extrabold text-3xl sm:text-4xl lg:text-5xl text-[#0F172A] flex items-center justify-center sm:justify-start">
                            <span class="stat-counter-number" 
                                  data-target="{{ $targetNumber }}" 
                                  data-suffix="{{ $suffix }}">
                                0{{ $suffix }}
                            </span>
                        </div>
                        <div class="font-mono font-bold text-xs sm:text-sm text-[#2563EB] tracking-wider uppercase mt-1">
                            {{ $stat['label'] }}
                        </div>
                    </div>
                    <div class="font-sans text-xs text-slate-500 font-medium pt-2 border-t border-slate-200">
                        {{ $stat['desc'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Count-Up Animation Script using IntersectionObserver -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.stat-counter-number');
        const statsSection = document.getElementById('stats-section');

        if (!counters.length || !statsSection) return;

        let hasAnimated = false;

        function startCountAnimation() {
            if (hasAnimated) return;
            hasAnimated = true;

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target') || '0', 10);
                const suffix = counter.getAttribute('data-suffix') || '';
                const duration = 1800; // 1.8s total animation duration
                const startTime = performance.now();

                function updateCount(currentTime) {
                    const elapsedTime = currentTime - startTime;
                    const progress = Math.min(elapsedTime / duration, 1);
                    
                    // Ease Out Quad formula for smooth deceleration
                    const easeProgress = 1 - (1 - progress) * (1 - progress);
                    const currentVal = Math.floor(easeProgress * target);

                    counter.textContent = currentVal + suffix;

                    if (progress < 1) {
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.textContent = target + suffix;
                    }
                }

                requestAnimationFrame(updateCount);
            });
        }

        // Trigger count animation automatically when stats section enters viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCountAnimation();
                }
            });
        }, { threshold: 0.2 });

        observer.observe(statsSection);
    });
</script>
