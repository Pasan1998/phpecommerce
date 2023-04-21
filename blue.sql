-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2023 at 08:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blue`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sku` varchar(14) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `sku`, `price`, `image`) VALUES
(1, 'Iphone', 'IPHO001', '400.00', 'iphone.jpg'),
(2, 'Camera', 'CAME001', '700.00', 'camera.jpg'),
(3, 'Watch', 'WATC001', '100.00', 'watch.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `Id` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `categoryimage` varchar(255) NOT NULL,
  `ProductDescription` text NOT NULL,
  `Status` int(10) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(11) DEFAULT NULL,
  `UpdateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`Id`, `ProductName`, `categoryimage`, `ProductDescription`, `Status`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'nokia', '', 'Nokia is major brans', 0, 6, '2023-02-17', NULL, NULL),
(3, 'Huawei', '', 'Huawei is one of major competitor in mobile indusrty', 0, 6, '2023-02-18', NULL, NULL),
(4, 'Lg', '', 'Lg is one of major brand', 0, 6, '2023-02-18', NULL, NULL),
(5, 'xiami', '', 'this is a major category', 0, 6, '2023-02-26', NULL, NULL),
(7, 'testing', '', 'tesdsfsdfsdsd', 0, 6, '2023-03-19', NULL, NULL),
(8, 'testing12', '64170120b54c37.67428335testing12.jpg', 'tesdsfsdfsdsd', 0, 6, '2023-03-19', NULL, NULL),
(9, 'Samsung', '641701e34fb511.34246750Samsung.png', 'Samsung', 1, 6, '2023-03-19', NULL, NULL),
(10, 'Apple', '6417021444e511.90822197Apple.png', 'Apple', 1, 6, '2023-03-19', NULL, NULL),
(11, 'Xiaomi', '64170247d11e15.08843937Xiaomi.png', 'Xiaomi', 1, 6, '2023-03-19', NULL, NULL),
(12, 'Nokia', '641702ac36bfd2.59742935Nokia.png', 'Nokia', 1, 6, '2023-03-19', NULL, NULL),
(13, 'Testing', '6418ae2208b707.61114351Testing.png', 'This is lg brand', 1, 6, '2023-03-20', NULL, NULL),
(14, 'ZTE', '6418bed78e73b2.30261630ZTE.png', 'zte', 1, 6, '2023-03-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `CustomerId` int(20) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NIC` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Mobile` varchar(12) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Address2` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `ReferenceNumber` varchar(255) NOT NULL,
  `ReferenceStatus` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`CustomerId`, `Title`, `FirstName`, `LastName`, `Email`, `NIC`, `Password`, `Mobile`, `Gender`, `Address`, `Address2`, `City`, `ReferenceNumber`, `ReferenceStatus`) VALUES
(16, '', 'wer', 'wer', 'wer@gmail.com', '2121212121', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '1234567890', '', 'asdf', '', 'piliyandala', '0', 0),
(17, '', 'qwer', 'qwer', 'pasanmanhara5@gmail.com', '981143426v', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', '', 'piliyandala', '', 'colombo', '0', 0),
(18, 'Mr', 'Perera', 'Silva', 'pasanmanahara6@gmail.com', '981143426V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', '', 'piliyandala', '', 'colombo', '0', 0),
(19, 'Mr', 'Mia', 'Khalifa', 'Khalifa@gmail.com', '981143426v', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'polgasowita', '', 'piliyandala', '0', 0),
(20, 'Mr', 'MANAHRA', 'wjerama', 'pasanmanaharawijersdama@gmail.com', '981143426V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'male', 'colombo', '', 'piliyandala', '0', 0),
(21, 'Mr', 'PAsan', 'manahara', 'pasanmanahara1@gmail.com', '981143426v', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '1234567890', 'male', 'colombo', '', 'colombo', '0', 0),
(22, 'Mr', 'qweqwe', 'qweqwe', 'pasanmaasasanahara@gmail.comsdsd', '981143426v', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'no 23/43, A , Ambalangoda , Polgasowita', '', 'piliyandala', '0', 0),
(23, 'Mr', 'sdsd', 'sdsd', 'pasanmanasdsdhara@gmail.com', '981143426V', '58c4a2b69d479b7aafff96df3c219204deab5341', '0785954493', 'male', 'no 23/43, A , Ambalangoda , Polgasowita', '', 'piliyandala', '0', 0),
(24, 'Mr', 'sd', 'sd', 'pasanmanaasashara@gmail.com', '981143426V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'no 23/43, A , Ambalangoda , Polgasowita', '', 'piliyandala', '0', 0),
(25, 'Mr', 'abc', 'abc', 'pasanmanahara@gmail.com', '981142426V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '7896541230', 'male', 'colombo', '', 'piliyandala', '0', 0),
(40, 'Mr', 'thomasssssszxxxx', 'jackxxxz', 'jxaxxzzxazasssscasdssdsddk@gmail.com', '123456789V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'asdas', 'asdasd', 'asdaasd', '1745231843', 0),
(41, 'Mr', 'thomasssssszxxxx', 'jackxxxz', 'jxasxxzzxazasssscasdssdsddk@gmail.com', '123456789V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'asdas', 'asdasd', 'asdaasd', '558220572', 0),
(42, 'Mr', 'thomasssssszxxxx', 'jackxxxz', 'jxasxxzzxafzasssscasdssdsddk@gmail.com', '123456789V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'asdas', 'asdasd', 'asdaasd', '246733257', 0),
(43, 'Mr', 'thomasssssszxxxxasd', 'jackxxxz', 'jxasxxzzxafzasssscasdssasddsddk@gmail.com', '123456789V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'male', 'asdas', 'asdasd', 'asdaasd', '1133214980', 0),
(44, 'Miss', 'thomasssssszxxxxasdasdasd', 'jackxxxz', 'jxasxxasdzzxafzasssscasdssasddsddk@gmail.com', '123456789V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'asdas', 'asdasd', 'asdaasd', '1314794657', 0),
(45, 'Mr', 'thomasssssszxxxxasdasdasdas', 'jackxxxz', 'jxasxaasxasdzzxafzasssscasdssasddsddk@gmail.com', '123456789V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'asdas', 'asdasd', 'asdaasd', '2112863906', 1),
(47, 'Mr', 'loga', 'mithrah', 'logassdsdmithrah@gmail.com', '981143426v', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'polgaowita', 'piliynadala', 'colombo', '', 0),
(48, 'Miss', 'loga', 'mithrah', 'logamithrah@gmail.com', '984456214V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'female', 'polgaowita', 'piliynadala', 'colombo', '1990707885', 1),
(49, 'Mr', 'asdasdf', 'asfasda', 'asdafsdfsd@gmail.com', '984455621V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'male', 'colombo', 'colombo', 'piliyandala', '1205387559', 1),
(50, 'Mr', 'asdasdf', 'asfasda', 'asasdasdafsdfsd@gmail.com', '984423651V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'male', 'colombo', 'colombo', 'piliyandala', '1054613447', 0),
(51, 'Mr', 'cvxcv', 'xcvxcv', 'xcvxcv@gmail.com', '985544526V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'male', 'colombo', 'colombo', 'colombo', '1976862270', 0),
(52, 'Mr', 'zxczxc', 'zxcsd', 'ZXczsdew@gmail.com', '652236541V', 'aade8e604c19c594ce081d5f479847e1a846c1ba', '0785954493', 'male', 'colombo', 'colombo', 'colombo', '2057869159', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preorderproducts`
--

CREATE TABLE `tbl_preorderproducts` (
  `ProductID` int(20) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `ProductImage` varchar(255) NOT NULL,
  `ProductCategory` varchar(255) NOT NULL,
  `ProductPrice` float(16,2) NOT NULL,
  `Camera` int(20) NOT NULL,
  `Battery` int(20) NOT NULL,
  `Storage` int(20) NOT NULL,
  `Warranty` int(20) NOT NULL,
  `SelectYear` varchar(20) NOT NULL,
  `ProductDescription` text NOT NULL,
  `ProductStatus` int(5) NOT NULL,
  `AddUser` int(5) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(5) NOT NULL,
  `UpdateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_preorderproducts`
--

INSERT INTO `tbl_preorderproducts` (`ProductID`, `ProductName`, `ProductImage`, `ProductCategory`, `ProductPrice`, `Camera`, `Battery`, `Storage`, `Warranty`, `SelectYear`, `ProductDescription`, `ProductStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'nova 2i', '640863aa6c0233.55369933.jpg', 'Nokia', 500.00, 20, 20, 20, 20, '2013', 'Testing Testing Testing Testing', 0, 6, '2023-03-08', 0, '0000-00-00'),
(2, 'Apple 6s', '640d5cc5c0cdc1.93049867.jpeg', 'Nokia', 5000.00, 20, 20, 20, 365, '2017', 'This is apple product', 0, 6, '2023-03-12', 0, '0000-00-00'),
(3, 'Samsung galaxy 10', '641610ea2b9de4.47039650.png', 'Nokia', 20000.00, 12, 12, 64, 365, '2014', 'testing', 0, 40, '2023-03-18', 0, '0000-00-00'),
(4, 'Samsung galaxy 10', '6416874231e764.67009403.png', 'Nokia', 60000.00, 20, 5000, 64, 365, '2017', 'New products proudly presented by samsung', 1, 6, '2023-03-19', 0, '0000-00-00'),
(5, 'Nokia10', '6418be8d555cc2.91426096.png', 'Nokia', 65000.00, 20, 20, 20, 20, '2013', '2000', 1, 6, '2023-03-20', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `ProductID` int(20) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductImage` varchar(255) NOT NULL,
  `ProductCode` varchar(20) NOT NULL,
  `ProductCategory` varchar(20) NOT NULL,
  `Quantity` int(10) NOT NULL,
  `ProductPrice` decimal(18,2) DEFAULT NULL,
  `Camera` int(10) NOT NULL,
  `Battery` int(10) NOT NULL,
  `Storage` int(10) NOT NULL,
  `Warranty` int(10) NOT NULL,
  `IMIE` int(20) NOT NULL,
  `SelectYear` int(11) NOT NULL,
  `ProductDescription` varchar(255) NOT NULL,
  `ProductSellingType` varchar(255) NOT NULL,
  `ProductStatus` int(20) NOT NULL,
  `ProductSold` int(16) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date DEFAULT NULL,
  `UpdateUser` int(11) NOT NULL,
  `UpdateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`ProductID`, `ProductName`, `ProductImage`, `ProductCode`, `ProductCategory`, `Quantity`, `ProductPrice`, `Camera`, `Battery`, `Storage`, `Warranty`, `IMIE`, `SelectYear`, `ProductDescription`, `ProductSellingType`, `ProductStatus`, `ProductSold`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(23, 'mithrah', '6400fab55ed592.28807050.png', 'mithrah 011', 'Huawei', 17, '1000000.00', 0, 0, 0, 0, 0, 2014, 'test', 'inquiry', 1, 0, 37, '2023-03-02', 0, NULL),
(24, 'qwert', '6402f36a758b17.47928737.png', '1223565', 'Huawei', 1, '60000.00', 20, 6000, 64, 150, 2147483647, 2012, 'sdsdasdasdadas', 'inquiry', 0, 0, 6, '2023-03-04', 0, NULL),
(25, '$pName', '$file_name_new', '$pCode', '$pCategory', 0, '0.00', 0, 0, 0, 0, 0, 0, '$pDescription', '$sType', 0, 0, 0, '0000-00-00', 0, NULL),
(26, 'samsung', '64030ea8d99ff1.42888933.png', '123123', 'mithrah', 20, '123123.00', 12, 12, 12, 12, 1212, 2023, 'sdfsdf', 'sell', 1, 10, 6, '2023-03-04', 0, NULL),
(27, 'asas', '64030f37363f51.50225692.jpg', 'asdasdas', 'xiami', 1, '500.00', 12, 12, 12, 12, 12, 2012, 'csdsdf', 'inquiry', 1, 0, 6, '2023-03-04', 0, NULL),
(28, 'asas', '64030fd811b4b1.50197357.png', 'asdasdassas', 'Nokia', 1, '500.00', 12, 12, 12, 12, 12, 2023, 'csdsdf', 'inquiry', 1, 10, 6, '2023-03-04', 0, NULL),
(29, 'sdas', '6403118ccbb918.23704695.png', 'asdasdasdas', 'Nokia', 19, '10.00', 12, 223, 23, 23, 23, 2022, 'weewe', 'sell', 1, 0, 6, '2023-03-04', 0, NULL),
(30, 'Pasan', '64031201d004a4.13149627.png', 'asasaszxzx', 'Nokia', 19, '50000.00', 12, 12, 12, 12, 12, 2022, 'dasdasdas', 'sell', 1, 10, 6, '2023-03-04', 0, NULL),
(31, 'sdas', '640313313c5b09.76721216.png', 'asdf', 'nokia', 18, '10.00', 12, 22, 21, 21, 12, 2023, 'sdfsdfsdf', 'sell', 0, 0, 6, '2023-03-04', 0, NULL),
(32, 'testing 4', '6403696b3b2040.09211394.png', 'testing 4', 'Nokia', 2, '50000.00', 31, 12, 122, 122, 123, 2013, 'testing 4', 'sell', 1, 10, 6, '2023-03-04', 0, NULL),
(33, 'testing04', '64036a55a3a974.68655864.png', 'testing04', 'Nokia', 19, '10.00', 10, 20, 20, 20, 2023, 2023, 'testing04', 'inquiry', 0, 10, 6, '2023-03-04', 0, NULL),
(34, 'Huawe nova 2i', '', '', '', 0, NULL, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, NULL, 0, NULL),
(36, 'Sakuni', '64036a55a3a974.68655864.png', 'asdasd', 'nokia', 21, '50000.00', 12, 12, 12, 120, 132215465, 2023, 'sdsdfsdf', 'sell', 1, 0, 6, '2023-03-08', 0, NULL),
(37, 'Sakuni', '64036a55a3a974.68655864.png', '123546', 'xiami', 21, '500.00', 12, 23, 23, 23, 23, 2023, 'wewe', 'sell', 0, 0, 6, '2023-03-09', 0, NULL),
(38, 'Huawe nova 2i', '64185df579d161.09834673.png', 'h200', 'Samsung', 1, '25000.00', 12, 5000, 64, 365, 546868, 2023, 'sdsdfsdf', '', 1, 0, 6, '2023-03-20', 0, NULL),
(39, 'Huawe nova 2i', '64187313374184.82451937.png', '124578', 'Samsung', 1, '525000.00', 30, 6000, 64, 365, 135168465, 2016, 'sdsdfsdfsd', '', 1, 0, 6, '2023-03-20', 0, NULL),
(40, 'Huawe nova 2i', '641879402bbc68.72251762.png', 'asasd', 'Xiaomi', 1, '200000.00', 30, 6000, 128, 365, 98486545, 2013, 'asdasd', '', 1, 0, 6, '2023-03-20', 0, NULL),
(41, 'Galaxy Note 10', '64189bca55deb0.42362103.png', 'qwe12', 'Samsung', 2, '565000.00', 30, 6500, 64, 365, 1259874693, 2012, 'asdasd', '', 1, 0, 6, '2023-03-20', 0, NULL),
(42, 'Huawe nova 2i', '64189c39c20a04.88644095.png', 'asdasdasfbfgb', 'Xiaomi', 19, '620000.00', 30, 2356, 64, 365, 2147483647, 2013, 'asdasda', '', 1, 0, 6, '2023-03-20', 0, NULL),
(43, 'Huawe nova 2i', '64189ef7eb26f3.93961900.png', 'asasdcvb', 'Samsung', 2, '500.00', 20, 20, 20, 20, 20, 2013, '202dsdfsd', '', 1, 0, 6, '2023-03-20', 0, NULL),
(44, 'Galaxy Note 10', '64189ffa30aa62.50319589.png', 'asdasdxcvxc', 'Samsung', 21, '202.00', 20, 20, 20, 320, 202, 2014, 'sdsdfsd', '', 1, 0, 6, '2023-03-20', 0, NULL),
(45, 'Galaxy Note 10', '6418a0cb21b302.04457123.png', 'vcbcvb', 'Samsung', 21, '200000.00', 20, 20, 20, 20, 20, 2013, 'SDFSDF', '', 1, 0, 6, '2023-03-20', 0, NULL),
(46, 'Galaxy Note 10', '6418a11f5959d5.05807353.png', 'SDSDFSDF', 'Samsung', 19, '500.00', 20, 20, 20, 20, 2147483647, 2013, 'dfasdfefq', '', 1, 0, 6, '2023-03-20', 0, NULL),
(47, 'Huawe nova 2i', '6418a149b43664.67799667.png', '10320asdasdasd', 'Apple', 1, '10.00', 1, -2, -2, -2, -3, 2013, 'asdasd', '', 1, 0, 6, '2023-03-20', 0, NULL),
(48, 'Huawe nova 2i', '6418a195e164e2.19284068.png', '10320', 'Samsung', 19, '20.00', 20, 20, 20, 20, 20, 2013, '2020', '', 1, 0, 6, '2023-03-20', 0, NULL),
(49, 'Huawe nova 2i', '6418a24be45990.89228888.png', 'sdfsdBMBNM', 'Samsung', 2, '2220.00', 20, 20, 20, 20, 365, 2022, 'SDJMVGH', '', 1, 0, 6, '2023-03-20', 0, NULL),
(50, 'Huawe nova 2i', '6418a5b303abd6.85243623.png', 'yioguioui', 'Samsung', 18, '20.00', 20, 20, 20, 20, 20, 2022, '20', '', 1, 0, 6, '2023-03-20', 0, NULL),
(51, 'Galaxy Note 10', '6418a5f5c118b2.43733436.png', '10320asdasdasdasdasd', 'Apple', 1, '20.00', 20, 20, 20, 20, 20, 2013, '20', '', 1, 0, 6, '2023-03-20', 0, NULL),
(52, 'Galaxy Note 10', '6418a6321cbf83.73018996.png', '203659', 'Apple', 18, '99999.00', 20, 20, 20, 20, 20, 2013, '20', '', 1, 0, 6, '2023-03-20', 0, NULL),
(53, 'Galaxy Note 10', '6418aac8eb1896.17186539.png', '2356', 'Samsung', 21, '500.00', 20, 20, 2048, 20, 20, 2012, '20', '', 1, 0, 6, '2023-03-20', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products_name`
--

CREATE TABLE `tbl_products_name` (
  `ProductNameID` int(10) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `SoldCount` int(10) NOT NULL,
  `ReturnCount` int(10) NOT NULL,
  `AddUser` int(10) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(10) NOT NULL,
  `UpdateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products_name`
--

INSERT INTO `tbl_products_name` (`ProductNameID`, `ProductName`, `Category`, `SoldCount`, `ReturnCount`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Huawe nova 2i', '', 0, 0, 0, '0000-00-00', 0, '0000-00-00'),
(2, 'Galaxy Note 10', 'Huawei', 0, 0, 0, '0000-00-00', 0, '0000-00-00'),
(3, 'Sakuni', 'Nokia', 0, 0, 0, '0000-00-00', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_size`
--

CREATE TABLE `tbl_product_size` (
  `ProductSizeId` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Size` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product_size`
--

INSERT INTO `tbl_product_size` (`ProductSizeId`, `ProductID`, `Size`) VALUES
(1, 13, 'small'),
(2, 14, 'small'),
(3, 14, 'medium'),
(4, 14, 'large'),
(5, 14, 'exlarge'),
(6, 15, 'small'),
(7, 15, 'medium'),
(8, 15, 'large'),
(9, 15, 'exlarge'),
(10, 0, 'medium'),
(11, 0, 'medium'),
(12, 0, 'exlarge'),
(13, 16, 'small'),
(14, 17, 'large'),
(15, 18, 'medium'),
(16, 19, 'small'),
(17, 19, 'medium'),
(18, 20, 'small'),
(19, 21, 'small'),
(20, 22, 'medium'),
(21, 23, 'small'),
(22, 24, 'small'),
(23, 24, 'medium'),
(24, 26, 'small'),
(25, 27, 'medium'),
(26, 28, 'medium'),
(27, 29, 'small'),
(28, 30, 'small'),
(29, 31, 'small'),
(30, 32, 'small'),
(31, 33, 'large'),
(32, 33, 'exlarge'),
(33, 36, 'small'),
(34, 37, 'small'),
(35, 38, 'large'),
(36, 39, 'small'),
(37, 40, 'small'),
(38, 41, 'small'),
(39, 42, 'large'),
(40, 43, 'medium'),
(41, 44, 'exlarge'),
(42, 45, 'medium'),
(43, 46, 'medium'),
(44, 47, 'small'),
(45, 48, 'small'),
(46, 49, 'small'),
(47, 50, 'medium'),
(48, 51, 'small'),
(49, 52, 'small'),
(50, 53, 'small');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_redeemcodes`
--

CREATE TABLE `tbl_redeemcodes` (
  `RedeemcodeID` int(10) NOT NULL,
  `RedeemCode` varchar(10) NOT NULL,
  `Percentage` int(10) NOT NULL,
  `Status` int(20) NOT NULL,
  `Adduser` int(20) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(20) NOT NULL,
  `UpdateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_redeemcodes`
--

INSERT INTO `tbl_redeemcodes` (`RedeemcodeID`, `RedeemCode`, `Percentage`, `Status`, `Adduser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, '0', 10, 1, 5, '2023-03-07', 0, '0000-00-00'),
(2, 'CK50', 10, 1, 5, '2023-03-07', 0, '0000-00-00'),
(3, 'AQ20', 20, 2, 5, '2023-03-07', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stories`
--

CREATE TABLE `tbl_stories` (
  `SuccessID` int(20) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `CustomerImage` varchar(255) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `CustomerDescription` text NOT NULL,
  `SuccessStatus` int(5) NOT NULL,
  `AddUser` int(10) NOT NULL,
  `AddDate` date NOT NULL,
  `UpdateUser` int(10) NOT NULL,
  `UpdateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stories`
--

INSERT INTO `tbl_stories` (`SuccessID`, `CustomerName`, `CustomerImage`, `ProductName`, `CustomerDescription`, `SuccessStatus`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(1, 'Rajindra', '6403a201d81666.43356786.jfif', 'Huawei nova 2 i', 'Customer is happy', 1, 6, '2023-03-04', 0, '0000-00-00'),
(2, 'Charana', '6403a721bc6939.52096267.jfif', 'Oppo F17', 'Customer is happy', 1, 6, '2023-03-04', 0, '0000-00-00'),
(3, 'Pasan', '641611bf746208.14799460.jpeg', 'Samsung galaxy S10', 'customer is very happy for the product.', 0, 40, '2023-03-18', 0, '0000-00-00'),
(4, 'sd', '6418b100ab3a42.47364900sd.png', 'sd', 'sd', 1, 6, '2023-03-20', 0, '0000-00-00'),
(5, 'zte', '6418b25a537471.14840905zte.png', 'zte', 'zte product', 1, 6, '2023-03-20', 0, '0000-00-00'),
(6, 'zte', '6418b2a156fd61.76797709zte.png', 'zte', 'zte', 1, 6, '2023-03-20', 0, '0000-00-00'),
(7, 'zte', '6418b349612128.30208511zte.png', 'zte', 'zte', 1, 6, '2023-03-20', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `UserId` int(11) NOT NULL,
  `Title` varchar(10) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `UserRole` varchar(100) NOT NULL,
  `Status` int(20) NOT NULL,
  `UserImage` varchar(255) NOT NULL,
  `AddUser` int(11) NOT NULL,
  `AddDate` date DEFAULT NULL,
  `UpdateUser` int(11) NOT NULL,
  `UpdateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`UserId`, `Title`, `FirstName`, `LastName`, `UserName`, `Password`, `UserRole`, `Status`, `UserImage`, `AddUser`, `AddDate`, `UpdateUser`, `UpdateDate`) VALUES
(4, 'Mr.', 'pasan', 'wijerama', 'pasan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1', 1, '', 0, NULL, 0, NULL),
(5, 'Mr.', 'Admin', 'Officer', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'admin', 1, '', 0, NULL, 0, NULL),
(6, 'abc', 'Chanuri', 'Manager', 'abc', 'a9993e364706816aba3e25717850c26c9cd0d89d', 'manager', 1, '', 0, NULL, 0, NULL),
(7, 'Mr', 'Hima', 'Order Collector', 'himansa', 'dff53a4dee370852dfc5792c21df4d857f68037a', 'ordercollector', 1, '641375532cd782.05563060Hima.png', 0, NULL, 7, '2023-03-16'),
(8, 'Mr.', 'Charana', 'Order Distributor', 'w', 'aff024fe4ab0fece4091de044c58c9ae4233383a', 'orderdistributor', 1, '', 0, NULL, 0, NULL),
(9, 'Mr.', 'Sakuni', 'Store Keeper', 'e', '58e6b3a414a1e090dfc6029add0f3555ccba127f', 'storekeeper', 1, '', 0, NULL, 0, NULL),
(10, 'Mr.', 'Avishka', 'Return Officer', 'r', '4dc7c9ec434ed06502767136789763ec11d2c4b7', 'returnofficer', 1, '', 0, NULL, 0, NULL),
(11, 'Mr.', 'Sachin', 'Accountant', 't', '8efd86fb78a56a5145ed7739dcb00c78581c5375', 'accountant', 1, '', 0, NULL, 0, NULL),
(12, 'Mr.', 'Pasan MW', 'Owner', 'y', '95cb0bfd2977c761298d9624e4b4d4c72a39974a', 'owner', 1, '', 0, NULL, 0, NULL),
(13, 'Mr.', 'Reji', 'Warranty Claim Officer', 'u', '51e69892ab49df85c6230ccc57f8e1d1606caccc', 'warrantyofficer', 1, '', 0, NULL, 0, NULL),
(14, 'Miss', 'Stefan', 'Repair Officer', 'i', '042dc4512fa3d391c5170cf3aa61e6a638f84342', 'repiarofficer', 1, '', 0, NULL, 0, NULL),
(16, 'Mr.', 'dfsdfsd', 'sdfsdf', 'sdfsd', 'sdfsds', 'admin', 1, '', 0, NULL, 0, NULL),
(22, 'Miss', 'testing', 'testing', 'testing', '', '', 0, '', 0, NULL, 0, NULL),
(29, 'Mr', 'Pasan', 'Wijerama', 'Wijerama', '6b823d2ec39d8f98568c93ec4f1a16a9a3eb0cde', 'ordercollector', 1, '', 5, '2023-02-16', 0, NULL),
(30, 'Miss', 'Sakuni', 'Hagoda', 'Hagoda', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'ordercollector', 1, '', 5, '2023-02-17', 0, NULL),
(31, 'Mr', 'Testing', 'Pasan', 'Pasan', 'e893d4c3978432863b6032e0591882644516beaf', 'storekeeper', 1, '', 5, '2023-02-18', 0, NULL),
(32, 'Mr', 'sdfs', 'sdfsd', 'sdfsd', '056eafe7cf52220de2df36845b8ed170c67e23e3', 'manager', 1, '', 5, '2023-02-18', 0, NULL),
(33, 'Mr', 'asd', 'asd', 'asd', 'f10e2821bbbea527ea02200352313bc059445190', 'manager', 2, '', 5, '2023-02-18', 0, NULL),
(34, 'Mr', 'Tharindu', 'Bhagaya', 'Bhagaya', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'manager', 2, '', 5, '2023-02-19', 0, NULL),
(35, 'Mr', 'abc', 'qwe', 'qwe', '6ddf48140859b7c6ec877337f703f246e8983cfd', 'manager', 1, '', 5, '2023-02-19', 0, NULL),
(36, 'Mr', 'qwe', 'qwe', '1234', 'aade8e604c19c594ce081d5f479847e1a846c1ba', 'admin', 2, '', 5, '2023-02-19', 0, NULL),
(37, 'Miss', 'loga', 'mithrah', 'mithrah', 'afa3568b855e0b0e6e446825cde0ea7b877f1d28', 'manager', 1, '', 5, '2023-03-02', 0, NULL),
(38, 'Miss', 'Mia', 'Khalifa', 'khalifa@gmail.com', 'aade8e604c19c594ce081d5f479847e1a846c1ba', 'manager', 1, '6412eeaf662f62.16425154Mia.jpg', 5, '2023-03-16', 0, NULL),
(39, 'Mr', 'qqqqqw', 'qqqqqw', 'qqqqwq@gmail.com', 'qwerqwe', 'manager', 1, '641359067400f3.55103195qqqqqw.jpg', 5, '2023-03-16', 39, '2023-03-16'),
(40, 'Miss', 'mithrah', 'loga', 'mithrah2', 'afa3568b855e0b0e6e446825cde0ea7b877f1d28', 'manager', 1, '64160e89717ae5.22454565mithrah.jpg', 5, '2023-03-18', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `tbl_preorderproducts`
--
ALTER TABLE `tbl_preorderproducts`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `tbl_products_name`
--
ALTER TABLE `tbl_products_name`
  ADD PRIMARY KEY (`ProductNameID`);

--
-- Indexes for table `tbl_product_size`
--
ALTER TABLE `tbl_product_size`
  ADD PRIMARY KEY (`ProductSizeId`);

--
-- Indexes for table `tbl_redeemcodes`
--
ALTER TABLE `tbl_redeemcodes`
  ADD PRIMARY KEY (`RedeemcodeID`);

--
-- Indexes for table `tbl_stories`
--
ALTER TABLE `tbl_stories`
  ADD PRIMARY KEY (`SuccessID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `CustomerId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_preorderproducts`
--
ALTER TABLE `tbl_preorderproducts`
  MODIFY `ProductID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `ProductID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_products_name`
--
ALTER TABLE `tbl_products_name`
  MODIFY `ProductNameID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product_size`
--
ALTER TABLE `tbl_product_size`
  MODIFY `ProductSizeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_redeemcodes`
--
ALTER TABLE `tbl_redeemcodes`
  MODIFY `RedeemcodeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_stories`
--
ALTER TABLE `tbl_stories`
  MODIFY `SuccessID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
