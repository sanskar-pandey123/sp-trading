CREATE DATABASE IF NOT EXISTS `disaster_relief` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `disaster_relief`;

-- Requests table
CREATE TABLE IF NOT EXISTS `requests` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `location` VARCHAR(200) NOT NULL,
  `help_type` ENUM('Rescue','Food','Medical','Shelter','Others') NOT NULL,
  `description` TEXT NULL,
  `contact` VARCHAR(60) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Donations table
CREATE TABLE IF NOT EXISTS `donations` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(160) NOT NULL,
  `type` ENUM('Money','Food','Clothes','Medicines') NOT NULL,
  `message` TEXT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volunteers table
CREATE TABLE IF NOT EXISTS `volunteers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(120) NOT NULL,
  `email` VARCHAR(160) NOT NULL,
  `phone` VARCHAR(40) NOT NULL,
  `skills` VARCHAR(200) NULL,
  `availability` VARCHAR(120) NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



