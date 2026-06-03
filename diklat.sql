-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bkpsdm
-- CREATE DATABASE IF NOT EXISTS `bkpsdm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bkpsdm`;

-- Dumping structure for table bkpsdm.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.admin: ~0 rows (approximately)
INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_admin`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '$2y$12$sWuSNgGMNEX0UQas5WCNTuuUcvI2NwFw6RYUrSvgO/XUyzx2ELoAm', 1, '2026-02-06 23:31:45', '2026-02-06 23:31:45');

-- Dumping structure for table bkpsdm.akpk_10_komentars
CREATE TABLE IF NOT EXISTS `akpk_10_komentars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_integritas` int NOT NULL,
  `jml_kerjasama` int NOT NULL,
  `jml_komunikasi` int NOT NULL,
  `jml_orientasipada_hasil` int NOT NULL,
  `jml_pelayanan_publik` int NOT NULL,
  `jml_pengembangan_diri` int NOT NULL,
  `jml_mengelola_perubahan` int NOT NULL,
  `jml_pengambilan_keputusan` int NOT NULL,
  `jml_penguasaan_teknologi` int NOT NULL,
  `jml_keahlian_spesifik` int NOT NULL,
  `jml_penerapan_prosedur` int NOT NULL,
  `jml_kemajemukan` int NOT NULL,
  `jml_menghargai` int NOT NULL,
  `jml_tolerasi` int NOT NULL,
  `jml_daya_guna` int NOT NULL,
  `jml_hubungan_sosial` int NOT NULL,
  `komentar_integritas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_kerjasama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_komunikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_orientasi_pada_hasil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pelayanan_publik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pengembangan_diri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_mengelola_perubahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_pengambilan_keputusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_penguasaan_teknologi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_keahlian_spesifik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_penerapan_prosedur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_kemajemukan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_menghargai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_tolerasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_daya_guna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar_hubungan_sosial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_10_komentars: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_11_hasilakhirs
CREATE TABLE IF NOT EXISTS `akpk_11_hasilakhirs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` int NOT NULL,
  `nip` int NOT NULL,
  `nip_atasan` int NOT NULL,
  `kategori_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standarmin_integritas` int NOT NULL,
  `standarmin_kerjasama` int NOT NULL,
  `standarmin_komunikasi` int NOT NULL,
  `standarmin_orientasi_pada_hasil` int NOT NULL,
  `standarmin_pelayanan_publik` int NOT NULL,
  `standarmin_pengembangan_diri` int NOT NULL,
  `standarmin_mengelola_perubahan` int NOT NULL,
  `standarmin_pengambilan_keputusan` int NOT NULL,
  `standarmin_penguasaan_teknologi` int NOT NULL,
  `standarmin_keahlian_spesifik` int NOT NULL,
  `standarmin_penerapan_prosedur` int NOT NULL,
  `standarmin_kemajemukan` int NOT NULL,
  `standarmin_menghargai` int NOT NULL,
  `standarmin_tolerasi` int NOT NULL,
  `standarmin_daya_guna` int NOT NULL,
  `standarmin_hubungan_sosial` int NOT NULL,
  `self_kompetensi_ditingkatkan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `self_pelatihan_dibutuhkan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atasan_integritas` int NOT NULL,
  `atasan_kerjasama` int NOT NULL,
  `atasan_komunikasi` int NOT NULL,
  `atasan_orientasi_pada_hasil` int NOT NULL,
  `atasan_pelayanan_publik` int NOT NULL,
  `atasan_pengembangan_diri` int NOT NULL,
  `atasan_mengelola_perubahan` int NOT NULL,
  `atasan_pengambilan_keputusan` int NOT NULL,
  `atasan_penguasaan_teknologi` int NOT NULL,
  `atasan_keahlian_spesifik` int NOT NULL,
  `atasan_penerapan_prosedur` int NOT NULL,
  `atasan_kemajemukan` int NOT NULL,
  `atasan_menghargai` int NOT NULL,
  `atasan_tolerasi` int NOT NULL,
  `atasan_daya_guna` int NOT NULL,
  `atasan_hubungan_sosial` int NOT NULL,
  `atasan_kompetensi_dikembangkan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atasan_rekomendari_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atasan_alasan_rekomendasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_integritas` int NOT NULL,
  `jml_kerjasama` int NOT NULL,
  `jml_komunikasi` int NOT NULL,
  `jml_orientasi_pada_hasil` int NOT NULL,
  `jml_pelayanan_publik` int NOT NULL,
  `jml_pengembangan_diri` int NOT NULL,
  `jml_mengelola_perubahan` int NOT NULL,
  `jml_pengambilan_keputusan` int NOT NULL,
  `jml_penguasaan_teknologi` int NOT NULL,
  `jml_keahlian_spesifik` int NOT NULL,
  `jml_penerapan_prosedur` int NOT NULL,
  `jml_kemajemukan` int NOT NULL,
  `jml_menghargai` int NOT NULL,
  `jml_tolerasi` int NOT NULL,
  `jml_daya_guna` int NOT NULL,
  `jml_hubungan_sosial` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_11_hasilakhirs: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_1_infos
CREATE TABLE IF NOT EXISTS `akpk_1_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `info_akpk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_1_infos: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_2_selfs
CREATE TABLE IF NOT EXISTS `akpk_2_selfs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pegawai_id` bigint unsigned NOT NULL,
  `tanggal_pengisian` date NOT NULL,
  `manajerial_nilai` json NOT NULL,
  `teknis_nilai` json NOT NULL,
  `sosiokultural_nilai` json NOT NULL,
  `kompetensi_dibutuhkan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelatihan_dibutuhkan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_atasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manajerial_keterangan` json DEFAULT NULL,
  `teknis_keterangan` json DEFAULT NULL,
  `sosiokultural_keterangan` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akpk_2_selfs_pegawai_id_foreign` (`pegawai_id`),
  CONSTRAINT `akpk_2_selfs_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `ref_pegawais` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_2_selfs: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_3_atasans
CREATE TABLE IF NOT EXISTS `akpk_3_atasans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_unitkerja` int NOT NULL,
  `unit_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_3_atasans: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_3_penilaianbawahans
CREATE TABLE IF NOT EXISTS `akpk_3_penilaianbawahans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_atasan` bigint unsigned DEFAULT NULL,
  `nip_bawahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengisian` date NOT NULL,
  `manajerial_nilai` json NOT NULL,
  `teknis_nilai` json NOT NULL,
  `sosiokultural_nilai` json NOT NULL,
  `kompetensi_dibutuhkan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelatihan_dibutuhkan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `manajerial_keterangan` json DEFAULT NULL,
  `teknis_keterangan` json DEFAULT NULL,
  `sosiokultural_keterangan` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `akpk_3_penilaianbawahans_id_atasan_foreign` (`id_atasan`),
  CONSTRAINT `akpk_3_penilaianbawahans_id_atasan_foreign` FOREIGN KEY (`id_atasan`) REFERENCES `ref_pegawais` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_3_penilaianbawahans: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_4_usulanpelatihans
CREATE TABLE IF NOT EXISTS `akpk_4_usulanpelatihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `tahun` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usulansolowasis` enum('on progres','diterima','tolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_4_usulanpelatihans: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_5_usulankebutuhanpelatihans
CREATE TABLE IF NOT EXISTS `akpk_5_usulankebutuhanpelatihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` int NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_5_usulankebutuhanpelatihans: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_5_usulpelatihanumums
CREATE TABLE IF NOT EXISTS `akpk_5_usulpelatihanumums` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` int NOT NULL,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_usulanpelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_5_usulpelatihanumums: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_6_kirimusulanopds
CREATE TABLE IF NOT EXISTS `akpk_6_kirimusulanopds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` int NOT NULL,
  `jenis_usulan` int NOT NULL,
  `nama_usulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_pdf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('proses verifikasi','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_6_kirimusulanopds: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_7_penanngungjawabs
CREATE TABLE IF NOT EXISTS `akpk_7_penanngungjawabs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_7_penanngungjawabs: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_8_settingusulsolowases
CREATE TABLE IF NOT EXISTS `akpk_8_settingusulsolowases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_tampil` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelatihan ]` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_8_settingusulsolowases: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.akpk_9_standarmins
CREATE TABLE IF NOT EXISTS `akpk_9_standarmins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kategori_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standarmin_integeregritas` int NOT NULL,
  `standarmin_kerjasama` int NOT NULL,
  `standarmin_komunikasi` int NOT NULL,
  `standarmin_orientasipada_hasil` int NOT NULL,
  `standarmin_pelayanan_publik` int NOT NULL,
  `standarmin_pengembangan_diri` int NOT NULL,
  `standarmin_mengelola_perubahan` int NOT NULL,
  `standarmin_pengambilan_keputusan` int NOT NULL,
  `standarmin_penguasaan_teknologi` int NOT NULL,
  `standarmin_keahlian_spesifik` int NOT NULL,
  `standarmin_penerapan_prosedur` int NOT NULL,
  `standarmin_kemajemukan` int NOT NULL,
  `standarmin_menghargai` int NOT NULL,
  `standarmin_tolerasi` int NOT NULL,
  `standarmin_daya_guna` int NOT NULL,
  `standarmin_hubungan_sosial` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.akpk_9_standarmins: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.brosur_1_infos
CREATE TABLE IF NOT EXISTS `brosur_1_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `info_brosur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_brosur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.brosur_1_infos: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.brosur_2_masuks
CREATE TABLE IF NOT EXISTS `brosur_2_masuks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_sales` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brosur_excel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brosur_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('proses verifikasi','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.brosur_2_masuks: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.cache: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.cache_locks: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.directory_1_infos
CREATE TABLE IF NOT EXISTS `directory_1_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `info_katalog` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.directory_1_infos: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.directory_2_laporans
CREATE TABLE IF NOT EXISTS `directory_2_laporans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_ruang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelaksanaan_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rumpun_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyelenggara_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `hasil_pelatihan` enum('lulus','tidak lulus') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abstrak_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status_peserta` enum('Alumni',' Non Alumni') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.directory_2_laporans: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.evaluasi_users
CREATE TABLE IF NOT EXISTS `evaluasi_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `evaluasi_users_nip_unique` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.evaluasi_users: ~1 rows (approximately)
INSERT INTO `evaluasi_users` (`id`, `nip`, `email`, `nama`, `password`, `tanggal_lahir`, `foto_profile`, `created_at`, `updated_at`) VALUES
	(1, '19850101', 'budi.santoso@bkpsdm.go.id', 'Budi Santoso', '$2y$12$UPanZb5ZxkH0bTYux4OO/epm3N34sYrZvqLvDm5AoAoM2arpBEGo6', '1985-01-01', 'uploads/profiles/profile_1_1770630769.jpg', '2026-02-06 23:32:34', '2026-02-09 02:52:49');

-- Dumping structure for table bkpsdm.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.ipasn_1_infos
CREATE TABLE IF NOT EXISTS `ipasn_1_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `info_ipasn` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ipasn_1_infos: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.ipasn_2_historyinstansis
CREATE TABLE IF NOT EXISTS `ipasn_2_historyinstansis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_penetapan` date NOT NULL,
  `nilai` int NOT NULL,
  `link_bkn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_bkpsdm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ipasn_2_historyinstansis: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.ipasn_3_nilaiperasns
CREATE TABLE IF NOT EXISTS `ipasn_3_nilaiperasns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_kerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai_pendidikan` int NOT NULL,
  `nilai_kinerja` int NOT NULL,
  `nilai_disiplin` int NOT NULL,
  `nilai_bangkom` int NOT NULL,
  `nilai_totalipasn` int NOT NULL,
  `link_filepenetapanbkd` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ipasn_3_nilaiperasns: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.jobs: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.job_batches: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.katalog_1_infos
CREATE TABLE IF NOT EXISTS `katalog_1_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `info_katalog` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.katalog_1_infos: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.katalog_2_masuks
CREATE TABLE IF NOT EXISTS `katalog_2_masuks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_CP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_HP` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelaksanaan_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rumpun_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `informasi_pelatihan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estimasi_biaya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('proses verifikasi','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.katalog_2_masuks: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.linkdrives
CREATE TABLE IF NOT EXISTS `linkdrives` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` year NOT NULL,
  `linkdrive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.linkdrives: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.migrations: ~49 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2023_01_01_000000_create_usulan_pelatihans_table', 1),
	(5, '2024_12_11_151900_create_admin', 1),
	(6, '2025_01_28_010929_ref_kategorijabatans', 1),
	(7, '2025_01_28_011044_ref_namapenyelenggaras', 1),
	(8, '2025_01_28_011059_ref_unitkerja', 1),
	(9, '2025_01_28_011745_ref_jenisasns', 1),
	(10, '2025_01_28_022712_ref_namajabatanasn', 1),
	(11, '2025_01_28_143823_ref_golongan', 1),
	(12, '2025_01_28_143847_ref_jenispelatihan', 1),
	(13, '2025_01_28_143943_ref_metodepelatihan', 1),
	(14, '2025_01_28_143958_ref_namapelatihan', 1),
	(15, '2025_01_28_144008_ref_pegawai', 1),
	(16, '2025_01_28_144028_ref_pelaksanaanpelatihan', 1),
	(17, '2025_01_29_005150_pbj_1_pelatihan', 1),
	(18, '2025_01_29_005158_pbj_2_sertifikasi', 1),
	(19, '2025_01_29_010452_pelatihan_1_info', 1),
	(20, '2025_01_29_010459_pelatihan_2_usulan', 1),
	(21, '2025_01_29_010516_pelatihan_3_laporan', 1),
	(22, '2025_01_29_010526_pelatihan_4_alumni', 1),
	(23, '2025_01_29_010628_katalog_1_info', 1),
	(24, '2025_01_29_010647_katalog_2_masuk', 1),
	(25, '2025_01_29_010701_brosur_1_info', 1),
	(26, '2025_01_29_010721_brosur_2_masuk', 1),
	(27, '2025_02_14_155630_linkdrive', 1),
	(28, '2025_03_07_161700_solowasis_1_info', 1),
	(29, '2025_03_07_161918_solowasis_2_daftarlatsolowasis', 1),
	(30, '2025_03_08_011733_directory_1_info', 1),
	(31, '2025_03_08_011747_directory_2_laporan', 1),
	(32, '2025_03_08_080814_ipasn_1_info', 1),
	(33, '2025_03_08_080815_ipasn_2_historyinstansis', 1),
	(34, '2025_03_08_080835_ipasn_3_nilaiperasns', 1),
	(35, '2025_03_09_010730_akpk_1_info', 1),
	(36, '2025_03_09_011021_akpk_4_usulanpelatihan', 1),
	(37, '2025_03_09_011359_akpk_3_atasan', 1),
	(38, '2025_03_09_011359_akpk_3_penilaianbawahan', 1),
	(39, '2025_03_09_011423_akpk_2_self', 1),
	(40, '2025_03_09_013203_akpk_6_kirimusulanopds', 1),
	(41, '2025_03_09_013243_akpk_7_penanggungjawabs', 1),
	(42, '2025_03_09_013333_akpk_9_standarmins', 1),
	(43, '2025_03_09_013455_akpk_11_hasilakhirs', 1),
	(44, '2025_03_09_015106_akpk_8_settingusulsolowases', 1),
	(45, '2025_03_09_015123_akpk_10_komentars', 1),
	(46, '2025_03_09_015939_akpk_5_usulpelatihanumums', 1),
	(47, '2025_03_11_050419_create_pelatihan_5_pertanyaan_table', 1),
	(48, '2025_04_11_111000_create_pelatihan_5_jawaban_alumni_table', 1),
	(49, '2025_05_13_130048_profile_akpk', 1),
	(50, '2025_06_02_162117_create_jawabans_table', 1),
	(51, '2025_09_13_071616_create_pelatihan_5_pascadiklat_alumni_table', 1),
	(52, '2025_09_13_071634_create_pelatihan_5_pascadiklat_atasan_table', 1),
	(53, '2025_09_13_071641_create_pelatihan_5_pascadiklat_rekankerja_table', 1),
	(54, '2025_09_13_071851_modify_ref_namapelatihans_add_jenis_pelatihan_id', 1),
	(55, '2025_09_13_073426_create_pegawai_auths_table', 1),
	(56, '2025_09_13_091507_create_pelatihan_5_pascadiklat_kuisioner_table', 1),
	(57, '2025_09_13_091536_create_pelatihan_5_pascadiklat_pertanyaan_table', 1),
	(58, '2025_09_13_091551_create_pelatihan_5_pascadiklat_opsi_jawaban_table', 1),
	(59, '2025_09_13_091559_create_pelatihan_5_pascadiklat_jawaban_table', 1),
	(60, '2025_09_14_024345_create_pelatihan_5_pascadiklat_kuesioner_table', 1),
	(61, '2025_09_14_024428_create_pelatihan_5_pascadiklat_pertanyaan_table', 1),
	(62, '2025_09_14_024519_create_pelatihan_5_pascadiklat_opsi_jawaban_table', 1),
	(63, '2025_09_14_024611_create_pelatihan_5_pascadiklat_pelatihan_kuesioner_table', 1),
	(64, '2025_09_23_072028_create_pelatihan_5_pascadiklat_jawaban_table', 1),
	(65, '2025_09_23_072134_create_pelatihan_5_pascadiklat_pelatihan_kuesioner_table', 1),
	(66, '2025_09_29_161717_update_jenis_pertanyaan_pascadiklat', 1),
	(67, '2025_10_05_154105_add_alumni_id_to_pelatihan_5_pascadiklat_jawaban_table', 1),
	(68, '2025_10_05_155443_add_pelatihan_id_to_pascadiklat_relations_tables', 1),
	(69, '2026_02_06_223000_remove_nilai_from_pelatihan_5_pascadiklat_opsi_jawaban_table', 1),
	(70, '2026_02_07_061958_create_evaluasi_users_table', 1),
	(71, '2026_02_07_062902_update_evaluasi_users_table_remove_role', 1),
	(72, '2026_02_09_164300_add_foto_profile_to_evaluasi_users_table', 2);

-- Dumping structure for table bkpsdm.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.pbj_1_pelatihans
CREATE TABLE IF NOT EXISTS `pbj_1_pelatihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `hasil_pelatihan` enum('lulus','tidaklulus') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pbj_1_pelatihans: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.pbj_2_sertifikasis
CREATE TABLE IF NOT EXISTS `pbj_2_sertifikasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_sertifikasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sertifikasi` date NOT NULL,
  `hasil_sertifikasi` enum('lulus','tidaklulus') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pbj_2_sertifikasis: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.pegawai_auth
CREATE TABLE IF NOT EXISTS `pegawai_auth` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint unsigned NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pegawai_auth_id_pegawai_unique` (`id_pegawai`),
  KEY `pegawai_auth_id_pegawai_index` (`id_pegawai`),
  CONSTRAINT `pegawai_auth_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `ref_pegawais` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pegawai_auth: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.pelatihan_1_infos
CREATE TABLE IF NOT EXISTS `pelatihan_1_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `info_pelatihan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_1_infos: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.pelatihan_2_usulans
CREATE TABLE IF NOT EXISTS `pelatihan_2_usulans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelaksanaan_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyelenggara_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `estimasi_biaya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_penawaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_usulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('proses verifikasi','diterima','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_2_usulans: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.pelatihan_3_laporans
CREATE TABLE IF NOT EXISTS `pelatihan_3_laporans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelaksanaan_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyelenggara_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pelatihan` date NOT NULL,
  `selesai_pelatihan` date NOT NULL,
  `biaya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil_pelatihan` enum('lulus','tidak lulus') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_3_laporans: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.pelatihan_4_alumni
CREATE TABLE IF NOT EXISTS `pelatihan_4_alumni` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unitkerja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelaksanaan_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penyelenggara_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mulai_pelatihan` date NOT NULL,
  `selesai_pelatihan` date NOT NULL,
  `biaya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil_pelatihan` enum('lulus','tidak lulus') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_4_alumni: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.pelatihan_5_pascadiklat_alumni
CREATE TABLE IF NOT EXISTS `pelatihan_5_pascadiklat_alumni` (
  `alumni_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pegawai_id` bigint unsigned NOT NULL,
  `pelatihan_id` bigint unsigned NOT NULL,
  `tanggal_mulai_pelatihan` date DEFAULT NULL,
  `tanggal_selesai_pelatihan` date DEFAULT NULL,
  `status_alumni` enum('belum_dinilai','sedang_dinilai','sudah_dinilai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_dinilai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`alumni_id`),
  KEY `pelatihan_5_pascadiklat_alumni_pelatihan_id_foreign` (`pelatihan_id`),
  KEY `pelatihan_5_pascadiklat_alumni_pegawai_id_pelatihan_id_index` (`pegawai_id`,`pelatihan_id`),
  CONSTRAINT `pelatihan_5_pascadiklat_alumni_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `ref_pegawais` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_alumni_pelatihan_id_foreign` FOREIGN KEY (`pelatihan_id`) REFERENCES `ref_namapelatihans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pascadiklat_alumni: ~0 rows (approximately)
INSERT INTO `pelatihan_5_pascadiklat_alumni` (`alumni_id`, `pegawai_id`, `pelatihan_id`, `tanggal_mulai_pelatihan`, `tanggal_selesai_pelatihan`, `status_alumni`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2026-02-02', '2026-02-03', 'belum_dinilai', '2026-02-07 00:44:18', '2026-02-07 00:44:18');

-- Dumping structure for table bkpsdm.pelatihan_5_pascadiklat_atasan
CREATE TABLE IF NOT EXISTS `pelatihan_5_pascadiklat_atasan` (
  `atasan_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `alumni_id` bigint unsigned NOT NULL,
  `pegawai_id` bigint unsigned NOT NULL,
  `pelatihan_id` bigint unsigned DEFAULT NULL,
  `status_penilaian` enum('belum_dinilai','sudah_dinilai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_dinilai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`atasan_id`),
  KEY `pelatihan_5_pascadiklat_atasan_alumni_id_index` (`alumni_id`),
  KEY `pelatihan_5_pascadiklat_atasan_pegawai_id_index` (`pegawai_id`),
  KEY `pelatihan_5_pascadiklat_atasan_pelatihan_id_foreign` (`pelatihan_id`),
  CONSTRAINT `pelatihan_5_pascadiklat_atasan_alumni_id_foreign` FOREIGN KEY (`alumni_id`) REFERENCES `pelatihan_5_pascadiklat_alumni` (`alumni_id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_atasan_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `ref_pegawais` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_atasan_pelatihan_id_foreign` FOREIGN KEY (`pelatihan_id`) REFERENCES `ref_namapelatihans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pascadiklat_atasan: ~0 rows (approximately)
INSERT INTO `pelatihan_5_pascadiklat_atasan` (`atasan_id`, `alumni_id`, `pegawai_id`, `pelatihan_id`, `status_penilaian`, `created_at`, `updated_at`) VALUES
	(1, 1, 4, 1, 'belum_dinilai', '2026-02-07 00:56:13', '2026-02-07 00:56:13');

-- Dumping structure for table bkpsdm.pelatihan_5_pascadiklat_jawaban
CREATE TABLE IF NOT EXISTS `pelatihan_5_pascadiklat_jawaban` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pegawai_id` bigint unsigned NOT NULL,
  `alumni_id` bigint unsigned DEFAULT NULL,
  `kuesioner_id` bigint unsigned NOT NULL,
  `pertanyaan_id` bigint unsigned NOT NULL,
  `opsi_jawaban_id` bigint unsigned DEFAULT NULL,
  `jawaban_teks` text COLLATE utf8mb4_unicode_ci,
  `pelatihan_id` bigint unsigned DEFAULT NULL,
  `role_pengisi` enum('alumni','atasan','rekan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengisian` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pelatihan_5_pascadiklat_jawaban_pertanyaan_id_foreign` (`pertanyaan_id`),
  KEY `pelatihan_5_pascadiklat_jawaban_opsi_jawaban_id_foreign` (`opsi_jawaban_id`),
  KEY `pelatihan_5_pascadiklat_jawaban_pelatihan_id_foreign` (`pelatihan_id`),
  KEY `pelatihan_5_pascadiklat_jawaban_pegawai_id_kuesioner_id_index` (`pegawai_id`,`kuesioner_id`),
  KEY `pelatihan_5_pascadiklat_jawaban_kuesioner_id_pertanyaan_id_index` (`kuesioner_id`,`pertanyaan_id`),
  KEY `pelatihan_5_pascadiklat_jawaban_alumni_id_foreign` (`alumni_id`),
  CONSTRAINT `pelatihan_5_pascadiklat_jawaban_alumni_id_foreign` FOREIGN KEY (`alumni_id`) REFERENCES `ref_pegawais` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pelatihan_5_pascadiklat_jawaban_kuesioner_id_foreign` FOREIGN KEY (`kuesioner_id`) REFERENCES `pelatihan_5_pascadiklat_kuesioner` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_jawaban_opsi_jawaban_id_foreign` FOREIGN KEY (`opsi_jawaban_id`) REFERENCES `pelatihan_5_pascadiklat_opsi_jawaban` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_jawaban_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `ref_pegawais` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_jawaban_pelatihan_id_foreign` FOREIGN KEY (`pelatihan_id`) REFERENCES `ref_namapelatihans` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_jawaban_pertanyaan_id_foreign` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pelatihan_5_pascadiklat_pertanyaan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pascadiklat_jawaban: ~15 rows (approximately)
INSERT INTO `pelatihan_5_pascadiklat_jawaban` (`id`, `pegawai_id`, `alumni_id`, `kuesioner_id`, `pertanyaan_id`, `opsi_jawaban_id`, `jawaban_teks`, `pelatihan_id`, `role_pengisi`, `tanggal_pengisian`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1, 1, NULL, NULL, 'alumni', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(2, 1, 1, 1, 2, 6, NULL, NULL, 'alumni', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(3, 1, 1, 1, 3, NULL, 'Setelah mengikuti pelatihan, saya dapat menerapkan konsep manajemen waktu yang lebih efektif dalam menyelesaikan tugas-tugas harian. Saya juga lebih memahami cara berkomunikasi yang baik dengan tim.', NULL, 'alumni', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(4, 1, 1, 1, 4, NULL, 'ya', NULL, 'alumni', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(5, 4, 1, 2, 5, 12, NULL, NULL, 'atasan', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(6, 4, 1, 2, 6, 17, NULL, NULL, 'atasan', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(7, 4, 1, 2, 7, NULL, 'Alumni menunjukkan peningkatan dalam hal ketepatan waktu penyelesaian laporan dan kualitas analisis yang lebih mendalam. Komunikasi dengan tim juga menjadi lebih efektif.', NULL, 'atasan', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(8, 4, 1, 2, 8, NULL, 'ya', NULL, 'atasan', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(9, 6, 1, 3, 9, 22, NULL, NULL, 'rekan', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(10, 6, 1, 3, 10, 27, NULL, NULL, 'rekan', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(11, 6, 1, 3, 11, NULL, 'Rekan ini menjadi lebih proaktif dalam memberikan saran dan solusi untuk permasalahan tim. Juga lebih terbuka untuk berbagi pengetahuan baru yang didapat dari pelatihan.', NULL, 'rekan', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(12, 6, 1, 3, 12, NULL, 'ya', NULL, 'rekan', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(13, 2, 2, 1, 1, 2, NULL, NULL, 'alumni', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(14, 2, 2, 1, 2, 5, NULL, NULL, 'alumni', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(15, 2, 2, 1, 3, NULL, 'Pelatihan membantu saya memahami pentingnya analisis data dalam pengambilan keputusan. Sekarang saya lebih sistematis dalam menyusun laporan dan presentasi.', NULL, 'alumni', '2026-02-06 23:31:56', '2026-02-06 23:31:56', '2026-02-06 23:31:56'),
	(16, 1, NULL, 2, 4, 10, NULL, 1, 'alumni', '2026-02-07 00:56:27', '2026-02-07 00:56:27', '2026-02-07 00:56:27'),
	(17, 1, NULL, 2, 5, NULL, 'Tida Ada', 1, 'alumni', '2026-02-07 00:56:27', '2026-02-07 00:56:27', '2026-02-07 00:56:27');

-- Dumping structure for table bkpsdm.pelatihan_5_pascadiklat_kuesioner
CREATE TABLE IF NOT EXISTS `pelatihan_5_pascadiklat_kuesioner` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `role_target` enum('alumni','atasan','rekan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pascadiklat_kuesioner: ~6 rows (approximately)
INSERT INTO `pelatihan_5_pascadiklat_kuesioner` (`id`, `judul`, `deskripsi`, `role_target`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 'Evaluasi Kepuasan Alumni Pascadiklat', 'Kuesioner untuk mengukur tingkat kepuasan alumni terhadap pelatihan yang telah diikuti', 'alumni', 1, '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 'Evaluasi Implementasi Ilmu Alumni', 'Kuesioner untuk mengukur sejauh mana alumni mengimplementasikan ilmu yang diperoleh dari pelatihan', 'alumni', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(3, 'Evaluasi Kinerja Alumni oleh Atasan', 'Kuesioner untuk menilai perubahan kinerja alumni setelah mengikuti pelatihan', 'atasan', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(4, 'Evaluasi Kontribusi Alumni dalam Tim', 'Kuesioner untuk menilai kontribusi alumni terhadap tim dan organisasi setelah pelatihan', 'atasan', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(5, 'Evaluasi Kolaborasi dengan Alumni', 'Kuesioner untuk menilai kemampuan kolaborasi dan kerjasama alumni setelah pelatihan', 'rekan', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(6, 'Evaluasi Soft Skills Alumni', 'Kuesioner untuk menilai perkembangan soft skills alumni setelah mengikuti pelatihan', 'rekan', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54');

-- Dumping structure for table bkpsdm.pelatihan_5_pascadiklat_opsi_jawaban
CREATE TABLE IF NOT EXISTS `pelatihan_5_pascadiklat_opsi_jawaban` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pertanyaan_id` bigint unsigned NOT NULL,
  `teks_opsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_opsi_pertanyaan` (`pertanyaan_id`),
  CONSTRAINT `fk_opsi_pertanyaan` FOREIGN KEY (`pertanyaan_id`) REFERENCES `pelatihan_5_pascadiklat_pertanyaan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pascadiklat_opsi_jawaban: ~57 rows (approximately)
INSERT INTO `pelatihan_5_pascadiklat_opsi_jawaban` (`id`, `pertanyaan_id`, `teks_opsi`, `urutan`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Sangat Tidak Puas', 1, '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 1, 'Tidak Puas', 2, '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(3, 1, 'Cukup Puas', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(4, 1, 'Puas', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(5, 1, 'Sangat Puas', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(6, 2, 'Sangat membantu', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(7, 2, 'Cukup membantu', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(8, 2, 'Sedikit membantu', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(9, 2, 'Tidak membantu', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(10, 4, 'Ya, sudah diterapkan sepenuhnya', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(11, 4, 'Ya, sudah diterapkan sebagian', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(12, 4, 'Baru mulai menerapkan', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(13, 4, 'Belum diterapkan', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(14, 5, 'Kurangnya dukungan dari atasan', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(15, 5, 'Keterbatasan waktu', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(16, 5, 'Kurangnya fasilitas pendukung', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(17, 5, 'Resistensi dari rekan kerja', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(18, 5, 'Tidak ada kendala', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(19, 6, 'Sangat Tidak Puas', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(20, 6, 'Tidak Puas', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(21, 6, 'Cukup Puas', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(22, 6, 'Puas', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(23, 6, 'Sangat Puas', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(24, 7, 'Ya, sangat terlihat penerapannya', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(25, 7, 'Ya, cukup terlihat', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(26, 7, 'Sedikit terlihat', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(27, 7, 'Tidak terlihat', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(28, 9, 'Sangat Tidak Berkontribusi', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(29, 9, 'Tidak Berkontribusi', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(30, 9, 'Cukup Berkontribusi', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(31, 9, 'Berkontribusi', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(32, 9, 'Sangat Berkontribusi', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(33, 10, 'Kemampuan teknis', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(34, 10, 'Kemampuan komunikasi', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(35, 10, 'Kemampuan leadership', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(36, 10, 'Kemampuan analisis', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(37, 10, 'Tidak ada peningkatan', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(38, 11, 'Sangat Buruk', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(39, 11, 'Buruk', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(40, 11, 'Cukup Baik', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(41, 11, 'Baik', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(42, 11, 'Sangat Baik', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(43, 12, 'Ya, selalu berbagi dengan antusias', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(44, 12, 'Ya, sering berbagi', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(45, 12, 'Kadang-kadang berbagi', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(46, 12, 'Jarang berbagi', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(47, 12, 'Tidak pernah berbagi', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(48, 14, 'Sangat Buruk', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(49, 14, 'Buruk', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(50, 14, 'Cukup Baik', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(51, 14, 'Baik', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(52, 14, 'Sangat Baik', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(53, 15, 'Kemampuan presentasi', 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(54, 15, 'Kemampuan negosiasi', 2, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(55, 15, 'Kemampuan problem solving', 3, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(56, 15, 'Kemampuan adaptasi', 4, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(57, 15, 'Kemampuan kepemimpinan', 5, '2026-02-06 23:31:54', '2026-02-06 23:31:54');

-- Dumping structure for table bkpsdm.pelatihan_5_pascadiklat_pelatihan_kuesioner
CREATE TABLE IF NOT EXISTS `pelatihan_5_pascadiklat_pelatihan_kuesioner` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pelatihan_id` bigint unsigned NOT NULL,
  `kuesioner_id` bigint unsigned NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `p5_pasca_pel_kues_unique` (`pelatihan_id`,`kuesioner_id`),
  KEY `pelatihan_5_pascadiklat_pelatihan_kuesioner_kuesioner_id_foreign` (`kuesioner_id`),
  CONSTRAINT `pelatihan_5_pascadiklat_pelatihan_kuesioner_kuesioner_id_foreign` FOREIGN KEY (`kuesioner_id`) REFERENCES `pelatihan_5_pascadiklat_kuesioner` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_pelatihan_kuesioner_pelatihan_id_foreign` FOREIGN KEY (`pelatihan_id`) REFERENCES `ref_namapelatihans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pascadiklat_pelatihan_kuesioner: ~0 rows (approximately)
INSERT INTO `pelatihan_5_pascadiklat_pelatihan_kuesioner` (`id`, `pelatihan_id`, `kuesioner_id`, `tanggal_mulai`, `tanggal_selesai`, `is_active`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, NULL, NULL, 1, '2026-02-07 00:55:26', '2026-02-07 00:55:26');

-- Dumping structure for table bkpsdm.pelatihan_5_pascadiklat_pertanyaan
CREATE TABLE IF NOT EXISTS `pelatihan_5_pascadiklat_pertanyaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kuesioner_id` bigint unsigned NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('pilihan_ganda','pertanyaan_singkat','ya_tidak','skala_likert','teks_panjang','checkbox') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `wajib` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pertanyaan_kuesioner` (`kuesioner_id`),
  CONSTRAINT `fk_pertanyaan_kuesioner` FOREIGN KEY (`kuesioner_id`) REFERENCES `pelatihan_5_pascadiklat_kuesioner` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pascadiklat_pertanyaan: ~16 rows (approximately)
INSERT INTO `pelatihan_5_pascadiklat_pertanyaan` (`id`, `kuesioner_id`, `pertanyaan`, `jenis`, `urutan`, `wajib`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Bagaimana tingkat kepuasan Anda terhadap materi pelatihan yang diberikan?', 'skala_likert', 1, 1, '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 1, 'Sejauh mana pelatihan ini membantu meningkatkan kemampuan kerja Anda?', 'pilihan_ganda', 2, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(3, 1, 'Saran dan masukan untuk perbaikan pelatihan ke depan:', 'teks_panjang', 3, 0, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(4, 2, 'Apakah Anda sudah menerapkan ilmu dari pelatihan dalam pekerjaan sehari-hari?', 'pilihan_ganda', 1, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(5, 2, 'Kendala apa saja yang Anda hadapi dalam menerapkan ilmu dari pelatihan? (Boleh pilih lebih dari satu)', 'checkbox', 2, 0, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(6, 3, 'Bagaimana penilaian Anda terhadap peningkatan kinerja alumni setelah mengikuti pelatihan?', 'skala_likert', 1, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(7, 3, 'Apakah alumni menunjukkan penerapan ilmu dari pelatihan dalam tugasnya?', 'pilihan_ganda', 2, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(8, 3, 'Catatan khusus tentang perkembangan alumni:', 'teks_panjang', 3, 0, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(9, 4, 'Seberapa besar kontribusi alumni terhadap pencapaian target tim?', 'skala_likert', 1, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(10, 4, 'Aspek mana yang paling meningkat pada alumni setelah pelatihan?', 'pilihan_ganda', 2, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(11, 5, 'Bagaimana penilaian Anda terhadap kemampuan kerjasama alumni dalam tim?', 'skala_likert', 1, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(12, 5, 'Apakah alumni berbagi pengetahuan dari pelatihan kepada rekan kerja?', 'pilihan_ganda', 2, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(13, 5, 'Aspek positif apa yang Anda amati dari alumni setelah pelatihan?', 'teks_panjang', 3, 0, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(14, 6, 'Bagaimana penilaian Anda terhadap kemampuan komunikasi alumni?', 'skala_likert', 1, 1, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(15, 6, 'Kemampuan apa yang paling terlihat perubahannya pada alumni? (Boleh pilih lebih dari satu)', 'checkbox', 2, 0, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(16, 6, 'Saran untuk pengembangan alumni selanjutnya:', 'teks_panjang', 3, 0, '2026-02-06 23:31:54', '2026-02-06 23:31:54');

-- Dumping structure for table bkpsdm.pelatihan_5_pascadiklat_rekankerja
CREATE TABLE IF NOT EXISTS `pelatihan_5_pascadiklat_rekankerja` (
  `rekankerja_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `alumni_id` bigint unsigned NOT NULL,
  `pegawai_id` bigint unsigned NOT NULL,
  `pelatihan_id` bigint unsigned DEFAULT NULL,
  `status_penilaian` enum('belum_dinilai','sudah_dinilai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_dinilai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rekankerja_id`),
  UNIQUE KEY `pelatihan_5_pascadiklat_rekankerja_alumni_id_unique` (`alumni_id`),
  KEY `pelatihan_5_pascadiklat_rekankerja_alumni_id_index` (`alumni_id`),
  KEY `pelatihan_5_pascadiklat_rekankerja_pegawai_id_index` (`pegawai_id`),
  KEY `pelatihan_5_pascadiklat_rekankerja_pelatihan_id_foreign` (`pelatihan_id`),
  CONSTRAINT `pelatihan_5_pascadiklat_rekankerja_alumni_id_foreign` FOREIGN KEY (`alumni_id`) REFERENCES `pelatihan_5_pascadiklat_alumni` (`alumni_id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_rekankerja_pegawai_id_foreign` FOREIGN KEY (`pegawai_id`) REFERENCES `ref_pegawais` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pelatihan_5_pascadiklat_rekankerja_pelatihan_id_foreign` FOREIGN KEY (`pelatihan_id`) REFERENCES `ref_namapelatihans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pascadiklat_rekankerja: ~0 rows (approximately)
INSERT INTO `pelatihan_5_pascadiklat_rekankerja` (`rekankerja_id`, `alumni_id`, `pegawai_id`, `pelatihan_id`, `status_penilaian`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, 1, 'belum_dinilai', '2026-02-07 00:56:13', '2026-02-07 00:56:13');

-- Dumping structure for table bkpsdm.pelatihan_5_pertanyaan
CREATE TABLE IF NOT EXISTS `pelatihan_5_pertanyaan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_jenispelatihan` enum('JP001','JP002','JP003','JP004') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kategoripertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.pelatihan_5_pertanyaan: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.profile_akpk
CREATE TABLE IF NOT EXISTS `profile_akpk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_kerja` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip_atasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_atasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_atasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profile_akpk_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.profile_akpk: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.ref_golongans
CREATE TABLE IF NOT EXISTS `ref_golongans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_asn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat_golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_golongans: ~9 rows (approximately)
INSERT INTO `ref_golongans` (`id`, `kode_golongan`, `jenis_asn`, `golongan`, `pangkat`, `pangkat_golongan`, `created_at`, `updated_at`) VALUES
	(1, 'PNS001', 'PNS', 'IV/e', 'Pembina Utama', 'Pembina Utama (IV/e)', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 'PNS002', 'PNS', 'IV/d', 'Pembina Utama Madya', 'Pembina Utama Madya (IV/d)', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(3, 'PNS003', 'PNS', 'IV/c', 'Pembina Utama Muda', 'Pembina Utama Muda (IV/c)', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(4, 'PNS004', 'PNS', 'IV/b', 'Pembina Tk. I', 'Pembina Tk. I (IV/b)', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(5, 'PNS004', 'PNS', 'IV/b', 'Pembina Tk. I', 'Pembina Tk. I (IV/b)', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(6, 'PNS005', 'PNS', 'IV/a', 'Pembina', 'Pembina (IV/a)', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(7, 'PNS006', 'PNS', 'III/d', 'Penata Tk. I', 'Penata Tk. I (III/d)', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(8, 'PNS007', 'PNS', 'III/c', 'Penata', 'Penata (III/c)', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(9, 'PNS008', 'PNS', 'III/b', 'Penata Muda Tk. I', 'Penata Muda Tk. I (III/b)', '2026-02-06 23:31:53', '2026-02-06 23:31:53');

-- Dumping structure for table bkpsdm.ref_jenisasns
CREATE TABLE IF NOT EXISTS `ref_jenisasns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_jenisasn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_asn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_jenisasns: ~2 rows (approximately)
INSERT INTO `ref_jenisasns` (`id`, `kode_jenisasn`, `jenis_asn`, `created_at`, `updated_at`) VALUES
	(1, 'JA001', 'PNS', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 'JA002', 'PPPK', '2026-02-06 23:31:53', '2026-02-06 23:31:53');

-- Dumping structure for table bkpsdm.ref_jenispelatihans
CREATE TABLE IF NOT EXISTS `ref_jenispelatihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_jenispelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_jenispelatihans: ~4 rows (approximately)
INSERT INTO `ref_jenispelatihans` (`id`, `kode_jenispelatihan`, `jenis_pelatihan`, `created_at`, `updated_at`) VALUES
	(1, 'JP001', 'Diklat Dasar', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 'JP002', 'Diklat Fungsional', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(3, 'JP0033', 'Diklat Struktural', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(4, 'JP004', 'Diklat Teknis', '2026-02-06 23:31:53', '2026-02-06 23:31:53');

-- Dumping structure for table bkpsdm.ref_kategorijabatans
CREATE TABLE IF NOT EXISTS `ref_kategorijabatans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_kategorijabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_kategorijabatans: ~4 rows (approximately)
INSERT INTO `ref_kategorijabatans` (`id`, `kode_kategorijabatan`, `kategori_jabatan`, `created_at`, `updated_at`) VALUES
	(1, 'KJ001', 'Esselon II', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 'KJ002', 'Esselon III', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(3, 'KJ003', 'Esselon IV', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(4, 'KJ004', 'Pelaksana', '2026-02-06 23:31:53', '2026-02-06 23:31:53');

-- Dumping structure for table bkpsdm.ref_metodepelatihans
CREATE TABLE IF NOT EXISTS `ref_metodepelatihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_metodepelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_metodepelatihans: ~3 rows (approximately)
INSERT INTO `ref_metodepelatihans` (`id`, `kode_metodepelatihan`, `metode_pelatihan`, `created_at`, `updated_at`) VALUES
	(1, 'MP001', 'Blended Learning', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 'MP002', 'E-Learning', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(3, 'MP003', 'Klasikal', '2026-02-06 23:31:53', '2026-02-06 23:31:53');

-- Dumping structure for table bkpsdm.ref_namajabatanasns
CREATE TABLE IF NOT EXISTS `ref_namajabatanasns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_jabatanasn` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatanasn` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_jabatanasn` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_namajabatanasns: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.ref_namapelatihans
CREATE TABLE IF NOT EXISTS `ref_namapelatihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis_pelatihan_id` bigint unsigned NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_namapelatihans_jenis_pelatihan_id_index` (`jenis_pelatihan_id`),
  CONSTRAINT `ref_namapelatihans_jenis_pelatihan_id_foreign` FOREIGN KEY (`jenis_pelatihan_id`) REFERENCES `ref_jenispelatihans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_namapelatihans: ~0 rows (approximately)
INSERT INTO `ref_namapelatihans` (`id`, `jenis_pelatihan_id`, `nama_pelatihan`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Bahasa Inggris', '2026-02-07 00:34:24', '2026-02-07 00:34:24');

-- Dumping structure for table bkpsdm.ref_namapenyelenggaras
CREATE TABLE IF NOT EXISTS `ref_namapenyelenggaras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_namapenyelenggaras: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.ref_pegawais
CREATE TABLE IF NOT EXISTS `ref_pegawais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nip` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pangkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_asn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_jabatanasn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_unitkerja` bigint unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmt` date NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_atasan` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_pegawais: ~8 rows (approximately)
INSERT INTO `ref_pegawais` (`id`, `nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `pangkat`, `golongan`, `jabatan`, `jenis_asn`, `kategori_jabatanasn`, `kode_unitkerja`, `email`, `no_hp`, `alamat`, `tmt`, `foto`, `id_atasan`, `created_at`, `updated_at`) VALUES
	(1, 19850101, 'Budi Santoso', 'Jakarta', '1985-01-01', 'Penata Muda', 'III/a', 'Analis Kebijakan', 'PNS', 'Fungsional', 1, 'budi.santoso@bkpsdm.go.id', '081234567890', 'Jl. Merdeka No. 1', '2010-01-01', 'default.jpg', NULL, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(2, 19850202, 'Siti Rahayu', 'Bandung', '1985-02-02', 'Penata Muda', 'III/b', 'Analis SDM', 'PNS', 'Fungsional', 1, 'siti.rahayu@bkpsdm.go.id', '081234567891', 'Jl. Sudirman No. 2', '2010-01-01', 'default.jpg', NULL, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(3, 19850303, 'Ahmad Wijaya', 'Surabaya', '1985-03-03', 'Penata', 'III/c', 'Analis Kinerja', 'PNS', 'Fungsional', 1, 'ahmad.wijaya@bkpsdm.go.id', '081234567892', 'Jl. Diponegoro No. 3', '2010-01-01', 'default.jpg', NULL, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(4, 19750404, 'Dr. Indra Gunawan', 'Yogyakarta', '1975-04-04', 'Pembina', 'IV/a', 'Kepala Bagian Perencanaan', 'PNS', 'Struktural', 1, 'indra.gunawan@bkpsdm.go.id', '081234567893', 'Jl. Ahmad Yani No. 4', '2005-01-01', 'default.jpg', NULL, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(5, 19760505, 'Dra. Sari Wulandari', 'Semarang', '1976-05-05', 'Pembina', 'IV/a', 'Kepala Bagian Pengembangan SDM', 'PNS', 'Struktural', 1, 'sari.wulandari@bkpsdm.go.id', '081234567894', 'Jl. Pahlawan No. 5', '2005-01-01', 'default.jpg', NULL, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(6, 19860606, 'Eko Prasetyo', 'Malang', '1986-06-06', 'Penata Muda', 'III/b', 'Analis Pelatihan', 'PNS', 'Fungsional', 1, 'eko.prasetyo@bkpsdm.go.id', '081234567895', 'Jl. Kartini No. 6', '2010-01-01', 'default.jpg', NULL, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(7, 19870707, 'Maya Sari', 'Bogor', '1987-07-07', 'Penata Muda', 'III/a', 'Analis Kompetensi', 'PNS', 'Fungsional', 1, 'maya.sari@bkpsdm.go.id', '081234567896', 'Jl. Imam Bonjol No. 7', '2010-01-01', 'default.jpg', NULL, '2026-02-06 23:31:54', '2026-02-06 23:31:54'),
	(8, 19880808, 'Rizki Ramadhan', 'Depok', '1988-08-08', 'Penata Muda', 'III/a', 'Analis Mutasi', 'PNS', 'Fungsional', 1, 'rizki.ramadhan@bkpsdm.go.id', '081234567897', 'Jl. Thamrin No. 8', '2010-01-01', 'default.jpg', NULL, '2026-02-06 23:31:54', '2026-02-06 23:31:54');

-- Dumping structure for table bkpsdm.ref_pelaksanaanpelatihans
CREATE TABLE IF NOT EXISTS `ref_pelaksanaanpelatihans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_pelaksanaanpelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelaksanaan_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_pelaksanaanpelatihans: ~3 rows (approximately)
INSERT INTO `ref_pelaksanaanpelatihans` (`id`, `kode_pelaksanaanpelatihan`, `pelaksanaan_pelatihan`, `created_at`, `updated_at`) VALUES
	(1, 'PP001', 'Pengiriman', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(2, 'PP002', 'Penyelenggaraan', '2026-02-06 23:31:53', '2026-02-06 23:31:53'),
	(3, 'PP003', 'Kerjasama', '2026-02-06 23:31:53', '2026-02-06 23:31:53');

-- Dumping structure for table bkpsdm.ref_unitkerjas
CREATE TABLE IF NOT EXISTS `ref_unitkerjas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.ref_unitkerjas: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.sessions: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.solowasis_1_infos
CREATE TABLE IF NOT EXISTS `solowasis_1_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `info_solowasis` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_solowasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_solowasis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.solowasis_1_infos: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.solowasis_2_daftarlatsolowases
CREATE TABLE IF NOT EXISTS `solowasis_2_daftarlatsolowases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tahun` year NOT NULL,
  `nama_pelatihan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_jp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_peserta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.solowasis_2_daftarlatsolowases: ~0 rows (approximately)

-- Dumping structure for table bkpsdm.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `pegawai_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table bkpsdm.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `pegawai_id`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Admin System', 'admin@bkpsdm.go.id', NULL, '$2y$12$mXSh7t80FtwV3oDWJK52Z.R4Nq6NB24yTLEZccNgPRJvwKgPUM0LS', 'admin', NULL, NULL, '2026-02-06 23:31:55', '2026-02-06 23:31:55'),
	(2, 'Budi Santoso', 'budi.santoso@bkpsdm.go.id', NULL, '$2y$12$hkMmg1lZl6S0PWsWJcVJ5edx8SI3472T7Jr2d.UsOhHxxPUhgLw66', 'alumni', 1, NULL, '2026-02-06 23:31:55', '2026-02-06 23:31:55'),
	(3, 'Siti Rahayu', 'siti.rahayu@bkpsdm.go.id', NULL, '$2y$12$6mNx80BTURj7ZIHIP9Lwue8lylF6CS3dQfTO0AqpjRZq21FQsZLFq', 'alumni', 2, NULL, '2026-02-06 23:31:55', '2026-02-06 23:31:55'),
	(4, 'Dr. Indra Gunawan', 'indra.gunawan@bkpsdm.go.id', NULL, '$2y$12$jeCYyZsA9nFk1s2qYK/6QeLCHedcuoc4T37F0ORCSj4xvRKi5kAJa', 'atasan', 4, NULL, '2026-02-06 23:31:55', '2026-02-06 23:31:55'),
	(5, 'Eko Prasetyo', 'eko.prasetyo@bkpsdm.go.id', NULL, '$2y$12$fhnPcvj7TSd5Z0ussm/TmeSpRpjr8fQRZ96OndUixSPpWWRz/21Cy', 'rekan_kerja', 6, NULL, '2026-02-06 23:31:56', '2026-02-06 23:31:56');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
