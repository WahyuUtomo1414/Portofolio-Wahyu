@props([
    'profile' => [],
])

<footer class="bg-[#FAF8F5] text-[#0F172A] border-t-2 border-[#0F172A] mt-auto">
    
    <!-- Top Statement Section: 2-Column Split (Left: Typewriter Motto, Right: Terminal Quick Contact Card) -->
    <div id="footer-typewriter-section" class="bg-[#0F172A] text-white border-b-2 border-[#0F172A] py-16 lg:py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10">
            
            <!-- Left Side (7 Columns): Motto & Perfectly Sized Typewriter Headline (No Crop & No Jitter) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Category Tag Pill -->
                <div class="inline-flex items-center gap-2 bg-[#2563EB] text-white border-neo px-4 py-1.5 rounded-full font-mono text-xs font-bold uppercase tracking-wider shadow-neo-sm">
                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                    <span>MOTTO & KOMITMEN LAYANAN</span>
                </div>

                <!-- Headline Container (Zero Cropping & Zero Layout Shift) -->
                <div class="space-y-3 font-heading font-black tracking-tight uppercase leading-tight select-none">
                    
                    <!-- Line 1: SEMANGAT BERKEMBANG -->
                    <div class="min-h-[44px] sm:min-h-[56px] lg:min-h-[68px] flex items-center gap-2">
                        <h2 id="typewriter-line-1" class="text-2xl sm:text-4xl lg:text-5xl font-black text-white leading-tight"></h2>
                        <span id="typewriter-cursor-1" class="text-[#2563EB] text-2xl sm:text-4xl lg:text-5xl animate-pulse font-mono font-bold">|</span>
                    </div>

                    <!-- Line 2: SEPANJANG MASA -->
                    <div class="min-h-[44px] sm:min-h-[56px] lg:min-h-[68px] flex items-center gap-2">
                        <h2 id="typewriter-line-2" class="text-2xl sm:text-4xl lg:text-5xl font-black text-[#2563EB] leading-tight"></h2>
                        <span id="typewriter-cursor-2" class="text-[#2563EB] text-2xl sm:text-4xl lg:text-5xl animate-pulse font-mono font-bold hidden">|</span>
                    </div>

                </div>

                <!-- Subtitle Copywriting -->
                <p class="font-sans text-slate-300 text-base sm:text-lg font-medium leading-relaxed max-w-xl">
                    Siap membantu perusahaan, instansi, dan UMKM membangun aplikasi web modern, sistem backend yang kokoh, antarmuka yang cepat dan responsif, serta aplikasi mobile.
                </p>

                <!-- Action CTA Button -->
                <div class="pt-2">
                    <a href="#contact" class="inline-flex items-center justify-center font-mono font-bold text-sm bg-[#059669] hover:bg-[#047857] text-white px-7 py-3.5 rounded-lg border-neo shadow-neo shadow-neo-hover transition-all duration-200">
                        <span>KONSULTASI PROJECT SEKARANG</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

            </div>

            <!-- Right Side (5 Columns): Interactive Terminal & Quick Contact Card -->
            <div class="lg:col-span-5">
                <div class="bg-[#1E293B] border-2 border-slate-700 rounded-xl p-6 shadow-2xl space-y-5 font-mono">
                    
                    <!-- Terminal Top Bar -->
                    <div class="flex items-center justify-between pb-3 border-b border-slate-700">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-red-500"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                            <span class="w-3 h-3 rounded-full bg-green-500"></span>
                        </div>
                        <span class="text-xs text-slate-400 font-bold">// QUICK_CONTACT.SH</span>
                    </div>

                    <!-- Code Snippet Box -->
                    <div class="space-y-2 text-xs sm:text-sm text-slate-300">
                        <p class="text-slate-400">// Konsultasi Bebas & Respon Cepat (&lt; 2 Jam)</p>
                        <p><span class="text-[#60A5FA]">$service</span> = <span class="text-[#F59E0B]">new</span> DigitalProduct();</p>
                        <p><span class="text-[#60A5FA]">$service</span>-&gt;<span class="text-[#34D399]">startProject</span>([</p>
                        <p class="pl-4"><span class="text-slate-400">'client'</span> =&gt; <span class="text-[#FBBF24]">'Your_Company'</span>,</p>
                        <p class="pl-4"><span class="text-slate-400">'scope'</span>  =&gt; <span class="text-[#FBBF24]">['Backend', 'Frontend', 'Mobile']</span>,</p>
                        <p class="pl-4"><span class="text-slate-400">'status'</span> =&gt; <span class="text-[#34D399]">'● READY_TO_BUILD'</span></p>
                        <p>]);</p>
                    </div>

                    <!-- Quick Direct Contact Actions -->
                    <div class="pt-2 space-y-2.5">
                        <a href="{{ $profile['social_whatsapp'] ?? '#' }}" target="_blank" rel="noopener noreferrer" 
                           class="flex items-center justify-between p-3 bg-[#059669] hover:bg-[#047857] text-white rounded-lg border border-emerald-400/30 text-xs font-bold transition-all shadow-neo-sm">
                            <span class="flex items-center gap-2">
                                <span>💬</span>
                                <span>CHAT WHATSAPP LANGSUNG</span>
                            </span>
                            <span>↗</span>
                        </a>

                        <a href="mailto:{{ $profile['email'] ?? 'wahyudwiutomo1414@gmail.com' }}" 
                           class="flex items-center justify-between p-3 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-lg border border-slate-600 text-xs font-bold transition-all">
                            <span class="flex items-center gap-2">
                                <span>✉️</span>
                                <span class="truncate">{{ $profile['email'] ?? 'wahyudwiutomo1414@gmail.com' }}</span>
                            </span>
                            <span>↗</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Main 3-Column Footer Section (Warm Cream Dot Pattern Theme) -->
    <div class="py-12 lg:py-16 px-4 sm:px-6 lg:px-8 bg-dot-pattern">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 pb-12 border-b-2 border-[#0F172A]">
            
            <!-- Left Column: Brand Info (6 Cols) -->
            <div class="md:col-span-6 space-y-4">
                <div class="inline-flex items-center gap-2 bg-white border-neo px-3.5 py-1.5 rounded-md shadow-neo-sm">
                    <span class="w-3 h-3 rounded-full bg-[#2563EB]"></span>
                    <span class="font-heading font-extrabold text-xl text-[#0F172A] tracking-tight uppercase">
                        WAHYU<span class="text-[#2563EB]">.DEV</span>
                    </span>
                </div>
                <p class="font-sans text-slate-700 text-sm sm:text-base max-w-md leading-relaxed font-medium">
                    Layanan profesional pengembangan aplikasi web, sistem enterprise, aplikasi mobile, dan solusi digital terintegrasi.
                </p>
                <div class="pt-1 font-mono text-xs text-slate-500 font-bold">
                    📍 {{ $profile['location'] ?? 'Bekasi / Jakarta, Indonesia' }}
                </div>
            </div>

            <!-- Middle Column: Navigasi (3 Cols) -->
            <div class="md:col-span-3 space-y-3 font-mono">
                <h4 class="text-xs font-extrabold tracking-widest text-[#2563EB] uppercase">// NAVIGASI</h4>
                <ul class="space-y-2.5 text-sm font-bold text-[#0F172A]">
                    <li><a href="{{ route('home') }}" class="hover:text-[#2563EB] transition-colors inline-flex items-center gap-1.5"><span class="text-[#2563EB]">→</span> Home Page</a></li>
                    <li><a href="#about" class="hover:text-[#2563EB] transition-colors inline-flex items-center gap-1.5"><span class="text-[#2563EB]">→</span> Tentang Saya</a></li>
                    <li><a href="#experience" class="hover:text-[#2563EB] transition-colors inline-flex items-center gap-1.5"><span class="text-[#2563EB]">→</span> Riwayat Karier</a></li>
                    <li><a href="#projects" class="hover:text-[#2563EB] transition-colors inline-flex items-center gap-1.5"><span class="text-[#2563EB]">→</span> Katalog Project</a></li>
                    <li><a href="#contact" class="hover:text-[#2563EB] transition-colors inline-flex items-center gap-1.5"><span class="text-[#2563EB]">→</span> Form Kontak</a></li>
                </ul>
            </div>

            <!-- Right Column: Ikuti Kami / Sosmed (3 Cols) -->
            <div class="md:col-span-3 space-y-3 font-mono">
                <h4 class="text-xs font-extrabold tracking-widest text-[#2563EB] uppercase">// IKUTI KAMI</h4>
                <ul class="space-y-2.5 text-sm font-bold text-[#0F172A]">
                    <li><a href="{{ $profile['social_github'] ?? '#' }}" target="_blank" rel="noopener" class="hover:text-[#2563EB] transition-colors">GitHub ↗</a></li>
                    <li><a href="{{ $profile['social_linkedin'] ?? '#' }}" target="_blank" rel="noopener" class="hover:text-[#2563EB] transition-colors">LinkedIn ↗</a></li>
                    <li><a href="{{ $profile['social_instagram'] ?? '#' }}" target="_blank" rel="noopener" class="hover:text-[#2563EB] transition-colors">Instagram ↗</a></li>
                    <li><a href="{{ $profile['social_whatsapp'] ?? '#' }}" target="_blank" rel="noopener" class="hover:text-[#059669] transition-colors">WhatsApp ↗</a></li>
                </ul>
            </div>

        </div>

        <!-- Copyright Line -->
        <div class="max-w-7xl mx-auto pt-8 flex flex-col sm:flex-row items-center justify-between font-mono text-xs font-bold text-slate-600 gap-2">
            <p>© {{ $profile['current_year'] ?? '2026' }} Wahyu Dwi Utomo. All rights reserved.</p>
            <p class="text-slate-400">{{ $profile['location_upper'] ?? 'BEKASI / JAKARTA, INDONESIA' }}</p>
        </div>
    </div>
</footer>

<!-- Smooth 2-Line Typewriter Animation Script (No Clip & No Shift) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const line1Text = "SEMANGAT BERKEMBANG";
        const line2Text = "SEPANJANG MASA";
        
        const targetLine1 = document.getElementById('typewriter-line-1');
        const targetLine2 = document.getElementById('typewriter-line-2');
        const cursor1 = document.getElementById('typewriter-cursor-1');
        const cursor2 = document.getElementById('typewriter-cursor-2');

        if (!targetLine1 || !targetLine2) return;

        let index1 = 0;
        let index2 = 0;

        function typeLine1() {
            if (index1 < line1Text.length) {
                targetLine1.textContent = line1Text.substring(0, index1 + 1);
                index1++;
                setTimeout(typeLine1, 75);
            } else {
                if (cursor1) cursor1.classList.add('hidden');
                if (cursor2) cursor2.classList.remove('hidden');
                setTimeout(typeLine2, 100);
            }
        }

        function typeLine2() {
            if (index2 < line2Text.length) {
                targetLine2.textContent = line2Text.substring(0, index2 + 1);
                index2++;
                setTimeout(typeLine2, 75);
            } else {
                setTimeout(resetAndReplay, 4000);
            }
        }

        function resetAndReplay() {
            index1 = 0;
            index2 = 0;
            targetLine1.textContent = '';
            targetLine2.textContent = '';
            if (cursor1) cursor1.classList.remove('hidden');
            if (cursor2) cursor2.classList.add('hidden');
            setTimeout(typeLine1, 400);
        }

        // Trigger typing animation when footer section comes into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    typeLine1();
                    observer.disconnect();
                }
            });
        }, { threshold: 0.1 });

        const footerBanner = document.getElementById('footer-typewriter-section');
        if (footerBanner) {
            observer.observe(footerBanner);
        } else {
            typeLine1();
        }
    });
</script>
