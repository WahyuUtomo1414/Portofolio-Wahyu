@props([
    'profile' => [],
])

<section id="contact" class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <x-common.section-header 
            number="04" 
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

                <!-- Contact Detail Items -->
                <div class="space-y-4 font-mono text-sm">
                    
                    <!-- Email -->
                    <a href="mailto:{{ $profile['email'] ?? 'wahyudwiutomo1414@gmail.com' }}" class="flex items-center gap-3 p-3 bg-white border-neo rounded-md shadow-neo-sm hover:shadow-neo transition-all">
                        <div class="w-9 h-9 bg-[#2563EB] text-white flex items-center justify-center rounded border-neo font-bold">
                            ✉
                        </div>
                        <div class="truncate">
                            <div class="text-[10px] text-slate-400 font-bold uppercase">EMAIL UTAMA</div>
                            <div class="font-bold text-[#0F172A] text-xs sm:text-sm truncate">{{ $profile['email'] ?? 'wahyudwiutomo1414@gmail.com' }}</div>
                        </div>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 p-3 bg-white border-neo rounded-md shadow-neo-sm hover:shadow-neo transition-all">
                        <div class="w-9 h-9 bg-[#059669] text-white flex items-center justify-center rounded border-neo font-bold">
                            💬
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase">WHATSAPP</div>
                            <div class="font-bold text-[#0F172A] text-xs sm:text-sm">{{ $profile['no_wa'] ?? '+62 812-3456-7890' }}</div>
                        </div>
                    </a>

                    <!-- Location -->
                    <div class="flex items-center gap-3 p-3 bg-white border-neo rounded-md shadow-neo-sm">
                        <div class="w-9 h-9 bg-[#F59E0B] text-white flex items-center justify-center rounded border-neo font-bold">
                            📍
                        </div>
                        <div>
                            <div class="text-[10px] text-slate-400 font-bold uppercase">LOKASI</div>
                            <div class="font-bold text-[#0F172A] text-xs sm:text-sm">{{ $profile['location'] ?? 'Bekasi / Jakarta, Indonesia' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Chips -->
                <div class="pt-4 border-t border-slate-300 font-mono">
                    <div class="text-xs font-bold text-slate-500 uppercase mb-3">// CONNECT WITH ME</div>
                    <div class="flex flex-wrap gap-2 text-xs font-bold">
                        <a href="https://github.com/WahyuUtomo1414" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3 py-1.5 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">
                            GitHub ↗
                        </a>
                        <a href="https://linkedin.com/in/wahyu-dwi-utomo" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3 py-1.5 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">
                            LinkedIn ↗
                        </a>
                        <a href="https://instagram.com/wahyudwi" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3 py-1.5 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">
                            Instagram ↗
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
