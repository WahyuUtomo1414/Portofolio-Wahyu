# Requirement Filament Resource Web Portofolio Wahyu

## 1. Tujuan

Dokumen ini menjadi acuan pembuatan resource admin menggunakan Filament untuk Website Portofolio Wahyu.

Scope tahap ini:

- Generate resource memakai command artisan.
- Fokus pada resource, form, table, infolist, dan relation manager yang dibutuhkan.
- Resource disesuaikan dengan struktur database pada `docs/database.md`.
- Resource memakai model domain dengan `SoftDeletes`, `AuditedBySoftDelete`, dan `protected $guarded = ['id'];`.
- Semua label UI wajib memakai bahasa Indonesia.
- Admin panel dipakai untuk mengelola konten portofolio, bukan untuk membuat dashboard publik manual.

Catatan:

- Filament menjadi panel admin utama untuk mengelola about, journey, kategori, client, tools, project, relasi tools project, gambar project, dan pesan kontak.
- Tabel `admin` tidak dibuat. Jika butuh akun panel, gunakan model `User` bawaan Laravel.
- Kolom audit `created_by`, `updated_by`, dan `deleted_by` berasal dari trait `BaseModelSoftDeleteDefault`.
- Audit user otomatis diisi oleh trait `AuditedBySoftDelete`.
- Role dan permission bisa ditambahkan nanti memakai Spatie Permission atau Filament Shield jika kebutuhan admin sudah lebih kompleks.

## 2. Model Resource

Model yang dibuatkan resource:

- `About`
- `Journey`
- `Category`
- `Client`
- `Tools`
- `Project`
- `ProjectImage`
- `Contact`

Model yang tidak perlu menjadi resource sidebar mandiri:

- `ProjectTool`

Catatan:

- `ProjectTool` adalah pivot table untuk relasi many-to-many antara `Project` dan `Tools`.
- Tools project sebaiknya dikelola dari form `ProjectResource` memakai multi select relationship atau relation manager.
- `ProjectImage` boleh dibuat resource mandiri, tetapi rekomendasi utama adalah dikelola lewat relation manager `Gambar Project` pada `ProjectResource`.
- Semua resource domain mengikuti pola soft delete dan audit user.
- Model domain wajib menulis `protected $table` eksplisit karena nama tabel mengikuti ERD dan tidak dipaksa plural.

## 3. Dependency

Package utama:

```bash
composer require filament/filament
```

Package opsional untuk role dan permission:

```bash
composer require spatie/laravel-permission
```

Setelah dependency Filament terpasang:

- Buat panel admin Filament.
- Buat user admin awal.
- Generate resource sesuai model domain.
- Jangan menambah kolom `level`, `role`, atau `permission` manual pada tabel `users`.

Jika memakai Spatie Permission:

- Publish migration dan config Spatie Permission sesuai dokumentasi package.
- Tambahkan trait `HasRoles` pada model `User`.
- Kelola role dan permission lewat package, bukan lewat kolom manual.

## 4. Command Generate Resource

Command resource mengikuti preferensi:

- Pakai `php artisan make:filament-resource`.
- Pakai `--generate`.
- Pakai `--soft-deletes` untuk resource domain yang memakai soft delete.

Daftar command:

```bash
php artisan make:filament-resource About --generate --soft-deletes
php artisan make:filament-resource Journey --generate --soft-deletes
php artisan make:filament-resource Category --generate --soft-deletes
php artisan make:filament-resource Client --generate --soft-deletes
php artisan make:filament-resource Tools --generate --soft-deletes
php artisan make:filament-resource Project --generate --soft-deletes
php artisan make:filament-resource ProjectImage --generate --soft-deletes
php artisan make:filament-resource Contact --generate --soft-deletes
```

Catatan:

- `ProjectToolResource` tidak dibuat sebagai menu sidebar.
- Jika suatu saat perlu audit relasi tools project secara detail, `ProjectTool` boleh dibuat resource internal, tetapi tidak perlu tampil di navigasi utama.
- Resource domain memakai `--soft-deletes` karena tabel domain memakai `$this->base($table);`.

## 5. Standar Struktur Resource

Resource dirapikan dengan pola modular Filament 5:

```php
<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\EditProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Filament\Resources\Projects\Pages\ViewProject;
use App\Filament\Resources\Projects\Schemas\ProjectForm;
use App\Filament\Resources\Projects\Schemas\ProjectInfolist;
use App\Filament\Resources\Projects\Tables\ProjectsTable;
use App\Models\Project;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';

    protected static string|UnitEnum|null $navigationGroup = 'Portofolio';

    protected static ?string $navigationLabel = 'Project';

    protected static ?string $modelLabel = 'Project';

    protected static ?string $pluralModelLabel = 'Project';

    public static function form(Schema $schema): Schema
    {
        return ProjectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProjectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
```

## 6. Properti Resource

Semua resource wajib memiliki properti:

```php
protected static ?string $model = ModelName::class;

protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

protected static string|UnitEnum|null $navigationGroup = 'Nama Group';

protected static ?string $navigationLabel = 'Label';

protected static ?string $modelLabel = 'Label';

protected static ?string $pluralModelLabel = 'Label';
```

Ketentuan:

- Label wajib bahasa Indonesia.
- Nama model tetap PascalCase.
- Nama tabel tetap mengikuti `docs/database.md`, misalnya `about`, `journey`, `project`, dan `project_image`.

## 7. Standar Page

Page default untuk resource domain:

- `List`
- `Create`
- `View`
- `Edit`

Pengecualian:

- `AboutResource` dianggap single record. Menu `About` sebaiknya langsung mengarah ke record aktif pertama, dengan fallback create jika belum ada data.
- `ProjectImageResource` boleh tidak tampil di sidebar jika gambar project dikelola lewat relation manager pada `ProjectResource`.
- `ProjectTool` tidak dibuat sebagai resource sidebar.
- Halaman detail memakai `Infolist`.
- Form resource wajib memakai `Filament\Schemas\Components\Section`.
- Setiap section memakai `columnSpanFull()` agar input dikelompokkan per konteks.
- Infolist resource wajib memiliki minimal section `Informasi Utama` dan `Audit Data`.
- Section `Audit Data` berisi `createdBy`, `created_at`, `updatedBy`, `updated_at`, `deletedBy`, dan `deleted_at`.

## 8. Navigation Group

| Resource | Group |
| --- | --- |
| `About` | `Profil` |
| `Journey` | `Profil` |
| `Category` | `Master Data` |
| `Client` | `Master Data` |
| `Tools` | `Master Data` |
| `Project` | `Portofolio` |
| `ProjectImage` | `Portofolio` |
| `Contact` | `Konten` |

## 9. Label dan Icon Resource

| Model | Navigation Label | Model Label | Plural Model Label | Navigation Group | Icon |
| --- | --- | --- | --- | --- | --- |
| `About` | `Profil Utama` | `Profil Utama` | `Profil Utama` | `Profil` | `heroicon-o-identification` |
| `Journey` | `Perjalanan` | `Perjalanan` | `Perjalanan` | `Profil` | `heroicon-o-map` |
| `Category` | `Kategori Project` | `Kategori Project` | `Kategori Project` | `Master Data` | `heroicon-o-tag` |
| `Client` | `Client` | `Client` | `Client` | `Master Data` | `heroicon-o-building-office-2` |
| `Tools` | `Tools` | `Tools` | `Tools` | `Master Data` | `heroicon-o-wrench-screwdriver` |
| `Project` | `Project` | `Project` | `Project` | `Portofolio` | `heroicon-o-briefcase` |
| `ProjectImage` | `Gambar Project` | `Gambar Project` | `Gambar Project` | `Portofolio` | `heroicon-o-photo` |
| `Contact` | `Pesan Kontak` | `Pesan Kontak` | `Pesan Kontak` | `Konten` | `heroicon-o-envelope` |

## 10. Standar Implementasi

Setelah command resource dijalankan:

- Rapikan resource class agar sesuai pola modular Filament.
- Sesuaikan `navigationGroup`, `navigationIcon`, `navigationLabel`, `modelLabel`, dan `pluralModelLabel`.
- Rapikan form schema.
- Rapikan table schema.
- Tambahkan infolist untuk halaman detail.
- Tambahkan kolom audit `createdBy`, `updatedBy`, dan `deletedBy` pada semua table resource domain.
- Aktifkan query tanpa `SoftDeletingScope` untuk resource domain.
- Pertahankan dukungan soft delete pada table action dan filter.
- Pastikan form tidak menginput manual `created_by`, `updated_by`, dan `deleted_by`.
- Field upload menyimpan path file sesuai rancangan database.

Catatan:

- Audit user otomatis diisi oleh trait `AuditedBySoftDelete`.
- Kolom `active` boleh tampil di form sebagai toggle.
- Kolom `deleted_by` hanya relevan untuk data yang sudah soft delete.
- Field `slug` project dibuat otomatis dari `name`, tetapi tetap bisa diedit manual.
- Field `sort` hanya ada pada `JourneyResource`.

## 11. Kolom Audit Table

Semua table resource domain wajib menambahkan kolom:

```php
TextColumn::make('createdBy.name')
    ->label('Dibuat Oleh')
    ->badge()
    ->description(fn ($record) => $record->created_at?->format('d M Y H:i'))
    ->sortable(),

TextColumn::make('updatedBy.name')
    ->label('Diubah Oleh')
    ->badge()
    ->description(fn ($record) => $record->updated_at?->format('d M Y H:i'))
    ->sortable()
    ->toggleable(isToggledHiddenByDefault: true),

TextColumn::make('deletedBy.name')
    ->label('Dihapus Oleh')
    ->badge()
    ->description(fn ($record) => $record->deleted_at?->format('d M Y H:i'))
    ->sortable()
    ->toggleable(isToggledHiddenByDefault: true),
```

Ketentuan:

- `Dibuat Oleh` tampil default di table.
- `Diubah Oleh` dan `Dihapus Oleh` dibuat toggleable agar table tetap ringkas.
- Relasi audit berasal dari trait `AuditedBySoftDelete`.

## 12. Action dan Filter Table

Action resource domain:

- `ViewAction`
- `EditAction`
- `DeleteAction`
- `RestoreAction`
- `ForceDeleteAction`

Bulk action resource domain:

- `DeleteBulkAction`
- `RestoreBulkAction`
- `ForceDeleteBulkAction`

Filter:

- Filter `active`.
- Filter soft delete atau trashed.
- Filter `key` untuk `Journey`.
- Filter `type` untuk `Category`.
- Filter `category_id` untuk `Project`.
- Filter `client_id` untuk `Project`.
- Filter `tools` untuk `Project` jika memakai filter relationship many-to-many.
- Filter `is_featured` untuk `Project`.
- Filter tanggal untuk `Project.start_project` dan `Project.end_project`.
- Filter `read_at` dan `replied_at` untuk `Contact`.

Catatan:

- `ForceDeleteAction` boleh disembunyikan dari role non-super-admin jika role sudah diterapkan.
- Tombol `ViewAction` pada table list boleh dihilangkan untuk resource ringkas seperti `Category`, `Client`, `Tools`, dan `Journey`.
- `Project` tetap memakai `ViewAction` karena detail project lebih kompleks.

## 13. Standar Upload File

Field upload wajib memakai `FileUpload`.

Contoh konfigurasi:

```php
FileUpload::make('thumbnail')
    ->label('Thumbnail')
    ->image()
    ->disk('public')
    ->directory('project/thumbnail')
    ->visibility('public')
    ->preserveFilenames()
    ->maxSize(2048);
```

Ketentuan:

- Gunakan `disk('public')` untuk semua upload gambar dan dokumen.
- Gunakan `directory()` sesuai nama tabel atau konteks resource.
- Database hanya menyimpan path file, bukan binary file.
- Jalankan `php artisan storage:link` agar file di disk public bisa diakses dari browser.

Mapping directory upload:

| Resource | Field | Disk | Directory |
| --- | --- | --- | --- |
| `AboutResource` | `image_profile` | `public` | `about` |
| `JourneyResource` | `logo` | `public` | `journey` |
| `ClientResource` | `logo` | `public` | `client` |
| `ToolsResource` | `logo` | `public` | `tools` |
| `ProjectResource` | `thumbnail` | `public` | `project/thumbnail` |
| `ProjectResource` relation manager `Gambar Project` | `image` | `public` | `project/image` |
| `ProjectImageResource` | `image` | `public` | `project/image` |

## 14. Form Per Resource

### 14.1 About

Field:

- `name`
- `email`
- `no_wa`
- `sosial_media`
- `description`
- `image_profile`
- `tagline`
- `address`
- `active`

Catatan:

- `sosial_media` memakai field fixed per platform dengan state path JSON seperti `sosial_media.github`, `sosial_media.linkedin`, `sosial_media.instagram`, dan `sosial_media.website`.
- `description` memakai textarea atau rich editor.
- `image_profile` memakai `FileUpload`.
- `active` memakai toggle.
- Idealnya hanya satu record `about` yang aktif.

### 14.2 Journey

Field:

- `key`
- `title`
- `logo`
- `institute`
- `description`
- `date_range`
- `sort`
- `active`

Catatan:

- `key` memakai select dengan opsi `education`, `experience`, `organization`, dan `certification`.
- `logo` memakai `FileUpload`.
- `description` memakai textarea.
- `sort` tampil sebagai numeric input karena hanya `journey` yang butuh urutan manual.
- Table memakai `defaultSort('sort')` dan boleh memakai `reorderable('sort')`.

### 14.3 Category

Field:

- `name`
- `desc`
- `type`
- `active`

Catatan:

- `name` wajib unik.
- `desc` memakai textarea.
- `type` boleh memakai select, misalnya `project` dan `blog` jika nanti kategori dipakai lintas konten.
- Untuk tahap awal, `type` boleh default `project`.

### 14.4 Client

Field:

- `logo`
- `name`
- `desc`
- `active`

Catatan:

- `logo` memakai `FileUpload`.
- `name` wajib unik.
- `desc` memakai textarea singkat.
- Jika project pribadi tidak punya client, buat record `Personal Project`.

### 14.5 Tools

Field:

- `logo`
- `name`
- `desc`
- `active`

Catatan:

- `logo` memakai `FileUpload`.
- `name` wajib unik.
- `desc` memakai textarea.
- Tools dipilih dari `ProjectResource` melalui relationship many-to-many.

### 14.6 Project

Field:

- `thumbnail`
- `name`
- `slug`
- `category_id`
- `body`
- `client_id`
- `start_project`
- `end_project`
- `tools`
- `url`
- `is_featured`
- `active`

Catatan:

- `thumbnail` memakai `FileUpload`.
- `slug` wajib unik dan dapat dibuat otomatis dari `name`.
- `category_id` memakai select relasi ke `Category`.
- `client_id` memakai select relasi ke `Client`.
- `tools` memakai multi select relasi many-to-many ke `Tools`.
- `body` memakai rich editor atau textarea besar.
- `start_project` dan `end_project` memakai date picker.
- `url` opsional.
- `is_featured` dan `active` memakai toggle.
- Jangan tampilkan field `project_tool` manual pada form utama.

### 14.7 ProjectImage

Field:

- `project_id`
- `image`
- `description`
- `active`

Catatan:

- `project_id` memakai select relasi ke `Project`.
- `image` memakai `FileUpload`.
- `description` memakai text input atau textarea pendek.
- Jika dikelola lewat relation manager `ProjectResource`, `project_id` tidak perlu tampil karena otomatis mengikuti parent project.

### 14.8 Contact

Field:

- `name`
- `email`
- `subject`
- `message`
- `read_at`
- `replied_at`
- `active`

Catatan:

- Data utama dibuat dari form kontak publik.
- `subject` opsional.
- `message` memakai textarea.
- `read_at` dan `replied_at` boleh diisi dari action table `Tandai Dibaca` dan `Tandai Dibalas`.
- Admin boleh create manual dari Filament jika perlu mencatat pesan offline.

## 15. Table Per Resource

### 15.1 About

Kolom:

- `name`
- `email`
- `no_wa`
- `active`
- `createdBy`
- `updatedBy`

### 15.2 Journey

Kolom:

- `sort`
- `key`
- `title`
- `institute`
- `date_range`
- `active`
- `createdBy`
- `updatedBy`

Catatan:

- Table memakai `defaultSort('sort')`.
- Jika ingin drag reorder, gunakan `reorderable('sort')`.

### 15.3 Category

Kolom:

- `name`
- `type`
- `active`
- `createdBy`
- `updatedBy`

### 15.4 Client

Kolom:

- `logo`
- `name`
- `desc`
- `active`
- `createdBy`
- `updatedBy`

### 15.5 Tools

Kolom:

- `logo`
- `name`
- `active`
- `createdBy`
- `updatedBy`

### 15.6 Project

Kolom:

- `thumbnail`
- `name`
- `slug`
- `category.name`
- `client.name`
- `is_featured`
- `active`
- `createdBy`
- `updatedBy`

### 15.7 ProjectImage

Kolom:

- `project.name`
- `image`
- `description`
- `active`
- `createdBy`
- `updatedBy`

### 15.8 Contact

Kolom:

- `name`
- `email`
- `subject`
- `message`
- `active`
- `read_at`
- `replied_at`
- `createdBy`
- `updatedBy`

## 16. Infolist Per Resource

### 16.1 About

Tampilkan:

- nama
- email
- nomor WhatsApp
- sosial media
- deskripsi
- foto profil
- tagline
- alamat
- status aktif
- audit data

### 16.2 Journey

Tampilkan:

- jenis journey
- judul
- logo
- institusi
- deskripsi
- periode
- urutan
- status aktif
- audit data

### 16.3 Category

Tampilkan:

- nama kategori
- deskripsi
- tipe
- status aktif
- audit data

### 16.4 Client

Tampilkan:

- logo
- nama client
- deskripsi
- status aktif
- audit data

### 16.5 Tools

Tampilkan:

- logo
- nama tools
- deskripsi
- status aktif
- audit data

### 16.6 Project

Tampilkan:

- thumbnail
- nama project
- slug
- kategori
- client
- deskripsi lengkap
- tanggal mulai
- tanggal selesai
- tools
- URL project
- status featured
- status aktif
- gambar project
- audit data

### 16.7 ProjectImage

Tampilkan:

- project
- gambar
- deskripsi
- status aktif
- audit data

### 16.8 Contact

Tampilkan:

- nama lengkap
- email
- subjek
- pesan
- status aktif
- tanggal dibaca
- tanggal dibalas
- audit data

## 17. Relation Manager

Relation manager yang disarankan:

- `ProjectResource` memiliki relation manager `ImagesRelationManager` untuk mengelola `ProjectImage`.
- `ProjectResource` mengelola relasi `Tools` lewat multi select atau relation manager `ToolsRelationManager`.
- `CategoryResource` dapat memiliki relation manager untuk `Project`.
- `ClientResource` dapat memiliki relation manager untuk `Project`.
- `ToolsResource` dapat memiliki relation manager untuk `Project`.

Catatan:

- Relation manager `Project -> Gambar Project` menjadi pengganti utama resource sidebar `ProjectImage`.
- Relation manager `Project -> Tools` tidak menginput manual `created_by`, `updated_by`, atau `deleted_by`.
- Jika pivot `project_tool` memakai base column, pastikan attach tools mengisi `active` dan audit dengan nilai default yang valid.

## 17.1 Resource About Single Record

Ketentuan khusus `AboutResource`:

- Data about dianggap single record.
- Menu `Profil Utama` tidak perlu menampilkan list panjang.
- Route index `/admin/about` boleh langsung redirect ke halaman view record about aktif pertama.
- Jika record about belum ada, route index boleh redirect ke halaman create sebagai fallback.
- Halaman view/infolist menjadi halaman utama untuk membaca data profil.
- Halaman edit tetap tersedia untuk mengubah data profil.
- Seeder `AboutSeeder` sebaiknya menyiapkan satu record awal agar halaman about langsung bisa dibuka.

## 18. Catatan Khusus Repo

- Database mengikuti `docs/database.md`.
- Nama tabel domain tidak memakai akhiran `s`.
- Model domain wajib menulis `protected $table` eksplisit.
- Model domain memakai `protected $guarded = ['id'];`, bukan `$fillable`.
- Semua model domain memakai `AuditedBySoftDelete`, `HasFactory`, dan `SoftDeletes`.
- Semua tabel domain memakai soft delete dari `$this->base($table);`.
- Semua resource domain harus mengaktifkan query tanpa `SoftDeletingScope` agar data trashed bisa dikelola dari Filament.
- Kolom `active` digunakan untuk status tampil atau tidak tampil pada halaman publik.
- Field upload wajib memakai `FileUpload`, disk `public`, dan `directory()` sesuai mapping.
- `project.slug` dipakai untuk route detail project publik.
- `project.is_featured` dipakai untuk menampilkan project unggulan di Home.
- `journey.sort` adalah satu-satunya sort manual yang dibutuhkan pada ERD saat ini.
- `project_tool` adalah pivot untuk banyak tools per project.

## 19. Catatan Aman Testing dan Database

- Jangan menjalankan `migrate:fresh`, `migrate:fresh --seed`, atau `db:wipe` pada database lokal yang berisi data kerja tanpa backup.
- Jika ingin testing resource, gunakan database testing terpisah.
- Pastikan storage link sudah dibuat sebelum mengetes upload gambar.
- Pastikan user id `1` tersedia karena trait audit memiliki fallback ke user id `1`.
- Pastikan akun admin dibuat sebelum panel dipakai.

## 20. Urutan Pengerjaan

Urutan implementasi resource:

1. Pastikan migration dan model sesuai `docs/database.md`.
2. Install atau siapkan Filament panel admin.
3. Generate resource master data: `Category`, `Client`, dan `Tools`.
4. Generate resource profil: `About` dan `Journey`.
5. Generate resource portofolio: `Project` dan `ProjectImage`.
6. Rapikan form, table, infolist, dan label bahasa Indonesia.
7. Tambahkan relation manager `Project -> Gambar Project`.
8. Sambungkan `Project -> Tools` sebagai multi select relationship.
9. Tambahkan policy atau permission gate jika role admin sudah dibutuhkan.

Alasan:

- Master data dibuat lebih dulu karena dipakai oleh project.
- Profil bisa berjalan mandiri.
- Project dikerjakan setelah kategori, client, dan tools tersedia.
- Relation manager dikerjakan setelah resource utama stabil.
