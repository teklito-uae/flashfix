-- =========================================
-- FlashFix Support Ticket Platform
-- Database Schema
-- =========================================

CREATE DATABASE IF NOT EXISTS `flashfix_support` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `flashfix_support`;

-- -----------------------------------------
-- Admins
-- -----------------------------------------
CREATE TABLE `admins` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password_hash` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(100) NOT NULL,
    `avatar` VARCHAR(255) DEFAULT NULL,
    `is_active` TINYINT(1) NOT NULL DEFAULT 1,
    `last_login` DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------
-- Customers
-- -----------------------------------------
CREATE TABLE `customers` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `full_name` VARCHAR(100) DEFAULT NULL,
    `phone` VARCHAR(30) DEFAULT NULL,
    `company` VARCHAR(150) DEFAULT NULL,
    `last_login` DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- -----------------------------------------
-- Login Tokens (magic links)
-- -----------------------------------------
CREATE TABLE `login_tokens` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT UNSIGNED NOT NULL,
    `token` VARCHAR(64) NOT NULL UNIQUE,
    `expires_at` DATETIME NOT NULL,
    `used` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------
-- Tickets
-- -----------------------------------------
CREATE TABLE `tickets` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `case_id` VARCHAR(20) NOT NULL UNIQUE,
    `customer_id` INT UNSIGNED NOT NULL,
    `subject` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `priority` ENUM('low','medium','high','critical') NOT NULL DEFAULT 'medium',
    `category` ENUM('IT Support','Network','Security','Cloud','Hardware','Software','Other') NOT NULL DEFAULT 'IT Support',
    `status` ENUM('open','in-progress','waiting','resolved','closed') NOT NULL DEFAULT 'open',
    `assigned_admin_id` INT UNSIGNED DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `closed_at` DATETIME DEFAULT NULL,
    FOREIGN KEY (`customer_id`) REFERENCES `customers`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`assigned_admin_id`) REFERENCES `admins`(`id`) ON DELETE SET NULL,
    INDEX `idx_status` (`status`),
    INDEX `idx_priority` (`priority`),
    INDEX `idx_customer` (`customer_id`),
    INDEX `idx_created` (`created_at`)
) ENGINE=InnoDB;

-- -----------------------------------------
-- Ticket Replies
-- -----------------------------------------
CREATE TABLE `ticket_replies` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `ticket_id` INT UNSIGNED NOT NULL,
    `sender_type` ENUM('customer','admin') NOT NULL,
    `sender_id` INT UNSIGNED NOT NULL,
    `message` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`ticket_id`) REFERENCES `tickets`(`id`) ON DELETE CASCADE,
    INDEX `idx_ticket` (`ticket_id`)
) ENGINE=InnoDB;

-- -----------------------------------------
-- Ticket Attachments
-- -----------------------------------------
CREATE TABLE `ticket_attachments` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `reply_id` INT UNSIGNED DEFAULT NULL,
    `ticket_id` INT UNSIGNED NOT NULL,
    `file_name` VARCHAR(255) NOT NULL,
    `file_path` VARCHAR(500) NOT NULL,
    `file_size` INT UNSIGNED NOT NULL DEFAULT 0,
    `mime_type` VARCHAR(100) DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`reply_id`) REFERENCES `ticket_replies`(`id`) ON DELETE SET NULL,
    FOREIGN KEY (`ticket_id`) REFERENCES `tickets`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- -----------------------------------------
-- Default Admin Account
-- Password: admin123 (change immediately after first login)
-- -----------------------------------------
INSERT INTO `admins` (`username`, `email`, `password_hash`, `full_name`) VALUES
('admin', 'admin@flashfixtechnologies.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Flash Fix Admin');
