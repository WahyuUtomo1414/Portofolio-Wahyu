<div class="lg:col-span-7 bg-white border-neo p-6 sm:p-8 rounded-lg shadow-neo space-y-5">
    <div>
        <h2 class="font-heading font-extrabold text-xl text-[#0F172A] uppercase">Kirim Pesan</h2>
        <p class="font-sans text-sm text-slate-600 mt-1">Isi form di bawah untuk memulai diskusi project.</p>
    </div>

    <form action="{{ route('contact.store') }}" method="POST" class="space-y-4 font-mono text-sm">
        @csrf

        <div>
            <label for="name" class="block font-bold text-xs uppercase text-[#0F172A] mb-1.5">Nama Lengkap *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama Anda" class="w-full bg-[#FAF8F5] border-neo rounded-md px-4 py-2.5 text-[#0F172A] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#2563EB] font-sans">
            @error('name')
                <p class="mt-1 text-xs text-red-600 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-bold text-xs uppercase text-[#0F172A] mb-1.5">Alamat Email *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@domain.com" class="w-full bg-[#FAF8F5] border-neo rounded-md px-4 py-2.5 text-[#0F172A] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#2563EB] font-sans">
            @error('email')
                <p class="mt-1 text-xs text-red-600 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block font-bold text-xs uppercase text-[#0F172A] mb-1.5">Pesan / Detail Project *</label>
            <textarea id="message" name="message" rows="5" required placeholder="Jelaskan kebutuhan project atau hal yang ingin didiskusikan..." class="w-full bg-[#FAF8F5] border-neo rounded-md px-4 py-2.5 text-[#0F172A] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#2563EB] font-sans">{{ old('message') }}</textarea>
            @error('message')
                <p class="mt-1 text-xs text-red-600 font-bold">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center font-mono font-bold text-sm bg-[#059669] hover:bg-[#047857] text-white px-8 py-3.5 rounded-md border-neo shadow-neo shadow-neo-hover cursor-pointer transition-all">
            KIRIM PESAN SEKARANG
        </button>
    </form>
</div>
