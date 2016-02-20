# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.20)
# Database: invoice_manager_lite
# Generation Time: 2016-02-20 17:53:41 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ci_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table clients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` varchar(50) NOT NULL,
  `credentials_id` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(120) NOT NULL,
  `address` varchar(120) NOT NULL,
  `address2` varchar(120) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `tel1` varchar(40) NOT NULL,
  `tel2` varchar(40) NOT NULL,
  `registration_number` varchar(40) DEFAULT NULL,
  `unique_number` varchar(40) DEFAULT NULL,
  `tax_number` varchar(40) DEFAULT NULL,
  `self_client` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table clients_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clients_groups`;

CREATE TABLE `clients_groups` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `credentials_id` varchar(50) NOT NULL DEFAULT '',
  `company_id` varchar(50) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_description` varchar(1024) DEFAULT NULL,
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table clients_in_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clients_in_groups`;

CREATE TABLE `clients_in_groups` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `credentials_id` varchar(50) NOT NULL DEFAULT '',
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `client_id` varchar(50) NOT NULL DEFAULT '',
  `group_id` varchar(50) NOT NULL DEFAULT '',
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table credentials
# ------------------------------------------------------------

DROP TABLE IF EXISTS `credentials`;

CREATE TABLE `credentials` (
  `id` varchar(50) NOT NULL,
  `parent_id` varchar(50) NOT NULL DEFAULT '0',
  `full_name` varchar(80) DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` enum('ADMIN','CUSTOMER','RESELLER','VIEWER') NOT NULL DEFAULT 'CUSTOMER',
  `is_child` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `status` enum('ENABLE','DISABLE') NOT NULL DEFAULT 'ENABLE',
  `suspended` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `deleted` int(1) NOT NULL,
  `data_created` date NOT NULL,
  `data_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer_company_profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_company_profile`;

CREATE TABLE `customer_company_profile` (
  `id` varchar(50) NOT NULL,
  `credentials_id` varchar(50) NOT NULL,
  `company_name` varchar(120) NOT NULL DEFAULT '',
  `address` varchar(120) NOT NULL,
  `address2` varchar(120) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(80) NOT NULL,
  `tel1` varchar(40) NOT NULL,
  `tel2` varchar(40) NOT NULL,
  `registration_number` varchar(40) DEFAULT '',
  `unique_number` varchar(40) DEFAULT '',
  `tax_number` varchar(40) DEFAULT '',
  `iban_code` varchar(20) NOT NULL,
  `bank_name` varchar(40) NOT NULL,
  `bank_address` varchar(80) NOT NULL,
  `bank_account` varchar(40) DEFAULT '',
  `swift` varchar(10) NOT NULL,
  `company_logo` varchar(120) DEFAULT NULL,
  `deleted` int(1) NOT NULL,
  `data_created` date NOT NULL,
  `data_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer_profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_profile`;

CREATE TABLE `customer_profile` (
  `credentials_id` varchar(50) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `tel1` varchar(40) NOT NULL,
  `tel2` varchar(40) NOT NULL,
  `data_created` date NOT NULL,
  `data_modified` date NOT NULL,
  PRIMARY KEY (`credentials_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer_relations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_relations`;

CREATE TABLE `customer_relations` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `credentials_id` varchar(50) NOT NULL DEFAULT '',
  `client_credentials_id` varchar(50) NOT NULL DEFAULT '',
  `related` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table customer_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_settings`;

CREATE TABLE `customer_settings` (
  `credentials_id` varchar(50) NOT NULL,
  `default_currency` varchar(5) NOT NULL,
  `default_language` int(2) NOT NULL DEFAULT '0',
  `invoice_number` int(6) NOT NULL DEFAULT '0',
  `invoice_number_format` enum('YEARMINUMBER','YRMINUMBER','NUMBERSLYEAR','NUMBERSLYR','NUMBER') NOT NULL DEFAULT 'NUMBER',
  `invoice_number_pre` varchar(10) DEFAULT NULL,
  `output_invoice_number` int(6) NOT NULL DEFAULT '0',
  `output_invoice_number_format` enum('YEARMINUMBER','YRMINUMBER','NUMBERSLYEAR','NUMBERSLYR','NUMBER') NOT NULL DEFAULT 'NUMBER',
  `output_invoice_number_pre` varchar(10) DEFAULT NULL,
  `draft_invoice_number` int(6) NOT NULL DEFAULT '0',
  `draft_invoice_number_format` enum('YEARMINUMBER','YRMINUMBER','NUMBERSLYEAR','NUMBERSLYR','NUMBER') NOT NULL DEFAULT 'NUMBER',
  `draft_invoice_number_pre` varchar(10) DEFAULT NULL,
  `incoming_order_number` int(6) NOT NULL DEFAULT '0',
  `outgoing_order_number` int(6) NOT NULL DEFAULT '0',
  `request_number` int(6) NOT NULL DEFAULT '0',
  `delivery_note_number` int(6) NOT NULL DEFAULT '0',
  `received_note_number` int(6) NOT NULL DEFAULT '0',
  `tax_visible` int(1) NOT NULL,
  `tax_calculate` int(1) NOT NULL,
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table documents_stats
# ------------------------------------------------------------

DROP TABLE IF EXISTS `documents_stats`;

CREATE TABLE `documents_stats` (
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `invoice_number` int(6) DEFAULT '0',
  `output_invoice_number` int(6) DEFAULT '0',
  `draft_invoice_number` int(6) DEFAULT '0',
  `incoming_order_number` int(6) DEFAULT '0',
  `outgoing_order_number` int(6) DEFAULT '0',
  `request_number` int(6) DEFAULT '0',
  `delivery_note_number` int(6) DEFAULT '0',
  `received_note_number` int(6) DEFAULT '0',
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table invoice
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id` varchar(50) NOT NULL,
  `draft_id` varchar(50) DEFAULT NULL,
  `delivery_note_id` varchar(50) DEFAULT NULL,
  `received_note_id` varchar(50) DEFAULT NULL,
  `credentials_id` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `clients_id` varchar(50) NOT NULL,
  `location_id` varchar(50) DEFAULT NULL,
  `inventory_id` varchar(50) DEFAULT NULL,
  `invoice_number` varchar(14) NOT NULL DEFAULT '',
  `invoice_sum` int(11) NOT NULL,
  `invoice_tax_sum` int(11) NOT NULL,
  `invoice_subtotal` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `paid_date` date DEFAULT NULL,
  `show_tax` int(1) NOT NULL,
  `calculate_tax` int(1) NOT NULL,
  `status` enum('PAID','NOTPAID') NOT NULL DEFAULT 'NOTPAID',
  `store_status` enum('STORED','PROCEDED') NOT NULL DEFAULT 'STORED',
  `confirmed` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `comment` varchar(1024) NOT NULL DEFAULT 'NO',
  `invoice_type` enum('INPUT','OUTPUT','DRAFT','DELIVERY','RECEIVED') NOT NULL DEFAULT 'INPUT',
  `imported` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table invoice_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `invoice_products`;

CREATE TABLE `invoice_products` (
  `id` varchar(50) NOT NULL,
  `credentials_id` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `invoice_id` varchar(50) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `product_price_id` varchar(50) NOT NULL,
  `inventory_id` varchar(50) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(2) NOT NULL,
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table product_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_category`;

CREATE TABLE `product_category` (
  `id` varchar(50) NOT NULL,
  `credentials_id` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(80) NOT NULL,
  `description` varchar(120) NOT NULL,
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` varchar(50) NOT NULL,
  `credentials_id` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `product_code` varchar(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(255) NOT NULL,
  `product_type_id` varchar(50) NOT NULL,
  `category_id` varchar(50) NOT NULL,
  `tax` int(4) NOT NULL,
  `unit` varchar(6) NOT NULL,
  `input_price` varchar(10) DEFAULT NULL,
  `output_price` varchar(10) DEFAULT NULL,
  `current_price_id` varchar(50) DEFAULT NULL,
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table products_price
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products_price`;

CREATE TABLE `products_price` (
  `id` varchar(50) NOT NULL,
  `credentials_id` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `product_id` varchar(50) NOT NULL,
  `input_price` varchar(10) NOT NULL,
  `output_price` varchar(10) NOT NULL,
  `tax` varchar(4) NOT NULL DEFAULT '',
  `deleted` int(1) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table products_quantity_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products_quantity_list`;

CREATE TABLE `products_quantity_list` (
  `credentials_id` varchar(50) NOT NULL DEFAULT '',
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `shop_id` varchar(50) NOT NULL DEFAULT '',
  `product_id` varchar(50) NOT NULL DEFAULT '',
  `quantity` int(11) NOT NULL,
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table shops_locations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shops_locations`;

CREATE TABLE `shops_locations` (
  `id` varchar(50) NOT NULL,
  `credentials_id` varchar(50) NOT NULL,
  `company_id` varchar(50) NOT NULL DEFAULT '',
  `type` enum('CLIENT','CUSTOMER') NOT NULL DEFAULT 'CUSTOMER',
  `client_id` varchar(50) DEFAULT '',
  `name` varchar(80) NOT NULL,
  `address` varchar(255) DEFAULT '',
  `city` varchar(40) DEFAULT '',
  `zip` varchar(10) DEFAULT NULL,
  `tel` varchar(40) DEFAULT NULL,
  `deleted` int(1) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
