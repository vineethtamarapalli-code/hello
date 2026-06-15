-- 1. Create the database (if you haven't already)
CREATE DATABASE IF NOT EXISTS `otp_system`;
USE `otp_system`;

-- 2. Create the users_otp table
CREATE TABLE IF NOT EXISTS `users_otp` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(255) NOT NULL,
    `otp` VARCHAR(6) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
