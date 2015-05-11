-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.43-0+deb7u1-log - (Debian)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- Dumping data for table infogoal.badges: ~1 rows (approximately)
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
INSERT INTO `badges` (`id`, `rulesToGetBadge`, `name`, `imageUrl`, `howToGetBadge`) VALUES
	(1, 'win::1', '', '', ''),
	(2, 'win::3', '', '', ''),
	(5, 'played::1', '', '', ''),
	(6, 'played::3', '', '', '');
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;

-- Dumping data for table infogoal.players: ~4 rows (approximately)
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` (`id`, `cardId`, `name`, `xp`, `levelXp`, `level`, `played`, `won`, `lastGame`, `photo`) VALUES
	(7, 4255210, 'Albertas Balzarevičius', 130, 1000, 1, 5, 2, '2015-05-07 18:03:05', ''),
	(8, 4255271, 'Aurelija Kuncevičiūtė', 0, 1000, 1, 1, 0, '2015-05-06 19:20:28', ''),
	(9, 4250229, 'Ernestas Oželis', 315, 1000, 1, 3, 2, '2015-05-07 18:03:05', ''),
	(10, 4390173, 'Aivaras Sevelevičius', 0, 1000, 1, 0, 0, '2015-05-05 18:28:18', '');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;

-- Dumping data for table infogoal.PlayersBadges: ~0 rows (approximately)
/*!40000 ALTER TABLE `PlayersBadges` DISABLE KEYS */;
INSERT INTO `PlayersBadges` (`id`, `playerId`, `badgeId`, `date`) VALUES
	(9, 7, 1, '2015-05-08 20:31:33'),
	(10, 7, 5, '2015-05-08 20:31:33'),
	(11, 7, 6, '2015-05-08 20:31:33'),
	(12, 9, 1, '2015-05-08 23:04:19'),
	(13, 9, 5, '2015-05-08 23:04:19'),
	(14, 9, 6, '2015-05-08 23:04:19'),
	(15, 8, 5, '2015-05-08 23:05:05');
/*!40000 ALTER TABLE `PlayersBadges` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
