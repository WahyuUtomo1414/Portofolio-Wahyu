<footer class="bg-[#0F172A] text-white border-neo-t border-[#0F172A] mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 pb-12 border-b border-slate-800">
            
            <!-- Left Info Column -->
            <div class="md:col-span-6 space-y-4">
                <div class="inline-block bg-[#2563EB] text-white border-neo border-white px-3 py-1 font-mono font-bold text-lg shadow-neo-sm">
                    WAHYU.DEV
                </div>
                <p class="text-slate-300 font-sans max-w-md text-sm sm:text-base leading-relaxed">
                    Senior Fullstack Web Developer yang berfokus pada arsitektur web modern, keandalan sistem backend Laravel, dan pengalaman antarmuka pengguna yang luar biasa.
                </p>
                <div class="pt-2 flex items-center gap-3 font-mono text-xs text-slate-400">
                    <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>BEKASI / JAKARTA, INDONESIA</span>
                </div>
            </div>

            <!-- Quick Nav Links -->
            <div class="md:col-span-3 space-y-3 font-mono">
                <h4 class="text-sm font-bold tracking-wider text-slate-400 uppercase">// NAVIGASI</h4>
                <ul class="space-y-2 text-sm font-semibold">
                    <li><a href="{{ route('home') }}" class="hover:text-[#2563EB] transition-colors">→ Home Page</a></li>
                    <li><a href="#projects" class="hover:text-[#2563EB] transition-colors">→ Katalog Project</a></li>
                    <li><a href="#experience" class="hover:text-[#2563EB] transition-colors">→ Pengalaman Kerja</a></li>
                    <li><a href="#contact" class="hover:text-[#2563EB] transition-colors">→ Form Kontak</a></li>
                </ul>
            </div>

            <!-- Social Links -->
            <div class="md:col-span-3 space-y-3 font-mono">
                <h4 class="text-sm font-bold tracking-wider text-slate-400 uppercase">// SOCIAL & MEDIA</h4>
                <ul class="space-y-2 text-sm font-semibold">
                    <li>
                        <a href="https://github.com/WahyuUtomo1414" target="_blank" rel="noopener noreferrer" class="hover:text-[#2563EB] inline-flex items-center gap-2 transition-colors">
                            <span>GitHub</span> ↗
                        </a>
                    </li>
                    <li>
                        <a href="https://linkedin.com/in/wahyu-dwi-utomo" target="_blank" rel="noopener noreferrer" class="hover:text-[#2563EB] inline-flex items-center gap-2 transition-colors">
                            <span>LinkedIn</span> ↗
                        </a>
                    </li>
                    <li>
                        <a href="https://instagram.com/wahyudwi" target="_blank" rel="noopener noreferrer" class="hover:text-[#2563EB] inline-flex items-center gap-2 transition-colors">
                            <span>Instagram</span> ↗
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Copyright & Server Time -->
        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between font-mono text-xs text-slate-400 gap-4">
            <p>© {{ date('Y') }} Wahyu Dwi Utomo. All rights reserved.</p>
            <p class="bg-slate-800 px-3 py-1 rounded border border-slate-700">
                BUILT WITH LARAVEL {{ app()->version() }} & TAILWIND CSS
            </p>
        </div>
    </div>
</footer>
