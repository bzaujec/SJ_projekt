-- --------------------------------------------------------
-- Hostiteľ:                     127.0.0.1
-- Verze serveru:                10.4.25-MariaDB - mariadb.org binary distribution
-- OS serveru:                   Win64
-- HeidiSQL Verzia:              12.8.0.6978
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportování struktury databáze pro
CREATE DATABASE IF NOT EXISTS `bzsj2024` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bzsj2024`;

-- Exportování struktury pro tabulka bzsj2024.tcategories
CREATE TABLE IF NOT EXISTS `tcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` varchar(10) NOT NULL,
  `cat_name` varchar(32) NOT NULL,
  `cat_desc` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku bzsj2024.tcategories: ~3 rows (přibližně)
INSERT INTO `tcategories` (`id`, `cat_id`, `cat_name`, `cat_desc`) VALUES
	(1, 'cold', 'Iced Coffee', ''),
	(2, 'hot', 'Hot Coffee', ''),
	(3, 'juice', 'Fruit Juice', '');

-- Exportování struktury pro tabulka bzsj2024.titems
CREATE TABLE IF NOT EXISTS `titems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(32) NOT NULL,
  `item_price` decimal(5,2) DEFAULT 0.00,
  `item_desc` text DEFAULT NULL,
  `cat_id` varchar(10) DEFAULT NULL,
  `is_valid` int(1) DEFAULT NULL,
  `item_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Exportování dat pro tabulku bzsj2024.titems: ~9 rows (přibližně)
INSERT INTO `titems` (`id`, `item_name`, `item_price`, `item_desc`, `cat_id`, `is_valid`, `item_image`) VALUES
	(1, 'Iced Americano', 10.25, '', 'cold', 1, 'iced-americano.png'),
	(2, 'Iced Cappuccino', 12.25, '', 'cold', 1, 'iced-cappuccino.png'),
	(3, 'Hot Americano', 8.50, '', 'hot', 1, 'hot-americano.png'),
	(4, 'Hot Cappuccino', 9.50, '', 'hot', 1, 'hot-cappuccino.png'),
	(5, 'Strawberry Smoothie', 12.50, '', 'juice', 1, 'smoothie-1.png'),
	(6, 'Red Berry Smoothie', 14.50, '', 'juice', 1, 'smoothie-2.png'),
	(10, 'Multivitmin', 12.00, 'výborný multivitamín z rôzneho ovocia', 'juice', 1, 'hot-cappuccino.png'),
	(11, 'jablko', 11.00, 'jablko', 'juice', 1, 'Jablko.jfif'),
	(17, 'medovina', 33.00, 'Horuca medovina', 'hot', 1, 'Medovina.jfif');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
