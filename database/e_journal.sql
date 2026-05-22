-- Skema database E-Jurnal UNPATTI
-- Database: jurnal-elektronik
-- Impor: mysql -u root jurnal-elektronik < database/e_journal.sql

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `jurnal-elektronik`
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `jurnal-elektronik`;

-- --------------------------------------------------------
-- Tabel: jurnal
-- --------------------------------------------------------

DROP TABLE IF EXISTS `jurnal`;
CREATE TABLE IF NOT EXISTS `jurnal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pengarang` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int NOT NULL,
  `volume` int NOT NULL,
  `no` int NOT NULL,
  `halaman` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Tabel: pengguna
-- --------------------------------------------------------

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `peran` enum('admin','petugas') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'petugas',
  `dibuat_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Data awal
-- Akun default: username admin, kata sandi admin123
-- --------------------------------------------------------

INSERT INTO `pengguna` (`nama`, `username`, `password`, `peran`) VALUES
('Administrator', 'admin', '$2y$12$VIZUSE8pQ7OKLsI8Xzw1Z.3J1DpTYGOUOULcPhANp97BB4.dkKXMu', 'admin');

-- --------------------------------------------------------
-- Data jurnal contoh (20 artikel dari sumber resmi OJS UNPATTI)
-- Sumber: https://ojs3.unpatti.ac.id (JENDELA PENGETAHUAN, BAREKENG, RUMPHIUS)
-- Berkas PDF placeholder; unduh asli dari portal OJS masing-masing artikel.
-- --------------------------------------------------------

INSERT INTO `jurnal` (`judul`, `pengarang`, `tahun`, `volume`, `no`, `halaman`, `file`) VALUES
('Peranan Guru Geografi untuk Meningkatkan Kedisiplinan dan Tingkat Kesedaran Peserta Didik di SMPN 10 Kayu Putih Kota Ambon', 'Sartila Aufat; Ferdinand Salomo Leuwol; Susan Evelin Manakane', 2025, 19, 1, '1-10', 'jurnal-unpatti-001.pdf'),
('Dampak Kehadiran Minimarket terhadap Pendapatan Kios Kecil di Desa Piru Kecamatan Seram Barat Kabupaten Seram Bagian Barat (SBB)', 'Helena Sahetapy; Melianus Salakory; Susan Evelin Manakane', 2025, 19, 1, '11-23', 'jurnal-unpatti-002.pdf'),
('Kajian Peran Masyarakat dalam Pengelolaan Sumber Daya Alam di Kawasan Desa Hatu Kecamatan Leihitu Barat Kabupaten Maluku Tengah', 'Maria Lidwina Matly; Daniel Anthoni Sihasale; Mohammad Amin Lasaiba', 2025, 19, 1, '24-34', 'jurnal-unpatti-003.pdf'),
('Optimalisasi Sanitasi Lingkungan di Pasar Mardika Kota Ambon', 'Sundari Mane; Robert Berthy Riry; Susan Evelin Manakane', 2025, 19, 1, '35-46', 'jurnal-unpatti-004.pdf'),
('Pengembangan Wisata Pantai Namasua di Negeri Naku Kecamatan Leitimur Selatan Kota Ambon', 'Cornelia M Labery; Rafael Marthinus Osok; Robert Berthy Riry', 2025, 19, 1, '47-62', 'jurnal-unpatti-005.pdf'),
('Tanjung Burung Maleo dalam Tatanan Adat Negeri Kailolo Kecamatan Pulau Haruku Kabupaten Maluku Tengah Provinsi Maluku', 'Nurlaila Tuanany; Edward Gland Tetelepta; Mohammad Amin Lasaiba', 2025, 19, 1, '63-73', 'jurnal-unpatti-006.pdf'),
('Peningkatan Motivasi Belajar Ips Melalui Model Pembelajaran Kooperatif Tipe Jigsaw Pada Siswa Kelas Vii Smp Negeri 31 Seram Bagian Timur', 'Sarjono Rumida; Melianus Salakory; Ferdinand Salomo Leuwol', 2025, 19, 1, '74-86', 'jurnal-unpatti-007.pdf'),
('Peran dan Statregi Guru dalam Meningkatkan Literasi Digital Siswa di Sma Negeri 10 Seram Bagian Timur', 'Ida Royani Rumodar; Mohammad Amin Lasaiba; Edward Gland Tetelepta', 2025, 19, 1, '87-99', 'jurnal-unpatti-008.pdf'),
('Pengembangan Karya Lokal Kain Tenun untuk Pemenuhan Kebutuhan Rumah Tangga di Desa Atubul Dol Kecamatan Wertambrian Kabupaten Kepulauan Tanimbar', 'Maria M. Ngoranmele; Wiclif Sephnath Pinoa; Robert Berthy Riry', 2025, 19, 1, '100-109', 'jurnal-unpatti-009.pdf'),
('Aktivitas Nelayan dan Kondisi Ekonomi di Desa Sesar Kecamatan Bula Kabupaten Seram Bagian Timur', 'Yati Kocal; Wiclif Sephnath Pinoa; Daniel Anthoni Sihasale', 2025, 19, 1, '110-119', 'jurnal-unpatti-010.pdf'),
('LSTM AND GRU IN RICE PREDICTION FOR FOOD SECURITY IN INDONESIA', 'Triyani Hendrawati; Kennedy Marthendra; Brian Riski Jayama Simanjuntak; Anindya Aprilianti Pravitasari', 2025, 20, 1, '55-68', 'jurnal-unpatti-011.pdf'),
('STRUCTURAL EQUATION MODELING ANALYSIS ON POVERTY IN WEST KALIMANTAN WITH FINITE MIXTURE IN PARTIAL LEAST SQUARE APPROACH', 'Muhammad Fauzan; Hendra Perdana; Neva Satyahadewi', 2025, 20, 1, '1-16', 'jurnal-unpatti-012.pdf'),
('COMPARISON OF CLUSTERING EARTHQUAKE PRONE AREA IN SUMATRA ISLAND USING K-MEANS AND SELF-ORGANIZING MAPS', 'Faradilla Ardiyani; Winita Sulandari; Yuliana Susanti', 2025, 20, 1, '17-30', 'jurnal-unpatti-013.pdf'),
('GRAPH ENERGY OF THE COPRIME GRAPH ON GENERALIZED QUATERNION GROUP', 'Miftahurrahman; I Gede Adhitya Wisnu Wardhana; Nur Idayu Alimon; Nor Haniza Sarmin', 2025, 20, 1, '31-40', 'jurnal-unpatti-014.pdf'),
('PARTIAL LEAST SQUARES - MULTIGROUP ANALYSIS ON THE EFFECT OF LEADERSHIP ON WORK CULTURE AND LECTURER PERFORMANCE', 'Hairur Rahman; Angga Dwi Mulyanto; Sri Harini; Fachrur Rozi', 2025, 20, 1, '41-54', 'jurnal-unpatti-015.pdf'),
('THE GENERALIZED SPACE-TIME ARIMA (GSTARIMA) MODEL FOR PREDICTING NITROGEN MONOXIDE TO MITIGATE EID AL-FITR AIR POLLUTION IN SURABAYA', 'Hani Khaulasari; Dian Candra Rini Novitasari; Maunah Setyawati; Jeneiro Maulana', 2025, 20, 1, '69-86', 'jurnal-unpatti-016.pdf'),
('Morphological Characteristics and Abundance of Bacteria in Fried Snack Foods from the Pujasera Canteen, Universitas Pattimura', 'Merry Pattipeilohy; Ferymon Mahulette; Alamanda Pelamonia', 2026, 8, 1, '39-46', 'jurnal-unpatti-017.pdf'),
('Analysis Proximate of Nerita costata and Nerita maxima Collected from Hutumuri and Latuhalat Beaches in Ambon, Maluku, Indonesia', 'Rafdin; Sintje Liline; Sriyanti Imelda Aksamina Salmanu', 2026, 8, 1, '1-6', 'jurnal-unpatti-018.pdf'),
('Analysis Antioxidant of Clove Leaves (Syzygium aromaticum) as a Source of Bioactive Compounds', 'Syahran Wael; Ine Arini; Marike Muskita; Heinrich Rakuasa', 2026, 8, 1, '47-54', 'jurnal-unpatti-019.pdf'),
('Effectiveness of Sea Cucumber (Holothuria atra) Extract Ointment from the Talaud Islands on Burn Wound Healing in Mice (Mus musculus)', 'Trivena Vannesa Mumu; Verawati Ida Yani Roring; Nonny Manampiring', 2026, 8, 1, '61-70', 'jurnal-unpatti-020.pdf');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
