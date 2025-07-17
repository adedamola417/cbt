-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 20, 2025 at 02:33 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlu_cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_option` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 'What is the capital of Nigeria?', 'Lagos', 'Abuja', 'Port Harcourt', 'Kano', 'B'),
(2, 'What is the largest planet in our solar system?', 'Earth', 'Saturn', 'Jupiter', 'Uranus', 'C'),
(3, 'Who is the author of \"To Kill a Mockingbird\"?', 'F. Scott Fitzgerald', 'Harper Lee', 'Jane Austen', 'J.K. Rowling', 'B'),
(4, 'What is the chemical symbol for gold?', 'Ag', 'Au', 'Hg', 'Pb', 'B'),
(5, 'What is the process by which plants make their own food?', 'Respiration', 'Photosynthesis', 'Decomposition', 'Fermentation', 'B'),
(6, 'Which of the following authors wrote \"The Great Gatsby\"?', 'F. Scott Fitzgerald', 'Ernest Hemingway', 'William Faulkner', 'John Steinbeck', 'A'),
(7, 'What is the largest mammal on Earth?', 'Blue whale', 'Fin whale', 'Humpback whale', 'Sperm whale', 'A'),
(8, 'Who painted the famous artwork \"The Starry Night\"?', 'Leonardo da Vinci', 'Vincent van Gogh', 'Pablo Picasso', 'Claude Monet', 'B'),
(9, 'What is the smallest country in the world, both in terms of population and land area?', 'Vatican City', 'Monaco', 'Nauru', 'Tuvalu', 'A'),
(10, 'Who is the main character in the novel \"The Catcher in the Rye\"?', 'Holden Caulfield', 'Huckleberry Finn', 'Heathcliff', 'Sherlock Holmes', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `answers` json NOT NULL,
  `video_path` varchar(255) NOT NULL,
  `submission_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
