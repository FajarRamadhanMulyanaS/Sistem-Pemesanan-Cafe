-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2025 pada 04.49
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cafebase`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporan` (
`kd_transaksi` int(11)
,`menu` varchar(100)
,`harga` int(11)
,`subtotal` int(11)
,`tgl_transaksi` datetime
,`no_meja` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `q_user`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `q_user` (
`kd_user` int(11)
,`nama` varchar(50)
,`no_hp` varchar(15)
,`username` varchar(50)
,`password` varchar(50)
,`level` varchar(10)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_pesanan`
--

CREATE TABLE `tb_detail_pesanan` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_detail_pesanan`
--

INSERT INTO `tb_detail_pesanan` (`id`, `pesanan_id`, `menu_id`, `jumlah`, `catatan`, `harga`, `total_harga`) VALUES
(3, 4, 59, 1, 'no sugar', 21000, 0),
(8, 9, 69, 2, '', 16000, 0),
(9, 12, 58, 1, '', 18000, 0),
(10, 13, 57, 1, '', 18000, 0),
(11, 14, 57, 1, '', 18000, 0),
(12, 14, 68, 1, '', 18000, 0),
(13, 15, 57, 2, '', 18000, 0),
(14, 16, 61, 1, '', 17000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `kd_kategori` int(11) NOT NULL,
  `kategori` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`kd_kategori`, `kategori`) VALUES
(19, 'Coffe Based'),
(23, 'Makanan Berat'),
(24, 'Ngemil Asin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id`, `user_id`, `menu_id`, `jumlah`, `catatan`, `total_harga`, `created_at`) VALUES
(83, 4, 62, 1, '', 18000, '2024-12-21 14:24:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_menu`
--

CREATE TABLE `tb_menu` (
  `kd_menu` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kd_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_menu`
--

INSERT INTO `tb_menu` (`kd_menu`, `menu`, `jenis`, `harga`, `status`, `foto`, `kd_kategori`) VALUES
(57, 'DOKEN - Doppio Shaken', 'Minuman', 18000, 'Tersedia', 'Gambar WhatsApp 2024-11-20 pukul 14.31.45_669347d2.jpg', 19),
(58, 'KONAS - Kopi Nanas', 'Minuman', 18000, 'Tersedia', 'Gambar WhatsApp 2024-11-20 pukul 14.31.45_d9f38853.jpg', 19),
(59, 'UME - Unggulan Creme', 'Minuman', 21000, 'Tersedia', 'Gambar WhatsApp 2024-11-20 pukul 14.31.44_480bc93d.jpg', 19),
(60, 'DOPUNG - Doppio Unggulan', 'Minuman', 18000, 'Tersedia', 'Gambar WhatsApp 2024-11-20 pukul 14.31.45_b93f85a3.jpg', 19),
(61, 'KOPUNG - Kopi Unggulan', 'Minuman', 17000, 'Tersedia', 'Gambar WhatsApp 2024-11-20 pukul 14.31.45_fadb75b5.jpg', 19),
(62, 'AMON - Americano Lemon', 'Minuman', 18000, 'Tersedia', 'Gambar WhatsApp 2024-11-20 pukul 14.31.44_549e50eb.jpg', 19),
(68, 'Sosis Goreng', 'Makanan', 18000, 'Tersedia', 'sosis-goreng-foto-resep-utama.jpg', 24),
(69, 'Tahu Cabe Lada Garam', 'Makanan', 16000, 'Tersedia', 'tahu-cabe-lada-garam-foto-resep-utama.jpg', 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_meja` int(11) DEFAULT NULL,
  `total_harga` int(11) NOT NULL,
  `status` enum('belum_bayar','sudah_bayar','diproses','selesai','dibatalkan') DEFAULT 'belum_bayar',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id`, `user_id`, `no_meja`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(4, 4, 0, 21000, 'diproses', '2024-12-02 02:04:51', '2024-12-02 03:30:55'),
(9, 4, 0, 32000, 'selesai', '2024-12-02 02:31:02', '2024-12-02 03:39:15'),
(10, 4, 0, 0, 'belum_bayar', '2024-12-02 03:34:46', '2024-12-02 03:34:46'),
(11, 4, 0, 0, 'belum_bayar', '2024-12-02 03:35:19', '2024-12-02 03:35:19'),
(12, 4, 0, 18000, 'sudah_bayar', '2024-12-02 03:35:34', '2024-12-02 03:36:11'),
(13, 4, 0, 18000, 'dibatalkan', '2024-12-02 03:36:50', '2024-12-02 03:37:11'),
(14, 4, 0, 36000, 'belum_bayar', '2024-12-03 08:55:40', '2024-12-03 08:55:40'),
(15, 7, 0, 36000, 'dibatalkan', '2025-06-03 02:22:10', '2025-06-03 02:23:13'),
(16, 7, 0, 17000, 'dibatalkan', '2025-06-03 02:46:17', '2025-06-03 02:46:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `kd_transaksi` int(11) NOT NULL,
  `kd_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `kd_user` int(11) NOT NULL,
  `no_meja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`kd_transaksi`, `kd_menu`, `jumlah`, `subtotal`, `tgl_transaksi`, `kd_user`, `no_meja`) VALUES
(1, 13, 2, 20000, '2019-01-08 14:20:11', 18, 1),
(2, 7000, 10, 70000, '2019-01-09 09:17:28', 0, 17),
(2, 13, 10, 70000, '2019-01-09 09:19:19', 0, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `kd_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`kd_user`, `nama`, `no_hp`, `username`, `password`, `level`) VALUES
(23, 'Fajar Ramadhan', '08979324531', 'Admin1', 'Admin1', 'admin'),
(24, 'Tyan Firzi ', '08912345678', 'owner1', 'owner1', 'Owner'),
(25, 'Tyan', '089289201820', 'dapur1', 'dapur1', 'Dapur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `Nama` varchar(200) DEFAULT NULL,
  `No_Hp` varchar(15) DEFAULT NULL,
  `Username` varchar(60) DEFAULT NULL,
  `Password` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `Nama`, `No_Hp`, `Username`, `Password`) VALUES
(1, 'Fajar Ramadhan ms', '0895630472540', 'fajar', '483c0815eeefbfe60edbbdc9811bd39d'),
(2, 'tyan', '08979324531', 'tyan@gmail.com', '55b99fce0233a33e675b3e596fd7e6d0'),
(3, 'Fajar Ramadhan', '0895630472540', 'fajar04', '8a2ac9bd067544bf3505b6aebe2e08b9'),
(4, 'Fajar Ramadhan', '08979324531', 'Fajar10', 'ba934cd4b0ce58a41067989c50a6fcbe'),
(5, 'Tyan Firzi ', '089563027458', 'TyanF', '88cbefd8c73b6c51164f1cf0f9a51830'),
(6, 'Rizal M', '08912345678', 'Rizal1', '49c158abbcaf49e6012ad8d70b121381'),
(7, 'Fajar Ramadhan', '08973470444', 'fajar', 'be963885b1e3bd7bbe1f6f924458589a');

-- --------------------------------------------------------

--
-- Struktur untuk view `laporan`
--
DROP TABLE IF EXISTS `laporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `laporan`  AS SELECT `tb_transaksi`.`kd_transaksi` AS `kd_transaksi`, `tb_menu`.`menu` AS `menu`, `tb_menu`.`harga` AS `harga`, `tb_transaksi`.`subtotal` AS `subtotal`, `tb_transaksi`.`tgl_transaksi` AS `tgl_transaksi`, `tb_transaksi`.`no_meja` AS `no_meja` FROM (`tb_transaksi` join `tb_menu`) WHERE `tb_transaksi`.`kd_menu` = `tb_menu`.`kd_menu` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `q_user`
--
DROP TABLE IF EXISTS `q_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `q_user`  AS SELECT `tb_user`.`kd_user` AS `kd_user`, `tb_user`.`nama` AS `nama`, `tb_user`.`no_hp` AS `no_hp`, `tb_user`.`username` AS `username`, `tb_user`.`password` AS `password`, `tb_user`.`level` AS `level` FROM `tb_user` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`kd_kategori`),
  ADD KEY `kd_kategori` (`kd_kategori`) USING BTREE;

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`kd_menu`),
  ADD KEY `kd_kategori` (`kd_kategori`) USING BTREE;

--
-- Indeks untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD KEY `kd_user` (`kd_user`) USING BTREE,
  ADD KEY `kd_menu` (`kd_menu`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`kd_user`),
  ADD KEY `kd_user` (`kd_user`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `kd_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `kd_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `kd_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  ADD CONSTRAINT `tb_detail_pesanan_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `tb_pesanan` (`id`),
  ADD CONSTRAINT `tb_detail_pesanan_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `tb_menu` (`kd_menu`);

--
-- Ketidakleluasaan untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD CONSTRAINT `tb_keranjang_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `tb_menu` (`kd_menu`),
  ADD CONSTRAINT `tb_keranjang_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD CONSTRAINT `tb_menu_ibfk_1` FOREIGN KEY (`kd_kategori`) REFERENCES `tb_kategori` (`kd_kategori`);

--
-- Ketidakleluasaan untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
