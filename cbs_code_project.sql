-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 27, 2019 at 10:50 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.11-2+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbs_code_project`
--

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`id`, `created_at`, `updated_at`, `actor_name`) VALUES
(1, '2019-07-09 04:00:00', '2019-07-09 04:00:00', 'Brad Pitt'),
(2, '2019-07-16 06:45:55', '2019-07-16 06:45:55', 'Tom Cruise'),
(3, '2019-07-16 06:50:26', '2019-07-16 06:50:26', 'Cate Blanchett'),
(4, '2019-07-16 07:01:23', '2019-07-16 07:01:23', 'George Clooney'),
(5, '2019-07-24 06:34:27', '2019-07-24 06:34:27', 'Kelly McGillis'),
(6, '2019-07-27 02:27:46', '2019-07-27 02:27:46', 'Mahershala Ali'),
(7, '2019-07-28 06:21:05', '2019-07-28 06:21:05', 'Andy Garcia'),
(8, '2019-07-28 06:22:27', '2019-07-28 06:22:27', 'Val Kilmer');

--
-- Dumping data for table `actors_movies`
--

INSERT INTO `actors_movies` (`id`, `created_at`, `updated_at`, `actor_id`, `movie_id`, `actor_base_pay`, `actor_revenue_share`, `movie_character_name`) VALUES
(1, '2019-07-10 04:00:00', '2019-07-10 04:00:00', 1, 1, '100000.00', '20.00', 'Benjamin Button'),
(2, '2019-07-10 04:00:00', '2019-07-10 04:00:00', 1, 2, '80000.00', '20.00', 'Rusty Ryan'),
(3, '2019-07-16 07:17:20', '2019-07-16 07:17:20', 4, 2, '100000.00', '80.00', 'Danny Ocean'),
(4, '2019-07-24 05:48:23', '2019-07-24 05:48:23', 3, 1, '100000.00', '100.00', 'Daisy'),
(5, '2019-07-26 06:05:51', '2019-07-26 06:05:51', 2, 3, '80000.00', '120.00', 'Maverick'),
(6, '2019-07-27 02:28:03', '2019-07-27 02:28:03', 6, 1, '1000.00', '10000.00', 'Tizzy'),
(7, '2019-07-28 06:21:28', '2019-07-28 06:21:28', 7, 2, '80000.00', '10000.00', 'Terry Benedict'),
(8, '2019-07-28 06:23:06', '2019-07-28 06:23:06', 8, 3, '10000.00', '1000.00', 'Iceman'),
(9, '2019-07-28 06:24:59', '2019-07-28 06:24:59', 5, 3, '100000.00', '10000.00', 'Charlie');

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `created_at`, `updated_at`, `movie_name`, `production_companies_id`, `production_company_revenue_share`) VALUES
(1, '2019-07-10 04:00:00', '2019-07-10 04:00:00', 'The Curious Case of Benjamin Button', 2, '80.00'),
(2, '2019-07-10 04:00:00', '2019-07-10 04:00:00', 'Ocean\'s Eleven', 2, '80.00'),
(3, '2019-07-24 06:52:45', '2019-07-24 06:52:45', 'Top Gun', 1, '120000.00');

--
-- Dumping data for table `production_companies`
--

INSERT INTO `production_companies` (`id`, `created_at`, `updated_at`, `company_name`) VALUES
(1, '2019-07-10 04:00:00', '2019-07-10 04:00:00', 'Paramount Pictures'),
(2, '2019-07-10 04:00:00', '2019-07-10 04:00:00', 'Warner Brothers'),
(3, '2019-07-24 06:58:23', '2019-07-24 06:58:23', 'Miramax');

--
-- Dumping data for table `scripts`
--

INSERT INTO `scripts` (`id`, `created_at`, `updated_at`, `movie_id`) VALUES
(1, '2019-07-26 06:25:30', '2019-07-26 06:25:30', 1),
(2, '2019-07-28 00:06:31', '2019-07-28 00:06:31', 2),
(3, '2019-07-28 06:29:19', '2019-07-28 06:29:19', 3);

--
-- Dumping data for table `script_lines`
--

INSERT INTO `script_lines` (`id`, `created_at`, `updated_at`, `script_id`, `actor_id`, `line`) VALUES
(2, '2019-07-26 07:29:19', '2019-07-26 07:29:19', 1, '4', 'Did you know turkeys aren\'t really birds...?'),
(3, '2019-07-27 01:06:19', '2019-07-27 01:06:19', 1, '1', 'Why do you say that, Daisy?'),
(4, '2019-07-27 01:11:00', '2019-07-27 01:11:00', 1, '4', 'They\'re in the pheasant family. They can hardly fly. It\'s sad don\'t you think? A bird, that can\'t fly.'),
(5, '2019-07-27 23:55:50', '2019-07-27 23:55:50', 1, '1', '(whispers) I heard Tizzy and my mother whisper. They said I was going to die soon. (smiles) But I fooled them so far.'),
(6, '2019-07-28 00:06:31', '2019-07-28 00:06:31', 2, '3', 'Contrary to what Mr. Ryan may say,\n                   Seth, I always check my cards\n                   before I make a bet. But be\n                   cafeful. I could tell from your\n                   face you\'re holding three of a\n                   kind or better.\n                          (digging his wallet\n                           out)\n                   Five hundred to call. And two\n                   grand more.'),
(7, '2019-07-28 00:06:59', '2019-07-28 00:06:59', 2, '2', 'Guys, you\'re free to do what you\n                   like. It\'s a lot of money. But\n                   I\'m staying in. He\'s trying to\n                   buy his way out of his bluff.'),
(8, '2019-07-28 06:29:19', '2019-07-28 06:29:19', 3, '8', 'Maverick, figured it out yet?'),
(9, '2019-07-28 06:29:43', '2019-07-28 06:29:43', 3, '5', 'Figured out what, Iceman?'),
(10, '2019-07-28 06:29:58', '2019-07-28 06:29:58', 3, '8', 'Who is the best.'),
(11, '2019-07-28 06:30:09', '2019-07-28 06:30:09', 3, '5', 'Nope.'),
(12, '2019-07-28 06:30:22', '2019-07-28 06:30:22', 3, '8', 'Need a hint?'),
(13, '2019-07-28 06:30:36', '2019-07-28 06:30:36', 3, '5', 'I think I can work it out on my \n	own.'),
(14, '2019-07-28 06:30:55', '2019-07-28 06:30:55', 3, '8', 'You like to work alone. I\'ve heard \r\n	that about you, Maverick.'),
(15, '2019-07-28 06:31:19', '2019-07-28 06:31:19', 3, '5', 'I\'ve heard of you, too. You were in \n	124 with Bargamian.'),
(16, '2019-07-28 06:31:42', '2019-07-28 06:31:42', 3, '8', 'And you were with Cougar. He was my \n	roommate in flight school.'),
(17, '2019-07-28 06:32:06', '2019-07-28 06:32:06', 3, '5', 'He\'s a good man.'),
(18, '2019-07-28 06:32:23', '2019-07-28 06:32:23', 3, '8', 'The best.'),
(19, '2019-07-28 06:33:17', '2019-07-28 06:33:17', 3, '9', 'Long cruise, was it?'),
(20, '2019-07-28 06:33:31', '2019-07-28 06:33:31', 3, '9', 'Anything I can do to help, Lieutenant?'),
(21, '2019-07-28 06:33:45', '2019-07-28 06:33:45', 3, '5', 'Lots of things.'),
(22, '2019-07-28 06:33:59', '2019-07-28 06:33:59', 3, '9', 'I\'ll bet!'),
(23, '2019-07-28 06:34:16', '2019-07-28 06:34:16', 3, '5', 'Uhhh...Anything I can do for you?'),
(24, '2019-07-28 06:34:37', '2019-07-28 06:34:37', 3, '9', 'Yeah. Hold this. It might be safer.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
