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
