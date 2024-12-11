-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 15, 2023 at 07:24 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rescron_export`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `auto_wallets`
--

CREATE TABLE `auto_wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deposit_coin_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whitelisted` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `c_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bots`
--

CREATE TABLE `bots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_min` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bot_activations`
--

CREATE TABLE `bot_activations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bot_id` bigint(20) UNSIGNED NOT NULL,
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_in` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gen_timestamps` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_sequence` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_timestamp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_profit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `next_trade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bot_histories`
--

CREATE TABLE `bot_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bot_id` bigint(20) UNSIGNED NOT NULL,
  `bot_activation_id` bigint(20) UNSIGNED NOT NULL,
  `capital` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pair` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exit_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profit_percent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timestamp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cron_jobs`
--

CREATE TABLE `cron_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_run` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'link',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cron_jobs`
--

INSERT INTO `cron_jobs` (`id`, `name`, `last_run`, `type`, `created_at`, `updated_at`) VALUES
(1, 'bot-cron-one', '1694166794', 'link', '2023-09-07 19:48:56', '2023-09-08 08:53:14'),
(2, 'delete-logs', '1694119736', 'link', '2023-09-07 19:48:56', '2023-09-07 19:48:56'),
(3, 'queue-work', '1694119736', 'link', '2023-09-07 19:48:56', '2023-09-07 19:48:56'),
(4, 'schedule-run', '1697354230', 'php', '2023-10-15 06:17:10', '2023-10-15 06:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deposit_coin_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `converted_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `network` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_until` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_wallet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_coins`
--

CREATE TABLE `deposit_coins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_regex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `network` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smart_contract` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `network_precision` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precision` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `can_withdraw` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposit_coins`
--

INSERT INTO `deposit_coins` (`id`, `code`, `name`, `wallet_regex`, `priority`, `logo_url`, `network`, `smart_contract`, `network_precision`, `precision`, `ticker`, `status`, `can_withdraw`, `created_at`, `updated_at`) VALUES
(1, '1INCH', '1inch Network', '^(0x)[0-9A-Fa-f]{40}$', '168', '/images/coins/1inch.svg', 'eth', '0x111111111117dc0aa78b770fa6a738034120c302', '18', '8', '1inch', 0, '0', '2023-08-11 07:40:51', '2023-08-30 13:45:55'),
(2, '1INCHBSC', '1Inch Network (BSC)', '^(0x)[0-9A-Fa-f]{40}$', '171', '/images/coins/1inchbsc.svg', 'bsc', '0x111111111117dc0aa78b770fa6a738034120c302', '18', '8', '1inch', 0, '0', '2023-08-11 07:40:51', '2023-08-30 13:45:55'),
(3, 'AAVE', 'Aave', '^(0x)[0-9A-Fa-f]{40}$', '127', '/images/coins/aave.svg', 'eth', '0x7Fc66500c84A76Ad7e9c93437bFc5Ac33E2DDaE9', '18', '8', 'aave', 0, '0', '2023-08-11 07:40:51', '2023-08-30 13:45:55'),
(4, 'ADA', 'Cardano', '^([1-9A-HJ-NP-Za-km-z]{59,104})|([0-9A-Za-z]{58,104})$', '21', '/images/coins/ada.svg', 'ada', NULL, '6', '8', 'ada', 0, '0', '2023-08-11 07:40:51', '2023-08-30 13:45:55'),
(5, 'AE', 'AE', '^ak_[A-Za-z0-9]{49,52}$', '15', '/images/coins/ae.svg', NULL, NULL, NULL, '8', NULL, 0, '0', '2023-08-11 07:40:51', '2023-08-30 13:45:55'),
(6, 'ALGO', 'ALGO', '^[A-Z0-9]{58}$', '15', '/images/coins/algo.svg', 'algo', NULL, '6', '8', 'algo', 0, '0', '2023-08-11 07:40:51', '2023-08-30 13:45:55'),
(7, 'APE', 'ApeCoin', '^(0x)[0-9A-Fa-f]{40}$', '174', '/images/coins/ape.png', 'eth', '0x4d224452801aced8b2f0aebe155379bb5d594381', '18', '8', 'ape', 0, '0', '2023-08-11 07:40:51', '2023-08-30 13:45:55'),
(8, 'APT', 'Aptos', '^(0x)[0-9A-Za-z]{64}$', '200', '/images/coins/apt.svg', 'apt', NULL, NULL, '8', 'apt', 0, '0', '2023-08-11 07:40:51', '2023-08-30 13:45:55'),
(9, 'ARB', 'Arbitrum', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/arbitrum.svg', 'arbitrum', '0x912CE59144191C1204E64559FE8253a0e49E6548', '18', '8', 'arb', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(10, 'ARK', 'ARK', '^(A)[A-Za-z0-9]{33}$', '10', '/images/coins/ark.svg', 'ark', NULL, '8', '8', 'ark', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(11, 'ARPA', 'ARPA Chain', '^(0x)[0-9A-Fa-f]{40}$', '151', '/images/coins/arpa.svg', 'eth', '0xba50933c268f567bdc86e1ac131be072c6b0b71a', '18', '8', 'arpa', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(12, 'ARV', 'Ariva', '^(0x)[0-9A-Fa-f]{40}$', '167', '/images/coins/ariva.svg', 'bsc', '0x6679eb24f59dfe111864aec72b443d1da666b360', '8', '8', 'arv', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(13, 'ATLAS', 'Star Atlas', '[1-9A-HJ-NP-Za-km-z]{32,44}', '200', '/images/coins/atlas.svg', 'sol', NULL, NULL, '8', 'atlas', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(14, 'ATOM', 'Cosmos', '^(cosmos1)[0-9a-z]{38}$', '139', '/images/coins/atom.svg', 'atom', NULL, '6', '8', 'atom', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(15, 'AVA', 'Travala.com', '^(bnb1)[0-9a-z]{38}$', '15', '/images/coins/ava.svg', 'bnb', 'AVA-645', '7', '8', 'ava', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(16, 'AVABSC', 'Travala.com', '^(0x)[0-9A-Fa-f]{40}$', '152', '/images/coins/ava.svg', 'bsc', '0x13616f44ba82d63c8c0dc3ff843d36a8ec1c05a9', '18', '8', 'ava', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(17, 'AVAERC20', 'Travala.com', '^(0x)[0-9A-Fa-f]{40}$', '147', '/images/coins/ava.svg', 'eth', '0x442b153f6f61c0c99a33aa4170dcb31e1abda1d0', '18', '8', 'ava', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(18, 'AVAX', 'AVAX', '^(X-avax)[0-9A-za-z]{39}$', '104', '/images/coins/avax.svg', 'xchain', NULL, '9', '8', 'avax', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(19, 'AVAXC', 'Avalanche (C-Chain)', '^(0x)[0-9A-Fa-f]{40}$', '164', '/images/coins/avaxc.svg', 'cchain', NULL, '18', '8', 'avax', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(20, 'AVN', 'AVNRich', '^(0x)[0-9A-Fa-f]{40}$', '165', '/images/coins/avn.svg', 'bsc', '0xbf151f63d8d1287db5fc7a3bc104a9c38124cdeb', '18', '8', 'avn', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(21, 'AXS', 'Axie Infinity', '^(0x)[0-9A-Fa-f]{40}$', '124', '/images/coins/axs.svg', 'eth', '0xbb0e17ef65f82ab018d8edd776e8dd940327b28b', '18', '8', 'axs', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(22, 'BABYDOGE', 'Baby Doge Coin', '^(0x)[0-9A-Fa-f]{40}$', '146', '/images/coins/babydoge.svg', 'bsc', '0xc748673057861a797275cd8a068abb95a902e8de', '9', '8', 'babydoge', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(23, 'BAT', 'Basic Attention Token', '^(0x)[0-9A-Fa-f]{40}$', '32', '/images/coins/bat.svg', 'eth', '0x0d8775f648430679a709e98d2b0cb6250d2887ef', '18', '8', 'bat', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(24, 'BCD', 'Bitcoin Diamond', '^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$', '28', '/images/coins/bcd.svg', 'bcd', NULL, '8', '8', 'bcd', 0, '0', '2023-08-11 07:40:52', '2023-08-30 13:45:55'),
(25, 'BCH', 'Bitcoin Cash', '^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$|^(bitcoincash:)?[0-9A-Za-z]{42,42}$', '3', '/images/coins/bch.svg', 'bch', NULL, '8', '8', 'bch', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(26, 'BEAM', 'Beam', '^[A-Za-z0-9]{66,67}$', '34', '/images/coins/beam.svg', 'beam', NULL, NULL, '8', 'beam', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(27, 'BEL', 'Bella Protocol', '^(0x)[0-9A-Fa-f]{40}$', '150', '/images/coins/bel.svg', 'eth', '0xa91ac63d040deb1b7a5e4d4134ad23eb0ba07e14', '18', '8', 'bel', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(28, 'BIFI', 'Beefy Finance', '^(0x)[0-9A-Fa-f]{40}$', '166', '/images/coins/beefy.svg', 'bsc', '0xCa3F508B8e4Dd382eE878A314789373D80A5190A', '18', '8', 'bifi', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(29, 'BLOCKS', 'BLOCKS', '^(0x)[0-9A-Fa-f]{40}$', '164', '/images/coins/blocks.svg', 'eth', '0x8a6d4c8735371ebaf8874fbd518b56edd66024eb', '18', '8', 'blocks', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(30, 'BNBBSC', 'BNBBSC', '^(0x)[0-9A-Fa-f]{40}$', '96', '/images/coins/bnbbsc.svg', 'bsc', NULL, '18', '8', 'bnb', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(31, 'BNBMAINNET', 'BNBMAINNET', '^(bnb1)[0-9a-z]{38}$', '16', '/images/coins/bnbmainnet.svg', 'bnb', NULL, '8', '8', 'bnb', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(32, 'BOBA', 'Boba Network', '^(0x)[0-9A-Fa-f]{40}$', '201', '/images/coins/boba.svg', 'eth', '0x42bbfa2e77757c645eeaad1655e0911a7553efbc', '18', '8', 'boba', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(33, 'BONE', 'Bone ShibaSwap', '^(0x)[0-9A-Fa-f]{40}$', '193', '/images/coins/bone_eth.svg', 'eth', '0x9813037ee2218799597d83D4a5B6F3b6778218d9', '18', '8', 'bone', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(34, 'BRGBSC', 'Bridge Oracle', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/brgbsc.svg', 'bsc', '0x6e4a971B81CA58045a2AA982EaA3d50C4Ac38F42', '18', '8', 'brgbsc', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(35, 'BRISE', 'Bitgert Mainnet', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/brise.svg', 'brise', '0x8fff93e810a2edaafc326edee51071da9d398e83', '9', '8', 'brisemainnet', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(36, 'BRISEMAINNET', 'Bitgert Mainnet', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/brise.svg', 'brise', NULL, '18', '8', 'brisemainnet', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(37, 'BSV', 'Bitcoin SV', '^[1][a-km-zA-HJ-NP-Z1-9]{25,34}$|^(bitcoincash:)?[0-9A-Za-z]{42,42}$', '200', '/images/coins/bsv.svg', 'bsv', NULL, '8', '8', 'bsv', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(38, 'BTC', 'Bitcoin', '^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$|^(bc1|BC1)[0-9A-Za-z]{39,59}$', '0', '/images/coins/btc.svg', 'btc', NULL, '8', '8', 'btc', 1, '1', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(39, 'BTFA', 'Banana Task Force Ape', '^(0x)[0-9A-Fa-f]{40}$', '181', '/images/coins/btfa.svg', 'eth', NULL, NULL, '8', 'btfa', 0, '0', '2023-08-11 07:40:53', '2023-08-30 13:45:55'),
(40, 'BTG', 'Bitcoin Gold', '^[AG][a-km-zA-HJ-NP-Z1-9]{25,34}$', '16', '/images/coins/btg.svg', 'btg', NULL, '8', '8', 'btg', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(41, 'BTTC', 'BitTorrent-New (TRC 20)', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '184', '/images/coins/bttc.svg', 'trx', 'TAFjULxiVgT4qWk6UZwjqwZXTSaGaqnVp4', '18', '8', 'bttc', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(42, 'BTTCBSC', 'BitTorrent-NEW (Binance Smart Chain)', '^(0x)[0-9A-Fa-f]{40}$', '182', '/images/coins/btt.svg', 'bsc', '0x352Cb5E19b12FC216548a2677bD0fce83BaE434B', '18', '8', 'bttc', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(43, 'BUSD', 'BUSD', '^(0x)[0-9A-Fa-f]{40}$', '40', '/images/coins/busd.svg', 'eth', '0x4Fabb145d64652a948d72533023f6E7A623C7C53', '18', '8', 'busd', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(44, 'BUSDBSC', 'BUSDBSC', '^(0x)[0-9A-Fa-f]{40}$', '41', '/images/coins/busdbsc.svg', 'bsc', '0xe9e7cea3dedca5984780bafc599bd69add087d56', '18', '2', 'busd', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(45, 'C98', 'Coin98', '^(0x)[0-9A-Fa-f]{40}$', '125', '/images/coins/c98.svg', 'bsc', '0xaec945e04baf28b135fa7c640f624f8d90f1c3a6', '18', '8', 'c98', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(46, 'CAKE', 'CAKE', '^(0x)[0-9A-Fa-f]{40}$', '107', '/images/coins/cake.svg', 'bsc', '0x0e09fabb73bd3ade0a17ecc321fd13a19e81ce82', '18', '8', 'cake', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(47, 'CFX', 'Conflux', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/cfxbsc.svg', 'bsc', NULL, NULL, '8', 'cfx', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(48, 'CHR', 'CHR', '^(0x)[0-9A-Fa-f]{40}$', '99', '/images/coins/chr.svg', 'eth', '0x8a2279d4a90b6fe1c4b30fa660cc9f926797baa2', '6', '8', 'chr', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(49, 'CHZ', 'Chiliz', '^(0x)[0-9A-Fa-f]{40}$', '126', '/images/coins/chz.svg', 'eth', '0x3506424f91fd33084466f402d5d97f05f8e3b4af', '18', '8', 'chz', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(50, 'CNS', 'CentricSwap', '^(0x)[0-9A-Fa-f]{40}$', '135', '/images/coins/cns.svg', 'bsc', '0xF6Cb4ad242BaB681EfFc5dE40f7c8FF921a12d63', '8', '8', 'cns', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(51, 'COTI', 'COTI', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/coti.svg', 'eth', '0xddb3422497e61e13543bea06989c0789117555c5', '18', '8', 'coti', 0, '0', '2023-08-11 07:40:54', '2023-08-30 13:45:55'),
(52, 'CRO', 'CRO', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/cro.svg', 'eth', '0xA0b73E1Ff0B80914AB6fe0444E65848C4C34450b', '18', '8', 'cro', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(53, 'CROMAINNET', 'Cronos(Mainnet)', '^(cro)[0-9A-Za-z]{39}', '200', '/images/coins/cromainnet.svg', 'cro', NULL, NULL, '8', 'cromainnet', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(54, 'CSPR', 'Casper (Mainnet)', '^[A-Za-z0-9]{66,68}$', '200', '/images/coins/cspr.svg', 'cspr', NULL, NULL, '8', 'cspr', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(55, 'CTSI', 'CTSI', '^(0x)[0-9A-Fa-f]{40}$', '40', '/images/coins/ctsi.svg', 'eth', '0x491604c0fdf08347dd1fa4ee062a822a5dd06b5d', '18', '8', 'ctsi', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(56, 'CUDOS', 'Cudos', '^(0x)[0-9A-Fa-f]{40}$', '165', '/images/coins/cudos.svg', 'eth', '0x817bbDbC3e8A1204f3691d14bB44992841e3dB35', '18', '8', 'cudos', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(57, 'CULT', 'Cult DAO', '^(0x)[0-9A-Fa-f]{40}$', '170', '/images/coins/cult.svg', 'eth', '0xf0f9d895aca5c8678f706fb8216fa22957685a13', '18', '8', 'cult', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(58, 'CUSD', 'Celo Dollar', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/cusd.svg', 'celo', '0x765de816845861e75a25fca122bb6898b8b1282a', '18', '8', 'cusd', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(59, 'CVC', 'Civic', '^(0x)[0-9A-Fa-f]{40}$', '128', '/images/coins/cvc.svg', 'eth', '0x41e5560054824ea6b0732e656e3ad64e20e94e45', '8', '8', 'cvc', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(60, 'DAI', 'DAI', '^(0x)[0-9A-Fa-f]{40}$', '10', '/images/coins/dai.svg', 'eth', '0x6b175474e89094c44da98b954eedeac495271d0f', '18', '2', 'dai', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(61, 'DAIARB', 'DAIARB', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/daiarb.svg', 'arb', NULL, NULL, '8', 'daiarb', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(62, 'DAO', 'DAO', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/dao.svg', 'eth', '0x0f51bb10119727a7e5ea3538074fb341f56b09ad', '18', '8', 'dao', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(63, 'DASH', 'Dash', '^[X|7][0-9A-Za-z]{33}$', '19', '/images/coins/dash.svg', 'dash', NULL, '8', '8', 'dash', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(64, 'DCR', 'Decred', '^(Ds|Dc)[0-9A-Za-z]{33}$', '28', '/images/coins/dcr.svg', 'dcr', NULL, '8', '8', 'dcr', 0, '0', '2023-08-11 07:40:55', '2023-08-30 13:45:55'),
(65, 'DGB', 'DigiByte', '^[DS][a-km-zA-HJ-NP-Z1-9]{25,34}$|^(dgb1)[0-9A-Za-z]', '7', '/images/coins/dgb.svg', 'dgb', NULL, '8', '8', 'dgb', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(66, 'DGD', 'DigixDAO', '^(0x)[0-9A-Fa-f]{40}$', '13', '/images/coins/dgd.svg', 'eth', '0xe0b7927c4af23765cb51314a0e0521a9645f0e2a', '9', '8', 'dgd', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(67, 'DGMOON', 'DogeMoon', '^(0x)[0-9A-Fa-f]{40}$', '187', '/images/coins/dogemoon.svg', 'bsc', '0x18359CF655A444204e46F286eDC445C9D30fFc54', '18', '8', 'dgmoon', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(68, 'DINO', 'DinoLFG', '^(0x)[0-9A-Fa-f]{40}$', '203', '/images/coins/dino.svg', 'eth', '0x49642110B712C1FD7261Bc074105E9E44676c68F', '18', '8', 'dino', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(69, 'DIVI', 'Divi', '^(D)[A-Za-z0-9]{33}$', '194', '/images/coins/divi.svg', 'divi', NULL, '8', '8', NULL, 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(70, 'DOGE', 'DOGE', '^(D|A|9)[a-km-zA-HJ-NP-Z1-9]{33,34}$', '10', '/images/coins/doge.svg', 'doge', NULL, '8', '1', 'doge', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(71, 'DOGECOIN', 'Buff Doge Coin', '^(0x)[0-9A-Fa-f]{40}$', '188', '/images/coins/dogecoin.svg', 'bsc', '0x23125108bc4c63E4677b2E253Fa498cCb4B3298b', '9', '8', 'dogecoin', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(72, 'DOT', 'POLKADOT', '^1[0-9a-z-A-Z]{45,50}$', '15', '/images/coins/dot.svg', 'dot', NULL, '10', '8', 'dot', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(73, 'EGLD', 'EGLD', '^(erd)[a-z-A-Z0-9]{59}$', '10', '/images/coins/egld.svg', 'egld', NULL, '18', '8', 'egld', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(74, 'ENJ', 'Enjin Coin', '^(0x)[0-9A-Fa-f]{40}$', '129', '/images/coins/enj.svg', 'eth', '0xf629cbd94d3791c9250152bd8dfbdf380e2a3b9c', '18', '8', 'enj', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(75, 'EOS', 'EOS', '^[1-5a-z\\.]{1,12}$', '11', '/images/coins/eos.svg', 'eos', NULL, NULL, '8', 'eos', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(76, 'EPIC', 'EpicCash', '(es)(\\w{50})(@epicbox.)(\\w+)(.\\w+)', '200', '/images/coins/epic.svg', 'epic', NULL, NULL, '8', 'epic', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(77, 'ETC', 'Ethereum Classic', '^(0x)[0-9A-Fa-f]{40}$', '36', '/images/coins/etc.svg', 'etc', NULL, '18', '8', 'etc', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(78, 'ETH', 'Ethereum', '^(0x)[0-9A-Fa-f]{40}$', '1', '/images/coins/eth.svg', 'eth', NULL, '18', '8', 'eth', 1, '1', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(79, 'ETHARB', 'Ethereum (Arbitrum)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/etharbitrum.svg', 'arbitrum', NULL, '18', '8', 'etharb', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(80, 'ETHBSC', 'Ethereum (Binance Smart Chain)', '^(0x)[0-9A-Fa-f]{40}$', '177', '/images/coins/eth.svg', 'bsc', '0x2170ed0880ac9a755fd29b2688956bd959f933f8', '18', '8', 'eth', 0, '0', '2023-08-11 07:40:56', '2023-08-30 13:45:55'),
(81, 'ETHW', 'EthereumPoW', '^(0x)[0-9A-Fa-f]{40}$', '188', '/images/coins/ethw.svg', 'ethw', NULL, '18', '8', 'ethw', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(82, 'EURT', 'EURO Tether', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/eurt.svg', 'eth', NULL, NULL, '8', 'eurt', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(83, 'FEG', 'FEG Token', '^(0x)[0-9A-Fa-f]{40}$', '122', '/images/coins/feg.svg', 'eth', NULL, NULL, '8', 'feg', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(84, 'FIL', 'Filecoin', '^[a-z0-9]{41}$|[a-z0-9]{86}$', '10', '/images/coins/fil.svg', 'fil', NULL, '18', '8', 'fil', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(85, 'FIRO', 'FIRO', '^[a|Z|3|4][0-9A-za-z]{33}$', '25', '/images/coins/firo.svg', 'firo', NULL, '8', '8', 'firo', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(86, 'FITFI', 'Step App (AVAXC)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/fitfi.svg', 'avaxc', '0x714f020C54cc9D104B6F4f6998C63ce2a31D1888', '18', '8', 'fitfi', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(87, 'FLOKI', 'Floki (ERC20)', '^(0x)[0-9A-Fa-f]{40}$', '132', '/images/coins/floki.svg', 'eth', '0xcf0C122c6b73ff809C693DB761e7BaeBe62b6a2E', '9', '8', 'floki', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(88, 'FLOKIBSC', 'Floki (BSC)', '^(0x)[0-9A-Fa-f]{40}$', '188', '/images/coins/floki.svg', 'bsc', '0xfb5B838b6cfEEdC2873aB27866079AC55363D37E', '9', '8', 'floki', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(89, 'FLUF', 'Fluffy Coin', '^(0x)[0-9A-Fa-f]{40}$', '155', '/images/coins/fluf.svg', 'bsc', '0xa3abe68db1b8467b44715eb94542b20dc134f005', '18', '8', 'fluf', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(90, 'FRONT', 'FRONT', '^(0x)[0-9A-Fa-f]{40}$', '11', '/images/coins/front.svg', 'eth', '0xf8C3527CC04340b208C854E985240c02F7B7793f', '18', '8', 'front', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(91, 'FTM', 'FTM', '^(0x)[0-9A-Fa-f]{40}$', '11', '/images/coins/ftm.svg', 'eth', '0x4e15361fd6b4bb609fa63c81a2be19d873717870', '18', '8', 'ftm', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(92, 'FTMMAINNET', 'FTMMAINNET', '^(0x)[0-9A-Fa-f]{40}$', '12', '/images/coins/ftm.svg', 'ftm', NULL, '18', '8', 'ftm', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(93, 'FTT', 'FTT', '^(0x)[0-9A-Fa-f]{40}$', '100', '/images/coins/ftt.svg', 'eth', '0x50d1c9771902476076ecfc8b2a83ad6b9355a4c9', '18', '8', 'ftt', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(94, 'FUN', 'FUNToken', '^(0x)[0-9A-Fa-f]{40}$', '12', '/images/coins/fun.svg', 'eth', '0x419D0d8BdD9aF5e606Ae2232ed285Aff190E711b', '8', '8', 'fun', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(95, 'GAFA', 'Gafa', '^(0x)[0-9A-Fa-f]{40}$', '180', '/images/coins/gafa.svg', 'bsc', '0x495205d4c6307A73595C5C11B44Bee9B3418Ac69', '9', '8', 'gafa', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(96, 'GAL', 'Project Galaxy', '^(0x)[0-9A-Fa-f]{40}$', '185', '/images/coins/gal.svg', 'bsc', '0xe4Cc45Bb5DBDA06dB6183E8bf016569f40497Aa5', '18', '8', 'gal', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(97, 'GALAERC20', 'GALAERC20', '^(0x)[0-9A-Fa-f]{40}$', '160', '/images/coins/galaerc20.svg', 'eth', '0x15D4c048F83bd7e37d49eA4C83a07267Ec4203dA', '8', '8', 'gala', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(98, 'GARI', 'Gari', '^[1-9A-HJ-NP-Za-km-z]{32,44}$', '200', '/images/coins/gari.svg', 'sol', 'CKaKtYvz6dKPyMvYq9Rh3UBrnNqYZAyd7iF4hJtjUvks', '9', '8', 'gari', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(99, 'GAS', 'NeoGas', '^(A)[A-Za-z0-9]{33}$', '14', '/images/coins/gas.svg', 'neo', NULL, '8', '8', 'gas', 0, '0', '2023-08-11 07:40:57', '2023-08-30 13:45:55'),
(100, 'GETH', 'Guarded Ether (ERC20)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/geth.svg', 'eth', NULL, NULL, '8', 'geth', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(101, 'GGTKN', 'GG TOKEN', '^(0x)[0-9A-Fa-f]{40}$', '188', '/images/coins/ggtkn.svg', 'bsc', '0x1f7e8fe01aeba6fdaea85161746f4d53dc9bda4f', '18', '8', 'ggtkn', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(102, 'GHC', 'Galaxy Heroes Coin', '^(0x)[0-9A-Fa-f]{40}$', '175', '/images/coins/ghc.svg', 'bsc', '0xd10Fe9d371C22416df34340287cd5D9029842Fc3', '18', '8', 'ghc', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(103, 'GRS', 'Groestlcoin', '^(F|3)[0-9A-za-z]{33}$', '15', '/images/coins/grs.svg', 'grs', NULL, NULL, '8', 'grs', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(104, 'GRT', 'The Graph', '^(0x)[0-9A-Fa-f]{40}$', '130', '/images/coins/grt.svg', 'eth', '0xc944e90c64b2c07662a292be6244bdf05cda44a7', '18', '8', 'grt', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(105, 'GSPI', 'Shopping.io Governance', '^(0x)[0-9A-Fa-f]{40}$', '137', '/images/coins/gspi.svg', 'bsc', NULL, NULL, '8', NULL, 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(106, 'GT', 'Gatechain Token', '^(0x)[0-9A-Fa-f]{40}$', '10', '/images/coins/gt.svg', 'eth', '0xe66747a101bff2dba3697199dcce5b743b454759', '18', '8', 'gt', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(107, 'GUARD', 'Guardian', '^(0x)[0-9A-Fa-f]{40}$', '188', '/images/coins/guard.svg', 'bsc', '0xf606bd19b1e61574ed625d9ea96c841d4e247a32', '18', '8', 'guard', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(108, 'GUSD', 'GUSD', '^(0x)[0-9A-Fa-f]{40}$', '95', '/images/coins/gusd.svg', 'eth', '0x056Fd409E1d7A124BD7017459dFEa2F387b6d5Cd', '2', '8', 'gusd', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(109, 'HBAR', 'HBAR', '^0\\.0\\.\\d{1,7}$', '11', '/images/coins/hbar.svg', 'hbar', NULL, '6', '8', 'hbar', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(110, 'HEX', 'Hex', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/hex.svg', 'eth', NULL, NULL, '8', 'hex', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(111, 'HOGE', 'HOGE', '^(0x)[0-9A-Fa-f]{40}$', '93', '/images/coins/hoge.svg', 'eth', '0xfad45e47083e4607302aa43c65fb3106f1cd7607', '9', '8', 'hoge', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(112, 'HOT', 'HOT', '^(0x)[0-9A-Fa-f]{40}$', '112', '/images/coins/hot.svg', 'eth', '0x6c6ee5e31d828de241282b9606c8e98ea48526e2', '18', '8', 'hot', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(113, 'HOTCROSS', 'Hot Cross', '^(0x)[0-9A-Fa-f]{40}$', '176', '/images/coins/hotcross.svg', 'bsc', '0x4FA7163E153419E0E1064e418dd7A99314Ed27b6', '18', '8', 'hotcross', 0, '0', '2023-08-11 07:40:58', '2023-08-30 13:45:55'),
(114, 'HT', 'Huobi Token', '^(0x)[0-9A-Fa-f]{40}$', '31', '/images/coins/ht.svg', 'eth', '0x6f259637dcd74c767781e37bc6133cd6a68aa161', '18', '8', 'ht', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(115, 'ICX', 'ICON', '^(hx)[A-Za-z0-9]{40}$', '40', '/images/coins/icx.svg', 'icx', NULL, '18', '8', 'icx', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(116, 'ID', 'Space ID', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/id.svg', 'eth', NULL, NULL, '8', 'space-id', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(117, 'IDBSC', 'Space ID', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/idbsc.svg', 'bsc', NULL, NULL, '8', 'space-id', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(118, 'ILV', 'Illuvium', '^(0x)[0-9A-Fa-f]{40}$', '167', '/images/coins/ilv.svg', 'eth', '0x767fe9edc9e0df98e07454847909b5e959d7ca0e', '18', '8', 'ilv', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(119, 'IOTA', 'IOTA', '^(iota)[0-9a-z]{60}$', '111', '/images/coins/miota.svg', 'iota', NULL, '6', '8', 'iota', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(120, 'IOTX', 'IOTX', 'io1[qpzry9x8gf2tvdw0s3jn54khce6mua7l]{38}', '108', '/images/coins/iotx.svg', 'iotx', NULL, '18', '8', 'iotx', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(121, 'JASMY', 'JasmyCoin', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/jasmy.svg', 'eth', '0x7420B4b9a0110cdC71fB720908340C03F9Bc03EC', '18', '8', 'jasmy', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(122, 'JST', 'Just', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '200', '/images/coins/jsttrc20.svg', 'trx', NULL, NULL, '8', 'jst', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(123, 'KAS', 'Kaspa', '^(kaspa:)[0-9a-z]{60,71}$', '200', '/images/coins/kas.svg', 'kas', NULL, NULL, '8', 'kas', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(124, 'KEANU', 'KEANU', '^(0x)[0-9A-Fa-f]{40}$', '107', '/images/coins/keanu.svg', 'eth', '0x106552c11272420aad5d7e94f8acab9095a6c952', '9', '8', 'keanu', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(125, 'KIBA', 'Kiba Inu (ERC20)', '^(0x)[0-9A-Fa-f]{40}$', '167', '/images/coins/kiba.svg', 'eth', '0x005D1123878Fc55fbd56b54C73963b234a64af3c', '9', '8', 'kiba', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(126, 'KIBABSC', 'Kiba Inu (BSC)', '^(0x)[0-9A-Fa-f]{40}$', '161', '/images/coins/kiba.svg', 'bsc', '0xC3afDe95B6Eb9ba8553cDAea6645D45fB3a7FAF5', '18', '8', 'kiba', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(127, 'KISHU', 'KISHU', '^(0x)[0-9A-Fa-f]{40}$', '102', '/images/coins/kishu.svg', 'eth', '0xA2b4C0Af19cC16a6CfAcCe81F192B024d625817D', '9', '8', 'kishu', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(128, 'KLAY', 'Klaytn', '^(0x)[0-9A-Fa-f]{40}$', '159', '/images/coins/klay.svg', 'klay', NULL, '18', '8', 'klay', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(129, 'KLV', 'KLV', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '92', '/images/coins/klv.svg', 'trx', 'TVj7RNVHy6thbM7BWdSe9G6gXwKhjhdNZS', '6', '8', 'klv', 0, '0', '2023-08-11 07:40:59', '2023-08-30 13:45:55'),
(130, 'KLVMAINNET', 'Klever', '^(klv1)[0-9a-z]{58}$', '200', '/images/coins/klv.svg', 'klv', NULL, NULL, '8', 'klvmainnet', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(131, 'KMD', 'Komodo', '^(R)[A-Za-z0-9]{33}$', '33', '/images/coins/kmd.svg', 'kmd', NULL, '8', '8', 'kmd', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(132, 'KNC', 'Kyber Network Crystal', '^(0x)[0-9A-Fa-f]{40}$', '123', '/images/coins/knc.svg', 'eth', '0xdd974d5c2e2928dea5f71b9825b8b646686bd200', '18', '8', 'knc', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(133, 'LEASH', 'Doge Killer', '^(0x)[0-9A-Fa-f]{40}$', '131', '/images/coins/leash.svg', 'eth', '0x27c70cd1946795b66be9d954418546998b546634', '18', '8', 'leash', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(134, 'LGCY', 'LGCY', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/lgcy.svg', 'eth', '0xae697f994fc5ebc000f8e22ebffee04612f98a0d', '18', '8', 'lgcy', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(135, 'LINK', 'Chainlink', '^(0x)[0-9A-Fa-f]{40}$', '10', '/images/coins/link.svg', 'eth', '0x514910771af9ca656af840dff83e8264ecf986ca', '18', '8', 'link', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(136, 'LSK', 'Lisk', '^(lsk)[0-9A-Za-z]{38}$', '15', '/images/coins/lsk.svg', 'lsk', NULL, '8', '8', 'lsk', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(137, 'LTC', 'Litecoin', '^(L|M|3)[A-Za-z0-9]{33}$|^(ltc1)[0-9A-Za-z]{39}$', '2', '/images/coins/ltc.svg', 'ltc', NULL, '8', '8', 'ltc', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(138, 'LUNA', 'Terra', '^(terra1)[0-9a-z]{38}$', '120', '/images/coins/luna.svg', 'luna', NULL, '6', '8', 'luna', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(139, 'LUNC', 'Terra Classic', '^(terra1)[0-9a-z]{38}$', '100', '/images/coins/lunc.svg', 'lunc', NULL, '6', '8', 'lunc', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(140, 'MANA', 'MANA', '^(0x)[0-9A-Fa-f]{40}$', '12', '/images/coins/mana.svg', 'eth', '0x0f5d2fb29fb7d3cfee444a200298f468908cc942', '18', '8', 'mana', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(141, 'MARSH', 'Unmarshal', '^(0x)[0-9A-Fa-f]{40}$', '166', '/images/coins/marsh.svg', 'bsc', '0x2FA5dAF6Fe0708fBD63b1A7D1592577284f52256', '18', '8', 'marsh', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(142, 'MATIC', 'MATIC', '^(0x)[0-9A-Fa-f]{40}$', '40', '/images/coins/matic.svg', 'eth', '0x7D1AfA7B718fb893dB30A3aBc0Cfc608AaCfeBB0', '18', '8', 'matic', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(143, 'MATICMAINNET', 'MATICMAINNET', '^(0x)[0-9A-Fa-f]{40}$', '161', '/images/coins/matic.svg', 'matic', NULL, '18', '8', 'matic', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(144, 'MCO', 'MCO', '^(0x)[0-9A-Fa-f]{40}$', '14', '/images/coins/mco.svg', 'eth', '0xa0b73e1ff0b80914ab6fe0444e65848c4c34450b', '8', '8', NULL, 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(145, 'MX', 'MX', '^(0x)[0-9A-Fa-f]{40}$', '114', '/images/coins/mx.svg', 'eth', '0x11eef04c884e24d9b7b4760e7476d06ddf797f36', '18', '8', 'mx', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(146, 'NANO', 'Nano', '^(xrb_|nano_)[13456789abcdefghijkmnopqrstuwxyz]{60}', '35', '/images/coins/nano.svg', 'nano', NULL, '30', '8', 'xno', 0, '0', '2023-08-11 07:41:00', '2023-08-30 13:45:55'),
(147, 'NEAR', 'Near', '^(0x)[0-9A-Fa-f]{40}$', '154', '/images/coins/near.svg', 'near', NULL, '24', '8', 'near', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(148, 'NEO', 'NEO', '^(A)[A-Za-z0-9]{33}$', '24', '/images/coins/neo.svg', 'neo', NULL, '0', '8', 'neo', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(149, 'NFTB', 'NFTb', '^(0x)[0-9A-Fa-f]{40}$', '163', '/images/coins/nftb.svg', 'bsc', '0xde3dbbe30cfa9f437b293294d1fd64b26045c71a', '18', '8', 'nftb', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(150, 'NOW', 'ChangeNOW', '^(0x)[0-9A-Fa-f]{40}$', '80', '/images/coins/now.svg', 'eth', '0xe9a95d175a5f4c9369f3b74222402eb1b837693b', '8', '8', 'now', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(151, 'NPXS', 'Pundi-x', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/npxs.svg', 'eth', '0xa15c7ebe1f07caf6bff097d8a589fb8ac49ae5b3', '18', '8', 'npxs', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(152, 'NTVRK', 'Netvrk', '^(0x)[0-9A-Fa-f]{40}$', '157', '/images/coins/ntvrk.png', 'eth', '0xfc0d6cf33e38bce7ca7d89c0e292274031b7157a', '18', '8', 'ntvrk', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(153, 'NWC', 'NWC', '^(0x)[0-9A-Fa-f]{40}$', '101', '/images/coins/nwc.svg', 'eth', '0x968f6f898a6df937fc1859b323ac2f14643e3fed', '18', '8', 'nwc', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(154, 'OCEAN', 'OCEAN', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/ocean.svg', 'eth', '0x967da4048cd07ab37855c090aaf366e4ce1b9f48', '18', '8', 'ocean', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(155, 'OKB', 'OKB', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/okb.svg', 'eth', '0x75231f58b43240c9718dd58b4967c5114342a86c', '18', '8', 'okb', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(156, 'OM', 'OM', '^(0x)[0-9A-Fa-f]{40}$', '90', '/images/coins/om.svg', 'eth', '0x3593d125a4f7849a1b059e64f4517a86dd60c95d', '18', '8', 'om', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(157, 'OMG', 'OMG Network', '^(0x)[0-9A-Fa-f]{40}$', '134', '/images/coins/omg.svg', 'eth', '0xd26114cd6EE289AccF82350c8d8487fedB8A0C07', '18', '8', 'omg', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(158, 'ONE', 'ONE', '^(one1)[a-z0-9]{38}$', '40', '/images/coins/one.svg', 'one', NULL, '18', '8', 'one', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(159, 'ONIGI', 'Onigiri Neko', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/onigiri.svg', 'eth', '0xb4615AAD766f6De3c55330099E907fF7F13f1582', '9', '8', 'onigi', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(160, 'ONT', 'Ontology', '^(A)[A-Za-z0-9]{33}$', '15', '/images/coins/ont.svg', 'ont', NULL, '8', '8', 'ont', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(161, 'PAX', 'Paxos', '^(0x)[0-9A-Fa-f]{40}$', '27', '/images/coins/pax.svg', 'eth', '0x8E870D67F660D95d5be530380D0eC0bd388289E1', '18', '8', 'pax', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(162, 'PIKA', 'Pika', '^(0x)[0-9A-Fa-f]{40}$', '178', '/images/coins/pika.svg', 'eth', '0x60F5672A271C7E39E787427A18353ba59A4A3578', '18', '8', 'pika', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(163, 'PIT', 'PITBULL', '^(0x)[0-9A-Fa-f]{40}$', '162', '/images/coins/pitbull.svg', 'bsc', '0xA57ac35CE91Ee92CaEfAA8dc04140C8e232c2E50', '9', '8', 'pit', 0, '0', '2023-08-11 07:41:01', '2023-08-30 13:45:55'),
(164, 'PIVX', 'Pivx', '^(D)[0-9A-za-z]{33}$', '200', '/images/coins/pivx.svg', 'pivx', NULL, NULL, '8', 'pivx', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(165, 'PLS', 'Pulsechain', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/pls.svg', 'pulse', NULL, NULL, '8', 'pls', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(166, 'POODL', 'Poodl Token', '^(0x)[0-9A-Fa-f]{40}$', '149', '/images/coins/poodl.svg', 'bsc', '0x4a68c250486a116dc8d6a0c5b0677de07cc09c5d', '9', '8', 'poodl', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(167, 'POOLX', 'Poolz Finance', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/poolx.svg', 'bsc', '0xbAeA9aBA1454DF334943951d51116aE342eAB255', '18', '8', 'poolx', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(168, 'POOLZ', 'Poolz Finance', '^(0x)[0-9A-Fa-f]{40}$', '163', '/images/coins/poolz.svg', 'bsc', NULL, NULL, '8', 'poolz', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(169, 'QTUM', 'Qtum', '^[Q|M][A-Za-z0-9]{33}$', '30', '/images/coins/qtum.svg', 'qtum', NULL, '8', '8', 'qtum', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(170, 'QUACK', 'RichQuack', '^(0x)[0-9A-Fa-f]{40}$', '190', '/images/coins/quack.svg', 'bsc', '0xD74b782E05AA25c50e7330Af541d46E18f36661C', '9', '8', 'quack', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(171, 'RACA', 'Radio Caca', '^(0x)[0-9A-Fa-f]{40}$', '158', '/images/coins/raca.svg', 'bsc', '0x12BB890508c125661E03b09EC06E404bc9289040', '18', '8', 'raca', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(172, 'RBIF', 'Robo Inu Finance', '^(0x)[0-9A-Fa-f]{40}$', '163', '/images/coins/rbif.svg', 'eth', '0x7b32e70e8d73ac87c1b342e063528b2930b15ceb', '9', '8', 'rbif', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(173, 'REP', 'Augur', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/rep.svg', 'eth', '0x221657776846890989a759ba2973e427dff5c9bb', '18', '8', 'rep', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(174, 'RJV', 'Rejuve.AI', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/rjv.svg', 'eth', NULL, NULL, '8', 'rjv', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(175, 'RUNE', 'THORChain', '^thor[0-9a-zA-Z]{39}$', '200', '/images/coins/rune.svg', 'rune', NULL, NULL, '8', 'rune', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(176, 'RVN', 'RVN', '^R[A-Za-z0-9]{33}$', '10', '/images/coins/rvn.svg', 'rvn', NULL, '8', '8', 'rvn', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(177, 'RXCG', 'RXCGames', '^(0x)[0-9A-Fa-f]{40}$', '144', '/images/coins/rxcg.svg', 'bsc', NULL, NULL, '8', NULL, 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(178, 'SAND', 'SAND', '^(0x)[0-9A-Fa-f]{40}$', '40', '/images/coins/sand.svg', 'eth', '0x3845badAde8e6dFF049820680d1F14bD3903a5d0', '18', '8', 'sand', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(179, 'SFUND', 'Seedify.fund', '^(0x)[0-9A-Fa-f]{40}$', '158', '/images/coins/sfund.png', 'bsc', '0x477bc8d23c634c154061869478bce96be6045d12', '18', '8', 'sfund', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(180, 'SHIB', 'Shiba Inu', '^(0x)[0-9A-Fa-f]{40}$', '10', '/images/coins/shib.svg', 'eth', '0x95ad61b0a150d79219dcf64e1e6cc01f0b64c4ce', '18', '0', 'shib', 0, '0', '2023-08-11 07:41:02', '2023-08-30 13:45:55'),
(181, 'SHIBBSC', 'Shiba Inu (BSC)', '^(0x)[0-9A-Fa-f]{40}$', '164', '/images/coins/shib.svg', 'bsc', '0x2859e4544C4bB03966803b044A93563Bd2D0DD4D', '18', '8', 'shib', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(182, 'SOL', 'SOL', '[1-9A-HJ-NP-Za-km-z]{32,44}', '40', '/images/coins/sol.svg', 'sol', NULL, '9', '8', 'sol', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(183, 'SPI', 'Shopping.io', '^(0x)[0-9A-Fa-f]{40}$', '140', '/images/coins/spi.svg', 'eth', NULL, NULL, '8', NULL, 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(184, 'SRK', 'SRK', '^(0x)[0-9A-Fa-f]{40}$', '94', '/images/coins/srk.svg', 'eth', '0x0488401c3f535193fa8df029d9ffe615a06e74e6', '18', '8', 'srk', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(185, 'STKK', 'Streakk', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/stkk.svg', 'bsc', NULL, NULL, '8', 'stkk', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(186, 'STPT', 'STP Network', '^(0x)[0-9A-Fa-f]{40}$', '10', '/images/coins/stpt.svg', 'eth', '0xde7d85157d9714eadf595045cc12ca4a5f3e2adb', '18', '8', 'stpt', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(187, 'STRAX', 'STRAX', '^(X)[0-9A-Za-z]{33}$', '40', '/images/coins/strax.svg', 'strax', NULL, '7', '8', 'strax', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(188, 'SUN', 'sun', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '200', '/images/coins/suntrc20.svg', 'trx', NULL, NULL, '8', 'sun', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(189, 'SUPER', 'SUPER', '^(0x)[0-9A-Fa-f]{40}$', '91', '/images/coins/super.svg', 'eth', '0xe53ec727dbdeb9e2d5456c3be40cff031ab40a55', '18', '8', 'super', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(190, 'SXPMAINNET', 'Solar Network', '^(S)[0-9A-Za-z]{33}$', '10', '/images/coins/sxp.svg', 'sxp', NULL, '8', '8', 'sxp', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(191, 'SYSEVM', 'SYSEVM', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/sysevm.svg', 'sys', NULL, NULL, '8', 'sysevm', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(192, 'TENSHI', 'Tenshi', '^(0x)[0-9A-Fa-f]{40}$', '183', '/images/coins/tenshi.svg', 'eth', '0x52662717e448be36cb54588499d5a8328bd95292', '18', '8', 'tenshi', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(193, 'TFUEL', 'TFUEL', '^(0x)[0-9A-Fa-f]{40}$', '115', '/images/coins/tfuel.svg', 'theta', NULL, '18', '8', 'tfuel', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(194, 'THETA', 'THETA', '^(0x)[0-9A-Fa-f]{40}$', '109', '/images/coins/theta.svg', 'theta', NULL, '18', '8', 'theta', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(195, 'TKO', 'Tokocrypto', '^(0x)[0-9A-Fa-f]{40}$', '133', '/images/coins/tko.svg', 'bsc', '0x9f589e3eabe42ebc94a44727b3f3531c0c877809', '18', '8', 'tko', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(196, 'TLOS', 'Telos(BSC)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/tlos.svg', 'bsc', NULL, NULL, '8', 'tlos', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(197, 'TLOSERC20', 'Telos(ETH)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/tlos.svg', 'eth', NULL, NULL, '8', 'tloserc20', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(198, 'TOMO', 'TomoChain', '^(0x)[0-9A-Fa-f]{40}$', '172', '/images/coins/tomo.svg', 'eth', '0x05d3606d5c81eb9b7b18530995ec9b29da05faba', '18', '8', 'tomo', 0, '0', '2023-08-11 07:41:03', '2023-08-30 13:45:55'),
(199, 'TON', 'Toncoin', '^(EQ)[0-9a-zA-Z-_!]{46}', '10', '/images/coins/ton.svg', 'ton', NULL, '8', '8', 'ton', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(200, 'TRVL', 'DTravel', '^(0x)[0-9A-Fa-f]{40}$', '142', '/images/coins/trvl.svg', 'eth', '0xd47bdf574b4f76210ed503e0efe81b58aa061f3d', '18', '8', 'trvl', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(201, 'TRX', 'Tron', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '6', '/images/coins/trx.svg', 'trx', NULL, '6', '1', 'trx', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(202, 'TTC', 'TechTrees', '^(0x)[0-9A-Fa-f]{40}$', '192', '/images/coins/ttcbsc.svg', 'bsc', '0x6A684b3578f5B07c0Aa02fAFc33ED248AE0c2dB2', '18', '8', 'ttc', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(203, 'TUP', 'TenUp', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/tup.svg', 'eth', '0x7714f320Adca62B149df2579361AfEC729c5FE6A', '18', '8', 'tup', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(204, 'TUSD', 'TrueUSD', '^(0x)[0-9A-Fa-f]{40}$', '10', '/images/coins/tusd.svg', 'eth', '0x0000000000085d4780b73119b644ae5ecd22b376', '18', '8', 'tusd', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(205, 'TUSDTRC20', 'TrueUSD (Tron)', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '200', '/images/coins/tusdtrc20.svg', 'trx', 'TUpMhErZL2fhh4sVNULAbNKLokS4GjC1F4', '18', '8', 'tusd', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(206, 'UNI', 'Uniswap', '^(0x)[0-9A-Fa-f]{40}$', '10', '/images/coins/uni.svg', 'eth', '0x1f9840a85d5aF5bf1D1762F925BDADdC4201F984', '18', '8', 'uni', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(207, 'USDC', 'USDC', '^(0x)[0-9A-Fa-f]{40}$', '41', '/images/coins/usdc.svg', 'eth', '0xA0b86991c6218b36c1d19D4a2e9Eb0cE3606eB48', '6', '2', 'usdc', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(208, 'USDCALGO', 'USDCALGO', '^[A-Z0-9]{58}$', '200', '/images/coins/usdcalgo.svg', 'algo', NULL, NULL, '8', 'usdcalgo', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(209, 'USDCARB', 'USD Coin (Arbitrum One)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/usdcarb.svg', 'arbitrum', NULL, NULL, '8', 'usdcarb', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(210, 'USDCARC20', 'USD Coin (AVAX C-CHAIN)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/usdcavax.svg', 'avaxc', '0xB97EF9Ef8734C71904D8002F8b6Bc66Dd9c48a6E', '6', '8', 'usdcarc20', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(211, 'USDCMATIC', 'USD Coin (Polygon)', '^(0x)[0-9A-Fa-f]{40}$', '186', '/images/coins/usdcmatic.svg', 'matic', '0x2791bca1f2de4661ed88a30c99a7a9449aa84174', '6', '8', 'usdc', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(212, 'USDCSOL', 'USDCSOL', '[1-9A-HJ-NP-Za-km-z]{32,44}', '200', '/images/coins/usdcsol.svg', 'sol', NULL, NULL, '8', 'usdcsol', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(213, 'USDDTRC20', 'USDD (TRC20)', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '188', '/images/coins/usddtrc20.svg', 'trx', 'TPYmHEhy5n8TCEfYGqW2rPxsghSfzghPDn', '18', '2', 'usdd', 0, '0', '2023-08-11 07:41:04', '2023-08-30 13:45:55'),
(214, 'USDJ', 'USDJ', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '200', '/images/coins/usdjtrc20.svg', 'trx', NULL, NULL, '8', 'usdj', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(215, 'USDP', 'Pax Dollar', '^(bnb1)[0-9a-z]{38}$', '121', '/images/coins/pax.svg', 'eth', '0x8E870D67F660D95d5be530380D0eC0bd388289E1', '18', '8', 'usdp', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(216, 'USDT', 'USDT', '^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$', '42', '/images/coins/usdt.svg', 'btc', '31', '18', '8', 'usdt', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(217, 'USDTARB', 'Tether (Arbitrum One)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/arbitrumusdt.svg', 'arbitrum', '0xFd086bC7CD5C481DCC9C85ebE478A1C0b69FCbb9', '6', '8', 'usdt', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(218, 'USDTARC20', 'Tether (AVAX C-CHAIN)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/usdtavax.svg', 'avaxc', '0x9702230A8Ea53601f5cD2dc00fDBc13d4dF4A8c7', '6', '8', 'usdtarc20', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(219, 'USDTBSC', 'Tether-BSC', '^(0x)[0-9A-Fa-f]{40}$', '140', '/images/coins/usdtbsc.svg', 'bsc', '0x55d398326f99059ff775485246999027b3197955', '18', '2', 'usdt', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(220, 'USDTDOT', 'Tether (STATEMINT(Polkadot))', '^1[0-9a-z-A-Z]{45,50}$', '200', '/images/coins/usdtdot.svg', 'dot', NULL, NULL, '8', 'usdt', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(221, 'USDTERC20', 'Tether', '^(0x)[0-9A-Fa-f]{40}$', '29', '/images/coins/usdterc20.svg', 'eth', '0xdAC17F958D2ee523a2206206994597C13D831ec7', '6', '2', 'usdt', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(222, 'USDTOP', 'Tether (Optimism)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/usdtop.svg', 'op', NULL, NULL, '8', 'usdtop', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(223, 'USDTSOL', 'Tether (SOL)', '^[1-9A-HJ-NP-Za-km-z]{32,44}$', '189', '/images/coins/usdtsol.svg', 'sol', 'Es9vMFrzaCERmJfrF4H2FYD4KCoNkY11McCe8BenwNYB', '6', '8', 'usdt', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(224, 'USDTTRC20', 'Tether-Tron', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '10', '/images/coins/usdttrc20.svg', 'trx', 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t', '6', '2', 'usdt', 1, '1', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(225, 'UST', 'TerraUSD', '^(terra1)[0-9a-z]{38}$', '113', '/images/coins/ust.svg', 'luna', NULL, NULL, '8', NULL, 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(226, 'VERSE', 'Verse', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/verse.svg', 'eth', '0x249cA82617eC3DfB2589c4c17ab7EC9765350a18', NULL, '8', 'verse', 0, '0', '2023-08-11 07:41:05', '2023-08-30 13:45:55'),
(227, 'VET', 'Vechain', '^(0x)[0-9A-Fa-f]{40}$', '12', '/images/coins/vet.svg', 'eth', NULL, '18', '8', 'vet', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(228, 'VIB', 'VIB', '^(0x)[0-9A-Fa-f]{40}$', '90', '/images/coins/vib.svg', 'eth', '0x2c974b2d0ba1716e644c1fc59982a89ddd2ff724', '18', '8', 'vib', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(229, 'VOLT', 'Volt Inu V2', '^(0x)[0-9A-Fa-f]{40}$', '169', '/images/coins/volt.svg', 'bsc', '0x7db5af2B9624e1b3B4Bb69D6DeBd9aD1016A58Ac', '9', '8', 'volt', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(230, 'WABI', 'Tael', '^(0x)[0-9A-Fa-f]{40}$', '29', '/images/coins/wabi.svg', 'eth', '0x286BDA1413a2Df81731D4930ce2F862a35A609fE', '18', '8', 'wabi', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(231, 'WAVES', 'Waves', '^(3P)[0-9A-Za-z]{33}$', '20', '/images/coins/waves.svg', 'waves', NULL, '8', '8', 'waves', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(232, 'WBTCMATIC', 'Wrapped Bitcoin (Polygon)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/wbtcmatic.svg', 'matic', NULL, NULL, '8', 'wbtcmatic', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(233, 'WINTRC20', 'WinLink (Tron)', '^T[1-9A-HJ-NP-Za-km-z]{33}$', '200', '/images/coins/wintrc20.svg', 'trx', NULL, NULL, '8', 'wintrc20', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(234, 'XAUT', 'Tether Gold', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/xaut.svg', 'eth', NULL, NULL, '8', 'xaut', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(235, 'XCAD', 'XCAD Network', '^(0x)[0-9A-Fa-f]{40}$', '179', '/images/coins/xcad.svg', 'eth', '0x7659ce147d0e714454073a5dd7003544234b6aa0', '18', '8', 'xcad', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(236, 'XCUR', 'XCUR', '^(0x)[0-9A-Fa-f]{40}$', '80', '/images/coins/xcur.svg', 'eth', '0xE1c7E30C42C24582888C758984f6e382096786bd', '8', '8', 'xcur', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(237, 'XDC', 'XDC Network', '^xdc[a-fA-F0-9]{40}$', '161', '/images/coins/xdc.svg', 'xdc', NULL, '8', '8', 'xdc', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(238, 'XEC', 'eCash', '^[13][a-km-zA-HJ-NP-Z1-9]{25,34}$|^(ecash:)([qpzry9x8gf2tvdw0s3jn54khce6mua7l]{42})$', '200', '/images/coins/xec.svg', 'xec', NULL, NULL, '8', 'xec', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(239, 'XEM', 'NEM', '^(NA|NB|NC|ND)[a-zA-z0-9]{38}$', '40', '/images/coins/xem.svg', 'xem', NULL, '6', '8', 'xem', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(240, 'XLM', 'Stellar Lumens', '^G[A-D]{1}[A-Z2-7]{54}$', '18', '/images/coins/xlm.svg', 'xlm', NULL, '7', '8', 'xlm', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(241, 'XMR', 'Monero', '^[48][a-zA-Z|\\d]{94}([a-zA-Z|\\d]{11})?$', '22', '/images/coins/xmr.svg', 'xmr', NULL, '12', '8', 'xmr', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(242, 'XRP', 'Ripple', '^r[1-9A-HJ-NP-Za-km-z]{25,34}$', '21', '/images/coins/xrp.svg', 'xrp', NULL, '6', '8', 'xrp', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(243, 'XTZ', 'Tezos', '^tz1[a-zA-Z0-9]{33}$', '10', '/images/coins/xtz.svg', 'xtz', NULL, '6', '8', 'xtz', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(244, 'XVG', 'Verge', '^(D)[A-Za-z0-9]{33}$', '4', '/images/coins/xvg.svg', 'xvg', NULL, '8', '8', 'xvg', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(245, 'XYM', 'XYM', '^[N]{1}[0-9A-Z]{38}$', '97', '/images/coins/xym.svg', 'xym', NULL, '6', '8', 'xym', 0, '0', '2023-08-11 07:41:06', '2023-08-30 13:45:55'),
(246, 'XYO', 'XYO Network', '^(0x)[0-9A-Fa-f]{40}$', '148', '/images/coins/xyo.svg', 'eth', '0x55296f69f40ea6d20e478533c15a6b08b654e758', '18', '8', 'xyo', 0, '0', '2023-08-11 07:41:07', '2023-08-30 13:45:55'),
(247, 'XZC', 'Zcoin', '^[a|Z|3|4][0-9A-za-z]{33}$', '25', '/images/coins/xzc.svg', NULL, NULL, NULL, '8', NULL, 0, '0', '2023-08-11 07:41:07', '2023-08-30 13:45:55'),
(248, 'YFI', 'YFI', '^(0x)[0-9A-Fa-f]{40}$', '15', '/images/coins/yfi.svg', 'eth', '0x0bc529c00C6401aEF6D220BE8C6Ea1667F6Ad93e', '18', '8', 'yfi', 0, '0', '2023-08-11 07:41:07', '2023-08-30 13:45:55'),
(249, 'ZBC', 'Zebec Protocol', '^[1-9A-HJ-NP-Za-km-z]{32,44}$', '200', '/images/coins/zbcsol.svg', 'sol', 'zebeczgi5fSEtbpfQKVZKCJ3WgYXxjkMUkNNx7fLKAF', '9', '8', NULL, 0, '0', '2023-08-11 07:41:07', '2023-08-30 13:45:55'),
(250, 'ZEC', 'Zcash', '^(t)[A-Za-z0-9]{34}$', '5', '/images/coins/zec.svg', 'zec', NULL, '8', '8', 'zec', 0, '0', '2023-08-11 07:41:07', '2023-08-30 13:45:55'),
(251, 'ZEN', 'Horizen', '^(z)[0-9A-za-z]{34}$', '9', '/images/coins/zen.svg', 'zen', NULL, '8', '8', 'zen', 0, '0', '2023-08-11 07:41:07', '2023-08-30 13:45:55'),
(252, 'ZIL', 'Zilliqa', '^zil1[qpzry9x8gf2tvdw0s3jn54khce6mua7l]{38}$', '20', '/images/coins/zil.svg', 'zil', NULL, '12', '8', 'zil', 0, '0', '2023-08-11 07:41:07', '2023-08-30 13:45:55'),
(253, 'ZKSYNC', 'Ethereum (ZkSync Era)', '^(0x)[0-9A-Fa-f]{40}$', '200', '/images/coins/ethzksync.svg', 'zksync', NULL, NULL, '8', 'zksync', 0, '0', '2023-08-11 07:41:07', '2023-08-30 13:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_records`
--

CREATE TABLE `kyc_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `document_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` json NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2014_10_12_000000_create_users_table', 1),
(16, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(17, '2019_08_19_000000_create_failed_jobs_table', 1),
(18, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(19, '2023_07_08_063245_create_jobs_table', 1),
(20, '2023_07_08_132516_create_settings_table', 1),
(21, '2023_07_09_200208_create_kyc_records_table', 1),
(23, '2023_07_25_165642_create_deposits_table', 2),
(26, '2023_07_27_120010_create_transactions_table', 3),
(41, '2023_07_27_132121_create_bots_table', 4),
(42, '2023_07_27_132953_create_bot_activations_table', 4),
(43, '2023_08_07_203055_create_bot_histories_table', 4),
(46, '2023_08_11_073652_create_deposit_coins_table', 5),
(50, '2023_08_17_110620_create_withdrawals_table', 6),
(53, '2023_08_19_212414_create_admins_table', 7),
(54, '2023_08_21_161924_add_status_to_users_table', 8),
(55, '2023_08_30_143329_can_withdraw_to_deposit_coin', 9),
(57, '2023_09_06_214312_create_p2ps_table', 10),
(60, '2023_09_07_200553_create_cron_jobs_table', 11),
(61, '2023_09_08_133330_create_pages_table', 12),
(62, '2023_09_11_192942_add_google_2fa_to_user', 13),
(63, '2023_09_12_101830_return_daily_proft', 14),
(64, '2023_09_21_104200_site_seting', 15),
(65, '2023_09_26_090532_create_auto_wallets_table', 16),
(66, '2023_09_26_114234_add_to_withdrawal_table', 16),
(67, '2023_09_26_154351_add_to_settings', 16),
(68, '2023_09_28_164206_add_hold_period', 16),
(69, '2023_09_28_205850_fix_auto_withdrawa', 16),
(70, '2023_09_29_201754_fix_calculations_m', 16),
(71, '2023_10_06_080249_add_next_trade', 16),
(72, '2023_10_07_054217_fix_bottrade_fx', 16),
(73, '2023_10_07_061540_fix_add_to_group', 16),
(74, '2023_10_12_080616_add_to_cron_jobs', 17);

-- --------------------------------------------------------

--
-- Table structure for table `p2ps`
--

CREATE TABLE `p2ps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `seo`, `content`, `created_at`, `updated_at`) VALUES
(2, 'Testing page one', 'testing-page-one-1', 'Testing Page one', '\"<p>Some really Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maiores a dicta vero eveniet hic incidunt tempora mollitia inventore. Vero optio voluptates ipsa harum sunt ea illum maiores ex nihil laborum itaque voluptatum repellendus fugit ut explicabo, inventore, quia at nobis nostrum quos molestiae quod libero eius? Vero doloribus id dolorum?<\\/p><p>&nbsp;<\\/p><p>&nbsp;<\\/p><p>&nbsp;<\\/p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, sunt obcaecati voluptatum illo, molestiae a quis praesentium veniam ex cupiditate minus repudiandae doloribus quod omnis atque possimus deleniti ipsa eveniet.<\\/p><p>&nbsp;<\\/p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, sunt obcaecati voluptatum illo, molestiae a quis praesentium veniam ex cupiditate minus repudiandae doloribus quod omnis atque possimus deleniti ipsa eveniet.<\\/p><p>&nbsp;<\\/p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, sunt obcaecati voluptatum illo, molestiae a quis praesentium veniam ex cupiditate minus repudiandae doloribus quod omnis atque possimus deleniti ipsa eveniet.<\\/p>\"', '2023-09-08 14:48:26', '2023-09-08 14:48:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'name', 'Rescron AI', '2023-09-08 06:38:24', '2023-09-08 06:38:24'),
(2, 'logo_rec', 'logo-rec.png', '2023-09-08 06:38:24', '2023-09-08 06:38:24'),
(3, 'logo_square', 'logo-square.png', '2023-09-08 06:38:24', '2023-09-08 06:38:24'),
(4, 'favicon', 'favicon.png', '2023-09-08 06:38:24', '2023-09-08 06:38:24'),
(5, 'currency', 'USD', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(6, 'currency_symbol', '$', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(7, 'currency_position', 'left', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(8, 'use_sign', '0', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(9, 'homepage', NULL, '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(10, 'address', 'No 20 Nomands Str', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(11, 'city', 'London', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(12, 'state', 'London', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(13, 'country', 'England', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(14, 'phone', '494895984', '2023-09-08 06:38:25', '2023-09-08 06:38:25'),
(15, 'email', 'support@business.com', '2023-09-08 06:38:26', '2023-09-08 06:38:26'),
(16, 'livechat', '\"<script  async><\\/script>\"', '2023-09-08 06:38:26', '2023-09-09 18:44:05'),
(17, 'strong_password', '0', '2023-09-08 06:38:26', '2023-09-08 06:38:26'),
(18, 'email_v', '1', '2023-09-08 06:38:26', '2023-09-08 06:38:26'),
(19, 'kyc_v', '1', '2023-09-08 06:38:26', '2023-09-08 06:38:26'),
(20, 'user_otp', '0', '2023-09-08 06:38:26', '2023-09-09 19:06:27'),
(21, 'admin_otp', '\"0\"', '2023-09-08 06:38:26', '2023-09-09 19:06:27'),
(22, 'user_fields', '[\"name\",\"username\",\"address\",\"state\",\"country\",\"gender\",\"phone\",\"dob\"]', '2023-09-08 06:38:26', '2023-09-08 06:38:26'),
(23, 'min_deposit', '10', '2023-09-08 06:38:26', '2023-09-08 06:38:26'),
(24, 'max_deposit', '1000', '2023-09-08 06:38:26', '2023-09-08 06:38:26'),
(25, 'deposit_fee', '1', '2023-09-08 06:38:26', '2023-09-08 06:38:26'),
(26, 'min_withdrawal', '10', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(27, 'max_withdrawal', '1000', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(28, 'withdrawal_fee', '1', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(29, 'bot_compounding', '1', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(30, 'bot_min_trade', '3', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(31, 'bot_max_trade', '8', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(32, 'trading_days', '[\"monday\",\"tuesday\",\"wednesday\",\"thursday\",\"friday\",\"saturday\",\"sunday\"]', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(33, 'min_transfer', '10', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(34, 'max_transfer', '1000', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(35, 'transfer_fee', '1', '2023-09-08 06:38:27', '2023-09-08 06:38:27'),
(36, 'bonus', '[4,3,2,1,1,1,1,1,1,1]', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(37, 'robots', 'index', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(38, 'cover', 'cover.png?v=1694158815', '2023-09-08 06:38:28', '2023-09-08 06:40:15'),
(39, 'seo_description', 'Rescron AI uses advanced Ai robots trained on extensive trading data and algorithms to analyze market trends and execute profitable trades with high precision.', '2023-09-08 06:38:28', '2023-09-08 06:40:15'),
(40, 'pagination', '10', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(41, 'facebook', 'https://www.facebook.com', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(42, 'instagram', 'https://www.instagram.com', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(43, 'twitter', 'https://www.twitter.com', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(44, 'linkedin', 'https://www.linkedin.com', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(45, 'youtube', 'https://www.youtube.com', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(46, 'pinterest', 'https://www.pinterest.com', '2023-09-08 06:38:28', '2023-09-08 06:38:28'),
(47, 'snapchat', 'https://www.snapchat.com', '2023-09-08 06:38:29', '2023-09-08 06:38:29'),
(48, 'tiktok', 'https://www.tiktok.com', '2023-09-08 06:38:29', '2023-09-08 06:38:29'),
(49, 'reddit', 'https://www.reddit.com', '2023-09-08 06:38:29', '2023-09-08 06:38:29'),
(50, 'whatsapp', 'https://www.whatsapp.com', '2023-09-08 06:38:29', '2023-09-08 06:38:29'),
(51, 'preloader', '0', '2023-09-21 09:55:22', '2023-09-21 10:05:31'),
(52, 'auto_withdraw', '0', '2023-10-09 18:46:27', '2023-10-09 18:46:27'),
(53, 'wallet_lock_duration', '3', '2023-10-09 18:46:27', '2023-10-09 18:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `g2fa` int(11) NOT NULL DEFAULT '0',
  `g2fa_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `kyc_verified_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referred_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `deposit_coin_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `converted_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'manual',
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto_wallets`
--
ALTER TABLE `auto_wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_wallets_user_id_foreign` (`user_id`),
  ADD KEY `auto_wallets_deposit_coin_id_foreign` (`deposit_coin_id`);

--
-- Indexes for table `bots`
--
ALTER TABLE `bots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bot_activations`
--
ALTER TABLE `bot_activations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bot_activations_user_id_foreign` (`user_id`),
  ADD KEY `bot_activations_bot_id_foreign` (`bot_id`);

--
-- Indexes for table `bot_histories`
--
ALTER TABLE `bot_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bot_histories_user_id_foreign` (`user_id`),
  ADD KEY `bot_histories_bot_id_foreign` (`bot_id`),
  ADD KEY `bot_histories_bot_activation_id_foreign` (`bot_activation_id`);

--
-- Indexes for table `cron_jobs`
--
ALTER TABLE `cron_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposits_user_id_foreign` (`user_id`),
  ADD KEY `deposits_deposit_coin_id_foreign` (`deposit_coin_id`);

--
-- Indexes for table `deposit_coins`
--
ALTER TABLE `deposit_coins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `kyc_records`
--
ALTER TABLE `kyc_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kyc_records_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `p2ps`
--
ALTER TABLE `p2ps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawals_user_id_foreign` (`user_id`),
  ADD KEY `withdrawals_deposit_coin_id_foreign` (`deposit_coin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auto_wallets`
--
ALTER TABLE `auto_wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bots`
--
ALTER TABLE `bots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bot_activations`
--
ALTER TABLE `bot_activations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bot_histories`
--
ALTER TABLE `bot_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cron_jobs`
--
ALTER TABLE `cron_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_coins`
--
ALTER TABLE `deposit_coins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kyc_records`
--
ALTER TABLE `kyc_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `p2ps`
--
ALTER TABLE `p2ps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auto_wallets`
--
ALTER TABLE `auto_wallets`
  ADD CONSTRAINT `auto_wallets_deposit_coin_id_foreign` FOREIGN KEY (`deposit_coin_id`) REFERENCES `deposit_coins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auto_wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bot_activations`
--
ALTER TABLE `bot_activations`
  ADD CONSTRAINT `bot_activations_bot_id_foreign` FOREIGN KEY (`bot_id`) REFERENCES `bots` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bot_activations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bot_histories`
--
ALTER TABLE `bot_histories`
  ADD CONSTRAINT `bot_histories_bot_activation_id_foreign` FOREIGN KEY (`bot_activation_id`) REFERENCES `bot_activations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bot_histories_bot_id_foreign` FOREIGN KEY (`bot_id`) REFERENCES `bots` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bot_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_deposit_coin_id_foreign` FOREIGN KEY (`deposit_coin_id`) REFERENCES `deposit_coins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `deposits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kyc_records`
--
ALTER TABLE `kyc_records`
  ADD CONSTRAINT `kyc_records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_deposit_coin_id_foreign` FOREIGN KEY (`deposit_coin_id`) REFERENCES `deposit_coins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `withdrawals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
