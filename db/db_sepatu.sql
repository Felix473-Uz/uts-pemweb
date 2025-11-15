-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 05:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sepatu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_produk`, `id_user`, `qty`, `created_at`, `updated_at`) VALUES
(8, 3, 1, '2025-08-25 07:41:14', '2025-08-25 07:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(6, 'NIKE', '2025-06-01 21:36:34', '2025-06-10 05:09:27'),
(11, 'ADIDAS', '2025-06-10 04:23:57', '2025-06-10 04:23:57'),
(12, 'NEW BALANCE', '2025-06-10 05:18:48', '2025-06-10 05:18:48'),
(13, 'PUMA', '2025-06-10 08:19:33', '2025-06-10 08:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_30_234300_create_kategori_table', 1),
(5, '2025_05_30_234300_create_produk_table', 1),
(6, '2025_05_30_234301_create_transaksi_table', 1),
(7, '2025_05_30_234311_create_transaksi_detail_table', 1),
(8, '2025_05_30_234558_create_cart_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `foto_cover` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `deskripsi`, `harga`, `foto_cover`, `foto`, `created_at`, `updated_at`) VALUES
(8, 6, 'Nike Dunk Low LX Croc \" Black \"', 'sneakers', 400000, 'foto_produk/cover/c1khkGIrTZlz2eQvwRdco5MCKiW7h3O4Rc4u48Y4.jpg', '[\"foto_produk\\/lain\\/KvT0e3RQXGHqD0POoKxoA5AMyKBHDlgwJVIkQTyw.jpg\",\"foto_produk\\/lain\\/3SIUVTVrl9qKCmoItOuARSV46osCafLXCfpb6Nto.jpg\",\"foto_produk\\/lain\\/xbSsq06UzSm4jCwvg33teVnrglpAY3o1ta8j3rCm.jpg\"]', '2025-06-10 06:16:59', '2025-06-10 06:16:59'),
(10, 6, 'Nike Air Force One Low \"Chili Pepper\"', 'sneakers', 500000, 'foto_produk/cover/n8X3ghwuSHdvBHXbG6axNtd5AHdPXHk31Y5GdXbs.jpg', '[\"foto_produk\\/lain\\/5eXCIxDDnCQxEXBnc7qlzhyWxN9z8PtvKhTDs3qo.jpg\",\"foto_produk\\/lain\\/54MHAJqP8pfDse3eXRat2yskUHtMyOvZO7bTsLUD.jpg\",\"foto_produk\\/lain\\/tIK7ul6RnJ3qib4VOXGBg3LObhByOL2X6QOI795C.jpg\",\"foto_produk\\/lain\\/wNLuwZZDD1LXewzIz0492eehcjRYfVLSQqUTjTGX.jpg\"]', '2025-06-10 06:21:45', '2025-06-10 06:21:45'),
(11, 6, 'Nike SB Pogo \" Black Gum \"', 'sneaker', 450000, 'foto_produk/cover/MK9IvQxKFvT1hqLfnQ2ljO93bP2APiDrS7nJHYRM.jpg', '[\"foto_produk\\/lain\\/aGs1Nn3oOIyfvPnqlXken1bwrJCxwn9Gmwnc06Iw.jpg\",\"foto_produk\\/lain\\/vKg6gOjqJAoxV4alXGhy9bS33NHyMNFz1TM04iIn.jpg\",\"foto_produk\\/lain\\/SozxKeDBtFGSo9IUj7p1Zsgir4h1tsqvZjcth5ti.jpg\"]', '2025-06-10 06:33:25', '2025-06-10 06:33:25'),
(12, 6, 'Nike Airmax 90 SE 2 GS \" White Dark Purple Dust \"', 'sneaker', 550000, 'foto_produk/cover/Y8JZr8ItQaxnPNP2men6kK4q5HwM1vZfrYVX4BPO.jpg', '[\"foto_produk\\/lain\\/Np9OXU8oIDYeUc7ZKg0B1L1A1awh4T88UiOkmarX.jpg\",\"foto_produk\\/lain\\/nQc80cRE4Rc0iUnsCG4OJTLS1kdRyYDGrEX8TSFF.jpg\",\"foto_produk\\/lain\\/wKJGHAXTDzPtSUKorG8aUS8VqfFn67rjEpg88j4b.jpg\",\"foto_produk\\/lain\\/bfUSJjwGefbHEmDXqZ4RyUecMCa3MiB0mbPzQeuL.jpg\"]', '2025-06-10 06:36:35', '2025-06-10 06:36:35'),
(13, 6, 'Nike Air Force 1 Low \" Chicago Pack \"', 'sneakers', 475000, 'foto_produk/cover/8BVoqmm0WiuNffhG2puBD2YpAag0pg5FuGz5xwOz.jpg', '[\"foto_produk\\/lain\\/EKSOMdPcFBym67Bsjfq2LNDHjwnn4o3IRLAt8G5e.jpg\",\"foto_produk\\/lain\\/KSeqvmTFUhUVu758DKAaIGTOWNRZCv3G4OTiMRol.jpg\",\"foto_produk\\/lain\\/pZx3vAoMbnLc5bfsHwAXhtsr8pivfZZadVtKGgWo.jpg\",\"foto_produk\\/lain\\/0KW5SSn9jJRTe5QwJ1x5uZr16LtZiTbt7QT4YeoT.jpg\"]', '2025-06-10 06:39:24', '2025-06-10 06:39:24'),
(15, 6, 'Nike ReactX Infinity Run 4 \" White Black Light Crimson \"', 'running', 550000, 'foto_produk/cover/Y8rfn2Tu7qBuhWlM4F1QpSYGPce2fI8zYzLUEqsf.jpg', '[\"foto_produk\\/lain\\/ytYCmvO9NnF0B66WOImnNv4CT8rtoQU2obgBkNHF.jpg\",\"foto_produk\\/lain\\/6NHJW8TKxT6tR4ysstrRPBcS3tcQG22vjHWB9xbv.jpg\",\"foto_produk\\/lain\\/zhpJ0ghAKWMjJ3sNlIgIeR4nlQvnSntvetkowNOl.jpg\",\"foto_produk\\/lain\\/l4r0fnpA8ufWoyNmDJSjpZuO1bdopFVDjyP02WVb.jpg\"]', '2025-06-10 06:47:38', '2025-06-10 06:47:38'),
(16, 6, 'Nike Air Jordan 1 High \" Satin Bred \"', 'Limited Edition', 500000, 'foto_produk/cover/RmDjSdAP4fqyDxoAp04rcVGmLb8U56Tgl2YPJXFI.jpg', '[\"foto_produk\\/lain\\/WTP7H2B2Htnuifv2a1g08nVSZTdKvjM1qJOX40u7.jpg\",\"foto_produk\\/lain\\/Jth2CFoFH6ywus0XaDok1SaS66FbqpnpEimobPBb.jpg\",\"foto_produk\\/lain\\/4qhrtBb4vZiSze6gYlzkbOeG9VYRR5n2bHXwN5oz.jpg\"]', '2025-06-10 06:53:23', '2025-06-10 06:53:23'),
(17, 6, 'Nike Zoom X Zegama Trail 2 \" Armory Navy \"', 'Casual, Running', 480000, 'foto_produk/cover/08x89fcYTtlvWDY9nd9eJKDAeHgPYmoL2Dqz7r5Y.jpg', '[\"foto_produk\\/lain\\/vAYXiZuV48vWsHJxPkSF4iPT2KXOo0JyulPpDg7w.jpg\",\"foto_produk\\/lain\\/aIRc6hguqyg5UKJ2g5bJNGxmzliigtYKFoV4QwqQ.jpg\",\"foto_produk\\/lain\\/cEcPLfvR9EZOvIQBX0YMR1OvzHrUIj6ZOhRg4q73.jpg\",\"foto_produk\\/lain\\/i33ELtvUQPhrznS2axrMgIhBCG48hRWWY5j9PkW6.jpg\"]', '2025-06-10 06:57:23', '2025-06-10 06:58:19'),
(18, 11, 'Adidas Gazelle Bold Navy', 'Casual', 475000, 'foto_produk/cover/QxE0k9C3OAtvqk5hZn2myuoIqSjoRPLbQNNIM9j2.jpg', '[\"foto_produk\\/lain\\/asc2G6eW9CS03EGZ5ouqeqLwdrrSd7CVPR8k2kSR.jpg\",\"foto_produk\\/lain\\/JjnYgkiJtSGoHC9cMfGJOZR6DB41ivr5OsTacEzM.jpg\",\"foto_produk\\/lain\\/BAJFXK8qR2rOlHXPS4y7y9w3Ax9Gn3oULCvaPVfb.jpg\",\"foto_produk\\/lain\\/Bb2yWO3HJ4Zt5rQpHN34ugt2rliDud82MYuTuvHF.jpg\"]', '2025-06-10 07:03:27', '2025-06-10 07:03:27'),
(19, 11, 'Adidas Adizero Adios Pro 3 \" Core Black\" Metallic \"', 'Running', 550000, 'foto_produk/cover/yjeLhYLUtsn8eLHBhsk9RtvsvpRQN0W1ChT7RJqg.jpg', '[\"foto_produk\\/lain\\/KcWBwJMxBvOoca5pWq4MOTT6n7uZtJjBqxC995Gj.jpg\",\"foto_produk\\/lain\\/353mRRsI9Qph6F3jpyJjJBIQ5E9R4PWPwDLgLeuA.jpg\",\"foto_produk\\/lain\\/wKbFHSctHYp0uKmu0fwZHBBUty4aT7shu4UEEXlY.jpg\"]', '2025-06-10 07:09:07', '2025-06-10 07:09:07'),
(20, 11, 'Adidas PureBoost \" White Pink \"', 'Casual / Running', 475000, 'foto_produk/cover/TS6WlV42mB6WQc9luUEvGmMFkPMjTWA5fL4VGNVn.jpg', '[\"foto_produk\\/lain\\/Z68cHMYimDDpFOVBBPlK4ATxlkQBUhoKy3BlcFWM.jpg\",\"foto_produk\\/lain\\/IwDmGqliSnRERiqgOqSrKmdT1egsC9dspIcceChU.jpg\",\"foto_produk\\/lain\\/IdhoK0NIRRnUsuOhoeFb8gu0Yc0xjgoacBfD6sm4.jpg\"]', '2025-06-10 07:12:52', '2025-06-10 07:12:52'),
(21, 11, 'ADIDAS ADISTAR \" TRIPLE BLACK \"', 'Casual', 450000, 'foto_produk/cover/zwCanqtkMATD78nvMMQVgM8ZU7fbbG7zfq9E1QUu.jpg', '[\"foto_produk\\/lain\\/mNN5D1itQmwasOcxxKgewlJbgEiRwOGdggvutPxk.jpg\",\"foto_produk\\/lain\\/q7nC3zf5KhWg2f713c3TwVE7v1IrF6FwqsIrBwlH.jpg\",\"foto_produk\\/lain\\/4us9BM0unSndFkTH858jYwcdJihld6HFPADK3fTq.jpg\"]', '2025-06-10 07:18:39', '2025-06-10 07:18:39'),
(22, 12, 'New Balance 5740 \" Black White \"', 'Casual', 600000, 'foto_produk/cover/xfsrbow7FMqL0pHi9Erh42vjOF3m63epfiLb9Le2.jpg', '[\"foto_produk\\/lain\\/1Q3vXoEWjnSesOpxRQOxM0yPKKgP0zJILAf8XOuB.jpg\",\"foto_produk\\/lain\\/F1TiwqG41Ek7EUy3cebKTUPXpChXqtUy0XpkmYxF.jpg\",\"foto_produk\\/lain\\/jUhU34tzTveihtXiJp8eYiZbpWRSxo9WAwUzhKWi.jpg\",\"foto_produk\\/lain\\/zqtB8TDKpa1dKdTWrr8gtBvLFZzdF5ewPyhDSHjw.jpg\",\"foto_produk\\/lain\\/rueW4CWuFKVf0oDQ6u6CNjQfsvaeghOgn2B2tGnH.jpg\"]', '2025-06-10 07:23:53', '2025-06-10 07:23:53'),
(23, 12, 'New Balance 327 \" Beige Navy \"', 'Casual', 450000, 'foto_produk/cover/jtV7uQGphOY0JadH3PWbyXDMMHTqxT4XCxhHAspN.jpg', '[\"foto_produk\\/lain\\/qAebSQBTrog2UhIhQQKxL9aPrhTrBKtigj6aExZb.jpg\",\"foto_produk\\/lain\\/9eRdlLXLh55Jre8ReXctkTqQUZWpl01twmIlmFBN.jpg\",\"foto_produk\\/lain\\/3VGKoOFESE6uc0b3DH3dQA5pCYOsLGfge1gK2B0A.jpg\",\"foto_produk\\/lain\\/X96glNdbStawdzzHK4oNVGPOkBaLbrTNfenocxbK.jpg\"]', '2025-06-10 07:27:19', '2025-06-10 07:27:19'),
(24, 12, 'New Balance Retro 530 \" White Steel \"', 'Casual, Running', 475000, 'foto_produk/cover/3g8WR31YTyJyzu1eDnTkruRKIdcxHEF0Gunis2E5.jpg', '[\"foto_produk\\/lain\\/ESezzEZdFPCp7hBFH4p1AqwsgGoz7csyXbyDD0Yy.jpg\",\"foto_produk\\/lain\\/jKKZdh2MsJkLqaNw5nGSC7D4hLfmGR8HH9WpuKB5.jpg\",\"foto_produk\\/lain\\/d9KO6cmbY97PTLz0xQB8JfVlNOJ8JaZk29Yw07Dh.jpg\",\"foto_produk\\/lain\\/o6HQm3A3sw8HpFT72JL2f7dIxLcbDDxJg3MH3I0h.jpg\"]', '2025-06-10 07:32:52', '2025-06-10 07:32:52'),
(25, 12, 'New Balance 2002R \" Protection Pack Blue \"', 'Casual', 550000, 'foto_produk/cover/gTtHbtqy7ysstFC5ueZdrD1RDd1L0y3LThre82KO.jpg', '[\"foto_produk\\/lain\\/MmwAKBhyfeRelqznhBR7ORwi2i6E8DZfOhFnnuKn.jpg\",\"foto_produk\\/lain\\/km9qqSK2x5bQlFj7EzxHOO14XWhmbtv2os1zDqjD.jpg\",\"foto_produk\\/lain\\/YXfpOd9knw4IAflRB1Cl5dUQO5BMNeFt3DHXpI4h.jpg\"]', '2025-06-10 07:39:40', '2025-06-10 07:39:40'),
(26, 13, 'Puma RS Fast Limiter \" Colorfull \"', 'Casual', 525000, 'foto_produk/cover/8Er7Hc3PchY5FvDoKWpcZMBRpXqJa7gHfiLUTdEc.jpg', '[\"foto_produk\\/lain\\/eCjronUKcdvJE7bvCaLLdiG5IavAyiAveygjfok8.jpg\",\"foto_produk\\/lain\\/l3tzhEMJNGCJadoYHMdwlcVBYLgvkIcucL6CbNKk.jpg\"]', '2025-06-10 08:36:01', '2025-06-10 08:36:01'),
(27, 6, 'Puma MagMax NITRO', 'Running Shoes', 560000, 'foto_produk/cover/sgbqeO9zmVDIusxx0Hg3qfvHzdulIZnEFeKOGvwa.jpg', '[\"foto_produk\\/lain\\/3QYGCbrKxis7AbZjLHa4D0fB3N4V3yFwQ2nwp046.jpg\",\"foto_produk\\/lain\\/RFekgZUzLBpUYerbDUICa5kuCqtJiDF5nfTI8Rxb.jpg\",\"foto_produk\\/lain\\/BJ25WnOcGMsTTtMAuBJPbTCYndMZk2eHVeJPPs3c.jpg\",\"foto_produk\\/lain\\/itbp3JSNnPDFWUZ0ByCidpgt5uu72573VNmOzLnJ.jpg\"]', '2025-06-10 08:38:30', '2025-06-10 08:46:14'),
(28, 13, 'Puma RS- X Games', 'Sneakers', 485000, 'foto_produk/cover/Lsr8pWboEBgXdrvDfYiB9FflqLx5tzbKeqEqdJ8B.jpg', '[\"foto_produk\\/lain\\/EO1IF6LiXH9Uh6IX4i0USioWXnaWInKxx8THt2UJ.jpg\",\"foto_produk\\/lain\\/9pL87A9BkJ2rO42LBckEkTfQwW6lBQobLsfP8n6S.jpg\",\"foto_produk\\/lain\\/TOnix33ZLleolOZR9EXK4TsaBRlbkaA1MNSPjYFI.jpg\"]', '2025-06-10 08:41:51', '2025-06-10 08:41:51'),
(29, 13, 'Puma Wild Rider \" Black Red \"', 'Casual, Running', 550000, 'foto_produk/cover/9VoSOK1nTPzBnNzqwxRc5DL8f1w8sPBLpzB8sYNb.jpg', '[\"foto_produk\\/lain\\/TEbwlnV3P04XG65WhWIxf6TaRLn3BzhGOw8TZkd0.jpg\",\"foto_produk\\/lain\\/83NTJIr7oQqQ13PMTDQGBg5POfllofmrCSIbDO9p.jpg\",\"foto_produk\\/lain\\/334jNHRvvaw28iXW3l8ewb7UZcKqVBYAip9iHMuL.jpg\",\"foto_produk\\/lain\\/UYTnyJaGhOn4cKD8bEktj9BSYX28sSbwFlBvhtiF.jpg\"]', '2025-06-10 08:45:30', '2025-06-10 08:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('A0JkX2B5iZ4JQWSrGe0iy7jVs7uwXDAE9l3ZEAHY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMEJHbEVrb1lSMlJXN1RPT1ZnY1FtaGlqQU9ZSGczU3JPUHd2OXhmQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763214614),
('aKEUqYSYqAx8iZ55lIvaLybn8xX3gR6XU3neKLDu', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZDRQQWpodTFoc3NoMmlsUjdsMDQ3TVl1MDBYNENTNnNnQWhRUUFwTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9oaXN0b3J5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ4ODY5NzUwO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1748869793),
('eFPFxryEVe9xO4RmbFCXEbb6odWhmwzvAcrh58P6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXU1T29DRE1FVzFpV1hveUdyUThmNkMzdEphczh6RHlLb2lFQ1RRUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749632432),
('fQPIBlwjapGb47D9t1ahVdaDto9Ub60H2NCDReeV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicnNGYkhZZ2hTWkMwSjJIMFFpY3hzYXV5Y3VWdWdoanlUWDBqblN4ZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ob21lcGFnZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc2MjU1Nzk4Mjt9fQ==', 1762558172),
('IlTsOhqfGadKGOOXjud3Bt6Mf6OaNGgiSbPC6w2t', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNWs5MW1JU3hXUFZmOUtmTHhCMG9yeEtEWEp4ODJRczN1YVRRRWZ4MiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9rYXRlZ29yaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ5MTA5MzgxO319', 1749109508),
('mxfSQUfwie1lI0iRUozhCwQlrcNbsDLLZOwgcGBW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFRuTm9LMXVZa1VrUEx1alVFWE5EREhaclVjRmNhN0FGQXNVeXh5ayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763214668),
('ne7uxh73SoeZOJssYhw4QdtZ98yweVCvw1RWmE1O', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUzA1WEVtblNJUVo5NGtXNjRkVnpiRXVSa2FSUENPTTVXZ1RuYVF6ciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzUxNTMyNTI0O319', 1751532612),
('o66ph0th5xEnJPHI3dyCO3NCOmb6UFrLcz0VnKtE', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU1BqQVZFZ2ZRYUw1ZzQxck1pM0JyQkZ5UDREWk5pS21mdDd2aWg3SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2Frc2kiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NTE2MjcxMTQ7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1751627211),
('qIl0MPduUFvqA8npKHSXIzC5VzAVjEIz4CCaBO44', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzdsMEpPV1V3N2NKYUlYcVBXUEw3VDlXR2VBZjF5d25HSjJ4R3lRSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1749546903),
('qJzolYmuZaCgz5CVPVL7uXsXRyRQPT8VXoumkSBC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3EyaEkzdWx3UzZPcFBhNjRsU3poQ2VYTjE4ZW95U1AyRXNnUGJGUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1751626909),
('QPuAfzibSyO0S8JeDqQgA4iYCHlNSQKUWMPgmo3V', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib05ZUURZTkxtd29iREwweDNhTUx4NEZ1TlVTNGVIaXlsUkp6NjlJOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc1MTAzNjE3Mzt9fQ==', 1751036793),
('RL9euQ3NXdubpfcz2UhbxqgYq1vwIa0sYrAhBDbo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ0FWV0pyWTRIODFXbkhReUxyZTV6WlNDYUlTSWtQSlpSZm9vT1BxbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1763221991),
('SrVbAeCuyU6mUipYt9uJTpeXHaW9NLq2Qb2JuK2b', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTmFzT1I1dWVUbHQ1N3BJOUVKd24weFJza2lxa3hLelpacFlXUG1rOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzUzNjI1MjIyO319', 1753625246),
('SU4o8HPp2AMSZFyovOegmn0Nx1KHL5h7UCTzjTnX', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS0x4aDNQVzZVb0NVS1U3RUUxUTJ2M2MzUTBPS285bk05YjZNYlNaUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ob21lcGFnZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1762558184),
('t48xvdunn6TdjumS4MgHiSylu6q0LW78NZuLWjrQ', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieVhLVkZWTlNBcGEwYzhRWUVaSlRvTnFRVldaOFdlODdmRncwWVptViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzU2MTMyMjk1O319', 1756132874),
('uoDxloMSuLJXffpgdM8R9jHPBQr3GT0vXmV4mLM9', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibThiM3VidGw1eDhtZG1jUjFjbWxnSkt5emdyZThhMGdWVUpPR3JqcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jaGVja291dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc0OTU3MTk0OTt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1749571979);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '2025-06-02', 'Success', '2025-06-02 05:44:19', '2025-06-02 05:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi` int(10) UNSIGNED NOT NULL,
  `id_produk` int(10) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `no_telepon`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(2, 'admin', '98903459023', 'admin@gmail.com', NULL, '$2y$12$kzp6PKOXq7mpLoL0bYySsuoPFGquyl6DoGMQ0y1aHKZh4u529tjva', NULL, 'admin', '2025-06-01 18:07:12', '2025-06-01 18:07:12'),
(3, 'Customer', '092312312', 'customer@gmail.com', NULL, '$2y$12$BFPRBRICIck954DBQ4Inl.5M0QpWqIjGc.hRvR7i17rswmA9KOd1K', NULL, 'customer', '2025-06-01 22:58:51', '2025-06-01 22:58:51'),
(4, 'Haziq', '081234567890', 'haziq@gmail.com', NULL, '$2y$12$vYQ0qIldR9tdWdpYJ/BbTeuRkOBag/2.BvOCCBemyDwBYswh0a83m', NULL, 'customer', '2025-06-10 04:21:51', '2025-06-10 04:21:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_produk`,`id_user`),
  ADD KEY `cart_id_user_foreign` (`id_user`),
  ADD KEY `id_produk` (`id_produk`);

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
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `produk_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_id_user_foreign` (`id_user`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi`,`id_produk`),
  ADD KEY `transaksi_detail_id_produk_foreign` (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_id_produk_foreign` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_id_transaksi_foreign` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
