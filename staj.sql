-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2014 at 10:29 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `staj`
--

-- --------------------------------------------------------

--
-- Table structure for table `birimler`
--

CREATE TABLE IF NOT EXISTS `birimler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `birimKodu` bigint(8) NOT NULL,
  `birim` varchar(100) NOT NULL,
  `bagliOlduguBirimKodu` bigint(8) DEFAULT NULL,
  `parola` varchar(8) NOT NULL,
  `adres` varchar(200) NOT NULL,
  `yetki` int(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `birim` (`birim`),
  KEY `birimKodu` (`birimKodu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `birimler`
--

INSERT INTO `birimler` (`id`, `birimKodu`, `birim`, `bagliOlduguBirimKodu`, `parola`, `adres`, `yetki`) VALUES
(1, 132, 'topkek', 0, '123', 'asdas', 2),
(2, 135, 'deneme', 15987, '123', '', 1),
(3, 123, 'asdsadas', 135, '123', 'asfasfasfa', 1),
(4, 15987, 'bilgi işlem', 0, '123', 'asdasd', 2),
(5, 464645456, 'asdsadsada', 0, '123123', 'asdas adasdvas', 1),
(6, 12345678, 'hele', 0, '123', 'orda burda', 1),
(7, 14785236, 'hljkhkghj', 0, '123', 'adasda', 5),
(8, 0, 'THE BAKAN', NULL, '123', 'bakanlık', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kisiler`
--

CREATE TABLE IF NOT EXISTS `kisiler` (
  `tcKimlik` bigint(11) unsigned NOT NULL,
  `sicilNo` varchar(10) CHARACTER SET utf8 NOT NULL,
  `isim` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `soyad` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ePosta` varchar(50) CHARACTER SET utf8 NOT NULL,
  `birim` bigint(8) NOT NULL,
  `telefon` varchar(15) CHARACTER SET utf8 NOT NULL,
  `dahili` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `faks` varchar(15) CHARACTER SET utf8 NOT NULL,
  `unvan` int(3) NOT NULL,
  `unvan_Diger` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `olusturulmaTarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sonGüncellenme` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tcKimlik`),
  KEY `birim` (`birim`),
  KEY `unvan` (`unvan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kisiler`
--

INSERT INTO `kisiler` (`tcKimlik`, `sicilNo`, `isim`, `soyad`, `ePosta`, `birim`, `telefon`, `dahili`, `faks`, `unvan`, `unvan_Diger`, `olusturulmaTarihi`, `sonGüncellenme`) VALUES
(1232131, '12312', 'asdsad', 'asdsadas', 'sadsadsa', 135, '1232132', '12321', '21321', 123124, NULL, '2014-07-18 12:02:07', '2014-07-18 12:02:07'),
(10048187458, '123456789a', 'can', 'şehirlioğlu', 'asdas@gmail.com', 123, '21312321', '21321312', '123213', 123125, '', '2014-07-17 16:20:54', '2014-07-18 12:03:21'),
(10048187459, '123456789f', 'asd', 'asdasd', 'asdas@kultur.gov.tr', 15987, '2131231', '12321', '123213', 123124, '', '2014-07-18 13:41:49', '2014-07-18 13:41:49'),
(12345678916, '123456789a', 'can', 'şehirlioğlu', 'asdas@kultur.gov.tr', 15987, '12321', '123213', '123213', 123125, '', '2014-07-16 12:12:01', '2014-07-18 11:19:26'),
(12345678922, '123456789c', 'asdsa', 'asdsadsa', 'adassa@kultur.gov', 132, '8888', '445665', '978', 123125, '', '2014-07-18 10:22:08', '2014-07-18 12:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `oturumlar`
--

CREATE TABLE IF NOT EXISTS `oturumlar` (
  `sessionID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `birimKodu` bigint(8) NOT NULL,
  `sessionKey` varchar(60) NOT NULL,
  `sessionAddress` varchar(100) NOT NULL,
  `sessionUseragent` varchar(200) NOT NULL,
  `sessionExpires` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`sessionID`),
  KEY `idxSessionKey` (`sessionKey`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `oturumlar`
--

INSERT INTO `oturumlar` (`sessionID`, `birimKodu`, `sessionKey`, `sessionAddress`, `sessionUseragent`, `sessionExpires`) VALUES
(122, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-16 13:31:10'),
(123, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-16 14:39:20'),
(124, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-16 17:52:52'),
(125, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-16 23:45:56'),
(126, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 15:22:16'),
(127, 15987, 'v272f2n0hosvibpd9esrb9np26', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', '2014-07-17 10:23:22'),
(128, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 10:28:07'),
(129, 15987, 'v272f2n0hosvibpd9esrb9np26', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', '2014-07-17 12:26:51'),
(130, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 12:28:24'),
(131, 15987, '0imubjn55djrij8kkot4k30fd2', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko', '2014-07-17 14:13:17'),
(132, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 14:14:08'),
(133, 15987, '3vacbjehm6atvs35nd47fdrk86', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 14:27:26'),
(134, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 18:52:28'),
(135, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 16:45:52'),
(136, 135, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 17:31:08'),
(137, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 17:32:12'),
(138, 135, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 17:36:30'),
(139, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 17:43:44'),
(140, 135, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 17:48:27'),
(141, 135, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 18:42:22'),
(142, 135, 'v272f2n0hosvibpd9esrb9np26', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', '2014-07-17 18:53:48'),
(143, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-17 20:52:50'),
(144, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-18 17:48:16'),
(145, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-18 11:01:23'),
(146, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-18 12:09:49'),
(147, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-18 12:47:36'),
(148, 135, 'v272f2n0hosvibpd9esrb9np26', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.153 Safari/537.36', '2014-07-18 13:05:30'),
(149, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-18 13:14:55'),
(150, 15987, 'hu2rleeme31v4vgakiv51a8e20', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-18 14:35:32'),
(151, 15987, 'pc93pth8kg1ijcm24oh7th9n21', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:30.0) Gecko/20100101 Firefox/30.0', '2014-07-19 11:09:08'),
(152, 15987, 'gpo094ffqgn07iltd6ugcd6l16', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; rv:11.0) like Gecko', '2014-07-19 11:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `unvanlar`
--

CREATE TABLE IF NOT EXISTS `unvanlar` (
  `unvanKodu` int(3) NOT NULL AUTO_INCREMENT,
  `unvan` varchar(50) NOT NULL,
  PRIMARY KEY (`unvanKodu`),
  KEY `unvan` (`unvan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=123126 ;

--
-- Dumping data for table `unvanlar`
--

INSERT INTO `unvanlar` (`unvanKodu`, `unvan`) VALUES
(123125, 'başkan'),
(123124, 'müdür');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
