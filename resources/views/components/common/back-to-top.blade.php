<div id="back-to-top-btn" 
     class="fixed bottom-6 right-6 z-50 hidden transition-all duration-300 transform translate-y-4 opacity-0">
    
    <button type="button" 
            onclick="window.scrollTo({ top: 0, behavior: 'smooth' });"
            class="group bg-white border-neo rounded-lg shadow-neo hover:shadow-neo-hover overflow-hidden transition-all duration-200 cursor-pointer flex flex-col items-stretch">
        
        <!-- Progress Bar at Top of Button -->
        <div class="w-full bg-slate-200 h-1.5 relative overflow-hidden">
            <div id="scroll-progress-bar" class="h-full bg-[#2563EB] transition-all duration-150" style="width: 0%;"></div>
        </div>

        <!-- Button Content (Rectangular & Neo-Brutalist in Bahasa Indonesia) -->
        <div class="px-3.5 py-2.5 flex items-center gap-2.5 font-mono text-xs font-extrabold text-[#0F172A]">
            <div class="w-6 h-6 rounded bg-[#2563EB] text-white flex items-center justify-center border-neo text-xs shadow-neo-sm group-hover:-translate-y-0.5 transition-transform">
                ↑
            </div>
            <span class="tracking-wider uppercase">KE ATAS</span>
            <span id="scroll-percentage-text" class="bg-[#0F172A] text-white text-[10px] px-2 py-0.5 rounded border-neo font-mono">
                0%
            </span>
        </div>

    </button>
</div>

<!-- Scroll Listener & Progress Calculation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopBtn = document.getElementById('back-to-top-btn');
        const progressBar = document.getElementById('scroll-progress-bar');
        const percentageText = document.getElementById('scroll-percentage-text');

        if (!backToTopBtn || !progressBar || !percentageText) return;

        function updateScrollProgress() {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            
            if (scrollHeight <= 0) return;

            const scrollPercent = Math.min(100, Math.max(0, (scrollTop / scrollHeight) * 100));

            // Update Progress Bar & Text
            progressBar.style.width = scrollPercent + '%';
            percentageText.textContent = Math.round(scrollPercent) + '%';

            // Toggle visibility
            if (scrollTop > 200) {
                backToTopBtn.classList.remove('hidden', 'translate-y-4', 'opacity-0');
                backToTopBtn.classList.add('translate-y-0', 'opacity-100');
            } else {
                backToTopBtn.classList.add('translate-y-4', 'opacity-0');
                setTimeout(() => {
                    if (window.scrollY <= 200) {
                        backToTopBtn.classList.add('hidden');
                    }
                }, 200);
            }
        }

        window.addEventListener('scroll', updateScrollProgress, { passive: true });
        updateScrollProgress();
    });
</script>
