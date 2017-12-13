-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2017 at 01:26 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `victory`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan_baku` int(11) NOT NULL,
  `kode_item` varchar(45) DEFAULT NULL,
  `nama_item` varchar(40) NOT NULL,
  `ukuran` varchar(30) NOT NULL,
  `tipe_warna` varchar(30) NOT NULL,
  `style` varchar(10) NOT NULL COMMENT 'Carter''s, Gymbore, TCP, K-mart',
  `value` varchar(15) NOT NULL COMMENT 'value dari style/buyer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan_baku`, `kode_item`, `nama_item`, `ukuran`, `tipe_warna`, `style`, `value`) VALUES
(1, 'BRG001', 'Polybag MPP', '1 slide print', 'brown', 'Carter', '10');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pemesanan_produk`
--

CREATE TABLE `detail_pemesanan_produk` (
  `nomor_invoice` char(15) NOT NULL,
  `id_produk` char(5) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengadaan_bahan_baku`
--

CREATE TABLE `detail_pengadaan_bahan_baku` (
  `id_pengadaan_bahan_baku` char(13) NOT NULL,
  `id_bahan_baku` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_supplier`
--

CREATE TABLE `detail_supplier` (
  `id_supplier` char(6) NOT NULL,
  `id_bahan_baku` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kebutuhan_produksi`
--

CREATE TABLE `kebutuhan_produksi` (
  `id_kebutuhan_produksi` char(8) NOT NULL COMMENT 'KP000001',
  `id_produk` char(5) NOT NULL,
  `quantity_produksi` smallint(6) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` char(1) DEFAULT NULL COMMENT '0=ditolak, 1=disetujui'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `komposisi`
--

CREATE TABLE `komposisi` (
  `id_produk` char(5) NOT NULL,
  `id_bahan_baku` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` char(11) NOT NULL COMMENT 'KON00001',
  `nama_konsumen` varchar(50) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_pengadaan_bahan_baku`
--

CREATE TABLE `pembayaran_pengadaan_bahan_baku` (
  `id_pengadaan_bahan_baku` char(13) NOT NULL,
  `bukti_pembayaran` varchar(30) NOT NULL,
  `bon_pembayaran` varchar(30) DEFAULT NULL,
  `status_pembayaran` char(1) DEFAULT NULL COMMENT '0=tidak valid, 1=valid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan_produk`
--

CREATE TABLE `pemesanan_produk` (
  `nomor_invoice` char(15) NOT NULL COMMENT '171106INV093059',
  `id_konsumen` char(11) NOT NULL,
  `status_pemesanan` char(1) NOT NULL DEFAULT 'p' COMMENT 'p=pending, s=diterima, t=ditolak',
  `ketersediaan_produk` char(1) DEFAULT NULL COMMENT '0=kurang/tidak tersedia 1=tersedia',
  `total_pembayaran` bigint(20) NOT NULL,
  `bukti_pembayaran` varchar(30) DEFAULT NULL,
  `status_pembayaran` char(1) DEFAULT NULL COMMENT '0=tidak valid, 1=valid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan_bahan_baku`
--

CREATE TABLE `pengadaan_bahan_baku` (
  `id_pengadaan_bahan_baku` char(13) NOT NULL COMMENT '1711PBB000001',
  `nomor_induk_karyawan` char(6) NOT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_pengajuan` char(1) NOT NULL DEFAULT 'p' COMMENT 'p=pending, s=disetujui, t=ditolak',
  `status_pemesanan` char(1) NOT NULL DEFAULT '0' COMMENT '0=belum diterima oleh supplier, 1=sudah diterima oleh supplier',
  `status_pengadaan` char(1) DEFAULT NULL COMMENT '0=gagal, 1=sukses',
  `id_supplier` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_produk`
--

CREATE TABLE `pengeluaran_produk` (
  `nomor_invoice` char(15) NOT NULL,
  `status_persetujuan` char(1) NOT NULL DEFAULT 'p' COMMENT 'p=pending, s=disetujui, t=ditolak',
  `tanggal_persetujuan` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `nomor_induk_karyawan` char(6) NOT NULL COMMENT 'sesuai NIK perusahaan',
  `email` varchar(50) DEFAULT NULL,
  `bagian` varchar(30) NOT NULL COMMENT 'purchasing, marketing, pimpinan, warehouse spearpart, factory_manager, marketing manager, warehouse fabric, exim dan container',
  `kata_sandi` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`nomor_induk_karyawan`, `email`, `bagian`, `kata_sandi`) VALUES
('000001', 'purchasing@gmail.com', 'purchasing', '04fc711301f3c784d66955d98d399afb'),
('000002', 'marketing@gmail.com', 'marketing', '768c1c687efe184ae6dd2420710b8799'),
('000003', 'pimpinan@gmail.com', 'pimpinan', 'f7a5c99c58103f6b65c451efd0f81826'),
('000004', 'warehouse_spearpart@gmail.com', 'warehouse spearpart', '75891c215fa472036c240d83dddd8b74'),
('000005', 'factory_manager@gmail.com', 'factory manager', 'b69b712f7bd6757ddcda59959c89a2b1'),
('000006', 'marketing_manager@gmail.com', 'marketing manager', '58b2c53441a9db19e159bec686d685d8'),
('000007', 'warehouse_fabric', 'warehouse fabric', '27701bd8dd141b953b94a5c9a44697c0'),
('000008', 'exim_container@gmail.com', 'exim dan container', '7f7d5f9f3a660f2b09e3aae62a15e29b');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman_produk`
--

CREATE TABLE `pengiriman_produk` (
  `nomor_invoice` char(15) NOT NULL,
  `status_persetujuan` char(1) NOT NULL DEFAULT 'p' COMMENT 'p=pending, s=disetujui, t=ditolak',
  `tanggal_persetujuan` timestamp NULL DEFAULT NULL,
  `status_pengiriman` char(1) DEFAULT NULL COMMENT '0=belum dikirim,  1=sudah dikirim, s=sudah sampai/diterima oleh pelanggan',
  `tanggal_pengiriman` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peramalan`
--

CREATE TABLE `peramalan` (
  `id_peramalan` int(11) NOT NULL,
  `periode` datetime NOT NULL,
  `id_produk` char(5) NOT NULL,
  `hasil_peramalan` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `persediaan_bahan_baku`
--

CREATE TABLE `persediaan_bahan_baku` (
  `id_bahan_baku` int(11) NOT NULL,
  `nomor_po` varchar(60) DEFAULT NULL,
  `id_supplier` char(6) NOT NULL,
  `stok_awal` smallint(6) NOT NULL DEFAULT '0',
  `quantity_order` smallint(6) NOT NULL DEFAULT '0',
  `outgoing_produksi` smallint(6) NOT NULL DEFAULT '0',
  `balance_stok_akhir` smallint(6) NOT NULL DEFAULT '0',
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` char(5) NOT NULL COMMENT 'PR001',
  `nama_produk` varchar(30) NOT NULL,
  `gambar_produk` varchar(30) NOT NULL DEFAULT 'produk.jpg',
  `style` char(5) NOT NULL COMMENT 'WH001',
  `deskripsi` text,
  `warna` varchar(40) NOT NULL,
  `harga` int(11) NOT NULL DEFAULT '0',
  `safety_stock` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar_produk`, `style`, `deskripsi`, `warna`, `harga`, `safety_stock`) VALUES
('PR001', 'Kaos', 'produk.jpg', 'polo', 'import grade A', 'hitam', 100000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` char(6) NOT NULL COMMENT 'SUP001',
  `nama_supplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `waktu_pengiriman` tinyint(4) DEFAULT NULL,
  `nama_pengguna` varchar(20) NOT NULL,
  `kata_sandi` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat`, `no_telp`, `email`, `waktu_pengiriman`, `nama_pengguna`, `kata_sandi`) VALUES
('SUP001', 'PT. ILJIN', 'Bandung', '022264533', 'mail@iljin.com', 2, 'supplier', '99b0e8da24e29e4ccb5d7d76e677c2ac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan_baku`);

--
-- Indexes for table `detail_pemesanan_produk`
--
ALTER TABLE `detail_pemesanan_produk`
  ADD KEY `nomor_invoice` (`nomor_invoice`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `detail_pengadaan_bahan_baku`
--
ALTER TABLE `detail_pengadaan_bahan_baku`
  ADD KEY `id_pengadaan_bahan_baku` (`id_pengadaan_bahan_baku`),
  ADD KEY `id_bahan_baku` (`id_bahan_baku`);

--
-- Indexes for table `detail_supplier`
--
ALTER TABLE `detail_supplier`
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_bahan_baku` (`id_bahan_baku`);

--
-- Indexes for table `kebutuhan_produksi`
--
ALTER TABLE `kebutuhan_produksi`
  ADD PRIMARY KEY (`id_kebutuhan_produksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `komposisi`
--
ALTER TABLE `komposisi`
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_bahan_baku` (`id_bahan_baku`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `pembayaran_pengadaan_bahan_baku`
--
ALTER TABLE `pembayaran_pengadaan_bahan_baku`
  ADD KEY `id_pengadaan_bahan_baku` (`id_pengadaan_bahan_baku`);

--
-- Indexes for table `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  ADD PRIMARY KEY (`nomor_invoice`),
  ADD KEY `id_konsumen` (`id_konsumen`);

--
-- Indexes for table `pengadaan_bahan_baku`
--
ALTER TABLE `pengadaan_bahan_baku`
  ADD PRIMARY KEY (`id_pengadaan_bahan_baku`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `nomor_induk_karyawan` (`nomor_induk_karyawan`);

--
-- Indexes for table `pengeluaran_produk`
--
ALTER TABLE `pengeluaran_produk`
  ADD KEY `nomor_invoice` (`nomor_invoice`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`nomor_induk_karyawan`);

--
-- Indexes for table `pengiriman_produk`
--
ALTER TABLE `pengiriman_produk`
  ADD KEY `nomor_invoice` (`nomor_invoice`);

--
-- Indexes for table `peramalan`
--
ALTER TABLE `peramalan`
  ADD PRIMARY KEY (`id_peramalan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `persediaan_bahan_baku`
--
ALTER TABLE `persediaan_bahan_baku`
  ADD KEY `id_bahan_baku` (`id_bahan_baku`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `nama_pengguna_supplier` (`nama_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bahan_baku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `peramalan`
--
ALTER TABLE `peramalan`
  MODIFY `id_peramalan` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pemesanan_produk`
--
ALTER TABLE `detail_pemesanan_produk`
  ADD CONSTRAINT `fk_id_produk_dibeli` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nomor_invoice` FOREIGN KEY (`nomor_invoice`) REFERENCES `pemesanan_produk` (`nomor_invoice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_pengadaan_bahan_baku`
--
ALTER TABLE `detail_pengadaan_bahan_baku`
  ADD CONSTRAINT `fk_id_bahan_baku_dibeli` FOREIGN KEY (`id_bahan_baku`) REFERENCES `bahan_baku` (`id_bahan_baku`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_pengadaan_bahan_baku` FOREIGN KEY (`id_pengadaan_bahan_baku`) REFERENCES `pengadaan_bahan_baku` (`id_pengadaan_bahan_baku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_supplier`
--
ALTER TABLE `detail_supplier`
  ADD CONSTRAINT `fk_id_bahan_baku` FOREIGN KEY (`id_bahan_baku`) REFERENCES `bahan_baku` (`id_bahan_baku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kebutuhan_produksi`
--
ALTER TABLE `kebutuhan_produksi`
  ADD CONSTRAINT `fk_id_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komposisi`
--
ALTER TABLE `komposisi`
  ADD CONSTRAINT `fk_id_bahan_baku_komposisi` FOREIGN KEY (`id_bahan_baku`) REFERENCES `bahan_baku` (`id_bahan_baku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_produk_komposisi` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran_pengadaan_bahan_baku`
--
ALTER TABLE `pembayaran_pengadaan_bahan_baku`
  ADD CONSTRAINT `fk_id_pengadaan_bahan_baku_harus_dbayar` FOREIGN KEY (`id_pengadaan_bahan_baku`) REFERENCES `pengadaan_bahan_baku` (`id_pengadaan_bahan_baku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemesanan_produk`
--
ALTER TABLE `pemesanan_produk`
  ADD CONSTRAINT `fk_id_konsumen` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`) ON UPDATE CASCADE;

--
-- Constraints for table `pengadaan_bahan_baku`
--
ALTER TABLE `pengadaan_bahan_baku`
  ADD CONSTRAINT `fk_id_suplier_terpilih` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nomor_induk_karyawan` FOREIGN KEY (`nomor_induk_karyawan`) REFERENCES `pengguna` (`nomor_induk_karyawan`) ON UPDATE CASCADE;

--
-- Constraints for table `pengeluaran_produk`
--
ALTER TABLE `pengeluaran_produk`
  ADD CONSTRAINT `fk_nomor_invoice_pengeluaran_produk` FOREIGN KEY (`nomor_invoice`) REFERENCES `pemesanan_produk` (`nomor_invoice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengiriman_produk`
--
ALTER TABLE `pengiriman_produk`
  ADD CONSTRAINT `fk_nomor_invoice_pengiriman` FOREIGN KEY (`nomor_invoice`) REFERENCES `pemesanan_produk` (`nomor_invoice`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peramalan`
--
ALTER TABLE `peramalan`
  ADD CONSTRAINT `fk_id_produk_peramalan` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `persediaan_bahan_baku`
--
ALTER TABLE `persediaan_bahan_baku`
  ADD CONSTRAINT `fk_bahan_baku` FOREIGN KEY (`id_bahan_baku`) REFERENCES `bahan_baku` (`id_bahan_baku`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
