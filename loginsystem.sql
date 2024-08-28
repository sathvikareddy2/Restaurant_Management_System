-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2019 at 12:32 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: loginsystem
--

-- --------------------------------------------------------

--
-- Table structure for table reservation
--

DROP TABLE IF EXISTS reservation;
CREATE TABLE IF NOT EXISTS reservation (
  reserv_id int(11) NOT NULL AUTO_INCREMENT,
  f_name text NOT NULL,
  l_name text NOT NULL,
  num_guests int(11) NOT NULL,
  num_tables int(11) NOT NULL,
  rdate date NOT NULL,
  time_zone text NOT NULL,
  telephone text NOT NULL,
  comment mediumtext NOT NULL,
  reg_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_fk int(11) NOT NULL,
  PRIMARY KEY (reserv_id),
  KEY users_fk (user_fk)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

--
-- Dumping data for table reservation
--



-- --------------------------------------------------------

--
-- Table structure for table role
--

DROP TABLE IF EXISTS role;
CREATE TABLE IF NOT EXISTS role (
  role_id int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (role_id),
  KEY role_id (role_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table role
--

INSERT INTO role (role_id) VALUES
(1),
(2),
(3);




--
-- Table structure for table users
--

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  user_id int(11) NOT NULL AUTO_INCREMENT,
  uidUsers tinytext NOT NULL,
  emailUsers tinytext NOT NULL,
  pwdUsers longtext NOT NULL,
  reg_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  role_id int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (user_id),
  KEY role_id (role_id)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table users
--



--
-- Constraints for dumped tables
--

--
-- Constraints for table reservation
--
ALTER TABLE reservation
  ADD CONSTRAINT idusers FOREIGN KEY (user_fk) REFERENCES users (user_id);

--
-- Constraints for table users
--
ALTER TABLE users
  ADD CONSTRAINT users_ibfk_1 FOREIGN KEY (role_id) REFERENCES role (role_id) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;