-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 05, 2023 lúc 05:31 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlybanhang1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_act`
--

CREATE TABLE `tbl_act` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_act`
--

INSERT INTO `tbl_act` (`id`, `name`, `slug`, `status`, `created_ad`) VALUES
(1, 'Nhập kho', 'nhap-kho', 1, '2023-01-10 06:09:23'),
(2, 'Xuất kho', 'xuat-kho', 1, '2023-01-10 06:09:23'),
(3, 'Hủy kệ', 'huy-ke', 1, '2023-01-10 06:09:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`id`, `name`, `address`, `status`, `created_ad`) VALUES
(1, 'Cơ sở 1', '260 Phong Đình Cảng, Vinh, Nghệ An', 1, '2023-01-09 16:23:55'),
(2, 'Cơ sở 2', '27 Đốc Thiết, Vinh, Nghệ An', 1, '2023-01-09 16:23:55'),
(3, 'Cơ sở 3', 'chưa mở', 1, '2023-03-08 13:34:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_classify`
--

CREATE TABLE `tbl_classify` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_classify`
--

INSERT INTO `tbl_classify` (`id`, `name`, `slug`, `title`, `status`, `created_at`) VALUES
(1, 'Bao cao su', NULL, NULL, 1, '2023-01-10 09:34:52'),
(2, 'Gel bôi trơn', NULL, NULL, 1, '2023-01-10 09:34:52'),
(3, 'Cương dương', NULL, NULL, 1, '2023-01-10 09:34:52'),
(4, 'Xịt kéo dài', NULL, NULL, 1, '2023-01-10 09:34:52'),
(5, 'Bao đôn dên', NULL, NULL, 1, '2023-01-10 09:34:52'),
(6, 'Âm đạo giả', NULL, NULL, 1, '2023-01-10 09:34:52'),
(7, 'Dương vật giả', NULL, NULL, 1, '2023-01-10 09:34:52'),
(8, 'Trứng rung', NULL, NULL, 1, '2023-01-10 09:34:52'),
(9, 'Chày rung', NULL, NULL, 1, '2023-01-10 09:34:52'),
(10, 'Kích thích nữ', NULL, NULL, 1, '2023-01-10 09:34:52'),
(11, 'Đồ chơi khác', NULL, NULL, 1, '2023-01-10 09:34:52'),
(12, 'Sản phẩm khác', NULL, NULL, 1, '2023-01-10 17:30:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_from_where`
--

CREATE TABLE `tbl_from_where` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_from_where`
--

INSERT INTO `tbl_from_where` (`id`, `name`, `slug`, `note`, `status`, `created_ad`) VALUES
(1, 'Thấy trực tiếp', 'NV', 'Mua tại shop', 1, '2023-01-10 06:03:55'),
(2, 'Page chị Linh', 'NV', 'Đơn từ page chị Linh', 1, '2023-01-10 06:03:55'),
(3, 'CTV Tú nhỏ', 'CTV', 'Đơn từ CTV Tú nhỏ', 1, '2023-01-10 06:03:55'),
(4, 'Page Tú to', 'NV', 'Đơn từ page Tú to', 1, '2023-01-10 06:03:55'),
(5, 'Page shop', 'NV', 'Đơn từ zalo, sđt và page shop', 1, '2023-01-10 06:03:55'),
(6, 'CTV Nam', 'CTV', 'Đơn từ CTV Nam', 1, '2023-02-23 11:28:25'),
(7, 'CTV A Ngọc', 'CTV', 'Đơn từ CTV A Ngọc', 1, '2023-02-23 11:28:25'),
(8, 'Page Minh', 'NV', 'Đơn từ page Minh', 1, '2023-02-23 11:29:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_payment_status`
--

CREATE TABLE `tbl_payment_status` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_ad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_payment_status`
--

INSERT INTO `tbl_payment_status` (`id`, `name`, `type`, `status`, `created_ad`, `updated_ad`) VALUES
(1, 'Tiền mặt', 'OK', 1, '2023-01-10 06:06:19', NULL),
(2, 'Chuyển khoản', 'OK', 1, '2023-01-10 06:06:19', NULL),
(3, 'COD Viettel', 'COD', 1, '2023-01-10 06:06:19', NULL),
(4, 'COD GHTK', 'COD', 1, '2023-01-10 06:06:19', NULL),
(5, 'Tặng khách', 'TANG', 1, '2023-01-10 06:06:44', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_classify` bigint(20) NOT NULL,
  `id_unit` bigint(20) NOT NULL,
  `num_unit` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` int(20) DEFAULT 0,
  `note` longtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `id_user` bigint(20) NOT NULL,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `detail`, `id_classify`, `id_unit`, `num_unit`, `price`, `quantity`, `note`, `status`, `id_user`, `created_ad`) VALUES
(2, 'BCS sagami 0.01', 'BCS sagami siêu mỏng 0.01mm', 1, 5, 1, 130000, 0, '', 1, 2, '2023-01-10 17:45:02'),
(3, 'BCS sagami 0.02', 'BCS sagami siêu mỏng 0.02', 1, 5, 1, 90000, 0, '', 1, 2, '2023-01-10 17:45:02'),
(4, 'BCS sagami cam H10', 'cũ là đỏ trơn đổi thành cam trơn', 1, 1, 10, 110000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(5, 'BCS sagami xanh H10', 'BCS sagami xanh bi liti', 1, 1, 1, 110000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(6, 'BCS OLO 0.01 đỏ', 'BCS OLO siêu mỏng 0.01, tạo nhiệt', 1, 1, 10, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(7, 'BCS OLO 0.01 đỏ lẻ', 'BCS OLO siêu mỏng 0.01, tạo nhiệt lẻ', 1, 5, 1, 25000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(8, 'BCS OLO 0.01 đen', 'BCS OLO siêu mỏng 0.01, kéo dài', 1, 1, 10, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(9, 'BCS OLO 0.01 đen lẻ', 'BCS OLO siêu mỏng 0.01, kéo dài lẻ', 1, 5, 1, 25000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(10, 'BCS Gold Time 0.03', 'BCS God Time 0.03, kéo dài', 1, 1, 12, 160000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(11, 'BCS Feel 4in1', 'BCS Feel 4in1 kéo dài, gai liti', 1, 1, 12, 90000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(12, 'BCS Feel Bliss', 'BCS Feel Bliss có gai, size 53', 1, 1, 12, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(13, 'BCS Durex Per H3', 'BCS Durex Performa kéo dài', 1, 1, 3, 70000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(14, 'BCS Durex Per H12', 'BCS Durex Performa kéo dài', 1, 1, 12, 230000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(15, 'BCS Durex Feth H3', 'BCS Durex Fetherlite mỏng thường', 1, 1, 3, 70000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(16, 'BCS Durex Feth H12', 'BCS Durex Fetherlite mỏng thường', 1, 1, 12, 230000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(17, 'BCS Durex Invis H3', 'BCS Durex Invisable siêu mỏng', 1, 1, 3, 75000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(18, 'BCS Durex Kingtext H3', 'BCS Durex Kingtext size 49', 1, 1, 3, 60000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(19, 'BCS Oleo H3', 'BCS Oleo trơn kéo dài 49mm', 1, 1, 3, 40000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(20, 'BCS Oleo H10', 'BCS Oleo trơn kéo dài size 49', 1, 1, 10, 120000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(21, 'BCS Oleo 4in1', 'BCS Oleo 4in1 gai liti, kéo dài', 1, 1, 12, 120000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(22, 'BCS Masculan H3', 'BCS Masculan gai liti, kéo dài, hương dâu', 1, 1, 3, 55000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(23, 'BCS Masculan H10', 'BCS Masculan gai liti, kéo dài, hương dâu', 1, 1, 10, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(24, 'BCS Xmen', 'BCS Bi Xmen 6 bi', 1, 1, 1, 15000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(25, 'BCS Gai super runbo', 'BCS Gai Chôm Chôm', 1, 1, 2, 50000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(26, 'BCS Gai H1', 'BCS Gai cao cấp 1 cái', 1, 1, 1, 30000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(27, 'BCS Gai Extra H6', 'BCS Gai Extra Sensitive', 1, 1, 6, 140000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(28, 'BCS Innova', 'BCS Innova gai liti, kéo dài', 1, 1, 12, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(29, 'BCS Việt Lẻ', 'BCS Việt lẻ', 1, 5, 1, 5000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(30, 'BCS Cá Ngựa', 'BCS Cá ngựa kéo dài, mỏng', 1, 1, 12, 110000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(31, 'BCS Maxmen', 'BCS Maxmen kéo dài, gai liti', 1, 5, 1, 10000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(32, 'BCS 9 Bi Cắt Lẻ', 'BCS 9 bi cắt lẻ', 1, 5, 1, 20000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(33, 'BCS Zero O2', 'BCS Nhật siêu mỏng 0.02', 1, 1, 1, 90000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(34, 'BCS Gold time Super thin', 'BCS goldtime mỏng k kéo dài', 1, 1, 1, 140000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(35, 'BCS Michio', 'Bcs siêu mỏng, hỗ trợ kéo dài', 1, 1, 1, 80000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(36, 'BCS OLO Ngọc Trai', 'BCS OLO Ngọc Trai : 5 bao + 5 bi', 1, 1, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(37, 'BCS OLO Băng Hỏa', 'BCS OLO Băng Hỏa : nóng lạnh', 1, 1, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(38, 'BCS OLO Đồng', 'BCS OLO Đồng mỏng, kéo dài', 1, 1, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(39, 'BCS OLO Xanh - trơn', 'BCS OLO Xanh - trơn, kéo dài', 1, 1, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(40, 'BCS OLO Đồng lẻ', 'BCS OLO Đồng mỏng, kéo dài lẻ', 1, 5, 1, 25000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(41, 'BCS OLO Ngọc Trai lẻ', 'BCS OLO Ngọc Trai : 5 bao + 5 bi lẻ', 1, 7, 1, 50000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(42, 'BCS OLO Vàng lẻ', 'BCS OLO Vàng có gân gai lẻ', 1, 5, 1, 25000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(43, 'BCS OLO Băng Hỏa lẻ', 'BCS OLO Băng Hỏa : nóng lạnh lẻ', 1, 5, 1, 25000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(44, 'BCS OLO Vàng', 'BCS OLO Vàng có gân gai', 1, 1, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(45, 'BCS Oleo Power', 'BCS Oleo Power hộp 10c', 1, 1, 1, 170000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(46, 'BCS Oleo Power lẻ', 'BCS Oleo Power bán lẻ', 1, 5, 1, 20000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(47, 'BCS Gai đầu chôm 1C', 'BCS Gai đầu chôm 1C rời', 1, 5, 1, 20000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(48, 'BCS Miệng Oralsex', 'BCS cho qh Miệng Oralsex hộp 10c', 1, 1, 1, 80000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(49, 'BCS OLO Xanh - bi', 'BCS OLO Xanh - bi, kéo dài', 1, 1, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(50, 'BCS OLO Xanh - bi lẻ', 'BCS OLO Xanh - bi, kéo dài lẻ', 1, 5, 1, 25000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(51, 'BCS OLO Xanh - trơn lẻ', 'BCS OLO Xanh - trơn, kéo dài lẻ', 1, 5, 1, 25000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(52, 'BCS Eros', 'BCS thường Eros hộp 144c', 1, 1, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(53, 'BCS sagami đỏ H10 kéo dài', 'Bao cao su sagami đỏ kéo dài thời gian', 1, 1, 10, 130000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(54, 'Gel Durex Ky', 'Gel bôi trơn durex Ky', 2, 2, 1, 65000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(55, 'Gel Durex 2in1', 'Gel Durex 2in1', 2, 2, 1, 330000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(56, 'Gel Durex Dâu', 'Gel Durex hương dâu', 2, 2, 1, 230000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(57, 'Gel Durex Classic', 'Gel Durex Classic 50ml', 2, 2, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(58, 'Gel Tinh Trùng', 'Gel tinh trùng Nhật 200ml', 2, 2, 1, 170000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(59, 'Gel Back Door', 'Gel Back Door hậu môn cho gay', 2, 2, 1, 210000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(60, 'Gel Dâu Love Kiss', 'Gel Love Kiss hương Dâu 100ml', 2, 2, 1, 110000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(61, 'Gel hương Chanh', 'Gel bôi trơn hoa quả có mùi hương 100ml', 2, 2, 1, 110000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(62, 'Gel hương Đào', 'Gel bôi trơn hoa quả có mùi hương 100ml', 2, 2, 1, 110000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(63, 'Gel hương Táo', 'Gel bôi trơn hoa quả có mùi hương 100ml', 2, 2, 1, 110000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(64, 'Gel Vanessa 200ml', 'Gel bôi trơn Vanessa 200ml', 2, 2, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(65, 'Gel KT nữ dạng gói', 'Gel KT âm đạo dạng gói', 2, 6, 1, 25000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(66, 'Gel Durex Warming', 'Gel Durex Warming ấm nóng', 2, 2, 1, 230000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(67, 'Gel Cokelife cherry (nóng)', 'Gel Cokelife cherry nóng', 2, 2, 1, 140000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(68, 'Gel Cokelife táo (lạnh)', 'Gel Cokelife táo lạnh', 2, 2, 1, 140000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(69, 'Gel Cokelife dưa lưới (thường)', 'Gel Cokelife dưa lưới thường', 2, 2, 1, 140000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(70, 'Gel giảm đau đỏ (nóng)', 'Gel Cokelife giảm đau nóng màu đỏ', 2, 2, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(71, 'Gel giảm đau xanh (lạnh)', 'Gel Cokelife giảm đau lạnh màu xanh', 2, 2, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(72, 'Gel giảm đau vàng (thường)', 'Gel Cokelife giảm đau thường màu vàng', 2, 2, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(73, 'CD Rockman', 'CD và kéo dài Rockman', 3, 2, 1, 600000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(74, 'CD Ngựa Thái', 'CD và kéo dài Ngựa Thái', 3, 3, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(75, 'CD Ngựa Thái Lẻ', 'CD và kéo dài Ngựa Thái', 3, 4, 1, 50000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(76, 'CD Maxman', 'CD và kéo dài Maxman', 3, 3, 1, 300000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(77, 'CD Maxman Lẻ', 'CD và kéo dài Maxman', 3, 4, 1, 40000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(78, 'CD Rồng Nâu', 'CD và kéo dài Rồng Nâu', 3, 3, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(79, 'CD Rồng Nâu Lẻ', 'CD và kéo dài Rồng Nâu', 3, 4, 1, 40000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(80, 'CD Tem Vinix 100mg lẻ', 'CD và kéo dài Tem Vinix 100mg', 3, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(81, 'CD Men Pro', 'CD Men Pro', 3, 3, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(82, 'CD Men Pro Lẻ', 'CD Men Pro Lẻ', 3, 4, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(83, 'CD Kamagra', 'CD dạng vỉ 4 viên nén 100mg', 3, 3, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(84, 'CD Kamagra lẻ', 'CD dạng vỉ 4 viên nén, lẻ 1v. 100mg', 3, 4, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(85, 'CXT Stud 100', 'CXT Xịt Stud 100', 4, 2, 1, 500000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(86, 'CXT Bamboo', 'CXT Xịt Bamboo 13%', 4, 2, 1, 600000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(87, 'CXT Dynamo', 'CXT Xịt Dynamo 12%', 4, 2, 1, 500000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(88, 'CXT Playboy', 'CXT Xịt Playboy', 4, 2, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(89, 'CXT Emla', 'CXT Tuýp Emla 5%', 4, 2, 1, 110000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(90, 'CXT Gói Volcano', 'CXT Gói Volcano', 4, 6, 1, 40000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(91, 'CXT Cao Sìn Sú', 'CXT Cao Sìn Sú', 4, 2, 1, 270000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(92, 'CXT sìn sú xịt', 'Chống xuất tinh kéo dài thời gian sìn sú dạng xịt', 4, 2, 1, 220000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(93, 'CXT longtime', 'Xịt kéo dài thời gian long time', 4, 2, 1, 90000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(94, 'CXT Cao sìn đen', 'Cao sìn sú đen giống xịt', 4, 2, 1, 240000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(95, 'Sìn sú bột ê đê', 'Sìn sú ê đê dạng bột', 4, 1, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(96, 'TR 1 Trứng', 'Trứng rung 1 trứng thường', 8, 5, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(97, 'TR 2 Trứng', 'Trứng rung 2 trứng thường', 8, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(98, 'TR Không Dây LiLou', 'Trứng rung không dây LiLou', 8, 5, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(99, 'TR 2 Trứng Gai', 'Trứng rung 2 trứng có gai', 8, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(100, 'TR 1 Trứng Nhật', 'Trứng rung 1 trứng có dây Nhật', 8, 5, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(101, 'TR Pretty Love Harriet', 'Trứng rung 1 trứng có dây', 8, 5, 1, 450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(102, 'TR Pretty Love Eunice', 'Trứng rung có dây', 8, 5, 1, 450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(103, 'TR Nhét HM Hình DV', 'Trứng rung nhét hậu môn hình dương vật nhỏ', 8, 5, 1, 660000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(104, 'TR Mini Love Egg', 'Trứng rung có dây', 8, 5, 1, 450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(105, 'TR Pretty love Irma', 'TR Pretty love Irma 2 trứng', 8, 5, 1, 600000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(106, 'TR 3T có lưỡi liếm', 'Trứng rung 3T. 1 trứng có lưỡi liếm', 8, 5, 1, 500000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(107, 'TR lưỡi liếm con heo', 'TR lưỡi liếm con heo xinh xắn', 8, 5, 1, 400000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(108, 'TR đuôi cá 600k', 'TR đuôi cá 600k', 8, 5, 1, 600000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(109, 'TR Jum egg', 'TR 1 cục lưỡi 1 cục trứng bi dài', 8, 5, 1, 440000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(110, 'TR hình DV', 'TR hình DV', 8, 5, 1, 300000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(111, 'DV 2 Pin', 'Dương vật thường 2 pin', 7, 5, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(112, 'DV 1 Pin', 'Dương vật thường mới 1 pin', 7, 5, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(113, 'DV Hít Tường', 'DV Hít tường JB rung, ngoáy', 7, 5, 1, 650000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(114, 'DV 7 Chế Độ', 'Dương vật 7 chế độ rung, pin', 7, 5, 1, 850000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(115, 'DV 7 Phát Nhiệt Fanala', 'DV 7 Chế độ, phát nhiệt Fanala', 7, 5, 1, 750000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(116, 'DV Libo', 'Dương vật Libo rung thụt', 7, 5, 1, 850000, 0, '', 0, 3, '2023-01-10 17:45:02'),
(117, 'DV Chuối', 'DV ngụy trang hình trái chuối', 7, 5, 1, 900000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(118, 'DV 2 đầu', 'Dương vật 2 đầu không rung', 7, 5, 1, 600000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(119, 'DV Snappy', 'Dương vật nhiều chế độ rung, pin', 7, 5, 1, 500000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(120, 'DV 2 Pin Rung Ngoáy', 'DV 2 Pin Rung Ngoáy', 7, 5, 1, 450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(121, 'DV hít tường mềm mới', 'dv mới', 7, 5, 1, 700000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(122, 'Máy tập dương vật tự động', 'Máy tập dv tự động', 11, 5, 1, 1450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(123, 'DV gắn tường excited', 'Dương vật gắn tường excited', 7, 5, 1, 650000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(124, 'DV Rockin Dong', 'Dương vật Rockin Dong', 7, 5, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(125, 'DV xoay thụt Mars', 'Dương vật xoay thụt, có độ ấm Mars', 7, 5, 1, 1450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(126, 'DV phát nhiệt CC 48 độ', 'Dương vật phát nhiệt cao cấp 48 độ', 7, 5, 1, 1600000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(127, 'DV 3 khấc', 'Dương vật có 3 khấc nhiều chế độ rung', 7, 5, 1, 660000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(128, 'DV cầm tay AILIGHTER', 'DV cầm tay AILIGHTER thụt', 7, 5, 1, 1860000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(129, 'DV cầm tay cong leten', 'DV cầm tay cong tai thỏ leten 7 chế độ', 7, 5, 1, 980000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(130, 'DV hít tường King Sized', 'Dương vật hít tường siêu to khổng lồ king sized', 7, 5, 1, 990000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(131, 'DV hít tường rung thụt', 'DV hít tường rung thụt king-sized màu hồng', 7, 5, 1, 650000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(132, 'DV libo xạc', 'DV libo cầm tay xạc', 7, 5, 1, 850000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(133, 'AD Cốc Baile', 'Âm đạo cốc tình Baile rung', 6, 5, 1, 400000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(134, 'AD Đèn Pin 7 Chế Độ', 'AD đèn pin 7 chế độ rung', 6, 5, 1, 800000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(135, 'AD Đèn Pin 1 Chế Độ', 'Âm đạo đèn pin 1 chế độ rung', 6, 5, 1, 550000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(136, 'AD Katerina II', 'Âm đạo tự động cao cấp', 6, 5, 1, 1850000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(137, 'AD 2 Đầu', 'Âm đạo 2 đầu có rung', 6, 5, 1, 1000000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(138, 'AD GẮN TƯỜNG CRAZY BULL PIN', 'Âm đạo gắn tường Crazy Bull pin,RUNG ,RÊN', 6, 5, 1, 900000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(139, 'AD Gắn tường Sạc', 'Âm đạo gắn tường Crazy Bull Sạc', 6, 5, 1, 950000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(140, 'AD Trái Tim', 'Âm đạo hình trái tim', 6, 5, 1, 700000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(141, 'AD Hít tường chân rời', 'AD Hít tường chân rời', 6, 5, 1, 980000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(142, 'AD Cốc Qing 240k', 'AD Cốc Qing 240k', 6, 5, 1, 240000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(143, 'AD Hình Mông', 'AD Hình Mông', 6, 5, 1, 800000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(144, 'AD mông 2 chân', 'Âm đạo hình mông quỳ 2 chân có rung, bộ làm ấm', 6, 1, 1, 1400000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(145, 'AD gắn tường tự động laten', 'AD gắn tường tự động thụt', 6, 5, 1, 1550000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(146, 'AD cầm tay laten 3.0', 'Âm đạo cầm tay laten 3.0', 6, 5, 1, 1950000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(147, 'Chày Rung', 'Chày rung kích thích nữ', 9, 5, 1, 800000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(148, 'Chày rung 2 đầu', 'Chày rung 2 đầu', 9, 5, 1, 1450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(149, 'Chày rung 2 đầu 880k', 'Chày rung 2 đầu 880k', 9, 5, 1, 880000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(150, 'Chày rung móc khóa', 'Chày rung mini treo chìa khóa', 9, 5, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(151, 'DZ Thường Gai', 'DZ Thường Gai', 5, 5, 1, 120000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(152, 'DZ Cao Cấp 6 râu', 'DZ cao cấp trơn 6 râu', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(153, 'DZ Gai Và Bi', 'DZ gai có bi', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(154, 'DZ Đầu Rồng', 'DZ đầu rồng có gai, rung', 5, 5, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(155, 'DZ Size Lớn', 'DZ Size Lớn', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(156, 'DZ Braveman 2 Rung', 'DZ Braveman có quai 2 rung', 5, 5, 1, 380000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(157, 'DZ Braveman Rung Đầu', 'DZ Braveman 1 Rung Đầu', 5, 5, 1, 300000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(158, 'DZ Quai Không Rung', 'DZ Quai Không Rung', 5, 5, 1, 200000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(159, 'DZ Quai Rung Đầu', 'DZ có quai rung đầu', 5, 5, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(160, 'DZ Khúc', 'DZ độn khúc giữa', 5, 5, 1, 50000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(161, 'DZ Ngón Tay', 'DZ Ngón tay', 5, 5, 1, 45000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(162, 'DZ trơn cao cấp', 'Đôn dên trơn cao cấp', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(163, 'DZ gân gai cao cấp', 'Đôn dên gân gai cao cấp', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(164, 'DZ gân bi xanh cao cấp', 'Đôn dên gân gai màu xanh cao cấp (3 bi dọc)', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(165, 'DZ gân bi đen cao cấp', 'Đôn dên gân gai màu đen cao cấp (2 bi ngang)', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(166, 'DZ khúc sét 6 cái', 'Bộ set đôn dên khúc gồm 6 cái', 5, 1, 6, 220000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(167, 'DZ MaxMan', 'Đôn dên maxman 50mm có bi nổi trên bề mặt', 5, 5, 1, 300000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(168, 'KT Viagra lọ', 'KT Nữ Viagra dạng nước', 10, 2, 1, 400000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(169, 'KT Viagra LaDy Era', 'KT Viagra dạng viên LaDy Era', 10, 3, 4, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(170, 'KT Viagra LaDy Era lẻ', 'KT Viagra dạng viên LaDy Era', 10, 4, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(171, 'KT Phiter', 'KT Phiter dùng 1 lần', 10, 2, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(172, 'KT Nữ Nhật', 'KT Nữ Nhật màu tím', 10, 2, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(173, 'Kẹo Sâm', 'Kẹo Sâm', 3, 5, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(174, 'Kẹo BJ', 'Kẹo BJ love mint Thái', 12, 1, 1, 195000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(175, 'Kẹo cao su', 'Kẹo cao su tăng ham muốn nữ', 12, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(176, 'Dụng cụ bạo dâm', 'Bộ dụng cụng bao dâm nô lệ', 11, 5, 1, 800000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(177, 'Nước Hoa Dionel', 'Nước hoa bím Dionel', 12, 2, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(178, 'Nước hoa AĐ Foellie', 'Nước hoa Âm đạo Foellie', 12, 2, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(179, 'Combo nước Oral Sex Water', 'Gói quan hệ bằng miệng Combo', 12, 6, 2, 70000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(180, 'Máy tập dương vật', 'Máy tập hút dương vật', 11, 5, 1, 750000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(181, 'Lưỡi rung + Trứng', 'Hộp combo lưỡi rung + 2 trứng', 8, 5, 1, 620000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(182, 'Vòng đeo Stay Hart 3 chiếc', 'Vòng đeo Stay Hard 3 cái', 5, 5, 1, 120000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(183, 'Vòng đeo có rung', 'Vòng đeo kích thích âm đạo', 5, 5, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(184, 'AD cầm tay laten 1.0', 'Âm đạo tự động cao cấp có màn led 1.0', 6, 5, 1, 2050000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(185, 'BCS Boss', 'Bao cao su kéo dài thời gian BOSS', 1, 5, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(186, 'KT nữ Blue', 'Kích thích nữ Blue', 10, 2, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(187, 'KT nữ Jade', 'Kích thích nữ Jade', 10, 2, 1, 400000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(188, 'Gel mát xa toàn thân', 'Gel mát xa toàn thân mát lạnh + giữ ẩm', 2, 2, 1, 240000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(189, 'AD mông 2 lỗ', 'Âm đạo có hình mông có 2 lỗ có rung, rên', 6, 5, 1, 820000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(190, 'TR đuôi tròn', 'Trứng rung điều khiển từ xa đuôi tròn', 8, 5, 1, 630000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(191, 'TR 2 đầu dktx', 'Chày rung hai đầu điều khiển từ xa', 8, 5, 1, 780000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(192, 'TR LiLo phát nhiệt dktx', 'Trứng rung LiLo điều khiển từ xa, phát nhiệt', 8, 5, 1, 800000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(193, 'TR Magic vinix', 'Trứng rung điểu khiển từ xa magic vinix 7 cđ rung', 8, 5, 1, 1370000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(194, 'DV LangKyl', 'Dương vật langkyl rung thụt, ngụy trang có vỏ trắng', 7, 5, 1, 1480000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(195, 'TR ngón tay', 'Trứng rung ngón tay dktx, con xoay KT hạt le', 8, 5, 1, 700000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(196, 'DV Silicol tháo rời', 'Dương vật silicol tháo rời, có rung', 7, 5, 1, 260000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(197, 'DV rung thụt đầu lưỡi', 'Dương vật rung thụt, đầu có lưỡi liếm', 7, 5, 1, 1350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(198, 'DV cầm tay DiBe', 'DV cầm tay rung thụt Dibe', 7, 5, 1, 1550000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(199, 'Gel mát xa Tulip', 'Gel mát xa toàn thân hương Tulip', 2, 2, 1, 220000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(200, 'TR tai thỏ hình DV', 'Trứng rung tai thỏ hình DV, DKTX, Little Dance', 8, 5, 1, 850000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(201, 'TR 4T LiLo', 'Trứng rung 4 trứng tách rời LiLo', 8, 5, 1, 1250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(202, 'Gel Tinh Trùng 200ml', 'Gel tinh trừng nhật 200ml', 2, 2, 1, 130000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(203, 'AD Ferrady', 'Âm đạo tự động thụt màu hồng Ferrady', 6, 5, 1, 1350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(204, 'DV 45 độ Vibrators', 'Dương vật tung thụt, màn điện tử Vibrators', 7, 5, 1, 1150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(205, 'CXT BamBoo Black', 'CXT BamBoo Black 13%', 4, 2, 1, 450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(206, 'CXT Playboy đỏ', 'CXT Playboy đỏ', 4, 2, 1, 250000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(207, 'BCS Boss H3', 'BCS Boss hộp 3 cái, kéo dài, gân gai liti', 1, 1, 1, 40000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(208, 'DV hít tường trong suốt', 'Dv hít tường trong suốt', 7, 5, 1, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(209, 'Chip rung 10 chế độ', 'Chip rung 10 chế độ', 8, 5, 1, 870000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(210, 'Vòng đeo râu rồng', 'Vòng đeo râu rồng (Có bi hoặc ko có)', 5, 5, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(211, 'BCS gai Super Gold', 'BCS gai Super Gold', 1, 1, 1, 50000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(212, 'BCS Durex socola', 'BCS Durex socola', 1, 1, 1, 70000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(213, 'BCS Durex Dâu', 'BCS Durex Dâu', 1, 1, 1, 70000, 0, '', 1, 3, '2023-01-10 17:45:02'),
(214, 'BCS Maxman 6in1', 'BCS Maxman 6in1', 1, 1, 10, 120000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(215, 'Ống thụt rửa', 'Ống thụt rửa', 11, 5, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(216, 'Gel tảo biển Jirun', 'Gel tảo biển Jirun', 2, 2, 1, 80000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(217, 'Gel kích thích nữ Duai', 'Gel kích thích nữ Duai màu trắng', 2, 2, 1, 260000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(218, 'DV lưỡi liếm hồng', 'Dv lưỡi liếm màu hồng', 7, 5, 1, 500000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(219, 'DZ gân gai cam cao cấp', 'Đôn dên gân gai hộp màu cam cao cấp', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(220, 'DZ gân gai có đáy cao cấp', 'Đôn dên gân gai có đáy cao cấp', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(221, 'DZ vảy chùy cao cấp', 'Đôn dên có vảy, đáy có chùy cao cấp', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(222, 'DZ gai hột le cao cấp', 'Đôn dên có hạt le cao cấp', 5, 5, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(223, 'DZ thường 100k', 'Đôn dên thường 100k', 5, 5, 1, 100000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(224, 'DZ six sex', 'Đôn dên six sex hộp nhỏ', 5, 5, 1, 120000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(225, 'CD Rocket 1h', 'Cương dương và kéo dài thời gian Rocket 1 giờ', 3, 2, 10, 350000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(226, 'AD Mông LongLove', 'Âm đạo bộ mông có bông hoa Longlove', 6, 5, 1, 1150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(227, 'Chày rung X 2 đầu', 'Chày rung X 2 đầu có ngoáy', 9, 5, 1, 1450000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(228, 'DV langKyl gắn tường', 'Dương vật Langkyl rung thụt, ngụy trang, gắn tường', 7, 5, 1, 1550000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(229, 'DV đế rời INTENSE 42 độ', 'DV đế rời INTENSE 42 độ', 7, 5, 1, 1560000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(230, 'AD co bóp YULEI', 'DV tự đông co bóp YULEI', 6, 5, 1, 1650000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(231, 'AD tự động Masturbation Cup', 'AD tự động Masturbation Cup', 6, 5, 1, 1400000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(232, 'Que rung guerlain', 'Que rung guerlain', 9, 5, 1, 660000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(233, 'Gel Olo Cooling lạnh', 'Gel OLo Coling lạnh', 2, 2, 1, 90000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(234, 'Gel Olo Warming nóng', 'Gel OLo Coling nóng', 2, 2, 1, 90000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(235, 'BCS INNO H3', 'BCS INNO hộp 3 cái', 1, 1, 3, 30000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(236, 'Bọt vệ sinh nam oniiz', 'Bọt vệ sinh nam oniiz', 12, 2, 1, 150000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(237, 'BCS bi supergord', 'BCS bi supergord', 1, 1, 1, 50000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(238, 'CXT Strong men', 'Xịt kéo dài STRONG MEN', 4, 2, 1, 390000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(239, 'CXT Playboy VIP', 'Xịt playboy VIP vàng', 4, 2, 1, 270000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(240, 'Que rung Ailice', 'Que rung Ailice màu trúc khúc', 9, 5, 1, 720000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(241, 'DV Double-vibe', 'DV Double-vibe Có 3 râu', 7, 5, 1, 630000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(242, 'BCS Maxxmen 5in1 0.03mm H3', 'BCS Maxxmen 5in1 0.03mm hộp 3 cái', 1, 1, 3, 40000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(243, 'BCS Maxxmen 5in1 Prolong H3', 'BCS Maxxmen 5in1 Prolong hộp 3 cái', 1, 1, 3, 40000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(244, 'BCS Maxxmen 5in1 0.03mm H12', 'BCS Maxxmen 5in1 0.03mm hộp 12 cái', 1, 1, 12, 140000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(245, 'BCS Maxxmen 5in1 Prolong h12', 'BCS Maxxmen 5in1 Prolong hộp 12 cái', 1, 1, 12, 140000, 0, NULL, 1, 2, '2023-01-10 17:45:02'),
(246, 'BCS maxmen 0.03 ', 'bao siêu  mỏng 0.03 xuất sứ malai size 49 ,kéo dài thời gian', 1, 1, 12, 140000, 0, '', 1, 2, '2023-02-19 07:42:47'),
(247, 'KT nữ adrop', 'kick thich tăng ham muốn cho nữ', 10, 2, 1, 400000, 0, '', 1, 3, '2023-02-24 13:41:34'),
(248, 'Kt nữ D10', 'tăng ham muốn ', 10, 1, 1, 300000, 0, '', 1, 3, '2023-02-24 13:44:24'),
(249, 'DV hít tường long love', 'giống dv trong suốt , nhưng to hơn và đựng trong hộp', 7, 1, 1, 350000, 0, '', 1, 3, '2023-02-24 13:46:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `id` bigint(20) NOT NULL,
  `id_product` bigint(20) NOT NULL,
  `classify` tinyint(4) NOT NULL,
  `price_sale` bigint(20) DEFAULT NULL,
  `id_product_sale` bigint(20) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `note` text DEFAULT NULL,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sell_manage`
--

CREATE TABLE `tbl_sell_manage` (
  `id` bigint(20) NOT NULL,
  `id_product` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sale` bigint(20) DEFAULT NULL,
  `plus` bigint(20) DEFAULT NULL,
  `total` bigint(20) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_user_sell` bigint(20) NOT NULL,
  `id_brand` bigint(20) NOT NULL,
  `id_payment_status` bigint(20) NOT NULL,
  `id_from_where` bigint(20) NOT NULL,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_ad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sell_manage`
--

INSERT INTO `tbl_sell_manage` (`id`, `id_product`, `quantity`, `sale`, `plus`, `total`, `note`, `date`, `id_user`, `id_user_sell`, `id_brand`, `id_payment_status`, `id_from_where`, `created_ad`, `update_ad`) VALUES
(25, 76, 1, 0, 0, 300000, '', '2023-02-22', 6, 6, 2, 2, 5, '2023-02-25 01:58:04', NULL),
(26, 186, 1, 0, 0, 350000, '', '2023-02-22', 6, 6, 2, 1, 1, '2023-02-25 01:58:43', NULL),
(27, 98, 1, 0, 0, 350000, '', '2023-02-23', 6, 6, 2, 1, 2, '2023-02-25 02:05:23', NULL),
(28, 160, 1, 0, 0, 50000, '', '2023-02-23', 6, 6, 2, 1, 1, '2023-02-25 02:18:52', NULL),
(29, 59, 1, 0, 0, 210000, '', '2023-02-23', 6, 6, 2, 1, 1, '2023-02-25 02:19:34', NULL),
(30, 123, 1, 0, 0, 650000, '', '2023-02-23', 6, 6, 2, 2, 2, '2023-02-25 02:21:34', NULL),
(31, 233, 1, 0, 0, 90000, '', '2023-02-23', 6, 6, 2, 2, 2, '2023-02-25 02:22:07', NULL),
(33, 8, 1, 0, 0, 200000, '', '2023-02-24', 6, 6, 2, 1, 1, '2023-02-25 02:23:47', NULL),
(34, 76, 1, 0, 0, 300000, '', '2023-02-24', 6, 6, 2, 1, 1, '2023-02-25 02:24:07', NULL),
(35, 227, 1, 0, 0, 1450000, '', '2023-02-25', 6, 6, 2, 1, 2, '2023-02-25 05:48:22', NULL),
(36, 205, 1, 0, 0, 450000, '', '2023-02-22', 4, 4, 2, 2, 2, '2023-02-25 11:20:24', NULL),
(37, 185, 1, 0, 0, 100000, '', '2023-02-22', 4, 4, 2, 2, 1, '2023-02-25 11:20:53', NULL),
(38, 151, 1, 0, 0, 120000, '', '2023-02-23', 4, 4, 2, 1, 1, '2023-02-25 11:22:22', NULL),
(39, 39, 1, 0, 0, 200000, '', '2023-02-22', 4, 4, 2, 2, 1, '2023-02-25 11:23:00', NULL),
(40, 247, 1, 0, 0, 400000, '', '2023-02-24', 4, 4, 2, 2, 2, '2023-02-25 11:23:39', NULL),
(41, 159, 1, 0, 0, 250000, '', '2023-02-24', 4, 4, 2, 2, 2, '2023-02-25 11:24:08', NULL),
(42, 7, 4, 0, 0, 100000, '', '2023-02-24', 4, 4, 2, 2, 2, '2023-02-25 11:24:30', NULL),
(43, 239, 1, 0, 0, 270000, '', '2023-02-24', 4, 4, 2, 2, 2, '2023-02-25 11:24:59', NULL),
(44, 8, 1, 0, 0, 200000, '', '2023-02-24', 4, 4, 2, 2, 2, '2023-02-25 11:25:18', NULL),
(45, 87, 1, 0, 0, 500000, '', '2023-02-24', 4, 4, 2, 1, 2, '2023-02-25 11:25:52', NULL),
(46, 75, 1, 0, 0, 50000, '', '2023-02-24', 4, 4, 2, 1, 1, '2023-02-25 11:26:09', NULL),
(47, 160, 1, 0, 0, 50000, '', '2023-02-25', 4, 4, 2, 1, 1, '2023-02-25 13:19:07', NULL),
(48, 38, 1, 0, 0, 200000, '', '2023-02-25', 4, 4, 2, 1, 1, '2023-02-25 13:20:01', NULL),
(49, 173, 1, 0, 0, 100000, '', '2023-02-25', 4, 4, 2, 2, 1, '2023-02-25 13:20:22', NULL),
(50, 106, 1, 0, 0, 500000, '', '2023-02-25', 4, 4, 2, 2, 1, '2023-02-25 13:21:00', NULL),
(51, 207, 1, 0, 0, 40000, '', '2023-02-25', 4, 4, 2, 1, 1, '2023-02-25 13:21:45', NULL),
(52, 92, 1, 0, 0, 220000, '', '2023-02-22', 2, 2, 1, 1, 2, '2023-02-26 04:44:31', NULL),
(53, 56, 1, 0, 0, 230000, '', '2023-02-22', 3, 3, 1, 1, 2, '2023-02-26 04:45:08', NULL),
(54, 106, 1, 0, 0, 500000, '', '2023-02-22', 3, 3, 1, 1, 2, '2023-02-26 04:45:50', NULL),
(55, 19, 1, 0, 0, 40000, '', '2023-02-22', 3, 3, 1, 1, 2, '2023-02-26 04:46:18', NULL),
(56, 185, 1, 0, 0, 100000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:46:46', NULL),
(57, 4, 1, 0, 0, 110000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:47:59', NULL),
(58, 142, 1, 0, 0, 240000, '', '2023-02-22', 3, 3, 1, 1, 5, '2023-02-26 04:48:28', NULL),
(59, 29, 1, 0, 0, 5000, '', '2023-02-22', 3, 3, 1, 1, 4, '2023-02-26 04:49:35', NULL),
(60, 73, 1, 100000, 0, 500000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:50:56', NULL),
(61, 85, 1, 0, 0, 500000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:51:27', NULL),
(62, 23, 2, 0, 0, 300000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:51:57', NULL),
(63, 210, 1, 0, 0, 100000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:52:23', NULL),
(64, 40, 2, 0, 0, 50000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:53:16', NULL),
(65, 185, 1, 0, 0, 100000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:53:44', NULL),
(66, 40, 2, 0, 0, 50000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:54:10', NULL),
(67, 74, 1, 0, 0, 350000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:54:43', NULL),
(68, 92, 1, 0, 0, 220000, '', '2023-02-22', 3, 3, 1, 1, 1, '2023-02-26 04:55:09', NULL),
(69, 173, 1, 0, 0, 100000, '', '2023-02-23', 3, 3, 1, 1, 1, '2023-02-26 05:03:59', NULL),
(70, 74, 1, 0, 0, 350000, '', '2023-02-23', 3, 3, 1, 2, 3, '2023-02-26 05:04:34', NULL),
(71, 19, 1, 0, 0, 40000, '', '2023-02-23', 3, 3, 1, 1, 1, '2023-02-26 05:08:16', NULL),
(72, 111, 1, 0, 0, 250000, '', '2023-02-23', 3, 3, 1, 1, 1, '2023-02-26 05:08:49', NULL),
(73, 210, 3, 0, 0, 300000, '', '2023-02-23', 3, 3, 1, 2, 1, '2023-02-26 05:09:20', NULL),
(74, 83, 1, 0, 0, 350000, '', '2023-02-23', 3, 3, 1, 1, 5, '2023-02-26 05:10:32', NULL),
(75, 244, 2, 0, 0, 280000, '', '2023-02-23', 3, 3, 1, 4, 2, '2023-02-26 05:13:04', NULL),
(76, 244, 1, 0, 0, 140000, '', '2023-02-24', 3, 3, 1, 1, 2, '2023-02-26 05:13:56', NULL),
(77, 24, 10, 0, 0, 150000, '', '2023-02-24', 3, 3, 1, 1, 2, '2023-02-26 05:15:02', NULL),
(78, 24, 1, 0, 0, 0, '', '2023-02-24', 3, 3, 1, 5, 2, '2023-02-26 05:15:38', NULL),
(79, 42, 2, 0, 0, 50000, '', '2023-02-24', 3, 3, 1, 1, 3, '2023-02-26 05:16:15', NULL),
(80, 75, 2, 0, 0, 100000, '', '2023-02-24', 3, 3, 1, 1, 3, '2023-02-26 05:16:50', NULL),
(81, 85, 1, 0, 0, 500000, '', '2023-02-24', 3, 3, 1, 1, 1, '2023-02-26 05:22:34', NULL),
(82, 54, 1, 0, 0, 65000, '', '2023-02-24', 3, 3, 1, 1, 1, '2023-02-26 05:23:24', NULL),
(83, 14, 1, 0, 5000, 230000, '', '2023-02-24', 3, 3, 1, 2, 2, '2023-02-26 05:25:07', NULL),
(84, 40, 2, 0, 0, 50000, '', '2023-02-24', 3, 3, 1, 2, 1, '2023-02-26 05:25:43', NULL),
(85, 232, 1, 0, 0, 660000, '', '2023-02-24', 3, 3, 1, 2, 3, '2023-02-26 05:26:53', NULL),
(86, 22, 1, 0, 0, 55000, '', '2023-02-25', 3, 3, 1, 1, 1, '2023-02-26 05:27:56', NULL),
(87, 6, 1, 0, 0, 200000, '', '2023-02-25', 3, 3, 1, 1, 1, '2023-02-26 05:29:26', NULL),
(88, 39, 1, 0, 0, 200000, '', '2023-02-25', 3, 3, 1, 1, 1, '2023-02-26 05:30:19', NULL),
(89, 74, 1, 0, 0, 350000, '', '2023-02-25', 3, 3, 1, 1, 1, '2023-02-26 05:31:14', NULL),
(90, 75, 1, 0, 0, 0, '', '2023-02-25', 3, 3, 1, 5, 1, '2023-02-26 05:31:52', NULL),
(91, 38, 1, 0, 0, 200000, '', '2023-02-25', 3, 3, 1, 2, 1, '2023-02-26 05:32:26', NULL),
(92, 74, 1, 0, 0, 350000, '', '2023-02-25', 3, 3, 1, 2, 1, '2023-02-26 05:33:00', NULL),
(93, 75, 1, 0, 0, 0, '', '2023-02-25', 3, 3, 1, 5, 1, '2023-02-26 05:33:34', NULL),
(94, 74, 1, 0, 0, 350000, '', '2023-02-26', 3, 3, 1, 1, 1, '2023-02-26 05:34:28', NULL),
(95, 75, 1, 0, 0, 0, '', '2023-02-26', 3, 3, 1, 5, 1, '2023-02-26 05:35:33', NULL),
(96, 173, 1, 0, 0, 100000, '', '2023-02-23', 6, 6, 2, 1, 3, '2023-02-26 05:44:35', NULL),
(97, 88, 1, 0, 0, 150000, '', '2023-02-26', 6, 6, 2, 1, 2, '2023-02-26 05:50:54', NULL),
(98, 39, 1, 0, 0, 200000, '', '2023-02-26', 6, 6, 2, 1, 1, '2023-02-26 05:51:18', NULL),
(99, 44, 1, 0, 0, 200000, '', '2023-02-26', 6, 6, 2, 2, 2, '2023-02-26 09:02:40', NULL),
(100, 80, 1, 0, 0, 150000, '', '2023-02-26', 6, 6, 2, 2, 2, '2023-02-26 09:02:58', NULL),
(101, 174, 1, 15000, 0, 180000, '', '2023-02-26', 6, 6, 2, 1, 1, '2023-02-26 10:54:00', NULL),
(102, 22, 1, 0, 0, 55000, '', '2023-02-26', 4, 4, 2, 2, 2, '2023-02-26 14:01:15', NULL),
(103, 59, 1, 0, 0, 210000, 'ca minh bán', '2023-02-26', 3, 4, 1, 2, 1, '2023-02-27 01:37:35', NULL),
(104, 174, 1, 15000, 0, 180000, '', '2023-02-26', 3, 3, 1, 1, 5, '2023-02-27 01:38:30', NULL),
(105, 24, 2, 0, 0, 30000, '', '2023-02-26', 3, 3, 1, 1, 1, '2023-02-27 01:38:55', NULL),
(106, 23, 1, 0, 0, 150000, '', '2023-02-26', 3, 3, 1, 1, 1, '2023-02-27 01:39:15', NULL),
(107, 138, 1, 0, 0, 900000, 'ca minh bán', '2023-02-26', 3, 3, 1, 1, 5, '2023-02-27 01:40:12', NULL),
(108, 215, 1, 0, 0, 100000, 'ca minh bán', '2023-02-22', 3, 3, 1, 4, 8, '2023-02-27 01:42:51', NULL),
(109, 88, 1, 0, 0, 150000, 'ca minh bán', '2023-02-23', 3, 3, 1, 1, 2, '2023-02-27 01:43:34', NULL),
(110, 74, 1, 0, 0, 350000, 'ca minh bán', '2023-02-25', 3, 3, 1, 1, 1, '2023-02-27 01:44:55', NULL),
(111, 75, 1, 0, 0, 0, 'ca minh bán\r\n', '2023-02-25', 3, 3, 1, 5, 1, '2023-02-27 01:45:24', NULL),
(112, 88, 1, 0, 0, 150000, 'ca minh bán\r\n', '2023-02-25', 3, 3, 1, 1, 1, '2023-02-27 01:45:54', NULL),
(113, 203, 1, 0, 0, 1350000, '', '2023-02-27', 6, 6, 2, 2, 1, '2023-02-27 06:10:45', NULL),
(114, 62, 1, 0, 0, 110000, '', '2023-02-27', 6, 6, 2, 1, 5, '2023-02-27 10:37:30', NULL),
(115, 173, 1, 0, 0, 100000, '', '2023-02-27', 6, 6, 2, 1, 1, '2023-02-27 10:37:49', NULL),
(116, 8, 1, 0, 0, 200000, '', '2023-02-27', 6, 6, 2, 2, 1, '2023-02-27 10:38:12', NULL),
(117, 51, 2, 0, 0, 50000, '', '2023-02-27', 6, 6, 2, 2, 1, '2023-02-27 10:38:34', NULL),
(118, 44, 2, 50000, 0, 350000, '', '2023-02-27', 6, 6, 2, 2, 3, '2023-02-27 10:44:20', NULL),
(119, 221, 1, 0, 0, 150000, '', '2023-02-27', 4, 4, 2, 1, 1, '2023-02-27 11:39:34', NULL),
(120, 88, 1, 0, 0, 150000, '', '2023-02-27', 4, 4, 2, 1, 1, '2023-02-27 11:39:49', NULL),
(121, 142, 1, 0, 0, 240000, '', '2023-02-27', 3, 3, 1, 1, 2, '2023-02-27 13:28:37', NULL),
(122, 54, 1, 0, 0, 65000, '', '2023-02-27', 3, 3, 1, 1, 2, '2023-02-27 13:29:27', NULL),
(123, 44, 4, 100000, 0, 700000, '', '2023-02-27', 3, 3, 1, 1, 1, '2023-02-27 13:30:35', NULL),
(124, 213, 1, 0, 0, 70000, '', '2023-02-27', 3, 3, 1, 1, 1, '2023-02-27 13:31:34', NULL),
(125, 89, 2, 0, 0, 220000, '', '2023-02-27', 3, 3, 1, 1, 1, '2023-02-27 13:32:25', NULL),
(126, 20, 2, 0, 0, 240000, '', '2023-02-27', 3, 3, 1, 2, 5, '2023-02-27 13:33:16', NULL),
(127, 225, 1, 0, 0, 350000, 'ca minh bán', '2023-02-27', 3, 3, 1, 1, 1, '2023-02-27 13:34:51', NULL),
(128, 23, 1, 0, 0, 150000, '', '2023-02-27', 3, 3, 1, 1, 1, '2023-02-27 13:35:12', NULL),
(129, 4, 1, 0, 0, 110000, '', '2023-02-27', 3, 3, 1, 1, 1, '2023-02-27 13:36:04', NULL),
(130, 15, 1, 0, 0, 70000, '', '2023-02-27', 3, 3, 1, 2, 2, '2023-02-27 13:36:28', NULL),
(131, 24, 10, 0, 0, 150000, '', '2023-02-27', 3, 3, 1, 4, 3, '2023-02-27 13:37:22', NULL),
(132, 24, 1, 0, 0, 0, '', '2023-02-27', 3, 3, 1, 5, 3, '2023-02-27 13:37:56', NULL),
(133, 235, 1, 0, 0, 30000, '', '2023-02-27', 3, 3, 1, 1, 4, '2023-02-28 03:00:42', NULL),
(134, 58, 1, 0, 0, 170000, '', '2023-02-27', 3, 3, 1, 1, 4, '2023-02-28 03:04:12', NULL),
(136, 154, 1, 30000, 0, 170000, '', '2023-02-28', 6, 6, 2, 2, 2, '2023-02-28 06:29:24', NULL),
(137, 211, 1, 0, 0, 50000, '', '2023-02-28', 6, 6, 2, 1, 1, '2023-02-28 10:41:43', NULL),
(138, 77, 3, 0, 0, 120000, '', '2023-02-28', 4, 4, 2, 1, 1, '2023-02-28 13:04:28', NULL),
(139, 56, 1, 0, 0, 230000, '', '2023-02-28', 4, 4, 2, 1, 2, '2023-02-28 13:04:49', NULL),
(140, 210, 1, 0, 0, 100000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 13:52:33', NULL),
(141, 203, 1, 0, 0, 1350000, '', '2023-02-28', 3, 3, 1, 1, 2, '2023-02-28 13:52:48', NULL),
(142, 93, 1, 0, 0, 90000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 13:53:07', NULL),
(143, 24, 1, 0, 0, 15000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 13:53:26', NULL),
(144, 238, 1, 0, 0, 390000, '', '2023-02-28', 3, 3, 1, 4, 2, '2023-02-28 13:57:44', NULL),
(145, 185, 1, 0, 0, 100000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 13:58:35', NULL),
(146, 52, 1, 0, 0, 150000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 13:58:56', NULL),
(147, 15, 1, 0, 0, 70000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 13:59:17', NULL),
(148, 213, 1, 0, 0, 70000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 13:59:40', NULL),
(149, 9, 3, 0, 0, 75000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 14:00:13', NULL),
(150, 24, 2, 0, 0, 30000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 14:00:34', NULL),
(151, 92, 1, 0, 0, 220000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 14:01:12', NULL),
(152, 211, 1, 0, 0, 50000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-02-28 14:02:15', NULL),
(153, 30, 2, 0, 0, 220000, 'khách  phúc binh phước', '2023-02-28', 3, 3, 1, 4, 2, '2023-02-28 14:03:02', NULL),
(154, 103, 1, 0, 0, 660000, '', '2023-03-01', 6, 6, 2, 2, 2, '2023-03-01 02:11:02', NULL),
(155, 80, 1, 0, 0, 150000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-03-01 02:20:38', NULL),
(156, 22, 1, 0, 0, 55000, '', '2023-02-28', 3, 3, 1, 1, 1, '2023-03-01 02:24:03', NULL),
(157, 106, 1, 0, 0, 500000, '', '2023-02-28', 4, 4, 2, 1, 2, '2023-03-01 07:13:11', NULL),
(158, 92, 1, 0, 0, 220000, '', '2023-02-28', 4, 4, 2, 2, 3, '2023-03-01 07:13:35', NULL),
(159, 92, 1, 0, 0, 220000, '', '2023-03-01', 6, 6, 2, 2, 2, '2023-03-01 07:48:21', NULL),
(160, 86, 1, 0, 0, 600000, '', '2023-03-01', 6, 6, 2, 2, 2, '2023-03-01 09:30:47', NULL),
(161, 38, 1, 0, 0, 200000, '', '2023-03-01', 6, 6, 2, 2, 3, '2023-03-01 10:37:02', NULL),
(162, 24, 5, 0, 0, 75000, '', '2023-03-01', 6, 6, 2, 2, 3, '2023-03-01 10:37:20', NULL),
(163, 102, 1, 0, 0, 450000, '', '2023-03-01', 6, 6, 2, 1, 3, '2023-03-01 11:11:08', NULL),
(164, 173, 3, 0, 0, 300000, '', '2023-03-01', 3, 3, 1, 1, 1, '2023-03-01 14:36:04', NULL),
(165, 15, 1, 0, 0, 70000, '', '2023-03-01', 3, 3, 1, 1, 1, '2023-03-01 14:36:21', NULL),
(166, 75, 2, 0, 0, 100000, '', '2023-03-01', 3, 3, 1, 1, 1, '2023-03-01 14:36:46', NULL),
(167, 89, 1, 0, 0, 110000, 'ca minh bán', '2023-03-01', 3, 3, 1, 1, 2, '2023-03-01 14:37:37', NULL),
(168, 74, 1, 0, 0, 350000, '', '2023-03-01', 3, 3, 1, 1, 1, '2023-03-01 14:38:09', NULL),
(169, 75, 1, 0, 0, 0, '', '2023-03-01', 3, 3, 1, 5, 1, '2023-03-01 14:38:33', NULL),
(170, 23, 1, 0, 0, 150000, '', '2023-03-01', 3, 3, 1, 1, 1, '2023-03-01 14:38:51', NULL),
(171, 181, 1, 0, 0, 620000, '', '2023-03-01', 3, 3, 1, 1, 1, '2023-03-01 14:39:14', NULL),
(172, 37, 1, 0, 0, 200000, 'ctv tú  nhỏ', '2023-03-01', 3, 3, 1, 2, 3, '2023-03-02 02:01:11', NULL),
(173, 86, 1, 0, 0, 600000, 'ctv tú  nhỏ', '2023-03-01', 3, 3, 1, 4, 3, '2023-03-02 02:01:37', NULL),
(174, 5, 1, 0, 0, 110000, '', '2023-03-01', 3, 3, 1, 1, 1, '2023-03-02 02:01:57', NULL),
(175, 5, 1, 0, 0, 110000, '', '2023-03-02', 6, 6, 2, 1, 1, '2023-03-02 09:05:42', NULL),
(177, 4, 1, 0, 0, 110000, '', '2023-03-02', 6, 6, 2, 1, 1, '2023-03-02 09:06:55', NULL),
(180, 20, 1, 0, 0, 120000, '', '2023-03-02', 4, 4, 2, 2, 1, '2023-03-02 12:51:16', NULL),
(181, 185, 1, 0, 0, 100000, '', '2023-03-02', 4, 4, 2, 2, 1, '2023-03-02 13:08:59', NULL),
(182, 56, 1, 0, 0, 230000, '', '2023-03-02', 3, 3, 1, 4, 5, '2023-03-02 13:55:33', NULL),
(183, 57, 1, 0, 0, 150000, '', '2023-03-02', 3, 3, 1, 1, 1, '2023-03-02 13:55:53', NULL),
(184, 74, 1, 0, 0, 350000, '', '2023-03-02', 3, 3, 1, 1, 1, '2023-03-02 13:56:10', NULL),
(185, 75, 1, 0, 0, 0, '', '2023-03-02', 3, 3, 1, 5, 1, '2023-03-02 13:56:24', NULL),
(186, 213, 1, 0, 0, 70000, '', '2023-03-02', 3, 3, 1, 2, 1, '2023-03-02 14:31:51', NULL),
(187, 23, 1, 0, 0, 150000, '', '2023-03-02', 3, 3, 1, 2, 1, '2023-03-02 14:32:12', NULL),
(188, 40, 2, 0, 0, 50000, '', '2023-03-02', 3, 3, 1, 1, 1, '2023-03-02 14:32:32', NULL),
(189, 23, 1, 0, 0, 150000, '', '2023-03-02', 3, 3, 1, 1, 1, '2023-03-02 14:32:52', NULL),
(190, 43, 2, 0, 0, 50000, '', '2023-03-02', 3, 3, 1, 1, 1, '2023-03-02 14:33:23', NULL),
(191, 125, 1, 0, 0, 1450000, '', '2023-03-02', 3, 3, 1, 2, 1, '2023-03-02 14:35:55', NULL),
(192, 23, 1, 0, 0, 150000, '', '2023-03-02', 3, 3, 1, 2, 1, '2023-03-02 14:36:15', NULL),
(193, 182, 1, 0, 0, 120000, '', '2023-03-02', 3, 3, 1, 2, 1, '2023-03-02 14:36:35', NULL),
(194, 7, 3, 0, 0, 75000, '', '2023-03-02', 3, 3, 1, 2, 1, '2023-03-02 14:36:57', NULL),
(195, 217, 1, 0, 0, 260000, '', '2023-03-02', 3, 3, 1, 2, 1, '2023-03-02 14:37:31', NULL),
(196, 65, 1, 0, 0, 0, '', '2023-03-02', 3, 3, 1, 5, 1, '2023-03-02 14:38:02', NULL),
(197, 24, 1, 0, 0, 0, '', '2023-03-02', 3, 3, 1, 5, 1, '2023-03-02 14:38:23', NULL),
(198, 54, 1, 0, 0, 0, '', '2023-03-02', 3, 3, 1, 5, 1, '2023-03-02 14:38:54', NULL),
(199, 80, 1, 0, 0, 150000, '', '2023-03-02', 4, 4, 2, 1, 1, '2023-03-02 14:52:41', NULL),
(200, 212, 1, 0, 0, 70000, '', '2023-03-03', 6, 6, 2, 1, 2, '2023-03-03 04:03:30', NULL),
(201, 206, 1, 0, 0, 250000, '', '2023-03-03', 6, 6, 2, 2, 2, '2023-03-03 09:08:14', NULL),
(202, 7, 1, 0, 0, 25000, '', '2023-03-03', 6, 6, 2, 2, 2, '2023-03-03 09:08:28', NULL),
(203, 76, 1, 20000, 0, 280000, 'giảm giá khách quen hay mua rồng nâu bán lại', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 11:26:25', NULL),
(204, 207, 1, 0, 0, 40000, 'minh bán', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 11:27:04', NULL),
(205, 171, 1, 0, 0, 150000, 'minh bán', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 11:27:25', NULL),
(206, 74, 1, 0, 0, 350000, 'minh bán', '2023-03-03', 3, 3, 1, 1, 2, '2023-03-03 11:28:07', NULL),
(207, 75, 1, 0, 0, 0, '', '2023-03-03', 3, 3, 1, 5, 2, '2023-03-03 11:28:47', NULL),
(208, 75, 3, 0, 0, 150000, 'minh bán', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 11:29:21', NULL),
(209, 92, 1, 0, 0, 220000, 'minh bán', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 11:29:56', NULL),
(210, 207, 1, 0, 0, 40000, '', '2023-03-03', 4, 4, 2, 1, 1, '2023-03-03 14:23:05', NULL),
(211, 39, 1, 0, 0, 200000, '', '2023-03-03', 4, 4, 2, 2, 2, '2023-03-03 14:23:26', NULL),
(212, 4, 1, 0, 0, 110000, '', '2023-03-03', 4, 4, 2, 1, 1, '2023-03-03 14:23:50', NULL),
(213, 38, 1, 0, 0, 200000, '', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 14:31:14', NULL),
(214, 88, 1, 0, 0, 150000, '', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 14:34:00', NULL),
(215, 40, 2, 0, 0, 50000, '', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 14:34:16', NULL),
(216, 65, 1, 0, 0, 25000, '', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 14:34:50', NULL),
(217, 33, 1, 0, 0, 90000, '', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 14:35:17', NULL),
(218, 8, 2, 50000, 0, 350000, '', '2023-03-03', 3, 3, 1, 2, 2, '2023-03-03 14:36:19', NULL),
(219, 86, 1, 0, 0, 600000, '', '2023-03-03', 3, 3, 1, 2, 2, '2023-03-03 14:36:38', NULL),
(220, 8, 1, 0, 0, 200000, '', '2023-03-03', 3, 3, 1, 1, 1, '2023-03-03 14:36:59', NULL),
(221, 19, 1, 0, 0, 40000, '', '2023-03-04', 6, 6, 2, 1, 1, '2023-03-04 03:16:36', NULL),
(222, 46, 1, 0, 0, 20000, '', '2023-03-04', 6, 6, 2, 1, 1, '2023-03-04 03:16:54', NULL),
(223, 236, 1, 0, 0, 150000, '', '2023-03-04', 6, 6, 2, 1, 1, '2023-03-04 03:17:11', NULL),
(224, 44, 1, 0, 0, 200000, '', '2023-03-04', 6, 6, 2, 1, 1, '2023-03-04 07:13:50', NULL),
(225, 174, 1, 15000, 0, 180000, '', '2023-03-04', 6, 6, 2, 2, 1, '2023-03-04 08:35:24', NULL),
(226, 39, 1, 0, 0, 200000, '', '2023-03-04', 6, 6, 2, 1, 1, '2023-03-04 09:18:35', NULL),
(227, 74, 1, 0, 0, 350000, '', '2023-03-04', 3, 3, 1, 2, 1, '2023-03-04 11:03:37', NULL),
(228, 75, 1, 0, 0, 0, '', '2023-03-04', 3, 3, 1, 5, 1, '2023-03-04 11:04:20', NULL),
(229, 4, 1, 0, 0, 110000, '', '2023-03-04', 3, 3, 1, 1, 1, '2023-03-04 11:04:44', NULL),
(230, 174, 1, 15000, 0, 180000, '', '2023-03-04', 3, 3, 1, 3, 2, '2023-03-04 11:05:07', NULL),
(231, 211, 1, 0, 0, 50000, '', '2023-03-04', 3, 3, 1, 3, 2, '2023-03-04 11:05:28', NULL),
(232, 164, 1, 0, 0, 150000, '', '2023-03-04', 3, 3, 1, 1, 3, '2023-03-04 11:05:56', NULL),
(233, 24, 1, 0, 0, 15000, '', '2023-03-04', 3, 3, 1, 1, 3, '2023-03-04 11:06:51', NULL),
(234, 38, 1, 0, 0, 200000, '', '2023-03-04', 3, 3, 1, 3, 3, '2023-03-04 11:07:28', NULL),
(235, 43, 2, 0, 0, 50000, '', '2023-03-04', 3, 3, 1, 2, 1, '2023-03-04 11:08:38', NULL),
(239, 92, 1, 0, 0, 220000, '', '2023-03-04', 3, 3, 1, 1, 5, '2023-03-05 02:27:31', NULL),
(240, 206, 1, 0, 0, 250000, 'tú nhỏ bán', '2023-03-04', 3, 3, 1, 1, 1, '2023-03-05 02:28:05', NULL),
(241, 247, 1, 0, 0, 400000, '', '2023-03-04', 3, 3, 1, 2, 2, '2023-03-05 02:28:33', NULL),
(242, 224, 1, 0, 0, 120000, '', '2023-03-04', 3, 3, 1, 2, 2, '2023-03-05 02:28:56', NULL),
(243, 23, 1, 0, 0, 150000, 'tú nhỏ bán', '2023-03-04', 3, 3, 1, 1, 1, '2023-03-05 02:29:27', NULL),
(244, 238, 1, 0, 0, 390000, '', '2023-03-04', 3, 3, 2, 2, 2, '2023-03-05 02:35:06', NULL),
(245, 22, 1, 0, 0, 55000, '', '2023-03-04', 3, 3, 2, 2, 1, '2023-03-05 02:35:37', NULL),
(246, 37, 1, 0, 0, 200000, '', '2023-03-04', 3, 3, 2, 1, 3, '2023-03-05 02:36:08', NULL),
(247, 245, 1, 0, 0, 140000, '', '2023-03-04', 3, 3, 2, 1, 1, '2023-03-05 02:36:34', NULL),
(248, 39, 1, 0, 0, 200000, '', '2023-03-04', 3, 3, 2, 2, 1, '2023-03-05 02:37:15', NULL),
(252, 24, 20, 0, 0, 300000, '', '2023-03-05', 6, 6, 2, 2, 3, '2023-03-05 10:56:26', NULL),
(253, 24, 2, 0, 0, 0, '', '2023-03-05', 6, 6, 2, 5, 3, '2023-03-05 10:56:43', NULL),
(254, 243, 1, 0, 0, 40000, '', '2023-03-05', 6, 6, 2, 1, 2, '2023-03-05 10:57:21', NULL),
(255, 21, 1, 0, 0, 120000, '', '2023-03-05', 3, 3, 1, 1, 1, '2023-03-05 14:03:59', NULL),
(256, 206, 1, 0, 0, 250000, '', '2023-03-05', 3, 3, 1, 4, 3, '2023-03-05 14:04:49', NULL),
(257, 112, 1, 30000, 0, 320000, '', '2023-03-05', 3, 3, 1, 4, 8, '2023-03-05 14:05:52', NULL),
(258, 174, 2, 30000, 0, 360000, '', '2023-03-05', 3, 3, 1, 2, 3, '2023-03-05 14:07:29', NULL),
(259, 74, 1, 0, 0, 350000, '', '2023-03-05', 3, 3, 1, 2, 3, '2023-03-05 14:08:12', NULL),
(260, 75, 1, 0, 0, 0, '', '2023-03-05', 3, 3, 1, 5, 3, '2023-03-05 14:08:46', NULL),
(261, 53, 1, 0, 0, 130000, '', '2023-03-05', 3, 3, 1, 3, 2, '2023-03-05 14:09:33', NULL),
(262, 23, 1, 0, 0, 150000, '', '2023-03-05', 3, 3, 1, 1, 1, '2023-03-05 14:10:01', NULL),
(263, 22, 1, 0, 0, 55000, '', '2023-03-05', 3, 3, 1, 1, 1, '2023-03-05 14:10:28', NULL),
(264, 171, 1, 0, 0, 150000, '', '2023-03-05', 3, 3, 1, 1, 1, '2023-03-05 14:10:55', NULL),
(265, 75, 1, 0, 0, 50000, '', '2023-03-05', 3, 3, 1, 1, 1, '2023-03-05 14:29:30', NULL),
(266, 3, 1, 0, 10000, 100000, '', '2023-03-05', 3, 3, 1, 1, 1, '2023-03-05 14:30:06', NULL),
(267, 92, 1, 0, 0, 220000, '', '2023-03-05', 3, 3, 1, 2, 1, '2023-03-06 01:31:30', NULL),
(268, 92, 1, 0, 0, 220000, '', '2023-03-05', 3, 3, 1, 1, 1, '2023-03-06 01:31:48', NULL),
(269, 186, 1, 0, 0, 350000, '', '2023-03-06', 6, 6, 2, 1, 2, '2023-03-06 09:52:37', NULL),
(270, 9, 4, 0, 0, 100000, '', '2023-03-06', 6, 6, 2, 1, 1, '2023-03-06 09:53:01', NULL),
(271, 14, 1, 0, 0, 230000, '', '2023-03-06', 4, 4, 2, 1, 1, '2023-03-06 13:04:23', NULL),
(272, 173, 1, 0, 0, 100000, '', '2023-03-06', 4, 4, 2, 1, 1, '2023-03-06 13:53:16', NULL),
(273, 205, 1, 0, 0, 450000, '', '2023-03-06', 4, 4, 2, 1, 1, '2023-03-06 13:55:03', NULL),
(274, 22, 1, 0, 0, 55000, '', '2023-03-06', 4, 4, 2, 1, 1, '2023-03-06 13:55:18', NULL),
(275, 38, 1, 0, 0, 200000, '', '2023-03-07', 6, 6, 2, 2, 2, '2023-03-07 01:20:04', NULL),
(276, 22, 1, 0, 0, 55000, '', '2023-03-07', 6, 6, 2, 2, 2, '2023-03-07 01:20:24', NULL),
(277, 88, 1, 0, 0, 150000, '', '2023-03-06', 3, 3, 1, 1, 1, '2023-03-07 01:58:46', NULL),
(278, 23, 1, 0, 0, 150000, '', '2023-03-06', 3, 3, 1, 1, 2, '2023-03-07 01:59:08', NULL),
(279, 172, 1, 0, 0, 350000, '', '2023-03-06', 3, 3, 1, 4, 3, '2023-03-07 01:59:49', NULL),
(280, 88, 1, 0, 0, 150000, '', '2023-03-07', 6, 6, 2, 2, 1, '2023-03-07 04:47:24', NULL),
(281, 15, 1, 0, 0, 70000, '', '2023-03-07', 6, 6, 2, 2, 1, '2023-03-07 04:47:42', NULL),
(282, 206, 1, 0, 0, 250000, '', '2023-03-07', 6, 6, 2, 1, 2, '2023-03-07 08:30:29', NULL),
(283, 132, 1, 0, 0, 850000, '', '2023-03-07', 3, 3, 1, 4, 2, '2023-03-07 14:35:05', NULL),
(284, 27, 1, 0, 0, 140000, 'ca minh bán', '2023-03-07', 3, 3, 1, 2, 2, '2023-03-07 14:35:27', NULL),
(285, 174, 1, 0, 0, 195000, 'ca minh bán', '2023-03-07', 3, 3, 1, 1, 1, '2023-03-07 14:35:48', NULL),
(286, 83, 1, 0, 0, 350000, 'ca minh bán', '2023-03-07', 3, 3, 1, 2, 2, '2023-03-07 14:36:11', NULL),
(287, 237, 1, 0, 0, 50000, 'ca minh bán', '2023-03-07', 3, 3, 1, 1, 1, '2023-03-07 14:37:14', NULL),
(288, 23, 1, 0, 0, 150000, 'ca minh bán', '2023-03-07', 3, 3, 1, 1, 1, '2023-03-07 14:38:01', NULL),
(289, 38, 1, 0, 0, 200000, '', '2023-03-07', 3, 3, 1, 1, 1, '2023-03-07 14:38:31', NULL),
(290, 88, 1, 0, 0, 150000, '', '2023-03-07', 3, 3, 1, 2, 1, '2023-03-07 14:38:53', NULL),
(291, 22, 1, 0, 0, 55000, '', '2023-03-07', 3, 3, 1, 2, 1, '2023-03-07 14:39:50', NULL),
(292, 88, 1, 0, 0, 150000, '', '2023-03-07', 3, 3, 1, 1, 1, '2023-03-07 14:40:19', NULL),
(293, 207, 1, 0, 0, 40000, '', '2023-03-07', 3, 3, 1, 1, 1, '2023-03-07 14:40:53', NULL),
(294, 33, 1, 0, 0, 90000, '', '2023-03-07', 4, 4, 2, 1, 1, '2023-03-07 15:32:26', NULL),
(295, 174, 1, 0, 0, 195000, '', '2023-03-07', 4, 4, 2, 2, 5, '2023-03-07 15:33:14', NULL),
(296, 85, 1, 0, 0, 500000, '', '2023-03-07', 4, 4, 2, 2, 5, '2023-03-07 15:33:33', NULL),
(297, 92, 1, 0, 0, 220000, '', '2023-03-08', 6, 6, 2, 1, 1, '2023-03-08 04:50:34', NULL),
(298, 74, 1, 0, 0, 350000, '', '2023-03-08', 6, 6, 2, 2, 2, '2023-03-08 07:23:57', NULL),
(299, 39, 1, 0, 0, 200000, '', '2023-03-08', 6, 6, 2, 1, 1, '2023-03-08 08:26:16', NULL),
(300, 92, 1, 0, 0, 220000, '', '2023-03-08', 6, 6, 2, 2, 2, '2023-03-08 08:26:31', NULL),
(301, 186, 1, 0, 0, 350000, '', '2023-03-08', 6, 6, 2, 2, 2, '2023-03-08 08:26:50', NULL),
(302, 173, 1, 0, 0, 100000, '', '2023-03-08', 6, 6, 2, 1, 1, '2023-03-08 09:10:23', NULL),
(303, 51, 1, 0, 0, 25000, '', '2023-03-08', 6, 6, 2, 1, 1, '2023-03-08 09:10:42', NULL),
(304, 24, 1, 0, 0, 15000, '', '2023-03-08', 6, 6, 2, 1, 1, '2023-03-08 09:10:56', NULL),
(305, 76, 1, 0, 0, 300000, '', '2023-03-08', 3, 3, 1, 1, 1, '2023-03-08 14:09:35', NULL),
(306, 45, 1, 0, 0, 170000, '', '2023-03-08', 3, 3, 1, 1, 4, '2023-03-08 14:10:36', NULL),
(307, 89, 1, 0, 0, 110000, '', '2023-03-08', 3, 3, 1, 1, 1, '2023-03-08 14:10:52', NULL),
(308, 171, 1, 0, 0, 150000, '', '2023-03-08', 3, 3, 1, 1, 2, '2023-03-08 14:12:12', NULL),
(309, 173, 1, 0, 0, 100000, '', '2023-03-08', 4, 4, 2, 1, 1, '2023-03-08 14:35:16', NULL),
(310, 93, 1, 0, 0, 90000, '', '2023-03-08', 4, 4, 2, 1, 1, '2023-03-08 14:35:30', NULL),
(311, 92, 1, 0, 0, 220000, '', '2023-03-08', 4, 4, 2, 1, 1, '2023-03-08 14:35:59', NULL),
(312, 75, 2, 0, 0, 100000, '', '2023-03-08', 4, 4, 2, 1, 1, '2023-03-08 14:36:11', NULL),
(313, 212, 1, 0, 0, 70000, '', '2023-03-08', 4, 4, 2, 1, 1, '2023-03-08 14:36:31', NULL),
(314, 75, 1, 0, 0, 50000, '', '2023-03-08', 3, 3, 1, 1, 1, '2023-03-09 01:54:20', NULL),
(315, 210, 1, 0, 0, 100000, '', '2023-03-09', 6, 6, 2, 1, 1, '2023-03-09 08:43:27', NULL),
(316, 173, 1, 0, 0, 100000, '', '2023-03-09', 6, 6, 2, 1, 5, '2023-03-09 08:43:45', NULL),
(317, 211, 1, 0, 0, 50000, '', '2023-03-09', 6, 6, 2, 1, 5, '2023-03-09 08:44:14', NULL),
(318, 38, 1, 0, 0, 200000, '', '2023-03-09', 6, 6, 2, 1, 5, '2023-03-09 08:44:30', NULL),
(319, 64, 1, 0, 0, 100000, '', '2023-03-09', 6, 6, 2, 2, 1, '2023-03-09 10:44:37', NULL),
(320, 23, 1, 0, 0, 150000, '', '2023-03-03', 6, 6, 2, 2, 4, '2023-03-09 11:49:56', NULL),
(321, 171, 1, 0, 0, 150000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:10:32', NULL),
(322, 40, 2, 0, 0, 50000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:11:01', NULL),
(323, 92, 1, 0, 0, 220000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:11:21', NULL),
(324, 173, 3, 0, 0, 300000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:11:47', NULL),
(325, 80, 1, 0, 0, 150000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:12:03', NULL),
(326, 39, 1, 0, 0, 200000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:12:27', NULL),
(327, 182, 1, 0, 0, 120000, '', '2023-03-09', 3, 3, 1, 2, 2, '2023-03-09 14:12:47', NULL),
(328, 211, 1, 0, 0, 50000, '', '2023-03-09', 3, 3, 1, 2, 2, '2023-03-09 14:13:19', NULL),
(329, 174, 1, 0, 0, 195000, '', '2023-03-09', 3, 3, 1, 2, 2, '2023-03-09 14:13:38', NULL),
(330, 44, 1, 0, 0, 200000, '', '2023-03-09', 3, 3, 1, 2, 2, '2023-03-09 14:13:58', NULL),
(331, 153, 1, 0, 0, 150000, '', '2023-03-09', 3, 3, 1, 1, 2, '2023-03-09 14:14:18', NULL),
(332, 23, 1, 0, 0, 150000, 'ca minh bán', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:14:58', NULL),
(333, 75, 1, 0, 0, 50000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:15:22', NULL),
(334, 75, 5, 70000, 0, 180000, '', '2023-03-09', 3, 3, 1, 2, 2, '2023-03-09 14:16:03', NULL),
(335, 24, 10, 0, 0, 150000, '', '2023-03-09', 3, 3, 1, 4, 3, '2023-03-09 14:16:43', NULL),
(336, 86, 1, 0, 0, 600000, '', '2023-03-09', 3, 3, 1, 4, 3, '2023-03-09 14:17:06', NULL),
(337, 182, 1, 0, 0, 120000, '', '2023-03-09', 3, 3, 1, 4, 2, '2023-03-09 14:17:41', NULL),
(338, 60, 1, 10000, 0, 100000, '', '2023-03-09', 3, 3, 1, 4, 2, '2023-03-09 14:18:04', NULL),
(339, 75, 1, 0, 0, 50000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:18:28', NULL),
(340, 24, 2, 0, 0, 30000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:18:45', NULL),
(341, 47, 1, 0, 0, 20000, '', '2023-03-09', 3, 3, 1, 1, 1, '2023-03-09 14:19:12', NULL),
(342, 44, 1, 0, 0, 200000, '', '2023-03-09', 3, 3, 1, 3, 3, '2023-03-09 14:19:42', NULL),
(343, 121, 1, 0, 0, 700000, '', '2023-03-09', 3, 3, 1, 4, 8, '2023-03-09 14:20:27', NULL),
(344, 23, 1, 0, 0, 150000, '', '2023-03-09', 4, 4, 2, 2, 3, '2023-03-09 14:47:11', NULL),
(345, 27, 1, 0, 0, 140000, '', '2023-03-09', 4, 4, 2, 2, 3, '2023-03-09 14:47:31', NULL),
(346, 24, 1, 0, 0, 15000, '', '2023-03-09', 4, 4, 2, 2, 3, '2023-03-09 14:47:53', NULL),
(347, 20, 1, 0, 0, 120000, '', '2023-03-09', 4, 4, 2, 2, 1, '2023-03-09 14:49:01', NULL),
(348, 160, 2, 0, 0, 100000, '', '2023-03-09', 4, 4, 2, 1, 4, '2023-03-09 14:49:44', NULL),
(349, 42, 2, 0, 0, 50000, '', '2023-03-09', 4, 4, 2, 1, 1, '2023-03-09 14:50:14', NULL),
(350, 38, 1, 0, 0, 200000, '', '2023-03-09', 4, 4, 2, 1, 1, '2023-03-09 14:50:34', NULL),
(351, 37, 1, 50000, 0, 150000, '', '2023-03-09', 4, 4, 2, 1, 1, '2023-03-09 14:52:07', NULL),
(352, 65, 2, 0, 0, 50000, '', '2023-03-09', 3, 3, 1, 1, 2, '2023-03-10 01:28:53', NULL),
(353, 234, 1, 0, 0, 90000, '', '2023-03-09', 3, 3, 1, 1, 2, '2023-03-10 01:29:31', NULL),
(354, 23, 3, 0, 0, 450000, '', '2023-03-10', 6, 6, 2, 2, 3, '2023-03-10 06:22:22', NULL),
(355, 119, 1, 0, 0, 500000, '', '2023-03-10', 6, 6, 2, 1, 3, '2023-03-10 06:22:37', NULL),
(356, 237, 1, 0, 0, 50000, '', '2023-03-10', 6, 6, 2, 2, 3, '2023-03-10 07:10:01', NULL),
(357, 65, 2, 0, 0, 50000, '', '2023-03-10', 6, 6, 2, 2, 3, '2023-03-10 07:10:22', NULL),
(358, 162, 1, 0, 0, 150000, '', '2023-03-10', 6, 6, 2, 2, 2, '2023-03-10 07:10:39', NULL),
(359, 147, 1, 0, 0, 800000, '', '2023-03-10', 6, 6, 2, 2, 5, '2023-03-10 07:12:29', NULL),
(360, 80, 1, 0, 0, 150000, '', '2023-03-10', 6, 6, 2, 4, 5, '2023-03-10 09:42:20', NULL),
(361, 86, 1, 0, 0, 600000, '', '2023-03-10', 6, 6, 2, 4, 5, '2023-03-10 09:42:35', NULL),
(362, 213, 1, 0, 0, 70000, '', '2023-03-10', 3, 3, 1, 2, 1, '2023-03-10 14:43:35', NULL),
(363, 19, 1, 0, 0, 40000, '', '2023-03-10', 3, 3, 1, 2, 1, '2023-03-10 14:43:50', NULL),
(364, 206, 1, 10000, 0, 240000, '', '2023-03-10', 3, 3, 1, 2, 5, '2023-03-10 14:44:17', NULL),
(365, 23, 1, 0, 0, 150000, '', '2023-03-10', 3, 3, 1, 4, 3, '2023-03-10 14:44:45', NULL),
(366, 75, 5, 50000, 0, 200000, '', '2023-03-10', 3, 3, 1, 4, 3, '2023-03-10 14:45:17', NULL),
(367, 74, 1, 0, 0, 350000, '', '2023-03-10', 3, 3, 1, 1, 1, '2023-03-10 14:45:38', NULL),
(368, 27, 1, 0, 0, 140000, '', '2023-03-10', 3, 3, 1, 3, 2, '2023-03-10 14:46:32', NULL),
(369, 225, 1, 0, 0, 350000, '', '2023-03-10', 3, 3, 1, 3, 2, '2023-03-10 14:47:03', NULL),
(370, 238, 1, 0, 0, 390000, '', '2023-03-10', 3, 3, 1, 3, 2, '2023-03-10 14:47:32', NULL),
(371, 160, 1, 0, 0, 50000, '', '2023-03-10', 3, 3, 1, 3, 2, '2023-03-10 14:47:50', NULL),
(372, 92, 1, 0, 0, 220000, 'ca minh bán', '2023-03-10', 3, 3, 1, 1, 2, '2023-03-10 14:48:20', NULL),
(373, 239, 1, 0, 0, 270000, '', '2023-03-10', 3, 3, 1, 1, 3, '2023-03-10 14:48:45', NULL),
(374, 167, 1, 0, 0, 300000, 'ca minh bán', '2023-03-10', 3, 3, 1, 1, 1, '2023-03-10 14:49:46', NULL),
(375, 24, 2, 0, 0, 30000, 'ca minh bán', '2023-03-10', 3, 3, 1, 1, 1, '2023-03-10 14:50:20', NULL),
(376, 111, 1, 0, 0, 250000, 'ca minh bán', '2023-03-10', 3, 3, 1, 1, 1, '2023-03-10 14:50:44', NULL),
(377, 75, 1, 0, 0, 50000, '', '2023-03-10', 3, 3, 1, 1, 1, '2023-03-10 14:51:05', NULL),
(378, 59, 1, 0, 0, 210000, '', '2023-03-10', 3, 3, 1, 2, 1, '2023-03-10 14:51:23', NULL),
(379, 239, 1, 0, 0, 270000, 'ca minh bán', '2023-03-10', 3, 3, 1, 1, 2, '2023-03-10 14:51:50', NULL),
(380, 42, 1, 0, 0, 25000, 'ca minh bán', '2023-03-10', 3, 3, 1, 1, 2, '2023-03-10 14:52:10', NULL),
(381, 24, 4, 0, 0, 60000, '', '2023-03-10', 3, 3, 1, 1, 1, '2023-03-10 14:52:29', NULL),
(382, 47, 1, 0, 0, 20000, '', '2023-03-10', 3, 3, 1, 1, 1, '2023-03-10 14:52:52', NULL),
(383, 87, 1, 0, 0, 500000, '', '2023-03-10', 3, 3, 1, 1, 2, '2023-03-10 14:53:09', NULL),
(384, 51, 3, 0, 0, 75000, '', '2023-03-11', 6, 6, 2, 2, 1, '2023-03-11 07:50:35', NULL),
(385, 40, 2, 0, 0, 50000, '', '2023-03-11', 6, 6, 2, 2, 1, '2023-03-11 07:50:53', NULL),
(386, 217, 1, 0, 0, 260000, '', '2023-03-11', 6, 6, 2, 2, 1, '2023-03-11 07:51:05', NULL),
(387, 151, 1, 0, 0, 120000, '', '2023-03-11', 6, 6, 2, 1, 1, '2023-03-11 07:53:59', NULL),
(388, 40, 3, 0, 0, 75000, '', '2023-03-11', 3, 3, 1, 1, 1, '2023-03-11 14:02:05', NULL),
(389, 60, 1, 0, 0, 110000, '', '2023-03-11', 3, 3, 1, 3, 2, '2023-03-11 14:07:03', NULL),
(390, 92, 1, 0, 0, 220000, '', '2023-03-11', 3, 3, 1, 1, 1, '2023-03-11 14:07:23', NULL),
(391, 174, 1, 0, 0, 195000, '', '2023-03-11', 3, 3, 1, 2, 5, '2023-03-11 14:07:45', NULL),
(392, 9, 2, 0, 0, 50000, 'ca minh bán', '2023-03-11', 3, 3, 1, 1, 1, '2023-03-11 14:08:11', NULL),
(393, 230, 1, 0, 0, 1650000, '', '2023-03-11', 3, 3, 1, 1, 1, '2023-03-11 14:08:35', NULL),
(394, 54, 1, 0, 0, 0, '', '2023-03-11', 3, 3, 1, 5, 1, '2023-03-11 14:08:58', NULL),
(395, 173, 1, 0, 0, 100000, 'ca minh bán', '2023-03-11', 3, 3, 1, 1, 1, '2023-03-11 14:09:19', NULL),
(396, 119, 1, 0, 0, 500000, 'ca minh bán', '2023-03-11', 3, 3, 1, 1, 2, '2023-03-11 14:09:41', NULL),
(397, 75, 1, 0, 0, 50000, '', '2023-03-11', 3, 3, 1, 1, 1, '2023-03-11 14:10:01', NULL),
(398, 23, 1, 0, 0, 150000, '', '2023-03-11', 3, 3, 1, 1, 2, '2023-03-11 14:10:16', NULL),
(399, 9, 2, 0, 0, 50000, '', '2023-03-11', 3, 3, 1, 1, 1, '2023-03-11 14:11:23', NULL),
(400, 51, 2, 0, 0, 50000, '', '2023-03-11', 3, 3, 1, 1, 1, '2023-03-11 14:11:43', NULL),
(401, 85, 1, 0, 0, 500000, '', '2023-03-12', 6, 6, 2, 1, 1, '2023-03-12 09:04:44', NULL),
(402, 207, 1, 0, 0, 40000, '', '2023-03-12', 4, 4, 2, 1, 2, '2023-03-12 13:35:32', NULL),
(403, 120, 1, 0, 0, 450000, '', '2023-03-11', 4, 4, 2, 2, 2, '2023-03-12 13:36:25', NULL),
(404, 174, 1, 0, 0, 195000, '', '2023-03-11', 4, 4, 2, 1, 5, '2023-03-12 13:36:42', NULL),
(405, 8, 1, 0, 0, 200000, '', '2023-03-11', 4, 4, 2, 2, 1, '2023-03-12 13:37:14', NULL),
(406, 8, 1, 0, 0, 200000, '', '2023-03-11', 4, 4, 2, 1, 1, '2023-03-12 13:37:30', NULL),
(407, 75, 5, 50000, 0, 200000, '', '2023-03-12', 3, 3, 1, 1, 1, '2023-03-12 14:14:26', NULL),
(408, 173, 2, 0, 0, 200000, '', '2023-03-12', 3, 3, 1, 1, 1, '2023-03-12 14:14:44', NULL),
(409, 40, 5, 0, 0, 125000, '', '2023-03-12', 3, 3, 1, 1, 5, '2023-03-12 14:16:07', NULL),
(410, 182, 1, 0, 0, 120000, '', '2023-03-12', 3, 3, 1, 1, 5, '2023-03-12 14:16:42', NULL),
(411, 24, 5, 0, 0, 75000, '', '2023-03-12', 3, 3, 1, 1, 5, '2023-03-12 14:19:00', NULL),
(412, 173, 1, 0, 0, 100000, '', '2023-03-12', 3, 3, 1, 1, 1, '2023-03-12 14:19:23', NULL),
(413, 23, 2, 0, 0, 300000, '', '2023-03-12', 3, 3, 1, 2, 2, '2023-03-12 14:22:33', NULL),
(414, 86, 1, 0, 0, 600000, '', '2023-03-12', 3, 3, 1, 2, 4, '2023-03-12 14:22:51', NULL),
(415, 87, 1, 0, 0, 500000, '', '2023-03-12', 4, 4, 2, 1, 1, '2023-03-12 14:23:52', NULL),
(416, 247, 1, 0, 0, 400000, '', '2023-03-12', 3, 3, 1, 1, 1, '2023-03-12 14:24:13', NULL),
(417, 75, 1, 0, 0, 50000, '', '2023-03-12', 3, 3, 1, 1, 1, '2023-03-12 14:31:11', NULL),
(418, 77, 1, 0, 0, 40000, '', '2023-03-12', 3, 3, 1, 1, 1, '2023-03-12 14:31:32', NULL),
(419, 247, 1, 0, 0, 400000, '', '2023-03-12', 3, 3, 1, 1, 2, '2023-03-12 14:33:53', NULL),
(420, 228, 1, 0, 0, 1550000, '', '2023-03-13', 6, 6, 2, 2, 3, '2023-03-13 02:32:27', NULL),
(422, 174, 1, 0, 0, 195000, '', '2023-03-13', 6, 6, 2, 2, 2, '2023-03-13 09:53:16', NULL),
(423, 24, 2, 0, 0, 30000, '', '2023-03-13', 6, 6, 2, 2, 2, '2023-03-13 09:53:37', NULL),
(424, 40, 4, 0, 0, 100000, '', '2023-03-13', 6, 6, 2, 2, 2, '2023-03-13 09:54:00', NULL),
(425, 211, 1, 0, 0, 50000, '', '2023-03-13', 6, 6, 2, 1, 1, '2023-03-13 09:54:19', NULL),
(426, 47, 2, 0, 0, 40000, '', '2023-03-13', 6, 6, 2, 1, 1, '2023-03-13 09:54:39', NULL),
(427, 54, 1, 0, 0, 0, 'Đơn số 1', '2023-03-13', 6, 6, 2, 5, 3, '2023-03-13 09:59:07', NULL),
(428, 206, 1, 0, 0, 250000, '', '2023-03-13', 6, 6, 2, 1, 2, '2023-03-13 10:07:13', NULL),
(429, 92, 1, 0, 0, 220000, '', '2023-03-13', 6, 6, 2, 1, 1, '2023-03-13 10:07:31', NULL),
(430, 173, 1, 0, 0, 100000, '', '2023-03-13', 6, 6, 2, 1, 1, '2023-03-13 10:07:53', NULL),
(431, 173, 1, 0, 0, 100000, '', '2023-03-13', 6, 6, 2, 1, 5, '2023-03-13 10:08:06', NULL),
(432, 87, 1, 0, 0, 500000, '', '2023-03-13', 6, 6, 2, 2, 2, '2023-03-13 10:08:27', NULL),
(433, 6, 1, 25000, 0, 175000, '', '2023-03-13', 6, 6, 2, 2, 2, '2023-03-13 10:08:50', NULL),
(434, 44, 1, 25000, 0, 175000, '', '2023-03-13', 6, 6, 2, 2, 2, '2023-03-13 10:09:15', NULL),
(435, 185, 2, 0, 0, 200000, '', '2023-03-13', 4, 4, 2, 1, 1, '2023-03-13 12:42:42', NULL),
(436, 150, 1, 0, 0, 100000, '', '2023-03-13', 4, 4, 2, 2, 2, '2023-03-13 12:43:10', NULL),
(437, 47, 2, 0, 0, 40000, '', '2023-03-13', 4, 4, 2, 2, 2, '2023-03-13 12:43:22', NULL),
(438, 242, 1, 0, 0, 40000, '', '2023-03-13', 4, 4, 2, 2, 2, '2023-03-13 12:43:41', NULL),
(439, 149, 1, 0, 0, 880000, '', '2023-03-13', 3, 3, 1, 2, 2, '2023-03-13 13:12:56', NULL),
(440, 75, 1, 0, 0, 50000, '', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:13:16', NULL),
(441, 140, 1, 0, 0, 700000, '', '2023-03-13', 3, 3, 1, 3, 2, '2023-03-13 13:13:44', NULL),
(442, 108, 1, 0, 0, 600000, '', '2023-03-13', 3, 3, 1, 2, 2, '2023-03-13 13:14:04', NULL),
(443, 221, 1, 0, 0, 150000, 'ca minh bán', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:15:10', NULL),
(444, 65, 4, 0, 0, 100000, 'ca minh bán', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:15:47', NULL),
(445, 20, 1, 0, 0, 120000, 'ca minh bán', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:16:39', NULL),
(447, 64, 1, 0, 0, 100000, 'ca minh bán', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:25:16', NULL),
(448, 65, 3, 0, 0, 75000, 'ca minh bán', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:25:40', NULL),
(449, 40, 2, 0, 0, 50000, 'ca minh bán', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:26:14', NULL),
(450, 76, 1, 0, 0, 300000, '', '2023-03-13', 3, 3, 1, 2, 2, '2023-03-13 13:26:34', NULL),
(451, 241, 1, 30000, 0, 600000, '', '2023-03-13', 3, 3, 1, 3, 2, '2023-03-13 13:27:13', NULL),
(452, 23, 1, 0, 0, 150000, '', '2023-03-13', 3, 3, 1, 3, 2, '2023-03-13 13:27:40', NULL),
(453, 235, 1, 0, 0, 30000, '', '2023-03-13', 3, 3, 1, 2, 2, '2023-03-13 13:28:25', NULL),
(454, 206, 1, 0, 0, 250000, '', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:28:42', NULL),
(455, 173, 1, 0, 0, 100000, '', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:29:00', NULL),
(456, 173, 1, 0, 0, 100000, '', '2023-03-13', 3, 3, 1, 1, 1, '2023-03-13 13:58:12', NULL),
(457, 174, 1, 0, 0, 195000, '', '2023-03-13', 3, 3, 1, 2, 5, '2023-03-13 14:34:29', NULL),
(458, 65, 4, 0, 0, 100000, '', '2023-03-13', 3, 3, 1, 3, 2, '2023-03-14 01:47:56', NULL),
(459, 162, 1, 0, 0, 150000, '', '2023-03-07', 6, 6, 2, 2, 1, '2023-03-14 08:42:32', NULL),
(460, 13, 1, 0, 0, 70000, '', '2023-03-07', 6, 6, 2, 1, 1, '2023-03-14 09:10:57', NULL),
(461, 92, 1, 0, 0, 220000, '', '2023-03-14', 4, 4, 2, 2, 1, '2023-03-14 12:50:07', NULL),
(462, 85, 1, 0, 0, 500000, '', '2023-03-14', 3, 3, 1, 3, 2, '2023-03-14 14:31:35', NULL),
(463, 189, 1, 0, 0, 820000, '', '2023-03-14', 3, 3, 1, 2, 1, '2023-03-14 14:32:00', NULL),
(464, 54, 1, 0, 0, 65000, '', '2023-03-14', 3, 3, 1, 2, 1, '2023-03-14 14:32:22', NULL),
(465, 236, 1, 0, 0, 150000, '', '2023-03-14', 3, 3, 1, 4, 8, '2023-03-14 14:32:51', NULL),
(466, 54, 1, 0, 0, 65000, '', '2023-03-14', 3, 3, 1, 4, 8, '2023-03-14 14:33:34', NULL),
(467, 249, 1, 0, 0, 350000, '', '2023-03-14', 3, 3, 1, 4, 8, '2023-03-14 14:33:55', NULL),
(468, 74, 1, 0, 0, 350000, '', '2023-03-14', 3, 3, 1, 2, 3, '2023-03-14 14:34:32', NULL),
(469, 92, 1, 0, 0, 220000, '', '2023-03-14', 3, 3, 1, 1, 1, '2023-03-14 14:34:53', NULL),
(470, 22, 1, 0, 0, 55000, '', '2023-03-14', 3, 3, 1, 1, 1, '2023-03-14 14:35:16', NULL),
(471, 88, 1, 0, 0, 150000, '', '2023-03-14', 3, 3, 1, 1, 1, '2023-03-14 14:35:34', NULL),
(472, 47, 1, 0, 0, 20000, '', '2023-03-14', 3, 3, 1, 1, 1, '2023-03-14 14:35:57', NULL),
(473, 24, 1, 0, 0, 15000, '', '2023-03-14', 3, 3, 1, 1, 1, '2023-03-14 14:36:17', NULL),
(474, 56, 1, 0, 0, 230000, '', '2023-03-14', 3, 3, 1, 2, 1, '2023-03-14 14:36:42', NULL),
(475, 74, 1, 0, 0, 350000, '', '2023-03-14', 3, 3, 1, 1, 1, '2023-03-14 14:36:58', NULL),
(476, 207, 1, 0, 0, 40000, '', '2023-03-14', 4, 4, 2, 1, 1, '2023-03-14 14:44:36', NULL),
(477, 210, 1, 0, 0, 100000, '', '2023-03-15', 6, 6, 2, 2, 1, '2023-03-15 10:26:03', NULL),
(478, 24, 10, 0, 0, 150000, '', '2023-03-15', 6, 6, 2, 1, 3, '2023-03-15 10:26:34', NULL),
(479, 85, 1, 0, 0, 500000, '', '2023-03-15', 6, 6, 2, 1, 3, '2023-03-15 10:26:48', NULL),
(480, 74, 1, 0, 0, 350000, '', '2023-03-15', 6, 6, 2, 1, 1, '2023-03-15 10:27:09', NULL),
(481, 8, 1, 0, 0, 200000, '', '2023-03-15', 6, 6, 2, 1, 1, '2023-03-15 10:27:23', NULL),
(482, 247, 1, 0, 0, 400000, '', '2023-03-15', 6, 6, 2, 2, 2, '2023-03-15 10:27:40', NULL),
(483, 211, 1, 0, 0, 50000, '', '2023-03-15', 6, 6, 2, 2, 2, '2023-03-15 10:27:57', NULL),
(484, 88, 1, 0, 0, 150000, '', '2023-03-15', 6, 6, 2, 1, 3, '2023-03-15 10:28:13', NULL),
(485, 73, 1, 100000, 0, 500000, '', '2023-03-15', 4, 4, 2, 1, 1, '2023-03-15 14:42:19', NULL),
(486, 182, 1, 0, 0, 120000, '', '2023-03-15', 3, 3, 1, 2, 5, '2023-03-15 14:43:16', NULL),
(487, 85, 1, 0, 0, 500000, '', '2023-03-15', 3, 3, 1, 1, 3, '2023-03-15 14:43:38', NULL),
(488, 92, 1, 0, 0, 220000, '', '2023-03-15', 3, 3, 1, 1, 5, '2023-03-15 14:44:05', NULL),
(489, 239, 1, 0, 0, 270000, '', '2023-03-15', 3, 3, 1, 1, 5, '2023-03-15 14:44:44', NULL),
(490, 173, 1, 0, 0, 100000, '', '2023-03-15', 3, 3, 1, 1, 1, '2023-03-15 14:45:04', NULL),
(491, 38, 1, 25000, 0, 175000, '', '2023-03-15', 3, 3, 1, 1, 1, '2023-03-15 14:45:52', NULL),
(492, 6, 1, 25000, 0, 175000, '', '2023-03-15', 3, 3, 1, 1, 1, '2023-03-15 14:46:37', NULL),
(493, 15, 1, 0, 0, 70000, '', '2023-03-15', 3, 3, 1, 1, 1, '2023-03-15 14:46:57', NULL),
(494, 172, 1, 0, 0, 350000, '', '2023-03-16', 6, 6, 2, 1, 1, '2023-03-16 06:35:15', NULL),
(495, 65, 2, 0, 0, 50000, '', '2023-03-16', 6, 6, 2, 1, 1, '2023-03-16 06:35:34', NULL),
(496, 248, 1, 0, 0, 300000, 'Combo ', '2023-03-16', 6, 6, 2, 2, 2, '2023-03-16 06:35:51', NULL),
(497, 75, 2, 60000, 0, 40000, 'Combo', '2023-03-16', 6, 6, 2, 2, 2, '2023-03-16 06:36:11', NULL),
(498, 74, 1, 0, 0, 350000, '', '2023-03-16', 6, 6, 2, 1, 2, '2023-03-16 07:43:38', NULL),
(499, 3, 1, 0, 10000, 100000, '', '2023-03-16', 6, 6, 2, 1, 1, '2023-03-16 09:00:31', NULL),
(500, 74, 1, 0, 0, 350000, '', '2023-03-16', 6, 6, 2, 2, 2, '2023-03-16 09:01:05', NULL),
(501, 39, 1, 0, 0, 200000, '', '2023-03-16', 6, 6, 2, 2, 2, '2023-03-16 09:01:22', NULL),
(502, 210, 1, 0, 0, 100000, '', '2023-03-16', 6, 6, 2, 2, 4, '2023-03-16 09:01:44', NULL),
(503, 59, 1, 0, 0, 210000, '', '2023-03-16', 4, 4, 2, 2, 3, '2023-03-16 14:13:37', NULL),
(504, 69, 1, 0, 0, 140000, '', '2023-03-16', 4, 4, 2, 1, 1, '2023-03-16 14:13:54', NULL),
(505, 38, 2, 50000, 0, 350000, '', '2023-03-16', 3, 3, 1, 1, 1, '2023-03-16 14:47:16', NULL),
(506, 185, 1, 0, 0, 100000, '', '2023-03-16', 3, 3, 1, 2, 2, '2023-03-16 14:47:49', NULL),
(507, 85, 1, 0, 0, 500000, '', '2023-03-16', 3, 3, 1, 3, 2, '2023-03-16 14:48:39', NULL),
(508, 182, 1, 0, 0, 120000, '', '2023-03-16', 3, 3, 1, 3, 2, '2023-03-16 14:49:12', NULL),
(509, 22, 1, 0, 0, 55000, '', '2023-03-16', 3, 3, 1, 2, 1, '2023-03-16 14:49:34', NULL),
(510, 20, 1, 0, 0, 120000, '', '2023-03-16', 3, 3, 1, 1, 2, '2023-03-16 14:51:58', NULL),
(511, 239, 1, 0, 0, 270000, '', '2023-03-16', 3, 3, 1, 1, 2, '2023-03-16 14:53:32', NULL),
(512, 173, 1, 0, 0, 100000, '', '2023-03-16', 3, 3, 1, 1, 1, '2023-03-16 14:53:57', NULL),
(513, 245, 1, 0, 0, 140000, '', '2023-03-16', 3, 3, 1, 2, 3, '2023-03-16 14:54:36', NULL),
(514, 100, 1, 0, 0, 250000, '', '2023-03-16', 3, 3, 1, 1, 1, '2023-03-16 14:55:02', NULL),
(515, 85, 2, 50000, 0, 950000, '', '2023-03-16', 3, 3, 1, 1, 2, '2023-03-16 14:55:39', NULL),
(516, 27, 1, 0, 0, 140000, '', '2023-03-16', 3, 3, 1, 2, 1, '2023-03-16 14:56:12', NULL),
(517, 75, 1, 0, 0, 50000, '', '2023-03-16', 3, 3, 1, 2, 1, '2023-03-16 14:56:29', NULL),
(518, 185, 1, 0, 0, 100000, '', '2023-03-16', 3, 3, 1, 4, 3, '2023-03-16 14:56:55', NULL),
(519, 24, 5, 0, 0, 75000, '', '2023-03-16', 3, 3, 1, 4, 3, '2023-03-16 14:57:16', NULL),
(520, 74, 1, 0, 0, 350000, '', '2023-03-16', 3, 3, 1, 4, 2, '2023-03-16 14:57:34', NULL),
(521, 153, 1, 0, 0, 150000, '', '2023-03-16', 3, 3, 1, 4, 2, '2023-03-16 14:57:56', NULL),
(522, 214, 1, 0, 0, 120000, '', '2023-03-16', 3, 3, 1, 1, 1, '2023-03-16 14:58:15', NULL),
(523, 12, 1, 0, 0, 100000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 07:40:05', NULL),
(524, 173, 1, 0, 0, 100000, '', '2023-03-17', 3, 3, 1, 1, 2, '2023-03-17 07:40:24', NULL),
(525, 7, 2, 0, 0, 50000, '', '2023-03-17', 3, 3, 1, 1, 2, '2023-03-17 07:40:56', NULL),
(526, 242, 1, 0, 0, 50000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 07:42:38', NULL),
(527, 186, 1, 0, 0, 350000, 'kh đã ck 50k', '2023-03-17', 3, 3, 1, 1, 3, '2023-03-17 07:47:03', NULL),
(528, 75, 2, 60000, 0, 40000, '', '2023-03-17', 3, 3, 1, 1, 3, '2023-03-17 07:47:36', NULL),
(529, 245, 1, 0, 0, 140000, '', '2023-03-17', 3, 3, 1, 3, 3, '2023-03-17 07:47:58', NULL),
(530, 2, 1, 0, 0, 130000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 07:48:32', NULL),
(531, 22, 1, 0, 0, 55000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 07:48:47', NULL),
(532, 77, 1, 0, 0, 40000, '', '2023-03-17', 6, 6, 2, 1, 1, '2023-03-17 10:44:23', NULL),
(533, 85, 1, 0, 0, 500000, '', '2023-03-17', 6, 6, 2, 1, 2, '2023-03-17 10:44:42', NULL),
(534, 210, 1, 0, 0, 100000, '', '2023-03-17', 6, 6, 2, 1, 1, '2023-03-17 10:44:57', NULL),
(535, 44, 1, 0, 0, 200000, '', '2023-03-17', 3, 3, 1, 2, 5, '2023-03-17 14:10:23', NULL),
(536, 85, 1, 0, 0, 500000, '', '2023-03-17', 3, 3, 1, 1, 2, '2023-03-17 14:11:22', NULL),
(537, 185, 1, 0, 0, 100000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:12:49', NULL),
(538, 160, 1, 0, 0, 50000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:13:10', NULL),
(539, 75, 5, 50000, 0, 200000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:14:17', NULL),
(540, 77, 2, 0, 0, 80000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:14:35', NULL),
(541, 22, 1, 0, 0, 55000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:15:37', NULL),
(542, 93, 1, 0, 0, 90000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:16:50', NULL),
(543, 51, 2, 0, 0, 50000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:19:09', NULL),
(544, 9, 2, 0, 0, 50000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:21:11', NULL),
(545, 75, 1, 0, 0, 50000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:21:32', NULL),
(546, 237, 1, 0, 0, 50000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:21:57', NULL),
(547, 211, 1, 0, 0, 50000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:22:24', NULL),
(548, 80, 1, 0, 0, 150000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:23:01', NULL),
(549, 88, 1, 0, 0, 150000, '', '2023-03-17', 3, 3, 1, 1, 1, '2023-03-17 14:24:53', NULL),
(550, 23, 1, 0, 0, 150000, '', '2023-03-17', 3, 3, 1, 1, 2, '2023-03-17 14:37:11', NULL),
(551, 120, 1, 0, 0, 450000, '', '2023-03-17', 4, 4, 2, 1, 1, '2023-03-17 14:53:36', NULL),
(552, 64, 1, 0, 0, 100000, '', '2023-03-17', 4, 4, 2, 1, 1, '2023-03-17 14:53:50', NULL),
(553, 37, 1, 0, 0, 200000, '', '2023-03-17', 4, 4, 2, 1, 1, '2023-03-17 14:54:03', NULL),
(554, 74, 1, 0, 0, 350000, '', '2023-03-17', 4, 4, 2, 2, 2, '2023-03-17 14:54:20', NULL),
(555, 75, 3, 0, 0, 150000, '', '2023-03-17', 4, 4, 2, 2, 3, '2023-03-17 14:56:17', NULL),
(556, 74, 2, 0, 0, 700000, '', '2023-03-18', 6, 6, 2, 2, 2, '2023-03-18 10:28:38', NULL),
(557, 75, 1, 0, 0, 0, '', '2023-03-18', 6, 6, 2, 5, 2, '2023-03-18 10:39:58', NULL),
(558, 247, 1, 0, 0, 400000, '', '2023-03-18', 6, 6, 2, 1, 2, '2023-03-18 10:40:15', NULL),
(559, 185, 5, 50000, 0, 450000, '', '2023-03-18', 3, 3, 1, 2, 2, '2023-03-18 10:50:02', NULL),
(560, 83, 1, 0, 0, 350000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-18 10:51:04', NULL),
(561, 65, 2, 0, 0, 50000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-18 10:51:28', NULL),
(562, 239, 1, 0, 0, 270000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-18 10:51:43', NULL),
(563, 159, 1, 0, 0, 250000, '', '2023-03-18', 3, 3, 1, 4, 2, '2023-03-18 10:52:05', NULL),
(564, 238, 1, 10000, 0, 380000, '', '2023-03-18', 3, 3, 1, 1, 2, '2023-03-18 10:52:30', NULL),
(565, 77, 3, 0, 0, 120000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-18 10:52:47', NULL),
(566, 151, 1, 0, 0, 120000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-18 10:53:02', NULL),
(567, 85, 1, 0, 0, 500000, '', '2023-03-18', 3, 3, 1, 2, 2, '2023-03-18 10:53:36', NULL),
(568, 75, 1, 0, 0, 50000, '', '2023-03-18', 3, 3, 1, 2, 2, '2023-03-18 10:53:50', NULL),
(569, 42, 1, 0, 0, 25000, '', '2023-03-18', 3, 3, 1, 2, 2, '2023-03-18 10:54:08', NULL),
(570, 7, 1, 0, 0, 25000, '', '2023-03-18', 3, 3, 1, 1, 2, '2023-03-18 10:54:26', NULL),
(571, 241, 1, 30000, 0, 600000, '', '2023-03-18', 4, 4, 2, 2, 2, '2023-03-18 14:52:33', NULL),
(572, 51, 2, 0, 0, 50000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-19 01:31:16', NULL),
(573, 181, 1, 0, 0, 620000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-19 01:31:46', NULL),
(574, 15, 1, 0, 0, 70000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-19 01:32:20', NULL),
(575, 24, 2, 0, 0, 30000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-19 01:32:53', NULL),
(576, 23, 1, 0, 0, 150000, '', '2023-03-18', 3, 3, 1, 1, 1, '2023-03-19 01:34:24', NULL),
(577, 9, 1, 0, 0, 25000, '', '2023-03-18', 3, 3, 1, 2, 2, '2023-03-19 01:38:11', NULL),
(578, 75, 5, 50000, 0, 200000, '', '2023-03-19', 6, 6, 2, 1, 2, '2023-03-19 07:17:12', NULL),
(579, 237, 1, 0, 0, 50000, '', '2023-03-19', 6, 6, 2, 2, 1, '2023-03-19 10:30:40', NULL),
(580, 9, 3, 0, 0, 75000, '', '2023-03-19', 6, 6, 2, 1, 1, '2023-03-19 10:30:57', NULL),
(581, 40, 2, 0, 0, 50000, '', '2023-03-19', 6, 6, 2, 1, 1, '2023-03-19 10:31:14', NULL),
(582, 75, 2, 0, 0, 100000, '', '2023-03-19', 3, 3, 1, 2, 1, '2023-03-20 01:32:42', NULL),
(583, 171, 1, 0, 0, 150000, '', '2023-03-19', 3, 3, 1, 3, 2, '2023-03-20 01:33:07', NULL),
(584, 75, 1, 30000, 0, 20000, '', '2023-03-19', 3, 3, 1, 3, 2, '2023-03-20 01:33:41', NULL),
(585, 154, 1, 0, 0, 200000, '', '2023-03-19', 3, 3, 1, 1, 5, '2023-03-20 01:34:33', NULL),
(586, 65, 2, 0, 0, 50000, '', '2023-03-19', 3, 3, 1, 1, 2, '2023-03-20 01:35:12', NULL),
(587, 75, 2, 0, 0, 100000, '', '2023-03-19', 3, 3, 1, 1, 1, '2023-03-20 01:35:44', NULL),
(588, 22, 1, 0, 0, 55000, '', '2023-03-19', 3, 3, 1, 1, 1, '2023-03-20 01:36:06', NULL),
(589, 74, 1, 0, 0, 350000, '', '2023-03-19', 3, 3, 1, 2, 3, '2023-03-20 01:38:50', NULL),
(590, 24, 11, 15000, 0, 150000, '', '2023-03-20', 6, 6, 2, 2, 3, '2023-03-20 07:08:08', NULL),
(591, 196, 1, 0, 0, 260000, '', '2023-03-19', 4, 4, 2, 1, 2, '2023-03-20 11:25:28', NULL),
(592, 164, 1, 0, 0, 150000, '', '2023-03-19', 4, 4, 2, 1, 2, '2023-03-20 11:26:02', NULL),
(593, 75, 1, 0, 0, 50000, '', '2023-03-19', 4, 4, 2, 1, 1, '2023-03-20 11:27:55', NULL),
(594, 167, 1, 0, 0, 300000, '', '2023-03-19', 4, 4, 2, 1, 3, '2023-03-20 11:28:26', NULL),
(595, 217, 1, 0, 0, 260000, '', '2023-03-19', 4, 4, 2, 1, 3, '2023-03-20 11:28:57', NULL),
(596, 160, 1, 0, 0, 50000, '', '2023-03-19', 4, 4, 2, 1, 3, '2023-03-20 11:29:15', NULL);
INSERT INTO `tbl_sell_manage` (`id`, `id_product`, `quantity`, `sale`, `plus`, `total`, `note`, `date`, `id_user`, `id_user_sell`, `id_brand`, `id_payment_status`, `id_from_where`, `created_ad`, `update_ad`) VALUES
(597, 197, 1, 0, 0, 1350000, '', '2023-03-19', 4, 4, 2, 2, 3, '2023-03-20 11:29:47', NULL),
(598, 172, 1, 0, 0, 350000, '', '2023-03-19', 4, 4, 2, 2, 3, '2023-03-20 11:30:21', NULL),
(599, 199, 1, 0, 0, 220000, '', '2023-03-19', 4, 4, 2, 2, 3, '2023-03-20 11:30:37', NULL),
(600, 54, 1, 65000, 0, 0, 'Tặng', '2023-03-19', 4, 4, 2, 2, 3, '2023-03-20 11:31:03', NULL),
(601, 247, 1, 0, 0, 400000, '', '2023-03-19', 4, 4, 2, 1, 3, '2023-03-20 11:31:20', NULL),
(602, 167, 1, 0, 0, 300000, '', '2023-03-19', 4, 4, 2, 1, 3, '2023-03-20 11:31:38', NULL),
(603, 123, 1, 0, 0, 650000, '', '2023-03-20', 4, 4, 2, 2, 1, '2023-03-20 11:32:01', NULL),
(604, 154, 1, 0, 0, 200000, '', '2023-03-19', 4, 4, 2, 1, 1, '2023-03-20 11:32:51', NULL),
(605, 45, 1, 0, 0, 170000, '', '2023-03-20', 4, 4, 2, 1, 1, '2023-03-20 14:47:12', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_timekeeping`
--

CREATE TABLE `tbl_timekeeping` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `morning` tinyint(4) DEFAULT 0,
  `noon` tinyint(4) DEFAULT 0,
  `afternoon` tinyint(4) DEFAULT 0,
  `evening` tinyint(4) DEFAULT 0,
  `id_brand` bigint(20) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_timekeeping`
--

INSERT INTO `tbl_timekeeping` (`id`, `date`, `morning`, `noon`, `afternoon`, `evening`, `id_brand`, `note`, `created_at`) VALUES
(29, '2023-02-23', 6, 6, 6, 4, 2, '/./././.', '2023-02-23 12:28:29'),
(31, '2023-02-22', 6, 6, 6, 4, 2, '/././.', '2023-02-23 12:35:43'),
(32, '2023-02-22', 3, 3, 4, 3, 1, '/././.', '2023-02-23 12:47:38'),
(33, '2023-02-23', 3, 3, 4, 3, 1, '/././.', '2023-02-23 12:47:44'),
(34, '2023-02-14', 3, 3, 3, 3, 1, NULL, '2023-02-23 12:55:25'),
(35, '2023-02-15', 3, 3, 4, 3, 1, NULL, '2023-02-23 12:55:25'),
(36, '2023-02-16', 3, 3, 4, 3, 1, NULL, '2023-02-23 12:57:37'),
(37, '2023-02-17', 3, 3, 4, 3, 1, NULL, '2023-02-23 12:57:37'),
(38, '2023-02-18', 3, 3, 4, 3, 1, NULL, '2023-02-23 12:57:37'),
(39, '2023-02-19', 3, 3, 4, 3, 1, NULL, '2023-02-23 12:57:37'),
(40, '2023-02-20', 3, 3, 4, 3, 1, NULL, '2023-02-23 12:57:37'),
(41, '2023-02-21', 3, 3, 4, 3, 1, NULL, '2023-02-23 12:57:37'),
(42, '2023-02-24', 3, 3, 4, 3, 1, '/././.', '2023-02-24 08:51:23'),
(43, '2023-02-24', 4, 4, 6, 4, 2, '/././.', '2023-02-24 09:02:56'),
(44, '2023-02-25', 6, 6, 6, 4, 2, '/././.', '2023-02-25 13:15:25'),
(45, '2023-02-25', 3, 3, 4, 3, 1, '/././.', '2023-02-26 02:27:16'),
(46, '2023-02-26', 3, 3, 4, 3, 1, '/././.', '2023-02-26 02:27:51'),
(47, '2023-02-26', 6, 6, 6, 4, 2, '/././.', '2023-02-26 10:54:14'),
(48, '2023-02-27', 3, 3, 4, 3, 1, '/./././.', '2023-02-27 01:47:40'),
(49, '2023-02-27', 6, 6, 6, 4, 2, '/././.', '2023-02-27 06:14:26'),
(50, '2023-02-28', 6, 6, 6, 4, 2, '/././.', '2023-02-28 10:43:09'),
(51, '2023-02-28', 3, 3, 4, 3, 1, '/././.', '2023-02-28 13:03:52'),
(52, '2023-03-01', 6, 6, 6, 4, 2, '/./././.', '2023-03-01 10:37:45'),
(53, '2023-03-01', 3, 3, 4, 3, 1, '', '2023-03-01 14:47:44'),
(54, '2023-03-02', 0, 0, 0, 4, 2, '', '2023-03-02 12:51:26'),
(55, '2023-03-02', 3, 3, 4, 3, 1, '', '2023-03-02 13:12:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_timekepping_story`
--

CREATE TABLE `tbl_timekepping_story` (
  `id` bigint(20) NOT NULL,
  `Id_timekeping` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `time` tinyint(4) NOT NULL DEFAULT 0,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `name`, `status`, `created_ad`) VALUES
(1, 'Hộp', 1, '2023-01-10 09:47:13'),
(2, 'Lọ', 1, '2023-01-10 09:47:13'),
(3, 'Vỉ', 1, '2023-01-10 09:47:13'),
(4, 'Viên', 1, '2023-01-10 09:47:13'),
(5, 'Cái', 1, '2023-01-10 09:47:13'),
(6, 'Gói', 1, '2023-01-10 09:47:13'),
(7, 'Một cặp', 1, '2023-01-10 17:33:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `power` tinyint(4) NOT NULL DEFAULT 3,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `id_brand` bigint(20) NOT NULL,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_ad` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `fullname`, `power`, `status`, `id_brand`, `created_ad`, `update_ad`) VALUES
(2, 'admin', '$2y$10$M5Y.LsvDAlr4/Zt7DdtTJ.sVIP7HWApAbYj1C7byCxKZcKLEYLJ/q', 'admin', 1, 1, 1, '2023-01-09 17:24:58', '2023-01-09 17:24:58'),
(3, 'tuto', '$2y$10$HOF4nnueQBkWB/9xNlsFyuraMKPfn0DXwRYH.VvgHRPECLVlHSd4e', 'Tú To', 2, 1, 1, '2023-01-10 02:49:01', '2023-01-10 02:49:01'),
(4, 'minh', '$2y$10$xw0jAHdXKiFnnX14AdvxS.T73a5GgnX/gJ8oWnb0yhxNKwgmeyfEu', 'Minh', 3, 1, 2, '2023-01-11 12:58:02', '2023-01-11 12:58:02'),
(5, 'tunho', '$2y$10$SKM9EnsxawMhmNV84yAMJObQgfyJPTVci6IGaENxY1pomt34Toxki', 'Tú nhỏ', 2, 1, 1, '2023-01-12 08:59:35', '2023-01-12 08:59:35'),
(6, 'quy', '$2y$10$B0UXZ9k0tuzPhIx/JEfY9.rlPxnKUrzBN3XKZfGWzJeIy3CLqSxXy', 'Quý', 3, 1, 2, '2023-01-12 08:59:55', '2023-01-12 08:59:55'),
(8, 'test', '$2y$10$xSuTfiaRRtcolKPbS/tRCODDtNQnz//KWEorRl4.SIfJn4BByZw5C', 'test', 3, 1, 1, '2023-03-18 13:35:51', '2023-03-18 13:35:51'),
(9, 'test2', '$2y$10$8fIE5PK4hXV/4waXBxTqQufqdRxrLdG/NBjG8riqwWlajkAB7ECjy', 'Tesst2', 3, 1, 2, '2023-04-14 11:58:47', '2023-04-14 11:58:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_warehouse`
--

CREATE TABLE `tbl_warehouse` (
  `id` bigint(20) NOT NULL,
  `id_product` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_brand` bigint(20) NOT NULL,
  `id_act` bigint(20) NOT NULL,
  `note` longtext DEFAULT NULL,
  `created_ad` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_ad` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_warehouse`
--

INSERT INTO `tbl_warehouse` (`id`, `id_product`, `quantity`, `id_user`, `id_brand`, `id_act`, `note`, `created_ad`, `update_ad`) VALUES
(81, 2, 5, 3, 2, 1, '', '2023-02-24 11:49:56', NULL),
(82, 3, 1, 3, 2, 1, '', '2023-02-24 11:50:39', NULL),
(83, 4, 10, 3, 2, 1, '', '2023-02-24 11:50:56', NULL),
(84, 5, 6, 3, 2, 1, '', '2023-02-24 11:51:11', NULL),
(85, 6, 8, 3, 2, 1, '', '2023-02-24 11:51:27', NULL),
(86, 7, 5, 3, 2, 1, '', '2023-02-24 11:51:42', NULL),
(87, 8, 4, 3, 2, 1, '', '2023-02-24 11:52:06', NULL),
(88, 9, 8, 3, 2, 1, '', '2023-02-24 11:52:23', NULL),
(89, 12, 2, 3, 2, 1, '', '2023-02-24 11:53:25', NULL),
(90, 13, 2, 3, 2, 1, '', '2023-02-24 11:53:42', NULL),
(91, 14, 2, 3, 2, 1, '', '2023-02-24 11:54:02', NULL),
(92, 15, 4, 3, 2, 1, '', '2023-02-24 11:54:20', '2023-02-24 11:55:05'),
(93, 16, 1, 3, 2, 1, '', '2023-02-24 11:54:36', NULL),
(94, 19, 6, 3, 2, 1, '', '2023-02-24 12:01:10', NULL),
(95, 20, 6, 3, 2, 1, '', '2023-02-24 12:02:08', NULL),
(96, 21, 2, 3, 2, 1, '', '2023-02-24 12:02:42', NULL),
(97, 22, 16, 3, 2, 1, '', '2023-02-24 12:03:08', NULL),
(98, 23, 8, 3, 2, 1, '', '2023-02-24 12:03:21', NULL),
(99, 24, 14, 3, 2, 1, '', '2023-02-24 12:03:40', NULL),
(100, 29, 42, 3, 2, 1, '', '2023-02-24 12:13:01', NULL),
(101, 30, 4, 3, 2, 1, '', '2023-02-24 12:13:22', NULL),
(102, 31, 2, 3, 2, 1, '', '2023-02-24 12:13:52', NULL),
(103, 33, 6, 3, 2, 1, '', '2023-02-24 12:14:07', NULL),
(104, 34, 2, 3, 2, 1, '', '2023-02-24 12:17:20', NULL),
(105, 37, 5, 3, 2, 1, '', '2023-02-24 12:17:42', NULL),
(106, 38, 4, 3, 2, 1, '', '2023-02-24 12:18:07', NULL),
(107, 39, 4, 3, 2, 1, '', '2023-02-24 12:18:34', '2023-02-24 12:19:10'),
(108, 42, 9, 3, 2, 1, '', '2023-02-24 12:19:42', NULL),
(109, 43, 6, 3, 2, 1, '', '2023-02-24 12:20:00', NULL),
(110, 44, 3, 3, 2, 1, '', '2023-02-24 12:20:24', NULL),
(111, 45, 3, 3, 2, 1, '', '2023-02-24 12:20:39', NULL),
(112, 46, 9, 3, 2, 1, '', '2023-02-24 12:20:53', NULL),
(113, 47, 4, 3, 2, 1, '', '2023-02-24 12:21:11', NULL),
(114, 49, 3, 3, 2, 1, '', '2023-02-24 12:21:29', NULL),
(115, 51, 7, 3, 2, 1, '', '2023-02-24 12:21:44', NULL),
(116, 54, 3, 3, 2, 1, '', '2023-02-24 12:22:01', NULL),
(117, 55, 3, 3, 2, 1, '', '2023-02-24 12:22:16', NULL),
(118, 56, 2, 3, 2, 1, '', '2023-02-24 12:22:33', NULL),
(119, 57, 2, 3, 2, 1, '', '2023-02-24 12:22:55', NULL),
(120, 58, 3, 3, 2, 1, '', '2023-02-24 12:23:11', NULL),
(121, 59, 3, 3, 2, 1, '', '2023-02-24 12:23:26', '2023-02-24 12:29:09'),
(122, 61, 2, 3, 2, 1, '', '2023-02-24 12:23:43', NULL),
(124, 63, 3, 3, 2, 1, '', '2023-02-24 12:24:09', NULL),
(125, 64, 1, 3, 2, 1, '', '2023-02-24 12:24:24', NULL),
(126, 65, 14, 3, 2, 1, '', '2023-02-24 12:24:41', NULL),
(127, 67, 1, 3, 2, 1, '', '2023-02-24 12:26:44', NULL),
(128, 69, 2, 3, 2, 1, '', '2023-02-24 12:27:08', NULL),
(129, 70, 3, 3, 2, 1, '', '2023-02-24 12:27:23', NULL),
(130, 71, 1, 3, 2, 1, '', '2023-02-24 12:27:40', NULL),
(131, 72, 1, 3, 2, 1, '', '2023-02-24 12:28:02', NULL),
(132, 73, 1, 3, 2, 1, '', '2023-02-24 12:28:20', NULL),
(133, 74, 5, 3, 2, 1, '', '2023-02-24 12:28:41', NULL),
(134, 75, 5, 3, 2, 1, '', '2023-02-24 12:29:39', NULL),
(135, 76, 3, 3, 2, 1, '', '2023-02-24 12:30:01', NULL),
(136, 77, 3, 3, 2, 1, '', '2023-02-24 12:30:22', NULL),
(137, 79, 7, 3, 2, 1, '', '2023-02-24 12:30:53', NULL),
(138, 80, 11, 3, 2, 1, '', '2023-02-24 12:31:08', NULL),
(139, 81, 1, 3, 2, 1, '', '2023-02-24 12:31:27', NULL),
(140, 82, 1, 3, 2, 1, '', '2023-02-24 12:31:41', NULL),
(141, 83, 2, 3, 2, 1, '', '2023-02-24 12:31:53', NULL),
(142, 85, 1, 3, 2, 1, '', '2023-02-24 12:32:06', NULL),
(143, 86, 4, 3, 2, 1, '', '2023-02-24 12:32:23', NULL),
(144, 87, 4, 3, 2, 1, '', '2023-02-24 12:32:39', NULL),
(145, 88, 4, 3, 2, 1, '', '2023-02-24 12:32:52', NULL),
(146, 89, 8, 3, 2, 1, '', '2023-02-24 12:33:04', NULL),
(147, 92, 2, 3, 2, 1, '', '2023-02-24 12:33:21', NULL),
(148, 93, 4, 3, 2, 1, '', '2023-02-24 12:33:33', NULL),
(149, 96, 5, 3, 2, 1, '', '2023-02-24 12:33:50', NULL),
(150, 98, 2, 3, 2, 1, '', '2023-02-24 12:34:11', '2023-02-24 12:37:25'),
(151, 99, 2, 3, 2, 1, '', '2023-02-24 12:34:29', NULL),
(152, 100, 1, 3, 2, 1, '', '2023-02-24 12:34:43', NULL),
(153, 101, 1, 3, 2, 1, '', '2023-02-24 12:35:04', NULL),
(154, 102, 1, 3, 2, 1, '', '2023-02-24 12:35:23', NULL),
(155, 103, 1, 3, 2, 1, '', '2023-02-24 12:35:40', NULL),
(156, 104, 1, 3, 2, 1, '', '2023-02-24 12:36:01', NULL),
(157, 105, 1, 3, 2, 1, '', '2023-02-24 12:36:16', NULL),
(158, 106, 2, 3, 2, 1, '', '2023-02-24 12:36:32', NULL),
(159, 108, 1, 3, 2, 1, '', '2023-02-24 12:39:39', NULL),
(160, 111, 2, 3, 2, 1, '', '2023-02-24 12:40:05', NULL),
(161, 112, 1, 3, 2, 1, '', '2023-02-24 12:40:20', NULL),
(162, 117, 1, 3, 2, 1, '', '2023-02-24 12:42:11', NULL),
(163, 119, 1, 3, 2, 1, '', '2023-02-24 12:42:29', NULL),
(164, 120, 2, 3, 2, 1, '', '2023-02-24 12:42:43', NULL),
(165, 121, 1, 3, 2, 1, '', '2023-02-24 12:43:00', NULL),
(166, 123, 1, 3, 2, 1, '', '2023-02-24 12:43:19', NULL),
(167, 125, 1, 3, 2, 1, '', '2023-02-24 12:43:35', NULL),
(168, 127, 1, 3, 2, 1, '', '2023-02-24 12:44:06', NULL),
(169, 128, 1, 3, 2, 1, '', '2023-02-24 12:44:22', NULL),
(170, 132, 1, 3, 2, 1, '', '2023-02-24 12:47:11', NULL),
(171, 135, 2, 3, 2, 1, '', '2023-02-24 12:47:36', NULL),
(172, 137, 1, 3, 2, 1, '', '2023-02-24 12:47:53', NULL),
(173, 141, 1, 3, 2, 1, '', '2023-02-24 12:48:17', NULL),
(174, 142, 3, 3, 2, 1, '', '2023-02-24 12:48:37', NULL),
(175, 146, 1, 3, 2, 1, '', '2023-02-24 12:49:10', NULL),
(176, 147, 1, 3, 2, 1, '', '2023-02-24 13:09:59', NULL),
(177, 149, 1, 3, 2, 1, '', '2023-02-24 13:11:36', NULL),
(178, 150, 3, 3, 2, 1, '', '2023-02-24 13:11:51', NULL),
(184, 152, 3, 3, 2, 1, '', '2023-02-24 13:14:02', NULL),
(186, 154, 3, 3, 2, 1, '', '2023-02-24 13:15:02', NULL),
(187, 157, 2, 3, 2, 1, '', '2023-02-24 13:16:25', NULL),
(188, 158, 2, 3, 2, 1, '', '2023-02-24 13:16:47', NULL),
(189, 159, 2, 3, 2, 1, '', '2023-02-24 13:16:58', NULL),
(190, 160, 8, 3, 2, 1, '', '2023-02-24 13:17:33', NULL),
(191, 162, 2, 3, 2, 1, '', '2023-02-24 13:17:56', NULL),
(192, 163, 2, 3, 2, 1, '', '2023-02-24 13:18:17', NULL),
(193, 164, 2, 3, 2, 1, '', '2023-02-24 13:18:40', NULL),
(195, 165, 1, 3, 2, 1, '', '2023-02-24 13:19:08', NULL),
(196, 166, 2, 3, 2, 1, '', '2023-02-24 13:19:33', NULL),
(197, 167, 4, 3, 2, 1, '', '2023-02-24 13:19:57', NULL),
(198, 171, 3, 3, 2, 1, '', '2023-02-24 13:20:14', NULL),
(199, 172, 3, 3, 2, 1, '', '2023-02-24 13:21:04', NULL),
(201, 173, 35, 3, 2, 1, '', '2023-02-24 13:21:30', NULL),
(202, 174, 2, 3, 2, 1, '', '2023-02-24 13:21:46', NULL),
(204, 176, 1, 3, 2, 1, '', '2023-02-24 13:25:12', NULL),
(205, 178, 1, 3, 2, 1, '', '2023-02-24 13:25:33', NULL),
(207, 180, 1, 3, 2, 1, '', '2023-02-24 13:26:23', NULL),
(208, 181, 1, 3, 2, 1, '', '2023-02-24 13:26:44', NULL),
(209, 182, 2, 3, 2, 1, '', '2023-02-24 13:26:56', NULL),
(210, 185, 3, 3, 2, 1, '', '2023-02-24 13:27:17', NULL),
(211, 186, 2, 3, 2, 1, '', '2023-02-24 13:27:33', NULL),
(212, 188, 3, 3, 2, 1, '', '2023-02-24 13:27:53', NULL),
(213, 190, 2, 3, 2, 1, '', '2023-02-24 13:28:15', NULL),
(214, 192, 2, 3, 2, 1, '', '2023-02-24 13:28:32', NULL),
(215, 196, 1, 3, 2, 1, '', '2023-02-24 13:28:53', NULL),
(216, 197, 1, 3, 2, 1, '', '2023-02-24 13:29:08', NULL),
(217, 199, 1, 3, 2, 1, '', '2023-02-24 13:29:21', NULL),
(218, 202, 3, 3, 2, 1, '', '2023-02-24 13:29:37', NULL),
(219, 203, 1, 3, 2, 1, '', '2023-02-24 13:29:49', NULL),
(220, 204, 1, 3, 2, 1, '', '2023-02-24 13:30:02', NULL),
(221, 205, 3, 3, 2, 1, '', '2023-02-24 13:30:18', NULL),
(222, 206, 2, 3, 2, 1, '', '2023-02-24 13:30:34', NULL),
(223, 207, 4, 3, 2, 1, '', '2023-02-24 13:30:48', NULL),
(224, 208, 2, 3, 2, 1, '', '2023-02-24 13:31:04', NULL),
(225, 210, 4, 3, 2, 1, '', '2023-02-24 13:31:21', NULL),
(226, 211, 8, 3, 2, 1, '', '2023-02-24 13:31:37', NULL),
(227, 212, 2, 3, 2, 1, '', '2023-02-24 13:31:52', NULL),
(228, 213, 3, 3, 2, 1, '', '2023-02-24 13:32:26', NULL),
(229, 214, 5, 3, 2, 1, '', '2023-02-24 13:32:49', NULL),
(230, 215, 3, 3, 2, 1, '', '2023-02-24 13:33:05', NULL),
(231, 217, 1, 3, 2, 1, '', '2023-02-24 13:33:21', NULL),
(232, 218, 1, 3, 2, 1, '', '2023-02-24 13:33:36', NULL),
(233, 219, 1, 3, 2, 1, '', '2023-02-24 13:33:59', NULL),
(234, 220, 1, 3, 2, 1, '', '2023-02-24 13:34:15', NULL),
(235, 221, 2, 3, 2, 1, '', '2023-02-24 13:34:24', NULL),
(236, 222, 2, 3, 2, 1, '', '2023-02-24 13:34:45', NULL),
(237, 223, 1, 3, 2, 1, '', '2023-02-24 13:35:00', NULL),
(238, 225, 2, 3, 2, 1, '', '2023-02-24 13:35:12', NULL),
(239, 227, 1, 3, 2, 1, '', '2023-02-24 13:35:39', NULL),
(240, 228, 1, 3, 2, 1, '', '2023-02-24 13:35:52', NULL),
(241, 230, 1, 3, 2, 1, '', '2023-02-24 13:36:06', NULL),
(242, 232, 1, 3, 2, 1, '', '2023-02-24 13:36:22', NULL),
(243, 233, 1, 3, 2, 1, '', '2023-02-24 13:36:40', NULL),
(244, 235, 5, 3, 2, 1, '', '2023-02-24 13:36:55', NULL),
(245, 236, 6, 3, 2, 1, '', '2023-02-24 13:37:08', NULL),
(246, 237, 1, 3, 2, 1, '', '2023-02-24 13:37:24', NULL),
(247, 238, 1, 3, 2, 1, '', '2023-02-24 13:37:41', NULL),
(248, 239, 1, 3, 2, 1, '', '2023-02-24 13:37:55', NULL),
(249, 240, 1, 3, 2, 1, '', '2023-02-24 13:38:16', NULL),
(250, 241, 1, 3, 2, 1, '', '2023-02-24 13:38:27', NULL),
(251, 242, 1, 3, 2, 1, '', '2023-02-24 13:39:03', NULL),
(252, 243, 1, 3, 2, 1, '', '2023-02-24 13:39:19', NULL),
(253, 244, 4, 3, 2, 1, '', '2023-02-24 13:39:54', NULL),
(254, 245, 3, 3, 2, 1, '', '2023-02-24 13:40:09', NULL),
(255, 247, 6, 3, 2, 1, '', '2023-02-24 13:47:43', NULL),
(256, 248, 4, 3, 2, 1, '', '2023-02-24 13:47:54', NULL),
(257, 249, 2, 3, 2, 1, '', '2023-02-24 13:48:11', NULL),
(258, 2, 5, 3, 2, 2, '', '2023-02-24 13:50:16', NULL),
(259, 3, 1, 3, 2, 2, '', '2023-02-24 13:50:27', NULL),
(260, 4, 10, 3, 2, 2, '', '2023-02-24 13:50:39', NULL),
(261, 5, 6, 3, 2, 2, '', '2023-02-24 13:57:14', NULL),
(262, 6, 8, 3, 2, 2, '', '2023-02-24 13:57:38', NULL),
(263, 7, 5, 3, 2, 2, '', '2023-02-24 13:57:56', NULL),
(264, 8, 4, 3, 2, 2, '', '2023-02-24 13:58:13', NULL),
(265, 9, 8, 3, 2, 2, '', '2023-02-24 13:58:29', NULL),
(266, 12, 2, 3, 2, 2, '', '2023-02-24 13:58:43', NULL),
(267, 13, 2, 3, 2, 2, '', '2023-02-24 13:58:56', NULL),
(268, 14, 2, 3, 2, 2, '', '2023-02-24 13:59:17', NULL),
(269, 15, 4, 3, 2, 2, '', '2023-02-24 13:59:34', NULL),
(270, 16, 1, 3, 2, 2, '', '2023-02-24 13:59:46', NULL),
(271, 19, 6, 3, 2, 2, '', '2023-02-24 14:00:03', NULL),
(272, 20, 6, 3, 2, 2, '', '2023-02-24 14:01:01', NULL),
(273, 21, 2, 3, 2, 2, '', '2023-02-24 14:01:15', NULL),
(274, 22, 16, 3, 2, 2, '', '2023-02-24 14:01:30', NULL),
(275, 23, 8, 3, 2, 2, '', '2023-02-24 14:01:46', NULL),
(276, 24, 14, 3, 2, 2, '', '2023-02-24 14:02:02', NULL),
(277, 25, 0, 3, 2, 2, '', '2023-02-24 14:02:17', '2023-02-24 14:04:23'),
(278, 29, 42, 3, 2, 2, '', '2023-02-24 14:02:38', NULL),
(279, 30, 4, 3, 2, 2, '', '2023-02-24 14:02:50', NULL),
(281, 25, 6, 3, 2, 1, '', '2023-02-24 14:04:43', NULL),
(282, 25, 6, 3, 2, 2, '', '2023-02-24 14:06:15', NULL),
(283, 33, 6, 3, 2, 2, '', '2023-02-24 14:06:50', NULL),
(284, 34, 2, 3, 2, 2, '', '2023-02-24 14:15:18', NULL),
(285, 37, 5, 3, 2, 2, '', '2023-02-24 14:15:32', NULL),
(286, 38, 4, 3, 2, 2, '', '2023-02-24 14:15:48', NULL),
(287, 39, 4, 3, 2, 2, '', '2023-02-24 14:16:02', '2023-02-24 14:16:23'),
(288, 42, 9, 3, 2, 2, '', '2023-02-24 14:17:05', NULL),
(289, 43, 6, 3, 2, 2, '', '2023-02-24 14:17:17', NULL),
(290, 44, 3, 3, 2, 2, '', '2023-02-24 14:17:30', NULL),
(291, 45, 3, 3, 2, 2, '', '2023-02-24 14:17:41', NULL),
(292, 46, 9, 3, 2, 2, '', '2023-02-24 14:17:51', NULL),
(293, 47, 4, 3, 2, 2, '', '2023-02-24 14:18:04', NULL),
(294, 49, 3, 3, 2, 2, '', '2023-02-24 14:18:20', NULL),
(295, 51, 7, 3, 2, 2, '', '2023-02-24 14:18:31', NULL),
(296, 54, 3, 3, 2, 2, '', '2023-02-24 14:18:48', NULL),
(297, 55, 3, 3, 2, 2, '', '2023-02-24 14:18:59', NULL),
(298, 56, 2, 3, 2, 2, '', '2023-02-24 14:19:25', NULL),
(299, 57, 2, 3, 2, 2, '', '2023-02-24 14:19:39', NULL),
(300, 58, 3, 3, 2, 2, '', '2023-02-24 14:20:08', NULL),
(301, 59, 3, 3, 2, 2, '', '2023-02-24 14:20:24', NULL),
(302, 61, 2, 3, 2, 2, '', '2023-02-24 14:20:42', NULL),
(304, 63, 3, 3, 2, 2, '', '2023-02-24 14:21:10', NULL),
(305, 64, 1, 3, 2, 2, '', '2023-02-24 14:21:23', NULL),
(306, 65, 14, 3, 2, 2, '', '2023-02-24 14:21:36', NULL),
(307, 67, 1, 3, 2, 2, '', '2023-02-24 14:21:50', NULL),
(308, 69, 2, 3, 2, 2, '', '2023-02-24 14:22:06', NULL),
(309, 70, 3, 3, 2, 2, '', '2023-02-24 14:22:22', NULL),
(310, 71, 1, 3, 2, 2, '', '2023-02-24 14:22:41', NULL),
(311, 72, 1, 3, 2, 2, '', '2023-02-24 14:22:57', NULL),
(312, 73, 1, 3, 2, 2, '', '2023-02-24 14:23:10', NULL),
(313, 74, 5, 3, 2, 2, '', '2023-02-24 14:23:24', NULL),
(314, 75, 5, 3, 2, 2, '', '2023-02-24 14:23:38', NULL),
(315, 76, 3, 3, 2, 2, '', '2023-02-24 14:23:53', NULL),
(316, 77, 3, 3, 2, 2, '', '2023-02-24 14:24:09', NULL),
(317, 79, 7, 3, 2, 2, '', '2023-02-24 14:24:20', NULL),
(318, 80, 11, 3, 2, 2, '', '2023-02-24 14:24:37', NULL),
(319, 81, 1, 3, 2, 2, '', '2023-02-24 14:24:47', NULL),
(320, 82, 1, 3, 2, 2, '', '2023-02-24 14:25:00', NULL),
(321, 83, 2, 3, 2, 2, '', '2023-02-24 14:25:15', NULL),
(322, 85, 1, 3, 2, 2, '', '2023-02-24 14:25:29', NULL),
(323, 86, 4, 3, 2, 2, '', '2023-02-24 14:25:41', NULL),
(324, 87, 4, 3, 2, 2, '', '2023-02-24 14:25:54', NULL),
(325, 88, 4, 3, 2, 2, '', '2023-02-24 14:26:06', NULL),
(326, 89, 8, 3, 2, 2, '', '2023-02-24 14:26:16', NULL),
(327, 92, 2, 3, 2, 2, '', '2023-02-24 14:26:29', NULL),
(328, 93, 4, 3, 2, 2, '', '2023-02-24 14:26:43', NULL),
(329, 96, 5, 3, 2, 2, '', '2023-02-24 14:26:56', NULL),
(330, 98, 2, 3, 2, 2, '', '2023-02-24 14:28:37', '2023-02-24 14:28:53'),
(331, 99, 2, 3, 2, 2, '', '2023-02-24 14:29:17', NULL),
(332, 100, 1, 3, 2, 2, '', '2023-02-24 14:29:31', NULL),
(333, 101, 1, 3, 2, 2, '', '2023-02-24 14:29:41', NULL),
(334, 102, 1, 3, 2, 2, '', '2023-02-24 14:29:52', NULL),
(335, 103, 1, 3, 2, 2, '', '2023-02-24 14:30:03', NULL),
(336, 104, 1, 3, 2, 2, '', '2023-02-24 14:30:17', NULL),
(337, 105, 1, 3, 2, 2, '', '2023-02-24 14:30:34', NULL),
(338, 106, 2, 3, 2, 2, '', '2023-02-24 14:30:50', NULL),
(339, 108, 1, 3, 2, 2, '', '2023-02-24 14:31:13', NULL),
(340, 111, 2, 3, 2, 2, '', '2023-02-24 14:31:29', NULL),
(341, 112, 1, 3, 2, 2, '', '2023-02-24 14:31:42', NULL),
(342, 117, 1, 3, 2, 2, '', '2023-02-24 14:31:53', NULL),
(343, 119, 1, 3, 2, 2, '', '2023-02-24 14:32:05', NULL),
(344, 120, 2, 3, 2, 2, '', '2023-02-24 14:32:27', NULL),
(345, 121, 1, 3, 2, 2, '', '2023-02-24 14:32:49', NULL),
(346, 123, 1, 3, 2, 2, '', '2023-02-24 14:33:03', NULL),
(347, 125, 1, 3, 2, 2, '', '2023-02-24 14:33:20', NULL),
(348, 127, 1, 3, 2, 2, '', '2023-02-24 14:33:41', NULL),
(349, 128, 1, 3, 2, 2, '', '2023-02-24 14:33:51', NULL),
(350, 132, 1, 3, 2, 2, '', '2023-02-24 14:34:04', NULL),
(351, 135, 2, 3, 2, 2, '', '2023-02-24 14:34:21', NULL),
(352, 137, 1, 3, 2, 2, '', '2023-02-24 14:34:56', NULL),
(353, 141, 1, 3, 2, 2, '', '2023-02-24 14:35:10', NULL),
(354, 142, 3, 3, 2, 2, '', '2023-02-24 14:35:20', NULL),
(355, 146, 1, 3, 2, 2, '', '2023-02-24 14:35:35', NULL),
(356, 147, 1, 3, 2, 2, '', '2023-02-24 14:35:48', NULL),
(357, 149, 1, 3, 2, 2, '', '2023-02-24 14:36:20', NULL),
(358, 150, 3, 3, 2, 2, '', '2023-02-24 14:36:30', NULL),
(361, 154, 3, 3, 2, 2, '', '2023-02-24 14:37:06', NULL),
(362, 157, 2, 3, 2, 2, '', '2023-02-24 14:37:32', NULL),
(363, 158, 2, 3, 2, 2, '', '2023-02-24 14:37:47', NULL),
(364, 159, 2, 3, 2, 2, '', '2023-02-24 14:38:04', NULL),
(365, 160, 8, 3, 2, 2, '', '2023-02-24 14:38:19', NULL),
(366, 162, 2, 3, 2, 2, '', '2023-02-24 14:38:34', NULL),
(367, 163, 2, 3, 2, 2, '', '2023-02-24 14:38:50', NULL),
(368, 164, 2, 3, 2, 2, '', '2023-02-24 14:39:04', NULL),
(370, 166, 2, 3, 2, 2, '', '2023-02-24 14:39:26', NULL),
(371, 167, 4, 3, 2, 2, '', '2023-02-24 14:39:49', NULL),
(372, 171, 3, 3, 2, 2, '', '2023-02-24 14:40:06', NULL),
(373, 172, 3, 3, 2, 2, '', '2023-02-24 14:40:23', NULL),
(374, 173, 35, 3, 2, 2, '', '2023-02-24 14:40:37', NULL),
(375, 174, 2, 3, 2, 2, '', '2023-02-24 14:40:48', NULL),
(376, 176, 1, 3, 2, 2, '', '2023-02-24 14:41:03', NULL),
(377, 178, 1, 3, 2, 2, '', '2023-02-24 14:41:21', NULL),
(379, 179, 2, 3, 2, 1, '', '2023-02-24 14:42:16', NULL),
(380, 179, 2, 3, 2, 2, '', '2023-02-24 14:42:58', NULL),
(381, 180, 1, 3, 2, 2, '', '2023-02-24 14:43:34', NULL),
(382, 181, 1, 3, 2, 2, '', '2023-02-24 14:43:46', NULL),
(383, 182, 2, 3, 2, 2, '', '2023-02-24 14:44:02', NULL),
(384, 185, 3, 3, 2, 2, '', '2023-02-24 14:44:19', NULL),
(385, 186, 2, 3, 2, 2, '', '2023-02-24 14:44:31', NULL),
(386, 188, 3, 3, 2, 2, '', '2023-02-24 14:44:45', NULL),
(387, 190, 2, 3, 2, 2, '', '2023-02-24 14:44:59', NULL),
(388, 192, 2, 3, 2, 2, '', '2023-02-24 14:45:16', NULL),
(389, 196, 1, 3, 2, 2, '', '2023-02-24 14:45:42', NULL),
(390, 197, 1, 3, 2, 2, '', '2023-02-24 14:45:57', NULL),
(391, 199, 1, 3, 2, 2, '', '2023-02-24 14:46:16', NULL),
(392, 202, 3, 3, 2, 2, '', '2023-02-24 14:46:31', NULL),
(393, 203, 1, 3, 2, 2, '', '2023-02-24 14:46:44', NULL),
(394, 204, 1, 3, 2, 2, '', '2023-02-24 14:46:57', NULL),
(395, 205, 3, 3, 2, 2, '', '2023-02-24 14:47:10', NULL),
(396, 206, 2, 3, 2, 2, '', '2023-02-24 14:47:23', NULL),
(397, 207, 4, 3, 2, 2, '', '2023-02-24 14:47:36', NULL),
(398, 208, 2, 3, 2, 2, '', '2023-02-24 14:47:52', NULL),
(399, 210, 4, 3, 2, 2, '', '2023-02-24 14:48:10', NULL),
(400, 211, 8, 3, 2, 2, '', '2023-02-24 14:48:32', NULL),
(401, 212, 2, 3, 2, 2, '', '2023-02-24 14:48:46', NULL),
(402, 213, 3, 3, 2, 2, '', '2023-02-24 14:49:10', NULL),
(404, 214, 5, 3, 2, 2, '', '2023-02-24 14:54:43', NULL),
(405, 215, 3, 3, 2, 2, '', '2023-02-24 14:55:28', NULL),
(406, 217, 1, 3, 2, 2, '', '2023-02-24 14:55:42', NULL),
(407, 218, 1, 3, 2, 2, '', '2023-02-24 14:55:55', NULL),
(408, 219, 1, 3, 2, 2, '', '2023-02-24 14:56:16', NULL),
(409, 220, 1, 3, 2, 2, '', '2023-02-24 14:56:28', NULL),
(410, 221, 2, 3, 2, 2, '', '2023-02-24 14:56:42', NULL),
(411, 222, 2, 3, 2, 2, '', '2023-02-24 14:56:53', NULL),
(412, 223, 1, 3, 2, 2, '', '2023-02-24 14:57:05', NULL),
(413, 225, 2, 3, 2, 2, '', '2023-02-24 14:57:17', NULL),
(414, 227, 1, 3, 2, 2, '', '2023-02-24 14:57:33', NULL),
(415, 228, 1, 3, 2, 2, '', '2023-02-24 14:57:49', NULL),
(416, 230, 1, 3, 2, 2, '', '2023-02-24 14:58:01', NULL),
(417, 232, 1, 3, 2, 2, '', '2023-02-24 14:58:13', NULL),
(418, 233, 1, 3, 2, 2, '', '2023-02-24 14:58:39', NULL),
(419, 235, 5, 3, 2, 2, '', '2023-02-24 14:58:52', NULL),
(420, 236, 6, 3, 2, 2, '', '2023-02-24 14:59:05', NULL),
(421, 237, 1, 3, 2, 2, '', '2023-02-24 14:59:17', NULL),
(422, 238, 1, 3, 2, 2, '', '2023-02-24 14:59:30', NULL),
(423, 239, 1, 3, 2, 2, '', '2023-02-24 14:59:42', NULL),
(424, 240, 1, 3, 2, 2, '', '2023-02-24 15:00:00', NULL),
(425, 241, 1, 3, 2, 2, '', '2023-02-24 15:00:09', NULL),
(426, 242, 1, 3, 2, 2, '', '2023-02-24 15:00:30', NULL),
(427, 243, 1, 3, 2, 2, '', '2023-02-24 15:00:43', NULL),
(428, 244, 4, 3, 2, 2, '', '2023-02-24 15:01:04', NULL),
(429, 245, 3, 3, 2, 2, '', '2023-02-24 15:01:19', NULL),
(430, 247, 6, 3, 2, 2, '', '2023-02-24 15:01:31', NULL),
(431, 248, 4, 3, 2, 2, '', '2023-02-24 15:01:45', NULL),
(432, 249, 2, 3, 2, 2, '', '2023-02-24 15:01:59', NULL),
(434, 62, 1, 3, 2, 1, '', '2023-02-24 15:09:15', NULL),
(435, 62, 1, 3, 2, 2, '', '2023-02-24 15:09:29', NULL),
(436, 151, 12, 3, 2, 1, '', '2023-02-24 15:13:17', NULL),
(437, 151, 12, 3, 2, 2, '', '2023-02-24 15:13:31', NULL),
(438, 152, 3, 3, 2, 2, '', '2023-02-25 01:27:58', NULL),
(439, 165, 1, 3, 2, 2, '', '2023-02-25 01:29:38', NULL),
(440, 138, 1, 3, 2, 1, '', '2023-02-25 01:49:28', NULL),
(441, 138, 1, 3, 2, 2, '', '2023-02-25 01:49:59', NULL),
(442, 6, 4, 6, 2, 1, '', '2023-02-25 09:04:15', NULL),
(443, 38, 4, 6, 2, 1, '', '2023-02-25 09:04:29', NULL),
(444, 39, 4, 6, 2, 1, '', '2023-02-25 09:04:42', NULL),
(445, 44, 4, 6, 2, 1, '', '2023-02-25 09:04:57', NULL),
(446, 6, 4, 6, 2, 2, '', '2023-02-25 09:05:13', NULL),
(447, 38, 4, 6, 2, 2, '', '2023-02-25 09:05:24', NULL),
(448, 39, 4, 6, 2, 2, '', '2023-02-25 09:05:35', NULL),
(449, 44, 4, 6, 2, 2, '', '2023-02-25 09:05:49', NULL),
(450, 38, 1, 6, 2, 3, 'Huỷ kệ xuất 10 cái lẻ ', '2023-02-25 10:14:25', NULL),
(451, 40, 10, 6, 2, 1, '', '2023-02-25 10:14:57', NULL),
(453, 40, 10, 6, 2, 2, '', '2023-02-25 10:15:57', NULL),
(454, 2, 4, 3, 1, 1, '', '2023-02-25 14:29:44', NULL),
(455, 3, 2, 3, 1, 1, '', '2023-02-25 14:29:54', NULL),
(456, 4, 4, 3, 1, 1, '', '2023-02-25 14:30:13', NULL),
(457, 5, 7, 3, 1, 1, '', '2023-02-25 14:30:28', NULL),
(458, 6, 6, 3, 1, 1, '', '2023-02-25 14:31:15', NULL),
(459, 7, 7, 3, 1, 1, '', '2023-02-25 14:31:36', NULL),
(460, 8, 18, 3, 1, 1, '', '2023-02-25 14:34:10', NULL),
(461, 9, 7, 3, 1, 1, '', '2023-02-25 14:34:32', NULL),
(462, 12, 19, 3, 1, 1, '', '2023-02-25 14:34:46', NULL),
(463, 14, 14, 3, 1, 1, '', '2023-02-25 14:44:02', NULL),
(464, 15, 7, 3, 1, 1, '', '2023-02-25 14:44:26', NULL),
(465, 16, 2, 3, 1, 1, '', '2023-02-25 14:44:58', NULL),
(466, 19, 5, 3, 1, 1, '', '2023-02-25 14:46:09', NULL),
(467, 20, 17, 3, 1, 1, '', '2023-02-25 14:46:32', NULL),
(468, 21, 2, 3, 1, 1, '', '2023-02-25 14:46:46', NULL),
(469, 22, 12, 3, 1, 1, '', '2023-02-25 14:47:04', NULL),
(470, 23, 18, 3, 1, 1, '', '2023-02-25 14:47:23', NULL),
(471, 24, 124, 3, 1, 1, '', '2023-02-25 14:47:50', NULL),
(472, 25, 14, 3, 1, 1, '', '2023-02-25 14:48:03', NULL),
(473, 29, 80, 3, 1, 1, '', '2023-02-25 14:48:46', '2023-02-26 03:19:48'),
(474, 30, 4, 3, 1, 1, '', '2023-02-25 14:49:01', NULL),
(475, 33, 20, 3, 1, 1, '', '2023-02-25 14:49:20', NULL),
(476, 34, 1, 3, 1, 1, '', '2023-02-25 14:50:12', NULL),
(477, 37, 9, 3, 1, 1, '', '2023-02-25 14:50:39', NULL),
(478, 38, 11, 3, 1, 1, '', '2023-02-25 14:50:53', NULL),
(479, 39, 4, 3, 1, 1, '', '2023-02-25 14:51:38', NULL),
(480, 40, 10, 3, 1, 1, '', '2023-02-25 14:52:52', NULL),
(481, 42, 10, 3, 1, 1, '', '2023-02-25 14:53:09', NULL),
(482, 43, 4, 3, 1, 1, '', '2023-02-25 14:53:34', NULL),
(483, 44, 7, 3, 1, 1, '', '2023-02-25 14:53:49', NULL),
(484, 45, 3, 3, 1, 1, '', '2023-02-25 14:54:26', NULL),
(485, 46, 4, 3, 1, 1, '', '2023-02-25 14:54:43', NULL),
(486, 47, 5, 3, 1, 1, '', '2023-02-25 14:55:01', NULL),
(487, 49, 10, 3, 1, 1, '', '2023-02-25 14:55:42', NULL),
(488, 50, 9, 3, 1, 1, '', '2023-02-25 14:55:58', NULL),
(489, 52, 1, 3, 1, 1, '', '2023-02-26 01:55:02', NULL),
(490, 53, 9, 3, 1, 1, '', '2023-02-26 01:55:40', NULL),
(491, 54, 19, 3, 1, 1, '', '2023-02-26 01:56:27', NULL),
(492, 55, 4, 3, 1, 1, '', '2023-02-26 01:56:42', NULL),
(493, 56, 4, 3, 1, 1, '', '2023-02-26 01:57:04', NULL),
(494, 57, 12, 3, 1, 1, '', '2023-02-26 01:57:21', NULL),
(495, 58, 7, 3, 1, 1, '', '2023-02-26 01:57:44', NULL),
(496, 59, 3, 3, 1, 1, '', '2023-02-26 01:57:58', NULL),
(497, 60, 1, 3, 1, 1, '', '2023-02-26 01:58:08', NULL),
(498, 61, 2, 3, 1, 1, '', '2023-02-26 01:58:21', NULL),
(499, 62, 1, 3, 1, 1, '', '2023-02-26 01:58:33', NULL),
(500, 63, 7, 3, 1, 1, '', '2023-02-26 01:58:46', NULL),
(501, 64, 1, 3, 1, 1, '', '2023-02-26 01:58:59', NULL),
(502, 65, 43, 3, 1, 1, '', '2023-02-26 01:59:29', NULL),
(503, 69, 2, 3, 1, 1, '', '2023-02-26 01:59:46', NULL),
(504, 70, 9, 3, 1, 1, '', '2023-02-26 02:00:31', NULL),
(505, 71, 6, 3, 1, 1, '', '2023-02-26 02:01:09', NULL),
(506, 72, 2, 3, 1, 1, '', '2023-02-26 02:01:20', NULL),
(507, 73, 2, 3, 1, 1, '', '2023-02-26 02:01:36', NULL),
(508, 74, 21, 3, 1, 1, '', '2023-02-26 02:01:54', NULL),
(509, 75, 31, 3, 1, 1, '', '2023-02-26 02:02:12', NULL),
(510, 76, 10, 3, 1, 1, '', '2023-02-26 02:02:28', NULL),
(511, 77, 6, 3, 1, 1, '', '2023-02-26 02:03:08', NULL),
(512, 79, 2, 3, 1, 1, '', '2023-02-26 02:03:34', NULL),
(513, 80, 40, 3, 1, 1, '', '2023-02-26 02:03:47', NULL),
(514, 81, 1, 3, 1, 1, '', '2023-02-26 02:04:11', NULL),
(515, 82, 1, 3, 1, 1, '', '2023-02-26 02:04:23', NULL),
(516, 83, 3, 3, 1, 1, '', '2023-02-26 02:04:35', NULL),
(517, 85, 2, 3, 1, 1, '', '2023-02-26 02:04:44', NULL),
(518, 86, 7, 3, 1, 1, '', '2023-02-26 02:05:01', NULL),
(519, 87, 3, 3, 1, 1, '', '2023-02-26 02:05:11', NULL),
(520, 88, 11, 3, 1, 1, '', '2023-02-26 02:05:33', NULL),
(521, 89, 3, 3, 1, 1, '', '2023-02-26 02:05:50', NULL),
(522, 92, 14, 3, 1, 1, '', '2023-02-26 02:06:06', NULL),
(523, 93, 22, 3, 1, 1, '', '2023-02-26 02:06:20', NULL),
(524, 96, 5, 3, 1, 1, '', '2023-02-26 02:06:36', NULL),
(525, 98, 2, 3, 1, 1, '', '2023-02-26 02:07:01', NULL),
(526, 99, 2, 3, 1, 1, '', '2023-02-26 02:07:18', NULL),
(527, 100, 2, 3, 1, 1, '', '2023-02-26 02:07:50', NULL),
(528, 101, 4, 3, 1, 1, '', '2023-02-26 02:10:51', NULL),
(529, 102, 3, 3, 1, 1, '', '2023-02-26 02:11:04', NULL),
(530, 105, 1, 3, 1, 1, '', '2023-02-26 02:11:19', NULL),
(531, 106, 5, 3, 1, 1, '', '2023-02-26 02:11:40', NULL),
(532, 108, 3, 3, 1, 1, '', '2023-02-26 02:11:51', NULL),
(533, 111, 11, 3, 1, 1, '', '2023-02-26 02:12:04', NULL),
(534, 112, 3, 3, 1, 1, '', '2023-02-26 02:12:15', NULL),
(535, 132, 5, 3, 1, 1, '', '2023-02-26 02:22:42', NULL),
(536, 117, 1, 3, 1, 1, '', '2023-02-26 02:22:57', NULL),
(537, 120, 2, 3, 1, 1, '', '2023-02-26 02:23:12', NULL),
(538, 121, 3, 3, 1, 1, '', '2023-02-26 02:23:31', NULL),
(539, 123, 2, 3, 1, 1, '', '2023-02-26 02:23:56', NULL),
(540, 124, 1, 3, 1, 1, '', '2023-02-26 02:24:12', NULL),
(541, 125, 1, 3, 1, 1, '', '2023-02-26 02:24:27', NULL),
(542, 127, 1, 3, 1, 1, '', '2023-02-26 02:24:55', NULL),
(543, 131, 1, 3, 1, 1, '', '2023-02-26 02:25:20', NULL),
(544, 135, 3, 3, 1, 1, '', '2023-02-26 02:25:44', NULL),
(545, 137, 1, 3, 1, 1, '', '2023-02-26 02:25:58', NULL),
(546, 138, 2, 3, 1, 1, '', '2023-02-26 02:26:10', NULL),
(547, 141, 1, 3, 1, 1, '', '2023-02-26 02:26:25', NULL),
(548, 142, 6, 3, 1, 1, '', '2023-02-26 02:33:49', NULL),
(549, 146, 1, 3, 1, 1, '', '2023-02-26 02:34:15', NULL),
(550, 147, 1, 3, 1, 1, '', '2023-02-26 02:34:30', NULL),
(551, 149, 1, 3, 1, 1, '', '2023-02-26 02:35:02', NULL),
(552, 150, 5, 3, 1, 1, '', '2023-02-26 02:35:17', NULL),
(553, 151, 9, 3, 1, 1, '', '2023-02-26 02:35:37', NULL),
(554, 152, 4, 3, 1, 1, '', '2023-02-26 02:35:48', NULL),
(555, 154, 4, 3, 1, 1, '', '2023-02-26 02:36:06', NULL),
(556, 155, 2, 3, 1, 1, '', '2023-02-26 02:36:23', NULL),
(557, 157, 7, 3, 1, 1, '', '2023-02-26 02:37:01', NULL),
(558, 158, 2, 3, 1, 1, '', '2023-02-26 02:37:13', NULL),
(559, 159, 3, 3, 1, 1, '', '2023-02-26 02:37:27', NULL),
(560, 160, 27, 3, 1, 1, '', '2023-02-26 02:37:41', NULL),
(561, 162, 8, 3, 1, 1, '', '2023-02-26 02:37:57', NULL),
(562, 163, 4, 3, 1, 1, '', '2023-02-26 02:38:33', NULL),
(563, 164, 1, 3, 1, 1, '', '2023-02-26 02:38:52', NULL),
(564, 165, 3, 3, 1, 1, '', '2023-02-26 02:40:07', NULL),
(565, 166, 7, 3, 1, 1, '', '2023-02-26 02:40:24', NULL),
(566, 167, 2, 3, 1, 1, '', '2023-02-26 02:40:43', NULL),
(567, 171, 15, 3, 1, 1, '', '2023-02-26 02:41:01', NULL),
(568, 172, 2, 3, 1, 1, '', '2023-02-26 02:41:19', NULL),
(569, 173, 49, 3, 1, 1, '', '2023-02-26 02:42:03', NULL),
(570, 174, 14, 3, 1, 1, '', '2023-02-26 02:42:14', NULL),
(571, 176, 2, 3, 1, 1, '', '2023-02-26 02:42:24', NULL),
(572, 177, 1, 3, 1, 1, '', '2023-02-26 02:42:47', NULL),
(573, 178, 2, 3, 1, 1, '', '2023-02-26 02:42:59', NULL),
(574, 179, 1, 3, 1, 1, '', '2023-02-26 02:43:11', NULL),
(575, 181, 1, 3, 1, 1, '', '2023-02-26 02:43:37', NULL),
(576, 182, 10, 3, 1, 1, '', '2023-02-26 02:43:52', NULL),
(577, 185, 14, 3, 1, 1, '', '2023-02-26 02:44:30', NULL),
(578, 186, 2, 3, 1, 1, '', '2023-02-26 02:46:28', NULL),
(579, 188, 3, 3, 1, 1, '', '2023-02-26 02:47:58', NULL),
(580, 189, 1, 3, 1, 1, '', '2023-02-26 02:48:10', NULL),
(581, 190, 2, 3, 1, 1, '', '2023-02-26 02:48:24', NULL),
(582, 192, 2, 3, 1, 1, '', '2023-02-26 02:48:39', NULL),
(583, 196, 2, 3, 1, 1, '', '2023-02-26 02:48:52', NULL),
(584, 197, 2, 3, 1, 1, '', '2023-02-26 02:49:09', NULL),
(585, 199, 2, 3, 1, 1, '', '2023-02-26 02:49:20', NULL),
(586, 201, 1, 3, 1, 1, '', '2023-02-26 02:49:29', NULL),
(587, 202, 10, 3, 1, 1, '', '2023-02-26 02:49:55', NULL),
(588, 203, 3, 3, 1, 1, '', '2023-02-26 02:50:07', NULL),
(589, 204, 2, 3, 1, 1, '', '2023-02-26 02:50:18', NULL),
(590, 205, 3, 3, 1, 1, '', '2023-02-26 02:50:41', NULL),
(591, 206, 5, 3, 1, 1, '', '2023-02-26 02:50:55', NULL),
(592, 207, 10, 3, 1, 1, '', '2023-02-26 02:51:10', NULL),
(593, 208, 3, 3, 1, 1, '', '2023-02-26 02:51:24', NULL),
(594, 210, 22, 3, 1, 1, '', '2023-02-26 02:51:42', NULL),
(595, 211, 20, 3, 1, 1, '', '2023-02-26 02:54:23', NULL),
(596, 213, 10, 3, 1, 1, '', '2023-02-26 02:54:43', NULL),
(597, 215, 6, 3, 1, 1, '', '2023-02-26 02:55:01', NULL),
(598, 214, 3, 3, 1, 1, '', '2023-02-26 02:58:00', NULL),
(599, 217, 2, 3, 1, 1, '', '2023-02-26 02:58:17', NULL),
(600, 220, 4, 3, 1, 1, '', '2023-02-26 02:58:33', NULL),
(601, 221, 12, 3, 1, 1, '', '2023-02-26 02:58:48', NULL),
(602, 222, 2, 3, 1, 1, '', '2023-02-26 02:58:59', NULL),
(603, 223, 1, 3, 1, 1, '', '2023-02-26 02:59:11', NULL),
(604, 224, 1, 3, 1, 1, '', '2023-02-26 02:59:23', NULL),
(605, 225, 3, 3, 1, 1, '', '2023-02-26 02:59:32', NULL),
(606, 227, 1, 3, 1, 1, '', '2023-02-26 02:59:58', NULL),
(607, 230, 2, 3, 1, 1, '', '2023-02-26 03:00:10', NULL),
(608, 232, 1, 3, 1, 1, '', '2023-02-26 03:02:09', NULL),
(609, 233, 2, 3, 1, 1, '', '2023-02-26 03:02:24', NULL),
(610, 234, 1, 3, 1, 1, '', '2023-02-26 03:02:39', NULL),
(611, 235, 20, 3, 1, 1, '', '2023-02-26 03:02:53', NULL),
(612, 236, 3, 3, 1, 1, '', '2023-02-26 03:03:04', NULL),
(613, 237, 2, 3, 1, 1, '', '2023-02-26 03:03:17', NULL),
(614, 238, 1, 3, 1, 1, '', '2023-02-26 03:03:27', NULL),
(615, 240, 1, 3, 1, 1, '', '2023-02-26 03:03:40', NULL),
(616, 241, 1, 3, 1, 1, '', '2023-02-26 03:03:51', NULL),
(617, 245, 2, 3, 1, 1, '', '2023-02-26 03:04:13', NULL),
(618, 244, 3, 3, 1, 1, '', '2023-02-26 03:04:26', NULL),
(619, 247, 6, 3, 1, 1, '', '2023-02-26 03:04:37', NULL),
(620, 248, 6, 3, 1, 1, '', '2023-02-26 03:04:48', NULL),
(621, 249, 2, 3, 1, 1, '', '2023-02-26 03:05:00', NULL),
(622, 2, 4, 3, 1, 2, '', '2023-02-26 03:11:11', NULL),
(623, 3, 2, 3, 1, 2, '', '2023-02-26 03:11:39', NULL),
(624, 4, 3, 3, 1, 2, '', '2023-02-26 03:11:46', '2023-02-26 03:12:54'),
(625, 5, 7, 3, 1, 2, '', '2023-02-26 03:11:55', '2023-02-26 03:13:12'),
(626, 6, 4, 3, 1, 2, '', '2023-02-26 03:13:50', NULL),
(627, 7, 7, 3, 1, 2, '', '2023-02-26 03:13:58', NULL),
(628, 8, 5, 3, 1, 2, '', '2023-02-26 03:14:13', NULL),
(629, 9, 7, 3, 1, 2, '', '2023-02-26 03:14:18', NULL),
(630, 12, 4, 3, 1, 2, '', '2023-02-26 03:14:32', NULL),
(631, 14, 5, 3, 1, 2, '', '2023-02-26 03:15:12', NULL),
(632, 15, 5, 3, 1, 2, '', '2023-02-26 03:15:23', NULL),
(633, 16, 2, 3, 1, 2, '', '2023-02-26 03:15:50', NULL),
(634, 19, 5, 3, 1, 2, '', '2023-02-26 03:16:06', NULL),
(635, 20, 6, 3, 1, 2, '', '2023-02-26 03:16:27', NULL),
(636, 21, 2, 3, 1, 2, '', '2023-02-26 03:16:44', NULL),
(637, 22, 12, 3, 1, 2, '', '2023-02-26 03:16:58', NULL),
(638, 23, 8, 3, 1, 2, '', '2023-02-26 03:17:08', NULL),
(639, 24, 25, 3, 1, 2, '', '2023-02-26 03:17:24', NULL),
(640, 25, 4, 3, 1, 2, '', '2023-02-26 03:17:33', NULL),
(641, 29, 80, 3, 1, 2, '', '2023-02-26 03:18:28', NULL),
(643, 30, 4, 3, 1, 2, '', '2023-02-26 03:21:09', NULL),
(644, 34, 1, 3, 1, 2, '', '2023-02-26 03:21:34', NULL),
(645, 37, 3, 3, 1, 2, '', '2023-02-26 03:21:44', NULL),
(646, 38, 3, 3, 1, 2, '', '2023-02-26 03:21:58', NULL),
(647, 39, 4, 3, 1, 2, '', '2023-02-26 03:22:09', NULL),
(648, 40, 10, 3, 1, 2, '', '2023-02-26 03:22:21', NULL),
(649, 42, 8, 3, 1, 2, '', '2023-02-26 03:22:31', NULL),
(650, 42, 2, 3, 1, 2, '', '2023-02-26 03:22:44', NULL),
(651, 43, 4, 3, 1, 2, '', '2023-02-26 03:22:58', NULL),
(652, 44, 2, 3, 1, 2, '', '2023-02-26 03:23:08', NULL),
(653, 45, 1, 3, 1, 2, '', '2023-02-26 03:23:46', NULL),
(654, 46, 4, 3, 1, 2, '', '2023-02-26 03:24:05', NULL),
(655, 47, 5, 3, 1, 2, '', '2023-02-26 03:24:23', NULL),
(656, 49, 4, 3, 1, 2, '', '2023-02-26 03:24:37', NULL),
(657, 50, 9, 3, 1, 2, '', '2023-02-26 03:24:50', NULL),
(658, 52, 1, 3, 1, 2, '', '2023-02-26 03:25:20', NULL),
(659, 53, 4, 3, 1, 2, '', '2023-02-26 03:25:35', NULL),
(660, 54, 9, 3, 1, 2, '', '2023-02-26 03:25:50', NULL),
(661, 55, 3, 3, 1, 2, '', '2023-02-26 03:28:47', NULL),
(662, 56, 2, 3, 1, 2, '', '2023-02-26 03:29:23', NULL),
(663, 57, 3, 3, 1, 2, '', '2023-02-26 03:34:41', NULL),
(664, 58, 3, 3, 1, 2, '', '2023-02-26 03:35:04', NULL),
(665, 59, 3, 3, 1, 2, '', '2023-02-26 03:35:17', NULL),
(666, 60, 1, 3, 1, 2, '', '2023-02-26 03:35:29', NULL),
(667, 61, 2, 3, 1, 2, '', '2023-02-26 03:35:43', NULL),
(668, 62, 1, 3, 1, 2, '', '2023-02-26 03:35:50', NULL),
(669, 63, 2, 3, 1, 2, '', '2023-02-26 03:36:02', NULL),
(670, 64, 1, 3, 1, 2, '', '2023-02-26 03:36:10', NULL),
(671, 65, 18, 3, 1, 2, '', '2023-02-26 03:36:25', NULL),
(672, 69, 2, 3, 1, 2, '', '2023-02-26 03:36:34', NULL),
(673, 70, 3, 3, 1, 2, '', '2023-02-26 03:36:59', NULL),
(674, 71, 1, 3, 1, 2, '', '2023-02-26 03:37:09', NULL),
(675, 72, 2, 3, 1, 2, '', '2023-02-26 03:37:26', NULL),
(676, 73, 2, 3, 1, 2, '', '2023-02-26 03:37:44', NULL),
(677, 74, 7, 3, 1, 2, '', '2023-02-26 03:37:52', NULL),
(678, 75, 31, 3, 1, 2, '', '2023-02-26 03:38:14', NULL),
(679, 76, 3, 3, 1, 2, '', '2023-02-26 03:38:24', NULL),
(680, 77, 6, 3, 1, 2, '', '2023-02-26 03:38:52', NULL),
(681, 79, 2, 3, 1, 2, '', '2023-02-26 03:39:08', NULL),
(682, 80, 10, 3, 1, 2, '', '2023-02-26 03:39:15', NULL),
(683, 81, 1, 3, 1, 2, '', '2023-02-26 03:39:26', NULL),
(684, 82, 1, 3, 1, 2, '', '2023-02-26 03:39:32', NULL),
(685, 85, 2, 3, 1, 2, '', '2023-02-26 03:40:28', NULL),
(686, 86, 3, 3, 1, 2, '', '2023-02-26 03:40:35', NULL),
(687, 87, 1, 3, 1, 2, '', '2023-02-26 03:40:43', NULL),
(688, 88, 3, 3, 1, 2, '', '2023-02-26 03:40:53', NULL),
(689, 89, 3, 3, 1, 2, '', '2023-02-26 03:41:03', NULL),
(690, 92, 4, 3, 1, 2, '', '2023-02-26 03:41:16', NULL),
(691, 93, 6, 3, 1, 2, '', '2023-02-26 03:41:24', NULL),
(692, 96, 5, 3, 1, 2, '', '2023-02-26 03:41:35', NULL),
(693, 98, 2, 3, 1, 2, '', '2023-02-26 03:41:45', NULL),
(694, 99, 2, 3, 1, 2, '', '2023-02-26 03:41:54', NULL),
(695, 100, 1, 3, 1, 2, '', '2023-02-26 03:42:04', NULL),
(696, 101, 1, 3, 1, 2, '', '2023-02-26 03:42:11', NULL),
(697, 102, 2, 3, 1, 2, '', '2023-02-26 03:42:39', NULL),
(698, 105, 1, 3, 1, 2, '', '2023-02-26 03:42:46', NULL),
(699, 106, 2, 3, 1, 2, '', '2023-02-26 03:42:57', NULL),
(700, 108, 2, 3, 1, 2, '', '2023-02-26 03:43:04', NULL),
(701, 111, 2, 3, 1, 2, '', '2023-02-26 03:43:14', NULL),
(702, 112, 2, 3, 1, 2, '', '2023-02-26 03:43:23', NULL),
(703, 132, 3, 3, 1, 2, '', '2023-02-26 03:43:32', NULL),
(704, 117, 1, 3, 1, 2, '', '2023-02-26 03:45:56', NULL),
(705, 119, 1, 3, 1, 2, '', '2023-02-26 03:46:06', NULL),
(706, 120, 2, 3, 1, 2, '', '2023-02-26 03:46:14', NULL),
(707, 121, 2, 3, 1, 2, '', '2023-02-26 03:46:23', NULL),
(708, 123, 1, 3, 1, 2, '', '2023-02-26 03:46:39', NULL),
(709, 124, 1, 3, 1, 2, '', '2023-02-26 03:46:48', NULL),
(710, 125, 1, 3, 1, 2, '', '2023-02-26 03:46:57', NULL),
(711, 127, 1, 3, 1, 2, '', '2023-02-26 03:48:05', NULL),
(712, 131, 1, 3, 1, 2, '', '2023-02-26 03:50:00', NULL),
(713, 135, 1, 3, 1, 2, '', '2023-02-26 03:50:11', NULL),
(714, 138, 1, 3, 1, 2, '', '2023-02-26 03:50:22', NULL),
(715, 142, 4, 3, 1, 2, '', '2023-02-26 03:50:31', NULL),
(716, 146, 1, 3, 1, 2, '', '2023-02-26 03:50:44', NULL),
(717, 147, 1, 3, 1, 2, '', '2023-02-26 03:50:53', NULL),
(718, 149, 1, 3, 1, 2, '', '2023-02-26 03:51:02', NULL),
(719, 150, 5, 3, 1, 2, '', '2023-02-26 03:51:09', NULL),
(720, 151, 7, 3, 1, 2, '', '2023-02-26 03:51:21', NULL),
(721, 152, 2, 3, 1, 2, '', '2023-02-26 03:53:06', NULL),
(722, 154, 4, 3, 1, 2, '', '2023-02-26 03:53:42', NULL),
(723, 155, 2, 3, 1, 2, '', '2023-02-26 03:53:55', NULL),
(724, 157, 2, 3, 1, 2, '', '2023-02-26 03:54:20', NULL),
(725, 158, 2, 3, 1, 2, '', '2023-02-26 03:54:31', NULL),
(726, 159, 3, 3, 1, 2, '', '2023-02-26 03:54:45', NULL),
(727, 160, 10, 3, 1, 2, '', '2023-02-26 03:54:54', NULL),
(728, 162, 3, 3, 1, 2, '', '2023-02-26 03:55:11', NULL),
(729, 163, 1, 3, 1, 2, '', '2023-02-26 03:55:26', NULL),
(730, 164, 1, 3, 1, 2, '', '2023-02-26 03:55:57', NULL),
(731, 165, 2, 3, 1, 2, '', '2023-02-26 03:56:13', NULL),
(732, 166, 2, 3, 1, 2, '', '2023-02-26 03:56:29', NULL),
(733, 167, 2, 3, 1, 2, '', '2023-02-26 03:56:43', NULL),
(734, 171, 9, 3, 1, 2, '', '2023-02-26 03:56:55', NULL),
(735, 172, 2, 3, 1, 2, '', '2023-02-26 03:57:12', NULL),
(736, 173, 15, 3, 1, 2, '', '2023-02-26 03:57:31', NULL),
(737, 174, 2, 3, 1, 2, '', '2023-02-26 03:57:39', NULL),
(738, 176, 2, 3, 1, 2, '', '2023-02-26 03:57:49', NULL),
(739, 177, 1, 3, 1, 2, '', '2023-02-26 03:58:06', NULL),
(740, 178, 2, 3, 1, 2, '', '2023-02-26 03:58:14', NULL),
(741, 179, 1, 3, 1, 2, '', '2023-02-26 03:58:26', NULL),
(742, 181, 1, 3, 1, 2, '', '2023-02-26 03:58:45', NULL),
(743, 182, 5, 3, 1, 2, '', '2023-02-26 03:58:57', NULL),
(744, 185, 6, 3, 1, 2, '', '2023-02-26 03:59:10', NULL),
(745, 186, 2, 3, 1, 2, '', '2023-02-26 03:59:21', NULL),
(746, 188, 3, 3, 1, 2, '', '2023-02-26 03:59:30', NULL),
(747, 189, 1, 3, 1, 2, '', '2023-02-26 03:59:49', NULL),
(748, 190, 2, 3, 1, 2, '', '2023-02-26 04:00:15', NULL),
(749, 192, 2, 3, 1, 2, '', '2023-02-26 04:00:24', NULL),
(750, 196, 2, 3, 1, 2, '', '2023-02-26 04:00:36', NULL),
(751, 197, 1, 3, 1, 2, '', '2023-02-26 04:00:49', NULL),
(752, 199, 2, 3, 1, 2, '', '2023-02-26 04:01:02', NULL),
(753, 201, 1, 3, 1, 2, '', '2023-02-26 04:01:10', NULL),
(754, 202, 1, 3, 1, 2, '', '2023-02-26 04:01:49', NULL),
(755, 203, 2, 3, 1, 2, '', '2023-02-26 04:02:01', NULL),
(756, 204, 1, 3, 1, 2, '', '2023-02-26 04:02:08', NULL),
(757, 205, 3, 3, 1, 2, '', '2023-02-26 04:02:18', NULL),
(758, 206, 2, 3, 1, 2, '', '2023-02-26 04:03:07', NULL),
(759, 207, 10, 3, 1, 2, '', '2023-02-26 04:03:45', NULL),
(760, 208, 3, 3, 1, 2, '', '2023-02-26 04:03:55', NULL),
(761, 210, 12, 3, 1, 2, '', '2023-02-26 04:04:05', NULL),
(762, 211, 8, 3, 1, 2, '', '2023-02-26 04:04:17', NULL),
(763, 213, 5, 3, 1, 2, '', '2023-02-26 04:04:33', NULL),
(764, 214, 3, 3, 1, 2, '', '2023-02-26 04:04:44', NULL),
(765, 215, 2, 3, 1, 2, '', '2023-02-26 04:05:06', NULL),
(766, 217, 2, 3, 1, 2, '', '2023-02-26 04:05:18', NULL),
(767, 220, 2, 3, 1, 2, '', '2023-02-26 04:05:30', NULL),
(768, 221, 2, 3, 1, 2, '', '2023-02-26 04:05:38', NULL),
(769, 222, 2, 3, 1, 2, '', '2023-02-26 04:05:54', NULL),
(770, 223, 1, 3, 1, 2, '', '2023-02-26 04:06:06', NULL),
(771, 224, 1, 3, 1, 2, '', '2023-02-26 04:06:12', NULL),
(772, 225, 3, 3, 1, 2, '', '2023-02-26 04:06:19', NULL),
(773, 227, 1, 3, 1, 2, '', '2023-02-26 04:06:35', NULL),
(774, 230, 1, 3, 1, 2, '', '2023-02-26 04:06:43', NULL),
(775, 232, 1, 3, 1, 2, '', '2023-02-26 04:06:54', NULL),
(776, 233, 2, 3, 1, 2, '', '2023-02-26 04:07:35', NULL),
(777, 234, 1, 3, 1, 2, '', '2023-02-26 04:07:49', NULL),
(778, 235, 6, 3, 1, 2, '', '2023-02-26 04:08:00', NULL),
(779, 236, 3, 3, 1, 2, '', '2023-02-26 04:08:13', NULL),
(780, 237, 2, 3, 1, 2, '', '2023-02-26 04:08:29', NULL),
(781, 238, 1, 3, 1, 2, '', '2023-02-26 04:08:41', NULL),
(782, 240, 1, 3, 1, 2, '', '2023-02-26 04:09:02', NULL),
(783, 241, 1, 3, 1, 2, '', '2023-02-26 04:09:10', NULL),
(784, 244, 3, 3, 1, 2, '', '2023-02-26 04:09:29', NULL),
(785, 245, 2, 3, 1, 2, '', '2023-02-26 04:09:38', NULL),
(786, 247, 6, 3, 1, 2, '', '2023-02-26 04:11:35', NULL),
(787, 248, 3, 3, 1, 2, '', '2023-02-26 04:11:47', NULL),
(788, 249, 2, 3, 1, 2, '', '2023-02-26 04:11:57', NULL),
(789, 119, 1, 3, 1, 1, '', '2023-02-26 04:16:52', NULL),
(790, 33, 4, 3, 1, 2, '', '2023-02-26 04:21:30', NULL),
(791, 83, 3, 3, 1, 2, '', '2023-02-26 04:31:07', NULL),
(792, 137, 1, 3, 1, 2, '', '2023-02-26 04:37:23', NULL),
(793, 141, 1, 3, 1, 2, '', '2023-02-26 04:38:23', NULL),
(794, 87, 2, 3, 1, 2, '', '2023-02-26 12:30:39', NULL),
(795, 92, 5, 3, 1, 2, '', '2023-02-26 12:30:50', NULL),
(796, 88, 4, 3, 1, 2, '', '2023-02-26 12:31:02', NULL),
(797, 74, 6, 3, 1, 2, '', '2023-02-26 12:31:13', NULL),
(798, 4, 1, 3, 1, 2, '', '2023-02-26 12:31:26', NULL),
(799, 8, 2, 3, 1, 2, '', '2023-02-26 12:31:35', NULL),
(800, 8, 2, 3, 1, 3, 'xuất lên cs2', '2023-02-26 12:31:59', NULL),
(801, 8, 6, 6, 2, 1, '', '2023-02-26 12:38:05', NULL),
(802, 8, 6, 6, 2, 2, '', '2023-02-26 12:38:21', NULL),
(803, 138, 1, 3, 1, 2, '', '2023-02-27 02:00:45', NULL),
(804, 213, 3, 3, 1, 2, '', '2023-02-27 03:20:22', NULL),
(805, 71, 3, 3, 1, 2, '', '2023-02-27 03:20:38', NULL),
(806, 92, 4, 3, 1, 2, '', '2023-02-27 03:20:50', NULL),
(807, 174, 5, 3, 1, 2, '', '2023-02-27 03:21:01', NULL),
(808, 171, 6, 3, 1, 2, '', '2023-02-27 03:21:14', NULL),
(809, 54, 4, 3, 1, 2, '', '2023-02-27 03:21:34', NULL),
(810, 111, 2, 3, 1, 2, '', '2023-02-27 03:21:45', NULL),
(811, 112, 1, 3, 1, 2, '', '2023-02-27 03:22:09', NULL),
(812, 132, 1, 3, 1, 2, '', '2023-02-27 03:22:21', NULL),
(813, 24, 29, 3, 1, 2, '', '2023-02-27 03:22:29', NULL),
(814, 123, 1, 3, 1, 2, '', '2023-02-27 03:23:02', NULL),
(815, 76, 3, 3, 1, 2, '', '2023-02-27 03:23:14', NULL),
(816, 244, 2, 3, 1, 1, '', '2023-02-27 03:23:45', NULL),
(817, 244, 2, 3, 1, 2, '', '2023-02-27 03:24:16', NULL),
(818, 213, 3, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:25:40', NULL),
(819, 24, 29, 6, 2, 1, '', '2023-02-27 03:25:56', NULL),
(820, 71, 3, 3, 1, 3, 'xuất lên cs2\r\n', '2023-02-27 03:25:59', NULL),
(821, 213, 3, 6, 2, 1, '', '2023-02-27 03:26:18', NULL),
(822, 92, 4, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:26:22', NULL),
(823, 12, 4, 6, 2, 1, '', '2023-02-27 03:26:34', NULL),
(824, 174, 5, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:26:42', NULL),
(825, 92, 4, 6, 2, 1, '', '2023-02-27 03:26:53', NULL),
(826, 171, 6, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:27:04', NULL),
(827, 76, 3, 6, 2, 1, '', '2023-02-27 03:27:04', NULL),
(828, 54, 4, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:27:20', NULL),
(829, 54, 4, 6, 2, 1, '', '2023-02-27 03:27:24', NULL),
(830, 111, 2, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:27:41', NULL),
(831, 71, 3, 6, 2, 1, '', '2023-02-27 03:27:51', NULL),
(832, 112, 1, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:27:57', NULL),
(833, 132, 1, 3, 1, 3, 'xuất len cs2', '2023-02-27 03:28:14', NULL),
(834, 123, 1, 6, 2, 1, '', '2023-02-27 03:28:32', NULL),
(835, 24, 29, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:28:34', NULL),
(836, 123, 1, 3, 1, 3, 'xuất lên cs2\r\n', '2023-02-27 03:28:53', NULL),
(837, 112, 1, 6, 2, 1, '', '2023-02-27 03:28:56', NULL),
(838, 111, 2, 6, 2, 1, '', '2023-02-27 03:29:09', NULL),
(839, 76, 3, 3, 1, 3, 'xuất lên cs2', '2023-02-27 03:29:09', NULL),
(840, 132, 1, 6, 2, 1, '', '2023-02-27 03:29:55', NULL),
(841, 174, 5, 6, 2, 1, '', '2023-02-27 03:30:09', NULL),
(843, 171, 6, 6, 2, 1, '', '2023-02-27 03:33:30', NULL),
(844, 24, 29, 6, 2, 2, '', '2023-02-27 03:34:30', NULL),
(845, 213, 3, 6, 2, 2, '', '2023-02-27 03:34:47', NULL),
(846, 12, 4, 6, 2, 2, '', '2023-02-27 03:35:11', NULL),
(847, 92, 4, 6, 2, 2, '', '2023-02-27 03:35:25', NULL),
(848, 76, 3, 6, 2, 2, '', '2023-02-27 03:35:38', NULL),
(849, 54, 4, 6, 2, 2, '', '2023-02-27 03:35:49', NULL),
(850, 71, 3, 6, 2, 2, '', '2023-02-27 03:36:03', NULL),
(851, 123, 1, 6, 2, 2, '', '2023-02-27 03:36:28', NULL),
(852, 112, 1, 6, 2, 2, '', '2023-02-27 03:36:39', NULL),
(853, 111, 2, 6, 2, 2, '', '2023-02-27 03:36:45', NULL),
(854, 132, 1, 6, 2, 2, '', '2023-02-27 03:37:00', NULL),
(855, 174, 5, 6, 2, 2, '', '2023-02-27 03:37:12', NULL),
(856, 171, 6, 6, 2, 2, '', '2023-02-27 03:37:21', NULL),
(857, 44, 5, 3, 1, 2, '', '2023-02-27 06:25:26', NULL),
(858, 6, 2, 3, 1, 2, '', '2023-02-27 06:26:35', NULL),
(859, 38, 4, 3, 1, 2, '', '2023-02-27 06:26:48', NULL),
(860, 37, 3, 3, 1, 2, '', '2023-02-27 06:27:02', NULL),
(861, 174, 5, 3, 1, 2, '', '2023-02-27 06:27:15', NULL),
(862, 142, 2, 3, 1, 2, '', '2023-02-27 06:27:25', NULL),
(863, 24, 30, 3, 1, 2, '', '2023-02-27 06:27:35', NULL),
(864, 203, 1, 6, 2, 1, '', '2023-02-28 06:26:31', NULL),
(865, 106, 1, 6, 2, 1, '', '2023-02-28 06:28:10', NULL),
(866, 203, 1, 6, 2, 2, '', '2023-02-28 06:29:39', NULL),
(867, 106, 1, 6, 2, 2, '', '2023-02-28 06:29:56', NULL),
(868, 203, 1, 3, 1, 2, '', '2023-02-28 13:27:15', NULL),
(869, 106, 1, 3, 1, 2, '', '2023-02-28 13:27:36', NULL),
(871, 203, 1, 3, 1, 3, 'xuất lên cs2', '2023-02-28 13:29:23', NULL),
(872, 106, 1, 3, 1, 3, 'xuất lên cs2', '2023-02-28 13:29:39', NULL),
(873, 89, 3, 4, 2, 3, 'Chuyển xuống cs1', '2023-03-01 14:47:03', NULL),
(874, 23, 10, 3, 1, 2, '', '2023-03-02 14:46:58', NULL),
(876, 4, 1, 8, 1, 3, 'dsfd', '2023-04-14 11:58:05', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_act`
--
ALTER TABLE `tbl_act`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_classify`
--
ALTER TABLE `tbl_classify`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_from_where`
--
ALTER TABLE `tbl_from_where`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_payment_status`
--
ALTER TABLE `tbl_payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_classify` (`id_classify`);

--
-- Chỉ mục cho bảng `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_sell_manage`
--
ALTER TABLE `tbl_sell_manage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_from_where` (`id_from_where`),
  ADD KEY `id_payment_status` (`id_payment_status`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_user_sell` (`id_user_sell`);

--
-- Chỉ mục cho bảng `tbl_timekeeping`
--
ALTER TABLE `tbl_timekeeping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_brand` (`id_brand`);

--
-- Chỉ mục cho bảng `tbl_timekepping_story`
--
ALTER TABLE `tbl_timekepping_story`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_timekeping` (`Id_timekeping`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_branch` (`id_brand`);

--
-- Chỉ mục cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_act` (`id_act`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_act`
--
ALTER TABLE `tbl_act`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_classify`
--
ALTER TABLE `tbl_classify`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_from_where`
--
ALTER TABLE `tbl_from_where`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_payment_status`
--
ALTER TABLE `tbl_payment_status`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT cho bảng `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tbl_sell_manage`
--
ALTER TABLE `tbl_sell_manage`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=606;

--
-- AUTO_INCREMENT cho bảng `tbl_timekeeping`
--
ALTER TABLE `tbl_timekeeping`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `tbl_timekepping_story`
--
ALTER TABLE `tbl_timekepping_story`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=877;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_product_ibfk_2` FOREIGN KEY (`id_classify`) REFERENCES `tbl_classify` (`id`);

--
-- Các ràng buộc cho bảng `tbl_sell_manage`
--
ALTER TABLE `tbl_sell_manage`
  ADD CONSTRAINT `tbl_sell_manage_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `tbl_brand` (`id`),
  ADD CONSTRAINT `tbl_sell_manage_ibfk_2` FOREIGN KEY (`id_from_where`) REFERENCES `tbl_from_where` (`id`),
  ADD CONSTRAINT `tbl_sell_manage_ibfk_3` FOREIGN KEY (`id_payment_status`) REFERENCES `tbl_payment_status` (`id`),
  ADD CONSTRAINT `tbl_sell_manage_ibfk_4` FOREIGN KEY (`id_product`) REFERENCES `tbl_product` (`id`),
  ADD CONSTRAINT `tbl_sell_manage_ibfk_5` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_sell_manage_ibfk_6` FOREIGN KEY (`id_user_sell`) REFERENCES `tbl_user` (`id`);

--
-- Các ràng buộc cho bảng `tbl_timekeeping`
--
ALTER TABLE `tbl_timekeeping`
  ADD CONSTRAINT `tbl_timekeeping_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `tbl_brand` (`id`);

--
-- Các ràng buộc cho bảng `tbl_timekepping_story`
--
ALTER TABLE `tbl_timekepping_story`
  ADD CONSTRAINT `tbl_timekepping_story_ibfk_1` FOREIGN KEY (`Id_timekeping`) REFERENCES `tbl_timekeeping` (`id`),
  ADD CONSTRAINT `tbl_timekepping_story_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`);

--
-- Các ràng buộc cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`id_brand`) REFERENCES `tbl_brand` (`id`);

--
-- Các ràng buộc cho bảng `tbl_warehouse`
--
ALTER TABLE `tbl_warehouse`
  ADD CONSTRAINT `tbl_warehouse_ibfk_1` FOREIGN KEY (`id_act`) REFERENCES `tbl_act` (`id`),
  ADD CONSTRAINT `tbl_warehouse_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `tbl_brand` (`id`),
  ADD CONSTRAINT `tbl_warehouse_ibfk_3` FOREIGN KEY (`id_product`) REFERENCES `tbl_product` (`id`),
  ADD CONSTRAINT `tbl_warehouse_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
