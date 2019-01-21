-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 21 Jan 2019 pada 12.01
-- Versi server: 5.6.38
-- Versi PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinjaman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(60) NOT NULL,
  `email_admin` varchar(60) NOT NULL,
  `password_admin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email_admin`, `password_admin`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailpinjaman`
--

CREATE TABLE `detailpinjaman` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `tujuanpinjaman` text NOT NULL,
  `jumlahpendapatan` text NOT NULL,
  `jaminan` text NOT NULL,
  `filejaminan` text NOT NULL,
  `filelaporankeuangantahun` text NOT NULL,
  `filerekkoran3` text NOT NULL,
  `fileusaha` text NOT NULL,
  `filedokumenperjanjian` text NOT NULL,
  `status` int(11) NOT NULL,
  `alasanditolak` text NOT NULL,
  `danaterkumpul` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `detailpinjaman`
--

INSERT INTO `detailpinjaman` (`id`, `id_pinjaman`, `tujuanpinjaman`, `jumlahpendapatan`, `jaminan`, `filejaminan`, `filelaporankeuangantahun`, `filerekkoran3`, `fileusaha`, `filedokumenperjanjian`, `status`, `alasanditolak`, `danaterkumpul`) VALUES
(9, 5, 'untuk membeli tablet', '5000000', '', '', '', 'Budi_koran_200120191803.png', '', 'Budi_dokumenperjanjian_200120191803.pdf', 0, '', '0'),
(10, 6, 'untuk pembelian 2 unit genset', '50000000', 'Surat Tanah', 'andi waseso_jaminan_200120194231.', 'andi waseso_tahun_200120194231.jpg', 'andi waseso_koran_200120194231.jog', 'andi waseso_usaha_200120194231.jpg', 'andi waseso_dokumenperjanjian_200120194231.pdf', 0, '', '0'),
(13, 7, 'dsadsada', 'dasdsadad', '', '', '', 'akun 3_koran_210120195510.png', '', 'akun 3_dokumenperjanjian_210120195510.pdf', 0, '', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailusaha`
--

CREATE TABLE `detailusaha` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `namausaha` varchar(255) NOT NULL,
  `jenisusaha` varchar(255) NOT NULL,
  `tahunpendirian` varchar(4) NOT NULL,
  `kategoriusaha` varchar(255) NOT NULL,
  `alamatusaha` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kodepos` varchar(255) NOT NULL,
  `telpon1` varchar(15) NOT NULL,
  `telpon2` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL,
  `fotousaha` text NOT NULL,
  `modalusaha` text NOT NULL,
  `utangusaha` text NOT NULL,
  `status` int(11) NOT NULL,
  `alasanditolak` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `detailusaha`
--

INSERT INTO `detailusaha` (`id`, `id_pinjaman`, `namausaha`, `jenisusaha`, `tahunpendirian`, `kategoriusaha`, `alamatusaha`, `provinsi`, `kabupaten`, `kodepos`, `telpon1`, `telpon2`, `deskripsi`, `fotousaha`, `modalusaha`, `utangusaha`, `status`, `alasanditolak`) VALUES
(1, 6, 'CV berkat jaya', 'cv', '2015', 'teknologi', 'jl madura', 'sumatera-utara', 'medan', '20128', '999', '888', 'usaha yang bergerak di bidang penjualan komputer', 'andi waseso_fotousaha_200120194334.jpg', '100000000', '50000000', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `jenis` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `dokumen`
--

INSERT INTO `dokumen` (`id`, `id_member`, `nama`, `jenis`, `created_at`) VALUES
(5, 1, 'Budi_dokumenperjanjian_Beli Tablet_200120190545.pdf', 'Dokumen perjanjian pinjaman dengan kode = P1', '2019-01-20 07:05:45'),
(6, 2, 'andi waseso_dokumenperjanjian_Beli Genset_200120193854.pdf', 'Dokumen perjanjian pinjaman dengan kode = P2', '2019-01-20 08:38:54'),
(7, 6, 'akun 3_dokumenperjanjian_beli beli_210120195353.pdf', 'Dokumen perjanjian pinjaman dengan kode = P3', '2019-01-21 10:53:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `email_member` varchar(60) NOT NULL,
  `password_member` varchar(60) NOT NULL,
  `nama_member` varchar(60) NOT NULL,
  `tgllahir` date NOT NULL,
  `fotoprofil` text NOT NULL,
  `noktp` int(20) NOT NULL,
  `fotoktp` text NOT NULL,
  `nonpwp` int(20) NOT NULL,
  `fotonpwp` text NOT NULL,
  `alamat` text NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kabupaten` varchar(255) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `handphone1` varchar(15) NOT NULL,
  `handphone2` varchar(15) NOT NULL,
  `saldo` varchar(30) NOT NULL,
  `norekening` varchar(20) NOT NULL,
  `namarekening` varchar(50) NOT NULL,
  `namabank` varchar(50) NOT NULL,
  `fotobukutabungan` text NOT NULL,
  `deskripsi` text NOT NULL,
  `statuspengguna` int(1) NOT NULL,
  `statusverifikasi` int(1) NOT NULL,
  `alasanditolak` text NOT NULL,
  `alasanbanned` text NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `email_member`, `password_member`, `nama_member`, `tgllahir`, `fotoprofil`, `noktp`, `fotoktp`, `nonpwp`, `fotonpwp`, `alamat`, `provinsi`, `kabupaten`, `kodepos`, `handphone1`, `handphone2`, `saldo`, `norekening`, `namarekening`, `namabank`, `fotobukutabungan`, `deskripsi`, `statuspengguna`, `statusverifikasi`, `alasanditolak`, `alasanbanned`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'member@gmail.com', 'budi', 'Budi', '2019-01-12', 'member_profile_200120193100.jpg', 3123131, 'Budi_ktp_200120193127.jpg', 0, '', 'jl binjai', 'sumatera-utara', 'medan', '2020', '9999', '8888', '300000', '9099', 'budi', 'mandiri', '', '', 1, 1, '', '', '', '2019-01-21 11:05:06', '0000-00-00 00:00:00'),
(2, 'andi@gmail.com', 'andi', 'andi waseso', '1994-01-03', 'andi waseso_profile_200120194655.jpg', 898982323, 'andi waseso_ktp_200120192510.jpg', 0, '', 'jl medan', 'sumatera-utara', 'medan', '20129', '0812', '0813', '400000', '989898989', 'andi waseso', 'mandiri', '_tabungan_200120195750.png', '', 1, 1, 'buku tabungan tidak jelas', '', '', '2019-01-20 15:57:54', '0000-00-00 00:00:00'),
(4, 'akun@gmail.com', 'akun', 'akun 2', '1997-01-02', 'akun 2_profile_210120195804.jpg', 23232, 'akun 2_ktp_210120195804.jpg', 0, '', 'sdadads', 'sumatera-utara', 'medan', '2132131', '2131', '32131', '0', '0930232', 'akun 2', 'mandiri', '_tabungan_210120195824.jpg', '', 1, 1, '', '', '', '2019-01-21 04:01:07', '0000-00-00 00:00:00'),
(5, 'akun2@gmail.com', 'akun', 'akun 2', '2019-01-11', 'akun 2_profile_210120191357.jpg', 2313231, 'akun 2_ktp_210120191357.jpg', 0, '', 'dasda', 'sumatera-utara', 'medan', '231313', '32131', '32131', '500000', '2131', 'akun2', 'mandiri', '', '', 1, 1, '', '', '', '2019-01-21 04:17:33', '0000-00-00 00:00:00'),
(6, 'akun3@gmail.com', 'akun', 'akun 3', '2019-01-04', 'akun 3_profile_210120195021.jpg', 0, 'akun 3_ktp_210120195021.jpg', 0, '', 'dasdadsa', 'sumatera-utara', 'medan', '3232', '231', '32131', '500000', '2113', 'akun3', 'mandiri', '', '', 1, 1, '', '', '', '2019-01-21 10:56:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `notification` text NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `is_read` int(1) NOT NULL,
  `tgl_dibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `notification`
--

INSERT INTO `notification` (`id`, `id_member`, `notification`, `id_dokumen`, `is_read`, `tgl_dibuat`) VALUES
(5, 1, 'Topup sebesar Rp.1000000 disetujui oleh admin', 0, 1, '2019-01-19 20:13:45'),
(6, 2, 'Verifikasi ditolak => buku tabungan tidak jelas .Segera update profile kembali', 0, 1, '2019-01-20 04:41:27'),
(7, 2, 'Profile anda telah diverifikasi member.Sekarang anda dapat mengajukan atau meminjam', 0, 1, '2019-01-20 04:58:35'),
(8, 2, 'Anda telah dibanned oleh admin =>karena diindikasi penipuan .Segera hubungi kami agar banned dibuka', 0, 1, '2019-01-20 05:14:59'),
(9, 2, 'Banned anda telah dibatalkan anda bisa menggunakan kembali', 0, 1, '2019-01-20 05:14:59'),
(10, 1, 'Profile anda telah diverifikasi member.Sekarang anda dapat mengajukan atau meminjam', 0, 1, '2019-01-20 05:32:24'),
(11, 1, 'Dokumen berkas perjanjian untuk pinjaman dengan kode P1', 5, 1, '2019-01-20 07:06:09'),
(12, 2, 'Dokumen berkas perjanjian untuk pinjaman dengan kode P2', 6, 1, '2019-01-20 08:39:00'),
(14, 1, 'Pengajuan Pinjaman anda telah diapprove oleh admin', 0, 1, '2019-01-20 16:15:15'),
(15, 2, 'Topup sebesar Rp.1000000 disetujui oleh admin', 0, 1, '2019-01-20 13:33:02'),
(16, 2, 'Pemindahan dana sebesar Rp.500000 disetujui oleh admin', 0, 1, '2019-01-20 14:28:28'),
(17, 2, 'Pencairan dana saldo sebesar Rp.100000 disetujui oleh admin', 0, 1, '2019-01-20 16:05:10'),
(21, 1, 'Pencairan dana saldo Pinjaman sebesar Rp.100000 disetujui oleh admin', 0, 1, '2019-01-20 16:16:46'),
(22, 1, 'Pencairan dana saldo  sebesar Rp.500000 disetujui oleh admin', 0, 1, '2019-01-21 03:39:57'),
(23, 1, 'Pencairan dana saldo  sebesar Rp.100000 disetujui oleh admin', 0, 1, '2019-01-21 03:39:57'),
(24, 4, 'Profile anda telah diverifikasi member.Sekarang anda dapat mengajukan atau meminjam', 0, 1, '2019-01-21 03:59:16'),
(25, 4, 'Topup sebesar Rp.500000 disetujui oleh admin', 0, 1, '2019-01-21 04:00:24'),
(26, 4, 'Pemindahan dana sebesar Rp.500000 disetujui oleh admin', 0, 1, '2019-01-21 04:01:12'),
(27, 5, 'Profile anda telah diverifikasi member.Sekarang anda dapat mengajukan atau meminjam', 0, 1, '2019-01-21 04:15:56'),
(28, 5, 'Topup sebesar Rp.1000000 disetujui oleh admin', 0, 1, '2019-01-21 04:16:37'),
(29, 5, 'Pemindahan dana sebesar Rp.500000 disetujui oleh admin', 0, 1, '2019-01-21 04:19:22'),
(30, 1, 'Pencairan dana saldo Pinjaman sebesar Rp.1400000 disetujui oleh admin', 0, 1, '2019-01-21 04:30:22'),
(31, 6, 'Profile anda telah diverifikasi member.Sekarang anda dapat mengajukan atau meminjam', 0, 1, '2019-01-21 10:51:06'),
(32, 6, 'Dokumen berkas perjanjian untuk pinjaman dengan kode P3', 7, 1, '2019-01-21 10:54:01'),
(33, 6, 'Pengajuan Pinjaman anda telah diapprove oleh admin', 0, 1, '2019-01-21 10:57:20'),
(34, 6, 'Topup sebesar Rp.1000000 disetujui oleh admin', 0, 1, '2019-01-21 10:57:20'),
(35, 6, 'Pencairan dana saldo  sebesar Rp.500000 disetujui oleh admin', 0, 1, '2019-01-21 10:57:20'),
(36, 1, 'Pemindahan dana sebesar Rp.100000 disetujui oleh admin', 0, 1, '2019-01-21 11:05:59'),
(37, 6, 'Pencairan dana saldo Pinjaman sebesar Rp.50000 disetujui oleh admin', 0, 1, '2019-01-21 11:08:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemindahandana`
--

CREATE TABLE `pemindahandana` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pemindahandana`
--

INSERT INTO `pemindahandana` (`id`, `id_member`, `id_pinjaman`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 500000, 1, '2019-01-20 13:36:07', '2019-01-20 13:55:04'),
(2, 4, 5, 500000, 1, '2019-01-21 04:00:59', '2019-01-21 04:01:07'),
(3, 5, 5, 500000, 1, '2019-01-21 04:17:25', '2019-01-21 04:17:33'),
(4, 1, 7, 100000, 1, '2019-01-21 11:04:50', '2019-01-21 11:05:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencairandana`
--

CREATE TABLE `pencairandana` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `jenis` int(1) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pencairandana`
--

INSERT INTO `pencairandana` (`id`, `id_member`, `jenis`, `jumlah`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, 0, 100000, 1, '2019-01-20 15:34:06', '0000-00-00 00:00:00'),
(5, 1, 1, 100000, 1, '2019-01-20 16:08:08', '0000-00-00 00:00:00'),
(6, 1, 0, 500000, 1, '2019-01-21 03:36:47', '0000-00-00 00:00:00'),
(7, 1, 0, 100000, 1, '2019-01-21 03:37:31', '0000-00-00 00:00:00'),
(8, 1, 1, 1400000, 1, '2019-01-21 04:29:02', '0000-00-00 00:00:00'),
(9, 6, 0, 500000, 1, '2019-01-21 10:56:46', '0000-00-00 00:00:00'),
(10, 6, 1, 50000, 1, '2019-01-21 11:07:20', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `nama_pinjaman` varchar(255) NOT NULL,
  `kode_pinjaman` varchar(255) NOT NULL,
  `kategori_pinjaman` int(1) NOT NULL,
  `jumlah_pinjaman` varchar(20) NOT NULL,
  `lama_pinjaman` int(2) NOT NULL,
  `bunga_efektif` int(2) NOT NULL,
  `cara_pembayaran` int(1) NOT NULL,
  `id_dokumen` int(11) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `fotonpwp` text NOT NULL,
  `status_pengajuan` int(1) NOT NULL,
  `status_pinjaman` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_at` date NOT NULL,
  `end_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_member`, `nama_pinjaman`, `kode_pinjaman`, `kategori_pinjaman`, `jumlah_pinjaman`, `lama_pinjaman`, `bunga_efektif`, `cara_pembayaran`, `id_dokumen`, `npwp`, `fotonpwp`, `status_pengajuan`, `status_pinjaman`, `created_at`, `updated_at`, `start_at`, `end_at`) VALUES
(5, 1, 'Beli Tablet', 'P1', 0, '1500000', 6, 12, 0, 5, '231231', 'Beli Tablet_npwp_200120190545.jpg', 1, 0, '2019-01-21 10:33:40', '2019-01-20 10:14:33', '0000-00-00', '0000-00-00'),
(6, 2, 'Beli Genset', 'P2', 1, '10000000', 12, 0, 1, 6, '3132313', 'Beli Genset_npwp_200120193854.jpg', 0, 0, '2019-01-20 14:13:10', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00'),
(7, 6, 'beli beli', 'P3', 0, '2000000', 6, 15, 0, 7, '2132131', 'beli beli_npwp_210120195353.jpg', 1, 0, '2019-01-21 10:55:42', '2019-01-21 10:55:42', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `isi` text NOT NULL,
  `rating` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`id`, `id_member`, `id_pinjaman`, `isi`, `rating`, `created_at`, `updated_at`) VALUES
(4, 6, 5, 'dasdada', 5, '2019-01-21 10:51:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `saldo` varchar(30) NOT NULL,
  `fotobukti` text NOT NULL,
  `status` int(1) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `id_member`, `saldo`, `fotobukti`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 1, '1000000', 'member_bukti_200120193409.jpg', 1, '', '2019-01-19 19:02:34', '2019-01-19 19:02:34'),
(3, 2, '1000000', 'andi waseso_bukti_200120193232.png', 1, '', '2019-01-20 13:32:06', '2019-01-20 13:32:06'),
(4, 4, '500000', '_bukti_210120190006.png', 1, '', '2019-01-21 03:59:27', '2019-01-21 03:59:27'),
(5, 5, '1000000', '_bukti_210120191623.png', 1, '', '2019-01-21 04:16:11', '2019-01-21 04:16:11'),
(6, 6, '1000000', 'akun 3_bukti_210120195614.jpg', 1, '', '2019-01-21 10:56:05', '2019-01-21 10:56:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `angsuranke` int(11) NOT NULL,
  `totaltagihan` varchar(50) NOT NULL,
  `tgltagihan` date NOT NULL,
  `note` text NOT NULL,
  `denda` varchar(50) NOT NULL DEFAULT '0',
  `fotobukti` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `detailpinjaman`
--
ALTER TABLE `detailpinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `detailusaha`
--
ALTER TABLE `detailusaha`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemindahandana`
--
ALTER TABLE `pemindahandana`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pencairandana`
--
ALTER TABLE `pencairandana`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detailpinjaman`
--
ALTER TABLE `detailpinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `detailusaha`
--
ALTER TABLE `detailusaha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `pemindahandana`
--
ALTER TABLE `pemindahandana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pencairandana`
--
ALTER TABLE `pencairandana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=324;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
