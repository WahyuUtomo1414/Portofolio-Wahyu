# Spesifikasi Desain UI/UX Web Portofolio Wahyu Dwi Utomo

## 1. Konsep & Filosofi Desain

Desain ini mengusung gaya **Modern Neo-Brutalisme Minimalis & Swiss Grid System**, yang terinspirasi dari struktur visual situs *Programmer Zaman Now* (PZN), namun disesuaikan agar terasa lebih **simple, elegan, dan profesional** untuk sebuah Website Portofolio Pribadi.

### Karakteristik Visual Utama:
- **Bold & Structured Layout**: Penggunaan garis tepi (border) hitam/dark charcoal yang tegas (`2px solid`) untuk memisahkan setiap section dan card.
- **Typography-Driven**: Judul besar dengan perpaduan teks *solid* dan *outlined/stroke text* (`text-stroke`).
- **Section Indexing System**: Menggunakan penomoran impresif di setiap judul section (contoh: `01 / PROJECT UNGGULAN`, `02 / PENGALAMAN & PERJALANAN`, `03 / SKILL & TEKNOLOGI`, `04 / HUBUNGI SAYA`).
- **Stat Counters Grid**: Section Hero dilengkapi dengan grid statistik pencapaian di sisi kanan.
- **Tech Stack Marquee Ticker**: Running banner di bagian bawah/tengah untuk menampilkan daftar teknologi yang dikuasai.
- **Subtle Texture Background**: Latar belakang warna off-white/cream lembut dengan pola dot-grid mikroskopis.

---

## 2. Palet Warna (Color Palette)

Warna neon/lime khas PZN disesuaikan menjadi opsi warna yang lebih **elegan, tenang, namun tetap berkarakter tinggi**:

| Peran Warna | Nama / Hex Code | Penggunaan |
| --- | --- | --- |
| **Primary Background** | `#FAF8F5` (Warm Cream / Off-White) | Background utama seluruh halaman dengan subtle dot grid pattern |
| **Secondary Background (Card)** | `#FFFFFF` (Pure White) | Surface background untuk card project, modal, dan container |
| **Dark Border & Primary Text** | `#0F172A` (Deep Slate / Pitch Charcoal) | Warna teks utama, heading, border `2px`, dan shadow box |
| **Accent Primary (Hero CTA)** | `#2563EB` (Royal Blue) | Tombol utama, highlight teks penting, dan aksen hover |
| **Accent Elegant (Highlight)** | `#059669` (Emerald Green) atau `#F59E0B` (Amber Warm) | Badge status "AVAILABLE FOR HIRE", tag "FEATURED", dan indikator |
| **Muted Text** | `#64748B` (Slate Gray) | Subtitle, tanggal, deskripsi sekunder, dan caption |
| **Marquee Ticker Accent** | `#1E293B` (Dark Slate) / `#E2E8F0` | Background banner running text teknologi |

---

## 3. Tipografi (Typography)

- **Heading Font**: `Space Grotesk` / `Plus Jakarta Sans` (Font sans-serif modern dengan karakter geometri yang tegas dan modern).
- **Body Font**: `Inter` / `Plus Jakarta Sans` (Tinggi keterbacaannya untuk paragraf dan deskripsi).
- **Monospace Accent**: `JetBrains Mono` / `Fira Code` (Untuk tag teknologi, kode, dan penomoran section `01 / ...`).

---

## 4. Bedah Struktur Section & Komponen Halaman

### 4.1 Header & Navbar (`public.blade.php` / `navbar.blade.php`)
- **Left**: Logo / Signature `[WAHYU.DEV]` atau `WAHYU DWI UTOMO` dalam box bergaris tegas.
- **Center**: Navigasi (`Home`, `Projects`, `Blog`, `Contact`) dengan indikator aktif berupa underline/background aksen.
- **Right**: Button CTA kontak cepat `"HUBUNGI SAYA ->"` dengan gaya pill/box ber-border tebal.

### 4.2 Hero Section (`home/hero.blade.php`)
- **Kolom Kiri (60%)**:
  - Badge Status: `● TERSEDIA UNTUK PROJECT FREELANCE & FULL-TIME` (Latar emerald lembut / amber).
  - Main Headline:
    ```text
    BUILDING SCALABLE
    FULLSTACK_
    WEB APPLICATIONS!
    ```
    *(Kata "FULLSTACK_" menggunakan efek outlined/stroke text)*
  - Subtitle: Paragraf pengenal singkat yang jelas dan profesional.
  - Action Buttons:
    - Primary: `"EXPLORE PROJECTS ->"` (Solid Royal Blue dengan box shadow tebal).
    - Secondary: `"DOWNLOAD CV"` (Outlined white dengan border tebal).
- **Kolom Kanan (40% - Stat Grid)**:
  - Grid 4 Kotak Terpisah (Bordered Box):
    - `5+` | TAHUN PENGALAMAN
    - `20+` | PROJECT SELESAI
    - `10+` | MITRA & CLIENT
    - `100%` | KOMITMEN KUALITAS

### 4.3 Tech Stack Marquee Ticker (`home/skills.blade.php`)
- Banner memanjang horizontal yang bergerak otomatis (infinite marquee scrolling).
- Menampilkan item: `LARAVEL` • `VUE.JS` • `FLUTTER` • `TAILWIND CSS` • `MYSQL` • `DOCKER` • `REST API` • `GIT`.

### 4.4 Section 01: Project Unggulan (`home/featured-projects.blade.php`)
- **Header Section**: `01 / KATALOG PROJECT` | **PROJECT PILIHAN DENGAN KUALITAS TERBAIK**
- **Grid Layout**: 2 Kolom (Desktop) / 1 Kolom (Mobile).
- **Project Card Component**:
  - Header Card: Kategori Badge (`WEB APP`, `ERP`, `MOBILE`) & Status Tag.
  - Visual: Thumbnail Screenshot Project dengan perbingkai garis tebal.
  - Content: Judul Project, Deskripsi Singkat, & Tech Stack Chips.
  - Footer Card: Link Demo & Button `"DETAIL PROJECT ->"`.

### 4.5 Section 02: Pengalaman & Perjalanan (`home/experience.blade.php`)
- **Header Section**: `02 / RIWAYAT KARIER` | **PENGALAMAN KERJA & PENDIDIKAN**
- **Layout Grid Bento Box** (Inspirasi dari screenshot "SEKALI BAYAR, AKSES SELAMANYA"):
  - Box berbingkai `2px solid #0F172A` yang tersusun rapi.
  - Setiap box berisi: Icon aksen, Posisi/Role, Nama Perusahaan/Institusi, Periode Tanggal, & Poin Kontribusi Utama.

### 4.6 Section 03: Keunggulan / Nilai Tambah (`home/about-preview.blade.php`)
- Grid 4 Kotak Fitur:
  - `[⚡] CLEAN & MAINTAINABLE CODE`: Kode rapi berstandar PSR & modular.
  - `[🎯] RESPONSIVE & ACCESSIBLE`: Tampilan optimal di HP hingga Desktop.
  - `[🛡️] SECURE & SCALABLE`: Penerapan arsitektur database & Laravel terbaik.
  - `[💬] CLEAR COMMUNICATION`: Komunikasi transparan & pembaruan berkala.

### 4.7 Section 04: Contact CTA & Footer (`home/contact-cta.blade.php` & `footer.blade.php`)
- Split Box Container:
  - **Sisi Kiri**: Headline ajakan kolaborasi (`"MARI BEKERJA SAMA UNTUK PROJECT ANDA NEXT!"`), email, WhatsApp, & sosial media link.
  - **Sisi Kanan**: Form kontak cepat (Nama, Email, Pesan, Button Kirim).
- **Footer**: Copyright, link navigasi ulang, & penanda waktu server.

---

## 5. Implementasi CSS / Tailwind Config

Contoh variabel Tailwind / CSS kustom yang dipasang di `resources/css/app.css`:

```css
/* Custom Utility Classes untuk Neo-Brutalisme Elegan */
.border-neo {
    border: 2px solid #0f172a;
}

.shadow-neo {
    box-shadow: 4px 4px 0px #0f172a;
}

.shadow-neo-sm {
    box-shadow: 2px 2px 0px #0f172a;
}

.shadow-neo-hover:hover {
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0px #0f172a;
}

.text-stroke-dark {
    -webkit-text-stroke: 1.5px #0f172a;
    color: transparent;
}
```

---

## 6. Poin-poin Penyesuaian Agar Terasa "Elegan" (Bukan Sekadar Brutalis)

1. **Shadow Tidak Terlalu Ekstrem**: Menggunakan shadow `4px` offset padat daripada `8px` agar tampilan tidak terlalu kartun.
2. **Padding & White Space Pemurah**: Jarak antar elemen dibuat lega agar pembaca nyaman memindai informasi.
3. **Sentuhan Warna Royal Blue & Emerald**: Mengganti warna kuning neon mencolok dengan kombinasi Royal Blue (`#2563EB`) dan Emerald (`#059669`) untuk mengesankan kualitas kelas atas.
4. **Sudut Sedikit Rounded (`rounded-md` / `rounded-lg`)**: Memberikan efek *soft edge* (4px - 8px) pada card dan button agar tidak terlalu kaku namun tetap memiliki kontur yang jelas.

---

## 7. Panduan SEO & Metadata

Dokumentasi ini memudahkan Anda untuk menyesuaikan pengaturan SEO pada website:

### 7.1 Parameter Meta Tag Utama
- **Meta Title**: `Wahyu Dwi Utomo — Senior Fullstack Web Developer & Software Engineer`
- **Meta Description**: `Portofolio profesional Wahyu Dwi Utomo. Spesialis pengembangan aplikasi web modern yang scalable, berkinerja tinggi, dan bersih menggunakan Laravel, Vue, Flutter, dan Tailwind CSS.`
- **Keywords**: `Wahyu Dwi Utomo, Fullstack Developer, Laravel Developer, Portofolio Software Engineer, Web Developer Indonesia, Freelance Web Developer`
- **Author**: `Wahyu Dwi Utomo`
- **Canonical URL**: `https://wahyu.dev` (atau domain utama Anda)

### 7.2 Social Media Meta (OpenGraph & Twitter Card)
- `og:type`: `website`
- `og:site_name`: `Wahyu Dwi Utomo Portfolio`
- `og:title`: `Wahyu Dwi Utomo — Senior Fullstack Web Developer`
- `og:description`: `Membangun sistem web modern, efisien, dan siap berkembang untuk bisnis dan industri.`
- `og:image`: URL Gambar Banner OpenGraph (`public/images/og-image.jpg`)
- `twitter:card`: `summary_large_image`
- `twitter:site`: `@wahyudwi`

---

## 8. Kamus Copywriting & Content Matrix

Dokumentasi ini dibuat agar Anda dapat dengan mudah mengubah semua teks di `HomeController.php` tanpa perlu merusak struktur Blade visual.

### 8.1 Copywriting Section Hero
| Parameter Key | Teks Default | Catatan / Tips Pengubahan |
| --- | --- | --- |
| `availability_badge` | `● TERSEDIA UNTUK FREELANCE & FULL-TIME` | Ubah jika Anda sedang sibuk/tidak menerima project baru |
| `headline_prefix` | `BUILDING SCALABLE` | Baris pertama headline |
| `headline_highlight` | `FULLSTACK_` | Kata dengan stroke outline tebal |
| `headline_suffix` | `WEB APPLICATIONS!` | Baris ketiga headline |
| `subtitle` | `Mengembangkan aplikasi web modern dari arsitektur backend yang kokoh hingga antarmuka pengguna yang intuitif dan responsif.` | Ringkasan peran profesional Anda |
| `cta_primary` | `LIHAT PROJECT ->` | Label tombol ke katalog project |
| `cta_secondary` | `UNDUH CV` | Label tombol ke file CV PDF |

### 8.2 Copywriting Stats Counter Grid
| Key | Nilai | Label |
| --- | --- | --- |
| `stat_1` | `5+` | `TAHUN PENGALAMAN` |
| `stat_2` | `20+` | `PROJECT SELESAI` |
| `stat_3` | `10+` | `MITRA & CLIENT` |
| `stat_4` | `100%` | `KOMITMEN KUALITAS` |

### 8.3 Copywriting Titles & Index Section
- **Section 01**: `01 / KATALOG PROJECT` — `"PROJECT PILIHAN TERBARU"`
- **Section 02**: `02 / RIWAYAT KARIER` — `"PENGALAMAN KERJA & PENDIDIKAN"`
- **Section 03**: `03 / KEUNGGULAN` — `"NILAI UTAMA DALAM BEKERJA"`
- **Section 04**: `04 / HUBUNGI SAYA` — `"MARI BEKERJA SAMA UNTUK PROJECT ANDA NEXT!"`
