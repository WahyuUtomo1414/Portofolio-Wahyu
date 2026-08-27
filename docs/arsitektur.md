# Arsitektur Website Portofolio Wahyu

## 1. Tujuan Dokumen

Dokumen ini menjadi acuan arsitektur frontend publik Website Portofolio Wahyu.

Fokus utama dokumen:

- menentukan struktur controller, route, Blade page, dan Blade component;
- memisahkan data konten portofolio dari tampilan;
- menjaga Blade tetap bersih dari query dan logic berat;
- membuat struktur folder yang mudah dikembangkan jika nanti ditambah admin panel, database, atau CMS.

## 2. Konteks Project Saat Ini

Project menggunakan Laravel 13 sebagai backend utama.

Kondisi repo saat ini:

- Laravel 13 sudah terpasang;
- route publik `/` sudah memakai `HomeController`;
- route publik `projects`, `blog`, dan `contact` sudah dipisah ke controller masing-masing;
- model domain portofolio sudah mengikuti `docs/database.md`;
- Filament panel sudah tersedia untuk admin konten;
- layout publik, Blade page, dan Blade component portofolio sudah tersedia.

Karena ini website portofolio pribadi, area utama tetap website publik. Admin panel dipakai sebagai area internal untuk mengelola konten portofolio dari database.

## 3. Prinsip Arsitektur

Project dibagi menjadi dua kemungkinan area:

- Website Publik
- Admin Panel opsional

Website Publik:

- dipakai oleh recruiter, calon klien, partner, dan pengunjung umum;
- dibangun memakai route, controller, Blade layout, dan Blade component;
- menampilkan profil, skill, project, pengalaman, sertifikat, blog atau tulisan, dan kontak;
- tidak membutuhkan login publik.

Admin Panel opsional:

- hanya dibuat jika konten portofolio ingin dikelola dari database;
- sebaiknya memakai Filament jika nanti diperlukan;
- tidak perlu dibuat manual dengan Blade.

Catatan:

- Jangan membuat dashboard admin manual pada tahap awal.
- Jangan query database langsung dari Blade.
- Jangan menaruh logic formatting berat di Blade.
- Controller menyiapkan data siap tampil.
- Blade page menyusun section.
- Component fokus ke tampilan kecil yang reusable.

## 4. Struktur Folder Saat Ini

Struktur penting repo saat ini:

```text
app/
├── Http/
│   └── Controllers/
│       └── Controller.php
├── Models/
│   └── User.php
└── Providers/
    └── AppServiceProvider.php

resources/
├── css/
│   └── app.css
├── js/
│   └── app.js
└── views/
    └── welcome.blade.php

routes/
├── console.php
└── web.php
```

## 5. Struktur Frontend Publik Yang Disarankan

Struktur frontend publik sebaiknya dibuat seperti ini:

```text
app/
├── Http/
│   └── Controllers/
│       ├── HomeController.php
│       ├── ProjectController.php
│       ├── BlogController.php
│       └── ContactController.php
└── Support/
    └── PortfolioData.php

resources/
└── views/
    ├── layouts/
    │   └── public.blade.php
    ├── components/
    │   ├── layout/
    │   │   ├── navbar.blade.php
    │   │   └── footer.blade.php
    │   ├── common/
    │   │   ├── section-header.blade.php
    │   │   ├── button-primary.blade.php
    │   │   ├── button-secondary.blade.php
    │   │   ├── empty-state.blade.php
    │   │   └── image-card.blade.php
    │   ├── home/
    │   │   ├── hero.blade.php
    │   │   ├── about-preview.blade.php
    │   │   ├── skills.blade.php
    │   │   ├── featured-projects.blade.php
    │   │   ├── experience.blade.php
    │   │   └── contact-cta.blade.php
    │   ├── project/
    │   │   ├── card.blade.php
    │   │   ├── tech-stack.blade.php
    │   │   └── gallery.blade.php
    │   ├── blog/
    │   │   ├── card.blade.php
    │   │   └── content.blade.php
    │   └── contact/
    │       ├── contact-info.blade.php
    │       └── form.blade.php
    └── pages/
        ├── home.blade.php
        ├── projects/
        │   ├── index.blade.php
        │   └── show.blade.php
        ├── blog/
        │   ├── index.blade.php
        │   └── show.blade.php
        └── contact.blade.php
```

Catatan:

- `pages` dipakai sebagai penyusun halaman utama.
- `components` dipakai untuk section kecil dan UI reusable.
- Controller hanya menyiapkan data.
- Blade page tidak boleh menampung query database langsung.
- Blade tidak boleh berisi tag PHP mentah seperti `<?php ... ?>`.
- Blade directive dan echo seperti `{{ }}`, `@if`, `@foreach`, `route()`, `asset()`, `old()`, dan `@csrf` masih boleh dipakai seperlunya.

## 6. Domain Halaman Website Publik

Halaman publik yang disarankan pada tahap awal:

| Halaman | Route | Controller | Method | Data Utama |
| --- | --- | --- | --- | --- |
| Home | `/` | `HomeController` | `index` | profil singkat, skill, project unggulan, pengalaman, CTA kontak |
| Project | `/projects` | `ProjectController` | `index` | list project, kategori, tech stack |
| Detail Project | `/projects/{slug}` | `ProjectController` | `show` | detail project, gambar, link demo, link repository, tech stack |
| Blog | `/blog` | `BlogController` | `index` | list tulisan, kategori, pagination |
| Detail Blog | `/blog/{slug}` | `BlogController` | `show` | detail tulisan dan tulisan terkait |
| Kontak | `/contact` | `ContactController` | `index` | email, WhatsApp, sosial media, form kontak |
| Kirim Kontak | `/contact` | `ContactController` | `store` | validasi dan simpan atau kirim pesan |

Catatan:

- Untuk tahap awal, konten shared publik boleh disiapkan di presenter sederhana seperti `App\Support\PortfolioData`.
- Jika nanti semua konten publik sudah diambil dari database, gunakan route model binding slug untuk project.
- Halaman about terpisah belum wajib jika profil sudah cukup kuat di Home.
- Jika konten profil panjang, boleh ditambahkan route `/about`.
- Route blog boleh menjadi placeholder sampai tabel blog/post ditambahkan.

## 7. Mapping Konten ke Frontend

Jika belum semua halaman membaca database, data bisa disimpan di presenter sederhana.

| Konten | Sumber Tahap Awal | Tampilan Publik |
| --- | --- | --- |
| Profil | `App\Support\PortfolioData` atau tabel `about` | hero, about preview, footer, contact |
| Skill | config/controller | section skill |
| Project | `App\Support\PortfolioData` atau tabel `project` | home, project index, project detail |
| Experience | config/controller | home |
| Education | config/controller | home atau about |
| Certificate | config/controller | home atau about |
| Blog | markdown/config/database opsional | blog index, blog detail |
| Contact | config/env | halaman kontak, footer |
| Social Link | config/controller | navbar, footer, contact |

Jika nanti memakai database, domain model yang masuk akal:

| Tabel | Model | Tampilan Publik |
| --- | --- | --- |
| `about` | `About` | home, contact, footer |
| `journey` | `Journey` | education, experience, organization timeline |
| `category` | `Category` | filter project |
| `client` | `Client` | client section, detail project |
| `tools` | `Tools` | skill section, tech stack project |
| `project` | `Project` | home, project index, project detail |
| `project_tool` | `ProjectTool` | relasi banyak tools per project |
| `project_image` | `ProjectImage` | gallery detail project |

Filter data publik jika sudah memakai database:

- tampilkan hanya `active = true`;
- jangan tampilkan data soft deleted;
- project unggulan memakai `is_featured = true`;
- urutkan project berdasarkan `sort` lalu `created_at`;
- urutkan journey berdasarkan `sort`;
- eager load relasi yang tampil di halaman, misalnya `project.category`, `project.client`, `project.tools`, dan `project.images`.

## 8. Layout Global

File layout:

- `resources/views/layouts/public.blade.php`

Isi layout:

- tag `<head>` global;
- meta viewport;
- title dinamis;
- meta description opsional;
- Vite asset;
- navbar;
- slot konten;
- footer;
- script global.

Contoh struktur:

```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $title ?? 'Wahyu Dwi Utomo')</title>
    <meta name="description" content="@yield('description', $description ?? 'Portofolio pribadi Wahyu Dwi Utomo.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-layout.navbar />

    <main>
        @yield('content')
    </main>

    <x-layout.footer />
</body>
</html>
```

Aturan:

- Jangan memakai tag PHP mentah `<?php ... ?>` di Blade.
- Hindari blok `@php` kecuali benar-benar darurat.
- Jangan menaruh query model di Blade.
- URL gambar dan tanggal terformat disiapkan dari controller, accessor, atau helper khusus.

## 9. Arah Visual Frontend

Frontend portofolio sebaiknya terasa personal, profesional, modern, dan mudah dipindai.

Karakter visual:

- first viewport langsung memperlihatkan nama, role, ringkasan kemampuan, dan CTA;
- project menjadi bukti utama kemampuan;
- tipografi jelas dan tidak terlalu dekoratif;
- warna utama konsisten, tapi tidak terlalu ramai;
- card sederhana untuk project, experience, certificate, dan blog;
- mobile-first.

Palet awal yang disarankan:

```css
:root {
    --color-primary: #123c69;
    --color-primary-dark: #0b2545;
    --color-secondary: #2563eb;
    --color-accent: #14b8a6;
    --color-surface: #f8fafc;
    --color-surface-tint: #eef6ff;
    --color-text: #111827;
    --color-muted: #4b5563;
    --color-border: #d1d5db;
}
```

Catatan:

- Hindari visual yang terlalu ramai.
- Hindari terlalu banyak gradient.
- Prioritaskan keterbacaan project, pengalaman, dan kontak.
- Gunakan screenshot project atau gambar nyata sebagai visual utama.

## 10. Standar Mobile-First

Aturan frontend:

- default styling adalah mobile;
- breakpoint `md`, `lg`, dan `xl` dipakai untuk layar lebih besar;
- semua grid dimulai dari satu kolom;
- navbar wajib punya menu mobile;
- gambar harus responsive;
- card tidak boleh menyebabkan horizontal scroll;
- tombol utama mudah ditekan di layar kecil.

Contoh pola grid:

```blade
<div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
    {{-- cards --}}
</div>
```

## 11. Alur Backend ke Frontend

Alur data:

```text
Route
-> Controller
-> Data Source
-> View Data
-> Blade Page
-> Blade Component
-> HTML + CSS
```

Aturan:

- Route hanya mengarahkan request.
- Controller mengambil dan memformat data.
- Data source tahap awal boleh berupa config, array, markdown, atau database.
- Query yang rumit boleh dipindah ke service.
- Blade page menyusun section.
- Component fokus ke tampilan kecil yang reusable.
- Jangan query database langsung di component Blade.
- Jangan menulis tag PHP mentah `<?php ... ?>` di Blade.
- Blade menerima data siap tampil, misalnya `image_url`, `detail_url`, `formatted_date`, `tech_stack`, dan `external_links`.

## 12. Route Publik

Contoh route awal:

```php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
```

## 13. Controller Publik

### 13.1 HomeController

File page:

- `resources/views/pages/home.blade.php`

Data:

- profil singkat;
- role utama;
- CTA kontak dan CV;
- skill utama;
- project unggulan;
- pengalaman terbaru;
- link sosial media.

Component section:

- `components/home/hero.blade.php`
- `components/home/about-preview.blade.php`
- `components/home/skills.blade.php`
- `components/home/featured-projects.blade.php`
- `components/home/experience.blade.php`
- `components/home/contact-cta.blade.php`

### 13.2 ProjectController

File page:

- `resources/views/pages/projects/index.blade.php`
- `resources/views/pages/projects/show.blade.php`

Data index:

- list project;
- filter kategori atau tech stack;
- project unggulan;
- link demo dan repository jika tersedia.

Data show:

- detail project;
- deskripsi masalah dan solusi;
- tech stack;
- fitur utama;
- gambar atau screenshot;
- link demo;
- link repository;
- project terkait.

Component:

- `components/project/card.blade.php`
- `components/project/tech-stack.blade.php`
- `components/project/gallery.blade.php`

### 13.3 BlogController

File page:

- `resources/views/pages/blog/index.blade.php`
- `resources/views/pages/blog/show.blade.php`

Data index:

- list tulisan;
- kategori;
- pagination jika memakai database.

Data show:

- detail tulisan;
- tanggal publikasi;
- kategori;
- tulisan terkait.

Component:

- `components/blog/card.blade.php`
- `components/blog/content.blade.php`

### 13.4 ContactController

File page:

- `resources/views/pages/contact.blade.php`

Data:

- email;
- nomor WhatsApp;
- lokasi;
- link LinkedIn;
- link GitHub;
- link Instagram opsional;
- form pesan.

Component:

- `components/contact/contact-info.blade.php`
- `components/contact/form.blade.php`

Catatan:

- Form kontak memakai validasi Laravel.
- Jika belum ada tabel contact, form boleh diarahkan ke `mailto:` atau WhatsApp terlebih dahulu.
- Jika memakai form POST, pesan bisa dikirim ke email atau disimpan ke database.
- Link eksternal wajib memakai `target="_blank"` dan `rel="noopener"`.

## 14. Standar Gambar dan File Publik

Data gambar/file bisa berasal dari `public/`, `storage/app/public`, atau upload admin jika nanti ada CMS.

Mapping file yang disarankan:

| Konten | Directory |
| --- | --- |
| Foto profil | `public/images/profile` |
| Screenshot project | `public/images/projects` |
| Logo teknologi | `public/images/tech` |
| Sertifikat | `public/images/certificates` |
| Blog thumbnail | `public/images/blog` |
| CV | `public/files` |

Aturan frontend:

- tampilkan gambar dari field siap pakai seperti `$project['thumbnail_url']`;
- sediakan placeholder jika gambar kosong;
- semua gambar memakai `alt` yang jelas;
- gambar card memakai ukuran konsisten;
- jangan hardcode path gambar di banyak file Blade;
- pembentukan URL gambar dilakukan di controller, config, accessor, atau helper khusus.

## 15. Catatan SEO dan Aksesibilitas

Standar minimal:

- setiap halaman punya title yang jelas;
- home punya meta description;
- heading hanya satu `h1` utama per halaman;
- gambar punya `alt`;
- link eksternal punya label jelas;
- warna teks memenuhi kontras yang cukup;
- tombol dan link bisa diakses lewat keyboard;
- URL halaman project dan blog dibuat pendek dan deskriptif.

## 16. Sinkronisasi Naming

Keputusan naming konsep:

- route memakai bahasa Inggris agar konsisten dengan nama controller dan folder;
- folder `projects` memakai plural karena halaman index berisi banyak project;
- controller memakai PascalCase;
- component folder memakai lowercase;
- route name memakai plural untuk resource-like page.

Contoh:

- `ProjectController`
- `projects.index`
- `projects.show`
- `resources/views/pages/projects/index.blade.php`
- `resources/views/components/project/card.blade.php`

## 17. Prioritas Pengerjaan Frontend

Urutan pengerjaan yang disarankan:

1. Buat `resources/views/layouts/public.blade.php`.
2. Buat `components/layout/navbar.blade.php`.
3. Buat `components/layout/footer.blade.php`.
4. Buat component button, section header, empty state, dan image card.
5. Ubah route `/` agar memakai `HomeController`.
6. Buat `HomeController` dan `pages/home.blade.php`.
7. Buat section hero, skills, featured projects, experience, dan contact CTA.
8. Buat halaman project index dan detail.
9. Buat halaman kontak.
10. Tambahkan blog jika memang ingin rutin menulis.
11. Rapikan responsive mobile-first.
12. Sambungkan gambar dan file CV.

Alasan:

- layout global harus stabil lebih dulu;
- home menjadi pintu utama portofolio;
- project adalah bukti kerja paling penting;
- kontak harus mudah ditemukan;
- blog bisa menyusul setelah konten utama siap.

## 18. Catatan Teknis Penting

- Jangan menambah login publik pada tahap awal.
- Jangan membuat admin panel sebelum ada kebutuhan kelola konten dinamis.
- Gunakan route name agar link mudah dirawat.
- Jangan query langsung dari Blade.
- Jangan menulis tag PHP mentah `<?php ... ?>` di Blade.
- Blade directive dan helper view sederhana masih boleh dipakai.
- Gunakan component untuk UI yang berulang.
- Gunakan data siap tampil dari controller.
- Gunakan fallback gambar jika data gambar kosong.
- Gunakan validasi Laravel untuk form kontak.
- Jalankan `php artisan test` setelah perubahan controller atau route.
- Jalankan `npm run build` sebelum deploy jika frontend memakai Vite.

## 19. Rekomendasi Isi Website

Isi portofolio yang paling pas untuk versi awal:

- Home sebagai ringkasan identitas, role, skill utama, project unggulan, pengalaman, dan CTA kontak.
- Project sebagai halaman pembuktian kemampuan teknis.
- Detail project sebagai studi kasus singkat: masalah, solusi, fitur, tech stack, screenshot, dan link.
- Kontak sebagai jalur komunikasi lewat email, WhatsApp, LinkedIn, dan GitHub.
- Blog opsional untuk tulisan teknis, catatan belajar, atau dokumentasi project.

Yang belum perlu dibuat:

- dashboard user publik;
- login pengunjung;
- komentar blog;
- newsletter;
- payment;
- CMS custom manual;
- fitur terlalu kompleks sebelum konten utama siap.

Alasan:

Website portofolio pribadi sebaiknya fokus pada kredibilitas, bukti kerja, dan kemudahan kontak. Struktur ini cukup ringan untuk tahap awal, tapi tetap siap dikembangkan jika nanti data dipindah ke database atau admin panel.
