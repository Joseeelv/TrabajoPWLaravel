-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 09, 2025 at 10:02 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DB_KEBAB`
--

-- --------------------------------------------------------

--
-- Table structure for table `ALLERGENS`
--

CREATE TABLE `ALLERGENS` (
  `allergen_id` int(11) NOT NULL,
  `allergen_name` varchar(30) NOT NULL,
  `img_src` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ALLERGENS`
--

INSERT INTO `ALLERGENS` (`allergen_id`, `allergen_name`, `img_src`) VALUES
(1, 'Gluten', 'gluten.png'),
(2, 'Crustáceos', 'crustaceos.png'),
(3, 'Huevos', 'huevo.png'),
(4, 'Pescado', 'pescado.png'),
(5, 'Cacahuetes', 'cacahuetes.png'),
(6, 'Soja', 'soja.png'),
(7, 'Lácteos', 'lacteos.png'),
(8, 'Frutos secos', 'frutos_cascara.png'),
(9, 'Apio', 'Apio.png'),
(10, 'Mostaza', 'mostaza.png'),
(11, 'Sésamo', 'sesamo.png'),
(12, 'Sulfitos', 'sulfitos.png'),
(13, 'Altramuz', 'altramuz.png'),
(14, 'Moluscos', 'moluscos.png');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_manager1|127.0.0.1', 'i:3;', 1746707793),
('laravel_cache_manager1|127.0.0.1:timer', 'i:1746707793;', 1746707793);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMERS`
--

CREATE TABLE `CUSTOMERS` (
  `user_id` int(11) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CUSTOMERS`
--

INSERT INTO `CUSTOMERS` (`user_id`, `customer_address`, `points`) VALUES
(2, 'Avenida Real 456, Ciudad B', 100),
(4, 'Casajose', 0);

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMERS_OFFERS`
--

CREATE TABLE `CUSTOMERS_OFFERS` (
  `user_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `activation_date` date NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `INGREDIENTS`
--

CREATE TABLE `INGREDIENTS` (
  `ingredient_id` int(11) NOT NULL,
  `ingredient_name` varchar(30) NOT NULL,
  `cost` decimal(5,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `img_src` varchar(255) DEFAULT NULL,
  `vegan` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `INGREDIENTS`
--

INSERT INTO `INGREDIENTS` (`ingredient_id`, `ingredient_name`, `cost`, `stock`, `img_src`, `vegan`) VALUES
(1, 'Pan de pita', 0.50, 100, 'pan_de_pita.png', 1),
(2, 'Tortillas', 0.50, 100, 'tortillas.png', 1),
(3, 'Base de lahmacun', 0.50, 100, 'base_de_lahmacun.png', 1),
(4, 'Carne de pollo', 2.00, 50, 'carne_de_pollo.png', 0),
(5, 'Carne de ternera', 2.50, 50, 'carne_de_ternera.png', 0),
(6, 'Carne de cordero', 3.00, 50, 'carne_de_cordero.png', 0),
(7, 'Falafel', 1.50, 50, 'falafel.png', 1),
(8, 'Lechuga', 0.20, 100, 'lechuga.png', 1),
(9, 'Tomate', 0.20, 100, 'tomate.png', 1),
(10, 'Cebolla', 0.20, 100, 'cebolla.png', 1),
(11, 'Pimiento', 0.20, 100, 'pimiento.png', 1),
(12, 'Zanahoria', 0.20, 100, 'zanahoria.png', 1),
(13, 'Pepino', 0.20, 100, 'pepino.png', 1),
(14, 'Salsa de yogur', 0.50, 50, 'salsa_de_yogur.png', 1),
(15, 'Salsa picante', 0.50, 50, 'salsa_picante.png', 1),
(16, 'Patatas congeladas', 1.00, 100, 'patatas_congeladas.png', 1),
(17, 'Aceite de oliva', 0.50, 100, 'aceite_de_oliva.png', 1),
(18, 'Sal', 0.10, 100, 'sal.png', 1),
(19, 'Queso', 0.50, 50, 'queso.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `INGREDIENTS_ALLERGENS`
--

CREATE TABLE `INGREDIENTS_ALLERGENS` (
  `ingredient_id` int(11) NOT NULL,
  `allergen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `INGREDIENTS_ALLERGENS`
--

INSERT INTO `INGREDIENTS_ALLERGENS` (`ingredient_id`, `allergen_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 12),
(5, 12),
(6, 12),
(7, 1),
(7, 11),
(14, 7),
(15, 10),
(15, 12),
(18, 12),
(19, 7);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `MANAGERS`
--

CREATE TABLE `MANAGERS` (
  `user_id` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `employee` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MANAGERS`
--

INSERT INTO `MANAGERS` (`user_id`, `salary`, `employee`) VALUES
(3, 2500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_05_06_071236_create_sessions_table', 1),
(4, '2025_05_08_121810_create_password_resets_table', 2),
(5, '2025_05_08_122142_create_password_reset_tokens_table', 3),
(6, '2025_05_08_122306_create_password_reset_tokens_table', 4),
(7, '2025_05_08_123426_add_remember_token_to_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `OFFERS`
--

CREATE TABLE `OFFERS` (
  `offer_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL DEFAULT 100,
  `discount` decimal(5,2) NOT NULL,
  `offer_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `OFFERS`
--

INSERT INTO `OFFERS` (`offer_id`, `prod_id`, `cost`, `discount`, `offer_text`) VALUES
(1, 1, 300, 20.00, '20% de descuento en Döner de pollo'),
(2, 18, 100, 10.00, '10% de descuento en refresco grande'),
(3, 4, 200, 15.00, '15% de descuento en Döner de falafel'),
(4, 5, 150, 20.00, '20% de descuento en Durum de pollo');

-- --------------------------------------------------------

--
-- Table structure for table `ORDERS`
--

CREATE TABLE `ORDERS` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_status` enum('pendiente','entregado','cancelado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ORDER_ITEMS`
--

CREATE TABLE `ORDER_ITEMS` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ORDER_ITEMS_INGREDIENTS`
--

CREATE TABLE `ORDER_ITEMS_INGREDIENTS` (
  `order_item_ingredient_id` int(11) NOT NULL,
  `order_item_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS`
--

CREATE TABLE `PRODUCTS` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_price` decimal(5,2) NOT NULL,
  `category` enum('Durum','Döner','Lahmacun','Entrante','Bebida','Postre') NOT NULL,
  `img_src` varchar(255) DEFAULT NULL,
  `cost` decimal(5,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PRODUCTS`
--

INSERT INTO `PRODUCTS` (`product_id`, `product_name`, `product_price`, `category`, `img_src`, `cost`, `stock`) VALUES
(1, 'Döner de pollo', 6.00, 'Döner', 'döner_pollo.png', NULL, NULL),
(2, 'Döner de ternera', 6.00, 'Döner', 'döner_ternera.png', NULL, NULL),
(3, 'Döner cordero', 6.00, 'Döner', 'döner_cordero.png', NULL, NULL),
(4, 'Döner de falafel', 6.50, 'Döner', 'döner_vegetariano.png', NULL, NULL),
(5, 'Durum de pollo', 6.00, 'Durum', 'durum_pollo.png', NULL, NULL),
(6, 'Durum de ternera', 6.00, 'Durum', 'durum_ternera.png', NULL, NULL),
(7, 'Durum cordero', 6.00, 'Durum', 'durum_cordero.png', NULL, NULL),
(8, 'Durum de falafel', 6.50, 'Durum', 'durum_vegetariano.png', NULL, NULL),
(9, 'Lahmacun de pollo', 6.00, 'Lahmacun', 'lahmacun_pollo.png', NULL, NULL),
(10, 'Lahmacun de ternera', 6.00, 'Lahmacun', 'lahmacun_ternera.png', NULL, NULL),
(11, 'Lahmacun cordero', 6.00, 'Lahmacun', 'lahmacun_cordero.png', NULL, NULL),
(12, 'Lahmacun de falafel', 6.50, 'Lahmacun', 'lahmacun_vegetariano.png', NULL, NULL),
(13, 'Patatas Fritas', 3.00, 'Entrante', 'patatas_fritas.png', NULL, NULL),
(14, 'Patatas Kebab', 3.50, 'Entrante', 'patatas_kebab.png', NULL, NULL),
(15, 'Falafel', 4.00, 'Entrante', 'falafel.png', NULL, NULL),
(16, 'Refresco Pequeño', 1.00, 'Bebida', 'refresco_pequeño.png', 0.30, 20),
(17, 'Refresco Mediano', 1.50, 'Bebida', 'refresco_mediano.png', 0.50, 20),
(18, 'Refresco Grande', 2.00, 'Bebida', 'refresco_grande.png', 0.75, 20),
(19, 'Cerveza', 1.50, 'Bebida', 'cerveza.png', 1.00, 20),
(20, 'Agua', 1.00, 'Bebida', 'agua.png', 0.20, 20),
(21, 'Baklava', 2.00, 'Postre', 'baklava.png', 1.00, 20),
(22, 'Helado', 2.00, 'Postre', 'helado.png', 1.00, 20);

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS_INGREDIENTS`
--

CREATE TABLE `PRODUCTS_INGREDIENTS` (
  `product_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PRODUCTS_INGREDIENTS`
--

INSERT INTO `PRODUCTS_INGREDIENTS` (`product_id`, `ingredient_id`) VALUES
(1, 1),
(1, 4),
(1, 8),
(1, 9),
(1, 10),
(1, 14),
(1, 15),
(2, 1),
(2, 5),
(2, 8),
(2, 9),
(2, 10),
(2, 14),
(2, 15),
(3, 1),
(3, 6),
(3, 8),
(3, 9),
(3, 10),
(3, 14),
(3, 15),
(4, 1),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 14),
(4, 15),
(5, 2),
(5, 4),
(5, 8),
(5, 9),
(5, 10),
(5, 14),
(5, 15),
(6, 2),
(6, 5),
(6, 8),
(6, 9),
(6, 10),
(6, 14),
(6, 15),
(7, 2),
(7, 6),
(7, 8),
(7, 9),
(7, 10),
(7, 14),
(7, 15),
(8, 2),
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(8, 14),
(8, 15),
(9, 3),
(9, 4),
(9, 8),
(9, 9),
(9, 10),
(9, 14),
(9, 15),
(10, 3),
(10, 5),
(10, 8),
(10, 9),
(10, 10),
(10, 14),
(10, 15),
(11, 3),
(11, 6),
(11, 8),
(11, 9),
(11, 10),
(11, 14),
(11, 15),
(12, 3),
(12, 7),
(12, 8),
(12, 9),
(12, 10),
(12, 14),
(12, 15),
(13, 16),
(13, 17),
(13, 18),
(14, 14),
(14, 15),
(14, 16),
(14, 17),
(14, 18),
(14, 19),
(15, 7);

-- --------------------------------------------------------

--
-- Table structure for table `PRODUCTS_NO_INGREDIENTS_ALLERGENS`
--

CREATE TABLE `PRODUCTS_NO_INGREDIENTS_ALLERGENS` (
  `product_id` int(11) NOT NULL,
  `allergen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `PRODUCTS_NO_INGREDIENTS_ALLERGENS`
--

INSERT INTO `PRODUCTS_NO_INGREDIENTS_ALLERGENS` (`product_id`, `allergen_id`) VALUES
(19, 1),
(21, 1),
(21, 8),
(22, 7);

-- --------------------------------------------------------

--
-- Table structure for table `REPLENISHMENTS`
--

CREATE TABLE `REPLENISHMENTS` (
  `replenishment_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `replenishment_date` date NOT NULL,
  `ingredient_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `REVIEWS`
--

CREATE TABLE `REVIEWS` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `review_text` text DEFAULT NULL,
  `review_date` date NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `answer_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `REVIEWS`
--

INSERT INTO `REVIEWS` (`review_id`, `user_id`, `rating`, `review_text`, `review_date`, `manager_id`, `answer_text`) VALUES
(1, 2, 5, 'me ha cagado', '2025-05-08', NULL, 'Rafa gitano');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TRANSACTIONS`
--

CREATE TABLE `TRANSACTIONS` (
  `transaction_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `replenishment_id` int(11) DEFAULT NULL,
  `transaction_money` decimal(5,2) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE `USERS` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user_type` enum('customer','manager','admin') NOT NULL,
  `img_src` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`user_id`, `username`, `password`, `email`, `user_type`, `img_src`, `remember_token`) VALUES
(1, 'admin', '$2y$10$vtJ0CcA7T.Owsybcx5tAPOrWtnyNfjvf65.v9hSC5iSL5Ly/9dR02', 'admin@donerkebab.com', 'admin', 'default.jpg', NULL),
(2, 'user1', '$2y$12$Wv1wMdBDQpy8ujoWRALbnO2qhlT5MipDPmJ8auLTkYhlVlhc7Ovaa', 'user1@gmail.com', 'customer', 'default.jpg', NULL),
(3, 'Manager', '$2y$12$2Qs/XMdNXcifbfJSkH7Eh.mx8YOEoHLuk2tS.tbV.xkjibng9u7G.', 'manager@donerkebab.com', 'manager', 'Manager.jpeg', NULL),
(4, 'Jose', '$2y$12$2SKSXyq3VuVBE54pfnQhMuaz0y5APsx24o6QntmFuuXzamVVb88vO', 'jose.venegasan@gmail.com', 'customer', 'default.jpg', 'fEGNELf2H0pFHCi5Mr2hPTjSmQox7ZyKZxHpUGvC9zzFx1XYA28nMN9jelqb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ALLERGENS`
--
ALTER TABLE `ALLERGENS`
  ADD PRIMARY KEY (`allergen_id`),
  ADD UNIQUE KEY `allergen_name` (`allergen_name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `CUSTOMERS`
--
ALTER TABLE `CUSTOMERS`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `CUSTOMERS_OFFERS`
--
ALTER TABLE `CUSTOMERS_OFFERS`
  ADD PRIMARY KEY (`user_id`,`offer_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `INGREDIENTS`
--
ALTER TABLE `INGREDIENTS`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD UNIQUE KEY `ingredient_name` (`ingredient_name`);

--
-- Indexes for table `INGREDIENTS_ALLERGENS`
--
ALTER TABLE `INGREDIENTS_ALLERGENS`
  ADD PRIMARY KEY (`ingredient_id`,`allergen_id`),
  ADD KEY `allergen_id` (`allergen_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MANAGERS`
--
ALTER TABLE `MANAGERS`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `OFFERS`
--
ALTER TABLE `OFFERS`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `ORDER_ITEMS_INGREDIENTS`
--
ALTER TABLE `ORDER_ITEMS_INGREDIENTS`
  ADD PRIMARY KEY (`order_item_ingredient_id`),
  ADD KEY `order_item_id` (`order_item_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD KEY `password_reset_tokens_email_index` (`email`);

--
-- Indexes for table `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `PRODUCTS_INGREDIENTS`
--
ALTER TABLE `PRODUCTS_INGREDIENTS`
  ADD PRIMARY KEY (`product_id`,`ingredient_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indexes for table `PRODUCTS_NO_INGREDIENTS_ALLERGENS`
--
ALTER TABLE `PRODUCTS_NO_INGREDIENTS_ALLERGENS`
  ADD PRIMARY KEY (`product_id`,`allergen_id`),
  ADD KEY `allergen_id` (`allergen_id`);

--
-- Indexes for table `REPLENISHMENTS`
--
ALTER TABLE `REPLENISHMENTS`
  ADD PRIMARY KEY (`replenishment_id`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `ingredient_id` (`ingredient_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `REVIEWS`
--
ALTER TABLE `REVIEWS`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `manager_id` (`manager_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `TRANSACTIONS`
--
ALTER TABLE `TRANSACTIONS`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `replenishment_id` (`replenishment_id`);

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ALLERGENS`
--
ALTER TABLE `ALLERGENS`
  MODIFY `allergen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `INGREDIENTS`
--
ALTER TABLE `INGREDIENTS`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `OFFERS`
--
ALTER TABLE `OFFERS`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ORDER_ITEMS_INGREDIENTS`
--
ALTER TABLE `ORDER_ITEMS_INGREDIENTS`
  MODIFY `order_item_ingredient_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `REPLENISHMENTS`
--
ALTER TABLE `REPLENISHMENTS`
  MODIFY `replenishment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `REVIEWS`
--
ALTER TABLE `REVIEWS`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `TRANSACTIONS`
--
ALTER TABLE `TRANSACTIONS`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CUSTOMERS`
--
ALTER TABLE `CUSTOMERS`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `USERS` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `CUSTOMERS_OFFERS`
--
ALTER TABLE `CUSTOMERS_OFFERS`
  ADD CONSTRAINT `customers_offers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `CUSTOMERS` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customers_offers_ibfk_2` FOREIGN KEY (`offer_id`) REFERENCES `OFFERS` (`offer_id`) ON DELETE CASCADE;

--
-- Constraints for table `INGREDIENTS_ALLERGENS`
--
ALTER TABLE `INGREDIENTS_ALLERGENS`
  ADD CONSTRAINT `ingredients_allergens_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `INGREDIENTS` (`ingredient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ingredients_allergens_ibfk_2` FOREIGN KEY (`allergen_id`) REFERENCES `ALLERGENS` (`allergen_id`) ON DELETE CASCADE;

--
-- Constraints for table `MANAGERS`
--
ALTER TABLE `MANAGERS`
  ADD CONSTRAINT `managers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `USERS` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `CUSTOMERS` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `ORDER_ITEMS`
--
ALTER TABLE `ORDER_ITEMS`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ORDERS` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`product_id`);

--
-- Constraints for table `ORDER_ITEMS_INGREDIENTS`
--
ALTER TABLE `ORDER_ITEMS_INGREDIENTS`
  ADD CONSTRAINT `order_items_ingredients_ibfk_1` FOREIGN KEY (`order_item_id`) REFERENCES `ORDER_ITEMS` (`order_item_id`),
  ADD CONSTRAINT `order_items_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `INGREDIENTS` (`ingredient_id`);

--
-- Constraints for table `PRODUCTS_INGREDIENTS`
--
ALTER TABLE `PRODUCTS_INGREDIENTS`
  ADD CONSTRAINT `products_ingredients_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `INGREDIENTS` (`ingredient_id`) ON DELETE CASCADE;

--
-- Constraints for table `PRODUCTS_NO_INGREDIENTS_ALLERGENS`
--
ALTER TABLE `PRODUCTS_NO_INGREDIENTS_ALLERGENS`
  ADD CONSTRAINT `products_no_ingredients_allergens_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_no_ingredients_allergens_ibfk_2` FOREIGN KEY (`allergen_id`) REFERENCES `ALLERGENS` (`allergen_id`) ON DELETE CASCADE;

--
-- Constraints for table `REPLENISHMENTS`
--
ALTER TABLE `REPLENISHMENTS`
  ADD CONSTRAINT `replenishments_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `MANAGERS` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replenishments_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `INGREDIENTS` (`ingredient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replenishments_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `REVIEWS`
--
ALTER TABLE `REVIEWS`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `MANAGERS` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `CUSTOMERS` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `TRANSACTIONS`
--
ALTER TABLE `TRANSACTIONS`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ORDERS` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`replenishment_id`) REFERENCES `REPLENISHMENTS` (`replenishment_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
