/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 5.7.19 : Database - bandit
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bandit` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `bandit`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(9,'2014_10_12_000000_create_users_table',1),
(10,'2014_10_12_100000_create_password_resets_table',1),
(11,'2018_01_25_094227_create_transacciones_table',1);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `transacciones` */

DROP TABLE IF EXISTS `transacciones`;

CREATE TABLE `transacciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `returnCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bankURL` varchar(900) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trazabilityCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transactionCycle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transactionID` int(11) DEFAULT NULL,
  `transactionState` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sessionID` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bankCurrency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bankFactor` double(8,2) DEFAULT NULL,
  `responseCode` int(11) DEFAULT NULL,
  `responseReasonCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responseReasonText` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requestDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bankProcessDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `onTest` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transacciones_user_id_foreign` (`user_id`),
  CONSTRAINT `transacciones_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `transacciones` */

insert  into `transacciones`(`id`,`user_id`,`returnCode`,`bankURL`,`trazabilityCode`,`transactionCycle`,`transactionID`,`transactionState`,`sessionID`,`bankCurrency`,`bankFactor`,`responseCode`,`responseReasonCode`,`responseReasonText`,`reference`,`requestDate`,`bankProcessDate`,`onTest`,`created_at`,`updated_at`) values 
(1,1,'SUCCESS','https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu9lymCR0U21n9ddGI3mmLh8bXu%2fdrpZLDolUJWXxokQG','1386791','2',1454289789,'NOT_AUTHORIZED','10625b8e4306ec28f47fbad99fc1f0d3','COP',1.00,3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.','1d3927b6d34cc375ae5bc46de071cb56','2018-01-25T10:56:04-05:00','2018-01-25T10:56:12-05:00',1,'2018-01-25 10:56:07','2018-01-25 11:09:44'),
(2,1,'SUCCESS','https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fTquYn%2bFKzqg3lTqjfW%2bD1loFIqtlXg7EEtGjDyvPgW','1386819','2',1454292336,NULL,'1e35ae761ba7835923bf18b87b0295fb','COP',1.00,3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.',NULL,NULL,NULL,NULL,'2018-01-25 11:28:28','2018-01-25 11:28:28'),
(3,1,'SUCCESS','https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fTquYn%2bFKzqg3lTqjfW%2bD1W2UCQtOAi4z3DvT9foLCp','1386820','2',1454292453,'OK','f5f66a829fe80a046dcc2a6e69ccd522','COP',1.00,3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.','1b6ea625c90cb5c64b903679001a0866','2018-01-25T11:31:22-05:00','2018-01-25T11:33:58-05:00',1,'2018-01-25 11:31:25','2018-01-25 11:34:26'),
(4,1,'SUCCESS','https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fTquYn%2bFKzqg3lTqjfW%2bD0ZDcnfsb0aDRXfPaoIM%2bW3','1386826','2',1454292610,'OK','9da69d9985aad0d2c5353fd604aa29ba','COP',1.00,3,'?-','Aprobada','75169b9ad24dcfcf16c1a6a00eb584f0','2018-01-25T11:35:57-05:00','2018-01-25T11:36:34-05:00',1,'2018-01-25 11:35:59','2018-01-25 11:37:18');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'juan carlos','juan2@correo.com','$2y$10$y5CZ4a120DLapV1VqspYquSL9tAU4Dn7FUoE.SswJkiJwP5zv9y8G',NULL,'2018-01-25 10:55:53','2018-01-25 10:55:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
