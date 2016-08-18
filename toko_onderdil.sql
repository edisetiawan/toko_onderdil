-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2016 at 08:58 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toko_onderdil`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_balas_guest`
--

CREATE TABLE IF NOT EXISTS `tbl_balas_guest` (
`id_balas` int(11) NOT NULL,
  `tgl_balas` date NOT NULL,
  `balasan` text NOT NULL,
  `id_guest` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_balas_guest`
--

INSERT INTO `tbl_balas_guest` (`id_balas`, `tgl_balas`, `balasan`, `id_guest`, `id_user`) VALUES
(1, '2015-08-23', '<p>Balasan sample pesan&nbsp;</p>', 2, 1),
(4, '2015-09-01', '<p>sudah dibalas</p>', 4, 1),
(5, '2016-04-19', 'Bawa saja vespa kamu kebengkel kami boss pasti digarap', 5, 1),
(6, '2016-04-06', 'Bisa mas brow, datang saja ke bengkel', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_balas_komen`
--

CREATE TABLE IF NOT EXISTS `tbl_balas_komen` (
`id_balas_komen` int(11) NOT NULL,
  `id_komentar` int(11) NOT NULL,
  `tgl_balas` date NOT NULL,
  `isi_balasan` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_balas_komen`
--

INSERT INTO `tbl_balas_komen` (`id_balas_komen`, `id_komentar`, `tgl_balas`, `isi_balasan`, `id_user`) VALUES
(1, 1, '2016-04-06', 'Balasan komentar anda sudah dilakukan', 1),
(2, 2, '2016-06-30', 'baik', 1),
(3, 3, '2016-06-30', 'ok', 1),
(4, 4, '0000-00-00', '', 0),
(5, 5, '2016-06-30', 'ok 3', 1),
(6, 6, '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biaya_kirim`
--

CREATE TABLE IF NOT EXISTS `tbl_biaya_kirim` (
`id_biaya` int(11) NOT NULL,
  `nama_kota` varchar(30) NOT NULL,
  `biaya` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=669 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_biaya_kirim`
--

INSERT INTO `tbl_biaya_kirim` (`id_biaya`, `nama_kota`, `biaya`) VALUES
(1, 'Yogyakarta', 15000),
(2, 'Magelang', 10000),
(666, 'Purworejo (COD)', 0),
(667, 'Purwakarta', 25000),
(668, 'Surabaya', 35000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detil_order`
--

CREATE TABLE IF NOT EXISTS `tbl_detil_order` (
`id_detil_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jml_order` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detil_order`
--

INSERT INTO `tbl_detil_order` (`id_detil_order`, `id_produk`, `jml_order`, `id_order`) VALUES
(1, 4, 2, 2),
(2, 1, 1, 3),
(3, 3, 2, 3),
(4, 2, 3, 4),
(5, 4, 1, 4),
(6, 1, 1, 5),
(7, 2, 1, 6),
(8, 3, 2, 7),
(9, 2, 1, 8),
(10, 4, 1, 9),
(11, 3, 2, 10),
(12, 2, 1, 11),
(13, 1, 1, 12),
(14, 3, 5, 13),
(15, 2, 3, 14),
(16, 1, 2, 15),
(17, 2, 3, 16),
(18, 3, 5, 17),
(19, 4, 1, 17),
(20, 3, 1, 18),
(21, 1, 1, 18),
(22, 4, 2, 19),
(23, 7, 10, 20),
(24, 5, 1, 21),
(25, 4, 1, 22),
(26, 3, 1, 23),
(27, 1, 1, 24),
(28, 2, 1, 24),
(29, 2, 1, 25),
(30, 6, 1, 26),
(31, 2, 2, 27),
(32, 7, 1, 28),
(33, 8, 1, 29),
(34, 7, 1, 29),
(35, 2, 1, 30),
(36, 5, 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detil_pembelian`
--

CREATE TABLE IF NOT EXISTS `tbl_detil_pembelian` (
`id_detil_beli` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jml_beli` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `id_beli` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_detil_pembelian`
--

INSERT INTO `tbl_detil_pembelian` (`id_detil_beli`, `id_produk`, `jml_beli`, `harga_beli`, `id_beli`) VALUES
(1, 1, 3, 48500, 1),
(2, 2, 4, 25000, 2),
(3, 4, 3, 248000, 1),
(5, 3, 5, 10000, 5),
(6, 2, 5, 25000, 6),
(7, 6, 3, 65000, 6),
(8, 1, 2, 48500, 7),
(9, 7, 25, 40, 8),
(10, 3, 10, 10000, 9),
(11, 1, 1, 48500, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_galeri`
--

CREATE TABLE IF NOT EXISTS `tbl_galeri` (
`id_galeri` int(11) NOT NULL,
  `judul_galeri` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `tgl_posting` date NOT NULL,
  `keterangan` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_galeri`
--

INSERT INTO `tbl_galeri` (`id_galeri`, `judul_galeri`, `image`, `permalink`, `tgl_posting`, `keterangan`, `id_user`) VALUES
(1, 'Vespa', 'public/media/galeri/vespa.jpg', 'Vespa', '2016-03-21', '<p>Vespa</p>', 1),
(2, 'Vespa Kayu', 'public/media/galeri/vespa-kayu-3.jpg', 'Vespa-Kayu', '2016-03-30', '<p>Vespa Kayu</p>', 1),
(3, 'Vespa Mini', 'public/media/galeri/vespa-mini-3.jpg', 'Vespa-Mini', '2016-03-30', '<p>Vespa Mini</p>', 1),
(4, 'Vespa Putih', 'public/media/galeri/IMG_0188.jpg', 'Vespa-Putih', '2016-03-30', '<p>Vespa Putih</p>', 1),
(5, 'Scooter', 'public/media/galeri/Babeh-Scooter-Condet-04.jpg', 'Scooter', '2016-03-30', '<p>Scooter</p>', 1),
(6, 'Vespa', 'public/media/galeri/vespa1.jpg', 'Vespa', '2016-07-30', '<p>Vespa</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guestbook`
--

CREATE TABLE IF NOT EXISTS `tbl_guestbook` (
`id_guest` int(11) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tgl_guest` date NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_guestbook`
--

INSERT INTO `tbl_guestbook` (`id_guest`, `nama_lengkap`, `email`, `tgl_guest`, `pesan`) VALUES
(2, 'Rahmat Agil', 'agil_sr@yahoo.com', '2016-04-05', 'sample pesan'),
(4, 'Syarifudin', 'SyariefUdin90@gmail.com', '2016-04-05', 'sementara'),
(5, 'Samsul Bahri', 'samsul@gmail.com', '2016-04-06', ' kalo mau merakit vespa gimana bos ?'),
(6, 'ahamdi', 'ahmatim@yahoo.com', '2016-04-06', ' bos kalo mau ngecat body vespa bisa tidak ya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE IF NOT EXISTS `tbl_kategori` (
`id_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Artikel'),
(2, 'Berita'),
(3, 'Pengumuman'),
(4, 'Iklan Promosi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori_produk`
--

CREATE TABLE IF NOT EXISTS `tbl_kategori_produk` (
`id_kategori_produk` int(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori_produk`
--

INSERT INTO `tbl_kategori_produk` (`id_kategori_produk`, `nama_kategori`) VALUES
(1, 'Kelistrikan'),
(2, 'Pengapian'),
(3, 'Acessoris & Variasi'),
(4, 'Kaki-Kaki'),
(5, 'Body');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_komentar`
--

CREATE TABLE IF NOT EXISTS `tbl_komentar` (
`id_komentar` int(11) NOT NULL,
  `id_posting` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tgl_komentar` date NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_komentar`
--

INSERT INTO `tbl_komentar` (`id_komentar`, `id_posting`, `isi_komentar`, `tgl_komentar`, `nama_lengkap`, `email`) VALUES
(1, 6, ' Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type an', '2016-04-06', 'Samsul Bahri', 'samsul@gmail.com'),
(2, 6, 'testing ', '2016-06-30', 'babat', 'babat@gmail.com'),
(3, 5, ' yes', '2016-06-30', 'babat', 'babat@gmail.com'),
(4, 6, ' tes komentar', '2016-06-30', 'sample', 'sample@gmail.com'),
(5, 6, 'test4 ', '2016-06-30', 'marmut', 'marrmu123@gmail.com'),
(6, 5, 'komentar ke 2 ', '2016-06-30', 'MArco', 'marco_melandri@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE IF NOT EXISTS `tbl_level` (
`id_level` int(3) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`id_level`, `level`) VALUES
(1, 'Admin'),
(2, 'Operator'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi`
--

CREATE TABLE IF NOT EXISTS `tbl_lokasi` (
`id_lokasi` int(3) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `nama_lokasi` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id_lokasi`, `latitude`, `longitude`, `nama_lokasi`, `keterangan`, `id_user`) VALUES
(1, -7.7237084, 109.9033684, 'Sigit Vespa', 'Jalan perbatasan kota Desa Kalianyar, Kecamatan Kutoarjo, Kabupaten Purworejo,', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE IF NOT EXISTS `tbl_member` (
`id_member` int(11) NOT NULL,
  `nama_member` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_registrasi` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id_member`, `nama_member`, `no_telp`, `email`, `alamat`, `tgl_registrasi`) VALUES
(1, 'Administrator', '0274765890', 'administrator@gmail.com', 'Purworejo', '2015-12-01'),
(2, 'Decepticon', '089668341753', 'master.been@gmail.com', 'Sariharjo ngaglik sleman', '2015-10-01'),
(3, 'Nemo', '089668341754', 'speedway037@gmail.com', 'Jl.Kaliurang Km 9', '2015-10-05'),
(4, 'Kevin', '089668431753', 'minion@gmail.com', 'Bekasi Barat', '2015-09-30'),
(10, 'Sumanto', '081289134567', 'chombet_honda@yahoo.com', 'Magelang', '2016-04-19'),
(12, 'Rahmat Afandi', '0896674321678', 'chombet.yuansa@gmail.com', 'Purworejo', '2016-04-20'),
(13, 'babat', '0865566666666', 'babat@gmail.com', 'magelang', '2016-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
`id_menu` int(3) NOT NULL,
  `menu_nama` varchar(100) NOT NULL,
  `menu_uri` varchar(100) NOT NULL,
  `menu_allowed` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `menu_nama`, `menu_uri`, `menu_allowed`) VALUES
(1, 'Kategori', 'admin/kategori/index', '+1+'),
(2, 'Profil', 'admin/profil/index', '+1+'),
(3, 'Pengguna', 'admin/pengguna/index', '+1+2+'),
(4, 'Posting', 'admin/posting/index', '+1+2+'),
(5, 'Galeri', 'admin/galeri/index', '+1+2+'),
(6, 'Guestbook', 'admin/guestbook/index', '+1+2+3+'),
(7, 'Penjualan', 'admin/order_pesanan/index', '+1+2+'),
(8, 'Pembelian', 'admin/pembelian/index', '+1+2+'),
(9, 'Biaya Kirim', 'admin/biaya_kirim/index', '+1+2+'),
(10, 'Komentar', 'admin/komentar/index', '+1+2+');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
`id_order` int(11) NOT NULL,
  `no_order` varchar(10) NOT NULL,
  `tgl_order` date NOT NULL,
  `status_order` int(1) NOT NULL,
  `alamat_kirim` text NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_biaya` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id_order`, `no_order`, `tgl_order`, `status_order`, `alamat_kirim`, `id_member`, `id_biaya`) VALUES
(2, 'NO-0000001', '2016-04-08', 1, 'Magelang Kota', 4, 2),
(3, 'NO-0000002', '2016-04-08', 1, 'Jl. KAliurang KM 9 Yogyakarta', 4, 1),
(4, 'NO-0000003', '2016-04-09', 1, 'Jl. KAliurang KM 9 Yogyakarta', 3, 1),
(5, 'NO-0000004', '2016-04-09', 2, 'Purworejo Kota', 3, 666),
(6, 'NO-0000005', '2016-04-09', 2, 'Purworejo Kota', 3, 666),
(7, 'NO-0000006', '2016-04-12', 1, 'purworejo', 4, 666),
(8, 'NO-0000007', '2016-04-13', 1, 'purworejo', 4, 666),
(9, 'NO-0000008', '2016-04-19', 1, 'Magelang Kota', 10, 2),
(10, 'NO-0000009', '2016-04-19', 1, 'Magelang Kota', 10, 2),
(11, 'NO-0000010', '2016-04-19', 1, 'Magelang Kota', 10, 2),
(12, 'NO-0000011', '2016-04-19', 1, 'Magelang Kota', 10, 2),
(13, 'NO-0000012', '2016-04-19', 1, 'Yogyakarta', 3, 1),
(14, 'NO-0000013', '2016-04-19', 1, 'Yogyakarta', 3, 1),
(15, 'NO-0000014', '2016-04-19', 1, 'Magelang Kota', 10, 2),
(16, 'NO-0000015', '2016-04-20', 1, 'Purworejo kota', 12, 666),
(17, 'NO-0000016', '2016-04-20', 1, 'Purworejo kota', 12, 666),
(18, 'NO-0000017', '2016-04-20', 1, 'Yogyakarta', 3, 1),
(19, 'NO-0000018', '2016-04-20', 1, '', 3, 1),
(20, 'NO-0000019', '2016-06-30', 1, 'surabaya', 4, 668),
(21, 'NO-0000020', '2016-06-30', 1, 'yogyakarta', 4, 1),
(22, 'NO-0000021', '2016-06-30', 1, 'magelang', 3, 2),
(23, 'NO-0000022', '2016-06-30', 1, '', 3, 666),
(24, 'NO-0000023', '2016-07-27', 1, 'jalan kaliurang km 9 sleman yogyakarta', 4, 1),
(25, 'NO-0000024', '2016-07-28', 1, 'purworejo', 3, 666),
(26, 'NO-0000025', '2016-07-28', 1, 'magelang', 3, 2),
(27, 'NO-0000026', '2016-07-30', 1, 'Purwakarta', 4, 667),
(28, 'NO-0000027', '2016-07-30', 2, 'yogyakarta', 10, 1),
(29, 'NO-0000028', '2016-07-30', 1, 'yogyakarta km.14', 10, 666),
(30, 'NO-0000029', '2016-08-08', 1, 'MAgelang', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
`id_bayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `no_transfer` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `jml_bayar` double NOT NULL,
  `tagihan` double NOT NULL,
  `pelunasan` double NOT NULL,
  `status_bayar` varchar(6) NOT NULL,
  `id_order` int(11) NOT NULL,
  `metode` int(1) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembayaran`
--

INSERT INTO `tbl_pembayaran` (`id_bayar`, `tgl_bayar`, `no_transfer`, `image`, `permalink`, `jml_bayar`, `tagihan`, `pelunasan`, `status_bayar`, `id_order`, `metode`, `id_member`) VALUES
(1, '0000-00-00', '', '', '', 0, 510000, 0, 'Kurang', 2, 1, 4),
(2, '0000-00-00', '098765', '', '098765', 82000, 82000, 0, 'Lunas', 3, 1, 4),
(3, '2016-04-19', '112233456', 'public/media/pembayaran/WIN_20160409_0944482.JPG', '112233456', 336000, 336000, 0, 'Lunas', 4, 1, 3),
(4, '2016-04-11', '0', '', '', 55000, 55000, 0, 'Lunas', 5, 2, 3),
(5, '2016-04-11', '0', '', '', 37000, 37000, 0, 'Lunas', 6, 2, 3),
(6, '0000-00-00', '', '', '', 0, 22000, 0, 'Kurang', 7, 2, 4),
(7, '0000-00-00', '', '', '', 0, 27000, 0, 'Kurang', 8, 2, 4),
(8, '2016-04-19', '7654321', 'public/media/pembayaran/WIN_20160409_094448.JPG', '7654321', 260000, 260000, 0, 'Lunas', 9, 1, 10),
(9, '2016-04-19', '43256789', 'public/media/pembayaran/WIN_20160409_0944481.JPG', '43256789', 32000, 32000, 0, 'Lunas', 10, 1, 10),
(10, '0000-00-00', '', '', '', 0, 37000, 0, 'Kurang', 11, 1, 10),
(11, '0000-00-00', '', '', '', 0, 65000, 0, 'Kurang', 12, 1, 10),
(12, '2016-04-19', '12349876', 'public/media/pembayaran/WIN_20160409_0944483.JPG', '12349876', 60000, 60000, 0, 'Lunas', 13, 1, 3),
(13, '0000-00-00', '', '', '', 0, 86000, 0, 'Kurang', 14, 1, 3),
(14, '2016-04-19', '01234567', '', '01234567', 120000, 120000, 0, 'Lunas', 15, 1, 10),
(15, '0000-00-00', '', '', '', 0, 81000, 0, 'Kurang', 16, 2, 12),
(16, '0000-00-00', '', '', '', 0, 305000, 0, 'Kurang', 17, 2, 12),
(17, '2016-07-30', '999999', 'public/media/pembayaran/WIN_20160409_0944488.JPG', '999999', 71000, 71000, 0, 'Lunas', 18, 1, 3),
(18, '0000-00-00', '', '', '', 0, 505000, 0, 'Kurang', 19, 2, 3),
(19, '0000-00-00', '', '', '', 0, 535000, 0, 'Kurang', 20, 1, 4),
(20, '0000-00-00', '', '', '', 0, 1515000, 0, 'Kurang', 21, 1, 4),
(21, '2016-07-30', '777777', 'public/media/pembayaran/WIN_20160409_0944489.JPG', '777777', 260000, 260000, 0, 'Lunas', 22, 1, 3),
(22, '0000-00-00', '', '', '', 0, 21000, 0, 'Kurang', 23, 2, 3),
(23, '2016-07-27', '12345', 'public/media/pembayaran/WIN_20160409_0944484.JPG', '12345', 97000, 97000, 0, 'Lunas', 24, 1, 4),
(24, '2016-07-30', '0', '', '', 27000, 27000, 0, 'Lunas', 25, 2, 3),
(25, '2016-07-28', '1234', 'public/media/pembayaran/WIN_20160409_0944487.JPG', '1234', 80000, 80000, 0, 'Lunas', 26, 1, 3),
(26, '0000-00-00', '', '', '', 0, 79000, 0, 'Kurang', 27, 1, 4),
(27, '2016-07-30', '1234567', 'public/media/pembayaran/WIN_20160409_09444810.JPG', '1234567', 65000, 65000, 0, 'Lunas', 28, 1, 10),
(28, '0000-00-00', '', '', '', 0, 250000, 0, 'Kurang', 29, 2, 10),
(29, '0000-00-00', '', '', '', 0, 3037000, 0, 'Kurang', 30, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian`
--

CREATE TABLE IF NOT EXISTS `tbl_pembelian` (
`id_beli` int(11) NOT NULL,
  `no_beli` varchar(10) NOT NULL,
  `tgl_beli` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `status_beli` int(1) NOT NULL,
  `total_beli` double NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_suplier` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`id_beli`, `no_beli`, `tgl_beli`, `tgl_diterima`, `status_beli`, `total_beli`, `id_user`, `id_suplier`) VALUES
(1, 'BL-0000001', '2016-04-12', '2016-04-18', 2, 889500, 1, 1),
(2, 'BL-0000002', '2016-04-12', '2016-04-15', 2, 100000, 1, 2),
(5, 'BL-0000003', '2016-04-18', '0000-00-00', 1, 50000, 1, 3),
(6, 'BL-0000004', '2016-04-23', '1970-01-01', 1, 320000, 1, 2),
(7, 'BL-0000005', '2016-06-30', '2016-07-02', 2, 97000, 1, 1),
(8, 'BL-0000006', '2016-06-30', '1970-01-01', 2, 1000000, 1, 7),
(9, 'BL-0000007', '2016-07-27', '1970-01-01', 1, 100000, 1, 3),
(10, 'BL-0000008', '2016-07-28', '2016-07-30', 2, 48500, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posting`
--

CREATE TABLE IF NOT EXISTS `tbl_posting` (
`id_posting` int(11) NOT NULL,
  `judul_posting` varchar(255) NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `isi_posting` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_posting`
--

INSERT INTO `tbl_posting` (`id_posting`, `judul_posting`, `permalink`, `image`, `isi_posting`, `tgl_posting`, `id_kategori`, `id_user`) VALUES
(1, 'Modifikasi Vespa', 'Modifikasi-Vespa', 'public/media/posts/Babeh-Scooter-Condet-04.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>', '2015-09-20', 1, 1),
(2, 'Desain Vespa', 'Desain-Vespa', 'public/media/posts/vespa-gs-vs12.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>', '2016-03-30', 3, 1),
(3, 'Bengkel Vespa', 'Bengkel-Vespa', 'public/media/posts/bengkel3.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>', '2016-03-30', 3, 1),
(6, 'Kontes Modifikasi Vespa', 'Kontes-Modifikasi-Vespa', 'public/media/posts/vespa-kayu-3.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>', '2016-03-30', 3, 1),
(5, 'Komunitas Vespa', 'Komunitas-Vespa', 'public/media/posts/komunitas-vespa1.jpg', '<p>&nbsp;Qui ut ceteros comprehensam. Cu eos sale sanctus eligendi, id ius elitr saperet, ocurreret pertinacia pri an. No mei nibh consectetuer, semper laoreet perfecto ad qui, est rebum nulla argumentum ei. Fierent adipisci iracundia est ei, usu timeam persius ea. Usu ea justo malis, pri quando everti electram ei.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting  industry. Lorem Ipsum has been the industry''s standard dummy text ever  since the 1500s, when an unknown printer took a galley of type and  scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining  essentially unchanged. It was popularised in the 1960s with the release  of Letraset sheets containing Lorem Ipsum passages, and more recently  with desktop publishing software like Aldus PageMaker including versions  of Lorem Ipsum.</p>', '2016-03-30', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE IF NOT EXISTS `tbl_produk` (
`id_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `produk_sku` varchar(30) NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `harga_beli` double NOT NULL,
  `manufaktur` varchar(30) NOT NULL,
  `keterangan` text NOT NULL,
  `jml` int(3) NOT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `id_suplier` int(3) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `produk_sku`, `permalink`, `image`, `harga`, `harga_beli`, `manufaktur`, `keterangan`, `jml`, `id_kategori_produk`, `id_suplier`) VALUES
(1, 'Koil Super Sprint PXE', 'KL-001', 'Koil-Vespa-Super-Sprint-PXE', 'public/media/produk/Koil-Vespa-Super-Sprint-PXE.jpg', 55000, 48500, '', '<p>Koil vespa Super</p>', 12, 2, 1),
(2, 'Spul Platina', 'KL-002', 'Spul-Platina', 'public/media/produk/Spul-Platina.jpg', 27000, 25000, '', '<p>Spul Platina Vespa</p>', 2, 1, 2),
(3, 'Busi', 'PA-001', 'Busi', 'public/media/produk/12011356_961582043883325_2354596089541382266_n.jpg', 11000, 10000, '', '<p>busi Vespa</p>', 0, 2, 3),
(4, 'Knalpot Racing', 'AS-001', 'Knalpot-Racing', 'public/media/produk/b52e5afc-8921-494d-97ef-280f627c6686.jpg', 250000, 248000, '', '<p>Knalpot Racing</p>', 8, 3, 1),
(5, 'Body Vespa', 'B-001', 'Body-Vespa', 'public/media/produk/IMG_0188.jpg', 1500000, 1300000, '', '<p>Bodi vespa tanpa engine</p>', 2, 5, 6),
(6, 'Karburator Sparco', 'PA-002', 'Karburator-Sparco', 'public/media/produk/Carburator_Spaco_24_24_Asli.jpg', 70000, 65000, 'Sparco', '<p>Karburator khusus Vespa</p>', 9, 2, 2),
(7, 'kuil', 'BL-03', 'kuil', 'public/media/produk/2015-11-27T19_45_06+07_00.jpg', 50000, 40000, '', '<p>koil tidak untuk motor bebek</p>', 18, 3, 7),
(8, 'Crankcaft', 'C-001', 'Crankcaft', 'public/media/produk/Crankshaft+STANDARD+rotary+valve+Vespa+PX200.jpg', 175000, 150000, '', '', 10, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profil`
--

CREATE TABLE IF NOT EXISTS `tbl_profil` (
`id_profil` int(11) NOT NULL,
  `judul_profil` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `isi_profil` text NOT NULL,
  `tgl_posting` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_profil`
--

INSERT INTO `tbl_profil` (`id_profil`, `judul_profil`, `image`, `permalink`, `isi_profil`, `tgl_posting`, `id_user`) VALUES
(1, 'Tentang Kami', 'public/media/posts/foto-toko.jpg', 'Tentang-Kami', '<p style="text-align: justify;">Sigit Bengkel Vespa didirikan pada tahun 1996, didirikan oleh bapak Sigit. Yang berlokasi di desa Kalianyar Kecamatan Kutoarjo Kabupaten Purworejo. Letak SigitBengkel Vespa sangat strategis yaitu terletak di pinggir jalan perbatasan kota yang masih jarang terdapat bengkel-bengkel lain. Selain itu, Sigit Bengkel Vespa merupakan salah satu bengkel Rycicle atau daur ulang dari komponen-komponen kendaraan yang sudah tidak terpakai namun masih bisa diperbaiki dan digunakan agar bisa di rakit kembali sehingga menjadi sebuah kendaraan yang dapat digunakan kembali.</p>\r\n<p style="text-align: justify;"><br />Di Sigit Bengkel Vespa juga membuka usaha jual beli motor vespa hasil rycicle atau daur ulang yang sudah diperbaiki, mutu dari vespa daur ulang tersebut tidak kalah dengan keluaran vespa-vespa masakini. Sehingga banyak konsumen yang lebih memilih vespa-vespa produksi dari Sigit bengkel vespa yang tentu saja harganya jauh lebih terjangkau dibanding harga vespa baru.</p>\r\n<p style="text-align: justify;"><br />Sigit Bengkel Vespa memiliki 2 karyawan tetap yang bertugas dibagian mesin dan di bagian perakitan 1 orang dan dibagian sistim kelistrikan 1 orang. Sikap ramah dan kekeluargaan dari karyawan dan pemimpin bengkel yang menjadikan bengkel ini mempunyai banyak relasi-relasi bisnis dan konsumen yang membuat konsep bengkel meningkat dan maju.</p>', '2015-09-20', 1),
(3, 'Struktur Organisasi', 'public/media/posts/struktur.jpg', 'Struktur-Organisasi', '<p>Gambar Struktur Organisasi Sigit Vespa &amp; Asessoris</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', '2015-10-08', 1),
(4, 'Visi dan Misi', '', 'Visi-dan-Misi', '<h4><strong>Visi </strong></h4>\r\n<ol>\r\n<li>Membuat costumer puas dan menjaga keutuhan kondisi mesin padau mumnya, serta membuat costumer kembali lagi.</li>\r\n<li>Terbaik dalam pelayanan servis di bengkel.</li>\r\n<li>Terkenal dalam menangani segala macam problem motor</li>\r\n</ol>\r\n<h4><strong>Misi</strong></h4>\r\n<ol>\r\n<li>Mewujudkan pelayanan servis yang professional.</li>\r\n<li>Mewujudkan keahlian mekanik dalam menangani masalah.</li>\r\n<li>Mewujudkan ketepatan analisis dalam menentukan suatu kerusakan.</li>\r\n<li>Mewujudkan dayatarik seluruh masyarakat ke bengkel ini</li>\r\n</ol>\r\n<h4>Tujuan</h4>\r\n<ol>\r\n<li>Untuk memenuhi kebutuhan hidup keluarga dan sebagai matapencaharian pemilik bengkel.</li>\r\n<li>Membantu masyarakat dalam memperbaiki body dan mesin kendaraan.</li>\r\n<li>Membuka peluang kerja dan mengurangi pengangguran.</li>\r\n</ol>\r\n<p>&nbsp;</p>', '2016-03-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suplier`
--

CREATE TABLE IF NOT EXISTS `tbl_suplier` (
`id_suplier` int(3) NOT NULL,
  `nama_suplier` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` double NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`id_suplier`, `nama_suplier`, `alamat`, `no_telp`) VALUES
(1, 'PT Aspira Indonesia', 'Jl. Kebayoran Lama Jakarta', 217435678),
(2, 'PT Sparco', 'Senayan Jakarta Pusat', 2147483647),
(3, 'Astra Motor Indonesia tbk', 'Jl. Pandawa No 05. Jakarta Timur', 89018341755),
(6, 'PT Sinar Mas Indonesia', 'Jl. Untung Suropati No 1A. Sidoarjo Jawa Timur', 33789876),
(7, 'PT.COSMO', 'JAKARTA PUSAT', 865566666666);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
`id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `id_level` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `id_level`, `status`, `id_member`) VALUES
(1, 'admin', 'admin123', 'Administrator', '', 1, 1, 1),
(2, 'operator1', 'operator1', 'Operator 1', '', 2, 1, 2),
(3, 'member2', 'member2', 'Nemo', 'speedway037@gmail.com', 3, 1, 3),
(4, 'member1', 'member1', 'Kevin', 'minion@gmail.com', 3, 1, 4),
(35, 'sumanto', 'sumanto', 'Sumanto', 'chombet_honda@yahoo.com', 3, 1, 10),
(37, 'rahmat123', 'rahmat123', 'Rahmat Afandi', 'chombet.yuansa@gmail.com', 3, 1, 12),
(38, 'babat', 'babat123', 'babat', 'babat@gmail.com', 3, 1, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_balas_guest`
--
ALTER TABLE `tbl_balas_guest`
 ADD PRIMARY KEY (`id_balas`);

--
-- Indexes for table `tbl_balas_komen`
--
ALTER TABLE `tbl_balas_komen`
 ADD PRIMARY KEY (`id_balas_komen`);

--
-- Indexes for table `tbl_biaya_kirim`
--
ALTER TABLE `tbl_biaya_kirim`
 ADD PRIMARY KEY (`id_biaya`);

--
-- Indexes for table `tbl_detil_order`
--
ALTER TABLE `tbl_detil_order`
 ADD PRIMARY KEY (`id_detil_order`);

--
-- Indexes for table `tbl_detil_pembelian`
--
ALTER TABLE `tbl_detil_pembelian`
 ADD PRIMARY KEY (`id_detil_beli`);

--
-- Indexes for table `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
 ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `tbl_guestbook`
--
ALTER TABLE `tbl_guestbook`
 ADD PRIMARY KEY (`id_guest`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_kategori_produk`
--
ALTER TABLE `tbl_kategori_produk`
 ADD PRIMARY KEY (`id_kategori_produk`);

--
-- Indexes for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
 ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `tbl_level`
--
ALTER TABLE `tbl_level`
 ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
 ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
 ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
 ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
 ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
 ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
 ADD PRIMARY KEY (`id_beli`);

--
-- Indexes for table `tbl_posting`
--
ALTER TABLE `tbl_posting`
 ADD PRIMARY KEY (`id_posting`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
 ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tbl_profil`
--
ALTER TABLE `tbl_profil`
 ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
 ADD PRIMARY KEY (`id_suplier`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_balas_guest`
--
ALTER TABLE `tbl_balas_guest`
MODIFY `id_balas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_balas_komen`
--
ALTER TABLE `tbl_balas_komen`
MODIFY `id_balas_komen` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_biaya_kirim`
--
ALTER TABLE `tbl_biaya_kirim`
MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=669;
--
-- AUTO_INCREMENT for table `tbl_detil_order`
--
ALTER TABLE `tbl_detil_order`
MODIFY `id_detil_order` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tbl_detil_pembelian`
--
ALTER TABLE `tbl_detil_pembelian`
MODIFY `id_detil_beli` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_galeri`
--
ALTER TABLE `tbl_galeri`
MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_guestbook`
--
ALTER TABLE `tbl_guestbook`
MODIFY `id_guest` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_kategori_produk`
--
ALTER TABLE `tbl_kategori_produk`
MODIFY `id_kategori_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_komentar`
--
ALTER TABLE `tbl_komentar`
MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_level`
--
ALTER TABLE `tbl_level`
MODIFY `id_level` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
MODIFY `id_lokasi` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
MODIFY `id_menu` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
MODIFY `id_bayar` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
MODIFY `id_beli` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_posting`
--
ALTER TABLE `tbl_posting`
MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_profil`
--
ALTER TABLE `tbl_profil`
MODIFY `id_profil` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
MODIFY `id_suplier` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
