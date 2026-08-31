# Catatan Kepribadian & Preferensi Wahyu Dwi Utomo

Dokumen ini mencatat preferensi personal, gaya komunikasi, dan arah branding Wahyu Dwi Utomo untuk menjaga konsistensi saat mengembangkan website portofolio ini.

## Identitas Personal

- Nama publik: Wahyu Dwi Utomo.
- Inisial brand visual: WDU.
- Role utama yang ingin ditampilkan: Software Engineer.
- Lokasi publik: Jakarta, Indonesia.
- Email publik: wahyuxd14@gmail.com.
- Instagram: https://www.instagram.com/waahyutomo/
- LinkedIn: https://www.linkedin.com/in/wahyutomo/
- GitHub: https://github.com/WahyuUtomo1414
- WhatsApp: 6285891514812.

## Positioning

Wahyu ingin tampil sebagai personal portfolio, bukan agency. Copywriting harus terasa personal, profesional, dan tidak seperti layanan perusahaan jasa.

Gunakan positioning umum:

- Software engineer yang membangun produk digital.
- Fokus pada sistem yang rapi, scalable, mudah dirawat, dan nyaman digunakan.
- Bisa mengerjakan backend, frontend, mobile, dashboard, API, dan sistem internal tanpa menjadikan satu teknologi tertentu sebagai identitas utama.

Hindari positioning yang terlalu sempit:

- Senior Software Engineer.
- Senior Fullstack Developer.
- Laravel Developer.
- Vue Developer.
- Fullstack Web Developer sebagai label utama.
- Copy yang terlalu menjual seperti agency.

## Gaya Bahasa

- Gunakan Bahasa Indonesia sebagai bahasa utama website.
- Istilah teknis boleh tetap memakai bahasa Inggris jika memang umum dipakai, misalnya backend, frontend, mobile, API, dashboard, deployment, scalable, dan software engineer.
- Hindari campuran bahasa yang terasa asal, seperti CTA Indonesia tetapi label navigasi Inggris.
- Nada tulisan harus tegas, ringkas, profesional, dan manusiawi.
- Hindari klaim berlebihan yang sulit dibuktikan.

## Preferensi Copywriting

Copy yang disukai:

- Personal, jelas, dan realistis.
- Menjelaskan problem, solusi, dan hasil.
- Tidak terlalu banyak menyebut framework di deskripsi utama.
- Teknologi boleh masuk ke tech stack, bukan headline personal.

Copy yang perlu dihindari:

- Embel-embel teknologi di hero seperti Laravel, Vue, atau framework tertentu.
- Kata-kata yang membuat website terasa seperti agency, misalnya "layanan profesional" sebagai tone utama.
- Klaim absolut seperti "100% kualitas" jika tidak jelas konteksnya.
- Status yang terkesan realtime seperti "ONLINE" jika bukan status live.

## Data & Klaim

- Pengalaman profesional dimulai dari 2023.
- Angka pengalaman yang aman untuk ditampilkan: 3+ tahun.
- Total project boleh memakai 20+ karena dihitung dari project kuliah, kerja, freelance, dan joki.
- Status pendidikan: lulus dengan IPK 3.6, bukan cumlaude.
- Jika data bisa berubah dari admin panel, jangan hardcode di Blade.

## Preferensi UI

- Logo navbar dan footer memakai nama lengkap Wahyu Dwi Utomo.
- Favicon dan brand mark memakai inisial WDU.
- Logo sebaiknya clean, tanpa kotak putih tambahan di belakang mark.
- Visual boleh tegas dan modern, tapi jangan terlalu ramai.
- Bagian hero harus terasa luas, personal, dan tidak terlalu mengunci ke teknologi spesifik.

## Preferensi Teknis Project

- Blade hanya untuk render data yang sudah siap tampil.
- Jangan taruh logic PHP mentah, query, mapping, parsing, atau helper kompleks di Blade.
- Logic presentational sebaiknya disiapkan di controller atau support class.
- Jangan jadikan `AppServiceProvider` sebagai tempat helper umum.
- Helper reusable lebih cocok ditempatkan di `app/Support`.
- Data dari storage harus dinormalisasi lewat helper storage URL agar upload dari Filament muncul di halaman publik.
- Data yang punya kolom database harus diintegrasikan dari DB, dengan fallback seperlunya.

## Catatan Untuk Pengembangan Berikutnya

- Jika menambah copy baru, pastikan bahasa Indonesia dominan.
- Jika menambah label role, gunakan "Software Engineer" sebagai default.
- Jika menambah section baru, pastikan tidak terasa seperti company profile agency.
- Jika menambah data sosial/media, prioritaskan penyimpanan di kolom JSON `sosial_media` bila datanya memang bagian dari profil personal.
- Jika mengubah seeder, pastikan tidak merusak data manual seperti gambar yang sudah diupload melalui Filament.
