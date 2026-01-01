-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: smp_cordova
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.2

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
-- Table structure for table `academic_calendars`
--

DROP TABLE IF EXISTS `academic_calendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `academic_calendars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_holiday` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `academic_calendars`
--

LOCK TABLES `academic_calendars` WRITE;
/*!40000 ALTER TABLE `academic_calendars` DISABLE KEYS */;
INSERT INTO `academic_calendars` VALUES (6,'{\"en\":\"Odd Semester Student Holidays\",\"id\":\"Libur Santri Semester Ganjil\"}','2025-12-18','2026-01-01','{\"en\":\"A vacation is a temporary break from work or school to recharge, relax, engage in recreational activities such as traveling, or spend time with family. It can be an official holiday designated by the government (such as a religious holiday, a national holiday, or a weekend) or personal leave for a specific purpose. Essentially, a vacation is a break from the daily routine for physical and mental recovery.\",\"id\":\"Libur adalah waktu istirahat sementara dari pekerjaan atau sekolah untuk memulihkan energi, bersantai, melakukan kegiatan rekreatif seperti berwisata, atau berkumpul dengan keluarga, yang bisa berupa hari libur resmi yang ditetapkan pemerintah (seperti hari besar keagamaan, nasional, atau akhir pekan) atau cuti pribadi untuk tujuan tertentu. Intinya, libur adalah jeda dari rutinitas harian untuk pemulihan fisik dan mental.\"}',0,'2025-12-27 12:40:53','2025-12-27 12:40:53');
/*!40000 ALTER TABLE `academic_calendars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `achievements`
--

DROP TABLE IF EXISTS `achievements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `achievements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` text COLLATE utf8mb4_unicode_ci,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` year NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `achievements`
--

LOCK TABLES `achievements` WRITE;
/*!40000 ALTER TABLE `achievements` DISABLE KEYS */;
INSERT INTO `achievements` VALUES (1,'{\"id\":\"Juara 1 Programming C++\",\"en\":\"1st Place in C++ Programming\"}','Arista','1','Nasional',2025,'{\"id\":\"Juara adalah sebuah\",\"en\":\"Champion is a\"}','01KD3WYV8D585ZYH9A1ET4SJVC.webp','2025-12-22 13:22:06','2025-12-27 14:06:31'),(2,'{\"id\": \"Juara Database Design by ORACLE ACADEMY\"}','Dedy Apriliyan','2','International',2025,'{\"id\": \"Oracle academy is\"}','01KD3WXZDZ414F6V22F2D627FC.webp','2025-12-22 13:23:57','2025-12-27 14:06:47'),(3,'{\"id\": \"Tahfidz Al-Quran\"}','Pristi','1','Provinsi',2025,'{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\"}','01KD3WVKR82WMQNXWE7DJMVKY2.jpg','2025-12-22 13:43:48','2025-12-27 14:07:02'),(4,'{\"id\": \"Juara Matematika\"}','Tata','3','Kecamatan',2025,'{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\"}','01KD3X8VSDZ2PJHMRRBEMS8982.jpg','2025-12-22 13:46:57','2025-12-27 14:07:16');
/*!40000 ALTER TABLE `achievements` ENABLE KEYS */;
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
INSERT INTO `cache` VALUES ('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1766949272),('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1766949272;',1766949272),('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3','i:1;',1766949647),('laravel-cache-livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer','i:1766949646;',1766949646);
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
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extracurriculars`
--

DROP TABLE IF EXISTS `extracurriculars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `extracurriculars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `schedule` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extracurriculars`
--

LOCK TABLES `extracurriculars` WRITE;
/*!40000 ALTER TABLE `extracurriculars` DISABLE KEYS */;
INSERT INTO `extracurriculars` VALUES (1,'{\"id\":\"Bulutangkis\",\"en\":\"Badminton\"}','extracurriculars/01KD3VY9GB1F4YKTMS3SHG4STV.jpeg','2025-12-22 13:26:29','2025-12-27 14:31:12','{\"id\":\"Bulu tangkis (badminton) adalah olahraga raket di mana dua pemain (tunggal) atau dua pasangan (ganda) saling memukul kok (shuttlecock) melewati net agar jatuh di area lawan, sambil mencegah kok jatuh di area sendiri, dengan tujuan mencetak poin; permainan ini mengandalkan kecepatan, kelincahan, dan strategi. Olahraga ini dimainkan dengan raket untuk memukul kok yang biasanya terbuat dari bulu angsa atau bahan sintetis agar melewati net ke lapangan lawan, dan dimainkan dalam berbagai kategori (tunggal putra/putri, ganda putra/putri, ganda campuran).\",\"en\":\"Badminton is a racket sport in which two players (singles) or two pairs (doubles) hit a shuttlecock over a net to make it land in the opponent\'s court, while preventing the shuttlecock from landing in their own court, with the goal of scoring points; the game relies on speed, agility, and strategy. It is played with rackets to hit the shuttlecock, usually made of goose feathers or synthetic materials, over the net to the opponent\'s court, and is played in various categories (men\'s/women\'s singles, men\'s/women\'s doubles, mixed doubles).\"}','{\"id\":\"Sabtu 08.00 - 11.00\",\"en\":\"Saturday 08.00 - 11.00\"}'),(2,'{\"id\":\"Robotik\",\"en\":\"Robotic\"}','extracurriculars/01KD3VZWA7WCFXX7192BKTSC8A.jpg','2025-12-22 13:28:40','2025-12-27 14:35:05','{\"id\":\"Robotik adalah bidang ilmu dan teknologi interdisipliner yang mempelajari desain, konstruksi, operasi, dan aplikasi robot, menggabungkan mekanika, elektronika, ilmu komputer, dan algoritma untuk menciptakan mesin otomatis yang bisa melakukan tugas secara mandiri atau membantu manusia, seperti di industri, medis, atau bahkan eksplorasi luar angkasa. Robot dapat berbentuk fisik (humanoid, industri) atau perangkat lunak (Robotic Process Automation), bertujuan meningkatkan efisiensi, presisi, dan keselamatan dalam berbagai aktivitas.\",\"en\":\"Robotics is an interdisciplinary field of science and technology that studies the design, construction, operation, and application of robots, combining mechanics, electronics, computer science, and algorithms to create automated machines that can perform tasks independently or assist humans, such as in industry, medicine, or even space exploration. Robots can be physical (humanoid, industrial) or software (Robotic Process Automation), aiming to improve efficiency, precision, and safety in various activities.\"}','{\"en\":\"Saturday 08.00 - 11.00\",\"id\":\"Sabtu 08.00 - 11.00\"}'),(3,'{\"id\": \"Pramuka\"}','extracurriculars/01KD8TZM492CXCJD3GT6J7N5YR.jpg','2025-12-22 13:29:03','2025-12-24 11:47:15','{\"id\": \"Pramuka (Praja Muda Karana) adalah organisasi pendidikan nonformal di Indonesia yang menyelenggarakan pendidikan kepanduan, bertujuan membentuk karakter generasi muda yang mandiri, disiplin, berjiwa sosial, tanggung jawab, dan cinta tanah air. Sebagai wadah proses pendidikan, Pramuka menanamkan nilai-nilai kebangsaan, kode kehormatan (Satya dan Darma), serta semangat gotong royong bagi anggota muda maupun dewasa.\"}','Sabtu 08.00 - 11.00'),(4,'{\"id\": \"Sepak Bola\"}','extracurriculars/01KD8V02RJM40Q7MB1341TEABF.jpg','2025-12-22 13:30:10','2025-12-24 11:47:30','{\"id\": \"Football artinya sepak bola, olahraga tim yang dimainkan dua tim beranggotakan 11 pemain, bertujuan mencetak gol ke gawang lawan dengan menendang bola menggunakan kaki, tanpa tangan atau lengan. Di Indonesia disebut \\\"sepak bola,\\\" sementara di negara-negara berbahasa Inggris, \\\"football\\\" merujuk pada Association Football (yang dikenal di AS sebagai soccer), dan ada juga American Football yang menggunakan tangan.\"}','Sabtu 08.00 - 11.00'),(5,'{\"id\": \"PMR\"}','extracurriculars/01KD3W3K3Z8WWC16AW39SWD0YY.jpg','2025-12-22 13:30:41','2025-12-22 13:30:49','{\"id\": \"PMR adalah singkatan dari Palang Merah Remaja, sebuah wadah pembinaan dan pengembangan anggota remaja yang dibina oleh Palang Merah Indonesia (PMI) di sekolah-sekolah atau kelompok pemuda, yang bertujuan membentuk karakter relawan masa depan melalui kegiatan kepalangmerahan seperti pertolongan pertama, kesehatan sekolah, siaga bencana, dan pelayanan sosial, dengan jenjang anggota Mula (SD), Madya (SMP), dan Wira.\"}','Sabtu 08.00 - 10.00'),(6,'{\"id\": \"Panahan\"}','extracurriculars/01KD8TJG0KY1QS15E42XQWRMKP.jpg','2025-12-24 11:40:05','2025-12-24 11:40:05','{\"id\": \"Panahan adalah olahraga atau keterampilan kuno yang melibatkan penggunaan busur untuk menembakkan anak panah ke sasaran, melatih fokus, kesabaran, dan ketepatan, serta memiliki sejarah panjang sebagai alat berburu, senjata perang, dan kini menjadi olahraga presisi yang dianjurkan dalam ajaran Islam.\"}','Setiap Sabtu, 08.00 WIB');
/*!40000 ALTER TABLE `extracurriculars` ENABLE KEYS */;
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
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('photo','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'photo',
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'{\"id\":\"Podkes\",\"en\":\"Podcast\"}','photo','galleries/01KD3QJ3VNZMF38TVVJ9RNWPFF.jpeg','fasilitas','{\"id\":\"Podcast adalah program digital (audio atau video) dalam format serial yang bisa diunduh atau di-streaming melalui internet, mirip radio namun bisa didengarkan kapan saja, di mana saja, dan diulang-ulang sesuai keinginan pendengar, membahas topik beragam seperti berita, komedi, edukasi, atau cerita, yang dibawakan oleh satu orang (monolog), wawancara, atau diskusi kelompok.\",\"en\":\"A podcast is a digital program (audio or video) in a serial format that can be downloaded or streamed via the internet, similar to radio but can be listened to anytime, anywhere, and repeated as desired by the listener, discussing various topics such as news, comedy, education, or stories, presented by one person (monologue), interviews, or group discussions.\"}','2025-12-22 12:11:14','2025-12-27 14:44:15'),(2,'{\"id\":\"Ruang Kelas\",\"en\":\"Classroom\"}','photo','galleries/01KD3QKMR1X4S2NHC1A5A0ABCN.jpeg','fasilitas','{\"id\":\"Kelas memadai adalah lingkungan fisik atau virtual yang menyediakan fasilitas lengkap, nyaman, dan fungsional—seperti ventilasi, pencahayaan, meja-kursi ergonomis, serta proyektor—untuk menunjang proses pembelajaran yang efektif dan kondusif. Ini adalah ruang belajar yang memenuhi standar keamanan dan kebersihan, sehingga meningkatkan fokus dan semangat belajar.\",\"en\":\"An adequate classroom is a physical or virtual environment that provides complete, comfortable, and functional facilities—such as ventilation, lighting, ergonomic desks and chairs, and a projector—to support an effective and conducive learning process. It is a learning space that meets safety and hygiene standards, thereby increasing focus and enthusiasm for learning.\"}','2025-12-22 12:12:04','2025-12-27 14:45:38'),(3,'{\"id\": \"Laboratorium Komputer\"}','photo','galleries/01KD3QP7V7JHY24GZ2AK5GMST6.jpg','fasilitas','{\"id\": \"Lab komputer adalah sebuah ruangan khusus yang dilengkapi berbagai perangkat keras (komputer, printer) dan lunak (aplikasi, sistem operasi) untuk mendukung kegiatan pendidikan, pelatihan, penelitian, dan praktik ilmiah terkait ilmu komputer atau teknologi informasi, berfungsi sebagai sarana praktikum, pusat pembelajaran digital, dan tempat pengembangan keterampilan TIK bagi siswa, mahasiswa, atau peneliti di sekolah, kampus, dan perkantoran.\"}','2025-12-22 12:13:29','2025-12-24 11:26:41'),(4,'{\"id\": \"Perpustakaan\"}','photo','galleries/01KD3QRPB4FFMXG3F0ZDNCSEZ5.jpeg','fasilitas','{\"id\": \"Perpustakaan adalah sebuah institusi atau tempat yang mengumpulkan, mengelola, dan menyediakan koleksi bahan pustaka (buku, jurnal, rekaman, dll.) secara sistematis untuk diakses oleh pengguna demi kepentingan pendidikan, penelitian, informasi, pelestarian, dan rekreasi, serta kini juga mencakup sumber daya digital dan internet. Intinya, perpustakaan bukan sekadar gudang buku, tetapi pusat informasi dinamis yang memfasilitasi pembelajaran sepanjang hayat dan pengembangan masyarakat.\"}','2025-12-22 12:14:50','2025-12-22 12:14:50');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_12_22_043924_create_achievements_table',1),(5,'2025_12_22_043924_create_galleries_table',1),(6,'2025_12_22_043924_create_posts_table',1),(7,'2025_12_22_043924_create_programs_table',1),(8,'2025_12_22_043924_create_sliders_table',1),(10,'2025_12_22_045728_create_settings_table',1),(11,'2025_12_22_053227_create_testimonials_table',1),(12,'2025_12_22_160959_create_extracurriculars_table',1),(13,'2025_12_22_170654_add_details_to_extracurriculars_table',1),(14,'2025_12_22_185335_create_academic_calendars_table',1),(15,'2025_12_23_054239_create_organizations_table',2),(16,'2025_12_23_055001_add_details_to_teachers_table',3),(17,'2025_12_22_043924_create_teachers_table',4),(18,'2025_12_23_060435_add_order_to_teachers_table',5),(19,'2025_12_23_083320_add_avatar_url_to_users_table',6),(20,'2025_12_23_084313_create_partners_table',7),(21,'2025_12_24_045825_add_is_published_to_testimonials_table',8),(22,'2025_12_24_135438_create_contact_messages_table',9),(23,'2025_12_24_143943_create_school_settings_table',10),(24,'2025_12_24_152559_make_email_nullable_in_contact_messages_table',11),(25,'2025_12_24_163521_add_brochure_to_school_settings_table',12),(26,'2025_12_24_180207_add_buttons_config_to_sliders_table',13),(27,'2025_12_27_033946_convert_text_columns_to_json',14),(28,'2025_12_27_184226_change_academic_calendars_to_json',15),(29,'2025_12_27_202107_change_achievements_to_json',16),(30,'2025_12_27_212506_change_extracurriculars_to_json',17),(31,'2025_12_27_213848_change_galleries_to_json',18),(32,'2025_12_27_215040_change_programs_to_json',19),(33,'2025_12_27_220332_change_sliders_to_json',20),(34,'2025_12_27_222543_change_teachers_to_json',21),(35,'2025_12_27_225403_change_testimonials_to_json',22),(36,'2025_12_27_233004_change_settings_value_to_json',23);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organizations`
--

DROP TABLE IF EXISTS `organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organizations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organizations`
--

LOCK TABLES `organizations` WRITE;
/*!40000 ALTER TABLE `organizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (1,'Quipper School Premium','partners/01KD56RZV8XN3279TPAN0QW62D.png','https://www.quipper.com',3,1,'2025-12-23 01:56:23','2025-12-28 12:09:20'),(2,'Bank Syariah Indonesia','partners/01KD56T45KA5RTM582VR9FQ7B1.png','https://www.bankbsi.co.id',4,1,'2025-12-23 01:57:00','2025-12-28 12:09:26'),(3,'Satrify Web','partners/01KD56X6WBXEH5E7KJDJPBZ202.png','https://satrify.my.id',5,1,'2025-12-23 01:58:41','2025-12-28 12:09:31'),(4,'Devisi IT Miha','partners/01KD56XX2RG6S2HQTXKNXAWKQ2.png','https://itmiha.my.id',6,1,'2025-12-23 01:59:04','2025-12-28 12:09:36'),(5,'Universitas Negeri Malang','partners/01KD8GBVNF59X9PVNMSSBD3JRJ.png','https://um.ac.id',2,1,'2025-12-24 08:38:58','2025-12-28 12:09:12'),(6,'Pondok Pesantren Mabadi\'ul Ihsan','partners/01KDK62Q8NC8FQAPC8D5XPFRTF.png','https://ponpesmabadiulihsan.or.id',1,0,'2025-12-28 12:09:05','2025-12-28 12:13:46');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` json NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('berita','artikel','agenda','pengumuman') COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` json NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `published_at` date DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'{\"en\": \"Tahlil and Joint Prayer for the Crew of KRI Nanggala 402, Together with the Regional Leadership Communication Forum (Forkopimda), Ulama & Santri\", \"id\": \"Tahlil dan Doa Bersama untuk Awak KRI Nanggala 402, Bersama Forkopimda, Ulama & Santri\"}','tahlil-dan-doa-bersama-untuk-awak-kri-nanggala-402-bersama-forkopimda-ulama-santri','artikel','{\"en\": \"<p>On Monday evening (April 26, 2021), a communal prayer and tahlil (remembrance of Allah) were held at the Mabadi&#039;ul Ihsan Islamic Boarding School.</p><p>The tahlil was performed with religious scholars (kiai) and students, adhering to health protocols. Prior to this, a prayer in absentia was also performed for the fallen patriots aboard the KRI Nanggala-402. This prayer was held after the congregational tarawih prayer.</p><p>&quot;Those who died were patriots of the nation. God willing, they will be martyred and receive the most honorable place in the sight of Allah SWT. We also continue to provide support to their families and strengthen them so they can get through this truly difficult time,&quot; explained the Regent of Banyuwangi.</p><p>We share your deep sorrow.</p><p>Let us send Al-Fatihah (remembrance of Allah) to the crew of the KRI NANGGALA 402 submarine. May Allah record them as martyrs.</p><p>They passed away during the month of Ramadan.</p><p>May all his deeds of worship be accepted and all mistakes be forgiven by Allah.</p><p>And may the families left behind be given strength, fortitude and sincerity.</p><p>Amen ..</p>\", \"id\": {\"type\": \"doc\", \"content\": [{\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"start\"}, \"content\": [{\"text\": \"Senin malam (26/4/2021) dilakukan do’a dan tahlil bersama di Ponpes Mabadi’ul Ihsan.\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"start\"}, \"content\": [{\"text\": \"Tahlil dilakukan bersama para kiai dan santri dengan penerapan protokol kesehatan. Sebelumnya, juga ditunaikan salat gaib untuk para patriot bangsa yang gugur di KRI Nanggala-402. Salat ghaib ini digelar usai salat tarawih berjamaah.\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"start\"}, \"content\": [{\"text\": \"“Beliau-beliau yang gugur merupakan patriot bangsa. InsyaAllah syahid, mendapat tempat paling mulia di sisi Allah SWT. Kita juga terus beri dukungan ke keluarga, kita kuatkan agar bisa melewati masa yang sungguh tidak mudah ini,” jelas Ibu Bupati Banyuwangi.\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"start\"}, \"content\": [{\"text\": \"Kami ikut merasakan duka yang mendalam ..\", \"type\": \"text\"}, {\"type\": \"hardBreak\"}, {\"text\": \"Mari kita kirimkan Alfatihah\", \"type\": \"text\"}, {\"type\": \"hardBreak\"}, {\"text\": \"kepada awak kapal selam KRI NANGGALA 402 semoga Allah catat sebagai syuhada.\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"textAlign\": \"start\"}, \"content\": [{\"text\": \"Mereka Allah wafatkan di Bulan Ramadhan.\", \"type\": \"text\"}, {\"type\": \"hardBreak\"}, {\"text\": \"Semoga semua Amal ibadahnya diterima dan semua khilaf Allah ampuni.\", \"type\": \"text\"}, {\"type\": \"hardBreak\"}, {\"text\": \"Dan semoga keluarga yang ditinggalkan diberi kekuatan, ketabahan serta keikhlasan.\", \"type\": \"text\"}, {\"type\": \"hardBreak\"}, {\"text\": \"Aamiin ..\", \"type\": \"text\"}]}]}}','posts/01KD3TYVDEDQHR3R49EVF9SPKP.jpg','published','2025-12-22',1,'2025-12-22 13:10:37','2025-12-27 11:28:44'),(2,'{\"id\": \"Mabadi’ul Ihsan Super Camp 2021\"}','mabadiul-ihsan-super-camp-2021','agenda','{\"id\": \"<p><strong><br>Membentuk Karakter Santri Mandiri Dan Disiplin</strong></p><p>MABADI’UL IHSAN – Super Camp adalah salah satu bentuk kegiatan untuk santri dalam hal kepemimpinan, kebiasaan yang efektif, dan keorganisasian. Rangkaian kegiatan ini berlangsung selama empat hari dimulai dari tanggal 19 – 22 November 2021. Berlokasikan di Lapangan Gedung Putih Mabadi’ul Ihsan, dimana lokasi tersebut dapat menunjang seluruh kegiatan Miha Super Camp 2021 ini.</p><p>Kegiatan “MIHA Super Camp 2021” yang memiliki tema “Pembentukan Karakter Dan Peningatan Disiplin Santri Cinta Tanah Air Yang Berwawasan Kebangsaan” merupakan wadah kreatifitas santri Pondok Pesantren Mabadi’ul Ihsan dalam meningkatkan kedisiplinan.</p><p>Rentetan kegiatan pada Miha Super Camp 2021 ini sangatlah beragam. Mulai dari aneka perlombaan, penanaman nilai Islami, Motivation Building, Malam Unggun Gembira, hingga Out Bound.</p><p><a href=\\\"http://127.0.0.1:8000/storage/BzwjObQf88QypIi34bSgN9XlyiZ4JFTAYv3YNsV2.jpg\\\"><img src=\\\"http://127.0.0.1:8000/storage/BzwjObQf88QypIi34bSgN9XlyiZ4JFTAYv3YNsV2.jpg\\\" width=\\\"640\\\" height=\\\"427\\\">lapangan.jpg 216.76 KB</a></p><p>Dengan dikonsep untuk berkelompok, masing-masing kelompok terdiri dari 15 hingga 20 santri yang tentunya mereka bermalam Bersama di asrama Gedung putih. Adapun seluruh santri di ikutsertakan dalam kegiatan ini, dan juga para Ustadz ditunjuk sebagai danton. Dengan konsep tersebut, para santri dituntut untuk berlatih mandiri, meningkatkan rasa kebersamaan, dan ber-survive didalam nuansa alam. Hingga, mereka dapat mempersiapkan diri mereka untuk terjun degan masyarakat luas di masa mendatang.</p><p>Latihan kedisiplinan ini sangat penting bagi semua santri karena berguna untuk melatih dan meningkatkan disiplin santri dalam menempuh pendidikan di sekolah maupun di pesantren hingga lulus nanti. Dengan kegiatan ini diharapkan santri lebih meningkatkan kesadarannya untuk disiplin bukan karena orang lain, disiplin adalah tuntutan diri sendiri bukan karena dituntut oleh orang lain, disiplin tidak identik dengan kekerasan, maka dari itu persepsinya harus diubah untuk bisa menjadi disiplin tidak selalu harus dengan kekerasan atau pembelajaran yang kaku.</p><p>Tujuan jangka pendek pelatihan ini adalah untuk meningkatkan kesadaran dalam arti bahwa untuk mengikuti kegiatan belajar mengajar di sekolah maupun di pesantren itu dibatasi oleh sekian banyak aturan atau tata tertib, maka dari itu seluruh santri harus bisa menyesuaikan atau beradaptasi dengan segala peraturan tersebut. Jika seluruh santri didalam diri masing-masing sudah memiliki kesadaran untuk berlaku disiplin, maka otomatis kegiatan belajar mengajar di sekolah maupun di pesantren akan berjalan lancar dan tertib.</p><p>Sedangkan untuk tujuan jangka panjang adalah latihan kedisiplinan akan berdampak positif bagi para santri dimanapun dia berada selalu mengikuti aturan karena di dalam dirinya sudah memiliki kesadaran untuk berdisiplin.</p>\"}','posts/01KD3V3TPDQ2KXDYVXKHMWPNHA.jpg','published','2025-12-22',1,'2025-12-22 13:13:20','2025-12-24 05:26:40'),(3,'{\"id\": \"Programming Class by Satria Yudha Pratama, S.Kom.\"}','programming-class-by-satria-yudha-pratama-skom','pengumuman','{\"id\": \"<p>Guru sangat berperan dalam menciptakan ekosistem pembelajaran yang kolaboratif, berbasis teknologi, serta mampu mengembangkan potensi peserta didik secara optimal. Namun kompetensi guru di bidang koding dan kecerdasan artifisial dipandang belum optimal dan belum merata. Diperlukan “Pelatihan Koding dan Kecerdasan Artifisial untuk Guru-guru Penggerak pada Balai Guru Penggerak Provinsi Bali.” Pengabdian diawali dengan <em>focus group discussions (FGD) </em>melibatkan pelaksana pengabdian dan pengelola Balai Guru Penggerak Provinsi Bali untuk membahas program pengabdian. Setelah FGD, pelatihan dilaksanakan dengan model heuristik yang sudah teruji mampu menghasilkan keterampilan koding dalam waktu singkat. Sambil melakukan evaluasi formatif, tim pengabdian terus melakukan pendampingan, sementara pengelola melakukan pemantauan. Setelah pembelajaran berakhir dilakukan evaluasi sumatif oleh instruktur, pengelola, dan tim independen. Hasil evaluasi menunjukkan bahwa pelatihan mampu meningkatkan keterampilan koding para guru penggerak. Guru penggerak diminta mendiseminasikan keterampilan kepada para guru. Hasil akhir yang diharapkan adalah peningkatan kompetensi peserta didik di bidang koding dan kecerdasan artifisial.</p>\"}','posts/01KD3VAEV99M86MTVGS3KQ683Z.jpg','published','2025-12-22',1,'2025-12-22 13:16:58','2025-12-23 23:44:11'),(5,'{\"en\": \"Islamic Boarding Schools\", \"id\": \"Sekolah Berbasis Pondok Pesantren\"}','sekolah-berbasis-pondok-pesantren','berita','{\"en\": \"<div class=\\\"lead\\\"><p><strong>Cordova Plus Middle School Profile</strong></p></div><p>Cordova Plus Middle School is a pesantren-based school under the auspices of the Mabadi&#039;ul Ihsan Islamic Boarding School Foundation. It is located in Tegalsari District, Banyuwangi Regency, specifically on Jl. KH. Achmad Musayyidi, Karangdoro.</p><p>Cordova Plus Middle School is a modern Islamic educational institution complete with various adequate facilities. Currently, Cordova Plus Middle School has 22 classes with around 700 students, all of whom are required to live in boarding schools.</p><p>As an inspiring and innovative modern pesantren-based school, Cordova Plus Middle School strives to produce a generation that is Rabbani (Islamic-based), Qur&#039;anic, independent, and high-achieving, mastering science and technology, and upholding the Faith and Faith of God (Imtaq).</p><p>Cordova Plus Middle School aims to develop its students into students who are excellent, whole, and possess noble character for the glory and glory of Islam and the Muslim community.</p>\", \"id\": {\"type\": \"doc\", \"content\": [{\"type\": \"lead\", \"content\": [{\"type\": \"paragraph\", \"attrs\": {\"class\": null, \"style\": null, \"textAlign\": \"start\"}, \"content\": [{\"text\": \"Profil SMP Plus Cordova\", \"type\": \"text\", \"marks\": [{\"type\": \"bold\"}]}]}]}, {\"type\": \"paragraph\", \"attrs\": {\"class\": null, \"style\": null, \"textAlign\": \"start\"}, \"content\": [{\"text\": \"SMP Plus Cordova merupakan sekolah yang berbasis pesantren berada di bawah naungan Yayasan Pondok Pesantren Mabadi’ul Ihsan yang terletak di Kecamatan Tegalsari, Kabupaten Banyuwangi, tepatnya di Jl. KH. Achmad Musayyidi Karangdoro.\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"class\": null, \"style\": null, \"textAlign\": \"start\"}, \"content\": [{\"text\": \"SMP Plus Cordova menjadi lembaga pendidikan islam modern lengkap dengan berbagai fasilitas yang mumpuni. Saat ini SMP Plus Cordova memiliki 22 rombel dengan jumlah 700an peserta didik yang keseluruhan diwajibkan mondok.\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"class\": null, \"style\": null, \"textAlign\": \"start\"}, \"content\": [{\"text\": \"Sebagai sekolah berbasis pesantren modern yang inspiratif dan inovatif SMP Plus Cordova berupaya mencetak generasi yang rabbani, qur’ani. Mandiri dan berprestasi yang menguasai IPTEK dan memiliki IMTAQ.\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"class\": null, \"style\": null, \"textAlign\": \"start\"}, \"content\": [{\"text\": \"SMP Plus Cordova ingin mewujudkan siswa-siswinya menjadi siswa yang Unggul, Utuh, dan Berakhlakul Karimah untuk kemulian dan kejayaan Islam serta kaum muslimin.\", \"type\": \"text\"}]}, {\"type\": \"paragraph\", \"attrs\": {\"class\": null, \"style\": null, \"textAlign\": \"start\"}}]}}','posts/01KD8VJ5FRGGV5PGJG0SAFWFC1.jpeg','published','2025-12-24',1,'2025-12-24 11:57:22','2025-12-27 11:27:26'),(6,'{\"en\": \"National Santri Day 2026\", \"id\": \"Hari Santri Nasional 2026\"}','hari-santri-nasional-2026','berita','{\"en\": {\"type\": \"doc\", \"content\": [{\"type\": \"paragraph\", \"attrs\": {\"class\": null, \"style\": null, \"textAlign\": \"start\"}, \"content\": [{\"text\": \"Can you show us some samples of your writing? If that’s something you keep hearing but cannot say a confident yes to, you’re at the right place. We’ll show you 23 examples of how others write and present their content writing samples and answer some of the most frequently asked questions.\", \"type\": \"text\"}]}]}, \"id\": \"<p>Bisakah Anda menunjukkan kepada kami beberapa contoh tulisan Anda? Jika Anda sering mendengar pertanyaan ini tetapi tidak bisa menjawab dengan yakin, Anda berada di tempat yang tepat. Kami akan menunjukkan kepada Anda 23 contoh bagaimana orang lain menulis dan mempresentasikan sampel tulisan konten mereka, serta menjawab beberapa pertanyaan yang paling sering diajukan.</p>\"}','posts/01KDG4ZSRCZZ9H65D2XFFDR5X7.jpg','published','2025-12-27',1,'2025-12-27 07:56:47','2025-12-27 07:56:47');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programs`
--

LOCK TABLES `programs` WRITE;
/*!40000 ALTER TABLE `programs` DISABLE KEYS */;
INSERT INTO `programs` VALUES (1,'{\"id\":\"Kurikulum International\",\"en\":\"International Curriculum\"}','{\"id\":\"Mengadopsi standar Cambridge untuk mata pelajaran Sains, Matematika, dan Bahasa Inggris guna kesiapan global.\",\"en\":\"Adopting Cambridge standards for Science, Mathematics and English subjects for global readiness.\"}','globe','programs/01KD3W5FRNPEKGXJ6DX8D8244C.jpeg','2025-12-22 12:45:40','2025-12-27 14:58:04'),(2,'{\"id\": \"Tahfidz Al-Quran\"}','{\"id\": \"Program unggulan hafalan intensif dengan target pencapaian mutqin dan bersanad bagi setiap lulusan.\"}','book-open','programs/01KD3W685R1TSRX2QVY63W0V87.jpeg','2025-12-22 12:47:07','2025-12-22 13:32:08'),(3,'{\"id\": \"Sains & Teknologi\"}','{\"id\": \"Fasilitas laboratorium modern, coding, dan robotik untuk menunjang kreativitas dan logika siswa.\"}','cpu','programs/01KD3W75ZK6Z82W192RCGV3EVB.avif','2025-12-22 12:47:46','2025-12-22 13:32:39'),(4,'{\"id\": \"Character Building\"}','{\"id\": \"Pembentukan karakter islami melalui pembiasaan ibadah harian, adab, dan kedisiplinan asrama.\"}','user-group','programs/01KD3W7YCBH3EKZVT7FBA444FW.jpeg','2025-12-22 12:48:11','2025-12-22 13:33:04');
/*!40000 ALTER TABLE `programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_settings`
--

DROP TABLE IF EXISTS `school_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `school_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `maps_embed` text COLLATE utf8mb4_unicode_ci,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brochure` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_settings`
--

LOCK TABLES `school_settings` WRITE;
/*!40000 ALTER TABLE `school_settings` DISABLE KEYS */;
INSERT INTO `school_settings` VALUES (1,'smpplus.cordova@gmail.com','08973266517','Jl. K.H. Achmad Musayyidi No.177, Karangdoro, Kec. Tegalsari, Kabupaten Banyuwangi, Jawa Timur','<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.910500818144!2d114.10413899999999!3d-8.4104508!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd40031f0baa059%3A0x994411cc9256f80d!2sSMP%20PLUS%20CORDOVA%20BANYUWANGI!5e0!3m2!1sid!2sid!4v1766588189875!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>','smppluscordova','smppluscordova',NULL,'smppluscordova','2025-12-24 07:56:58','2025-12-24 09:57:22','brochures/01KD8MPDVKKK59056SDQBQDRG9.jpg');
/*!40000 ALTER TABLE `school_settings` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('4kIvLRWuGuPeXdkR39x4xRflPf3FC9ZzMpHrAdIm',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSXkxSFZzNGV0WmVJSGt4aXZqMjVpTkFTOENhZmQ4M0RUWUNSVzIzRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJsb2NhbGUiO3M6MjoiZW4iO30=',1766950270);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'home_video','{\"en\":\"https://youtu.be/HNxNHuw7gik\",\"id\":\"https://youtu.be/HNxNHuw7gik\"}','text','2025-12-22 12:22:33','2025-12-27 16:37:50'),(2,'home_about_title','{\"en\":\"Integrating Islamic Values & International Standards\",\"id\":\"Integrasi Nilai Pesantren & Standar Internasional\"}','text','2025-12-22 12:31:08','2025-12-27 16:43:15'),(3,'home_about_desc','{\"en\":\"SMP Plus Cordova presents a holistic education concept combining the national curriculum, Cambridge global perspectives, and Quranic character building characteristic of Islamic boarding schools. We are committed to shaping a generation that is not only intellectually bright but also morally and spiritually graceful.\",\"id\":\"SMP Plus Cordova hadir dengan konsep pendidikan holistik yang memadukan kurikulum nasional, wawasan global Cambridge, dan pembentukan karakter Qurani khas pesantren. Kami berkomitmen mencetak generasi yang tidak hanya cerdas secara intelektual, tetapi juga anggun dalam moral dan spiritual.\"}','textarea','2025-12-22 12:32:52','2025-12-27 16:43:40'),(4,'home_feat1_title','{\"en\":\"Cambridge & National Curriculum\",\"id\":\"Kurikulum Cambridge & Nasional\"}','text','2025-12-22 12:34:41','2025-12-27 16:44:03'),(5,'home_feat1_desc','{\"en\":\"A curriculum synergy preparing students to compete globally without forgetting their cultural roots.\",\"id\":\"Sinergi kurikulum yang mempersiapkan siswa bersaing di kancah global tanpa melupakan akar budaya bangsa.\"}','text','2025-12-22 12:35:13','2025-12-27 16:45:49'),(6,'home_feat2_title','{\"en\":\"Digital & Smart Classroom\",\"id\":\"Digital & Smart Classroom\"}','text','2025-12-22 12:35:33','2025-12-27 17:13:11'),(7,'home_feat2_desc','{\"en\":\"Learning based on the latest technology to support student digital literacy and creativity.\",\"id\":\"Pembelajaran berbasis teknologi terkini untuk mendukung literasi digital dan kreativitas siswa.\"}','text','2025-12-22 12:35:54','2025-12-27 17:13:33'),(8,'profile_history','{\"en\":\"Mabadi\'ul Ihsan Islamic Boarding School, often abbreviated as PP. MIHA, was founded by KH. Achmad Musayyidi Munaqib. Established in 1964, the boarding school is located in Karangdoro Village, Tegalsari District, Banyuwangi Regency. Currently, under the guidance of KH. Masykur Wardi and Nyai Hj. Murtasimah, Mabadi\'ul Ihsan Islamic Boarding School has several formal and informal institutions.\\nMabadi\'ul Ihsan Islamic boarding school is one of 10 Islamic boarding schools receiving business assistance from HIPMI, namely MIHA MART. Furthermore, students are taught to care for the environment through waste management training conducted by the Environmental Agency. They are taught to be productive by repurposing used materials into valuable products.\",\"id\":\"Pondok Pesantren Mabadi\'ul Ihsan atau yang sering disingkat PP. MIHA didirikan oleh KH. Achmad Musayyidi Munaqib. Pondok Pesantren yang didirikan pada tahun 1964 Masehi itu terletak di Desa Karangdoro, Kecamatan Tegalsari, Kabupaten Banyuwangi. Saat ini Pondok Pesantren Mabadi\'ul Ihsan yang diasuh oleh KH. Masykur Wardi dan Nyai Hj. Murtasimah ini memiliki beberapa lembaga formal dan non formal.\\nPesantren mabadi\'ul Ihsan menjadi salah satu dari 10 Pesantren yang mendapatkan Bantuan Usaha dari HIPMI yakni MIHA MART. Selain itu santri juga dididik untuk peduli terhadap lingkungan dengan pelatihan pengolahan sampah yang diadakan oleh Dinas Lingkungan Hidup dan diajarkan untuk menjadi santri yang produktif dengan memanfaatkan barang bekas menjadi barang yang bagus.\"}','textarea','2025-12-22 13:53:20','2025-12-27 17:18:52'),(9,'profile_vision','{\"en\":\"Producing human resources who are intelligent, creative, have noble morals, are innovative, play an active role in environmental preservation and are cadres of the nation and religion.\",\"id\":\"Mencetak sumber daya manusia yang cerdas, kreatif, berakhlaq mulia, inovatif, berperan aktif  dalam pelestarian lingkungan hidup dan sebagai kader bangsa dan agama.\"}','textarea','2025-12-22 13:53:47','2025-12-27 17:15:44'),(10,'profile_mission','{\"en\":\"Making the Qur\'an and As-Sunnah, with an understanding of the pious predecessors, the foundation of education.\\nIncreasing religious activities and environmental preservation to build and improve the quality of life in the nation.\\nCultivating a spirit of excellence and professionalism in all aspects.\",\"id\":\"Menjadikan Al – Qur’an dan As – Sunnah dengan pemahaman salafus sholih sebagai landasan pendidikan\\nMeningkatkan kegiatan – kegiatan keagamaan dan pelestarian lingkungan untuk membangun dan meningkatkan kualitas hidup negara\\nMenumbuhkan semangat keunggulan dan profesionalisme dalam segala hal\"}','textarea','2025-12-22 13:54:09','2025-12-27 17:16:09');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` text COLLATE utf8mb4_unicode_ci,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `open_new_tab` tinyint(1) NOT NULL DEFAULT '0',
  `button2_text` text COLLATE utf8mb4_unicode_ci,
  `button2_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button2_new_tab` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (1,'{\"id\":\"Selamat Datang di SMP Plus Cordova\",\"en\":\"Welcome to Cordova Plus Middle School\"}','{\"id\":\"SMP Plus Cordova menjadi lembaga pendidikan islam modern lengkap dengan berbagai fasilitas yang mumpuni. Saat ini SMP Plus Cordova memiliki 22 rombel dengan jumlah 700an peserta didik yang keseluruhan diwajibkan mondok.\",\"en\":\"Cordova Plus Middle School is a modern Islamic educational institution complete with a variety of excellent facilities. It currently has 22 classes with around 700 students, all of whom are required to live in boarding schools.\"}','sliders/01KDDG1NTQF87R9CF91DVRTAVH.jpg','{\"id\":\"Daftar Sekarang\",\"en\":\"Register Now\"}','https://ppdb.ponpesmiha.online/',1,'{\"id\":\"Youtube\",\"en\":\"Youtube\"}','https://youtu.be/HNxNHuw7gik',1,1,1,'2025-12-22 12:19:07','2025-12-28 11:41:47'),(2,'{\"id\":\"Penerimaan Peserta Didik Baru Telah Dibuka\",\"en\":\"New Student Admissions Have Opened\"}','{\"id\":\"PPDB Tahun Pelajaran 2026–2027 Resmi Dibuka!\\nSaatnya bergabung bersama kami untuk mendapatkan pendidikan terbaik, lingkungan belajar yang nyaman, dan tenaga pendidik profesional. Unduh petunjuk teknis PSB di sini untuk informasi pendaftaran selengkapnya.\",\"en\":\"The 2026–2027 Academic Year Student Admissions (PPDB) is officially open!\\nNow is the time to join us for the best education, a comfortable learning environment, and professional teaching staff. Download the PSB technical guidelines here for complete regis\"}','sliders/01KDDG1ZFZHFK5EJQK29XJ2K8Z.jpeg','{\"id\":\"Unduh Brosur\",\"en\":\"Download Brochure\"}','/storage/brochures/01KD8MPDVKKK59056SDQBQDRG9.jpg',1,'{\"id\":\"Youtube\",\"en\":\"Youtube\"}','https://youtu.be/HNxNHuw7gik',1,1,2,'2025-12-22 12:20:12','2025-12-27 17:25:49'),(3,'{\"id\":\"Pondok Pesantren Mabadi\'ul Ihsan Daar Al Ihsan\",\"en\":\"Mabadi\'ul Ihsan Daar Al Ihsan Islamic Boarding School\"}','{\"id\":\"Menghadirkan pengalaman belajar yang menyatukan kekuatan tradisi pesantren dan pendidikan modern. Di sini, setiap siswa dibina menjadi pribadi berkarakter, cerdas, dan siap bersaing. Dengan program unggulan, pembinaan intensif, dan lingkungan.\",\"en\":\"Providing a learning experience that combines the strengths of Islamic boarding school tradition with modern education. Here, each student is nurtured into a person of character, intelligence, and readiness to compete. Through excellent programs, intensiv\"}','sliders/01KDDG329YVMWZ39MNVDWJCFWY.jpeg','{\"id\":\"Kunjungi Kami\",\"en\":\"Visit Us\"}','https://ponpesmabadiulihsan.or.id',1,'{\"id\":\"Youtube\",\"en\":\"Youtube\"}','https://youtu.be/HNxNHuw7gik',1,1,3,'2025-12-22 12:42:54','2025-12-27 17:28:37'),(4,'{\"id\":\"Program Unggulan SMP Plus Cordova\",\"en\":\"Cordova Plus Middle School\'s Flagship Program\"}','{\"id\":\"Menghadirkan pembelajaran inovatif, penguatan karakter Islami, serta pendampingan prestasi akademik dan non-akademik untuk menyiapkan siswa menghadapi masa depan.\",\"en\":\"Providing innovative learning, strengthening Islamic character, and mentoring academic and non-academic achievements to prepare students for the future.\"}','sliders/01KDDG3BVSZZYQDG380K4TVXZS.jpg','{\"id\":\"Lihat Program\",\"en\":\"View Program\"}','/profil/program-unggulan',0,'{\"id\":\"Youtube\",\"en\":\"Youtube\"}','https://youtu.be/HNxNHuw7gik',1,1,4,'2025-12-24 10:59:01','2025-12-27 17:29:43');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (1,'Bill Gates, M.Kom.','{\"id\":\"Kepala Sekolah\",\"en\":\"Headmaster\"}','pimpinan',0,'teachers/01KD85KHEX8K3RJY6ZABX2ZWGM.jpg','{\"id\":\"Anda tidak dapat menghubungkan titik-titik di masa depan; Anda hanya dapat menghubungkannya dengan melihat ke belakang. Jadi, Anda harus percaya bahwa titik-titik itu akan terhubung di masa depan Anda.\",\"en\":\"You can’t connect the dots looking forward; you can only connect them looking backward. So you have to trust that the dots will somehow connect in your future.\"}','S1 - UIN Malang','hariyanto','hariyanto','hariyanto','teachers/cv/01KD4X4J0MA941JCPB1A65MCST.jpg','2025-12-22 23:07:56','2025-12-27 15:33:00'),(2,'Satria Yudha Pratama, S.Kom.','{\"id\": \"Programming Laravel\"}','guru',0,'teachers/01KDBASEVZPF1CQ0YKDMJY2ZVY.png','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\"}','S1 - Universitas Muhammadiyah Malang','sayudabimanyu','sayudabimanyu','sayudabimanyu','teachers/cv/01KD4X6KTAYA35ZQY38QF6NK6Q.jpg','2025-12-22 23:09:03','2025-12-25 11:01:59'),(3,'Mark Zuckerberg, S.Kom.','{\"id\": \"Coding and Artificial Intelligence\"}','guru',0,'teachers/01KD865MQ6Q6SGG5PNXSMQ8386.jpg','{\"id\": \"Mark Zuckerberg sering menekankan misi menghubungkan dunia, pentingnya inovasi berkelanjutan, dan memberi suara kepada semua orang untuk menciptakan perubahan positif, seperti dalam pidatonya di wisuda Harvard 2017 yang menyerukan aksi mengatasi ketidaksetaraan dan membangun tujuan bersama, serta mencontohkan kegagalan sebagai bagian dari kesuksesan dan peran \\\"keberuntungan\\\" dalam hidupnya.\"}','S1 - Universitas Brawijaya',NULL,NULL,NULL,NULL,'2025-12-24 05:38:28','2025-12-24 05:53:25'),(4,'Steve Jobs, M.Kom.','{\"id\": \"User Interface & User Experience\"}','guru',0,'teachers/01KD862G7W3WWM42HEY8VPHPPA.jpg','{\"id\": \"Sambutan Steve Jobs, terutama pidato wisudanya di Stanford 2005, berfokus pada tiga cerita hidup tentang menghubungkan titik-titik (melihat pola dari pengalaman lalu), cinta dan kehilangan (menemukan apa yang Anda cintai), dan kematian (menghargai waktu dan hidup sesuai hati nurani). Pesan utamanya adalah \\\"Stay Hungry, Stay Foolish\\\" (Tetap Lapar, Tetap Bodoh) sebagai dorongan untuk tidak pernah puas dan selalu berani berbeda, mengikuti kata hati, dan tidak terjebak oleh ekspektasi orang lain.\"}','S1 - Universitas Siber Muhammadiyah',NULL,NULL,NULL,NULL,'2025-12-24 05:41:49','2025-12-24 05:41:49'),(5,'Jack Ma, S.Kom.','{\"id\": \"Digital Marketing\"}','guru',0,'teachers/01KD86CGEZXAHFCAYB87RJQGCP.jpg','{\"id\": \"Ma mensyukuri semua kesalahan dan penolakan yang pernah didapatkannya. “Karena tanpa itu semua tidak akan ada Alibaba,” ucap dia sebagaimana dikutip dari kanal YouTube Sukses Daily, Sabtu (21/5/2022) malam.\"}','S1- Politeknik Negeri Malang',NULL,NULL,NULL,NULL,'2025-12-24 05:47:17','2025-12-24 05:54:11'),(6,'Jeff Bezos, M.Kom.','{\"id\": \"Technopreneurship\"}','guru',0,'teachers/01KD86J0RW6QTYAAW6WM0DGN07.jpg','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\"}','S-1 Universitas Muhammadiyah Jember',NULL,NULL,NULL,NULL,'2025-12-24 05:50:18','2025-12-24 05:53:55'),(7,'Sundar Pichai, M.Kom.','{\"id\": \"Machine Learning\"}','guru',0,'teachers/01KD86PS4S1B5FAJCS5NX7X71J.jpg','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\"}','S1 - Universitas Negeri Surabaya',NULL,NULL,NULL,NULL,'2025-12-24 05:52:54','2025-12-24 05:52:54'),(8,'William Tanuwijaya, M.Pd.','{\"id\": \"Marketing Manajement\"}','guru',0,'teachers/01KD86YAY962M4N0NWCYPSTY66.jpg','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\"}','S1 - Universitas Indonesia',NULL,NULL,NULL,NULL,'2025-12-24 05:57:01','2025-12-24 05:57:01');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` int NOT NULL DEFAULT '5',
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Dian Sastro','{\"id\":\"Artis Indonesia\",\"en\":\"Indonesian artist\"}','{\"id\":\"Dalam kesibukan hidup sehari-hari, kita sering kali membutuhkan kata kata motivasi rohani kehidupan sehari hari agar tetap menjaga iman di tengah tekanan dan kebingungan, serta mengandalkan kekuatan Tuhan agar terus melangkah maju. Kata-kata ini tidak saja menyemangati hati kita, tetapi juga memberi kita harapan, membantu kita untuk tetap berada di jalan yang telah Tuhan tuntun menuju masa depan yang lebih baik.\",\"en\":\"In the busyness of daily life, we often need spiritual motivational words to maintain our faith amidst pressure and confusion, and to rely on God\'s strength to keep moving forward. These words not only encourage our hearts but also give us hope, helping us stay on the path God has led us to a brighter future.\"}','testimonials/01KD7FNQB6GJT07GW5ZSA9AZXF.jpg',5,1,'2025-12-22 13:37:33','2025-12-27 16:00:20'),(2,'Sutrisno, S.Pd.','{\"id\": \"Wali Murid\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\"}','testimonials/01KD7FM0JKQYTBJJQ2458V61T2.jpg',4,1,'2025-12-22 13:39:12','2025-12-23 23:09:26'),(3,'Mark Walberg','{\"id\": \"Alumni 2022 - Kuliah di Al-Azhar Cairo\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\"}','testimonials/01KD7FMFG4GYXX4NNC3SM74WS5.jpg',5,1,'2025-12-22 13:40:08','2025-12-23 23:09:41'),(4,'M. Ihsan Kurniawan, S.Kom.','{\"id\": \"Alumni 2019 - Kuliah di Universitas Siber Muhammadiyah\"}','{\"id\": \"Suatu pengalaman yang luar biasa bisa pernah belajar dengan para guru di SMP Plus Cordova. Mereka Luar biasa.\"}','testimonials/01KD7FHBCJ6APC0696YAQ0C8Y7.png',5,1,'2025-12-23 04:35:07','2025-12-23 23:07:58'),(5,'Sutrisno','{\"id\": \"Wali Murid\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\"}','testimonials/01KD5KNGEAV7E2014WZ04KC5FH.png',5,1,'2025-12-23 05:41:40','2025-12-23 22:22:08'),(6,'Dedy Aprilian, S.Kom.','{\"id\": \"Alumni 2023 - Kuliah di Stikom Banyuwangi\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\"}','testimonials/01KD7FHR7HXS2EY9VPZTWPWP2F.png',4,1,'2025-12-23 05:42:16','2025-12-23 23:08:12'),(8,'Prabowo Subianto','{\"id\": \"Presiden Republik Indoneisa\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\"}','testimonials/01KD7FFKZAAA5RFWXNHF5T9WA0.jpg',5,1,'2025-12-23 22:44:16','2025-12-23 23:07:02'),(9,'Mark Zuckerberg','{\"id\": \"CEO Meta\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\"}','testimonials/01KD7FAV4J2VQJ0JTKTFHQ29HJ.jpg',5,1,'2025-12-23 22:45:29','2025-12-23 23:04:25'),(10,'Jeff Bezos','{\"id\": \"CEO Amazon\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\"}','testimonials/01KD7FBQ12W8QVM7N0ZNZ8ZKCK.jpg',5,1,'2025-12-23 22:46:08','2025-12-25 10:21:41'),(11,'MacKenzie Scott','{\"id\": \"Novelis\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\"}','testimonials/01KD7FDWGHE83844M6BRH5WK1R.jpg',5,1,'2025-12-23 22:46:38','2025-12-23 23:06:05'),(12,'Bill Gates','{\"id\": \"Pembisnis\"}','{\"id\": \"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\"}','testimonials/01KD7FC9460A527D71Q3MXYTPD.jpg',5,1,'2025-12-23 22:47:02','2025-12-23 23:05:12');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
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
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Satria Yudha Pratama','satria19121994@gmail.com','avatars/01KD55GTB2TE07WN7VGJFG1JY7.png',NULL,'$2y$12$6ORnvgjrPohje4RUjoORI.HQo/xlF6CWDWCBwXbuYF0o6iDFn4MWe',NULL,'2025-12-22 12:09:06','2025-12-23 01:34:26');
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

-- Dump completed on 2025-12-29  2:32:12
