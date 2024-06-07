-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Agu 2023 pada 21.17
-- Versi server: 10.6.14-MariaDB-cll-lve
-- Versi PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `n1579121_e-budgeting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) NOT NULL,
  `nrp` varchar(255) NOT NULL,
  `telpon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `slug`, `pangkat`, `nrp`, `telpon`, `email`, `created_at`, `updated_at`, `role_id`) VALUES
(2, 'admin', '$2y$10$u7IFTQgsKC3eEdDzABo12e9ZvWIntT0WUxi1AQ9MTvqGroZ.MulHu', 'Admin', NULL, 'bribda', '00001', '08123233322', 'admin@gmail.com', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dipa`
--

CREATE TABLE `dipa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dipa` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `anggaran` bigint(20) NOT NULL,
  `penambahan_dana` bigint(20) DEFAULT NULL,
  `pengurangan_dana` bigint(20) DEFAULT NULL,
  `anggaran_baru` bigint(20) DEFAULT NULL,
  `total_digunakan` bigint(20) DEFAULT NULL,
  `sisa_anggaran` bigint(20) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'tidak_ajukan',
  `respon` varchar(255) DEFAULT NULL,
  `revisi` varchar(255) DEFAULT NULL,
  `spn` varchar(200) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dipa`
--

INSERT INTO `dipa` (`id`, `jenis_dipa`, `slug`, `anggaran`, `penambahan_dana`, `pengurangan_dana`, `anggaran_baru`, `total_digunakan`, `sisa_anggaran`, `status`, `respon`, `revisi`, `spn`, `catatan`, `tanggal`, `bulan`, `tahun`, `created_at`, `updated_at`) VALUES
(2, 'DIPA TAHUN 2023', 'dipa-tahun-2023', 40418632000, NULL, NULL, 40418632000, 1763926336, 0, 'disetujui', 'disetujui', NULL, 'Ka SPN', NULL, 1, 'Januari', 2023, '2023-07-27 01:47:59', '2023-07-27 02:02:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dipa_anggaran`
--

CREATE TABLE `dipa_anggaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dipa` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `anggaran` bigint(20) NOT NULL,
  `penambahan_dana` bigint(20) DEFAULT NULL,
  `pengurangan_dana` bigint(20) DEFAULT NULL,
  `total_digunakan` bigint(20) DEFAULT NULL,
  `sisa_anggaran` bigint(20) DEFAULT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(200) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dipa_anggaran`
--

INSERT INTO `dipa_anggaran` (`id`, `jenis_dipa`, `slug`, `anggaran`, `penambahan_dana`, `pengurangan_dana`, `total_digunakan`, `sisa_anggaran`, `dipa_id`, `tanggal`, `bulan`, `tahun`, `created_at`, `updated_at`) VALUES
(4, 'DIPA TAHUN 2023', 'dipa-tahun-2023', 40418632000, NULL, NULL, 1763926336, 0, 2, 1, 'Januari', 2023, '2023-07-27 01:47:59', '2023-07-27 02:02:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dipa_kegiatan`
--

CREATE TABLE `dipa_kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dipa_kegiatan`
--

INSERT INTO `dipa_kegiatan` (`id`, `kode`, `kegiatan`, `slug`, `created_at`, `updated_at`) VALUES
(1, '3096.EBA.962', 'Layanan Umum', 'layanan-umum', '2023-05-15 07:25:57', '2023-07-27 15:39:08'),
(2, '3096.EBA.994', 'Layanan Perkantoran', 'layanan-perkantoran', '2023-05-15 07:26:45', '2023-05-15 07:26:45'),
(3, '3100.DBE.006', 'Pendidikan Pembentukan Bintara Polri', 'pendidikan-pembentukan-bintara-polri', '2023-05-15 07:27:50', '2023-05-15 07:27:50'),
(4, '3100.DBE.009', 'Pendidikan Pengembangan Spesialis', 'pendidikan-pengembangan-spesialis', '2023-05-15 07:28:46', '2023-05-15 07:28:46'),
(5, '3100.EBC.011', 'Pelatihan', 'pelatihan', '2023-05-15 07:29:38', '2023-05-15 07:29:38'),
(6, '3100.SCG.004', 'Pelatihan Penanganan Konflik Secara Humanis FT BRIMOB (PN)', 'pelatihan-penanganan-konflik-secara-humanis-ft-brimob-pn', '2023-05-15 07:31:18', '2023-05-15 07:31:18'),
(7, '3100.SCG.005', 'Pelatihan Penanganan Konflik Secara Humanis FT BINMAS (PN)', 'pelatihan-penanganan-konflik-secara-humanis-ft-binmas-pn', '2023-05-15 07:32:14', '2023-05-15 07:32:14'),
(8, '3100.SCG.006', 'Pelatihan Penanganan Konflik Secara Humanis FT SABHARA (PN)', 'pelatihan-penanganan-konflik-secara-humanis-ft-sabhara-pn', '2023-05-15 07:33:01', '2023-05-15 07:33:01'),
(9, '5059.EBA.994', 'Layanan Perkantoran', 'layanan-perkantoran-2', '2023-05-27 07:41:50', '2023-05-27 07:41:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dipa_revisi`
--

CREATE TABLE `dipa_revisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `anggaran_awal` bigint(20) NOT NULL,
  `anggaran_baru` bigint(20) NOT NULL,
  `total_terpakai` bigint(20) NOT NULL,
  `sisa_anggaran` bigint(20) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategory_kegiatan`
--

CREATE TABLE `kategory_kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategory_kegiatan`
--

INSERT INTO `kategory_kegiatan` (`id`, `dipa_id`, `kegiatan_id`, `created_at`, `updated_at`) VALUES
(10, 2, 1, NULL, NULL),
(11, 2, 2, NULL, NULL),
(12, 2, 3, NULL, NULL),
(13, 2, 4, NULL, NULL),
(14, 2, 5, NULL, NULL),
(15, 2, 6, NULL, NULL),
(16, 2, 7, NULL, NULL),
(17, 2, 8, NULL, NULL),
(18, 2, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategory_program`
--

CREATE TABLE `kategory_program` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategory_program`
--

INSERT INTO `kategory_program` (`id`, `dipa_id`, `program_id`, `created_at`, `updated_at`) VALUES
(3, 2, 1, NULL, NULL),
(4, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebutuhan_anggaran`
--

CREATE TABLE `kebutuhan_anggaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staf_id` bigint(20) UNSIGNED NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dipa` varchar(255) NOT NULL,
  `program_kode` varchar(255) NOT NULL,
  `dipa_kode` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `uraiaan` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `volume` int(11) NOT NULL,
  `harga_satuan` bigint(20) NOT NULL,
  `list` varchar(255) NOT NULL,
  `pagu` bigint(20) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'tidak_ajukan',
  `respon` text DEFAULT NULL,
  `revisi` text DEFAULT NULL,
  `spn` varchar(255) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `notifikasi` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kebutuhan_anggaran`
--

INSERT INTO `kebutuhan_anggaran` (`id`, `staf_id`, `dipa_id`, `jenis_dipa`, `program_kode`, `dipa_kode`, `kode`, `uraiaan`, `slug`, `volume`, `harga_satuan`, `list`, `pagu`, `tanggal`, `bulan`, `tahun`, `status`, `respon`, `revisi`, `spn`, `catatan`, `notifikasi`, `created_at`, `updated_at`) VALUES
(4, 7, 2, 'DIPA TAHUN 2023', '060.01.BD-Program Profesionalisme SDM Polri', '3096.EBA.994-Layanan Perkantoran', '001.AA.1', 'Pembayaran Gaji dan Tunjangan', 'pembayaran-gaji-dan-tunjangan', 1, 1167442000, 'OB', 1167442000, 3, 'Januari', 2023, 'disetujui', 'disetujui', NULL, 'Ka SPN', NULL, NULL, '2023-07-27 15:42:09', '2023-07-31 03:06:32'),
(5, 7, 2, 'DIPA TAHUN 2023', '060.01.BD-Program Profesionalisme SDM Polri', '3096.EBA.962-Layanan Umum', '003.AB..A.1', 'Rapat-Rapat Penyusunan Dokumen Perencanaan  (Dokumen TOR/RAB Pagu Indikatif T.A 2024)', 'rapat-rapat-penyusunan-dokumen-perencanaan-dokumen-tor-rab-pagu-indikatif-t-a-2024', 1, 2038334, 'OG', 2038334, 23, 'Januari', 2023, 'disetujui', 'disetujui', NULL, 'Ka SPN', NULL, NULL, '2023-07-27 15:44:46', '2023-07-31 03:06:32'),
(6, 1, 2, 'DIPA TAHUN 2023', '060.01.BD-Program Profesionalisme SDM Polri', '3096.EBA.962-Layanan Umum', '003.DA.1', 'Kegiatan Sosialisasi Kurikulum', 'kegiatan-sosialisasi-kurikulum', 1, 3225000, 'GIAT', 3225000, 2, 'Februari', 2023, 'disetujui', 'disetujui', NULL, 'Ka SPN', NULL, 'disetujui', '2023-07-27 16:24:22', '2023-07-27 16:34:29'),
(7, 1, 2, 'DIPA TAHUN 2023', '060.01.BD-Program Profesionalisme SDM Polri', '3100.EBC.011-Pelatihan', '003.DC.1', 'Belanja Barang Operasional Lainnya', 'belanja-barang-operasional-lainnya', 825, 70000, 'OG', 57750000, 3, 'Februari', 2023, 'disetujui', 'disetujui', NULL, 'Ka SPN', NULL, 'disetujui', '2023-07-27 16:29:46', '2023-07-27 16:34:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepala_spn`
--

CREATE TABLE `kepala_spn` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) NOT NULL,
  `nrp` varchar(255) NOT NULL,
  `telpon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kepala_spn`
--

INSERT INTO `kepala_spn` (`id`, `username`, `password`, `nama`, `slug`, `pangkat`, `nrp`, `telpon`, `email`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'kaspn', '$2y$10$yfrL0TgAZALdzf8NmBZHcu21Owc45dhOUInMvw8x.Syyq.Nu218h2', 'Ka SPN', 'ka-spn', 'Kombespol', '69020273', '082129661991', 'jokpit91@gmail.com', '2023-05-10 08:47:06', '2023-07-15 21:38:31', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_keuangan`
--

CREATE TABLE `laporan_keuangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staf_id` bigint(20) UNSIGNED NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `staf` varchar(255) DEFAULT NULL,
  `program_kegiatan` varchar(255) NOT NULL,
  `jenis_dipa` varchar(255) DEFAULT NULL,
  `dipa_kegiatan` varchar(255) NOT NULL,
  `kegiatan_kode` varchar(255) NOT NULL,
  `uraian_kegiatan` varchar(255) NOT NULL,
  `volume` varchar(255) NOT NULL,
  `list` varchar(100) NOT NULL,
  `harga_satuan` varchar(255) NOT NULL,
  `pagu` varchar(255) NOT NULL,
  `realisasi` varchar(255) NOT NULL,
  `sisa_anggaran` varchar(255) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan_keuangan`
--

INSERT INTO `laporan_keuangan` (`id`, `staf_id`, `dipa_id`, `staf`, `program_kegiatan`, `jenis_dipa`, `dipa_kegiatan`, `kegiatan_kode`, `uraian_kegiatan`, `volume`, `list`, `harga_satuan`, `pagu`, `realisasi`, `sisa_anggaran`, `tanggal`, `bulan`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 'Urmin', '060.01.BD-Program Profesionalisme SDM Polri', 'DIPA TAHUN 2023', '3096.EBA.962-Layanan Umum', '003.AB..A.1', 'Rapat-Rapat Penyusunan Dokumen Perencanaan  (Dokumen TOR/RAB Pagu Indikatif T.A 2024)', '1', 'OG', '2038334', '2038334', '2038334', '0', 23, 'Januari', 2023, '2023-07-27 16:03:31', '2023-07-27 16:03:31'),
(2, 7, 2, 'Urmin', '060.01.BD-Program Profesionalisme SDM Polri', 'DIPA TAHUN 2023', '3096.EBA.994-Layanan Perkantoran', '001.AA.1', 'Pembayaran Gaji dan Tunjangan', '1', 'OB', '1167442000', '1167442000', '1167442000', '0', 3, 'Januari', 2023, '2023-07-27 16:04:28', '2023-07-27 16:04:28'),
(3, 1, 2, 'Jarlat', '060.01.BD-Program Profesionalisme SDM Polri', 'DIPA TAHUN 2023', '3096.EBA.962-Layanan Umum', '003.DA.1', 'Kegiatan Sosialisasi Kurikulum', '1', 'GIAT', '3225000', '3225000', '3225000', '0', 2, 'Februari', 2023, '2023-07-27 16:39:21', '2023-07-27 16:39:21'),
(4, 1, 2, 'Jarlat', '060.01.BD-Program Profesionalisme SDM Polri', 'DIPA TAHUN 2023', '3100.EBC.011-Pelatihan', '003.DC.1', 'Belanja Barang Operasional Lainnya', '825', 'OG', '70000', '57750000', '57750000', '0', 3, 'Februari', 2023, '2023-07-27 16:39:58', '2023-07-27 16:39:58');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_23_211708_create_admin_table', 1),
(6, '2023_04_23_211743_create_renmi_table', 1),
(7, '2023_04_23_211810_create_staf_table', 1),
(8, '2023_04_23_211831_create_kepala_spn_table', 1),
(9, '2023_04_25_150753_create_roles_table', 1),
(10, '2023_04_25_152657_add_role_id_column_to_admin_table', 1),
(11, '2023_04_25_155426_add_role_id_column_to_renmi_table', 1),
(12, '2023_04_25_155450_add_role_id_column_to_staf_table', 1),
(13, '2023_04_25_155516_add_role_id_column_to_kepala_spn_table', 1),
(14, '2023_04_28_150108_create_kebutuhan_anggaran_table', 1),
(15, '2023_04_29_195655_add_status_column_to_kebutuhan_anggaran_table', 1),
(16, '2023_05_01_124402_add_catatan_column_to_kebutuhan_anggaran_table', 1),
(17, '2023_05_02_193940_add_bidang_colomn_to_staf_table', 1),
(18, '2023_05_02_194217_add_staf_colomn_to_kebutuhan_anggaran_table', 1),
(19, '2023_05_03_203706_create_dipa_kegiatan_table', 1),
(20, '2023_05_03_205833_create_dipa_anggaran_table', 1),
(21, '2023_05_05_120505_add_slug_colomn_to_dipa_kegiatan_table', 1),
(22, '2023_05_05_121244_add_slug_colomn_to_dipa_anggaran_table', 1),
(23, '2023_05_05_210907_create_dipa_table', 1),
(24, '2023_05_05_215748_create_kategory_kegiatan_table', 1),
(26, '2023_05_09_210038_add_catatan_colomn_to_dipa_table', 1),
(30, '2023_05_11_140828_add_spn_id_column_to_dipa_table', 2),
(31, '2023_05_12_160759_add_revisi_column_to_dipa_table', 3),
(32, '2023_05_13_215525_add_kebutuhan_anggaran_column_to_kebutuhan_anggaran_table', 4),
(33, '2023_05_15_185142_add_spn_column_to_kebutuhan_anggaran_table', 5),
(34, '2023_05_17_073222_create_laporan_anggaran_table', 6),
(35, '2023_05_17_182131_add_dipa_id_column_to_kebutuhan_anggaran_table', 7),
(36, '2023_05_17_183357_add_dipa_id_column_to_laporan_anggaran_table', 8),
(38, '2023_05_22_191604_create_program_kegiatan_table', 9),
(42, '2023_05_22_210329_create_kategory_program_table', 10),
(43, '2023_05_23_235732_add_program_kegiatan_column_to_kebutuhan_anggaran_table', 10),
(44, '2023_05_26_213450_create_staf_anggaran_table', 11),
(45, '2023_05_26_220413_add_staf_id_column_to_staf_anggaran_table', 12),
(46, '2023_05_27_101322_add_dipa_id_column_to_staf_anggaran_table', 13),
(47, '2023_05_27_164708_add_staf_id_column_to_laporan_anggaran_table', 14),
(48, '2023_05_27_213845_create_laporan_keuangan_table', 15),
(49, '2023_06_11_184407_create_dipa_revisi_table', 16),
(58, '2023_06_15_205848_create_revisi_dana_table', 17),
(59, '2023_06_15_210933_create_revisi_dana_staf_table', 17);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_kegiatan`
--

CREATE TABLE `program_kegiatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `program_kegiatan` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_kegiatan`
--

INSERT INTO `program_kegiatan` (`id`, `kode`, `program_kegiatan`, `slug`, `created_at`, `updated_at`) VALUES
(1, '060.01.BD', 'Program Profesionalisme SDM Polri', 'program-profesionalisme-sdm-polri', '2023-05-27 07:43:32', '2023-05-27 07:43:32'),
(2, '060.01.BP', 'Program Modernisasi Almarsus dan Sarana Prasarana Polri', 'program-modernisasi-almarsus-dan-sarana-prasarana-polri', '2023-05-27 07:44:45', '2023-05-27 07:44:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `realisasi_anggaran`
--

CREATE TABLE `realisasi_anggaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staf_id` bigint(20) UNSIGNED NOT NULL,
  `staf` varchar(255) NOT NULL,
  `bidang` varchar(255) DEFAULT NULL,
  `program_kegiatan` varchar(255) NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dipa` varchar(255) NOT NULL,
  `dipa_kegiatan` varchar(255) NOT NULL,
  `kode_kegiatan` varchar(255) NOT NULL,
  `uraian_kegiatan` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `volume` int(11) NOT NULL,
  `list` varchar(255) NOT NULL,
  `harga_satuan` bigint(20) NOT NULL,
  `pagu` bigint(20) NOT NULL,
  `spn` varchar(255) NOT NULL,
  `realisasi` bigint(20) NOT NULL,
  `total` bigint(20) DEFAULT NULL,
  `sisa_anggaran` bigint(20) DEFAULT NULL,
  `notifikasi` varchar(200) DEFAULT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `realisasi_anggaran`
--

INSERT INTO `realisasi_anggaran` (`id`, `staf_id`, `staf`, `bidang`, `program_kegiatan`, `dipa_id`, `jenis_dipa`, `dipa_kegiatan`, `kode_kegiatan`, `uraian_kegiatan`, `slug`, `volume`, `list`, `harga_satuan`, `pagu`, `spn`, `realisasi`, `total`, `sisa_anggaran`, `notifikasi`, `tanggal`, `bulan`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 7, 'Urmin', 'Perencanaan dan Administrasi', '060.01.BD-Program Profesionalisme SDM Polri', 2, 'DIPA TAHUN 2023', '3096.EBA.994-Layanan Perkantoran', '001.AA.1', 'Pembayaran Gaji dan Tunjangan', 'pembayaran-gaji-dan-tunjangan', 12, 'OB', 1167442000, 14009304000, 'Ka SPN', 0, 0, 1124402112, NULL, 3, 'Januari', 2023, '2023-07-27 08:50:02', '2023-07-27 08:50:02'),
(2, 7, 'Urmin', 'Perencanaan dan Administrasi', '060.01.BD-Program Profesionalisme SDM Polri', 2, 'DIPA TAHUN 2023', '3096.EBA.994-Layanan Perkantoran', '001.AA.1', 'Pembayaran Gaji dan Tunjangan', 'pembayaran-gaji-dan-tunjangan-2', 1, 'OB', 1167442000, 1167442000, 'Ka SPN', 1167442000, 0, 1167442000, NULL, 3, 'Januari', 2023, '2023-07-27 15:45:46', '2023-07-31 03:06:29'),
(3, 7, 'Urmin', 'Perencanaan dan Administrasi', '060.01.BD-Program Profesionalisme SDM Polri', 2, 'DIPA TAHUN 2023', '3096.EBA.962-Layanan Umum', '003.AB..A.1', 'Rapat-Rapat Penyusunan Dokumen Perencanaan  (Dokumen TOR/RAB Pagu Indikatif T.A 2024)', 'rapat-rapat-penyusunan-dokumen-perencanaan-dokumen-tor-rab-pagu-indikatif-t-a-2024', 1, 'OG', 2038334, 2038334, 'Ka SPN', 2038334, 0, 2038334, NULL, 23, 'Januari', 2023, '2023-07-27 15:45:55', '2023-07-31 03:06:29'),
(4, 1, 'Jarlat', 'Pengajaran dan Latihan', '060.01.BD-Program Profesionalisme SDM Polri', 2, 'DIPA TAHUN 2023', '3096.EBA.962-Layanan Umum', '003.DA.1', 'Kegiatan Sosialisasi Kurikulum', 'kegiatan-sosialisasi-kurikulum', 1, 'GIAT', 3225000, 3225000, 'Ka SPN', 3225000, 0, 3225000, 'realisasi', 2, 'Februari', 2023, '2023-07-27 16:31:45', '2023-07-27 16:39:21'),
(5, 1, 'Jarlat', 'Pengajaran dan Latihan', '060.01.BD-Program Profesionalisme SDM Polri', 2, 'DIPA TAHUN 2023', '3100.EBC.011-Pelatihan', '003.DC.1', 'Belanja Barang Operasional Lainnya', 'belanja-barang-operasional-lainnya', 825, 'OG', 70000, 57750000, 'Ka SPN', 57750000, 0, 57750000, 'realisasi', 3, 'Februari', 2023, '2023-07-27 16:31:50', '2023-07-27 16:39:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `renmi`
--

CREATE TABLE `renmi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) NOT NULL,
  `nrp` varchar(255) NOT NULL,
  `telpon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `renmi`
--

INSERT INTO `renmi` (`id`, `username`, `password`, `nama`, `slug`, `pangkat`, `nrp`, `telpon`, `email`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'renmin', '$2y$10$uziAFsR36ab/QXaTrt1OJONbdcVZ..Eyqw1TZMbF2RzcK6Cb0.nYi', 'Renmin', 'renmin', 'Bripda', '00110071', '082192291208', 'fadlan.hasan02@gmail.com', '2023-05-10 08:45:41', '2023-07-15 21:38:47', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `revisi_dana`
--

CREATE TABLE `revisi_dana` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `dana_awal` bigint(20) NOT NULL DEFAULT 0,
  `penambahan_dana` bigint(20) NOT NULL DEFAULT 0,
  `pengurangan_dana` bigint(20) NOT NULL DEFAULT 0,
  `dana_sekarang` bigint(20) NOT NULL DEFAULT 0,
  `tanggal` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `revisi_dana_staf`
--

CREATE TABLE `revisi_dana_staf` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `staf_id` bigint(20) UNSIGNED NOT NULL,
  `dana_awal` bigint(20) NOT NULL DEFAULT 0,
  `penambahan_dana` bigint(20) NOT NULL DEFAULT 0,
  `pengurangan_dana` bigint(20) NOT NULL DEFAULT 0,
  `dana_sekarang` bigint(20) NOT NULL DEFAULT 0,
  `tanggal` varchar(255) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Renmin', NULL, NULL),
(3, 'Staf', NULL, NULL),
(4, 'Spn', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `staf`
--

CREATE TABLE `staf` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bidang` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) NOT NULL,
  `nrp` varchar(255) NOT NULL,
  `telpon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `staf`
--

INSERT INTO `staf` (`id`, `username`, `password`, `bidang`, `nama`, `slug`, `pangkat`, `nrp`, `telpon`, `email`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'appi', '$2y$10$D4LnK5PoU4GHZuADfb3n6.Or0HSsmIE7ihfHWCvaAGiruJXYiJZyK', 'Pengajaran dan Latihan', 'Jarlat', 'jarlat', 'Bripda', '00040134', '082192441517', 'appibeta43@gmail.com', '2023-05-10 08:50:47', '2023-07-15 21:37:59', 3),
(2, 'aan', '$2y$10$O4ZNVTK25A2Ijwp2DVpcve9P9NkDJZ2au3uPg6wkuMFu3jmWm7r7u', 'Koordinator Tenaga Pendidik', 'Gadik', 'gadik', 'Bripda', '99090341', '08905950279', 'aanhikmahputra@gmail.com', '2023-05-10 08:55:37', '2023-07-15 21:37:48', 3),
(3, 'dwi', '$2y$10$TnWgJsli5Rt1DNTLlLcFWOUCr0wwz6ROlzHlUyeV67tG1kJUHx2Ga', 'Korps Siswa', 'Korsis', 'korsis', 'Bripda', '01110141', '082188987411', 'dwinugraha45@gmail.com', '2023-05-10 08:56:31', '2023-07-15 21:37:37', 3),
(4, 'sahir', '$2y$10$cMTAgpZ.hXwvoNiFSwFqle9s2gZWErVV.KgBeqVuxbN9lsSWeBPzu', 'Pelayanan Markas', 'Yanma', 'yanma', 'Bripda', '99100190', '082292599968', 'sahir9910@gmail.com', '2023-07-14 04:09:13', '2023-07-15 21:33:14', 3),
(5, 'Lutfi', '$2y$10$TcKaZTX1A890lk5HsgKzzuccVK/chHOwSfx/58754Q0HikMb0EulS', 'Profesi dan Pengamanan Personil', 'Provos', 'provos', 'Bripda', '02120527', '085796790901', 'lutfiairanda47@gmail.com', '2023-07-14 04:11:05', '2023-07-15 21:32:47', 3),
(6, 'ria', '$2y$10$hTZPffJ/Ks8BNpypii1mZe8WRWIxnOFBc0xfquMHRXJdGHQHF77.i', 'Pelayanan Kesehatan', 'Poliklinik', 'poliklinik', 'Bripka', '84121492', '08114212631', 'rheeaa262@gmail.com', '2023-07-14 04:12:35', '2023-07-15 21:32:32', 3),
(7, 'adam', '$2y$10$vt.gswKQ0DPBpn9o7tWaiel4B2QnWs8j9tWpyZECHxK9WOb6M3k5e', 'Perencanaan dan Administrasi', 'Urmin', 'urmin', 'Briptu', '97030320', '085720143417', 'kusnandio40@gmail.com', '2023-07-14 04:14:20', '2023-07-15 21:27:16', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `staf_anggaran`
--

CREATE TABLE `staf_anggaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dipa_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_dipa` varchar(255) NOT NULL,
  `staf_id` bigint(20) UNSIGNED NOT NULL,
  `total_anggaran` bigint(20) NOT NULL,
  `penambahan_dana` bigint(20) DEFAULT NULL,
  `pengurangan_dana` bigint(20) DEFAULT NULL,
  `total_pemakaian` bigint(20) NOT NULL,
  `sisa_anggaran` bigint(20) NOT NULL,
  `notifikasi` varchar(200) DEFAULT NULL,
  `tanggal` int(11) NOT NULL,
  `bulan` varchar(255) NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `staf_anggaran`
--

INSERT INTO `staf_anggaran` (`id`, `dipa_id`, `jenis_dipa`, `staf_id`, `total_anggaran`, `penambahan_dana`, `pengurangan_dana`, `total_pemakaian`, `sisa_anggaran`, `notifikasi`, `tanggal`, `bulan`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 2, 'DIPA TAHUN 2023', 7, 15638225000, NULL, NULL, 1169480334, 1583842778, NULL, 2, 'Januari', 2023, '2023-07-27 01:55:27', '2023-07-27 16:04:28'),
(2, 2, 'DIPA TAHUN 2023', 4, 17082699000, NULL, NULL, 0, 17082699000, NULL, 2, 'Januari', 2023, '2023-07-27 01:56:14', '2023-07-27 16:34:11'),
(3, 2, 'DIPA TAHUN 2023', 2, 5605375000, NULL, NULL, 0, 5605375000, NULL, 2, 'Januari', 2023, '2023-07-27 01:57:09', '2023-07-27 08:21:11'),
(4, 2, 'DIPA TAHUN 2023', 1, 793975500, NULL, NULL, 60975000, 733000500, NULL, 2, 'Januari', 2023, '2023-07-27 01:58:47', '2023-07-27 16:39:58'),
(5, 2, 'DIPA TAHUN 2023', 3, 410243750, NULL, NULL, 0, 410243750, 'ada', 2, 'Januari', 2023, '2023-07-27 01:59:56', '2023-07-27 01:59:56'),
(6, 2, 'DIPA TAHUN 2023', 5, 38963750, NULL, NULL, 0, 38963750, 'ada', 2, 'Januari', 2023, '2023-07-27 02:01:03', '2023-07-27 02:01:03'),
(7, 2, 'DIPA TAHUN 2023', 6, 849150000, NULL, NULL, 0, 849150000, 'ada', 2, 'Januari', 2023, '2023-07-27 02:02:41', '2023-07-27 02:02:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `pangkat` varchar(255) NOT NULL,
  `nrp` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`),
  ADD UNIQUE KEY `admin_email_unique` (`email`),
  ADD KEY `admin_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `dipa`
--
ALTER TABLE `dipa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dipa_anggaran`
--
ALTER TABLE `dipa_anggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dipa_anggaran_dipa_id_foreign` (`dipa_id`);

--
-- Indeks untuk tabel `dipa_kegiatan`
--
ALTER TABLE `dipa_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dipa_kegiatan_kode_unique` (`kode`);

--
-- Indeks untuk tabel `dipa_revisi`
--
ALTER TABLE `dipa_revisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dipa_revisi_dipa_id_foreign` (`dipa_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kategory_kegiatan`
--
ALTER TABLE `kategory_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategory_kegiatan_dipa_id_foreign` (`dipa_id`),
  ADD KEY `kategory_kegiatan_kegiatan_id_foreign` (`kegiatan_id`);

--
-- Indeks untuk tabel `kategory_program`
--
ALTER TABLE `kategory_program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategory_program_dipa_id_foreign` (`dipa_id`),
  ADD KEY `kategory_program_program_id_foreign` (`program_id`);

--
-- Indeks untuk tabel `kebutuhan_anggaran`
--
ALTER TABLE `kebutuhan_anggaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kebutuhan_anggaran_kode_unique` (`kode`),
  ADD KEY `kebutuhan_anggaran_staf_id_foreign` (`staf_id`),
  ADD KEY `kebutuhan_anggaran_dipa_id_foreign` (`dipa_id`);

--
-- Indeks untuk tabel `kepala_spn`
--
ALTER TABLE `kepala_spn`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kepala_spn_username_unique` (`username`),
  ADD UNIQUE KEY `kepala_spn_email_unique` (`email`),
  ADD KEY `kepala_spn_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_keuangan_staf_id_foreign` (`staf_id`),
  ADD KEY `laporan_keuangan_dipa_id_foreign` (`dipa_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `program_kegiatan`
--
ALTER TABLE `program_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_kegiatan_kode_unique` (`kode`);

--
-- Indeks untuk tabel `realisasi_anggaran`
--
ALTER TABLE `realisasi_anggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_anggaran_dipa_id_foreign` (`dipa_id`),
  ADD KEY `laporan_anggaran_staf_id_foreign` (`staf_id`);

--
-- Indeks untuk tabel `renmi`
--
ALTER TABLE `renmi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `renmi_username_unique` (`username`),
  ADD UNIQUE KEY `renmi_email_unique` (`email`),
  ADD KEY `renmi_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `revisi_dana`
--
ALTER TABLE `revisi_dana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisi_dana_dipa_id_foreign` (`dipa_id`);

--
-- Indeks untuk tabel `revisi_dana_staf`
--
ALTER TABLE `revisi_dana_staf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revisi_dana_staf_dipa_id_foreign` (`dipa_id`),
  ADD KEY `revisi_dana_staf_staf_id_foreign` (`staf_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `staf`
--
ALTER TABLE `staf`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staf_username_unique` (`username`),
  ADD UNIQUE KEY `staf_email_unique` (`email`),
  ADD KEY `staf_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `staf_anggaran`
--
ALTER TABLE `staf_anggaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staf_anggaran_staf_id_foreign` (`staf_id`),
  ADD KEY `staf_anggaran_dipa_id_foreign` (`dipa_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dipa`
--
ALTER TABLE `dipa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dipa_anggaran`
--
ALTER TABLE `dipa_anggaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `dipa_kegiatan`
--
ALTER TABLE `dipa_kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `dipa_revisi`
--
ALTER TABLE `dipa_revisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategory_kegiatan`
--
ALTER TABLE `kategory_kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `kategory_program`
--
ALTER TABLE `kategory_program`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kebutuhan_anggaran`
--
ALTER TABLE `kebutuhan_anggaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kepala_spn`
--
ALTER TABLE `kepala_spn`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `program_kegiatan`
--
ALTER TABLE `program_kegiatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `realisasi_anggaran`
--
ALTER TABLE `realisasi_anggaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `renmi`
--
ALTER TABLE `renmi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `revisi_dana`
--
ALTER TABLE `revisi_dana`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `revisi_dana_staf`
--
ALTER TABLE `revisi_dana_staf`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `staf`
--
ALTER TABLE `staf`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `staf_anggaran`
--
ALTER TABLE `staf_anggaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ketidakleluasaan untuk tabel `dipa_anggaran`
--
ALTER TABLE `dipa_anggaran`
  ADD CONSTRAINT `dipa_anggaran_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`);

--
-- Ketidakleluasaan untuk tabel `dipa_revisi`
--
ALTER TABLE `dipa_revisi`
  ADD CONSTRAINT `dipa_revisi_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`);

--
-- Ketidakleluasaan untuk tabel `kategory_kegiatan`
--
ALTER TABLE `kategory_kegiatan`
  ADD CONSTRAINT `kategory_kegiatan_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`),
  ADD CONSTRAINT `kategory_kegiatan_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `dipa_kegiatan` (`id`);

--
-- Ketidakleluasaan untuk tabel `kategory_program`
--
ALTER TABLE `kategory_program`
  ADD CONSTRAINT `kategory_program_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`),
  ADD CONSTRAINT `kategory_program_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program_kegiatan` (`id`);

--
-- Ketidakleluasaan untuk tabel `kebutuhan_anggaran`
--
ALTER TABLE `kebutuhan_anggaran`
  ADD CONSTRAINT `kebutuhan_anggaran_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`),
  ADD CONSTRAINT `kebutuhan_anggaran_staf_id_foreign` FOREIGN KEY (`staf_id`) REFERENCES `staf` (`id`);

--
-- Ketidakleluasaan untuk tabel `kepala_spn`
--
ALTER TABLE `kepala_spn`
  ADD CONSTRAINT `kepala_spn_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ketidakleluasaan untuk tabel `laporan_keuangan`
--
ALTER TABLE `laporan_keuangan`
  ADD CONSTRAINT `laporan_keuangan_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`),
  ADD CONSTRAINT `laporan_keuangan_staf_id_foreign` FOREIGN KEY (`staf_id`) REFERENCES `staf` (`id`);

--
-- Ketidakleluasaan untuk tabel `realisasi_anggaran`
--
ALTER TABLE `realisasi_anggaran`
  ADD CONSTRAINT `laporan_anggaran_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`),
  ADD CONSTRAINT `laporan_anggaran_staf_id_foreign` FOREIGN KEY (`staf_id`) REFERENCES `staf` (`id`);

--
-- Ketidakleluasaan untuk tabel `renmi`
--
ALTER TABLE `renmi`
  ADD CONSTRAINT `renmi_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ketidakleluasaan untuk tabel `revisi_dana`
--
ALTER TABLE `revisi_dana`
  ADD CONSTRAINT `revisi_dana_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`);

--
-- Ketidakleluasaan untuk tabel `revisi_dana_staf`
--
ALTER TABLE `revisi_dana_staf`
  ADD CONSTRAINT `revisi_dana_staf_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`),
  ADD CONSTRAINT `revisi_dana_staf_staf_id_foreign` FOREIGN KEY (`staf_id`) REFERENCES `staf` (`id`);

--
-- Ketidakleluasaan untuk tabel `staf`
--
ALTER TABLE `staf`
  ADD CONSTRAINT `staf_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Ketidakleluasaan untuk tabel `staf_anggaran`
--
ALTER TABLE `staf_anggaran`
  ADD CONSTRAINT `staf_anggaran_dipa_id_foreign` FOREIGN KEY (`dipa_id`) REFERENCES `dipa` (`id`),
  ADD CONSTRAINT `staf_anggaran_staf_id_foreign` FOREIGN KEY (`staf_id`) REFERENCES `staf` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
