-- MySQL dump 10.13  Distrib 8.0.25-15, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: vipketering
-- ------------------------------------------------------
-- Server version	8.0.25-15

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
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1zqZWnAtWrflPTVL6agcby8KVJfKWlCizhRi0zlV',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzl6bUtFV204UTc3SE1pVDRDT2hNUFlZNEhTMDc1aG16aTF4WDVmRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781193192),('3Xn9mFMXrBHGCrgiur4H8WVXdUl3BTfUMG2EbhPk',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHRMc1ltcVhhVkZGbG5JcUt4ZFdrZlJKd29qRnYzSHVUZDdjWjdSNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781194143),('3Y7T8vrT7t7fBXOuXU1H7tXMjKirj9hNNewvz4zK',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicmFrYzduM2ppMlBoZVVKYmdJUXh0bnQ4d1RQN3NKaFh1aTFCaTV6QiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781192313),('4cQ4NauUMTSBQUnDpXMusaxvtxyv1z6zJTHB78Tn',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieHhUd29lNm1zMHJZTGF2WkpUbUtWME9DcVlRVjcwMWhnRUNnZmNzMCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781194676),('8ndBVQ9Rza8ARexlEAoyy6FbBlXvLyv2sB8byfR4',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjJTOTBNNTE0R3pXM3BWN0xCRjVaZll2SFJKSnJYcXBva1hmWU9NaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781198302),('8Xc1F60enyiT23bguagBaWf8YNTYGVuDmmJsUtRK',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDRvdFFBUUtibmh1Vm5qdUdmTnpyV21SZ2hFRzJyc1doNUk4OGpPbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781194459),('8zPeQigGbVwsR51R7EBVwiGkDpsERWZWhGT2baRx',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS3hRQThQYThaeDhOTjljanl3V1pUZWd3TUNrYmNXWVZzUTMxMkxJTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781196556),('AEwBFdCAeFXJaLPpml4AZYk5yDJClueOHegt5Lxi',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidTd2ckZKdWZOY1J0ZWJ6clFES2tVZklYZDhUYVI3SHlVRDkwWkRzRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvbWVuaWEiO3M6NToicm91dGUiO3M6NToibWVuaWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781194643),('ajdfSvvISgycsPklttpNUUQQDJhnU0EGhHxUJOma',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNjFqTjY0bHZjMHZwNTBPejIzT05iMjdZVEthOGFCU2xlQjNwVU1pNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781192747),('BMYVQ1lSL21Kd5iTQg2ncIXCAaY9suThkxKT7oos',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidzN4SlRhbmFxR0gyM0FuY2FCWkdmRFpUbURzM0JWcDkyenQwSVRZMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781196709),('bSJy89uXWzdlexQloLoYE3o0kG9y7gk9mPcxteUO',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoianU1TkVuSTZoNlV2R0dncXNvSFBZUENlSGtrYnd6ZG9BS1ZiUWtqYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvbWVuaWEiO3M6NToicm91dGUiO3M6NToibWVuaWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781193704),('bSnnObNesDkCEwPsTY1NiM0BZoJoLyXSff2ks8OC',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYng0VTdkemx4VTV5N0IyRVQ4dlpWb1NlN0xIaFNjVFNLREFMc2Q3WSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781193162),('bsznGpyWzjEkgirKlonfxGDSuDfYxFMDbMCICGzB',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTThjaWU5dUZJd01MMEpkSVFxSEhNVmlWNVg5UTRCWjNZaUpZQ1VQdCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781193187),('bZZ3z3QyfbZMjXvX68fWcAUEuy0GFT8k8iXgUKbn',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVVFkcTQ4VzNHN3FYNlM0RElGcFpvQ0NDNHpuUnlvdXM4RXpKajI4UCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781193160),('EGHfVYlcKk1IESTRNh3cSByIDiYO3InTGliCFrqM',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXY2eng3ejZyOUZ6SDdqanVmM1JMdVp3ZmNLNU9nYkg0STdyZTZSSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781192268),('gKVyxIaXWGDzZWU5yoynafzkIzDjVrpp7MsuLAdP',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUhpYWk1ZFBKMUxZalh6bUVUaUtrUm95bzFqUkxRMDdGdVIwTlZOdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781193190),('HYZeM8t31dQ9rdASqYHbE3rEpMIvCTXQ0GfafR9t',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTVNEWHROcTdDRldwMmhLdEE1ck9pTTEwQU5ob2YyUjNib2tWa29CWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvYWJvdXQiO3M6NToicm91dGUiO3M6NToiYWJvdXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781198329),('J0Rbfchhx4EPNGNZmWNn310KCqOk2yFd62RehhOQ',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkwzMGhXdWRXRWF0cHdhM3hkWUoxOFhsckZkVm55VkpBTGV3TmQzNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvbWVuaWEiO3M6NToicm91dGUiO3M6NToibWVuaWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781193683),('jboDBZHpqQpxiwP7xpWZgCmrfnMY3rJxZlgrPEM7',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlpPTlJ4VHNrWlJRZXBZN0ZoV3pyMUdsNnhDekFhTjA4OEluWW9uayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781195556),('k29B5y0bbKmSRR6wLcLmX5OPpjoXbWAYZhNNFjKx',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicTU5dHZSNlE5RGFlcmpuQnRSd2NONVRvelpidDJ4QjFTOHdDcmxSSCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781196353),('kFvNasDqUD0mU7Q59sriAjIB0HVD1NkzAYtpnqv6',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0NCekQ2NzhjMk95U25zakhCNjFGUVAzZVgzZzRvRk5ZYzZBZlZpSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781195509),('Kqu7TiMeZgfiLm08L0nbYIt58ZXOc91yZ2kPHzq3',NULL,'172.17.0.1','Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUJnV2dTZnN6TUlETHlDSWdBNklZdDJqZjFORTk2bFlXRXJ5c1FQciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvYWJvdXQiO3M6NToicm91dGUiO3M6NToiYWJvdXQiO319',1781198476),('LokicM9bZn57wDzRvXKUtB5yDkLk5ehIjB1MEd8y',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibzhyakE4SGN4NkxrWk5lcmh5WXljYUt4YVVraE9hNDc0OXo0ZlJzdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvYWJvdXQiO3M6NToicm91dGUiO3M6NToiYWJvdXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781198105),('mYrOwkTLsOxt4bvgrmBcB3Hzn86DjfOEN6te90LE',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSW16THpuMWtrRjFLemYwb256TEZkNmdaSXl5elh0STJRSjdtWlFyQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781194325),('NJJl1it0NE0xlOrVh65p50hBXmzZO8WAqk8iZvfv',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiejQzM1FsRW1Sa3R1ZExqZlQ4RVRVamg3aFBlMFIwNFZOaGlVUEtvZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781194030),('Nt7vCYfJZIIOp8v3qgAcVpGzXJCNV1HMFbkARwMn',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZnVVU2lBaVBYR0F3Z2xaa3Y0SWo4cHdDUjJsbmY3VDJaQmFwcUxDZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781194674),('OK4akxotxDQNaqLrmQShxZeAhW6OiNcktdGUDGlu',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZUZaYllwam92RGJSVlZsMzd3VU53c0FGVTZ0VU00N2kzSFpWQUw0bCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781194527),('pfzfQvc28tLksTHYR2spVRDoR9kVW9GJUnY9oOWI',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1FaMTBYZnJWcUpMek9RRFYwOFNpSVR2dDJ2cEtQUUFqRTNTUzlIcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781194369),('PzoShW4gyEanDkiPEqwGGXcXLaZguAdoSjjWtrSq',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2NzZXBYeGtZVXJCUFQyOVFrQzVKTzMyVnIyc0w4Nm10Q0h4OHBiRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvYWJvdXQiO3M6NToicm91dGUiO3M6NToiYWJvdXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781196788),('QlKTIvzgfTnl9eXKKNkRArTf0sVckjk32ZecFlGu',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTTBHY0wzRjI4ZU9iYkhVRnFiM1hBYWxxSDNTQW1vYld1ZjZZR3Q4eSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781192240),('Qpw8tziUfrBZ1DDVlGy5ZBTOkyQLbCg2nT3DxE7G',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmUxNXFjZWJCQ3oyNXlzc0xlMk5WWURNcDNDRkJKaUg3MWp0R3ZFSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvYWJvdXQiO3M6NToicm91dGUiO3M6NToiYWJvdXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781196790),('S6eTlgR3Fooe8qSksz9GBQLsrYvg3oj7wi4nAGkN',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibTFjNDNSd0I4WWxaOGZiNzNWYUdWQ3R1VEF3c0pqaTBvdGp5cjdmYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781192744),('t2k1e0cpZo6qzi1ESOjSOaZpiqF8xvCUKTPutvbH',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2dFdWVIQ3ppdVowQklYYmlMUmpIMDByTVlMM3hSMWI4YnIwSVhFbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781193844),('TOzjv3nn6trgpzn0w2EfT1kyPnGSaFwbSU3qNoGV',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQTV2dUttN0M0eUlFWEN5aWE1cE5EcnA3eGtlNWJ1VWU1aXQzNXM3UCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvY29udGFjdCI7czo1OiJyb3V0ZSI7czo3OiJjb250YWN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1781194525),('tskOmotvAffLw08SMAbBtFyhMeUqBBYBtpA5YJyz',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicG5IVDF2SW8zRFVabFd6bk1jZHlQbzBlNFhjM1NyU3NLa1pUOVVYdSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvb3ByZW1hIjtzOjU6InJvdXRlIjtzOjY6Im9wcmVtYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781193842),('vLRJ8p5h11IunKHe95h1SGx7ekYAghGWqHkP2Ovz',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnpwSW4yM0VkUnJUVlhaTkU2MnVHajE4NjBocG1CS1M3R3l4bGs5USI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781193184),('wC3DXoiBZkJ3FI79JsHYtiX2nRjZvBasWRSwmHW8',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOEVlME83MnQ5NFdPWGNTRmYya2ZUMndjN0VTTnE2WlFPR2IyN084NCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvYWJvdXQiO3M6NToicm91dGUiO3M6NToiYWJvdXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781193156),('xtnBA7KlKJOllTn5YGVsVCHD33l0JbobfUFWxXhq',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOFRFMTdzbFZURDMxUTJEeklJenBFaWYyWllZWk9QdndpOFJDQTJxbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvbWVuaWEiO3M6NToicm91dGUiO3M6NToibWVuaWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781193157),('Y8SyOiceN7hAcXhLHMsngvkgf8uL1QXyV5QyvZw8',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmlUdW9QajdoTDVqWlJCQTJpSEE3SlBHaFl0Nmt2SkhKNjNlVGZTWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwvbWVuaWEiO3M6NToicm91dGUiO3M6NToibWVuaWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1781193681),('YkdlN1h2fZHzPN9ILZLX0VfVZPOeGOowxbupRrj3',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) HeadlessChrome/148.0.7778.96 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoicW9TYm1oMDNDYzM1bm00bHh3QnlCNzljRzVza1EwaVhUZzJDWGFWcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vdmlwa2V0ZXJpbmcubG9jYWwiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1781193154);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'vipketering'
--
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-11 17:26:35
