-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: dienthoaididong
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.20.04.1

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_at` varchar(30) NOT NULL,
  `update_at` varchar(30) NOT NULL,
  `description` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Iphone','10-05-2020 00:54:36','10-05-2020 00:54:36','Hãng điện thoại hàng đầu tại nước Mỹ, chuyên sản xuất các dòng điện thoại, laptop, tablet cao cấp và được ưa chuộng trên thế giới.'),(2,'Samsung','10-05-2020 00:54:36','14-05-2020 09:33:40','Hãng điện thoại hàng đầu từ Hàn Quốc. Chuyên cung cấp các thiết bị điện tử và gia dụng được ưa chuộng trên toàn thế giới.'),(3,'Oppo','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(4,'Vivo','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(5,'Xiaomi','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(6,'Huawei','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(7,'Realme','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(15,'test','03-07-2020 16:44:51','03-07-2020 16:44:51','test');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_at` varchar(30) NOT NULL,
  `update_at` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color`
--

LOCK TABLES `color` WRITE;
/*!40000 ALTER TABLE `color` DISABLE KEYS */;
INSERT INTO `color` VALUES (1,'Đỏ','10-05-2020 00:54:36','10-05-2020 00:54:36'),(2,'Xanh lam','10-05-2020 00:54:36','10-05-2020 00:54:36'),(3,'Vàng','10-05-2020 00:54:36','10-05-2020 00:54:36'),(4,'Cam','10-05-2020 00:54:36','10-05-2020 00:54:36'),(5,'Trắng','10-05-2020 00:54:36','10-05-2020 00:54:36'),(6,'Đen','10-05-2020 00:54:36','10-05-2020 00:54:36'),(7,'Tím','10-05-2020 00:54:36','10-05-2020 00:54:36'),(8,'Hồng','10-05-2020 00:54:36','10-05-2020 00:54:36'),(9,'Bạc','10-05-2020 00:54:36','10-05-2020 00:54:36');
/*!40000 ALTER TABLE `color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_customer` int NOT NULL,
  `id_product` int NOT NULL,
  `content` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_at` varchar(30) NOT NULL,
  `amount` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_customer_1_idx` (`id_customer`),
  KEY `fk_id_product_1_idx` (`id_product`),
  CONSTRAINT `fk_id_customer_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_product_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_infomation`
--

DROP TABLE IF EXISTS `company_infomation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_infomation` (
  `name` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_infomation`
--

LOCK TABLES `company_infomation` WRITE;
/*!40000 ALTER TABLE `company_infomation` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_infomation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complain`
--

DROP TABLE IF EXISTS `complain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complain` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_customer` int NOT NULL,
  `content` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_at` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_contact_1_idx` (`id_customer`),
  CONSTRAINT `fk_contact_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complain`
--

LOCK TABLES `complain` WRITE;
/*!40000 ALTER TABLE `complain` DISABLE KEYS */;
/*!40000 ALTER TABLE `complain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `pwd_hash` varchar(150) NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `create_at` varchar(30) NOT NULL,
  `update_at` varchar(30) NOT NULL,
  `pwd_reset_token` varchar(50) NOT NULL,
  `bank_number` varchar(25) DEFAULT NULL,
  `salt_passwd` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `pwd_reset_token` (`pwd_reset_token`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (2,'cuong123','3e3eb9dd3d3d81cf66b04a0fbf6e858c','Nguyễn Mạnh Cường','acuongnguyen1898@gmail.com','0816483256','Hà Nội','05-05-2020 15:15:42','04-07-2020 09:05:43','92807417487a18f3c630','234464562424','da37f77bde3c764131fa'),(4,'cuong','c27c49b71af61a2d801ec6a921c8d18a','Nguyen Cuong','acuongnguyen1898@gmail.com','0846238564','','12-05-2020 14:17:52','16-06-2020 18:39:29','0d8b3e241426cde7a9f4',NULL,'92abc9ca618ea24638c6'),(5,'cuong12','03bf4a07dc6ae19fcf00b28a3b9ee013','cuong2','acuongnguyen1898@gmail.com','0465691325','Ha Noi','03-07-2020 16:26:43','03-07-2020 16:26:43','3468da8362476582c6f4',NULL,'45138870becd45089ce0');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deliver_method`
--

DROP TABLE IF EXISTS `deliver_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deliver_method` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_at` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `update_at` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deliver_method`
--

LOCK TABLES `deliver_method` WRITE;
/*!40000 ALTER TABLE `deliver_method` DISABLE KEYS */;
INSERT INTO `deliver_method` VALUES (1,'Bình thường','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(2,'COD','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(3,'Giao hàng nhanh 2h','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(4,'Giao hàng tiết kiệm','10-05-2020 00:54:36','10-05-2020 00:54:36','1');
/*!40000 ALTER TABLE `deliver_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gio_hang`
--

DROP TABLE IF EXISTS `gio_hang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gio_hang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_customer` int NOT NULL,
  `id_product` int NOT NULL,
  `create_at` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_gio_hang_1_idx` (`id_product`),
  KEY `fk_gio_hang_2_idx` (`id_customer`),
  CONSTRAINT `fk_gio_hang_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_gio_hang_2` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gio_hang`
--

LOCK TABLES `gio_hang` WRITE;
/*!40000 ALTER TABLE `gio_hang` DISABLE KEYS */;
INSERT INTO `gio_hang` VALUES (30,2,4,'10-05-2020 01:17:35'),(33,4,2,'12-05-2020 14:18:37'),(35,2,3,'14-05-2020 22:18:12'),(37,2,11,'26-06-2020 14:36:43');
/*!40000 ALTER TABLE `gio_hang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_product`
--

DROP TABLE IF EXISTS `image_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `image_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_product` int NOT NULL,
  `image_link` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_image_product_1_idx` (`id_product`),
  CONSTRAINT `fk_image_product_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_product`
--

LOCK TABLES `image_product` WRITE;
/*!40000 ALTER TABLE `image_product` DISABLE KEYS */;
INSERT INTO `image_product` VALUES (1,'anh 1',1,'image/iphone-7-plus/1.jpg'),(2,'anh2',1,'image/iphone-7-plus/2.jpg'),(3,'anh3',1,'image/iphone-7-plus/3.jpg'),(4,'anh4',1,'image/iphone-7-plus/4.jpg'),(5,'anh5',1,'image/iphone-7-plus/5.jpg'),(6,'anh6',1,'image/iphone-7-plus/6.jpg'),(7,'anh7',1,'image/iphone-7-plus/7.jpg'),(8,'anh8',1,'image/iphone-7-plus/8.jpg'),(9,'anh1',2,'image/oppo-reno-2f/1.jpg'),(10,'anh2',2,'image/oppo-reno-2f/2.jpg'),(11,'anh3',2,'image/oppo-reno-2f/3.jpg'),(12,'anh4',2,'image/oppo-reno-2f/5.jpg'),(13,'anh5',2,'image/oppo-reno-2f/6.jpg'),(14,'anh1',3,'image/samsung-galaxy-a51/2.png'),(15,'anh2',3,'image/samsung-galaxy-a51/3.png'),(16,'anh3',3,'image/samsung-galaxy-a51/4.jpg'),(17,'anh4',3,'image/samsung-galaxy-a51/5.jpg'),(18,'anh5',3,'image/samsung-galaxy-a51/6.jpg'),(19,'anh1',4,'image/vivo-y50/1.png'),(20,'anh2',4,'image/vivo-y50/2.png'),(21,'anh3',4,'image/vivo-y50/3.png'),(22,'anh4',4,'image/vivo-y50/4.png'),(23,'anh5',4,'image/vivo-y50/5.png'),(35,'iphone-11-xanh-la-5-180x125.jpg',9,'uploads/iphone-11-xanh-la-5-180x125.jpg'),(36,'iphone-11-xanh-la-4-180x125.jpg',9,'uploads/iphone-11-xanh-la-4-180x125.jpg'),(37,'iphone-11-xanh-la-3-180x125.jpg',9,'uploads/iphone-11-xanh-la-3-180x125.jpg'),(38,'iphone-11-xanh-la-1-180x125.jpg',9,'uploads/iphone-11-xanh-la-1-180x125.jpg'),(39,'iphone-11-red-2-400x460-400x460.png',9,'uploads/iphone-11-red-2-400x460-400x460.png'),(40,'xiaomi-redmi-note-9s-xam-11-180x125.jpg',10,'uploads/xiaomi-redmi-note-9s-xam-11-180x125.jpg'),(41,'xiaomi-redmi-note-9s-xam-10-180x125.jpg',10,'uploads/xiaomi-redmi-note-9s-xam-10-180x125.jpg'),(42,'xiaomi-redmi-note-9s-xam-5-180x125.jpg',10,'uploads/xiaomi-redmi-note-9s-xam-5-180x125.jpg'),(43,'xiaomi-redmi-note-9s-xam-4-180x125.jpg',10,'uploads/xiaomi-redmi-note-9s-xam-4-180x125.jpg'),(44,'xiaomi-redmi-note-9s-xam-3-180x125.jpg',10,'uploads/xiaomi-redmi-note-9s-xam-3-180x125.jpg'),(45,'realme-6i-xanh-la-12-180x125.jpg',11,'uploads/realme-6i-xanh-la-12-180x125.jpg'),(46,'realme-6i-xanh-la-6-180x125.jpg',11,'uploads/realme-6i-xanh-la-6-180x125.jpg'),(47,'realme-6i-xanh-la-4-180x125.jpg',11,'uploads/realme-6i-xanh-la-4-180x125.jpg'),(48,'realme-6i-xanh-la-3-180x125.jpg',11,'uploads/realme-6i-xanh-la-3-180x125.jpg'),(49,'realme-6i-xanh-la-1-180x125.jpg',11,'uploads/realme-6i-xanh-la-1-180x125.jpg'),(50,'samsung-galaxy-fold-den-14-180x125.jpg',12,'uploads/samsung-galaxy-fold-den-14-180x125.jpg'),(51,'samsung-galaxy-fold-den-8-180x125.jpg',12,'uploads/samsung-galaxy-fold-den-8-180x125.jpg'),(52,'samsung-galaxy-fold-den-5-180x125.jpg',12,'uploads/samsung-galaxy-fold-den-5-180x125.jpg'),(53,'samsung-galaxy-fold-den-4-180x125.jpg',12,'uploads/samsung-galaxy-fold-den-4-180x125.jpg'),(54,'samsung-galaxy-fold-den-2-180x125.jpg',12,'uploads/samsung-galaxy-fold-den-2-180x125.jpg'),(55,'huawei-p40-pro-xanh-11-180x125.jpg',13,'uploads/huawei-p40-pro-xanh-11-180x125.jpg'),(56,'huawei-p40-pro-xanh-10-180x125.jpg',13,'uploads/huawei-p40-pro-xanh-10-180x125.jpg'),(57,'huawei-p40-pro-xanh-4-180x125.jpg',13,'uploads/huawei-p40-pro-xanh-4-180x125.jpg'),(58,'huawei-p40-pro-xanh-2-180x125.jpg',13,'uploads/huawei-p40-pro-xanh-2-180x125.jpg'),(59,'huawei-p40-pro-xanh-1-180x125.jpg',13,'uploads/huawei-p40-pro-xanh-1-180x125.jpg'),(60,'samsung-galaxy-z-flip-tgdd16.jpg',14,'uploads/samsung-galaxy-z-flip-tgdd16.jpg'),(61,'samsung-galaxy-z-flip-tgdd15.jpg',14,'uploads/samsung-galaxy-z-flip-tgdd15.jpg'),(62,'samsung-galaxy-z-flip-tgdd13.jpg',14,'uploads/samsung-galaxy-z-flip-tgdd13.jpg'),(63,'samsung-galaxy-z-flip-tgdd12.jpg',14,'uploads/samsung-galaxy-z-flip-tgdd12.jpg'),(64,'samsung-galaxy-z-flip-tgdd11.jpg',14,'uploads/samsung-galaxy-z-flip-tgdd11.jpg'),(65,'samsung-galaxy-z-flip-tgdd10.jpg',14,'uploads/samsung-galaxy-z-flip-tgdd10.jpg'),(66,'oppo-find-x2-xanh-duong-13-180x125.jpg',15,'uploads/oppo-find-x2-xanh-duong-13-180x125.jpg'),(67,'oppo-find-x2-xanh-duong-12-180x125.jpg',15,'uploads/oppo-find-x2-xanh-duong-12-180x125.jpg'),(68,'oppo-find-x2-xanh-duong-6-180x125.jpg',15,'uploads/oppo-find-x2-xanh-duong-6-180x125.jpg'),(69,'oppo-find-x2-xanh-duong-4-180x125.jpg',15,'uploads/oppo-find-x2-xanh-duong-4-180x125.jpg'),(70,'oppo-find-x2-xanh-duong-1-180x125.jpg',15,'uploads/oppo-find-x2-xanh-duong-1-180x125.jpg'),(71,'slide-galaxy-a51.png',16,'uploads/slide-galaxy-a51.png'),(72,'logo.jpg',16,'uploads/logo.jpg'),(73,'facebook.png',16,'uploads/facebook.png'),(74,'customer_avatar.jpg',16,'uploads/customer_avatar.jpg'),(75,'admin_avartar.png',16,'uploads/admin_avartar.png');
/*!40000 ALTER TABLE `image_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhan_vien`
--

DROP TABLE IF EXISTS `nhan_vien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nhan_vien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `pwd_hash` varchar(150) NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `create_at` varchar(30) NOT NULL,
  `update_at` varchar(30) NOT NULL,
  `pwd_reset_token` varchar(45) NOT NULL,
  `id_position` int NOT NULL,
  `ID_employee_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `salt_passwd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_nhan_vien_1_idx` (`id_position`),
  CONSTRAINT `fk_nhan_vien_1` FOREIGN KEY (`id_position`) REFERENCES `position` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhan_vien`
--

LOCK TABLES `nhan_vien` WRITE;
/*!40000 ALTER TABLE `nhan_vien` DISABLE KEYS */;
INSERT INTO `nhan_vien` VALUES (1,'nhanvienbanhang','256f6593424774a3c5c48d5d06443388','Nguyễn Mạnh Cường','acuongnguyen1898@gmail.com','0561553468','12-05-2020 09:56:48','03-07-2020 16:28:24','525e746e4e49be7a78ac',1,'B17DCAT029','8ee8867fa87b2bedc5c1'),(2,'nhanvienkho','d8c92c92641daa9ef68688c6ef92d36f','Nguyen Cuong','acuongnguyen1898@gmail.com','0846843164','12-05-2020 17:05:02','03-07-2020 16:49:24','d637f8770d9ccf7acbff',2,'B17DCAT029','1e7d7f212767dca7af9a'),(3,'admin','c70012aa02e933312b7e5e973c038570','Nguyen Manh Cuong','acuongnguyen1898@gmail.com','0846531654','14-05-2020 14:23:42','14-05-2020 21:46:57','135743098069c4cfda1d',3,'B17DCAT029','e949f077919c4b6d9de5');
/*!40000 ALTER TABLE `nhan_vien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_customer` int NOT NULL,
  `create_at` varchar(30) NOT NULL,
  `id_status_order` int NOT NULL,
  `address_ship` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone_number` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name_deliver_method` varchar(45) NOT NULL,
  `name_payment_method` varchar(45) NOT NULL,
  `info_payment` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `update_at` varchar(30) NOT NULL,
  `total_price` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_order_1_idx` (`id_customer`),
  KEY `fk_order_2_idx` (`id_status_order`),
  KEY `fk_order_3_idx` (`name_deliver_method`),
  KEY `fk_order_4_idx` (`name_payment_method`),
  CONSTRAINT `fk_order_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`),
  CONSTRAINT `fk_order_2` FOREIGN KEY (`id_status_order`) REFERENCES `status_order` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (67,2,'01-05-2020 00:54:36',2,'Hà Nội','123435345','Bình thường','Tiền mặt','','03-07-2020 16:32:01','11984000'),(68,2,'10-05-2020 01:17:56',6,'Hà Nội','34535345','Bình thường','Ngân hàng','Số thẻ: 234464562424','03-07-2020 16:32:36','17877000'),(69,4,'12-05-2020 14:19:35',3,'ha noi','0846238564','Bình thường','Tiền mặt','','12-05-2020 14:19:35','5992000'),(70,2,'14-05-2020 20:53:11',5,'Hà Nội','0816483256','Bình thường','Tiền mặt','','14-05-2020 20:55:07','5992000'),(71,2,'14-05-2020 20:53:21',5,'Hà Nội','0816483256','Bình thường','Tiền mặt','','14-05-2020 20:55:13','5790000'),(72,2,'14-05-2020 20:53:31',5,'Hà Nội','0816483256','Bình thường','Tiền mặt','','14-05-2020 20:55:17','7790000'),(73,2,'14-05-2020 20:53:39',5,'Hà Nội','0816483256','Bình thường','Tiền mặt','','14-05-2020 20:55:22','5992000'),(74,2,'14-05-2020 20:53:47',5,'Hà Nội','0816483256','Bình thường','Tiền mặt','','14-05-2020 20:55:27','11885000'),(75,2,'14-05-2020 20:53:51',5,'Hà Nội','0816483256','Bình thường','Tiền mặt','','14-05-2020 20:55:31','11885000'),(76,2,'14-05-2020 22:09:50',4,'Hà Nội','0816483256','Bình thường','Ngân hàng','Số thẻ: 234464562424','14-05-2020 22:16:18','100000000'),(77,2,'14-05-2020 22:15:30',2,'Hà Nội','0816483256','Bình thường','Tiền mặt','','14-05-2020 22:23:27','42565000'),(78,2,'14-05-2020 22:18:22',3,'Hà Nội','0816483256','Giao hàng nhanh 2h','Ngân hàng','Số thẻ: 234464562424','23-06-2020 14:02:43','23370000'),(79,2,'14-05-2020 22:18:45',1,'Hà Nội','0816483256','Bình thường','Tiền mặt','','14-05-2020 22:18:45','35270000'),(80,2,'23-06-2020 14:01:58',1,'Hà Nội','0816483256','Bình thường','Tiền mặt','','23-06-2020 14:01:58','35270000'),(81,2,'26-06-2020 14:37:09',1,'Hà Nội','0816483256','Bình thường','Tiền mặt','','26-06-2020 14:37:09','45155000'),(82,2,'03-07-2020 16:24:32',1,'Hà Nội','0816483256','Bình thường','Tiền mặt','','03-07-2020 16:24:32','11984000'),(83,2,'03-07-2020 16:25:28',1,'Hà Nội','0816483256','COD','Ngân hàng','Số thẻ: 234464562424','03-07-2020 16:25:28','15675000'),(84,2,'04-07-2020 15:50:19',2,'Hà Nội','0816483256','Bình thường','Tiền mặt','','04-07-2020 15:51:23','18570000'),(85,2,'04-07-2020 09:24:19',2,'Hà Nội','0816483256','Bình thường','Ngân hàng','Số thẻ: 234464562424','04-07-2020 09:25:52','14970000');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_method`
--

DROP TABLE IF EXISTS `payment_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_method` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_at` varchar(30) NOT NULL,
  `update_at` varchar(30) NOT NULL,
  `status` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_method`
--

LOCK TABLES `payment_method` WRITE;
/*!40000 ALTER TABLE `payment_method` DISABLE KEYS */;
INSERT INTO `payment_method` VALUES (1,'Tiền mặt','10-05-2020 00:54:36','10-05-2020 00:54:36','1'),(2,'Ngân hàng','10-05-2020 00:54:36','10-05-2020 00:54:36','1');
/*!40000 ALTER TABLE `payment_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'Chỉnh sửa đơn hàng','1','Quyền này cho phép chỉnh sửa các đơn hàng'),(2,'Chỉnh sửa, tạo sản phẩm','1','Quyền này cho phép chỉnh sửa và tạo các sản phẩm mới'),(3,'Chỉnh sửa, tạo thương hiệu','1','Quyền này cho phép tạo và quản lý các thương hiệu'),(4,'Quản lý users','1','Quyền này cho phép quản lý các user'),(5,'Quản lý position','1','Quyền này cho phép quản lý các position và các permission của position'),(6,'Xem thống kê','1','Quyền này cho phép xem các thông số thống kê dữ liệu của trang web');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_of_position`
--

DROP TABLE IF EXISTS `permission_of_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_of_position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_position` int NOT NULL,
  `id_permission` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_permission_of_position_1_idx` (`id_permission`),
  KEY `fk_permission_of_position_2_idx` (`id_position`),
  CONSTRAINT `fk_permission_of_position_1` FOREIGN KEY (`id_permission`) REFERENCES `permission` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_permission_of_position_2` FOREIGN KEY (`id_position`) REFERENCES `position` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_of_position`
--

LOCK TABLES `permission_of_position` WRITE;
/*!40000 ALTER TABLE `permission_of_position` DISABLE KEYS */;
INSERT INTO `permission_of_position` VALUES (4,3,4),(5,3,5),(6,3,6),(15,2,1),(16,2,3);
/*!40000 ALTER TABLE `permission_of_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `position` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(5000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,'nhân viên bán hàng','người bán hàng và tư vấn khách hàng','1'),(2,'nhân viên quản lý kho và đơn hàng','người quản lý product, category, order,...','1'),(3,'Admin','người quản lý user và các thông số thống kê','1');
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `image_thumbnail` varchar(150) NOT NULL,
  `content` varchar(8000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` varchar(45) NOT NULL,
  `percent_sale` varchar(10) DEFAULT '0',
  `sale_price` varchar(45) DEFAULT NULL,
  `category_id` int NOT NULL,
  `amount` int NOT NULL,
  `create_at` varchar(30) NOT NULL,
  `update_at` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_product_1_idx` (`category_id`),
  CONSTRAINT `fk_product_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Iphone 7 plus','image/iphone-7-plus/thumbnail.jpg','Mặc dù giữ nguyên vẻ bề ngoài so với dòng điện thoại iPhone đời trước, bù lại iPhone 7 Plus 32GB lại được trang bị nhiều nâng cấp đáng giá như camera kép đầu tiên cũng như cấu hình mạnh mẽ.Đặc điểm nổi bật của iPhone 7 Plus 32GB\n\n\nBộ sản phẩm chuẩn: Hộp, Sạc, Tai nghe, Sách hướng dẫn, Cáp, Cây lấy simMặc dù giữ nguyên vẻ bề ngoài so với dòng điện thoại iPhone đời trước, bù lại iPhone 7 Plus 32GB lại được trang bị nhiều nâng cấp đáng giá như camera kép đầu tiên cũng như cấu hình mạnh mẽ.Chiếc điện thoại sở hữu camera kép đầu tiên của Apple. iPhone 7 Plus là chiếc iPhone đầu tiên được trang bị camera kép có cùng độ phân giải 12 MP, đem lại khả năng chụp ảnh ở hai tiêu cự khác nhau.Camera chính chụp hình góc rộng, còn camera phụ có tiêu cự phù hợp để chụp chân dung, có tính năng chụp chân dung xóa phông (làm mờ hậu cảnh). Ngoài trái tim Apple A10 Fusion 4 nhân với hiệu năng cực kì mạnh mẽ và ấn tượng thì iPhone 7 Plus còn được cập nhật hệ điều hành mới nhất với nhiều tính năng bất ngờ, và thú vị.Màn hình Retina trên 7 Plus hỗ trợ DCI-P3 gam màu rộng, nghĩa là chúng có khả năng tái tạo màu sắc trong phạm vi của sRGB.','8.990.000','0%','8.990.000',1,999,'10-05-2020 00:54:36','03-07-2020 16:45:55'),(2,'Oppo Reno 2F','image/oppo-reno-2f/thumbnail.jpg','OPPO Reno 2F là một trong 3 chiếc smartphone thuộc dòng OPPO Reno2 vừa được OPPO giới thiệu với thiết kế thời trang cùng nhiều nâng cấp mạnh mẽ về camera.Cụm camera trên OPPO Reno2 F đã được nâng cấp rõ rệt với camera chính độ phân giải 48 MP cùng ống kính thứ 2 vẫn là 8 MP chụp ảnh góc siêu rộng, một ống kính 2 MP dùng để chụp ảnh chân dung xóa phông và một ống kính 2 MP hỗ trợ chụp ảnh đen trắng.Với độ phân giải 16 MP kèm tính năng làm đẹp bằng AI \"trứ danh\" thì chiếc smartphone OPPO này tự tin làm hài lòng cả những người dùng khó tính nhất.OPPO Reno2 F được trang bị màn hình AMOLED 6.5 inch có độ phân giải 2.340 x 1.080 pixels không bị khuyết bởi tai thỏ hay giọt nước.Hiệu năng của máy được cung cấp bởi vi xử lý MediaTek Helio P70 8 nhân với xung nhịp cao nhất lên đến 2.1 Ghz giúp máy có thể chiến tốt các tựa game hot hiện nay như Liên Quân, PUBG một cách ổn định.Để làm được điều này thì Reno2 F đã sử dụng camera pop-up nằm ngay chính giữa và có thể bật lên chỉ trong vòng 0.74 giây.OPPO trang bị cho OPPO Reno2 F một viên pin có dung lượng cao 4.000 mAh trên điện thoại để đảm bảo bạn có đủ năng lượng vượt qua những ngày bận rộn nhất.Cảm biến này không chỉ cải thiện tốc độ mở khóa nhanh hơn, nhạy hơn, có độ chính xác cao hơn mà còn hiển thị hình ảnh dấu vân tay rõ ràng trong màn hình.','7.490.000','20%','5.992.000',3,1000,'10-05-2020 00:54:36','14-05-2020 22:23:36'),(3,'Samsung Galaxy A51','image/samsung-galaxy-a51/thumnails.png','Galaxy A51 8GB là phiên bản nâng cấp RAM của smartphone tầm trung đình đám Galaxy A51 từ Samsung. Sản phẩm nổi bật với thiết kế sang trọng, màn hình Infinity-O cùng cụm 4 camera đột phá.\nMàn hình tràn viền Infinity-O thời thượng\nMặt trước của Galaxy A51 8GB nổi bật với màn hình tràn viền vô cực Infinity-O kế thừa từ series S, Note cao cấp. Phần đục lỗ rất nhỏ gọn, tạo độ thoáng cho màn hình, mình thực sự rất thích thiết kế này vì nó đẹp hơn tai thỏ, giọt nước, trong khi lại bền hơn cơ chế “thò thụt” của camera dạng pop-up.\n\nMàn hình này sử dụng tấm nền Super AMOLED 6.5 inch, độ phân giải FullHD+, đảm bảo hình ảnh hiển thị sắc nét và độ tương phản cao, màu sắc rực rỡ, bắt mắt.Cảm biến vân tay dưới màn hình cũng được Samsung trang bị lên máy, cho tốc độ mở khóa nhanh chóng, đem tới sự tiện lợi cao nhất cho người dùng khi cho phép nhận diện chính xác ngay cả khi tay có hơi ướt.Galaxy A51 sở hữu cụm 4 camera sau đặt trong module hình chữ nhật “hầm hố”, cung cấp đa dạng các chế độ chụp hình, quay video chuyên nghiệp.Camera chính với độ phân giải lên tới 48 MP đảm bảo những bức ảnh rõ nét cả ngày lẫn đêm, hỗ trợ nhiều chế độ quay phim như Slow Motion, Timelapse,... và đặc biệt là công nghệ siêu chống rung Super Steady.A51 8GB sở hữu con chip Exynos 9611 8 nhân và dung lượng RAM được nâng lên thành 8 GB (so với 6 GB trên phiên bản tiêu chuẩn), kết hợp cùng bộ nhớ trong 128 GB. Cung cấp năng lượng cho máy là viên pin 4000 mAh đáp ứng thoải mái nhu cầu sử dụng trong ngày, bên cạnh đó Galaxy A51 8GB cũng đi kèm sạc nhanh 15 W qua cổng USB Type-C giúp rút ngắn thời gian sạc pin đi đáng kể.','7.790.000','0%','7.790.000',2,450,'10-05-2020 00:54:36','14-05-2020 21:49:45'),(4,'Vivo Y50','image/vivo-y50/thumbnail.png','Vivo Y50 chính thức trình làng với chip Snapdragon 665, 4 camera sau, pin 5.000 mAh. Vừa sáng nay, Vivo V19 ra mắt và bây giờ, đến lượt Vivo Y50, một sản phẩm giá rẻ hơn của Vivo. Cùng trải nghiệm hiệu năng trên Vivo Y50: Snapdragon 665 có đủ ngon? Trải nghiệm Vivo Y50: Liệu đã đủ tốt trong phân khúc hơn 6 triệu? Trên tay Vivo Y50: Màn đục lỗ, chip Snapdragon 665, 4 camera sau, pin 5000 mAh. Trong đại dịch Covid-19 này, Vivo Y50 đã được ra mắt trực tuyến trên Facebook của Vivo Campuchia, hiện khách hàng tại Campuchia đã có thể đặt trước smartphone này với giá 250 USD (khoảng 5.8 triệu đồng). Vivo Y50 sẽ lên kệ tại đất nước này từ ngày 11/4. Vivo Y50 chính thức trình làng với chip Snapdragon 665, 4 camera sau, pin 5.000 mAh. Về cấu hình, Vivo Y50 có màn hình Ultra O 6.53 inch độ phân giải Full HD+, nó có 1 lỗ khoét nhỏ ở góc trên bên trái dành cho camera selfie.Một điểm mà nhiều người sẽ thích đó là Vivo Y50 có 4 camera mặt sau, chúng gồm: Cảm biến chính 13 MP, camera góc siêu rộng 8 MP, camera macro 2 MP và cảm biến độ sâu 2 MP để chụp ảnh chân dung.Chưa hết, Vivo Y50 còn có pin 5.000 mAh và hỗ trợ sạc nhanh 18W thông qua cổng USB-C. Máy cũng có cảm biến vân tay đặt ở mặt sau.Vivo Y50 được tích hợp vi xử lý Snapdragon 665 + bộ nhớ RAM 8 GB + bộ nhớ trong 128 GB. Ngoài ra, nó còn có thêm khe cắm thẻ nhớ microSD để mở rộng bộ nhớ. Máy có 2 màu sắc là Xanh và Đen.','5.790.000','50%','2.895.000',4,450,'10-05-2020 00:54:36','14-05-2020 21:49:51'),(9,'iPhone 11 64GB','uploads/iphone-11-red-2-400x460-400x460.png','Nếu như trước đây iPhone Xr chỉ có một camera thì nay với iPhone 11 chúng ta sẽ có tới hai camera ở mặt sau.\r\n\r\nĐiện thoại iPhone 11 64GB | Camera sau\r\n\r\nNgoài camera chính vẫn có độ phân giải 12 MP thì chúng ta sẽ có thêm một camera góc siêu rộng và cũng với độ phân giải tương tự.Năm nay Apple cũng đã nâng cấp độ phân giải camera trước nên 12 MP thay vì 7 MP như thế hệ trước đó.\r\n\r\nCamera trước cũng có một tính năng thông minh, khi bạn xoay ngang điện thoại nó sẽ tự kích hoạt chế độ selfie góc rộng để bạn có thể chụp với nhiều người hơn.Trên iPhone 11 mới Apple nâng cấp con chip của mình lên thế hệ Apple A13 Bionic rất mạnh mẽ.','21.690.000','0%','21.690.000',1,123,'14-05-2020 22:00:00','14-05-2020 22:00:00'),(10,'Xiaomi Redmi Note 9S','uploads/xiaomi-redmi-note-9s-xam-3-180x125.jpg','Khác với màn hình giọt nước trên người anh tiền nhiệm Redmi Note 8, Redmi Note 9s có thiết kế màn hình đục lỗ với camera trước đặt trong màn hình tương tự như trên hầu hết các máy flagship hiện nay.Máy được trang bị màn hình IPS LCD với kích thước 6.67 inch, độ phân giải Full HD+ và tỉ lệ màn hình 20:9, cho hình ảnh hiển thị rõ nét và rộng rãi.Về phần cứng, Redmi Note 9s được trang bị con chip Snapdragon 720G với 8 lõi xử lý của Qualcomm cùng với RAM 6 GB chuẩn LPDDR4x và bộ nhớ trong 128 GB chuẩn UFS 2.1. Máy được trang bị 2 Nano SIM và thẻ nhớ Micro SD mở rộng hỗ trợ tối đa 256 GB.Dung lượng pin của Xiaomi Redmi Note 9s khá ấn tượng với dung lượng pin “siêu trâu khổng lồ” đến 5.020 mAh.','5.990.000','20%','4.792.000',5,3342,'14-05-2020 22:03:03','03-07-2020 16:32:44'),(11,'Realme 6i','uploads/realme-6i-xanh-la-1-180x125.jpg','Tiếp nối những thành công của Realme 5i, Realme tiếp tục cho ra đời người em kế nhiệm mang tên Realme 6i với hàng loạt những cải tiến như: MediaTek Helio G80, màn hình giọt nước, 4 camera sau,… đi kèm một mức giá vô cùng hấp dẫn.Realme 6i có thiết kế màn hình giọt nước 6.5 inch, tràn viền hợp xu hướng, công nghệ IPS LCD, độ phân giải HD+ và tỷ lệ khung hình 20:9 cho trải nghiệm tương đối thoải mái, mọi thông tin và hình ảnh đều được hiển thị rõ ràng, màu sắc chính xác.Máy có phiên bản cấu hình RAM 4 GB, ROM 128 GB kết hợp với con chip Helio G80 tối ưu cho game, mang lại hiệu năng ổn định, mượt mà. Đây là một trong những smartphone đầu tiên trên thế giới được trang bị dòng chip mới ra mắt này của MediaTek.','4.990.000','0%','4.990.000',7,543,'14-05-2020 22:04:58','14-05-2020 22:04:58'),(12,'Samsung Galaxy Fold','uploads/samsung-galaxy-fold-den-2-180x125.jpg','Chiếc smartphone Samsung mới được trang bị cấu hình mạnh mẽ nhất của thế giới Android trong năm 2019 chính là chipset Snapdragon 855 mạnh mẽ cùng với RAM lên đến 12 GB.Bộ nhớ trong của máy cũng có dung lượng khủng lên tới 512 GB thoải mái cho bạn cài đặt game, ứng dụng cũng như lưu trữ dữ liệu cá nhân.Samsung Galaxy Fold sở hữu bộ 3 camera chính ở mặt lưng với khả năng chụp ảnh chân dung cũng như hỗ trợ ống kính góc rộng cho chụp phong cảnh.','50.000.000','0%','50.000.000',2,23223,'14-05-2020 22:07:16','14-05-2020 22:07:16'),(13,'Huawei P40 Pro','uploads/huawei-p40-pro-xanh-1-180x125.jpg','Không chỉ vuốt cong 2 cạnh như trên P30 Pro, Huawei P40 Pro sở hữu màn hình uốn cong ở cả 4 cạnh cho trải nghiệm thị giác cực ấn tượng, các phần viền gần như mất đi chỉ để lại màn hình ở mặt trước.Ngoài ra, với tốc độ làm mới lên đến 90 Hz, đem lại cảm giác vuốt chạm, các chuyển động trên máy, chơi game, video mượt mà hơn. Tấm nền OLED cho màu sắc sống động, độ tương phản cao và màu đen sâu, tiết kiệm pin hơn.4 camera của Huawei P40 Pro được đặt thành cụm hình chữ nhật nổi bật trên mặt lưng, lần lượt là ống kính góc rộng 40 MP, camera chính 50 MP, camera zoom 12 MP, phía còn lại là camera TOF 3D đo chiều sâu.Huawei P40 Pro sử dụng chip Kirin 990 5G trên tiến trình 7nm+ hiện đại, cùng dung lượng RAM 8 GB cho sức mạnh đỉnh cao trên smartphone, Mọi tác vụ chơi game hay xử lý 3D, AR trên điện thoại đều được thực hiện mượt mà không chút khó khăn.','23.990.000','0%','23.990.000',6,35435,'14-05-2020 22:09:11','14-05-2020 22:09:11'),(14,'Samsung Galaxy Z Flip','uploads/samsung-galaxy-z-flip-tgdd10.jpg','Tuy nhiên điểm khác biệt là màn hình của Z Flip được thiết kế gập theo chiều dọc, khiến cho tổng thể máy có thể nằm gọn trong lòng bàn tay của người dùng như một phụ kiện thời trang cao cấp.Bên cạnh đó công nghệ này còn cho phép Samsung Galaxy Z Flip có thể dễ dàng gập mở với độ bền lên tới hơn 200.000 lần, mở ra một thập kỷ mới của sự sáng tạo dành cho điện thoại màn hình gập.Galaxy Z Flip sở hữu màn hình Infinity Flex với công nghệ kính uốn dẻo Ultra Thin Glass (UTG) độc đáo từ Samsung, công nghệ này giúp máy mỏng hơn, cho cảm giác cầm nắm sang trọng và cao cấp.','36.000.000','0%','36.000.000',2,2324,'14-05-2020 22:12:28','14-05-2020 22:12:28'),(15,'OPPO Find X2','uploads/oppo-find-x2-xanh-duong-1-180x125.jpg','Màn hình này có độ sáng cao, hình ảnh sống động với hơn 1 tỷ màu, cùng công nghệ HDR10+ tiên tiến và nhiều tính năng thông minh khác, hứa hẹn sẽ đem đến một trải nghiệm thị giác tuyệt vời, màn hình Find X2 được Displaymate đánh giá rất cao, nằm trong top những chiếc smartphone có màn hình tốt nhất tính đến thời điểm hiện tại (3/2020).Đặc biệt hơn, màn hình Ultra Vision của Find X2 cung cấp tốc độ làm mới 120 Hz có thể kích hoạt cùng độ phân giải QHD+, cho mọi hình ảnh chuyển động mượt mà, trơn tru nhất. Tốc độ lấy mẫu cảm ứng lên tới 240 Hz đáp ứng ngay lập tức mọi thao tác chạm, vuốt của bạn.Find X2 tự tin là một trong những smartphone có chất lượng camera hàng đầu hiện nay với bộ camera góc rộng 48 MP, camera zoom quang 13 MP và góc siêu rộng 12 MP.Là một flagship cao cấp, hiển nhiên Find X2 sở hữu trong mình một phần cứng hàng đầu với chip Snapdragon 865 đầu bảng 2020, RAM khủng 12 GB cùng bộ nhớ trong 256 GB thoả sức lưu trữ.','23.990.000','0%','23.990.000',3,123,'14-05-2020 22:14:40','14-05-2020 22:14:40'),(16,'test','uploads/admin_avartar.png','test','1','0','1',2,0,'03-07-2020 16:47:09','03-07-2020 16:48:24');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_color`
--

DROP TABLE IF EXISTS `product_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL,
  `id_color` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_product_color_1_idx` (`id_product`),
  KEY `fk_product_color_2_idx` (`id_color`),
  CONSTRAINT `fk_product_color_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_product_color_2` FOREIGN KEY (`id_color`) REFERENCES `color` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_color`
--

LOCK TABLES `product_color` WRITE;
/*!40000 ALTER TABLE `product_color` DISABLE KEYS */;
INSERT INTO `product_color` VALUES (1,1,1),(2,1,5),(3,1,6),(4,1,9),(5,2,1),(6,2,5),(7,2,6),(8,3,2),(9,3,1),(10,3,3),(11,3,5),(12,3,4),(13,4,5),(14,4,9),(15,4,8);
/*!40000 ALTER TABLE `product_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_in_order`
--

DROP TABLE IF EXISTS `products_in_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_in_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL,
  `id_order` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_products_in_order_1_idx` (`id_product`),
  KEY `fk_products_in_order_2_idx` (`id_order`),
  CONSTRAINT `fk_products_in_order_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_products_in_order_2` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_in_order`
--

LOCK TABLES `products_in_order` WRITE;
/*!40000 ALTER TABLE `products_in_order` DISABLE KEYS */;
INSERT INTO `products_in_order` VALUES (53,2,67),(54,1,68),(55,2,68),(56,4,68),(57,2,69),(58,2,70),(59,4,71),(60,3,72),(61,2,73),(62,1,74),(63,4,74),(64,1,75),(65,4,75),(66,12,76),(67,1,77),(68,4,77),(69,9,77),(70,3,78),(71,3,79),(72,4,79),(73,9,79),(74,3,80),(75,4,80),(76,9,80),(77,3,81),(78,4,81),(79,9,81),(80,11,81),(81,2,82),(82,3,83),(83,4,83),(84,11,83),(85,3,84),(86,4,84),(87,11,84),(88,11,85);
/*!40000 ALTER TABLE `products_in_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_order`
--

DROP TABLE IF EXISTS `status_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `status_UNIQUE` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_order`
--

LOCK TABLES `status_order` WRITE;
/*!40000 ALTER TABLE `status_order` DISABLE KEYS */;
INSERT INTO `status_order` VALUES (1,'Hàng đợi','Hàng đợi'),(2,'Xác nhận','Xác nhận'),(3,'Đang gói hàng','Đang gói hàng'),(4,'Đang giao hàng','Đang giao hàng'),(5,'Hoàn thành','Hoàn thành'),(6,'Đã hủy','Đã hủy');
/*!40000 ALTER TABLE `status_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-07 18:53:56
