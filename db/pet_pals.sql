-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Mar 2025 pada 16.04
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_pals_revisi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL,
  `nama_admin` varchar(50) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Admin Pet Pals Shop', 'petpalsshop', '$2a$12$OLHcfkmIblk9SZrlu9r0A.k.kpGB8wG7c4YCB5s2QFIJrhfDK93mS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan Hewan'),
(2, 'Litter dan Toilet'),
(3, 'Produk Kesehatan Hewan'),
(4, 'Aksesoris Hewan'),
(5, 'Perlengkapan Hewan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(3) NOT NULL,
  `id_kategori` int(3) DEFAULT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `stok` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga`, `foto`, `detail`, `stok`) VALUES
(1, 5, 'Baby Wipes Tissue', 23500, 'Baby Wipes Tissue.jpeg', 'Tisu basah yang cocok digunakan untuk bayi', 50),
(2, 1, 'Bio Creamy Chicken dan Tuna', 16500, 'Bio Creamy Chicken & Tuna.jpeg', 'Snack Hewan Bio Creamy Chicken & Tuna 4 x 15gr', 50),
(3, 1, 'Bio Creamy Tuna', 16500, 'Bio Creamy Tuna 15gr.jpeg', 'Snack Hewan Bio Creamy Tuna 4 x 15gr', 50),
(4, 1, 'Bolt Dog Beef Flavor 1kg', 17100, 'Bolt Dog Beef Flavor 1kg.jpeg', 'Makanan Hewan Bolt Dog Beef Flavor 1kg', 50),
(5, 1, 'Cat Choize Kitten Tuna 1kg', 28700, 'Cat Choize Kitten Tuna 1kg.jpeg', 'Makanan Hewan Cat Choize Kitten Tuna 1kg', 50),
(6, 1, 'Cat Choize Salmon 1kg', 28700, 'Cat Choize Salmon 1kg.jpeg', 'Makanan Hewan Cat Choize Salmon 1kg', 50),
(7, 3, 'Diatomix Scabies Spray', 26400, 'Diatomix Scabies Spray.jpeg', 'Obat Scabies Pada Hewan 10ml', 50),
(8, 3, 'Diatomix Salep Schabies', 26400, 'Diotamix Salep Schabies.jpeg', 'Obat Salep Hewan untuk Penyakit Scabies 30gr', 50),
(9, 1, 'Dog Choize Adult Beef 1kg', 17200, 'Dog Choize Adult Beef.jpeg', 'Makanan Anjing Dog Choize Adult Beef 1kg', 50),
(10, 1, 'Dog Choize Lamb 800gr', 17200, 'Dog Choize Lamb 800gr.jpeg', 'Makanan Anjing Dog Choize Lamb 800gr', 50),
(11, 1, 'Excel Chicken dan Tuna Flavor Mother and Baby', 14800, 'Excel Chicken & Tuna Flavor Mother and Baby.jpeg', 'Makanan Hewan Excel Chicken & Tuna Flavor Mother and Baby 500gr', 50),
(12, 1, 'Excel Tuna Adult Flavour 500gr', 13500, 'Excel Tuna Adult Flavor.jpeg', 'Makanan Hewan Excel Tuna Adult Flavour 500gr', 50),
(13, 3, 'Fish Oil', 12000, 'Fish Oil Minyak Ikan.jpeg', 'Suplemen Penambah Nafsu Makan', 50),
(14, 1, 'Fish Snack Sugar Glider 20gr', 19000, 'Fish Snack.jpeg', 'Snack Hewan Sugar Glider 20gr', 50),
(15, 2, 'Gemoy Bentonite Cat Litter 5L', 25800, 'Gemoy Cat Litter 5L.jpeg', 'Cat Litter Gemoy isi 5L', 50),
(16, 5, 'Gunting Kuku Kucing Luve', 92000, 'Gunting Kuku Kucing Luve.jpeg', 'Gunting Kuku Kucing Luve', 50),
(17, 5, 'Gunting Kuku Kucing Sweet', 18000, 'Gunting Kuku Kucing Sweet.jpeg', 'Gunting Kuku Kucing Sweet', 50),
(18, 5, 'Izzy Pet Bubble Gum', 18500, 'Izzy Pet Parfum Bubble Gum.jpeg', 'Izzy Pet Bubble Gum', 50),
(19, 1, 'Jellyfruits Sugar Glider 50gr', 18500, 'Jellyfruits Sugar Glider.jpeg', 'Jellyfruits Sugar Glider 50gr', 50),
(20, 1, 'Kitchen Flavor Adult Cat 1.5kg', 130000, 'Kichen Flavor Adult Cat 1,5kg.jpeg', 'Kitchen Flavor Adult Cat 1,5kg', 50),
(21, 1, 'Kitchen Flavor Kitten 1.5kg', 136800, 'Kichen Flavor Kitten.jpeg', 'Kitchen Flavor Kitten 1,5kg', 50),
(22, 1, 'Life Cat Adult Tuna 400gr', 16200, 'Life Cat Adult Tuna.jpeg', 'Life Cat Adult Tuna 400gr', 50),
(23, 1, 'Life Cat Chicken dan Salmon 400gr', 16200, 'Life Cat Chicken and Salmon.jpeg', 'Life Cat Chicken & Salmon 400gr', 50),
(24, 1, 'Life Cat Kitten Salmon 400gr', 16200, 'Life Cat Kitten Salmon.jpeg', 'Life Cat Kitten Salmon 400gr', 50),
(25, 3, 'Maggot Kering', 15000, 'Maggot Kering.jpeg', 'Maggot Kering', 50),
(26, 4, 'Mainan Bola Basket', 13000, 'Mainan Bola Basket untuk Anabul.jpeg', 'Mainan Bola Basket', 50),
(27, 4, 'Mainan Bola Sepak', 13000, 'Mainan Bola Kucing.jpeg', 'Mainan Bola Sepak', 50),
(28, 2, 'Markotops Apple Pasir 5.5L', 32000, 'Markotop Apple Pasir 5,5L.jpeg', 'Markotops Apple Pasir 5,5L', 50),
(29, 1, 'Markotops Kitten dan Tuna 85gr', 6350, 'Markotop Kitten & Tuna 85gr.jpeg', 'Markotops Kitten & Tuna 85gr', 50),
(30, 2, 'Markotops Sakura Rose Pasir 5.5L', 32000, 'Markotop Sakura Rose Pasir 5,5L.jpeg', 'Markotops Sakura Rose Pasir 5,5L', 50),
(31, 1, 'Markotops Tuna dan Beef 85gr', 6350, 'Markotop Tuna & Beef 85gr.jpeg', 'Markotops Tuna & Beef 85gr', 50),
(32, 1, 'Me-O Cat Food Seafood 1.2kg', 57800, 'Me-O Cat Food Seafood.jpeg', 'Me-O Cat Food Seafood 1,2kg', 50),
(33, 1, 'Me-O Chicken Vegetable 1.2kg', 57800, 'Me-O Chicken Vegetable.jpeg', 'Me-O Chicken Vegetable 1,2kg', 50),
(34, 1, 'Me-O Mackarel 1.2kg', 57800, 'Me-O Mackarel 1,2kg.jpeg', 'Me-O Mackarel 1,2kg', 50),
(35, 1, 'Me-O Persian Anti Hairball 1.2kg', 67500, 'Me-O Persian Anti Hairball.jpeg', 'Me-O Persian Anti Hairball 1,2kg', 50),
(36, 1, 'Me-O Salmon 1.2kg', 57800, 'Me-O Salmon 1,2kg.jpeg', 'Me-O Salmon 1,2kg', 50),
(37, 3, 'Nutriplus Gel Vitamin', 165000, 'Nutriplus Gel Vitamin.jpeg', '                        Nutriplus Gel Vitamin 120,5gr                    ', 100),
(38, 1, 'OXP Milk Sugar Glider 50gr', 24500, 'Nutrisari Milk Pouch.jpeg', 'OXP Milk Sugar Glider 50gr', 50),
(39, 1, 'ORI Cat Kibble Ikan 800gr', 21000, 'Ori Cat Kibble Ikan.jpeg', 'ORI Cat Kibble Ikan 800gr', 50),
(40, 1, 'ORI Cat Kitten 800gr', 24000, 'Ori Cat Kitten.jpeg', 'ORI Cat Kitten 800gr', 50),
(41, 2, 'Pasir Arthacat Natural 7L', 78000, 'Pasir Arthacat 7L.jpeg', 'Pasir Arthacat Natural 7L', 50),
(42, 2, 'Pasir Arthacat Coffee 7L', 78000, 'Pasir Arthacat Coffe 7L.jpeg', 'Pasir Arthacat Natural 7L', 50),
(43, 2, 'Pasir Tofu Soya Rose 7L', 62400, 'Pasir Tofu Animal (Merah).jpeg', 'Pasir Tofu Soya Rose 7L', 50),
(44, 2, 'Pasir Tofu Soya Baby Powder 7L', 62400, 'Pasir Tofu Animal.jpeg', 'Pasir Tofu Soya Baby Powder 7L', 50),
(45, 1, 'Pedigree Beef 400gr', 27500, 'Pedigree Beef 400gr.jpeg', 'Pedigree Beef 400gr', 50),
(46, 1, 'Pedigree Meat Jerky Beef 80gr', 29500, 'Pedigree Meat Jerky Beef.jpeg', 'Pedigree Meat Jerky Beef 80gr', 50),
(47, 1, 'Pedigree Meat Jerky Stik 80gr', 29500, 'Pedigree Meat Jerky Griled Liver.jpeg', 'Pedigree Meat Jerky Stik 80gr', 50),
(48, 1, 'Pedigree Pupy 400gr', 30000, 'Pedigree Pupy 400gr.jpeg', 'Pedigree Pupy 400gr', 50),
(49, 3, 'Pet Ear Wipes 130pcs', 16800, 'Pet Ear Wipes (Orange).jpeg', 'Pet Ear Wipes 130pcs', 50),
(50, 3, 'Pet Eye Wipes 200pcs', 20200, 'Pet Eye Wipes (Kuning) 200pcs.jpeg', 'Pet Eye Wipes 200pcs', 50),
(51, 3, 'Pet Ear Wipes 200pcs', 20200, 'Pet Eye Wipes (Ungu) 200pcs.jpeg', 'Pet Ear Wipes 200pcs', 50),
(52, 5, 'Rubeimian Wipes', 16500, 'Pet Wipes Runbeiman Tisu.jpeg', 'Rubeimian Wipes', 50),
(53, 5, 'Pet Care Wipes', 21500, 'Pet Wipes Tissue.jpeg', 'Pet Care Wipes', 50),
(54, 3, 'ProPaws Anti Cacing dan Parasit', 18000, 'Pro Paws Anti Cacing & Parasit.jpeg', 'ProPaws Anti Cacing & Parasit', 50),
(55, 3, 'ProPaws Anti Diare', 18000, 'Pro Paws Anti Diare 30ml.jpeg', 'ProPaws Anti Diare', 50),
(56, 3, 'ProPaws Anti Flu dan Batuk', 18000, 'Pro Paws Anti Flu & Batuk.jpeg', 'ProPaws Anti Flu & Batuk', 50),
(57, 3, 'ProPaws Anti Fluid Urinary', 18000, 'Pro Paws Anti Fluid Urinary.jpeg', 'ProPaws Anti Fluid Urinary', 50),
(58, 3, 'ProPaws Anti Kutu 500ml', 66000, 'Pro Paws Anti Kutu 500ml.jpeg', 'Pro Paws Anti Kutu 500ml', 50),
(59, 3, 'ProPaws Anti Scabies', 18000, 'Pro Paws Anti Scabies 100ml.jpeg', 'ProPaws Anti Scabies', 50),
(60, 3, 'ProPaws Pembersih Telinga', 18000, 'Pro Paws Pembersih Telinga.jpeg', 'ProPaws Pembersih Telinga', 50),
(61, 3, 'ProPaws Pet Odor Remover Spray', 28500, 'Pro Paws Pet Odor Remover Spray.jpeg', 'ProPaws Pet Odor Remover Spray', 50),
(62, 3, 'ProPaws Tetes Mata', 18000, 'Pro Paws Tetes Mata 10ml.jpeg', 'ProPaws Pet Odor Remover Spray 10ml', 50),
(63, 5, 'ProPaws Shampoo dan Conditioner', 24500, 'Propaws Shampoo & Conditioner.jpeg', 'ProPaws Shampoo & Conditioner', 50),
(64, 5, 'Roll Bulu', 12000, 'Roll Bulu Anabul.jpeg', 'Roll Bulu Anabul', 50),
(65, 5, 'Shampoo Sugar Glider', 13500, 'Sampoo Sugar Glaider 100ml.jpeg', 'Shampoo Sugar Glider', 50),
(66, 1, 'Santap Cat Food 1kg', 22500, 'Santap Cat Food 1kg.jpeg', 'Santap Cat Food 1kg', 50),
(67, 1, 'Super Cat Tuna Beef 400gr', 17500, 'Supercat 400gr Beef Liver.jpeg', 'Super Cat Tuna Beef 400gr', 50),
(68, 2, 'Tofu Soya Lavender', 71200, 'Tofu Markotop.jpeg', 'Tofu Soya Lavender', 50),
(69, 1, 'Ulat Hongkong', 25000, 'Ulat Hongkong.jpeg', 'Ulat Hongkong', 50),
(70, 3, 'Vita Plus', 26400, 'Vita Plus 30ml.jpeg', 'Vita Plus 30ml', 50),
(71, 1, 'Whiskas Ikan Kembung', 7900, 'Whiskas Ikan Kembung.jpeg', 'Whiskas Ikan Kembung', 50),
(72, 1, 'Whiskas Junior Mackarel', 7900, 'Whiskas Junior Mackarel.jpeg', 'Whiskas Junior Mackarel', 50),
(73, 1, 'Whiskas Junior Mackarel 450gr', 37200, 'Whiskas Junior.jpeg', 'Whiskas Junior Mackarel 450gr', 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(3) NOT NULL,
  `id_user` int(3) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `alamat` varchar(75) DEFAULT NULL,
  `telepon` char(13) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `bukti` varchar(50) DEFAULT NULL,
  `status` enum('Menunggu Konfirmasi','Diproses','Selesai','Dibatalkan') DEFAULT 'Menunggu Konfirmasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `tgl_transaksi`, `nama_user`, `alamat`, `telepon`, `total`, `bukti`, `status`) VALUES
(1, 1, '2024-10-02 09:17:21', 'Hilman Arif Rahman', 'Jalan Sinai IV/66', '081210394632', 48700, 'paw.jpeg', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_detail` int(3) NOT NULL,
  `id_transaksi` int(3) DEFAULT NULL,
  `id_produk` int(3) DEFAULT NULL,
  `jumlah` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_detail`, `id_transaksi`, `id_produk`, `jumlah`) VALUES
(1, 1, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(3) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `alamat` varchar(75) DEFAULT NULL,
  `telepon` char(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `alamat`, `telepon`) VALUES
(1, 'Hilman Arif Rahman', 'hilmanar', '$2y$10$1n4w.R4vflQDy2whM9Y5sO2KNXaM1W23f2uxEujqWafXyD2x9YjEm', 'Jalan Sinai IV/66', '081210394632');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `nama_produk` (`nama_produk`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_detail` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
