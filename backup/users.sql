-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2024 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbc`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `surname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `countryId` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password`, `countryId`, `admin`) VALUES
(8, 'Pero', 'Perović', 'pperovic@tvz.hr', 'Pero', '$2y$12$FLhA3y8O3JYpZ9fHXn6kHeOHgRJqm3H16uZK6hAxiBFFk2wFxGAZa', 27, 0),
(12, 'Jakov', 'Košutić', 'jkosutic@tvz.hr', 'Jeryux', '$2y$12$nNnE1gyv7qguUolnwTL1Je6kcclpnu8/.goQr35.bw.g7i/OBVUUK', 52, 1),
(14, 'vedra', 'na', 'stelasimunov@gmail.com', 'Adamery', '$2y$12$ipHe/gkeWqGrb2vIYbLG7um50wPO.PrTHpY/tXZozAb3Zf/HBkV86', 6, 0),
(15, 'Macka', 'Smdic', 'mcka@gmail.com', 'Mackus', '$2y$12$b9KGucLESHeC9Gr9ORRkZu6dQyqmdt5tP1e2y2i3G83L3VsvuvM9a', 136, 0),
(16, 'Stela', 'Košutić', 'skos@gmail.com', 'StinkyKitty', '$2y$12$q0Tv9UOaa2gkR9XTSk.zWe7dr8gk1UU0Me7ygInaqN5.mSFdrHJty', 197, 0),
(17, 'Dobbs', 'Vasudeva', 'vasudeva_do@gmail.com', 'Vdobbs', '$2y$12$v4aO/TWpHFJzG2dJ794mpeka2Moa5m66MPwmB.q2k2VltylffH3Zu', 87, 0),
(18, 'Verner', 'Gingrich', 'vern@gmail.com', 'Vern', '$2y$12$gUmwnV6yQVkQNptbsuPMwehLXWMG3CRLrYxtC.Jc2BaHgals63qaG', 43, 0),
(19, 'Melantha', 'Edgell', 'medgell@gmai.com', 'Med', '$2y$12$8VHenQh7GcDcEUBCG4jZuOVEz8.UAlxhcButceXGgVKaPmTSOynha', 105, 0),
(20, 'Cathan', 'Straight', 'cath-straig@gmail.com', 'Cath', '$2y$12$WjHV.09ZF.xggdVG/dbD/O5T7RMMTi170B.ezk5J5PXp9.UqDIgNO', 6, 0),
(21, 'Parr', 'Sacco', 'par@gmail.com', 'Parer', '$2y$12$G.rDBXgUjcmY16MV6fiQ4eBoBpRrzDW8VbPbPqVVmDdxQ9O5oP7dC', 188, 0),
(22, 'Saviero', 'Obanion', 'savie.obani@gmai.com', 'Savvvi', '$2y$12$weYeK11gjwzEwN6NILRm4O.ahLLa2/xeXsGc/.tSpUT9UXMeq1ORW', 14, 0),
(23, 'Dwaine', 'Barahona', 'barara@gmail.com', 'Bara', '$2y$12$hoOzFmZ/P/b7/u5bdA659e/2c2/GY7hMlWENki0oWLZRRzjRbeFe.', 118, 0),
(25, 'a', 'a', 'a@a.a', 'a', '$2y$12$pec6E4zGrY1/SI1Q4I/RQejI/N6K6hmDQnru.F0GtvALYmRh4b5YW', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
