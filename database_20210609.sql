-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for surat-keluar
CREATE DATABASE IF NOT EXISTS `surat-keluar` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `surat-keluar`;

-- Dumping structure for table surat-keluar.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(4000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `group_category_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.categories: ~92 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `code`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`, `group_category_id`) VALUES
	(1, 'OT.00', 'ORGANISASI', 'Surat surat yang berhubungan dengan pembentukan, perubahan organisasi, uraian pekerjaan dan pembahasannya mulai dari awal sampai akhir dan jalur pertanggung jawabannya.', '2021-05-19 09:27:12', '2021-05-19 09:27:12', NULL, 1),
	(2, 'OT.01.1', 'PERENCANAAN', 'Surat surat yang berhubungan dengan penyusunan perencanaan / program kerja oleh unit-unit kerja Mahkamah Agung secara keseluruhan, termasuk segala jenis pertemuan dalam rangka penentuan kebijaksanaan perencanaan.', '2021-05-19 09:31:04', '2021-05-19 09:31:04', NULL, 1),
	(4, 'OT.01.2', 'LAPORAN', 'Surat surat yang berhubungan dengan laporan umum, monitoring, evaluasi dan unit kerja, baik laporan :\r\n\r\n- bulanan,\r\n\r\n- triwulan,\r\n- semester, dan\r\n- tahunan.', '2021-05-20 01:20:49', '2021-05-20 01:47:50', NULL, 1),
	(5, 'OT.01.3', 'PENYUSUNAN PROSEDUR KERJA', 'Surat-surat yang berkenaan dengan penyusunan sistem, prosedur, pedoman, petunjuk pelaksanaan, tata kerja dan hubungan kerja.', '2021-05-20 01:21:36', '2021-05-20 01:21:36', NULL, 1),
	(6, 'OT.01.4', 'PENYUSUNAN PEMBAKUAN SARANA KERJA', 'Surat-surat yang berhubungan dengan penyusunan pembakuan sarana kerja, yakni penentuan kualitas dan kuantitas yang meliputi :\r\n- ukuran,\r\n- jenis,\r\n- merek dan sebagainya.', '2021-05-20 01:22:50', '2021-05-20 01:58:23', NULL, 1),
	(7, 'HK.00', 'PERATURAN PERUNDANG-UNDANGAN', 'Surat-surat yang berkenaan dengan proses penyusunan peraturan perundang-undangan produk Mahkamah Agung, dari konsep / draf smpai selesai, maupun produk peraturan perundang-undangan yang diterima baik intern Mahkamah Agung maupun dari instansi lainnya.', '2021-05-20 01:25:51', '2021-05-20 01:25:51', NULL, 7),
	(8, 'HK.00.1', 'PERATURAN PERUNDANG-UNDANGAN', 'Undang-undang, termasuk PERPU', '2021-05-20 01:29:18', '2021-05-20 01:29:18', NULL, 7),
	(9, 'HK.00.2', 'PERATURAN PERUNDANG-UNDANGAN', 'Peraturan Pemerintah.', '2021-05-20 01:30:09', '2021-05-20 01:30:09', NULL, 7),
	(10, 'HK.00.3', 'PERATURAN PERUNDANG-UNDANGAN', 'Keputusan Presiden, Instruksi Presiden, Penetapan Presiden.', '2021-05-20 02:03:23', '2021-05-20 02:03:23', NULL, 7),
	(11, 'HK.00.4', 'PERATURAN PERUNDANG-UNDANGAN', 'Peraturan Ketua Mahkamah Agung RI.', '2021-05-20 02:03:57', '2021-05-20 02:03:57', NULL, 7),
	(12, 'HK.00.5', 'PERATURAN PERUNDANG-UNDANGAN', 'Keputusan Ketua Mahkamah Agung, Instruksi Mahkamah Agung.', '2021-05-20 02:04:29', '2021-05-20 02:04:29', NULL, 7),
	(13, 'HK.00.6', 'PERATURAN PERUNDANG-UNDANGAN', 'Keputusan Pejabat Eselon I.', '2021-05-20 02:04:57', '2021-05-20 02:04:57', NULL, 7),
	(14, 'HK.00.7', 'PERATURAN PERUNDANG-UNDANGAN', 'Surat Edaran Pejabat Eselon I.', '2021-05-20 02:08:20', '2021-05-20 02:08:20', NULL, 7),
	(15, 'HK.00.8', 'PERATURAN PERUNDANG-UNDANGAN', 'Peraturan Pengadilan Tingkat Banding dan Tingkat Pertama.', '2021-05-20 02:09:10', '2021-05-20 02:09:10', NULL, 7),
	(16, 'HK.00.9', 'PERATURAN PERUNDANG-UNDANGAN', 'Peraturan PEMDA Tk. I, dan PEMDA Tk. II.', '2021-05-20 02:12:23', '2021-05-20 02:12:23', NULL, 7),
	(17, 'HK.01', 'PIDANA', 'Surat-surat yang berkenaan dengan penyelesaian perkara pidana, baik pidana kejahatan maupun pidana pelanggaran.', '2021-05-20 02:17:24', '2021-05-20 02:17:24', NULL, 7),
	(18, 'HK.02', 'PERDATA', 'Surat-surat yang berkenaan dengan penyelesaian perkara perdata, baik gugatan maupun permohonan.', '2021-05-20 02:18:10', '2021-05-20 02:18:10', NULL, 7),
	(19, 'HK.03', 'PERDATA NIAGA', 'Surat-surat yang berkenaan dengan penyelesaian perkara perdata niaga.', '2021-05-20 02:18:42', '2021-05-20 02:18:42', NULL, 7),
	(20, 'HK.04', 'PIDANA MILITER', 'Surat-surat yang berkenaan dengan penyelesaian perkara pidana militer.', '2021-05-20 02:19:16', '2021-05-20 02:19:16', NULL, 7),
	(21, 'HK.05', 'PERDATA AGAMA', 'Surat-surat yang berkenaan dengan penyelesaian perkara perdata agama.', '2021-05-20 02:19:44', '2021-05-20 02:19:44', NULL, 7),
	(22, 'HK.06', 'TATA USAHA NEGARA', 'Surat-surat yang berkenaan dengan penyelesaian perkara Tata Usaha Negara.', '2021-05-20 02:20:20', '2021-05-20 02:20:20', NULL, 7),
	(23, 'HK.07', 'PIDANA KHUSUS', 'Surat-surat yang berkenaan dengan penyelesaian perkara pidana khusus.', '2021-05-20 02:20:57', '2021-05-20 02:20:57', NULL, 7),
	(24, 'HM.00', 'PENERANGAN', 'Surat-surat yang berkenaan dengan segala kegiatan penerangan terhadap masyarakat tentang kegiatan Mahkamah Agung RI, termasuk di dalamnya :\r\n- konferensi pers,\r\n- pameran,\r\n- wawancara,\r\n- dan penerangan dalam media massa lainnya.', '2021-05-20 02:23:14', '2021-05-20 02:23:14', NULL, 2),
	(25, 'HM.01', 'HUBUNGAN DAN KEPROTOKOLAN', '-', '2021-05-20 02:24:00', '2021-05-20 02:24:00', NULL, 2),
	(26, 'HM.01.1', 'HUBUNGAN', 'Surat-surat yang berhubungan dengan segala kegiatan intern Mahkamah Agung RI, dan antara Mahkamah Agung RI dengan pihak lain, baik dalam maupun luar negeri dalam bidang kehumasan, koordinasi, antara lain :\r\n- bakohumas,\r\n- hearing DPR,\r\n- kelompok kerja (POKJA),\r\n- dan organisasi-organisasi mass media.', '2021-05-20 02:25:27', '2021-05-20 02:25:27', NULL, 2),
	(27, 'HM.01.2', 'KEPROTOKOLAN', 'Surat-surat yang berkaan dengan masalah keprotokolan, seperti :\r\n- tamu-tamu pimpinan Mahkamah Agung RI baik dalam maupun luar negeri,\r\n- kunjungan kerja pimpinan dan pejabat Mahkamah Agung RI,\r\n- upacara hari nasional, dan\r\n- HUT Mahkamah Agung RI.', '2021-05-20 02:26:13', '2021-05-20 02:26:13', NULL, 2),
	(28, 'HM.02', 'DOKUMENTASI, KEPUSTAKAAN DAN TEKNOLOGI INFORMASI', '-', '2021-05-20 02:26:45', '2021-05-20 02:26:45', NULL, 2),
	(29, 'HM.02.1', 'DOKUMENTASI', 'Surat-surat yang berkenaan dengan kegiatan yang berhubungan dengan penyediaan / pengumpulan bahan / dokumentasi, termasuk penyebarannya.', '2021-05-20 02:27:27', '2021-05-20 02:27:27', NULL, 2),
	(30, 'HM.02.2', 'KEPUSTAKAAN', 'Surat-surat yang berkenaan dengan kegiatan yang berhubungan dengan penyediaan, pengumpulan, dan penataan bahan-bahan kepustakaan', '2021-05-20 02:27:59', '2021-05-20 02:27:59', NULL, 2),
	(31, 'HM.02.3', 'TEKNOLOGI INFORMASI', 'Surat-surat yang berkenaan dengan kegiatan yang berhubungan dengan perencanaan, penyediaan, pemeliharaan, pengelolaan dan hal-hal lain yang berkaitan dengan teknologi informasi.', '2021-05-20 02:31:08', '2021-05-20 02:31:08', NULL, 2),
	(32, 'KP', 'KEPEGAWAIAN', '-', '2021-05-20 02:31:57', '2021-05-21 01:35:59', '2021-05-21 01:35:59', 3),
	(33, 'KP.00', 'PENGADAAN', '-', '2021-05-20 02:32:32', '2021-05-20 02:32:32', NULL, 3),
	(34, 'KP.00.1', 'FORMASI', 'Surat-surat yang berkenaan dengan perencanaan pengadaan pegawai, nota usul formasi, sampai dengan persetujuan termasuk di dalamnya besetting.', '2021-05-20 02:36:00', '2021-05-20 02:36:00', NULL, 3),
	(35, 'KP.00.2', 'PENERIMAAN', 'Surat-surat yang berkenaan dengan penerimaan pegawai baru, mulai dari pengumuman penerimaan, panggilan testing / psikotes / clearance test, sampai dengan pengumuman yang diterima, termasuk di dalamnya pegawai honorer, seperti :\r\n- satpam,\r\n- pramusaji,\r\n- supir.', '2021-05-20 02:36:33', '2021-05-20 02:36:33', NULL, 3),
	(36, 'KP.00.3', 'PENGANGKATAN', 'Surat-surat yang berkenaan dengan seluruh proses pengangkatan, dan penempatan calon pegawai (CPNS) sampai dengan menjadi pegawai (PNS), mulai dari persyaratan, pemeriksaan kesehatan dan keterangan-keterangan lainnya yang berhubungan dengan pengangkatan.', '2021-05-20 02:37:12', '2021-05-20 02:37:12', NULL, 3),
	(37, 'KP.01', 'TATA USAHA KEPEGAWAIAN', '-', '2021-05-20 02:39:02', '2021-05-20 02:39:02', NULL, 3),
	(38, 'KP.01.1', 'IZIN / DISPENSASI', 'Surat-surat yang berkenaan dengan izin tidak masuk kerja atas permintaan yang diajukan oleh pegawai yang bersangkutan, maupun dispensasi yang diajukan oleh instansi lain termasuk tugas pada instansi lain baik tugas belajar maupun tugas di luar negeri bagi pegawai Mahkamah Agung RI.', '2021-05-20 02:39:28', '2021-05-20 02:39:28', NULL, 3),
	(39, 'KP.01.2', 'KETERANGAN', 'Surat-surat yang berkenaan dengan keterangan pegawai dan keluarganya, termasuk surat-surat yang berkaitan dengan NIP, KARPEG, KARSU / KARIS dan data pegawai / pejabat.', '2021-05-20 02:40:01', '2021-05-20 02:40:01', NULL, 3),
	(40, 'KP.02', 'PENILAIAN DAN HUKUMAN', '-', '2021-05-20 02:40:33', '2021-05-20 02:40:33', NULL, 3),
	(41, 'KP.02.1', 'PENILAIAN', 'Surat-surat yang berkenaan dengan penilaian pelaksanaan pekerjaan, disiplin pegawai, pemalsuan administrasi kepegawaian, rehabilitasi dan pemulihan nama baik.', '2021-05-20 02:40:59', '2021-05-20 02:40:59', NULL, 3),
	(42, 'KP.02.2', 'HUKUMAN', 'Surat-surat yang berkenaan dengan hukuman pegawai, meliputi :\r\n- teguran tertulis,\r\n- pernyataan tidak puas secara tertulis,\r\n- penundaan kenaikan gaji berkala untuk paling lama 1 (satu) tahun,\r\n- penurunan gaji sebesar 1 (satu) kalli kenaikan gaji berkala untuk paling lama 1 (satu) tahun,\r\n- penundaan kenaikan pangkat untuk paling lama 1 (satu) tahun,\r\n- penurunan pangkat pada pangkat yang setingkat lebih rendah untuk paling lama 1 (satu) tahun,\r\n- pembebasan dan jabatan,\r\n- pemberhentian dengan hormat tidak atas permintaan sendiri sebagai PNS / tenaga teknis / tenaga fungsional,\r\n- pemberhentian tidak dengan hormat sebagai PNS.', '2021-05-20 02:41:45', '2021-05-20 02:41:45', NULL, 3),
	(43, 'KP.03', 'PEMBINAAN MENTAL', 'Surat-surat yang berkenaan dengan pembinaan mental pegawai, termasuk di dalamnya pembinaan kerohanian.', '2021-05-20 02:42:15', '2021-05-20 02:42:15', NULL, 3),
	(44, 'KP.04', 'MUTASI', '-', '2021-05-20 02:42:44', '2021-05-20 02:42:44', NULL, 3),
	(45, 'KP.04.1', 'KEPANGKATAN', 'Surat-surat yang berkenaan dengan kenaikan dengan kenaikan pangkat / golongan, termasuk di dalamnya ujian dinas, ujian penyesuaian ijazah, dan daftar urut kepangkatan.', '2021-05-20 02:43:11', '2021-05-20 02:43:11', NULL, 3),
	(46, 'KP.04.2', 'KENAIKAN GAJI BERKALA', 'Surat-surat yang berkenaan dengan kenaikan gaji berkala.', '2021-05-20 02:43:36', '2021-05-20 02:43:36', NULL, 3),
	(47, 'KP.04.3', 'PENYESUAIAN MASA KERJA', 'Surat-surat yang berkenaan dengan penyesuaian masa kerja untuk perubahan ruang gaji dan impassing.', '2021-05-20 02:44:16', '2021-05-20 02:44:16', NULL, 3),
	(48, 'KP.04.4', 'PENYESUAIAN TUNJANGAN KELUARGA', 'Surat-surat yang berkenaan dengan penyesuaian tunjangan keluarga.', '2021-05-20 02:44:47', '2021-05-20 02:44:47', NULL, 3),
	(49, 'KP.04.5', 'ALIH TUGAS', 'Surat-surat yang berkenaan dengan alih tugas bagi para pelaksana / staf, perpindahan dalam rangka pemantapan tugas kerja termasuk mengenai fasilitasnya.', '2021-05-20 02:45:16', '2021-05-20 02:45:16', NULL, 3),
	(50, 'KP.04.6', 'JABATAN STRUKTURAL / FUNGSIONAL', 'Surat-surat yang berkenaan dengan pengangkatan dan pemberhentian dalam jabatan struktural / fungsional, termasuk tunjangan sewaktu penugasan atau pemberian kuasa untuk menjabat sementara.', '2021-05-20 02:45:50', '2021-05-20 02:45:50', NULL, 3),
	(51, 'KP.05', 'KESEJAHTERAAN', '-', '2021-05-20 02:46:13', '2021-05-20 02:46:13', NULL, 3),
	(52, 'KP.05.1', 'KESEHATAN', 'Surat-surat yang berkenaan dengan penyelenggaraan kesehatan bagi pegawai, meliputi :\r\n- asiuansi kesehatan,\r\n- general check up bagi pimpinan dan pejabat.', '2021-05-20 02:46:50', '2021-05-20 02:46:50', NULL, 3),
	(53, 'KP.05.2', 'CUTI', 'Surat-surat yang berkenaan dengan cuti pegawai, meliputi :\r\n- cuti sakit,\r\n- cuti hamil / bersalin, dan\r\n- cuti diluar tanggungan negara.', '2021-05-20 02:47:46', '2021-05-20 02:47:46', NULL, 3),
	(54, 'KP.05.3', 'REKREASI DAN OLAH RAGA', 'Surat-surat yang berkenaan dengan rekreasi dan olah raga.', '2021-05-20 02:48:16', '2021-05-20 02:48:16', NULL, 3),
	(55, 'KP.05.4', 'BANTUAN SOSIAL', 'Surat-surat yang berkenaan dengan pemberian bantuan / tunjangan sosial kepada pegawai dan keluarga yang mengalamai musibah, termasuk ucapan bela sungkawa.', '2021-05-20 02:48:43', '2021-05-20 02:48:43', NULL, 3),
	(56, 'KP.05.5', 'KOPERASI', 'Surat-surat yang berkenaan dengan organisasi koperasi termasuk didalamnya masalah pengurusan kebutuhan pokok.', '2021-05-20 02:49:11', '2021-05-20 02:49:11', NULL, 3),
	(57, 'KP.05.6', 'PERUMAHAN', 'Surat-surat yang berkenaan dengan perumahan pegawai, pejabat struktural / fungsional, pimpinan dan hakim agung.', '2021-05-20 02:49:37', '2021-05-20 02:49:37', NULL, 3),
	(58, 'KP.05.7', 'ANTAR JEMPUT', 'Surat-surat yang berkenaan dengan transportasi pegawai.', '2021-05-20 02:50:01', '2021-05-20 02:50:01', NULL, 3),
	(59, 'KP.05.8', 'PENGHARGAAN', 'Surat-surat yang berkenaan dengan penghargaan, tanda jasa, piagam, satya lencana, dan sejenisnya.', '2021-05-20 02:50:28', '2021-05-20 02:50:28', NULL, 3),
	(60, 'KP.06', 'PEMUTUSAN HUBUNGAN KERJA', 'Surat-surat yang berhubungan dengan pensiun pegawai, termasuk jaminan-jaminan asuransi karena berhenti atas permintaan sendiri, berhenti dengan hormat bukan karena hukuman, pindah / keluar dari MA RI dan meninggal dunia.', '2021-05-20 02:50:54', '2021-05-20 02:50:54', NULL, 3),
	(61, 'KU.00', 'AKUNTANSI', 'Surat-surat yang berkenaan dengan penyiapan bahan pelaksanaan dan pembinaan pembukuan keuangan serta penyusunan perhitungan anggaran.', '2021-05-20 03:31:30', '2021-05-20 03:31:30', NULL, 4),
	(62, 'KU.01', 'PELAKSANAAN ANGGARAN', 'Surat-surat yang berkenaan dengan penyiapan bahan bimbingan dalam pelaksanaan penggunaan anggaran dan pertanggung jawaban keuangan.', '2021-05-20 03:32:00', '2021-05-20 03:32:00', NULL, 4),
	(63, 'KU.02', 'VERIVIKASI DAN TUNTUTAN GANTI RUGI', 'Surat-surat yang berkenaan dengan penyiapan bahan pencatatan, penelitian, pembinaan, dan penyusunan laporan tentang verivikasi dan tuntutan ganti rugi.', '2021-05-20 03:32:28', '2021-05-20 03:32:28', NULL, 4),
	(64, 'KU.03', 'PERBENDAHARAAN', 'Surat-surat yang berkenaan dengan penyiapan bahan bimbingan dalam ketatausahaan perbendaharaan, penyelesaian masalah perbendaharaan, dan pelaksanaan pembinaan bendaharawan.', '2021-05-20 03:32:59', '2021-05-20 03:32:59', NULL, 4),
	(65, 'KU.04', 'PENDAPATAN NEGARA', '-', '2021-05-20 03:33:32', '2021-05-20 03:33:32', NULL, 4),
	(66, 'KU.04.1', 'PAJAK', 'Surat-surat yang berkenaan dengan pendapatan negara dan hasil pajak yang meliputi :\r\n- MPO (Menghitung Pajak Orang),\r\n- PPN (Pajak Pendapatan Negara),\r\n- Pajak Jasa,\r\n- PPH (Pajak Pendapatan Penghasilan),\r\n- PPN (Pajak Pertambahan Nilai),\r\n- dan pajak lainnya.', '2021-05-20 03:34:08', '2021-05-20 03:34:08', NULL, 4),
	(67, 'KU.04.2', 'BUKAN PAJAK', 'Surat-surat yang berkenaan dengan pendapatan negara dan hasil bukan pajak yang meliputi penerimaan dan :\r\n- biaya perkara,\r\n- biaya salinan putusan,\r\n- biaya sewa dari inventaris negara,\r\n- hasil penjualan barang-barang inventaris yang dihapus,\r\n- dan penerimaan negara bukan pajak lainnya.', '2021-05-20 03:36:50', '2021-05-20 03:36:50', NULL, 4),
	(68, 'KU.05', 'PERBANKAN', 'Surat-surat yang berkenaan dengan perbankan, antara lain :\r\n- pembukaan rekening,\r\n- spasement tanda tangan,\r\n- valuta asing,\r\n- rekening koran, dan\r\n- proyek perbankan lainnya.', '2021-05-20 03:37:29', '2021-05-20 03:37:29', NULL, 4),
	(69, 'KU.06', 'SUMBANGAN / BANTUAN', 'Surat-surat yang berkenaan dengan permintaan, pemberian sumbangan / bantuan khusus diluar tugas pokok Mahkamah Agung RI, seperti :\r\n- bencana alam,\r\n- kebakaran,\r\n- banjir,\r\n- qurban,\r\n- pekan olah raga,\r\n- dan lain sebagainya.', '2021-05-20 03:38:06', '2021-05-20 03:38:06', NULL, 4),
	(70, 'KS.00', 'KERUMAHTANGGAN', 'Surat-surat yang berkenaan dengan :\r\n- penggunaan fasilitas,\r\n- ketertiban dan keamanan,\r\n- konsumsi,\r\n- pakaian dinas,\r\n- papan nama,\r\n- stempel,\r\n- lambang,\r\n- alamat kantor dan pejabat,\r\n- telekomunikasi, listrik, air,\r\n- dan lain sebagainya.', '2021-05-20 03:39:02', '2021-05-20 03:39:02', NULL, 5),
	(71, 'PB.00', 'PENELITIAN HUKUM', 'Surat-surat yang berkenaan dengan penelitian dan pengembangan hukum, sejak dari awal perencanaan, perizinan, pelaksanaan, sampai dengan pelaporan hasil penelitian.', '2021-05-21 01:24:45', '2021-05-21 01:24:45', NULL, 9),
	(72, 'PB.01', 'PENELITIAN PERADILAN', 'Surat-surat yang berkenaan dengan penelitian dan pengembangan peradilan, sejak dari perencanaan, perizinan, pelaksanaan, sampai dengan pelaporan hasil penelitian.', '2021-05-21 01:25:11', '2021-05-21 01:25:11', NULL, 9),
	(73, 'PB.02', 'PENGEMBANGAN PENELITIAN', 'Surat-surat yang berkenaan dengan masalah-masalah pengembangan penelitian dan perencanaan, pelaksanaan, sampai dengan pelaporan.', '2021-05-21 01:25:38', '2021-05-21 01:25:38', NULL, 9),
	(74, 'PL.01', 'GEDUNG DAN RUMAH DINAS', 'Surat-surat yang berkenaan dengan perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan, antara lain :\r\n- bangunan kantor,\r\n- rumah dinas,\r\n- mes,\r\n- pos jaga,\r\n- persetujuan gambar gedung,\r\n- dan lain sebagainya.', '2021-05-21 01:26:13', '2021-05-21 01:26:13', NULL, 6),
	(75, 'PL.02', 'TANAH', 'Surat-surat yang berkenaan dengan perencanaan, pengadan /pelelangan, pemeliharaan, penghapusan dan tukar guling tanah.', '2021-05-21 01:26:40', '2021-05-21 01:26:40', NULL, 6),
	(76, 'PL.03', 'ALAT KANTOR', 'Surat-surat yang berkenaan dengan perencaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan, antara lain :\r\n- ATK (Alat Tulis Kantor),\r\n- formulir-formulir,\r\n- dan lain-lain.', '2021-05-21 01:27:10', '2021-05-21 01:27:10', NULL, 6),
	(77, 'PL.04', 'MESIN KANTOR / ALAT-ALAT ELEKTRONIK', 'Surat-surat yang berkenaan dengan perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan, antara lain :\r\n- AC,\r\n- laptop,\r\n- komputer / PC,\r\n- radio,\r\n- slide,\r\n- mesin stensil,\r\n- tape recorder,\r\n- teleks,\r\n- video taper,\r\n- infocus,\r\n- amplifier,\r\n- foto copy,\r\n- kamera,\r\n- kalkulator / mesin hitung,\r\n- mesin ketik,\r\n- overhead proyektor,\r\n- proyektor film\r\n- dan sebagainya.', '2021-05-21 01:27:49', '2021-05-21 01:27:49', NULL, 6),
	(78, 'PL.05', 'PERABOT KANTOR', 'Surat-surat yang berkenaan dengan perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan, dan penghapusan, antara lain :\r\n- kursi,\r\n- meja,\r\n- lemari,\r\n- filing cabinet rak,\r\n- dan lain-lain yang sejenis.', '2021-05-21 01:28:21', '2021-05-21 01:28:21', NULL, 6),
	(79, 'PL.06', 'KENDARAAN', 'Surat-surat yang berkenaan dengan masalah kendaraan dari perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan.', '2021-05-21 01:28:45', '2021-05-21 01:28:45', NULL, 6),
	(80, 'PL.07', 'INVENTARIS PERLENGKAPAN', 'Surat-surat yang berkenaan dengan inventaris perlengkapan, laporan inventaris perlengkapan baik pusat maupun daerah.', '2021-05-21 01:29:10', '2021-05-21 01:29:10', NULL, 6),
	(81, 'PL.08', 'PENAWARAN UMUM', 'Surat-surat yang berkenaan dengan pelelangan dari mulai persiapan pelelangan, penyusunan RKS, pelaksanaan pelelangan dan pengumuman pemenang, serta hal-hal lain yang berkaitan dengan pelaksanaan pelelangan.', '2021-05-21 01:29:34', '2021-05-21 01:29:34', NULL, 6),
	(82, 'PL.09', 'KETATAUSAHAAN', 'Surat-surat yang berkenaan dengan korespondensi, kearsipan, penandatanganan surat dan wewenangnya, cap dinas, dan lain sebagainya.', '2021-05-21 01:30:02', '2021-05-21 01:30:02', NULL, 6),
	(83, 'PP.00', 'PENDIDIKAN DAN PELATIHAN TEKNIS', '-', '2021-05-21 01:30:23', '2021-05-21 01:30:23', NULL, 8),
	(84, 'PP.00.1', 'HAKIM', 'Surat-surat yang berkenaan dengan perencanaan, pelaksanaan, dan evaluasi penyelenggaraan pendidikan dan pelatihan hakim.', '2021-05-21 01:30:48', '2021-05-21 01:30:48', NULL, 8),
	(85, 'PP.00.2', 'PANITERA', 'Surat-surat yang berkenaan dengan perencanaan, pelaksanaan, dan evaluasi penyelenggaraan pendidikan dan pelatihan panitera.', '2021-05-21 01:31:11', '2021-05-21 01:31:11', NULL, 8),
	(86, 'PP.00.3', 'JURU SITA', 'Surat-surat yang berkenaan dengan perencanaan, pelaksanaan, dan evaluasi penyelenggaraan pendidikan dan pelatihan juru sita.', '2021-05-21 01:31:36', '2021-05-21 01:31:36', NULL, 8),
	(87, 'PP.00.4', 'TEKNIS LAINNYA', 'Surat-surat yang berkenaan dengan perencanaan, pelaksanaan, dan evaluasi penyelenggaraan pendidikan dan pelatihan teknis lainnya.', '2021-05-21 01:32:05', '2021-05-21 01:32:05', NULL, 8),
	(88, 'PP.01', 'PENDIDIKAN DAN LATIHAN MANAJEMEN', '-', '2021-05-21 01:32:26', '2021-05-21 01:32:26', NULL, 8),
	(89, 'PP.01.1', 'PENJENJANGAN', 'Surat-surat yang berkenaan dengan pendidikan penjenjangan, antara lain :\r\n- Diklatpim tingkat IV,\r\n- Dilatpim tingkat III,\r\n- Diklatpim tingkat II,\r\n- Diklatpim tingkat I,\r\n- LEMHANAS\r\n\r\nmulai dari perencanaan, pelaksanaan dan evaluasi.', '2021-05-21 01:33:01', '2021-05-21 01:33:01', NULL, 8),
	(90, 'PP.01.2', 'KEPANGKATAN', 'Surat-surat yang berkenaan dengan pendidikan dan kepangkatan, antara lain :\r\n- Pra Jabatan,\r\n- SUSCATUR (Kursus Calon Pengatur),\r\n- SUSCATA (Kursus Calon Penata),\r\n- SUSCABIN (Kursus Calon Pembina),\r\n\r\nmulai dari perencanaan, pelaksanaan dan evaluasi.', '2021-05-21 01:33:35', '2021-05-21 01:33:35', NULL, 8),
	(91, 'PP.01.3', 'LATIHAN / KURSUS / PENATARAN MANAJEMEN', 'Surat-surat yang berkenaan dengan latihan tenaga administrasi, kursus, dan penataran, di bidang manajemen atau lainnya, baik dalam maupun luar negeri, mulai dari perencanaan, pelaksanaan dan evaluasi.', '2021-05-21 01:34:01', '2021-05-21 01:34:01', NULL, 8),
	(92, 'PS.00', 'ADMINISTRASI UMUM', 'Surat-surat yang berkenaan dengan pengawasan administrasi umum, meliputi :\r\n- pengawasan ketatausahaan,\r\n- pengawasan kepegawaian,\r\n- pengawasan keuangan,\r\n- pengawasan perlengkapan,\r\n\r\ntermasuk Laporan Hasil Pemeriksaan (LHP) dan tindak lanjut pemeriksaan.', '2021-05-21 01:34:31', '2021-05-21 01:34:31', NULL, 10),
	(93, 'PS.01', 'TEKNIS', 'Surat-surat yang berkenaan dengan pengawasan di bidang teknis peradilan mulai dari perencanaan, pelaksanaan dan Laporan Hasil Pemeriksaan (LHP) dan tindak lanjut pemeriksaan.', '2021-05-21 01:34:57', '2021-05-21 01:34:57', NULL, 10);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.departments: ~2 rows (approximately)
DELETE FROM `departments`;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` (`id`, `name`, `desc`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Kesekretarian', NULL, '2021-05-19 13:42:45', '2021-05-19 13:42:46', NULL),
	(2, 'Kepaniteraan', NULL, '2021-05-19 13:42:55', '2021-05-19 13:42:56', NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.dispositions
CREATE TABLE IF NOT EXISTS `dispositions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `mail_id` bigint(20) unsigned DEFAULT NULL,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dispositions_user_id_foreign` (`user_id`),
  KEY `dispositions_mail_id_foreign` (`mail_id`),
  CONSTRAINT `dispositions_mail_id_foreign` FOREIGN KEY (`mail_id`) REFERENCES `inboxes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `dispositions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.dispositions: ~4 rows (approximately)
DELETE FROM `dispositions`;
/*!40000 ALTER TABLE `dispositions` DISABLE KEYS */;
INSERT INTO `dispositions` (`id`, `user_id`, `mail_id`, `notes`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 4, 2, NULL, 'OPEN', '2021-06-04 09:54:13', '2021-06-04 09:54:13', NULL),
	(4, 4, 1, NULL, 'CLOSED', '2021-06-04 14:38:08', '2021-06-07 13:10:20', NULL),
	(6, 7, 1, '-', 'CLOSED', '2021-06-07 13:11:04', '2021-06-07 13:33:08', NULL),
	(7, 5, 1, 'ok, segera laksanakan', 'CLOSED', '2021-06-07 13:33:08', '2021-06-07 14:11:58', NULL);
/*!40000 ALTER TABLE `dispositions` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.group_categories
CREATE TABLE IF NOT EXISTS `group_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_categories_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.group_categories: ~10 rows (approximately)
DELETE FROM `group_categories`;
/*!40000 ALTER TABLE `group_categories` DISABLE KEYS */;
INSERT INTO `group_categories` (`id`, `code`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'OT', 'ORGANISASI DAN TATA LAKSANA', '-', '2021-05-19 15:03:18', '2021-05-19 15:03:18', NULL),
	(2, 'HM', 'KEHUMASAN', '-', '2021-05-19 15:03:57', '2021-05-19 15:03:58', NULL),
	(3, 'KP', 'KEPEGAWAIAN', '-', '2021-05-19 15:05:34', '2021-05-19 15:05:35', NULL),
	(4, 'KU', 'KEUANGAN', '-', '2021-05-19 15:06:56', '2021-05-19 15:06:57', NULL),
	(5, 'KS', 'KESEKRETARIATAN', '-', '2021-05-19 15:07:12', '2021-05-19 15:07:13', NULL),
	(6, 'PL', 'PERLENGKAPAN', '-', '2021-05-19 15:07:32', '2021-05-19 15:07:33', NULL),
	(7, 'HK', 'HUKUM', '-', '2021-05-19 15:07:48', '2021-05-19 15:07:48', NULL),
	(8, 'PP', 'PENDIDIKAN DAN PELATIHAN', '-', '2021-05-19 15:08:09', '2021-05-19 15:08:09', NULL),
	(9, 'PB', 'PENELITIAN DAN PENGEMBANGAN', '-', '2021-05-19 15:08:32', '2021-05-19 15:08:32', NULL),
	(10, 'PS', 'PENGAWASAN', '-', '2021-05-19 15:08:44', '2021-05-19 15:08:44', NULL);
/*!40000 ALTER TABLE `group_categories` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.inboxes
CREATE TABLE IF NOT EXISTS `inboxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `index` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reff` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `type_id` bigint(20) unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BARU',
  PRIMARY KEY (`id`),
  KEY `inboxes_user_id_foreign` (`user_id`),
  KEY `inboxes_category_id_foreign` (`category_id`),
  KEY `inboxes_type_id_foreign` (`type_id`),
  CONSTRAINT `inboxes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `inboxes_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`),
  CONSTRAINT `inboxes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.inboxes: ~2 rows (approximately)
DELETE FROM `inboxes`;
/*!40000 ALTER TABLE `inboxes` DISABLE KEYS */;
INSERT INTO `inboxes` (`id`, `index`, `reff`, `subject`, `date`, `origin`, `document`, `attachments`, `user_id`, `category_id`, `created_at`, `updated_at`, `deleted_at`, `type_id`, `status`) VALUES
	(1, '1', '944/SEK/KP.05.2/4/2021', 'Pembatasan Cuti dan Bepergian ke Luar Daerah', '13-04-2021', 'Sekretaris Mahkamah Agung RI', 'assets/inbox/IMSYKIaWlEwBQbBqxWK6N6LGAV2Rdz478t4lVAvM.pdf', '5 lembar', 1, 53, '2021-06-03 10:08:13', '2021-06-07 14:11:58', NULL, 1, 'SELESAI'),
	(2, '2', '77/Bua.2/Izin.01.3/4/2021', 'Pendaftaran Ujian Dinas Elektronik (e-Exam) pada Mahkamah Agung RI tahun 2021', '20-04-2021', 'Badan Urusan Administrasi Mahkamah Agung RI', 'assets/inbox/d6KXNGunU6SlX2GLcLMlQhQvOz04vEDWaNAJFpqt.pdf', '1 (Satu) Berkas', 1, 45, '2021-06-03 14:58:04', '2021-06-04 09:54:13', NULL, 1, 'PROSES DISPOSISI');
/*!40000 ALTER TABLE `inboxes` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.migrations: ~17 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2021_05_04_071506_create_outboxes_table', 2),
	(5, '2021_05_06_062933_create_categories_table', 3),
	(6, '2021_05_06_074758_add_category_id_on_outboxes_table', 4),
	(7, '2021_05_07_071128_add_reff_on_outboxes_table', 5),
	(10, '2021_05_17_081935_add_columns_at_users_table', 6),
	(11, '2021_05_19_062455_create_departments_table', 7),
	(14, '2021_05_19_070957_create_group_categories_table', 8),
	(15, '2021_05_19_071340_add_group_id_on_categories_tabel', 9),
	(16, '2021_06_02_140925_create_inboxes_table', 10),
	(17, '2021_06_03_081148_create_types_table', 11),
	(20, '2021_06_03_105859_create_user_roles_table', 12),
	(21, '2021_06_03_110847_update_users_table', 12),
	(22, '2021_06_04_080753_create_dispositions_table', 13),
	(23, '2021_06_04_083538_add_status_on_inboxes_table', 14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.outboxes
CREATE TABLE IF NOT EXISTS `outboxes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `index` int(10) unsigned DEFAULT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `reff` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `outboxes_user_id_foreign` (`user_id`),
  KEY `outboxes_category_id_foreign` (`category_id`),
  CONSTRAINT `outboxes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `outboxes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.outboxes: ~16 rows (approximately)
DELETE FROM `outboxes`;
/*!40000 ALTER TABLE `outboxes` DISABLE KEYS */;
INSERT INTO `outboxes` (`id`, `index`, `suffix`, `date`, `subject`, `destination`, `document`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `category_id`, `reff`) VALUES
	(1, 409, NULL, '2021-05-03', 'Ket Internal', 'BRI KCP Mentok', NULL, 1, '2021-05-20 03:10:34', '2021-05-20 03:20:00', NULL, 21, 'W28-A4/409/HK.05/V/2021'),
	(2, 410, NULL, '2021-05-03', 'Permohonan Cuti a.n Tibyani S.Ag., M.H.', 'PTA Babel', NULL, 1, '2021-05-20 03:21:00', '2021-05-20 03:21:00', NULL, 53, 'W28-A4/410/KP.05.2/V/2021'),
	(3, 411, NULL, '2021-05-03', 'Permohonan Cuti a.n Nailasara Hasniyati, S.H.I.', 'PTA Babel', NULL, 1, '2021-05-20 03:26:23', '2021-05-20 03:26:23', NULL, 53, 'W28-A4/411/KP.05.2/V/2021'),
	(4, 412, NULL, '2021-05-03', 'Permohonan Cuti a.n M Refi Malikul Adil, S.H.I.', 'PTA Babel', NULL, 1, '2021-05-20 03:27:36', '2021-05-20 03:27:36', NULL, 53, 'W28-A4/412/KP.05.2/V/2021'),
	(5, 413, NULL, '2021-05-03', 'Laporan PNBP', 'KPPN', NULL, 1, '2021-05-20 03:28:56', '2021-05-20 03:40:22', NULL, 67, 'W28-A4/413/KU.04.2/V/2021'),
	(6, 414, NULL, '2021-05-03', 'Permohonan Cuti', 'PTA Babel', NULL, 1, '2021-05-20 03:30:24', '2021-05-20 03:30:24', NULL, 53, 'W28-A4/414/KP.05.2/V/2021'),
	(7, 415, NULL, '2021-05-03', 'SPTSM Remun', '-', NULL, 1, '2021-05-20 03:42:47', '2021-05-20 03:42:47', NULL, 62, 'W28-A4/415/KU.01/V/2021'),
	(8, 416, NULL, '2021-05-03', 'SPTSM Transport', '-', NULL, 1, '2021-05-20 03:43:35', '2021-05-20 03:43:35', NULL, 62, 'W28-A4/416/KU.01/V/2021'),
	(9, 417, NULL, '2021-05-03', '-', '-', NULL, 1, '2021-05-20 03:46:37', '2021-05-20 03:46:37', NULL, 62, 'W28-A4/417/KU.01/V/2021'),
	(10, 418, NULL, '2021-05-03', 'Undangan Dukcapil', 'Dukcapil', NULL, 1, '2021-05-20 03:47:33', '2021-05-20 03:47:33', NULL, 25, 'W28-A4/418/HM.01/V/2021'),
	(11, 419, NULL, '2021-05-03', 'Undangan Kementrian Agama Bangka Barat', 'Kementrian Agama Bangka Barat', NULL, 1, '2021-05-20 03:48:23', '2021-05-20 03:48:23', NULL, 25, 'W28-A4/419/HM.01/V/2021'),
	(12, 420, NULL, '2021-05-03', 'Undangan Kesra', 'Kesra', NULL, 1, '2021-05-20 03:49:09', '2021-05-20 03:49:09', NULL, 25, 'W28-A4/420/HM.01/V/2021'),
	(13, 421, NULL, '2021-05-04', 'Surat Tugas Sidang Keliling', 'Kantor Camat Kelapa', NULL, 1, '2021-05-20 03:51:32', '2021-05-20 03:51:32', NULL, 37, 'W28-A4/421/KP.01/V/2021'),
	(14, 422, NULL, '2021-05-05', 'Relas 145', 'PA Jakarta Timur', NULL, 1, '2021-05-20 03:54:51', '2021-05-20 03:54:51', NULL, 21, 'W28-A4/422/HK.05/V/2021'),
	(15, 423, NULL, '2021-05-05', 'Relas 115', 'PA Soreang', NULL, 1, '2021-05-20 03:55:55', '2021-05-20 03:55:55', NULL, 21, 'W28-A4/423/HK.05/V/2021'),
	(16, 424, NULL, '2021-05-05', 'Undangan Kementrian Agama Bangka Barat', 'Kementrian Agama Bangka Barat', NULL, 1, '2021-05-20 03:57:07', '2021-05-20 03:57:07', NULL, 25, 'W28-A4/424/HM.01/V/2021');
/*!40000 ALTER TABLE `outboxes` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.types
CREATE TABLE IF NOT EXISTS `types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.types: ~3 rows (approximately)
DELETE FROM `types`;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` (`id`, `name`) VALUES
	(1, 'Umum'),
	(2, 'Rahasia'),
	(3, 'Mendesak');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(10) unsigned DEFAULT NULL,
  `is_active` enum('N','Y') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.users: ~7 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `nip`, `position`, `department_id`, `is_active`, `deleted_at`, `role_id`) VALUES
	(1, 'ADINDA APRILIA', 'dinda@pa-mentok.go.id', NULL, '$2y$10$8ojuxFo6H6HTUc/AYc8IH.9g68wZMdtS2yAH21K3yqg1OWlicWMWy', NULL, '2021-04-29 05:40:04', '2021-06-04 09:09:34', 'PPNPN20201', 'Staff Kesekretariatan', NULL, 'N', NULL, 3),
	(3, 'MUHAMMAD RIZKI, S.Si', 'rizki@pa-mentok.go.id', NULL, '$2y$10$4053RNlFXXYG/QlhWpG.NOGc5hUL.Txo0I5YbOCdqA1qJQ.5w7eUG', NULL, '2021-05-17 09:16:11', '2021-06-03 14:41:44', '199308192020121003', 'Pranata Komputer', NULL, 'Y', NULL, 1),
	(4, 'HARDIANSYAH ROPI, S.Ak.', 'ropi@pa-mentok.go.id', NULL, '$2y$10$F0.fnm1IJmTvwlmfjQg6WOHfLocEp8Xv80qGGKD6OGkraan9A8tu2', NULL, '2021-05-18 05:19:02', '2021-06-03 14:40:10', '198204032009121003', 'Kasubbag Kepegawaian', 1, 'Y', NULL, 2),
	(5, 'TIBYANI, S.Ag., M.H.', 'tibyani@pa-mentok.go.id', NULL, '$2y$10$.Fa6zPmb1LHRFQg52CK6CuQ2HnrDjm.JwFc.m9VPis3/5J3Fk5YNW', NULL, '2021-05-20 03:02:36', '2021-05-20 03:02:36', '197207051998031004', 'Ketua', NULL, 'Y', NULL, 2),
	(6, 'MUHAMAD SYARIF, S.H.I.', 'msyarif@pa-mentok.go.id', NULL, '$2y$10$wA6nUC6orng8qBQjHI45duHqX9dZsYsf/trnEASXh0EuywX2FDtQG', NULL, '2021-05-20 03:03:44', '2021-05-20 03:03:44', '197909142007041001', 'Wakil Ketua', NULL, 'Y', NULL, 2),
	(7, 'SUJOKO, S.E.', 'sujoko@pa-mentok.go.id', NULL, '$2y$10$pKaNbODLZZC3Y5DuWSj7FOnrhNzutV2JNBMsmc9RIWAvK/w2amvKm', NULL, '2021-05-20 03:04:44', '2021-05-20 03:04:44', '197904052009121004', 'Sekretaris', 1, 'Y', NULL, 2),
	(8, 'JATMIKO TRIAJI, S.T.', 'jatmiko@pa-mentok.go.id', NULL, '$2y$10$/N1PB0Xdntmtg8HeP2G9t.MQFBfrCqxdkSsviYpVEI.hsAGQ8DnIS', NULL, '2021-05-20 03:06:52', '2021-05-20 03:06:52', '198604122009121003', 'Kasubbag Perencanaan, IT, Pelaporan', 1, 'Y', NULL, 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table surat-keluar.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table surat-keluar.user_roles: ~3 rows (approximately)
DELETE FROM `user_roles`;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Super Admin', '2021-06-03 13:42:43', '2021-06-03 13:42:44', NULL),
	(2, 'Pengguna', '2021-06-03 13:42:57', '2021-06-03 13:42:57', NULL),
	(3, 'Petugas', '2021-06-03 14:40:36', '2021-06-03 14:40:36', NULL);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
