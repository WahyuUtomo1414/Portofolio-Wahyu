@props([
    'profile' => [],
])

@php
    $socials = data_get($profile, 'social_media', []);
    $github = data_get($socials, 'github', 'https://github.com/WahyuUtomo1414');
    $linkedin = data_get($socials, 'linkedin', 'https://linkedin.com/in/wahyu-dwi-utomo');
    $instagram = data_get($socials, 'instagram', 'https://instagram.com/wahyudwi');
    $whatsapp = data_get($socials, 'whatsapp', 'https://wa.me/6281234567890');
    $email = data_get($profile, 'email', 'wahyudwiutomo1414@gmail.com');
@endphp

<section id="contact" class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <x-common.section-header 
            number="05" 
            tag="HUBUNGI SAYA" 
            title="MARI BEKERJA SAMA UNTUK PROJECT ANDA NEXT!" 
            subtitle="Punya ide project menarik, butuh pengembang web fullstack, atau ingin berkonsultasi teknis? Jangan ragu untuk menghubungi saya." />

        <!-- Split Container -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            <!-- Left Info Box (5 Cols) -->
            <div class="lg:col-span-5 bg-[#FAF8F5] border-neo p-6 sm:p-8 rounded-lg shadow-neo space-y-6">
                
                <div>
                    <h3 class="font-heading font-extrabold text-xl text-[#0F172A] uppercase">INFORMASI KONTAK</h3>
                    <p class="font-sans text-sm text-slate-600 mt-1">Respon cepat via WhatsApp atau Email.</p>
                </div>

                <!-- Contact Detail Items with SVG Icons -->
                <div class="space-y-4 font-mono text-sm">
                    
                    <!-- Email -->
                    <a href="mailto:{{ $email }}" class="flex items-center gap-3.5 p-3.5 bg-white border-neo rounded-md shadow-neo-sm hover:shadow-neo transition-all">
                        <div class="w-10 h-10 bg-[#2563EB] text-white flex items-center justify-center rounded border-neo flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="truncate">
                            <div class="text-[10px] text-slate-400 font-bold uppercase">EMAIL UTAMA</div>
                            <div class="font-bold text-[#0F172A] text-xs sm:text-sm truncate">{{ $email }}</div>
                        </div>
                    </a>

                    <!-- WhatsApp -->
                    <a href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3.5 p-3.5 bg-white border-neo rounded-md shadow-neo-sm hover:shadow-neo transition-all">
                        <div class="w-10 h-10 bg-[#059669] text-white flex items-center justify-center rounded border-neo flex-shrink-0">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.705 1.754zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l.24.384-1.03 3.762 3.842-1.007.391.232z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase">WHATSAPP / TELEPON</div>
                            <div class="font-bold text-[#0F172A] text-xs sm:text-sm">{{ data_get($profile, 'no_wa', '+62 812-3456-7890') }}</div>
                        </div>
                    </a>

                    <!-- Location -->
                    <div class="flex items-center gap-3.5 p-3.5 bg-white border-neo rounded-md shadow-neo-sm">
                        <div class="w-10 h-10 bg-[#F59E0B] text-white flex items-center justify-center rounded border-neo flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase">LOKASI DOMISILI</div>
                            <div class="font-bold text-[#0F172A] text-xs sm:text-sm">{{ data_get($profile, 'location', 'Bekasi / Jakarta, Indonesia') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Chips with SVG Icons -->
                <div class="pt-4 border-t border-slate-300 font-mono">
                    <div class="text-xs font-bold text-slate-500 uppercase mb-3">// MEDIA SOSIAL</div>
                    <div class="flex flex-wrap gap-2.5 text-xs font-bold">
                        <a href="{{ $github }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-white text-[#0F172A] border-neo px-3 py-2 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                            </svg>
                            <span>GitHub</span> ↗
                        </a>

                        <a href="{{ $linkedin }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-white text-[#0F172A] border-neo px-3 py-2 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                            <span>LinkedIn</span> ↗
                        </a>

                        <a href="{{ $instagram }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-white text-[#0F172A] border-neo px-3 py-2 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span>Instagram</span> ↗
                        </a>
                    </div>
                </div>

            </div>

            <!-- Right Form Box (7 Cols) -->
            <div class="lg:col-span-7 bg-white border-neo p-6 sm:p-8 rounded-lg shadow-neo space-y-5">
                <div>
                    <h3 class="font-heading font-extrabold text-xl text-[#0F172A] uppercase">KIRIM PESAN LANGSUNG</h3>
                    <p class="font-sans text-sm text-slate-600 mt-1">Isi form di bawah untuk mengirim pesan langsung ke email saya.</p>
                </div>

                <form action="#" method="POST" onsubmit="alert('Terima kasih! Pesan Anda telah terkirim (Demo Form).'); return false;" class="space-y-4 font-mono text-sm">
                    @csrf
                    <div>
                        <label for="name" class="block font-bold text-xs uppercase text-[#0F172A] mb-1.5">NAMA LENGKAP *</label>
                        <input type="text" id="name" name="name" required placeholder="Masukkan nama Anda" class="w-full bg-[#FAF8F5] border-neo rounded-md px-4 py-2.5 text-[#0F172A] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#2563EB] font-sans">
                    </div>

                    <div>
                        <label for="email" class="block font-bold text-xs uppercase text-[#0F172A] mb-1.5">ALAMAT EMAIL *</label>
                        <input type="email" id="email" name="email" required placeholder="nama@domain.com" class="w-full bg-[#FAF8F5] border-neo rounded-md px-4 py-2.5 text-[#0F172A] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#2563EB] font-sans">
                    </div>

                    <div>
                        <label for="message" class="block font-bold text-xs uppercase text-[#0F172A] mb-1.5">PESAN / DETAIL PROJECT *</label>
                        <textarea id="message" name="message" rows="4" required placeholder="Jelaskan kebutuhan project atau hal yang ingin didiskusikan..." class="w-full bg-[#FAF8F5] border-neo rounded-md px-4 py-2.5 text-[#0F172A] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#2563EB] font-sans"></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center font-mono font-bold text-sm bg-[#059669] hover:bg-[#047857] text-white px-8 py-3.5 rounded-md border-neo shadow-neo shadow-neo-hover cursor-pointer transition-all">
                            <span>KIRIM PESAN SEKARANG</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>
