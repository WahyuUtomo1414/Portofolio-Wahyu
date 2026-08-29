<header class="sticky top-0 z-50 bg-[#FAF8F5]/90 backdrop-blur-md border-b-2 border-[#0F172A]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- Brand Logo (Clean & Elegant) -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="flex items-center gap-2 py-1 transition-all duration-200">
                    <img src="/images/brand/wdu-logo.svg" alt="Wahyu Dwi Utomo" class="h-10 sm:h-12 w-auto">
                </div>
            </a>

            <!-- Desktop Nav Items (Clean Typography - Removed stiff boxes) -->
            <nav class="hidden md:flex items-center space-x-8 font-sans text-sm font-bold">
                <a href="{{ route('home') }}" 
                   class="transition-colors duration-150 {{ request()->routeIs('home') && !request()->has('page') ? 'text-[#2563EB] border-b-2 border-[#2563EB] pb-0.5' : 'text-[#0F172A] hover:text-[#2563EB]' }}">
                    Home
                </a>
                <a href="#about" 
                   class="text-[#0F172A] hover:text-[#2563EB] transition-colors duration-150">
                    About
                </a>
                <a href="#experience" 
                   class="text-[#0F172A] hover:text-[#2563EB] transition-colors duration-150">
                    Journey
                </a>
                <a href="#projects" 
                   class="text-[#0F172A] hover:text-[#2563EB] transition-colors duration-150">
                    Projects
                </a>
                <a href="#contact" 
                   class="text-[#0F172A] hover:text-[#2563EB] transition-colors duration-150">
                    Contact
                </a>
            </nav>

            <!-- Action Button CTA (Sleek Rounded Button) -->
            <div class="hidden md:flex items-center">
                <a href="#contact" class="inline-flex items-center justify-center font-mono font-bold text-xs sm:text-sm bg-[#059669] hover:bg-[#047857] text-white px-5 py-2.5 rounded-full border-neo shadow-neo-sm hover:shadow-neo hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    <span>Kontak Saya</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="md:hidden">
                <button id="mobile-menu-toggle" type="button" class="bg-white border-neo p-2 rounded-lg shadow-neo-sm text-[#0F172A] hover:bg-slate-100 focus:outline-none" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-b-2 border-[#0F172A] bg-[#FAF8F5] px-4 pt-4 pb-6 space-y-3 font-sans font-bold">
        <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-lg border-neo bg-[#2563EB] text-white shadow-neo-sm">
            Home
        </a>
        <a href="#about" class="block px-4 py-2.5 rounded-lg border-neo bg-white text-[#0F172A] hover:bg-slate-100">
            About Me
        </a>
        <a href="#experience" class="block px-4 py-2.5 rounded-lg border-neo bg-white text-[#0F172A] hover:bg-slate-100">
            My Journey
        </a>
        <a href="#projects" class="block px-4 py-2.5 rounded-lg border-neo bg-white text-[#0F172A] hover:bg-slate-100">
            Katalog Project
        </a>
        <a href="#contact" class="block px-4 py-2.5 rounded-lg border-neo bg-white text-[#0F172A] hover:bg-slate-100">
            Hubungi Saya
        </a>
        <a href="#contact" class="block w-full text-center font-bold bg-[#059669] text-white px-4 py-3 rounded-full border-neo shadow-neo-sm">
            Kontak Saya →
        </a>
    </div>
</header>
