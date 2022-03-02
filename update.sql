-- Adminer 4.8.1 MySQL 5.5.5-10.5.12-MariaDB-0+deb11u1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `bitcoin_trx`;
CREATE TABLE `bitcoin_trx` (
                               `id` int(11) NOT NULL AUTO_INCREMENT,
                               `sender` int(11) NOT NULL,
                               `recipient` int(11) NOT NULL,
                               `amount` varchar(30) NOT NULL,
                               `status` int(11) NOT NULL DEFAULT 1,
                               `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                               `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- 2022-02-19 12:24:05

CREATE TABLE `bitcoin_withdraws` (
     `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `user` int(11) unsigned NOT NULL,
     `amount` varchar(200) NOT NULL,
     `address` varchar(255) NOT NULL,
     `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 pending, 1 approved, 2 rejected, 3 cancelled',
     `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
     FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE
);

CREATE TABLE `btc_addresses` (
     `id` int(11) NOT NULL AUTO_INCREMENT,
     `user` int(11) unsigned NOT NULL,
     `label` varchar(255) NOT NULL,
     `address` varchar(255) NOT NULL,
     `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
     PRIMARY KEY (`id`),
     KEY `user` (`user`),
     CONSTRAINT `btc_addresses_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;