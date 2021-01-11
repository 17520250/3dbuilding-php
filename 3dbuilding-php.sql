-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th1 08, 2021 lúc 04:18 PM
-- Phiên bản máy phục vụ: 8.0.13
-- Phiên bản PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `3dbuilding-php`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kientruc`
--

DROP TABLE IF EXISTS `kientruc`;
CREATE TABLE IF NOT EXISTS `kientruc` (
  `MaKienTruc` int(10) NOT NULL AUTO_INCREMENT,
  `MaLoaiKienTruc` int(10) NOT NULL,
  `MaVatLieu` int(10) NOT NULL,
  `MaTang` int(10) NOT NULL,
  `TenKienTruc` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayHoanThanh` date NOT NULL,
  `HanSuDungVL` int(10) NOT NULL,
  `HanBaoTri` date NOT NULL,
  `GeojsonKienTruc` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MucCanhBaoBT` int(10) NOT NULL DEFAULT '30',
  `TrangThaiBT` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#00ff00',
  `SoNgayDenBT` int(10) DEFAULT NULL,
  PRIMARY KEY (`MaKienTruc`),
  KEY `FK_kientruc_loaikientruc` (`MaLoaiKienTruc`),
  KEY `FK_kientruc_vatlieu` (`MaVatLieu`),
  KEY `FK_kientruc_tang` (`MaTang`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `kientruc`
--

INSERT INTO `kientruc` (`MaKienTruc`, `MaLoaiKienTruc`, `MaVatLieu`, `MaTang`, `TenKienTruc`, `NgayHoanThanh`, `HanSuDungVL`, `HanBaoTri`, `GeojsonKienTruc`, `MucCanhBaoBT`, `TrangThaiBT`, `SoNgayDenBT`) VALUES
(44, 1, 1, 1, 'Sàn nhà tầng 1', '2021-01-07', 12, '2021-01-15', '4070121061028.geojson', 30, '#ff0000', 7),
(45, 2, 1, 1, 'Trần nhà tầng 1', '2021-01-07', 12, '2022-01-07', '74070121061113.geojson', 30, '#00ff00', 364),
(46, 4, 4, 1, 'Cửa sổ tầng 1', '2021-01-07', 12, '2022-01-07', '1070121061145.geojson', 30, '#00ff00', 364),
(47, 3, 2, 1, 'Tường nhà tầng 1', '2021-01-07', 12, '2022-01-07', '51070121061221.geojson', 30, '#00ff00', 364),
(48, 1, 1, 2, 'Sàn nhà tầng 2', '2021-01-07', 12, '2022-01-07', '42070121100923.geojson', 30, '#00ff00', 364),
(49, 3, 2, 2, 'Tường nhà tầng 2', '2021-01-07', 12, '2022-01-07', '33070121101117.geojson', 30, '#00ff00', 364),
(50, 2, 1, 2, 'Trần nhà tầng 2', '2021-01-07', 12, '2022-01-07', '20070121101148.geojson', 30, '#00ff00', 364),
(51, 4, 4, 2, 'Cửa sổ tầng 2', '2021-01-07', 12, '2021-02-01', '50070121101216.geojson', 30, '#ff0000', 24),
(52, 1, 1, 3, 'Sàn nhà tầng 3', '2021-01-07', 12, '2022-01-07', '10070121102102.geojson', 30, '#00ff00', 364),
(53, 2, 1, 3, 'Trần nhà tầng 3', '2021-01-07', 12, '2022-01-07', '54070121102132.geojson', 30, '#00ff00', 364),
(54, 3, 2, 3, 'Tường nhà tầng 3', '2021-01-07', 12, '2021-03-04', '100070121102158.geojson', 60, '#ff0000', 55),
(55, 4, 4, 3, 'Cửa sổ tầng 3', '2021-01-07', 12, '2022-01-07', '90070121102221.geojson', 30, '#00ff00', 364),
(61, 1, 2, 4, 'Sàn nhà tầng 4', '2021-01-08', 12, '2022-01-08', '52080121032419.geojson', 30, '#00ff00', 365),
(62, 2, 1, 4, 'Trần nhà tầng 4', '2021-01-08', 12, '2022-01-08', '98080121032526.geojson', 30, '#00ff00', 365),
(63, 4, 4, 4, 'Cửa sổ tầng 4', '2021-01-08', 12, '2022-01-08', '43080121032550.geojson', 30, '#00ff00', 365),
(64, 3, 2, 4, 'Tường nhà tầng 4', '2021-01-08', 12, '2022-01-08', '76080121032652.geojson', 30, '#00ff00', 365),
(65, 1, 2, 5, 'Sàn nhà tầng 5', '2021-01-08', 12, '2021-01-30', '60080121032744.geojson', 30, '#ff0000', 22),
(66, 2, 6, 5, 'Trần nhà tầng 5', '2021-01-08', 12, '2022-01-08', '31080121032818.geojson', 30, '#00ff00', 365),
(67, 3, 7, 5, 'Tường nhà tầng 5', '2021-01-08', 12, '2021-01-30', '83080121032857.geojson', 30, '#ff0000', 22),
(68, 4, 4, 5, 'Cửa sổ tầng 5', '2021-01-08', 12, '2021-01-18', '74080121032935.geojson', 30, '#ff0000', 10),
(69, 1, 2, 6, 'Sàn nhà tầng 6', '2021-01-08', 12, '2022-01-08', '26080121033020.geojson', 30, '#00ff00', 365),
(70, 2, 1, 6, 'Trần nhà tầng 6', '2021-01-08', 10, '2021-11-08', '10080121033057.geojson', 30, '#00ff00', 304),
(71, 3, 3, 6, 'Tường nhà tầng 6', '2021-01-08', 12, '2021-01-11', '15080121033132.geojson', 30, '#ff0000', 3),
(72, 4, 4, 6, 'Cửa sổ tầng 6', '2021-01-08', 12, '2022-01-08', '42080121033216.geojson', 30, '#00ff00', 365),
(73, 1, 1, 7, 'Sàn nhà tầng 7', '2021-01-08', 10, '2021-11-08', '87080121033338.geojson', 30, '#00ff00', 304),
(74, 1, 2, 8, 'Sàn nhà tầng 8', '2021-01-08', 12, '2022-01-08', '47080121033408.geojson', 30, '#00ff00', 365),
(75, 3, 3, 7, 'Tường nhà tầng 7', '2021-01-08', 12, '2022-01-08', '70080121033434.geojson', 30, '#00ff00', 365),
(76, 3, 3, 8, 'Tường nhà tầng 8', '2021-01-08', 12, '2022-01-08', '65080121033456.geojson', 30, '#00ff00', 365),
(77, 2, 6, 7, 'Trần nhà tầng 7', '2021-01-08', 12, '2021-01-31', '100080121033547.geojson', 30, '#ff0000', 23),
(78, 2, 6, 8, 'Trần nhà tầng 8', '2021-01-08', 12, '2022-01-08', '23080121033617.geojson', 30, '#00ff00', 365),
(79, 4, 4, 8, 'Cửa sổ tầng 8', '2021-01-08', 12, '2021-01-12', '13080121033737.geojson', 30, '#ff0000', 4),
(80, 4, 4, 7, 'Cửa sổ tầng 7', '2021-01-08', 12, '2022-01-08', '44080121033800.geojson', 30, '#00ff00', 365),
(81, 1, 2, 9, 'Sàn nhà tầng 9', '2021-01-08', 10, '2021-11-08', '33080121033854.geojson', 30, '#00ff00', 304),
(82, 1, 1, 10, 'Sàn nhà tầng 10', '2021-01-08', 12, '2022-01-08', '4080121033920.geojson', 30, '#00ff00', 365),
(83, 3, 7, 9, 'Tường nhà tầng 9', '2021-01-08', 12, '2022-01-08', '53080121034039.geojson', 30, '#00ff00', 365),
(84, 4, 4, 9, 'Cửa sổ tầng 9', '2021-01-08', 12, '2022-01-08', '3080121034106.geojson', 30, '#00ff00', 365),
(85, 2, 6, 9, 'Trần nhà tầng 9', '2021-01-08', 12, '2022-01-08', '82080121034134.geojson', 30, '#00ff00', 365),
(86, 4, 4, 10, 'Cửa sổ tầng 10', '2021-01-08', 12, '2022-01-08', '48080121034258.geojson', 30, '#00ff00', 365),
(87, 3, 3, 10, 'Tường nhà tầng 10', '2021-01-08', 12, '2022-01-08', '53080121034331.geojson', 30, '#00ff00', 365),
(88, 2, 6, 10, 'Trần nhà tầng 10', '2021-01-08', 12, '2021-01-09', '3080121034420.geojson', 60, '#ff0000', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaikientruc`
--

DROP TABLE IF EXISTS `loaikientruc`;
CREATE TABLE IF NOT EXISTS `loaikientruc` (
  `MaLoaiKienTruc` int(10) NOT NULL AUTO_INCREMENT,
  `TenLoaiKienTruc` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Symbol` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Size` double(8,2) NOT NULL DEFAULT '0.00',
  `Width` double(8,2) NOT NULL DEFAULT '0.00',
  `Height` double(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`MaLoaiKienTruc`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaikientruc`
--

INSERT INTO `loaikientruc` (`MaLoaiKienTruc`, `TenLoaiKienTruc`, `Symbol`, `Color`, `Size`, `Width`, `Height`) VALUES
(1, 'Sàn', 'polygon-3d', '#8b4513', 1.00, 0.00, 0.00),
(2, 'Trần', 'polygon-3d', '#fffaf0', 0.50, 0.00, 0.00),
(3, 'Tường', 'line-3d', '#00ffff', 0.00, 0.50, 8.50),
(4, 'Cửa sổ', 'line-3d', '#90ee90', 0.00, 0.05, 8.50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tang`
--

DROP TABLE IF EXISTS `tang`;
CREATE TABLE IF NOT EXISTS `tang` (
  `MaTang` int(10) NOT NULL AUTO_INCREMENT,
  `TenTang` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaToaNha` int(10) NOT NULL,
  PRIMARY KEY (`MaTang`),
  KEY `FK_tang_toanha` (`MaToaNha`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tang`
--

INSERT INTO `tang` (`MaTang`, `TenTang`, `MaToaNha`) VALUES
(1, 'Tầng 1', 1),
(2, 'Tầng 2', 1),
(3, 'Tầng 3', 1),
(4, 'Tầng 4', 1),
(5, 'Tầng 5', 1),
(6, 'Tầng 6', 1),
(7, 'Tầng 7', 1),
(8, 'Tầng 8', 1),
(9, 'Tầng 9', 1),
(10, 'Tầng 10', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `toanha`
--

DROP TABLE IF EXISTS `toanha`;
CREATE TABLE IF NOT EXISTS `toanha` (
  `MaToaNha` int(10) NOT NULL AUTO_INCREMENT,
  `TenToaNha` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `SoTang` int(5) NOT NULL,
  `ViTri` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NamHoanThanh` int(11) NOT NULL,
  PRIMARY KEY (`MaToaNha`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `toanha`
--

INSERT INTO `toanha` (`MaToaNha`, `TenToaNha`, `SoTang`, `ViTri`, `NamHoanThanh`) VALUES
(1, 'Vinhomes Park ', 10, 'Dĩ An, Bình Dương', 2020);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `MaUser` int(11) NOT NULL AUTO_INCREMENT,
  `TenUser` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MatKhau` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Level` enum('Admin','User') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  PRIMARY KEY (`MaUser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`MaUser`, `TenUser`, `MatKhau`, `Level`) VALUES
(1, 'admin', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'Admin'),
(2, 'user', '$2y$10$oNX.X8jgLhNclHBeI8ytT.1vODlml8.AN1Ieb.rSIChhCa1e7cS0S', 'User');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vatlieu`
--

DROP TABLE IF EXISTS `vatlieu`;
CREATE TABLE IF NOT EXISTS `vatlieu` (
  `MaVatLieu` int(10) NOT NULL AUTO_INCREMENT,
  `TenVatLieu` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`MaVatLieu`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vatlieu`
--

INSERT INTO `vatlieu` (`MaVatLieu`, `TenVatLieu`) VALUES
(1, 'Gỗ'),
(2, 'Gạch'),
(3, 'Đá'),
(4, 'Kính'),
(5, 'Sứ'),
(6, 'Nhựa'),
(7, 'Xi măng'),
(8, 'Sắt');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `kientruc`
--
ALTER TABLE `kientruc`
  ADD CONSTRAINT `FK_kientruc_loaikientruc` FOREIGN KEY (`MaLoaiKienTruc`) REFERENCES `loaikientruc` (`maloaikientruc`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_kientruc_tang` FOREIGN KEY (`MaTang`) REFERENCES `tang` (`matang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FK_kientruc_vatlieu` FOREIGN KEY (`MaVatLieu`) REFERENCES `vatlieu` (`mavatlieu`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Các ràng buộc cho bảng `tang`
--
ALTER TABLE `tang`
  ADD CONSTRAINT `FK_tang_toanha` FOREIGN KEY (`MaToaNha`) REFERENCES `toanha` (`matoanha`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
