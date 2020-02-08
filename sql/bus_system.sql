-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2020 at 10:55 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_location`
--

CREATE TABLE `bus_location` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `today_date` date DEFAULT NULL,
  `currentLocation` varchar(200) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_location`
--

INSERT INTO `bus_location` (`id`, `bus_id`, `today_date`, `currentLocation`, `last_updated`) VALUES
(15, 2, '2020-02-08', '11.0256128,76.976128', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bus_master`
--

CREATE TABLE `bus_master` (
  `id` int(11) NOT NULL,
  `bus_num` varchar(100) NOT NULL,
  `register_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_master`
--

INSERT INTO `bus_master` (`id`, `bus_num`, `register_number`) VALUES
(1, 'b05', 'TN66A5645'),
(2, 'A11', 'TN37Q8909');

-- --------------------------------------------------------

--
-- Table structure for table `driver_master`
--

CREATE TABLE `driver_master` (
  `id` int(11) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `driver_email` varchar(100) NOT NULL,
  `driver_password` varchar(100) NOT NULL,
  `driver_phone` varchar(100) NOT NULL,
  `bus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_master`
--

INSERT INTO `driver_master` (`id`, `driver_name`, `driver_email`, `driver_password`, `driver_phone`, `bus_id`) VALUES
(1, 'Gopal', 'aea@g.c', '111', '9597927183', 2),
(2, 'sundhar', 'sundhar@gmail.com', '111', '6987451230', 1);

-- --------------------------------------------------------

--
-- Table structure for table `route_master`
--

CREATE TABLE `route_master` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `bus_from` varchar(200) NOT NULL,
  `bus_to` varchar(200) NOT NULL,
  `route_map` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_master`
--

INSERT INTO `route_master` (`id`, `bus_id`, `bus_from`, `bus_to`, `route_map`) VALUES
(1, 1, 'pollachi', 'skasc', 'kinathukadavu,othakaalmandabam,sundhurapuram,aathupalam,kuniyamuthur'),
(2, 2, 'avinashi', 'skasc', 'thirupur,palladam,sulur,singanallur,ramanathapuram,ukkadam,aathupalam,kuniyamuthur');

-- --------------------------------------------------------

--
-- Table structure for table `temp_route`
--

CREATE TABLE `temp_route` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `bus_from` varchar(100) NOT NULL,
  `bus_to` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `temp_route_map` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_route`
--

INSERT INTO `temp_route` (`id`, `bus_id`, `bus_from`, `bus_to`, `date`, `temp_route_map`) VALUES
(2, 2, 'avinashi', 'skasc', '2019-02-15', 'thirupur,palladam,sulur,singanallur,ramanathapuram,ukkadam,aathupalam'),
(3, 2, 'avinashi', 'skasc', '2019-02-23', 'thirupur,palladam,sulur,singanallur,ramanathapuram,ukkadam,aathupalam,kuniyamuthur'),
(4, 1, 'pollachi', 'skasc', '2019-02-23', 'kinathukadavu,othakaalmandabam,sundhurapuram,aathupalam,kuniyamuthur'),
(5, 2, 'avinashi', 'skasc', '2019-02-28', 'thirupur,palladam,sulur,singanallur,ramanathapuram,ukkadam,aathupalam,kuniyamuthur');

-- --------------------------------------------------------

--
-- Table structure for table `today_ride`
--

CREATE TABLE `today_ride` (
  `id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `today_date` date NOT NULL,
  `completed_route` longtext NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `today_ride`
--

INSERT INTO `today_ride` (`id`, `bus_id`, `today_date`, `completed_route`, `last_updated`) VALUES
(4, 2, '2019-02-19', ',thirupur,palladam,sulur,singanallur,ramanathapuram,ukkadam,aathupalam,kuniyamuthur', '2019-02-19 11:29:53'),
(5, 2, '2019-02-22', ',thirupur,palladam,sulur,singanallur,ramanathapuram,ukkadam,aathupalam,kuniyamuthur', '2019-02-22 18:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `user_email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_mobile` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL DEFAULT 'student',
  `bus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `user_email`, `password`, `user_mobile`, `user_type`, `bus_id`) VALUES
(3, 'admin', 'aravindancadet@gmail.com', '111', '9597927183', 'admin', 0),
(4, 'student 1', 'niranjanr2606@gmail.com', '111', '9597927183', 'student', 2),
(5, 'student 2', 'j.saferio17@gmail.com', '222', '9597927183', 'student', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus_location`
--
ALTER TABLE `bus_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `bus_master`
--
ALTER TABLE `bus_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_master`
--
ALTER TABLE `driver_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `route_master`
--
ALTER TABLE `route_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `temp_route`
--
ALTER TABLE `temp_route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `today_ride`
--
ALTER TABLE `today_ride`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus_location`
--
ALTER TABLE `bus_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bus_master`
--
ALTER TABLE `bus_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `driver_master`
--
ALTER TABLE `driver_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `route_master`
--
ALTER TABLE `route_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_route`
--
ALTER TABLE `temp_route`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `today_ride`
--
ALTER TABLE `today_ride`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus_location`
--
ALTER TABLE `bus_location`
  ADD CONSTRAINT `bus_location_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus_master` (`id`);

--
-- Constraints for table `driver_master`
--
ALTER TABLE `driver_master`
  ADD CONSTRAINT `driver_master_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus_master` (`id`);

--
-- Constraints for table `route_master`
--
ALTER TABLE `route_master`
  ADD CONSTRAINT `route_master_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus_master` (`id`);

--
-- Constraints for table `temp_route`
--
ALTER TABLE `temp_route`
  ADD CONSTRAINT `temp_route_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus_master` (`id`);

--
-- Constraints for table `today_ride`
--
ALTER TABLE `today_ride`
  ADD CONSTRAINT `today_ride_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus_master` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
