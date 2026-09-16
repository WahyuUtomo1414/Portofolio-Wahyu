
-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 31 Agu 2026 pada 12.41
-- Versi server: 11.8.8-MariaDB-log
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u301495856_portofolio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about`
--

CREATE TABLE `about` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_wa` varchar(18) NOT NULL,
  `sosial_media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`sosial_media`)),
  `description` text NOT NULL,
  `image_profile` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `about`
--

INSERT INTO `about` (`id`, `name`, `email`, `no_wa`, `sosial_media`, `description`, `image_profile`, `tagline`, `address`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Wahyu Dwi Utomo', 'wahyuxd14@gmail.com', '6285891514812', '{\"github\":\"https:\\/\\/github.com\\/WahyuUtomo1414\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/in\\/wahyutomo\\/\",\"instagram\":\"https:\\/\\/www.instagram.com\\/waahyutomo\\/\",\"website\":null,\"cv\":\"https:\\/\\/drive.google.com\\/file\\/d\\/1WsLeHHHNiw7ELZn19iaV9_yVBFQYCFzO\\/view?usp=sharing\"}', 'Software engineer yang fokus membangun produk digital yang rapi, scalable, mudah dirawat, dan nyaman digunakan.', 'about/492D13A2-C441-41D6-AC99-96F37C949C2D_1_105_c.jpeg', 'Membangun produk digital yang scalable.', 'Jakarta, Indonesia', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 13:28:58', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `desc` text DEFAULT NULL,
  `type` varchar(16) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`, `desc`, `type`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Web Development', 'Project website, dashboard, CMS, dan aplikasi bisnis berbasis web.', 'project', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(2, 'Enterprise App', 'Project sistem internal, ERP, dan aplikasi operasional perusahaan.', 'project', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(3, 'Mobile App', 'Project aplikasi mobile dan integrasi API backend.', 'project', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `client`
--

CREATE TABLE `client` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `client`
--

INSERT INTO `client` (`id`, `logo`, `name`, `desc`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'client/keynsoft.png', 'Keysoft ERP', 'Penyedia solusi ERP untuk kebutuhan operasional, inventory, accounting, dan proses bisnis perusahaan.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:00:27', NULL),
(2, 'client/pesona-trip.png', 'Pesona Trip Travel Indonesia', 'Perusahaan travel dan perjalanan wisata yang membutuhkan sistem digital untuk promosi, paket trip, dan operasional booking.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:00:41', NULL),
(3, 'client/dinas pertamanan.jpg', 'Dinas Pertamanan Dan Pemakanan DKI Jakarta', 'Instansi pemerintahan daerah yang mengelola layanan pertamanan, pemakaman, data aset, dan kebutuhan informasi publik.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:03:10', NULL),
(4, 'client/himsi.png', 'Himpunan Mahasiswa Sistem Informasi', 'Organisasi mahasiswa sistem informasi yang mengelola kegiatan, publikasi, struktur kepengurusan, dan informasi organisasi.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:08:12', NULL),
(5, 'client/sma harapan jaya.jpeg', 'SMA Harapan Jaya', 'Institusi pendidikan sekolah menengah atas dengan kebutuhan sistem informasi sekolah dan publikasi digital.', 1, 1, 1, 1, '2026-08-28 16:20:33', '2026-08-29 12:16:15', '2026-08-29 12:16:15'),
(6, 'client/logo.png', 'PT. Charlyn Jaya', 'Perusahaan swasta dengan kebutuhan digitalisasi proses bisnis, administrasi internal, dan pengelolaan data operasional.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:08:46', NULL),
(7, 'client/Logo_Gereja_Protestan_Maluku.jpg', 'Gereja Protestan Maluku', 'Lembaga keagamaan yang membutuhkan media informasi digital untuk jemaat, kegiatan, pelayanan, dan publikasi internal.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:03:45', NULL),
(8, 'client/Arthur Teknik.webp', 'PT. Arthur Teknik Indoprima', 'Perusahaan teknik dan konstruksi dengan kebutuhan sistem administrasi project, dokumentasi pekerjaan, dan operasional lapangan.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:03:59', NULL),
(9, 'client/smk patriot nusantara.jpeg', 'SMK Partriot Nusantara', 'Institusi pendidikan kejuruan dengan kebutuhan sistem informasi sekolah, profil digital, dan pengelolaan data akademik.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:04:13', NULL),
(10, NULL, 'PT. Intikarya Baja Lestari', 'Perusahaan industri baja dengan kebutuhan sistem operasional, inventory, administrasi produksi, dan pelaporan bisnis.', 0, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:11:26', NULL),
(11, 'client/roda nurmala.jpeg', 'Roda Nurmala', 'Brand atau bisnis lokal dengan kebutuhan website profil, katalog informasi, dan dukungan digital untuk aktivitas bisnis.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:04:29', NULL),
(12, 'client/hepiso.jpeg', 'Hepiso', 'Brand digital dengan kebutuhan pengembangan aplikasi, website, dan sistem pendukung operasional produk.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:12:01', NULL),
(13, 'client/logo.jpg', 'DLDK Kabupaten Lamandau', 'Brand digital dengan kebutuhan pengembangan aplikasi, website, dan sistem pendukung operasional produk.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:05:48', NULL),
(14, 'https://picsum.photos/seed/client-personal/320/320', 'Dinas Pertamanan Dan Pemakaman DKI Jakarta', 'Instansi pemerintahan daerah yang mengelola layanan pertamanan, pemakaman, data aset, dan kebutuhan informasi publik.', 1, 1, NULL, 1, '2026-08-29 08:56:54', '2026-08-29 12:04:43', '2026-08-29 12:04:43'),
(15, 'https://picsum.photos/seed/client-personal/320/320', 'SMK Patriot Nusantara', 'Institusi pendidikan kejuruan dengan kebutuhan sistem informasi sekolah, profil digital, dan pengelolaan data akademik.', 1, 1, NULL, 1, '2026-08-29 08:56:54', '2026-08-29 12:04:43', '2026-08-29 12:04:43'),
(16, 'client/arita.png', 'PT Arita Prima Indonesia', NULL, 1, 1, NULL, NULL, '2026-08-29 12:10:33', '2026-08-29 12:10:33', NULL),
(17, 'client/aming_coffee_logo.jpeg', 'Aming Coffe Indonesia', NULL, 1, 1, NULL, NULL, '2026-08-29 12:11:01', '2026-08-29 12:11:01', NULL),
(18, 'client/pesona-trip.png', 'PT Pesona Trip Travel Indonesia', NULL, 0, 1, 1, NULL, '2026-08-29 12:14:31', '2026-08-29 12:17:02', NULL),
(19, 'client/griya maju sentosa.jpeg', 'PT Griya Maju Sentosa', NULL, 1, 1, NULL, NULL, '2026-08-29 12:14:49', '2026-08-29 12:14:49', NULL),
(20, 'client/images.jpeg', 'SMA Harapan Jaya Cengkareng', NULL, 1, 1, NULL, NULL, '2026-08-29 12:16:37', '2026-08-29 12:16:37', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `replied_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `read_at`, `replied_at`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Raka Pratama', 'raka@example.com', 'Diskusi website company profile', 'Halo, saya ingin berdiskusi tentang kebutuhan website company profile untuk bisnis saya.', NULL, NULL, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(2, 'Nadia Putri', 'nadia@example.com', 'Pembuatan dashboard admin', 'Saya butuh dashboard admin untuk mengelola data internal dan laporan bulanan.', NULL, NULL, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(3, 'Fajar Nugroho', 'fajar@example.com', 'Integrasi API backend', 'Apakah bisa bantu integrasi API backend dengan aplikasi mobile yang sudah ada?', NULL, NULL, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `journey`
--

CREATE TABLE `journey` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(128) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `institute` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_range` varchar(128) NOT NULL,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `journey`
--

INSERT INTO `journey` (`id`, `key`, `title`, `logo`, `institute`, `description`, `date_range`, `sort`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'education', 'Sistem Informasi (S.Kom)', 'journey/bsi.png', 'Universitas Bina Sarana Informatika', 'Lulus dengan IPK 3.6. Fokus pada software engineering, database architecture, dan pengembangan sistem enterprise.', '2021 - 2025', 1, 1, 1, 1, NULL, '2026-08-29 09:54:47', '2026-08-29 11:44:39', NULL),
(2, 'education', 'MSIB Batch 6', 'journey/Logo Startup Campus 1 salinan.png', 'Startup Campus', 'Program Magang & Studi Independen Bersertifikat Kemendikbudristek bidang pengembangan perangkat lunak.', 'Feb 2024 - Juni 2024', 2, 1, 1, 1, NULL, '2026-08-29 09:54:47', '2026-08-29 11:46:02', NULL),
(3, 'education', 'Teknik Komputer & Jaringan', 'images/journey/smk.png', 'SMA / SMK Negeri', 'Mempelajari dasar-dasar algoritma pemrograman, jaringan komputer, server Linux, & troubleshooting hardware.', '2018 - 2021', 3, 1, 1, NULL, 1, '2026-08-29 09:54:47', '2026-08-29 11:46:29', '2026-08-29 11:46:29'),
(4, 'experience', 'Fullstack Software Engineer', 'journey/keynsoft.png', 'PT Keysoft ERP Indonesia', 'Mengembangkan modul ERP Production & Manufacturing, inventory/warehouse, dan WMS berbasis Flutter, termasuk optimasi query SQL Server dan integrasi REST API.', '2025 - Sekarang', 1, 1, 1, 1, NULL, '2026-08-29 09:54:47', '2026-08-29 11:53:21', NULL),
(5, 'experience', 'Junior Backend Developer', 'journey/pesona-trip.png', 'PT Pesona Trip Travel Indonesia', 'Mengintegrasikan database relasional untuk modul pemesanan dan membangun dashboard admin dengan Laravel & Filament, meningkatkan akurasi data transaksi hingga 99%.', 'Sept 2024 - Jan 2025', 3, 1, 1, 1, NULL, '2026-08-29 09:54:47', '2026-08-29 11:58:35', NULL),
(6, 'experience', 'Fullstack Web Developer', NULL, 'PT Jasanya Teknologi Indonesia', 'Membangun website bisnis untuk klien (agency, absensi karyawan, e-learning) menggunakan Laravel, Filament, dan Tailwind CSS.', '2023 - Present', 4, 1, 1, 1, NULL, '2026-08-29 09:54:47', '2026-08-29 11:58:48', NULL),
(7, 'experience', 'Koordinator Komite Kominfo', 'images/journey/himsi.png', 'HIMSI UBSI', 'Mengelola publikasi digital, dokumentasi kegiatan, dan pengembangan website organisasi.', '2023 - 2025', 4, 1, 1, NULL, 1, '2026-08-29 09:54:47', '2026-08-29 11:48:53', '2026-08-29 11:48:53'),
(8, 'experience', 'Backend & System Analyst', 'journey/griya maju sentosa.jpeg', 'PT Griya Maju Sentosa', 'Merancang arsitektur backend Warehouse & HR Management dari nol menggunakan Laravel, menerapkan CQRS dan RESTful API untuk maintainability sistem.', 'Januari 2025 - Juli 2025', 2, 1, 1, 1, NULL, '2026-08-29 11:50:09', '2026-08-29 11:56:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_27_205100_create_about_table', 1),
(5, '2026_08_27_205101_create_journey_table', 1),
(6, '2026_08_27_205102_create_category_table', 1),
(7, '2026_08_27_205103_create_client_table', 1),
(8, '2026_08_27_205104_create_tools_table', 1),
(9, '2026_08_27_205105_create_project_table', 1),
(10, '2026_08_27_205106_create_project_tool_table', 1),
(11, '2026_08_27_205107_create_project_image_table', 1),
(12, '2026_08_27_205108_create_contact_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `start_project` date DEFAULT NULL,
  `end_project` date DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id`, `thumbnail`, `name`, `slug`, `category_id`, `body`, `client_id`, `start_project`, `end_project`, `url`, `is_featured`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'https://picsum.photos/seed/project-erp/1200/720', 'Keysoft ERP Enterprise System', 'keysoft-erp-enterprise-system', 2, 'Sistem ERP enterprise untuk mengelola modul inventory, purchase, sales, finance, reporting, dan hak akses user internal. Dirancang untuk mendukung operasional multi-departemen dengan audit trail dan optimasi performa query.', 1, '2025-01-10', NULL, NULL, 1, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 08:56:54', NULL),
(2, 'https://picsum.photos/seed/project-portfolio/1200/720', 'Personal Portfolio CMS', 'personal-portfolio-cms', 1, 'Website portofolio pribadi dengan CMS internal untuk mengelola profil, journey, project, client, tools, dan pesan kontak. Dibangun dengan struktur database domain-driven dan admin panel yang scalable.', 12, '2026-08-01', NULL, NULL, 1, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 08:56:54', NULL),
(3, 'https://picsum.photos/seed/project-mobile/1200/720', 'Mobile Field Reporting App', 'mobile-field-reporting-app', 3, 'Aplikasi mobile untuk laporan aktivitas lapangan, upload dokumentasi, sinkronisasi data, dan dashboard monitoring berbasis API.', 8, '2024-09-15', '2025-02-20', NULL, 0, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 08:56:54', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `project_image`
--

CREATE TABLE `project_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `project_image`
--

INSERT INTO `project_image` (`id`, `project_id`, `image`, `description`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'https://picsum.photos/seed/project-erp-dashboard/1400/900', 'Dashboard ringkasan modul ERP.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(2, 1, 'https://picsum.photos/seed/project-erp-report/1400/900', 'Tampilan laporan operasional.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(3, 2, 'https://picsum.photos/seed/project-portfolio-home/1400/900', 'Halaman utama portofolio.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(4, 2, 'https://picsum.photos/seed/project-portfolio-admin/1400/900', 'Panel admin konten portofolio.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(5, 3, 'https://picsum.photos/seed/project-mobile-form/1400/900', 'Form laporan aktivitas lapangan.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(6, 3, 'https://picsum.photos/seed/project-mobile-dashboard/1400/900', 'Dashboard monitoring laporan.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `project_tool`
--

CREATE TABLE `project_tool` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `tools_id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `project_tool`
--

INSERT INTO `project_tool` (`id`, `project_id`, `tools_id`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(2, 1, 6, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(3, 1, 3, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(4, 1, 4, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(5, 2, 2, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(6, 2, 1, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(7, 2, 3, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(8, 3, 5, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(9, 3, 1, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL),
(10, 3, 6, 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tools`
--

CREATE TABLE `tools` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `desc` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tools`
--

INSERT INTO `tools` (`id`, `logo`, `name`, `desc`, `active`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg', 'Laravel', 'PHP framework untuk backend dan aplikasi web.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(2, 'tools/filament.png', 'Filament', 'Admin panel berbasis Laravel.', 1, 1, 1, NULL, '2026-08-28 16:20:33', '2026-08-29 12:18:49', NULL),
(3, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg', 'Tailwind CSS', 'Utility-first CSS framework.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(4, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg', 'Vue.js', 'Frontend framework untuk interface interaktif.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(5, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg', 'Flutter', 'Framework mobile cross-platform.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(6, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg', 'PostgreSQL', 'Relational database untuk aplikasi production.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(7, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/microsoftsqlserver/microsoftsqlserver-original.svg', 'SQL Server', 'Relational database untuk sistem enterprise dan reporting operasional.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(8, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg', 'MySQL', 'Relational database untuk aplikasi web dan sistem bisnis.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(9, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/go/go-original.svg', 'Golang', 'Bahasa pemrograman untuk service backend, API, dan sistem performa tinggi.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL),
(10, 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/firebase/firebase-original.svg', 'Firebase', 'Platform backend-as-a-service untuk autentikasi, database realtime, dan push notification.', 1, 1, NULL, NULL, '2026-08-28 16:20:33', '2026-08-28 16:20:33', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Wahyu Dwi Utomo', 'wahyuxd14@gmail.com', NULL, '$2y$12$3RqC8zwCm0Sviga3WuqRh.x.qLP8Dc2QEkS2ZJYFzSOv5HNAbac2C', NULL, '2026-08-28 16:20:33', '2026-08-29 09:54:47');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`),
  ADD KEY `about_active_index` (`active`),
  ADD KEY `about_created_by_index` (`created_by`),
  ADD KEY `about_updated_by_index` (`updated_by`),
  ADD KEY `about_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name_unique` (`name`),
  ADD KEY `category_active_index` (`active`),
  ADD KEY `category_created_by_index` (`created_by`),
  ADD KEY `category_updated_by_index` (`updated_by`),
  ADD KEY `category_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_name_unique` (`name`),
  ADD KEY `client_active_index` (`active`),
  ADD KEY `client_created_by_index` (`created_by`),
  ADD KEY `client_updated_by_index` (`updated_by`),
  ADD KEY `client_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_email_index` (`email`),
  ADD KEY `contact_read_at_index` (`read_at`),
  ADD KEY `contact_replied_at_index` (`replied_at`),
  ADD KEY `contact_active_index` (`active`),
  ADD KEY `contact_created_by_index` (`created_by`),
  ADD KEY `contact_updated_by_index` (`updated_by`),
  ADD KEY `contact_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `journey`
--
ALTER TABLE `journey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journey_key_index` (`key`),
  ADD KEY `journey_sort_index` (`sort`),
  ADD KEY `journey_active_index` (`active`),
  ADD KEY `journey_created_by_index` (`created_by`),
  ADD KEY `journey_updated_by_index` (`updated_by`),
  ADD KEY `journey_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_slug_unique` (`slug`),
  ADD KEY `project_category_id_active_index` (`category_id`,`active`),
  ADD KEY `project_client_id_active_index` (`client_id`,`active`),
  ADD KEY `project_is_featured_active_index` (`is_featured`,`active`),
  ADD KEY `project_active_index` (`active`),
  ADD KEY `project_start_project_index` (`start_project`),
  ADD KEY `project_end_project_index` (`end_project`),
  ADD KEY `project_created_by_index` (`created_by`),
  ADD KEY `project_updated_by_index` (`updated_by`),
  ADD KEY `project_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `project_image`
--
ALTER TABLE `project_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_image_project_id_active_index` (`project_id`,`active`),
  ADD KEY `project_image_active_index` (`active`),
  ADD KEY `project_image_created_by_index` (`created_by`),
  ADD KEY `project_image_updated_by_index` (`updated_by`),
  ADD KEY `project_image_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `project_tool`
--
ALTER TABLE `project_tool`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_tool_project_id_active_index` (`project_id`,`active`),
  ADD KEY `project_tool_tools_id_active_index` (`tools_id`,`active`),
  ADD KEY `project_tool_created_by_index` (`created_by`),
  ADD KEY `project_tool_updated_by_index` (`updated_by`),
  ADD KEY `project_tool_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tools_name_unique` (`name`),
  ADD KEY `tools_active_index` (`active`),
  ADD KEY `tools_created_by_index` (`created_by`),
  ADD KEY `tools_updated_by_index` (`updated_by`),
  ADD KEY `tools_deleted_by_index` (`deleted_by`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about`
--
ALTER TABLE `about`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `client`
--
ALTER TABLE `client`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `journey`
--
ALTER TABLE `journey`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `project_image`
--
ALTER TABLE `project_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `project_tool`
--
ALTER TABLE `project_tool`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tools`
--
ALTER TABLE `tools`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `project_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Ketidakleluasaan untuk tabel `project_image`
--
ALTER TABLE `project_image`
  ADD CONSTRAINT `project_image_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `project_tool`
--
ALTER TABLE `project_tool`
  ADD CONSTRAINT `project_tool_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_tool_tools_id_foreign` FOREIGN KEY (`tools_id`) REFERENCES `tools` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
