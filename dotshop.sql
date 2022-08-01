-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: dotshop
-- ------------------------------------------------------
-- Server version	8.0.29

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
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id_order` int DEFAULT NULL,
  `id_product` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `product_quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,11,4,48),(3,4,19,85),(5,7,2,72),(6,12,14,37),(7,15,16,4),(8,13,8,38),(9,18,10,13),(10,17,13,29),(1,20,4,6),(11,12,4,20),(11,8,4,6),(12,12,4,20),(12,8,4,6),(13,12,4,20),(14,12,4,20),(14,8,4,6),(15,13,8,6),(16,2,22,6);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id_product` int NOT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `cost` decimal(3,1) DEFAULT NULL,
  `available_products` int DEFAULT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Pork - Tenderloin, Fresh',1.3,71),(2,'Wine - Charddonnay Errazuriz',8.3,54),(3,'Cheese - Cheddar, Mild',1.7,70),(4,'Shrimp - Black Tiger 16/20',7.3,44),(5,'Wine - Jafflin Bourgongone',4.3,44),(6,'Wine - Alsace Riesling Reserve',6.2,1),(7,'Chocolate - Liqueur Cups With Foil',2.0,35),(8,'Cheese - Goat With Herbs',2.9,91),(9,'Oil - Safflower',2.0,88),(10,'Praline Paste',2.6,29),(11,'Ginger - Fresh',6.9,84),(12,'Pork - Belly Fresh',6.1,83),(13,'Bread - Pita',8.6,87),(14,'Onions Granulated',8.6,38),(15,'Basil - Seedlings Cookstown',6.1,55),(16,'Pepper Squash',2.0,45),(17,'Veal - Bones',8.9,97),(18,'Cafe Royale',3.7,97),(19,'Wine - Casillero Deldiablo',9.7,22),(20,'Coffee - Espresso',7.9,66),(21,'Ecolab - Solid Fusion',9.6,50),(22,'Lemon Balm - Fresh',5.8,17),(23,'Quail - Eggs, Fresh',1.5,83),(24,'Crab Brie In Phyllo',7.2,72),(25,'Tea - Apple Green Tea',8.5,85),(26,'Chocolate - Semi Sweet, Calets',3.1,70),(27,'Placemat - Scallop, White',4.0,20),(28,'Wine - Redchard Merritt',8.0,5),(29,'Vinegar - Rice',1.5,44),(30,'Piping - Bags Quizna',6.9,69),(31,'Irish Cream - Baileys',1.2,66),(32,'V8 Pet',9.5,44),(33,'Pear - Packum',8.1,55),(34,'Glaze - Clear',2.4,60),(35,'Juice Peach Nectar',5.7,20),(36,'Bread Base - Goodhearth',4.2,4),(37,'Sobe - Cranberry Grapefruit',4.4,15),(38,'Cup - Translucent 7 Oz Clear',2.1,71),(39,'Appetizer - Spring Roll, Veg',5.9,5),(40,'Sprouts - Peppercress',4.7,16),(41,'Salmon - Fillets',8.5,64),(42,'Soup - Campbells, Chix Gumbo',2.3,75),(43,'Plasticforkblack',8.0,43),(44,'Sweet Pea Sprouts',4.1,53),(45,'Celery',7.9,84),(46,'Tomatoes - Yellow Hot House',1.9,75),(47,'Grand Marnier',2.8,90),(48,'Chinese Foods - Cantonese',1.3,87),(49,'Tea - Herbal Orange Spice',3.6,62),(50,'Pastry - Chocolate Chip Muffin',6.4,19),(51,'Phyllo Dough',8.8,30),(52,'Beef - Short Loin',1.2,37),(53,'Beer - Pilsner Urquell',7.2,84),(54,'Oil - Shortening,liqud, Fry',3.6,97),(55,'Stock - Fish',4.2,24),(56,'Soup - Campbells Mushroom',1.7,38),(57,'Baking Powder',1.7,60),(58,'Beef - Striploin',5.3,18),(59,'Bacardi Raspberry',9.4,61),(60,'Cake - French Pear Tart',9.8,61),(61,'Clam - Cherrystone',6.0,64),(62,'Onions Granulated',3.8,24),(63,'Transfer Sheets',1.4,49),(64,'Oil - Food, Lacquer Spray',5.3,72),(65,'Mace Ground',3.0,74),(66,'Milkettes - 2%',3.7,73),(67,'Evaporated Milk - Skim',5.3,42),(68,'Bread Base - Italian',9.2,3),(69,'Cheese - Cheddar, Old White',9.6,92),(70,'Bagelers - Cinn / Brown',9.4,69),(71,'Juice - Pineapple, 48 Oz',4.9,99),(72,'Tomatoes - Roma',5.4,40),(73,'Tomatoes - Vine Ripe, Red',4.2,16),(74,'Oil - Olive',7.3,35),(75,'Vegetable - Base',6.6,21),(76,'Longos - Grilled Veg Sandwiches',4.9,9),(77,'Scallops - 20/30',5.0,48),(78,'Liners - Baking Cups',1.3,25),(79,'Muffin Batt - Ban Dream Zero',2.4,5),(80,'Scallop - St. Jaques',7.6,12),(81,'Mushroom - Shitake, Dry',6.7,71),(82,'Cheese - Bakers Cream Cheese',8.7,54),(83,'The Pop Shoppe - Black Cherry',3.2,72),(84,'Apple - Royal Gala',3.9,10),(85,'Veal - Leg',9.5,89),(86,'Lamb - Sausage Casings',4.9,42),(87,'Sobe - Liz Blizz',2.8,28),(88,'Tuna - Fresh',9.2,30),(89,'Veal - Round, Eye Of',3.5,41),(90,'Lotus Leaves',9.3,57),(91,'Cheese - Brick With Pepper',2.8,63),(92,'Mangoes',6.8,43),(93,'Bagel - Everything Presliced',1.6,19),(94,'Garam Marsala',6.5,26),(95,'Apple - Fuji',3.5,31),(96,'Bread - Focaccia Quarter',1.2,24),(97,'Pasta - Fusili Tri - Coloured',2.6,73),(98,'Zucchini - Mini, Green',6.9,2),(99,'Wine - Beaujolais Villages',8.8,12),(100,'Wine - Cotes Du Rhone',6.6,39);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Gray','Packman','gpackman0','gpackman0@blogtalkradio.com','2VAlhx4Z'),(2,'Petronille','Ingleston','pingleston1','pingleston1@example.com','OMdrb4SzCCk'),(3,'Nettie','Graeber','ngraeber2','ngraeber2@seesaa.net','jcFEtI'),(4,'Dael','Wellstood','dwellstood3','dwellstood3@qq.com','13c40E'),(5,'Karol','Dawks','kdawks4','kdawks4@illinois.edu','gRwu8X3'),(6,'Eric','Mosdill','emosdill5','emosdill5@addtoany.com','hw89cf'),(7,'Ahmad','Lycett','alycett6','alycett6@pcworld.com','RmcafYVj'),(8,'Daphna','Danilenko','ddanilenko7','ddanilenko7@usnews.com','quJWkXG4Ilm'),(9,'Hinze','Pelchat','hpelchat8','hpelchat8@a8.net','xR1OzF'),(10,'Honor','Collumbell','hcollumbell9','hcollumbell9@disqus.com','qOwrNbp3G6z'),(11,'Zaria','Calcutt','zcalcutta','zcalcutta@prlog.org','18mbGjIvVY4'),(12,'Merrick','Olin','molinb','molinb@skyrock.com','y3BR8TWGi'),(13,'Vanna','Ruddell','vruddellc','vruddellc@cloudflare.com','2wGUkgrcG'),(14,'Gifford','Boniface','gbonifaced','gbonifaced@discovery.com','bZ5O6Fc'),(15,'Jorie','Parkyns','jparkynse','jparkynse@tripadvisor.com','SQ8FKGVnxz8'),(16,'Malachi','Dumbellow','mdumbellowf','mdumbellowf@mysql.com','6WvEhtwEZ'),(17,'Hedwiga','Oakes','hoakesg','hoakesg@cafepress.com','SF2h8xn'),(18,'Ferd','Kintzel','fkintzelh','fkintzelh@trellian.com','wRqz79mb6P'),(19,'Averell','Krelle','akrellei','akrellei@twitter.com','EDztW1'),(20,'Gayle','Guyton','gguytonj','gguytonj@army.mil','86eRoFUY'),(21,'Luigi','Tatonetti','hyde','hyde@discovery.com','1e4e888ac66f8dd41e00c5a7ac36a32a9950d271'),(22,'Luigi','Tatonetti','ltatonetti','luigi@test.com','51abb9636078defbf888d8457a7c76f85c8f114c');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-01  8:56:03
