-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2020 at 06:26 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testiology`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `uname` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `contactno` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `pic` varchar(50) DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `lseen` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `name`, `uname`, `passwd`, `contactno`, `email`, `address`, `doj`, `dob`, `pic`, `gender`, `lseen`) VALUES
(1, 'Greha ', 'Grehashah@123', 'Grehashah', '9624441248', 'grehashah56@gmail.com', 'Naranpura', '2019-12-01', '1999-06-07', 'a1.jpg', 'F', '2019-12-25 08:06:09'),
(2, 'Shrey', 'shrey', 'shrey', '8401529943', 'shrey1999.sp@gmail.com', 'Gurukul', '2019-12-10', '1999-05-11', 'a2.jpg', 'M', '2019-12-25 08:06:09');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `token` varchar(500) NOT NULL,
  `ready` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `token`, `ready`, `userid`) VALUES
(29, 'diDWSo6rDo4:APA91bFbUMaahH7qNN7OqMfNbznBY_65HfR3OOrGcWIFs0q8UuNCKqiXqSI2t_QAK5AcYuMyCFox9gny6qP2MwMmPc88Fw_DdrJ-oVVZtgQxCxM20R0LcJSD5lwHN9DIGxRps5Me_hWw', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `eid` int(11) NOT NULL,
  `doc` date NOT NULL,
  `subjectid` int(11) NOT NULL,
  `totalque` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `place` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`eid`, `doc`, `subjectid`, `totalque`, `attendance`, `place`) VALUES
(1, '2019-12-02', 1, 50, 20, 'DAIICT'),
(2, '2019-12-01', 2, 20, 2, 'DAIICT'),
(3, '2019-12-05', 3, 20, 20, 'HBK School'),
(4, '2019-12-06', 4, 40, 20, 'Arham Classis'),
(13, '2020-01-01', 2, 3, 1, 'Ahmedabad');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `exp` varchar(50) NOT NULL,
  `comment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`fid`, `email`, `exp`, `comment`) VALUES
(1, 'shrey1999.sp@gmail.com', 'good', 'It is very helpful for us.'),
(2, 'sachinjoshi@gmail.com', 'better', 'It is very helpful for us.');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `qid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `questions` varchar(500) NOT NULL,
  `option1` varchar(500) NOT NULL,
  `option2` varchar(500) NOT NULL,
  `option3` varchar(500) NOT NULL,
  `option4` varchar(500) NOT NULL,
  `answer` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`qid`, `subjectid`, `questions`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 1, 'The maximum number of Gold medals in Olympics 2008 was won by ?', 'China', 'France', 'U.S.A.', 'S.Korea', 'U.S.A.'),
(2, 2, 'Which one of the following is an application of Stack Data Structure?', 'Managing Function  Calls', 'The Stock Span Problem', 'Arithmetic Expression evaluation', 'All of the above', 'All of the above'),
(3, 3, ' In the relational modes, cardinality is termed as :', 'Number of tuples. ', ' Number of attributes', 'Number of tables. ', 'Number of constraints.', 'Number of tuples.'),
(4, 4, 'Delaration a pointer more than once may cause ____', 'Error', 'Abort', 'Trap', 'Null', 'Trap'),
(5, 2, 'Process of inserting an element in stack is called ____________', 'Create', 'Push', 'Evaluation', 'Pop', 'Push'),
(6, 2, 'Process of removing an element from stack is called __________', 'Create', 'Push', 'Evaluation', 'Pop', 'Pop'),
(7, 2, 'In a stack, if a user tries to remove an element from empty stack it is called _________', 'Underflow', 'Empty collection', 'Overflow', 'Garbage Collection', 'Underflow'),
(8, 2, 'Entries in a stack are “ordered”. What is the meaning of this statement?', 'A collection of stacks is sortable', 'Stack entries may be compared with the ‘<‘ operati', 'The entries are stored in a linked list', 'There is a Sequential entry that is one by one', 'There is a Sequential entry that is one by one'),
(9, 2, 'Consider a hash table of size seven, with starting index zero, and a hash function (3x + 4)mod7. Assuming the hash table is initially empty, which of the following is the contents of the table when the sequence 1, 3, 8, 10 is inserted into the table using closed hashing? Note that ‘_’ denotes an empty location in the table.', '8, _, _, _, _, _, 10', '1, 8, 10, _, _, _, 3', '1, _, _, _, _, _,3', '1, 10, 8, _, _, _, 3', '1, 8, 10, _, _, _, 3'),
(10, 2, 'Given the following input (4322, 1334, 1471, 9679, 1989, 6171, 6173, 4199) and the hash function x mod 10, which of the following statements are true? i. 9679, 1989, 4199 hash to the same value ii. 1471, 6171 hash to the same value iii. All elements hash to the same value iv. Each element hashes to a different value (GATE CS 2004)', 'i only', 'ii only', 'i and ii only', 'iii or iv', 'i and ii only'),
(12, 2, 'How many stacks are needed to implement a queue. Consider the situation where no other data structure like arrays, linked list is available to you.', '1', '2', '3', '4', '2'),
(13, 2, 'How many queues are needed to implement a stack. Consider the situation where no other data structure like arrays, linked list is available to you.', '1', '2', '3', '4', '2');

-- --------------------------------------------------------

--
-- Table structure for table `questionpaper`
--

CREATE TABLE `questionpaper` (
  `qpid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `eid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `rid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `correctans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`rid`, `userid`, `eid`, `rank`, `correctans`) VALUES
(9, 2, 13, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `name`) VALUES
(1, 'G.K.'),
(2, 'DS'),
(3, 'DBMS'),
(4, 'CPP');

-- --------------------------------------------------------

--
-- Table structure for table `userexam`
--

CREATE TABLE `userexam` (
  `ueid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userexam`
--

INSERT INTO `userexam` (`ueid`, `eid`, `uid`) VALUES
(8, 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `contactno` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `lseen` datetime DEFAULT NULL,
  `isauth` varchar(10) DEFAULT NULL,
  `qualification` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `uname`, `passwd`, `contactno`, `email`, `doj`, `lseen`, `isauth`, `qualification`) VALUES
(1, 'Juhidudhia@123', 'Juhidudhia', '8401529949', 'shrey1999.sp@gmail.com', '2019-12-12', '2019-12-10 11:09:36', 'yes', 'MscIT'),
(2, 'sachin', 'sachin12', '8765543450', 'sachinjoshi@gmail.com', '2019-12-01', '2020-01-01 09:39:05', 'yes', 'mscit');

-- --------------------------------------------------------

--
-- Table structure for table `usersanswer`
--

CREATE TABLE `usersanswer` (
  `uaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `subjectid` (`subjectid`);

--
-- Indexes for table `questionpaper`
--
ALTER TABLE `questionpaper`
  ADD PRIMARY KEY (`qpid`),
  ADD KEY `qid` (`qid`),
  ADD KEY `eid` (`eid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `eid` (`eid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `userexam`
--
ALTER TABLE `userexam`
  ADD PRIMARY KEY (`ueid`),
  ADD KEY `eid` (`eid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `usersanswer`
--
ALTER TABLE `usersanswer`
  ADD PRIMARY KEY (`uaid`),
  ADD KEY `qid` (`qid`),
  ADD KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `questionpaper`
--
ALTER TABLE `questionpaper`
  MODIFY `qpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userexam`
--
ALTER TABLE `userexam`
  MODIFY `ueid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usersanswer`
--
ALTER TABLE `usersanswer`
  MODIFY `uaid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`subjectid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionpaper`
--
ALTER TABLE `questionpaper`
  ADD CONSTRAINT `questionpaper_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questionpaper_ibfk_2` FOREIGN KEY (`eid`) REFERENCES `exams` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `exams` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userexam`
--
ALTER TABLE `userexam`
  ADD CONSTRAINT `userexam_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `exams` (`eid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userexam_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usersanswer`
--
ALTER TABLE `usersanswer`
  ADD CONSTRAINT `usersanswer_ibfk_1` FOREIGN KEY (`qid`) REFERENCES `question` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usersanswer_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
