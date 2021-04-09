-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: 192.168.10.10    Database: sfornio_db
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `user_id` int unsigned NOT NULL,
  `image_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`image_id`),
  KEY `comment_for_image` (`image_id`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (104,'Lorem ipsum dolor sit amet, consectetur adipisicing elit.','2021-04-03',2,33),(105,'Ab magnam, ea consequatur sint tenetur vitae voluptate delectus qui quis eaque ex!','2021-04-03',2,33),(106,'Tempora velit fuga incidunt repellendus, sequi quaerat ab delectus.','2021-04-03',2,31),(107,'Aspernatur alias earum adipisci maxime sunt natus quo deleniti beatae nobis atque!','2021-04-03',2,29),(108,'Rerum reiciendis molestias delectus omnis eius? Quibusdam, soluta.','2021-04-03',2,32),(109,'Tempore quasi facilis vero quidem blanditiis impedit. Facilis, eius officiis.','2021-04-03',2,30),(110,'Ea eum cum, magnam ab ratione, minus deleniti repellendus expedita illum nostrum quibusdam error facilis necessitatibus assumenda tempora excepturi.','2021-04-03',1,33),(111,'Culpa minus doloremque, corporis vitae neque temporibus repellendus optio esse ullam?','2021-04-03',1,33),(112,'Vel voluptatibus recusandae perferendis praesentium minima ex eos illo nostrum quae nisi saepe, sunt vitae laboriosam, soluta libero deleniti facilis optio error velit, dolorum distinctio in magni.','2021-04-03',1,31),(113,'Ipsam, tempore cupiditate.','2021-04-03',1,29),(114,'','2021-04-03',1,29);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-03 10:32:42
