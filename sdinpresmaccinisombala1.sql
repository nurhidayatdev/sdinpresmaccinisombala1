-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql113.infinityfree.com
-- Generation Time: Nov 22, 2025 at 09:02 AM
-- Server version: 11.4.7-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40345157_sdinpresmaccinisombala1`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `link_youtube` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `link_youtube`, `deskripsi`) VALUES
(1, 'Ekstrakurikuler', 'https://www.youtube.com/embed/AuAK0Ro10-A?si=4lAK_Zlqc91yMNe8', 'Ekstrakurikuler yang ada di SPF SD Inpres Maccini Sombala 1 saat ini hanya ekstrakurikuler futsal. Dulu, terdapat ekstrakurikuler lain yaitu Drum Band. Namun, sekarang ekstrakurikuler itu sudah tidak aktif karena kurangnya minat siswa untuk ikut menjadi anggota. Untuk informasi lebih lanjut mengenai pendaftaran ekstrakurikuler futsal, silakan klik link berikut ini: <a href=\"form_futsal.php\">Daftar Ekskul Futsal</a>'),
(2, 'SDI Maccini Sombala I @ Field Trip Industri & Sejarah', 'https://www.youtube.com/embed/E6Hlq_X4wvM?si=JN_PS3GJjoClK4Zw', 'Video ini merupakan perjalanan yang merekam langkah-langkah kecil penuh semangat dari siswa-siswi SDI Maccini Sombala 1 saat mengikuti Field Trip Industri dan Sejarah bersama Pandawa Organizer. Mereka diajak keluar dari ruang kelas untuk menyentuh langsung dunia nyata, melihat bagaimana sebuah industri bekerja. '),
(3, 'Gambaran Kegiatan PLP 1 di UPT SPF SD Inpres Maccini Sombala 1', 'https://www.youtube.com/embed/16IwrAbf67o?si=q_DSthh85PPBhUpl', 'Video ini merekam jejak awal perjalanan seorang calon pendidik melalui kegiatan PLP 1 di UPT SPF SD Inpres Maccini Sombala 1. Bukan sekadar observasi, tetapi sebuah pengalaman yang mempertemukan teori dengan kenyataan di lapangan. Di sana, mahasiswa berkenalan dengan suasana sekolah, menyaksikan dinamika pembelajaran, dan merasakan interaksi hangat antara guru dan siswa. Momen-momen sederhana itu menjadi pijakan penting untuk menapaki jalan menuju dunia pendidikan yang sesungguhnya, membentuk pemahaman bahwa menjadi pendidik bukan hanya soal mengajar, tetapi juga tentang merangkul, memahami, dan mendampingi.');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_sekolah`
--

CREATE TABLE `fasilitas_sekolah` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `fasilitas` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas_sekolah`
--

INSERT INTO `fasilitas_sekolah` (`id`, `gambar`, `fasilitas`, `deskripsi`) VALUES
(13, '1762517282_halaman-1.jpg', 'Halaman Sekolah', 'Sekolah memiliki halaman yang cukup luas sebagai akses masuk utama. Halaman ini ditata dengan beberapa tanaman di sisi kanan-kiri sehingga memberi suasana asri dan nyaman bagi siswa. Sekolah juga memiliki lapangan utama yang digunakan bersama dengan sekolah lain.'),
(14, '1762517306_ruangguru-1.jpg', 'Ruang Guru', 'Ruang guru digunakan sebagai tempat beristirahat, berdiskusi, dan mempersiapkan materi pembelajaran. Ruangan ini dilengkapi meja, kursi, dan lemari penyimpanan.'),
(15, '1762517321_ruanguks-1.jpg', 'Ruang UKS', 'Ruang UKS (Usaha Kesehatan Sekolah) disediakan sebagai tempat pertolongan pertama apabila ada siswa yang sakit. Dengan adanya ruangan ini, kesehatan siswa dapat lebih terpantau selama berada di sekolah.'),
(16, '1762517336_perpustakaan-1.jpg', 'Perpustakaan', 'Perpustakaan sekolah menyediakan berbagai koleksi buku pelajaran maupun bacaan umum. Rak-rak buku tersusun rapi sehingga siswa dapat dengan mudah mencari referensi untuk menunjang pembelajaran.'),
(17, '1762517354_ruangkelas-2.jpg', 'Ruang Kelas', 'Ruang kelas dilengkapi dengan meja dan kursi untuk siswa, papan tulis, proyektor setiap kelas, toilet di masing-masing kelas, serta ventilasi dan jendela yang cukup untuk pencahayaan alami. Suasana kelas terlihat aktif dengan kegiatan belajar mengajar.'),
(18, '1762517369_ruangshalat-1.jpg', 'Ruang Shalat', 'Sekolah menyediakan ruang shalat khusus bagi siswa dan guru untuk melaksanakan ibadah. Fasilitas ini mencerminkan perhatian sekolah terhadap kebutuhan spiritual warga sekolah.');

-- --------------------------------------------------------

--
-- Table structure for table `form_futsal`
--

CREATE TABLE `form_futsal` (
  `id` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` enum('4','5','6') NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `alasan` text NOT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_futsal`
--

INSERT INTO `form_futsal` (`id`, `nisn`, `nama`, `kelas`, `jk`, `nohp`, `alasan`, `tanggal_daftar`) VALUES
(29, '1122334455', 'Bagas Saputra', '4', 'Laki-laki', '082345671234', 'Hobi main bola', '2025-11-15 17:35:41'),
(30, '9988123456', 'Rizky Maulana', '5', 'Laki-laki', '081234567890', 'Karena suka main futsal', '2025-11-15 17:38:40'),
(31, '0078912345', 'Aldi Pratama', '6', 'Laki-laki', '089512345678', 'Ingin lebih jago main futsal', '2025-11-15 17:39:35'),
(32, '5566778899', 'Ilham Firmansyah', '4', 'Laki-laki', '087765443210', 'Supayan punya teman main futsal', '2025-11-15 17:40:55'),
(33, '6655443322', 'Dafi Ramadhan', '6', 'Laki-laki', '089634521789', 'Biar bisa giat ikut latihan futsal', '2025-11-15 17:41:28'),
(34, '7788990011', 'Farhan Prasetyo', '4', 'Laki-laki', '081278945612', 'Karena diajak teman', '2025-11-15 17:43:38'),
(35, '9911223344', 'Arya Aditya', '6', 'Laki-laki', '083345667890', 'Karena ingin ikut pertandingan futsal di sekolah sama teman-teman', '2025-11-15 17:44:41'),
(36, '5566001122', 'Galang Permana', '5', 'Laki-laki', '085267894531', 'Supaya punya banyak teman baru ', '2025-11-15 17:45:44'),
(37, '3344556677', 'Ramzi', '4', 'Laki-laki', '087732145678', 'Supaya punya ekskul', '2025-11-15 17:49:04'),
(38, '4230342110', 'Nadia Putri', '6', 'Perempuan', '089876543210', 'Mau belajar teknik dasar futsal', '2025-11-15 17:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `pangkat_gol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `nip`, `pangkat_gol`) VALUES
(1, 'Jumiati Nada, S.Pd.', '19720304 199505 2 002', 'Pembina Utama Muda, IV/c'),
(2, 'Sitti Sulaeha, S.Pd', '19701231 199402 2 011', 'Pembina Utama Muda, IV/c'),
(3, 'Kasmiati, S.Pd', '19711111 199308 2 001', 'Pembina, IV/b'),
(4, 'Nita Hartaty, S.Pd', '19740628 200701 2 015', 'Penata Tk.I, III.d'),
(5, 'Harliyana, S.Pd', '19671111 200604 2 009', 'Penata Tk.I, III.d'),
(6, 'Andi Nurdiana, S.Pd', '19810917 200701 2 009', 'Penata Tk.I, III.d'),
(7, 'Ulfiani Safitri, S.Pd', '19861115 201001 2 032', 'Penata Muda Tk.I, III/b'),
(8, 'Muh. Fajrul, S.Pd.Gr. M.Pd', '19960421 201903 1 004', 'Penata Muda, III/a'),
(9, 'Suardi, S.Pd', '19860331 2023211007', 'Ahli Pertama Guru Kelas / IX'),
(10, 'Anita Dewi Hendri Hastuty, S.Pd', '19830414 2023212018', 'Ahli Guru Pertama Kelas / IX'),
(11, 'Nurmiati Syam, S.Pd.I.Gr', '19890916 2023212022', 'Ahli Pertama Guru Kelas / IX'),
(12, 'Rahmatiah, S.Pd', '19750817 2023212004', 'Ahli Pertama Guru PAI / IX'),
(13, 'Irda Yanti Kadri, S.Pd', '19880524 2024212014', 'Guru PJOK Ahli Pertama / IX'),
(14, 'Andi Arni, S.Pd.I', '19841213 2024212008', 'Ahli Pertama Guru PAI / IX'),
(15, 'Irma Yuliana Ahmad, S.Pd', '19910509 2024212026', 'Guru Kelas Ahli Pertama / IX'),
(16, 'Dhani Aswira, S.Pd', '19940212 2024212021', 'Guru Kelas Ahli Pertama / IX'),
(17, 'Nurmiati, S.Pd', '19941115 202421202', 'Guru Kelas Ahli Pertama / IX'),
(18, 'Dea Apriani, S.Pd', '-', 'Honorer'),
(19, 'Muhammad Bintang Idris Safa', '-', 'Honorer'),
(20, 'Muhammad Alif Fauzan Idris', '-', 'Honorer'),
(21, 'Nur Febrianty', '-', 'Honorer'),
(22, 'Yuliati Amir', '-', 'Honorer'),
(23, 'Irmayanti', '-', 'Honorer'),
(33, 'Andi Arna, S.Pd', '-', 'Honorer');

-- --------------------------------------------------------

--
-- Table structure for table `kelompok`
--

CREATE TABLE `kelompok` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `link_artikel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelompok`
--

INSERT INTO `kelompok` (`id`, `gambar`, `nama`, `nim`, `link_artikel`) VALUES
(1, 'dila.jpg', 'St. Fhadila Sayyidina Putri', '240209500067', 'https://fhadilasayyidina-cpu.github.io/Tugas/artikel.html'),
(2, 'adel.jpg', 'Adelia Maqfira Hapati', '240209500070', 'https://adeliamaqfirahapati-lgtm.github.io/Tugas-5-Pemrograman-Web/latihan4/menu.html'),
(3, 'yaya.jpg', 'Nur Hidayat', '240209501052', 'https://nurhidayatdev.github.io/praktikum-4/praktikum-4/tugas/artikel.html'),
(4, 'adit.jpg', 'A. Adithya Dwi Permadi Hakim', '240209501046', 'https://aadithyadwipermadihakim.github.io/Praktikum-2/Tugas/artikel.html'),
(5, 'ekii.jpg', 'Baso Rezki Ramadhan Mallanti', '240209501058', 'https://basorezkiramadhanmallanti.github.io/Tugas-5/artikel.html'),
(6, 'tegar.jpg', 'Tegar Angbirah Parerungan', '240209501059', 'https://tegaraparerungan.github.io/Tugas-5.2/artikel.html');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `nama`, `role`) VALUES
(2, 'yaya@gmail.com', '240209501052', 'NUR HIDAYAT', 'Administrator Utama'),
(3, 'dila@gmail.com', '240209500067', 'ST. FHADILA SAYYIDINA PUTRI', 'Admin Ekstrakulikuler'),
(4, 'adel@gmail.com', '240209500070', 'ADELIA MAQFIRA HAPATI', 'Admin Akademik'),
(5, 'adit@gmail.com', '240209501046', 'A. ADITHYA DWI PERMADI HAKIM', 'Admin Data Sekolah'),
(6, 'eki@gmail.com', '240209501058', 'BASO REZKI RAMADHAN MALLANTI', 'Admin Publikasi'),
(7, 'tegar@gmail.com', '240209501059', 'TEGAR ANGBIRAH PARERUNGAN', 'Admin Profil'),
(12, 'uaswebptikcklp5@gmail.com', 'pemrogramanweb', 'Alifya NFH, S.Pd.,M.Pd.', 'Administrator Utama');

-- --------------------------------------------------------

--
-- Table structure for table `mengajar`
--

CREATE TABLE `mengajar` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `jenis_ptk` varchar(100) DEFAULT NULL,
  `kelas_mapel` varchar(100) DEFAULT NULL,
  `jtm_per_minggu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mengajar`
--

INSERT INTO `mengajar` (`id`, `guru_id`, `jenis_ptk`, `kelas_mapel`, `jtm_per_minggu`) VALUES
(1, 1, 'Kepala Sekolah', '-', 24),
(2, 2, 'Guru Kelas', 'Kelas V/B', 24),
(3, 3, 'Guru Kelas', 'Kelas II/A', 24),
(4, 4, 'Guru Kelas', 'Kelas VI/A', 24),
(5, 5, 'Guru Kelas', 'Kelas VI/B', 24),
(6, 6, 'Guru Kelas', 'Kelas I/A', 24),
(7, 7, 'Guru Kelas', 'Kelas IV/B', 24),
(8, 8, 'Guru Mapel PJOK', 'Kelas I/A - VI/A', 24),
(9, 9, 'Guru Kelas', 'Kelas III/A', 24),
(10, 10, 'Guru Kelas', 'Kelas II/B', 24),
(11, 11, 'Guru Kelas', 'Kelas III/B', 24),
(12, 12, 'Guru Mapel PAI', 'Kelas I/A - VI/A', 24),
(13, 13, 'Guru Mapel PJOK', 'Kelas I/B - VI/B', 24),
(14, 14, 'Guru Mapel PAI', 'Kelas I/B - VI/B', 24),
(15, 15, 'Guru Kelas', 'Kelas V/A', 24),
(16, 16, 'Guru Kelas', 'Kelas IV/A', 24),
(17, 17, 'Guru Kelas', 'Kelas I/B', 24),
(28, 33, 'Guru Mapel Bhs. Daerah', 'Kelas IV-VI', 12),
(29, 18, 'Guru Mapel Bhs. Inggris', 'Kelas IV-VI', 12),
(30, 19, 'Tenaga Perpustakaan', '-', 0),
(31, 20, 'Tenaga Administrasi', '-', 0),
(32, 21, 'Operator', '-', 0),
(33, 22, 'Security', '-', 0),
(34, 23, 'Petugas Kebersihan', '-', 24);

-- --------------------------------------------------------

--
-- Table structure for table `misi`
--

CREATE TABLE `misi` (
  `id` int(11) NOT NULL,
  `pernyataan_misi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `misi`
--

INSERT INTO `misi` (`id`, `pernyataan_misi`) VALUES
(1, 'Meningkatkan SDM tenaga pendidik baik intra maupun ekstrakurikuler.'),
(2, 'Menanamkan disiplin, akhlak, dan budi pekerti luhur bernuansa agamis.'),
(3, 'Membina siswa agar kreatif, kritis, berani, dan bertanggung jawab.'),
(4, 'Melaksanakan pembelajaran yang menjaga kelestarian lingkungan.'),
(5, 'Menciptakan lingkungan sekolah yang bersih, sehat, dan nyaman.'),
(6, 'Menjalin kerja sama harmonis antara warga sekolah dan masyarakat.');

-- --------------------------------------------------------

--
-- Table structure for table `pembina_kegiatan`
--

CREATE TABLE `pembina_kegiatan` (
  `id` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `tugas_pembinaan` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembina_kegiatan`
--

INSERT INTO `pembina_kegiatan` (`id`, `guru_id`, `tugas_pembinaan`) VALUES
(1, 1, 'Pembina/Penanggungjawab Kegiatan Sekolah'),
(2, 2, 'Pembina Sosial dan Kesiswaan'),
(3, 3, 'Pembina Keindahan dan Kebersihan'),
(4, 4, 'Sarana dan Prasarana/Kebersihan'),
(5, 5, 'Pembina Kesiswaan/Kebersihan'),
(6, 6, 'Keindahan dan Kebersihan'),
(7, 7, 'Pembina UKS dan Pembina Sekolah Adiwiyata'),
(8, 8, 'Pembina Kesiswaan/Kebersihan'),
(9, 9, 'Pembinaan Kebersihan dan Pembantu Adiwiyata'),
(10, 10, 'Pembina Kesenian dan Keindahan'),
(11, 11, 'Pembantu Adiwiyata / Pembina Kesiswaan'),
(12, 12, 'Keagamaan'),
(13, 13, 'Pengurus Barang'),
(14, 14, 'Keagamaan'),
(15, 15, 'Bendahara Dana Bos'),
(16, 16, 'Pembantu Adiwiyata'),
(17, 17, 'Pembantu Adiwiyata'),
(26, 33, 'Pembantu Adiwiyata'),
(27, 18, 'Pembantu Adiwiyata'),
(28, 19, 'Pembantu Adiwiyata'),
(30, 20, 'Pembantu Adiwiyata'),
(31, 21, 'Pembantu Adiwiyata'),
(32, 22, 'Petugas Keamanan'),
(33, 23, 'Petugas Kebersihan');

-- --------------------------------------------------------

--
-- Table structure for table `profil_sekolah`
--

CREATE TABLE `profil_sekolah` (
  `id` int(11) NOT NULL,
  `nama_sekolah` varchar(100) DEFAULT NULL,
  `npsn` varchar(20) DEFAULT NULL,
  `jenjang` varchar(50) DEFAULT NULL,
  `status_sekolah` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `sk_pendirian` varchar(100) DEFAULT NULL,
  `tanggal_sk` date DEFAULT NULL,
  `status_kepemilikan` varchar(100) DEFAULT NULL,
  `kebutuhan_khusus` varchar(100) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `cabang_bank` varchar(100) DEFAULT NULL,
  `rekening_atas_nama` varchar(100) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `kepala_sekolah` varchar(100) DEFAULT NULL,
  `operator` varchar(100) DEFAULT NULL,
  `akreditasi` varchar(10) DEFAULT NULL,
  `kurikulum` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profil_sekolah`
--

INSERT INTO `profil_sekolah` (`id`, `nama_sekolah`, `npsn`, `jenjang`, `status_sekolah`, `alamat`, `kecamatan`, `kabupaten`, `provinsi`, `negara`, `sk_pendirian`, `tanggal_sk`, `status_kepemilikan`, `kebutuhan_khusus`, `nama_bank`, `cabang_bank`, `rekening_atas_nama`, `npwp`, `kepala_sekolah`, `operator`, `akreditasi`, `kurikulum`) VALUES
(1, 'UPT SPF SD INPRES MACCINI SOMBALA 1', '40307600', 'SD', 'Negeri', 'Jl. Abdul Kadir No. 47', 'Tamalate', 'Makassar', 'Sulawesi Selatan', 'Indonesia', '421/3023/DP/VIII/2020', '2020-08-26', 'Pemerintah Daerah', 'Tidak ada', 'BPD SULAWESI SELATAN', 'BPD SULSEL CABANG KOTA MAKASSAR', 'SD.INP.MACCINISOMBALAI', '002972891805000', 'Jumiati Nada', 'Irma Yuliana Ahmad, S.Pd.', 'B', 'Kurikulum Merdeka');

-- --------------------------------------------------------

--
-- Table structure for table `ptk_pd`
--

CREATE TABLE `ptk_pd` (
  `id` int(11) NOT NULL,
  `uraian` varchar(50) NOT NULL,
  `guru` int(11) NOT NULL,
  `tendik` int(11) NOT NULL,
  `ptk` int(11) NOT NULL,
  `pd` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ptk_pd`
--

INSERT INTO `ptk_pd` (`id`, `uraian`, `guru`, `tendik`, `ptk`, `pd`) VALUES
(1, 'Laki - Laki', 2, 2, 4, 190),
(2, 'Perempuan', 15, 5, 20, 175);

-- --------------------------------------------------------

--
-- Table structure for table `rombongan_mengajar`
--

CREATE TABLE `rombongan_mengajar` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `laki_laki` int(11) DEFAULT 0,
  `perempuan` int(11) DEFAULT 0,
  `total` int(11) GENERATED ALWAYS AS (`laki_laki` + `perempuan`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rombongan_mengajar`
--

INSERT INTO `rombongan_mengajar` (`id`, `kelas`, `laki_laki`, `perempuan`) VALUES
(1, 'Kelas 1', 30, 25),
(2, 'Kelas 2', 32, 40),
(3, 'Kelas 3', 35, 31),
(4, 'Kelas 4', 39, 29),
(5, 'Kelas 5', 26, 30),
(6, 'Kelas 6', 28, 20);

-- --------------------------------------------------------

--
-- Table structure for table `sarpras`
--

CREATE TABLE `sarpras` (
  `id` int(11) NOT NULL,
  `uraian` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sarpras`
--

INSERT INTO `sarpras` (`id`, `uraian`, `jumlah`) VALUES
(1, 'Ruang Kelas', 6),
(2, 'Ruang UKS', 1),
(3, 'Ruang Perpus', 1),
(5, 'Ruang Shalat', 1),
(7, 'Perpustakaan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE `tujuan` (
  `id` int(11) NOT NULL,
  `pernyataan_tujuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tujuan`
--

INSERT INTO `tujuan` (`id`, `pernyataan_tujuan`) VALUES
(1, 'Tersedianya tenaga pendidik profesional.'),
(2, 'Melahirkan peserta didik berakhlak dan disiplin.'),
(3, 'Meningkatkan kemampuan akademik dan karakter mandiri.'),
(4, 'Menerapkan pembelajaran ramah lingkungan.'),
(5, 'Mewujudkan sekolah yang bersih, sehat, dan nyaman.'),
(6, 'Membangun kerja sama dengan masyarakat dan lembaga terkait.');

-- --------------------------------------------------------

--
-- Table structure for table `visi`
--

CREATE TABLE `visi` (
  `id` int(11) NOT NULL,
  `pernyataan_visi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visi`
--

INSERT INTO `visi` (`id`, `pernyataan_visi`) VALUES
(1, 'Terwujudnya sekolah yang unggul dalam IMTAQ dan IPTEK, berdaya saing, berkarakter, serta peduli terhadap sesama dan lingkungan.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_sekolah`
--
ALTER TABLE `fasilitas_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_futsal`
--
ALTER TABLE `form_futsal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelompok`
--
ALTER TABLE `kelompok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `misi`
--
ALTER TABLE `misi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembina_kegiatan`
--
ALTER TABLE `pembina_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guru_id` (`guru_id`);

--
-- Indexes for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ptk_pd`
--
ALTER TABLE `ptk_pd`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rombongan_mengajar`
--
ALTER TABLE `rombongan_mengajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sarpras`
--
ALTER TABLE `sarpras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visi`
--
ALTER TABLE `visi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fasilitas_sekolah`
--
ALTER TABLE `fasilitas_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `form_futsal`
--
ALTER TABLE `form_futsal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `kelompok`
--
ALTER TABLE `kelompok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mengajar`
--
ALTER TABLE `mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `misi`
--
ALTER TABLE `misi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembina_kegiatan`
--
ALTER TABLE `pembina_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `profil_sekolah`
--
ALTER TABLE `profil_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ptk_pd`
--
ALTER TABLE `ptk_pd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rombongan_mengajar`
--
ALTER TABLE `rombongan_mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sarpras`
--
ALTER TABLE `sarpras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `visi`
--
ALTER TABLE `visi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mengajar`
--
ALTER TABLE `mengajar`
  ADD CONSTRAINT `mengajar_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembina_kegiatan`
--
ALTER TABLE `pembina_kegiatan`
  ADD CONSTRAINT `pembina_kegiatan_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
