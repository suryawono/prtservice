-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2015 at 04:20 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prt`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`id` int(11) NOT NULL,
  `biodata_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `account_status_id` int(11) DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL,
  `token_activation_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `biodata_id`, `user_id`, `account_status_id`, `activation_date`, `token_activation_id`, `created`, `modified`, `deleted`, `delete_date`) VALUES
(1, 1, 1, 2, NULL, NULL, '2015-01-29 12:19:27', '2015-01-29 18:45:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `anggotas`
--

CREATE TABLE IF NOT EXISTS `anggotas` (
`id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jenis_anggota_id` int(11) NOT NULL,
  `hubungan_anggota_id` int(11) DEFAULT NULL,
  `rumah_tangga_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggotas`
--

INSERT INTO `anggotas` (`id`, `email`, `password`, `nama`, `jenis_anggota_id`, `hubungan_anggota_id`, `rumah_tangga_id`, `created`, `modified`) VALUES
(1, 'suryawono@yahoo.co.id', 'suhendilau', 'Surya  Wono', 1, NULL, 1, '2015-03-01 20:57:09', '2015-03-25 18:20:46'),
(2, 'hatsune@gmail.com', 'suhendilau', 'Hatsune Miku', 2, 2, 1, '2015-03-02 22:13:22', '2015-03-02 22:13:22'),
(3, '7311093@student.unpar.ac.id', '532336', 'Surya Wono', 1, NULL, 2, '2015-03-03 01:01:32', '2015-03-03 01:01:32'),
(4, 'anak@gmail.com', 'anak', 'Anaku', 2, 3, 1, '2015-03-13 12:31:13', '2015-03-13 12:31:13');

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE IF NOT EXISTS `biodata` (
`id` int(11) NOT NULL,
  `first_name` varchar(250) DEFAULT NULL,
  `middle_name` varchar(250) DEFAULT NULL,
  `last_name` varchar(250) DEFAULT NULL,
  `identity_type_id` int(11) DEFAULT NULL,
  `identity_number` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `postal_code` varchar(11) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `handphone` varchar(16) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL COMMENT 'kolom ini diisi dengan kewarganegaraan pelamar. Cukup masukan id dari tabel negara.',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `first_name`, `middle_name`, `last_name`, `identity_type_id`, `identity_number`, `address`, `city`, `state_id`, `postal_code`, `birth_date`, `gender_id`, `phone`, `handphone`, `country_id`, `created`, `modified`) VALUES
(1, 'Admin', NULL, 'ecommerce', NULL, NULL, '-', '-', 1515, '-', NULL, NULL, NULL, '-', 100, '2015-01-29 18:45:55', '2015-01-29 18:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `hm_anggota_kategoris`
--

CREATE TABLE IF NOT EXISTS `hm_anggota_kategoris` (
`id` int(11) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hubungan_anggotas`
--

CREATE TABLE IF NOT EXISTS `hubungan_anggotas` (
`id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hubungan_anggotas`
--

INSERT INTO `hubungan_anggotas` (`id`, `nama`, `created`, `modified`) VALUES
(1, 'Suami', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Istri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Anak', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Sepupu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Saudara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Ayah', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Ibu', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_anggotas`
--

CREATE TABLE IF NOT EXISTS `jenis_anggotas` (
`id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `created` int(11) NOT NULL,
  `modifed` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_anggotas`
--

INSERT INTO `jenis_anggotas` (`id`, `nama`, `created`, `modifed`) VALUES
(1, 'Kepala Rumah Tangga', 0, 0),
(2, 'Pengurus Rumah Tangga', 0, 0),
(3, 'Anggota', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kategoris`
--

CREATE TABLE IF NOT EXISTS `jenis_kategoris` (
`id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_kategoris`
--

INSERT INTO `jenis_kategoris` (`id`, `nama`, `created`, `modified`) VALUES
(1, 'Pemasukan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Pengeluaran', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE IF NOT EXISTS `kategoris` (
`id` int(11) NOT NULL,
  `jenis_kategori_id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `is_default` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `jenis_kategori_id`, `nama`, `is_default`, `created`, `modified`) VALUES
(1, 1, 'Gaji', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Jualan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'Makanan', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 2, 'Minuman', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'Transfer Dari', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 2, 'Transfer Ke', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
`id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `class_icon` varchar(50) DEFAULT NULL,
  `ordering_number` int(11) DEFAULT NULL,
  `alias` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `position`, `class_icon`, `ordering_number`, `alias`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(1, 'Kategori', 'left', NULL, 1, 'kategori', NULL, NULL, 0, NULL),
(2, 'Rumah Tangga', 'left', NULL, 2, 'rumah-tangga', NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module_contents`
--

CREATE TABLE IF NOT EXISTS `module_contents` (
`id` int(11) NOT NULL,
  `module_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `user_group_id`, `module_id`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(1, 1, 1, NULL, NULL, 0, NULL),
(2, 1, 2, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rumah_tanggas`
--

CREATE TABLE IF NOT EXISTS `rumah_tanggas` (
`id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `rumah_tangga_status_id` int(2) NOT NULL DEFAULT '1',
  `deskripsi` text NOT NULL,
  `setup_up` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah_tanggas`
--

INSERT INTO `rumah_tanggas` (`id`, `nama`, `alamat`, `rumah_tangga_status_id`, `deskripsi`, `setup_up`, `created`, `modified`) VALUES
(1, 'Andigo', 'Jln. Bukit Sari 7, Ciumbeluit Bandung', 2, 'Warning!', 1, '2015-03-01 20:57:09', '2015-03-01 20:57:31'),
(2, 'Unpar', 'Bandung', 2, '', 1, '2015-03-03 01:01:32', '2015-03-03 01:02:38');

-- --------------------------------------------------------

--
-- Table structure for table `rumah_tangga_statuses`
--

CREATE TABLE IF NOT EXISTS `rumah_tangga_statuses` (
`id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rumah_tangga_statuses`
--

INSERT INTO `rumah_tangga_statuses` (`id`, `nama`, `created`, `modified`) VALUES
(1, 'Menunggu Proses', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Disetujui', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Ditolak', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE IF NOT EXISTS `transaksis` (
`id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `besaran` int(11) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `waktu` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksis`
--

INSERT INTO `transaksis` (`id`, `kategori_id`, `besaran`, `deskripsi`, `anggota_id`, `waktu`, `created`, `modified`) VALUES
(1, 1, 0, '', 1, '2015-03-02 16:55:50', '2015-03-02 23:55:50', '2015-03-02 23:55:50'),
(2, 2, 75000, '', 3, '2015-03-02 18:03:11', '2015-03-03 01:02:53', '2015-03-03 01:02:53'),
(3, 1, 7000000, '', 1, '2015-03-13 05:31:35', '2015-03-13 12:31:35', '2015-03-13 12:31:35'),
(4, 3, 250000, '', 1, '2015-03-13 05:31:49', '2015-03-13 12:31:49', '2015-03-13 12:31:49'),
(5, 1, 75000, '', 1, '2015-03-25 17:25:15', '2015-03-25 18:25:16', '2015-03-25 18:25:16'),
(6, 1, 75000, '', 1, '2015-03-25 17:25:15', '2015-03-25 18:26:43', '2015-03-25 18:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `user_group_id` int(11) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `profile_picture` varchar(250) DEFAULT '/img/profile_photos/default',
  `profile_picture_thumbnail` varchar(250) DEFAULT '/img/profile_photos/default',
  `salt` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `username`, `password`, `email`, `profile_picture`, `profile_picture_thumbnail`, `salt`, `created`, `modified`) VALUES
(1, 1, 'admin', '72d93b61fbc2a637a314110ff30c30740cc7b3bf621516b543b34d7fa3eef90d5955a6c57d47d7a0ed622b7aab380bdc2577663338e8b990fe3de242d12c6f49', 'admin@ecommerce.com', '/img/profile_photos/default', '/img/profile_photos/default', '2c436c1a949463948e79b4903380ec6ca42a00e2ff9528619ed2ad39', '2015-01-29 18:45:55', '2015-01-29 18:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
`id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `deleted_date` datetime DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `created`, `modified`, `deleted`, `deleted_date`) VALUES
(1, 'admin', NULL, NULL, 0, NULL),
(2, 'member', NULL, NULL, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `token_activation_id` (`token_activation_id`);

--
-- Indexes for table `anggotas`
--
ALTER TABLE `anggotas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hm_anggota_kategoris`
--
ALTER TABLE `hm_anggota_kategoris`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hubungan_anggotas`
--
ALTER TABLE `hubungan_anggotas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_anggotas`
--
ALTER TABLE `jenis_anggotas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_kategoris`
--
ALTER TABLE `jenis_kategoris`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_contents`
--
ALTER TABLE `module_contents`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rumah_tanggas`
--
ALTER TABLE `rumah_tanggas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rumah_tangga_statuses`
--
ALTER TABLE `rumah_tangga_statuses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `anggotas`
--
ALTER TABLE `anggotas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hm_anggota_kategoris`
--
ALTER TABLE `hm_anggota_kategoris`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hubungan_anggotas`
--
ALTER TABLE `hubungan_anggotas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jenis_anggotas`
--
ALTER TABLE `jenis_anggotas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jenis_kategoris`
--
ALTER TABLE `jenis_kategoris`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `module_contents`
--
ALTER TABLE `module_contents`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rumah_tanggas`
--
ALTER TABLE `rumah_tanggas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rumah_tangga_statuses`
--
ALTER TABLE `rumah_tangga_statuses`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
