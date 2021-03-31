-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 31, 2021 at 06:35 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_db`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `addresses_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addresses_add` (IN `first_namev` VARCHAR(45), IN `last_namev` VARCHAR(45), IN `phonev` VARCHAR(9), IN `typev` INT, IN `location_mapv` TEXT, IN `locations_idv` INT, IN `users_idv` INT, IN `descriptionv` TEXT)  NO SQL
BEGIN
INSERT INTO `addresses` (`id`, `first_name`, `last_name`, `phone`, `type`, `location_map`, `locations_id`, `users_id`,description) VALUES (NULL, first_namev,last_namev,phonev,typev,location_mapv,locations_idv,users_idv,descriptionv);
END$$

DROP PROCEDURE IF EXISTS `addresses_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addresses_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `addresses` WHERE `addresses`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `addresses_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addresses_update` (IN `idv` INT, IN `first_namev` VARCHAR(45), IN `last_namev` VARCHAR(45), IN `phonev` VARCHAR(9), IN `typev` INT, IN `location_mapv` TEXT, IN `locations_idv` INT, IN `users_idv` INT, IN `descriptionv` TEXT)  NO SQL
BEGIN
UPDATE `addresses` SET `first_name` = first_namev, `last_name` = last_namev, `phone` =phonev, `type` =typev, `location_map` = location_mapv, `description` = descriptionv, `locations_id` = locations_idv, `users_id` = users_idv  WHERE `addresses`.`id` =idv;
END$$

DROP PROCEDURE IF EXISTS `categories_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `categories_add` (IN `namev` VARCHAR(45), IN `add_datev` DATE, IN `activationv` BOOLEAN)  NO SQL
BEGIN
INSERT INTO `categories` ( `name`, `add_date`, `activation`) VALUES ( namev, add_datev, activationv);
END$$

DROP PROCEDURE IF EXISTS `categories_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `categories_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `categories` WHERE `categories`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `categories_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `categories_update` (IN `idv` INT, IN `namev` VARCHAR(45), IN `add_datev` DATE, IN `activationv` BOOLEAN)  NO SQL
BEGIN
UPDATE `categories` SET `name` = namev, `add_date` = add_datev, `activation` = activationv WHERE `categories`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `comments_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comments_add` (IN `commentva` TEXT, IN `add_datev` DATE, IN `activationv` TINYINT(1), IN `users_idv` INT, IN `products_idv` INT)  NO SQL
BEGIN
INSERT INTO `comments` ( `comment`, `add_date`, `activation`, `users_id`, `products_id`) VALUES ( commentva, add_datev, activationv,users_idv, products_idv);
END$$

DROP PROCEDURE IF EXISTS `comments_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comments_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `comments` WHERE `comments`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `comments_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `comments_update` (IN `idv` INT, IN `users_idv` INT, IN `products_idv` INT, IN `commentv` TEXT, IN `add_datev` DATE, IN `activationv` TINYINT)  NO SQL
BEGIN
UPDATE `comments` SET `comment` = commentv, `add_date` =add_datev, `activation` = activationv, `users_id` = users_idv, `products_id` = products_id WHERE `comments`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `evaluations_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `evaluations_add` (IN `users_idv` INT, IN `products_idv` INT, IN `evaluationv` INT)  NO SQL
BEGIN
INSERT INTO `evaluations` (  `users_id`, `products_id`,`evaluation`) VALUES (users_idv, products_idv, evaluationv);
END$$

DROP PROCEDURE IF EXISTS `evaluations_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `evaluations_delete` (IN `users_idv` INT, IN `products_idv` INT)  NO SQL
BEGIN
DELETE FROM `evaluations` WHERE `evaluations`.`users_id` = users_idv AND `evaluations`.`products_id` =products_id ;
END$$

DROP PROCEDURE IF EXISTS `evaluations_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `evaluations_update` (IN `users_idv` INT, IN `products_idv` INT, IN `evaluationv` INT)  NO SQL
BEGIN
UPDATE `evaluations` SET `evaluation` = evaluationv WHERE `evaluations`.`users_id` = users_idv AND `evaluations`.`products_id` =products_idv;
END$$

DROP PROCEDURE IF EXISTS `images_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `images_add` (IN `image_namev` VARCHAR(255), IN `products_idv` INT)  NO SQL
BEGIN
INSERT INTO `images` (`id`, `image_name`, `products_id`) VALUES (NULL, image_namev,products_idv);
END$$

DROP PROCEDURE IF EXISTS `images_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `images_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `images` WHERE `images`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `images_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `images_update` (IN `idv` INT, IN `image_namev` VARCHAR(255), IN `products_idv` INT)  NO SQL
BEGIN
UPDATE `images` SET `image_name` = image_namev WHERE `images`.`products_id` = products_idv and `images`.`id`=idv;
END$$

DROP PROCEDURE IF EXISTS `locations_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `locations_add` (IN `namev` VARCHAR(45), IN `levelv` TINYINT(1), IN `parentv` INT)  NO SQL
BEGIN
INSERT INTO `locations` (`id`, `name`, `level`, `parent`) VALUES (NULL,namev,levelv,parentv);
END$$

DROP PROCEDURE IF EXISTS `locations_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `locations_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `locations` WHERE `locations`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `locations_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `locations_update` (IN `idv` INT, IN `namev` VARCHAR(45), IN `levelv` TINYINT(1), IN `parentv` INT)  NO SQL
BEGIN
UPDATE `locations` SET `name` =namev, `level` = levelv, `parent` =parentv WHERE `locations`.`id` =idv;
END$$

DROP PROCEDURE IF EXISTS `messages_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `messages_add` (IN `messagev` TEXT, IN `users_idv` INT)  NO SQL
BEGIN
INSERT INTO `messages` (`message`,`users_id`) VALUES ( messagev,users_idv);
END$$

DROP PROCEDURE IF EXISTS `messages_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `messages_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `messages` WHERE `messages`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `messages_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `messages_update` (IN `idv` INT, IN `messagev` TEXT, IN `users_idv` INT)  NO SQL
BEGIN
UPDATE `messages` SET `message` = messagev ,`users_id`=users_idv WHERE `messages`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `notifications_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `notifications_add` (IN `users_idv` INT, IN `urlv` TEXT, IN `contentv` TEXT, IN `seenv` BOOLEAN, IN `add_datev` DATE)  NO SQL
BEGIN
INSERT INTO `notifications` ( `users_id`, `url`, `content`, `seen`, `add_date`) VALUES ( users_idv,urlv, contentv,seenv,add_datev);
END$$

DROP PROCEDURE IF EXISTS `offers_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `offers_add` (IN `products_idv` INT, IN `start_datev` DATE, IN `end_datev` DATE, IN `new_pricev` FLOAT)  NO SQL
BEGIN
INSERT INTO `offers` ( `products_id`, `start_date`, `end_date`, `new_price`) VALUES ( products_idv,start_datev, end_datev,new_pricev);
END$$

DROP PROCEDURE IF EXISTS `offers_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `offers_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `offers` WHERE `offers`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `offers_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `offers_update` (IN `idv` INT, IN `products_idv` INT, IN `start_datev` DATE, IN `end_datev` DATE, IN `new_pricev` FLOAT)  NO SQL
BEGIN
UPDATE `offers` SET `products_id` =products_idv, `start_date` =start_datev, `end_date` =end_datev, `new_price` =new_pricev WHERE `offers`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `orders_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orders_add` (IN `users_idv` INT, IN `products_idv` INT, IN `add_datev` DATE, IN `date_deliverv` DATE, IN `rolev` TINYINT(1), IN `sale_datev` DATE, IN `address_idv` INT)  NO SQL
BEGIN
INSERT INTO `orders` (`id`, `users_id`, `products_id`, `add_date`, `date_deliver`,  `role`,`sale_date`,`addresses_id`) VALUES (NULL, users_idv, products_idv, add_datev, date_deliverv,rolev,sale_datev,address_idv);
END$$

DROP PROCEDURE IF EXISTS `orders_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orders_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `orders` WHERE `orders`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `orders_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `orders_update` (IN `idv` INT, IN `users_idv` INT, IN `products_idv` INT, IN `add_datev` DATE, IN `date_deliverv` DATE, IN `rolev` INT, IN `sale_datev` DATE, IN `address_idv` INT)  NO SQL
BEGIN
UPDATE `orders` SET  `users_id` = users_idv, `add_date` =add_datev, `date_deliver` = date_deliverv, `role` =rolev, `sale_date` =sale_datev,`address_id` =address_idv WHERE `orders`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `products_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `products_add` (IN `users_idv` INT, IN `categories_idv` INT, IN `namev` VARCHAR(45), IN `descriptionv` TEXT, IN `activationv` BOOLEAN, IN `pricev` FLOAT, IN `add_datev` DATE, IN `periodv` INT, IN `imagef` VARCHAR(255), IN `imageb` VARCHAR(255), IN `imager` VARCHAR(255), IN `imagel` VARCHAR(255))  NO SQL
BEGIN
DECLARE productId int ;
START TRANSACTION; 
call 	products_info_add( users_idv, categories_idv, namev ,descriptionv,activationv,pricev, add_datev,periodv);
select id into productId 
from products 
where users_id=users_idv  
ORDER by id DESC limit 1 ;
if imagef !='no' then 
call images_add(imagef,productId);
END IF;
if imageb !='no' then 
call images_add(imageb,productId);
END IF;
if imager !='no' then 
call images_add(imager,productId);
END IF;
if imagel !='no' then 
call images_add(imagel,productId);
END IF;
commit;
END$$

DROP PROCEDURE IF EXISTS `products_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `products_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `products` WHERE `products`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `products_info_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `products_info_add` (IN `users_idv` INT, IN `categories_idv` INT, IN `namev` VARCHAR(45), IN `descriptionv` TEXT, IN `activationv` BOOLEAN, IN `pricev` FLOAT, IN `add_datev` DATE, IN `periodv` INT)  NO SQL
BEGIN
INSERT INTO `products` (`users_id`, `categories_id`,`name`, `description`, `activation`,`price`, `add_date`, `period`) VALUES ( users_idv, categories_idv, namev ,descriptionv,activationv,pricev, add_datev,periodv);
END$$

DROP PROCEDURE IF EXISTS `products_info_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `products_info_update` (IN `idv` INT, IN `users_idv` INT, IN `categories_idv` INT, IN `namev` VARCHAR(45), IN `descriptionv` TEXT, IN `activationv` TINYINT(1), IN `pricev` FLOAT, IN `add_datev` DATE, IN `periodv` INT)  NO SQL
BEGIN
UPDATE `products` SET `name` = namev, `description` = descriptionv, `activation` = activationv,  `price` = pricev, `add_date` = add_datev, `users_id` = users_idv, `categories_id` =categories_idv ,`period`=periodv WHERE `products`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `products_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `products_update` (IN `idv` INT, IN `categories_idv` INT, IN `users_idv` INT, IN `namev` VARCHAR(45), IN `descriptionv` TEXT, IN `activationv` BOOLEAN, IN `pricev` FLOAT, IN `add_datev` DATE, IN `periodv` INT, IN `id_imagef` INT, IN `imagef` VARCHAR(255), IN `id_imageb` INT, IN `imageb` VARCHAR(255), IN `id_imager` INT, IN `imager` VARCHAR(255), IN `id_imagel` INT, IN `imagel` VARCHAR(255))  NO SQL
BEGIN

START TRANSACTION; 
call 	products_info_update( idv,users_idv, categories_idv, namev ,descriptionv,activationv,pricev, add_datev,periodv);

if id_imagef !=0 and imagef!='no' then
 call images_update(id_imagef,imagef,idv);
ELSEif id_imagef =0 and imagef!='no' then
 call images_add(imagef,idv);
END IF;

if  id_imageb !=0 and imageb!='no' then
call images_update(id_imageb,imageb,idv);
 ELSEif  id_imageb =0 and imageb!='no' then
 call images_add(imageb,idv);
END IF;

if  id_imager !=0 and imager!='no' then
call images_update(id_imager,imager,idv);
 ELSEif id_imager =0 and imager!='no' then
 call images_add(imager,idv);
END IF;

if  id_imagel !=0 and imagel!='no' then
call images_update(id_imagel,imagel,idv); 
 ELSEif  id_imagel =0 and imagel!='no' then 
 call images_add(imagel,idv);
END IF; 

commit;
END$$

DROP PROCEDURE IF EXISTS `properties_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `properties_add` (IN `namev` VARCHAR(45), IN `valuev` VARCHAR(45), IN `typev` TINYINT(1), IN `newv` BOOLEAN)  NO SQL
BEGIN
INSERT INTO `properties` ( `name`, `value`, `type`, `new`) VALUES (namev,valuev,typev,newv);
END$$

DROP PROCEDURE IF EXISTS `properties_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `properties_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `properties` WHERE `properties`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `properties_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `properties_update` (IN `idv` INT, IN `namev` VARCHAR(45), IN `valuev` VARCHAR(45), IN `typev` TINYINT(1), IN `newv` BOOLEAN)  NO SQL
BEGIN
UPDATE `properties` SET `name` =namev, `value` = valuev, `type` = typev, `new` =newv WHERE `properties`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `used_properties_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `used_properties_add` (IN `properties_idv` INT, IN `defaultv` INT, IN `users_idv` INT)  NO SQL
BEGIN

DECLARE productId int ;
START TRANSACTION;
SELECT id into productId
from products
WHERE users_id = users_idv
order by id DESC
LIMIT 1;
INSERT INTO `used_properties` ( `properties_id`, `products_id`, `default`) VALUES (properties_idv, productId,defaultv);
COMMIT;

END$$

DROP PROCEDURE IF EXISTS `used_properties_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `used_properties_delete` (IN `properties_idv` INT, IN `products_idv` INT)  NO SQL
BEGIN
DELETE FROM `used_properties` WHERE `used_properties`.`products_id` =products_idv and`used_properties`.`properties_id`=properties_idv;
END$$

DROP PROCEDURE IF EXISTS `used_properties_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `used_properties_update` (IN `properties_idv` INT, IN `products_idv` INT, IN `defaultv` TINYINT(1))  NO SQL
BEGIN

UPDATE `used_properties` SET `properties_id`=properties_idv,`products_id`=products_idv,`default`=defaultv WHERE   `used_properties`.`properties_id` =properties_idv AND `used_properties`.`products_id`=products_idv ;END$$

DROP PROCEDURE IF EXISTS `users_add`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `users_add` (IN `first_namev` VARCHAR(45), IN `last_namev` VARCHAR(45), IN `emailv` VARCHAR(255), IN `imagev` VARCHAR(255), IN `passwordv` TEXT, IN `rolev` BOOLEAN, IN `activationv` BOOLEAN, IN `add_datev` DATE, IN `phonev` VARCHAR(9))  NO SQL
BEGIN
INSERT INTO users (first_name,last_name,email,image_name,password,role,activation,add_date,phone) VALUES (first_namev,last_namev,emailv,imagev,passwordv,rolev,activationv,add_datev,phonev);
END$$

DROP PROCEDURE IF EXISTS `users_delete`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `users_delete` (IN `idv` INT)  NO SQL
BEGIN
DELETE FROM `users` WHERE `users`.`id` = idv;
END$$

DROP PROCEDURE IF EXISTS `users_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `users_update` (IN `idv` INT, IN `first_namev` VARCHAR(45), IN `last_namev` VARCHAR(45), IN `emailv` VARCHAR(255), IN `iamge_namv` VARCHAR(255), IN `passwordv` TEXT, IN `rolev` BOOLEAN, IN `add_datev` DATE, IN `activationv` BOOLEAN, IN `phonev` VARCHAR(9))  NO SQL
BEGIN
UPDATE `users` SET `first_name` = first_namev, `last_name` = last_namev, `email` = emailv, `image_name` = iamge_namv, `password` = passwordv,  `role` = rolev, `add_date` = add_datev, `activation` = activationv ,`phone` = phonev WHERE `users`.`id` = idv;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `phone` varchar(9) NOT NULL,
  `type` tinyint(1) DEFAULT '1',
  `location_map` text,
  `locations_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_addresses_locations1_idx` (`locations_id`),
  KEY `fk_addresses_users1_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `first_name`, `last_name`, `phone`, `type`, `location_map`, `locations_id`, `users_id`, `description`) VALUES
(1, 'محمد', 'علي', '712712777', 3, 'hh', 15, 43, 'جوار مصنع شملان'),
(2, 'محمد', 'علي', '776779770', 3, 'hh', 15, 47, 'جوار مصنع شملان');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) NOT NULL,
  `products_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `image_name` (`image_name`),
  KEY `fk_images_products1_idx` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=360 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image_name`, `products_id`) VALUES
(358, '1.jpg', 158),
(359, '2.jpg', 159);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_locations_locations1_idx` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `level`, `parent`) VALUES
(1, 'اليمن', 1, NULL),
(11, 'صنعاء', 2, 1),
(12, 'الستين', 3, 11),
(13, 'هايل', 3, 11),
(14, 'مذبح', 3, 11),
(15, 'شملان', 3, 11),
(16, 'حدة', 3, 11),
(17, 'تعز', 2, 1),
(18, 'سعوان', 3, 11);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(45) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_users1_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `users_id`) VALUES
(1, ' ggg hhhh j', 43);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `content` text NOT NULL,
  `seen` tinyint(4) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `add_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notifications_users2_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `url`, `content`, `seen`, `users_id`, `add_date`) VALUES
(1, '../saller_cp/cp_order.php', 'وصل اليك طلب ( نظام التاجر)   ', 1, 43, '2021-03-04'),
(2, '../saller_cp/cp_order.php', 'وصل اليك طلب ( نظام الصراف)   ', 1, 43, '2021-03-04'),
(3, '../saller_cp/cp_order.php', 'وصل اليك طلب ( نظام الصراف)   ', 0, 43, '2021-03-07'),
(4, '../saller_cp/cp_order.php', 'وصل اليك طلب ( نظام الصراف)   ', 0, 43, '2021-03-07'),
(5, '../saller_cp/cp_order.php', 'وصل اليك طلب ( نظام التاجر)   ', 0, 43, '2021-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `new_price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `products_id` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `products_id`, `start_date`, `end_date`, `new_price`) VALUES
(33, 158, '2020-01-01', '2021-03-31', 1500),
(34, 159, '2021-03-06', '2021-03-25', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `add_date` date NOT NULL,
  `date_deliver` date DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '1',
  `sale_date` date DEFAULT NULL,
  `addresses_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_has_products_products2_idx` (`products_id`),
  KEY `fk_users_has_products_users1_idx` (`users_id`),
  KEY `address_isfk` (`addresses_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='				QQQQQQQQQQQQQQQQQQQQQQQQQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAXQXQXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXQXXXXXXXXXXQXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX	aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa																																																																								a	aaaaaaaaaaaaaaaaaaaaaaaaaaaaa																																																																																																																																																																																																																																																																																																																																																																																									qaAAAAAAAA';

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `users_id`, `products_id`, `add_date`, `date_deliver`, `role`, `sale_date`, `addresses_id`) VALUES
(1, 43, 158, '2021-03-04', '2021-03-04', 1, '2021-03-04', 1),
(2, 43, 158, '2021-03-04', '2021-03-04', 1, '2021-03-04', 1),
(3, 43, 159, '2021-03-04', '2021-03-04', 1, '2021-03-04', 1),
(4, 47, 159, '2021-03-07', '2021-03-07', 1, '2021-03-07', 2),
(5, 47, 159, '2021-03-07', '2021-03-07', 1, '2021-03-07', 2),
(6, 43, 158, '2021-03-07', '2021-03-07', 1, '2021-03-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` text,
  `activation` tinyint(4) DEFAULT NULL,
  `price` float NOT NULL,
  `add_date` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_products_users1_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `users_id`, `name`, `description`, `activation`, `price`, `add_date`) VALUES
(158, 43, 'نظام التاجر', 'وصف النظام\r\nنظام الدوت إكس برو المتقدم عبارة عن نظام محاسبي ومخزني متكامل – يلبي كافة متطلبات الأسواق التجارية والشركات ومحلات والسوبر والهايبر ماركت بمختلف طبيعة عملها، ويتميز النظام بتسهيل عمل مالكي المنشئات التجارية الكبيرة من خلال دعم النظام لإدارة بيانات الشركات والفروع المختلفة بشكل مركزي، ويتميز هذا النظام بإدارته للشئون المالية من خلال توفر دليل محاسبي معد مسبقا وفق معايير محاسبية معتمدة، ودعم النظام للعمليات المالية المختلفة مثل تعدد طرق الدفع (نقد – آجل – شيك) وترحيل القيود المحاسبية والرواتب الشهرية للموظفين ودعم التعامل بعملات مالية مختلفة وكذلك دعمه الكامل لنظام ضريبة المبيعات والقوانين السائدة، ويتميز النظام كذلك بإدارته لكافة العمليات التي تتم على الأصناف وحركة البيع والشراء من خلال تهيئة الأصناف بمختلف وحدات القياس، كما يدعم النظام تصميم وطباعة الباركود الخاص بالأصناف.\r\nويتميز النظام بإحتوائه على نظام صلاحيات واسع ودقيق يمكن منحها لمستخدمي النظام على مستوى النافذة أو العملية (إضافة – تعديل – حذف) وعلى مستوى الحقل الواحد، ويقوم النظام بعرض تقارير مالية وإدارية ومخزنية متنوعة تساعد مالكي المنشئات التجارية في إتخاذ القرارات المناسبة.\r\n\r\n \r\n\r\nمزايا النظام\r\n 1-يتميز النظام بتعدد اللغات (عربي ـ انجليزي).\r\n2-تم بناء النظام وفق معايير نظام الجرد المستمر.\r\n3-تقنية بحث رائعة للبحث عن معلومات الصنف كاملة من أي مكان في النظام مع اتاحة القيام بعمليات معينة على معلومات الصنف مباشرة.\r\n4-تخصيص المفاتيح الساخنة للتنقل السريع بين مكونات النظام.\r\n5-النسخ الاحتياطي التلقائي لقاعدة البيانات.\r\n6-الأرشفة الإلكترونية للمستندات والمراجع الآلية واليدوية\r\n7-يتيح نظام دوت اكس برو امكانية العمل بنظام الحساب الواحد لكل العملات كما يمكن إنشاء العديد من الصناديق والبنوك والمخازن. وكذلك استعلام الحساب لعدة عملات .\r\n8-يتميز النظام بإعطاء الحرية للمستخدم في ترحيل العمليات المحاسبية سواء (آلياً او يدوياً ) من خلال التحكم في الإعدادات التي يوفرها النظام. مما يعطي للمستخدم سهولة الترحيل و استخراج التقرير.\r\n9-يتميز بنظام بحثي متطور في كل نوافذ النظام ليستطيع البحث عن أي معلومة داخل النظام بدقة عالية وسرعة في إظهار النتائج.\r\n10-يدعم النظام تعدد الشركات، تعدد الفروع، تعدد العملات، تعدد المخازن وتعدد المستخدمين، وكذا تعدد وحدات قياس الصنف.', 1, 2000, '2020-01-01'),
(159, 43, 'نظام الصراف', 'وصف النظام\r\nنظام الدوت إكس برو المتقدم عبارة عن نظام محاسبي ومخزني متكامل – يلبي كافة متطلبات الأسواق التجارية والشركات ومحلات والسوبر والهايبر ماركت بمختلف طبيعة عملها، ويتميز النظام بتسهيل عمل مالكي المنشئات التجارية الكبيرة من خلال دعم النظام لإدارة بيانات الشركات والفروع المختلفة بشكل مركزي، ويتميز هذا النظام بإدارته للشئون المالية من خلال توفر دليل محاسبي معد مسبقا وفق معايير محاسبية معتمدة، ودعم النظام للعمليات المالية المختلفة مثل تعدد طرق الدفع (نقد – آجل – شيك) وترحيل القيود المحاسبية والرواتب الشهرية للموظفين ودعم التعامل بعملات مالية مختلفة وكذلك دعمه الكامل لنظام ضريبة المبيعات والقوانين السائدة، ويتميز النظام كذلك بإدارته لكافة العمليات التي تتم على الأصناف وحركة البيع والشراء من خلال تهيئة الأصناف بمختلف وحدات القياس، كما يدعم النظام تصميم وطباعة الباركود الخاص بالأصناف.\r\nويتميز النظام بإحتوائه على نظام صلاحيات واسع ودقيق يمكن منحها لمستخدمي النظام على مستوى النافذة أو العملية (إضافة – تعديل – حذف) وعلى مستوى الحقل الواحد، ويقوم النظام بعرض تقارير مالية وإدارية ومخزنية متنوعة تساعد مالكي المنشئات التجارية في إتخاذ القرارات المناسبة.\r\n\r\n \r\n\r\nمزايا النظام\r\n 1-يتميز النظام بتعدد اللغات (عربي ـ انجليزي).\r\n2-تم بناء النظام وفق معايير نظام الجرد المستمر.\r\n3-تقنية بحث رائعة للبحث عن معلومات الصنف كاملة من أي مكان في النظام مع اتاحة القيام بعمليات معينة على معلومات الصنف مباشرة.\r\n4-تخصيص المفاتيح الساخنة للتنقل السريع بين مكونات النظام.\r\n5-النسخ الاحتياطي التلقائي لقاعدة البيانات.\r\n6-الأرشفة الإلكترونية للمستندات والمراجع الآلية واليدوية\r\n7-يتيح نظام دوت اكس برو امكانية العمل بنظام الحساب الواحد لكل العملات كما يمكن إنشاء العديد من الصناديق والبنوك والمخازن. وكذلك استعلام الحساب لعدة عملات .\r\n8-يتميز النظام بإعطاء الحرية للمستخدم في ترحيل العمليات المحاسبية سواء (آلياً او يدوياً ) من خلال التحكم في الإعدادات التي يوفرها النظام. مما يعطي للمستخدم سهولة الترحيل و استخراج التقرير.\r\n9-يتميز بنظام بحثي متطور في كل نوافذ النظام ليستطيع البحث عن أي معلومة داخل النظام بدقة عالية وسرعة في إظهار النتائج.\r\n10-يدعم النظام تعدد الشركات، تعدد الفروع، تعدد العملات، تعدد المخازن وتعدد المستخدمين، وكذا تعدد وحدات قياس الصنف.', 1, 3000, '2021-03-04');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acounts` int(11) NOT NULL DEFAULT '0',
  `slides` int(11) NOT NULL DEFAULT '0',
  `users` int(11) NOT NULL DEFAULT '0',
  `products` int(11) DEFAULT '0',
  `offers` int(11) NOT NULL DEFAULT '0',
  `addresses` int(11) DEFAULT '0',
  `orders` int(11) NOT NULL DEFAULT '0',
  `locations` int(11) NOT NULL DEFAULT '0',
  `messages` int(11) NOT NULL DEFAULT '0',
  `granted_roles` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `acounts`, `slides`, `users`, `products`, `offers`, `addresses`, `orders`, `locations`, `messages`, `granted_roles`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0),
(4, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`) VALUES
(1, '1.jpg'),
(2, '2.jpg'),
(3, '3.jpg '),
(4, '4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT 'profile',
  `password` text NOT NULL,
  `reset` varchar(10) DEFAULT NULL,
  `role` tinyint(1) NOT NULL,
  `activation` tinyint(4) DEFAULT '0',
  `add_date` date DEFAULT NULL,
  `phone` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `phone_UNIQUE` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `image_name`, `password`, `reset`, `role`, `activation`, `add_date`, `phone`) VALUES
(43, 'امل', 'علي', 's@gmail.com', 'profile', '$2y$10$qg0xhiO8ZssUWzfiObNX5eGi9gXSwcKUtmGNvijXaF8Bb6C.1N5pW', NULL, 4, 1, '2021-03-03', '712715167'),
(44, 'سبأ', 'فضل', 'saba@gmail.com', 'profile', '$2y$10$zYYc2S0n5oIe0i4LNJwHc.EZl6W8x2T/MLCLIEqbE8h8equEw3/.K', NULL, 1, 1, '2020-01-03', '771771771'),
(45, 'لؤي', 'المغولي', 'l@gmail.com', '8247c31a11f10255cfc4fbd2ef3b5f36.jpg', '$2y$10$wZf1wt.bHz6lqXh32tkc7.miAQc58su0DlZuVqW7v4yk.oEHOF3t.', NULL, 3, 0, '2121-03-05', '776776778'),
(46, 'رسلان', 'الوصابي', 'user@gmail.com', 'profile', '$2y$10$.xwMsXMMTFmvdepasrQUk.yF9HEUIAOH7HHtk3R7F8AiiEL39V2u2', NULL, 2, 1, '2121-03-05', '776773773'),
(47, 'ريم', 'علي', 'r@gmail.com', 'profile', '$2y$10$RmfwyjXLm6aDr5uOOnF7Z.6n4ZFHQfTFbzs9e/wORGqFFdKfeHC5.', NULL, 3, 1, '2121-03-07', '712712713');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_addresses_locations1` FOREIGN KEY (`locations_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_addresses_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_images_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `fk_locations_locations1` FOREIGN KEY (`parent`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_users2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_users_has_products_products2` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_has_products_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`addresses_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
