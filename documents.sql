-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 01:22 PM
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
-- Database: `documents`
--

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE `doc` (
  `id` bigint(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `Matricule` varchar(50) NOT NULL,
  `status` enum('Pending','Accepted','Refused') NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc`
--

INSERT INTO `doc` (`id`, `name`, `Matricule`, `status`, `created_at`) VALUES
(377, 'Certificate of Achievement or Diploma', 'MAT2023006', 'Accepted', '2025-06-22 11:01:46');

-- --------------------------------------------------------

--
-- Table structure for table `grade_appeal`
--

CREATE TABLE `grade_appeal` (
  `id` int(11) NOT NULL,
  `moduleName` varchar(255) NOT NULL,
  `teacherName` varchar(255) NOT NULL,
  `wrongNote` decimal(4,2) NOT NULL CHECK (`wrongNote` between 0 and 20),
  `correctNote` decimal(4,2) NOT NULL CHECK (`correctNote` between 0 and 20),
  `status` enum('Pending','Accepted','Refused') DEFAULT 'Pending',
  `matricule` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main`
--

CREATE TABLE `main` (
  `Matricule` varchar(50) NOT NULL,
  `annee` date NOT NULL,
  `groupe` int(3) NOT NULL,
  `section` int(3) NOT NULL,
  `specialite` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`Matricule`, `annee`, `groupe`, `section`, `specialite`) VALUES
('MAT2023001', '2023-09-01', 101, 1, 'Computer Science'),
('MAT2023003', '2023-09-01', 103, 2, 'Electrical Engineering'),
('MAT2023004', '2023-09-01', 104, 2, 'Civil Engineering'),
('MAT2023005', '2023-09-01', 105, 3, 'Mathematics'),
('MAT2023006', '2024-05-12', 1, 2, 'Computer Science'),
('MAT2023007', '2025-06-24', 1, 3, 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `main_ad`
--

CREATE TABLE `main_ad` (
  `code` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_ad`
--

INSERT INTO `main_ad` (`code`, `email`) VALUES
('password', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(12) NOT NULL,
  `Matricule` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `verification_token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Matricule`, `firstName`, `lastName`, `email`, `password`, `verification_token`) VALUES
(24, 'MAT2023001', 'student name', 'student last name ', 'student@gmil.com', '3489b909418aec96e54689274211bf1a', ''),
(25, 'MAT2023006', 'user', 'last name', 'user@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_ad`
--

CREATE TABLE `users_ad` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_ad`
--

INSERT INTO `users_ad` (`id`, `firstName`, `lastName`, `email`, `password`, `code`) VALUES
(15, 'admin', '1', 'admin@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Test` (`Matricule`);

--
-- Indexes for table `grade_appeal`
--
ALTER TABLE `grade_appeal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matricule` (`matricule`);

--
-- Indexes for table `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`Matricule`);

--
-- Indexes for table `main_ad`
--
ALTER TABLE `main_ad`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Matricule` (`Matricule`);

--
-- Indexes for table `users_ad`
--
ALTER TABLE `users_ad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc`
--
ALTER TABLE `doc`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=379;

--
-- AUTO_INCREMENT for table `grade_appeal`
--
ALTER TABLE `grade_appeal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users_ad`
--
ALTER TABLE `users_ad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doc`
--
ALTER TABLE `doc`
  ADD CONSTRAINT `Test` FOREIGN KEY (`Matricule`) REFERENCES `main` (`Matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grade_appeal`
--
ALTER TABLE `grade_appeal`
  ADD CONSTRAINT `grade_appeal_ibfk_1` FOREIGN KEY (`matricule`) REFERENCES `main` (`Matricule`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`Matricule`) REFERENCES `main` (`Matricule`);

--
-- Constraints for table `users_ad`
--
ALTER TABLE `users_ad`
  ADD CONSTRAINT `fk_code` FOREIGN KEY (`code`) REFERENCES `main_ad` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
