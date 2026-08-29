@props([
    'profile' => [],
])

<div class="lg:col-span-5 bg-[#FAF8F5] border-neo p-6 sm:p-8 rounded-xl shadow-neo space-y-6">
    <div>
        <h2 class="font-heading font-extrabold text-xl text-[#0F172A] uppercase">Informasi Kontak</h2>
        <p class="font-sans text-sm text-slate-600 mt-1 font-medium">Respon cepat via WhatsApp atau Email.</p>
    </div>

    <div class="space-y-4 font-mono text-sm">
        
        <!-- Email Box with Copy Button -->
        <div class="p-4 bg-white border-neo rounded-lg shadow-neo-sm hover:shadow-neo transition-all flex items-center justify-between gap-3 group relative">
            <a href="mailto:{{ $profile['email'] }}" class="truncate flex-grow">
                <span class="block text-[10px] text-slate-400 font-bold uppercase">Email Utama</span>
                <span class="font-bold text-[#0F172A] break-all text-xs sm:text-sm group-hover:text-[#2563EB] transition-colors">{{ $profile['email'] }}</span>
            </a>
            <button type="button" 
                    onclick="copyToClipboard('{{ $profile['email'] }}', this)" 
                    class="bg-slate-100 hover:bg-[#2563EB] hover:text-white border-neo px-3 py-1.5 rounded text-xs font-bold transition-all cursor-pointer flex-shrink-0 flex items-center gap-1">
                <span>📋</span>
                <span class="copy-label">Salin</span>
            </button>
        </div>

        <!-- WhatsApp Box with Copy Button -->
        <div class="p-4 bg-white border-neo rounded-lg shadow-neo-sm hover:shadow-neo transition-all flex items-center justify-between gap-3 group relative">
            <a href="{{ $profile['social_media']['whatsapp'] }}" target="_blank" rel="noopener" class="truncate flex-grow">
                <span class="block text-[10px] text-slate-400 font-bold uppercase">WhatsApp Direct</span>
                <span class="font-bold text-[#0F172A] text-xs sm:text-sm group-hover:text-[#059669] transition-colors">{{ $profile['no_wa'] }}</span>
            </a>
            <button type="button" 
                    onclick="copyToClipboard('{{ $profile['no_wa'] }}', this)" 
                    class="bg-slate-100 hover:bg-[#059669] hover:text-white border-neo px-3 py-1.5 rounded text-xs font-bold transition-all cursor-pointer flex-shrink-0 flex items-center gap-1">
                <span>📋</span>
                <span class="copy-label">Salin</span>
            </button>
        </div>

        <!-- Location Box -->
        <div class="p-4 bg-white border-neo rounded-lg shadow-neo-sm">
            <span class="block text-[10px] text-slate-400 font-bold uppercase">Lokasi Domisili</span>
            <span class="font-bold text-[#0F172A] text-xs sm:text-sm">{{ $profile['location'] }}</span>
        </div>

    </div>

    <!-- Social Links -->
    <div class="pt-4 border-t border-slate-300 font-mono">
        <div class="text-xs font-bold text-slate-500 uppercase mb-3">// Media Sosial & Repository</div>
        <div class="flex flex-wrap gap-2.5 text-xs font-bold">
            <a href="{{ $profile['social_media']['github'] }}" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3.5 py-2 rounded-md shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">GitHub ↗</a>
            <a href="{{ $profile['social_media']['linkedin'] }}" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3.5 py-2 rounded-md shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">LinkedIn ↗</a>
            <a href="{{ $profile['social_media']['instagram'] }}" target="_blank" rel="noopener" class="bg-white text-[#0F172A] border-neo px-3.5 py-2 rounded-md shadow-neo-sm hover:bg-[#2563EB] hover:text-white transition-all">Instagram ↗</a>
        </div>
    </div>
</div>

<!-- Copy to Clipboard Script -->
<script>
    function copyToClipboard(text, btnElement) {
        if (!navigator.clipboard) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
        } else {
            navigator.clipboard.writeText(text);
        }

        const labelSpan = btnElement.querySelector('.copy-label');
        if (labelSpan) {
            const originalText = labelSpan.textContent;
            labelSpan.textContent = '✓ Tersalin!';
            btnElement.classList.add('bg-[#059669]', 'text-white');

            setTimeout(() => {
                labelSpan.textContent = originalText;
                btnElement.classList.remove('bg-[#059669]', 'text-white');
            }, 2000);
        }
    }
</script>
