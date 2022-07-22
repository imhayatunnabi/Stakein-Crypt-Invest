-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 09:33 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genius_crypto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` tinyint(4) NOT NULL DEFAULT 0,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `role_id`, `photo`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01629552892', 0, '1639300861admin.jpg', '$2y$10$NSxBfIBeDdxRjisT83p/0uN4GN4LcbYvKzuazAfyekwPffExwBUpO', 1, 'CmnEZYrO8S6We3LKX9FM4PAt1vz1STvnG52Y3GtGQLRPkRJlmAbbkq14FEbC', '2018-02-28 23:27:08', '2021-12-12 03:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin_languages`
--

CREATE TABLE `admin_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_languages`
--

INSERT INTO `admin_languages` (`id`, `is_default`, `language`, `file`, `name`, `rtl`, `created_at`, `updated_at`) VALUES
(1, 1, 'En', '1603880510hWH6gk7S.json', '1603880510hWH6gk7S', 0, NULL, NULL),
(19, 0, 'English', '16414442159c07jg2c.json', '16414442159c07jg2c', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_conversations`
--

CREATE TABLE `admin_user_conversations` (
  `id` int(191) NOT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(191) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user_messages`
--

CREATE TABLE `admin_user_messages` (
  `id` int(191) NOT NULL,
  `conversation_id` int(191) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(191) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `meta_tag` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category_id`, `title`, `slug`, `details`, `photo`, `source`, `views`, `status`, `meta_tag`, `meta_description`, `tags`, `created_at`) VALUES
(29, 3, 'The First Margin Trading Race of 2022 Has Landed!', 'the-first-margin-trading-race-of-2022-has-landed', 'The Crypto.com Exchange’s first Margin Trading Race of 2022 is locked, loaded, and ready to go! If you haven’t Margin traded in a while, it’s time to shake off the dust. Here’s why: the first 500 users who Margin trade at least USD 100 of any pair will score USD 50 in CRO and the chance to win tickets to a PSG vs Real Madrid Champions League game.\r\n\r\nNew and existing users with a Margin Trading account who have not made a Margin trade since 1 November 2021 are eligible for this campaign.\r\n\r\nCampaign Period: 14 January 2022 at 08:00 UTC - 26 January 2022 at 00:00 UTC\r\n\r\nHow to participate:\r\n\r\nSign in or sign up to the Crypto.com Exchange\r\nOpen a Margin Wallet (if you are new to Margin Trading)\r\nMargin trade at least USD 100 of any pair (FAQ, How-to video)\r\nRegister for the campaign here.\r\n\r\nThe first 500 eligible users who Margin trade at least USD 100 during the Campaign Period will win a share of USD 25,000 in CRO. Among the winners, three lucky traders will each receive one pair of tickets to the PSG vs Real Madrid Champions League game on 15 February 2022 at Paris Saint-Germain’s homeground, Le Parc des Princes!\r\n\r\n<<Trade Now>>\r\n\r\nWhat is Margin Trading?\r\nMargin Trading allows users to amplify their trading profits through borrowed funds during both up and down market movements. Users can access up to 3x leverage for eligible pairs. The Crypto.com Coin (CRO) powers Margin Trading with additional utility, offering preferential interest rates—as low as 0.008% per day—to users who stake CRO.\r\n\r\nCheck out our step-by-step video guides on How to Set Up Your Margin Trading Account and Use your Margin Trading Account.\r\n\r\nUseful Links:\r\n\r\nJoin us on Telegram to connect with our community.\r\nRefer to this FAQ for the latest list of supported margin trading pairs.\r\nRefer to this Margin Trading FAQ for more details about borrowing limits, and interest rates.\r\nNotes:\r\n\r\nIn addition to the following rules, please refer to the Official Rules for Sweepstakes for further rules regarding eligibility.\r\nThe Margin Trading Campaign is offered by Crypto.com to Crypto.com Exchange users.\r\nAny trades that are executed through bad trading practices in Crypto.com’s absolute opinion, including but not limited to wash trades, false trading, self-dealing, or trades that display any attributes of market manipulation (“Disqualified Trades”) will not be counted towards the transaction volume of the participant.\r\nThe links provided above to helpful information are for reference only.\r\nThe Reward will be paid in CRO and will be credited into the winners’ Crypto.com Exchange CRO Wallet within 30 days after the Reward Period ends.\r\nThe Paris Saint-Germain tickets will be e-mailed to the winners’ Crypto.com E-mail address 3-5 days prior to the game.\r\nWinners may be required to prove eligibility including proof of age, residence, and identity, which may include submitting a copy of his/her passport or similar government issued identification to collect the e-tickets.\r\nCrypto.com is not responsible for paying any additional fees associated with the redemption or usage of the prizes e.g including but not limited to personal expenses, taxes, etc.\r\nMargin trading geo-restrictions apply, please refer to this list for the excluded jurisdictions.\r\nThe eligibility of participants will be verified by Crypto.com after the campaign ends and the lucky draw results will be published.\r\nCrypto.com reserves the right to cancel or amend the campaign rules at our sole discretion.\r\nAll personal data collected is used strictly for verification purposes only.\r\nBy accepting the prize, winners agree to the Privacy Notice of Crypto.com, which is published at crypto.com/en/privacy/global.html.', 'PZiEKKQb1642483860.jpg', 'https://dev.geniusocean.net/geniuscrypto/', 0, 1, NULL, NULL, NULL, '2022-01-17 18:59:17'),
(30, 6, 'RUNE Exclusive Campaign Winner Announcement', 'rune-exclusive-campaign-winner-announcement', 'We’re excited to the results of the RUNE, Ex users have the chance to win a share of the prize pool worth USD 50,000 in RUNE by depositing and trading the token.\r\n\r\nCongratulations to all the winners! You will soon receive an email from us.\r\n\r\nPart 1: RUNE (BEP2) Net Deposit Competition (USD 30,000 Prize Pool)\r\n\r\nThe top 200 users ranked by RUNE (BEP2) Net Deposits* wins a share of USD 30,000, with the Rank 1 participant taking home USD 1,000 of RUNE.\r\n\r\n*RUNE (BEP2) Net Deposits = Deposits From External Exchanges and Wallets on BEP2 (RUNE) + Buys (RUNE) - Sells (RUNE) - Withdrawals (RUNE)\r\n\r\nUsers can be rewarded for both Part 1 and Part 2 of the campaign.\r\n\r\nFor more information about the promotion, please visit our blog.\r\n\r\nNote:\r\n\r\nThe eligibility of participants will be verified by Crypto.com after the campaign ends.', 'B4Ny29lM1642483847.jpg', 'https://dev.geniusocean.net/geniuscrypto', 1, 1, NULL, NULL, NULL, '2022-01-18 10:25:51'),
(31, 5, 'Crypto.com App Lists IDEX (IDEX)', 'cryptocom-app-lists-idex-idex', 'IDEX (IDEX) is now listed in the Crypto.com App, joining the growing list of 250+ supported cryptocurrencies and stablecoins, including Bitcoin (BTC), Ether (ETH), Polkadot (DOT), Chainlink (LINK), VeChain (VET), USD Coin (USDC), and Crypto.org Coin (CRO).\r\n\r\nIDEX is the first Hybrid Liquidity DEX that blends the best of centralised and decentralised exchanges, with the performance and features of a traditional order book and the security and liquidity of an automated market maker (AMM). Users benefit from not having to pay additional network costs for placing or canceling orders. Placements are also processed in real time, enabling advanced trading. IDEX is an Ethereum token that powers the IDEX decentralised exchange. IDEX holders can stake tokens in order to help secure the protocol and earn rewards.\r\n\r\nCrypto.com App users can now purchase IDEX at true cost with USD, EUR, GBP, and 20+ fiat currencies, and spend it at over 80 million merchants globally using the Crypto.com Visa Card.', 'yIQZFLYw1642483836.jpg', 'https://dev.geniusocean.net/geniuscrypto', 0, 1, NULL, NULL, NULL, '2022-01-18 10:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` int(191) NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`) VALUES
(2, 'Products', 'oil-and-gas'),
(3, 'Partnership', 'manufacturing'),
(4, 'Crypto', 'chemical_research'),
(5, 'Community', 'agriculture'),
(6, 'Daily Invest', 'mechanical'),
(7, 'Investment', 'entrepreneurs');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(191) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sign` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `sign`, `value`, `is_default`) VALUES
(1, 'USD', '$', 1, 1),
(4, 'BDT', '৳', 82.92649841308594, 0),
(6, 'EUR', '€', 0.864870011806488, 0),
(8, 'NGN', '₦', 410.94, 0),
(9, 'INR', '₹', 74, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(11) NOT NULL,
  `deposit_number` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `method` varchar(255) DEFAULT NULL,
  `charge_id` varchar(255) DEFAULT NULL,
  `status` enum('pending','complete') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `email_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_subject` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_body` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `email_type`, `email_subject`, `email_body`, `status`) VALUES
(1, 'Invest', 'You have invested successfully.', '<p>Hello {customer_name},<br>You have invested successfully.</p><p>Transaction ID:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span></p><p>Thank You.</p>', 1),
(2, 'Payout', 'Your Investment is completed successfully.', '<p>Hello {customer_name},<br>Your Investment is completed successfully.</p><p>Transaction ID:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span><br></p><p>Thank You<br></p>', 1),
(3, 'Withdraw', 'Your withdraw is completed successfully.', '<p>Hello {customer_name},<br>Your withdraw is completed successfully.</p><p>Thank You<br></p>', 1),
(4, 'Deposti', 'You have invested successfully.', '<p>Hello {customer_name},<br>You have deposited successfully.</p><p>Transaction ID:&nbsp;<span style=\"color: rgb(33, 37, 41);\">{order_number}.</span></p><p>Thank You.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `details`, `status`) VALUES
(1, 'Right my front it wound cause fully', '<span style=\"color: rgb(70, 85, 65); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</span><br>', 1),
(3, 'Man particular insensible celebrated', '<span style=\"color: rgb(70, 85, 65); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</span><br>', 1),
(4, 'Civilly why how end viewing related', '<span style=\"color: rgb(70, 85, 65); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</span><br>', 0),
(5, 'Six started far placing saw respect', '<span style=\"color: rgb(70, 85, 65); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.</span><br>', 0),
(6, 'She jointure goodness interest debat', '<div style=\"text-align: center;\"><div style=\"text-align: center;\"><img src=\"https://i.imgur.com/MGucWKc.jpg\" width=\"350\"></div></div><div style=\"text-align: center;\"><br></div><div style=\"text-align: center;\"><span style=\"color: rgb(70, 85, 65); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" font-size:=\"\" 16px;\"=\"\">Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.<br></span></div>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(191) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `title`, `details`, `photo`) VALUES
(8, 'Add coins to your Wallet', 'Add bitcoins you’ve created or exchanged via credit card.', '1639476553add-bitcoins.png'),
(9, 'Buy/Sell with Wallet', 'Enter receiver\'s address, specify the amount and send.', '1639476522buy-sell-bitcoins.png'),
(10, 'Download Bitcoin Wallet', 'Get it on PC or Mobile to create, send and receive bitcoins.', '1639476579download-bitcoin.png');

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `font_family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fonts`
--

INSERT INTO `fonts` (`id`, `font_family`, `font_value`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 'Rubik', 'Rubik', 0, '2021-09-07 22:34:28', '2022-01-17 13:07:33'),
(2, 'Roboto', 'Roboto', 0, '2021-09-07 22:35:10', '2022-01-17 13:07:33'),
(3, 'New Tegomin', 'New+Tegomin', 0, '2021-09-07 22:35:23', '2022-01-17 13:07:33'),
(5, 'Open Sans', 'Open+Sans', 1, '2021-09-07 22:44:49', '2022-01-17 13:07:33'),
(7, 'sanssarif', 'sanssarif', 0, '2021-09-12 02:47:49', '2022-01-17 13:07:33');

-- --------------------------------------------------------

--
-- Table structure for table `generalsettings`
--

CREATE TABLE `generalsettings` (
  `id` int(191) NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loader` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_loader` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_talkto` tinyint(1) NOT NULL DEFAULT 1,
  `talkto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_language` tinyint(1) NOT NULL DEFAULT 1,
  `is_loader` tinyint(1) NOT NULL DEFAULT 1,
  `map_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_disqus` tinyint(1) NOT NULL DEFAULT 0,
  `disqus` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_contact` tinyint(1) NOT NULL DEFAULT 0,
  `is_faq` tinyint(1) NOT NULL DEFAULT 0,
  `withdraw_status` tinyint(4) NOT NULL DEFAULT 0,
  `paypal_check` tinyint(1) DEFAULT 0,
  `flutter_check` tinyint(4) NOT NULL DEFAULT 0,
  `paystack_check` tinyint(4) NOT NULL DEFAULT 0,
  `paystack_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paytm_check` tinyint(4) DEFAULT NULL,
  `paystack_email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_check` tinyint(1) NOT NULL DEFAULT 0,
  `blockchain_check` int(11) NOT NULL DEFAULT 1,
  `coinpayment_check` int(11) NOT NULL DEFAULT 1,
  `cod_check` tinyint(1) NOT NULL DEFAULT 0,
  `paypal_business` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_client_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_client_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_sandbox_check` tinyint(4) NOT NULL DEFAULT 0,
  `stripe_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flutter_public_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flutter_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paytm_merchant` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paytm_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paytm_website` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paytm_industry` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paytm_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paytm_mode` enum('sandbox','live') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_encryption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smtp_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_pass` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_smtp` tinyint(1) NOT NULL DEFAULT 0,
  `coupon_found` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `already_coupon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_currency` tinyint(1) NOT NULL DEFAULT 0,
  `currency_format` tinyint(1) NOT NULL DEFAULT 0,
  `price_bigtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_subtitle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribe_success` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscribe_error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcumb_banner` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin_loader` tinyint(1) NOT NULL DEFAULT 0,
  `currency_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_sign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verification_email` tinyint(1) NOT NULL DEFAULT 0,
  `withdraw_fee` double NOT NULL DEFAULT 0,
  `withdraw_charge` double NOT NULL DEFAULT 0,
  `is_affilate` tinyint(1) NOT NULL DEFAULT 1,
  `affilate_charge` double NOT NULL DEFAULT 0,
  `affilate_banner` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_string` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blockchain_xpub` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blockchain_api` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gap_limit` int(11) NOT NULL DEFAULT 300,
  `coin_public_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_private_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blockio_api_btc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blockio_api_ltc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blockio_api_dgc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vouge_merchant` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blockio_btc` int(3) NOT NULL DEFAULT 1,
  `blockio_ltc` int(3) NOT NULL DEFAULT 1,
  `blockio_dgc` int(3) NOT NULL DEFAULT 1,
  `vougepay` int(3) NOT NULL DEFAULT 1,
  `coingate_auth` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coingate` int(11) NOT NULL DEFAULT 1,
  `isWallet` tinyint(4) NOT NULL DEFAULT 0,
  `affilate_new_user` int(11) NOT NULL DEFAULT 0,
  `affilate_user` int(11) NOT NULL DEFAULT 0,
  `footer_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pm_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pm` tinyint(4) DEFAULT 0,
  `cc_api_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_coin_base` tinyint(4) DEFAULT 0,
  `balance_transfer` tinyint(4) NOT NULL DEFAULT 0,
  `two_factor` tinyint(4) NOT NULL DEFAULT 0,
  `kyc` tinyint(4) NOT NULL DEFAULT 0,
  `menu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generalsettings`
--

INSERT INTO `generalsettings` (`id`, `logo`, `favicon`, `loader`, `admin_loader`, `banner`, `title`, `header_email`, `header_phone`, `footer`, `copyright`, `colors`, `is_talkto`, `talkto`, `is_language`, `is_loader`, `map_key`, `is_disqus`, `disqus`, `is_contact`, `is_faq`, `withdraw_status`, `paypal_check`, `flutter_check`, `paystack_check`, `paystack_key`, `paytm_check`, `paystack_email`, `stripe_check`, `blockchain_check`, `coinpayment_check`, `cod_check`, `paypal_business`, `paypal_client_id`, `paypal_client_secret`, `paypal_sandbox_check`, `stripe_key`, `stripe_secret`, `flutter_public_key`, `flutter_secret`, `paytm_merchant`, `paytm_secret`, `paytm_website`, `paytm_industry`, `paytm_text`, `paytm_mode`, `smtp_host`, `smtp_port`, `smtp_encryption`, `smtp_user`, `smtp_pass`, `from_email`, `from_name`, `is_smtp`, `coupon_found`, `already_coupon`, `order_title`, `service_subtitle`, `service_title`, `service_text`, `service_image`, `order_text`, `is_currency`, `currency_format`, `price_bigtitle`, `price_title`, `price_subtitle`, `price_text`, `subscribe_success`, `subscribe_error`, `error_title`, `error_text`, `error_photo`, `breadcumb_banner`, `is_admin_loader`, `currency_code`, `currency_sign`, `is_verification_email`, `withdraw_fee`, `withdraw_charge`, `is_affilate`, `affilate_charge`, `affilate_banner`, `secret_string`, `blockchain_xpub`, `blockchain_api`, `gap_limit`, `coin_public_key`, `coin_private_key`, `blockio_api_btc`, `blockio_api_ltc`, `blockio_api_dgc`, `vouge_merchant`, `blockio_btc`, `blockio_ltc`, `blockio_dgc`, `vougepay`, `coingate_auth`, `coingate`, `isWallet`, `affilate_new_user`, `affilate_user`, `footer_logo`, `pm_account`, `is_pm`, `cc_api_key`, `is_coin_base`, `balance_transfer`, `two_factor`, `kyc`, `menu`) VALUES
(1, 'VKfGLZ7u1642483785.png', '16393007481563335660service-icon-1.png', 'dhZik7hS1642399723.gif', 'xtO20vtZ1642399730.gif', '1563350277herobg.jpg', 'Invest Genius - Cryptocurrency HYIP Investment Platform', 'Info@example.com', '0123 456789', 'A place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.', 'COPYRIGHT © 2019. All Rights Reserved By <a href=\"http://geniusocean.com/\">GeniusOcean.com</a>', '#d7852e', 0, '<script type=\"text/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src=\'https://embed.tawk.to/5bc2019c61d0b77092512d03/default\';\r\ns1.charset=\'UTF-8\';\r\ns1.setAttribute(\'crossorigin\',\'*\');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n</script>', 1, 1, 'AIzaSyB1GpE4qeoJ__70UZxvX9CTMUTZRZNHcu8', 1, 'newspaper-7', 1, 1, 1, 1, 1, 1, 'pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2', 1, 'junnuns@gmail.com', 1, 1, 1, 1, 'shaon143-facilitator-1@gmail.com', 'AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi', 'EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE', 0, 'pk_test_UnU1Coi1p5qFGwtpjZMRMgJM', 'sk_test_QQcg3vGsKRPlW6T3dXcNJsor', 'FLWPUBK_TEST-a34940f2f87746abbdd8c117caee81cf-X', 'FLWSECK_TEST-1cb427c96e0b1e6772a04504be3638bd-X', 'tkogux49985047638244', 'LhNGUUKE9xCQ9xY8', 'WEBSTAGING', 'Retail', NULL, 'sandbox', 'smtp.mailtrap.io', '2525', 'tls', 'df3da325f3ec48', '8e18def867639a', 'admin@geniusocean.com', 'GeniusOcean', 1, 'Coupon Found', 'Coupon Already Applied', 'THANK YOU FOR YOUR INVEST.', '<h5 class=\"sub-title\">A litter bit More&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</h5>', '<h2 class=\"title extra-padding\">About US&nbsp;</h2>', '<p>Our organization pursues several goals that can be \r\n											identified as our mission. Learn more about them below.\r\n											Auis nostrud exercitation ullamc laboris nisitm aliquip ex \r\nbea sed consequat duis autes ure dolor. dolore magna aliqua nim ad \r\nminim.</p>\r\n									<p>\r\n											Auis nostrud exercitation ullamc laboris nisitm aliquip ex \r\nbea sed consequat duis autes ure dolor. dolore magna aliqua nim ad \r\nminim.&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', '1563350729about.png', 'We\'ll email you an order confirmation with details and tracking info.', 1, 1, 'PRICING', 'Choose Plans & Pricing', 'Choose the best for yourself', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'You are subscribed Successfully.', 'This email has already been taken.', 'OOPS ! ... PAGE NOT FOUND', 'THE PAGE YOU ARE LOOKING FOR MIGHT HAVE BEEN REMOVED, HAD ITS NAME CHANGED, OR IS TEMPORARILY UNAVAILABLE.', '16392899281561878540404.png', '1639560643bg-banner.jpg', 1, 'USD', '$', 0, 5, 5, 1, 5, '16406712051566471347add.jpg', 'ZzsMLGKe162CfA5EcG6j', 'xpub6CfHiBbFnj1eCa68kYVKYvvW9sxh76YLLHPJGGbWo8Xd3PADnLTG9tX8bpEvoERzDQYCGxvJcc7yyQHKXGKfRUr4KrkYS3gsfDZvVeavqMP', 'a10cca40-7934-4688-810d-adfb821b4b03', 3000, 'a5631c29ee0c12f5912c388d2be49d4a3eb86db2b739d4cd5a4a822dd72995bc', '2c6E81c067035F4fa4A7dB2Dd71452E5B5bd21b15BABB64870f019E26048e0bA', '1cfe-6428-523f-dd08', 'a9ef-8f3c-ec8c-6070', '3636-1e7f-c44b-5551', 'DEMO', 1, 1, 1, 0, 'B46P1XMf388193hz-sqrDJPhNprKy8xaZ3Sb2dt2', 1, 1, 5, 5, 'OaZCFqJ61642483790.png', 'U36807958', 1, 'cdb2163c-91cc-4fa6-b3fc-7de11bdcdf1a', 1, 1, 0, 1, '{\"Home\":{\"title\":\"Home\",\"dropdown\":\"no\",\"href\":\"\\/\",\"target\":\"self\"},\"Services\":{\"title\":\"Services\",\"dropdown\":\"no\",\"href\":\"\\/services\",\"target\":\"self\"},\"Plan\":{\"title\":\"Plan\",\"dropdown\":\"no\",\"href\":\"\\/pricing-plan\",\"target\":\"self\"},\"Blog\":{\"title\":\"Blog\",\"dropdown\":\"no\",\"href\":\"\\/blogs\",\"target\":\"self\"},\"Contact\":{\"title\":\"Contact\",\"dropdown\":\"no\",\"href\":\"\\/contact\",\"target\":\"self\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rtl` tinyint(4) NOT NULL DEFAULT 0,
  `is_default` tinyint(4) NOT NULL DEFAULT 0,
  `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `rtl`, `is_default`, `language`, `name`, `file`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'EN', '1636017050KyjRNauw', '1636017050KyjRNauw.json', NULL, NULL),
(14, 0, 0, 'Bn', '1641443819L3vJreHG', '1641443819L3vJreHG.json', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(191) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `title`, `subtitle`, `photo`, `facebook`, `twitter`, `linkedin`) VALUES
(2, 'Ervin Kim', 'CEO of Apple', '1561539258comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(3, 'Ervin Kim', 'CEO of Apple', '1561539242comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(4, 'Ervin Kim', 'CEO of Apple', '1561539231comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(5, 'Ervin Kim', 'CEO of Apple', '1561539222comment2.png', NULL, 'https://www.twitter.com', 'https://www.linkedin.com'),
(6, 'Ervin Kim', 'CEO of Apple', '1561539213comment2.png', NULL, 'https://www.twitter.com', 'https://www.linkedin.com'),
(7, 'Ervin Kim', 'CEO of Apple', '1561539184comment2.png', 'https://www.facebook.com', NULL, 'https://www.linkedin.com'),
(8, 'Ervin Kim', 'CEO of Apple', '1561539197comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', 'https://www.linkedin.com'),
(9, 'Ervin Kim', 'CEO of Apple', '1561539345comment2.png', 'https://www.facebook.com', 'https://www.twitter.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(191) NOT NULL,
  `order_id` int(191) UNSIGNED DEFAULT NULL,
  `user_id` int(191) DEFAULT NULL,
  `vendor_id` int(191) DEFAULT NULL,
  `product_id` int(191) DEFAULT NULL,
  `conversation_id` int(191) DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(191) NOT NULL,
  `invest` double NOT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_amount` float NOT NULL,
  `coin_amount` double DEFAULT NULL,
  `txnid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify_id` text DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `payment_status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `customer_email` varchar(255) NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_city` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_zip` varchar(255) DEFAULT NULL,
  `status` enum('pending','running','completed','declined') NOT NULL DEFAULT 'pending',
  `income_add_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_sign` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coin_address` text DEFAULT NULL,
  `confirmations` int(11) DEFAULT NULL,
  `end_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `check_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(191) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_tag` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` tinyint(1) NOT NULL DEFAULT 0,
  `footer` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `details`, `meta_tag`, `meta_description`, `header`, `footer`, `status`) VALUES
(1, 'About Us', 'about', '<div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 1</font><br></h2><p><span style=\"font-weight: 700;\">Lorem Ipsum</span>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p></div><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 2</font><br></h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><br helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><div helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\"><h2><font size=\"6\">Title number 3</font><br></h2><p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p><p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p></div><h2 helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-weight:=\"\" 700;=\"\" line-height:=\"\" 1.1;=\"\" color:=\"\" rgb(51,=\"\" 51,=\"\" 51);=\"\" margin:=\"\" 0px=\"\" 15px;=\"\" font-size:=\"\" 30px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\" style=\"font-family: \" 51);\"=\"\"><font size=\"6\">Title number 9</font><br></h2><p helvetica=\"\" neue\",=\"\" helvetica,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" font-style:=\"\" normal;=\"\" font-variant-ligatures:=\"\" font-variant-caps:=\"\" font-weight:=\"\" 400;=\"\" letter-spacing:=\"\" orphans:=\"\" 2;=\"\" text-align:=\"\" start;=\"\" text-indent:=\"\" 0px;=\"\" text-transform:=\"\" none;=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\" -webkit-text-stroke-width:=\"\" background-color:=\"\" rgb(255,=\"\" 255,=\"\" 255);=\"\" text-decoration-style:=\"\" initial;=\"\" text-decoration-color:=\"\" initial;\"=\"\">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, 1, 0, 0),
(2, 'Privacy & Policy', 'privacy', 'This Privacy Policy explains how we collect, use and (under certain conditions) disclose your personal information. This Privacy Policy also explains the steps we have taken to secure your personal information. Finally, this Privacy Policy explains your options regarding the collection, use and disclosure of your personal information. By visiting the Site directly or through another site, you accept the practices described in this Policy.\r\nData protection is a matter of trust and your privacy is important to us. We shall therefore only use your name and other information which relates to you in the manner set out in this Privacy Policy. We will only collect information where it is necessary for us to do so and we will only collect information if it is relevant to our dealings with you.\r\nWe will only keep your information for as long as we are either required to by law or as is relevant for the purposes for which it was collected.\r\nWe will cease to retain your personal data, or remove the means by which the data can be associated with you, as soon as it is reasonable to assume that such retention no longer serves the purposes for which the personal data was collected, and is no longer necessary for any legal or business purpose.\r\nYou can visit the Site and browse without having to provide personal details. During your visit to the Site you remain anonymous and at no time can we identify you unless you have an account on the Site and log on with your user name and password.', 'test,test1,test2,test3', 'Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pagesettings`
--

CREATE TABLE `pagesettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_success` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider` tinyint(1) NOT NULL DEFAULT 1,
  `service` tinyint(1) NOT NULL DEFAULT 1,
  `featured` tinyint(1) NOT NULL DEFAULT 1,
  `small_banner` tinyint(1) NOT NULL DEFAULT 1,
  `best` tinyint(1) NOT NULL DEFAULT 1,
  `top_rated` tinyint(1) NOT NULL DEFAULT 1,
  `large_banner` tinyint(1) NOT NULL DEFAULT 1,
  `big` tinyint(1) NOT NULL DEFAULT 1,
  `hot_sale` tinyint(1) NOT NULL DEFAULT 1,
  `review_blog` tinyint(1) NOT NULL DEFAULT 1,
  `pricing_plan` tinyint(1) NOT NULL DEFAULT 0,
  `service_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `review_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_top_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_link1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_link2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_big_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `c_background` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagesettings`
--

INSERT INTO `pagesettings` (`id`, `contact_success`, `contact_email`, `contact_title`, `contact_text`, `side_title`, `side_text`, `street`, `phone`, `fax`, `email`, `site`, `slider`, `service`, `featured`, `small_banner`, `best`, `top_rated`, `large_banner`, `big`, `hot_sale`, `review_blog`, `pricing_plan`, `service_subtitle`, `service_title`, `service_text`, `review_subtitle`, `review_title`, `review_text`, `blog_subtitle`, `blog_title`, `blog_text`, `about_photo`, `about_title`, `about_text`, `about_link`, `service_photo`, `service_video`, `footer_top_photo`, `footer_top_title`, `footer_top_text`, `banner_title`, `banner_text`, `banner_link1`, `banner_link2`, `t_big_title`, `t_subtitle`, `t_title`, `t_text`, `c_title`, `c_text`, `c_background`) VALUES
(1, 'Success! Thanks for contacting us, we will get back to you shortly.', 'admin@geniusocean.com', '<h4 class=\"subtitle\" style=\"margin-bottom: 6px; font-weight: 600; line-height: 28px; font-size: 28px; text-transform: uppercase;\">WE\'D LOVE TO</h4><h2 class=\"title\" style=\"margin-bottom: 13px;font-weight: 600;line-height: 50px;font-size: 40px;color: #1f71d4;text-transform: uppercase;\">HEAR FROM YOU</h2>', '<span style=\"color: rgb(119, 119, 119);\">Send us a message and we\' ll respond as soon as possible</span><br>', 'FEEL FREE TO DROP US A MESSAGE', 'Need to speak to us? Do you have any queries or suggestions? Please contact us about all enquiries including membership and volunteer work using the form below.', '3584 Hickory Heights Drive ,Hanover MD 21076, USA', '00 000 000 000', '00 000 000 000', 'admin@geniusocean.com', 'https://geniusocean.com/', 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 'THE BEST SERVICES', 'We bring the best things', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Testimonial', 'Customer Reviews', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Latest Blog', 'LOREM IPSUM DOLOR', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '1639556548about-us.png', 'WE ARE BAYYA', 'A place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.\r\n\r\nA place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.\r\n\r\nA place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.\r\n\r\nA place for everyone who wants to simply buy and sell Bitcoins. Deposit funds using your Visa/MasterCard or bank transfer. Instant buy/sell of Bitcoins at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.', 'https://www.google.com/', '1639568953bg-banner.jpg', 'https://www.youtube.com/watch?v=0gv7OC9L2s8', '1639561929call-to-action-bg.jpg', 'GET STARTED TODAY WITH BITCOIN', 'Open account for free and start trading Bitcoins!', '<h4 class=\"subtitle\" style=\"font-weight: 600; line-height: 1.2381; font-size: 24px; color: rgb(31, 113, 212);\">More convenient than others</h4>', '<h2 class=\"title\" style=\"font-weight: 600; line-height: 60px; font-size: 50px; color: rgb(23, 34, 44);\">Find Value &amp; Build confidence</h2>', 'https://www.google.com/', 'https://www.google.com/', 'TRANSACTIONS', 'User Statistics', 'Lastest Transactions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Enter your bitcoin address and make the first investment', NULL, '1566454842address-submit.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` int(191) NOT NULL,
  `subtitle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('manual','automatic') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'manual',
  `information` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keyword` varchar(191) DEFAULT NULL,
  `currency_id` varchar(191) NOT NULL DEFAULT '0',
  `status` int(191) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `subtitle`, `title`, `details`, `name`, `type`, `information`, `keyword`, `currency_id`, `status`) VALUES
(2, '(5 - 6 days)', 'Mobile Money', '<b>Payment Number: </b>69234324233423', NULL, 'manual', NULL, NULL, '0', 1),
(6, NULL, NULL, NULL, 'Flutter Wave', 'automatic', '{\"public_key\":\"FLWPUBK_TEST-299dc2c8bf4c7f14f7d7f48c32433393-X\",\"secret_key\":\"FLWSECK_TEST-afb1f2a4789002d7c0f2185b830450b7-X\",\"text\":\"Pay via your Flutter Wave account.\"}', 'flutterwave', '[\"1\"]', 1),
(8, NULL, NULL, NULL, 'Authorize.Net', 'automatic', '{\"login_id\":\"76zu9VgUSxrJ\",\"txn_key\":\"2Vj62a6skSrP5U3X\",\"sandbox_check\":1,\"text\":\"Pay Via Authorize.Net\"}', 'authorize.net', '[\"1\"]', 1),
(9, NULL, NULL, NULL, 'Razorpay', 'automatic', '{\"key\":\"rzp_test_xDH74d48cwl8DF\",\"secret\":\"cr0H1BiQ20hVzhpHfHuNbGri\",\"text\":\"Pay via your Razorpay account.\"}', 'razorpay', '[\"8\"]', 1),
(10, NULL, NULL, NULL, 'Mollie Payment', 'automatic', '{\"key\":\"test_jePgBjaRV5rUdzWc44rb2fUxgM2dM9\",\"text\":\"Pay with Mollie Payment.\"}', 'mollie', '[\"1\",\"6\"]', 1),
(11, NULL, NULL, NULL, 'Paytm', 'automatic', '{\"merchant\":\"tkogux49985047638244\",\"secret\":\"LhNGUUKE9xCQ9xY8\",\"website\":\"WEBSTAGING\",\"industry\":\"Retail\",\"sandbox_check\":1,\"text\":\"Pay via your Paytm account.\"}', 'paytm', '[\"8\"]', 1),
(12, NULL, NULL, NULL, 'Paystack', 'automatic', '{\"key\":\"pk_test_162a56d42131cbb01932ed0d2c48f9cb99d8e8e2\",\"email\":\"junnuns@gmail.com\",\"text\":\"Pay via your Paystack account.\"}', 'paystack', '[\"9\"]', 1),
(13, NULL, NULL, NULL, 'Instamojo', 'automatic', '{\"key\":\"test_172371aa837ae5cad6047dc3052\",\"token\":\"test_4ac5a785e25fc596b67dbc5c267\",\"sandbox_check\":1,\"text\":\"Pay via your Instamojo account.\"}', 'instamojo', '[\"8\"]', 1),
(14, NULL, NULL, NULL, 'Stripe', 'automatic', '{\"key\":\"pk_test_UnU1Coi1p5qFGwtpjZMRMgJM\",\"secret\":\"sk_test_QQcg3vGsKRPlW6T3dXcNJsor\",\"text\":\"Pay via your Credit Card.\"}', 'stripe', '[\"1\"]', 1),
(15, NULL, NULL, NULL, 'Paypal', 'automatic', '{\"client_id\":\"AcWYnysKa_elsQIAnlfsJXokR64Z31CeCbpis9G3msDC-BvgcbAwbacfDfEGSP-9Dp9fZaGgD05pX5Qi\",\"client_secret\":\"EGZXTq6d6vBPq8kysVx8WQA5NpavMpDzOLVOb9u75UfsJ-cFzn6aeBXIMyJW2lN1UZtJg5iDPNL9ocYE\",\"sandbox_check\":1,\"text\":\"Pay via your PayPal account.\"}', 'paypal', '[\"1\"]', 1),
(16, NULL, NULL, NULL, 'BlockChain', 'automatic', '{\"secret_string\":\"ZzsMLGKe162CfA5EcG6j\",\"blockchain_xpub\":\"xpub6CfHiBbFnj1eCa68kYVKYvvW9sxh76YLLHPJGGbWo8Xd3PADnLTG9tX8bpEvoERzDQYCGxvJcc7yyQHKXGKfRUr4KrkYS3gsfDZvVeavqMP\",\"blockchain_api\":\"a10cca40-7934-4688-810d-adfb821b4b03\",\"gap_limit\":\"3000\",\"text\":\"Pay via your BlockChain account.\"}', 'blockChain', '[\"1\"]', 1),
(17, NULL, NULL, NULL, 'CoinPayment ', 'automatic', '{\"secret_string\":\"ZzsMLGKe162CfA5EcG6j\",\"coin_public_key\":\"a5631c29ee0c12f5912c388d2be49d4a3eb86db2b739d4cd5a4a822dd72995bc\",\"coin_private_key\":\"2c6E81c067035F4fa4A7dB2Dd71452E5B5bd21b15BABB64870f019E26048e0bA\",\"text\":\"Pay via your Coin Payment account.\"}', 'coinPayment', '[\"1\"]', 1),
(18, NULL, NULL, NULL, 'Coingate', 'automatic', '{\"secret_string\":\"B46P1XMf388193hz-sqrDJPhNprKy8xaZ3Sb2dt2\",\"text\":\"Pay via your Coin gate account.\"}', 'coingate', '[\"1\"]', 1),
(21, NULL, NULL, NULL, 'Block.io (BTC)', 'automatic', '{\"blockio_api_btc\":\"fae9-e6f5-7d05-df07\",\"text\":\"Pay via your Block.io (BTC) account.\"}', 'block.io.btc', '[\"1\"]', 1),
(22, NULL, NULL, NULL, 'Block.io (LTC)', 'automatic', '{\"blockio_api_ltc\":\"642a-48dc-4e31-31f6\",\"text\":\"Pay via your Block.io (BTC) account.\"}', 'block.io.ltc', '[\"1\"]', 1),
(23, NULL, NULL, NULL, 'Block.io (DGC)', 'automatic', '{\"blockio_api_dgc\":\"e586-cdb2-d54e-be26\",\"text\":\"Pay via your Block.io (BTC) account.\"}', 'block.io.dgc', 'null', 1);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` int(191) NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `title`, `link`, `photo`) VALUES
(1, 'Search Engine Optimization', 'https://www.google.com/', '1561537582portfolio.jpg'),
(2, 'Search Engine Optimization', 'https://www.google.com/', '1561537603portfolio.jpg'),
(3, 'Search Engine Optimization', 'https://www.google.com/', '1561537609portfolio.jpg'),
(4, 'Search Engine Optimization', 'https://www.google.com/', '1561537620portfolio.jpg'),
(5, 'Search Engine Optimization', 'https://www.google.com/', '1561537630portfolio.jpg'),
(6, 'Search Engine Optimization', 'https://www.google.com/', '1561537643portfolio.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(191) UNSIGNED NOT NULL,
  `subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_price` double NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_price` double NOT NULL,
  `days` int(191) NOT NULL DEFAULT 0,
  `percentage` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `subtitle`, `title`, `min_price`, `details`, `max_price`, `days`, `percentage`) VALUES
(62, 'sed do eiusmod tempor', 'Plan 6', 100, '<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>', 1000, 90, 400),
(63, 'sed do eiusmod tempor', 'Plan 5', 100, '<ol><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li></ol>', 1000, 60, 300),
(64, 'sed do eiusmod tempor', 'Plan 4', 100, '<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>', 1000, 30, 200),
(65, 'sed do eiusmod tempor', 'Plan 3', 100, '<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>', 1000, 90, 400),
(66, 'sed do eiusmod tempor', 'Plan 2', 100, '<span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span><span style=\"color: rgb(0, 0, 0);\">Lorem ipsum dolor sit.</span><br>', 1000, 60, 300),
(67, 'sed do eiusmod tempor', 'Plan 1', 50, '<ol><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li><li>Lorem ipsum dolor sit amet<br></li></ol>', 5000, 30, 400);

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int(11) NOT NULL,
  `commission_type` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `percent` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `commission_type`, `level`, `percent`, `created_at`, `updated_at`) VALUES
(10, 'invest', 1, 3, '2022-02-01 21:59:02', '2022-02-01 21:59:02'),
(11, 'invest', 2, 2, '2022-02-01 21:59:02', '2022-02-01 21:59:02'),
(12, 'invest', 3, 1, '2022-02-01 21:59:02', '2022-02-01 21:59:02');

-- --------------------------------------------------------

--
-- Table structure for table `referral_bonuses`
--

CREATE TABLE `referral_bonuses` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `percentage` double DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `amount` decimal(20,10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `photo`, `title`, `subtitle`, `details`) VALUES
(4, '1561447511people.png', 'Jhon Smith', 'CEO & Founder', 'That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins'),
(5, '1561447450people.png', 'Jhon Smith', 'CEO & Founder', 'That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins'),
(6, '1561447441people.png', 'Jhon Smith', 'CEO & Founder', 'That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `section`, `created_at`, `updated_at`) VALUES
(6, 'Staff', 'Menu Builder , Invests , Transactions , Deposits , Manage Plans , Manage Customers , Manage Blog , General Setting , Homepage Setting , Email Setting , Message , Manage Roles , Messages , Social Setting , Payment Setting , Manage Staff , Language Setting , Fonts , Menupage Setting , Seo Tools , Subscribers', NULL, NULL),
(8, 'Moderator', 'Menu Builder , Deposits , Social Setting , Subscribers', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `seotools`
--

CREATE TABLE `seotools` (
  `id` int(10) UNSIGNED NOT NULL,
  `google_analytics` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keys` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seotools`
--

INSERT INTO `seotools` (`id`, `google_analytics`, `meta_keys`) VALUES
(1, '<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-137437974-1\"></script>  <script>    window.dataLayer = window.dataLayer || [];    function gtag(){dataLayer.push(arguments);}    gtag(\'js\', new Date());    gtag(\'config\', \'UA-137437974-1\');  </script>', 'Genius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,Sea');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(191) NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `details`, `photo`) VALUES
(15, 'HIGH LIQUIDITY', 'Fast access to high liquidity orderbook</br>\r\nfor top currency pairs', '1639476836high-liquidity.png'),
(16, 'COST EFFICIENCY', 'Reasonable trading fees for takers</br>\r\nand all market makers', '1639476885cost-efficiency.png'),
(17, 'MOBILE APP', 'Trading via our Mobile App, Available</br>\r\nin Play Store & App Store', '1639476911mobile-app.png'),
(18, 'PAYMENT OPTIONS', 'Popular methods: Visa, MasterCard,</br>\r\nbank transfer, cryptocurrency', '1639476937payment-options.png'),
(19, 'WORLD COVERAGE', 'Providing services in 99% countries</br>\r\naround all the globe', '1639476969world-coverage.png'),
(20, 'STRONG SECURITY', 'Protection against DDoS attacks,</br>\r\nfull data encryption', '1639476998strong-security.png');

-- --------------------------------------------------------

--
-- Table structure for table `sitemaps`
--

CREATE TABLE `sitemaps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitemap_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(191) UNSIGNED NOT NULL,
  `subtitle_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_anime` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_size` varchar(50) DEFAULT NULL,
  `title_color` varchar(50) DEFAULT NULL,
  `title_anime` varchar(50) DEFAULT NULL,
  `details_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_size` varchar(50) DEFAULT NULL,
  `details_color` varchar(50) DEFAULT NULL,
  `details_anime` varchar(50) DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `subtitle_text`, `subtitle_size`, `subtitle_color`, `subtitle_anime`, `title_text`, `title_size`, `title_color`, `title_anime`, `details_text`, `details_size`, `details_color`, `details_anime`, `photo`, `position`, `link`) VALUES
(9, 'YOU CAN TRUST', '24', '#ffffff', 'slideInUp', 'BITCOIN EXCHANGE', '60', '#ffffff', 'slideInDown', 'Highlight your personality  and look with these fabulous and exquisite fashion.', '16', '#ffffff', 'slideInDown', '1639479478bg1.jpg', 'slide-one', 'https://www.google.com/'),
(10, 'TO BITCOIN', '24', '#c32d2d', 'slideInUp', 'SECURE AND EASY WAY', '60', '#bc2727', 'slideInDown', NULL, NULL, '#c51d1d', 'slideInLeft', '1639479394bg2.jpg', 'slide-one', 'https://www.google.com/');

-- --------------------------------------------------------

--
-- Table structure for table `socialsettings`
--

CREATE TABLE `socialsettings` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gplus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dribble` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_status` tinyint(4) NOT NULL DEFAULT 1,
  `g_status` tinyint(4) NOT NULL DEFAULT 1,
  `t_status` tinyint(4) NOT NULL DEFAULT 1,
  `l_status` tinyint(4) NOT NULL DEFAULT 1,
  `d_status` tinyint(4) NOT NULL DEFAULT 1,
  `f_check` tinyint(10) DEFAULT NULL,
  `g_check` tinyint(10) DEFAULT NULL,
  `fclient_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fclient_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fredirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gclient_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gclient_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gredirect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `socialsettings`
--

INSERT INTO `socialsettings` (`id`, `facebook`, `gplus`, `twitter`, `linkedin`, `dribble`, `f_status`, `g_status`, `t_status`, `l_status`, `d_status`, `f_check`, `g_check`, `fclient_id`, `fclient_secret`, `fredirect`, `gclient_id`, `gclient_secret`, `gredirect`) VALUES
(1, 'https://www.facebook.com/', 'https://plus.google.com/', 'https://twitter.com/', 'https://www.linkedin.com/', 'https://dribbble.com/', 1, 1, 1, 1, 0, 1, 1, '503140663460329', 'f66cd670ec43d14209a2728af26dcc43', 'https://localhost/crypto/auth/facebook/callback', '904681031719-sh1aolu42k7l93ik0bkiddcboghbpcfi.apps.googleusercontent.com', 'yGBWmUpPtn5yWhDAsXnswEX3', 'http://localhost/marketplace/auth/google/callback');

-- --------------------------------------------------------

--
-- Table structure for table `social_providers`
--

CREATE TABLE `social_providers` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `provider_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_providers`
--

INSERT INTO `social_providers` (`id`, `user_id`, `provider_id`, `provider`, `created_at`, `updated_at`) VALUES
(3, 17, '102485372716947456487', 'google', '2019-06-19 17:06:00', '2019-06-19 17:06:00'),
(4, 18, '109955884428371086401', 'google', '2019-06-19 17:17:04', '2019-06-19 17:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(191) NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL DEFAULT 0,
  `receiver_id` int(11) DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `type` enum('Invest','Payout','Referral Bonus','Send Money','Received Money') NOT NULL,
  `txnid` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_provider` tinyint(10) NOT NULL DEFAULT 0,
  `status` tinyint(10) NOT NULL DEFAULT 0,
  `verification_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `income` double NOT NULL DEFAULT 0,
  `affilate_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_id` tinyint(1) NOT NULL DEFAULT 0,
  `twofa` tinyint(4) NOT NULL DEFAULT 0,
  `go` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_kyc` tinyint(4) NOT NULL DEFAULT 0,
  `is_banned` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 === banned\r\n0 === active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `order_id` int(191) NOT NULL DEFAULT 0,
  `withdraw_id` int(191) NOT NULL DEFAULT 0,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('Invest','Payout','Withdraw') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` int(191) NOT NULL,
  `user_id` int(191) DEFAULT NULL,
  `method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `swift` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `fee` float DEFAULT 0,
  `details` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` enum('pending','completed','rejected') NOT NULL DEFAULT 'pending',
  `type` enum('user','vendor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_methods`
--

CREATE TABLE `withdraw_methods` (
  `id` int(11) NOT NULL,
  `method` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `withdraw_methods`
--

INSERT INTO `withdraw_methods` (`id`, `method`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Paypal', 1, '2021-12-06 23:47:28', '2021-12-06 23:59:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_languages`
--
ALTER TABLE `admin_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generalsettings`
--
ALTER TABLE `generalsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pagesettings`
--
ALTER TABLE `pagesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_bonuses`
--
ALTER TABLE `referral_bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seotools`
--
ALTER TABLE `seotools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemaps`
--
ALTER TABLE `sitemaps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socialsettings`
--
ALTER TABLE `socialsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_languages`
--
ALTER TABLE `admin_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `admin_user_conversations`
--
ALTER TABLE `admin_user_conversations`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admin_user_messages`
--
ALTER TABLE `admin_user_messages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `generalsettings`
--
ALTER TABLE `generalsettings`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pagesettings`
--
ALTER TABLE `pagesettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(191) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `referral_bonuses`
--
ALTER TABLE `referral_bonuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seotools`
--
ALTER TABLE `seotools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sitemaps`
--
ALTER TABLE `sitemaps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(191) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `socialsettings`
--
ALTER TABLE `socialsettings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `withdraw_methods`
--
ALTER TABLE `withdraw_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
