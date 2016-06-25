-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: biorower
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `text` varchar(1500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users1_idx` (`user_id`),
  KEY `fk_comments_sessions1_idx` (`session_id`),
  CONSTRAINT `fk_comments_sessions1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (10,90,2,'fdgdfgdasdsa','2015-05-14 10:29:47'),(11,90,2,'fdgdfgdasdsa','2015-05-14 10:30:20'),(12,90,2,'dasdasd','2015-05-14 10:38:06'),(13,90,2,'fghfghfgh','2015-05-14 11:45:55'),(38,90,15,'asdasdasd','2015-05-19 10:22:04'),(41,90,2,'asdasdads\r\nghjghj','2015-06-10 12:51:41'),(45,90,2,'ssssssssss','2015-06-10 13:29:10');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_biorower_sessions`
--

DROP TABLE IF EXISTS `data_biorower_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_biorower_sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stroke_count` int(11) DEFAULT NULL,
  `time` double DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `stroke_distance_average` double DEFAULT NULL,
  `stroke_distance_max` double DEFAULT NULL,
  `speed_average` double DEFAULT NULL,
  `speed_max` double DEFAULT NULL,
  `pace_average` double DEFAULT NULL,
  `pace_max` double DEFAULT NULL,
  `heart_rate_average` double DEFAULT NULL,
  `heart_rate_max` double DEFAULT NULL,
  `stroke_rate_average` double DEFAULT NULL,
  `stroke_rate_max` double DEFAULT NULL,
  `power_average` double DEFAULT NULL,
  `power_max` double DEFAULT NULL,
  `power_left_average` double DEFAULT NULL,
  `power_left_max` double DEFAULT NULL,
  `power_right_average` double DEFAULT NULL,
  `power_right_max` double DEFAULT NULL,
  `power_balance` double DEFAULT NULL,
  `angle_average` double DEFAULT NULL,
  `angle_max` double DEFAULT NULL,
  `angle_left_average` double DEFAULT NULL,
  `angle_left_max` double DEFAULT NULL,
  `angle_right_average` double DEFAULT NULL,
  `angle_right_max` double DEFAULT NULL,
  `mml_2_level` double DEFAULT NULL,
  `mml_4_level` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_biorower_sessions`
--

LOCK TABLES `data_biorower_sessions` WRITE;
/*!40000 ALTER TABLE `data_biorower_sessions` DISABLE KEYS */;
INSERT INTO `data_biorower_sessions` VALUES (1,56,15,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37),(2,56,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,88,11,21,36,37),(3,56,49,12,16,14,15,16,14.3,18,19,20,21,22,67,24,100,16,27,28,29,30,31,32,33,34,35,36,37),(4,56,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37),(5,56,15,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37),(6,9,13.200001,84.10025,9.344472,14.767447,6.3712306,6.9157324,78.477776,72.29892,0,0,4.5454545,99.99999,756.30945,926.13135,415.80817,926.13135,356.71567,440.64877,67.12956,138.77777,199,167,199,110.55556,199,0,0),(7,8,11.740001,74.05459,9.256824,13.183761,6.307886,7.454807,79.265854,67.070816,0,0,5.110732,99.99999,750.09094,1160.0247,453.98154,926.13135,341.73962,440.64877,68.327065,143.6875,199,163,199,124.375,199,0,0),(8,30,40.140007,257.82678,8.594226,14.778832,6.4231873,6.7217937,77.84297,74.38491,0,0,1.494768,111.11111,752.06433,850.3811,425.74155,850.3811,330.77267,415.82855,71.705956,129.75,199,160,199,99.5,199,0,0),(9,12,16.619999,110.09755,9.174796,14.777009,6.6244016,7.286615,75.478516,68.618965,0,0,3.6101086,76.92308,853.0644,1083.267,497.13803,1083.267,373.45306,530.0624,66.7779,135.75,199,172,199,99.5,199,0,0),(10,7,10.059999,64.92781,9.275401,13.623918,6.454057,6.7217937,77.47065,74.38491,0,0,5.964215,111.11111,756.2715,850.3811,409.0588,850.3811,348.5988,415.82855,67.89666,139.64285,199,165.57143,199,113.71429,199,0,0),(11,8,20.2,114.402664,14.300333,15.122013,5.663498,5.728035,88.28466,87.28997,0,0,2.9702969,35.502956,511.79755,526.22925,254.7848,263.11462,257.7695,263.11462,49.339672,199,199,199,199,199,199,0,0),(12,4,7.660001,44.67555,11.168887,15.122013,5.8323164,6.12907,85.72923,81.578445,0,0,7.832897,199.99998,566.1708,644.6763,272.5931,320.93433,293.57767,334.90466,60.94498,161.375,199,173.5,199,149.25,199,0,0),(13,4,7.660001,44.67555,11.168887,15.122013,5.8323164,6.12907,85.72923,81.578445,0,0,7.832897,199.99998,566.1708,644.6763,272.5931,320.93433,293.57767,334.90466,60.94498,161.375,199,173.5,199,149.25,199,0,0),(14,11,29.16,166.34212,15.12201,15.122013,5.704462,5.728035,87.65068,87.28997,0,0,2.0576131,22.727272,524.0637,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(15,2,5.34,30.244026,15.122013,15.122013,5.6636753,5.728035,88.2819,87.28997,0,0,11.235954,22.727272,520.3165,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(16,2,5.46,30.244026,15.122013,15.122013,5.539199,5.728035,90.26576,87.28997,0,0,10.989011,22.727272,508.88104,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(17,2,4.48,25.631954,12.815977,15.122013,5.7214184,5.728035,87.390915,87.28997,0,0,13.392858,32.608696,524.4107,526.22925,262.20535,263.11462,262.20535,263.11462,50,199,199,199,199,199,199,0,0),(18,3,7.3600006,42.464314,14.154771,15.122013,5.7696075,6.049647,86.66101,82.64945,0,0,8.152173,29.70297,547.837,619.93774,272.83035,299.00342,279.45496,320.93433,49.4104,199,199,199,199,199,199,0,0),(19,2,5.34,30.244026,15.122013,15.122013,5.6636753,5.728035,88.2819,87.28997,0,0,11.235954,22.727272,520.3165,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(20,1,2.76,15.122013,15.122013,15.122013,5.47899,5.728035,91.25769,87.28997,0,0,21.73913,22.727272,503.34973,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(21,4,5.3800006,32.567757,8.141939,14.511988,6.053486,6.2568803,82.59704,79.912025,0,0,11.152415,166.66666,638.03235,685.8538,339.03613,408.4194,304.65906,352.76312,74.105225,125.25,199,151,199,99.5,199,0,0),(22,11,29.22,166.34212,15.12201,15.122013,5.692749,5.728035,87.83103,87.28997,0,0,2.053388,22.727272,522.9876,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(23,3,5.2799997,30.38628,10.12876,14.883957,5.7549777,6.1968255,86.88131,80.68648,0,0,11.363637,199.99998,581.1936,666.29395,284.3463,331.3893,314.7297,334.90466,64.577965,148.83333,199,165,199,132.66667,199,0,0),(24,4,5.5,29.54734,7.386835,14.898204,5.372244,6.103807,93.07098,81.91609,0,0,10.909091,250,544.0327,636.7374,266.18362,318.3687,289.42615,318.3687,23.906483,122.25,199,145,199,99.5,199,0,0),(25,3,7.12,40.001637,13.3338785,15.122013,5.6182075,5.728035,88.99636,87.28997,0,0,8.426967,33.707867,506.05817,526.22925,247.69022,263.11462,262.54248,263.11462,47.81171,199,199,199,199,199,199,0,0),(26,12,17.800001,112.34527,9.362105,14.796614,6.3115315,6.5208054,79.22008,76.67764,0,0,3.3707862,125,702.8475,776.35754,372.78275,751.4363,330.06476,477.35416,68.03112,140.04167,199,164,199,116.083336,199,0,0),(27,40,52.24,319.62543,7.990636,14.265687,6.118404,6.2568803,81.72066,79.912025,0,0,1.1485451,166.66666,647.0838,685.8538,339.10223,408.4194,307.9816,469.33823,73.81668,125.25,199,151,199,99.5,199,0,0),(28,1,2.18,0.0022764606,2.2764606,2.2764606,3.7592926,3.7592926,478.81348,478.81348,0,0,27.522936,27.522936,3.1883724,3.1883724,1.5941862,1.5941862,1.5941862,1.5941862,50,53,53,53,53,53,53,0,0),(29,2,4.5600004,0.0047725975,2.3862987,2.4961367,3.7678397,3.7756686,477.72733,476.73672,0,0,26.315786,27.522936,3.2102144,3.230221,1.6051072,1.6151105,1.6051072,1.6151105,50,58.5,64,58.5,64,58.5,64,0,0),(30,1,2.18,0.0022764606,2.2764606,2.2764606,3.7592926,3.7592926,478.81348,478.81348,0,0,27.522936,27.522936,3.1883724,3.1883724,1.5941862,1.5941862,1.5941862,1.5941862,50,53,53,53,53,53,53,0,0),(31,1,2.16,0.0022551136,2.2551136,2.2551136,3.7585223,3.7585223,478.9116,478.9116,0,0,27.777777,27.777777,3.1864123,3.1864123,1.5932062,1.5932062,1.5932062,1.5932062,50,52,52,52,52,52,52,0,0),(32,2,4.54,0.00475125,2.3756251,2.4961367,3.7675114,3.7756686,477.76895,476.73672,0,0,26.431719,27.777777,3.2093782,3.230221,1.6046891,1.6151105,1.6046891,1.6151105,50,58,64,58,64,58,64,0,0),(33,8,20.04,0.020610223,2.5762777,2.707404,3.702435,3.7756686,486.16653,476.73672,0,0,23.952095,27.522936,3.0476336,3.230221,1.5238168,1.6151105,1.5238168,1.6151105,50,66.625,72,66.625,72,66.625,72,0,0),(34,26,38.65,0.1849192,7.1122766,7.471388,17.224037,17.93133,104.50511,100.38296,0,0,40.362225,53.333332,308.10916,346.00952,147.20088,164.93884,161.11673,181.0707,47.838154,70.90385,72.5,78.38461,80,63.423077,65,0,0),(35,3,4.15,0.018995674,6.3318915,7.213546,16.478174,17.31251,109.2354,103.97106,0,0,43.373493,53.333332,274.42706,311.40863,133.87782,148.44498,142.26324,162.96367,49.136074,58.666668,72.5,66,80,51.333332,65,0,0),(36,11,30.339998,0.0815715,7.4155903,8.579497,9.678885,10.28867,185.97182,174.94974,0,0,21.753462,24.691357,55.031353,65.36243,32.885715,40.27756,22.145634,27.35525,59.804775,103.045456,114.5,112.90909,121,93.181816,108,0,0),(37,13,30.099998,0.09751437,7.5011053,8.77385,11.6628475,12.1439085,154.33623,148.22246,0,0,25.913624,29.197083,95.486046,107.47958,53.335922,60.418846,42.220257,47.060734,55.834064,67.15385,73.5,69.07692,76,65.23077,71,0,0),(38,16,38.26,0.1235311,7.720694,9.364849,11.623418,12.221862,154.85977,147.27705,0,0,25.09148,29.197083,94.62681,109.5627,52.68048,60.418846,42.0232,49.183636,55.6592,68.40625,76.5,70.25,77,66.5625,76,0,0),(39,3,7.23,0.023154484,7.718161,7.904787,11.529203,11.871583,156.12526,151.62257,0,0,24.896265,26.666666,92.60212,100.40988,52.88924,57.677525,39.93381,42.732357,56.99565,67,69.5,69.333336,72,64.666664,68,0,0),(40,1,2.53,0.007904787,7.904787,7.904787,11.247918,11.360172,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(41,26,59.14,0.19179945,7.376902,9.615999,11.675313,12.45449,154.17145,144.52618,0,0,26.378086,36.809814,96.00082,115.938705,52.97797,64.50281,43.07383,54.6089,55.15671,67.34615,78.5,69.19231,79,65.5,78,0,0),(42,6,13.66,0.044354867,7.3924775,7.904787,11.689423,11.952294,153.98535,150.5987,0,0,26.354319,29.197083,96.40918,102.47181,54.709682,59.013493,41.883465,46.61982,56.649815,66.833336,69.5,68.833336,72,64.833336,68,0,0),(43,1,2.53,0.007904787,7.904787,7.904787,11.247918,11.360172,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(44,1,2.53,0.007904787,7.904787,7.904787,11.247918,11.360172,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(45,26,59.14,0.19179945,7.376902,9.615999,11.675313,12.45449,154.17145,144.52618,0,0,26.378086,36.809814,96.00082,115.938705,52.97797,64.50281,43.07383,54.6089,55.15671,67.34615,78.5,69.19231,79,65.5,78,0,0),(46,11,24.919998,0.08101836,7.365305,7.904787,11.704097,12.1439085,153.7923,148.22246,0,0,26.484755,29.197083,96.53713,107.47958,54.046364,60.418846,42.57618,47.060734,55.945957,66.63636,69.5,68.454544,72,64.818184,68,0,0),(47,18,41.62,0.13479963,7.4888687,9.364849,11.659748,12.221862,154.37726,147.27705,0,0,25.949062,36.809814,95.431854,109.5627,53.050568,60.418846,42.42206,49.183636,55.574497,67.30556,76.5,69.22222,77,65.388885,76,0,0),(48,11,24.919998,0.08101836,7.365305,7.904787,11.704097,12.1439085,153.7923,148.22246,0,0,26.484755,29.197083,96.53713,107.47958,54.046364,60.418846,42.57618,47.060734,55.945957,66.63636,69.5,68.454544,72,64.818184,68,0,0),(49,18,41.62,0.13479963,7.4888687,9.364849,11.659748,12.221862,154.37726,147.27705,0,0,25.949062,36.809814,95.431854,109.5627,53.050568,60.418846,42.42206,49.183636,55.574497,67.30556,76.5,69.22222,77,65.388885,76,0,0),(50,1,2.53,0.007904787,7.904787,7.904787,11.247918,11.360172,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(51,7,15.74,0.05140508,7.3435826,7.904787,11.757197,12.1439085,153.0977,148.22246,0,0,26.683609,29.197083,97.93189,107.47958,55.464134,60.418846,42.575962,47.060734,56.587593,66.92857,69.5,68.85714,72,65,68,0,0),(52,20,45.239998,0.14672749,7.3363748,9.364849,3.2433136,3.3949618,154.16333,147.27705,0,0,26.5252,36.809814,95.857635,109.5627,53.191936,60.418846,42.722355,49.183636,55.440258,66.825,76.5,68.7,77,64.95,76,0,0),(53,26,59.14,0.19179945,7.376902,9.615999,11.675313,12.45449,154.17145,144.52618,0,0,26.378086,36.809814,96.00082,115.938705,52.97797,64.50281,43.07383,54.6089,55.15671,67.34615,78.5,69.19231,79,65.5,78,0,0),(54,13,30.099998,0.09751437,7.5011053,8.77385,11.6628475,12.1439085,154.33623,148.22246,0,0,25.913624,29.197083,95.486046,107.47958,53.335922,60.418846,42.220257,47.060734,55.834064,67.15385,73.5,69.07692,76,65.23077,71,0,0),(55,4,9.53,0.030677075,7.6692686,7.904787,11.588402,11.871583,155.32771,151.62257,0,0,25.183632,26.666666,94.11608,100.40988,53.52793,57.677525,40.845303,43.7197,56.73481,67,69.5,69.25,72,64.75,68,0,0),(56,4,9.53,0.030677075,7.6692686,7.904787,3.2190006,3.297662,155.32771,151.62257,0,0,25.183632,26.666666,94.11608,100.40988,53.52793,57.677525,40.845303,43.7197,56.73481,67,69.5,69.25,72,64.75,68,0,0),(57,6,13.66,0.044354867,7.3924775,7.904787,3.247062,3.320082,153.98535,150.5987,0,0,26.354319,29.197083,96.40918,102.47181,54.709682,59.013493,41.883465,46.61982,56.649815,66.833336,69.5,68.833336,72,64.833336,68,0,0),(58,13,30.099998,0.09751437,7.5011053,8.77385,3.23968,3.373308,154.33623,148.22246,0,0,25.913624,29.197083,95.486046,107.47958,53.335922,60.418846,42.220257,47.060734,55.834064,67.15385,73.5,69.07692,76,65.23077,71,0,0),(59,4,9.53,0.030677075,7.6692686,7.904787,3.2190006,3.297662,155.32771,151.62257,0,0,25.183632,26.666666,94.11608,100.40988,53.52793,57.677525,40.845303,43.7197,56.73481,67,69.5,69.25,72,64.75,68,0,0),(60,1,2.53,0.007904787,7.904787,7.904787,3.1244218,3.1556034,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(61,6,13.66,0.044354867,7.3924775,7.904787,11.689423,11.952294,153.98535,150.5987,0,0,26.354319,29.197083,96.40918,102.47181,54.709682,59.013493,41.883465,46.61982,56.649815,66.833336,69.5,68.833336,72,64.833336,68,0,0),(62,3,7.23,0.023154484,7.718161,7.904787,3.2025566,3.297662,156.12526,151.62257,0,0,24.896265,26.666666,92.60212,100.40988,52.88924,57.677525,39.93381,42.732357,56.99565,67,69.5,69.333336,72,64.666664,68,0,0),(63,12,27.339998,0.08874052,7.395043,7.904787,3.245813,3.373308,154.04462,148.22246,0,0,26.335041,29.197083,96.04491,107.47958,53.73264,60.418846,42.389793,47.060734,55.909725,66.625,69.5,68.5,72,64.75,68,0,0),(64,2,5,0.015734745,7.8673725,7.904787,3.146949,3.1893923,158.88405,156.76967,0,0,24,24.439919,88.778,90.84099,50.753666,51.99631,38.642616,38.844673,56.772434,65.75,69.5,68.5,72,63,67,0,0),(65,1,2.53,0.007904787,7.904787,7.904787,3.1244218,3.1556034,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(66,7,15.74,0.05140508,7.3435826,7.904787,3.2658882,3.373308,153.0977,148.22246,0,0,26.683609,29.197083,97.93189,107.47958,55.464134,60.418846,42.575962,47.060734,56.587593,66.92857,69.5,68.85714,72,65,68,0,0),(67,26,59.14,0.19179945,7.376902,9.615999,3.2431426,3.4595807,154.17145,144.52618,0,0,26.378086,36.809814,96.00082,115.938705,52.97797,64.50281,43.07383,54.6089,55.15671,67.34615,78.5,69.19231,79,65.5,78,0,0),(68,1,1.54,0,0,0,0,0,0,0,0,0,38.96104,38.96104,0,0,0,0,0,0,0,32,32,12,12,52,52,0,0),(69,14,31.700003,0,0,0,0,0,0,0,0,0,26.498423,47.61905,0,0,0,0,0,0,0,60.142857,69.5,60.857143,68,59.42857,73,0,0);
/*!40000 ALTER TABLE `data_biorower_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dic_countries`
--

DROP TABLE IF EXISTS `dic_countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dic_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dic_countries`
--

LOCK TABLES `dic_countries` WRITE;
/*!40000 ALTER TABLE `dic_countries` DISABLE KEYS */;
INSERT INTO `dic_countries` VALUES (1,'Andorra',1),(2,'United Arab Emirates',1),(3,'Afghanistan',1),(4,'Antigua and Barbuda',1),(5,'Anguilla',1),(6,'Albania',1),(7,'Armenia',1),(8,'Angola',1),(9,'Antarctica',1),(10,'Argentina',1),(11,'American Samoa',1),(12,'Austria',1),(13,'Australia',1),(14,'Aruba',1),(15,'Ă…land',1),(16,'Azerbaijan',1),(17,'Bosnia and Herzegovina',1),(18,'Barbados',1),(19,'Bangladesh',1),(20,'Belgium',1),(21,'Burkina Faso',1),(22,'Bulgaria',1),(23,'Bahrain',1),(24,'Burundi',1),(25,'Benin',1),(26,'Saint BarthĂ©lemy',1),(27,'Bermuda',1),(28,'Brunei',1),(29,'Bolivia',1),(30,'Bonaire',1),(31,'Brazil',1),(32,'Bahamas',1),(33,'Bhutan',1),(34,'Bouvet Island',1),(35,'Botswana',1),(36,'Belarus',1),(37,'Belize',1),(38,'Canada',1),(39,'Cocos [Keeling] Islands',1),(40,'Democratic Republic of the Congo',1),(41,'Central African Republic',1),(42,'Republic of the Congo',1),(43,'Switzerland',1),(44,'Ivory Coast',1),(45,'Cook Islands',1),(46,'Chile',1),(47,'Cameroon',1),(48,'China',1),(49,'Colombia',1),(50,'Costa Rica',1),(51,'Cuba',1),(52,'Cape Verde',1),(53,'Curacao',1),(54,'Christmas Island',1),(55,'Cyprus',1),(56,'Czech Republic',1),(57,'Germany',1),(58,'Djibouti',1),(59,'Denmark',1),(60,'Dominica',1),(61,'Dominican Republic',1),(62,'Algeria',1),(63,'Ecuador',1),(64,'Estonia',1),(65,'Egypt',1),(66,'Western Sahara',1),(67,'Eritrea',1),(68,'Spain',1),(69,'Ethiopia',1),(70,'Finland',1),(71,'Fiji',1),(72,'Falkland Islands',1),(73,'Micronesia',1),(74,'Faroe Islands',1),(75,'France',1),(76,'Gabon',1),(77,'United Kingdom',1),(78,'Grenada',1),(79,'Georgia',1),(80,'French Guiana',1),(81,'Guernsey',1),(82,'Ghana',1),(83,'Gibraltar',1),(84,'Greenland',1),(85,'Gambia',1),(86,'Guinea',1),(87,'Guadeloupe',1),(88,'Equatorial Guinea',1),(89,'Greece',1),(90,'South Georgia and the South Sandwich Islands',1),(91,'Guatemala',1),(92,'Guam',1),(93,'Guinea-Bissau',1),(94,'Guyana',1),(95,'Hong Kong',1),(96,'Heard Island and McDonald Islands',1),(97,'Honduras',1),(98,'Croatia',1),(99,'Haiti',1),(100,'Hungary',1),(101,'Indonesia',1),(102,'Ireland',1),(103,'Israel',1),(104,'Isle of Man',1),(105,'India',1),(106,'British Indian Ocean Territory',1),(107,'Iraq',1),(108,'Iran',1),(109,'Iceland',1),(110,'Italy',1),(111,'Jersey',1),(112,'Jamaica',1),(113,'Jordan',1),(114,'Japan',1),(115,'Kenya',1),(116,'Kyrgyzstan',1),(117,'Cambodia',1),(118,'Kiribati',1),(119,'Comoros',1),(120,'Saint Kitts and Nevis',1),(121,'North Korea',1),(122,'South Korea',1),(123,'Kuwait',1),(124,'Cayman Islands',1),(125,'Kazakhstan',1),(126,'Laos',1),(127,'Lebanon',1),(128,'Saint Lucia',1),(129,'Liechtenstein',1),(130,'Sri Lanka',1),(131,'Liberia',1),(132,'Lesotho',1),(133,'Lithuania',1),(134,'Luxembourg',1),(135,'Latvia',1),(136,'Libya',1),(137,'Morocco',1),(138,'Monaco',1),(139,'Moldova',1),(140,'Montenegro',1),(141,'Saint Martin',1),(142,'Madagascar',1),(143,'Marshall Islands',1),(144,'Macedonia',1),(145,'Mali',1),(146,'Myanmar [Burma]',1),(147,'Mongolia',1),(148,'Macao',1),(149,'Northern Mariana Islands',1),(150,'Martinique',1),(151,'Mauritania',1),(152,'Montserrat',1),(153,'Malta',1),(154,'Mauritius',1),(155,'Maldives',1),(156,'Malawi',1),(157,'Mexico',1),(158,'Malaysia',1),(159,'Mozambique',1),(160,'Namibia',1),(161,'New Caledonia',1),(162,'Niger',1),(163,'Norfolk Island',1),(164,'Nigeria',1),(165,'Nicaragua',1),(166,'Netherlands',1),(167,'Norway',1),(168,'Nepal',1),(169,'Nauru',1),(170,'Niue',1),(171,'New Zealand',1),(172,'Oman',1),(173,'Panama',1),(174,'Peru',1),(175,'French Polynesia',1),(176,'Papua New Guinea',1),(177,'Philippines',1),(178,'Pakistan',1),(179,'Poland',1),(180,'Saint Pierre and Miquelon',1),(181,'Pitcairn Islands',1),(182,'Puerto Rico',1),(183,'Palestine',1),(184,'Portugal',1),(185,'Palau',1),(186,'Paraguay',1),(187,'Qatar',1),(188,'RĂ©union',1),(189,'Romania',1),(190,'Serbia',1),(191,'Russia',1),(192,'Rwanda',1),(193,'Saudi Arabia',1),(194,'Solomon Islands',1),(195,'Seychelles',1),(196,'Sudan',1),(197,'Sweden',1),(198,'Singapore',1),(199,'Saint Helena',1),(200,'Slovenia',1),(201,'Svalbard and Jan Mayen',1),(202,'Slovakia',1),(203,'Sierra Leone',1),(204,'San Marino',1),(205,'Senegal',1),(206,'Somalia',1),(207,'Suriname',1),(208,'South Sudan',1),(209,'SĂŁo TomĂ© and PrĂ­ncipe',1),(210,'El Salvador',1),(211,'Sint Maarten',1),(212,'Syria',1),(213,'Swaziland',1),(214,'Turks and Caicos Islands',1),(215,'Chad',1),(216,'French Southern Territories',1),(217,'Togo',1),(218,'Thailand',1),(219,'Tajikistan',1),(220,'Tokelau',1),(221,'East Timor',1),(222,'Turkmenistan',1),(223,'Tunisia',1),(224,'Tonga',1),(225,'Turkey',1),(226,'Trinidad and Tobago',1),(227,'Tuvalu',1),(228,'Taiwan',1),(229,'Tanzania',1),(230,'Ukraine',1),(231,'Uganda',1),(232,'U.S. Minor Outlying Islands',1),(233,'United States',1),(234,'Uruguay',1),(235,'Uzbekistan',1),(236,'Vatican City',1),(237,'Saint Vincent and the Grenadines',1),(238,'Venezuela',1),(239,'British Virgin Islands',1),(240,'U.S. Virgin Islands',1),(241,'Vietnam',1),(242,'Vanuatu',1),(243,'Wallis and Futuna',1),(244,'Samoa',1),(245,'Kosovo',1),(246,'Yemen',1),(247,'Mayotte',1),(248,'South Africa',1),(249,'Zambia',1),(250,'Zimbabwe',1);
/*!40000 ALTER TABLE `dic_countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dic_languages`
--

DROP TABLE IF EXISTS `dic_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dic_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `dic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dic_languages`
--

LOCK TABLES `dic_languages` WRITE;
/*!40000 ALTER TABLE `dic_languages` DISABLE KEYS */;
INSERT INTO `dic_languages` VALUES (1,'English',1),(2,'Serbian',1),(3,'Engleski',2),(4,'Srpski',2);
/*!40000 ALTER TABLE `dic_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dic_user_types`
--

DROP TABLE IF EXISTS `dic_user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dic_user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dic_user_types`
--

LOCK TABLES `dic_user_types` WRITE;
/*!40000 ALTER TABLE `dic_user_types` DISABLE KEYS */;
INSERT INTO `dic_user_types` VALUES (1,'Home User',1),(2,'Gym/Club User',1),(3,'Work User',1),(4,' Armed Forces/Uniformed Services User',1);
/*!40000 ALTER TABLE `dic_user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (71,''),(72,''),(73,''),(74,''),(75,''),(76,''),(77,''),(78,''),(80,''),(81,''),(82,''),(86,'/000/000/000/2a527ec8899eb010390666ae9f05ed94.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_user_id` int(10) unsigned NOT NULL,
  `receiver_user_id` int(10) unsigned NOT NULL,
  `text` text,
  `subject` varchar(150) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `read` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_messages_users1_idx` (`sender_user_id`),
  KEY `fk_messages_users2_idx` (`receiver_user_id`),
  CONSTRAINT `fk_messages_users1` FOREIGN KEY (`sender_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_users2` FOREIGN KEY (`receiver_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,2,4,'Userjnapisesta hoces Boja Popović send you request for race. You can accept request on the following link: http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W0&id2=6k','New request for race','2015-06-02 00:00:00',1),(2,4,4,'User aaa3  send you request for race. You can accept request on the following link: <a href=http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W0&id2=6k >Accept</a>','New request for race',NULL,1),(3,2,4,'User jnapisesta hoces (Boja Popović) send you request for race. You can accept request on the following link: <a href=\'http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W0&id2=6k\' >Accept</a>','New request for race','2015-06-03 13:14:41',1),(4,2,4,'User jnapisesta hoces (Boja Popović) send you request for race. You can accept request on the following link: <a class=\'btn btn-default\' href=\'http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W0&id2=6k\' >Accept</a>','New request for race','2015-06-03 13:29:21',1),(14,2,5,'User jnapisesta hoces (Boja Popović) send you request for race. You can accept request on the following link: <a class=\'btn btn-default\' href=\'http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W5&id2=6k\' >Accept</a>','New request for race','2015-06-05 07:25:06',1),(19,2,15,'dasdasd','asdas','2015-06-11 10:37:00',0),(20,2,15,'asdasdaasdasda','dasd','2015-06-11 12:38:23',0),(21,2,13,'User Bojansaa (Bojan Popović) send you request for follow. You can accept request on the following link: <a class=\'btn btn-default\' href=\'http://localhost:8080/!powerhub%20template/blog/public/user/accept-following?user_ln=bojanproba811112\' >Accept</a>','New follower request','2015-06-12 07:47:48',1),(24,5,2,'sdfsdfsdf','sfsdf','2015-06-16 10:18:01',1),(25,2,5,'dadsadsasd','adasdad','2015-06-01 00:00:00',0),(26,2,5,'aaaaaaaaaa','dddddddddddd','2015-06-03 00:00:00',0),(27,2,5,'dsadasdasdas','dsadasdasd','2015-06-04 00:00:00',1),(28,5,2,'gde si?','ajdem','2015-06-17 07:52:32',1),(29,5,2,'jesi tu?','dad','2015-06-17 08:02:19',1),(30,2,3,'User Bojansaa (Bojan Popović) send you request for race. You can accept request on the following link: <a class=\'btn btn-default\' href=\'http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=oa&id2=V4\' >Accept</a>','New request for race','2015-07-16 07:24:02',0),(31,2,3,'User Bojansaa (Bojan Popović) send you request for race. You can accept request on the following link: <a class=\'btn btn-default\' href=\'http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=oa&id2=6k\' >Accept</a>','New request for race','2015-08-05 10:45:38',1),(32,2,15,'asdasdad','idemo','2015-09-08 08:44:51',0);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('bojanproba81@gmail.com','b04d2d1ceb87eb338344aa0f22f1e32fc1586aa6765c15094228836c0f88dd75','2015-08-04 08:35:09');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dic_languages_id` int(11) DEFAULT NULL,
  `dic_country_id` int(11) DEFAULT NULL,
  `dic_user_type_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `privacy` tinyint(1) NOT NULL DEFAULT '3',
  `about_me` text COLLATE utf8_unicode_ci,
  `date_of_birth` datetime DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '3',
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `line1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `line2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notify_me_on_comment` tinyint(1) DEFAULT '3',
  `notify_me_on_new_session` tinyint(1) DEFAULT '3',
  `notify_me_on_new_watcher` tinyint(1) DEFAULT '3',
  `send_session_summary` tinyint(1) DEFAULT '3',
  `email_summary_alternative` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_session_summary_alternate` tinyint(1) DEFAULT '3',
  PRIMARY KEY (`id`),
  KEY `fk_users_languages_idx` (`dic_languages_id`),
  KEY `fk_users_dic_country1_idx` (`dic_country_id`),
  KEY `fk_users_dic_user_type1_idx` (`dic_user_type_id`),
  KEY `fk_profiles_image1_idx` (`image_id`),
  CONSTRAINT `fk_users_dic_country1` FOREIGN KEY (`dic_country_id`) REFERENCES `dic_countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_dic_user_type1` FOREIGN KEY (`dic_user_type_id`) REFERENCES `dic_user_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_languages` FOREIGN KEY (`dic_languages_id`) REFERENCES `dic_languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,1,1,3,NULL,1,'sdf sdf sdf sdf','0000-00-00 00:00:00',0,'123123','121','1233','','','','',1,3,1,3,'er@gg.com',3),(3,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(4,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(5,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(6,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(15,NULL,NULL,NULL,86,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(18,NULL,NULL,NULL,NULL,1,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(19,NULL,NULL,NULL,NULL,1,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(20,NULL,NULL,NULL,NULL,1,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(25,NULL,NULL,NULL,NULL,1,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(26,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(29,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(33,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(34,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(35,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(36,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(37,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(38,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(39,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(40,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(41,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(42,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(43,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(44,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(45,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(46,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(47,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(48,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(49,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(50,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(51,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(52,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(53,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(54,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3),(55,NULL,NULL,NULL,NULL,3,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3,3,3,3,NULL,3);
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `races`
--

DROP TABLE IF EXISTS `races`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `races` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `races`
--

LOCK TABLES `races` WRITE;
/*!40000 ALTER TABLE `races` DISABLE KEYS */;
INSERT INTO `races` VALUES (6,'aaaadasda','2015-08-12 13:53:31'),(7,'dasda','2015-09-09 09:13:16'),(8,'idemo bre','2015-09-09 00:00:00'),(9,'sfsdfsdf','2015-09-18 13:36:51');
/*!40000 ALTER TABLE `races` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `data` text,
  `dataVersion` int(11) DEFAULT NULL,
  `deviceType` varchar(100) DEFAULT NULL,
  `serialNumber` varchar(50) DEFAULT NULL,
  `firmwareVersion` int(11) DEFAULT NULL,
  `mobileUserAgent` varchar(100) DEFAULT NULL,
  `sampleRate` int(11) DEFAULT NULL,
  `fftRange` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `utc` bigint(20) DEFAULT NULL,
  `website_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `data_biorower_sessions_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_session_users1_idx` (`user_id`),
  KEY `fk_sessions_websites1_idx` (`website_id`),
  KEY `fk_sessions_data_biorower_sessions1_idx` (`data_biorower_sessions_id`),
  CONSTRAINT `fk_sessions_data_biorower_sessions1` FOREIGN KEY (`data_biorower_sessions_id`) REFERENCES `data_biorower_sessions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sessions_websites1` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_session_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `throttle`
--

DROP TABLE IF EXISTS `throttle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(4) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `throttle`
--

LOCK TABLES `throttle` WRITE;
/*!40000 ALTER TABLE `throttle` DISABLE KEYS */;
/*!40000 ALTER TABLE `throttle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_sessions` (
  `id` varchar(100) NOT NULL,
  `payload` text,
  `last_activity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_sessions`
--

LOCK TABLES `user_sessions` WRITE;
/*!40000 ALTER TABLE `user_sessions` DISABLE KEYS */;
INSERT INTO `user_sessions` VALUES ('18c4d91e77e26060148d2ef161584eb0eea05cd9','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZm50UDNNOXMyQkhWTFVicTJybGw1ZHh1N1ZIeXJ0M3c2cUR0U3dYbSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODU4OTU7czoxOiJjIjtpOjE0NjY2ODU4OTU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466685895),('198b1424379bca35d6c5653f7d922620a13c8a5f','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHRURUFhV0lSa2g1VVRRS2djVjlCeldJMEFpdVdxWDdmVDJRT3RSSyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODY0ODM7czoxOiJjIjtpOjE0NjY2ODY0ODM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466686483),('2c8edf21253784d9a73e613670620a58c61e990c','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTnFxSEIwMkIzWHF4OFNKbFdmSmVzWWpJWEFhcEcwejB1cnpXTEFNNSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODY1MjE7czoxOiJjIjtpOjE0NjY2ODY1MjE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466686521),('2d1dca4cc89ba64213a350642e28d92ffc11f577','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWJ2MEdhdnF2Y1N4UURuYmZrVUdIS3hmOTRManhNaE00WnBtT0V6eSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODk3NzQ7czoxOiJjIjtpOjE0NjY2ODk3NzQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466689774),('3690af6ece703a9f384d6e1ffc512031fdfe0d48','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVAxbGlvQ2djQmEwQ3A0YW05MmdYWjkxYjJGSFE3bThjT1B0TGZVOSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODY0NDU7czoxOiJjIjtpOjE0NjY2ODY0NDU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466686445),('4bb624d9001bbefb4833f75d746f79f532d1f52d','YTozOntzOjY6Il90b2tlbiI7czo0MDoicEZBMmNIeUp1SGtDSnVMRHN1aG5TeldWUGp0aUxZTlZIV1VrZlo0ZSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODY1NjA7czoxOiJjIjtpOjE0NjY2ODY1NjA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466686560),('4dbe76c10ad12c0ef8fae35861d7255253fd88d8','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlVvTklyMFc0Y3RTSmlrc293WWR6cXVyUHVGOWxCd3hDSmhxanVwVyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODI4Mjc7czoxOiJjIjtpOjE0NjY2ODI4Mjc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466682827),('4f2a2e7c1ac13adbcac75953a1515a519fe4049a','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2JESVJSZDZKNUFrNHljcURoZUxYQ1RveTNHRW50WEluRFptVGd0ayI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODI4Mjc7czoxOiJjIjtpOjE0NjY2ODI4Mjc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466682827),('55e6e49f721920cb8251923f964a3269a3dc0efc','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNG92YXlCQ2dLQUh6Q2t0bXB2M1lTa1EwYUpxbnF1TUMzM014aE1UTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODQwOTM7czoxOiJjIjtpOjE0NjY2ODQwOTM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466684093),('5de2f1ae685c15ac2533e4e641495e8aeb35f19e','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVYwZDR5cGVGd1BJTDF0N0VMb0l0WjFnMXZuY21vekJQMnBBMGNDaCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODYyOTI7czoxOiJjIjtpOjE0NjY2ODYyOTI7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466686292),('7f8826d5049e10b128da30a8231ade2786d9d613','YTozOntzOjY6Il90b2tlbiI7czo0MDoid2xZRllOa1lRZmljTVZXUWl2ZU9LNGRjVmZvZFFBQ1VGZEI1Q1B2SyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODI0MjI7czoxOiJjIjtpOjE0NjY2ODI0MjI7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466682422),('840f5758326daf0fd751ce0d077d7b1734e46875','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVVMRHpGS3BHcHdJSDI4V3lxUWEyRTZiQzJmb0ZXZ1RMZ1Z1N2EzdCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODU2Mzk7czoxOiJjIjtpOjE0NjY2ODU2Mzk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466685639),('8f814d82fd7d64181ed5da4b743199403002b381','YTozOntzOjY6Il90b2tlbiI7czo0MDoieUlOSlo5SHdBdnM2RkVFcGhwcTlzNnZEV3VXVG9NVWxlVHpGcjZneCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODY5NDc7czoxOiJjIjtpOjE0NjY2ODY5NDc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466686947),('9c857ae094bda14c833d471b20583633190b4efc','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZ0hSVXB5akFFd0J2eTVzb1d4bU51d2p5UXdoQVdOZWg5ZmVqbkxHdyI7czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjI4OiJodHRwOi8vNDYuMTAxLjE4OS44NS9wcm9maWxlIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1L3Byb2ZpbGUiO31zOjM4OiJsb2dpbl84MmU1ZDJjNTZiZGQwODExMzE4ZjBjZjA3OGI3OGJmYyI7czoyOiIzNiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODkzNTM7czoxOiJjIjtpOjE0NjY2ODcxNTM7czoxOiJsIjtzOjE6IjAiO319',1466689353),('a1a7554886bd1917f8e24ff2086af22e68992b39','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzdCV0cyT2QycG51T0RidGVZQnZrVm45c0RBMmRxenU1Wk1qSHd3eiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODIxOTE7czoxOiJjIjtpOjE0NjY2ODIxOTE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466682191),('c2d340870a794be9a8315b221edca05fe170ea4c','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlF1UGMyNTl2dWplM1BreEl6VlRQeFl4ZG54MjRkNEVNTDFTaFA4dyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODY2NDU7czoxOiJjIjtpOjE0NjY2ODY2NDU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466686645),('c4469cc06930a0a027ab287940ca4505c7c1f99a','YTozOntzOjY6Il90b2tlbiI7czo0MDoiczRic0U4TkF4dkE3NTlvWUl0VDhMbmplanNUTGdJMEd5RzBFbGxMcSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODMxNDQ7czoxOiJjIjtpOjE0NjY2ODMxNDQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466683144),('c871390086c3e3e2a96b0b77fa2645c749220f27','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0lPa1h5YVhSVGlJUGdmc0lmOGh4Z3o5T2NFd3NuMTBUSmFEM2h5eSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODIyOTY7czoxOiJjIjtpOjE0NjY2ODIyOTY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466682296),('ca51eeaeee14545936821b0d400eebf5406af4c5','YTozOntzOjY6Il90b2tlbiI7czo0MDoiclJmOHFaamdEYVhudjNqbm5ETU9TNG41SzVHMzJYMFNUNUZLQlJHZSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODcxMDM7czoxOiJjIjtpOjE0NjY2ODcxMDM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466687103),('d821527fe1d2327d605491a3dbb1dc1b29d77c5c','YTozOntzOjY6Il90b2tlbiI7czo0MDoicnJOMEcwWnFObDE0d1hvTXNrcUNpSjBjNTlBTHFNaEZobmZXMVlHYiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODI4Mjg7czoxOiJjIjtpOjE0NjY2ODI4Mjg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466682828),('f0d1e35b909f7f78faffcad234864c4db7c91efa','YTozOntzOjY6Il90b2tlbiI7czo0MDoibnJnbW9KUkkyYWk5R3ZrcDVnRXE3aFhQZmNWM0phR2hJOTJDMUR2aiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODI4MjQ7czoxOiJjIjtpOjE0NjY2ODI4MjQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466682824),('f3505cf04e15ab2223603c9c1cc3efd8d81f566d','YTozOntzOjY6Il90b2tlbiI7czo0MDoidUY1em9nQ3lzWlFWMFpHMnNyM3Z5T3ExcUlaYnBpVHo0Q3ZmekJ0cyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODU3MDE7czoxOiJjIjtpOjE0NjY2ODU3MDE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466685701),('f685c534a8d86778cb4625f1dd49267af421014b','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN0o2TmZRWENYVUJtSVlzWDRZOGc2T01oQk5DMWxibm5rR2FxWEEwciI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODYyMDk7czoxOiJjIjtpOjE0NjY2ODYyMDk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466686209),('f9f7735af53a242795f59b9d55bda490503193ef','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSkdIS2dWZDZTT3U1T1NZSjd0dldRV3RLR3U3ek5uazFHekxHd1hidCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY2ODI4Mjg7czoxOiJjIjtpOjE0NjY2ODI4Mjg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466682828);
/*!40000 ALTER TABLE `user_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting1` int(11) DEFAULT NULL,
  `setting2` int(11) DEFAULT NULL,
  `setting3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_settings`
--

LOCK TABLES `user_settings` WRITE;
/*!40000 ALTER TABLE `user_settings` DISABLE KEYS */;
INSERT INTO `user_settings` VALUES (1,1,1,1),(2,2,2,2);
/*!40000 ALTER TABLE `user_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `linkname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_settings_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `linkname_UNIQUE` (`linkname`),
  UNIQUE KEY `twitter_id_UNIQUE` (`twitter_id`),
  UNIQUE KEY `facebook_id_UNIQUE` (`facebook_id`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`),
  KEY `fk_users_profiles_idx` (`profile_id`),
  KEY `fk_users_user_settings1_idx` (`user_settings_id`),
  CONSTRAINT `fk_users_profiles` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_user_settings1` FOREIGN KEY (`user_settings_id`) REFERENCES `user_settings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,1,'bojanproba81@gmail.com','$2y$10$Tay/ppyVxEhibD13oOQ9eO5jBT7Th91Z9JbsiiCMHDCaKfkWuwGcG',NULL,0,NULL,NULL,NULL,NULL,NULL,'Bojan','Popović','2015-03-31 22:00:00','2015-09-28 11:58:18','Z0n5eI9uf3qy1XYBJhmowRNJk0ssRwdxSJlDn9Q9LPNK6rzqV1YQIfMtLGHA',NULL,NULL,'Bojansaa','sdfsdfsdf',NULL,2),(3,3,'idemo@email.com','$2y$10$aiuU6uZt5P3jpk61rOY3Red.7WefuoQacCP9E0VrLBMT6WFvpBE4O',NULL,0,NULL,NULL,NULL,NULL,NULL,'Pera','Petrović','2015-04-27 09:50:37','2015-04-27 09:52:41','bhlLiONrNx3AQzgrA53lfLSYZZDMqdkK5HsS5RNyv0ioNG37wwBLlfuAHobH',NULL,NULL,'aaa2','aa2',NULL,1),(4,4,'bojanpopovic81@gmail.com','$2y$10$fdjTyMsZq4vkC.sAE/7APuBdwcm8biszMonLiNXgTHdEryyO4qvDG',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-04-27 09:52:59','2015-06-09 04:09:26','LYLxNuDKvWSHQiSvVqs4I2bfsbItTYVO6pOe1cQ2FCNJVpXMJmk1pkHmXbdH',NULL,NULL,'aaa3','aaa2',NULL,1),(5,5,'idemo2@email.com','$2y$10$U7M8LxoMjKi/vZ6uhpeGX.Wysz4ZhpkNJY4cSeNfSDHuN5MjTrDYG',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-04-27 09:54:51','2015-06-19 10:19:34','dAwmER1SeiV3dwi7dfkSFyyXvIRv9Zjy1PsPLPvwvB5ASG8Qyu5xpjBatCOv','8c4adf2b8b991af9e30aa28d2b4c38f3',NULL,'aaa5','aadsa',NULL,1),(6,6,'ajde@yuyu.com','$2y$10$qvxo/3DJ2tMgnVvqHiScL.Pf1JLtX9KQMPzwkxQJ4gjfKaAwdgj9O',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-04-27 10:28:06','2015-04-27 10:28:06',NULL,'cd4dd49e43b8b221acea7b6d7bd8b698',NULL,'aaa6','fsdff',NULL,1),(9,15,'retro981@yahoo.com','$2y$10$lc/z9MQ1zZlEHb0ICbO4xO3ojY3MCHHVsjF6.DrWPu0zXysTTBPPK',NULL,0,NULL,NULL,NULL,NULL,NULL,'Zdravko','Petrović','2015-04-30 08:37:05','2015-08-05 09:11:57','PwDSKskw0nzQ9fCmmKIcafXdQoi9PlSWla2oj1zYTkh1c9FuGf44CDXZiHo0',NULL,NULL,'aaa7','gsss',NULL,1),(11,18,'bojanproba8111@gmail.com','$2y$10$HvRAZh63KINZlmkV7rDEzuuphe4nS9E0exbtoY1uBeQWO1nyBpYAm',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-15 11:53:51','2015-05-15 11:56:45','XcRaCfDgXIiKsGM7Id9n0BJetAQFieqSCC8xpZ1TxZxIGve2VFQR4pbEe4cK',NULL,NULL,'','bojanproba8111',NULL,1),(12,19,'bojanproba8111@ajde.com','$2y$10$oiyQeS8MCrPHeraCdmoRKufIP5TTy5UhGeJkhxdDRLDhiSdBc18cO',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-15 11:57:37','2015-05-15 12:01:47','46WNvRxzW49AyInhTnW0dTeqIdx27Qn9PABkiUnbRHl1l97nP1xD4Y3UlEJU',NULL,NULL,'bojanproba8111','bojanproba81111',NULL,1),(13,20,'bojanproba8111@nekidrugi.com','$2y$10$lc/z9MQ1zZlEHb0ICbO4xO3ojY3MCHHVsjF6.DrWPu0zXysTTBPPK',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-15 12:16:20','2015-07-22 07:50:56','LN43H9ogTDMtU9Lfos5lJe0b0zT6Wm9trZSySh1F8Vcv5XyZTQRrgXNEeOkL',NULL,NULL,'bojanproba8111','bojanproba811112',NULL,1),(14,25,'bojanproba81@gaamail.com','$2y$10$FRnUw.l4vfc33Wt7xtkuqeW83tW/D0jPfZYJx5ziN3Ly3SZlmkFEm',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-19 04:36:29','2015-05-27 11:32:12','iDSM6NkgIvsoFTWEyZPapYMCsDILt5dbdqRptkLzV4J5ZcHiJ63Qd59Q3nLB',NULL,NULL,'bojanproba81','bojanproba81',NULL,1),(15,26,'bojanproba81@gaam23ail.com','$2y$10$wG7IBD8dOIkr.RQeuZmg.OgwlEnUgNOI43aAiq0cPxo47Cnvx5Hp.',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-19 04:41:33','2015-05-19 11:36:12','ikKVrciP4tIQR0gxeQWdShqtNKQjng2DtXcWGF0FQMPOX8vlZZPL044CECmY',NULL,NULL,'bojanproba81','bojanproba811',NULL,1),(23,34,'blabla@idemo.com','$2y$10$L4l8SEw.jmMnY9rfgrDEguLwlA0C89.zThrhK7/fyXO4CivO45zZm',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-08-03 05:28:52','2015-08-03 05:28:52',NULL,'8514dccbdfee3c84165ec611e35290c4','123314234','blabla','blabla',NULL,1),(24,35,'gaboroki2@gmail.com','$2a$06$dkzuAX6/omTwr9J0RSJn2.JF10wdaJ5S73000EDlFfAibAelZVow.',NULL,1,NULL,NULL,NULL,NULL,'j7Z8eFqXfkXGCPrNxkXmwFvsB5WLdK442gRHX0bGHfOKWSZ9ImEriLi3e9tY',NULL,NULL,'2015-11-25 12:44:41','2016-06-21 18:26:25','eR4FAmdzqAjwSOMogiWBVOCixRPRcbSyjqOBqVtD6xO66jZw2DfyuSQK2TyN','5add4731b6a3e8c7082d1a7ed745d3da',NULL,'gaboroki2','gaboroki2',NULL,NULL),(34,45,'milosh.diklich@gmail.com','$2y$10$yQLkqgndikz6sxSg5h75jOuYHclXaNZxK/7x8XZbnO4X.OVtq/N.S',NULL,1,NULL,NULL,NULL,NULL,'t92pOWg7dI34eupIL50xu4WzEnxntzuYf88PrEaG7Kx4yJzLZZe8ZxKY8w5W','Milos','Diklic','2016-05-22 18:56:43','2016-06-06 11:29:17','t92pOWg7dI34eupIL50xu4WzEnxntzuYf88PrEaG7Kx4yJzLZZe8ZxKY8w5W','b5ca10fb1c6fa2a0245207d3a324bdaa',NULL,'milosh.diklich','milosh.diklich',NULL,NULL),(35,46,'dusana05@gmail.com','$2y$10$haAIYptEP8o5g.Q7EAFuUOG1scJrPmuHM.4Mb6X.flKOWfqBRYQhi',NULL,1,NULL,NULL,NULL,NULL,'mIZKaUY6rvGzRmk7GHL1yllikjWN7nZvsb30FwTtLsbf0uLJFK6BsOYNVx2t','Dusan','Adamovic','2016-05-24 10:23:39','2016-06-05 22:06:03','mIZKaUY6rvGzRmk7GHL1yllikjWN7nZvsb30FwTtLsbf0uLJFK6BsOYNVx2t',NULL,NULL,'dusana05','dusana05',NULL,NULL),(36,47,'bojan@piktogramstudio.com','$2y$10$u6Cuq1Q2.XBaTsJ3DIoHgep1v/AHP4MU3JjErNGc5gZ81Lpq23kU6',NULL,1,NULL,NULL,NULL,NULL,'f25rdmnaajky3iddcsk41maz6npbd9p5zunb6u9s97sx6fh7gpmhm01feylilsp5xqqotxnixkomcw1wtzorz6xf9ovd7k8shidl','Bojan','Mitrovic','2016-05-24 21:49:55','2016-06-23 11:13:12','dG6YXd54xg7zcm9heyq7JdGFQ6fgy9bPMAVS8t3frwGKAKwtpFXcSGz9X9Zf','ba7ea5ad420066c02dccc2b84e7bab89',NULL,'bojan','bojan',NULL,NULL),(40,51,'dusana02@gmail.com','$2y$10$PAZD7TTB0XyNrsR0D23ffOHRkSiaWACESphf/Hw6Y2NRhL4yUXO4C',NULL,0,NULL,NULL,NULL,NULL,'f25rdmnaajky3iddcsk41maz6npbd9p5zunb6u9s97sx6fh7gpmhm01feylilsp5xqqotxnixkomcw1wtzorz6xf9ovd7k8shidl',NULL,NULL,'2016-06-09 13:47:33','2016-06-09 13:47:33',NULL,'8d6232df986c0c97062c91d09efe3763',NULL,'dusana02','dusana02',NULL,NULL),(42,53,'sholeem@gmail.com','$2y$10$/k1iI2kXlWuRwh8BRXLCC.qBDT13RKlF5wzLSS.DawNc5GcSCIhna',NULL,1,NULL,NULL,NULL,NULL,'4vtami06qd4r6ldetw96hdzuym6wcwy8x1qtn5lc6nguzz935k54lqpzzbt7lkaadknwn5w8tgdbcbxjwg2auappfoyvuxmhyttd','Some','One','2016-06-09 15:57:43','2016-06-09 15:59:23','1rU49yLBT2z6g66Kj9w0WTXTBh5UYxZxMnKegFhFTXZAMh8riicdEd5adKgZ',NULL,NULL,'sholeem','sholeem',NULL,NULL),(43,54,'bojan_neskovic@yahoo.com','$2y$10$2c/W0qYA7u/fLbUbOcwFcedcGu9r0TfTG6AIPDPyEBmSe6QP7xlRy',NULL,1,NULL,NULL,NULL,NULL,'reynyf1q3o7oefhu2txqthvosw12q5fq6tb0h26fav1rya997n035cilt1ftpq252ih4o6y4x0bssqmt3p21l7v0antatjkk8blm','Bojan','Neskovic','2016-06-09 21:58:38','2016-06-16 14:45:05','dOl6oXAJfuJC83u5TtsCZaITlpBP2T36sTj8m7fW22riNxLBGzLPWibWEhtx','94913bec599ad3b6c5285e6949528f48',NULL,'bojan_neskovic','bojan_neskovic',NULL,NULL),(44,55,'prognanici@gmail.com','$2y$10$PzQvyfGea2G3n9kOpiHxhuZDoNuXGQYiFvBILlpllHX.Uj/WgOr2m',NULL,1,NULL,NULL,NULL,NULL,'sfpc7yneuxmdsxvh9o8f9mufauakit910j7jz27n9474agskvgoud88tko8zql3ft4xjtfwceqz7ylfframvuxf8cj5oadwljswr','Aleksandar','Ustic','2016-06-16 12:40:46','2016-06-20 19:12:57','Q24g4FOshF7kis1LP9xIobdpsFiP18gJiP2t8msTViJTHz5f0cyNpPKMIXDz',NULL,NULL,'prognanici','prognanici',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_races`
--

DROP TABLE IF EXISTS `users_races`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_races` (
  `race_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `accepted` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `sessions_id` int(11) DEFAULT NULL,
  UNIQUE KEY `user_race_unique` (`race_id`,`user_id`),
  KEY `fk_users_race_rooms_races1_idx` (`race_id`),
  KEY `fk_users_race_rooms_users1_idx` (`user_id`),
  KEY `fk_users_races_sessions1_idx` (`sessions_id`),
  CONSTRAINT `fk_users_races_sessions1` FOREIGN KEY (`sessions_id`) REFERENCES `sessions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_race_rooms_races1` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_race_rooms_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_races`
--

LOCK TABLES `users_races` WRITE;
/*!40000 ALTER TABLE `users_races` DISABLE KEYS */;
INSERT INTO `users_races` VALUES (6,2,1,NULL,0,NULL),(6,3,0,NULL,0,NULL),(6,14,1,NULL,0,NULL),(7,2,1,NULL,0,NULL),(7,4,0,NULL,0,NULL),(9,2,1,NULL,0,NULL),(9,3,0,NULL,0,NULL),(9,4,0,NULL,0,NULL);
/*!40000 ALTER TABLE `users_races` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `watching`
--

DROP TABLE IF EXISTS `watching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `watching` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(10) unsigned NOT NULL,
  `user2_id` int(10) unsigned NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `website_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user1_user2_website` (`user1_id`,`user2_id`,`website_id`),
  KEY `fk_watching_users1_idx` (`user1_id`),
  KEY `fk_watching_users2_idx` (`user2_id`),
  KEY `fk_watching_websites1_idx` (`website_id`),
  CONSTRAINT `fk_watching_users1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_watching_users2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_watching_websites1` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `watching`
--

LOCK TABLES `watching` WRITE;
/*!40000 ALTER TABLE `watching` DISABLE KEYS */;
INSERT INTO `watching` VALUES (18,2,9,1,1),(21,15,2,1,1),(25,2,6,0,1),(35,2,4,1,1),(39,2,13,0,1),(41,2,5,1,1);
/*!40000 ALTER TABLE `watching` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `websites`
--

DROP TABLE IF EXISTS `websites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `websites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websites`
--

LOCK TABLES `websites` WRITE;
/*!40000 ALTER TABLE `websites` DISABLE KEYS */;
INSERT INTO `websites` VALUES (1,'biorower'),(2,'beeger');
/*!40000 ALTER TABLE `websites` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-23  9:54:03