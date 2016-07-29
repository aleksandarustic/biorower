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
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_biorower_sessions`
--

LOCK TABLES `data_biorower_sessions` WRITE;
/*!40000 ALTER TABLE `data_biorower_sessions` DISABLE KEYS */;
INSERT INTO `data_biorower_sessions` VALUES (1,56,15,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37),(2,56,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,88,11,21,36,37),(3,56,49,12,16,14,15,16,14.3,18,19,20,21,22,67,24,100,16,27,28,29,30,31,32,33,34,35,36,37),(4,56,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37),(5,56,15,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37),(6,9,13.200001,84.10025,9.344472,14.767447,6.3712306,6.9157324,78.477776,72.29892,0,0,4.5454545,99.99999,756.30945,926.13135,415.80817,926.13135,356.71567,440.64877,67.12956,138.77777,199,167,199,110.55556,199,0,0),(7,8,11.740001,74.05459,9.256824,13.183761,6.307886,7.454807,79.265854,67.070816,0,0,5.110732,99.99999,750.09094,1160.0247,453.98154,926.13135,341.73962,440.64877,68.327065,143.6875,199,163,199,124.375,199,0,0),(8,30,40.140007,257.82678,8.594226,14.778832,6.4231873,6.7217937,77.84297,74.38491,0,0,1.494768,111.11111,752.06433,850.3811,425.74155,850.3811,330.77267,415.82855,71.705956,129.75,199,160,199,99.5,199,0,0),(9,12,16.619999,110.09755,9.174796,14.777009,6.6244016,7.286615,75.478516,68.618965,0,0,3.6101086,76.92308,853.0644,1083.267,497.13803,1083.267,373.45306,530.0624,66.7779,135.75,199,172,199,99.5,199,0,0),(10,7,10.059999,64.92781,9.275401,13.623918,6.454057,6.7217937,77.47065,74.38491,0,0,5.964215,111.11111,756.2715,850.3811,409.0588,850.3811,348.5988,415.82855,67.89666,139.64285,199,165.57143,199,113.71429,199,0,0),(11,8,20.2,114.402664,14.300333,15.122013,5.663498,5.728035,88.28466,87.28997,0,0,2.9702969,35.502956,511.79755,526.22925,254.7848,263.11462,257.7695,263.11462,49.339672,199,199,199,199,199,199,0,0),(12,4,7.660001,44.67555,11.168887,15.122013,5.8323164,6.12907,85.72923,81.578445,0,0,7.832897,199.99998,566.1708,644.6763,272.5931,320.93433,293.57767,334.90466,60.94498,161.375,199,173.5,199,149.25,199,0,0),(13,4,7.660001,44.67555,11.168887,15.122013,5.8323164,6.12907,85.72923,81.578445,0,0,7.832897,199.99998,566.1708,644.6763,272.5931,320.93433,293.57767,334.90466,60.94498,161.375,199,173.5,199,149.25,199,0,0),(14,11,29.16,166.34212,15.12201,15.122013,5.704462,5.728035,87.65068,87.28997,0,0,2.0576131,22.727272,524.0637,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(15,2,5.34,30.244026,15.122013,15.122013,5.6636753,5.728035,88.2819,87.28997,0,0,11.235954,22.727272,520.3165,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(16,2,5.46,30.244026,15.122013,15.122013,5.539199,5.728035,90.26576,87.28997,0,0,10.989011,22.727272,508.88104,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(17,2,4.48,25.631954,12.815977,15.122013,5.7214184,5.728035,87.390915,87.28997,0,0,13.392858,32.608696,524.4107,526.22925,262.20535,263.11462,262.20535,263.11462,50,199,199,199,199,199,199,0,0),(18,3,7.3600006,42.464314,14.154771,15.122013,5.7696075,6.049647,86.66101,82.64945,0,0,8.152173,29.70297,547.837,619.93774,272.83035,299.00342,279.45496,320.93433,49.4104,199,199,199,199,199,199,0,0),(19,2,5.34,30.244026,15.122013,15.122013,5.6636753,5.728035,88.2819,87.28997,0,0,11.235954,22.727272,520.3165,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(20,1,2.76,15.122013,15.122013,15.122013,5.47899,5.728035,91.25769,87.28997,0,0,21.73913,22.727272,503.34973,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(21,4,5.3800006,32.567757,8.141939,14.511988,6.053486,6.2568803,82.59704,79.912025,0,0,11.152415,166.66666,638.03235,685.8538,339.03613,408.4194,304.65906,352.76312,74.105225,125.25,199,151,199,99.5,199,0,0),(22,11,29.22,166.34212,15.12201,15.122013,5.692749,5.728035,87.83103,87.28997,0,0,2.053388,22.727272,522.9876,526.22925,263.11462,263.11462,263.11462,263.11462,50,199,199,199,199,199,199,0,0),(23,3,5.2799997,30.38628,10.12876,14.883957,5.7549777,6.1968255,86.88131,80.68648,0,0,11.363637,199.99998,581.1936,666.29395,284.3463,331.3893,314.7297,334.90466,64.577965,148.83333,199,165,199,132.66667,199,0,0),(24,4,5.5,29.54734,7.386835,14.898204,5.372244,6.103807,93.07098,81.91609,0,0,10.909091,250,544.0327,636.7374,266.18362,318.3687,289.42615,318.3687,23.906483,122.25,199,145,199,99.5,199,0,0),(25,3,7.12,40.001637,13.3338785,15.122013,5.6182075,5.728035,88.99636,87.28997,0,0,8.426967,33.707867,506.05817,526.22925,247.69022,263.11462,262.54248,263.11462,47.81171,199,199,199,199,199,199,0,0),(26,12,17.800001,112.34527,9.362105,14.796614,6.3115315,6.5208054,79.22008,76.67764,0,0,3.3707862,125,702.8475,776.35754,372.78275,751.4363,330.06476,477.35416,68.03112,140.04167,199,164,199,116.083336,199,0,0),(27,40,52.24,319.62543,7.990636,14.265687,6.118404,6.2568803,81.72066,79.912025,0,0,1.1485451,166.66666,647.0838,685.8538,339.10223,408.4194,307.9816,469.33823,73.81668,125.25,199,151,199,99.5,199,0,0),(28,1,2.18,0.0022764606,2.2764606,2.2764606,3.7592926,3.7592926,478.81348,478.81348,0,0,27.522936,27.522936,3.1883724,3.1883724,1.5941862,1.5941862,1.5941862,1.5941862,50,53,53,53,53,53,53,0,0),(29,2,4.5600004,0.0047725975,2.3862987,2.4961367,3.7678397,3.7756686,477.72733,476.73672,0,0,26.315786,27.522936,3.2102144,3.230221,1.6051072,1.6151105,1.6051072,1.6151105,50,58.5,64,58.5,64,58.5,64,0,0),(30,1,2.18,0.0022764606,2.2764606,2.2764606,3.7592926,3.7592926,478.81348,478.81348,0,0,27.522936,27.522936,3.1883724,3.1883724,1.5941862,1.5941862,1.5941862,1.5941862,50,53,53,53,53,53,53,0,0),(31,1,2.16,0.0022551136,2.2551136,2.2551136,3.7585223,3.7585223,478.9116,478.9116,0,0,27.777777,27.777777,3.1864123,3.1864123,1.5932062,1.5932062,1.5932062,1.5932062,50,52,52,52,52,52,52,0,0),(32,2,4.54,0.00475125,2.3756251,2.4961367,3.7675114,3.7756686,477.76895,476.73672,0,0,26.431719,27.777777,3.2093782,3.230221,1.6046891,1.6151105,1.6046891,1.6151105,50,58,64,58,64,58,64,0,0),(33,8,20.04,0.020610223,2.5762777,2.707404,3.702435,3.7756686,486.16653,476.73672,0,0,23.952095,27.522936,3.0476336,3.230221,1.5238168,1.6151105,1.5238168,1.6151105,50,66.625,72,66.625,72,66.625,72,0,0),(34,26,38.65,0.1849192,7.1122766,7.471388,17.224037,17.93133,104.50511,100.38296,0,0,40.362225,53.333332,308.10916,346.00952,147.20088,164.93884,161.11673,181.0707,47.838154,70.90385,72.5,78.38461,80,63.423077,65,0,0),(35,3,4.15,0.018995674,6.3318915,7.213546,16.478174,17.31251,109.2354,103.97106,0,0,43.373493,53.333332,274.42706,311.40863,133.87782,148.44498,142.26324,162.96367,49.136074,58.666668,72.5,66,80,51.333332,65,0,0),(36,11,30.339998,0.0815715,7.4155903,8.579497,9.678885,10.28867,185.97182,174.94974,0,0,21.753462,24.691357,55.031353,65.36243,32.885715,40.27756,22.145634,27.35525,59.804775,103.045456,114.5,112.90909,121,93.181816,108,0,0),(37,13,30.099998,0.09751437,7.5011053,8.77385,11.6628475,12.1439085,154.33623,148.22246,0,0,25.913624,29.197083,95.486046,107.47958,53.335922,60.418846,42.220257,47.060734,55.834064,67.15385,73.5,69.07692,76,65.23077,71,0,0),(38,16,38.26,0.1235311,7.720694,9.364849,11.623418,12.221862,154.85977,147.27705,0,0,25.09148,29.197083,94.62681,109.5627,52.68048,60.418846,42.0232,49.183636,55.6592,68.40625,76.5,70.25,77,66.5625,76,0,0),(39,3,7.23,0.023154484,7.718161,7.904787,11.529203,11.871583,156.12526,151.62257,0,0,24.896265,26.666666,92.60212,100.40988,52.88924,57.677525,39.93381,42.732357,56.99565,67,69.5,69.333336,72,64.666664,68,0,0),(40,1,2.53,0.007904787,7.904787,7.904787,11.247918,11.360172,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(41,26,59.14,0.19179945,7.376902,9.615999,11.675313,12.45449,154.17145,144.52618,0,0,26.378086,36.809814,96.00082,115.938705,52.97797,64.50281,43.07383,54.6089,55.15671,67.34615,78.5,69.19231,79,65.5,78,0,0),(42,6,13.66,0.044354867,7.3924775,7.904787,11.689423,11.952294,153.98535,150.5987,0,0,26.354319,29.197083,96.40918,102.47181,54.709682,59.013493,41.883465,46.61982,56.649815,66.833336,69.5,68.833336,72,64.833336,68,0,0),(43,1,2.53,0.007904787,7.904787,7.904787,11.247918,11.360172,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(44,1,2.53,0.007904787,7.904787,7.904787,11.247918,11.360172,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(45,26,59.14,0.19179945,7.376902,9.615999,11.675313,12.45449,154.17145,144.52618,0,0,26.378086,36.809814,96.00082,115.938705,52.97797,64.50281,43.07383,54.6089,55.15671,67.34615,78.5,69.19231,79,65.5,78,0,0),(46,11,24.919998,0.08101836,7.365305,7.904787,11.704097,12.1439085,153.7923,148.22246,0,0,26.484755,29.197083,96.53713,107.47958,54.046364,60.418846,42.57618,47.060734,55.945957,66.63636,69.5,68.454544,72,64.818184,68,0,0),(47,18,41.62,0.13479963,7.4888687,9.364849,11.659748,12.221862,154.37726,147.27705,0,0,25.949062,36.809814,95.431854,109.5627,53.050568,60.418846,42.42206,49.183636,55.574497,67.30556,76.5,69.22222,77,65.388885,76,0,0),(48,11,24.919998,0.08101836,7.365305,7.904787,11.704097,12.1439085,153.7923,148.22246,0,0,26.484755,29.197083,96.53713,107.47958,54.046364,60.418846,42.57618,47.060734,55.945957,66.63636,69.5,68.454544,72,64.818184,68,0,0),(49,18,41.62,0.13479963,7.4888687,9.364849,11.659748,12.221862,154.37726,147.27705,0,0,25.949062,36.809814,95.431854,109.5627,53.050568,60.418846,42.42206,49.183636,55.574497,67.30556,76.5,69.22222,77,65.388885,76,0,0),(50,1,2.53,0.007904787,7.904787,7.904787,11.247918,11.360172,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(51,7,15.74,0.05140508,7.3435826,7.904787,11.757197,12.1439085,153.0977,148.22246,0,0,26.683609,29.197083,97.93189,107.47958,55.464134,60.418846,42.575962,47.060734,56.587593,66.92857,69.5,68.85714,72,65,68,0,0),(52,20,45.239998,0.14672749,7.3363748,9.364849,3.2433136,3.3949618,154.16333,147.27705,0,0,26.5252,36.809814,95.857635,109.5627,53.191936,60.418846,42.722355,49.183636,55.440258,66.825,76.5,68.7,77,64.95,76,0,0),(53,26,59.14,0.19179945,7.376902,9.615999,11.675313,12.45449,154.17145,144.52618,0,0,26.378086,36.809814,96.00082,115.938705,52.97797,64.50281,43.07383,54.6089,55.15671,67.34615,78.5,69.19231,79,65.5,78,0,0),(54,13,30.099998,0.09751437,7.5011053,8.77385,11.6628475,12.1439085,154.33623,148.22246,0,0,25.913624,29.197083,95.486046,107.47958,53.335922,60.418846,42.220257,47.060734,55.834064,67.15385,73.5,69.07692,76,65.23077,71,0,0),(55,4,9.53,0.030677075,7.6692686,7.904787,11.588402,11.871583,155.32771,151.62257,0,0,25.183632,26.666666,94.11608,100.40988,53.52793,57.677525,40.845303,43.7197,56.73481,67,69.5,69.25,72,64.75,68,0,0),(56,4,9.53,0.030677075,7.6692686,7.904787,3.2190006,3.297662,155.32771,151.62257,0,0,25.183632,26.666666,94.11608,100.40988,53.52793,57.677525,40.845303,43.7197,56.73481,67,69.5,69.25,72,64.75,68,0,0),(57,6,13.66,0.044354867,7.3924775,7.904787,3.247062,3.320082,153.98535,150.5987,0,0,26.354319,29.197083,96.40918,102.47181,54.709682,59.013493,41.883465,46.61982,56.649815,66.833336,69.5,68.833336,72,64.833336,68,0,0),(58,13,30.099998,0.09751437,7.5011053,8.77385,3.23968,3.373308,154.33623,148.22246,0,0,25.913624,29.197083,95.486046,107.47958,53.335922,60.418846,42.220257,47.060734,55.834064,67.15385,73.5,69.07692,76,65.23077,71,0,0),(59,4,9.53,0.030677075,7.6692686,7.904787,3.2190006,3.297662,155.32771,151.62257,0,0,25.183632,26.666666,94.11608,100.40988,53.52793,57.677525,40.845303,43.7197,56.73481,67,69.5,69.25,72,64.75,68,0,0),(60,1,2.53,0.007904787,7.904787,7.904787,3.1244218,3.1556034,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(61,6,13.66,0.044354867,7.3924775,7.904787,11.689423,11.952294,153.98535,150.5987,0,0,26.354319,29.197083,96.40918,102.47181,54.709682,59.013493,41.883465,46.61982,56.649815,66.833336,69.5,68.833336,72,64.833336,68,0,0),(62,3,7.23,0.023154484,7.718161,7.904787,3.2025566,3.297662,156.12526,151.62257,0,0,24.896265,26.666666,92.60212,100.40988,52.88924,57.677525,39.93381,42.732357,56.99565,67,69.5,69.333336,72,64.666664,68,0,0),(63,12,27.339998,0.08874052,7.395043,7.904787,3.245813,3.373308,154.04462,148.22246,0,0,26.335041,29.197083,96.04491,107.47958,53.73264,60.418846,42.389793,47.060734,55.909725,66.625,69.5,68.5,72,64.75,68,0,0),(64,2,5,0.015734745,7.8673725,7.904787,3.146949,3.1893923,158.88405,156.76967,0,0,24,24.439919,88.778,90.84099,50.753666,51.99631,38.642616,38.844673,56.772434,65.75,69.5,68.5,72,63,67,0,0),(65,1,2.53,0.007904787,7.904787,7.904787,3.1244218,3.1556034,160.0296,158.4483,0,0,23.715416,23.952095,87.22455,87.984314,49.54049,49.54049,38.44382,38.44382,56.306046,62,62,65,65,59,59,0,0),(66,7,15.74,0.05140508,7.3435826,7.904787,3.2658882,3.373308,153.0977,148.22246,0,0,26.683609,29.197083,97.93189,107.47958,55.464134,60.418846,42.575962,47.060734,56.587593,66.92857,69.5,68.85714,72,65,68,0,0),(67,26,59.14,0.19179945,7.376902,9.615999,3.2431426,3.4595807,154.17145,144.52618,0,0,26.378086,36.809814,96.00082,115.938705,52.97797,64.50281,43.07383,54.6089,55.15671,67.34615,78.5,69.19231,79,65.5,78,0,0),(68,1,1.54,0,0,0,0,0,0,0,0,0,38.96104,38.96104,0,0,0,0,0,0,0,32,32,12,12,52,52,0,0),(69,14,31.700003,0,0,0,0,0,0,0,0,0,26.498423,47.61905,0,0,0,0,0,0,0,60.142857,69.5,60.857143,68,59.42857,73,0,0),(70,10,22.599998,0.07351642,7.3516417,7.904787,3.252939,3.373308,153.70715,148.22246,0,0,26.548676,29.197083,96.72874,107.47958,54.332043,60.418846,42.490696,47.060734,56.125618,66.7,69.5,68.6,72,64.8,68,0,0);
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
-- Table structure for table `firmwares`
--

DROP TABLE IF EXISTS `firmwares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firmwares` (
  `device_type_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `version` int(11) DEFAULT NULL,
  `version_text` varchar(50) DEFAULT '',
  `data` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`device_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `firmwares`
--

LOCK TABLES `firmwares` WRITE;
/*!40000 ALTER TABLE `firmwares` DISABLE KEYS */;
/*!40000 ALTER TABLE `firmwares` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (161,24,'2016-06-30 21:17:24','[[{\"time\":2.505,\"dist\":7.904787,\"spd\":3.1556034,\"pace500\":158.4483,\"pace2k\":633.7932,\"hr\":0,\"srate\":23.952095,\"cal\":0.6284683,\"pwr_l\":49.54049,\"pwr_r\":38.44382,\"pwr\":87.984314,\"pwr_bal\":56.306046,\"ang_l\":\"wv\\/C\\/8P\\/w\\/\\/D\\/8P\\/w\\/\\/D\\/8T\\/xP\\/E\\/8T\\/xf\\/F\\/8X\\/xv\\/G\\/8b\\/xv\\/H\\/8f\\/yP\\/I\\/8j\\/yf\\/J\\/8r\\/yv\\/L\\/8v\\/zP\\/M\\/83\\/zf\\/O\\/8\\/\\/z\\/\\/Q\\/9H\\/0f\\/S\\/9P\\/0\\/\\/U\\/9X\\/1v\\/W\\/9f\\/2P\\/Z\\/9r\\/2v\\/b\\/9z\\/3f\\/e\\/9\\/\\/4P\\/h\\/+H\\/4v\\/j\\/+T\\/5f\\/m\\/+f\\/5\\/\\/o\\/+n\\/6v\\/r\\/+z\\/7f\\/t\\/+7\\/7\\/\\/w\\/\\/H\\/8f\\/y\\/\\/P\\/9P\\/0\\/\\/X\\/9v\\/2\\/\\/f\\/+P\\/4\\/\\/n\\/+v\\/6\\/\\/v\\/\\/P\\/8\\/\\/3\\/\\/v\\/+\\/\\/\\/\\/\\/\\/8AAAAAAAABAAEAAQACAAIAAgACAAIAAwADAAMAAwADAAMAAwADAAMAAwADAAMAAwADAAMAAwADAAMAAwADAAIAAgACAAIAAgABAAEAAQABAAEAAAAAAAAA\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/+\\/\\/7\\/\\/v\\/9\\/\\/3\\/\\/f\\/8\\/\\/z\\/+\\/\\/7\\/\\/v\\/+v\\/6\\/\\/n\\/+f\\/4\\/\\/j\\/9\\/\\/3\\/\\/b\\/9v\\/1\\/\\/T\\/9P\\/z\\/\\/L\\/8v\\/x\\/\\/D\\/8P\\/v\\/+7\\/7f\\/s\\/+z\\/6\\/\\/q\\/+n\\/6P\\/n\\/+b\\/5f\\/k\\/+P\\/4v\\/h\\/+D\\/3\\/\\/d\\/9z\\/2\\/\\/a\\/9n\\/2P\\/X\\/9b\\/1f\\/V\\/9T\\/0\\/\\/S\\/9H\\/0P\\/P\\/87\\/zv\\/N\\/8z\\/y\\/\\/L\\/8r\\/yf\\/I\\/8j\\/x\\/\\/G\\/8b\\/xf\\/F\\/8T\\/xP\\/D\\/8P\\/wv\\/C\\/8L\\/wf\\/B\\/8D\\/wP\\/A\\/8D\\/v\\/+\\/\\/7\\/\\/v\\/+\\/\\/77\\/vv++\\/77\\/vv++\\/77\\/vv8=\",\"ang_r\":\"yv\\/K\\/8r\\/y\\/\\/L\\/8v\\/y\\/\\/L\\/8z\\/zP\\/M\\/8z\\/zP\\/M\\/83\\/zf\\/N\\/83\\/zf\\/O\\/87\\/zv\\/O\\/87\\/z\\/\\/P\\/8\\/\\/0P\\/Q\\/9D\\/0f\\/R\\/9H\\/0v\\/S\\/9P\\/0\\/\\/T\\/9T\\/1P\\/V\\/9X\\/1v\\/X\\/9f\\/2P\\/Y\\/9n\\/2f\\/a\\/9r\\/2\\/\\/c\\/9z\\/3f\\/e\\/9\\/\\/3\\/\\/g\\/+H\\/4v\\/j\\/+P\\/5P\\/l\\/+b\\/5\\/\\/o\\/+n\\/6v\\/r\\/+z\\/7P\\/u\\/+\\/\\/7\\/\\/x\\/\\/H\\/8v\\/z\\/\\/T\\/9f\\/2\\/\\/f\\/+P\\/4\\/\\/n\\/+v\\/7\\/\\/z\\/\\/f\\/9\\/\\/7\\/\\/\\/8AAAAAAAABAAEAAgACAAMAAwADAAQABAAEAAQABAAFAAUABQAFAAUABQAFAAUABQAFAAUABQAFAAUABQAFAAUABAAEAAQABAAEAAMAAwADAAMAAgACAAIAAQABAAEAAAAAAP\\/\\/\\/\\/\\/\\/\\/\\/7\\/\\/v\\/9\\/\\/3\\/\\/P\\/7\\/\\/v\\/+v\\/5\\/\\/n\\/+P\\/3\\/\\/f\\/9v\\/1\\/\\/X\\/9P\\/z\\/\\/L\\/8f\\/x\\/\\/D\\/7\\/\\/u\\/+3\\/7P\\/r\\/+v\\/6v\\/p\\/+j\\/5\\/\\/m\\/+X\\/5P\\/j\\/+P\\/4v\\/h\\/+D\\/3\\/\\/e\\/97\\/3f\\/c\\/9v\\/2\\/\\/a\\/9n\\/2P\\/Y\\/9f\\/1v\\/V\\/9X\\/1P\\/T\\/9P\\/0v\\/S\\/9H\\/0P\\/Q\\/8\\/\\/z\\/\\/O\\/87\\/zf\\/N\\/8z\\/zP\\/L\\/8v\\/yv\\/K\\/8n\\/yf\\/J\\/8j\\/yP\\/H\\/8f\\/x\\/\\/G\\/8b\\/xv\\/G\\/8X\\/xf\\/F\\/8T\\/xP\\/E\\/8T\\/xP\\/E\\/8T\\/xP\\/E\\/8T\\/xP\\/E\\/w==\",\"ang\":62,\"offset\":0,\"frc_l\":\"ALD+QgCUAUMAtAJDANADQwDwBEMADAZDACwHQwBICEMAaAlDAGgJQwBoCUMAaAlDAIgKQwCICkMAiApDAIgKQwCICkMAiApDAIgKQwCkC0MApAtDAKQLQwCkC0MAxAxDAMQMQwDgDUMA4A1DAPwOQwAcEEMAHBBDADgRQwBYEkMAWBJDAHQTQwCUFEMAsBVDANAWQwDsF0MACBlDACgaQwBEG0MAYBxDAIAdQwCAHUMAnB5DALgfQwC4H0MAuB9DALgfQwC4H0MAuB9DALgfQwC4H0MAuB9DANggQwDYIEMA2CBDANggQwDYIEMAuB9DALgfQwCcHkMAnB5DAIAdQwBgHEMAYBxDAEQbQwAoGkMACBlDAOwXQwDsF0MA0BZDALAVQwCUFEMAdBNDADgRQwD8DkMAxAxDAEgIQwDQA0MAsP5CAIDzQgBQ6EIA2NpCAGjNQgDwv0IAMLBCALiiQgD4kkIAsIdCAGB0QgDQXUIAQEdCADA1QgAQI0IAgBVCAPAHQgDA9EEAoOJBAIDQQQCAvkEAYKxBAECaQQAgkUEAAH5BAABsQQDAWUEAwEdBAIA1QQBAI0EAQBFBAEARQQAA\\/kAAANpAAADaQAAA2kAAgLVAAIC1QACAkUAAgJFAAABaQAAAWkAAAFpAAABaQAAAEUAAABFAAAARQAAAEUAAABFAAAARQAAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAAAAAAJI\\/AACSPwAAkj8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAARQA==\",\"frc_r\":\"AKDYQgD42kIAUN1CAKDfQgD44UIAqOZCAPjoQgBQ60IAUOtCAKjtQgAA8EIAAPBCAFDyQgBQ8kIAqPRCAKj0QgCo9EIAqPRCAAD3QgAA90IAAPdCAAD3QgBQ+UIAUPlCAKj7QgCo+0IAAP5CAAD+QgAoAEMAKABDAFQBQwBUAUMAVAFDAFQBQwB8AkMAfAJDAHwCQwB8AkMAfAJDAHwCQwB8AkMAfAJDAHwCQwB8AkMAfAJDAHwCQwB8AkMAVAFDAFQBQwAoAEMAKABDAAD+QgAA\\/kIAqPtCAKj7QgCo+0IAqPtCAKj7QgBQ+UIAUPlCAFD5QgAA90IAqPRCAKj0QgBQ8kIAUPJCAFDyQgAA8EIAAPBCAKjtQgBQ60IA+OhCAFDkQgD44UIAUN1CAKDYQgCg0UIAmMpCADjBQgCItUIAKKxCAGigQgCwlEIA8IhCAGB6QgCAZ0IAAFBCACA9QgAAL0IAIBxCAPANQgCg\\/0EAoOxBAGDQQQBgvUEAgKpBAAChQQAgjkEAoIRBAIB2QQCAUEEAgD1BAIAqQQCAKkEAwBdBAMAEQQCA40AAgONAAIC9QACAvUAAgJdAAICXQAAAZEAAAGRAAABkQAAAGEAAABhAAAAYQAAAmD8AAJg\\/AACYPwAAmD8AAJg\\/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=\"},{\"time\":2.455,\"dist\":7.829958,\"spd\":3.1893923,\"pace500\":156.76967,\"pace2k\":627.0787,\"hr\":0,\"srate\":24.439919,\"cal\":0.6225573,\"pwr_l\":51.99631,\"pwr_r\":38.844673,\"pwr\":90.84099,\"pwr_bal\":57.238823,\"ang_l\":\"vv++\\/7\\/\\/v\\/+\\/\\/8D\\/wP\\/A\\/8H\\/wf\\/C\\/8P\\/w\\/\\/E\\/8X\\/xf\\/G\\/8f\\/yP\\/J\\/8r\\/y\\/\\/M\\/83\\/zv\\/P\\/9D\\/0f\\/S\\/9T\\/1f\\/W\\/9f\\/2P\\/a\\/9v\\/3P\\/d\\/97\\/3\\/\\/h\\/+L\\/4\\/\\/k\\/+X\\/5v\\/n\\/+j\\/6f\\/q\\/+v\\/7P\\/t\\/+\\/\\/7\\/\\/w\\/\\/H\\/8v\\/z\\/\\/T\\/9f\\/2\\/\\/f\\/+P\\/5\\/\\/r\\/+v\\/7\\/\\/z\\/\\/f\\/+\\/\\/7\\/\\/\\/8AAAEAAQABAAIAAgADAAMAAwADAAQABAAEAAQABAAFAAUABQAFAAUABQAFAAUABQAFAAUABgAGAAYABgAGAAYABgAGAAYABQAFAAUABQAFAAUABQAFAAUABQAFAAQABAAEAAQABAADAAMAAwADAAMAAgACAAIAAgACAAEAAQABAAEAAAAAAAAA\\/\\/\\/\\/\\/\\/\\/\\/\\/v\\/+\\/\\/7\\/\\/f\\/9\\/\\/z\\/\\/P\\/8\\/\\/v\\/+\\/\\/6\\/\\/r\\/+f\\/5\\/\\/n\\/+P\\/3\\/\\/f\\/9v\\/2\\/\\/X\\/9P\\/0\\/\\/P\\/8v\\/y\\/\\/H\\/8P\\/v\\/+\\/\\/7v\\/t\\/+z\\/6\\/\\/q\\/+n\\/6P\\/o\\/+f\\/5v\\/l\\/+T\\/4\\/\\/i\\/+H\\/4P\\/f\\/93\\/3f\\/c\\/9r\\/2v\\/Y\\/9f\\/1v\\/V\\/9T\\/0\\/\\/S\\/9H\\/0f\\/Q\\/8\\/\\/zv\\/N\\/8z\\/y\\/\\/L\\/8r\\/yf\\/J\\/8j\\/x\\/\\/H\\/8b\\/xv\\/F\\/8T\\/xP\\/D\\/8P\\/w\\/\\/C\\/8L\\/wf\\/B\\/8H\\/wf\\/A\\/8D\\/wP+\\/\\/7\\/\\/v\\/+\\/\\/7\\/\\/v\\/+\\/\\/7\\/\\/v\\/+\\/\\/7\\/\\/v\\/8=\",\"ang_r\":\"xP\\/E\\/8X\\/xf\\/F\\/8X\\/xv\\/G\\/8b\\/x\\/\\/H\\/8j\\/yf\\/J\\/8n\\/yv\\/L\\/8v\\/zP\\/M\\/83\\/zf\\/O\\/87\\/z\\/\\/Q\\/9D\\/0f\\/S\\/9L\\/0\\/\\/U\\/9X\\/1v\\/X\\/9f\\/2P\\/Z\\/9r\\/2\\/\\/c\\/93\\/3v\\/f\\/+D\\/4f\\/i\\/+P\\/5P\\/m\\/+f\\/6P\\/p\\/+r\\/7P\\/t\\/+7\\/7\\/\\/w\\/\\/H\\/8v\\/0\\/\\/X\\/9v\\/3\\/\\/j\\/+f\\/6\\/\\/v\\/\\/P\\/9\\/\\/3\\/\\/v\\/\\/\\/wAAAAABAAEAAgACAAMAAwAEAAQABAAEAAUABQAFAAUABgAGAAYABgAGAAYABgAHAAcABwAHAAcABwAHAAcABwAHAAcABwAHAAcABwAHAAcABgAGAAYABgAGAAYABQAFAAUABQAEAAQABAAEAAMAAwADAAIAAgACAAEAAQAAAAAAAAD\\/\\/\\/\\/\\/\\/v\\/+\\/\\/3\\/\\/f\\/8\\/\\/z\\/+\\/\\/6\\/\\/r\\/+f\\/5\\/\\/j\\/9\\/\\/3\\/\\/b\\/9f\\/1\\/\\/T\\/8\\/\\/y\\/\\/L\\/8f\\/w\\/+\\/\\/7\\/\\/u\\/+3\\/7P\\/r\\/+r\\/6v\\/p\\/+j\\/5\\/\\/m\\/+X\\/5P\\/k\\/+P\\/4v\\/h\\/+D\\/4P\\/f\\/97\\/3f\\/c\\/9v\\/2v\\/a\\/9n\\/2P\\/X\\/9f\\/1v\\/V\\/9T\\/1P\\/T\\/9L\\/0v\\/R\\/9D\\/0P\\/P\\/8\\/\\/zv\\/O\\/83\\/zP\\/M\\/8v\\/y\\/\\/K\\/8r\\/yv\\/J\\/8n\\/yP\\/I\\/8j\\/x\\/\\/H\\/8b\\/xv\\/G\\/8b\\/xf\\/F\\/8X\\/xP\\/E\\/8T\\/xP\\/E\\/8P\\/w\\/\\/D\\/8P\\/w\\/\\/D\\/8P\\/w\\/8=\",\"ang\":69.5,\"offset\":-5,\"frc_l\":\"AABaQAAA2kAAwEdBACCRQQCA0EEA8AdCAKAnQgDAS0IA0G9CALCHQgB4l0IA+KRCALC0QgAowkIAoM9CANjaQgAQ5kIAQPFCAHD8QgC0AkMALAdDAKQLQwAcEEMAdBNDAOwXQwAoGkMAgB1DANggQwAQI0MATCVDAIgnQwDAKUMA\\/CtDADQuQwBsMEMAbDBDAKgyQwCoMkMAxDNDAOA0QwDgNEMA4DRDAOA0QwDgNEMAxDNDAKgyQwCMMUMAbDBDADQuQwAYLUMA3CpDAKQoQwBMJUMA9CFDAIAdQwAIGUMAdBNDAMQMQwAMBkMAcPxCAMjsQgDY2kIA6MhCAPC2QgD4pEIAOJVCALCHQgDgeEIA0F1CAMBLQgCwOUIAoCdCAIAVQgDwB0IAwPRBAKDiQQCA0EEAgL5BAGCsQQBAmkEAIJFBAAB+QQAAbEEAwFlBAMBHQQCANUEAQCNBAEAjQQBAEUEAAP5AAADaQAAA2kAAgLVAAIC1QACAtUAAgJFAAICRQACAkUAAAFpAAABaQAAAWkAAABFAAAARQAAAEUAAABFAAAARQAAAEUAAABFAAAARQAAAEUAAAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAAAAAAAkj8AAAAAAAAAAAAAkj8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAARQAAAWkAAgLVAAIA1QQ==\",\"frc_r\":\"AAAAAAAAmD8AAJg\\/AACYPwAAmD8AABhAAICXQADABEEAgFBBAAChQQBg0EEAQAlCAJAlQgCQRkIA0GJCABB\\/QgBIi0IACJdCAGigQgDIqUIAMLNCAIi8QgCQw0IA8MxCAPDTQgD42kIAoN9CAKjmQgBQ60IAUPJCAAD3QgCo+0IAAP5CAFQBQwB8AkMA1ARDAPwFQwAoB0MAUAhDAFAIQwB8CUMAfAlDAHwJQwB8CUMAUAhDAFAIQwBQCEMAKAdDACgHQwAoB0MAKAdDAPwFQwDUBEMAqANDAHwCQwAoAEMAqPtCAKj0QgCo7UIA+OFCAKDYQgDwzEIA4L5CANiwQgBooEIAUJJCAJCGQgDwcEIAYFlCAJBGQgCwM0IA0CBCALASQgCABEIAIPZBAMDZQQDgxkEAALRBAAChQQCgl0EAoIRBAIB2QQCAY0EAgFBBAIA9QQCAKkEAwBdBAMAEQQCA40AAgONAAIC9QACAvUAAgJdAAICXQAAAZEAAAGRAAABkQAAAGEAAABhAAAAYQAAAGEAAAJg\\/AACYPwAAmD8AAJg\\/AACYPwAAmD8AAJg\\/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==\"},{\"time\":2.25,\"dist\":7.4197397,\"spd\":3.297662,\"pace500\":151.62257,\"pace2k\":606.4903,\"hr\":0,\"srate\":26.666666,\"cal\":0.59069586,\"pwr_l\":57.677525,\"pwr_r\":42.732357,\"pwr\":100.40988,\"pwr_bal\":57.44208,\"ang_l\":\"v\\/+\\/\\/8D\\/wP\\/B\\/8H\\/wv\\/C\\/8P\\/xP\\/F\\/8X\\/xv\\/H\\/8j\\/yf\\/K\\/8v\\/zP\\/N\\/87\\/z\\/\\/R\\/9L\\/0\\/\\/U\\/9X\\/1\\/\\/Y\\/9n\\/2v\\/c\\/93\\/3v\\/f\\/+H\\/4v\\/j\\/+T\\/5v\\/n\\/+j\\/6f\\/q\\/+v\\/7P\\/u\\/+\\/\\/8P\\/x\\/\\/L\\/8\\/\\/0\\/\\/X\\/9v\\/3\\/\\/j\\/+f\\/6\\/\\/r\\/+\\/\\/8\\/\\/3\\/\\/v\\/+\\/\\/\\/\\/AAAAAAEAAQACAAIAAwADAAMAAwAEAAQABAAFAAUABQAFAAUABQAFAAYABgAGAAYABgAGAAYABgAGAAYABgAGAAYABQAFAAUABQAFAAUABQAFAAQABAAEAAQAAwADAAMAAwADAAIAAgACAAEAAQABAAAAAAAAAP\\/\\/\\/\\/\\/\\/\\/\\/7\\/\\/v\\/9\\/\\/3\\/\\/P\\/8\\/\\/v\\/+\\/\\/7\\/\\/r\\/+f\\/5\\/\\/j\\/+P\\/3\\/\\/b\\/9v\\/1\\/\\/T\\/9P\\/z\\/\\/L\\/8f\\/w\\/\\/D\\/7\\/\\/u\\/+3\\/7P\\/r\\/+r\\/6f\\/o\\/+f\\/5v\\/l\\/+T\\/4\\/\\/i\\/+H\\/3\\/\\/e\\/93\\/3P\\/b\\/9r\\/2f\\/Y\\/9f\\/1v\\/V\\/9T\\/0\\/\\/S\\/9H\\/0P\\/P\\/87\\/zf\\/N\\/8z\\/y\\/\\/K\\/8r\\/yf\\/I\\/8f\\/x\\/\\/G\\/8X\\/xf\\/E\\/8P\\/w\\/\\/C\\/8L\\/wf\\/B\\/8H\\/wP\\/A\\/7\\/\\/v\\/+\\/\\/7\\/\\/vv++\\/77\\/vv++\\/77\\/vv++\\/77\\/vv8=\",\"ang_r\":\"w\\/\\/D\\/8T\\/xP\\/E\\/8T\\/xf\\/F\\/8X\\/xv\\/G\\/8b\\/x\\/\\/H\\/8j\\/yf\\/J\\/8r\\/yv\\/L\\/8z\\/zP\\/N\\/87\\/zv\\/P\\/9D\\/0f\\/S\\/9L\\/0\\/\\/U\\/9X\\/1v\\/X\\/9j\\/2f\\/a\\/9v\\/3P\\/d\\/97\\/3\\/\\/h\\/+L\\/4\\/\\/k\\/+X\\/5\\/\\/o\\/+n\\/6\\/\\/s\\/+3\\/7v\\/v\\/\\/H\\/8v\\/z\\/\\/T\\/9f\\/2\\/\\/f\\/+f\\/5\\/\\/v\\/+\\/\\/8\\/\\/3\\/\\/v\\/\\/\\/\\/\\/\\/AAAAAAEAAQACAAIAAwADAAMABAAEAAQABQAFAAUABQAFAAYABgAGAAYABgAGAAYABgAGAAYABwAGAAYABgAGAAYABgAGAAYABgAGAAUABQAFAAUABQAEAAQABAADAAMAAwACAAIAAgABAAEAAAAAAP\\/\\/\\/\\/\\/+\\/\\/7\\/\\/f\\/8\\/\\/z\\/+\\/\\/6\\/\\/r\\/+f\\/4\\/\\/j\\/9\\/\\/2\\/\\/X\\/9P\\/0\\/\\/P\\/8v\\/x\\/\\/D\\/7\\/\\/u\\/+3\\/7P\\/r\\/+r\\/6v\\/p\\/+j\\/5\\/\\/m\\/+X\\/5P\\/j\\/+L\\/4f\\/g\\/+D\\/3\\/\\/e\\/93\\/3P\\/b\\/9v\\/2v\\/Z\\/9n\\/2P\\/X\\/9b\\/1f\\/V\\/9T\\/0\\/\\/T\\/9L\\/0v\\/R\\/9D\\/0P\\/P\\/87\\/zv\\/N\\/83\\/zP\\/M\\/8v\\/y\\/\\/K\\/8r\\/yf\\/J\\/8j\\/yP\\/I\\/8f\\/x\\/\\/G\\/8b\\/xv\\/G\\/8X\\/xf\\/F\\/8T\\/xP\\/E\\/8T\\/xP\\/E\\/8T\\/xP\\/E\\/8T\\/xP\\/E\\/w==\",\"ang\":69.5,\"offset\":-8,\"frc_l\":\"ACCIQQCAx0EAcANCABAjQgBAR0IAUGtCALCHQgC4mUIAeKlCADC5QgDoyEIAmNhCAIjqQgA4+kIA0ANDAIgKQwA4EUMA0BZDAIAdQwAQI0MAiCdDAPwrQwBQL0MAqDJDAOA0QwAYN0MAVDlDAIw7QwCoPEMAxD1DAOA+QwDgPkMA\\/D9DAPw\\/QwD8P0MA\\/D9DAOA+QwDEPUMAqDxDAHA6QwA0OEMA4DRDAKgyQwA0LkMA3CpDAIgnQwD0IUMAgB1DANAWQwAcEEMASAhDAJQBQwBA8UIAWN9CAGjNQgBwu0IAuKtCALiZQgAwjEIAYH1CANBmQgBAUEIAMD5CACAsQgAQGkIAgAxCAOD9QQDA60EAgNBBAIC+QQBgrEEAQKNBACCRQQAgiEEAAGxBAMBZQQDAR0EAgDVBAEAjQQBAI0EAQBFBAAD+QAAA\\/kAAANpAAADaQACAtUAAgLVAAICRQACAkUAAgJFAAABaQAAAWkAAAFpAAAARQAAAEUAAABFAAAARQAAAEUAAABFAAACSPwAAEUAAAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAAAAAAAAAAAAJI\\/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAARQAAAEUAAgJFAAEARQQ==\",\"frc_r\":\"AAAAAAAAAAAAAAAAAACYPwAAmD8AAJg\\/AACYPwAAmD8AABhAAABkQACA40AAgD1BACCOQQDgxkEAoP9BANAgQgDQQUIA0GJCAOCBQgBQkkIAaKBCACisQgDgt0IAkMNCAPDMQgCg2EIAoN9CAPjoQgAA8EIAAPdCAAD+QgBUAUMA1ARDACgHQwB8CUMA0AtDAPgMQwAkDkMAJA5DACQOQwAkDkMAJA5DACQOQwAkDkMAJA5DACQOQwD4DEMA0AtDAKQKQwAoB0MA1ARDAFQBQwCo+0IAUPJCAPjoQgD42kIASM9CADjBQgAws0IAGKVCAAiXQgDwiEIAYHpCANBiQgBAS0IAcDhCAJAlQgBgF0IAQAlCACD2QQBA40EA4MZBAGC9QQCAqkEAoJdBACCOQQCAdkEAgGNBAIBQQQCAPUEAgCpBAMAXQQDABEEAwARBAIDjQACAvUAAgL1AAICXQACAl0AAgJdAAABkQAAAZEAAABhAAAAYQAAAGEAAABhAAACYPwAAmD8AAJg\\/AACYPwAAmD8AAJg\\/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAJg\\/AACYPwAAmD8=\"},{\"time\":2.29,\"dist\":7.5225906,\"spd\":3.284974,\"pace500\":152.2082,\"pace2k\":608.8328,\"hr\":0,\"srate\":26.200874,\"cal\":0.5990734,\"pwr_l\":55.535633,\"pwr_r\":43.7197,\"pwr\":99.25533,\"pwr_bal\":55.952293,\"ang_l\":\"vv++\\/7\\/\\/v\\/+\\/\\/8D\\/wf\\/B\\/8L\\/w\\/\\/E\\/8T\\/xf\\/G\\/8f\\/yP\\/K\\/8v\\/zP\\/N\\/87\\/z\\/\\/Q\\/9H\\/0\\/\\/U\\/9X\\/1\\/\\/Y\\/9n\\/2\\/\\/c\\/93\\/3\\/\\/g\\/+H\\/4v\\/k\\/+X\\/5v\\/n\\/+j\\/6v\\/r\\/+z\\/7f\\/v\\/+\\/\\/8f\\/y\\/\\/P\\/9P\\/1\\/\\/b\\/9\\/\\/4\\/\\/n\\/+f\\/6\\/\\/v\\/\\/P\\/9\\/\\/3\\/\\/v\\/+\\/\\/\\/\\/\\/\\/8AAAAAAQABAAEAAQACAAIAAgACAAIAAwADAAMAAwADAAMAAwADAAMAAwADAAMAAwADAAMAAwADAAMAAgACAAIAAgACAAIAAQABAAEAAQABAAAAAAAAAAAAAAD\\/\\/\\/\\/\\/\\/\\/\\/+\\/\\/7\\/\\/v\\/9\\/\\/3\\/\\/f\\/8\\/\\/z\\/\\/P\\/7\\/\\/v\\/+\\/\\/6\\/\\/r\\/+v\\/5\\/\\/n\\/+P\\/4\\/\\/j\\/9\\/\\/3\\/\\/b\\/9v\\/1\\/\\/X\\/9P\\/0\\/\\/P\\/8v\\/y\\/\\/H\\/8f\\/w\\/+\\/\\/7\\/\\/u\\/+3\\/7f\\/s\\/+v\\/6\\/\\/q\\/+n\\/6P\\/o\\/+f\\/5v\\/m\\/+X\\/5P\\/j\\/+L\\/4f\\/h\\/+D\\/3\\/\\/e\\/93\\/3P\\/c\\/9v\\/2v\\/Z\\/9j\\/1\\/\\/X\\/9b\\/1f\\/U\\/9P\\/0v\\/S\\/9H\\/0P\\/P\\/87\\/zv\\/N\\/8z\\/zP\\/L\\/8r\\/yf\\/J\\/8j\\/x\\/\\/H\\/8b\\/xv\\/F\\/8X\\/xP\\/E\\/8P\\/w\\/\\/C\\/8L\\/wf\\/B\\/8H\\/wP\\/A\\/8D\\/v\\/+\\/\\/7\\/\\/v\\/+\\/\\/7\\/\\/vv++\\/7\\/\\/v\\/+\\/\\/w==\",\"ang_r\":\"xP\\/E\\/8X\\/xf\\/F\\/8b\\/xv\\/H\\/8f\\/yP\\/J\\/8n\\/yv\\/K\\/8v\\/zP\\/N\\/83\\/zv\\/P\\/9D\\/0P\\/R\\/9L\\/0\\/\\/U\\/9X\\/1v\\/X\\/9j\\/2f\\/a\\/9v\\/3P\\/e\\/9\\/\\/4P\\/h\\/+P\\/5P\\/l\\/+b\\/6P\\/p\\/+r\\/7P\\/t\\/+7\\/7\\/\\/x\\/\\/L\\/8\\/\\/0\\/\\/X\\/9v\\/3\\/\\/j\\/+f\\/6\\/\\/v\\/\\/P\\/9\\/\\/3\\/\\/v\\/\\/\\/\\/\\/\\/AAAAAAEAAQACAAIAAgADAAMAAwAEAAQABAAEAAQABQAFAAUABQAFAAUABQAFAAUABQAFAAUABQAFAAUABQAEAAQABAAEAAMAAwADAAIAAgACAAEAAQABAAAAAAAAAP\\/\\/\\/\\/\\/+\\/\\/7\\/\\/f\\/8\\/\\/z\\/+\\/\\/7\\/\\/r\\/+f\\/5\\/\\/j\\/+P\\/3\\/\\/b\\/9v\\/1\\/\\/T\\/8\\/\\/z\\/\\/L\\/8f\\/x\\/\\/D\\/7\\/\\/u\\/+3\\/7P\\/s\\/+v\\/6v\\/p\\/+n\\/6P\\/n\\/+b\\/5f\\/l\\/+T\\/4\\/\\/j\\/+L\\/4f\\/g\\/+D\\/3\\/\\/e\\/97\\/3f\\/d\\/9z\\/2\\/\\/b\\/9r\\/2v\\/Z\\/9j\\/2P\\/X\\/9f\\/1v\\/V\\/9X\\/1P\\/U\\/9P\\/0\\/\\/S\\/9L\\/0f\\/R\\/9H\\/0P\\/Q\\/8\\/\\/z\\/\\/O\\/87\\/zv\\/N\\/83\\/zP\\/M\\/8z\\/y\\/\\/L\\/8v\\/yv\\/K\\/8r\\/yf\\/J\\/8n\\/yP\\/I\\/8j\\/yP\\/H\\/8f\\/x\\/\\/G\\/8b\\/xv\\/G\\/8b\\/xf\\/F\\/8X\\/xf\\/F\\/8X\\/xf\\/F\\/8X\\/\",\"ang\":67,\"offset\":-4,\"frc_l\":\"AAB+QQCAvkEAcANCACAsQgBAWUIAMINCALiZQgAwsEIAaMRCAGDWQgCI6kIAcPxCACwHQwD8DkMA0BZDAIAdQwAwJEMAwClDADQuQwCoMkMA\\/DVDADQ4QwBwOkMAjDtDAKg8QwCoPEMAxD1DAMQ9QwDgPkMA4D5DAOA+QwDgPkMAxD1DAKg8QwCoPEMAjDtDAHA6QwA0OEMA\\/DVDAKgyQwBQL0MA\\/CtDAKQoQwAQI0MAnB5DAOwXQwA4EUMAaAlDAHgAQwAI70IAGN1CACjLQgDwtkIAOKdCADiVQgCwh0IAYHRCANBdQgDAS0IAsDlCAKAnQgCAFUIA8AdCAMD0QQCg4kEAgNBBAIC+QQBgrEEAQJpBACCRQQAAfkEAAGxBAMBZQQDAR0EAgDVBAEAjQQBAI0EAQBFBAAD+QAAA\\/kAAANpAAIC1QACAtUAAgJFAAICRQACAkUAAgJFAAABaQAAAWkAAAFpAAABaQAAAEUAAABFAAAARQAAAEUAAABFAAAARQAAAEUAAAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAAAAAAJI\\/AACSPwAAkj8AAJI\\/AAAAAAAAAAAAAJI\\/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACSPwAAAAAAAAAAAAAAAAAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAARQAAAWkAAgLVAAIA1QQAgkUE=\",\"frc_r\":\"AACYPwAAmD8AAJg\\/AAAYQACAl0AAgONAAIBQQQAAoUEAQONBACAcQgDQQUIAQGxCAEiLQgBooEIA4LdCAEDIQgCg2EIAqOZCAKj0QgAoAEMA1ARDAHwJQwAkDkMAoBFDAPQTQwBwF0MAmBhDAMQZQwDsGkMA7BpDABgcQwAYHEMA7BpDAMQZQwDEGUMAmBhDAHAXQwBwF0MASBZDABwVQwD0E0MAoBFDACQOQwDQC0MAKAdDAKgDQwCo+0IAAPBCAPjhQgDw00IA6MVCAOC3QgBwp0IAYJlCAEiLQgBgekIA0GJCAEBLQgBwOEIAkCVCAGAXQgBACUIAIPZBAEDjQQBg0EEAYL1BAICqQQCgl0EAII5BAIB2QQCAY0EAgFBBAIA9QQCAKkEAwBdBAMAEQQDABEEAgONAAIC9QACAvUAAgJdAAICXQAAAZEAAAGRAAABkQAAAGEAAABhAAAAYQAAAGEAAAJg\\/AACYPwAAmD8AAJg\\/AACYPwAAmD8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\"},{\"time\":2.0749998,\"dist\":6.855021,\"spd\":3.3036249,\"pace500\":151.3489,\"pace2k\":605.3956,\"hr\":0,\"srate\":28.915665,\"cal\":0.5460173,\"pwr_l\":59.013493,\"pwr_r\":41.942062,\"pwr\":100.95555,\"pwr_bal\":58.454926,\"ang_l\":\"v\\/+\\/\\/8D\\/wP\\/B\\/8H\\/wv\\/D\\/8P\\/xP\\/F\\/8b\\/x\\/\\/I\\/8n\\/yv\\/L\\/8z\\/zf\\/O\\/9D\\/0f\\/S\\/9T\\/1f\\/W\\/9f\\/2f\\/a\\/9z\\/3f\\/e\\/9\\/\\/4f\\/i\\/+P\\/5P\\/m\\/+f\\/6P\\/p\\/+r\\/6\\/\\/t\\/+7\\/7\\/\\/w\\/\\/H\\/8v\\/z\\/\\/T\\/9f\\/2\\/\\/f\\/+P\\/5\\/\\/r\\/+\\/\\/8\\/\\/z\\/\\/f\\/+\\/\\/\\/\\/\\/\\/8AAAEAAQABAAIAAgACAAMAAwADAAMAAwAEAAQABAAEAAQABAAEAAQABAAEAAQAAwADAAMAAwADAAMAAwADAAIAAgACAAIAAgABAAEAAQABAAAAAAAAAP\\/\\/\\/\\/\\/\\/\\/\\/7\\/\\/v\\/+\\/\\/3\\/\\/f\\/8\\/\\/z\\/\\/P\\/7\\/\\/v\\/+v\\/6\\/\\/n\\/+f\\/4\\/\\/j\\/9\\/\\/2\\/\\/X\\/9f\\/0\\/\\/P\\/8\\/\\/y\\/\\/H\\/8P\\/v\\/+\\/\\/7v\\/t\\/+z\\/6\\/\\/q\\/+n\\/6P\\/n\\/+b\\/5f\\/j\\/+L\\/4f\\/h\\/9\\/\\/3v\\/d\\/9z\\/2\\/\\/a\\/9n\\/2P\\/X\\/9b\\/1f\\/U\\/9P\\/0v\\/R\\/9D\\/z\\/\\/O\\/87\\/zf\\/M\\/8v\\/y\\/\\/K\\/8n\\/yf\\/I\\/8f\\/x\\/\\/G\\/8X\\/xf\\/E\\/8T\\/xP\\/D\\/8P\\/wv\\/C\\/8L\\/wf\\/B\\/8H\\/wf\\/A\\/8D\\/wP\\/A\\/8D\\/wP+\\/\\/7\\/\\/v\\/+\\/\\/7\\/\\/\",\"ang_r\":\"xf\\/F\\/8b\\/xv\\/G\\/8b\\/x\\/\\/H\\/8j\\/yP\\/J\\/8n\\/yv\\/K\\/8v\\/y\\/\\/M\\/83\\/zv\\/O\\/8\\/\\/0P\\/Q\\/9H\\/0v\\/T\\/9T\\/1f\\/W\\/9f\\/2P\\/Z\\/9r\\/2\\/\\/c\\/93\\/3v\\/g\\/+H\\/4v\\/j\\/+T\\/5v\\/n\\/+j\\/6v\\/r\\/+z\\/7v\\/v\\/\\/D\\/8f\\/y\\/\\/T\\/9f\\/2\\/\\/f\\/+P\\/5\\/\\/r\\/+\\/\\/8\\/\\/3\\/\\/v\\/\\/\\/\\/\\/\\/AAAAAAEAAQACAAIAAwADAAMAAwAEAAQABAAEAAUABQAFAAUABQAFAAUABQAFAAUABQAFAAQABAAEAAQABAADAAMAAwADAAIAAgABAAEAAQAAAAAA\\/\\/\\/\\/\\/\\/7\\/\\/v\\/9\\/\\/z\\/\\/P\\/7\\/\\/r\\/+f\\/5\\/\\/j\\/9\\/\\/2\\/\\/X\\/9f\\/0\\/\\/P\\/8v\\/x\\/\\/D\\/7\\/\\/u\\/+3\\/7P\\/r\\/+r\\/6f\\/o\\/+f\\/5v\\/l\\/+T\\/5P\\/j\\/+L\\/4f\\/g\\/9\\/\\/3v\\/e\\/93\\/3P\\/b\\/9r\\/2v\\/Z\\/9j\\/2P\\/X\\/9b\\/1v\\/V\\/9T\\/1P\\/T\\/9P\\/0v\\/R\\/9H\\/0P\\/Q\\/8\\/\\/z\\/\\/O\\/87\\/zf\\/N\\/8z\\/zP\\/L\\/8v\\/yv\\/K\\/8n\\/yf\\/J\\/8j\\/yP\\/H\\/8f\\/xv\\/G\\/8b\\/xv\\/F\\/8X\\/xf\\/E\\/8T\\/xP\\/E\\/8P\\/w\\/\\/D\\/8P\\/w\\/\\/D\\/8P\\/w\\/8=\",\"ang\":66.5,\"offset\":-6,\"frc_l\":\"AIDHQQBwA0IAoCdCAMBLQgDQb0IA8IlCAPibQgB4qUIAMLlCAKjGQgBg1kIA0ONCAIDzQgB4AEMADAZDAMQMQwBYEkMA7BdDAGAcQwDYIEMATCVDAKQoQwD8K0MANC5DAIwxQwDEM0MA\\/DVDADQ4QwBUOUMAcDpDAHA6QwCMO0MAjDtDAHA6QwBwOkMAcDpDAFQ5QwA0OEMA\\/DVDAKgyQwBsMEMA\\/CtDAIgnQwAQI0MAYBxDANAWQwAcEEMASAhDALD+QgDI7EIA2NpCAOjIQgDwtkIA+KRCADiVQgCwh0IAYHRCANBdQgDAS0IAMDVCAKAnQgCAFUIA8AdCAMD0QQCg4kEAgMdBAGC1QQBgrEEAQJpBACCIQQAAfkEAAGxBAMBZQQDAR0EAgDVBAEAjQQBAEUEAQBFBAAD+QAAA2kAAANpAAIC1QACAtUAAgLVAAICRQACAkUAAAFpAAABaQAAAWkAAAFpAAABaQAAAEUAAABFAAAARQAAAEUAAABFAAACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAARQAAAWkAAAP5A\",\"frc_r\":\"AAAAAAAAmD8AAJg\\/AACYPwAAmD8AAJg\\/AAAYQACAl0AAwARBAIBjQQAAtEEAoOxBAGAXQgCwM0IAsFRCAKB1QgDwiEIACJdCAMCiQgAorEIAiLVCADjBQgBAyEIAoNFCAPjaQgD44UIAUOtCAFDyQgAA90IAAP5CAFQBQwCoA0MA\\/AVDAFAIQwB8CUMApApDAKQKQwCkCkMA0AtDANALQwDQC0MA0AtDAKQKQwB8CUMAKAdDAKgDQwAoAEMAAPdCAKjtQgD44UIA8NNCAOjFQgDgt0IAcKdCAGCZQgBIi0IAEH9CAIBnQgAAUEIAID1CAEAqQgBgF0IAQAlCAKD\\/QQBA40EAYNBBAGC9QQCAqkEAoJdBACCOQQCAdkEAgGNBAIBQQQCAPUEAgCpBAMAXQQDABEEAgONAAIDjQACAvUAAgL1AAICXQACAl0AAAGRAAABkQAAAZEAAABhAAAAYQAAAGEAAABhAAACYPwAAmD8AAJg\\/AACYPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==\"},{\"time\":2.0549998,\"dist\":6.8227677,\"spd\":3.320082,\"pace500\":150.5987,\"pace2k\":602.3948,\"hr\":0,\"srate\":29.197083,\"cal\":0.5438582,\"pwr_l\":55.85199,\"pwr_r\":46.61982,\"pwr\":102.47181,\"pwr_bal\":54.504734,\"ang_l\":\"wP\\/A\\/8D\\/wf\\/B\\/8L\\/wv\\/D\\/8T\\/xf\\/F\\/8b\\/x\\/\\/I\\/8n\\/y\\/\\/M\\/83\\/zv\\/P\\/9H\\/0v\\/T\\/9X\\/1v\\/X\\/9j\\/2v\\/b\\/9z\\/3v\\/f\\/+D\\/4v\\/j\\/+T\\/5f\\/n\\/+j\\/6f\\/q\\/+z\\/7f\\/u\\/+\\/\\/8P\\/x\\/\\/L\\/8\\/\\/0\\/\\/X\\/9v\\/4\\/\\/j\\/+f\\/6\\/\\/v\\/\\/P\\/9\\/\\/7\\/\\/v\\/\\/\\/\\/\\/\\/AAAAAAEAAQABAAIAAgACAAIAAgADAAMAAwADAAMAAwADAAMAAwADAAMAAwADAAMAAwACAAIAAgACAAIAAgACAAEAAQABAAEAAQAAAAAAAAAAAP\\/\\/\\/\\/\\/\\/\\/\\/7\\/\\/v\\/+\\/\\/3\\/\\/f\\/8\\/\\/z\\/\\/P\\/7\\/\\/v\\/+v\\/6\\/\\/n\\/+f\\/4\\/\\/j\\/9\\/\\/2\\/\\/b\\/9f\\/1\\/\\/T\\/8\\/\\/z\\/\\/L\\/8f\\/w\\/\\/D\\/7\\/\\/u\\/+3\\/7P\\/r\\/+r\\/6v\\/p\\/+j\\/5\\/\\/m\\/+X\\/5P\\/j\\/+L\\/4f\\/g\\/9\\/\\/3f\\/d\\/9z\\/2v\\/a\\/9n\\/1\\/\\/X\\/9b\\/1f\\/U\\/9P\\/0v\\/R\\/9H\\/0P\\/P\\/87\\/zf\\/N\\/8z\\/y\\/\\/K\\/8n\\/yf\\/I\\/8f\\/x\\/\\/G\\/8X\\/xf\\/E\\/8T\\/w\\/\\/D\\/8P\\/wv\\/C\\/8H\\/wf\\/B\\/8D\\/wP\\/A\\/7\\/\\/v\\/+\\/\\/7\\/\\/v\\/++\\/77\\/vv++\\/w==\",\"ang_r\":\"w\\/\\/D\\/8T\\/xP\\/E\\/8X\\/xf\\/F\\/8b\\/xv\\/H\\/8f\\/yP\\/J\\/8n\\/yv\\/L\\/8z\\/zP\\/N\\/87\\/z\\/\\/P\\/9D\\/0f\\/S\\/9P\\/1P\\/V\\/9b\\/1\\/\\/Y\\/9n\\/2v\\/b\\/93\\/3v\\/f\\/+D\\/4f\\/j\\/+T\\/5f\\/n\\/+j\\/6f\\/q\\/+z\\/7f\\/u\\/+\\/\\/8f\\/y\\/\\/P\\/9P\\/1\\/\\/f\\/+P\\/5\\/\\/r\\/+\\/\\/7\\/\\/z\\/\\/f\\/+\\/\\/7\\/\\/\\/8AAAAAAAABAAEAAgACAAMAAwADAAMABAAEAAQABAAEAAQABAAFAAUABQAEAAQABAAEAAQABAAEAAMAAwADAAMAAgACAAIAAQABAAEAAAAAAP\\/\\/\\/\\/\\/+\\/\\/3\\/\\/f\\/8\\/\\/v\\/+\\/\\/6\\/\\/n\\/+f\\/4\\/\\/f\\/9v\\/1\\/\\/T\\/8\\/\\/y\\/\\/L\\/8f\\/w\\/+\\/\\/7v\\/t\\/+z\\/6\\/\\/q\\/+n\\/6P\\/n\\/+b\\/5v\\/k\\/+T\\/4\\/\\/i\\/+H\\/4P\\/f\\/97\\/3v\\/d\\/9z\\/2\\/\\/a\\/9r\\/2f\\/Y\\/9f\\/1\\/\\/W\\/9X\\/1P\\/U\\/9P\\/0\\/\\/S\\/9H\\/0f\\/Q\\/9D\\/z\\/\\/O\\/87\\/zv\\/N\\/83\\/zP\\/M\\/8v\\/y\\/\\/K\\/8r\\/yf\\/J\\/8n\\/yP\\/I\\/8j\\/x\\/\\/H\\/8b\\/xv\\/G\\/8b\\/xf\\/F\\/8X\\/xP\\/E\\/8T\\/xP\\/E\\/8T\\/w\\/\\/D\\/8P\\/w\\/8=\",\"ang\":66.5,\"offset\":-5,\"frc_l\":\"AABsQQBgrEEAwPRBAJAeQgBAR0IA0G9CADCMQgC4okIAsLRCAKjGQgBg1kIAUOhCADj6QgAsB0MA\\/A5DANAWQwCAHUMAMCRDAMApQwAYLUMAjDFDAMQzQwD8NUMAGDdDADQ4QwA0OEMANDhDADQ4QwAYN0MA\\/DVDAOA0QwCoMkMAbDBDAFAvQwD8K0MAwClDAGgmQwAQI0MAnB5DAEQbQwDQFkMAWBJDAMQMQwAMBkMAeABDAEDxQgDQ40IAINRCAGjEQgBwskIAuKJCADiVQgCwh0IAYHRCANBdQgBAR0IAMDVCABAjQgCAFUIA8AdCAMD0QQCg4kEAgMdBAGC1QQBAo0EAQJpBACCIQQAAfkEAAGxBAMBZQQDAR0EAgDVBAEAjQQBAEUEAQBFBAAD+QAAA2kAAANpAAIC1QACAtUAAgLVAAICRQACAkUAAAFpAAABaQAAAWkAAAFpAAAARQAAAEUAAABFAAAARQAAAEUAAABFAAACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAAAAAAAkj8AAJI\\/AACSPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAkj8AAAAAAAAAAAAAAAAAAJI\\/AACSPwAAkj8AABFAAABaQAAA2kA=\",\"frc_r\":\"AAAAAAAAAAAAAJg\\/AACYPwAAmD8AAJg\\/AAAYQAAAGEAAgL1AAIA9QQAAoUEAoOxBANAgQgBAS0IAoHVCAFCSQgDIqUIAiLxCAEjPQgBQ3UIA+OhCAKj0QgAA\\/kIAqANDAHwJQwD4DEMAeBBDAMgSQwD0E0MAHBVDABwVQwAcFUMAHBVDAPQTQwDIEkMAyBJDAKARQwB4EEMATA9DAPgMQwDQC0MAfAlDACgHQwDUBEMAVAFDAFD5QgCo7UIA+OFCAEjWQgBAyEIAOLpCACisQgAQnkIA+I9CAOCBQgCAZ0IAsFRCANBBQgAAL0IA0CBCAPANQgCg\\/0EAoOxBAMDZQQDgxkEAgKpBAAChQQAgjkEAoIRBAIBjQQCAUEEAgD1BAIAqQQDAF0EAwBdBAMAEQQCA40AAgONAAIC9QACAvUAAgJdAAABkQAAAZEAAAGRAAAAYQAAAGEAAABhAAAAYQAAAmD8AAJg\\/AACYPwAAmD8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA==\"},{\"time\":2.09,\"dist\":7.0502133,\"spd\":3.373308,\"pace500\":148.22246,\"pace2k\":592.88983,\"hr\":0,\"srate\":28.708136,\"cal\":0.5629541,\"pwr_l\":60.418846,\"pwr_r\":47.060734,\"pwr\":107.47958,\"pwr_bal\":56.214256,\"ang_l\":\"vv++\\/7\\/\\/v\\/+\\/\\/8D\\/wP\\/B\\/8H\\/wv\\/D\\/8T\\/xf\\/G\\/8b\\/yP\\/J\\/8r\\/y\\/\\/M\\/83\\/zv\\/Q\\/9H\\/0v\\/U\\/9X\\/1v\\/Y\\/9n\\/2\\/\\/c\\/93\\/3\\/\\/g\\/+H\\/4\\/\\/k\\/+X\\/5\\/\\/o\\/+n\\/6v\\/r\\/+3\\/7v\\/v\\/\\/D\\/8f\\/y\\/\\/P\\/9P\\/1\\/\\/b\\/9\\/\\/4\\/\\/n\\/+v\\/7\\/\\/z\\/\\/P\\/9\\/\\/7\\/\\/v\\/\\/\\/wAAAAAAAAEAAQABAAEAAgACAAIAAgACAAMAAwADAAMAAwADAAMAAwADAAIAAgACAAIAAgACAAIAAgABAAEAAQABAAEAAQAAAAAAAAAAAP\\/\\/\\/\\/\\/\\/\\/\\/7\\/\\/v\\/+\\/\\/7\\/\\/f\\/9\\/\\/3\\/\\/P\\/8\\/\\/v\\/+\\/\\/7\\/\\/r\\/+v\\/5\\/\\/n\\/+P\\/4\\/\\/j\\/9\\/\\/2\\/\\/b\\/9f\\/0\\/\\/T\\/8\\/\\/y\\/\\/L\\/8f\\/w\\/+\\/\\/7\\/\\/u\\/+3\\/7P\\/r\\/+r\\/6f\\/o\\/+f\\/5v\\/l\\/+T\\/4\\/\\/i\\/+H\\/4P\\/f\\/97\\/3f\\/c\\/9v\\/2v\\/Z\\/9j\\/1\\/\\/W\\/9X\\/1P\\/T\\/9L\\/0f\\/R\\/9D\\/z\\/\\/O\\/83\\/zf\\/M\\/8v\\/yv\\/J\\/8j\\/yP\\/H\\/8b\\/xv\\/F\\/8T\\/xP\\/D\\/8P\\/wv\\/C\\/8H\\/wf\\/A\\/8D\\/v\\/+\\/\\/7\\/\\/v\\/++\\/77\\/vv++\\/77\\/vv++\\/77\\/vv8=\",\"ang_r\":\"w\\/\\/D\\/8T\\/xP\\/E\\/8T\\/xf\\/F\\/8b\\/xv\\/H\\/8f\\/yP\\/I\\/8n\\/yv\\/K\\/8v\\/zP\\/N\\/83\\/zv\\/P\\/9D\\/0f\\/S\\/9L\\/0\\/\\/U\\/9X\\/1v\\/Y\\/9n\\/2v\\/b\\/9z\\/3f\\/e\\/+D\\/4f\\/i\\/+T\\/5f\\/m\\/+j\\/6f\\/q\\/+v\\/7f\\/u\\/+\\/\\/8f\\/y\\/\\/P\\/9P\\/1\\/\\/b\\/+P\\/5\\/\\/r\\/+\\/\\/8\\/\\/z\\/\\/f\\/+\\/\\/\\/\\/\\/\\/8AAAAAAQABAAIAAgACAAMAAwADAAQABAAEAAQABAAEAAUABQAFAAUABQAFAAUABQAFAAQABAAEAAQABAAEAAMAAwADAAMAAgACAAIAAQABAAAAAAAAAP\\/\\/\\/\\/\\/+\\/\\/7\\/\\/f\\/8\\/\\/v\\/+\\/\\/6\\/\\/n\\/+f\\/4\\/\\/f\\/9v\\/1\\/\\/T\\/8\\/\\/y\\/\\/L\\/8f\\/w\\/+\\/\\/7v\\/t\\/+z\\/6\\/\\/q\\/+n\\/6P\\/n\\/+b\\/5f\\/k\\/+P\\/4v\\/h\\/+D\\/4P\\/f\\/97\\/3f\\/c\\/9v\\/2\\/\\/a\\/9n\\/2f\\/Y\\/9f\\/1\\/\\/W\\/9X\\/1f\\/U\\/9T\\/0\\/\\/S\\/9L\\/0f\\/R\\/9D\\/0P\\/P\\/87\\/zv\\/O\\/83\\/zf\\/M\\/8z\\/y\\/\\/L\\/8r\\/yv\\/J\\/8n\\/yP\\/I\\/8j\\/x\\/\\/H\\/8b\\/xv\\/G\\/8b\\/xf\\/F\\/8X\\/xP\\/E\\/8T\\/xP\\/E\\/8T\\/xP\\/E\\/8T\\/xP\\/E\\/8T\\/\",\"ang\":67.5,\"offset\":-6,\"frc_l\":\"AMBHQQBAmkEAoNlBAAARQgCwOUIAUGtCAPCJQgB4oEIAsLRCAKjGQgDY2kIAiOpCALD+QgBICEMAHBBDAOwXQwCAHUMAECNDAKQoQwAYLUMAjDFDAMQzQwD8NUMAGDdDAFQ5QwBwOkMAjDtDAKg8QwDEPUMA4D5DAOA+QwDgPkMAxD1DAMQ9QwCoPEMAjDtDAFQ5QwAYN0MAxDNDAFAvQwD8K0MAiCdDABAjQwCAHUMA0BZDAPwOQwAsB0MAsP5CAMjsQgDY2kIAaMRCALC0QgD4pEIAOJVCALCHQgBgdEIA0F1CAEBHQgAwNUIAECNCAIAVQgDwB0IAwPRBAKDiQQCA0EEAgL5BAGCsQQBAmkEAIJFBAAB+QQAAbEEAwFlBAMBHQQCANUEAQCNBAEARQQBAEUEAAP5AAADaQAAA2kAAANpAAIC1QACAkUAAgJFAAICRQACAkUAAAFpAAABaQAAAWkAAAFpAAAARQAAAEUAAABFAAAARQAAAEUAAABFAAACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AAAAAAAAkj8AAJI\\/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACSPwAAAAAAAJI\\/AACSPwAAEUAAABFAAICRQAAA\\/kAAAGxBAGCsQQ==\",\"frc_r\":\"AAAAAAAAAAAAAJg\\/AACYPwAAmD8AAJg\\/AAAYQACAl0AAwARBAIB2QQBgvUEAgARCAAAvQgCwVEIAEH9CAFCSQgDAokIAMLNCADjBQgBIz0IA+NpCAPjoQgBQ8kIAqPtCAKgDQwBQCEMA0AtDAEwPQwCgEUMA9BNDAEgWQwBwF0MAmBhDAMQZQwDEGUMAxBlDAMQZQwDEGUMAxBlDAJgYQwCYGEMASBZDABwVQwDIEkMATA9DAPgMQwBQCEMAqANDAFD5QgBQ60IAUN1CAEjPQgDgvkIAgK5CABCeQgD4j0IA4IFCAEBsQgBgWUIA0EFCAAAvQgDQIEIAsBJCAIAEQgCg7EEAwNlBAODGQQAAtEEAAKFBACCOQQCghEEAgHZBAIBQQQCAPUEAgCpBAIAqQQDAF0EAwARBAIDjQACA40AAgL1AAICXQACAl0AAgJdAAABkQAAAZEAAAGRAAAAYQAAAGEAAABhAAACYPwAAmD8AAJg\\/AACYPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACYPwAAmD8AAJg\\/\"},{\"time\":2.15,\"dist\":7.0892916,\"spd\":3.2973447,\"pace500\":151.63716,\"pace2k\":606.54865,\"hr\":0,\"srate\":27.906975,\"cal\":0.5645384,\"pwr_l\":56.3536,\"pwr_r\":44.02729,\"pwr\":100.38089,\"pwr_bal\":56.139767,\"ang_l\":\"vv++\\/7\\/\\/v\\/\\/A\\/8D\\/wf\\/C\\/8L\\/w\\/\\/E\\/8X\\/xv\\/H\\/8j\\/yv\\/L\\/8z\\/zf\\/P\\/9D\\/0f\\/S\\/9T\\/1f\\/X\\/9j\\/2f\\/b\\/9z\\/3f\\/f\\/+D\\/4v\\/j\\/+X\\/5v\\/n\\/+j\\/6f\\/r\\/+z\\/7f\\/u\\/+\\/\\/8P\\/y\\/\\/L\\/9P\\/1\\/\\/b\\/9\\/\\/4\\/\\/n\\/+v\\/7\\/\\/v\\/\\/P\\/9\\/\\/7\\/\\/v\\/\\/\\/\\/\\/\\/AAAAAAEAAQABAAEAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAQABAAEAAQABAAEAAAAAAAAAAAAAAP\\/\\/\\/\\/\\/\\/\\/\\/7\\/\\/v\\/+\\/\\/7\\/\\/f\\/9\\/\\/3\\/\\/P\\/8\\/\\/z\\/+\\/\\/7\\/\\/r\\/+v\\/6\\/\\/n\\/+f\\/4\\/\\/j\\/9\\/\\/2\\/\\/b\\/9f\\/0\\/\\/T\\/8\\/\\/y\\/\\/L\\/8f\\/w\\/+\\/\\/7\\/\\/u\\/+3\\/7P\\/r\\/+r\\/6f\\/o\\/+f\\/5v\\/l\\/+X\\/4\\/\\/i\\/+H\\/4f\\/f\\/97\\/3f\\/c\\/9z\\/2v\\/a\\/9n\\/1\\/\\/X\\/9b\\/1f\\/U\\/9P\\/0v\\/R\\/9H\\/0P\\/P\\/87\\/zf\\/N\\/8z\\/y\\/\\/L\\/8r\\/yf\\/J\\/8j\\/yP\\/H\\/8f\\/xv\\/G\\/8X\\/xf\\/E\\/8T\\/xP\\/D\\/8P\\/w\\/\\/C\\/8L\\/wv\\/C\\/8L\\/wf\\/B\\/8H\\/wf\\/B\\/8H\\/wP\\/A\\/8D\\/wP\\/A\\/8D\\/wP\\/A\\/8D\\/wP\\/A\\/8D\\/wP8=\",\"ang_r\":\"xP\\/E\\/8X\\/xf\\/G\\/8b\\/xv\\/H\\/8j\\/yP\\/J\\/8n\\/yv\\/L\\/8v\\/zP\\/N\\/87\\/zv\\/P\\/9D\\/0f\\/S\\/9P\\/1P\\/V\\/9b\\/1\\/\\/Y\\/9n\\/2v\\/b\\/93\\/3v\\/f\\/+D\\/4v\\/j\\/+T\\/5v\\/n\\/+j\\/6v\\/r\\/+z\\/7v\\/v\\/\\/D\\/8f\\/y\\/\\/T\\/9f\\/2\\/\\/f\\/+P\\/5\\/\\/r\\/+\\/\\/8\\/\\/3\\/\\/v\\/+\\/\\/\\/\\/AAAAAAEAAQACAAIAAgADAAMAAwADAAMABAAEAAQABAAEAAQABAAEAAQABAAEAAQAAwADAAMAAwADAAIAAgACAAEAAQABAAAAAAAAAP\\/\\/\\/\\/\\/+\\/\\/7\\/\\/f\\/9\\/\\/z\\/+\\/\\/7\\/\\/r\\/+f\\/5\\/\\/j\\/9\\/\\/2\\/\\/b\\/9f\\/0\\/\\/P\\/8v\\/x\\/\\/H\\/7\\/\\/v\\/+7\\/7f\\/s\\/+v\\/6v\\/p\\/+j\\/5\\/\\/m\\/+b\\/5f\\/k\\/+P\\/4v\\/h\\/+H\\/4P\\/f\\/97\\/3f\\/d\\/9z\\/2\\/\\/b\\/9r\\/2f\\/Z\\/9j\\/1\\/\\/X\\/9b\\/1f\\/V\\/9T\\/1P\\/T\\/9L\\/0v\\/R\\/9H\\/0P\\/Q\\/8\\/\\/z\\/\\/O\\/87\\/zv\\/N\\/83\\/zP\\/M\\/8z\\/y\\/\\/L\\/8r\\/yv\\/K\\/8n\\/yf\\/J\\/8n\\/yP\\/I\\/8j\\/x\\/\\/H\\/8f\\/x\\/\\/G\\/8b\\/xv\\/G\\/8b\\/xv\\/G\\/8X\\/xf\\/F\\/8X\\/xf\\/F\\/8X\\/xf\\/F\\/8X\\/xf\\/F\\/8X\\/xf\\/F\\/8X\\/\",\"ang\":66,\"offset\":-4,\"frc_l\":\"AMD0QQCQHkIAQEdCANBvQgDwiUIA+JtCAPCtQgCwvUIAaM1CAFjfQgAI70IAeABDACwHQwDgDUMAlBRDAEQbQwDYIEMAaCZDANwqQwBQL0MAqDJDAOA0QwAYN0MAVDlDAHA6QwCoPEMAqDxDAMQ9QwDEPUMAxD1DAKg8QwCMO0MAcDpDADQ4QwDgNEMAjDFDADQuQwDAKUMATCVDALgfQwAoGkMAdBNDAMQMQwDwBEMAOPpCAIjqQgCY2EIAqMZCALC0QgC4okIAOJVCALCHQgBgdEIA0F1CAEBHQgAwNUIAECNCAIAVQgDwB0IAwPRBAKDiQQCAx0EAYLVBAECjQQBAmkEAIIhBAAB+QQAAbEEAwFlBAMBHQQCANUEAQCNBAEARQQAA\\/kAAAP5AAADaQAAA2kAAgLVAAIC1QACAkUAAgJFAAICRQACAkUAAAFpAAABaQAAAWkAAAFpAAAARQAAAEUAAABFAAAARQAAAEUAAABFAAACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPw==\",\"frc_r\":\"AACYPwAAmD8AABhAAABkQACA40AAgD1BAKCXQQBg0EEAgARCAJAlQgCQRkIA0GJCAOCBQgD4j0IAEJ5CACisQgA4ukIA6MVCAPDTQgCg30IAqO1CAFD5QgB8AkMAUAhDAPgMQwCgEUMAHBVDAJgYQwDsGkMAQB1DAJAfQwCQH0MAvCBDAJAfQwCQH0MAaB5DAEAdQwAYHEMAxBlDAEgWQwDIEkMAJA5DAFAIQwB8AkMAUPlCAFDrQgD42kIAmMpCADi6QgDIqUIAuJtCAKCNQgAQf0IAgGdCAABQQgAgPUIAQCpCACAcQgDwDUIAoP9BAEDjQQBg0EEAYL1BAICqQQCgl0EAII5BAKCEQQCAY0EAgFBBAIA9QQCAKkEAwBdBAMAEQQDABEEAgONAAIC9QACAvUAAgJdAAICXQACAl0AAAGRAAABkQAAAGEAAABhAAAAYQAAAGEAAAJg\\/AACYPwAAmD8AAJg\\/AACYPwAAmD8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA\"},{\"time\":2.34,\"dist\":7.4168253,\"spd\":3.1695836,\"pace500\":157.74944,\"pace2k\":630.99774,\"hr\":0,\"srate\":25.641027,\"cal\":0.589452,\"pwr_l\":49.855644,\"pwr_r\":39.30324,\"pwr\":89.15889,\"pwr_bal\":55.91775,\"ang_l\":\"wP\\/A\\/8H\\/wf\\/B\\/8L\\/wv\\/D\\/8T\\/xf\\/F\\/8b\\/x\\/\\/I\\/8n\\/yv\\/M\\/83\\/zv\\/P\\/9D\\/0f\\/T\\/9T\\/1v\\/X\\/9j\\/2v\\/b\\/9z\\/3f\\/f\\/+D\\/4f\\/j\\/+T\\/5f\\/m\\/+j\\/6f\\/q\\/+v\\/7P\\/t\\/+\\/\\/8P\\/x\\/\\/L\\/8\\/\\/0\\/\\/X\\/9v\\/3\\/\\/j\\/+f\\/6\\/\\/v\\/+\\/\\/8\\/\\/3\\/\\/v\\/\\/\\/wAAAAABAAEAAgACAAIAAwADAAMAAwAEAAQABAAEAAQABAAEAAUABQAFAAUABQAFAAUABQAEAAQABAAEAAQABAAEAAQABAAEAAQABAADAAMAAwADAAMAAwADAAIAAgACAAIAAgACAAEAAQABAAEAAQAAAAAAAAAAAP\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/\\/v\\/+\\/\\/7\\/\\/f\\/9\\/\\/3\\/\\/f\\/8\\/\\/z\\/\\/P\\/7\\/\\/v\\/+v\\/6\\/\\/r\\/+f\\/5\\/\\/n\\/+P\\/4\\/\\/f\\/9\\/\\/2\\/\\/b\\/9v\\/1\\/\\/X\\/9P\\/0\\/\\/P\\/8v\\/y\\/\\/L\\/8f\\/w\\/\\/D\\/7\\/\\/u\\/+7\\/7f\\/s\\/+z\\/6\\/\\/q\\/+n\\/6f\\/o\\/+f\\/5\\/\\/m\\/+X\\/5P\\/j\\/+P\\/4v\\/h\\/+H\\/4P\\/f\\/97\\/3f\\/c\\/9z\\/2\\/\\/a\\/9n\\/2P\\/X\\/9f\\/1v\\/V\\/9T\\/0\\/\\/T\\/9L\\/0f\\/Q\\/8\\/\\/zv\\/O\\/83\\/zP\\/M\\/8v\\/yv\\/J\\/8n\\/yP\\/I\\/8f\\/x\\/\\/G\\/8X\\/xf\\/F\\/8T\\/xP\\/D\\/8P\\/w\\/\\/C\\/8L\\/wv\\/C\\/8H\\/wf\\/B\\/8H\\/\",\"ang_r\":\"xf\\/F\\/8b\\/xv\\/G\\/8b\\/x\\/\\/H\\/8f\\/yP\\/J\\/8n\\/yf\\/K\\/8v\\/zP\\/M\\/83\\/zv\\/P\\/8\\/\\/0P\\/R\\/9L\\/0\\/\\/U\\/9X\\/1v\\/X\\/9j\\/2f\\/a\\/9v\\/3f\\/e\\/9\\/\\/4P\\/h\\/+P\\/5P\\/l\\/+b\\/6P\\/p\\/+r\\/7P\\/t\\/+7\\/7\\/\\/x\\/\\/L\\/8\\/\\/0\\/\\/X\\/9\\/\\/4\\/\\/n\\/+v\\/7\\/\\/z\\/\\/f\\/+\\/\\/7\\/\\/\\/8AAAAAAQABAAIAAgADAAMABAAEAAQABQAFAAUABQAGAAYABgAGAAYABgAGAAYABgAGAAYABgAGAAYABgAGAAYABgAGAAYABgAGAAUABQAFAAUABQAEAAQABAAEAAMAAwADAAIAAgACAAEAAQAAAAAAAAD\\/\\/\\/\\/\\/\\/v\\/+\\/\\/3\\/\\/f\\/8\\/\\/z\\/+\\/\\/7\\/\\/r\\/+v\\/5\\/\\/n\\/+P\\/4\\/\\/f\\/9\\/\\/2\\/\\/X\\/9f\\/0\\/\\/P\\/8\\/\\/y\\/\\/L\\/8f\\/w\\/+\\/\\/7\\/\\/u\\/+3\\/7P\\/s\\/+v\\/6v\\/q\\/+n\\/6P\\/o\\/+f\\/5v\\/m\\/+X\\/5f\\/k\\/+T\\/4\\/\\/i\\/+L\\/4f\\/h\\/+D\\/4P\\/f\\/97\\/3v\\/d\\/93\\/3P\\/c\\/9v\\/2\\/\\/a\\/9n\\/2f\\/Y\\/9j\\/1\\/\\/X\\/9b\\/1v\\/V\\/9T\\/1P\\/T\\/9P\\/0v\\/S\\/9H\\/0P\\/Q\\/8\\/\\/z\\/\\/O\\/87\\/zf\\/N\\/8z\\/zP\\/L\\/8v\\/yv\\/J\\/8n\\/yf\\/I\\/8j\\/x\\/\\/H\\/8b\\/xv\\/G\\/8b\\/xf\\/F\\/8X\\/xf\\/F\\/8X\\/xf\\/F\\/8X\\/\",\"ang\":67,\"offset\":-2,\"frc_l\":\"AACSPwAAEUAAABFAAAARQAAAWkAAQBFBAAB+QQCA0EEAgAxCALA5QgBQa0IAcI5CAPikQgAwuUIAKMtCAFjfQgCA80IA0ANDAMQMQwCUFEMAYBxDABAjQwCkKEMANC5DAIwxQwDEM0MA\\/DVDABg3QwAYN0MAGDdDAPw1QwDgNEMAxDNDAKgyQwBsMEMANC5DAPwrQwCkKEMATCVDABAjQwCcHkMARBtDANAWQwA4EUMApAtDAPAEQwBw\\/EIACO9CAFjfQgCgz0IAsL1CAPCtQgA4nkIAcI5CAPCAQgBQa0IAwFRCALBCQgAgLEIAkB5CAAARQgBwA0IAwOtBAKDZQQCAx0EAYLVBAECjQQAgkUEAIIhBAAB+QQDAWUEAwEdBAIA1QQBAI0EAQCNBAEARQQAA\\/kAAAP5AAADaQAAA2kAAgLVAAIC1QACAtUAAgJFAAICRQACAkUAAAFpAAABaQAAAWkAAAFpAAAARQAAAEUAAABFAAAARQAAAEUAAABFAAACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAAAAAAJI\\/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACSPwAAkj8AAJI\\/AACSPwAAEUAAgLVA\",\"frc_r\":\"AAAAAAAAmD8AAJg\\/AACYPwAAmD8AAJg\\/AACYPwAAGEAAAGRAAIDjQACAPUEAAKFBAEDjQQAgHEIAkEZCAKB1QgBQkkIAcKdCADi6QgDwzEIAUN1CAKjtQgAA90IAVAFDAPwFQwB8CUMA+AxDAEwPQwB4EEMAoBFDAMgSQwDIEkMAyBJDAKARQwB4EEMAeBBDACQOQwD4DEMA0AtDAKQKQwBQCEMA\\/AVDAKgDQwBUAUMAqPtCAFDyQgD46EIAoN9CAPDTQgDoxUIA4LdCAHCnQgBgmUIAoI1CABB\\/QgCAZ0IAAFBCACA9QgBAKkIAIBxCAPANQgCg\\/0EAoOxBAGDQQQBgvUEAgKpBAAChQQAgjkEAoIRBAIBjQQCAUEEAgD1BAIAqQQDAF0EAwBdBAMAEQQCA40AAgONAAIC9QACAl0AAgJdAAABkQAAAZEAAAGRAAAAYQAAAGEAAABhAAAAYQAAAGEAAAJg\\/AACYPwAAmD8AAJg\\/AACYPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACYPwAAmD8AAJg\\/\"},{\"time\":2.365,\"dist\":7.605226,\"spd\":3.2157404,\"pace500\":155.48518,\"pace2k\":621.94073,\"hr\":0,\"srate\":25.369978,\"cal\":0.6047675,\"pwr_l\":49.428432,\"pwr_r\":43.682575,\"pwr\":93.11101,\"pwr_bal\":53.085487,\"ang_l\":\"wf\\/B\\/8L\\/wv\\/C\\/8P\\/w\\/\\/E\\/8T\\/xf\\/G\\/8b\\/x\\/\\/I\\/8n\\/yv\\/L\\/8z\\/zf\\/O\\/8\\/\\/0f\\/S\\/9P\\/1P\\/W\\/9f\\/2P\\/a\\/9v\\/3P\\/e\\/9\\/\\/4P\\/i\\/+P\\/5P\\/m\\/+f\\/6P\\/p\\/+r\\/6\\/\\/t\\/+7\\/7\\/\\/w\\/\\/H\\/8v\\/z\\/\\/T\\/9f\\/2\\/\\/f\\/+P\\/5\\/\\/r\\/+\\/\\/8\\/\\/3\\/\\/v\\/\\/\\/wAAAAABAAEAAgACAAMAAwADAAMABAAEAAQABAAEAAQABAAEAAQABAAEAAQABAAEAAQABAAEAAQABAAEAAQAAwADAAMAAwADAAMAAwADAAIAAgACAAIAAgABAAEAAQABAAEAAQAAAAAAAAAAAP\\/\\/\\/\\/\\/\\/\\/\\/7\\/\\/v\\/+\\/\\/3\\/\\/f\\/9\\/\\/z\\/\\/P\\/8\\/\\/v\\/+\\/\\/7\\/\\/r\\/+v\\/6\\/\\/n\\/+f\\/5\\/\\/j\\/+P\\/3\\/\\/f\\/9v\\/2\\/\\/b\\/9f\\/1\\/\\/T\\/9P\\/z\\/\\/P\\/8v\\/y\\/\\/H\\/8f\\/w\\/+\\/\\/7\\/\\/u\\/+7\\/7f\\/s\\/+z\\/6\\/\\/q\\/+r\\/6f\\/o\\/+j\\/5\\/\\/m\\/+X\\/5f\\/k\\/+P\\/4v\\/h\\/+H\\/4P\\/f\\/97\\/3f\\/d\\/9z\\/2\\/\\/a\\/9n\\/2P\\/Y\\/9f\\/1v\\/V\\/9X\\/1P\\/T\\/9L\\/0f\\/R\\/9D\\/z\\/\\/O\\/87\\/zf\\/M\\/8z\\/y\\/\\/K\\/8n\\/yf\\/I\\/8f\\/x\\/\\/G\\/8b\\/xf\\/F\\/8T\\/xP\\/D\\/8P\\/wv\\/C\\/8H\\/wf\\/B\\/8D\\/wP\\/A\\/8D\\/v\\/+\\/\\/7\\/\\/v\\/++\\/77\\/vv++\\/77\\/vv8=\",\"ang_r\":\"xf\\/F\\/8b\\/xv\\/G\\/8f\\/x\\/\\/I\\/8j\\/yf\\/J\\/8r\\/yv\\/L\\/8z\\/zP\\/N\\/87\\/zv\\/P\\/9D\\/0f\\/R\\/9L\\/0\\/\\/U\\/9X\\/1v\\/X\\/9j\\/2f\\/a\\/9v\\/3f\\/e\\/9\\/\\/4P\\/h\\/+P\\/5P\\/l\\/+f\\/6P\\/p\\/+v\\/7P\\/t\\/+\\/\\/8P\\/x\\/\\/L\\/9P\\/1\\/\\/b\\/9\\/\\/4\\/\\/n\\/+v\\/7\\/\\/z\\/\\/f\\/+\\/\\/\\/\\/\\/\\/8AAAAAAQABAAIAAgADAAMAAwAEAAQABAAEAAQABQAFAAUABQAFAAUABQAFAAUABQAFAAUABQAEAAQABAAEAAQABAADAAMAAwADAAIAAgACAAEAAQABAAAAAAAAAP\\/\\/\\/\\/\\/+\\/\\/7\\/\\/f\\/9\\/\\/3\\/\\/P\\/7\\/\\/v\\/+v\\/6\\/\\/n\\/+f\\/4\\/\\/j\\/9\\/\\/2\\/\\/b\\/9f\\/0\\/\\/T\\/8\\/\\/y\\/\\/L\\/8f\\/w\\/\\/D\\/7\\/\\/v\\/+7\\/7f\\/s\\/+z\\/6\\/\\/q\\/+r\\/6f\\/o\\/+j\\/5\\/\\/n\\/+b\\/5f\\/l\\/+T\\/5P\\/j\\/+L\\/4v\\/h\\/+D\\/4P\\/f\\/9\\/\\/3v\\/e\\/93\\/3f\\/c\\/9v\\/2\\/\\/a\\/9r\\/2f\\/Z\\/9j\\/2P\\/X\\/9f\\/1v\\/W\\/9X\\/1f\\/U\\/9T\\/0\\/\\/T\\/9L\\/0v\\/S\\/9H\\/0f\\/Q\\/9D\\/z\\/\\/P\\/8\\/\\/zv\\/O\\/83\\/zf\\/N\\/8z\\/zP\\/L\\/8v\\/yv\\/K\\/8r\\/yf\\/J\\/8j\\/yP\\/I\\/8f\\/x\\/\\/G\\/8b\\/xv\\/F\\/8X\\/xf\\/E\\/8T\\/xP\\/D\\/8P\\/w\\/\\/D\\/8P\\/w\\/\\/D\\/8P\\/w\\/8=\",\"ang\":65.5,\"offset\":-2,\"frc_l\":\"AIA1QQBAmkEAoOJBAJAeQgBAUEIA8IBCAHiXQgDwrUIA8L9CACDUQgAQ5kIAOPpCANADQwCICkMAOBFDANAWQwBgHEMA2CBDAEwlQwCkKEMA\\/CtDADQuQwBQL0MAbDBDAIwxQwCoMkMAxDNDAMQzQwDEM0MAxDNDAKgyQwCMMUMAbDBDAFAvQwA0LkMAGC1DANwqQwCkKEMATCVDAPQhQwCcHkMARBtDANAWQwBYEkMA4A1DAEgIQwC0AkMAOPpCAIjqQgAY3UIAaM1CALC9QgDwrUIAOJ5CAHCOQgDwgEIAUGtCAMBUQgAwPkIAoDBCAJAeQgAAEUIAcANCAMDrQQCg2UEAgMdBAGC1QQBAo0EAIJFBACCIQQAAbEEAwFlBAMBHQQCANUEAQCNBAEAjQQBAEUEAAP5AAAD+QAAA2kAAANpAAIC1QACAtUAAgJFAAICRQACAkUAAgJFAAABaQAAAWkAAAFpAAAARQAAAWkAAABFAAAARQAAAEUAAABFAAACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAkj8AAJI\\/AACSPwAAAAAAAJI\\/AACSPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACSPwAAkj8AAJI\\/AACSPwAAEUAAAFpAAADaQA==\",\"frc_r\":\"AACYPwAAZEAAgONAAIA9QQCgl0EAYNBBAPANQgCwM0IAIF5CAOCBQgAIl0IAcKdCADi6QgDwzEIAUN1CAFDrQgBQ+UIAfAJDAFAIQwD4DEMAoBFDAEgWQwDEGUMAGBxDAGgeQwC8IEMA5CFDAAwjQwA4JEMAOCRDADgkQwAMI0MADCNDALwgQwC8IEMAaB5DAEAdQwAYHEMAxBlDAHAXQwAcFUMAoBFDAEwPQwDQC0MAUAhDAKgDQwCo+0IAAPBCAPjhQgDw00IA6MVCAOC3QgBwp0IAYJlCAEiLQgBgekIA0GJCAEBLQgBwOEIAQCpCAGAXQgBACUIAoP9BAEDjQQBg0EEAYL1BAICqQQCgl0EAII5BAIB2QQCAY0EAgFBBAIA9QQCAKkEAwBdBAMAEQQDABEEAgONAAIC9QACAvUAAgJdAAICXQAAAZEAAAGRAAABkQAAAGEAAABhAAAAYQAAAGEAAAJg\\/AACYPwAAmD8AAJg\\/AACYPwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACYPw==\"}]]',1,'Biorower Skiff V1','101',0,'onboard; JTY; joya82_wet_kk; N960; 0123456789ABCDEF; Biorower performance computer; 1',NULL,NULL,NULL,1467292644129,1,0,70);
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
INSERT INTO `user_sessions` VALUES ('0322405314a3ec920a5f119c09e3c10f3091dccc','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWVCemVpT2dFZWhucEVoclpKbHlzaVRJQzJaZ0tvbnlOejBkMjU0aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY5MDY5NTY7czoxOiJjIjtpOjE0NjY5MDY5NTY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466906956),('039761ba354d9f1b95930074bd13e8e2d47f14a5','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFZJMHJ2bUtod0pNbm9WbnFPRVRQSlFsNjdjdUJQSU9FYzVReTRHdyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDU2ODk7czoxOiJjIjtpOjE0NjcyMDU2ODk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467205689),('03ac5d13d033f49fd67835ea27e0ab63966a22ee','YTozOntzOjY6Il90b2tlbiI7czo0MDoiemlYSFQwVHZDNjhZZXhzNEh3MHc4VnVHRHBXWUwwQ3N4RXFSRlVFVCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDk3OTg7czoxOiJjIjtpOjE0NjcyMDk3OTg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467209798),('045ffdee79418bd37a2e2e068acf40b708cc495f','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1hkN1laWHl1d0NhQjFueThsV0VYbjhoMHRRdU9qWlZGQzNQdDF5VSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyOTIwNTc7czoxOiJjIjtpOjE0NjcyOTIwNTc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467292057),('0647c3a2131e9ab0c135738dd102ab6212985fc7','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidHZzeTdXWlBXa2oyWVlFNzBVanNvNW9YZHhGYWQ3a1hqSkZlZHhpTyI7czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO3M6MjoiMjQiO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDY3MTIzNzA4O3M6MToiYyI7aToxNDY3MTIzNzA4O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1467123708),('09b809a425af85a81c016baa4e14600d74f23bb0','YTozOntzOjY6Il90b2tlbiI7czo0MDoieTZOY3ZkRGtVZWE4UlJSYkllZlJ0SVlpbGp3UFlwQ1lKeWFLZVNSMyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDU2ODk7czoxOiJjIjtpOjE0NjcyMDU2ODk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467205689),('0a3acb089ed457e0106ded74bedd88f707b1c720','YTozOntzOjY6Il90b2tlbiI7czo0MDoiREk2SUkwc2NZcExCaktDbmxMR3pxZEhqMWJEdm5qbmNKdUtUVklGZCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyOTIwNTc7czoxOiJjIjtpOjE0NjcyOTIwNTc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467292057),('0c175f04b5fec853c8cd34c74c1f1d209350080d','YTozOntzOjY6Il90b2tlbiI7czo0MDoibzgzWDA0eFVZZldXNllCc25vMWdKc1NoeUl5dm42Vm1mbmtUZ2RneSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NTg0MzA7czoxOiJjIjtpOjE0NjY3NTg0MzA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466758431),('0ecd13013fc46b99c6b5ecd6da2a1900bbd78eb6','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGdtTlBpOVl1ajZJT3czek15b0swRGp5VTBwZm1HNVM5N0JKRHVLMSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NTg2MzM7czoxOiJjIjtpOjE0NjY3NTg2MzM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466758633),('0fae7200ae2bb4d866f9eac75f61c595b0293afb','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGZpY1U3cVl2SjhmYUFqdVNTMzNLb3Nid1M0a0JGd0FSOHpSM2tXZSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDU2NjM7czoxOiJjIjtpOjE0NjcyMDU2NjM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467205663),('0ff3b9a75a4c00cda7b20f01bf678dfbf400fd27','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVFUcjJtZjhpMTdINkdQb1ZPMjRnMlA3RjNvOTFLS2VYbDBiaTZOdiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDk3NjM7czoxOiJjIjtpOjE0NjcyMDk3NjM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467209763),('16a9ff3fb679714da42bc3cd145f1421a112536c','YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGg5QXBrS1NSNlcwYlhqZWNKUm1NdnQ4TlFNRFRia0dJVGhxVTJEVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY4MTg5Njg7czoxOiJjIjtpOjE0NjY4MTg5Njg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466818968),('185394c82aab587b60758cbabfa33224db15be40','YTozOntzOjY6Il90b2tlbiI7czo0MDoiblpNTnJGQ2JTb0U4MkF6cjFvanVyTzV5V05LRzlQYm40d3ZiWUc3NSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDU2ODk7czoxOiJjIjtpOjE0NjcyMDU2ODk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467205689),('189e4087a15e8c77dbd22d2237b1504d94b1e4b6','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFhhTjZNaDNucWk0V09MVkt0T3ZKdjVKdUtGYVFxT0s4MUhzdGpZcCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyOTI3MTE7czoxOiJjIjtpOjE0NjcyOTI3MTE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467292711),('1a1b16655e6c27e9eb66242a207d09775b83cb63','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXVzNlRoVURJdVNYdmR3R2hmeWd3YXRhTEpPb3BIZnJISERkVkd1SSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NjIyNDE7czoxOiJjIjtpOjE0NjY3NjIyNDE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466762241),('1c959c5774eb12f183b995b90e010ebe97a63879','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVRSQldGNGtBY3ZsTU52Mk0zNEoxMklCWU1zdWZHSngwZmNCMmt1ZyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcwMjcxODI7czoxOiJjIjtpOjE0NjcwMjcxODI7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467027182),('1cd4719c524278b03644e3144baecb97697ae647','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQVUzY2JkcVpKZWZvcFdYTFp6ZHptNXFtSmVqU0NCeTVOYm5wRGVkbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyNzA0ODA7czoxOiJjIjtpOjE0NjcyNzA0ODA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467270480),('1d448f497a5a854e16b5d1db154f0d8f2aca7729','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRkZNem9yYk1ITFRZQ1REUXdwdVpPN2xza1hsWTNDZ3dUNjJtbWFOTCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxODM4ODU7czoxOiJjIjtpOjE0NjcxODM4ODU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467183885),('1eb2fb58b2b4d5ea6e7d0f2d3102370d1ae5a31a','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVhPN0hnN1I5elAzSEhjVUZnN2RWSHV0MDUzdFo0RkVlTzdKOFlBRSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDU5OTg7czoxOiJjIjtpOjE0NjcyMDU5OTg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467205998),('204fd3af21995adc2fb16ddc4d42dfba37fd94ec','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOHl1WldjMjNVR1dhdXZqTVhXdzNOcml1b1BRdGpKcEZ3TTRTOURmdCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NjE4MzA7czoxOiJjIjtpOjE0NjY3NjE4MzA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466761830),('25c0992d0cc2cd26424d47acd6feb24a3d69b005','YTozOntzOjY6Il90b2tlbiI7czo0MDoia25rOVI0S0pCSm5udHVPUXlwNmpGR3FnMTQ5ZDhkanUxSkZjNkdOeiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxMjM3MjY7czoxOiJjIjtpOjE0NjcxMjM3MjY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467123726),('26130713e3d06c2e4c1be983969951fe3c94ad76','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQmZFQjZLWkxoR3NGNnVvbGhPejBQMHlZWk5pYmxqdFBXbXVXdzBCRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY5ODAxNDQ7czoxOiJjIjtpOjE0NjY5ODAxNDQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466980144),('2746eaec7077d40747a82979b420c6b9f39de07b','YTo1OntzOjY6Il90b2tlbiI7czo0MDoib21EMXBoazZ4VHBSVHkxczhFb0g1MDF4RHRLNlhPN2d1UlVRdEpzOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1L3Byb2ZpbGUiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6Mzg6ImxvZ2luXzgyZTVkMmM1NmJkZDA4MTEzMThmMGNmMDc4Yjc4YmZjIjtzOjI6IjM2IjtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQ2Njc1Mjc0MjtzOjE6ImMiO2k6MTQ2Njc1MjYzNztzOjE6ImwiO3M6MToiMCI7fX0=',1466752742),('29d6fa5844c3a6c46e76c9a1609995e49e1c77dd','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOFdLMm40b3B1bTY3NG5sRkk0M1hYUW1EQmNIeUFNSFVaNTFIMm82USI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY4ODI4Mzc7czoxOiJjIjtpOjE0NjY4ODI4Mzc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466882837),('2b87d105e076671f5b1e33a0fe939fa22ea54e92','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVY1VzM5Y2VsZXRLU1pXRFhoRE5VMUN1bEJBbFk0OWdFU29MMFFCNiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY4ODI4Mzc7czoxOiJjIjtpOjE0NjY4ODI4Mzc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466882837),('2ddf7b4a256d7318e7cb2c48d65765ede66f52d3','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGpIUWxRQVRGdU1wNVVSZ3JBOTM0R29KZ25DMGlhNDFyV2NoWUl3RiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDk4ODY7czoxOiJjIjtpOjE0NjcyMDk4ODY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467209886),('331b2a972d9d52d2ea832a873680617b47fdd6fe','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjNlN1dpSWNXUVhpdHo5SVd4aVh6WU1MY3BtaDBkRjBLN1JWRVkyZSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDk1MTQ7czoxOiJjIjtpOjE0NjcyMDk1MTQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467209514),('3468351c144f0eb7a1b7efbad54159d22d2b0d8d','YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0ZBRWlodmJGM0s5RE43R01PMWlvYkEzYllXUkJqQjVkTE9OV1NoUCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxMjM3MjY7czoxOiJjIjtpOjE0NjcxMjM3MjY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467123726),('3c0492d2ce3693898d74b98cdb5d421b14b4a4be','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUJTaERBanBucGNldnVLTmNyTU1JbG80WGJRb0xNUWhpN2owQlBCOCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxMjM3MTA7czoxOiJjIjtpOjE0NjcxMjM3MTA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467123710),('3c431473ac55abcb107c86f474bae52d68b4b4fe','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnZ5ZzUzSjYzbXhBMXZnaDVQczZIQkRSa2hLNVZuNkNXeTNMV05ZdCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NjIwNjQ7czoxOiJjIjtpOjE0NjY3NjIwNjQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466762064),('3ecb75783493338b6e0bb7e4c398631183acd977','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM3pNN2hmaUZvWjFEdkxJR05zdnBTTnB6UjVMMGRrRlIxdTdwaHVIVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyNDgyMjM7czoxOiJjIjtpOjE0NjcyNDgyMjM7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467248223),('40940f60c8bb2bb72c1d6910a20b3f5cb7bbe51f','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOGRwbEZ4M1NLMTBJY0E4V0xadHNHdlZOZzRLVEJJeWE4NzF4akFZbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY4NzMzODg7czoxOiJjIjtpOjE0NjY4NzMzODg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466873388),('42d6a5971428ee8c1e71376ff35db36029ced7d2','YTo0OntzOjY6Il90b2tlbiI7czo0MDoic0JLSEo5Wlkyak1Fb3VFMEFYQWFZemdXT25RTW9TZDN1dXhkQzNjUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcwNTI2NjA7czoxOiJjIjtpOjE0NjcwNTI2NjA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467052660),('49049f870ea98cb3036789ffbae5bcf0b437564a','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzI3blNmbDV0d0Z2RExQTng2ZlQxbms0bFZrelRqZlQ5RHMyYkNqZyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzQzODQ7czoxOiJjIjtpOjE0NjY3NzQzODQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466774384),('49633f18ad982513949850104f7ec3f4eea45645','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM2R4TU51NUFUZjFSWW9sZ0FaQXR6MkJIZHRJOGxoNGVKMFRJdXM3biI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY5MDAzNTQ7czoxOiJjIjtpOjE0NjY5MDAzNTQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466900354),('4cfa6aade2dab9095ece398d96beaf08a3e7ee1f','YTozOntzOjY6Il90b2tlbiI7czo0MDoidEVDbWdkSlhMMUxha2x4MmdxeVl5cFB1VUFvQUJ2Z1FqUVdrT0x3NCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyOTIwNTc7czoxOiJjIjtpOjE0NjcyOTIwNTc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467292057),('4d7cba8ab0f2bd8c2b171d1d6bd6e2a4da854de5','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDBmMDF3THRYMEpWdUZ2b3dYNjZ5VmQ5YVpXc1NTUGhsTDNBSDZ2SSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzU4NDU7czoxOiJjIjtpOjE0NjY3NzU4NDU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466775845),('545ea95fc2bc02dd8569cf954ee61898571698b9','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWWYzbUUxSTllclBUQkxVMUFZRVlOajBiV0xJNGM0ekpkanpaaTRsdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcwNzQ2NDc7czoxOiJjIjtpOjE0NjcwNzQ2NDc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467074647),('54cc796e9d57cb62903957c5b8f10f87f87ea598','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTU45S0NXdnVab3RJSDlhbXpqWmhrQlAwcE9teFVaZHR0ZHgyRnQ4QSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzU3NzA7czoxOiJjIjtpOjE0NjY3NzU3NzA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466775770),('56c3aadb7ae7234e1f08535708305436f5e0c4b4','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS1phWDlxbDcxOHdOcjdxRkV2WE5ZeFFvNXZiUGZFdzZITTJqSThvZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyNDUzMzc7czoxOiJjIjtpOjE0NjcyNDUzMzc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467245337),('57aa0d612e0de1122fe5dd59a8f97c050974420e','YTo0OntzOjY6Il90b2tlbiI7czo0MDoid0phdVlnY2ExZkRiT2dCWnV0UzFBN3l5VmNsbTRkb3pnYXhUZm5wRyI7czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO3M6MjoiMjQiO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDY3MjkyMDQyO3M6MToiYyI7aToxNDY3MjkyMDQyO3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1467292042),('59df9de49e067b7f6bed9e4f37f37998e720c1da','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNHJsQ0JOSlJ1TlV1ekJOUHpqZnVIdm1BZGZqNjVjNXVkVjVpNWIyQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMjQyMjU7czoxOiJjIjtpOjE0NjcyMjQyMjU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467224225),('5fa169d4f3370825f7691a8bdd30b3c830865236','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHVIcURSZmZobFNSUExIMHV6MmgyTDF3Y09renZEQzZpRUNMT2dCNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcwNjYyMDQ7czoxOiJjIjtpOjE0NjcwNjYyMDQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467066204),('6711f7ec7980f3eb62e7ca20eb2a82362b76f5ba','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMnZnZzV0anJJM0FHT05KVnY3Q3pWN2pMVndPeWM3NmxZYlRMUHl1cSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY5MDc4Mjc7czoxOiJjIjtpOjE0NjY5MDc4Mjc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466907827),('6876a488d3892f1cf414cc23ec7bfde6744a4c4c','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmlRWW5XWXBNT1h0VnVMV1Z5cEI1RkZQWGxhQXlhcndlNW1RdzI4RSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxMjM3MjY7czoxOiJjIjtpOjE0NjcxMjM3MjY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467123726),('6b7db22112b31bca5574c89840062cb6dce4dae2','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVzB0UVlWaFN4b1RxWjRPdEFQMjhKcHQ1SWp3dnlOZzc0ZFRkVnAzOSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NjE4Mjk7czoxOiJjIjtpOjE0NjY3NjE4Mjk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466761829),('6e6c5435cf3dff7a2f09a967b732f44a9f1176d5','YTozOntzOjY6Il90b2tlbiI7czo0MDoiejV0RUc1RGpjVXhMWFRiSklpazg2ZkR5ZjFIVmhmQmZBTWJwVTk5YSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NTc4NDk7czoxOiJjIjtpOjE0NjY3NTc4NDk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466757849),('73c989c436025ef851447ec09c2b5453fbb1e724','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN3dSWVptdWZsNEduNjZiakg4VFlSYU1vU0lPcklsa3lEOHFCUGJMbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxNDI4ODU7czoxOiJjIjtpOjE0NjcxNDI4ODU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467142885),('761510944ba31b14c1fbf1a011c75b8a7b5bf4f2','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjA0U0JGU1B5eGhYMnpQVnhreVJXMFg1QVBKSUZtTzlzMW9aZm9XTCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxMjM3MjY7czoxOiJjIjtpOjE0NjcxMjM3MjY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467123726),('764ae86665629fa9867f0a6b528d1e6418c7d2fd','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZFNrSmw2ZXFrR1lpanZwUm5JZ0N5VFNOa05CZXZWY2wwelVGaVd4aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcwODQ2MTk7czoxOiJjIjtpOjE0NjcwODQ2MTk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467084619),('7828284a44a1344e20b10ddea7f3a72807031018','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnlzdlE2VmNCMzB1NGExUTA2Umdrb1JlUjZTdnZJSHFidjhVNHVOOSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzY3NTA7czoxOiJjIjtpOjE0NjY3NzY3NTA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466776750),('8231504b378dd6bb6a2d0bea3886758ca0fcc021','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGhLbXd4RXpsa3JJeGY5TERPVFNIbVY2bmJmaVpvbU45MXhtT3VqeCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDU2ODk7czoxOiJjIjtpOjE0NjcyMDU2ODk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467205689),('89b02361515ae2e6df1ada30cf77fc553b411a7e','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXVObXVEVnVPOTNMb3g2aGFieVVrZDA4UVJ2alpZbk1wNWRodnVQeSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxMjM3MTA7czoxOiJjIjtpOjE0NjcxMjM3MTA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467123710),('8a7449af77aa425f1136d126c328a3ba08b5be02','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZGJqWEFWN0wyVjRzNlljWGZ3dkk0RVE0dWIyWDh2TnFiY2w5dHNHayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcwNTQ3MTE7czoxOiJjIjtpOjE0NjcwNTQ3MTE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467054711),('9173ddb9eff5e906381bc215b482359a39ca0067','YTozOntzOjY6Il90b2tlbiI7czo0MDoid0hUUXJYWDluVk1KUXRRWU5JZ1QwNXZlV2NsTHNLbjRDNWZaVWJRdyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcwNzE3MTI7czoxOiJjIjtpOjE0NjcwNzE3MTI7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467071712),('9204f62da5eae0bdb04e5a18bc3425d18077a8f5','YTozOntzOjY6Il90b2tlbiI7czo0MDoieXN3SXJxcXhwY3BZdWZ0OWtjODRCN0ViaHNWb3BWMGQ3ZzRrV3dGciI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NjE4Mjk7czoxOiJjIjtpOjE0NjY3NjE4Mjk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466761829),('946b5ce63a072daad1c3600e4b53ee6759c5159f','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiME1XYUJiZ2wwNVRQWDdONjloODlycDJ4MDhOOUtjR2NVUXNiTEd1SCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxODM5NDE7czoxOiJjIjtpOjE0NjcxODM5NDE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467183941),('9473b922af5e513743176d4488cceaf628f3a0b1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVg3UzYzdUV2QU5oRGRKU0M1ZXg4TWRaS2s3ZmdMblViWnFwZzA2dSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NTg3NTk7czoxOiJjIjtpOjE0NjY3NTg3NTk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466758759),('992e5568e22a4e04b0b51088b07344177defdee9','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWmZLSmpGM25lSG45WldXdlRrUHA0Y1N4RGR2ZlFFYlJ0Y0hPSzVDSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY4OTM4MjY7czoxOiJjIjtpOjE0NjY4OTM4MjY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466893826),('994dc8235e49192bfd30b97de8ba26d7972792f4','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVBrVTkyMG1pcjNSaEQ1VktlOHIwVzNDeDEzbWlZcENXUEtJc1A5NCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxMjM3MTE7czoxOiJjIjtpOjE0NjcxMjM3MTE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467123711),('a49c61e8d36587eecbd7b77fed0fe45129ffdac1','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiczRjZ1ZtT21wQ2JGV0FQb0xXcmozaGlzVE1IOWtSMFhLdnFWY0F2TyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY5MzA5ODY7czoxOiJjIjtpOjE0NjY5MzA5ODY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466930986),('aa5bb84063f245a1e88994565abca908faaafd69','YTozOntzOjY6Il90b2tlbiI7czo0MDoibGhqMUtmY1l0dEF3ZWZqNEVmQm5CWjlHdjJ5aVRnaXRxSVhnanRQYiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDY4NDg7czoxOiJjIjtpOjE0NjcyMDY4NDg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467206848),('ad1f18a7f9f79602884ef39bf162818fe0558abf','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRUF1UmlGYzJnUmV3dGd3U2laeDRuRXVsbHk0RFlleVNRUkcxM3JpayI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDY1NzU7czoxOiJjIjtpOjE0NjcyMDY1NzU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467206575),('ae2073077ec4751821ced0f8b89d59f7d7167256','YTozOntzOjY6Il90b2tlbiI7czo0MDoiamR0QW1XZHNoZTBlMDM1aDBIRmpSUHlQeHZUd21JVTBnOE81SGJBOCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzQ5MjE7czoxOiJjIjtpOjE0NjY3NzQ5MjE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466774921),('b1676e57fdb78628e94c9a83c96b9ecf35d2e1fd','YTozOntzOjY6Il90b2tlbiI7czo0MDoidWh6S1JLR2ZqaFFaUFpzb0Q5dzVjRVJsZ2V5WXp0WFluVDB6M3NVYiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyOTIwNTc7czoxOiJjIjtpOjE0NjcyOTIwNTc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467292057),('b4b86f7f2b37716531cbc8bc349e1d7ce68b8ea6','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSWN2RjJteUV5Y05LRkRyV0VsczlLUmFYa3dZYVQyb2x5Qmc5TWlBbiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzQ0Mzg7czoxOiJjIjtpOjE0NjY3NzQ0Mzg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466774438),('b74d802ad3e17d1a523648e5001852968bade488','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMmVQZk40cnIzaWJlazJjWERPcFREWXlQRG1GWEFLd3RLcmRnc3dmaiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NjI0OTg7czoxOiJjIjtpOjE0NjY3NjI0OTg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466762498),('bdc7aeb640292cbcde5f2b20b1ba9590b7d6d06f','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0NoYTIwbXVLRVhZZFhjMlFoaThMY00zTVpld21QaURkUHdLSXRIRyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzEyNjE7czoxOiJjIjtpOjE0NjY3NzEyNjE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466771261),('bec5a5bbec399305a2bdb1546461ce06c0fa4018','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjB3ZmFUUFlXUkJUc1Z6Skk0QVZISlV2UldIT1o2SGQ0V3dnY2xkeCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyOTI2NDQ7czoxOiJjIjtpOjE0NjcyOTI2NDQ7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467292644),('c5d4bce499af54a464ea5ffa4ae9017d4d12fea2','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXNmdnJqTHh1RlRvR0RkbVloaFNOdFhsa1l1WTRIdmZIdWNsdUIwbyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMDk3NTI7czoxOiJjIjtpOjE0NjcyMDk3NTI7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467209752),('c96a330e2c121fe79c91c21b2545cb43a93d16ea','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVVVWTJ0V2RQQ3d2aG1Vd2tSRUQzb3RlSVQ3UXFTMkxaVU1SS3VEUSI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzI5MDY7czoxOiJjIjtpOjE0NjY3NzI5MDY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466772906),('ccf4ea58284f492421f6b95ce5847911300efa71','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNlJ4dGZzTGo5emwwRkVveTB2cGJlOHczbk1TSGd3dDVzY21EVWplcyI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY4NDE3NDI7czoxOiJjIjtpOjE0NjY4NDE3NDI7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466841742),('cd7824b2427de72266247be13d788afedb0171bc','YTo0OntzOjY6Il90b2tlbiI7czo0MDoieFREaThNRUoweWpsbEs1VmhKUU5nNmVlVWswd2g1Y3lWaWViaDBYdSI7czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO3M6MjoiMjQiO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDY3MjA5NTQ5O3M6MToiYyI7aToxNDY3MjA5NTQ5O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1467209549),('cd89355fcbd096c1df737e205482f850ad560d8e','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibHhzUXd4bTZLS0JuZWRtMldLSnJFOTJUVkJ2NkQ0RUlyRDZ0b096TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcwNjE1MDU7czoxOiJjIjtpOjE0NjcwNjE1MDU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467061505),('d0ed8f7286a834ea17554618e4ef431efa2e2ba1','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiamNhelFrb1JuSkFxNElQRXQ4aTRMNXhTaUNrNHdadklkNWxOY2JQNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMzMxNDE7czoxOiJjIjtpOjE0NjcyMzMxNDE7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467233141),('d7421dea3a4faccd9f1ff93f1063f289b04523a2','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRlo5V1NvYlNFWVIyc3Y1WkE4NWY3Nk1ONXhNT0d0bWtnZ0lXc0x5WCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY4NjcxMjU7czoxOiJjIjtpOjE0NjY4NjcxMjU7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466867125),('de8d589ca1338bb9cc8d8888c80a1d467ca9927f','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiblQ5Z3hQSkJhT0Y3ekcxV0VGbXZjS3ZWT2JOamNlZlJ2SFg4alBiNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY4NTMzNzk7czoxOiJjIjtpOjE0NjY4NTMzNzk7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466853379),('df9994ac46835fe5787e5dc4b45dfdbfd4644239','YTozOntzOjY6Il90b2tlbiI7czo0MDoiODduWHZvbFdTdU44MHhaSmNDWHZ1SkhWZXJmMjBHcmUwY2JzcEtidiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NTgyNzc7czoxOiJjIjtpOjE0NjY3NTgyNzc7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466758277),('e98b26a6e2c6a2208c8d698ae8605448b619341a','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSGNSQkNLaFh4bEJtZDlGMVltT0d0OVV5cTN2TE9RcUxNREppN1ZyciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1Ijt9czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcyMjI5MzA7czoxOiJjIjtpOjE0NjcyMjI5MzA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467222930),('ec241207ef50f78296032f767b19ea3e578aa6a3','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidWR0THR6RzlNM3pncEllbTZreTNTWXlFUG1rc242TUtBdEJTSWVwaCI7czozODoibG9naW5fODJlNWQyYzU2YmRkMDgxMTMxOGYwY2YwNzhiNzhiZmMiO3M6MjoiMjQiO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDY2NzYxODI3O3M6MToiYyI7aToxNDY2NzYxODI3O3M6MToibCI7czoxOiIwIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1466761827),('edeaae1388f5ae4dde1732f181d0edf8c9dafa2a','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN2lkM01lOU9INVg1TUt6RzhHWk1xNjRmVTJvVnJaenpkZEVCaVFIbiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxMjM3MTA7czoxOiJjIjtpOjE0NjcxMjM3MTA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467123710),('eeffc9148817679d41e8388bc279d77c62fc4697','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNUlpTXhmT1N1aVd0Z1NuUXM4QjVRR0hsaDZmaVgzNEpiaFFhVjJxWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly9jc2dvd2lsZC5jb20iO31zOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQ2Njk4NjgxNDtzOjE6ImMiO2k6MTQ2Njk4NjgxNDtzOjE6ImwiO3M6MToiMCI7fXM6NToiZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1466986814),('f31cc7a07e8fa7fb84b3ded0d330d8b837c73b32','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaW9EU2NrRDlvcWdEd2pic291czJxaXBxYlZZMUk4Qlc0S0hKNHZuciI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjcxNTM4MDA7czoxOiJjIjtpOjE0NjcxNTM4MDA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1467153800),('f34d3c24b7cc44d03d2304b729320d98a9a3f218','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMzFMWlBYRVZPRDN4ZDA3dzEzSjFnTzZSTzU1TEQ4ZkJoVm9QVFVkNCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzM4NTY7czoxOiJjIjtpOjE0NjY3NzM4NTY7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466773856),('f57a146bf14c05f10957b7edf7224aaae7b493c6','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMHlicXZBa3NZMDdodnZwdnRPQk55ak9xbEwyUFRuRHEwd1JZc3JHYiI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NjE4MzA7czoxOiJjIjtpOjE0NjY3NjE4MzA7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466761830),('f76227de8ef2c3ffb53fc5d997a65a2173855b16','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYWhmeXNqS3puOXlHRTJUOEg5UHlUdHNuOTdDcGZ3YjlpdGR2bDVGZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1L3Byb2ZpbGUiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6Mzg6ImxvZ2luXzgyZTVkMmM1NmJkZDA4MTEzMThmMGNmMDc4Yjc4YmZjIjtzOjI6IjM2IjtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQ2Njg4Mjk2OTtzOjE6ImMiO2k6MTQ2Njg4MjgzNztzOjE6ImwiO3M6MToiMCI7fX0=',1466882969),('fbd8185f2208e10b2a7b4ac714b10578b5cef8df','YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3ZoNUdhVWR3YUxndDZraXBGYnUydkg5Q1FIMHdGdk50TnhBUHdJUCI7czo5OiJfc2YyX21ldGEiO2E6Mzp7czoxOiJ1IjtpOjE0NjY3NzI4Mzg7czoxOiJjIjtpOjE0NjY3NzI4Mzg7czoxOiJsIjtzOjE6IjAiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1466772838),('fe5d5a9a01da68f96e785b7a7661c630c48d03e7','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR2dyVGUzVXhEWnRPYVJqdmlYYnNQY01yMVJ0NE9paGdMT3Y4V21lbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly80Ni4xMDEuMTg5Ljg1L3Byb2ZpbGUiO31zOjU6ImZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6Mzg6ImxvZ2luXzgyZTVkMmM1NmJkZDA4MTEzMThmMGNmMDc4Yjc4YmZjIjtzOjI6IjI0IjtzOjk6Il9zZjJfbWV0YSI7YTozOntzOjE6InUiO2k6MTQ2Njc2NTEwNjtzOjE6ImMiO2k6MTQ2Njc2NDk3MTtzOjE6ImwiO3M6MToiMCI7fX0=',1466765106);
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
INSERT INTO `users` VALUES (2,1,'bojanproba81@gmail.com','$2y$10$Tay/ppyVxEhibD13oOQ9eO5jBT7Th91Z9JbsiiCMHDCaKfkWuwGcG',NULL,0,NULL,NULL,NULL,NULL,NULL,'Bojan','Popović','2015-03-31 22:00:00','2015-09-28 11:58:18','Z0n5eI9uf3qy1XYBJhmowRNJk0ssRwdxSJlDn9Q9LPNK6rzqV1YQIfMtLGHA',NULL,NULL,'Bojansaa','sdfsdfsdf',NULL,2),(3,3,'idemo@email.com','$2y$10$aiuU6uZt5P3jpk61rOY3Red.7WefuoQacCP9E0VrLBMT6WFvpBE4O',NULL,0,NULL,NULL,NULL,NULL,NULL,'Pera','Petrović','2015-04-27 09:50:37','2015-04-27 09:52:41','bhlLiONrNx3AQzgrA53lfLSYZZDMqdkK5HsS5RNyv0ioNG37wwBLlfuAHobH',NULL,NULL,'aaa2','aa2',NULL,1),(4,4,'bojanpopovic81@gmail.com','$2y$10$fdjTyMsZq4vkC.sAE/7APuBdwcm8biszMonLiNXgTHdEryyO4qvDG',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-04-27 09:52:59','2015-06-09 04:09:26','LYLxNuDKvWSHQiSvVqs4I2bfsbItTYVO6pOe1cQ2FCNJVpXMJmk1pkHmXbdH',NULL,NULL,'aaa3','aaa2',NULL,1),(5,5,'idemo2@email.com','$2y$10$U7M8LxoMjKi/vZ6uhpeGX.Wysz4ZhpkNJY4cSeNfSDHuN5MjTrDYG',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-04-27 09:54:51','2015-06-19 10:19:34','dAwmER1SeiV3dwi7dfkSFyyXvIRv9Zjy1PsPLPvwvB5ASG8Qyu5xpjBatCOv','8c4adf2b8b991af9e30aa28d2b4c38f3',NULL,'aaa5','aadsa',NULL,1),(6,6,'ajde@yuyu.com','$2y$10$qvxo/3DJ2tMgnVvqHiScL.Pf1JLtX9KQMPzwkxQJ4gjfKaAwdgj9O',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-04-27 10:28:06','2015-04-27 10:28:06',NULL,'cd4dd49e43b8b221acea7b6d7bd8b698',NULL,'aaa6','fsdff',NULL,1),(9,15,'retro981@yahoo.com','$2y$10$lc/z9MQ1zZlEHb0ICbO4xO3ojY3MCHHVsjF6.DrWPu0zXysTTBPPK',NULL,0,NULL,NULL,NULL,NULL,NULL,'Zdravko','Petrović','2015-04-30 08:37:05','2015-08-05 09:11:57','PwDSKskw0nzQ9fCmmKIcafXdQoi9PlSWla2oj1zYTkh1c9FuGf44CDXZiHo0',NULL,NULL,'aaa7','gsss',NULL,1),(11,18,'bojanproba8111@gmail.com','$2y$10$HvRAZh63KINZlmkV7rDEzuuphe4nS9E0exbtoY1uBeQWO1nyBpYAm',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-15 11:53:51','2015-05-15 11:56:45','XcRaCfDgXIiKsGM7Id9n0BJetAQFieqSCC8xpZ1TxZxIGve2VFQR4pbEe4cK',NULL,NULL,'','bojanproba8111',NULL,1),(12,19,'bojanproba8111@ajde.com','$2y$10$oiyQeS8MCrPHeraCdmoRKufIP5TTy5UhGeJkhxdDRLDhiSdBc18cO',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-15 11:57:37','2015-05-15 12:01:47','46WNvRxzW49AyInhTnW0dTeqIdx27Qn9PABkiUnbRHl1l97nP1xD4Y3UlEJU',NULL,NULL,'bojanproba8111','bojanproba81111',NULL,1),(13,20,'bojanproba8111@nekidrugi.com','$2y$10$lc/z9MQ1zZlEHb0ICbO4xO3ojY3MCHHVsjF6.DrWPu0zXysTTBPPK',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-15 12:16:20','2015-07-22 07:50:56','LN43H9ogTDMtU9Lfos5lJe0b0zT6Wm9trZSySh1F8Vcv5XyZTQRrgXNEeOkL',NULL,NULL,'bojanproba8111','bojanproba811112',NULL,1),(14,25,'bojanproba81@gaamail.com','$2y$10$FRnUw.l4vfc33Wt7xtkuqeW83tW/D0jPfZYJx5ziN3Ly3SZlmkFEm',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-19 04:36:29','2015-05-27 11:32:12','iDSM6NkgIvsoFTWEyZPapYMCsDILt5dbdqRptkLzV4J5ZcHiJ63Qd59Q3nLB',NULL,NULL,'bojanproba81','bojanproba81',NULL,1),(15,26,'bojanproba81@gaam23ail.com','$2y$10$wG7IBD8dOIkr.RQeuZmg.OgwlEnUgNOI43aAiq0cPxo47Cnvx5Hp.',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-05-19 04:41:33','2015-05-19 11:36:12','ikKVrciP4tIQR0gxeQWdShqtNKQjng2DtXcWGF0FQMPOX8vlZZPL044CECmY',NULL,NULL,'bojanproba81','bojanproba811',NULL,1),(23,34,'blabla@idemo.com','$2y$10$L4l8SEw.jmMnY9rfgrDEguLwlA0C89.zThrhK7/fyXO4CivO45zZm',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-08-03 05:28:52','2015-08-03 05:28:52',NULL,'8514dccbdfee3c84165ec611e35290c4','123314234','blabla','blabla',NULL,1),(24,35,'gaboroki2@gmail.com','$2a$06$dkzuAX6/omTwr9J0RSJn2.JF10wdaJ5S73000EDlFfAibAelZVow.',NULL,1,NULL,NULL,NULL,NULL,'j7Z8eFqXfkXGCPrNxkXmwFvsB5WLdK442gRHX0bGHfOKWSZ9ImEriLi3e9tY',NULL,NULL,'2015-11-25 12:44:41','2016-06-30 17:07:22','eR4FAmdzqAjwSOMogiWBVOCixRPRcbSyjqOBqVtD6xO66jZw2DfyuSQK2TyN','ba48cc4a462999096de1bead812d21d6',NULL,'gaboroki2','gaboroki2',NULL,NULL),(34,45,'milosh.diklich@gmail.com','$2y$10$yQLkqgndikz6sxSg5h75jOuYHclXaNZxK/7x8XZbnO4X.OVtq/N.S',NULL,1,NULL,NULL,NULL,NULL,'t92pOWg7dI34eupIL50xu4WzEnxntzuYf88PrEaG7Kx4yJzLZZe8ZxKY8w5W','Milos','Diklic','2016-05-22 18:56:43','2016-06-06 11:29:17','t92pOWg7dI34eupIL50xu4WzEnxntzuYf88PrEaG7Kx4yJzLZZe8ZxKY8w5W','b5ca10fb1c6fa2a0245207d3a324bdaa',NULL,'milosh.diklich','milosh.diklich',NULL,NULL),(35,46,'dusana05@gmail.com','$2y$10$haAIYptEP8o5g.Q7EAFuUOG1scJrPmuHM.4Mb6X.flKOWfqBRYQhi',NULL,1,NULL,NULL,NULL,NULL,'mIZKaUY6rvGzRmk7GHL1yllikjWN7nZvsb30FwTtLsbf0uLJFK6BsOYNVx2t','Dusan','Adamovic','2016-05-24 10:23:39','2016-06-05 22:06:03','mIZKaUY6rvGzRmk7GHL1yllikjWN7nZvsb30FwTtLsbf0uLJFK6BsOYNVx2t',NULL,NULL,'dusana05','dusana05',NULL,NULL),(36,47,'bojan@piktogramstudio.com','$2y$10$u6Cuq1Q2.XBaTsJ3DIoHgep1v/AHP4MU3JjErNGc5gZ81Lpq23kU6',NULL,1,NULL,NULL,NULL,NULL,'f25rdmnaajky3iddcsk41maz6npbd9p5zunb6u9s97sx6fh7gpmhm01feylilsp5xqqotxnixkomcw1wtzorz6xf9ovd7k8shidl','Bojan','Mitrovic','2016-05-24 21:49:55','2016-06-23 11:13:12','dG6YXd54xg7zcm9heyq7JdGFQ6fgy9bPMAVS8t3frwGKAKwtpFXcSGz9X9Zf','ba7ea5ad420066c02dccc2b84e7bab89',NULL,'bojan','bojan',NULL,NULL),(40,51,'dusana02@gmail.com','$2y$10$PAZD7TTB0XyNrsR0D23ffOHRkSiaWACESphf/Hw6Y2NRhL4yUXO4C',NULL,0,NULL,NULL,NULL,NULL,'f25rdmnaajky3iddcsk41maz6npbd9p5zunb6u9s97sx6fh7gpmhm01feylilsp5xqqotxnixkomcw1wtzorz6xf9ovd7k8shidl',NULL,NULL,'2016-06-09 13:47:33','2016-06-09 13:47:33',NULL,'8d6232df986c0c97062c91d09efe3763',NULL,'dusana02','dusana02',NULL,NULL),(42,53,'sholeem@gmail.com','$2y$10$/k1iI2kXlWuRwh8BRXLCC.qBDT13RKlF5wzLSS.DawNc5GcSCIhna',NULL,1,NULL,NULL,NULL,NULL,'4vtami06qd4r6ldetw96hdzuym6wcwy8x1qtn5lc6nguzz935k54lqpzzbt7lkaadknwn5w8tgdbcbxjwg2auappfoyvuxmhyttd','Some','One','2016-06-09 15:57:43','2016-06-09 15:59:23','1rU49yLBT2z6g66Kj9w0WTXTBh5UYxZxMnKegFhFTXZAMh8riicdEd5adKgZ',NULL,NULL,'sholeem','sholeem',NULL,NULL),(43,54,'bojan_neskovic@yahoo.com','$2y$10$2c/W0qYA7u/fLbUbOcwFcedcGu9r0TfTG6AIPDPyEBmSe6QP7xlRy',NULL,1,NULL,NULL,NULL,NULL,'reynyf1q3o7oefhu2txqthvosw12q5fq6tb0h26fav1rya997n035cilt1ftpq252ih4o6y4x0bssqmt3p21l7v0antatjkk8blm','Bojan','Neskovic','2016-06-09 21:58:38','2016-06-16 14:45:05','dOl6oXAJfuJC83u5TtsCZaITlpBP2T36sTj8m7fW22riNxLBGzLPWibWEhtx','94913bec599ad3b6c5285e6949528f48',NULL,'bojan_neskovic','bojan_neskovic',NULL,NULL),(44,55,'prognanici@gmail.com','$2y$10$PzQvyfGea2G3n9kOpiHxhuZDoNuXGQYiFvBILlpllHX.Uj/WgOr2m',NULL,1,NULL,NULL,NULL,NULL,'sfpc7yneuxmdsxvh9o8f9mufauakit910j7jz27n9474agskvgoud88tko8zql3ft4xjtfwceqz7ylfframvuxf8cj5oadwljswr','Aleksandar','Ustic','2016-06-16 12:40:46','2016-06-20 19:12:57','Q24g4FOshF7kis1LP9xIobdpsFiP18gJiP2t8msTViJTHz5f0cyNpPKMIXDz',NULL,NULL,'prognanici','prognanici',NULL,NULL);
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

-- Dump completed on 2016-06-30 11:32:30