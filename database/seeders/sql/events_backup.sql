-- Events Table Backup - 2025-10-08 20:23:28

-- Truncate table first
TRUNCATE TABLE `events`;

-- Table data with proper column specification
INSERT INTO `events` (`id`, `title`, `image`, `status`, `start_time`, `end_time`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '世界杯预选赛开波', 'events/h0OMAUKSg3aBYq1cwpQbxSHSUZbNc09qLROibbR3.png', 'active', '2025-10-08 19:09:00', '2026-01-29 13:09:00', 1, '2025-10-08 19:21:56', '2025-10-08 19:30:10', NULL),
(2, '波神来啦 - 季节赛', 'events/dm09jeT78LO6IVwtRF4qcGiJ4TPFCWVDtjIdTpRC.png', 'active', '2025-10-08 19:30:00', '2026-07-31 13:30:00', 1, '2025-10-08 19:31:03', '2025-10-08 19:31:03', NULL),
(3, '猜积分 赢奖品', 'events/Gb3j4PjvZwoXcW0crcJcOK9eSvuM8SNx03cnBLpS.png', 'active', '2025-10-08 19:32:00', '2027-03-18 13:32:00', 1, '2025-10-08 19:32:30', '2025-10-08 19:32:30', NULL);

-- Reset auto increment
ALTER TABLE events AUTO_INCREMENT = 4;
