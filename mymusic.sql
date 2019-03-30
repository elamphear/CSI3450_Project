-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2019 at 09:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mymusic`
--

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `playlistid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `globalflag` int(1) NOT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`playlistid`, `name`, `globalflag`, `userid`) VALUES
(1, 'All Songs', 1, NULL),
(2, 'Alternative Rock', 1, NULL),
(3, 'My Favorites', 0, 1),
(4, 'Classic Rock', 1, NULL),
(24, 'Admin Favorites', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `playlistid` int(11) NOT NULL,
  `songid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`playlistid`, `songid`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 3),
(3, 2),
(24, 2);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `songid` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `album` varchar(30) NOT NULL,
  `artist` varchar(30) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `songfilepath` varchar(100) NOT NULL,
  `albumartfilepath` varchar(100) NOT NULL,
  `premiumflag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`songid`, `title`, `album`, `artist`, `genre`, `songfilepath`, `albumartfilepath`, `premiumflag`) VALUES
(1, 'Without Me (Clean)', 'Without Me (Single)', 'Halsey', 'Alternative Rock', 'MusicFiles/halsey_without_me.mp3', 'AlbumArt/halsey_without_me.png', 0),
(2, 'Under Pressure', 'Nothing Has Changed', 'David Bowie', 'Rock', 'MusicFiles/bow_under_pressure.mp3', 'AlbumArt/bowie_nothing.png', 1),
(3, 'High Hopes', 'Pray for the Wicked', 'Panic at the Disco', 'Alternative Rock', 'MusicFiles\\patd_high_hopes.mp3', 'AlbumArt\\patd_high_hopes.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `userfname` varchar(20) NOT NULL,
  `userlname` varchar(20) NOT NULL,
  `subscriptionstatus` int(11) NOT NULL,
  `adminflag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `userfname`, `userlname`, `subscriptionstatus`, `adminflag`) VALUES
(1, 'esl', 'esl', 'Eric', 'Lamphear', 1, 0),
(2, 'admin', 'admin', 'Admin', 'User', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`playlistid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD KEY `playlistid` (`playlistid`),
  ADD KEY `songid` (`songid`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`songid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `playlistid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `songid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `FK` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD CONSTRAINT `PK1` FOREIGN KEY (`playlistid`) REFERENCES `playlists` (`playlistid`),
  ADD CONSTRAINT `PK2` FOREIGN KEY (`songid`) REFERENCES `songs` (`songid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
