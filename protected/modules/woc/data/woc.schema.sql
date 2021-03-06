-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 06 lug, 2011 at 08:31 PM
-- Versione MySQL: 5.1.54
-- Versione PHP: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `woc`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `woc_suggestions`
--

DROP TABLE IF EXISTS `woc_suggestions`;
CREATE TABLE IF NOT EXISTS `woc_suggestions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `threadId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `desc` text,
  `dateCreated` datetime NOT NULL,
  `votes_up` smallint(6) DEFAULT '0',
  `votes_mid` smallint(6) DEFAULT '0',
  `votes_down` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `woc_threads`
--

DROP TABLE IF EXISTS `woc_threads`;
CREATE TABLE IF NOT EXISTS `woc_threads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `short_desc` tinytext NOT NULL,
  `desc` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `woc_users`
--

DROP TABLE IF EXISTS `woc_users`;
CREATE TABLE IF NOT EXISTS `woc_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nickname` varchar(70) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `karma` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `woc_votes`
--

DROP TABLE IF EXISTS `woc_votes`;
CREATE TABLE IF NOT EXISTS `woc_votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `suggestionId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `datetime` datetime NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
