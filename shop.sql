-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 11, 2017 lúc 09:00 AM
-- Phiên bản máy phục vụ: 10.1.26-MariaDB
-- Phiên bản PHP: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoponline`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email use to id log in',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ten khach hang',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mat khau',
  `birthday` date NOT NULL COMMENT 'ngay sinh',
  `avatar` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'avatar',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='cac thanh vien khach hang';

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id`, `email`, `name`, `password`, `birthday`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'test@gmail.com', 'test', '$2y$10$xRypUqTTg/wGqBq84xtn0uSVS7.f0Zry0iSM3ejhE7R3edJ.n9nR.', '1930-01-21', 'avatar', '2017-11-09 12:29:21', '2017-11-10 20:27:14'),
(3, 'test1@gmail.com', 'test1', '$2y$10$Z/MrvxN0ejbvNRDKcReR9esSBPgBd8J8qCQyxrUJvGy31IMCZZTzi', '1997-02-19', 'avatar', '2017-11-09 12:53:41', '2017-11-10 20:00:53'),
(4, 'test2@gmail.com', 'test2', '$2y$10$0TqOMgb8kvTlZGQNvd8FJ.9YlBX93VhAYVtquKwNRowAjcBXAmFvS', '2017-11-10', 'avatar', '2017-11-09 12:54:02', '2017-11-09 12:54:02'),
(6, 'test3@gmail.com', 'test3', '$2y$10$0sYs0qL0cOTMcgAUTlKj9.NH1lgfXK3INj2SX6Hi/ZOrrYPZ0el3a', '1923-11-15', 'avatar', '2017-11-10 20:02:31', '2017-11-10 20:02:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `catagory_news_id` int(11) NOT NULL COMMENT 'chu de bai viet',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'tieu de bai viet',
  `content` varchar(5000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'noi dung bai viet',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='cac bai viet';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_catagories`
--

CREATE TABLE `news_catagories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ten chu de',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='cac chu de bai viet';

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL COMMENT 'nguoi mua hang',
  `total` int(11) NOT NULL COMMENT 'tong gia tri',
  `status` int(11) NOT NULL COMMENT 'trang thai don hang (1->4) pending, processing, shipped, delivered',
  `payment_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'hinh thuc thanh toan',
  `payment_status` int(11) NOT NULL COMMENT 'trang thai thanh toan',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='cac don hang';

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `member_id`, `total`, `status`, `payment_type`, `payment_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 57000000, 1, 'ATM', 0, '2017-11-07 20:06:25', '2017-11-10 19:21:20', '2017-11-09 20:06:25'),
(2, 3, 32000000, 3, 'ATM', 0, '2017-11-08 20:07:28', '2017-11-09 20:07:28', '2017-11-09 20:07:28'),
(3, 4, 32000000, 4, 'ATM', 0, '2017-11-09 20:07:35', '2017-11-09 20:07:35', '2017-11-09 20:07:35'),
(5, 3, 30000000, 2, 'ATM', 0, '2017-11-09 20:22:52', '2017-11-09 20:22:52', '2017-11-09 20:22:52'),
(6, 4, 20000000, 2, 'ATM', 0, '2017-11-11 01:51:04', '2017-11-11 01:51:04', '2017-11-11 01:51:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL COMMENT 'ma so don hang',
  `product_id` int(11) NOT NULL COMMENT 'ten san pham',
  `quantity` int(11) NOT NULL COMMENT 'so luong',
  `price` int(11) NOT NULL COMMENT 'gia co the thay doi khi sale',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='cac san pham trong don hang';

--
-- Đang đổ dữ liệu cho bảng `orders_items`
--

INSERT INTO `orders_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 2, 6000000, '2017-11-10 02:45:52', '2017-11-09 23:46:03'),
(2, 1, 7, 3, 15000000, '2017-11-10 02:46:08', '2017-11-10 19:21:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ten san pham',
  `quantity` int(11) NOT NULL COMMENT 'so luong',
  `price` int(11) NOT NULL COMMENT 'gia san pham',
  `subcrible` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'thong tin san pham',
  `catagory_id` int(11) NOT NULL COMMENT 'hang san xuat',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='bang danh sach san pham';

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `price`, `subcrible`, `catagory_id`, `created_at`, `updated_at`) VALUES
(1, 'Iphone X', 20, 23000000, 'sieu pham dang cap nhat the gioi', 1, '2017-11-08 15:42:46', '2017-11-08 15:42:46'),
(3, 'Iphone 6', 20, 9000000, 'sieu pham dang cap nhat the gioi', 1, '2017-11-08 15:43:25', '2017-11-09 10:08:05'),
(5, 'Samsung J7', 10, 6000000, 'sieu pham dang cap nhat the gioi', 2, '2017-11-08 15:45:19', '2017-11-08 15:45:19'),
(6, 'Samsung S8', 20, 26000000, 'sieu pham dang cap nhat the gioi12', 2, '2017-11-08 15:45:37', '2017-11-09 10:20:25'),
(7, 'Nokia 8', 20, 1500000, 'yasuo sieu pham', 21, '2017-11-09 10:07:47', '2017-11-09 10:07:47'),
(8, 'Oppo F5', 10, 1500000, 'san pham tot', 6, '2017-11-09 11:00:23', '2017-11-09 11:00:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_catagories`
--

CREATE TABLE `products_catagories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ten hang san xuat',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='cac hang san xuat';

--
-- Đang đổ dữ liệu cho bảng `products_catagories`
--

INSERT INTO `products_catagories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Iphone', '2017-11-10 23:19:19', '2017-11-10 16:19:19'),
(2, 'Samsung', '2017-11-08 15:45:02', '2017-11-08 08:45:02'),
(4, 'HTC', '2017-11-05 07:28:55', '0000-00-00 00:00:00'),
(5, 'XiaoMi', '2017-11-08 06:23:49', '2017-11-07 23:23:49'),
(6, 'Oppo', '2017-11-08 00:54:02', '2017-11-08 00:54:02'),
(7, 'Blackberry', '2017-11-09 08:40:23', '2017-11-09 01:39:07'),
(20, 'Bphone', '2017-11-09 01:40:36', '2017-11-09 01:40:36'),
(21, 'Nokia', '2017-11-09 10:07:22', '2017-11-09 10:07:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news_catagories`
--
ALTER TABLE `news_catagories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products_catagories`
--
ALTER TABLE `products_catagories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `news_catagories`
--
ALTER TABLE `news_catagories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT cho bảng `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `products_catagories`
--
ALTER TABLE `products_catagories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
