-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 12:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `materi_portalberita`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `foto`, `deskripsi`, `level`) VALUES
(1, 'admin', '$2a$12$jsSO2hgGR4MWV9v7KRYN.uKTwiY0R8HqxvvnBpTimgwEXVK/OxzZ2', 'Ryan', 'deadpool.jpg', 'Mahasiswa Universitas Muhammadiyah Kota Sorong Fakultas Teknik Program Studi Teknik Informatika', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `teks_berita` text NOT NULL,
  `tgl_posting` datetime NOT NULL,
  `id_admin` int(11) NOT NULL,
  `dilihat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `id_kategori`, `gambar`, `teks_berita`, `tgl_posting`, `id_admin`, `dilihat`) VALUES
(11, 'Memantau Mesin Pompa Penerimaan Avtur', 2, 'WhatsApp Image 2025-01-03 at 15.42.25.jpeg', '<p><strong>Memantau Mesin Pompa Penerimaan Avtur</strong></p>\r\n\r\n<p>Pekerja Melakukan pemantauan pada mesin pompa untuk penerimaan avtur</p>\r\n', '2025-01-05 09:03:07', 1, 15),
(12, 'Proses Pengecekan Engsel Floating Section', 1, 'WhatsApp Image 2025-01-03 at 15.49.51.jpeg', '<p><strong>Proses Pengecekan Engsel Floating Section</strong></p>\r\n\r\n<p>Para mahasiswa magang melakukan pengecekan&nbsp;engsel Floating Section</p>\r\n', '2025-01-05 09:06:22', 1, 18),
(13, 'Simulasi Pemadaman Api', 3, 'WhatsApp Image 2025-01-03 at 15.43.02.jpeg', '<p><strong>Simulasi Pemadaman Api</strong></p>\r\n\r\n<p>Para pekerja dan mahasiswa magang melakukan proses simulasi pemadaman api</p>\r\n', '2025-01-05 09:07:26', 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `buku_tamu`
--

CREATE TABLE `buku_tamu` (
  `komentar_id` int(11) NOT NULL,
  `komentar_pengirim` varchar(100) NOT NULL,
  `komentar_email` varchar(100) NOT NULL,
  `komentar_isi` text NOT NULL,
  `komentar_status` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `komentar_tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `buku_tamu`
--

INSERT INTO `buku_tamu` (`komentar_id`, `komentar_pengirim`, `komentar_email`, `komentar_isi`, `komentar_status`, `komentar_tgl`) VALUES
(11, 'Chaca', 'nurhaliza@gmail.com', 'websitenya bagus', 'ya', '2016-06-17 11:30:27'),
(12, 'Ryan', 'adriansyach@gmail.com', 'mantap', 'ya', '2016-06-17 11:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `halaman`
--

CREATE TABLE `halaman` (
  `id_hal` int(11) NOT NULL,
  `nm_halaman` varchar(30) NOT NULL,
  `link` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `halaman`
--

INSERT INTO `halaman` (`id_hal`, `nm_halaman`, `link`) VALUES
(1, 'Kontak', 'contact.php'),
(2, 'Tentang Kami', 'about.php'),
(3, 'Buku Tamu', 'buku-tamu.php');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Teknik'),
(2, 'RSD'),
(3, 'HSSE');

-- --------------------------------------------------------

--
-- Table structure for table `kontak_redaksi`
--

CREATE TABLE `kontak_redaksi` (
  `id` int(11) NOT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `no_handphone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kontak_redaksi`
--

INSERT INTO `kontak_redaksi` (`id`, `telp`, `no_handphone`, `email`, `alamat`) VALUES
(1, '0951-356-678', '081234567890', 'aftdeo15@gmail.com', 'Jl. Basuki Rahmat No. 90, Malaingkedi, Kec. Sorong Utara, Kota Sorong');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `pesan_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `subjek` varchar(100) NOT NULL,
  `pesan_isi` text NOT NULL,
  `status` varchar(5) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`pesan_id`, `email`, `pengirim`, `subjek`, `pesan_isi`, `status`, `tanggal`) VALUES
(14, 'nurhaliza@gmail.com', 'Nurhaliza', 'Memantau mesin pompa avtur', 'Berita yang disampaikan menarik!', 'dibac', '2025-01-05 08:27:30'),
(15, 'adriansyach16@gmail.com', 'tes', 'tes', 'tes', 'dibac', '2025-01-06 06:33:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  ADD PRIMARY KEY (`komentar_id`);

--
-- Indexes for table `halaman`
--
ALTER TABLE `halaman`
  ADD PRIMARY KEY (`id_hal`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kontak_redaksi`
--
ALTER TABLE `kontak_redaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`pesan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `buku_tamu`
--
ALTER TABLE `buku_tamu`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `halaman`
--
ALTER TABLE `halaman`
  MODIFY `id_hal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kontak_redaksi`
--
ALTER TABLE `kontak_redaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `pesan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
