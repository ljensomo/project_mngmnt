-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_project_mngmnt
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `database_backups`
--

DROP TABLE IF EXISTS `database_backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `database_backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) NOT NULL,
  `file_path` varchar(150) NOT NULL,
  `file_size` float DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `database_backups`
--

LOCK TABLES `database_backups` WRITE;
/*!40000 ALTER TABLE `database_backups` DISABLE KEYS */;
INSERT INTO `database_backups` VALUES (1,'backup_20251004_083847.sql','database_dumps/backup_20251004_083847.sql',11334,'2025-10-04 14:38:48'),(2,'backup_20251004_084124.sql','database_dumps/backup_20251004_084124.sql',33850,'2025-10-04 14:41:24'),(3,'backup_20251004_085903.sql','database_dumps/backup_20251004_085903.sql',33989,'2025-10-04 14:59:03'),(4,'backup_20251004_090931.sql','database_dumps/backup_20251004_090931.sql',34253,'2025-10-04 15:09:32'),(5,'backup_20251102_022845.sql','database_dumps/backup_20251102_022845.sql',38166,'2025-11-02 09:28:46');
/*!40000 ALTER TABLE `database_backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature_statuses`
--

DROP TABLE IF EXISTS `feature_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feature_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature_statuses`
--

LOCK TABLES `feature_statuses` WRITE;
/*!40000 ALTER TABLE `feature_statuses` DISABLE KEYS */;
INSERT INTO `feature_statuses` VALUES (1,'Planned','Scheduled for development'),(2,'In Development','Actively being built'),(3,'Testing','QA Phase'),(4,'Released','Live and available'),(5,'Deprecated','Replaced or retired');
/*!40000 ALTER TABLE `feature_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module_statuses`
--

DROP TABLE IF EXISTS `module_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_statuses`
--

LOCK TABLES `module_statuses` WRITE;
/*!40000 ALTER TABLE `module_statuses` DISABLE KEYS */;
INSERT INTO `module_statuses` VALUES (1,'Planned','Not yet started'),(2,'Active','Under development'),(3,'Stable','Fully implemented and reliable'),(4,'Deprecated','No longer maintained');
/*!40000 ALTER TABLE `module_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_attachments`
--

DROP TABLE IF EXISTS `project_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `date_added` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_attachments`
--

LOCK TABLES `project_attachments` WRITE;
/*!40000 ALTER TABLE `project_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_features`
--

DROP TABLE IF EXISTS `project_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `feature` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `status` int(1) NOT NULL,
  `version_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `date_completed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_features`
--

LOCK TABLES `project_features` WRITE;
/*!40000 ALTER TABLE `project_features` DISABLE KEYS */;
INSERT INTO `project_features` VALUES (2,0,0,'test','test',1,NULL,'2025-07-12 12:22:16',1,NULL),(5,3,4,'Register New User','This feature allows user to create an account within the system by providing necessary information.',4,1,'2025-07-12 13:23:53',1,'2025-09-14 21:46:08'),(6,3,4,'Edit User','This feature allows user to edit the information of the selected user.',4,1,'2025-07-12 13:29:40',1,'2025-09-14 21:46:20'),(7,3,5,'Add New Project','This feature allows user to add a new project.',4,1,'2025-07-12 13:37:00',1,'2025-09-14 21:46:24'),(8,3,5,'Edit Project','This feature allows user to edit the details (project description, status) of the created project.',4,1,'2025-07-12 13:46:34',1,'2025-09-14 21:46:28'),(9,3,5,'Add Task','This feature allows user to add project tasks.',4,1,'2025-07-12 13:48:59',1,'2025-09-14 21:46:32'),(10,3,5,'Edit Task','This feature allows user to edit task details (assignee, task , description and status)',4,1,'2025-07-12 13:50:18',1,'2025-09-14 21:46:36'),(11,3,5,'Add Module','This feature allows user to add project modules.',4,1,'2025-07-12 13:52:30',1,'2025-09-14 21:46:40'),(12,3,5,'Edit Module','This feature allows user to edit module details (module name, module description and status).',4,1,'2025-07-12 13:54:26',1,'2025-09-14 21:46:44'),(13,3,5,'Add Feature','This feature allows user to add features of a module.',4,1,'2025-07-12 13:57:11',1,'2025-09-14 21:46:48'),(14,3,5,'Edit Feature','This feature allows user to edit the details of a feature.',4,1,'2025-07-12 13:59:15',1,'2025-09-14 21:46:53'),(15,3,5,'Project Mini Dashboard','This feature shows the current total of open, in progress, completed on hold tasks, modules and features.',4,1,'2025-07-12 14:00:57',1,'2025-09-14 21:47:02'),(16,3,6,'Login/Sign-in','This feature allows user to login using the created accounts within the system.',4,1,'2025-07-12 14:42:38',1,'2025-09-14 21:47:06'),(17,3,6,'Logout/Sign-out','This feature allows user to close his/her session within the system to avoid invalid access. ',4,1,'2025-07-12 14:43:45',1,'2025-09-14 21:47:10'),(18,3,6,'System Authentication','This feature allows the user to only access the system and perform functions if he/she has logged in to the system.',4,1,'2025-07-12 14:45:15',1,'2025-09-14 21:47:57'),(19,5,7,'Insert Record','Allow users to insert record.',1,NULL,'2025-08-17 06:34:36',1,NULL),(20,7,12,'Current balance (Total Income - Total Expenses)','Show current balance',4,4,'2025-09-14 15:42:22',1,'2025-09-23 20:33:25'),(21,7,12,'Quick summary of monthly income vs. expenses','Show summary of monthly income vs. expenses',4,4,'2025-09-14 15:43:35',1,'2025-09-23 20:51:06'),(22,7,12,'Chart or graph showing spending by category','Show spending by category via chart or graph.',4,4,'2025-09-14 15:44:08',1,'2025-09-27 08:35:16'),(23,7,12,'List of recent transactions','Show list of recent transactions.',4,4,'2025-09-14 15:44:35',1,'2025-09-27 08:35:26'),(24,7,13,'Add/Edit/Delete Expenses','Fields for amount, date, category, and notes.',4,4,'2025-09-14 15:45:26',1,'2025-09-23 18:27:43'),(25,7,13,'Add/Edit/Delete Income','Fields for amount, date, source of income, and notes.',4,4,'2025-09-14 15:46:14',1,'2025-09-27 08:37:24'),(26,7,13,'Attach Receipts','An upload field in the expense entry form that accepts images or PDF files.',1,4,'2025-09-14 15:46:32',1,NULL),(27,7,13,'View All Transactions','A searchable and filterable table of all user\'s financial activities.',4,4,'2025-09-14 15:47:19',1,'2025-09-28 12:08:28'),(28,7,14,'Add/Edit/Delete Category','Create, edit, and delete expense categories (e.g., \"Food,\" \"Transportation,\" \"Utilities\").',4,4,'2025-09-14 15:48:11',1,'2025-09-23 18:26:51'),(29,7,14,'Category Color Assign','Assign a color or icon to each category for better visualization.',4,29,'2025-09-14 15:48:39',1,'2025-11-02 09:39:30'),(30,7,15,'Add/Edit/Delete Planned Purchases','Add/Edit/Delete planned purchases with fields for item name, target price, and a description or link.',4,26,'2025-09-14 15:49:34',1,'2025-10-21 13:16:06'),(32,7,16,'Expense by Category Report','A pie chart or bar graph showing where user\'s money goes over a specific period (e.g., last month).',4,4,'2025-09-14 15:51:24',1,'2025-09-27 09:37:33'),(33,7,16,'Income vs. Expense Report','A line graph comparing user\'s total income and expenses over time.',4,4,'2025-09-14 15:51:44',1,'2025-09-27 09:15:45'),(34,7,16,'Data Export','A function to export your transaction data to a CSV or Excel file.',4,4,'2025-09-14 15:52:44',1,'2025-09-28 08:44:11'),(35,7,17,'Secure Login','Login Page for user',4,4,'2025-09-14 15:53:48',1,'2025-09-20 15:20:49'),(36,7,17,'Registration Page','Registration page for user',4,4,'2025-09-14 15:54:39',1,'2025-09-20 15:20:37'),(37,7,18,'Profile Management','User can update details of his/her profile.',1,4,'2025-09-14 15:56:04',1,NULL),(38,7,18,'Change Password','Change password page for user.',1,4,'2025-09-14 15:57:46',1,NULL),(40,3,9,'Add/Edit/Delete Versions','This feature allow users to manage all versions',4,2,'2025-09-20 09:22:45',1,'2025-09-20 09:22:53'),(41,3,10,'Add/Edit/Delete','This feature allow users to manage all technologies',4,5,'2025-09-20 09:23:37',1,'2025-09-20 09:23:42'),(42,8,21,'Test Feature','Feature Testing',1,8,'2025-09-28 14:11:49',1,NULL),(43,3,22,'Manual Backup Trigger','Allow users/admins to initiate backups on demand.',4,13,'2025-09-28 14:50:02',1,'2025-10-04 15:54:38'),(44,3,22,'Backup History Log','View past backups with timestamps, size, and status.',4,13,'2025-09-28 14:50:43',1,'2025-10-04 15:54:34'),(45,3,22,'Download Backup','Export backup files for external storage.',4,13,'2025-09-28 14:51:12',1,'2025-10-04 15:54:27');
/*!40000 ALTER TABLE `project_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_modules`
--

DROP TABLE IF EXISTS `project_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `module` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `version_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_completed` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_modules`
--

LOCK TABLES `project_modules` WRITE;
/*!40000 ALTER TABLE `project_modules` DISABLE KEYS */;
INSERT INTO `project_modules` VALUES (1,0,'Users','Management of system users.',1,NULL,'2025-07-12 12:58:57',NULL,1),(2,0,'test','test',1,NULL,'2025-07-12 12:59:57',NULL,1),(4,3,'Users','Management of system users.',3,1,'2025-07-12 13:04:22','2025-09-14 21:27:44',1),(5,3,'Projects','Management of projects, including tasks, modules and features.',3,1,'2025-07-12 13:07:56','2025-09-14 21:34:29',1),(6,3,'Authentication','System authentication.',3,1,'2025-07-12 13:08:46','2025-09-14 21:34:42',1),(7,5,'Family Module','Allows user to manage (add/edit) family member information.',2,NULL,'2025-07-20 08:40:55',NULL,1),(8,5,'Family Tree Page','Allows user to view the structure of family tree.',2,NULL,'2025-07-20 08:41:55',NULL,1),(9,3,'Versions','Management of versions. This will determine which modules and features are part of which version.',3,2,'2025-07-20 09:45:50','2025-09-14 22:15:27',1),(10,3,'Technologies','Management of technologies use for the project.',3,5,'2025-07-20 09:46:27','2025-09-20 09:20:27',1),(12,7,'Dashboard','Overview of your financial health with charts and summaries',3,4,'2025-09-14 15:33:42','2025-11-02 09:51:56',1),(13,7,'Transactions','Log daily expenses and income with category tagging',3,4,'2025-09-14 15:36:34','2025-11-02 09:52:10',1),(14,7,'Categories','Organize spending into meaningful category groups',3,4,'2025-09-14 15:37:25','2025-11-02 09:52:36',1),(15,7,'Planned Purchases (Wishlist)','Track future purchases and savings goals',3,26,'2025-09-14 15:37:56','2025-11-02 09:53:06',1),(16,7,'Reports','Generate monthly and yearly financial summaries',3,4,'2025-09-14 15:38:35','2025-11-02 09:53:18',1),(17,7,'User Authentication','Secure login and registration',3,4,'2025-09-14 15:40:05','2025-11-02 09:53:30',1),(18,7,'Settings','Customize preferences and account details',1,4,'2025-09-14 15:40:38',NULL,1),(20,3,'Attachments','Uploading of any project related files.',3,7,'2025-09-20 12:43:33','2025-10-04 15:50:52',1),(21,8,'Test Module','Testing',1,8,'2025-09-28 14:11:06',NULL,1),(22,3,'Database Backup','Dumping of application\'s database in the system.',3,13,'2025-09-28 14:47:30','2025-10-04 15:50:46',1),(23,7,'Sub Categories','Organize spending into meaningful sub-category groups',3,25,'2025-09-28 20:50:37','2025-11-02 09:52:47',1),(24,7,'Google Sheet Integration','Sync data with your personal Google Sheets',3,30,'2025-09-29 21:05:17','2025-11-02 09:53:57',1),(25,3,'Dashboard','Show summary of Tasks,  Projects',1,20,'2025-10-04 19:29:08',NULL,1),(26,3,'To be able to add attachments','add documents',1,21,'2026-02-28 20:34:30',NULL,1);
/*!40000 ALTER TABLE `project_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_tasks`
--

DROP TABLE IF EXISTS `project_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `task_type` tinyint(1) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `date_completed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_tasks`
--

LOCK TABLES `project_tasks` WRITE;
/*!40000 ALTER TABLE `project_tasks` DISABLE KEYS */;
INSERT INTO `project_tasks` VALUES (9,3,1,'Add Type of Task','Add type of task type (Bug, Enhancement) selection when creating or updating Project Task.',1,7,'2025-07-12 14:07:46',0,'2025-07-12 08:37:19'),(10,3,1,'Add Date Complete in Project Task','Add date completion when updating to complete the tasks.',1,7,'2025-07-12 14:13:38',0,'2025-07-12 08:34:53'),(11,3,2,'Fix Assign To','When editing project task, the assigned to is not properly selected.',1,7,'2025-07-12 14:15:01',0,'2025-07-12 08:37:24'),(14,3,1,'Add Date Completed in Project Features','Display the date completed in the features table.',1,7,'2025-07-12 14:37:13',0,'2025-07-12 08:40:23'),(15,3,1,'Add Date Complete in Module','Add date completed column for project modules.',1,7,'2025-07-12 14:46:17',0,'2025-07-19 12:52:21'),(16,3,1,'Display the User in Project Page','Display the user who created the project in project\'s page',1,7,'2025-07-12 14:47:21',0,'2025-07-19 13:05:08'),(17,3,1,'Add Date Complete in Project','Add date completed column in projects page.',1,7,'2025-07-12 14:49:32',0,'2025-07-19 14:16:18'),(18,6,2,'Ticket Module','Fix the module for viewing the logged user\'s open, in progress and closed tickets.',NULL,1,'2025-09-14 15:25:05',0,NULL),(19,6,2,'Fix Dashboard display','The dashboard is currently in static',NULL,1,'2025-09-14 15:25:52',0,NULL),(20,3,3,'Add a release button in version','This button will automatically release the changes, update the version status.',1,8,'2025-09-15 08:06:43',0,'2025-10-04 18:51:18'),(21,3,3,'Add version validation','Should not be able to add module or feature to version that have been archived or is active.',NULL,1,'2025-09-15 08:07:33',0,NULL),(22,3,3,'Add cancel status for module and feature','User will be able to cancel module or feature if not feasible',1,8,'2025-09-15 08:08:07',0,'2025-10-04 18:51:14'),(23,3,3,'Automatically \"Archived\" the \"Active\" ','Automatically \"Archived\" the \"Active\" version when updating \"Development\" to \"Active\"',1,7,'2025-09-20 08:50:08',0,'2025-10-04 18:50:45'),(24,3,1,'Add SDLC Status','Add SDLC statuses in Project module',1,7,'2025-09-20 09:10:06',0,'2025-09-28 13:01:21'),(25,3,1,'Add Sidebar','Add sidebar on UI',1,7,'2025-09-28 12:10:51',0,'2025-09-28 13:01:08'),(26,7,5,'Create Readme','Create Readme file for github for the project',1,7,'2025-09-28 14:40:33',0,'2025-11-02 09:51:43'),(27,7,3,'Change dashboard content','Change dashboard Monthly Income vs Monthly Expense to Bar graph for better visualization',1,7,'2025-09-28 20:52:10',0,'2025-10-05 13:18:29'),(28,7,3,'Filter Categories','Display categories based on what is selected e.g. Expense or income.',1,7,'2025-09-28 20:56:30',0,'2025-10-11 13:51:22'),(29,3,3,'Improve Theme of the application','Apply Theme changes',1,7,'2025-10-04 09:30:55',0,'2025-10-04 18:50:28'),(30,3,2,'Date complete in task not updating','When updating status to Completed the date completed column is not updated.',1,7,'2025-10-04 10:33:51',0,'2025-10-04 19:06:42'),(31,3,1,'Add comment feature in Tasks','Users can updates from time to time for the specific tasks.',1,1,'2025-10-04 12:09:13',0,NULL),(32,3,1,'Target date','Add target date for each project versions',1,7,'2025-10-04 12:11:04',0,'2025-10-04 18:50:31'),(33,3,3,'Change alerts in database backups','Use sweetalerts instead of normal JS alerts.',1,7,'2025-10-04 15:02:30',0,'2025-10-04 18:50:36'),(34,3,3,'Add color to Version statuses','To easily distinguish statuses',1,7,'2025-10-04 16:01:14',0,'2025-10-04 18:50:39'),(35,3,2,'Edit user not working ','cannot edit user',1,7,'2025-10-04 16:45:12',0,'2025-10-04 18:50:49'),(36,3,3,'Add icons to task type','Add icons to task type items',1,7,'2025-10-04 18:10:20',0,'2025-10-04 18:50:20'),(37,7,3,'Use datatable in transactions','Use datatable for pagination and filtering',1,7,'2025-10-05 13:19:24',0,'2025-10-05 15:07:03'),(38,7,4,'Google Sheet Integration','Review if possible to integrate with Google Sheet',1,7,'2025-10-05 13:20:14',0,'2025-11-02 09:28:03'),(40,7,3,'Change the icon of income and expense','Use arrow up for income and arrow down for expense',1,7,'2025-10-12 08:09:18',0,'2025-10-13 17:11:19'),(41,7,1,'Add Sub Category Module','Add Sub Category Module',1,7,'2025-10-12 09:01:08',0,'2025-10-18 23:10:22'),(42,7,1,'Budget Module','Add module where user can create budgeting',1,7,'2025-10-13 17:12:25',0,'2025-12-30 07:52:33'),(43,7,1,'Bills module','Add module where user can input recurring bills',1,1,'2025-10-13 17:12:53',0,NULL),(44,7,1,'Complete Wishlist module','Complete Wishlist module',1,7,'2025-10-18 23:24:42',0,'2025-10-19 14:17:37'),(45,7,3,'Minimize code in routing','Use looping in repeated routes',1,7,'2025-10-19 14:19:09',0,'2025-10-31 13:21:29'),(46,7,3,'Add target date in Wishlist','Add target date column in Wishlist',1,1,'2025-10-19 14:22:54',0,NULL),(47,3,1,'Add Filter in Tasks Table','Add Filter in Tasks Table',1,1,'2025-10-21 07:25:09',0,NULL),(48,7,2,'Edit Sub Category','Cannot fetch sub category',1,7,'2025-10-21 07:32:14',0,'2025-10-21 13:12:53'),(49,7,1,'Add Monthly Dashboard','Add dashboard to view transactions specific for the current mnonth',1,7,'2025-10-31 10:21:40',0,'2025-10-31 13:21:22'),(50,7,3,'Add color in categories','Add coloring in categories and connect to dashboards',1,7,'2025-10-31 13:36:31',0,'2025-10-31 15:22:22'),(51,7,1,'Google Sheet Integration','Implement Google Sheet Integration',1,7,'2025-11-02 09:27:55',0,'2025-11-02 09:28:23'),(52,7,3,'Refactor routes','Remove repeated lines',1,7,'2025-11-02 09:59:27',0,'2025-11-02 09:59:38');
/*!40000 ALTER TABLE `project_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_techs`
--

DROP TABLE IF EXISTS `project_techs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_techs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `technology` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `type` enum('Frontend','Backend','Database','DevOps','Other') DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_techs`
--

LOCK TABLES `project_techs` WRITE;
/*!40000 ALTER TABLE `project_techs` DISABLE KEYS */;
INSERT INTO `project_techs` VALUES (2,3,'MySQL (MariaDB)','','Database','2025-09-20 08:33:06'),(3,7,'Laravel','','Backend','2025-09-20 08:40:07'),(4,7,'Vue.JS','','Frontend','2025-09-20 08:40:22'),(5,7,'MariaDB','','Database','2025-09-20 08:41:33'),(6,7,'Github','Version control','Other','2025-09-20 11:20:37'),(7,5,'React Native','','Frontend','2025-09-20 16:05:16'),(8,3,'PHP','','Backend','2025-09-28 14:30:53'),(9,7,'Google API','External Integration','Backend','2025-11-02 09:54:45');
/*!40000 ALTER TABLE `project_techs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_versions`
--

DROP TABLE IF EXISTS `project_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `version_number` varchar(100) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `target_date_release` date DEFAULT NULL,
  `date_released` date DEFAULT NULL,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_versions`
--

LOCK TABLES `project_versions` WRITE;
/*!40000 ALTER TABLE `project_versions` DISABLE KEYS */;
INSERT INTO `project_versions` VALUES (1,3,'1.0.0','',4,NULL,'2025-07-20','2025-09-14 16:20:58'),(2,3,'1.1.0','',4,NULL,'2025-07-20','2025-09-14 19:43:00'),(4,7,'1.0.0','Initial version',4,'2025-09-28','2025-09-28','2025-09-15 08:01:14'),(5,3,'1.2.0','',4,NULL,'2025-09-14','2025-09-15 13:15:04'),(6,3,'1.2.1','',4,NULL,'2025-09-20','2025-09-20 09:19:36'),(7,3,'2.0.0','',4,NULL,'2025-09-28','2025-09-20 11:24:52'),(8,8,'2.1.0','New Theme Design',1,NULL,'2025-10-04','2025-09-28 14:10:45'),(9,3,'2.1.0','New Theme Design',4,NULL,'2025-10-04','2025-10-04 09:31:53'),(10,3,'2.1.1','Auto archive old version when updating active',4,NULL,'2025-10-04','2025-10-04 10:54:27'),(11,3,'2.1.2','Add target date for version',4,'2025-10-04','2025-10-04','2025-10-04 12:11:31'),(12,8,'1.0.0','',1,'2025-10-03','2025-10-06','2025-10-04 12:24:34'),(13,3,'2.2.0','Add new database backup Module',4,'2025-10-05','2025-10-04','2025-10-04 13:25:27'),(14,3,'2.2.1','Fix date completed of feature when updating as Released',4,'2025-10-04','2025-10-04','2025-10-04 15:52:31'),(15,3,'2.2.2','Add color in version statuses',4,'2025-10-04','2025-10-04','2025-10-04 16:33:19'),(16,3,'2.2.3','Add icon to task types',4,'2025-10-04','2025-10-04','2025-10-04 18:30:33'),(17,3,'2.2.4','Fix editing user',4,'2025-10-04','2025-10-04','2025-10-04 18:39:11'),(18,3,'2.2.5','Fix auto set of date closed in Task Type',4,'2025-10-04','2025-10-04','2025-10-04 18:52:45'),(19,3,'2.2.6','Hide date complete column in Feature and Module ',4,'2025-10-04','2025-10-05','2025-10-04 19:14:54'),(20,3,'2.3.0','New Features\r\n - Settings\r\n   1. Project Status Maintenance\r\n - Dashboard\r\n - Project Mini Dashboard',1,'2025-10-12','0000-00-00','2025-10-04 19:28:06'),(21,3,'2.2.7','Fix login',3,'2025-10-05','2025-10-05','2025-10-05 09:27:19'),(22,7,'2.0.0','Improve UI',4,'2025-10-12','2025-10-12','2025-10-05 09:33:18'),(23,7,'2.0.1','Change icon for income and expense',4,'2025-10-12','2025-10-12','2025-10-12 08:09:51'),(24,7,'2.0.2','Add icon',4,'2025-10-12','2025-10-12','2025-10-12 08:27:34'),(25,7,'2.1.0','Add sub category module',4,'2025-10-18','2025-10-18','2025-10-12 09:00:31'),(26,7,'2.2.0','Add wishlist module',4,'2025-10-19','2025-10-19','2025-10-18 23:25:46'),(27,7,'2.2.1','Fix edit sub-category',4,'2025-10-25','2025-10-21','2025-10-21 07:34:37'),(28,7,'2.3.0','Add monthly dashbaord',4,'2025-11-02','2025-10-31','2025-10-31 10:22:24'),(29,7,'2.3.1','Add color label in categories',4,'2025-11-02','2025-10-31','2025-10-31 13:39:19'),(30,7,'2.4.0','Implement google sheet integration',4,'2025-11-02','2025-11-02','2025-11-02 09:36:09'),(31,7,'2.4.1','Refactor routes remove repetitive lines',4,'2025-11-02','2025-11-02','2025-11-02 10:00:02'),(32,7,'2.4.2','Dashboard update',4,'2025-11-09','2025-11-09','2025-11-09 15:02:22'),(33,7,'2.5.0','Add Budget Module',3,'2025-11-15','2025-12-30','2025-11-09 15:04:08');
/*!40000 ALTER TABLE `project_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `phase_id` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_completed` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (3,'Project Management','This project is use to manage applications that will be created, monitor the progress, review the features and manage updates to be added.',0,6,'2025-07-07 20:12:41',NULL,1),(5,'Family Tree Maker','This project is intended to make a family tree content and add relevant family information.',0,3,'2025-07-12 14:48:38',NULL,1),(6,'Support Ticketing (Fix)','CSTA Capstone Project',0,6,'2025-09-14 15:22:54',NULL,1),(7,'Finance Core','A personal web application designed for straightforward financial management. It provides a clean interface to track daily expenses, monitor income, plan for future purchases, and digitally store receipts. The goal is to offer a simple, private, and efficient way to see where your money is going.',0,6,'2025-09-14 15:30:58',NULL,1),(9,'Home Dashboard','To have a dashboard at home, to display family events bills and etc.',1,1,'2025-10-21 11:54:45',NULL,1),(10,'Pisonet Management System','To monitor as admin all PC',1,1,'2026-02-28 20:33:20',NULL,1);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sdlc_phases`
--

DROP TABLE IF EXISTS `sdlc_phases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sdlc_phases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phase` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sdlc_phases`
--

LOCK TABLES `sdlc_phases` WRITE;
/*!40000 ALTER TABLE `sdlc_phases` DISABLE KEYS */;
INSERT INTO `sdlc_phases` VALUES (1,'Planning','The Planning phase defines the \"what\" and \"why\" of the project—the requirements, goals, scope, and resources. This output (e.g., a detailed requirements document) serves as the core input for the Design phase.'),(2,'Design','The Design phase produces the \"how\" of the project—the system architecture, user interface (UI), and database design. These blueprints and specifications are essential for the Development phase, guiding the programmers as they write the actual code. The code must adhere to the design to ensure the final product meets the architectural and functional requirements.'),(3,'Development','The completed code from the Development phase is the product that is handed over to the Testing phase. Testers use the project requirements and design documents to create test cases and verify that the software functions as intended, identifying bugs and defects.'),(4,'Testing','Once the software has passed all tests and is deemed stable and bug-free, it is ready for Deployment. The deployment team takes the final, validated software and releases it to the production environment, making it available to end-users.'),(5,'Deployment','Once deployed, the software enters the Maintenance phase. This phase relies on feedback from users, monitoring data, and bug reports from the production environment. These new requirements and bug fixes then feed back into the Planning or Development phases, starting the cycle over again for the next version or update.'),(6,'Maintenance','The Maintenance phase is the final stage of the Software Development Life Cycle (SDLC) and begins immediately after the software has been deployed to the production environment. Its primary purpose is to ensure the software continues to function correctly and remains relevant and useful to users over its entire lifespan.'),(7,'Closed','The Closed phase is used to officially mark a project as complete and to indicate that no further work will be done on it. While the Maintenance phase is ongoing and active (dealing with bug fixes and updates), the Closed phase represents a final, terminal state for the project.');
/*!40000 ALTER TABLE `sdlc_phases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_status_groups`
--

DROP TABLE IF EXISTS `task_status_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_status_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_group` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_status_groups`
--

LOCK TABLES `task_status_groups` WRITE;
/*!40000 ALTER TABLE `task_status_groups` DISABLE KEYS */;
INSERT INTO `task_status_groups` VALUES (1,'Open'),(2,'Pending'),(3,'Closed');
/*!40000 ALTER TABLE `task_status_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_statuses`
--

DROP TABLE IF EXISTS `task_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status_group_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_statuses`
--

LOCK TABLES `task_statuses` WRITE;
/*!40000 ALTER TABLE `task_statuses` DISABLE KEYS */;
INSERT INTO `task_statuses` VALUES (1,'Backlog','Task is logged but not yet prioritized or scheduled.',1),(2,'To Do','Task is ready to be worked on but hasn\'t started.',1),(3,'In Progress','Task is actively being worked on.',1),(4,'In Review','Task is completed and under review or testing.',2),(5,'Blocked','Task cannot proceed due to a dependency or issue.',2),(6,'On Hold','Task is paused temporarily (e.g., waiting for client feedback).',2),(7,'Completed','Task is finished and approved.',3),(8,'Cancelled','Task was removed or deemed unnecessary.',3),(9,'Deferred','Task postponed for future consideration.',2);
/*!40000 ALTER TABLE `task_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_types`
--

DROP TABLE IF EXISTS `task_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_type` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_types`
--

LOCK TABLES `task_types` WRITE;
/*!40000 ALTER TABLE `task_types` DISABLE KEYS */;
INSERT INTO `task_types` VALUES (1,'Feature','A new functionality or capability to be built. Common in software projects.'),(2,'Bug','A defect or issue that needs fixing.'),(3,'Improvement','Enhancing an existing feature or process.'),(4,'Research','Investigating a topic, tool, or solution before implementation.'),(5,'Documentation','Writing manuals, guides, or internal notes.'),(6,'Designing','UI/UX work, wireframes, mockups, or visual assets.'),(7,'Testing','QA tasks, test case creation, or validation.'),(8,'Deployment','Releasing code or assets to production or staging environments.'),(9,'Meeting','Scheduled discussions, reviews, or planning sessions.'),(10,'Review','Code reviews, design critiques, or feedback loops.'),(11,'Training','Onboarding, skill development, or knowledge sharing.'),(12,'Maintenance','Routine updates, backups, or system checks.'),(13,'Support','Responding to user issues or internal requests.'),(14,'Approval','Tasks requiring sign-off or decision-making.');
/*!40000 ALTER TABLE `task_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'LJ','Ensomo','lensomo','$2y$10$TB.3f684fkVDEzTTl.lv8eURKue1/lLgHDyljZb27JEpz8/PC7VLy',1,'2025-07-05 08:36:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `version_statuses`
--

DROP TABLE IF EXISTS `version_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `version_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `version_statuses`
--

LOCK TABLES `version_statuses` WRITE;
/*!40000 ALTER TABLE `version_statuses` DISABLE KEYS */;
INSERT INTO `version_statuses` VALUES (1,'Development','This is the version you are currently working on. It\'s not finished or ready for use yet.'),(2,'Published','The version is complete and ready. Think of this as a \"release candidate\" that is stable but not yet the main version you are using.'),(3,'Active','This is the single, official version of the application that you are currently using. There should only ever be one active version at a time.'),(4,'Archived','This is a previous version that was once Active but has since been replaced by a newer one. It\'s kept for historical records.'),(5,'Withdrawn','A version that was Published but you decided to pull back for some reason (e.g., you found a major bug). It was never Active');
/*!40000 ALTER TABLE `version_statuses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-01  6:56:37
