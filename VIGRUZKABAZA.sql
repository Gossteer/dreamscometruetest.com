-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3308
-- Время создания: Мар 27 2020 г., 14:09
-- Версия сервера: 8.0.18
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dreamscometrue`
--

-- --------------------------------------------------------

--
-- Структура таблицы `additional_services`
--

DROP TABLE IF EXISTS `additional_services`;
CREATE TABLE IF NOT EXISTS `additional_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tours_id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Count` int(11) NOT NULL DEFAULT '1',
  `Price` int(11) DEFAULT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `additional_services_tours_id_foreign` (`tours_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `partners_id` bigint(20) UNSIGNED NOT NULL,
  `Address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Нет',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_partners_id_foreign` (`partners_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `albums`
--

DROP TABLE IF EXISTS `albums`;
CREATE TABLE IF NOT EXISTS `albums` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Album_Title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Album_Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Album_Cover` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Confidentiality` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `albums_album_title_unique` (`Album_Title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `buses`
--

DROP TABLE IF EXISTS `buses`;
CREATE TABLE IF NOT EXISTS `buses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Brand_Bus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `State_Registration_Number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Year_Issue` date NOT NULL,
  `Diagnostic_card` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Validity_Date` date NOT NULL,
  `Amount_Place_Bus` smallint(6) NOT NULL,
  `Tachograph` tinyint(1) NOT NULL DEFAULT '0',
  `Glonas_GPS` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `buses_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `buses`
--

INSERT INTO `buses` (`id`, `employee_id`, `created_at`, `updated_at`, `Brand_Bus`, `State_Registration_Number`, `Year_Issue`, `Diagnostic_card`, `Validity_Date`, `Amount_Place_Bus`, `Tachograph`, `Glonas_GPS`, `LogicalDelete`) VALUES
(1, 1, '2020-02-20 06:54:27', '2020-02-20 20:10:34', 'Автобус', '11111111111111', '2020-01-12', '1111111111111111', '2020-12-12', 1111, 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `category_sources`
--

DROP TABLE IF EXISTS `category_sources`;
CREATE TABLE IF NOT EXISTS `category_sources` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name_Category_Source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_sources_name_category_source_unique` (`Name_Category_Source`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `childrens`
--

DROP TABLE IF EXISTS `childrens`;
CREATE TABLE IF NOT EXISTS `childrens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `passengers_id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Surname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Middle_Name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Occupied_Place_Bus` smallint(6) NOT NULL,
  `Fry` tinyint(1) NOT NULL DEFAULT '0',
  `Date_Birth_Day` date NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `childrens_passengers_id_foreign` (`passengers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `contracts`
--

DROP TABLE IF EXISTS `contracts`;
CREATE TABLE IF NOT EXISTS `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name_Contract_doc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Salary` int(11) NOT NULL DEFAULT '0',
  `tours_id` bigint(20) UNSIGNED NOT NULL,
  `partners_id` bigint(20) UNSIGNED NOT NULL,
  `Document_Contract` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `contracts_partners_id_foreign` (`partners_id`),
  KEY `contracts_tours_id_foreign` (`tours_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `contracts_for_passengers`
--

DROP TABLE IF EXISTS `contracts_for_passengers`;
CREATE TABLE IF NOT EXISTS `contracts_for_passengers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Childrens` tinyint(4) NOT NULL DEFAULT '0',
  `Gorwns` tinyint(4) NOT NULL DEFAULT '0',
  `Prepayment` int(11) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Surname` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Middle_Name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `White_Days` smallint(6) NOT NULL DEFAULT '0',
  `Black_Days` smallint(6) NOT NULL DEFAULT '0',
  `The_amount_of_tokens_spent` int(11) NOT NULL DEFAULT '0',
  `Amount_Customers_Listed` smallint(6) NOT NULL DEFAULT '0',
  `Photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Phone_Number_Customer` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Phone_Customer_Inviter` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sources_id` bigint(20) UNSIGNED DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `z_g_p_s_id` bigint(20) UNSIGNED DEFAULT NULL,
  `p_r_f_s_id` bigint(20) UNSIGNED DEFAULT NULL,
  `Date_Birth_Customer` date NOT NULL,
  `Preferred_Type_Tours` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `floor` tinyint(1) NOT NULL,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Отсуствует',
  `Age_Group` smallint(6) DEFAULT NULL,
  `Condition` tinyint(4) NOT NULL DEFAULT '0',
  `Debt` mediumint(9) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_phone_number_customer_unique` (`Phone_Number_Customer`),
  KEY `customers_users_id_foreign` (`users_id`),
  KEY `customers_z_g_p_s_id_foreign` (`z_g_p_s_id`),
  KEY `customers_sources_id_foreign` (`sources_id`),
  KEY `customers_p_r_f_s_id_foreign` (`p_r_f_s_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `created_at`, `updated_at`, `Name`, `Surname`, `Middle_Name`, `White_Days`, `Black_Days`, `The_amount_of_tokens_spent`, `Amount_Customers_Listed`, `Photo`, `Phone_Number_Customer`, `Phone_Customer_Inviter`, `sources_id`, `users_id`, `z_g_p_s_id`, `p_r_f_s_id`, `Date_Birth_Customer`, `Preferred_Type_Tours`, `floor`, `Description`, `Age_Group`, `Condition`, `Debt`, `LogicalDelete`) VALUES
(1, '2020-02-20 05:49:10', '2020-02-20 05:49:10', 'Антон', 'Игнатьев', 'Александрович', 0, 0, 0, 0, NULL, '+7 (926) 478-53-81', '+7 (654) 654-65-46', NULL, 1, NULL, NULL, '1999-03-31', NULL, 0, 'Отсуствует', 1, -1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `depts`
--

DROP TABLE IF EXISTS `depts`;
CREATE TABLE IF NOT EXISTS `depts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tours_id` bigint(20) UNSIGNED NOT NULL,
  `passengers_id` bigint(20) UNSIGNED NOT NULL,
  `Amount of children` mediumint(9) DEFAULT NULL,
  `Sum` int(11) NOT NULL,
  `Paid` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `depts_passengers_id_foreign` (`passengers_id`),
  KEY `depts_employee_id_foreign` (`employee_id`),
  KEY `depts_tours_id_foreign` (`tours_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `drivers_lisenses`
--

DROP TABLE IF EXISTS `drivers_lisenses`;
CREATE TABLE IF NOT EXISTS `drivers_lisenses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Driving_License_Series` smallint(6) NOT NULL,
  `Driver_License_Id` mediumint(9) NOT NULL,
  `Date_Driver_License` date NOT NULL,
  `driving_license_categories_id` bigint(20) UNSIGNED NOT NULL,
  `Confirmation` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `drivers_lisenses_driving_license_categories_id_foreign` (`driving_license_categories_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `driving_license_categories`
--

DROP TABLE IF EXISTS `driving_license_categories`;
CREATE TABLE IF NOT EXISTS `driving_license_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name_Driving_Category` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `driving_license_categories_name_driving_category_unique` (`Name_Driving_Category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `emails`
--

DROP TABLE IF EXISTS `emails`;
CREATE TABLE IF NOT EXISTS `emails` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `partners_id` bigint(20) UNSIGNED NOT NULL,
  `Representative_Email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Нет',
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emails_partners_id_foreign` (`partners_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Surname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Middle_Name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Byrthday` date DEFAULT NULL,
  `Description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Лучший в своем деле!',
  `Phone_Number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contract_Employee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Set_Permission` tinyint(1) NOT NULL DEFAULT '0',
  `Man_brought` int(11) NOT NULL DEFAULT '0',
  `Joint_excursions` int(11) NOT NULL DEFAULT '0',
  `Level` smallint(6) NOT NULL DEFAULT '0',
  `jobs_id` bigint(20) UNSIGNED DEFAULT NULL,
  `Work_Schedule_id` bigint(20) UNSIGNED DEFAULT NULL,
  `passport_date_id` bigint(20) UNSIGNED DEFAULT NULL,
  `drivers_lisense_id` bigint(20) UNSIGNED DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED DEFAULT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_phone_number_unique` (`Phone_Number`),
  KEY `employees_jobs_id_foreign` (`jobs_id`),
  KEY `employees_passport_date_id_foreign` (`passport_date_id`),
  KEY `employees_drivers_lisense_id_foreign` (`drivers_lisense_id`),
  KEY `employees_work_schedule_id_foreign` (`Work_Schedule_id`),
  KEY `employees_users_id_foreign` (`users_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `created_at`, `updated_at`, `Name`, `Surname`, `Middle_Name`, `Byrthday`, `Description`, `Phone_Number`, `Photo`, `Contract_Employee`, `Set_Permission`, `Man_brought`, `Joint_excursions`, `Level`, `jobs_id`, `Work_Schedule_id`, `passport_date_id`, `drivers_lisense_id`, `users_id`, `LogicalDelete`) VALUES
(1, '2020-02-20 06:42:45', '2020-02-20 06:42:45', 'Игнатьев', 'Игнатьев', 'Антон', '1976-12-23', 'asdasd', '+7 (892) 647-85-38', NULL, NULL, 0, 0, 0, 0, 1, NULL, NULL, NULL, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Job_Title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Salary` int(11) DEFAULT NULL,
  `Company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `created_at`, `updated_at`, `Job_Title`, `Salary`, `Company`, `LogicalDelete`) VALUES
(1, '2020-02-20 06:28:11', '2020-02-20 06:28:11', 'Водитель', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_04_132237_create_type_tours_table', 1),
(4, '2019_08_04_133856_create_routes_table', 1),
(5, '2019_08_04_133935_create_buses_table', 1),
(6, '2019_08_04_134007_create_type_contracts_table', 1),
(7, '2019_08_04_134042_create_passengers_table', 1),
(8, '2019_08_04_140046_create_customers_table', 1),
(9, '2019_08_04_142110_create_partners_table', 1),
(10, '2019_08_04_142255_create_type_activities_table', 1),
(11, '2019_08_04_142359_create_employees_table', 1),
(12, '2019_08_04_142412_create_jobs_table', 1),
(13, '2019_08_04_142444_create_work_schedules_table', 1),
(14, '2019_08_04_142558_create_sources_table', 1),
(15, '2019_08_04_143513_create_albums_table', 1),
(16, '2019_08_04_143621_create_photos_table', 1),
(17, '2019_08_04_143820_create_new_category_news_table', 1),
(18, '2019_08_04_143838_create_new_categories_table', 1),
(19, '2019_08_05_102059_create_driving_license_categories_table', 1),
(20, '2019_08_05_104441_create_news_table', 1),
(21, '2019_08_05_113126_create_contracts_table', 1),
(22, '2019_08_05_113544_create_tours_table', 1),
(23, '2019_08_06_090514_create_roles_table', 1),
(24, '2019_08_10_164714_create_category_sources_table', 1),
(25, '2019_08_17_202605_create_z_g_p_s_table', 1),
(26, '2019_08_17_202611_create_p_r_f_s_table', 1),
(27, '2019_09_03_091632_create_stocks_table', 1),
(28, '2019_09_09_140038_create_tour_employees_table', 1),
(29, '2019_10_10_102412_create_contracts_for_passengers_table', 1),
(30, '2019_10_11_121527_create_additional_services_table', 1),
(31, '2019_10_11_121559_create_purchased_additional_services_table', 1),
(32, '2019_10_25_182920_create_price_per__levels_table', 1),
(33, '2019_10_27_164155_create_passport_dates_table', 1),
(34, '2019_10_27_164611_create_drivers_lisenses_table', 1),
(35, '2019_10_27_170035_create_childrens_table', 1),
(36, '2019_10_27_171747_create_used_tickets_table', 1),
(37, '2019_10_27_172232_create_tickets_table', 1),
(38, '2019_11_05_100848_create_phone_nombers_table', 1),
(39, '2019_11_05_100914_create_addresses_table', 1),
(40, '2019_11_05_100932_create_emails_table', 1),
(41, '2019_11_05_100950_create_websites_table', 1),
(42, '2019_11_19_162006_create_depts_table', 1),
(43, '2019_11_19_202636_create_trigger', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `albums_id` bigint(20) UNSIGNED NOT NULL,
  `Headline` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Text_News` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `news_albums_id_foreign` (`albums_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `new_categories`
--

DROP TABLE IF EXISTS `new_categories`;
CREATE TABLE IF NOT EXISTS `new_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name_New_Category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `new_categories_name_new_category_unique` (`Name_New_Category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `new_category_news`
--

DROP TABLE IF EXISTS `new_category_news`;
CREATE TABLE IF NOT EXISTS `new_category_news` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `new_category_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `new_category_news_news_id_foreign` (`news_id`),
  KEY `new_category_news_new_category_id_foreign` (`new_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `partners`
--

DROP TABLE IF EXISTS `partners`;
CREATE TABLE IF NOT EXISTS `partners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type_activities_id` bigint(20) UNSIGNED NOT NULL,
  `Name_Partners` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Conract_Partners` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `INN` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `partners_name_partners_unique` (`Name_Partners`),
  UNIQUE KEY `partners_inn_unique` (`INN`),
  KEY `partners_type_activities_id_foreign` (`type_activities_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `passengers`
--

DROP TABLE IF EXISTS `passengers`;
CREATE TABLE IF NOT EXISTS `passengers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tours_id` bigint(20) UNSIGNED NOT NULL,
  `customers_id` bigint(20) UNSIGNED NOT NULL,
  `contracts_for_passengers_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_id` bigint(20) UNSIGNED DEFAULT NULL,
  `Preferential_Terms` tinyint(1) NOT NULL DEFAULT '0',
  `Accompanying` tinyint(1) NOT NULL DEFAULT '0',
  `Free_Children` mediumint(9) NOT NULL DEFAULT '0',
  `Amount_Children` tinyint(4) NOT NULL DEFAULT '0',
  `Assessment` tinyint(4) NOT NULL DEFAULT '0',
  `Presence` tinyint(4) NOT NULL DEFAULT '0',
  `Occupied_Place_Bus` smallint(6) DEFAULT NULL,
  `Paid` tinyint(1) NOT NULL DEFAULT '0',
  `Stars` tinyint(4) DEFAULT NULL,
  `Final_Price` int(11) NOT NULL DEFAULT '0',
  `Payment_method` tinyint(1) NOT NULL,
  `Comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Отсутствует',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `passengers_tours_id_foreign` (`tours_id`),
  KEY `passengers_customers_id_foreign` (`customers_id`),
  KEY `passengers_contracts_for_passengers_id_foreign` (`contracts_for_passengers_id`),
  KEY `passengers_stock_id_foreign` (`stock_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `passport_dates`
--

DROP TABLE IF EXISTS `passport_dates`;
CREATE TABLE IF NOT EXISTS `passport_dates` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Passport_Series` smallint(6) NOT NULL,
  `Passport_Id` mediumint(9) NOT NULL,
  `Address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Confirmation` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `phone_nombers`
--

DROP TABLE IF EXISTS `phone_nombers`;
CREATE TABLE IF NOT EXISTS `phone_nombers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `partners_id` bigint(20) UNSIGNED NOT NULL,
  `Representative` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Не имеется',
  `Phone_Number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phone_nombers_partners_id_foreign` (`partners_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `albums_id` bigint(20) UNSIGNED NOT NULL,
  `Photo_Description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `photos_albums_id_foreign` (`albums_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `price_per_levels`
--

DROP TABLE IF EXISTS `price_per_levels`;
CREATE TABLE IF NOT EXISTS `price_per_levels` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `Level` smallint(6) NOT NULL DEFAULT '0',
  `Price` int(11) NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `price_per_levels_tour_id_foreign` (`tour_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `purchased_additional_services`
--

DROP TABLE IF EXISTS `purchased_additional_services`;
CREATE TABLE IF NOT EXISTS `purchased_additional_services` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `passengers_id` bigint(20) UNSIGNED NOT NULL,
  `additional_service_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `purchased_additional_services_passengers_id_foreign` (`passengers_id`),
  KEY `purchased_additional_services_additional_service_id_foreign` (`additional_service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `p_r_f_s`
--

DROP TABLE IF EXISTS `p_r_f_s`;
CREATE TABLE IF NOT EXISTS `p_r_f_s` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `PRF_Series` mediumint(9) NOT NULL,
  `PRF_Number` mediumint(9) NOT NULL,
  `Date_Issue_PRF` date NOT NULL,
  `Issued_PRF` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Code_Division_PRF` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo_PRF` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Confirm` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Tours` tinyint(1) NOT NULL DEFAULT '0',
  `Partners` tinyint(1) NOT NULL DEFAULT '0',
  `Customers` tinyint(1) NOT NULL DEFAULT '0',
  `Employee` tinyint(1) NOT NULL DEFAULT '0',
  `Passengers` tinyint(1) NOT NULL DEFAULT '0',
  `Passengers_Paid` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE IF NOT EXISTS `routes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Map` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Itinerary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Distination_From_Initial_Pop` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Time_Sending_From_Initial_Pop` time NOT NULL,
  `Distination_From_End_Point` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Time_Sending_From_End_Point` time NOT NULL,
  `Name_Car_Dorough_Dorog_Report_Transportation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `routes`
--

INSERT INTO `routes` (`id`, `created_at`, `updated_at`, `Map`, `Itinerary`, `Distination_From_Initial_Pop`, `Time_Sending_From_Initial_Pop`, `Distination_From_End_Point`, `Time_Sending_From_End_Point`, `Name_Car_Dorough_Dorog_Report_Transportation`, `LogicalDelete`) VALUES
(1, '2020-02-20 06:54:40', '2020-02-20 20:47:16', '123', '5555', '11111', '11:11:00', '1111111', '11:11:00', '1111111', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `sources`
--

DROP TABLE IF EXISTS `sources`;
CREATE TABLE IF NOT EXISTS `sources` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name_Source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Site` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Category_Sources_id` bigint(20) UNSIGNED NOT NULL,
  `Photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sources_name_source_unique` (`Name_Source`),
  UNIQUE KEY `sources_site_unique` (`Site`),
  KEY `sources_category_sources_id_foreign` (`Category_Sources_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name_Stock` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Stock_Price` mediumint(9) NOT NULL,
  `Start_Date_Stock` date NOT NULL,
  `Percent` tinyint(1) NOT NULL DEFAULT '0',
  `End_Date_Stock` date DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci,
  `Access` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` mediumint(9) NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tours`
--

DROP TABLE IF EXISTS `tours`;
CREATE TABLE IF NOT EXISTS `tours` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `albums_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_tours_id` bigint(20) UNSIGNED NOT NULL,
  `routes_id` bigint(20) UNSIGNED DEFAULT NULL,
  `buses_id` bigint(20) UNSIGNED DEFAULT NULL,
  `Seating` tinyint(1) NOT NULL,
  `Duration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Подробности по телефону.',
  `Popular` tinyint(1) NOT NULL DEFAULT '0',
  `Assessment` tinyint(4) NOT NULL DEFAULT '0',
  `ZGP` tinyint(1) NOT NULL DEFAULT '0',
  `PRF` tinyint(1) NOT NULL DEFAULT '0',
  `Name_Tours` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` text COLLATE utf8mb4_unicode_ci,
  `Start_Date_Tours` datetime NOT NULL,
  `End_Date_Tours` datetime DEFAULT NULL,
  `Price` mediumint(9) NOT NULL,
  `Confidentiality` tinyint(1) NOT NULL DEFAULT '0',
  `Privilegens_Price` mediumint(9) DEFAULT NULL,
  `Children_price` mediumint(9) DEFAULT NULL,
  `Notification_OPDA` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Profit` int(11) NOT NULL DEFAULT '0',
  `Expenses` int(11) NOT NULL,
  `Amount_Place` mediumint(9) NOT NULL,
  `Occupied_Place` mediumint(9) NOT NULL DEFAULT '0',
  `Confirmation_Tours` tinyint(4) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tours_buses_id_foreign` (`buses_id`),
  KEY `tours_routes_id_foreign` (`routes_id`),
  KEY `tours_type_tours_id_foreign` (`type_tours_id`),
  KEY `tours_albums_id_foreign` (`albums_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tours`
--

INSERT INTO `tours` (`id`, `created_at`, `updated_at`, `albums_id`, `type_tours_id`, `routes_id`, `buses_id`, `Seating`, `Duration`, `Popular`, `Assessment`, `ZGP`, `PRF`, `Name_Tours`, `Description`, `Start_Date_Tours`, `End_Date_Tours`, `Price`, `Confidentiality`, `Privilegens_Price`, `Children_price`, `Notification_OPDA`, `Profit`, `Expenses`, `Amount_Place`, `Occupied_Place`, `Confirmation_Tours`, `LogicalDelete`) VALUES
(1, '2020-03-17 21:18:35', '2020-03-17 21:18:35', NULL, 1, 1, 1, 0, '0', 0, 5, 0, 0, '111111', NULL, '1111-11-11 11:11:00', '1111-11-11 11:11:00', 16000, 0, NULL, NULL, NULL, 0, 2222, 19, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tour_employees`
--

DROP TABLE IF EXISTS `tour_employees`;
CREATE TABLE IF NOT EXISTS `tour_employees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Salary` int(11) NOT NULL DEFAULT '0',
  `Occupied_Place_Bus` smallint(6) DEFAULT NULL,
  `tour_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `Confidentiality` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tour_employees_tour_id_foreign` (`tour_id`),
  KEY `tour_employees_employee_id_foreign` (`employee_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `type_activities`
--

DROP TABLE IF EXISTS `type_activities`;
CREATE TABLE IF NOT EXISTS `type_activities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name_Type_Activity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_activities_name_type_activity_unique` (`Name_Type_Activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `type_contracts`
--

DROP TABLE IF EXISTS `type_contracts`;
CREATE TABLE IF NOT EXISTS `type_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name_Type_Contract` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Document_Extension` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_contracts_name_type_contract_unique` (`Name_Type_Contract`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `type_tours`
--

DROP TABLE IF EXISTS `type_tours`;
CREATE TABLE IF NOT EXISTS `type_tours` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Name_Type_Tours` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type_tours_name_type_tours_unique` (`Name_Type_Tours`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `type_tours`
--

INSERT INTO `type_tours` (`id`, `created_at`, `updated_at`, `Name_Type_Tours`, `LogicalDelete`) VALUES
(1, '2020-02-20 06:53:51', '2020-02-20 06:56:11', 'Школьная', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `used_tickets`
--

DROP TABLE IF EXISTS `used_tickets`;
CREATE TABLE IF NOT EXISTS `used_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `passengers_id` bigint(20) UNSIGNED NOT NULL,
  `tickets_id` bigint(20) UNSIGNED NOT NULL,
  `Amount` mediumint(9) NOT NULL,
  `Confirmation` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `used_tickets_passengers_id_foreign` (`passengers_id`),
  KEY `used_tickets_tickets_id_foreign` (`tickets_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `Notifications` tinyint(1) NOT NULL DEFAULT '0',
  `Processing_Personal_Data` tinyint(1) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `Type_User` tinyint(4) NOT NULL DEFAULT '-1',
  `roles_id` bigint(20) UNSIGNED DEFAULT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_unique` (`login`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_roles_id_foreign` (`roles_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `email_verified_at`, `Notifications`, `Processing_Personal_Data`, `password`, `remember_token`, `created_at`, `updated_at`, `Photo`, `Type_User`, `roles_id`, `LogicalDelete`) VALUES
(1, 'Gossteer', 'GossteerPlus@gmail.com', NULL, 1, 1, '89264785381a', NULL, '2020-02-20 05:49:10', '2020-02-20 05:49:10', 'default', 1, NULL, 0),
(13, 'xczxczxczxc', 'GosssssteerPlus@gmail.com', NULL, 1, 1, '$2y$10$p7hu6YL2kZrjy.tvSMEoO.3OM.1DvGq30gXw4P1UB.SnuVwgApfna', NULL, '2020-03-25 16:16:12', '2020-03-25 16:16:12', 'default', -1, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `websites`
--

DROP TABLE IF EXISTS `websites`;
CREATE TABLE IF NOT EXISTS `websites` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `partners_id` bigint(20) UNSIGNED NOT NULL,
  `Site` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `websites_partners_id_foreign` (`partners_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `work_schedules`
--

DROP TABLE IF EXISTS `work_schedules`;
CREATE TABLE IF NOT EXISTS `work_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Days_Week` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Hours_Hour` tinyint(4) NOT NULL,
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `z_g_p_s`
--

DROP TABLE IF EXISTS `z_g_p_s`;
CREATE TABLE IF NOT EXISTS `z_g_p_s` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ZGP_Series` mediumint(9) NOT NULL,
  `ZGP_Number` mediumint(9) NOT NULL,
  `Date_Issue_ZGP` date NOT NULL,
  `Issued_ZGP` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Valid_Until_ZGP` date NOT NULL,
  `Photo_ZGP` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Confirm` tinyint(1) NOT NULL DEFAULT '0',
  `LogicalDelete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
