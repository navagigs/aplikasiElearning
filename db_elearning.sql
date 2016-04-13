-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2014 at 08:19 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT 'administrator',
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'admin',
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `level`, `alamat`, `no_telp`, `email`, `blokir`, `id_session`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Reza Nur Fajri', 'admin', 'Ciamis', '-', 'rezanur@yahoo.com', 'N', 'bjj5ap0306lf708n1fki4fmvu6');

-- --------------------------------------------------------

--
-- Table structure for table `background`
--

CREATE TABLE IF NOT EXISTS `background` (
  `id_background` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `url` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_posting` date NOT NULL,
  PRIMARY KEY (`id_background`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `background`
--

INSERT INTO `background` (`id_background`, `judul`, `url`, `gambar`, `tgl_posting`) VALUES
(17, 'Background', '', 'body_1.png', '2014-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `file_materi`
--

CREATE TABLE IF NOT EXISTS `file_materi` (
  `id_file` int(7) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_matapelajaran` varchar(5) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `tgl_posting` date NOT NULL,
  `pembuat` varchar(50) NOT NULL,
  `hits` int(3) NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `file_materi`
--

INSERT INTO `file_materi` (`id_file`, `judul`, `id_kelas`, `id_matapelajaran`, `nama_file`, `tgl_posting`, `pembuat`, `hits`) VALUES
(109, 'user', 'R3a', 'O1', 'Belajar Bahasa Pemrograman Web (Basic) with PHP+MySQL.pdf', '2013-07-27', '10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE IF NOT EXISTS `jawaban` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_tq` int(50) NOT NULL,
  `id_quiz` int(50) NOT NULL,
  `id_siswa` int(50) NOT NULL,
  `jawaban` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id`, `id_tq`, `id_quiz`, `id_siswa`, `jawaban`) VALUES
(5, 28, 77, 5, 'persamaan kata'),
(6, 28, 78, 5, 'perlawanan kata'),
(9, 32, 82, 7, 'e2e'),
(10, 32, 83, 7, '2e2e2'),
(11, 38, 85, 16, ''),
(12, 38, 84, 16, ''),
(13, 38, 85, 15, ''),
(14, 38, 84, 15, ''),
(15, 43, 86, 15, ''),
(16, 43, 87, 15, ''),
(17, 43, 86, 17, ''),
(18, 43, 87, 17, ''),
(19, 47, 93, 16, ''),
(20, 47, 93, 16, 'Objek Oriented Progremming'),
(21, 49, 97, 58, '');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_kelas` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_pengajar` int(9) NOT NULL,
  `id_siswa` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `id_kelas`, `nama`, `id_pengajar`, `id_siswa`) VALUES
(57, 'R2b', 'XI RPL B', 0, 0),
(58, 'R2c', 'XI RPL C', 0, 0),
(59, 'R3a', 'XII RPL A', 8, 58),
(60, 'R3b', 'XII RPL B', 0, 0),
(55, 'R1b', 'X RPL B', 0, 0),
(56, 'R2a', 'XI RPL A', 0, 0),
(54, 'R1a', 'X RPL A', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE IF NOT EXISTS `mata_pelajaran` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_matapelajaran` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_pengajar` int(9) NOT NULL,
  `deskripsi` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kelas` (`id_kelas`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id`, `id_matapelajaran`, `nama`, `id_kelas`, `id_pengajar`, `deskripsi`) VALUES
(70, 'O1', 'OOP', 'R3a', 10, 'Object'),
(75, '', 'e2', 'R1b', 8, 'e2r'),
(69, 'weblanjut', 'WEB DINAMIS LANJUT', 'R3a', 8, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` int(5) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `link` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `static_content` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` enum('pengajar','admin') COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `link_seo` varchar(50) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_modul`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=91 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `link`, `static_content`, `gambar`, `publish`, `status`, `aktif`, `urutan`, `link_seo`) VALUES
(2, 'Manajemen Admin', '?module=admin', '', '', 'N', 'admin', 'N', 2, ''),
(18, 'Manajemen Materi', '?module=materi', '', '', 'N', 'pengajar', 'Y', 6, 'semua-berita.html'),
(37, 'Manajemen Siswa', '?module=siswa', '', '', 'Y', 'admin', 'Y', 3, 'profil-kami.html'),
(10, 'Manajemen Modul', '?module=modul', '', '', 'N', 'admin', 'N', 1, ''),
(31, 'Mata Pelajaran', '?module=matapelajaran', '', '', 'Y', 'pengajar', 'Y', 5, ''),
(63, 'Manajemen Quiz', '?module=quiz', '', '', 'N', 'pengajar', 'Y', 7, ''),
(41, 'Manajemen Kelas', ' ?module=kelas', '', '', 'N', 'pengajar', 'Y', 4, 'semua-agenda.html'),
(87, 'Background User', '?module=background', '', '', 'Y', 'admin', 'Y', 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_tq` int(50) NOT NULL,
  `id_siswa` int(50) NOT NULL,
  `benar` int(10) NOT NULL,
  `salah` int(10) NOT NULL,
  `tidak_dikerjakan` int(50) NOT NULL,
  `persentase` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `id_tq`, `id_siswa`, `benar`, `salah`, `tidak_dikerjakan`, `persentase`) VALUES
(2, 30, 7, 4, 1, 0, 80),
(3, 31, 11, 0, 0, 1, 0),
(4, 44, 16, 0, 0, 1, 0),
(5, 50, 58, 0, 0, 1, 0),
(6, 50, 58, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_soal_esay`
--

CREATE TABLE IF NOT EXISTS `nilai_soal_esay` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `id_tq` int(50) NOT NULL,
  `id_siswa` int(50) NOT NULL,
  `nilai` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `nilai_soal_esay`
--


-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `ip` varchar(20) NOT NULL,
  `id_siswa` int(50) NOT NULL,
  `tanggal` date NOT NULL,
  `online` varchar(1) NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `online`
--

INSERT INTO `online` (`ip`, `id_siswa`, `tanggal`, `online`) VALUES
('127.0.0.1', 7, '0000-00-00', 'T'),
('::1', 16, '0000-00-00', 'T'),
('127.0.0.1', 11, '0000-00-00', 'Y'),
('127.0.0.1', 28, '0000-00-00', 'T'),
('127.0.0.1', 32, '0000-00-00', 'T'),
('::1', 17, '0000-00-00', 'T'),
('::1', 15, '0000-00-00', 'T'),
('127.0.0.1', 30, '0000-00-00', 'T'),
('::1', 58, '0000-00-00', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

CREATE TABLE IF NOT EXISTS `pengajar` (
  `id_pengajar` int(9) NOT NULL AUTO_INCREMENT,
  `nip` char(12) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(100) NOT NULL,
  `password_login` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'pengajar',
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `jabatan` varchar(200) NOT NULL,
  `blokir` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pengajar`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pengajar`
--

INSERT INTO `pengajar` (`id_pengajar`, `nip`, `nama_lengkap`, `username_login`, `password_login`, `level`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_telp`, `email`, `foto`, `website`, `jabatan`, `blokir`, `id_session`) VALUES
(7, '(022) 611556', 'Dadan Juansah', 'dadan', 'fd68e8922a6705a916b19669fb356cce', 'pengajar', 'Perum Graha-Padalarang', 'Soreang', '1969-07-30', 'L', 'Islam', '(022) 61155664', 'dadan_juansah@yahoo.com', 'dadan.jpg', 'http://', 'Guru ', 'N', 'n3t12uuvtb5m5hge00lmno3lt3'),
(8, '0138203', 'Erik Pratama', 'guru', '77e69c137812518e359196bb2f5e9bb9', 'pengajar', 'Lembang', 'Kuningan', '1985-01-15', 'L', 'Islam', '32141', 'rik_pratama@yahoo.co.id', '578984_3823169739987_1122811948_n.jpg', 'www.erikpratama.net', 'Guru', 'N', 'ok1k1uumhda7o1a5d2hauf3337'),
(9, '044', 'wanda', 'wanda', '5d0aecec3cbbf1da2ec93b114db636c2', 'pengajar', 'Cijerah', 'Ciamis', '1977-01-14', 'L', 'Islam', '0852-2051-6074', 'mrkuswanda@yahoo.com', 'kuswanda.jpg', 'http://', 'Guru', 'N', 'i2mcakutk0l15hpq0d6oe9sj12'),
(10, '213310431', 'Yaya Suharya', 'yaya', '4409eae53c2e26a65cfc24b3a2359eb9', 'pengajar', 'Padalarang', 'Bandung', '2013-03-06', 'L', 'Islam', '9103390131', 'aayaya@yahoo.com', '428945_2507230363694_795627052_n.jpg', 'http://cdi.co.id', 'Guru', 'N', 'q0vpbffs5ddgbk43b0rmtocrp2'),
(11, '1023811', 'Nava Gia Ginasta', 'nava', '533078acd91fffef2a525239de4a3dc9', 'pengajar', 'Cianjur', 'C', '2013-11-21', 'L', 'Islam', '089663867222', 'nava10webmaster', '', 'http://', '', 'N', 'avvm8p1n574pf0sl2v230j0312');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_esay`
--

CREATE TABLE IF NOT EXISTS `quiz_esay` (
  `id_quiz` int(9) NOT NULL AUTO_INCREMENT,
  `id_tq` int(9) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `tgl_buat` date NOT NULL,
  `jenis_soal` varchar(50) NOT NULL DEFAULT 'esay',
  PRIMARY KEY (`id_quiz`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `quiz_esay`
--

INSERT INTO `quiz_esay` (`id_quiz`, `id_tq`, `pertanyaan`, `gambar`, `tgl_buat`, `jenis_soal`) VALUES
(102, 49, 'iawd', '', '2014-03-06', 'esay'),
(97, 49, '2e2e2', 'DESAIN KAOS copy.jpg', '2013-07-30', 'esay');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_pilganda`
--

CREATE TABLE IF NOT EXISTS `quiz_pilganda` (
  `id_quiz` int(10) NOT NULL AUTO_INCREMENT,
  `id_tq` int(9) NOT NULL,
  `pertanyaan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `pil_a` text NOT NULL,
  `pil_b` text NOT NULL,
  `pil_c` text NOT NULL,
  `pil_d` text NOT NULL,
  `kunci` varchar(1) NOT NULL,
  `tgl_buat` date NOT NULL,
  `jenis_soal` varchar(50) NOT NULL DEFAULT 'pilganda',
  PRIMARY KEY (`id_quiz`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=218 ;

--
-- Dumping data for table `quiz_pilganda`
--

INSERT INTO `quiz_pilganda` (`id_quiz`, `id_tq`, `pertanyaan`, `gambar`, `pil_a`, `pil_b`, `pil_c`, `pil_d`, `kunci`, `tgl_buat`, `jenis_soal`) VALUES
(217, 49, 'q', '', 'q', 'q', 'q', 'q', 'A', '2014-03-06', 'pilganda');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `id_siswa` int(9) NOT NULL AUTO_INCREMENT,
  `nis` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username_login` varchar(50) NOT NULL,
  `password_login` varchar(50) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `th_masuk` varchar(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `background` varchar(150) NOT NULL,
  `blokir` enum('Y','N') NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_session_soal` varchar(100) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT 'siswa',
  `Aktivasi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama_lengkap`, `username_login`, `password_login`, `id_kelas`, `jabatan`, `alamat`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `agama`, `nama_ayah`, `nama_ibu`, `th_masuk`, `email`, `no_telp`, `foto`, `background`, `blokir`, `id_session`, `id_session_soal`, `level`, `Aktivasi`) VALUES
(58, '1112010237', 'Nava Gia Ginasta', 'siswa', 'bcd724d15cde8c47650fda962968f102', 'R3a', 'Web Developers', 'Kp.Haurwangi Rt.02/04 Haurwangi-Cianjur', 'Cianjur', '1995-05-10', 'L', 'Islam', 'Nandan', 'Enung', '2011', 'nava.webdevelopers@gmail.com', '089663867222', '1003993_130796320464384_1423269157_n.jpg', '', 'N', 'b4b22eue15cna27jlujrn1hmv1', '1112010237', 'siswa', NULL),
(59, '12134', 'Nava Gia Ginasta', 'nava', '533078acd91fffef2a525239de4a3dc9', 'R3a', 'Ketua Kelas', 'Kp.Haurwangi', 'Cianjur', '1995-05-10', 'L', 'Islam', 'Nandan', 'Enung', '2011', 'navagiaginasta@gmail.com', '089663867222', '20130518183347.jpg', '', 'Y', '12134', '12134', 'siswa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `siswa_sudah_mengerjakan`
--

CREATE TABLE IF NOT EXISTS `siswa_sudah_mengerjakan` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `id_tq` int(20) NOT NULL,
  `id_siswa` varchar(200) NOT NULL,
  `dikoreksi` varchar(1) NOT NULL DEFAULT 'B',
  `hits` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `siswa_sudah_mengerjakan`
--

INSERT INTO `siswa_sudah_mengerjakan` (`id`, `id_tq`, `id_siswa`, `dikoreksi`, `hits`) VALUES
(3, 49, '58', 'B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `topik_quiz`
--

CREATE TABLE IF NOT EXISTS `topik_quiz` (
  `id_tq` int(9) NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) NOT NULL,
  `id_kelas` varchar(5) NOT NULL,
  `id_matapelajaran` varchar(10) NOT NULL,
  `tgl_buat` date NOT NULL,
  `pembuat` varchar(100) NOT NULL,
  `waktu_pengerjaan` int(50) NOT NULL,
  `info` text NOT NULL,
  `terbit` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_tq`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `topik_quiz`
--

INSERT INTO `topik_quiz` (`id_tq`, `judul`, `id_kelas`, `id_matapelajaran`, `tgl_buat`, `pembuat`, `waktu_pengerjaan`, `info`, `terbit`) VALUES
(49, 'Ujikom2', 'R3a', 'weblanjut', '2013-07-30', '8', 3600, 'web', 'Y');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
