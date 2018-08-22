-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 04 Tem 2018, 12:44:15
-- Sunucu sürümü: 5.7.21
-- PHP Sürümü: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `db_hw`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_attribute`
--

DROP TABLE IF EXISTS `tbl_attribute`;
CREATE TABLE IF NOT EXISTS `tbl_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `html` text NOT NULL,
  `style` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_attribute`
--

INSERT INTO `tbl_attribute` (`id`, `user_id`, `type`, `html`, `style`) VALUES
(36, 1, 'a', '<a href=Google style=\'cursor: cell; font-size: 20; zoom: 2\'>www.google.com.tr</a>', '\'cursor: cell; font-size: 20; zoom: 2\''),
(35, 1, 'p', '<p style=\'text-align: left; text-transform: uppercasepx; text-decoration: underline\'>Deneme yazÄ±sÄ± </p>', '\'text-align: left; text-transform: uppercasepx; text-decoration: underline\''),
(31, 1, 'img', '<img src=https://hiset.ets.org/rsc/img/icons/icon-tt-checklist.svg style=\'width: 100; height: 100px; border: 0px solid\' />', '\'width: 100; height: 100px; border: 0px solid\''),
(30, 1, 'table', '<table style=\'width: 300px; height: 80px; color: black; font-size: 20px; font-style: italic\'><tr><td style=\'border: 2px solid;\'>Deneme tablo 2</td><td style=\'border: 2px solid;\'>Deneme tablo 2</td></tr><tr><td style=\'border: 2px solid;\'>Deneme tablo 2</td><td style=\'border: 2px solid;\'>Deneme tablo 2</td></tr></table>', '\'width: 300px; height: 80px; color: black; font-size: 20px; font-style: italic\''),
(37, 7, 'table', '<table style=\'width: 300px; height: 80px;\'><tr><td style=\'border: 1px solid;\'>Deneme tablo 2</td><td style=\'border: 1px solid;\'>Deneme tablo 2</td></tr><tr><td style=\'border: 1px solid;\'>Deneme tablo 2</td><td style=\'border: 1px solid;\'>Deneme tablo 2</td></tr></table>', '\'width: 300px; height: 80px;\''),
(38, 7, 'img', '<img src=https://hiset.ets.org/rsc/img/icons/icon-tt-checklist.svg style=\'width: 40; height: 40px; border: 2px solid\' />', '\'width: 40; height: 40px; border: 2px solid\''),
(39, 7, 'p', '<p style=\'width:100%;\'>Deneme yazÄ±sÄ± </p>', '\'width:100%;\'');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL,
  `user_surname` varchar(25) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`) VALUES
(1, 'Deneme', 'Kullanıcı', 'asd@asd.com', '123456'),
(7, 'Deneme2', 'Son', 'test@gmail.com', '123456');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
