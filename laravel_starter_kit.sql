-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: laravel_starter_kit
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,'Permission','Data ini telah di-created','App\\Models\\Permission','created',30,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Lihat Audit Log\", \"slug\": \"auditlog.view\", \"menu_id\": 12}}',NULL,'2025-09-02 02:11:18','2025-09-02 02:11:18'),(2,'Permission','Data ini telah di-created','App\\Models\\Permission','created',31,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Audit Log\", \"slug\": \"audit-log.view\", \"menu_id\": 13}}',NULL,'2025-09-02 02:19:42','2025-09-02 02:19:42'),(3,'User','Data ini telah di-updated','App\\Models\\User','updated',5,'App\\Models\\User',12,'{\"old\": {\"name\": \"ljacobi\"}, \"attributes\": {\"name\": \"ljacobi.update\"}}',NULL,'2025-09-02 12:22:03','2025-09-02 12:22:03'),(4,'Menu','Data ini telah di-updated','App\\Models\\Menu','updated',3,'App\\Models\\User',12,'{\"old\": {\"name\": \"Manajemen Role\"}, \"attributes\": {\"name\": \"Manajemen Rl\"}}',NULL,'2025-09-02 12:38:35','2025-09-02 12:38:35'),(5,'Menu','Data ini telah di-updated','App\\Models\\Menu','updated',3,'App\\Models\\User',12,'{\"old\": {\"name\": \"Manajemen Rl\"}, \"attributes\": {\"name\": \"Manajemen Role\"}}',NULL,'2025-09-02 12:39:03','2025-09-02 12:39:03'),(6,'Permission','Data ini telah di-updated','App\\Models\\Permission','updated',17,'App\\Models\\User',12,'{\"old\": {\"name\": \"View Dashboard\"}, \"attributes\": {\"name\": \"Lihat Dashboard\"}}',NULL,'2025-09-02 22:46:03','2025-09-02 22:46:03'),(7,'Role','Data ini telah di-created','App\\Models\\Role','created',4,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Test Role Again\", \"slug\": \"test-role\"}}',NULL,'2025-09-04 16:20:43','2025-09-04 16:20:43');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`key`)
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
  PRIMARY KEY (`key`)
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
-- Table structure for table `menu_role`
--

DROP TABLE IF EXISTS `menu_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_role` (
  `menu_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`,`role_id`),
  KEY `menu_role_role_id_foreign` (`role_id`),
  CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_role`
--

LOCK TABLES `menu_role` WRITE;
/*!40000 ALTER TABLE `menu_role` DISABLE KEYS */;
INSERT INTO `menu_role` VALUES (1,1,'2025-09-02 02:28:43','2025-09-02 02:28:43'),(1,2,NULL,NULL),(1,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(2,1,'2025-09-02 02:28:43','2025-09-02 02:28:43'),(2,2,'2025-09-04 16:17:04','2025-09-04 16:17:04'),(2,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(3,1,'2025-09-02 02:28:43','2025-09-02 02:28:43'),(4,1,'2025-09-02 02:28:43','2025-09-02 02:28:43'),(5,1,'2025-09-02 02:28:43','2025-09-02 02:28:43'),(5,2,'2025-09-04 16:17:04','2025-09-04 16:17:04'),(6,1,'2025-09-02 02:28:43','2025-09-02 02:28:43'),(6,2,NULL,NULL),(6,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(7,1,'2025-09-02 02:28:43','2025-09-02 02:28:43'),(7,2,NULL,NULL),(7,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(8,1,'2025-09-02 02:28:44','2025-09-02 02:28:44'),(8,2,NULL,NULL),(11,1,'2025-09-02 02:28:43','2025-09-02 02:28:43'),(11,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(13,1,'2025-09-02 03:04:44','2025-09-02 03:04:44'),(13,2,'2025-09-04 16:17:04','2025-09-04 16:17:04');
/*!40000 ALTER TABLE `menu_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_route_name_unique` (`route_name`),
  KEY `menus_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,NULL,'Dashboard','dashboard','bi bi-grid-fill',1,'2025-08-25 17:13:48','2025-08-25 17:13:48'),(2,NULL,'RBAC',NULL,'bi bi-shield-fill',2,'2025-08-25 17:13:48','2025-09-01 16:13:48'),(3,2,'Manajemen Role','roles.index',NULL,1,'2025-08-25 17:13:48','2025-09-02 12:39:03'),(4,2,'Manajemen Permission','permissions.index',NULL,2,'2025-08-25 17:13:48','2025-08-25 17:13:48'),(5,2,'Manajemen Menu','menus.index',NULL,3,'2025-08-25 17:13:48','2025-08-25 17:13:48'),(6,NULL,'Manajemen Barang',NULL,'bi bi-box-seam-fill',3,'2025-08-25 17:13:48','2025-08-25 17:13:48'),(7,6,'Produk','products.index',NULL,1,'2025-08-25 17:13:48','2025-08-25 17:13:48'),(8,6,'Kategori','categories.index',NULL,2,'2025-08-25 17:13:48','2025-08-25 17:13:48'),(11,2,'Manajemen User','users.index',NULL,4,'2025-09-02 00:45:50','2025-09-02 00:45:50'),(13,NULL,'Audit Logs','audit-logs.index','bi bi-clock-fill',4,'2025-09-02 02:18:21','2025-09-02 02:18:21');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_08_24_065910_add_username_to_users_table',1),(5,'2025_08_24_085142_create_roles_table',1),(6,'2025_08_24_085152_create_menus_table',1),(7,'2025_08_24_085239_create_role_user_table',1),(8,'2025_08_24_085346_create_menu_role_table',1),(9,'2025_08_24_085431_remove_role_id_from_users_table',1),(10,'2025_08_24_100358_create_permissions_table',1),(11,'2025_08_24_100441_create_permission_role_table',1),(12,'2025_08_24_224709_add_menu_id_to_permissions_table',1),(13,'2025_09_02_085848_create_activity_log_table',2),(14,'2025_09_02_085849_add_event_column_to_activity_log_table',2),(15,'2025_09_02_085850_add_batch_uuid_column_to_activity_log_table',2);
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
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1,NULL,NULL),(2,1,NULL,NULL),(3,1,NULL,NULL),(4,1,NULL,NULL),(5,1,NULL,NULL),(5,2,NULL,NULL),(5,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(6,1,NULL,NULL),(6,2,'2025-09-04 16:17:04','2025-09-04 16:17:04'),(7,1,NULL,NULL),(7,2,'2025-09-04 16:17:04','2025-09-04 16:17:04'),(8,1,NULL,NULL),(8,2,'2025-09-04 16:17:04','2025-09-04 16:17:04'),(9,1,NULL,NULL),(9,2,NULL,NULL),(10,1,NULL,NULL),(10,2,NULL,NULL),(11,1,NULL,NULL),(12,1,NULL,NULL),(13,1,NULL,NULL),(14,1,NULL,NULL),(14,2,NULL,NULL),(17,1,NULL,NULL),(17,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(18,1,NULL,NULL),(18,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(19,1,NULL,NULL),(19,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(20,1,NULL,NULL),(20,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(21,1,NULL,NULL),(21,4,'2025-09-04 16:20:43','2025-09-04 16:20:43'),(22,1,NULL,NULL),(23,1,NULL,NULL),(24,1,NULL,NULL),(25,1,NULL,NULL),(26,1,NULL,NULL),(27,1,NULL,NULL),(28,1,NULL,NULL),(29,1,NULL,NULL),(31,1,'2025-09-02 02:20:50','2025-09-02 02:20:50');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`),
  KEY `permissions_menu_id_foreign` (`menu_id`),
  CONSTRAINT `permissions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,3,'Lihat Role','role.view','2025-08-25 17:13:48','2025-08-25 17:13:48'),(2,3,'Tambah Role','role.create','2025-08-25 17:13:48','2025-08-25 17:13:48'),(3,3,'Edit Role','role.edit','2025-08-25 17:13:48','2025-08-25 17:13:48'),(4,3,'Hapus Role','role.delete','2025-08-25 17:13:48','2025-08-25 17:13:48'),(5,7,'Lihat Produk','product.view','2025-08-25 17:13:48','2025-08-25 17:13:48'),(6,7,'Tambah Produk','product.create','2025-08-25 17:13:48','2025-08-25 17:13:48'),(7,7,'Edit Produk','product.edit','2025-08-25 17:13:48','2025-08-25 17:13:48'),(8,7,'Hapus Produk','product.delete','2025-08-25 17:13:48','2025-08-25 17:13:48'),(9,7,'Export Produk','product.export','2025-08-25 17:13:48','2025-08-25 17:13:48'),(10,8,'Lihat Kategori','category.view','2025-08-25 17:13:48','2025-08-25 17:13:48'),(11,8,'Tambah Kategori','category.create','2025-08-25 17:13:48','2025-08-25 17:13:48'),(12,8,'Edit Kategori','category.edit','2025-08-25 17:13:48','2025-08-25 17:13:48'),(13,8,'Hapus Kategori','category.delete','2025-08-25 17:13:48','2025-08-25 17:13:48'),(14,8,'Export Kategori','category.export','2025-08-25 17:13:48','2025-08-25 17:13:48'),(17,1,'Lihat Dashboard','view.dashboard','2025-09-01 18:20:16','2025-09-02 22:46:03'),(18,11,'Lihat user','users.view','2025-09-02 00:46:29','2025-09-02 00:46:29'),(19,11,'Edit User','users.edit','2025-09-02 00:46:47','2025-09-02 00:46:47'),(20,11,'Tambah User','users.create','2025-09-02 00:47:36','2025-09-02 00:47:36'),(21,11,'Hapus User','users.delete','2025-09-02 00:48:00','2025-09-02 00:48:00'),(22,4,'Tambah Permission','permission.create','2025-08-25 17:13:48','2025-08-25 17:13:48'),(23,4,'Edit Permission','permission.edit','2025-08-25 17:13:48','2025-08-25 17:13:48'),(24,4,'Hapus Permission','permission.delete','2025-08-25 17:13:48','2025-08-25 17:13:48'),(25,4,'Lihat Permission','permission.view','2025-08-25 17:13:48','2025-08-25 17:13:48'),(26,5,'Tambah Menu','menu.create','2025-08-25 17:13:48','2025-08-25 17:13:48'),(27,5,'Edit Menu','menu.edit','2025-08-25 17:13:48','2025-08-25 17:13:48'),(28,5,'Hapus Menu','menu.delete','2025-08-25 17:13:48','2025-08-25 17:13:48'),(29,5,'Lihat Menu','menu.view','2025-08-25 17:13:48','2025-08-25 17:13:48'),(31,13,'Lihat Audit Logs','audit-log.view','2025-09-02 02:19:42','2025-09-02 02:19:42');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user` (
  `role_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,NULL,NULL),(1,2,NULL,NULL),(1,12,NULL,NULL),(2,5,NULL,NULL),(2,6,NULL,NULL),(2,7,NULL,NULL),(2,8,NULL,NULL),(2,9,NULL,NULL),(2,10,NULL,NULL),(2,11,NULL,NULL);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Super Admin','admin','2025-08-25 17:13:48','2025-08-25 17:13:48'),(2,'Regular User','user','2025-08-25 17:13:48','2025-08-25 17:13:48'),(4,'Test Role Again','test-role','2025-09-04 16:20:42','2025-09-04 16:20:42');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('6unQvRL4MB6Vfci6bUm5GCwcM9SDvPHUjTSLVELq',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRjM0MnlZcjhBNTljYmxvVnUwNWQ3NUhlNnJ1Sm1hWDF5Y2tKN0ZiQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hdWRpdC1sb2dzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319',1757003005);
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
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin User Update','admin','admin@gmail.com','2025-08-25 17:13:49','$2y$12$5YAprNjrkznvyYdCwVJJPuO1wgyezQDsjZO03zmgSk9H4KoalNPtu','lLpsVxexZGU5AQUi6YCDXNRqMdxNV7qvxHW9fDnGJAFbOVWLvqOydVFxJk3Y','2025-08-25 17:13:50','2025-09-02 01:39:47'),(2,'sydnie.update','koepp.damian','jbartoletti@example.com','2025-08-25 17:13:50','$2y$12$SFk8Aw9jtc0nYusNj0YMqOaA.QyLTTQDP3w51IzKf/rJiDQUZ.mhe','7YqmoYIgGu','2025-08-25 17:13:52','2025-09-02 01:15:03'),(5,'ljacobi.update','funk.seth','schroeder.elaina@example.net','2025-08-25 17:13:50','$2y$12$MaiYmisHJdQIYKALDe1WnO17v7sKtymh8IWkYi9u03LQi6rdg2iFu','pr9ItYUVuQ','2025-08-25 17:13:52','2025-09-02 12:22:03'),(6,'mabel31','jacynthe07','labadie.ansley@example.com','2025-08-25 17:13:51','$2y$12$bkuwGxrG/lErsmubNbQWUepukiNBgqdfRHPnTdW9fLJ5qNl.IMOmq','Fjlq7z048h','2025-08-25 17:13:52','2025-08-25 17:13:52'),(7,'rippin.charlotte','barton.dayne','kauer@example.org','2025-08-25 17:13:51','$2y$12$FJSlVmofs6dd9BD8wk5GhOXOtgAboLvb93BVj9at9N7GACjOvH3Fm','tikGor6B1l','2025-08-25 17:13:52','2025-08-25 17:13:52'),(8,'quinton.emmerich','carleton.hettinger','natalie15@example.net','2025-08-25 17:13:51','$2y$12$RtUcn1dVyRfyvrDSiRWcUeXRJlWjc/m85B9JAb9TvrtvctlAvBb3W','QzkDTDhWRx','2025-08-25 17:13:52','2025-08-25 17:13:52'),(9,'estiedemann','gus78','jacobs.walter@example.com','2025-08-25 17:13:51','$2y$12$u0oJXv2mqNlIBDN/oCmkoe75zxOtWJtQowOt4DY0lJ1e2zJx2N9Ne','SBHBPKGNW8','2025-08-25 17:13:52','2025-08-25 17:13:52'),(10,'johns.samara','cleve42','bernadette33@example.org','2025-08-25 17:13:52','$2y$12$Y3xGklLtkbyAcmqh.7u5/uVAZ0JV3eTJeG.LokfBYZ6DSjAN9C7o.','o1qEnQVpnf','2025-08-25 17:13:52','2025-08-25 17:13:52'),(11,'hcormier','vokeefe','rodger.von@example.com','2025-08-25 17:13:52','$2y$12$8LK1yia00aVYmRm3LXKoXe7u2kd1dtbWG5wzeLDki60yy7LNJMqVe','QcyhYQ3um0','2025-08-25 17:13:52','2025-08-25 17:13:52'),(12,'Raka Hikmah Ramadhan','rakahikmah','rakahikmah46@gmail.com',NULL,'$2y$12$3Gcj/qJhJq4.gee6sVxzfOG8m.l1y79COdw3gCvK4ki061a8QLXES',NULL,'2025-09-02 01:01:57','2025-09-02 01:01:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel_starter_kit'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-04 23:42:17
