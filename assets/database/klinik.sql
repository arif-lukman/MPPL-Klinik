-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12 Jan 2018 pada 17.08
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` text NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `no_telp` text NOT NULL,
  `email` text NOT NULL,
  `status` int(1) NOT NULL,
  `id_user_klinik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `email`, `status`, `id_user_klinik`) VALUES
(1, 'Roby Esta Sunara', 'Jl. Bangau Sakti', '1997-07-04', 'L', '089988776655', 'roby@gmail.com', 1, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(8) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` text NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` text NOT NULL,
  `jam_daftar` time NOT NULL,
  `jam_layan` time NOT NULL,
  `jam_selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `id_pasien`, `nama_pasien`, `id_dokter`, `tanggal`, `status`, `jam_daftar`, `jam_layan`, `jam_selesai`) VALUES
(2, 1, 'Jason Prawira Azali', 1, '2017-12-26', 'Menunggu', '16:25:00', '17:00:00', NULL),
(3, 1, 'Jason Prawira Azali', 1, '2017-12-31', 'Menunggu', '20:48:00', '21:00:00', NULL),
(4, 1, 'Jason Prawira Azali', 1, '2018-01-01', 'Menunggu', '13:21:00', '16:00:00', NULL),
(5, 1, 'Jason Prawira Azali', 2, '2018-01-03', 'Menunggu', '14:42:00', '15:00:00', NULL),
(6, 1, 'Jason Prawira Azali', 1, '2018-01-04', 'Menunggu', '20:17:00', '11:11:00', NULL),
(7, 1, 'Jason Prawira Azali', 2, '2018-01-05', 'Selesai', '16:45:00', '17:00:00', '18:44:00'),
(8, 1, 'Jason Prawira Azali', 3, '2018-01-06', 'Selesai', '00:47:00', '02:00:00', '19:01:00'),
(9, 2, 'Sugeng Hartono', 1, '2018-01-07', 'Selesai', '19:05:00', '20:00:00', '13:07:00'),
(10, 2, 'Sugeng Hartono', 3, '2018-01-07', 'Selesai', '21:01:00', '08:00:00', '15:13:00'),
(11, 1, 'Jason Prawira Azali', 2, '2018-01-08', 'Selesai', '07:51:00', '10:00:00', '06:11:00'),
(12, 4, 'Lukmannil Hakim', 1, '2018-01-08', 'Selesai', '13:45:00', '14:00:00', '07:55:00'),
(13, 2, 'Sugeng Hartono', 2, '2018-01-08', 'Menunggu', '14:06:00', '15:00:00', NULL),
(14, 4, 'Lukmannil Hakim', 2, '2018-01-12', 'Selesai', '20:28:00', '12:00:00', '16:19:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(8) NOT NULL,
  `id_pasien` int(11) DEFAULT NULL,
  `nama_pasien` text NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `no_telp` text NOT NULL,
  `status_pasien` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id_booking`, `id_pasien`, `nama_pasien`, `id_dokter`, `tanggal`, `jam`, `no_telp`, `status_pasien`) VALUES
(1, NULL, 'John Kennedy', 1, '2017-12-02', '12:00:00', '081122334455', 2),
(2, 1, 'Jason Prawira Azali', 1, '2017-12-31', '19:00:00', '082233445566', 1),
(3, 0, 'Lukmannil Hakim', 1, '2018-01-08', '14:00:00', '082233445566', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_diagnosa`
--

CREATE TABLE `detail_diagnosa` (
  `id_transaksi` int(11) NOT NULL,
  `id_detail_diagnosa` int(11) NOT NULL,
  `k1` int(11) DEFAULT NULL,
  `k2` int(11) DEFAULT NULL,
  `k3` int(11) DEFAULT NULL,
  `k4` int(11) DEFAULT NULL,
  `diagnosa` text NOT NULL,
  `id_terapi` int(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `terapi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_diagnosa`
--

INSERT INTO `detail_diagnosa` (`id_transaksi`, `id_detail_diagnosa`, `k1`, `k2`, `k3`, `k4`, `diagnosa`, `id_terapi`, `biaya`, `terapi`) VALUES
(7, 14, 0, 0, 0, 3, 'Ket Diag', 3, 200000, 'Ket Terapi'),
(7, 15, 1, 0, 0, 3, 'Diagnosa', 7, 210000, 'Diagnosaa'),
(8, 16, 0, 3, 0, 0, 'A', 3, 200000, 'A'),
(8, 17, 0, 0, 4, 0, 'B', 40, 1200000, 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_obat`
--

CREATE TABLE `detail_transaksi_obat` (
  `id_transaksi` int(11) NOT NULL,
  `id_detail_transaksi_obat` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(11) NOT NULL,
  `no_reg_dokter` varchar(12) DEFAULT NULL,
  `nama_dokter` text NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `no_telp` text NOT NULL,
  `email` text NOT NULL,
  `status` int(1) NOT NULL,
  `id_user_klinik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `no_reg_dokter`, `nama_dokter`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `email`, `status`, `id_user_klinik`) VALUES
(1, '', 'Arif Lukman Hakim', 'Jl. Bangau Sakti no. 84', '1997-12-01', 'L', '081267357649', 'goodgamerasep@gmail.com', 1, 2),
(2, '', 'Roby Estara Sunara', 'Jl. Bangau Sakti', '1997-04-05', 'L', '0811223344', 'roby@gmail.com', 1, 5),
(3, '', 'Lukmannil Hakim', 'Jl. Garuda Sakti', '2018-02-03', 'L', '08998877363', 'lukman@gmail.com', 2, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_terapi`
--

CREATE TABLE `kategori_terapi` (
  `id_kategori_terapi` int(11) NOT NULL,
  `nama_kategori_terapi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_terapi`
--

INSERT INTO `kategori_terapi` (`id_kategori_terapi`, `nama_kategori_terapi`) VALUES
(1, 'Konsultasi'),
(2, 'Pembersihan Karang Gigi'),
(3, 'Pencabutan Gigi'),
(4, 'Penambalan Gigi'),
(5, 'Perawatan Saluran Akar'),
(6, 'Veneer'),
(7, 'Pemutihan Gigi'),
(8, 'Orthodontic'),
(9, 'Gigi Tiruan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` text NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `id_satuan`, `stok`, `harga`) VALUES
(1, 'Paracetamol', 1, 30, 10000),
(2, 'OBH', 3, 20, 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama_pasien` text NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` text NOT NULL,
  `no_telp` text NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `no_rekam_medis` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama_pasien`, `alamat`, `tanggal_lahir`, `pekerjaan`, `no_telp`, `jenis_kelamin`, `no_rekam_medis`) VALUES
(1, 'Jason Prawira Azali', 'Jl. Bangau Sakti no.84', '1997-01-05', 'Mahasiswa', '082233445566', 'L', '000000000001'),
(2, 'Sugeng Hartono', 'Jl. Kalideres no. 12', '2018-04-24', 'Juragan Bakso', '081288889999', 'L', '000000000002'),
(4, 'Lukmannil Hakim', 'Jl. Garuda Sakti km.1', '1997-01-08', 'Mahasiswa', '081266667777', 'L', '000000000003');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perawat`
--

CREATE TABLE `perawat` (
  `id_perawat` int(11) NOT NULL,
  `no_reg_perawat` varchar(12) DEFAULT NULL,
  `nama_perawat` text NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `no_telp` text NOT NULL,
  `email` text NOT NULL,
  `status` int(1) NOT NULL,
  `id_user_klinik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perawat`
--

INSERT INTO `perawat` (`id_perawat`, `no_reg_perawat`, `nama_perawat`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `email`, `status`, `id_user_klinik`) VALUES
(1, '', 'Rihhadatul Aisy Frianti', 'Jl. Bangau Sakti', '1997-12-26', 'P', '0811223344', 'aisy@gmail.com', 1, 3),
(10, '', 'Mega Bintang Purnama Sari', 'Jl. Sudirman', '1997-01-03', 'P', '0811223344', 'mega@gmail.com', 1, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Papan'),
(3, 'Botol'),
(4, 'Kapsul');

-- --------------------------------------------------------

--
-- Struktur dari tabel `terapi`
--

CREATE TABLE `terapi` (
  `id_terapi` int(11) NOT NULL,
  `nama_terapi` text NOT NULL,
  `kategori` int(11) NOT NULL,
  `tarif_min` int(11) NOT NULL,
  `tarif_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `terapi`
--

INSERT INTO `terapi` (`id_terapi`, `nama_terapi`, `kategori`, `tarif_min`, `tarif_max`) VALUES
(1, 'Konsultasi', 1, 0, 0),
(2, 'Pembersihan Karang Gigi Dewasa Kelas I', 2, 150000, 150000),
(3, 'Pembersihan Karang Gigi Dewasa Kelas II', 2, 200000, 200000),
(4, 'Pembersihan Karang Gigi Dewasa Kelas III', 2, 250000, 300000),
(5, 'Pembersihan Karang Gigi Anak-Anak', 2, 100000, 150000),
(6, 'Pencabutan Standard Dewasa', 3, 150000, 150000),
(7, 'Pencabutan Dengan Komplikasi Dewasa', 3, 200000, 250000),
(8, 'Pencabutan Odontektomi Dewasa', 3, 750000, 750000),
(9, 'Pencabutan Gigi Anak-Anak Dengan Anastesi Topikal', 3, 80000, 80000),
(10, 'Pencabutan Gigi Anak-Anak Dengan Anastesi Injeksi', 3, 100000, 100000),
(11, 'Penambalan Gigi Dewasa (Kecil)', 4, 150000, 150000),
(12, 'Penambalan Gigi Dewasa (Sedang)', 4, 200000, 200000),
(13, 'Penambalan Gigi Dewasa (Besar)', 4, 250000, 300000),
(14, 'Penambalan Gigi Anak-Anak', 4, 100000, 100000),
(15, 'Perawatan Saluran Akar (Kunjungan Pertama)', 5, 100000, 100000),
(16, 'Perawatan Saluran Akar (Dressing)', 5, 80000, 80000),
(17, 'Perawatan Saluran Akar (Obturasi)', 5, 100000, 100000),
(18, 'Direct Veneer', 6, 750000, 32000000),
(19, 'Bleaching Reguler', 7, 1500000, 1500000),
(20, 'Bleaching Premium', 7, 2000000, 2000000),
(21, 'Orthodontic Metal Bracket (RA & RB)', 8, 4000000, 4000000),
(22, 'Kontrol Orthodontic(RA & RB)', 8, 150000, 150000),
(23, 'Kontrol Orthodontic(RA / RB)', 8, 100000, 100000),
(24, 'GTSL Akrilik Unilateral', 9, 400000, 400000),
(25, 'GTSL Akrilik Bilateral', 9, 550000, 550000),
(26, 'Penambahan Gigi GTSL Akrilik', 9, 100000, 3200000),
(27, 'GTSL V Flex Unilateral', 9, 600000, 600000),
(28, 'GTSL V Flex Bilateral', 9, 800000, 800000),
(29, 'Penambahan Gigi GTSL V Flex', 9, 150000, 4800000),
(30, 'GTSL Valplast Unilateral', 9, 850000, 850000),
(31, 'GTSL Valplast Bilateral', 9, 1300000, 1300000),
(32, 'Penambahan Gigi GTSL Valplast', 9, 150000, 4800000),
(33, 'GTSL FRS Unilateral', 9, 1000000, 1000000),
(34, 'GTSL FRS Bilateral', 9, 1500000, 1500000),
(35, 'Penambahan Gigi GTSL FRS', 9, 150000, 4800000),
(36, 'Full Denture Akrilik', 9, 1750000, 3500000),
(37, 'Full Denture V Flex', 9, 2600000, 5000000),
(38, 'Crown PFM', 9, 1200000, 1200000),
(39, 'Crown Full Porcelain', 9, 1700000, 1700000),
(40, 'Bridge PFM', 9, 1200000, 4800000),
(41, 'Bridge Full Porcelain', 9, 1700000, 6800000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_perawat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `metode_pembayaran` text NOT NULL,
  `biaya_total` int(11) NOT NULL,
  `diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pasien`, `id_dokter`, `id_perawat`, `tanggal`, `jam`, `metode_pembayaran`, `biaya_total`, `diskon`) VALUES
(7, 4, 2, 1, '2018-01-12', '15:32:00', 'Kredit', 388000, 3),
(8, 0, 2, 1, '2018-01-12', '16:19:00', 'Tunai', 1120000, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_klinik`
--

CREATE TABLE `user_klinik` (
  `id_user_klinik` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `password` text NOT NULL,
  `jenis_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_klinik`
--

INSERT INTO `user_klinik` (`id_user_klinik`, `username`, `password`, `jenis_user`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'arif', '0ff6c3ace16359e41e37d40b8301d67f', 2),
(3, 'aisy', 'fe5f63a00e379ab137b0c658f186693f', 3),
(4, 'roby', 'c5c5a17bbf5d31171d022fb123416d1a', 1),
(5, 'roby2', 'bef3f47be6f3efef495050ccb6ded9af', 2),
(6, 'lukman', 'b5bbc8cf472072baffe920e4e28ee29c', 2),
(8, 'mega', '91805ec00ad20b85226bec0bacf843d3', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indexes for table `detail_diagnosa`
--
ALTER TABLE `detail_diagnosa`
  ADD PRIMARY KEY (`id_detail_diagnosa`,`id_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `detail_transaksi_obat`
--
ALTER TABLE `detail_transaksi_obat`
  ADD PRIMARY KEY (`id_detail_transaksi_obat`,`id_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indexes for table `kategori_terapi`
--
ALTER TABLE `kategori_terapi`
  ADD PRIMARY KEY (`id_kategori_terapi`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `no_rekam_medis` (`no_rekam_medis`);

--
-- Indexes for table `perawat`
--
ALTER TABLE `perawat`
  ADD PRIMARY KEY (`id_perawat`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `terapi`
--
ALTER TABLE `terapi`
  ADD PRIMARY KEY (`id_terapi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user_klinik`
--
ALTER TABLE `user_klinik`
  ADD PRIMARY KEY (`id_user_klinik`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_diagnosa`
--
ALTER TABLE `detail_diagnosa`
  MODIFY `id_detail_diagnosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detail_transaksi_obat`
--
ALTER TABLE `detail_transaksi_obat`
  MODIFY `id_detail_transaksi_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_terapi`
--
ALTER TABLE `kategori_terapi`
  MODIFY `id_kategori_terapi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perawat`
--
ALTER TABLE `perawat`
  MODIFY `id_perawat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `terapi`
--
ALTER TABLE `terapi`
  MODIFY `id_terapi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_klinik`
--
ALTER TABLE `user_klinik`
  MODIFY `id_user_klinik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_diagnosa`
--
ALTER TABLE `detail_diagnosa`
  ADD CONSTRAINT `detail_diagnosa_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_transaksi_obat`
--
ALTER TABLE `detail_transaksi_obat`
  ADD CONSTRAINT `detail_transaksi_obat_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
