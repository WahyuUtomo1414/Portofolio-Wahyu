# Integrasi Data ke Frontend Portofolio Wahyu

## 1. Tujuan Dokumen

Dokumen ini menjadi acuan integrasi data dari database dan admin Filament ke frontend publik Website Portofolio Wahyu.

Fokus utama dokumen:

- mengganti data statis frontend menjadi data dari database;
- menjaga query dan pengambilan data tetap berada di controller terkait;
- memastikan Blade menerima data yang sudah siap tampil;
- memastikan data yang dikelola dari Filament tampil konsisten di website publik;
- menjaga form kontak publik tersimpan ke tabel `contact`.

Dokumen ini mengacu pada:

- `docs/database.md`;
- `docs/arsitektur.md`;
- `docs/filament-resource.md`.

## 2. Kondisi Integrasi Saat Ini

Frontend publik saat ini sudah memiliki:

- `HomeController`;
- `ProjectController`;
- `BlogController`;
- `ContactController`;
- layout publik `resources/views/layouts/public.blade.php`;
- halaman `home`, `projects`, `blog`, dan `contact`;
- component layout, common, home, project, dan contact;
- presenter sementara `App\Support\PortfolioData`;
- form kontak publik yang menyimpan data ke model `Contact`.

Catatan:

- `PortfolioData` dipakai sebagai data sementara agar frontend bisa berjalan sebelum seluruh konten dibaca dari database.
- Setelah migration dijalankan dan data awal tersedia, controller publik boleh mulai mengambil data dari model Eloquent.
- Blog masih placeholder karena struktur database saat ini belum memiliki tabel blog/post.

## 3. Prinsip Integrasi

Aturan utama:

- Jangan query database dari Blade.
- Jangan memakai blok `@php` di Blade.
- Jangan memakai tag PHP mentah `<?php ... ?>` di Blade.
- Jangan memakai helper logic seperti `data_get()`, `Str::...`, `collect()`, atau mapping array di Blade.
- Blade hanya boleh dipakai untuk struktur tampilan dan directive sederhana seperti `@extends`, `@section`, `@if`, `@foreach`, `@csrf`, `@error`, dan echo `{{ $value }}`.
- Controller terkait wajib mengambil data untuk halamannya sendiri.
- Controller menyiapkan data dan menentukan view.
- Query kompleks tetap dipanggil dari controller terkait. Jika butuh dirapikan, gunakan private method di controller atau class query khusus yang tidak dipanggil dari Blade.
- Mapping data berulang boleh dipindah ke presenter, tetapi presenter hanya dipanggil dari controller dan tidak melakukan query tersembunyi.
- Blade page hanya menyusun section.
- Blade component hanya menerima data siap tampil.
- Semua data publik dari database wajib difilter `active = true`.
- Data soft deleted tidak tampil di publik.
- Gunakan eager loading untuk relasi yang tampil.
- Gunakan fallback jika data belum tersedia.

## 4. Alur Data

Alur integrasi frontend:

```text
Route
-> Controller Terkait
-> Model Query
-> Mapping Data Siap Tampil
-> Blade Page
-> Blade Component
-> HTML
```

Contoh:

```text
/projects
-> ProjectController@index
-> Project::query()->with(['category', 'client', 'tools', 'images'])
-> mapProjectCard()
-> resources/views/pages/projects/index.blade.php
-> resources/views/components/project/card.blade.php
```

## 5. Mapping Tabel ke Frontend

| Tabel | Model | Digunakan di FE | Catatan |
| --- | --- | --- | --- |
| `about` | `About` | home, contact, footer | ambil satu data aktif sebagai profil utama |
| `journey` | `Journey` | home section education/experience | filter berdasarkan `key`, urut `sort` |
| `category` | `Category` | project filter, project card | hanya kategori aktif |
| `client` | `Client` | client section, project detail | hanya client aktif |
| `tools` | `Tools` | skills, project tech stack | tools aktif |
| `project` | `Project` | home featured, project index, project detail | filter aktif, slug untuk detail |
| `project_tool` | `ProjectTool` | relasi project-tools | tidak tampil sebagai halaman sendiri |
| `project_image` | `ProjectImage` | gallery detail project | gambar aktif per project |
| `contact` | `Contact` | form kontak publik | data dibuat dari form, dibaca dari Filament |

## 6. Data Siap Tampil

Controller tidak harus mengirim model mentah ke Blade. Untuk section yang kompleks, controller sebaiknya mengirim array siap render.

Contoh bentuk data project card:

```php
[
    'name' => $project->name,
    'slug' => $project->slug,
    'category' => $project->category?->name,
    'client_name' => $project->client?->name,
    'client_logo' => $project->client?->logo_url,
    'thumbnail_url' => $project->thumbnail_url,
    'short_description' => str($project->body)->stripTags()->limit(160)->toString(),
    'tech_stack' => $project->tools->pluck('name')->all(),
    'demo_url' => $project->url,
    'detail_url' => route('projects.show', $project->slug),
    'is_featured' => $project->is_featured,
]
```

Catatan:

- `thumbnail_url`, `client_logo`, dan URL gambar lain sebaiknya dibuat dari accessor/helper.
- `detail_url` boleh disiapkan dari controller agar component tidak perlu membentuk URL.
- Untuk data yang sering dipakai lintas halaman, gunakan presenter seperti `PortfolioData` atau class baru, misalnya `PortfolioPresenter`.
- Presenter hanya melakukan mapping data yang sudah diberikan controller.
- Presenter tidak boleh mengambil data database sendiri.

## 6.1 Batasan Blade

Blade harus dianggap sebagai layer render saja.

Yang boleh di Blade:

- `@extends`;
- `@section`;
- `@if`;
- `@foreach`;
- `@csrf`;
- `@error`;
- `old()`;
- `route()` untuk link sederhana;
- echo data seperti `{{ $project['name'] }}`;
- component call seperti `<x-project.card :project="$project" />`.

Yang tidak boleh di Blade:

- `@php`;
- tag PHP mentah `<?php ... ?>`;
- query model seperti `Project::query()`;
- `data_get()`;
- `Str::startsWith()`;
- `collect()`;
- `array_map()`;
- `Storage::url()`;
- formatting tanggal;
- membuat URL gambar;
- mapping relasi;
- menentukan filter data publik.

Jika Blade butuh nilai seperti `thumbnail_url`, `formatted_date`, `detail_url`, `category_name`, `client_name`, atau `tech_stack`, nilai itu harus sudah disiapkan dari controller.

## 7. Integrasi Home

Controller:

- `App\Http\Controllers\HomeController@index`

Data yang dibutuhkan:

- profil dari `about`;
- skills dari `tools`;
- statistik statis atau turunan data project/client;
- journey education dari `journey.key = education`;
- journey experience dari `journey.key = experience`;
- client aktif dari `client`;
- project unggulan dari `project.is_featured = true`;
- form kontak.

Query rekomendasi:

```php
$about = About::query()
    ->where('active', true)
    ->latest()
    ->first();

$skills = Tools::query()
    ->where('active', true)
    ->latest()
    ->get();

$education = Journey::query()
    ->where('active', true)
    ->where('key', 'education')
    ->orderBy('sort')
    ->get();

$experience = Journey::query()
    ->where('active', true)
    ->whereIn('key', ['experience', 'organization'])
    ->orderBy('sort')
    ->get();

$clients = Client::query()
    ->where('active', true)
    ->latest()
    ->get();

$featuredProjects = Project::query()
    ->with(['category', 'client', 'tools'])
    ->where('active', true)
    ->where('is_featured', true)
    ->latest()
    ->limit(6)
    ->get();
```

Fallback:

- Jika `about` kosong, pakai fallback dari `PortfolioData::profile()`.
- Jika project kosong, tampilkan empty state.
- Jika tools kosong, section skills boleh disembunyikan atau tampil fallback statis.

Catatan controller:

- Semua query untuk home berada di `HomeController@index`.
- Mapping data home boleh dibuat sebagai private method di `HomeController`.
- Blade `pages/home.blade.php` hanya meneruskan data ke component.

## 8. Integrasi Project Index

Controller:

- `App\Http\Controllers\ProjectController@index`

Data:

- list project aktif;
- kategori aktif;
- filter kategori dari query string `category`;
- relasi `category`, `client`, dan `tools`.

Route:

```php
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
```

Query rekomendasi:

```php
$selectedCategory = $request->string('category')->toString();

$projects = Project::query()
    ->with(['category', 'client', 'tools'])
    ->where('active', true)
    ->when($selectedCategory !== '', function ($query) use ($selectedCategory) {
        $query->whereHas('category', function ($categoryQuery) use ($selectedCategory) {
            $categoryQuery->where('name', $selectedCategory);
        });
    })
    ->latest()
    ->paginate(9)
    ->withQueryString();
```

Catatan:

- Untuk filter yang lebih stabil, kategori sebaiknya memiliki `slug`.
- Jika belum ada `category.slug`, filter memakai `category.name` masih boleh untuk tahap awal.
- Semua query project list berada di `ProjectController@index`.
- Blade tidak boleh membaca request query string secara langsung untuk filtering.

## 9. Integrasi Detail Project

Controller:

- `App\Http\Controllers\ProjectController@show`

Route:

```php
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
```

Query rekomendasi:

```php
$project = Project::query()
    ->with(['category', 'client', 'tools', 'images' => function ($query) {
        $query->where('active', true)->latest();
    }])
    ->where('active', true)
    ->where('slug', $slug)
    ->firstOrFail();

$relatedProjects = Project::query()
    ->with(['category', 'client', 'tools'])
    ->where('active', true)
    ->whereKeyNot($project->getKey())
    ->where('category_id', $project->category_id)
    ->latest()
    ->limit(3)
    ->get();
```

Data siap tampil:

- nama project;
- kategori;
- client;
- deskripsi lengkap;
- tanggal mulai dan selesai;
- tools;
- URL demo;
- thumbnail;
- gallery dari `project_image`;
- related project.

Catatan controller:

- Semua query detail project berada di `ProjectController@show`.
- Related project disiapkan di controller.
- Blade detail project tidak boleh mencari project terkait sendiri.

## 10. Integrasi Contact

Controller:

- `App\Http\Controllers\ContactController@index`;
- `App\Http\Controllers\ContactController@store`.

Route:

```php
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
```

Form field publik:

- `name`;
- `email`;
- `subject`;
- `message`.

Validasi:

```php
$validated = $request->validate([
    'name' => ['required', 'string', 'max:128'],
    'email' => ['required', 'email', 'max:128'],
    'subject' => ['nullable', 'string', 'max:255'],
    'message' => ['required', 'string', 'max:2000'],
]);
```

Simpan data:

```php
Contact::create($validated);
```

Catatan:

- Model `Contact` memakai `AuditedBySoftDelete`, sehingga `created_by` otomatis memakai user login atau fallback user id `1`.
- Pastikan user id `1` tersedia saat form publik mulai dipakai.
- Setelah submit sukses, tampilkan flash message.
- Admin membaca pesan dari Filament resource `Pesan Kontak`.
- Field `read_at` dan `replied_at` diisi oleh admin dari Filament.
- Semua validasi dan create pesan berada di `ContactController@store`.

## 11. Integrasi Blog

Status saat ini:

- Route dan controller blog sudah tersedia sebagai placeholder.
- Database belum memiliki tabel blog/post.

Pilihan integrasi:

- tetap jadikan blog placeholder sampai tabel blog/post dibuat;
- gunakan markdown file sebagai sumber sementara;
- tambah tabel `post` atau `blog` nanti jika blog memang dibutuhkan.

Aturan:

- Jangan paksakan query blog ke tabel yang belum ada.
- Jika belum ada data, tampilkan empty state.
- Jika nanti memakai database, detail blog sebaiknya memakai slug.

## 12. Accessor URL Gambar

Field gambar yang perlu URL siap tampil:

| Model | Field | Output FE |
| --- | --- | --- |
| `About` | `image_profile` | `image_profile_url` |
| `Journey` | `logo` | `logo_url` |
| `Client` | `logo` | `logo_url` |
| `Tools` | `logo` | `logo_url` |
| `Project` | `thumbnail` | `thumbnail_url` |
| `ProjectImage` | `image` | `image_url` |

Contoh accessor:

```php
use Illuminate\Support\Facades\Storage;

public function getThumbnailUrlAttribute(): ?string
{
    if (blank($this->thumbnail)) {
        return null;
    }

    if (str_starts_with($this->thumbnail, 'http')) {
        return $this->thumbnail;
    }

    return Storage::disk('public')->url($this->thumbnail);
}
```

Catatan:

- Jangan hardcode `/storage/...` di banyak file Blade.
- Gunakan `php artisan storage:link` sebelum test gambar publik.
- Sediakan fallback gambar dari component `image-card`.

## 13. Presenter atau Mapper

Jika mapping mulai berulang, buat class khusus. Class ini hanya menerima model atau collection dari controller, lalu mengembalikan array siap tampil.

```text
app/
└── Support/
    └── Frontend/
        ├── AboutPresenter.php
        ├── JourneyPresenter.php
        └── ProjectPresenter.php
```

Contoh tugas presenter:

- mengubah model menjadi array siap tampil;
- membentuk URL gambar;
- membentuk route detail;
- format tanggal;
- mengambil nama relasi;
- mengubah collection tools menjadi array nama tools.
- tidak mengambil data dari database.

Contoh penggunaan:

```php
$projects = Project::query()
    ->with(['category', 'client', 'tools'])
    ->where('active', true)
    ->latest()
    ->get()
    ->map(fn (Project $project) => ProjectPresenter::card($project));
```

Catatan:

- Query tetap ditulis atau dipanggil dari controller terkait.
- Presenter tidak boleh dipanggil dari Blade.

## 14. Empty State dan Fallback

Fallback wajib disiapkan untuk:

- data `about` belum ada;
- list project kosong;
- gallery project kosong;
- list tools kosong;
- client logo kosong;
- gambar gagal dimuat;
- blog belum tersedia.

Aturan:

- Gunakan component `x-common.empty-state` untuk list kosong.
- Gunakan component `x-common.image-card` untuk fallback gambar.
- Jangan biarkan halaman error hanya karena data admin belum diisi.

## 15. Urutan Implementasi Integrasi

Urutan yang disarankan:

1. Jalankan migration saat sudah siap.
2. Seed user id `1` dan data awal `about`.
3. Isi data awal dari Filament: about, tools, category, client, project.
4. Buat accessor URL gambar pada model yang punya file upload.
5. Refactor `HomeController` agar membaca `about`, `tools`, `journey`, `client`, dan featured project dari database.
6. Refactor `ProjectController@index` agar membaca list project dari database.
7. Refactor `ProjectController@show` agar membaca detail project berdasarkan slug dari database.
8. Pastikan form `ContactController@store` menyimpan ke tabel `contact`.
9. Tambahkan test feature untuk route publik dan submit kontak.
10. Jalankan `php artisan test`.

## 16. Catatan Teknis

- Jangan menjalankan `migrate:fresh` pada database berisi data kerja tanpa backup.
- Jangan query model dari Blade.
- Jangan memakai `@php` di Blade.
- Jangan memakai `data_get()`, `Str`, `Storage`, atau helper mapping lain di Blade.
- Semua data `get`, query, filter, dan mapping utama dilakukan di controller terkait.
- Jangan tampilkan data soft deleted di publik.
- Jangan tampilkan data `active = false` di publik.
- Gunakan pagination pada halaman project jika data sudah banyak.
- Gunakan route name untuk semua link internal.
- Gunakan `withQueryString()` saat pagination memakai filter.
- Gunakan `old()` dan `@error` di form publik.
- Gunakan `target="_blank"` dan `rel="noopener"` untuk link eksternal.
- Setelah integration selesai, `PortfolioData` bisa dipertahankan sebagai fallback atau dihapus jika semua data sudah berasal dari database.
