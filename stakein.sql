-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: localhost    Database: stakeina
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_languages`
--

DROP TABLE IF EXISTS `admin_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `is_default` tinyint NOT NULL DEFAULT '0',
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_languages`
--

LOCK TABLES `admin_languages` WRITE;
/*!40000 ALTER TABLE `admin_languages` DISABLE KEYS */;
INSERT INTO `admin_languages` VALUES (1,1,'En','1603880510hWH6gk7S.json','1603880510hWH6gk7S',0,NULL,NULL),(19,0,'English','16414442159c07jg2c.json','16414442159c07jg2c',0,NULL,NULL);
/*!40000 ALTER TABLE `admin_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user_conversations`
--

DROP TABLE IF EXISTS `admin_user_conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_user_conversations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user_conversations`
--

LOCK TABLES `admin_user_conversations` WRITE;
/*!40000 ALTER TABLE `admin_user_conversations` DISABLE KEYS */;
INSERT INTO `admin_user_conversations` VALUES (14,'Message',60,'Please check my message','2022-02-09 12:10:44','2022-02-09 12:10:44');
/*!40000 ALTER TABLE `admin_user_conversations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user_messages`
--

DROP TABLE IF EXISTS `admin_user_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_user_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `conversation_id` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user_messages`
--

LOCK TABLES `admin_user_messages` WRITE;
/*!40000 ALTER TABLE `admin_user_messages` DISABLE KEYS */;
INSERT INTO `admin_user_messages` VALUES (41,14,'Please check my message',60,'2022-02-09 12:10:44','2022-02-09 12:10:44');
/*!40000 ALTER TABLE `admin_user_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint NOT NULL DEFAULT '0',
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin','admin@gmail.com','01000000000',0,'P0D6FZt61645515306.png','$2y$10$NSxBfIBeDdxRjisT83p/0uN4GN4LcbYvKzuazAfyekwPffExwBUpO',1,'CmnEZYrO8S6We3LKX9FM4PAt1vz1STvnG52Y3GtGQLRPkRJlmAbbkq14FEbC','2018-02-28 23:27:08','2022-02-22 12:35:06');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (2,'Products','oil-and-gas'),(3,'Partnership','manufacturing'),(4,'Crypto','chemical_research'),(5,'Community','agriculture'),(6,'Daily Invest','mechanical'),(7,'Investment','entrepreneurs');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '1',
  `meta_tag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `tags` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (30,6,'RUNE Exclusive Campaign Winner Announcement','rune-exclusive-campaign-winner-announcement','We’re excited to the results of the RUNE, Ex users have the chance to win a share of the prize pool worth USD 50,000 in RUNE by depositing and trading the token.\r\n\r\nCongratulations to all the winners! You will soon receive an email from us.\r\n\r\nPart 1: RUNE (BEP2) Net Deposit Competition (USD 30,000 Prize Pool)\r\n\r\nThe top 200 users ranked by RUNE (BEP2) Net Deposits* wins a share of USD 30,000, with the Rank 1 participant taking home USD 1,000 of RUNE.\r\n\r\n*RUNE (BEP2) Net Deposits = Deposits From External Exchanges and Wallets on BEP2 (RUNE) + Buys (RUNE) - Sells (RUNE) - Withdrawals (RUNE)\r\n\r\nUsers can be rewarded for both Part 1 and Part 2 of the campaign.\r\n\r\nFor more information about the promotion, please visit our blog.\r\n\r\nNote:\r\n\r\nThe eligibility of participants will be verified by Crypto.com after the campaign ends.','B4Ny29lM1642483847.jpg','https://dev.geniusocean.net/geniuscrypto',2,1,NULL,NULL,NULL,'2022-01-18 10:25:51'),(31,5,'Crypto.com App Lists IDEX (IDEX)','cryptocom-app-lists-idex-idex','IDEX (IDEX) is now listed in the Crypto.com App, joining the growing list of 250+ supported cryptocurrencies and stablecoins, including Bitcoin (BTC), Ether (ETH), Polkadot (DOT), Chainlink (LINK), VeChain (VET), USD Coin (USDC), and Crypto.org Coin (CRO).\r\n\r\nIDEX is the first Hybrid Liquidity DEX that blends the best of centralised and decentralised exchanges, with the performance and features of a traditional order book and the security and liquidity of an automated market maker (AMM). Users benefit from not having to pay additional network costs for placing or canceling orders. Placements are also processed in real time, enabling advanced trading. IDEX is an Ethereum token that powers the IDEX decentralised exchange. IDEX holders can stake tokens in order to help secure the protocol and earn rewards.\r\n\r\nCrypto.com App users can now purchase IDEX at true cost with USD, EUR, GBP, and 20+ fiat currencies, and spend it at over 80 million merchants globally using the Crypto.com Visa Card.','yIQZFLYw1642483836.jpg','https://dev.geniusocean.net/geniuscrypto',1,1,NULL,NULL,NULL,'2022-01-18 10:42:55');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'USD','$',1,1),(4,'BDT','৳',82.92649841308594,0),(6,'EUR','€',0.864870011806488,0),(8,'NGN','₦',410.94,0),(9,'INR','₹',74,0);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposits`
--

DROP TABLE IF EXISTS `deposits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deposits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `deposit_number` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency_id` int DEFAULT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `charge_id` varchar(255) DEFAULT NULL,
  `instamojo_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','complete') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposits`
--

LOCK TABLES `deposits` WRITE;
/*!40000 ALTER TABLE `deposits` DISABLE KEYS */;
INSERT INTO `deposits` VALUES (131,'zYic1645339043',60,10,1,'USD','40082351718','authorize.net',NULL,NULL,'complete','2022-02-20 00:37:23','2022-02-20 00:38:41');
/*!40000 ALTER TABLE `deposits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_subject` mediumtext CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `email_body` longtext CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Invest','You have invested successfully.','<p>Hello {customer_name},<br>You have invested successfully.</p><p>Transaction ID:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span></p><p>Thank You.</p>',1),(2,'Payout','Your Investment is completed successfully.','<p>Hello {customer_name},<br>Your Investment is completed successfully.</p><p>Transaction ID:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span><br></p><p>Thank You<br></p>',1),(3,'Withdraw','Your withdraw is completed successfully.','<p>Hello {customer_name},<br>Your withdraw is completed successfully.</p><p>Thank You<br></p>',1),(4,'Deposti','You have invested successfully.','<p>Hello {customer_name},<br>You have deposited successfully.</p><p>Transaction ID:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span></p><p>Thank You.</p>',1);
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'Right my front it wound cause fully','<span style=\"color: rgb(70, 85, 65); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</span><br>',1),(3,'Man particular insensible celebrated','<span style=\"color: rgb(70, 85, 65); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</span><br>',1),(4,'Civilly why how end viewing related','<span style=\"color: rgb(70, 85, 65); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</span><br>',0),(5,'Six started far placing saw respect','<span style=\"color: rgb(70, 85, 65); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</span><br>',0),(6,'She jointure goodness interest debat','<div style=\"text-align: center;\"><div style=\"text-align: center;\"><img src=\"https://i.imgur.com/MGucWKc.jpg\" width=\"350\"></div></div><div style=\"text-align: center;\"><br></div><div style=\"text-align: center;\"><span style=\"color: rgb(70, 85, 65); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.<br></span></div>',0);
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `features`
--

DROP TABLE IF EXISTS `features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `features` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `features`
--

LOCK TABLES `features` WRITE;
/*!40000 ALTER TABLE `features` DISABLE KEYS */;
INSERT INTO `features` VALUES (8,'Add coins to your Wallet','Add bitcoins you’ve created or exchanged via credit card.','1639476553add-bitcoins.png'),(9,'Buy/Sell with Wallet','Enter receiver\'s address, specify the amount and send.','1639476522buy-sell-bitcoins.png'),(10,'Download Bitcoin Wallet','Get it on PC or Mobile to create, send and receive bitcoins.','1639476579download-bitcoin.png');
/*!40000 ALTER TABLE `features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fonts`
--

DROP TABLE IF EXISTS `fonts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fonts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `font_family` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fonts`
--

LOCK TABLES `fonts` WRITE;
/*!40000 ALTER TABLE `fonts` DISABLE KEYS */;
INSERT INTO `fonts` VALUES (1,'Rubik','Rubik',0,'2021-09-07 22:34:28','2022-01-17 13:07:33'),(2,'Roboto','Roboto',0,'2021-09-07 22:35:10','2022-01-17 13:07:33'),(3,'New Tegomin','New+Tegomin',0,'2021-09-07 22:35:23','2022-01-17 13:07:33'),(5,'Open Sans','Open+Sans',1,'2021-09-07 22:44:49','2022-01-17 13:07:33'),(7,'sanssarif','sanssarif',0,'2021-09-12 02:47:49','2022-01-17 13:07:33');
/*!40000 ALTER TABLE `fonts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `generalsettings`
--

DROP TABLE IF EXISTS `generalsettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `generalsettings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `loader` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_loader` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `header_phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `footer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_talkto` tinyint(1) NOT NULL DEFAULT '1',
  `talkto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_language` tinyint(1) NOT NULL DEFAULT '1',
  `is_loader` tinyint(1) NOT NULL DEFAULT '1',
  `map_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_disqus` tinyint(1) NOT NULL DEFAULT '0',
  `disqus` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_contact` tinyint(1) NOT NULL DEFAULT '0',
  `is_faq` tinyint(1) NOT NULL DEFAULT '0',
  `withdraw_status` tinyint NOT NULL DEFAULT '0',
  `paypal_check` tinyint(1) DEFAULT '0',
  `flutter_check` tinyint NOT NULL DEFAULT '0',
  `paystack_check` tinyint NOT NULL DEFAULT '0',
  `paystack_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paytm_check` tinyint DEFAULT NULL,
  `paystack_email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `stripe_check` tinyint(1) NOT NULL DEFAULT '0',
  `blockchain_check` int NOT NULL DEFAULT '1',
  `coinpayment_check` int NOT NULL DEFAULT '1',
  `cod_check` tinyint(1) NOT NULL DEFAULT '0',
  `paypal_business` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paypal_client_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paypal_client_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paypal_sandbox_check` tinyint NOT NULL DEFAULT '0',
  `stripe_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `stripe_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `flutter_public_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `flutter_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paytm_merchant` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paytm_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paytm_website` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paytm_industry` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paytm_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `paytm_mode` enum('sandbox','live') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_encryption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_user` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_pass` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_smtp` tinyint(1) NOT NULL DEFAULT '0',
  `coupon_found` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `already_coupon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_currency` tinyint(1) NOT NULL DEFAULT '0',
  `currency_format` tinyint(1) NOT NULL DEFAULT '0',
  `price_bigtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribe_success` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subscribe_error` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `error_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `error_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `error_photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcumb_banner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin_loader` tinyint(1) NOT NULL DEFAULT '0',
  `currency_code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sign` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verification_email` tinyint(1) NOT NULL DEFAULT '0',
  `withdraw_fee` double NOT NULL DEFAULT '0',
  `withdraw_charge` double NOT NULL DEFAULT '0',
  `is_affilate` tinyint(1) NOT NULL DEFAULT '1',
  `affilate_charge` double NOT NULL DEFAULT '0',
  `affilate_banner` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `secret_string` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blockchain_xpub` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blockchain_api` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gap_limit` int NOT NULL DEFAULT '300',
  `coin_public_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `coin_private_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blockio_api_btc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blockio_api_ltc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blockio_api_dgc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `vouge_merchant` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blockio_btc` int NOT NULL DEFAULT '1',
  `blockio_ltc` int NOT NULL DEFAULT '1',
  `blockio_dgc` int NOT NULL DEFAULT '1',
  `vougepay` int NOT NULL DEFAULT '1',
  `coingate_auth` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `coingate` int NOT NULL DEFAULT '1',
  `isWallet` tinyint NOT NULL DEFAULT '0',
  `affilate_new_user` int NOT NULL DEFAULT '0',
  `affilate_user` int NOT NULL DEFAULT '0',
  `footer_logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_account` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pm` tinyint DEFAULT '0',
  `cc_api_key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_coin_base` tinyint DEFAULT '0',
  `balance_transfer` tinyint NOT NULL DEFAULT '0',
  `two_factor` tinyint NOT NULL DEFAULT '0',
  `kyc` tinyint NOT NULL DEFAULT '0',
  `menu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generalsettings`
--

LOCK TABLES `generalsettings` WRITE;
/*!40000 ALTER TABLE `generalsettings` DISABLE KEYS */;
INSERT INTO `generalsettings` VALUES (1,'omb5BHGu1658315200.png','WMC12qIT1645514801.png','gpZA9XFN1645514866.gif','75TeeeNv1645514882.gif','1563350277herobg.jpg','Stakein - Cryptocurrency HYIP Investment Platform','Info@example.com','0123 456789','A place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.','COPYRIGHT © 2019. All Rights Reserved By <a href=\"https://script.appdevs.net/cryp-invest/\">CrypInvest</a>','#d7852e',0,'<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5bc2019c61d0b77092512d03/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>',1,1,'AIzaSyB1GpE4qeoJ__70UZxvX9CTMUTZRZNHcu8',1,'newspaper-7',1,1,1,1,1,1,'pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2',1,'junnuns@gmail.com',1,1,1,1,'shaon143-facilitator-1@gmail.com','AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi','EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE',0,'pk_test_UnU1Coi1p5qFGwtpjZMRMgJM','sk_test_QQcg3vGsKRPlW6T3dXcNJsor','FLWPUBK_TEST-a34940f2f87746abbdd8c117caee81cf-X','FLWSECK_TEST-1cb427c96e0b1e6772a04504be3638bd-X','tkogux49985047638244','LhNGUUKE9xCQ9xY8','WEBSTAGING','Retail',NULL,'sandbox','smtp.mailtrap.io','2525','tls','df3da325f3ec48','8e18def867639a','admin@geniusocean.com','GeniusOcean',1,'Coupon Found','Coupon Already Applied','THANK YOU FOR YOUR INVEST.','<h5 class=\"sub-title\">A litter bit More&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</h5>','<h2 class=\"title extra-padding\">About US&nbsp;</h2>','<p>Our organization pursues several goals that can be \r\n											identified as our mission. Learn more about them below.\r\n											Auis nostrud exercitation ullamc laboris nisitm aliquip ex \r\nbea sed consequat duis autes ure dolor. dolore magna aliqua nim ad \r\nminim.</p>\r\n									<p>\r\n											Auis nostrud exercitation ullamc laboris nisitm aliquip ex \r\nbea sed consequat duis autes ure dolor. dolore magna aliqua nim ad \r\nminim.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>','1563350729about.png','We\'ll email you an order confirmation with details and tracking info.',1,1,'PRICING','Choose Plans & Pricing','Choose the best for yourself','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','You are subscribed Successfully.','This email has already been taken.','OOPS ! ... PAGE NOT FOUND','THE PAGE YOU ARE LOOKING FOR MIGHT HAVE BEEN REMOVED, HAD ITS NAME CHANGED, OR IS TEMPORARILY UNAVAILABLE.','16392899281561878540404.png','1639560643bg-banner.jpg',1,'USD','$',0,5,5,1,5,'16406712051566471347add.jpg','ZzsMLGKe162CfA5EcG6j','xpub6CfHiBbFnj1eCa68kYVKYvvW9sxh76YLLHPJGGbWo8Xd3PADnLTG9tX8bpEvoERzDQYCGxvJcc7yyQHKXGKfRUr4KrkYS3gsfDZvVeavqMP','a10cca40-7934-4688-810d-adfb821b4b03',3000,'a5631c29ee0c12f5912c388d2be49d4a3eb86db2b739d4cd5a4a822dd72995bc','2c6E81c067035F4fa4A7dB2Dd71452E5B5bd21b15BABB64870f019E26048e0bA','1cfe-6428-523f-dd08','a9ef-8f3c-ec8c-6070','3636-1e7f-c44b-5551','DEMO',1,1,1,0,'B46P1XMf388193hz-sqrDJPhNprKy8xaZ3Sb2dt2',1,1,5,5,'ExcPToZh1658314822.png','U36807958',1,'cdb2163c-91cc-4fa6-b3fc-7de11bdcdf1a',1,1,0,1,'{\"Home\":{\"title\":\"Home\",\"dropdown\":\"no\",\"href\":\"\\/\",\"target\":\"self\"},\"Services\":{\"title\":\"Services\",\"dropdown\":\"no\",\"href\":\"\\/services\",\"target\":\"self\"},\"Plan\":{\"title\":\"Plan\",\"dropdown\":\"no\",\"href\":\"\\/pricing-plan\",\"target\":\"self\"},\"Blog\":{\"title\":\"Blog\",\"dropdown\":\"no\",\"href\":\"\\/blogs\",\"target\":\"self\"},\"Contact\":{\"title\":\"Contact\",\"dropdown\":\"no\",\"href\":\"\\/contact\",\"target\":\"self\"}}');
/*!40000 ALTER TABLE `generalsettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `rtl` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint NOT NULL DEFAULT '0',
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,1,1,'EN','1636017050KyjRNauw','1636017050KyjRNauw.json',NULL,NULL),(14,0,0,'Bn','1641443819L3vJreHG','1641443819L3vJreHG.json',NULL,NULL);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `twitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `linkedin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (2,'Ervin Kim','CEO of Apple','1561539258comment2.png','https://www.facebook.com','https://www.twitter.com','https://www.linkedin.com'),(3,'Ervin Kim','CEO of Apple','1561539242comment2.png','https://www.facebook.com','https://www.twitter.com','https://www.linkedin.com'),(4,'Ervin Kim','CEO of Apple','1561539231comment2.png','https://www.facebook.com','https://www.twitter.com','https://www.linkedin.com'),(5,'Ervin Kim','CEO of Apple','1561539222comment2.png',NULL,'https://www.twitter.com','https://www.linkedin.com'),(6,'Ervin Kim','CEO of Apple','1561539213comment2.png',NULL,'https://www.twitter.com','https://www.linkedin.com'),(7,'Ervin Kim','CEO of Apple','1561539184comment2.png','https://www.facebook.com',NULL,'https://www.linkedin.com'),(8,'Ervin Kim','CEO of Apple','1561539197comment2.png','https://www.facebook.com','https://www.twitter.com','https://www.linkedin.com'),(9,'Ervin Kim','CEO of Apple','1561539345comment2.png','https://www.facebook.com','https://www.twitter.com',NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int unsigned DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `vendor_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `conversation_id` int DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (154,NULL,60,NULL,NULL,NULL,0,'2022-02-07 08:18:12','2022-02-07 08:18:12'),(155,NULL,NULL,NULL,NULL,13,0,'2022-02-09 11:39:47','2022-02-09 11:39:47'),(156,NULL,62,NULL,NULL,NULL,0,'2022-02-20 04:55:06','2022-02-20 04:55:06'),(157,NULL,63,NULL,NULL,NULL,0,'2022-03-04 15:19:11','2022-03-04 15:19:11'),(158,173,NULL,NULL,NULL,NULL,0,'2022-07-20 07:47:53','2022-07-20 07:47:53'),(159,175,NULL,NULL,NULL,NULL,0,'2022-07-21 00:46:01','2022-07-21 00:46:01'),(160,176,NULL,NULL,NULL,NULL,0,'2022-07-21 00:51:59','2022-07-21 00:51:59');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `instamojo_id` varchar(255) DEFAULT NULL,
  `invest` double NOT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_amount` float NOT NULL,
  `coin_amount` double DEFAULT NULL,
  `txnid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify_id` text,
  `order_number` varchar(255) NOT NULL,
  `payment_status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_zip` varchar(255) DEFAULT NULL,
  `status` enum('pending','running','completed','declined') NOT NULL DEFAULT 'pending',
  `income_add_status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_sign` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_code` varchar(255) DEFAULT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `coin_address` text,
  `confirmations` int DEFAULT NULL,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `check_data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (172,62,NULL,50,NULL,200,NULL,NULL,NULL,NULL,'pLw61645465860','pending','user@gmail.com','User',NULL,NULL,NULL,NULL,'pending',0,'2022-02-21 11:51:00','2022-02-21 11:51:00','$','USD','sed do eiusmod tempor','Plan 1','<ol><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li></ol>',NULL,NULL,'2022-03-22 23:51:00',NULL),(173,62,NULL,1054,'Manual',1159.4,NULL,'hghjgaxjhgasghjxas',NULL,NULL,'mDiX1658324873','pending','user@gmail.com','Nabil','162345','sector-09,road-06','Dhaka','1280','pending',0,'2022-07-20 07:47:53','2022-07-20 07:47:53','$',NULL,'sed do eiusmod tempor','BASIC','<ol><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li></ol>',NULL,NULL,'2022-08-18 19:47:53',NULL),(174,62,NULL,3.6501679077238,'parisi_bank',4.08819,NULL,NULL,NULL,NULL,'ehmA1658385875','pending','user@gmail.com','User','162345','sector-09,road-06','Dhaka','1280','pending',0,'2022-07-21 00:44:35','2022-07-21 00:44:35','₦',NULL,'sed do eiusmod tempor','STANDARD','<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>',NULL,NULL,'2022-09-19 00:44:35',NULL),(175,62,NULL,3.6501679077238,'Manual',4.08819,NULL,'hghjgaxjhgasghjxas',NULL,NULL,'BskE1658385961','pending','user@gmail.com','User','162345','sector-09,road-06','Dhaka','1280','pending',0,'2022-07-21 00:46:01','2022-07-21 00:46:01','₦',NULL,'sed do eiusmod tempor','STANDARD','<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>',NULL,NULL,'2022-09-19 00:46:01',NULL),(176,62,NULL,1000,'Manual',1100,NULL,'hghjgaxjhgasghjxas',NULL,NULL,'IfRn1658386319','pending','user@gmail.com','User','162345','sector-09,road-06','Dhaka','1280','pending',0,'2022-07-21 00:51:59','2022-07-21 00:51:59','₦',NULL,'sed do eiusmod tempor','BASIC','<ol><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li></ol>',NULL,NULL,'2022-08-20 00:51:59',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_tag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `header` tinyint(1) NOT NULL DEFAULT '0',
  `footer` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'About Us','about','<div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 1</font><br></h2><p><span style=\"font-weight: 700;\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 2</font><br></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 3</font><br></h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><h2 helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" line-height:=\"\" 1.1;=\"\" color:=\"\" rgb(51,=\"\" 51,=\"\" 51);=\"\" margin:=\"\" 0px=\"\" 15px;=\"\" font-size:=\"\" 30px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\" style=\"font-family: \" 51);\"=\"\"><font size=\"6\">Title number 9</font><br></h2><p helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>',NULL,NULL,1,0,0),(2,'Privacy & Policy','privacy','This Privacy Policy explains how we collect, use and (under certain conditions) disclose your personal information. This Privacy Policy also explains the steps we have taken to secure your personal information. Finally, this Privacy Policy explains your options regarding the collection, use and disclosure of your personal information. By visiting the Site directly or through another site, you accept the practices described in this Policy.\r\nData protection is a matter of trust and your privacy is important to us. We shall therefore only use your name and other information which relates to you in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information if it is relevant to our dealings with you.\r\nWe will only keep your information for as long as we are either required to by law or as is relevant for the purposes for which it was collected.\r\nWe will cease to retain your personal data, or remove the means by which the data can be associated with you, as soon as it is reasonable to assume that such retention no longer serves the purposes for which the personal data was collected, and is no longer necessary for any legal or business purpose.\r\nYou can visit the Site and browse without having to provide personal details. During your visit to the Site you remain anonymous and at no time can we identify you unless you have an account on the Site and log on with your user name and password.','test,test1,test2,test3','Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',0,1,1);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagesettings`
--

DROP TABLE IF EXISTS `pagesettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagesettings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `contact_success` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contact_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `side_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `side_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `street` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fax` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `site` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `slider` tinyint(1) NOT NULL DEFAULT '1',
  `service` tinyint(1) NOT NULL DEFAULT '1',
  `featured` tinyint(1) NOT NULL DEFAULT '1',
  `small_banner` tinyint(1) NOT NULL DEFAULT '1',
  `best` tinyint(1) NOT NULL DEFAULT '1',
  `top_rated` tinyint(1) NOT NULL DEFAULT '1',
  `large_banner` tinyint(1) NOT NULL DEFAULT '1',
  `big` tinyint(1) NOT NULL DEFAULT '1',
  `hot_sale` tinyint(1) NOT NULL DEFAULT '1',
  `review_blog` tinyint(1) NOT NULL DEFAULT '1',
  `pricing_plan` tinyint(1) NOT NULL DEFAULT '0',
  `service_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `service_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `review_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `review_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `review_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blog_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blog_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `blog_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_video` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `footer_top_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner_link1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner_link2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `t_big_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `t_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `t_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `t_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `c_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `c_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `c_background` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagesettings`
--

LOCK TABLES `pagesettings` WRITE;
/*!40000 ALTER TABLE `pagesettings` DISABLE KEYS */;
INSERT INTO `pagesettings` VALUES (1,'Success! Thanks for contacting us, we will get back to you shortly.','admin@site.com','<h4 class=\"subtitle\" style=\"margin-bottom: 6px; font-weight: 600; line-height: 28px; font-size: 28px; text-transform: uppercase;\">WE\'D LOVE TO</h4><h2 class=\"title\" style=\"margin-bottom: 13px;font-weight: 600;line-height: 50px;font-size: 40px;color: #1f71d4;text-transform: uppercase;\">HEAR FROM YOU</h2>','<span style=\"color: rgb(119, 119, 119);\">Send us a message and we\' ll respond as soon as possible</span><br>','FEEL FREE TO DROP US A MESSAGE','Need to speak to us? Do you have any queries or suggestions? Please contact us about all enquiries including membership and volunteer work using the form below.','3584 Hickory Heights Drive ,Hanover MD 21076, USA','00 000 000 000','00 000 000 000','admin@site.com','https://site.com/',1,1,0,0,0,1,1,1,1,1,1,'THE BEST SERVICES','We bring the best things','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','Testimonial','Customer Reviews','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','Latest Blog','LOREM IPSUM DOLOR','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','1639556548about-us.png','WE ARE BAYYA','A place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.\r\n\r\nA place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.\r\n\r\nA place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.\r\n\r\nA place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.','https://www.google.com/','1639568953bg-banner.jpg','https://www.youtube.com/watch?v=0gv7OC9L2s8','1639561929call-to-action-bg.jpg','GET STARTED TODAY WITH BITCOIN','Open account for free and start trading Bitcoins!','<h4 class=\"subtitle\" style=\"font-weight: 600; line-height: 1.2381; font-size: 24px; color: rgb(31, 113, 212);\">More convenient than others</h4>','<h2 class=\"title\" style=\"font-weight: 600; line-height: 60px; font-size: 50px; color: rgb(23, 34, 44);\">Find Value &amp; Build confidence</h2>','https://www.google.com/','https://www.google.com/','TRANSACTIONS','User Statistics','Lastest Transactions','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','Enter your bitcoin address and make the first investment',NULL,'1566454842address-submit.jpg');
/*!40000 ALTER TABLE `pagesettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_gateways`
--

DROP TABLE IF EXISTS `payment_gateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_gateways` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subtitle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('manual','automatic') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'manual',
  `information` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `keyword` varchar(191) DEFAULT NULL,
  `currency_id` varchar(191) NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_gateways`
--

LOCK TABLES `payment_gateways` WRITE;
/*!40000 ALTER TABLE `payment_gateways` DISABLE KEYS */;
INSERT INTO `payment_gateways` VALUES (2,'(5 - 6 days)','Mobile Money','<b>Payment Number: </b>69234324233423',NULL,'manual',NULL,NULL,'0',1),(6,NULL,NULL,NULL,'Flutter Wave','automatic','{\"public_key\":\"FLWPUBK_TEST-299dc2c8bf4c7f14f7d7f48c32433393-X\",\"secret_key\":\"FLWSECK_TEST-afb1f2a4789002d7c0f2185b830450b7-X\",\"text\":\"Pay via your Flutter Wave account.\"}','flutterwave','[\"1\"]',1),(8,NULL,NULL,NULL,'Authorize.Net','automatic','{\"login_id\":\"76zu9VgUSxrJ\",\"txn_key\":\"2Vj62a6skSrP5U3X\",\"sandbox_check\":1,\"text\":\"Pay Via Authorize.Net\"}','authorize.net','[\"1\"]',1),(9,NULL,NULL,NULL,'Razorpay','automatic','{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\",\"text\":\"Pay via your Razorpay account.\"}','razorpay','[\"8\"]',1),(10,NULL,NULL,NULL,'Mollie Payment','automatic','{\"key\":\"test_jePgBjaRV5rUdzWc44rb2fUxgM2dM9\",\"text\":\"Pay with Mollie Payment.\"}','mollie','[\"1\",\"6\"]',1),(11,NULL,NULL,NULL,'Paytm','automatic','{\"merchant\":\"tkogux49985047638244\",\"secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"sandbox_check\":1,\"text\":\"Pay via your Paytm account.\"}','paytm','[\"8\"]',1),(12,NULL,NULL,NULL,'Paystack','automatic','{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"junnuns@gmail.com\",\"text\":\"Pay via your Paystack account.\"}','paystack','[\"9\"]',1),(13,NULL,NULL,NULL,'Instamojo','automatic','{\"key\":\"test_172371aa837ae5cad6047dc3052\",\"token\":\"test_4ac5a785e25fc596b67dbc5c267\",\"sandbox_check\":1,\"text\":\"Pay via your Instamojo account.\"}','instamojo','[\"8\"]',1),(14,NULL,NULL,NULL,'Stripe','automatic','{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit Card.\"}','stripe','[\"1\"]',1),(15,NULL,NULL,NULL,'Paypal','automatic','{\"client_id\":\"AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi\",\"client_secret\":\"EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE\",\"sandbox_check\":1,\"text\":\"Pay via your PayPal account.\"}','paypal','[\"1\"]',1),(16,NULL,NULL,NULL,'BlockChain','automatic','{\"secret_string\":\"ZzsMLGKe162CfA5EcG6j\",\"blockchain_xpub\":\"xpub6CfHiBbFnj1eCa68kYVKYvvW9sxh76YLLHPJGGbWo8Xd3PADnLTG9tX8bpEvoERzDQYCGxvJcc7yyQHKXGKfRUr4KrkYS3gsfDZvVeavqMP\",\"blockchain_api\":\"a10cca40-7934-4688-810d-adfb821b4b03\",\"gap_limit\":\"3000\",\"text\":\"Pay via your BlockChain account.\"}','blockChain','[\"1\"]',1),(17,NULL,NULL,NULL,'CoinPayment ','automatic','{\"secret_string\":\"ZzsMLGKe162CfA5EcG6j\",\"coin_public_key\":\"a5631c29ee0c12f5912c388d2be49d4a3eb86db2b739d4cd5a4a822dd72995bc\",\"coin_private_key\":\"2c6E81c067035F4fa4A7dB2Dd71452E5B5bd21b15BABB64870f019E26048e0bA\",\"text\":\"Pay via your Coin Payment account.\"}','coinPayment','[\"1\"]',1),(18,NULL,NULL,NULL,'Coingate','automatic','{\"secret_string\":\"B46P1XMf388193hz-sqrDJPhNprKy8xaZ3Sb2dt2\",\"text\":\"Pay via your Coin gate account.\"}','coingate','[\"1\"]',1),(21,NULL,NULL,NULL,'Block.io (BTC)','automatic','{\"blockio_api_btc\":\"fae9-e6f5-7d05-df07\",\"text\":\"Pay via your Block.io (BTC) account.\"}','block.io.btc','[\"1\"]',1),(22,NULL,NULL,NULL,'Block.io (LTC)','automatic','{\"blockio_api_ltc\":\"642a-48dc-4e31-31f6\",\"text\":\"Pay via your Block.io (BTC) account.\"}','block.io.ltc','[\"1\"]',1),(23,NULL,NULL,NULL,'Block.io (DGC)','automatic','{\"blockio_api_dgc\":\"e586-cdb2-d54e-be26\",\"text\":\"Pay via your Block.io (BTC) account.\"}','block.io.dgc','null',1);
/*!40000 ALTER TABLE `payment_gateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
INSERT INTO `portfolios` VALUES (1,'Search Engine Optimization','https://www.google.com/','1561537582portfolio.jpg'),(2,'Search Engine Optimization','https://www.google.com/','1561537603portfolio.jpg'),(3,'Search Engine Optimization','https://www.google.com/','1561537609portfolio.jpg'),(4,'Search Engine Optimization','https://www.google.com/','1561537620portfolio.jpg'),(5,'Search Engine Optimization','https://www.google.com/','1561537630portfolio.jpg'),(6,'Search Engine Optimization','https://www.google.com/','1561537643portfolio.jpg');
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_price` double NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `max_price` double NOT NULL,
  `days` int NOT NULL DEFAULT '0',
  `percentage` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (63,'sed do eiusmod tempor','MEGA',10000,'<ol><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li></ol>',20000,60,115),(64,'sed do eiusmod tempor','ULTRA',5000,'<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>',8000,30,115),(65,'sed do eiusmod tempor','PREMIUN',3000,'<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>',4000,90,115),(66,'sed do eiusmod tempor','STANDARD',1500,'<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>',1800,60,112),(67,'sed do eiusmod tempor','BASIC',1000,'<ol><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li></ol>',1250,30,110);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referral_bonuses`
--

DROP TABLE IF EXISTS `referral_bonuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referral_bonuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `from_user_id` int DEFAULT NULL,
  `to_user_id` int DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `amount` decimal(20,10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referral_bonuses`
--

LOCK TABLES `referral_bonuses` WRITE;
/*!40000 ALTER TABLE `referral_bonuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `referral_bonuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referrals`
--

DROP TABLE IF EXISTS `referrals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referrals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commission_type` varchar(255) DEFAULT NULL,
  `level` int DEFAULT NULL,
  `percent` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referrals`
--

LOCK TABLES `referrals` WRITE;
/*!40000 ALTER TABLE `referrals` DISABLE KEYS */;
INSERT INTO `referrals` VALUES (10,'invest',1,3,'2022-02-01 21:59:02','2022-02-01 21:59:02'),(11,'invest',2,2,'2022-02-01 21:59:02','2022-02-01 21:59:02'),(12,'invest',3,1,'2022-02-01 21:59:02','2022-02-01 21:59:02');
/*!40000 ALTER TABLE `referrals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (4,'1561447511people.png','Jhon Smith','CEO & Founder','That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins'),(5,'1561447450people.png','Jhon Smith','CEO & Founder','That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins'),(6,'1561447441people.png','Jhon Smith','CEO & Founder','That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (6,'Staff','Menu Builder , Invests , Transactions , Deposits , Manage Plans , Manage Customers , Manage Blog , General Setting , Homepage Setting , Email Setting , Message , Manage Roles , Messages , Social Setting , Payment Setting , Manage Staff , Language Setting , Fonts , Menupage Setting , Seo Tools , Subscribers',NULL,NULL),(8,'Moderator','Menu Builder , Deposits , Social Setting , Subscribers',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seotools`
--

DROP TABLE IF EXISTS `seotools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seotools` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `google_analytics` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_keys` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seotools`
--

LOCK TABLES `seotools` WRITE;
/*!40000 ALTER TABLE `seotools` DISABLE KEYS */;
INSERT INTO `seotools` VALUES (1,'<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-137437974-1\"></script>  <script>    window.dataLayer = window.dataLayer || [];    function gtag(){dataLayer.push(arguments);}    gtag(\'js\', new Date());    gtag(\'config\', \'UA-137437974-1\');  </script>','crypto wallet, buy bitcoin, bitcoin wallet, crypto currency, crypto app,');
/*!40000 ALTER TABLE `seotools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (15,'HIGH LIQUIDITY','Fast access to high liquidity orderbook</br>\r\nfor top currency pairs','1639476836high-liquidity.png'),(16,'COST EFFICIENCY','Reasonable trading fees for takers</br>\r\nand all market makers','1639476885cost-efficiency.png'),(17,'MOBILE APP','Trading via our Mobile App, Available</br>\r\nin Play Store & App Store','1639476911mobile-app.png'),(18,'PAYMENT OPTIONS','Popular methods: Visa, MasterCard,</br>\r\nbank transfer, cryptocurrency','1639476937payment-options.png'),(19,'WORLD COVERAGE','Providing services in 99% countries</br>\r\naround all the globe','1639476969world-coverage.png'),(20,'STRONG SECURITY','Protection against DDoS attacks,</br>\r\nfull data encryption','1639476998strong-security.png');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitemaps`
--

DROP TABLE IF EXISTS `sitemaps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sitemaps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sitemap_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitemaps`
--

LOCK TABLES `sitemaps` WRITE;
/*!40000 ALTER TABLE `sitemaps` DISABLE KEYS */;
/*!40000 ALTER TABLE `sitemaps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `subtitle_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subtitle_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_anime` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title_size` varchar(50) DEFAULT NULL,
  `title_color` varchar(50) DEFAULT NULL,
  `title_anime` varchar(50) DEFAULT NULL,
  `details_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details_size` varchar(50) DEFAULT NULL,
  `details_color` varchar(50) DEFAULT NULL,
  `details_anime` varchar(50) DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (9,'YOU CAN TRUST','24','#ffffff','slideInUp','BITCOIN EXCHANGE','60','#ffffff','slideInDown','Highlight your personality  and look with these fabulous and exquisite fashion.','16','#ffffff','slideInDown','1639479478bg1.jpg','slide-one','https://www.google.com/'),(10,'TO BITCOIN','24','#c32d2d','slideInUp','SECURE AND EASY WAY','60','#bc2727','slideInDown',NULL,NULL,'#c51d1d','slideInLeft','1639479394bg2.jpg','slide-one','https://www.google.com/');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_providers`
--

DROP TABLE IF EXISTS `social_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_providers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_providers`
--

LOCK TABLES `social_providers` WRITE;
/*!40000 ALTER TABLE `social_providers` DISABLE KEYS */;
INSERT INTO `social_providers` VALUES (3,17,'102485372716947456487','google','2019-06-19 17:06:00','2019-06-19 17:06:00'),(4,18,'109955884428371086401','google','2019-06-19 17:17:04','2019-06-19 17:17:04');
/*!40000 ALTER TABLE `social_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socialsettings`
--

DROP TABLE IF EXISTS `socialsettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `socialsettings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `facebook` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gplus` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dribble` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_status` tinyint NOT NULL DEFAULT '1',
  `g_status` tinyint NOT NULL DEFAULT '1',
  `t_status` tinyint NOT NULL DEFAULT '1',
  `l_status` tinyint NOT NULL DEFAULT '1',
  `d_status` tinyint NOT NULL DEFAULT '1',
  `f_check` tinyint DEFAULT NULL,
  `g_check` tinyint DEFAULT NULL,
  `fclient_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fclient_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `fredirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gclient_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gclient_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gredirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socialsettings`
--

LOCK TABLES `socialsettings` WRITE;
/*!40000 ALTER TABLE `socialsettings` DISABLE KEYS */;
INSERT INTO `socialsettings` VALUES (1,'https://www.facebook.com/','https://plus.google.com/','https://twitter.com/','https://www.linkedin.com/','https://dribbble.com/',1,1,1,1,0,1,1,'503140663460329','f66cd670ec43d14209a2728af26dcc43','https://localhost/crypto/auth/facebook/callback','904681031719-sh1aolu42k7l93ik0bkiddcboghbpcfi.apps.googleusercontent.com','yGBWmUpPtn5yWhDAsXnswEX3','http://localhost/marketplace/auth/google/callback');
/*!40000 ALTER TABLE `socialsettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL DEFAULT '0',
  `receiver_id` int DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `type` enum('Invest','Payout','Referral Bonus','Send Money','Received Money') NOT NULL,
  `txnid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (114,62,NULL,'user@gmail.com',50,'Invest','uwNf1645355853','2022-02-20 05:21:33','2022-02-20 05:21:33'),(115,62,NULL,'user@gmail.com',0.67567567567568,'Invest','AQbB1645375720','2022-02-20 10:54:28','2022-02-20 10:54:28'),(116,62,NULL,'user@gmail.com',0.67567567567568,'Invest','XlgI1645376461','2022-02-20 11:04:23','2022-02-20 11:04:23'),(117,62,NULL,'user@gmail.com',50,'Invest','uTEQ1645377553','2022-02-20 11:25:07','2022-02-20 11:25:07'),(118,62,NULL,'user@gmail.com',50,'Invest','4ECa1645379222','2022-02-20 11:50:05','2022-02-20 11:50:05'),(119,62,NULL,'user@gmail.com',50,'Invest','MGxZ1645379680','2022-02-20 11:56:19','2022-02-20 11:56:19'),(120,62,NULL,'user@gmail.com',50,'Invest','mnaT1645382294','2022-02-20 12:42:21','2022-02-20 12:42:21'),(121,62,NULL,'user@gmail.com',50,'Invest','1aM61645448326','2022-02-21 07:41:08','2022-02-21 07:41:08'),(122,62,NULL,'user@gmail.com',50,'Invest','hs3e1645451321','2022-02-21 07:49:14','2022-02-21 07:49:14'),(123,62,NULL,'user@gmail.com',50,'Invest','hs3e1645451321','2022-02-21 07:50:02','2022-02-21 07:50:02'),(124,62,NULL,'user@gmail.com',50,'Invest','lBkL1645454043','2022-02-21 08:35:28','2022-02-21 08:35:28'),(125,62,NULL,'user@gmail.com',1054,'Invest','mDiX1658324873','2022-07-20 07:47:53','2022-07-20 07:47:53'),(126,62,NULL,'user@gmail.com',3.6501679077238,'Invest','BskE1658385961','2022-07-21 00:46:01','2022-07-21 00:46:01'),(127,62,NULL,'user@gmail.com',1000,'Invest','IfRn1658386319','2022-07-21 00:51:59','2022-07-21 00:51:59');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `untitled_table_0`
--

DROP TABLE IF EXISTS `untitled_table_0`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `untitled_table_0` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `untitled_table_0`
--

LOCK TABLES `untitled_table_0` WRITE;
/*!40000 ALTER TABLE `untitled_table_0` DISABLE KEYS */;
/*!40000 ALTER TABLE `untitled_table_0` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notifications`
--

DROP TABLE IF EXISTS `user_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL DEFAULT '0',
  `withdraw_id` int NOT NULL DEFAULT '0',
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('Invest','Payout','Withdraw') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notifications`
--

LOCK TABLES `user_notifications` WRITE;
/*!40000 ALTER TABLE `user_notifications` DISABLE KEYS */;
INSERT INTO `user_notifications` VALUES (100,62,173,0,0,'2022-07-20 07:47:53','2022-07-20 07:47:53','Invest'),(101,62,175,0,0,'2022-07-21 00:46:01','2022-07-21 00:46:01','Invest'),(102,62,176,0,0,'2022-07-21 00:51:59','2022-07-21 00:51:59','Invest');
/*!40000 ALTER TABLE `user_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_provider` tinyint NOT NULL DEFAULT '0',
  `status` tinyint NOT NULL DEFAULT '0',
  `verification_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_verified` enum('Yes','No') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `income` double NOT NULL DEFAULT '0',
  `affilate_code` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `referral_id` tinyint(1) NOT NULL DEFAULT '0',
  `twofa` tinyint NOT NULL DEFAULT '0',
  `go` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint NOT NULL DEFAULT '0',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_kyc` tinyint NOT NULL DEFAULT '0',
  `is_banned` tinyint NOT NULL DEFAULT '0' COMMENT '1 === banned\r\n0 === active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (62,'User',NULL,NULL,NULL,'sector-09,road-06',NULL,NULL,'user@gmail.com','$2y$10$3dzuts0XBDl0W7qXum2Z6OREcKAOqm/PID3WoWcdkqs0O7PnINHCm',NULL,'2022-02-20 04:55:06','2022-02-21 07:41:08',0,0,'6738b047f206a5befc5b63da151c7b09','Yes',1950,'33899bafa30292165430cb90b545728a',0,0,NULL,0,NULL,0,0),(63,'Amin',NULL,NULL,NULL,'UAE',NULL,NULL,'aminalzeez@gmail.com','$2y$10$NEfKljpOZ4cpRB9pS2LZPunlvxnErsClAqQW9ldLJVXs6ohKyF2D.',NULL,'2022-03-04 15:19:11','2022-07-20 04:02:59',0,0,'affee12229cb5c881981df5b1eb4dd89','Yes',0,'b685f2489cbaba3141b58cb7bc2afb2b',0,0,NULL,0,NULL,1,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraw_methods`
--

DROP TABLE IF EXISTS `withdraw_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `withdraw_methods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `method` varchar(255) DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraw_methods`
--

LOCK TABLES `withdraw_methods` WRITE;
/*!40000 ALTER TABLE `withdraw_methods` DISABLE KEYS */;
INSERT INTO `withdraw_methods` VALUES (1,'Paypal',1,'2021-12-06 23:47:28','2021-12-06 23:59:57');
/*!40000 ALTER TABLE `withdraw_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdraws`
--

DROP TABLE IF EXISTS `withdraws`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `withdraws` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `swift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` float DEFAULT NULL,
  `fee` float DEFAULT '0',
  `details` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('pending','completed','rejected') NOT NULL DEFAULT 'pending',
  `type` enum('user','vendor') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdraws`
--

LOCK TABLES `withdraws` WRITE;
/*!40000 ALTER TABLE `withdraws` DISABLE KEYS */;
INSERT INTO `withdraws` VALUES (11,60,'Paypal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,90,10,'ahmmedafzal4@gmail.com','2022-02-13 13:59:36','2022-02-13 13:59:36','pending','user'),(12,60,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,90,10,'ahmmedafzal4@gmail.com','2022-02-13 14:29:46','2022-02-13 14:29:46','pending','user'),(13,60,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,90,10,'ahmmedafzal4@gmail.com','2022-02-13 14:30:42','2022-02-13 14:30:42','pending','user');
/*!40000 ALTER TABLE `withdraws` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-22 19:58:33
