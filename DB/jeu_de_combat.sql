-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Aug 02, 2023 at 07:39 AM
-- Server version: 10.6.12-MariaDB-1:10.6.12+maria~ubu2004-log
-- PHP Version: 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeu_de_combat`
--

-- --------------------------------------------------------

--
-- Table structure for table `heroes`
--

CREATE TABLE `heroes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT 0,
  `health_point` int(11) NOT NULL DEFAULT 100,
  `energy` int(11) NOT NULL,
  `defence` int(11) NOT NULL,
  `agility` int(11) NOT NULL,
  `lifesteal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `heroes`
--

INSERT INTO `heroes` (`id`, `name`, `class`, `lvl`, `health_point`, `energy`, `defence`, `agility`, `lifesteal`) VALUES
(127, 'Yup!', 'Archer', 4, -298, 54, 13, 66, 8),
(128, 'Yup!', 'Warrior', 1, -27, 28, 58, 21, 10),
(129, 'Warrior', 'Warrior', 4, -114, 11, 58, 21, 10),
(130, 'hero', 'Warrior', 11, -11, 27, 58, 21, 10),
(131, 'hero', 'Mage', 7, -403, 47, 33, 36, 0),
(132, 'Yup', 'Archer', 6, -80, 53, 13, 66, 24),
(133, 'Yup!', 'Warrior', 12, -82, 32, 58, 21, 58),
(134, 'Yup!', 'Warrior', 9, 0, 17, 58, 66, 14),
(135, 'Yup!', 'Warrior', 7, -130, 17, 58, 56, 10),
(136, 'Yup', 'Warrior', 11, -182, 33, 80, 21, 10),
(137, 'Yup!', 'Warrior', 8, 0, 16, 60, 26, 30),
(138, 'Urdad', 'Warrior', 8, 0, 4, 58, 21, 42),
(139, 'Urdad', 'Warrior', 1, 1665, 19, 58, 21, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
