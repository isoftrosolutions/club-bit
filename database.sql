/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 12.0.2-MariaDB : Database - club
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`club` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_uca1400_ai_ci */;

USE `club`;

/*Table structure for table `activities` */

DROP TABLE IF EXISTS `activities`;

CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(200) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_activities_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `activities` */

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','admin','editor') DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `idx_admins_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`name`,`email`,`password`,`role`,`created_at`,`updated_at`,`username`) values 
(1,'Super Admin','admin@techinnovationclub.com','$2y$12$FboxvJtIrAyt5mDtM.SDbObnrHntBhU48ctTnd/quCOzr0Pex8ZUG','super_admin','2026-02-02 10:55:37','2026-05-14 09:54:54','admin');

/*Table structure for table `contacts` */

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_contacts_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `contacts` */

/*Table structure for table `cta_sections` */

DROP TABLE IF EXISTS `cta_sections`;

CREATE TABLE `cta_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cta_key` varchar(50) NOT NULL,
  `cta_title` varchar(200) NOT NULL,
  `cta_description` text DEFAULT NULL,
  `cta_button_text` varchar(100) DEFAULT NULL,
  `cta_button_link` varchar(255) DEFAULT NULL,
  `cta_background` varchar(50) DEFAULT 'primary',
  `is_visible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cta_key` (`cta_key`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `cta_sections` */

insert  into `cta_sections`(`id`,`cta_key`,`cta_title`,`cta_description`,`cta_button_text`,`cta_button_link`,`cta_background`,`is_visible`,`created_at`,`updated_at`) values 
(1,'membership','Ready to Join Our Community?','Become part of a vibrant community of innovators and future engineers. Apply today!','Apply for Membership','pages/membership.php','primary',1,'2026-05-14 10:28:50','2026-05-14 10:28:50');

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `upload_date` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_gallery_upload_date` (`upload_date`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `gallery` */

insert  into `gallery`(`id`,`image_path`,`title`,`description`,`upload_date`,`created_at`,`updated_at`) values 
(1,'assets/images/gallery/maghe_sankranti.jpg','Maghe Sankranti Greetings','Celebrating the festival of harvest and warmth with Club Abhiyanta.','2026-02-02 11:12:49','2026-02-02 11:12:49','2026-02-02 11:12:49'),
(2,'assets/images/gallery/saraswati_puja.jpg','Saraswati Puja & Basant Panchami','Seeking blessings from the Goddess of Knowledge for a bright future.','2026-02-02 11:12:49','2026-02-02 11:12:49','2026-02-02 11:12:49'),
(3,'assets/images/gallery/sahid_diwas.jpg','Martyrs\' Day Remembrance','Honoring the heroes who sacrificed their lives for the nation.','2026-02-02 11:12:49','2026-02-02 11:12:49','2026-02-02 11:12:49');

/*Table structure for table `home_sections` */

DROP TABLE IF EXISTS `home_sections`;

CREATE TABLE `home_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_key` varchar(50) NOT NULL,
  `section_title` varchar(200) NOT NULL,
  `section_subtitle` varchar(500) DEFAULT NULL,
  `section_content` text DEFAULT NULL,
  `section_image` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_visible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `section_key` (`section_key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `home_sections` */

insert  into `home_sections`(`id`,`section_key`,`section_title`,`section_subtitle`,`section_content`,`section_image`,`icon`,`sort_order`,`is_visible`,`created_at`,`updated_at`) values 
(1,'history','History',NULL,'Founded by visionary engineers at BIT, starting as a small workshop and evolving into the region premier technical club.',NULL,'history',1,1,'2026-05-14 10:28:50','2026-05-14 10:28:50'),
(2,'mission','Mission',NULL,'To foster a culture of hands-on learning and technological breakthrough through collaborative engineering projects.',NULL,'rocket_launch',2,1,'2026-05-14 10:28:50','2026-05-14 10:28:50'),
(3,'vision','Vision',NULL,'Creating a sustainable ecosystem where innovation meets real-world industrial application for future-ready engineers.',NULL,'visibility',3,1,'2026-05-14 10:28:50','2026-05-14 10:28:50');

/*Table structure for table `leadership_team` */

DROP TABLE IF EXISTS `leadership_team`;

CREATE TABLE `leadership_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `position` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `hierarchy_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `leadership_team` */

insert  into `leadership_team`(`id`,`name`,`email`,`phone`,`address`,`position`,`image`,`hierarchy_order`,`created_at`,`updated_at`) values 
(1,'Mishal Mohammad','mishalmohammadnp@gmail.com','9817291913','','President','assets/images/team/1770010582_480698846_562851366783783_8107258345516463020_n.jpg',1,'2026-02-02 11:08:15','2026-05-14 10:17:18'),
(2,'Anjali Thakur',NULL,NULL,NULL,'Vice President',NULL,2,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(3,'Manu Patel Kurmi','','','','Secretary',NULL,3,'2026-02-02 11:08:15','2026-02-04 10:05:14'),
(4,'Abdul Kayum Ansari',NULL,NULL,NULL,'Joint Secretary',NULL,4,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(5,'Rishav Kumar Sah',NULL,NULL,NULL,'Treasurer',NULL,5,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(6,'Raju Yadav',NULL,NULL,NULL,'Public Relations Officer',NULL,6,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(7,'Raunak Kayastha',NULL,NULL,NULL,'Technical Lead',NULL,7,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(8,'Krishna Gupta',NULL,NULL,NULL,'Event Manager (Lead)',NULL,8,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(9,'Bikash Kushwaha',NULL,NULL,NULL,'Event Manager',NULL,9,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(10,'Sagar Patel',NULL,NULL,NULL,'Event Manager',NULL,10,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(11,'Lalbabu Sharma',NULL,NULL,NULL,'Event Manager',NULL,11,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(12,'Satya Prakash Sharma',NULL,NULL,NULL,'Assistant Event Manager (Lead)',NULL,12,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(13,'Sanjana Yadav',NULL,NULL,NULL,'Assistant Event Manager',NULL,13,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(14,'Sanjana Mandal',NULL,NULL,NULL,'Assistant Event Manager',NULL,14,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(15,'Sita Kumari Sha',NULL,NULL,NULL,'Assistant Event Manager',NULL,15,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(16,'Manish Kumar Sharma',NULL,NULL,NULL,'Maintenance Lead',NULL,16,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(17,'Anjal BK',NULL,NULL,NULL,'Decorative Lead',NULL,17,'2026-02-02 11:08:15','2026-02-02 11:08:15'),
(18,'Surya Singh',NULL,NULL,NULL,'Media & Outreach Lead',NULL,18,'2026-02-02 11:08:15','2026-02-02 11:08:15');

/*Table structure for table `members` */

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `faculty` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `join_date` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('active','pending','inactive') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `idx_members_email` (`email`),
  KEY `idx_members_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `members` */

/*Table structure for table `programs` */

DROP TABLE IF EXISTS `programs`;

CREATE TABLE `programs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `program_title` varchar(200) NOT NULL,
  `program_description` text DEFAULT NULL,
  `program_image` varchar(255) DEFAULT NULL,
  `program_date` varchar(100) DEFAULT NULL,
  `program_location` varchar(200) DEFAULT NULL,
  `program_category` varchar(50) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  `is_visible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `programs` */

/*Table structure for table `projects` */

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_title` varchar(200) NOT NULL,
  `project_description` text DEFAULT NULL,
  `project_image` varchar(255) DEFAULT NULL,
  `project_category` varchar(50) DEFAULT NULL,
  `project_status` enum('ongoing','completed','planning') DEFAULT 'ongoing',
  `is_featured` tinyint(1) DEFAULT 0,
  `sort_order` int(11) DEFAULT 0,
  `is_visible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `projects` */

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`),
  KEY `idx_settings_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`setting_key`,`setting_value`,`created_at`,`updated_at`) values 
(1,'club_name','Club Abhiyanta','2026-02-02 08:54:05','2026-02-02 10:59:18'),
(2,'club_description','Empowering Tech Innovation & AI Learnings at Birmingham Institute of Technology','2026-02-02 08:54:05','2026-02-02 08:54:05'),
(3,'contact_email','info.clubabhiyanta@gmail.com','2026-02-02 08:54:05','2026-05-14 10:16:36'),
(4,'contact_phone','9820751182','2026-02-02 08:54:05','2026-05-14 10:16:36'),
(5,'website_title','Club Abhiyanta','2026-02-02 08:54:05','2026-02-02 10:59:18'),
(6,'meta_description','Tech Innovation Club at Birgunj Institute of Technology','2026-02-02 08:54:05','2026-05-14 10:16:36'),
(7,'established_year','2024','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(8,'address','Birgunj, Nepal','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(9,'hero_tagline','Innovate • Build • Inspire','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(10,'hero_description','A premium engineering research and innovation hub dedicated to precision engineering, IoT, and Robotics. We bridge the gap between theoretical physics and applied industrial solutions.','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(11,'cta_button_text','Join Club','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(12,'cta_button_link','pages/membership.php','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(13,'secondary_cta_text','Explore Activities','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(14,'secondary_cta_link','pages/about.php','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(15,'hero_image','assets/images/hero-image.jpeg','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(16,'about_section_enabled','1','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(17,'programs_section_enabled','1','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(18,'projects_section_enabled','1','2026-05-14 10:28:22','2026-05-14 10:28:22'),
(19,'membership_section_enabled','1','2026-05-14 10:28:22','2026-05-14 10:28:22');

/*Table structure for table `site_colors` */

DROP TABLE IF EXISTS `site_colors`;

CREATE TABLE `site_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_key` varchar(50) NOT NULL,
  `color_name` varchar(100) NOT NULL,
  `color_value` varchar(20) NOT NULL,
  `category` enum('primary','surface','text','border','accent') DEFAULT 'primary',
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `color_key` (`color_key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `site_colors` */

insert  into `site_colors`(`id`,`color_key`,`color_name`,`color_value`,`category`,`sort_order`,`created_at`,`updated_at`) values 
(1,'primary','Primary (Engineering Red)','#a10014','primary',1,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(2,'on-primary','On Primary','#ffffff','primary',2,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(3,'primary-container','Primary Container','#c81d25','primary',3,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(4,'on-primary-container','On Primary Container','#ffddda','primary',4,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(5,'surface','Surface (Creamy White)','#fafaf3','surface',1,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(6,'surface-dim','Surface Dim','#dadad4','surface',2,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(7,'surface-container-lowest','Surface Container Lowest','#ffffff','surface',3,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(8,'surface-container-low','Surface Container Low','#f4f4ee','surface',4,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(9,'surface-container','Surface Container','#eeeee8','surface',5,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(10,'surface-container-high','Surface Container High','#e8e8e2','surface',6,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(11,'surface-variant','Surface Variant','#e3e3dd','surface',7,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(12,'on-surface','On Surface','#1a1c19','text',1,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(13,'on-surface-variant','On Surface Variant','#5c403d','text',2,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(14,'secondary','Secondary','#5f5e5e','accent',1,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(15,'on-secondary','On Secondary','#ffffff','accent',2,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(16,'error','Error','#ba1a1a','accent',2,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(17,'on-error','On Error','#ffffff','accent',3,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(18,'outline','Outline','#906f6c','border',1,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(19,'outline-variant','Outline Variant','#e5bdba','border',2,'2026-05-14 10:28:22','2026-05-14 10:28:22');

/*Table structure for table `social_links` */

DROP TABLE IF EXISTS `social_links`;

CREATE TABLE `social_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `platform` varchar(50) NOT NULL,
  `platform_name` varchar(100) NOT NULL,
  `url` varchar(500) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_visible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `platform` (`platform`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `social_links` */

insert  into `social_links`(`id`,`platform`,`platform_name`,`url`,`icon`,`sort_order`,`is_visible`,`created_at`,`updated_at`) values 
(1,'facebook','Facebook',NULL,'facebook',1,1,'2026-05-14 10:28:50','2026-05-14 10:28:50'),
(2,'instagram','Instagram',NULL,'photo_camera',2,1,'2026-05-14 10:28:50','2026-05-14 10:28:50'),
(3,'twitter','Twitter (X)',NULL,'tag',3,1,'2026-05-14 10:28:50','2026-05-14 10:28:50'),
(4,'linkedin','LinkedIn',NULL,'work',4,1,'2026-05-14 10:28:50','2026-05-14 10:28:50'),
(5,'youtube','YouTube',NULL,'play_circle',5,1,'2026-05-14 10:28:50','2026-05-14 10:28:50'),
(6,'whatsapp','WhatsApp',NULL,'call',6,1,'2026-05-14 10:28:50','2026-05-14 10:28:50');

/*Table structure for table `stats` */

DROP TABLE IF EXISTS `stats`;

CREATE TABLE `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stat_key` varchar(50) NOT NULL,
  `stat_value` varchar(20) NOT NULL,
  `stat_label` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `is_visible` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `stat_key` (`stat_key`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

/*Data for the table `stats` */

insert  into `stats`(`id`,`stat_key`,`stat_value`,`stat_label`,`icon`,`sort_order`,`is_visible`,`created_at`,`updated_at`) values 
(1,'active_members','100+','ACTIVE MEMBERS','group',1,1,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(2,'annual_events','30+','ANNUAL EVENTS','event',2,1,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(3,'rd_projects','12','R&D PROJECTS','science',3,1,'2026-05-14 10:28:22','2026-05-14 10:28:22'),
(4,'workshops','30+','WORKSHOPS','school',4,1,'2026-05-14 10:28:22','2026-05-14 10:28:22');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
