-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.43-0+deb7u1 - (Debian)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Dumping data for table infogoal.players: ~3 rows (approximately)
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` (`id`, `cardId`, `name`, `xp`, `levelXp`, `level`, `played`, `won`, `lastGame`, `photo`) VALUES
	(1, 4255210, 'Albertas Balzarevičius', 0, 1000, 1, 0, 0, NULL, ''),
	(2, 4255271, 'Aurelija Kuncevičiūtė', 0, 1000, 1, 0, 0, NULL, ''),
	(3, 4250229, 'Ernestas Oželis', 0, 1000, 1, 0, 0, NULL, '');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
