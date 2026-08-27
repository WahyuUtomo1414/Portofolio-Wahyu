@props([
    'profile' => [],
])

<div class="lg:col-span-5 bg-[#FAF8F5] border-neo p-6 sm:p-8 rounded-lg shadow-neo space-y-6">
    <div>
        <h2 class="font-heading font-extrabold text-xl text-[#0F172A] uppercase">Informasi Kontak</h2>
        <p class="font-sans text-sm text-slate-600 mt-1">Respon cepat via WhatsApp atau email.</p>
    </div>

    <div class="space-y-4 font-mono text-sm">
        <a href="mailto:{{ $profile['email'] }}" class="block p-4 bg-white border-neo rounded-md shadow-neo-sm hover:shadow-neo transition-all">
            <span class="block text-[10px] text-slate-400 font-bold uppercase">Email</span>
            <span class="font-bold text-[#0F172A] break-all">{{ $profile['email'] }}</span>
        </a>

        <a href="{{ $profile['social_media']['whatsapp'] }}" target="_blank" rel="noopener" class="block p-4 bg-white border-neo rounded-md shadow-neo-sm hover:shadow-neo transition-all">
            <span class="block text-[10px] text-slate-400 font-bold uppercase">WhatsApp</span>
            <span class="font-bold text-[#0F172A]">{{ $profile['no_wa'] }}</span>
        </a>

        <div class="p-4 bg-white border-neo rounded-md shadow-neo-sm">
            <span class="block text-[10px] text-slate-400 font-bold uppercase">Lokasi</span>
            <span class="font-bold text-[#0F172A]">{{ $profile['location'] }}</span>
        </div>
    </div>

    <div class="pt-4 border-t border-slate-300 font-mono">
        <div class="text-xs font-bold text-slate-500 uppercase mb-3">// Social</div>
        <div class="flex flex-wrap gap-2.5 text-xs font-bold">
            <a href="{{ $profile['social_media']['github'] }}" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3 py-2 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">GitHub ↗</a>
            <a href="{{ $profile['social_media']['linkedin'] }}" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3 py-2 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">LinkedIn ↗</a>
            <a href="{{ $profile['social_media']['instagram'] }}" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3 py-2 rounded shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">Instagram ↗</a>
        </div>
    </div>
</div>
