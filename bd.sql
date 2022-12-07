-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               10.10.2-MariaDB - mariadb.org binary distribution
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных hunter
CREATE DATABASE IF NOT EXISTS `hunter` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci */;
USE `hunter`;

-- Дамп структуры для таблица hunter.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- Дамп данных таблицы hunter.users: ~15 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `login`, `phone`, `email`, `password`) VALUES
	(1, 'ddd', '+79182224422', 'wefwef@mail.ru', '$2y$10$r.QqG/eAVA1AFp4zer3ZBOB49uwdG75kZA8PW9xh/IuhSaVySpei2'),
	(2, 'argergerg', '+79199999999', 'waeg@mi.ru', '$2y$10$ib/pDJk7Iirgnkpavlpr1.ADqHiHpWNzspx.HGRtg0/byU.ndwwH2'),
	(3, 'dfegferg', '+79182223311', 'argserg@mail.ru', '$2y$10$6N7N67QrBPxyxHgWwZtm0.A5WOkph6jfax0R93p.RbsPsLe8LJ44.'),
	(4, 'efefweafewfweaf', '+79182223333', 'argeserg@mail.ru', '$2y$10$BzRwX9w5ABHvdrZ10y8oLOfvKpg/kE8wAFXD/1VUPUlVlOPQi3ER.'),
	(5, 'ewfwefwef', '+79182223312', 'ffargeserg@mail.ru', '$2y$10$HJSZ.g52Nl8wV4hzZouosugnQYrCcpWRn84ZTxHMD1vWbCg7ue8hW'),
	(6, 'ewfwefwefv', '+79182223310', 'ffargfeserg@mail.ru', '$2y$10$b4.0wvYvABFYlbygu19bfOftkgjOBaX0lHsuCxyNZDHYeSmGTfLjq'),
	(7, 'gergergeeeeeee', '+79111111111', '1111111111rl@mail.ewfw', '$2y$10$PMcdwFq49JjsiMY4ebqGyOu8J6IGp0LaDgdATjtCP0RHLEIa/CUJW'),
	(8, 'tv', '+79199999988', 'dv@mail.ru', '$2y$10$CVD5mj4yxeoRx1ct9EgnM.XYIIhzLsbEmMt74kkEBnsszAFHAatiS'),
	(9, 'rgergerg', '+79199999222', 'dccccv@mail.ru', '$2y$10$cNBAnwWthCf1lXT2JgU1V.4QRz0eBNjJa7ktXjzym5FzIyTJcxkJW'),
	(10, 'privet', '+79199999666', 'dva@mail.ru', '$2y$10$jbK7TcNWU3.kWDVQ8GRgLuWleU0H8ludWN/G/2BnOpb1zy4QNtpPG'),
	(11, 'gsreggrvr', '+79199999939', 'dv11sv@mail.ru', '$2y$10$jts/rewOqP3.1thXRFYcrep7msh9czi3Rzd4UgTCbwfb/w7iKMKZi'),
	(12, 'vrerv', '+79199999991', 'ddv@mail.ru', '$2y$10$KMPAj.bp98PfLHYRCwarSusgKfPAjcJLyRZJv2HoAqe9Per6utS/C'),
	(13, 'ewfwefw', '+79199999911', 'd1dede1dsv@mail.ru', '$2y$10$pio9AFr9NkiN0usu4gfvK.ZPkVxqgkA7dm3DKFI5dYA1WpzrMy38G'),
	(14, 'assssss', '+79191111111', 'dddddddvv@mail.ru', '$2y$10$1wZeXzluNWXbS33eiRrdFOa6zS3fI4k1sn41lr/k2M/AIXWbQI5am'),
	(15, 'esggrefffff', '+79192229911', 'reagergvv@mail.ru', '$2y$10$rEKq4Ss0J.MdwDgfehsq1OTDF9F0z5RdEXcyciEJUr6QQathTNpve'),
	(16, 'efewfewfwef', '+79182223344', 'wge@pochta.com', '$2y$10$4I3oSqc5mWmwOqyhR0PN6.O0.f18kavU7FTWQa9ki5WAIn/fKMOtu'),
	(17, 'ef1111', '+79185552222', 'wgcccccccde@pochta.com', '$2y$10$IVLWTtK2zANroeee7ASRZO8ZdrzV7MWI8UjV4VmCnEipopSN1v.L.');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
