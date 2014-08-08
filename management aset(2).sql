-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2013 at 09:59 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `management aset`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_inventori`
--

CREATE TABLE IF NOT EXISTS `barang_inventori` (
  `id_barang_inventori` int(15) NOT NULL AUTO_INCREMENT,
  `id_categori_barang` int(11) NOT NULL,
  `kode_barang` varchar(150) NOT NULL,
  `gambar_barang` varchar(150) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `merek_barang` varchar(150) NOT NULL,
  `jumlah_barang` int(6) NOT NULL,
  `harga_sewa` varchar(15) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `keterangan_barang` text NOT NULL,
  PRIMARY KEY (`id_barang_inventori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `barang_inventori`
--

INSERT INTO `barang_inventori` (`id_barang_inventori`, `id_categori_barang`, `kode_barang`, `gambar_barang`, `nama_barang`, `merek_barang`, `jumlah_barang`, `harga_sewa`, `tanggal_pembelian`, `keterangan_barang`) VALUES
(1, 24, '', 'bad9.jpg', 'raket badminton3', 'yonex', 7, '5000', '2013-03-20', ''),
(6, 24, '', 'bad6.png', 'raket badminton2', 'yamaha', 3, '4000', '0000-00-00', ''),
(7, 24, '', 'bad11.jpg', 'raket badminton1', 'yamaha', 5, '200', '2013-03-11', 'harga ditetapkan'),
(8, 20, '', 'bas9.jpg', 'ring basket3', 'NN', 5, '4000', '0000-00-00', ''),
(16, 10, '', 'vol7.jpg', 'bola voli6', 'kings', 5, '3000', '0000-00-00', ''),
(17, 10, '', 'vol6.jpg', 'bola voli5', 'mikasa', 5, '5000', '2013-03-01', ''),
(25, 16, '', 'fut1.JPG', 'sepatu futsal2', 'nike', 6, '1500', '2013-03-01', ''),
(23, 17, '', 'bad14.jpg', 'shuttle cock7', 'NN', 5, '4000', '2013-03-01', ''),
(26, 10, '', 'vol9.gif', 'bola voli4', 'mihasa', 4, '7000', '0000-00-00', ''),
(27, 20, '', 'bas11.jpg', 'ring basket portable1', 'victoria', 4, '6000', '0000-00-00', ''),
(41, 22, '', 'bad10.jpg', 'sepatu basket1', 'nike', 5, '3444', '0000-00-00', ''),
(43, 17, '', 'bad16.jpg', 'shuttle cock2', 'pro', 4, '6000', '2013-03-28', ''),
(35, 11, '', 'bas16.jpg', 'bola basket', 'spalding', 3, '5000', '0000-00-00', ''),
(36, 23, '', 'bad22.jpg', 'net badminton2', 'victoria', 5, '6822', '0000-00-00', ''),
(37, 11, '', 'bas17.jpg', 'bola basket6', 'mikasa', 5, '5000', '0000-00-00', ''),
(38, 19, '', 'fut11.jpg', 'bola futsal4', 'penalty', 5, '6000', '0000-00-00', ''),
(39, 17, '', 'bad4.jpg', 'shuttlecock3', 'pows', 4, '600', '0000-00-00', ''),
(40, 4, '', 'ten21.jpg', 'raket tenis4', 'yonex', 6, '600', '0000-00-00', ''),
(44, 19, '', 'fut10.jpg', 'bola futsal1', 'Victoria', 4, '6000', '2013-03-28', ''),
(45, 21, '', 'vol15.jpg', 'net voli1', 'EYS', 5, '5000', '2013-03-28', ''),
(46, 9, '', 'fut20.jpg', 'gawang futsal1', 'EYS', 4, '500', '2013-03-28', ''),
(47, 17, '', 'bad1.jpg', 'shuttlecock1', 'powers', 5, '500', '2013-03-28', ''),
(48, 11, '', 'bas16.jpg', 'bola basket4', 'spalding pro', 5, '7000', '2013-02-27', ''),
(49, 11, '', 'bas19.jpg', 'bola basket3', 'spalding', 4, '3000', '2013-02-27', ''),
(50, 4, '', 'ten6.jpg', 'raket tenis2', 'wiltson', 4, '3555', '0000-00-00', ''),
(51, 4, '', 'ten2.jpg', 'raket tenis1', 'yonex', 5, '3555', '0000-00-00', ''),
(52, 11, '', 'bas14.jpg', 'bola basket2', 'molten', 5, '6000', '2013-02-27', ''),
(53, 11, '', 'bas1.jpg', 'bola basket1', 'mikasa', 4, '5000', '2013-02-27', '');

-- --------------------------------------------------------

--
-- Table structure for table `barang_rusak`
--

CREATE TABLE IF NOT EXISTS `barang_rusak` (
  `id_barang_rusak` int(15) NOT NULL AUTO_INCREMENT,
  `id_barang_inventori` int(15) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  `harga_perbaikan` varchar(10) NOT NULL,
  `jumlah_perbaikan` int(4) NOT NULL,
  `tanggal_perbaikan` date NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id_barang_rusak`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `barang_rusak`
--

INSERT INTO `barang_rusak` (`id_barang_rusak`, `id_barang_inventori`, `jumlah`, `harga_perbaikan`, `jumlah_perbaikan`, `tanggal_perbaikan`, `status`) VALUES
(1, 46, '1', '2000', 1, '2013-04-27', 'dalam perbaikan'),
(2, 49, '1', '3000', 1, '2013-05-22', 'selesai diperbaiki'),
(3, 53, '1', '3000', 1, '2013-05-22', 'selesai diperbaiki'),
(4, 50, '1', '200', 1, '2013-05-22', 'dalam perbaikan'),
(5, 49, '2', '400', 1, '2013-05-23', 'dalam perbaikan'),
(6, 46, '1', '2000', 1, '2013-05-23', 'dalam perbaikan'),
(7, 45, '1', '2000', 1, '2013-05-22', 'dalam perbaikan'),
(8, 53, '1', '3000', 1, '2013-05-22', 'dalam perbaikan');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id_booking` int(3) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `id_member` varchar(150) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `id_lapangan` int(3) NOT NULL,
  `tanggal_booking` date NOT NULL,
  `jam` time NOT NULL,
  `nama_lapangan` varchar(20) NOT NULL,
  `harga_lapangan` int(15) NOT NULL,
  `lama_pemakaian` int(12) NOT NULL,
  `status_pembayaran` varchar(150) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `status_booking` varchar(150) NOT NULL,
  PRIMARY KEY (`id_booking`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_pelanggan`, `id_member`, `nama`, `alamat`, `telepon`, `id_lapangan`, `tanggal_booking`, `jam`, `nama_lapangan`, `harga_lapangan`, `lama_pemakaian`, `status_pembayaran`, `tanggal_pembayaran`, `status_booking`) VALUES
(1, 0, '0', 'Hujan', 'jgka766', '52462829', 11, '2013-04-25', '14:00:00', 'basket6', 6000, 2, '', '0000-00-00', 'checkin'),
(2, 0, '0', 'tury', 'jhaan6789', '314567198', 9, '2013-04-25', '14:00:00', 'badminton1', 11000, 3, '', '0000-00-00', 'checkin'),
(3, 0, '0', 'hji', 'ahgaa6', '643678900', 10, '2013-04-25', '14:00:00', 'futsal1', 6000, 2, '', '0000-00-00', 'batal'),
(4, 0, '31', 'sfsfas', 'qdadada', '22344232', 10, '2013-04-25', '16:00:00', 'futsal1', 6000, 1, '', '0000-00-00', 'checkin'),
(5, 0, '0', 'hu', 'hahga6544', '536989', 9, '2013-04-26', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'checkin'),
(6, 0, '0', 'Turyi', 'asa62457', '34657765', 9, '2013-04-26', '14:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'batal'),
(7, 0, '65', 'htyu', 'abaa5567', '26434678', 9, '2013-04-26', '11:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'checkin'),
(8, 0, '54', 'hujanb', 'gft965789', '765422689', 9, '2013-04-30', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'checkin'),
(9, 0, '0', 'guhj', 'ghffh6789', '532578', 10, '2013-04-30', '09:00:00', 'futsal1', 6000, 3, '', '0000-00-00', 'batal'),
(10, 0, 'n22', 'nino', 'ghfdd76909', '75433567', 17, '2013-04-30', '09:00:00', 'voli2', 5000, 2, '', '0000-00-00', 'batal'),
(11, 0, 'N78', 'Pio', 'jh.khagaf6879', '75916280', 9, '2013-05-01', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'checkin'),
(12, 0, 'e3errf', 'ffff', 'hghh', '5443', 9, '2013-05-06', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'checkin'),
(13, 0, 'fda', 'aghda', 'ad3233', '23434', 9, '2013-05-07', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'batal'),
(14, 0, 'r23', 'rq', 'ahcda66', '122323', 11, '2013-05-06', '09:00:00', 'basket1', 6000, 2, '', '0000-00-00', 'batal'),
(15, 0, '455', 'gaa', 'adadafew355', '345465767', 11, '2013-05-06', '11:00:00', 'basket1', 6000, 2, '', '0000-00-00', 'checkin'),
(16, 0, '0', 'gfaggha', 'sdfa45456', '3525252525', 11, '2013-05-07', '09:00:00', 'basket1', 6000, 2, '', '0000-00-00', 'checkin'),
(17, 0, 'r25', 'ruu', 'dgay667', '3412412', 11, '2013-05-07', '11:00:00', 'basket1', 6000, 2, '', '0000-00-00', 'checkin'),
(18, 0, 'r25', 'ruu', 'dgay667', '3412412', 11, '2013-05-08', '09:00:00', 'basket1', 7000, 2, '', '0000-00-00', 'batal'),
(19, 0, '241242', 'adADA', 'DADA452W', '4124242', 9, '2013-05-08', '11:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'checkin'),
(20, 0, 'r25', 'ruu', 'dgay667', '3412412', 22, '2013-05-07', '09:00:00', 'basket3', 7000, 2, '', '0000-00-00', 'batal'),
(21, 0, 'ty78', 'dui', 'faf4646', '32525242', 10, '2013-05-07', '09:00:00', 'futsal1', 6000, 2, '', '0000-00-00', 'batal'),
(22, 0, 'ter44', 'fdds', 'sadfafa353', '53247474363', 9, '2013-05-07', '12:00:00', 'badminton1', 11000, 3, '', '0000-00-00', 'checkin'),
(23, 0, 'df4654', 'sfafafa', 'ae35df', '35265252', 20, '2013-05-07', '09:00:00', 'badminton2', 6000, 2, '', '0000-00-00', 'checkin'),
(24, 0, 'gt78', 'Dino', 'jl pangestu 9', '9542687', 9, '2013-05-22', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'batal'),
(25, 0, '0', 'hipo', 'jl kelapa ', '8534689', 11, '2013-05-22', '12:00:00', 'basket1', 7000, 2, '', '0000-00-00', 'checkin'),
(26, 0, 'frs32', 'Biko', 'jl hiko 32', '34242522', 9, '2013-05-23', '09:00:00', 'badminton1', 11000, 1, '', '0000-00-00', 'batal'),
(27, 0, '0', 'hu', 'jlbahdjha', '34242', 11, '2013-05-23', '09:00:00', 'basket1', 7000, 3, '', '0000-00-00', 'booking'),
(28, 0, '0', 'hhjj', 'kjdaDA', '2442', 11, '2013-05-24', '09:00:00', 'basket1', 7000, 3, '', '0000-00-00', 'checkin'),
(29, 0, '0', 'JDFJA', 'DJAOD;A', '2611', 14, '2013-05-23', '09:00:00', 'basket2', 5000, 2, '', '0000-00-00', 'batal'),
(30, 0, '0', 'kjjkll66', '7erqhqa', '4252627', 11, '2013-05-23', '12:00:00', 'basket1', 7000, 2, '', '0000-00-00', 'batal'),
(32, 0, '', 'Paa', 'jl kiii', '2141414141', 9, '2013-06-15', '16:00:00', 'badminton1', 11000, 1, '', '0000-00-00', 'checkin'),
(33, 0, '', 'mis', 'gj kaha', '27773733', 9, '2013-06-14', '15:00:00', 'badminton1', 11000, 3, '', '0000-00-00', 'checkin'),
(34, 0, '', 'paaaaa', 'jl juagdka', '7836824628', 9, '2013-06-14', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'booking'),
(35, 0, '', '', '', '', 9, '2013-07-01', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'booking'),
(36, 0, '', 'gfgfgg', 'jl hff', '6876989', 9, '2013-07-01', '11:00:00', 'badminton1', 11000, 3, '', '0000-00-00', 'booking'),
(37, 0, '', 'fhjfj', 'bjkk', '7878', 9, '2013-07-02', '09:00:00', 'badminton1', 11000, 2, '', '0000-00-00', 'booking'),
(38, 0, '', 'tesd', 'tesd1', '654662328', 9, '2013-07-03', '09:00:00', 'badminton1', 11000, 2, 'pembayaran dp2', '2013-07-01', 'booking'),
(39, 0, '', 'dadaadadad', 'adfafdafaf', '241414141', 9, '2013-07-03', '11:00:00', 'badminton1', 11000, 2, 'pembayaran dp1', '0000-00-00', 'booking');

-- --------------------------------------------------------

--
-- Table structure for table `categori_barang`
--

CREATE TABLE IF NOT EXISTS `categori_barang` (
  `id_categori_barang` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `categori` varchar(200) NOT NULL,
  `salvage_value` int(7) NOT NULL,
  `jumlah_total` int(11) NOT NULL,
  PRIMARY KEY (`id_categori_barang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `categori_barang`
--

INSERT INTO `categori_barang` (`id_categori_barang`, `parent_id`, `categori`, `salvage_value`, `jumlah_total`) VALUES
(1, 0, 'basket', 0, 0),
(2, 0, 'tenis', 0, 0),
(3, 0, 'futsal', 0, 0),
(4, 2, 'raket tenis', 1000, 20),
(14, 1, 'jaring tenis', 1200, 0),
(8, 0, 'voli', 0, 0),
(9, 3, 'gawang futsal', 1200, 0),
(10, 8, 'bola voli', 1000, 7),
(11, 1, 'bola basket', 1000, 0),
(12, 2, 'bola tenis', 1200, 0),
(15, 0, 'badminton', 0, 0),
(16, 3, 'sepatu futsal', 1000, 13),
(17, 15, 'shutlecock', 1000, 3),
(20, 1, 'ring basket', 0, 0),
(18, 2, 'sepatu tenis', 0, 0),
(19, 1, 'bola futsal', 0, 0),
(21, 8, 'net voli', 0, 0),
(22, 1, 'sepatu basket', 0, 0),
(23, 15, 'net badminton', 0, 0),
(24, 15, 'raket badminton', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE IF NOT EXISTS `gambar` (
  `id_gambar` int(15) NOT NULL AUTO_INCREMENT,
  `nama_gambar` varchar(150) NOT NULL,
  `kategori_gambar` varchar(150) NOT NULL,
  `date_add` date NOT NULL,
  PRIMARY KEY (`id_gambar`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `gambar`
--

INSERT INTO `gambar` (`id_gambar`, `nama_gambar`, `kategori_gambar`, `date_add`) VALUES
(1, 'vol1.JPG', 'voli', '2013-05-22'),
(2, 'tenis1.jpg', 'tenis', '2013-05-22'),
(3, 'tenis2.jpg', 'tenis', '2013-05-22'),
(4, 'vol3.jpg', 'voli', '2013-05-22'),
(5, 'badminton3.jpg', 'badminton', '2013-05-22'),
(6, 'badminton4.jpg', 'badminton', '2013-05-22'),
(7, 'badminton8.jpg', 'badminton', '2013-05-22'),
(8, 'basket1.jpg', 'basket', '2013-05-22'),
(9, 'basket2.jpg', 'basket', '2013-05-22'),
(10, 'basket6.jpg', 'basket', '2013-05-22'),
(11, 'tenis6.JPG', 'tenis', '2013-05-22'),
(12, 'vol4.jpg', 'voli', '2013-05-22'),
(13, 'futsal2.jpg', 'futsal', '2013-05-22'),
(14, 'futsal3.jpg', 'futsal', '2013-05-22'),
(15, 'futsal7.jpg', 'futsal', '2013-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE IF NOT EXISTS `karyawan` (
  `id_karyawan` int(3) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nama_karyawan` varchar(20) NOT NULL,
  `alamat_karyawan` char(20) NOT NULL,
  `kota` varchar(15) NOT NULL,
  `jabatan_karyawan` varchar(20) NOT NULL,
  `telepon` int(10) NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `user_id`, `nama_karyawan`, `alamat_karyawan`, `kota`, `jabatan_karyawan`, `telepon`) VALUES
(1, 7, 'nino', 'jl barebu', 'bandung', 'kasir', 35235252),
(6, 5, 'bolo', 'jl karawis 21', 'bandung', 'admin', 3568989),
(2, 2, 'kop', 'jl moh. toha', 'cirebon', 'manager_keuangan', 2424242),
(7, 39, 'lilooo', 'jl kecebong 11', 'bandung', 'admin', 62677881);

-- --------------------------------------------------------

--
-- Table structure for table `lapangan`
--

CREATE TABLE IF NOT EXISTS `lapangan` (
  `id_lapangan` int(3) NOT NULL AUTO_INCREMENT,
  `nama_lapangan` varchar(150) NOT NULL,
  `sewa_lapangan` int(10) NOT NULL,
  `jenis_lapangan` varchar(150) NOT NULL,
  PRIMARY KEY (`id_lapangan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `nama_lapangan`, `sewa_lapangan`, `jenis_lapangan`) VALUES
(10, 'futsal1', 6000, 'futsal'),
(9, 'badminton1', 11000, 'badminton'),
(11, 'basket1', 7000, 'basket'),
(8, 'tenis1', 2000, 'tenis'),
(14, 'basket2', 5000, 'basket'),
(17, 'voli1', 5000, 'voli'),
(16, 'voli2', 5000, 'voli'),
(18, 'tenis2', 6000, 'tenis'),
(19, 'futsal2', 5000, 'futsal'),
(20, 'badminton2', 6000, 'badminton'),
(22, 'basket3', 7000, 'basket'),
(23, 'tenis3', 3000, 'tenis');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id_news` int(15) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `tanggal_dibuat` date NOT NULL,
  `news` longtext NOT NULL,
  `gambar_news` varchar(250) NOT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_news`, `judul`, `tanggal_dibuat`, `news`, `gambar_news`) VALUES
(6, 'raket badminton', '2013-03-16', 'Mulai hari ini, di tempat kami akan datang raket badminton yang baru. Anda bisa segera langsung meminjam raket badminton ini. Segeralah datang ke tempat kami . Kami tunggu kedatangan Anda. Terima kasih.', 'bad2.gif'),
(3, 'sepatu basket', '2013-03-16', 'Mulai tanggal hari ini, kami juga akan menyewakan sepatu basket. Anda tidak perlu lagi bersusah payah untuk membeli sepatu hanya untuk berolahraga. Di sini kami sediakan untuk Anda pinjam. Segeralah datang ke tempat kami. Kami tunggu kehadirannya. Terima kasih. ', 'bad3.jpg'),
(4, 'raket badminton', '2013-03-16', 'Mulai hari ini, di tempat kami akan datang raket badminton yang baru. \r\nAnda bisa segera langsung meminjam raket badminton ini. Segeralah datang\r\n ke tempat kami . Kami tunggu kedatangan Anda. Terima kasih.', 'bad6.png'),
(5, 'raket badminton', '2013-03-16', 'Mulai hari ini, di tempat kami akan datang raket badminton yang baru. \r\nAnda bisa segera langsung meminjam raket badminton ini. Segeralah datang\r\n ke tempat kami . Kami tunggu kedatangan Anda. Terima kasih.', 'bad7.png'),
(7, 'Pemandangan', '2013-03-27', 'Banyak sekali pemandangan yang akan didapat, apabila Anda datang ke tempat kami. Di sini pemandangan yang asri akan membuat Anda bertambah semangat untuk melakukan olahraga. Oleh karena itu segeralah kemari dan mengajak teman-teman Anda untuk datang ke tempat kami.', 'big_img_03.gif'),
(8, 'Lapangan', '2013-03-27', 'Lapangan&nbsp; badminton yang ada di gambar ini , akan segera kami bangun untuk menambah lapangan. Kami meminta maaf apabila kenyamanan Anda terganggu karena proyek pembangunan lapangan ini. Terima kasih.', 'badminton3.jpg'),
(9, 'Diskon 10%', '2013-03-27', 'Kami akan mengadakan diskon sebesar 10% , untuk semua jenis bola basket yang Anda pinjam. Promo ini hanya berlaku sampai dengan 4 April 2013. Segeralah datang ke tempat kami dan nikmatilah diskon-diskon yang telah kami siapkan untuk Anda. Terima kasih.', 'bas14.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `option_barang`
--

CREATE TABLE IF NOT EXISTS `option_barang` (
  `id_option_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang_inventori` int(11) NOT NULL,
  `nama_option` varchar(150) NOT NULL,
  `nilai_option` text NOT NULL,
  PRIMARY KEY (`id_option_barang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `option_barang`
--

INSERT INTO `option_barang` (`id_option_barang`, `id_barang_inventori`, `nama_option`, `nilai_option`) VALUES
(1, 4, 'ukuran', '40x50'),
(3, 6, 'ukuran', '30x40'),
(4, 7, 'ukuran', '40x50'),
(5, 8, 'warna ', 'merah'),
(6, 16, 'warna ', 'kuning'),
(7, 0, '', ''),
(8, 0, '', ''),
(9, 0, '', ''),
(10, 0, '', ''),
(11, 0, '', ''),
(12, 0, '', ''),
(13, 0, '', ''),
(14, 0, '', ''),
(15, 0, '', ''),
(16, 0, '', ''),
(17, 0, '', ''),
(18, 0, '', ''),
(19, 23, 'warna', 'putih'),
(20, 25, 'ukuran', '90x50'),
(21, 26, 'warna', 'kuning'),
(22, 27, 'warna', 'hitam'),
(23, 40, 'warna', 'kuning'),
(24, 41, 'warna', 'biru'),
(25, 42, '', 'gahdgak'),
(26, 43, 'warna', 'hitam'),
(27, 44, 'warna', 'kuning'),
(28, 45, 'warna', 'merah'),
(29, 46, 'warna', 'kuning'),
(30, 47, 'bulu', 'warna putih');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(6) NOT NULL AUTO_INCREMENT,
  `id_member` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_member`, `user_id`, `nama_pelanggan`, `alamat_pelanggan`, `telepon_pelanggan`) VALUES
(19, 'f40', 40, 'fifo', 'jl ramayana 12', '13463653'),
(17, 'n35', 35, 'nuu', 'jl sangkuriang 32', '452541242'),
(18, 'b36', 36, 'bok', 'jl kalim 11', '5346363633'),
(16, 'b34', 34, 'buk', 'jl sumatera', '321313131'),
(15, 'r33', 33, 'ruu', 'jl pangestu 7', '6188292');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id_pembayaran` int(8) NOT NULL AUTO_INCREMENT,
  `id_booking` int(15) NOT NULL,
  `status_pbyr` varchar(1500) NOT NULL,
  `tanggal_pbyr` date NOT NULL,
  `bukti_pbyr` varchar(1500) NOT NULL,
  `keterangan_pbyr` varchar(1500) NOT NULL,
  `total_pembayaran` int(15) NOT NULL,
  PRIMARY KEY (`id_pembayaran`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_booking`, `status_pbyr`, `tanggal_pbyr`, `bukti_pbyr`, `keterangan_pbyr`, `total_pembayaran`) VALUES
(1, 38, 'diterima', '2013-07-01', '', '0', 50000),
(2, 39, 'diterima', '2013-07-01', '', 'pembayaran dp1', 50000),
(3, 38, 'diterima', '2013-07-01', 'bukti_pembayaran/Desert.jpg', 'pembayaran dp2', 40000),
(4, 38, 'diterima', '2013-07-01', 'bukti_pembayaran/Desert.jpg', 'pembayaran dp2', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_pembelian` int(3) NOT NULL AUTO_INCREMENT,
  `tanggal_pembelian` date NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `total_harga_pembelian` int(15) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id_pembelian`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tanggal_pembelian`, `id_karyawan`, `total_harga_pembelian`, `keterangan`) VALUES
(1, '2013-03-20', 6, 27000, ''),
(3, '2013-03-20', 6, 51000, ''),
(4, '2013-03-20', 6, 79000, ''),
(5, '2013-03-20', 6, 79000, ''),
(6, '2013-03-20', 6, 79000, ''),
(7, '2013-03-20', 6, 107000, ''),
(8, '2013-03-20', 6, 7000, ''),
(9, '2013-03-20', 6, 35000, ''),
(10, '2013-03-20', 6, 9000, ''),
(11, '2013-03-20', 6, 31000, ''),
(12, '2013-03-28', 6, 18000, ''),
(13, '2013-04-02', 6, 20000, ''),
(14, '2013-04-13', 6, 14700, ''),
(15, '2013-04-26', 6, 60000, '');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE IF NOT EXISTS `penerimaan` (
  `id_penerimaan` int(15) NOT NULL AUTO_INCREMENT,
  `tanggal_terima` date NOT NULL,
  `id_karyawan` int(15) NOT NULL,
  `bukti_penerimaan` varchar(250) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  PRIMARY KEY (`id_penerimaan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `penerimaan`
--

INSERT INTO `penerimaan` (`id_penerimaan`, `tanggal_terima`, `id_karyawan`, `bukti_penerimaan`, `keterangan`) VALUES
(1, '2013-02-20', 5, 'yte98776', ''),
(2, '2013-02-20', 5, 'yte98776', ''),
(3, '2013-02-22', 5, 'jhf98766', ''),
(4, '2013-02-23', 5, 'tr8766', 'barang sudah ada'),
(5, '2013-02-26', 5, 'yu755567', 'barang sudah ada'),
(6, '2013-02-27', 5, '353w', 'barang sudah ada'),
(7, '2013-02-27', 5, 'fr445', ''),
(8, '2013-03-01', 5, 'yehw67373', 'barang sudah ada'),
(9, '2013-03-01', 5, 'yehw67373', 'barang sudah ada'),
(10, '2013-03-01', 5, 'yehw67373', 'barang sudah ada'),
(11, '2013-03-01', 5, 'yehw67373', 'barang sudah ada'),
(12, '2013-03-01', 5, 'yehw67373', 'barang sudah ada'),
(13, '2013-03-01', 5, '74746y3yh2', ''),
(14, '2013-03-01', 5, '74746y3yh2', ''),
(15, '2013-03-01', 5, '74746y3yh2', ''),
(16, '2013-03-01', 5, '74746y3yh2', ''),
(17, '2013-03-01', 5, '9767yu', ''),
(18, '2013-03-01', 5, '9767yu', ''),
(19, '2013-03-01', 5, '23344', ''),
(20, '2013-03-01', 5, '23344', ''),
(21, '2013-03-27', 5, 'adga6daq7w', 'barang sdh diterima'),
(22, '2013-03-28', 5, 'afasfaa', 'brg diterima'),
(23, '2013-03-28', 5, 'afasfaa', 'brg diterima'),
(24, '2013-03-28', 5, 'dfaqrwa3', 'barang sdh diterima'),
(25, '2013-03-28', 5, 'adfaaaw222', 'request harga'),
(26, '2013-03-28', 5, 'haydqa345545', 'request harga'),
(27, '2013-03-28', 5, 'asojKDyqw764', 'request harga'),
(28, '2013-04-02', 5, 'fhjt6456t57', 'request harga'),
(29, '2013-04-13', 5, '646eytfjh', 'request harga'),
(30, '2013-04-26', 5, 'td5679', 'request harga');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE IF NOT EXISTS `penyewaan` (
  `id_penyewaan` int(15) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` varchar(150) NOT NULL,
  `id_penyewaan_lapangan` int(15) NOT NULL,
  `id_karyawan` int(15) NOT NULL,
  `nama_pelanggan` varchar(150) NOT NULL,
  `tanggal_penyewaan` date NOT NULL,
  `jam` time NOT NULL,
  `lama_pemakaian` varchar(150) NOT NULL,
  `jumlah_dibayar` int(15) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  PRIMARY KEY (`id_penyewaan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `id_pelanggan`, `id_penyewaan_lapangan`, `id_karyawan`, `nama_pelanggan`, `tanggal_penyewaan`, `jam`, `lama_pemakaian`, `jumlah_dibayar`, `total_pembayaran`, `keterangan`) VALUES
(1, '43', 50, 7, 'Hujan', '2013-04-25', '14:00:00', '2', 50000, 24000, 'selesai'),
(2, '36', 51, 7, 'tury', '2013-04-25', '14:00:00', '3', 40000, 33000, 'selesai'),
(3, 'N78', 52, 7, 'Pio', '2013-05-01', '09:00:00', '2', 50000, 30000, 'selesai'),
(5, '3556', 54, 7, 'affa', '2013-05-06', '11:00:00', '2', 80000, 22000, 'selesai'),
(6, 'sfaa', 55, 7, 'afafa', '2013-05-07', '11:00:00', '1', 10000, 11000, 'selesai'),
(7, '4141', 56, 7, 'gazfa', '2013-05-08', '09:00:00', '2', 55000, 5500, 'selesai'),
(8, 'r25', 57, 7, 'ruu', '2013-05-07', '11:00:00', '2', 12000, 6000, 'selesai'),
(9, '241242', 58, 7, 'adADA', '2013-05-08', '11:00:00', '2', 22000, 22000, 'selesai'),
(10, '31', 59, 7, 'sfsfas', '2013-04-25', '16:00:00', '1', 10000, 6000, ''),
(11, 'as34', 60, 7, 'hu', '2013-04-26', '09:00:00', '2', 50000, 22000, ''),
(12, '65', 61, 7, 'htyu', '2013-04-26', '11:00:00', '2', 50000, 22000, ''),
(13, '54', 62, 7, 'hujanb', '2013-04-30', '09:00:00', '2', 50000, 22000, ''),
(14, 'e3errf', 63, 7, 'ffff', '2013-05-06', '09:00:00', '2', 50000, 22000, ''),
(15, 'df4654', 64, 7, 'sfafafa', '2013-05-07', '09:00:00', '2', 20000, 12000, ''),
(16, '455', 65, 7, 'gaa', '2013-05-06', '11:00:00', '2', 20000, 12000, ''),
(17, '455', 66, 7, 'gaa', '2013-05-06', '11:00:00', '2', 20000, 12000, ''),
(18, 'vdgss', 67, 7, 'gfaggha', '2013-05-07', '09:00:00', '-7', 22000, 12000, 'selesai'),
(19, 'ter44', 68, 7, 'fdds', '2013-05-07', '12:00:00', '1', 50000, 33000, 'selesai'),
(20, 'sfsf', 69, 7, 'hipo', '2013-05-22', '12:00:00', '1', 30000, 14000, 'selesai'),
(21, '241', 70, 7, 'hhjj', '2013-05-24', '09:00:00', '3', 50000, 48000, 'selesai'),
(23, '', 72, 7, 'Paa', '2013-06-15', '16:00:00', '1', 50000, 16000, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_barang`
--

CREATE TABLE IF NOT EXISTS `penyewaan_barang` (
  `id_penyewaan_barang` int(4) NOT NULL AUTO_INCREMENT,
  `id_barang_inventori` int(15) NOT NULL,
  `id_penyewaan_lapangan` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `harga_total` int(15) NOT NULL,
  PRIMARY KEY (`id_penyewaan_barang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `penyewaan_barang`
--

INSERT INTO `penyewaan_barang` (`id_penyewaan_barang`, `id_barang_inventori`, `id_penyewaan_lapangan`, `nama`, `jumlah`, `harga_total`) VALUES
(1, 23, 10, 'shuttle cock', 1, 4000),
(2, 16, 10, 'bola basket8', 1, 3000),
(3, 23, 11, 'shuttle cock', 1, 4000),
(4, 16, 11, 'bola basket8', 1, 3000),
(5, 23, 12, 'shuttle cock', 1, 4000),
(6, 16, 12, 'bola basket8', 1, 3000),
(7, 23, 13, 'shuttle cock', 1, 4000),
(8, 16, 13, 'bola basket8', 1, 3000),
(9, 23, 14, 'shuttle cock', 1, 4000),
(10, 16, 14, 'bola basket8', 1, 3000),
(11, 23, 15, 'shuttle cock', 1, 4000),
(12, 16, 15, 'bola basket8', 1, 3000),
(13, 23, 16, 'shuttle cock', 1, 4000),
(14, 16, 16, 'bola basket8', 1, 3000),
(15, 23, 17, 'shuttle cock', 1, 4000),
(16, 16, 17, 'bola basket8', 1, 3000),
(17, 25, 19, 'bola futsal', 1, 4000),
(18, 25, 20, 'bola futsal', 1, 4000),
(19, 25, 21, 'bola futsal', 1, 4000),
(20, 25, 22, 'bola futsal', 1, 4000),
(21, 16, 23, 'bola basket8', 1, 3000),
(22, 16, 24, 'bola basket8', 1, 3000),
(23, 6, 25, 'raket tenis 3', 1, 4000),
(24, 25, 26, 'bola futsal', 1, 4000),
(25, 16, 27, 'bola basket8', 1, 3000),
(26, 16, 28, 'bola basket8', 1, 3000),
(27, 16, 29, 'bola basket8', 1, 3000),
(28, 16, 31, 'bola basket8', 1, 3000),
(29, 16, 32, 'bola basket8', 1, 3000),
(30, 16, 33, 'bola basket8', 2, 6000),
(33, 16, 41, 'bola basket8', 2, 6000),
(32, 16, 35, 'shutle cock', 3, 9000),
(34, 16, 42, 'bola basket8', 2, 6000),
(35, 16, 44, 'bola basket8', 1, 3000),
(36, 27, 50, 'raket tenis 5', 1, 6000),
(37, 23, 52, 'shuttle cock', 1, 4000),
(38, 23, 53, 'shuttle cock', 1, 4000),
(39, 1, 70, 'raket badminton3', 1, 5000),
(40, 8, 70, 'ring basket3', 1, 4000),
(41, 8, 71, 'ring basket3', 1, 4000),
(42, 40, 71, 'raket tenis4', 1, 600),
(43, 1, 71, 'raket badminton3', 1, 5000),
(44, 6, 71, 'raket badminton2', 1, 4000),
(45, 7, 71, 'raket badminton1', 1, 200),
(46, 1, 72, 'raket badminton3', 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan_lapangan`
--

CREATE TABLE IF NOT EXISTS `penyewaan_lapangan` (
  `id_penyewaan_lapangan` int(10) NOT NULL AUTO_INCREMENT,
  `id_lapangan` int(10) NOT NULL,
  `harga_total_lapangan` int(15) NOT NULL,
  PRIMARY KEY (`id_penyewaan_lapangan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `penyewaan_lapangan`
--

INSERT INTO `penyewaan_lapangan` (`id_penyewaan_lapangan`, `id_lapangan`, `harga_total_lapangan`) VALUES
(1, 9, 10000),
(2, 9, 10000),
(3, 9, 10000),
(4, 9, 10000),
(5, 9, 10000),
(6, 9, 10000),
(7, 9, 10000),
(8, 9, 10000),
(9, 9, 0),
(10, 9, 15000),
(11, 9, 15000),
(12, 9, 15000),
(13, 9, 15000),
(14, 9, 15000),
(15, 9, 15000),
(16, 9, 15000),
(17, 9, 15000),
(18, 9, 15000),
(19, 9, 5000),
(20, 9, 5000),
(21, 9, 5000),
(22, 9, 5000),
(23, 9, 5000),
(24, 11, 8000),
(25, 9, 5000),
(26, 9, 5000),
(27, 9, 5000),
(28, 9, 10000),
(29, 9, 15000),
(30, 9, 15000),
(31, 9, 10000),
(32, 14, 5000),
(33, 9, 10000),
(34, 9, 20000),
(35, 9, 15000),
(36, 8, 5400),
(37, 8, 5400),
(38, 8, 5400),
(39, 8, 5400),
(40, 8, 5400),
(41, 9, 33000),
(42, 9, 22000),
(43, 9, 33000),
(44, 9, 22000),
(45, 9, 33000),
(46, 8, 4000),
(47, 11, 12000),
(48, 14, 10000),
(49, 10, 12000),
(50, 11, 12000),
(51, 9, 33000),
(52, 9, 22000),
(53, 9, 22000),
(54, 9, 22000),
(55, 9, 11000),
(56, 9, 5500),
(57, 11, 6000),
(58, 9, 22000),
(59, 10, 6000),
(60, 9, 22000),
(61, 9, 22000),
(62, 9, 22000),
(63, 9, 22000),
(64, 20, 12000),
(65, 11, 12000),
(66, 11, 12000),
(67, 11, 12000),
(68, 9, 33000),
(69, 11, 14000),
(70, 11, 21000),
(71, 9, 11000),
(72, 9, 11000),
(73, 9, 33000);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE IF NOT EXISTS `promo` (
  `id_promo` int(7) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(150) NOT NULL,
  `nama_promo` varchar(250) NOT NULL,
  `diskon` double(5,2) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `deskripsi`, `nama_promo`, `diskon`, `periode_awal`, `periode_akhir`) VALUES
(3, 'berlari', 'vaaa', 0.20, '2013-04-04', '2013-04-11'),
(4, 'Dapatkan promosi 10% dengan cara reservasi di tempat ini sebelum tanggal 31 Mei', 'promosi 10% ', 0.10, '2013-05-06', '2013-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `request_pembelian`
--

CREATE TABLE IF NOT EXISTS `request_pembelian` (
  `id_request_pembelian` int(15) NOT NULL AUTO_INCREMENT,
  `id_barang_inventori` int(15) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_penerimaan` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `option_request_barang` varchar(150) NOT NULL,
  `merek_barang` varchar(100) NOT NULL,
  `jumlah_barang` int(15) NOT NULL,
  `harga_satuan` int(15) NOT NULL,
  `total_harga` int(15) NOT NULL,
  `status` varchar(150) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`id_request_pembelian`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `request_pembelian`
--

INSERT INTO `request_pembelian` (`id_request_pembelian`, `id_barang_inventori`, `id_pembelian`, `id_penerimaan`, `id_karyawan`, `id_supplier`, `tanggal_pembelian`, `nama_barang`, `option_request_barang`, `merek_barang`, `jumlah_barang`, `harga_satuan`, `total_harga`, `status`, `keterangan`) VALUES
(1, 47, 7, 26, 5, 1, '2013-03-20', 'shuttlecock', 'warna putih', 'NN', 4, 5000, 20000, 'telah diterima', 'request harga'),
(2, 9, 0, 3, 5, 1, '2013-02-20', 'gawangfutsal', 'warna putih', 'MM', 6, 8000, 48000, 'telah diterima', ''),
(3, 0, 0, 4, 5, 1, '2013-02-23', 'badminton', '', 'YAMAHA', 3, 4000, 12000, 'telah diterima', 'barang sudah ada'),
(4, 0, 0, 5, 5, 2, '2013-02-26', 'bola voli', '', 'hhhh', 1, 7000, 7000, 'telah diterima', 'barang sudah ada'),
(5, 0, 10, 7, 5, 3, '2013-03-20', 'bola basket', '', 'kkk', 1, 9000, 9000, 'dibeli', ''),
(6, 0, 0, 12, 5, 1, '2013-02-26', 'bola basket vg 56', '', 'dddd', 1, 8000, 8000, 'telah diterima', 'barang sudah ada'),
(7, 0, 0, 6, 5, 1, '2013-02-27', 'net badminton', 'warna putih', 'mikasa', 4, 80000, 320000, 'telah diterima', 'barang sudah ada'),
(8, 48, 9, 27, 5, 1, '2013-03-20', 'bola voli3', 'warna:hitam', 'nnn', 4, 7000, 28000, 'telah diterima', 'request harga'),
(9, 0, 11, 18, 5, 1, '2013-03-20', 'shuttle cock', 'warna:putih', 'bbb', 1, 7000, 7000, 'dibeli', ''),
(10, 25, 11, 20, 5, 1, '2013-03-20', 'bola futsal', 'ukuran90x50', 'weeeee', 6, 4000, 24000, 'dibeli', 'harga ditetapkan'),
(11, 42, 0, 21, 5, 2, '2013-03-27', 'sdh', 'gahdgak', 'gada', 1, 6000, 6000, 'telah diterima', 'barang sdh diterima'),
(12, 44, 0, 23, 5, 1, '2013-03-28', 'bola basket', 'huuanha', 'baa', 4, 30000, 120000, 'telah diterima', 'brg diterima'),
(13, 45, 0, 24, 5, 1, '2013-03-28', 'net voli', 'aaafagaga', 'dadada', 6, 6000, 36000, 'telah diterima', 'barang sdh diterima'),
(14, 46, 0, 25, 5, 1, '2013-03-28', 'gfjhfkj', '2esada', 'gadiahdalda', 4, 4654, 18616, 'telah diterima', 'request harga'),
(15, 0, 12, 0, 5, 1, '2013-03-28', 'raket tenis 7', 'wqafa', 'adadaadadada', 3, 6000, 18000, 'dibeli', ''),
(16, 49, 13, 28, 5, 3, '2013-04-02', 'raket tenis 7', 'warna hitam', 'gf', 5, 4000, 20000, 'telah diterima', 'request harga'),
(17, 52, 14, 29, 5, 1, '2013-04-13', 'bola voli3', 'raaaaa', 'gfaga', 3, 4900, 14700, 'telah diterima', 'request harga'),
(18, 53, 15, 30, 5, 1, '2013-04-26', 'raket tenis 7', 'warna putih', 'yamaha', 4, 15000, 60000, 'telah diterima', 'request harga');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id_supplier` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `kota` char(30) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `cp_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id_supplier`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `kota`, `telepon`, `cp_nama`) VALUES
(1, 'PT.Agung', 'Jl. kalmin', 'Bandung', '022-5643232', 'Vokki'),
(2, 'PT Gio', 'Jln.aggaga', 'Bandung', '022-45635372', 'Alexx'),
(3, 'PT Kosima', 'jl.najaga', 'Bogor', '066-593737', 'Kol'),
(4, 'PT Banyu', 'jl pangestu sari', 'Kalimantan', '34342444', 'Jimmi'),
(5, 'pt Gudang', 'jl kenangan', 'Garut', '12234299', 'Poku'),
(6, 'Pt Sarana', 'jl kimo', 'bandung', '23424', 'Bilo'),
(7, 'pt hasa', 'jl mino', 'bandung', '243231', 'Fino'),
(9, 'Pt sejahtera', 'jl nomia', 'Yogyakarta', '24141', 'Muni'),
(12, 'pt yuio', 'jl mekar 12', 'cirebon', '243525', 'pamela'),
(11, 'pt Guji', 'jl kaio', 'bandung', '242678', 'Dudi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(6) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL,
  `password` varchar(150) NOT NULL,
  `nama` char(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `jabatan` char(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `nama`, `email`, `jabatan`) VALUES
(5, 'gudang', '202446dd1d6028084426867365b0c7a1', 'gudang', 'gudang@yahoo.com', 'manager_gudang'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@yahoo.com', 'admin'),
(6, 'keuangan', 'a4151d4b2856ec63368a7c784b1f0a6e', 'Hope', 'hope@yahoo.com', 'manager_keuangan'),
(7, 'kasir', 'c7911af3adbd12a035b289556d96470a', 'nino', 'nino@yahoo.com', 'kasir'),
(11, 'pemilik', '58399557dae3c60e23c78606771dfa3d', 'pemilik', 'pemilik@yahoo.com', 'pemilik'),
(33, 'ruu', '202cb962ac59075b964b07152d234b70', 'ruu', '', 'user'),
(32, 'keuangan2', 'a4151d4b2856ec63368a7c784b1f0a6e', 'bop', 'keuangan2@yahoo.com', 'manager_keuangan'),
(31, 'gudang2', '202446dd1d6028084426867365b0c7a1', 'gip', 'gudang2@yahoo.com', 'manager_gudang'),
(30, 'kasir2', 'c7911af3adbd12a035b289556d96470a', 'nok', 'kasir2@yahoo.com', 'kasir'),
(29, 'admin2', '21232f297a57a5a743894a0e4a801fc3', 'nik', 'admin2@yahoo.com', 'admin'),
(27, 'kasir3', 'c7911af3adbd12a035b289556d96470a', 'buki', 'pasta@yahoo.com', 'kasir'),
(34, 'buk', '202cb962ac59075b964b07152d234b70', 'buk', '', 'user'),
(35, 'nuu', '202cb962ac59075b964b07152d234b70', 'nuu', '', 'user'),
(36, 'bok', '202cb962ac59075b964b07152d234b70', 'bok', '', 'user'),
(37, 'admin3', '202cb962ac59075b964b07152d234b70', 'jiko', 'jiko@yahoo.com', 'admin'),
(38, 'kasir5', '202cb962ac59075b964b07152d234b70', 'lilo', 'kasir5@yahoo.com', 'kasir'),
(39, 'admin89', 'e10adc3949ba59abbe56e057f20f883e', 'lilooo', 'admin78@yahoo.com', 'admin'),
(40, 'fifo', '25d55ad283aa400af464c76d713c07ad', 'fifo', 'fifo2@yahoo.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `webcontent`
--

CREATE TABLE IF NOT EXISTS `webcontent` (
  `id_webcontent` int(15) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id_webcontent`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `webcontent`
--

INSERT INTO `webcontent` (`id_webcontent`, `kategori`, `content`) VALUES
(3, 'mission', 'PT. Abadi ini mempunyai misi sebagai berikut :<br>1. Mengajak semua lapisan masyarakat untuk berolahraga<br>2. Hidup sehat dengan berolahraga bersama kami<br>3. Membuat kontribusi dengan masyarakat agar mau hidup sehat.<br>                    '),
(2, 'home', '            \r\nSelamat datang di tempat penyewaan PT. Abadi ini.<br>\r\nKami bergerak di bidang jasa untuk melayani masyarakat yang ingin berolahraga sejenak di tengah kepenatan aktifitas Anda sehari-hari.dan kami akan memberikan pelayanan yang sebaik-baiknya untuk Anda yang telah mau datang ke tempat kami ini.\r\n<br>\r\nSalam PT Abadi Corp.                                    '),
(4, 'contact_us', 'Apabila Anda mempunyai kritik dan saran untuk PT Abadi ini maka , silakan hubungi kami di :<br>Telp Kantor :(021)-652523787<br>Fax :082-526-252-16<br>E-mail : www.ptabadi.com<br>                '),
(5, 'membership', '            PT Abadi ini juga menyediakan promo-promo untuk yang mau bergabung dengan kami. Apabila Anda mendaftar menjadi member kami, maka akan ada promosi untuk member setiap bulannya. Syarat dan ketentuan berlaku ^^ . Segeralah bergabung dengan kami.<br><br>Salam PT Abadi corp.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
