SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
USE `sportisimo`;

CREATE TABLE `sp_users` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(127) NOT NULL,
    `user_email` varchar(320) NOT NULL,
    `user_password` varchar(255) NOT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

CREATE TABLE `sp_brands` (
    `brand_id` int(11) NOT NULL AUTO_INCREMENT,
    `brand_code` varchar(127) NOT NULL,
    `brand_name` varchar(511) NOT NULL,
    `brand_created` datetime NOT NULL,
    `brand_created_by` int(11) NOT NULL,
    `brand_edited` datetime DEFAULT NULL,
    `brand_edited_by` int(11) DEFAULT NULL,
    PRIMARY KEY (`brand_id`),
    KEY `brand_created_by` (`brand_created_by`),
    KEY `brand_editted_by` (`brand_edited_by`),
    CONSTRAINT `sp_brands_ibfk_1` FOREIGN KEY (`brand_created_by`) REFERENCES `sp_users` (`user_id`),
    CONSTRAINT `sp_brands_ibfk_2` FOREIGN KEY (`brand_edited_by`) REFERENCES `sp_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;