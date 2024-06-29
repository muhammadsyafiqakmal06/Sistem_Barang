-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2024 at 07:15 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `stok_awal` varchar(10) NOT NULL,
  `terjual` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stok_akhir` varchar(10) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`id_barang`, `nama_barang`, `harga`, `stok_awal`, `terjual`, `stok_akhir`, `kategori`) VALUES
(1299, 'PIO-PIO POP', '40000', '152', '57', '95', 'Diminati'),
(1300, 'PIO-PIO PELANGI', '40000', '142', '47', '95', 'Diminati'),
(1301, 'TIARA 500', '40000', '64', '17', '47', 'Kurang Diminati'),
(1302, 'TIARA 2,000', '55000', '156', '72', '84', 'Diminati'),
(1303, 'SHAUN THE SEEP', '40000', '121', '46', '75', 'Diminati'),
(1304, 'MIKO NANGKA', '40000', '136', '46', '90', 'Diminati'),
(1305, 'MANIS MADU', '40000', '152', '73', '79', 'Diminati'),
(1306, 'KLEPON', '49000', '161', '61', '100', 'Diminati'),
(1307, 'POTEITOS', '74000', '124', '42', '82', 'Diminati'),
(1308, 'ORICH ', '16500', '149', '58', '91', 'Diminati'),
(1309, 'O-LARIS STIKC', '40000', '109', '43', '66', 'Diminati'),
(1310, 'MARIS WAFER', '40000', '119', '43', '76', 'Diminati'),
(1311, 'GOLDEN CIPS', '50000', '210', '140', '70', 'Paling Diminati'),
(1312, 'CITOP', '63000', '52', '21', '31', 'Kurang Diminati'),
(1313, 'GOPEK', '62000', '48', '24', '24', 'Kurang Diminati'),
(1314, 'KOPYOR', '32000', '131', '41', '90', 'Diminati'),
(1315, 'DAWET', '32000', '56', '34', '22', 'Kurang Diminati'),
(1316, 'O-RING', '32000', '157', '54', '103', 'Diminati'),
(1317, 'HAPPY TWIST', '32000', '79', '36', '43', 'Kurang Diminati'),
(1318, 'MELON', '32000', '48', '28', '20', 'Kurang Diminati'),
(1319, 'UBI UNGGU', '32000', '167', '71', '96', 'Diminati'),
(1320, 'GREEN COCO', '56000', '143', '46', '97', 'Diminati'),
(1321, 'PUTRA BALI', '38000', '167', '51', '116', 'Diminati'),
(1322, 'ARIES', '64000', '43', '28', '15', 'Kurang Diminati'),
(1323, 'JEKPOT', '64000', '290', '200', '90', 'Paling Diminati'),
(1324, 'MOO JUMBO', '32000', '155', '51', '104', 'Diminati'),
(1325, 'KOMO', '17000', '198', '80', '118', 'Diminati'),
(1326, 'AMEX', '32000', '230', '160', '70', 'Paling Diminati'),
(1327, 'TOP TEN RING', '17000', '212', '92', '120', 'Diminati'),
(1328, 'KACI-KACI', '47000', '159', '60', '99', 'Diminati'),
(1329, 'CINCIN GAJAH ', '41000', '113', '40', '73', 'Diminati'),
(1330, 'KOMPAS GAJAH', '41000', '180', '77', '103', 'Diminati'),
(1331, 'TANGGO', '95000', '100', '49', '51', 'Kurang Diminati'),
(1332, 'HAPPY JAMUR', '48000', '76', '34', '42', 'Kurang Diminati'),
(1333, 'CONE SNACK', '48000', '165', '62', '103', 'Diminati'),
(1334, 'PANDA CIPS', '48000', '67', '31', '36', 'Kurang Diminati'),
(1335, 'MINI DONAT', '48000', '149', '53', '96', 'Diminati'),
(1336, 'STICU MISIS', '48000', '45', '20', '25', 'Kurang Diminati'),
(1337, 'SAGU KEJU', '48000', '59', '30', '29', 'Kurang Diminati'),
(1338, 'COKLAT KEJU', '48000', '143', '52', '91', 'Diminati'),
(1339, 'ROSTA PEDAS', '100000', '165', '61', '104', 'Diminati'),
(1340, 'COCOLATOS', '118000', '145', '52', '93', 'Diminati'),
(1341, 'GERRY CEREAL', '102000', '123', '48', '75', 'Diminati'),
(1342, 'GERRY BISCOK', '102000', '121', '45', '76', 'Diminati'),
(1343, 'GERRY MISIS', '102000', '49', '27', '22', 'Kurang Diminati'),
(1344, 'GERRY RING', '91000', '60', '39', '21', 'Kurang Diminati'),
(1345, 'GERRY DONAT', '128000', '113', '43', '70', 'Diminati'),
(1346, 'PILUS GARUDA', '49000', '156', '65', '91', 'Diminati'),
(1347, 'GARUDA POTATO', '100000', '149', '55', '94', 'Diminati'),
(1348, 'DILAN BAR', '230000', '49', '23', '26', 'Kurang Diminati'),
(1349, 'DILAN BAG', '158000', '142', '54', '88', 'Diminati'),
(1350, 'DILAN TOPES', '168000', '114', '44', '70', 'Diminati'),
(1351, 'KEJU PROCIS', '163000', '79', '39', '40', 'Kurang Diminati'),
(1352, 'NABATI', '98000', '141', '59', '82', 'Diminati'),
(1353, 'TIME BREAK', '99000', '167', '65', '102', 'Diminati'),
(1354, 'SIIP', '98000', '156', '63', '93', 'Diminati'),
(1355, 'AH', '83000', '149', '52', '97', 'Diminati'),
(1356, 'COCOPIE', '160000', '142', '45', '97', 'Diminati'),
(1357, 'SOSIS OKE', '119000', '132', '54', '78', 'Diminati'),
(1358, 'SOSIS VIRGO', '119000', '156', '64', '92', 'Diminati'),
(1359, 'TIC-TIC', '66000', '101', '42', '59', 'Kurang Diminati'),
(1360, 'SOSIS SO NICE', '110000', '99', '47', '52', 'Kurang Diminati'),
(1361, 'MISTER', '51000', '112', '40', '72', 'Diminati'),
(1362, 'LEA NET TIC-TIC', '51000', '78', '32', '46', 'Kurang Diminati'),
(1363, 'SPIX MIE GORENG', '34000', '156', '62', '94', 'Diminati'),
(1364, 'SUKI', '66000', '169', '70', '99', 'Diminati'),
(1365, 'BOIKY', '66000', '106', '48', '58', 'Kurang Diminati'),
(1366, 'GO RIO-RIO', '69000', '156', '65', '91', 'Diminati'),
(1367, 'GO POTATO', '69000', '148', '55', '93', 'Diminati'),
(1368, 'PISANG COKELAT ', '60000', '123', '40', '83', 'Diminati'),
(1369, 'CRISPY OAT', '100000', '145', '55', '90', 'Diminati'),
(1370, 'COLIMBIA', '103000', '35', '20', '15', 'Kurang Diminati'),
(1371, 'OREO', '75000', '157', '69', '88', 'Diminati'),
(1372, 'MARINDO', '104000', '119', '49', '70', 'Diminati'),
(1373, 'WAFER APRILLO', '67000', '187', '73', '114', 'Diminati'),
(1374, 'INOFOOD ', '125000', '32', '10', '22', 'Kurang Diminati'),
(1375, 'JAGUNG JUMBO', '50000', '156', '62', '94', 'Diminati'),
(1376, 'SUS HUTTON', '50000', '129', '51', '78', 'Diminati'),
(1377, 'POP CORN\'GO', '50000', '98', '45', '53', 'Kurang Diminati'),
(1378, 'MOMOTARO', '98000', '137', '51', '86', 'Diminati'),
(1379, 'P,MAS', '98000', '37', '20', '17', 'Kurang Diminati'),
(1380, 'MARY OPPA', '193000', '107', '46', '61', 'Diminati'),
(1381, 'AOKA', '109000', '240', '160', '80', 'Paling Diminati'),
(1382, 'PANDA', '34000', '167', '72', '95', 'Diminati'),
(1383, 'MARANI', '38000', '111', '42', '69', 'Diminati'),
(1384, 'PILUS', '49000', '199', '88', '111', 'Diminati'),
(1385, 'SUKRO', '33000', '109', '42', '67', 'Diminati'),
(1386, 'POLONG', '49000', '146', '63', '83', 'Diminati'),
(1387, 'KORO', '49000', '124', '54', '70', 'Diminati'),
(1388, 'KACANG KULIT', '67000', '114', '42', '72', 'Diminati'),
(1389, 'TOS-TOS', '98000', '131', '57', '74', 'Diminati'),
(1390, 'RONI', '98000', '142', '51', '91', 'Diminati'),
(1391, 'COKI-COKI', '154000', '169', '64', '105', 'Diminati'),
(1392, 'WAFELO', '102000', '61', '39', '22', 'Kurang Diminati'),
(1393, 'BENG-BENG', '238000', '189', '80', '109', 'Diminati'),
(1394, 'SUPER STAR', '122000', '121', '44', '77', 'Diminati'),
(1395, 'KALPA', '158000', '54', '28', '26', 'Kurang Diminati'),
(1396, 'FRENTA', '182000', '143', '54', '89', 'Diminati'),
(1397, 'SISRI', '200000', '148', '53', '95', 'Diminati'),
(1398, 'MILKITA', '131000', '153', '120', '33', 'Paling Diminati');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'admin2', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_barang`
--
ALTER TABLE `data_barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1399;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
