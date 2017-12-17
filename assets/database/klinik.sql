-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17 Des 2017 pada 12.36
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
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `email`, `status`) VALUES
(1, ' Nanang', 'Jl. Bungur', '2017-12-02', 'L', ' 0811992288', 'nanang@gmail.com', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(8) NOT NULL,
  `no_rekam_medis` varchar(12) NOT NULL,
  `tanggal` date NOT NULL,
  `status` text NOT NULL,
  `jam_daftar` time NOT NULL,
  `jam_layan` time NOT NULL,
  `no_reg_dokter` varchar(12) NOT NULL,
  `status_pasien` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `no_rekam_medis`, `tanggal`, `status`, `jam_daftar`, `jam_layan`, `no_reg_dokter`, `status_pasien`) VALUES
(1, 'ME21250001', '2017-12-16', 'Menunggu', '12:00:00', '13:00:00', 'DO1250035', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` int(8) NOT NULL,
  `no_rekam_medis` varchar(12) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama_pasien` text NOT NULL,
  `no_telp` text NOT NULL,
  `no_reg_dokter` varchar(12) NOT NULL,
  `status_pasien` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_akun_admin`
--

CREATE TABLE `detail_akun_admin` (
  `id_admin` int(11) NOT NULL,
  `id_user_klinik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_akun_admin`
--

INSERT INTO `detail_akun_admin` (`id_admin`, `id_user_klinik`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_akun_dokter`
--

CREATE TABLE `detail_akun_dokter` (
  `id_dokter` int(11) NOT NULL,
  `id_user_klinik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_akun_dokter`
--

INSERT INTO `detail_akun_dokter` (`id_dokter`, `id_user_klinik`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_akun_perawat`
--

CREATE TABLE `detail_akun_perawat` (
  `id_perawat` int(11) NOT NULL,
  `id_user_klinik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_akun_perawat`
--

INSERT INTO `detail_akun_perawat` (`id_perawat`, `id_user_klinik`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_jasa`
--

CREATE TABLE `detail_transaksi_jasa` (
  `id_transaksi` int(11) NOT NULL,
  `id_jasa` int(11) NOT NULL,
  `biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi_obat`
--

CREATE TABLE `detail_transaksi_obat` (
  `id_transaksi` int(11) NOT NULL,
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
  `no_reg_dokter` varchar(12) NOT NULL,
  `nama_dokter` text NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `no_telp` text NOT NULL,
  `email` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `no_reg_dokter`, `nama_dokter`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `email`, `status`) VALUES
(1, 'DO1250035', '  Asep Lukman Hakim', 'Jl. Bangau Sakti no. 84', '2017-12-01', 'L', '081267357649', 'goodgamerasep@gmail.com', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa`
--

CREATE TABLE `jasa` (
  `id_jasa` int(11) NOT NULL,
  `nama_jasa` text NOT NULL,
  `kategori` int(11) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jasa`
--

INSERT INTO `jasa` (`id_jasa`, `nama_jasa`, `kategori`, `tarif`) VALUES
(1, 'Penambalan', 1, 100000),
(2, 'Mangkok', 3, 10),
(3, 'Piring', 7, 333);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_jasa`
--

CREATE TABLE `kategori_jasa` (
  `id_kategori_jasa` int(11) NOT NULL,
  `nama_kategori_jasa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_jasa`
--

INSERT INTO `kategori_jasa` (`id_kategori_jasa`, `nama_kategori_jasa`) VALUES
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
  `satuan` text NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `satuan`, `stok`, `harga`) VALUES
(1, '  Paracetamol', '  Papan', 20, 25000);

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
(1, 'Jason Prawira Azali', 'Jl. Bangau Sakti', '2017-03-08', '', '0811223344', 'L', 'ME21250001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perawat`
--

CREATE TABLE `perawat` (
  `id_perawat` int(11) NOT NULL,
  `no_reg_perawat` varchar(12) NOT NULL,
  `nama_perawat` text NOT NULL,
  `alamat` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `no_telp` text NOT NULL,
  `email` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `perawat`
--

INSERT INTO `perawat` (`id_perawat`, `no_reg_perawat`, `nama_perawat`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `no_telp`, `email`, `status`) VALUES
(1, 'PE125130001', '  Rihhadatul Aisy Frianti', 'Jl. Bangau Sakti', '2017-01-01', 'P', '081267778888', 'aisy@gmail.com', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_rekam_medis` varchar(12) NOT NULL,
  `no_reg_dokter` varchar(12) NOT NULL,
  `no_reg_perawat` varchar(12) NOT NULL,
  `tanggal` date NOT NULL,
  `diagnosa` text NOT NULL,
  `terapi` text NOT NULL,
  `keterangan` text NOT NULL,
  `jam` time NOT NULL,
  `jenis_pembayaran` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'asep', 'dc855efb0dc7476760afaa1b281665f1', 2),
(3, 'aisy', 'fe5f63a00e379ab137b0c658f186693f', 3),
(4, 'nanang', 'cc8839950896aa17b3224887089241ba', 1);

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
  ADD PRIMARY KEY (`id_antrian`),
  ADD UNIQUE KEY `no_rekam_medis` (`no_rekam_medis`),
  ADD KEY `no_reg_dokter` (`no_reg_dokter`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD UNIQUE KEY `no_rekam_medis` (`no_rekam_medis`),
  ADD KEY `no_reg_dokter` (`no_reg_dokter`);

--
-- Indexes for table `detail_akun_admin`
--
ALTER TABLE `detail_akun_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_user_klinik` (`id_user_klinik`);

--
-- Indexes for table `detail_akun_dokter`
--
ALTER TABLE `detail_akun_dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD KEY `id_user_klinik` (`id_user_klinik`);

--
-- Indexes for table `detail_akun_perawat`
--
ALTER TABLE `detail_akun_perawat`
  ADD PRIMARY KEY (`id_perawat`),
  ADD KEY `id_user_klinik` (`id_user_klinik`);

--
-- Indexes for table `detail_transaksi_jasa`
--
ALTER TABLE `detail_transaksi_jasa`
  ADD PRIMARY KEY (`id_transaksi`,`id_jasa`),
  ADD KEY `id_jasa` (`id_jasa`);

--
-- Indexes for table `detail_transaksi_obat`
--
ALTER TABLE `detail_transaksi_obat`
  ADD PRIMARY KEY (`id_transaksi`,`id_obat`),
  ADD KEY `id_obat` (`id_obat`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`),
  ADD UNIQUE KEY `no_reg` (`no_reg_dokter`);

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id_jasa`);

--
-- Indexes for table `kategori_jasa`
--
ALTER TABLE `kategori_jasa`
  ADD PRIMARY KEY (`id_kategori_jasa`);

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
  ADD PRIMARY KEY (`id_perawat`),
  ADD UNIQUE KEY `no_reg_perawat` (`no_reg_perawat`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `no_rekam_medi` (`no_rekam_medis`),
  ADD KEY `no_reg_dokter` (`no_reg_dokter`),
  ADD KEY `no_reg_perawat` (`no_reg_perawat`);

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
  MODIFY `id_antrian` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_jasa`
--
ALTER TABLE `kategori_jasa`
  MODIFY `id_kategori_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perawat`
--
ALTER TABLE `perawat`
  MODIFY `id_perawat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_klinik`
--
ALTER TABLE `user_klinik`
  MODIFY `id_user_klinik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`no_rekam_medis`) REFERENCES `pasien` (`no_rekam_medis`),
  ADD CONSTRAINT `antrian_ibfk_2` FOREIGN KEY (`no_reg_dokter`) REFERENCES `dokter` (`no_reg_dokter`);

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`no_rekam_medis`) REFERENCES `pasien` (`no_rekam_medis`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`no_reg_dokter`) REFERENCES `dokter` (`no_reg_dokter`);

--
-- Ketidakleluasaan untuk tabel `detail_akun_admin`
--
ALTER TABLE `detail_akun_admin`
  ADD CONSTRAINT `detail_akun_admin_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `detail_akun_admin_ibfk_2` FOREIGN KEY (`id_user_klinik`) REFERENCES `user_klinik` (`id_user_klinik`);

--
-- Ketidakleluasaan untuk tabel `detail_akun_dokter`
--
ALTER TABLE `detail_akun_dokter`
  ADD CONSTRAINT `detail_akun_dokter_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `detail_akun_dokter_ibfk_2` FOREIGN KEY (`id_user_klinik`) REFERENCES `user_klinik` (`id_user_klinik`);

--
-- Ketidakleluasaan untuk tabel `detail_akun_perawat`
--
ALTER TABLE `detail_akun_perawat`
  ADD CONSTRAINT `detail_akun_perawat_ibfk_1` FOREIGN KEY (`id_perawat`) REFERENCES `perawat` (`id_perawat`),
  ADD CONSTRAINT `detail_akun_perawat_ibfk_2` FOREIGN KEY (`id_user_klinik`) REFERENCES `user_klinik` (`id_user_klinik`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksi_jasa`
--
ALTER TABLE `detail_transaksi_jasa`
  ADD CONSTRAINT `detail_transaksi_jasa_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`),
  ADD CONSTRAINT `detail_transaksi_jasa_ibfk_2` FOREIGN KEY (`id_jasa`) REFERENCES `jasa` (`id_jasa`);

--
-- Ketidakleluasaan untuk tabel `detail_transaksi_obat`
--
ALTER TABLE `detail_transaksi_obat`
  ADD CONSTRAINT `detail_transaksi_obat_ibfk_1` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`),
  ADD CONSTRAINT `detail_transaksi_obat_ibfk_2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`no_rekam_medis`) REFERENCES `pasien` (`no_rekam_medis`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`no_reg_dokter`) REFERENCES `dokter` (`no_reg_dokter`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`no_reg_perawat`) REFERENCES `perawat` (`no_reg_perawat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
