/*
SQLyog Ultimate v10.41 
MySQL - 8.0.30 : Database - bromindo_test
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`name`,`email`,`username`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'Super Admin','superadmin@mail.com','superadmin',NULL,'$2y$10$WhYBFqgWXCpFUTFthG/1E.qPUspAJI8jW2fsHa9qYqBmqTVJ1mRGu',NULL,'2024-10-29 07:05:37','2024-10-29 07:05:37'),(2,'Pengunjung','pengunjung@mail.com','pengunjung',NULL,'$2y$10$5Fi7.3pDvvfX6fCNYMikGOWb64RJmyTv9X4TJeUZq4JjaJAMemVQu',NULL,'2024-10-29 07:10:52','2024-10-29 07:10:52');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_07_24_184706_create_permission_tables',1),(5,'2020_09_12_043205_create_admins_table',1),(6,'2024_10_25_152139_create_penduduk_table',1);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (1,'App\\Models\\Admin',1),(2,'App\\Models\\Admin',2);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `penduduk` */

DROP TABLE IF EXISTS `penduduk`;

CREATE TABLE `penduduk` (
  `penId` int unsigned NOT NULL AUTO_INCREMENT,
  `penNik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penNama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penTempatLahir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penTglLahir` date DEFAULT NULL,
  `penImage` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`penId`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `penduduk` */

insert  into `penduduk`(`penId`,`penNik`,`penNama`,`penTempatLahir`,`penTglLahir`,`penImage`,`created_at`,`updated_at`) values (1,'3387080312606786','Jefferey Gislason','Wehnermouth','2000-09-03','','2024-10-29 07:05:51','2024-10-29 07:05:51'),(2,'4468156854365092','Dr. Jacky Emard III','Dooleymouth','1975-06-19','','2024-10-29 07:05:51','2024-10-29 07:05:51'),(3,'3444537563706792','Dr. Nella Schoen','North Reese','2014-03-15','','2024-10-29 07:05:51','2024-10-29 07:05:51'),(4,'0181009068610093','Janessa Schiller','Fayland','2017-05-04','','2024-10-29 07:05:52','2024-10-29 07:05:52'),(5,'6602623048399229','Kaleb Russel','Heathcotemouth','1988-07-11','','2024-10-29 07:05:52','2024-10-29 07:05:52'),(6,'4865526522090082','Prof. Viva Olson DDS','West Briana','1982-10-10','','2024-10-29 07:05:52','2024-10-29 07:05:52'),(7,'7082195912172555','Verner Halvorson','Rocioside','1974-01-04','','2024-10-29 07:05:52','2024-10-29 07:05:52'),(8,'1265730921366297','Prof. Adolphus Wiza PhD','West Godfreyfort','1982-06-19','','2024-10-29 07:05:53','2024-10-29 07:05:53'),(9,'2435630451809118','Miss Beth Streich DDS','Bennettmouth','2014-06-19','','2024-10-29 07:05:53','2024-10-29 07:05:53'),(10,'5587588580909436','Betsy Mraz','Gillianbury','2006-04-29','','2024-10-29 07:05:53','2024-10-29 07:05:53'),(11,'6397823494655565','Carolina Daniel','Cormierburgh','1998-04-26','','2024-10-29 07:05:53','2024-10-29 07:05:53'),(12,'6353816181717429','Garnett Hirthe','Port Tyrellmouth','2004-12-23','','2024-10-29 07:05:53','2024-10-29 07:05:53'),(13,'5372042428590629','Mr. Allan Marvin III','Port Gabebury','2018-05-19','','2024-10-29 07:05:54','2024-10-29 07:05:54'),(14,'8387201023504510','Sammie Bartoletti','Clintmouth','2020-03-25','','2024-10-29 07:05:54','2024-10-29 07:05:54'),(15,'8226663906579492','Gabe Jakubowski','Lake Winnifredchester','2005-05-09','','2024-10-29 07:05:54','2024-10-29 07:05:54'),(16,'9640922246661629','Josefina Dietrich','South Deliaton','2016-02-21','','2024-10-29 07:05:54','2024-10-29 07:05:54'),(17,'2104089900660505','Josefina Smitham','Nashmouth','2019-01-31','','2024-10-29 07:05:55','2024-10-29 07:05:55'),(18,'3528764251837317','Dr. Clair McGlynn IV','Lolafort','2017-01-08','','2024-10-29 07:05:55','2024-10-29 07:05:55'),(19,'8232061694184051','Miss Imogene Hansen II','East Deborahberg','1977-08-02','','2024-10-29 07:05:55','2024-10-29 07:05:55'),(20,'8181742591144083','Estelle Frami','Ondrickabury','1972-07-17','','2024-10-29 07:05:55','2024-10-29 07:05:55'),(21,'1671947198484267','Kaylie Kirlin','Keithchester','2000-12-09','','2024-10-29 07:05:55','2024-10-29 07:05:55'),(22,'9766477679834383','Tanya Towne','Landenchester','2021-10-27','','2024-10-29 07:05:56','2024-10-29 07:05:56'),(23,'6605605272294170','Darian Windler','Swaniawskichester','2012-08-02','','2024-10-29 07:05:56','2024-10-29 07:05:56'),(24,'5210517052006619','Solon Gaylord MD','Bethton','1987-03-29','','2024-10-29 07:05:56','2024-10-29 07:05:56'),(25,'0572464314171473','Dr. Luigi Rutherford','Port Allymouth','1970-10-17','','2024-10-29 07:05:56','2024-10-29 07:05:56'),(26,'2708751412565804','Lon Greenholt','North Donald','1971-12-19','','2024-10-29 07:05:56','2024-10-29 07:05:56'),(27,'2521804268109667','Jermey Fahey','North Jarrod','1999-06-10','','2024-10-29 07:05:57','2024-10-29 07:05:57'),(28,'7120325466266755','Alanna Borer PhD','West Llewellynview','1991-07-13','','2024-10-29 07:05:57','2024-10-29 07:05:57'),(29,'3940346524949424','Giovanna Streich','New Jordynton','2002-04-12','','2024-10-29 07:05:57','2024-10-29 07:05:57'),(30,'7932146265786925','Prof. Lucie Mosciski','South Tiatown','2001-11-08','','2024-10-29 07:05:57','2024-10-29 07:05:57'),(31,'4934964633686499','Rosalind Mueller II','Reillyport','1975-08-13','','2024-10-29 07:05:57','2024-10-29 07:05:57'),(32,'9497824134239955','Linda Maggio','Jaskolskiville','2020-04-12','','2024-10-29 07:05:57','2024-10-29 07:05:57'),(33,'3065071904721390','Prof. Cody Legros','West Charity','1981-08-17','','2024-10-29 07:05:58','2024-10-29 07:05:58'),(34,'3442699136493825','Miss Kali Durgan','Brockland','1975-03-26','','2024-10-29 07:05:58','2024-10-29 07:05:58'),(35,'6609652068692401','Ms. Fiona DuBuque I','North Cierra','2012-01-03','','2024-10-29 07:05:58','2024-10-29 07:05:58'),(36,'4398822051934233','Russel Hayes','Spencerstad','2017-01-19','','2024-10-29 07:05:58','2024-10-29 07:05:58'),(37,'5924107369851843','Prof. Elvis Witting DDS','North Erick','2005-11-03','','2024-10-29 07:05:58','2024-10-29 07:05:58'),(38,'8373528520390918','Myrna Grady','Auerview','1977-06-13','','2024-10-29 07:05:58','2024-10-29 07:05:58'),(39,'8434535168900654','Etha Renner','Marlenborough','1974-02-21','','2024-10-29 07:05:59','2024-10-29 07:05:59'),(40,'1502160179629233','Eleazar Jast','Feilside','1980-04-23','','2024-10-29 07:06:00','2024-10-29 07:06:00'),(41,'0676323928086770','Vladimir Daniel DVM','New Zoeyview','2002-02-27','','2024-10-29 07:06:00','2024-10-29 07:06:00'),(42,'8323042280926943','Sofia Hayes','Ignaciohaven','1997-08-25','','2024-10-29 07:06:00','2024-10-29 07:06:00'),(43,'5618229109810180','Adeline Russel','Gabeview','2014-01-04','','2024-10-29 07:06:01','2024-10-29 07:06:01'),(44,'6969031264447486','Neil Bins','Tristianburgh','1999-02-08','','2024-10-29 07:06:01','2024-10-29 07:06:01'),(45,'3072368771901812','Savanah Leffler','Sipesside','2010-10-01','','2024-10-29 07:06:01','2024-10-29 07:06:01'),(46,'9870046388388491','Prof. Deangelo Hammes','West Monroehaven','2016-04-23','','2024-10-29 07:06:01','2024-10-29 07:06:01'),(47,'0772787729891727','Ebba Zemlak','New Ashtynborough','1987-02-12','','2024-10-29 07:06:01','2024-10-29 07:06:01'),(48,'9406872154939359','Dr. Maribel Muller','Malcolmborough','1980-03-24','','2024-10-29 07:06:01','2024-10-29 07:06:01'),(49,'8299821696287159','Alec Mann','Schillertown','1991-02-14','','2024-10-29 07:06:02','2024-10-29 07:06:02'),(50,'4264246409589558','Drew Murphy','Hillview','1979-08-24','','2024-10-29 07:06:02','2024-10-29 07:06:02'),(51,'7416623006259459','Miss Meggie Miller','New Darianhaven','2016-12-02','','2024-10-29 07:06:02','2024-10-29 07:06:02'),(52,'0533598797497231','Mrs. Chanel Strosin DVM','Mittieborough','2010-11-13','','2024-10-29 07:06:02','2024-10-29 07:06:02'),(53,'8460187654473842','Aisha Hamill','Blickfurt','2002-04-06','','2024-10-29 07:06:03','2024-10-29 07:06:03'),(54,'1067008694049320','Mr. Jace Walter Jr.','South Shannon','1982-11-08','','2024-10-29 07:06:03','2024-10-29 07:06:03'),(55,'4201838146937709','Nolan Conn V','Ernserland','1991-11-08','','2024-10-29 07:06:03','2024-10-29 07:06:03'),(56,'3814262734415633','Else Runolfsson','Adityahaven','1986-08-27','','2024-10-29 07:06:03','2024-10-29 07:06:03'),(57,'9428577415081441','Miss Rae Jast','Mathiasstad','2017-03-31','','2024-10-29 07:06:04','2024-10-29 07:06:04'),(58,'2528972763310111','Karson Nader','New Lorenz','2007-04-26','','2024-10-29 07:06:04','2024-10-29 07:06:04'),(59,'6062600492383574','Darren Rempel','East Arlie','2012-10-02','','2024-10-29 07:06:04','2024-10-29 07:06:04'),(60,'4936518027063011','Miss Caroline Armstrong DDS','Boyleburgh','1994-08-19','','2024-10-29 07:06:04','2024-10-29 07:06:04'),(61,'5356551465604292','Don Leffler','Hesselfurt','1973-05-22','','2024-10-29 07:06:04','2024-10-29 07:06:04'),(62,'3064634552874087','Giuseppe Homenick','Port Cristianport','2001-09-29','','2024-10-29 07:06:04','2024-10-29 07:06:04'),(63,'6411225505686308','Gerry Volkman','South Bailee','1976-12-14','','2024-10-29 07:06:05','2024-10-29 07:06:05'),(64,'3312044624438065','Prof. Nathaniel Davis III','Estafurt','2016-04-02','','2024-10-29 07:06:05','2024-10-29 07:06:05'),(65,'9241842369885512','Miss Theodora Goyette PhD','Rashadshire','1973-02-03','','2024-10-29 07:06:05','2024-10-29 07:06:05'),(66,'2869488966093419','Bert Huel Sr.','Rudolphton','2009-11-15','','2024-10-29 07:06:05','2024-10-29 07:06:05'),(67,'8505316977276339','Gerry Rosenbaum','Jilliantown','1995-03-17','','2024-10-29 07:06:05','2024-10-29 07:06:05'),(68,'8124039779959016','Rhett Thompson MD','Roobshire','1974-12-22','','2024-10-29 07:06:05','2024-10-29 07:06:05'),(69,'4146392941819147','Ferne Brekke','Petrahaven','1995-11-28','','2024-10-29 07:06:06','2024-10-29 07:06:06'),(70,'1469637579818305','Brando Wisoky','Kelsieberg','2003-06-18','','2024-10-29 07:06:06','2024-10-29 07:06:06'),(71,'6370220783816872','Alexie Howell Sr.','West Metafurt','1992-03-31','','2024-10-29 07:06:06','2024-10-29 07:06:06'),(72,'2852671068599299','Emmitt Roberts','Hayesside','2024-05-06','','2024-10-29 07:06:06','2024-10-29 07:06:06'),(73,'3545853532713361','Prof. Johann Schoen','Kolbyview','2008-06-03','','2024-10-29 07:06:06','2024-10-29 07:06:06'),(74,'8887304159682657','Winnifred Leannon','South Alizeville','1982-09-20','','2024-10-29 07:06:07','2024-10-29 07:06:07'),(75,'1756778846690608','Dr. Isom Heathcote','New Alexandre','2005-07-10','','2024-10-29 07:06:07','2024-10-29 07:06:07'),(76,'8528341246185973','Kristopher McKenzie','Hansenton','1970-09-04','','2024-10-29 07:06:07','2024-10-29 07:06:07'),(77,'4560967789423721','Caroline Hoppe','South Naomiport','1997-02-18','','2024-10-29 07:06:07','2024-10-29 07:06:07'),(78,'0296977358470018','Louvenia Schulist DDS','New Harold','1994-01-13','','2024-10-29 07:06:07','2024-10-29 07:06:07'),(79,'2550179485609851','Myrtis Feil','New Leonard','2013-06-09','','2024-10-29 07:06:07','2024-10-29 07:06:07'),(80,'2571857577149768','Era Hettinger','West Bettyeburgh','1999-12-25','','2024-10-29 07:06:08','2024-10-29 07:06:08'),(81,'9035317864177944','Brenden Gaylord','Wizastad','1997-11-28','','2024-10-29 07:06:08','2024-10-29 07:06:08'),(82,'4627862567540162','Ms. Baby Franecki DVM','Reynoldsfurt','1992-03-07','','2024-10-29 07:06:08','2024-10-29 07:06:08'),(83,'7145213026670356','Zakary Weimann','Alysamouth','2001-09-27','','2024-10-29 07:06:08','2024-10-29 07:06:08'),(84,'3933028104488937','Prof. Rahsaan Swaniawski DVM','Casandramouth','2011-04-07','','2024-10-29 07:06:08','2024-10-29 07:06:08'),(85,'5869890908616916','Prof. Irving Huel','Maurinehaven','2018-03-06','','2024-10-29 07:06:09','2024-10-29 07:06:09'),(86,'4969778919580063','Hermina Nitzsche Sr.','Gerholdmouth','1991-07-10','','2024-10-29 07:06:09','2024-10-29 07:06:09'),(87,'9785932279036115','Lennie Hettinger','East Griffinmouth','2009-07-12','','2024-10-29 07:06:09','2024-10-29 07:06:09'),(88,'7686349366678091','Kristin Howell','Daphneshire','1985-10-04','','2024-10-29 07:06:09','2024-10-29 07:06:09'),(89,'8044459478152009','Afton Crona','Franeckitown','1992-04-14','','2024-10-29 07:06:09','2024-10-29 07:06:09'),(90,'7588497911013814','Mr. Lew Hand PhD','Travonbury','1999-09-27','','2024-10-29 07:06:10','2024-10-29 07:06:10'),(91,'2468191349693713','Myrna Klein','New Amirastad','2018-08-16','','2024-10-29 07:06:10','2024-10-29 07:06:10'),(92,'7294754166511836','Mustafa Murazik','Amieshire','1989-08-21','','2024-10-29 07:06:10','2024-10-29 07:06:10'),(93,'0619020999403673','Isom Parker','Port Zolahaven','2002-07-31','','2024-10-29 07:06:10','2024-10-29 07:06:10'),(94,'0162639513666725','Dalton Lindgren','South Mohammad','1981-04-09','','2024-10-29 07:06:10','2024-10-29 07:06:10'),(95,'3174445634832925','Eleonore Corkery DVM','Andresfurt','2007-10-10','','2024-10-29 07:06:11','2024-10-29 07:06:11'),(96,'0731570684337641','Bill Wuckert DVM','Lake Lysanne','2013-10-08','','2024-10-29 07:06:11','2024-10-29 07:06:11'),(97,'3241311275423278','Prof. Laurianne Jones','Charlietown','1983-06-09','','2024-10-29 07:06:11','2024-10-29 07:06:11'),(98,'3237338460556105','Angela McGlynn','North Percy','2017-09-18','','2024-10-29 07:06:11','2024-10-29 07:06:11'),(99,'4396923156090167','Myrna Wintheiser','South Vito','2009-02-03','','2024-10-29 07:06:11','2024-10-29 07:06:11'),(100,'6553013335663032','Albert Breitenberg','Port Judd','1989-06-22','','2024-10-29 07:06:12','2024-10-29 07:06:12'),(101,'3708576149654478','Fletcher Feil IV','Rebaview','2020-12-08','','2024-10-29 07:06:12','2024-10-29 07:06:12'),(102,'3820532728705849','Mrs. Mollie Trantow','Keithshire','1973-08-24','','2024-10-29 07:06:12','2024-10-29 07:06:12'),(103,'1169371094626736','Ricardo Bergstrom IV','Waltonstad','1972-02-18','','2024-10-29 07:06:12','2024-10-29 07:06:12'),(104,'6511543329936982','Beth Kerluke','Mayerburgh','2023-05-02','','2024-10-29 07:06:12','2024-10-29 07:06:12'),(105,'8281825436382199','Eldridge Murazik','Remingtonfort','1987-02-06','','2024-10-29 07:06:13','2024-10-29 07:06:13'),(106,'4344216344835805','Mrs. Anabelle Wisozk V','North Estelle','2003-12-09','','2024-10-29 07:06:13','2024-10-29 07:06:13'),(107,'7582481559673663','Mr. Dexter Swift Sr.','Glennaborough','2022-06-07','','2024-10-29 07:06:13','2024-10-29 07:06:13'),(108,'3680116194994597','Marco Hirthe','South Vesta','2023-01-11','','2024-10-29 07:06:13','2024-10-29 07:06:13'),(109,'2997855254194694','Aletha Kshlerin','South Carrollberg','1970-06-28','','2024-10-29 07:06:13','2024-10-29 07:06:13'),(110,'6081482670938351','Shawn Conn','Waylonfurt','1990-06-13','','2024-10-29 07:06:13','2024-10-29 07:06:13'),(111,'9088163751384137','Forest Kiehn','Austynville','2023-09-24','','2024-10-29 07:06:14','2024-10-29 07:06:14'),(112,'7056055509369602','Ora Bergstrom','North Eribertomouth','1976-11-13','','2024-10-29 07:06:14','2024-10-29 07:06:14'),(113,'8450019976492535','Jaime McDermott','Toreyport','2000-12-30','','2024-10-29 07:06:14','2024-10-29 07:06:14'),(114,'7842351591322759','Doyle Mitchell IV','Geovanniborough','1985-09-05','','2024-10-29 07:06:14','2024-10-29 07:06:14'),(115,'0076379466608811','Mckenzie Gleason','East Diannastad','2018-06-17','','2024-10-29 07:06:14','2024-10-29 07:06:14'),(116,'1089817174233483','Mr. Makenna Ebert','Johnstonhaven','2019-12-12','','2024-10-29 07:06:14','2024-10-29 07:06:14'),(117,'8155235072900936','Novella Schiller MD','Mattburgh','1976-05-24','','2024-10-29 07:06:15','2024-10-29 07:06:15'),(118,'9061523000823439','Emmanuelle Maggio','Keshaunland','2006-08-20','','2024-10-29 07:06:15','2024-10-29 07:06:15'),(119,'8275970388688587','Fritz Beier Sr.','West Bethanyview','2011-01-28','','2024-10-29 07:06:15','2024-10-29 07:06:15'),(120,'4610996156252499','Cordelia Streich Jr.','Breitenbergmouth','1993-11-25','','2024-10-29 07:06:15','2024-10-29 07:06:15'),(121,'4105346292620248','Mr. Dameon Parker','East Darleneside','2019-07-13','','2024-10-29 07:06:15','2024-10-29 07:06:15'),(122,'7885481107177064','Benjamin Kautzer I','South Ruthe','1978-04-02','','2024-10-29 07:06:16','2024-10-29 07:06:16'),(123,'2981556770708583','Prof. Norwood Schowalter V','Lake Scotshire','1982-10-20','','2024-10-29 07:06:16','2024-10-29 07:06:16'),(124,'2773010398572691','Prof. Jessica Balistreri','Carterview','2007-10-06','','2024-10-29 07:06:16','2024-10-29 07:06:16'),(125,'0895220304648597','Prof. Constantin Weimann MD','Kiehnmouth','1973-06-05','','2024-10-29 07:06:16','2024-10-29 07:06:16'),(126,'6356757154338949','Marlene Hirthe','Lake Elissaland','1971-09-29','','2024-10-29 07:06:16','2024-10-29 07:06:16'),(127,'6264487925533714','Holly Hodkiewicz','Lake Nataliemouth','2012-03-20','','2024-10-29 07:06:16','2024-10-29 07:06:16'),(128,'2046892513868611','Dr. Cristian Christiansen','West Bettyeside','2003-04-28','','2024-10-29 07:06:17','2024-10-29 07:06:17'),(129,'6786186129177387','Ms. Alvera Stanton Jr.','Moniqueberg','1970-02-28','','2024-10-29 07:06:17','2024-10-29 07:06:17'),(130,'9187098061831664','Fletcher Crooks','Jaskolskichester','2018-03-19','','2024-10-29 07:06:17','2024-10-29 07:06:17'),(131,'9203500141684990','Mr. Frederic Okuneva','East Lela','1993-05-03','','2024-10-29 07:06:17','2024-10-29 07:06:17'),(132,'6001580377115921','Mallory Orn II','New Grady','2024-05-08','','2024-10-29 07:06:17','2024-10-29 07:06:17'),(133,'8342101359108519','Damion Boehm','Cormierbury','1985-02-11','','2024-10-29 07:06:18','2024-10-29 07:06:18'),(134,'8669756363263190','Christelle Runte','Lenoremouth','2017-01-06','','2024-10-29 07:06:18','2024-10-29 07:06:18'),(135,'5773851360068959','Derek Hayes','West Matildeside','2017-02-22','','2024-10-29 07:06:18','2024-10-29 07:06:18'),(136,'1164126881538782','Ms. Fabiola Kreiger DVM','North Kylie','1982-08-25','','2024-10-29 07:06:18','2024-10-29 07:06:18'),(137,'2157281001880698','Prof. Dena Carter I','South Margaretstad','2022-11-06','','2024-10-29 07:06:18','2024-10-29 07:06:18'),(138,'5399855785664517','Lenny Mitchell','East Pierce','2000-07-31','','2024-10-29 07:06:19','2024-10-29 07:06:19'),(139,'2546721576034401','Tina Kautzer','Blandahaven','1990-01-07','','2024-10-29 07:06:19','2024-10-29 07:06:19'),(140,'0246441139941442','Prof. Randy Pagac Sr.','Denesikburgh','1994-01-28','','2024-10-29 07:06:19','2024-10-29 07:06:19'),(141,'4342646482534560','Lizzie Monahan','Greenholtland','2008-06-09','','2024-10-29 07:06:19','2024-10-29 07:06:19'),(142,'4138257934726920','Daisha Marks','Klockoland','2024-06-22','','2024-10-29 07:06:19','2024-10-29 07:06:19'),(143,'8844831085347909','Alvah Lindgren','Parisianshire','2004-03-26','','2024-10-29 07:06:19','2024-10-29 07:06:19'),(144,'5842492379103375','Spencer Bartell','Cummeratastad','1982-05-06','','2024-10-29 07:06:20','2024-10-29 07:06:20'),(145,'7082376752695532','Blaze Schuppe','North Cydneyhaven','1977-12-16','','2024-10-29 07:06:20','2024-10-29 07:06:20'),(146,'4293998449305498','Dr. Jean Barrows V','Robertsview','1989-04-12','','2024-10-29 07:06:20','2024-10-29 07:06:20'),(147,'1956407203345869','Reginald Anderson','North Demarco','2009-01-03','','2024-10-29 07:06:20','2024-10-29 07:06:20'),(148,'9201123449792627','Dr. Laverne Breitenberg','Cummingshaven','1990-02-27','','2024-10-29 07:06:21','2024-10-29 07:06:21'),(149,'8883265335102640','Rafael Jacobs','New Verdie','1997-10-22','','2024-10-29 07:06:21','2024-10-29 07:06:21'),(150,'1273502174991629','Lila Halvorson','Kshlerinberg','1992-03-24','','2024-10-29 07:06:21','2024-10-29 07:06:21'),(151,'8112101112487556','Yvette Thompson','Kleinfort','1996-07-23','','2024-10-29 07:06:21','2024-10-29 07:06:21'),(152,'8558766039908823','Holden Sauer','Maeveland','1975-04-23','','2024-10-29 07:06:21','2024-10-29 07:06:21'),(153,'3172997483422518','Aiden Beatty MD','Rutherfordmouth','2018-04-20','','2024-10-29 07:06:21','2024-10-29 07:06:21'),(154,'8252353119894544','Golden Jacobson','Langworthton','2016-05-08','','2024-10-29 07:06:22','2024-10-29 07:06:22'),(155,'9283987344623904','Elisha Lang','Leschfurt','2016-06-05','','2024-10-29 07:06:22','2024-10-29 07:06:22'),(156,'7846689250243724','Kadin Satterfield','Lemkehaven','2004-02-25','','2024-10-29 07:06:22','2024-10-29 07:06:22'),(157,'6224944342789113','Darrell Dibbert','New Melany','1981-07-27','','2024-10-29 07:06:22','2024-10-29 07:06:22'),(158,'9368535659173169','Ms. Baby Buckridge','North Brandy','2019-02-20','','2024-10-29 07:06:23','2024-10-29 07:06:23'),(159,'3213383960270498','Donnie Brakus','Lake Antoniaberg','1985-09-06','','2024-10-29 07:06:23','2024-10-29 07:06:23'),(160,'8673139358844187','Miss Bonnie Koelpin','Stiedemannshire','1987-08-06','','2024-10-29 07:06:23','2024-10-29 07:06:23'),(161,'5195922811406136','Minnie Senger','New Rosemarie','1992-03-07','','2024-10-29 07:06:23','2024-10-29 07:06:23'),(162,'0592917680028772','Mr. Gilbert Hoppe DVM','Walterborough','1990-12-17','','2024-10-29 07:06:23','2024-10-29 07:06:23'),(163,'9903996304167513','Mr. Toney Runte MD','Manteport','1998-11-01','','2024-10-29 07:06:23','2024-10-29 07:06:23'),(164,'7593496663358160','Esta Deckow','Missouristad','2001-02-14','','2024-10-29 07:06:24','2024-10-29 07:06:24'),(165,'0863064181192255','Oscar Boyle','Mrazland','2001-01-11','','2024-10-29 07:06:24','2024-10-29 07:06:24'),(166,'2873692492832446','Isabelle Beier','Wolffville','1972-12-24','','2024-10-29 07:06:24','2024-10-29 07:06:24'),(167,'2864665904165484','Alexys Turner','Lake Gonzalo','2014-08-14','','2024-10-29 07:06:24','2024-10-29 07:06:24'),(168,'0608011382747325','Drake Kuhlman DVM','Lake Ayla','2005-02-20','','2024-10-29 07:06:24','2024-10-29 07:06:24'),(169,'9273785253715076','Tressie Mann','North Kiarra','2004-07-19','','2024-10-29 07:06:25','2024-10-29 07:06:25'),(170,'4553917605042560','Noelia Kuhic','North Marionfurt','1986-09-27','','2024-10-29 07:06:25','2024-10-29 07:06:25'),(171,'9878618720666557','Electa Emmerich','West Alphonso','1998-04-05','','2024-10-29 07:06:25','2024-10-29 07:06:25'),(172,'9158459496039123','Elyse VonRueden','New Herminiabury','1991-07-11','','2024-10-29 07:06:25','2024-10-29 07:06:25'),(173,'6098540766389902','Buck Zulauf','Owenburgh','1984-02-22','','2024-10-29 07:06:25','2024-10-29 07:06:25'),(174,'6549210246267783','Ms. Christy Schaden','Kundetown','2011-09-06','','2024-10-29 07:06:25','2024-10-29 07:06:25'),(175,'6439531603803554','Prof. Loyal Bogan','North Lamarstad','1998-01-31','','2024-10-29 07:06:26','2024-10-29 07:06:26'),(176,'3099116938944139','Giovani Leffler','New Cory','1984-03-22','','2024-10-29 07:06:26','2024-10-29 07:06:26'),(177,'9791477942389740','Emmitt Jast','Terryberg','2020-11-07','','2024-10-29 07:06:26','2024-10-29 07:06:26'),(178,'4964024059305900','Dr. Josh Heaney','North Jessycaland','2004-12-04','','2024-10-29 07:06:26','2024-10-29 07:06:26'),(179,'7224062174435467','Prof. Sean Bayer Jr.','North Wallace','1980-06-18','','2024-10-29 07:06:26','2024-10-29 07:06:26'),(180,'4962899980505201','Emie Kulas','Rosenbaumburgh','2000-11-29','','2024-10-29 07:06:27','2024-10-29 07:06:27'),(181,'3702504095182614','Vaughn Parisian','Handville','1985-02-03','','2024-10-29 07:06:27','2024-10-29 07:06:27'),(182,'0253078346877081','Dr. Ernestina Mohr','East Trevionport','1973-09-19','','2024-10-29 07:06:27','2024-10-29 07:06:27'),(183,'8683991029709409','Hazel Lakin','Port Arne','1985-08-17','','2024-10-29 07:06:27','2024-10-29 07:06:27'),(184,'7381908719503103','Tamara Wiegand','Lake Lucio','2010-08-05','','2024-10-29 07:06:27','2024-10-29 07:06:27'),(185,'2602915619071190','Stewart Christiansen','Fredyborough','2007-11-29','','2024-10-29 07:06:28','2024-10-29 07:06:28'),(186,'6669104902686774','Alexie Gusikowski','Rasheedville','1987-10-09','','2024-10-29 07:06:28','2024-10-29 07:06:28'),(187,'4805647129672342','Prof. Lera Jaskolski II','Myrtlemouth','2020-04-15','','2024-10-29 07:06:28','2024-10-29 07:06:28'),(188,'7766664400768444','Thalia Huels','Nicolaschester','1978-04-03','','2024-10-29 07:06:28','2024-10-29 07:06:28'),(189,'7315582448285623','Annamarie Johnson','Port Onie','1981-12-28','','2024-10-29 07:06:28','2024-10-29 07:06:28'),(190,'4662902918561800','Lorna Klocko','New Esther','1975-03-28','','2024-10-29 07:06:28','2024-10-29 07:06:28'),(191,'3508283372671995','Benton Pfeffer','East Jermain','1981-04-11','','2024-10-29 07:06:29','2024-10-29 07:06:29'),(192,'8325675396968735','Velma Morar','Opheliamouth','2011-11-20','','2024-10-29 07:06:29','2024-10-29 07:06:29'),(193,'6403399724265148','Reggie Lebsack','South Skyla','2017-11-18','','2024-10-29 07:06:29','2024-10-29 07:06:29'),(194,'9235413244718534','Maxie Maggio DVM','New Maybellbury','1978-08-17','','2024-10-29 07:06:29','2024-10-29 07:06:29'),(195,'6280624854826806','Haven Shanahan','Lake Lourdeschester','1998-08-20','','2024-10-29 07:06:29','2024-10-29 07:06:29'),(196,'9543079027417452','Justyn Renner','East Elissa','1973-09-11','','2024-10-29 07:06:29','2024-10-29 07:06:29'),(197,'4192169183875525','Tessie Cole DVM','West Samir','1976-03-16','','2024-10-29 07:06:30','2024-10-29 07:06:30'),(198,'5874078015628606','Braxton Eichmann DDS','Beerton','2009-05-24','','2024-10-29 07:06:30','2024-10-29 07:06:30'),(199,'1609322942370874','Cristopher Ryan','Lednershire','1983-01-31','','2024-10-29 07:06:30','2024-10-29 07:06:30'),(200,'8830808879781209','Lisa Sipes','North Reymundobury','1971-08-05','','2024-10-29 07:06:30','2024-10-29 07:06:30');

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`name`,`guard_name`,`group_name`,`created_at`,`updated_at`) values (1,'dashboard.view','admin','dashboard','2024-10-29 07:05:38','2024-10-29 07:05:38'),(2,'dashboard.edit','admin','dashboard','2024-10-29 07:05:38','2024-10-29 07:05:38'),(3,'blog.create','admin','blog','2024-10-29 07:05:39','2024-10-29 07:05:39'),(4,'blog.view','admin','blog','2024-10-29 07:05:39','2024-10-29 07:05:39'),(5,'blog.edit','admin','blog','2024-10-29 07:05:39','2024-10-29 07:05:39'),(6,'blog.delete','admin','blog','2024-10-29 07:05:40','2024-10-29 07:05:40'),(7,'blog.approve','admin','blog','2024-10-29 07:05:40','2024-10-29 07:05:40'),(8,'admin.create','admin','admin','2024-10-29 07:05:41','2024-10-29 07:05:41'),(9,'admin.view','admin','admin','2024-10-29 07:05:41','2024-10-29 07:05:41'),(10,'admin.edit','admin','admin','2024-10-29 07:05:42','2024-10-29 07:05:42'),(11,'admin.delete','admin','admin','2024-10-29 07:05:42','2024-10-29 07:05:42'),(12,'admin.approve','admin','admin','2024-10-29 07:05:43','2024-10-29 07:05:43'),(13,'role.create','admin','role','2024-10-29 07:05:43','2024-10-29 07:05:43'),(14,'role.view','admin','role','2024-10-29 07:05:43','2024-10-29 07:05:43'),(15,'role.edit','admin','role','2024-10-29 07:05:44','2024-10-29 07:05:44'),(16,'role.delete','admin','role','2024-10-29 07:05:44','2024-10-29 07:05:44'),(17,'role.approve','admin','role','2024-10-29 07:05:45','2024-10-29 07:05:45'),(18,'profile.view','admin','profile','2024-10-29 07:05:45','2024-10-29 07:05:45'),(19,'profile.edit','admin','profile','2024-10-29 07:05:46','2024-10-29 07:05:46'),(20,'profile.delete','admin','profile','2024-10-29 07:05:46','2024-10-29 07:05:46'),(21,'profile.update','admin','profile','2024-10-29 07:05:47','2024-10-29 07:05:47'),(22,'penduduk.create','admin','Data Penduduk','2024-10-29 07:05:47','2024-10-29 07:05:47'),(23,'penduduk.view','admin','Data Penduduk','2024-10-29 07:05:48','2024-10-29 07:05:48'),(24,'penduduk.edit','admin','Data Penduduk','2024-10-29 07:05:49','2024-10-29 07:05:49'),(25,'penduduk.delete','admin','Data Penduduk','2024-10-29 07:05:49','2024-10-29 07:05:49'),(26,'penduduk.update','admin','Data Penduduk','2024-10-29 07:05:50','2024-10-29 07:05:50'),(27,'penduduk.importexcel','admin','Data Penduduk','2024-10-29 07:05:50','2024-10-29 07:05:50'),(28,'penduduk.exportexcel','admin','Data Penduduk','2024-10-29 07:05:51','2024-10-29 07:05:51');

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(1,2),(2,2),(23,2),(28,2);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'superadmin','admin','2024-10-29 07:05:38','2024-10-29 07:05:38'),(2,'Pengunjung','admin','2024-10-29 07:09:50','2024-10-29 07:09:50');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'Adi Tri Cahyono','adicahyo@mail.com',NULL,'$2y$10$tOEUsCy73QqhjIaCHFQ6vO87nhRe90xQt.0DTSjzcZ1YPZayBZBDC',NULL,'2024-10-29 07:05:37','2024-10-29 07:05:37');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
