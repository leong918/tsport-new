-- Matches Table Backup - 2025-10-08 13:34:23

-- Truncate table first
TRUNCATE TABLE `match`;

-- Insert matches data
INSERT INTO `match` (`id`, `match_title`, `short_content`, `banner`, `status`, `is_top`, `start_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '南安普顿 vs 莱斯特城', '英超联赛 2024/25 第23轮', 'match/nQiDiynRw90ahkMuCBCIBdXfqeHKFjEEQVGVNxuV.png', 1, 0, '2024-12-15 15:30:00', '2025-10-08 20:45:00', '2025-10-08 20:55:07', NULL),
(2, '切尔西 vs 阿森纳', '英超联赛 2024/25 第23轮', 'match/5Vi3ogm0d6RKVtLAKVAUPj2bR9k1WoBEcGSMNu6c.png', 1, 0, '2024-12-15 17:30:00', '2025-10-08 20:45:00', '2025-10-08 20:55:42', NULL),
(3, '利物浦 vs 曼城', '英超联赛 2024/25 第23轮', 'match/taO1hJTxEZV0D5jxmYyFL6XqcP7KXLlPEJ4W3qwg.png', 1, 0, '2024-12-15 20:00:00', '2025-10-08 20:45:00', '2025-10-08 20:55:50', NULL),
(4, '热刺 vs 西汉姆', '英超联赛 2024/25 第23轮', 'match/E3mEwyBh9DxJ1gfxDUhED70eIXL46mxEbpzlzvMc.png', 1, 0, '2024-12-16 15:30:00', '2025-10-08 20:45:00', '2025-10-08 20:55:58', NULL),
(5, '狼队 vs 阿斯顿维拉', '英超联赛 2024/25 第24轮', 'match/QZTy83kKOMIFWXa8fUC3WRCkDeMsWHlxKzwMkyQi.png', 1, 0, '2024-12-22 15:30:00', '2025-10-08 20:45:00', '2025-10-08 20:56:06', NULL),
(6, '纽卡 vs 水晶宫', '英超联赛 2024/25 第24轮', 'match/kaNr77AvSrpmqsIc43M4bTImXrV0G1gfGathr93D.png', 1, 0, '2024-12-22 17:30:00', '2025-10-08 20:45:00', '2025-10-08 20:56:12', NULL),
(7, '曼市 vs 曼联', '英超联赛 2024/25 第22轮', 'match/ahPA6IXnjc2i38d2gBghXXbOyLoYfsbLX5tGU3PZ.png', 1, 1, '2025-05-01 15:58:56', '2025-10-09 15:59:09', '2025-10-09 15:59:19', NULL),
(8, '曼市 vs 曼联', '英超联赛 2024/25 第22轮', 'match/ahPA6IXnjc2i38d2gBghXXbOyLoYfsbLX5tGU3PZ.png', 1, 1, '2025-05-01 15:58:56', '2025-10-09 15:59:09', '2025-10-09 15:59:19', NULL),
(9, '曼市 vs 曼联', '英超联赛 2024/25 第22轮', 'match/ahPA6IXnjc2i38d2gBghXXbOyLoYfsbLX5tGU3PZ.png', 1, 1, '2025-05-01 15:58:56', '2025-10-09 15:59:09', '2025-10-09 15:59:19', NULL);

-- Reset auto increment
ALTER TABLE `match` AUTO_INCREMENT = 10;
