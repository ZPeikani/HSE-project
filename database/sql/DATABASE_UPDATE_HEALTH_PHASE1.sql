-- HSE Manager - Health Phase 1 incremental database update
-- Target: MariaDB/MySQL current project database
-- This script only adds new tables/data. It does not delete existing HSE data.

START TRANSACTION;

CREATE TABLE IF NOT EXISTS `occupational_health_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `job_title` varchar(190) NOT NULL,
  `employment_start_date` date DEFAULT NULL,
  `fitness_status` varchar(40) NOT NULL DEFAULT 'pending',
  `medical_restrictions` text DEFAULT NULL,
  `follow_up_required` tinyint(1) NOT NULL DEFAULT 0,
  `follow_up_date` date DEFAULT NULL,
  `occupational_disease_status` varchar(40) NOT NULL DEFAULT 'none',
  `notes` text DEFAULT NULL,
  `last_examination_date` date DEFAULT NULL,
  `next_examination_date` date DEFAULT NULL,
  `last_examination_type` varchar(40) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `health_profiles_user_unique` (`user_id`),
  KEY `health_profiles_fitness_idx` (`fitness_status`),
  KEY `health_profiles_next_exam_idx` (`next_examination_date`),
  KEY `health_profiles_created_by_idx` (`created_by`),
  KEY `health_profiles_updated_by_idx` (`updated_by`),
  CONSTRAINT `health_profiles_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `health_profiles_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `health_profiles_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `medical_examinations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `occupational_health_profile_id` bigint(20) UNSIGNED NOT NULL,
  `examination_type` varchar(40) NOT NULL,
  `examination_date` date NOT NULL,
  `health_center` varchar(190) DEFAULT NULL,
  `physician` varchar(190) DEFAULT NULL,
  `result` text DEFAULT NULL,
  `fitness_status` varchar(40) NOT NULL DEFAULT 'pending',
  `restrictions` text DEFAULT NULL,
  `follow_up_required` tinyint(1) NOT NULL DEFAULT 0,
  `follow_up_date` date DEFAULT NULL,
  `next_examination_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `attachment_path` varchar(500) DEFAULT NULL,
  `attachment_name` varchar(255) DEFAULT NULL,
  `data_source` varchar(40) NOT NULL DEFAULT 'manual',
  `external_id` varchar(190) DEFAULT NULL,
  `last_synced_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_exam_profile_idx` (`occupational_health_profile_id`),
  KEY `medical_exam_date_idx` (`examination_date`),
  KEY `medical_exam_next_date_idx` (`next_examination_date`),
  KEY `medical_exam_fitness_idx` (`fitness_status`),
  KEY `medical_exam_source_external_idx` (`data_source`,`external_id`),
  KEY `medical_exam_created_by_idx` (`created_by`),
  KEY `medical_exam_updated_by_idx` (`updated_by`),
  CONSTRAINT `medical_exam_profile_fk` FOREIGN KEY (`occupational_health_profile_id`) REFERENCES `occupational_health_profiles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `medical_exam_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `medical_exam_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Demo-ready sample records, only if the matching employee does not already have a profile.
INSERT INTO `occupational_health_profiles`
(`user_id`,`job_title`,`employment_start_date`,`fitness_status`,`medical_restrictions`,`follow_up_required`,`follow_up_date`,`occupational_disease_status`,`notes`,`last_examination_date`,`next_examination_date`,`last_examination_type`,`created_by`,`updated_by`,`created_at`,`updated_at`)
SELECT 3,'سرپرست تولید','2022-03-21','fit',NULL,0,NULL,'none','داده نمایشی فاز سلامت','2026-09-20','2027-09-20','periodic',1,1,NOW(),NOW()
WHERE EXISTS (SELECT 1 FROM `users` WHERE `id`=3)
  AND NOT EXISTS (SELECT 1 FROM `occupational_health_profiles` WHERE `user_id`=3);

INSERT INTO `occupational_health_profiles`
(`user_id`,`job_title`,`employment_start_date`,`fitness_status`,`medical_restrictions`,`follow_up_required`,`follow_up_date`,`occupational_disease_status`,`notes`,`last_examination_date`,`next_examination_date`,`last_examination_type`,`created_by`,`updated_by`,`created_at`,`updated_at`)
SELECT 2,'مسئول HSE','2021-06-01','fit_with_restrictions','محدودیت نمایشی: رعایت توصیه ارگونومی در کار طولانی با رایانه.',1,'2026-10-12','none','داده نمایشی؛ فاقد اطلاعات پزشکی واقعی','2026-10-01','2026-10-20','periodic',1,1,NOW(),NOW()
WHERE EXISTS (SELECT 1 FROM `users` WHERE `id`=2)
  AND NOT EXISTS (SELECT 1 FROM `occupational_health_profiles` WHERE `user_id`=2);

INSERT INTO `medical_examinations`
(`occupational_health_profile_id`,`examination_type`,`examination_date`,`health_center`,`physician`,`result`,`fitness_status`,`restrictions`,`follow_up_required`,`follow_up_date`,`next_examination_date`,`notes`,`data_source`,`created_by`,`updated_by`,`created_at`,`updated_at`)
SELECT p.id,'periodic','2026-09-20','مرکز طب کار نمونه','پزشک نمونه','معاینه دوره‌ای نمایشی؛ مناسب برای دمو.','fit',NULL,0,NULL,'2027-09-20','فاقد داده پزشکی واقعی','manual',1,1,NOW(),NOW()
FROM `occupational_health_profiles` p
WHERE p.user_id=3
  AND NOT EXISTS (SELECT 1 FROM `medical_examinations` m WHERE m.occupational_health_profile_id=p.id);

INSERT INTO `medical_examinations`
(`occupational_health_profile_id`,`examination_type`,`examination_date`,`health_center`,`physician`,`result`,`fitness_status`,`restrictions`,`follow_up_required`,`follow_up_date`,`next_examination_date`,`notes`,`data_source`,`created_by`,`updated_by`,`created_at`,`updated_at`)
SELECT p.id,'periodic','2026-10-01','مرکز طب کار نمونه','پزشک نمونه','نتیجه نمایشی جهت نمایش گردش کار طب کار.','fit_with_restrictions','محدودیت نمایشی: توصیه ارگونومی.',1,'2026-10-12','2026-10-20','فاقد داده پزشکی واقعی','manual',1,1,NOW(),NOW()
FROM `occupational_health_profiles` p
WHERE p.user_id=2
  AND NOT EXISTS (SELECT 1 FROM `medical_examinations` m WHERE m.occupational_health_profile_id=p.id);

COMMIT;
