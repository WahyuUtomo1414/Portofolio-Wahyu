# Audit Copywriting & SEO Website Portofolio Wahyu

## 1. Tujuan Dokumen

Dokumen ini merangkum hasil audit copywriting, SEO, dan data seeder pada Website Portofolio Wahyu untuk memastikan seluruh konten:

- konsisten dengan positioning pribadi (personal portfolio, bukan agency);
- memakai data asli, bukan placeholder atau dummy;
- profesional, ringkas, dan sesuai standar SEO dasar;
- tidak hardcoded di Blade jika konten bersifat editorial dan bisa berubah.

Audit ini mengacu pada:

- `docs/arsitektur.md`;
- `docs/design.md`;
- `docs/frontend-data-integration.md`;
- `docs/filament-resource.md`;
- `docs/database.md`.

## 2. Ringkasan Temuan

Temuan dikelompokkan berdasarkan prioritas:

| Prioritas | Kategori | Jumlah Temuan Utama |
| --- | --- | --- |
| P1 | Identitas kontak & data personal salah/inkonsisten | 5 |
| P2 | Positioning tercampur (personal vs agency) | 5 |
| P3 | Data seeder yang perlu dirapikan (di luar gambar) | 4 |
| P4 | SEO gap pada layout publik | 8 |
| P5 | Hardcoded copywriting di Blade | 11 |
| P6 | Inkonsistensi struktur & bahasa | 5 |
| P7 | Klaim & angka yang perlu diverifikasi | 4 |
| P8 | Bug teknis yang berdampak ke copy publik | 3 |

Catatan: seluruh gambar, logo, thumbnail, dan foto profil yang saat ini memakai `picsum.photos` di seeder akan diganti manual lewat database, jadi tidak dicakup dalam audit ini.

## 3. P1 — Identitas Kontak & Data Personal

Masalah utama: nama, email, nomor WA, dan handle sosial media berbeda-beda di berbagai file. Ini paling kritis karena berdampak langsung ke recruiter/klien.

### 3.1 Email

| Sumber | Nilai |
| --- | --- |
| `app/Support/PortfolioData.php` line 15 | `wahyudwiutomo1414@gmail.com` |
| `database/seeders/AboutSeeder.php` line 13 | `wahyudwiutomo1414@gmail.com` |
| `database/seeders/UserSeeder.php` line 14 | `wahyuxd14@gmail.com` |
| `resources/views/components/layout/footer.blade.php` line 91, 95 | fallback hardcoded `wahyudwiutomo1414@gmail.com` |

Rekomendasi:

- pilih satu email resmi profesional (misal `wahyudwiutomo1414@gmail.com` atau email personal branding lain);
- update seluruh sumber agar konsisten;
- fallback hardcoded di footer sebaiknya dihapus dan diarahkan ke variabel `$profile['email']`.

### 3.2 Nomor WhatsApp

| Sumber | Nilai |
| --- | --- |
| `PortfolioData.php` line 16, 25 | `+62 812-3456-7890` dan `https://wa.me/6281234567890` (dummy) |
| `AboutSeeder.php` line 16 | `6285891514812` |

Rekomendasi:

- pastikan nomor `6285891514812` benar milik pribadi;
- ganti seluruh dummy `+62 812-3456-7890` di `PortfolioData.php` agar tidak dipakai sebagai fallback ketika DB kosong.

### 3.3 Handle Sosial Media

| Sumber | Instagram | LinkedIn | GitHub |
| --- | --- | --- | --- |
| `PortfolioData.php` | `https://instagram.com/wahyudwi` | `https://linkedin.com/in/wahyu-dwi-utomo` | `https://github.com/WahyuUtomo1414` |
| `AboutSeeder.php` | `https://www.instagram.com/waahyutomo/` | `https://www.linkedin.com/in/wahyutomo/` | `https://github.com/WahyuUtomo1414` |

Rekomendasi:

- pilih handle asli yang aktif;
- samakan format URL (dengan trailing slash atau tidak, prefix `www` atau tidak);
- konsisten di `PortfolioData::profile()` dan `AboutSeeder`.

### 3.4 Lokasi

| Sumber | Nilai |
| --- | --- |
| `PortfolioData.php` | `Bekasi / Jakarta, Indonesia` |
| `AboutSeeder.php` | `Jakarta, Indonesia` |
| `footer.blade.php` line 123, 155 | hardcoded fallback `Bekasi / Jakarta, Indonesia` |

Rekomendasi:

- pilih satu format (disarankan `Jakarta, Indonesia` untuk ringkas);
- hapus fallback hardcoded di footer, gunakan `$profile['location']`.

### 3.5 Nama Akun & Konsistensi Personal

- `UserSeeder` memakai email `wahyuxd14@gmail.com` (mungkin akun lama);
- pertimbangkan mengganti akun admin agar sama dengan email publik agar tidak membingungkan saat login panel.

## 4. P2 — Positioning: Personal vs Agency

Website ini disebut sebagai portofolio pribadi, tapi banyak copy yang memakai nada perusahaan jasa. Ini menurunkan kesan "personal brand" dan malah terasa seperti mini agency.

### 4.1 Contoh Nada Agency yang Perlu Diubah

| File | Baris | Copy Sekarang | Masalah |
| --- | --- | --- | --- |
| `footer.blade.php` line 18 | `MOTTO & KOMITMEN LAYANAN` | kata "layanan" jamak, nada agency |
| `footer.blade.php` line 40 | `Siap membantu perusahaan, instansi, dan UMKM membangun aplikasi web modern...` | positioning jasa borongan |
| `footer.blade.php` line 46 | `KONSULTASI PROJECT SEKARANG` | CTA agency, bukan personal |
| `footer.blade.php` line 71-77 | `$service = new DigitalProduct(); ... 'client' => 'Your_Company'` | terminal snippet berkonotasi layanan |
| `footer.blade.php` line 120 | `Layanan profesional pengembangan aplikasi web, sistem enterprise, aplikasi mobile...` | brand tagline agency |
| `footer.blade.php` line 141 | `// IKUTI KAMI` | plural "kami" untuk personal brand terasa aneh |
| `contact-cta.blade.php` line 12 | `MARI BEKERJA SAMA UNTUK PROJECT ANDA NEXT!` | grammar `NEXT!` patah, nada agency |

### 4.2 Rekomendasi Perubahan Tone

Ganti dengan bahasa yang lebih personal, misalnya:

- `MOTTO & KOMITMEN LAYANAN` → `MOTTO & PRINSIP KERJA`
- `Siap membantu perusahaan, instansi, dan UMKM...` → `Fokus membangun aplikasi web dan sistem digital yang scalable, bersih, dan mudah dirawat.`
- `KONSULTASI PROJECT SEKARANG` → `DISKUSI PROJECT BARU`
- `// IKUTI KAMI` → `// IKUTI SAYA`
- `Layanan profesional pengembangan aplikasi web...` → `Software engineer yang fokus di pengembangan aplikasi web, sistem internal, dan aplikasi mobile.`
- `MARI BEKERJA SAMA UNTUK PROJECT ANDA NEXT!` → `MARI DISKUSIKAN PROJECT BERIKUTNYA` atau `TERTARIK KOLABORASI? MARI DISKUSI.`

### 4.3 Terminal Snippet di Footer

Snippet `startProject(...)` di footer.blade.php line 71-77 boleh dipertahankan sebagai gimmick visual, tapi ubah agar terasa personal, misalnya:

```
// Coba diskusi project baru
$wahyu = new SoftwareEngineer();
$wahyu->collaborate([
    'stack' => ['Backend', 'Frontend', 'Mobile'],
    'status' => '● OPEN_FOR_PROJECT',
]);
```

## 5. P3 — Data Seeder yang Perlu Dirapikan

Item terkait gambar (logo client, thumbnail project, foto profil, dsb) tidak dicakup karena akan diganti manual lewat database. Yang berikut ini bukan gambar dan tetap perlu perhatian:

### 5.1 URL Demo Project Masih Dummy

`ProjectSeeder.php` line 24-64: semua field `url` memakai `https://example.com/*`. Jika project belum punya URL demo publik, set `null` agar tombol demo tidak tampil di halaman publik. Jika sudah ada, isi URL asli.

### 5.2 Typo di ClientSeeder

| Baris | Nama Sekarang | Kemungkinan Benar |
| --- | --- | --- |
| 25 | `Dinas Pertamanan Dan Pemakanan DKI Jakarta` | `Dinas Pertamanan Dan Pemakaman DKI Jakarta` |
| 31 | `SMK Partriot Nusantara` | `SMK Patriot Nusantara` |

### 5.3 Bug Struktural ProjectSeeder

`ProjectSeeder.php` line 21: semua project di-set `'client_id' => 1`. Artinya seluruh project mengarah ke client pertama, terlepas dari fakta project itu untuk client mana. Ini menurunkan kredibilitas ketika halaman detail project publik menampilkan client yang salah.

Rekomendasi: tambahkan lookup `Client::query()->where('name', ...)->value('id')` seperti pola yang dipakai untuk `category_id`, atau isi `client_id` secara eksplisit per project.

### 5.4 Deskripsi Client Terlalu Generik

Semua client di seeder memakai template deskripsi mirip ("Perusahaan dengan kebutuhan sistem digital..."). Kalau memang client asli, tulis deskripsi spesifik project apa yang dikerjakan; jika hanya sebagai referensi visual, ubah menjadi one-liner ringkas seperti "ERP manufaktur" atau "Sistem informasi sekolah".

### 5.5 ContactSeeder Berisi Pesan Dummy

`ContactSeeder` menyimpan 3 pesan dari `Raka Pratama`, `Nadia Putri`, `Fajar Nugroho` yang bukan pesan asli. Data ini akan muncul di inbox panel admin dan bisa membingungkan saat cek pesan baru.

Rekomendasi: kosongkan `ContactSeeder` atau hapus pemanggilannya dari `PortfolioSeeder`. Biarkan tabel `contact` terisi dari form publik saja.

## 6. P4 — SEO Gap pada Layout Publik

File: `resources/views/layouts/public.blade.php`.

### 6.1 Meta Tag yang Sudah Ada

- `<title>` dengan fallback OK.
- `<meta name="description">` OK tapi generik.
- `<meta name="keywords">` ada, tapi keywords sudah tidak relevan untuk SEO modern (bisa dihapus).
- Open Graph title, description, image, type, url — OK.
- Twitter Card — OK.

### 6.2 Yang Belum Ada

| Tag | Status | Rekomendasi |
| --- | --- | --- |
| `<link rel="canonical">` | belum ada | tambahkan `<link rel="canonical" href="{{ url()->current() }}">` |
| `<meta name="robots">` | belum ada | tambahkan `<meta name="robots" content="index, follow">` untuk halaman publik |
| `og:site_name` | belum ada | tambahkan `<meta property="og:site_name" content="Wahyu Dwi Utomo">` |
| `og:locale` | belum ada | tambahkan `<meta property="og:locale" content="id_ID">` |
| `<link rel="icon">` favicon | belum ada | tambahkan favicon di `<head>` |
| `theme-color` mobile | belum ada | tambahkan `<meta name="theme-color" content="#0F172A">` sesuai palet |
| JSON-LD `Person` schema | belum ada | tambahkan structured data untuk portfolio personal |
| OG image file | referensi `images/og-image.jpg` | pastikan file ada di `public/images/og-image.jpg`, ukuran minimal 1200x630 |

### 6.3 Contoh JSON-LD Person Schema

```blade
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "Wahyu Dwi Utomo",
    "url": "{{ url('/') }}",
    "image": "{{ asset('images/profile/wahyu.png') }}",
    "jobTitle": "Software Engineer & Fullstack Developer",
    "email": "mailto:{{ $profile['email'] ?? '' }}",
    "sameAs": [
        "{{ $profile['social_github'] ?? '' }}",
        "{{ $profile['social_linkedin'] ?? '' }}",
        "{{ $profile['social_instagram'] ?? '' }}"
    ]
}
</script>
```

### 6.4 Title & Description Per Halaman

Sudah bagus:

- `ProjectController@index` set `title` dan `description` dengan spesifik.
- `ProjectController@show` set berdasarkan nama project.
- `BlogController@index` dan `ContactController@index` sudah override.

Belum bagus:

- `home.blade.php` line 3-4 memakai `$profile['name'] . ' — ' . $profile['role']` sebagai title. Ini fallback dari layout, tapi bisa dibuat lebih deskriptif seperti `Wahyu Dwi Utomo — Software Engineer Fullstack | Portofolio & Studi Kasus Project`.
- `home.blade.php` description saat ini sama dengan bio profil. Ganti dengan value proposition yang lebih SEO-friendly (menyebut "portofolio", "project", "Laravel", "developer Indonesia").

## 7. P5 — Hardcoded Copywriting di Blade

Meskipun `docs/arsitektur.md` menyatakan Blade harus terima data siap tampil, banyak copy editorial (section title, subtitle, tag section, badge) masih hardcoded. Ini bikin sulit maintain jika suatu saat ingin mengubah copy dari admin panel.

### 7.1 Section Header Home

| Component | Nomor | Tag | Title |
| --- | --- | --- | --- |
| `about-preview.blade.php` line 10-14 | `01` | `TENTANG SAYA & KEUNGGULAN` | `FILOSOFI & KEUNGGULAN KERJA` |
| `experience.blade.php` line 10-14 | `02` | `RIWAYAT KARIER & PENDIDIKAN` | `MY JOURNEY: EDUCATION & EXPERIENCE` |
| `clients.blade.php` line 10-14 | `04` | `MITRA & CLIENT` | `DIPERCAYA OLEH BERBAGAI BISNIS DAN INSTITUSI` |
| `featured-projects.blade.php` line 10-14 | `04` | `KATALOG PROJECT` | `PROJECT PILIHAN & KARYA TERBARU` |
| `contact-cta.blade.php` line 9-13 | `05` | `HUBUNGI SAYA` | `MARI BEKERJA SAMA UNTUK PROJECT ANDA NEXT!` |

Masalah:

- nomor section tidak konsisten: `01` → `02` → skip `03` → `04` → `04` (double) → `05`;
- semua copy hardcoded padahal ini konten editorial;
- masalah grammar di `contact-cta` (`NEXT!`).

Rekomendasi:

- pindahkan nomor + tag + title + subtitle ke array di `HomeController`;
- perbaiki urutan menjadi `01` (about), `02` (journey), `03` (clients), `04` (projects), `05` (contact) — sesuaikan juga dengan `docs/design.md`;
- konten section header bisa diambil dari config atau tabel `about` jika suatu saat ingin dinamis.

### 7.2 Copy JavaScript

- `footer.blade.php` line 163-164: text typewriter `SEMANGAT BERKEMBANG` dan `SEPANJANG MASA` hardcoded di script.
- `hero.blade.php` line 126: rotator words `['SOLUSI DIGITAL_', 'WEB & MOBILE_', 'SISTEM SCALABLE_', 'CLEAN ARCHITECTURE_']` hardcoded di script.

Rekomendasi:

- pindahkan ke variabel Blade yang diinject dari controller, atau `data-*` attribute di element target;
- misal: `<h1 data-rotator='["SOLUSI DIGITAL_","WEB & MOBILE_"]'>` lalu JS baca `dataset.rotator`.

### 7.3 Copy Kecil Berulang

| File | Copy | Lokasi Baris |
| --- | --- | --- |
| `hero.blade.php` | `Clean Code`, `Scalable`, `100% Kualitas`, `5+ Thn Exp` | 55, 60, 66, 72 |
| `hero.blade.php` | `PROFIL DEVELOPER`, `WAHYU.DEV`, `ONLINE` | 81, 84, 99 |
| `hero.blade.php` | `💻 Software Dev`, `📍 Bekasi / Jakarta` | 107, 110 |
| `about-preview.blade.php` | chips `Clean Code`, `Clean Architecture`, `High Performance` | 39-41 |
| `about-preview.blade.php` | `✔ VERIFIED STANDARD` | 63 |
| `experience.blade.php` | `EDUCATION`, `EXPERIENCE & WORK`, `// ACADEMIC BACKGROUND`, `// WORK HISTORY` | 29, 31, 99, 101 |

Rekomendasi:

- badge floating dan chip statis yang bersifat editorial sebaiknya dikelompokkan di controller atau file config `config/portfolio.php`;
- klaim `ONLINE` di hero terkesan misleading karena bukan status realtime, ganti dengan label netral seperti `AVAILABLE`.

## 8. P6 — Inkonsistensi Struktur & Bahasa

### 8.1 Menu Navbar Campur Bahasa

`navbar.blade.php`:

- desktop nav: `Home`, `About`, `Journey`, `Projects`, `Contact` (Inggris).
- mobile drawer: `Home`, `About Me`, `My Journey`, `Katalog Project`, `Hubungi Saya` (campur Inggris & Indonesia).

Rekomendasi: pilih satu bahasa dominan. Untuk portfolio profesional Indonesia disarankan pakai Bahasa Indonesia semua atau Inggris semua.

### 8.2 Nomor Section Home Tidak Berurut

Sudah dibahas di bagian 7.1. Perlu di-renumber ulang `01`-`05` tanpa lompatan/duplikasi.

### 8.3 Values Titles Campur Bahasa

`HomeController::valuesData()`:

- `KODE BERSIH & TERSTRUKTUR` (ID)
- `RESPONSIF & CEPAT DIAKSES` (ID)
- `AMAN & READY FOR SCALE` (campur ID+EN)
- `KOMUNIKASI TRANSPARAN` (ID)

Rekomendasi: konsisten Bahasa Indonesia, misalnya `AMAN & READY FOR SCALE` → `AMAN & SIAP TUMBUH`.

### 8.4 Duplikasi Section Header di /contact

`contact-cta.blade.php` (home) dan `pages/contact.blade.php` sama-sama tampilkan section header `HUBUNGI SAYA`. Halaman `/contact` juga pakai nomor `01` `HUBUNGI SAYA` `MARI DISKUSIKAN PROJECT ANDA`. Redundant.

Rekomendasi: pakai copy berbeda di halaman kontak dedicated, atau hapus section header di `pages/contact.blade.php` karena konteks halaman sudah jelas.

### 8.5 Naming Sosial Media

- di footer: `IKUTI KAMI` (jamak).
- di contact-cta: `// MEDIA SOSIAL`.
- di navbar dan hero: tidak ada label.

Rekomendasi: konsisten `IKUTI SAYA` atau `MEDIA SOSIAL`.

## 9. P7 — Klaim & Angka yang Perlu Diverifikasi

Klaim kuantitatif di section hero sangat berpengaruh ke kredibilitas. Pastikan angka realistis dan bisa dibuktikan.

| Klaim | Sumber | Catatan |
| --- | --- | --- |
| `5+ TAHUN PENGALAMAN` | `HomeController::statsData()` | Journey seeder mencatat experience mulai 2023. Kalau dihitung dari 2023 sampai 2026 hanya 3 tahun. Rekomendasi turunkan ke `3+` atau hitung ulang dari mulai belajar coding. |
| `20+ PROJECT SELESAI` | `HomeController::statsData()` | Seeder hanya berisi 3 project. Kalau memang punya 20+, tambahkan di seeder; kalau tidak, turunkan angka agar realistis. |
| `10+ MITRA & CLIENT` | `HomeController::statsData()` | ClientSeeder ada 13, fallback controller ada 16. Angka `10+` OK, tapi pastikan semua nama client asli. |
| `100% KOMITMEN KUALITAS` | `HomeController::statsData()` | Klaim absolut sulit dibuktikan. Rekomendasi ganti ke label kualitatif seperti `KODE BERSIH` atau `SIAP DEPLOY`. |
| `Lulus Predikat Cumlaude` | `JourneySeeder` line 29 | pastikan benar; jika belum lulus, ganti ke `Sedang menyelesaikan studi`. |
| `100+ mahasiswa` (di HomeController fallback journey line 227) | `HomeController::fallbackJourneyData()` | pastikan angka benar. Fallback ini masih aktif jika DB journey kosong. |

## 10. P8 — Bug Teknis yang Berdampak ke Copy Publik

### 10.1 `$totalProjects` Tidak Dikirim ke Featured Projects Home

`resources/views/pages/home.blade.php` line 27:

```blade
<x-home.featured-projects :projects="$featured_projects" />
```

Component `featured-projects.blade.php` menerima props `totalProjects` (default `0`) lalu tampilkan `LIHAT SEMUA PROJECT ({{ $totalProjects }}+)`. Karena tidak dipass dari `HomeController`, tombol akan tampil `LIHAT SEMUA PROJECT (0+)`.

Fix:

- `HomeController::index` tambahkan `'total_projects' => Project::query()->where('active', true)->count()`;
- `home.blade.php` pass `:totalProjects="$total_projects"`.

### 10.2 Blok `@php` di stats.blade.php

`resources/views/components/home/stats.blade.php` line 9-15:

```blade
@php
    $rawString = (string) $stat['number'];
    preg_match('/^(\d+)(.*)$/', $rawString, $matches);
    ...
@endphp
```

Melanggar aturan di `docs/arsitektur.md` bagian 6.1 dan `frontend-data-integration.md` bagian 6.1 yang melarang `@php` di Blade.

Fix: pindahkan parsing angka+suffix ke `HomeController::statsData()` sehingga `$stat` sudah punya `number_value` dan `number_suffix` siap render.

### 10.3 Nomor Section Duplikat

Sudah dibahas di bagian 7.1. Selain menurunkan kepercayaan visual, ini juga membingungkan pembaca urutan konten.

## 11. Rekomendasi Urutan Pengerjaan

Urutan yang disarankan agar audit ini bisa diselesaikan bertahap tanpa mengganggu website yang sudah jalan:

1. **P1 Identitas** — samakan email, no WA, sosial media, dan lokasi di `PortfolioData`, `AboutSeeder`, `UserSeeder`, dan footer. Ini paling kritis.
2. **P8 Bug** — perbaiki `$totalProjects` yang tidak dipass, hapus `@php` di stats, perbaiki nomor section. Cepat dikerjakan, dampak besar.
3. **P2 Positioning** — ganti seluruh copy nada agency menjadi personal. Konsisten dengan branding portofolio pribadi.
4. **P7 Klaim** — sesuaikan angka statistik agar realistis dan bisa dibuktikan.
5. **P4 SEO** — tambahkan canonical, robots, og:site_name, og:locale, favicon, dan JSON-LD Person.
6. **P5 Hardcoded Copy** — pindahkan section header dan copy editorial ke controller/config agar mudah di-maintain.
7. **P6 Konsistensi Bahasa** — pilih satu bahasa dominan untuk menu dan values.
8. **P3 Seeder** — rapikan URL `example.com` di ProjectSeeder, perbaiki typo ClientSeeder, fix `client_id => 1` yang hardcoded, dan hapus dummy `ContactSeeder`.

## 12. Catatan Tambahan

- Setelah copy editorial dipindah ke controller/config, section header bisa dijadikan record di tabel `about` sebagai kolom baru (misal `home_sections` json) jika ingin dikelola dari Filament di kemudian hari.
- Terminal snippet di footer dan rotator hero adalah gimmick visual yang bagus, tapi pastikan copy-nya tidak berkontradiksi dengan positioning personal.
- Semua fallback hardcoded di Blade (email, lokasi, nomor) sebaiknya dihilangkan dan diarahkan ke `$profile` yang dikirim dari controller lewat `PublicProfileData`. Ini mencegah kondisi "data berubah di admin tapi tetap muncul angka lama di footer".
- Klaim `ONLINE` di hero sebaiknya diganti `AVAILABLE` atau `OPEN FOR PROJECT` agar tidak terkesan realtime chat indicator.
- Setelah copy final, jalankan `php artisan test` dan preview `/` di browser untuk memverifikasi tidak ada layout shift atau string yang terputus.
