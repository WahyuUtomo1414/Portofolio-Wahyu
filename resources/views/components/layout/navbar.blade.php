<header class="sticky top-0 z-50 bg-[#FAF8F5]/95 backdrop-blur-md border-neo-b border-[#0F172A]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="bg-white border-neo px-3 py-1.5 shadow-neo-sm group-hover:shadow-neo transition-all duration-200">
                    <span class="font-mono font-extrabold text-lg sm:text-xl tracking-tight text-[#0F172A]">
                        WAHYU<span class="text-[#2563EB]">.DEV</span>
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Items -->
            <nav class="hidden md:flex items-center space-x-1 sm:space-x-2 font-mono text-sm font-bold">
                <a href="{{ route('home') }}" 
                   class="px-4 py-2 rounded-md border-neo transition-all duration-150 {{ request()->routeIs('home') ? 'bg-[#2563EB] text-white shadow-neo-sm' : 'bg-white hover:bg-slate-100 text-[#0F172A]' }}">
                    // HOME
                </a>
                <a href="#projects" 
                   class="px-4 py-2 rounded-md bg-white hover:bg-slate-100 border-neo text-[#0F172A] transition-all duration-150">
                    // PROJECTS
                </a>
                <a href="#experience" 
                   class="px-4 py-2 rounded-md bg-white hover:bg-slate-100 border-neo text-[#0F172A] transition-all duration-150">
                    // EXPERIENCE
                </a>
                <a href="#contact" 
                   class="px-4 py-2 rounded-md bg-white hover:bg-slate-100 border-neo text-[#0F172A] transition-all duration-150">
                    // CONTACT
                </a>
            </nav>

            <!-- Action Button CTA -->
            <div class="hidden md:flex items-center">
                <a href="#contact" class="inline-flex items-center justify-center font-mono font-bold text-sm bg-[#059669] text-white px-5 py-2.5 rounded-md border-neo shadow-neo-sm hover:shadow-neo hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                    <span>KONTAK SAYA</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            <!-- Mobile Hamburger Button -->
            <div class="md:hidden">
                <button id="mobile-menu-toggle" type="button" class="bg-white border-neo p-2 rounded-md shadow-neo-sm text-[#0F172A] hover:bg-slate-100 focus:outline-none" aria-label="Toggle menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-neo-t bg-[#FAF8F5] px-4 pt-4 pb-6 space-y-3 font-mono font-bold">
        <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-md border-neo bg-[#2563EB] text-white shadow-neo-sm">
            // HOME
        </a>
        <a href="#projects" class="block px-4 py-2.5 rounded-md border-neo bg-white text-[#0F172A]">
            // PROJECTS
        </a>
        <a href="#experience" class="block px-4 py-2.5 rounded-md border-neo bg-white text-[#0F172A]">
            // EXPERIENCE
        </a>
        <a href="#contact" class="block px-4 py-2.5 rounded-md border-neo bg-white text-[#0F172A]">
            // CONTACT
        </a>
        <a href="#contact" class="block w-full text-center font-bold bg-[#059669] text-white px-4 py-3 rounded-md border-neo shadow-neo-sm">
            KONTAK SAYA →
        </a>
    </div>
</header>
