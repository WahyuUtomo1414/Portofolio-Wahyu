# Database Web Portofolio Wahyu

## 1. Ringkasan

Dokumen ini merangkum konsep struktur database awal Website Portofolio Wahyu berdasarkan ERD portfolio, dengan penyesuaian teknis agar cocok untuk implementasi Laravel 13, migration, Eloquent model, upload gambar, dan kebutuhan frontend publik.

Database ini digunakan untuk menyimpan:

- informasi profil atau about;
- riwayat pendidikan, pekerjaan, organisasi, dan perjalanan karier;
- project portfolio;
- kategori project;
- client;
- tools atau teknologi yang digunakan, termasuk banyak tools untuk satu project;
- dokumentasi gambar project.

Catatan penting:

- Nama tabel domain mengikuti ERD dan tidak dipaksa plural.
- Tabel utama adalah `project`.
- `about` dan `journey` bersifat independen.
- Relasi project ke `category` dan `client` memakai foreign key.
- Relasi project ke `tools` memakai pivot table `project_tool`.
- Relasi `project` ke `project_image` adalah one-to-many.
- Model domain tidak perlu memakai `$fillable`; gunakan `protected $guarded = ['id'];`.
- Untuk website publik, data yang tampil sebaiknya difilter dari controller, bukan dari Blade.
- Semua tabel domain direkomendasikan memakai trait `BaseModelSoftDeleteDefault` dan memanggil `$this->base($table);`.

## 2. Daftar Tabel

Struktur ERD saat ini memiliki 8 tabel:

- `about`
- `journey`
- `category`
- `client`
- `tools`
- `project`
- `project_tool`
- `project_image`

## 3. Base Column

ERD utama hanya memuat kolom domain. Untuk implementasi Laravel, kolom standar direkomendasikan dibuat lewat trait migration `BaseModelSoftDeleteDefault`.

Kolom bawaan dari `$this->base($table);`:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| active | boolean | no | status data aktif, default `true` |
| created_by | bigint unsigned | no | id user pembuat data, default `1` |
| updated_by | bigint unsigned | yes | id user terakhir yang mengubah data |
| deleted_by | bigint unsigned | yes | id user yang menghapus data secara soft delete |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh pola migration:

```php
return new class extends Migration
{
    use BaseModelSoftDeleteDefault;

    public function up(): void
    {
        Schema::create('nama_table', function (Blueprint $table) {
            $table->id();
            // kolom utama tabel
            $this->base($table);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nama_table');
    }
};
```

Catatan:

- `active` dipakai untuk mengontrol data yang tampil di website publik.
- `created_by`, `updated_by`, dan `deleted_by` dipakai oleh trait `AuditedBySoftDelete`.
- `deleted_at` membuat data bisa dihapus sementara tanpa hilang permanen.
- Karena `$this->base($table);` sudah menambahkan kolom base, migration domain tidak perlu memanggil kolom tersebut manual.

Catatan detail tabel:

- Tabel di bawah menampilkan kolom domain dan beberapa kolom base yang paling sering dipakai frontend.
- Kolom audit `created_by`, `updated_by`, dan `deleted_by` tetap ikut dibuat lewat `$this->base($table);`.

## 4. Detail Tabel

### 4.1 about

Fungsi:
Menyimpan informasi utama pemilik portofolio.

Kolom berdasarkan ERD:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(255) | no | nama pemilik portofolio |
| email | varchar(128) | no | email utama |
| no_wa | varchar(18) | no | nomor WhatsApp |
| sosial_media | json | yes | daftar sosial media |
| description | text | no | deskripsi atau bio |
| image_profile | varchar(255) | yes | path atau URL foto profil |
| tagline | varchar(255) | yes | tagline portofolio |
| address | varchar(255) | yes | alamat atau lokasi |
| active | boolean | no | status data aktif |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('about', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email', 128);
    $table->string('no_wa', 18);
    $table->json('sosial_media')->nullable();
    $table->text('description');
    $table->string('image_profile')->nullable();
    $table->string('tagline')->nullable();
    $table->string('address')->nullable();
    $this->base($table);
});
```

Format `sosial_media`:

```php
[
    'github' => 'https://github.com/username',
    'linkedin' => 'https://linkedin.com/in/username',
    'instagram' => 'https://instagram.com/username',
    'website' => 'https://domain.com',
]
```

Catatan:

- Idealnya hanya ada satu data `about` yang aktif.
- Frontend mengambil data `about` aktif terbaru atau data pertama yang aktif.
- Key sosial media sebaiknya dibuat konsisten agar mudah ditampilkan di frontend.

### 4.2 journey

Fungsi:
Menyimpan riwayat perjalanan seperti pendidikan, pekerjaan, organisasi, atau pengalaman lain.

Kolom berdasarkan ERD:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| key | varchar(128) | no | identifier atau jenis journey |
| title | varchar(255) | no | judul journey |
| logo | varchar(255) | yes | logo institusi atau perusahaan |
| institute | varchar(255) | no | nama institusi atau perusahaan |
| description | varchar(255) | yes | deskripsi singkat journey |
| date_range | varchar(128) | no | periode journey |
| sort | integer unsigned | no | urutan tampil journey |
| active | boolean | no | status data aktif |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('journey', function (Blueprint $table) {
    $table->id();
    $table->string('key', 128);
    $table->string('title');
    $table->string('logo')->nullable();
    $table->string('institute');
    $table->string('description')->nullable();
    $table->string('date_range', 128);
    $table->unsignedInteger('sort')->default(0);
    $this->base($table);
});
```

Contoh data:

| key | title | institute | date_range |
| --- | --- | --- | --- |
| education | Sistem Informasi | Universitas BSI | 2021 - 2025 |
| experience | Fullstack Developer | Keysoft ERP | 2025 - Present |
| organization | Koordinator Kominfo | HIMSI UBSI | 2023 - 2025 |

Catatan:

- `key` digunakan untuk mengelompokkan journey.
- Nilai `key` yang disarankan: `education`, `experience`, `organization`, `certification`.
- `sort` digunakan untuk mengatur urutan tampil journey secara manual.

### 4.3 category

Fungsi:
Menyimpan kategori dari project portofolio.

Kolom berdasarkan ERD:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| name | varchar(128) | no | nama category |
| desc | text | yes | deskripsi category |
| type | varchar(16) | yes | tipe category |
| active | boolean | no | status data aktif |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('category', function (Blueprint $table) {
    $table->id();
    $table->string('name', 128);
    $table->text('desc')->nullable();
    $table->string('type', 16)->nullable();
    $this->base($table);
});
```

Contoh data:

- Web Development
- Mobile Development
- ERP
- Data Science
- UI/UX

Catatan:

- Jika category hanya untuk project, kolom `type` boleh dikosongkan atau dihapus.
- Jika nanti category dipakai untuk blog juga, `type` bisa diisi `project` atau `blog`.

### 4.4 client

Fungsi:
Menyimpan informasi client yang berkaitan dengan project.

Kolom berdasarkan ERD:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| logo | varchar(128) | yes | logo client |
| name | varchar(128) | no | nama client |
| desc | varchar(255) | yes | deskripsi client |
| active | boolean | no | status data aktif |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('client', function (Blueprint $table) {
    $table->id();
    $table->string('logo', 128)->nullable();
    $table->string('name', 128);
    $table->string('desc')->nullable();
    $this->base($table);
});
```

Catatan:

- Jika project pribadi tidak punya client, buat client seperti `Personal Project` atau izinkan `project.client_id` nullable.
- Untuk project freelance atau pekerjaan kantor, client membantu memberi konteks pada project.

### 4.5 tools

Fungsi:
Menyimpan teknologi atau tools yang digunakan pada project.

Kolom berdasarkan ERD:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| logo | varchar(128) | yes | logo tools atau technology |
| name | varchar(128) | no | nama tools |
| desc | text | yes | deskripsi tools |
| active | boolean | no | status data aktif |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('tools', function (Blueprint $table) {
    $table->id();
    $table->string('logo', 128)->nullable();
    $table->string('name', 128);
    $table->text('desc')->nullable();
    $this->base($table);
});
```

Contoh data:

- Laravel
- Flutter
- PHP
- JavaScript
- MySQL
- SQL Server
- PostgreSQL
- Docker

Catatan:

- Satu project bisa memakai banyak tools.
- Relasi tools ke project dibuat lewat pivot table `project_tool`.

### 4.6 project

Fungsi:
Menyimpan project yang ditampilkan pada portofolio.

Kolom berdasarkan ERD:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| thumbnail | varchar(128) | yes | thumbnail project |
| name | varchar(128) | no | nama project |
| slug | varchar(128) | no | slug unik untuk URL detail project |
| category_id | bigint unsigned | no | foreign key ke `category.id` |
| body | text | no | deskripsi lengkap project |
| client_id | bigint unsigned | no | foreign key ke `client.id` |
| start_project | date | yes | tanggal mulai project |
| end_project | date | yes | tanggal selesai project |
| url | varchar(255) | yes | URL project jika tersedia |
| is_featured | boolean | no | penanda project unggulan |
| active | boolean | no | status data aktif |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('project', function (Blueprint $table) {
    $table->id();
    $table->string('thumbnail', 128)->nullable();
    $table->string('name', 128);
    $table->string('slug', 128)->unique();
    $table->foreignId('category_id')->constrained('category');
    $table->text('body');
    $table->foreignId('client_id')->constrained('client');
    $table->date('start_project')->nullable();
    $table->date('end_project')->nullable();
    $table->string('url')->nullable();
    $table->boolean('is_featured')->default(false);
    $this->base($table);
});
```

Foreign key:

```text
project.category_id -> category.id
project.client_id   -> client.id
```

Catatan:

- `slug` dipakai untuk URL detail project yang rapi.
- `is_featured` dipakai untuk memilih project unggulan di Home.
- Jika client opsional, ubah `client_id` menjadi nullable.

### 4.7 project_tool

Fungsi:
Menyimpan relasi many-to-many antara project dan tools.

Kolom:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| project_id | bigint unsigned | no | foreign key ke `project.id` |
| tools_id | bigint unsigned | no | foreign key ke `tools.id` |
| active | boolean | no | status data aktif |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('project_tool', function (Blueprint $table) {
    $table->id();
    $table->foreignId('project_id')->constrained('project')->cascadeOnDelete();
    $table->foreignId('tools_id')->constrained('tools')->cascadeOnDelete();
    $this->base($table);
});
```

Foreign key:

```text
project_tool.project_id -> project.id
project_tool.tools_id   -> tools.id
```

Catatan:

- Tabel ini membuat satu project bisa memiliki banyak tools.
- Jika tidak memakai soft delete pada pivot, bisa tambahkan unique composite `project_id` dan `tools_id`.
- Jika tetap memakai soft delete pada pivot, unique composite perlu dirancang lebih hati-hati agar data restore tidak bentrok.

### 4.8 project_image

Fungsi:
Menyimpan beberapa gambar dokumentasi untuk setiap project.

Kolom berdasarkan ERD:

| Kolom | Tipe | Null | Keterangan |
| --- | --- | --- | --- |
| id | bigint unsigned | no | primary key |
| project_id | bigint unsigned | no | foreign key ke `project.id` |
| image | varchar(255) | no | path atau URL gambar |
| description | varchar(255) | yes | deskripsi gambar |
| active | boolean | no | status data aktif |
| created_at | timestamp | yes | bawaan Laravel |
| updated_at | timestamp | yes | bawaan Laravel |
| deleted_at | timestamp | yes | soft delete |

Contoh migration:

```php
Schema::create('project_image', function (Blueprint $table) {
    $table->id();
    $table->foreignId('project_id')->constrained('project')->cascadeOnDelete();
    $table->string('image');
    $table->string('description')->nullable();
    $this->base($table);
});
```

Foreign key:

```text
project_image.project_id -> project.id
```

Catatan:

- `cascadeOnDelete()` menghapus gambar saat project dihapus permanen.
- Jika memakai soft delete, data child tidak otomatis soft delete saat parent soft delete kecuali dibuat logic tambahan.

## 5. Relasi Antar Tabel

Relasi utama berdasarkan ERD:

- `project.category_id` -> `category.id`
- `project.client_id` -> `client.id`
- `project_tool.project_id` -> `project.id`
- `project_tool.tools_id` -> `tools.id`
- `project_image.project_id` -> `project.id`

Secara konsep:

```text
category (1) ----< (n) project
client   (1) ----< (n) project
project  (n) ----< project_tool >---- (n) tools
project  (1) ----< (n) project_image

about    standalone
journey  standalone
```

Relationship summary:

```text
category
   │
   │ 1:N
   ▼
project ◄──── 1:N ──── client
   │
   │
   ├──── N:N ──── tools
   │
   │ 1:N
   ▼
project_image

about       standalone
journey     standalone
```

## 6. Rekomendasi Migration Order

Urutan migration yang direkomendasikan:

1. `create_about_table`
2. `create_journey_table`
3. `create_category_table`
4. `create_client_table`
5. `create_tools_table`
6. `create_project_table`
7. `create_project_tool_table`
8. `create_project_image_table`

Alasan:

- `project` membutuhkan `category` dan `client`.
- `project_tool` membutuhkan `project` dan `tools`.
- `project_image` membutuhkan `project`.
- `about` dan `journey` tidak bergantung ke tabel lain.

## 7. Rekomendasi Index dan Constraint

### 7.1 Unique

- `category.name` jika nama kategori tidak boleh duplikat.
- `client.name` jika nama client tidak boleh duplikat.
- `tools.name` jika nama tools tidak boleh duplikat.
- `project.slug`.

### 7.2 Index

- `about.active`
- `journey.key`
- `journey.sort`
- `journey.active`
- `category.active`
- `client.active`
- `tools.active`
- `project.category_id`
- `project.client_id`
- `project.slug`
- `project.is_featured`
- `project.active`
- `project.start_project`
- `project.end_project`
- `project_tool.project_id`
- `project_tool.tools_id`
- `project_image.project_id`
- `project_image.active`

Contoh tambahan index:

```php
$table->index('active');
$table->index('key');
$table->index('sort');
$table->index(['category_id', 'active']);
$table->index(['client_id', 'active']);
$table->index(['is_featured', 'active']);
$table->index(['project_id', 'active']);
$table->index(['tools_id', 'active']);
```

## 8. Contoh Model Eloquent

Setiap model domain memakai `AuditedBySoftDelete`, `HasFactory`, dan `SoftDeletes`. Model tidak perlu `$fillable`; gunakan `protected $guarded = ['id'];`.

Template dasar model:

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NamaModel extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'nama_table';

    protected $guarded = ['id'];
}
```

### 8.1 About

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'about';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'sosial_media' => 'array',
            'active' => 'boolean',
        ];
    }
}
```

### 8.2 Journey

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journey extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'journey';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'sort' => 'integer',
            'active' => 'boolean',
        ];
    }
}
```

### 8.3 Category

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'category';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id');
    }
}
```

### 8.4 Client

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'client';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }
}
```

### 8.5 Tools

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tools extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'tools';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_tool', 'tools_id', 'project_id')
            ->withPivot(['active', 'deleted_at'])
            ->wherePivot('active', true)
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }
}
```

### 8.6 Project

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'project';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'start_project' => 'date',
            'end_project' => 'date',
            'is_featured' => 'boolean',
            'active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function tools(): BelongsToMany
    {
        return $this->belongsToMany(Tools::class, 'project_tool', 'project_id', 'tools_id')
            ->withPivot(['active', 'deleted_at'])
            ->wherePivot('active', true)
            ->wherePivotNull('deleted_at')
            ->withTimestamps();
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }
}
```

### 8.7 ProjectTool

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectTool extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'project_tool';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function tools(): BelongsTo
    {
        return $this->belongsTo(Tools::class, 'tools_id');
    }
}
```

### 8.8 ProjectImage

```php
namespace App\Models;

use App\Traits\AuditedBySoftDelete;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectImage extends Model
{
    use AuditedBySoftDelete, HasFactory, SoftDeletes;

    protected $table = 'project_image';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
```

## 9. Query Publik Yang Direkomendasikan

Contoh query Home:

```php
$about = About::query()
    ->where('active', true)
    ->latest()
    ->first();

$journeys = Journey::query()
    ->where('active', true)
    ->orderBy('sort')
    ->latest()
    ->get()
    ->groupBy('key');

$featuredProjects = Project::query()
    ->with(['category', 'client', 'tools'])
    ->where('active', true)
    ->where('is_featured', true)
    ->latest()
    ->take(6)
    ->get();
```

Contoh query detail project:

```php
$project = Project::query()
    ->with(['category', 'client', 'tools', 'images'])
    ->where('active', true)
    ->where('slug', $slug)
    ->firstOrFail();
```

Catatan:

- Query dilakukan di controller atau service, bukan di Blade.
- Gunakan eager loading untuk menghindari N+1 query.
- Data gambar sebaiknya dikirim ke view sebagai URL siap tampil.

## 10. Standar Gambar dan File

Mapping file yang disarankan:

| Tabel | Field | Disk | Directory |
| --- | --- | --- | --- |
| `about` | `image_profile` | `public` | `about` |
| `journey` | `logo` | `public` | `journey` |
| `category` | opsional | `public` | `category` |
| `client` | `logo` | `public` | `client` |
| `tools` | `logo` | `public` | `tools` |
| `project` | `thumbnail` | `public` | `project/thumbnail` |
| `project_image` | `image` | `public` | `project/image` |

Aturan:

- Simpan path relatif ke database, bukan URL penuh jika file berasal dari storage lokal.
- Jalankan `php artisan storage:link` sebelum mengetes gambar publik.
- Di frontend, jangan hardcode `/storage/...` di banyak Blade.
- Buat URL gambar dari controller, accessor, presenter, atau helper.
- Sediakan placeholder jika gambar kosong.

## 11. Catatan Teknis Penting

- `about` idealnya hanya punya satu data aktif.
- `journey.key` sebaiknya memakai nilai konsisten seperti `education`, `experience`, `organization`, dan `certification`.
- `journey.sort` dipakai untuk urutan tampil manual.
- `project` adalah tabel utama dan wajib eager load `category`, `client`, `tools`, dan `images` saat tampil di detail.
- `project.slug` wajib dipakai untuk URL detail project yang rapi.
- `project.is_featured` dipakai untuk menandai project unggulan di halaman Home.
- `project_tool` dipakai agar satu project bisa memiliki banyak tools.
- Gunakan `nullable()` untuk field gambar agar data awal bisa dibuat tanpa upload.
- Hindari menjalankan `migrate:fresh` atau `db:wipe` pada database lokal yang berisi data kerja tanpa backup.
- Jangan query database langsung dari Blade.
- Semua data publik sebaiknya difilter `active = true`.
