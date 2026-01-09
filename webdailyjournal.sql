-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 11:31 AM
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
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `isi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `gambar` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Hitori Gotou', 'Gotou atau biasa dipanggil Bocchi adalah gadis yang sangat pemalu dan canggung saat berinteraksi dengan orang lain. Meskipun begitu, ia memiliki bakat luar biasa dalam bermain gitar, hasil dari latihan bertahun-tahun di kamarnya. Ia bercita-cita menjadi populer lewat musik agar bisa berteman. Setelah bergabung dengan Kessoku Band, Bocchi mulai belajar menghadapi dunia luar dan menemukan arti kerja sama serta persahabatan.', 'bocchi.jpg', '2025-12-01 18:10:15', 'Rofa'),
(2, 'Nijika Ijichi', 'Nijika adalah drummer berkepribadian ceria dan penuh semangat. Ia selalu optimis dan menjadi sumber motivasi bagi anggota band lainnya. Sebagai pendiri Kessoku Band, Nijika punya impian besar untuk membuat band-nya dikenal luas dan tampil di berbagai panggung. Ia juga sosok yang perhatian dan berusaha memahami kekurangan masing-masing anggota agar mereka tetap kompak.', 'nijika.jpg', '2025-12-10 22:07:23', 'rayan'),
(3, 'Ryo Yamada', 'Ryo adalah pemain bass yang berkarakter tenang, dingin, dan kadang sulit ditebak. Di balik sikap santainya, Ryo sebenarnya sangat serius soal musik dan memiliki selera yang unik. Ia sering memberikan pandangan tajam tentang permainan band, sehingga menjadi semacam mentor bagi Bocchi. Meski terlihat acuh, Ryo peduli pada teman-temannya dengan caranya sendiri.', 'ryo.jpg', '2025-12-10 22:08:47', 'roff'),
(4, 'Ikuyo Kita', 'Kita adalah vokalis yang ceria, ramah, dan sangat bersemangat. Ia punya kepribadian yang kontras dengan Bocchi, membuat suasana band jadi lebih hidup. Awalnya ia sempat meninggalkan Kessoku Band karena gugup dan kurang percaya diri, tapi setelah kembali, ia menunjukkan tekad kuat untuk berkembang bersama teman-temannya. Energi positif Kita sering menjadi penyemangat di setiap latihan dan pertunjukan.', 'ikuyoo.jpg', '2025-12-10 22:08:47', 'rof'),
(5, 'Heisenberg', 'My name is walter white yo\r\n', '20251211094124.png', '2025-12-11 09:44:51', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
