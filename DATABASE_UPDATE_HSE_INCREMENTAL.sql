-- HSE Manager - Incremental Safety Module Update
-- MySQL 8 / MariaDB 10.4+
-- این فایل داده‌های فعلی را حذف نمی‌کند و باید بعد از بکاپ روی دیتابیس فعلی Import شود.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DELIMITER $$
DROP PROCEDURE IF EXISTS hse_add_column$$
CREATE PROCEDURE hse_add_column(IN p_table VARCHAR(64), IN p_column VARCHAR(64), IN p_definition TEXT)
BEGIN
 IF NOT EXISTS(SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=p_table AND COLUMN_NAME=p_column) THEN
  SET @sql=CONCAT('ALTER TABLE `',p_table,'` ADD COLUMN `',p_column,'` ',p_definition);
  PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
 END IF;
END$$
DROP PROCEDURE IF EXISTS hse_add_index$$
CREATE PROCEDURE hse_add_index(IN p_table VARCHAR(64), IN p_index VARCHAR(64), IN p_columns VARCHAR(255))
BEGIN
 IF NOT EXISTS(SELECT 1 FROM information_schema.STATISTICS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=p_table AND INDEX_NAME=p_index) THEN
  SET @sql=CONCAT('ALTER TABLE `',p_table,'` ADD INDEX `',p_index,'` (',p_columns,')');
  PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
 END IF;
END$$
DROP PROCEDURE IF EXISTS hse_add_fk$$
CREATE PROCEDURE hse_add_fk(IN p_table VARCHAR(64), IN p_name VARCHAR(64), IN p_sql TEXT)
BEGIN
 IF NOT EXISTS(SELECT 1 FROM information_schema.TABLE_CONSTRAINTS WHERE CONSTRAINT_SCHEMA=DATABASE() AND TABLE_NAME=p_table AND CONSTRAINT_NAME=p_name) THEN
  SET @sql=CONCAT('ALTER TABLE `',p_table,'` ADD CONSTRAINT `',p_name,'` ',p_sql);
  PREPARE stmt FROM @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt;
 END IF;
END$$
DELIMITER ;

CALL hse_add_column('risks','owner_id','BIGINT UNSIGNED NULL AFTER `identified_by`');
CALL hse_add_column('risks','assessment_method','VARCHAR(30) NOT NULL DEFAULT ''matrix'' AFTER `owner_id`');
CALL hse_add_column('risks','residual_likelihood','TINYINT UNSIGNED NULL AFTER `risk_level`');
CALL hse_add_column('risks','residual_severity','TINYINT UNSIGNED NULL AFTER `residual_likelihood`');
CALL hse_add_column('risks','residual_score','SMALLINT UNSIGNED NULL AFTER `residual_severity`');
CALL hse_add_column('risks','residual_level','VARCHAR(30) NULL AFTER `residual_score`');
CALL hse_add_column('risks','review_due_at','DATE NULL AFTER `proposed_controls`');
CALL hse_add_index('risks','risks_method_status_index','`assessment_method`,`status`');
CALL hse_add_index('risks','risks_review_due_index','`review_due_at`');
CALL hse_add_index('risks','risks_owner_index','`owner_id`');
CALL hse_add_fk('risks','risks_owner_fk','FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL');

CALL hse_add_column('incidents','activity','VARCHAR(500) NULL AFTER `location`');
CALL hse_add_column('incidents','involved_people','JSON NULL AFTER `activity`');
CALL hse_add_column('incidents','consequences','TEXT NULL AFTER `involved_people`');
CALL hse_add_column('incidents','rca_method','VARCHAR(30) NULL AFTER `root_cause`');
CALL hse_add_column('incidents','five_whys','JSON NULL AFTER `rca_method`');
CALL hse_add_column('incidents','fishbone','JSON NULL AFTER `five_whys`');
CALL hse_add_column('incidents','fault_tree','JSON NULL AFTER `fishbone`');
CALL hse_add_index('incidents','incidents_rca_status_index','`rca_method`,`status`');

CALL hse_add_column('inspection_responses','is_nonconformity','TINYINT(1) NOT NULL DEFAULT 0 AFTER `evidence_path`');
CALL hse_add_column('inspection_responses','corrective_action_id','BIGINT UNSIGNED NULL AFTER `is_nonconformity`');
CALL hse_add_column('inspection_responses','risk_id','BIGINT UNSIGNED NULL AFTER `corrective_action_id`');
CALL hse_add_index('inspection_responses','inspection_responses_nc_index','`inspection_id`,`is_nonconformity`');
CALL hse_add_fk('inspection_responses','inspection_responses_action_fk','FOREIGN KEY (`corrective_action_id`) REFERENCES `corrective_actions` (`id`) ON DELETE SET NULL');
CALL hse_add_fk('inspection_responses','inspection_responses_risk_fk','FOREIGN KEY (`risk_id`) REFERENCES `risks` (`id`) ON DELETE SET NULL');

CALL hse_add_column('corrective_actions','reminder_days','TINYINT UNSIGNED NOT NULL DEFAULT 7 AFTER `due_date`');
CALL hse_add_column('corrective_actions','started_at','TIMESTAMP NULL AFTER `result`');
CALL hse_add_column('corrective_actions','closed_at','TIMESTAMP NULL AFTER `verified_at`');
CALL hse_add_column('corrective_actions','effectiveness_note','TEXT NULL AFTER `closed_at`');
CALL hse_add_index('corrective_actions','capa_due_status_assignee_index','`due_date`,`status`,`assignee_id`');

CREATE TABLE IF NOT EXISTS `job_safety_analyses` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `risk_id` BIGINT UNSIGNED NOT NULL,
 `activity` VARCHAR(190) NOT NULL, `location` VARCHAR(190) NULL, `department_id` BIGINT UNSIGNED NOT NULL,
 `owner_id` BIGINT UNSIGNED NOT NULL, `review_due_at` DATE NULL, `status` VARCHAR(30) NOT NULL DEFAULT 'active',
 `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL, PRIMARY KEY (`id`), UNIQUE KEY `jsa_risk_unique` (`risk_id`),
 KEY `jsa_department_status_index` (`department_id`,`status`), KEY `jsa_owner_review_index` (`owner_id`,`review_due_at`),
 CONSTRAINT `jsa_risk_fk` FOREIGN KEY (`risk_id`) REFERENCES `risks` (`id`) ON DELETE CASCADE,
 CONSTRAINT `jsa_department_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
 CONSTRAINT `jsa_owner_fk` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `jsa_steps` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `jsa_id` BIGINT UNSIGNED NOT NULL, `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
 `step` TEXT NOT NULL, `hazard` TEXT NOT NULL, `consequence` TEXT NOT NULL, `controls` TEXT NULL,
 `likelihood` TINYINT UNSIGNED NOT NULL, `severity` TINYINT UNSIGNED NOT NULL, `risk_score` SMALLINT UNSIGNED NOT NULL,
 `residual_likelihood` TINYINT UNSIGNED NOT NULL, `residual_severity` TINYINT UNSIGNED NOT NULL, `residual_score` SMALLINT UNSIGNED NOT NULL,
 `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL, PRIMARY KEY (`id`), KEY `jsa_steps_order_index` (`jsa_id`,`sort_order`),
 CONSTRAINT `jsa_steps_analysis_fk` FOREIGN KEY (`jsa_id`) REFERENCES `job_safety_analyses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `fmea_analyses` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `risk_id` BIGINT UNSIGNED NOT NULL, `process` VARCHAR(190) NOT NULL,
 `function` TEXT NOT NULL, `department_id` BIGINT UNSIGNED NOT NULL, `owner_id` BIGINT UNSIGNED NOT NULL,
 `review_due_at` DATE NULL, `status` VARCHAR(30) NOT NULL DEFAULT 'active', `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL,
 PRIMARY KEY (`id`), UNIQUE KEY `fmea_risk_unique` (`risk_id`), KEY `fmea_department_status_index` (`department_id`,`status`),
 CONSTRAINT `fmea_risk_fk` FOREIGN KEY (`risk_id`) REFERENCES `risks` (`id`) ON DELETE CASCADE,
 CONSTRAINT `fmea_department_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
 CONSTRAINT `fmea_owner_fk` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `fmea_items` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `fmea_id` BIGINT UNSIGNED NOT NULL, `sort_order` INT UNSIGNED NOT NULL DEFAULT 0,
 `failure_mode` TEXT NOT NULL, `effect` TEXT NOT NULL, `cause` TEXT NOT NULL, `existing_control` TEXT NULL,
 `severity` TINYINT UNSIGNED NOT NULL, `occurrence` TINYINT UNSIGNED NOT NULL, `detection` TINYINT UNSIGNED NOT NULL,
 `rpn` SMALLINT UNSIGNED NOT NULL, `recommended_action` TEXT NULL, `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL,
 PRIMARY KEY (`id`), KEY `fmea_items_rpn_index` (`fmea_id`,`rpn`), CONSTRAINT `fmea_items_analysis_fk` FOREIGN KEY (`fmea_id`) REFERENCES `fmea_analyses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `hse_notifications` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `notification_key` VARCHAR(190) NOT NULL, `user_id` BIGINT UNSIGNED NOT NULL,
 `type` VARCHAR(30) NOT NULL, `title` VARCHAR(190) NOT NULL, `message` TEXT NOT NULL, `notifiable_type` VARCHAR(190) NULL,
 `notifiable_id` BIGINT UNSIGNED NULL, `due_at` TIMESTAMP NULL, `read_at` TIMESTAMP NULL, `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL,
 PRIMARY KEY (`id`), UNIQUE KEY `hse_notifications_key_unique` (`notification_key`), KEY `hse_notifications_user_read_index` (`user_id`,`read_at`),
 KEY `hse_notifications_notifiable_index` (`notifiable_type`,`notifiable_id`), CONSTRAINT `hse_notifications_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `ppe_types` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `name` VARCHAR(190) NOT NULL, `category` VARCHAR(100) NOT NULL,
 `standard` VARCHAR(190) NULL, `replacement_days` INT UNSIGNED NOT NULL DEFAULT 365, `is_active` TINYINT(1) NOT NULL DEFAULT 1,
 `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL, PRIMARY KEY (`id`), UNIQUE KEY `ppe_types_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `ppe_requirements` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `department_id` BIGINT UNSIGNED NOT NULL, `job_title` VARCHAR(190) NOT NULL,
 `ppe_type_id` BIGINT UNSIGNED NOT NULL, `quantity` SMALLINT UNSIGNED NOT NULL DEFAULT 1, `notes` TEXT NULL,
 `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL, PRIMARY KEY (`id`), UNIQUE KEY `ppe_requirement_unique` (`department_id`,`job_title`,`ppe_type_id`),
 CONSTRAINT `ppe_requirements_department_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
 CONSTRAINT `ppe_requirements_type_fk` FOREIGN KEY (`ppe_type_id`) REFERENCES `ppe_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `ppe_issues` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `user_id` BIGINT UNSIGNED NOT NULL, `ppe_type_id` BIGINT UNSIGNED NOT NULL,
 `quantity` SMALLINT UNSIGNED NOT NULL DEFAULT 1, `issued_at` DATE NOT NULL, `expires_at` DATE NULL, `returned_at` DATE NULL,
 `condition` VARCHAR(30) NOT NULL, `status` VARCHAR(30) NOT NULL DEFAULT 'issued', `issued_by` BIGINT UNSIGNED NOT NULL, `notes` TEXT NULL,
 `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL, PRIMARY KEY (`id`), KEY `ppe_issues_due_index` (`status`,`expires_at`),
 KEY `ppe_issues_user_index` (`user_id`,`issued_at`), CONSTRAINT `ppe_issues_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
 CONSTRAINT `ppe_issues_type_fk` FOREIGN KEY (`ppe_type_id`) REFERENCES `ppe_types` (`id`), CONSTRAINT `ppe_issues_issuer_fk` FOREIGN KEY (`issued_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `safety_equipments` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `code` VARCHAR(80) NOT NULL, `name` VARCHAR(190) NOT NULL, `type` VARCHAR(50) NOT NULL,
 `department_id` BIGINT UNSIGNED NOT NULL, `location` VARCHAR(190) NOT NULL, `serial_number` VARCHAR(190) NULL,
 `inspection_interval_days` INT UNSIGNED NOT NULL DEFAULT 30, `service_interval_days` INT UNSIGNED NOT NULL DEFAULT 365,
 `last_inspected_at` DATE NULL, `next_inspection_at` DATE NULL, `last_serviced_at` DATE NULL, `next_service_at` DATE NULL,
 `expiry_date` DATE NULL, `status` VARCHAR(30) NOT NULL DEFAULT 'active', `notes` TEXT NULL, `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL,
 PRIMARY KEY (`id`), UNIQUE KEY `safety_equipments_code_unique` (`code`), KEY `safety_equipment_due_index` (`status`,`next_inspection_at`,`next_service_at`),
 KEY `safety_equipment_department_index` (`department_id`,`type`), CONSTRAINT `safety_equipment_department_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `work_permits` (
 `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, `code` VARCHAR(80) NOT NULL, `title` VARCHAR(190) NOT NULL, `type` VARCHAR(50) NOT NULL,
 `department_id` BIGINT UNSIGNED NOT NULL, `requester_id` BIGINT UNSIGNED NOT NULL, `approver_id` BIGINT UNSIGNED NULL,
 `location` VARCHAR(190) NOT NULL, `description` TEXT NOT NULL, `hazards` TEXT NOT NULL, `controls` TEXT NOT NULL,
 `starts_at` TIMESTAMP NOT NULL, `ends_at` TIMESTAMP NOT NULL, `status` VARCHAR(30) NOT NULL DEFAULT 'requested',
 `closed_at` TIMESTAMP NULL, `closure_notes` TEXT NULL, `created_at` TIMESTAMP NULL, `updated_at` TIMESTAMP NULL,
 PRIMARY KEY (`id`), UNIQUE KEY `work_permits_code_unique` (`code`), KEY `work_permits_status_time_index` (`status`,`starts_at`,`ends_at`),
 KEY `work_permits_department_index` (`department_id`,`status`), CONSTRAINT `work_permits_department_fk` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
 CONSTRAINT `work_permits_requester_fk` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`), CONSTRAINT `work_permits_approver_fk` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

UPDATE `risks` SET `assessment_method`='matrix' WHERE `assessment_method` IS NULL OR `assessment_method`='';
INSERT INTO `settings` (`key`,`value`) VALUES ('action_reminder_days','7'),('risk_review_days','90') ON DUPLICATE KEY UPDATE `value`=`value`;

DROP PROCEDURE IF EXISTS hse_add_column;
DROP PROCEDURE IF EXISTS hse_add_index;
DROP PROCEDURE IF EXISTS hse_add_fk;
SET FOREIGN_KEY_CHECKS = 1;
