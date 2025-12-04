-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2025 pada 09.37
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motor-expert`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Honda'),
(2, 'Yamaha');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `diseases`
--

CREATE TABLE `diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motor_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `solution` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `diseases`
--

INSERT INTO `diseases` (`id`, `motor_type_id`, `name`, `description`, `solution`) VALUES
(5, 12, 'Aki Lemah / Soak', 'Kapasitas daya penyimpanan aki sudah menurun drastis karena usia pakai atau masalah pada sistem pengisian (Kiprok). Ini adalah masalah kelistrikan paling umum pada motor matic.', 'Periksa tegangan aki. Ganti aki baru dengan tipe yang sesuai. Jika aki cepat soak lagi, periksa sistem pengisian motor.'),
(6, 12, 'V-Belt Aus dan Retak', 'V-Belt sudah keras, retak, atau menipis karena melebihi batas usia pemakaian (normal 20.000 - 24.000 km). Menyebabkan power loss dan suara decitan saat belt licin.', 'Lakukan servis CVT, ganti V-Belt baru (rekomendasi pabrikan). Sekaligus periksa kondisi roller dan bersihkan area puli.'),
(7, 12, 'Injektor Tersumbat / Kotor', 'Lubang penyemprotan bahan bakar pada injektor tersumbat oleh kotoran, menyebabkan kabut bensin tidak sempurna. Ini sangat mempengaruhi performa mesin FI.', 'Lakukan pembersihan injektor secara profesional menggunakan alat ultrasonic cleaner. Cek dan kuras tangki bensin jika ada indikasi kotoran atau air.'),
(8, 12, 'Filter Udara Kotor / Sobek', 'Filter udara kotor menghambat asupan udara bersih ke ruang bakar, membuat campuran bensin terlalu kaya. Filter sobek menyebabkan kotoran besar merusak throttle body.', 'Ganti filter udara dengan yang baru (jangan dicuci, ganti unit). Pastikan kotak filter udara terpasang rapat dan tidak ada kebocoran di sambungan.'),
(9, 12, 'Ring Piston Aus / Stang Seher Longgar', 'Keausan pada Ring Piston menyebabkan oli masuk ke ruang bakar (asap putih). Bunyi klotok-klotok adalah indikasi bearing stang seher yang mulai longgar. Ini adalah kerusakan mekanis yang memerlukan perbaikan mesin.', 'Segera bawa motor ke bengkel spesialis untuk pemeriksaan kompresi dan pembongkaran mesin (turun mesin). Diperlukan penggantian ring piston dan pemeriksaan klep/seher.'),
(10, 13, 'Bearing Pulley Belakang Oblak', 'Terjadi keausan pada bearing (laher) di dalam puli belakang (driven face). Bearing yang oblak menyebabkan puli tidak stabil, menghasilkan getaran parah dan bunyi klotok pada kecepatan rendah.', 'Bongkar unit CVT, identifikasi bearing yang rusak (biasanya bearing bambu atau bearing biasa), dan ganti bearing tersebut. Periksa juga kondisi grease di dalam puli.'),
(11, 13, 'Sensor Oksigen (O2 Sensor) Rusak', 'Sensor O2 gagal membaca kadar oksigen di gas buang dan mengirimkan informasi yang salah ke ECU. Hal ini menyebabkan ECU menyemprotkan bahan bakar secara berlebihan (terlalu kaya), yang memicu pemborosan BBM.', 'Periksa tegangan output sensor O2 menggunakan multimeter atau alat diagnosa. Jika nilainya tidak stabil, ganti sensor O2. Lakukan reset ECU dan ECM learning.'),
(12, 13, 'Kabel Body Terkelupas / Korsleting', 'Kerusakan fisik pada instalasi kabel (terkelupas/digigit tikus) yang menyebabkan hubungan arus pendek (korsleting) intermiten. Ini sering memicu sekring putus dan memblokir daya ke ECU atau starter.', 'Identifikasi lokasi korsleting (seringkali di area setang atau bawah jok). Ganti kabel yang terkelupas atau putus. Jangan menaikkan nilai ampere sekring!'),
(13, 13, 'Shockbreaker Belakang Bocor', 'Seal oli pada suspensi belakang sudah rusak atau mengeras, menyebabkan oli peredam keluar. Suspensi kehilangan kemampuan peredamannya (damping), membuat motor tidak nyaman dan menimbulkan bunyi keras.', 'Ganti seal oli dan isi ulang oli shockbreaker atau, jika unit sudah tua, ganti shockbreaker belakang satu set. Jangan biarkan shock bocor terlalu lama karena dapat merusak komponen lain.'),
(14, 13, 'Koil Pengapian Panas (Overheating)', 'Koil pengapian mengalami overheating (terlalu panas) karena kualitas koil yang menurun atau masalah arus. Ketika koil terlalu panas, ia gagal menghasilkan percikan api, dan mesin mati. Setelah didinginkan, koil berfungsi kembali untuk sementara.', 'Periksa kondisi koil dan sambungan kabelnya. Lakukan penggantian koil pengapian. Cek juga kondisi busi dan cap busi (cop busi).'),
(15, 14, 'Kebocoran Ringan pada Sistem Pendingin', 'Terjadi kebocoran halus pada sambungan selang, water pump seal, atau tutup radiator. Hal ini menyebabkan sistem pendinginan kehilangan tekanan dan volume air, yang memicu overheat.', 'Periksa tutup radiator (seringkali karet seal sudah mengeras) dan ganti jika rusak. Cek semua sambungan selang dan water pump seal. Lakukan pengisian air radiator (coolant) yang benar.'),
(16, 14, 'Baterai Remote Keyless Lemah', 'Baterai kecil (seperti baterai jam) di dalam remote telah habis, sehingga remote gagal mengirimkan sinyal ke Smart Control Unit (SCU) di motor.', 'Segera ganti baterai remote (biasanya tipe CR2032) dengan yang baru dan berkualitas baik. Pastikan remote berfungsi kembali. Jika tetap tidak bisa, cek tegangan aki motor.'),
(17, 14, 'Bearing Roda Belakang / Kruk As Rusak', 'Bearing (laher) pada roda belakang atau bearing transmisi kruk as sudah aus atau kering. Kerusakan ini menghasilkan suara kasar yang meningkat seiring kecepatan. Ini adalah kerusakan mekanis yang serius.', 'Lakukan pemeriksaan bearing roda belakang dan bearing kruk as. Ganti bearing yang rusak. Pemeriksaan ini memerlukan alat khusus (tracker) dan pembongkaran transmisi.'),
(18, 14, 'Kampas Rem Aus dan Minyak Rem Kurang', 'Kampas rem sudah menipis hingga besi bertemu besi (suara kasar). Rem blong disebabkan oleh minyak rem yang berkurang atau ada angin yang masuk ke jalur hidrolik.', 'Periksa ketebalan kampas rem, ganti jika sudah tipis. Tambahkan minyak rem atau lakukan bleeding rem (membuang angin) jika terasa blong. Periksa juga kebocoran di kaliper rem.'),
(19, 14, 'Fuel Pump Lemah / Filter Bensin Kotor', 'Fuel pump (pompa bensin) yang lemah gagal memberikan tekanan yang cukup ke injektor, membuat start mesin sulit. Filter bensin yang kotor memperparah hambatan.', 'Ukur tekanan fuel pump (standar biasanya 29-40 PSI). Jika tekanan di bawah standar, ganti fuel pump satu set. Ganti filter bensin jika kotor.'),
(20, 8, 'Gigi Starter (Bendix Gear) Rusak/Macet', 'Terjadi keausan atau macet pada mekanisme Bendix Gear (gigi sentrifugal) di dinamo starter. Umumnya terjadi karena kotoran atau kurangnya pelumasan, membuat gigi gagal mendorong atau menarik (retract) saat starter selesai.', 'Bongkar unit starter dan periksa kondisi Bendix Gear. Bersihkan dan beri pelumas. Jika gigi starter sudah aus parah, ganti unit starter clutch (kopling starter) satu set.'),
(21, 8, 'Ring Piston Aus / Kebocoran Oli', 'Ring piston di dalam mesin sudah aus atau patah, menyebabkan oli mesin bocor ke ruang bakar dan ikut terbakar (asap putih). Ini adalah kerusakan mekanis internal.', 'Lakukan tes kompresi mesin. Jika kompresi rendah, harus dilakukan pembongkaran mesin (turun mesin) untuk mengganti set ring piston dan memeriksa kondisi seher (piston) serta dinding silinder.'),
(22, 8, 'Roller Peyang dan Rumah Roller Aus', 'Roller yang peyang menyebabkan V-Belt bergerak tidak stabil, memicu getaran dan bunyi kasar. Rumah roller (primary sliding sheave) yang aus memperparah kondisi ini.', 'Ganti roller satu set. Cek dan ganti roller guide (bosh puli) dan sliding sheave. Jika rumah roller sudah ada cekungan, sebaiknya ganti juga agar performa CVT optimal.'),
(23, 8, 'Kerusakan pada Sensor TPS (Throttle Position Sensor)', 'Sensor TPS gagal mendeteksi posisi bukaan gas dengan akurat, mengirimkan data yang salah ke ECU. ECU kemudian gagal menghitung rasio bahan bakar-udara yang tepat, menyebabkan tenaga hilang dan pemborosan BBM.', 'Lakukan pemeriksaan kode error (kedipan MIL 4-6x seringkali mengarah ke TPS). Lakukan kalibrasi TPS menggunakan diagnostic tool. Jika kalibrasi gagal, ganti unit sensor TPS.'),
(24, 8, 'Setting Celah Klep Tidak Tepat', 'Celah klep (valve clearance) terlalu rapat atau terlalu renggang. Setelan yang tidak tepat mengganggu proses kompresi dan pembakaran, yang sangat terasa saat mesin belum mencapai suhu ideal.', 'Lakukan penyetelan ulang celah klep sesuai standar pabrikan (teknik setting ulang). Jika celah cepat berubah lagi, periksa kondisi shim (penyangga klep) dan rocker arm (pelatuk klep).'),
(25, 9, 'Kelemahan atau Kerusakan Bearing CVT', 'Bearing (laher) di as puli primer atau sekunder mulai aus/kering. Keausan ini menciptakan celah yang menghasilkan bunyi dengung keras saat kecepatan tinggi dan getaran di area kaki.', 'Bongkar unit CVT, identifikasi semua bearing di transmisi (as roda belakang dan as puli). Ganti bearing yang oblak. Pastikan pelumasan pada primary sheave (rumah roller) cukup.'),
(26, 9, 'Kelemahan Aki dan Kerusakan Relay Starter', 'Aki motor sudah di ambang batas (low voltage), ditambah relay starter (bendik) yang mulai rusak. Relay yang rusak akan berbunyi \"cetek-cetek\" tetapi tidak kuat mengalirkan arus ke dinamo starter.', 'Lakukan pengujian dan pengisian ulang aki. Jika tegangan stabil, ganti relay starter atau bendik starter. Jika error Kode 46 muncul, segera periksa tegangan pengisian (Kiprok) karena kode itu terkait masalah kelistrikan.'),
(27, 9, 'Kerusakan Sensor Crankshaft (CKP)', 'Sensor Crankshaft Position (CKP) yang rusak gagal mengirimkan sinyal posisi poros engkol ke ECU, membuat ECU tidak tahu kapan harus menyemprotkan bensin dan memicu busi. Gejala mati mendadak saat panas adalah ciri khasnya.', 'Periksa sambungan kabel sensor CKP (terutama yang dekat dengan roda gila). Jika sambungan baik, sensor CKP perlu diganti. Lakukan reset ECU setelah penggantian.'),
(28, 9, 'Filter Udara Kotor / Injektor Tersumbat Parah', 'Filter udara yang kotor menghalangi asupan udara (menyebabkan bensin terlalu kaya/asap hitam). Atau, injektor tersumbat sehingga penyemprotan tidak sempurna. Keduanya menyebabkan tenaga mesin hilang.', 'Ganti filter udara. Jika masalah berlanjut, lakukan Injector Cleaning dengan alat ultrasonic. Cek busi dan setelan Throttle Body.'),
(29, 9, 'Kerusakan Noken As (Camshaft) dan Rocker Arm', 'Keausan pada Noken As atau Rocker Arm (pelatuk klep) disebabkan oleh kurangnya pelumasan atau oli yang telat diganti. Ini adalah masalah serius pada mekanisme katup (klep) dan menghasilkan bunyi kasar di kepala mesin.', 'Lakukan pemeriksaan celah klep. Jika celah terlalu longgar, periksa Noken As dan Rocker Arm. Ganti komponen yang sudah termakan atau aus. Pastikan menggunakan oli mesin yang berkualitas baik dan rutin menggantinya.'),
(30, 5, 'Roller Peyang dan Bos Pulley Aus', 'Roller yang sudah peyang (datar) dan bosh (pin) puli primer yang mulai aus menyebabkan pergerakan puli primer tidak sinkron. Ini adalah masalah mekanis yang merusak performa CVT secara keseluruhan, terutama pada Nmax yang bertenaga besar.', 'Bongkar dan periksa Pulley depan. Ganti satu set Roller dan bos puli. Pastikan grease puli baru (high temperature grease) dilumasi dengan benar.'),
(31, 5, 'Seal Water Pump Bocor', 'Seal (karet perapat) pada pompa air (water pump) yang rusak atau getas menyebabkan kebocoran air pendingin langsung dari mesin. Jika dibiarkan, mesin bisa mengalami overheat yang parah dan menyebabkan kerusakan internal.', 'Segera ganti seal water pump dan bearing yang terkait. Isi ulang air radiator (coolant) dan lakukan bleeding (membuang angin) agar tidak ada udara yang terperangkap di sistem pendingin.'),
(32, 5, 'Kerusakan One-Way Starter Clutch', 'One-Way Starter Clutch (kopling satu arah) yang berfungsi menghubungkan dinamo ke kruk as mulai selip atau aus. Ini menyebabkan dinamo berputar tetapi tenaga putaran tidak tersalurkan ke mesin. Biasanya terjadi saat mesin panas.', 'Lakukan pemeriksaan dan pembersihan One-Way Starter di area magnet. Ganti per (pegas) atau roller one-way jika sudah aus. Pastikan bearing jarum tidak rusak.'),
(33, 5, 'Sensor VVA atau Sensor TPS Bermasalah', 'Variable Valve Actuation (VVA) adalah sistem yang meningkatkan tenaga di putaran tinggi. Jika sensor VVA atau sensor TPS (Throttle Position Sensor) bermasalah, VVA gagal aktif, membuat performa di putaran atas drop drastis. Kode MIL 12 biasanya mengacu pada Sensor Crankshaft.', 'Periksa sambungan kabel pada Solenoid VVA dan Sensor TPS. Lakukan reset ECU. Jika error berulang, periksa kode kedipan MIL untuk menentukan sensor mana yang harus diganti.'),
(34, 5, 'Kerusakan Modul LED atau Kabel Konektor Headlamp', 'Lampu utama LED memiliki modul driver dan konektor yang rentan terhadap panas dan kelembaban. Kerusakan pada driver LED atau korsleting pada konektor (socket) lampu utama sering menyebabkan lampu mati atau berkedip-kedip.', 'Cek kondisi socket (konektor) lampu utama, bersihkan dari karat/kotoran, atau ganti jika meleleh. Jika modul LED utama rusak (mati total/kedip), ganti unit modul lampu utama.'),
(35, 11, 'Kelemahan Aki Total', 'Aki motor telah mencapai batas usia pakai atau mengalami low voltage karena pengisian yang kurang optimal. Daya yang tersisa hanya cukup untuk lampu kecil/sensor, tetapi tidak cukup untuk dinamo starter.', 'Periksa tegangan aki, jika di bawah 12V, lakukan pengisian ulang. Jika kondisi sel aki sudah buruk, ganti aki dengan tipe yang sesuai. Periksa juga relay starter dan sekring utama.'),
(36, 11, 'Busi Kotor dan Setting CO Tidak Pas', 'Busi yang kotor menghambat percikan api yang kuat, yang sering diperparah oleh setting rasio udara-bensin (CO) yang terlalu basah (kaya bensin). Ini menyebabkan pembakaran tidak stabil.', 'Cek kondisi busi dan ganti jika perlu. Lakukan penyetelan ulang setting CO pada sistem injeksi menggunakan diagnostic tool untuk mendapatkan rasio udara-bensin yang ideal.'),
(37, 11, 'Per Masuk (Per Kopling Sentrifugal) Lemah', 'Per (pegas) kopling sentrifugal sudah lemah atau patah. Ini menyebabkan kampas kopling menyentuh mangkok kopling sebelum waktunya (saat idle), yang menimbulkan bunyi gesekan klotok-klotok.', 'Bongkar unit kopling sentrifugal. Ganti per-per kecil di kopling sentrifugal. Bersihkan dan lumasi area CVT, cek kondisi center spring (per puli sekunder) jika sudah lemah.'),
(38, 11, 'Oli Transmisi (Gardan) Kurang/Kotor', 'Oli transmisi (gardan) yang tidak pernah diganti atau volumenya kurang akan menyebabkan bearing dan gigi-gigi di gardan bekerja keras tanpa pelumasan. Ini menghasilkan suara dengung keras dan getaran di kecepatan tinggi.', 'Segera ganti oli transmisi (gardan). Lakukan pengecekan volume oli gardan. Jika suara mendengung tidak hilang, perlu pemeriksaan dan penggantian bearing di unit gardan.'),
(39, 11, 'Masalah Sensor CKP (Crankshaft Position Sensor)', 'Kerusakan pada sensor CKP (Kode 12) menyebabkan ECU tidak menerima data posisi poros engkol, sehingga urutan pengapian dan injeksi tidak terjadi dengan benar. Ini membuat mesin sulit, bahkan mustahil, untuk menyala.', 'Cek sambungan kabel sensor CKP (sering terputus atau terkelupas). Jika sambungan aman, sensor CKP perlu diganti. Lakukan reset ECU setelah penggantian.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_19_164218_create_brands_table', 1),
(5, '2025_11_19_164230_create_motor_types_table', 1),
(6, '2025_11_19_164243_create_symptoms_table', 1),
(7, '2025_11_19_164250_create_diseases_table', 1),
(8, '2025_11_19_164259_create_rules_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `motor_types`
--

CREATE TABLE `motor_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `motor_types`
--

INSERT INTO `motor_types` (`id`, `brand_id`, `name`) VALUES
(19, 1, 'ADV'),
(6, 2, 'Aerox'),
(12, 1, 'Beat'),
(10, 2, 'Fazzio'),
(11, 2, 'Fino'),
(7, 2, 'Freego'),
(9, 2, 'Gear'),
(15, 1, 'Genio'),
(8, 2, 'Mio M3'),
(5, 2, 'Nmax'),
(16, 1, 'PCX'),
(13, 1, 'Scoopy'),
(17, 1, 'Spacy'),
(18, 1, 'Stylo'),
(14, 1, 'Vario');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rules`
--

CREATE TABLE `rules` (
  `disease_id` bigint(20) UNSIGNED NOT NULL,
  `symptom_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rules`
--

INSERT INTO `rules` (`disease_id`, `symptom_id`) VALUES
(5, 7),
(5, 8),
(5, 9),
(6, 10),
(6, 11),
(6, 12),
(7, 13),
(7, 14),
(7, 15),
(8, 16),
(8, 17),
(8, 18),
(9, 19),
(9, 20),
(9, 21),
(10, 22),
(10, 23),
(10, 24),
(11, 25),
(11, 26),
(11, 27),
(12, 28),
(12, 29),
(12, 30),
(13, 31),
(13, 32),
(13, 33),
(14, 34),
(14, 35),
(14, 36),
(15, 37),
(15, 38),
(15, 39),
(16, 40),
(16, 41),
(16, 42),
(17, 43),
(17, 44),
(17, 45),
(18, 46),
(18, 47),
(18, 48),
(19, 49),
(19, 50),
(19, 51),
(20, 52),
(20, 53),
(20, 54),
(21, 55),
(21, 56),
(21, 57),
(22, 58),
(22, 59),
(22, 60),
(23, 61),
(23, 62),
(23, 63),
(24, 64),
(24, 65),
(24, 66),
(25, 67),
(25, 68),
(25, 69),
(26, 70),
(26, 71),
(26, 72),
(27, 73),
(27, 74),
(27, 75),
(28, 76),
(28, 77),
(28, 78),
(29, 79),
(29, 80),
(29, 81),
(30, 82),
(30, 83),
(30, 84),
(31, 85),
(31, 86),
(31, 87),
(32, 88),
(32, 89),
(32, 90),
(33, 91),
(33, 92),
(33, 93),
(34, 94),
(34, 95),
(34, 96),
(35, 97),
(35, 98),
(35, 99),
(36, 100),
(36, 101),
(36, 102),
(37, 103),
(37, 104),
(37, 105),
(38, 106),
(38, 107),
(38, 108),
(39, 109),
(39, 110),
(39, 111);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FspJX3MIykbldSiTcyKPJbh84Sk4xXbwCXxRTPtW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVTNncmZwczZzVFp4eG9BdHp5dkFJYWNPWXh1SXBnRmRVSmltQUpyZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764837323);

-- --------------------------------------------------------

--
-- Struktur dari tabel `symptoms`
--

CREATE TABLE `symptoms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `motor_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `symptoms`
--

INSERT INTO `symptoms` (`id`, `motor_type_id`, `name`) VALUES
(7, 12, 'Starter elektrik gagal berfungsi / hanya berbunyi \"tek\".'),
(8, 12, 'Lampu utama dan lampu senja redup saat mesin idle.'),
(9, 12, 'Klakson berbunyi serak atau lemah.'),
(10, 12, 'Ada suara mendecit/berdecit saat motor baru jalan.'),
(11, 12, 'Tarikan motor terasa berat dan lambat saat di tanjakan.'),
(12, 12, 'Kecepatan tertinggi (top speed) menurun drastis.'),
(13, 12, 'Mesin sering mati mendadak saat gas ditutup (idle).'),
(14, 12, 'Mesin terasa brebet atau tersendat-sendat di putaran atas.'),
(15, 12, 'Lampu MIL (Malfunction Indicator Lamp) berkedip 1-2-5 kali (kode tertentu).'),
(16, 12, 'Terdengar suara \"ngook\" saat gas ditutup cepat (deselerasi).'),
(17, 12, 'Konsumsi bahan bakar tiba-tiba menjadi sangat boros.'),
(18, 12, 'Bau bensin mentah tercium dari area knalpot.'),
(19, 12, 'Terdengar bunyi \"klotok-klotok\" saat mesin idle (panas/dingin).'),
(20, 12, 'Terdapat asap putih tipis keluar dari knalpot saat pertama dihidupkan.'),
(21, 12, 'Oli mesin sering berkurang drastis tanpa ada kebocoran.'),
(22, 13, 'Getaran kuat terasa di bagian CVT saat putaran mesin rendah (0-20 km/jam).'),
(23, 13, 'Muncul suara \"klotok-klotok\" saat melewati jalan yang tidak rata.'),
(24, 13, 'Akselerasi terasa berat dan tertahan saat baru mulai bergerak.'),
(25, 13, 'Konsumsi bahan bakar (BBM) terasa sangat boros dari biasanya.'),
(26, 13, 'Bau bensin mentah tercium dari knalpot saat mesin panas.'),
(27, 13, 'Mesin terasa \"brebet\" atau tarikan tidak stabil pada kecepatan tinggi.'),
(28, 13, 'Starter elektrik gagal berfungsi (tidak ada bunyi \"tek\" atau putaran).'),
(29, 13, 'Lampu MIL berkedip cepat (misalnya, 8 atau 9 kali).'),
(30, 13, 'Fuse (sekring) utama sering putus tanpa sebab jelas.'),
(31, 13, 'Terdengar bunyi \"duk\" atau \"jedug\" keras saat melewati polisi tidur.'),
(32, 13, 'Suspensi belakang terasa keras atau terlalu memantul (rebound).'),
(33, 13, 'Ada rembesan oli di sekitar shockbreaker belakang.'),
(34, 13, 'Mesin tiba-tiba mati saat kecepatan tinggi atau di jalan lurus.'),
(35, 13, 'Setelah mati, mesin bisa dihidupkan lagi setelah didiamkan beberapa menit.'),
(36, 13, 'Lampu MIL berkedip 1-2 kali (kode tertentu).'),
(37, 14, 'Lampu indikator temperatur (air radiator) menyala terus.'),
(38, 14, 'Terdengar suara mendesis dari area radiator saat mesin panas.'),
(39, 14, 'Air radiator di tabung reservoir (cadangan) cepat berkurang.'),
(40, 14, 'Indikator Keyless (lampu biru) di smart key tidak menyala saat diaktifkan.'),
(41, 14, 'Motor tidak bisa dihidupkan, meskipun remote sudah dekat.'),
(42, 14, 'Bunyi buzzer (alarm) pada motor tidak merespons remote.'),
(43, 14, 'Terdengar suara \"klotok-klotok\" dari CVT saat kecepatan tinggi (di atas 60 km/jam).'),
(44, 14, 'Muncul suara \"nging\" atau \"ngung\" saat mesin idle (dibiarkan menyala).'),
(45, 14, 'Terjadi getaran berlebihan pada pedal starter (engkol).'),
(46, 14, 'Rem belakang terasa sangat dalam (blong) atau harus diinjak kuat.'),
(47, 14, 'Terdengar suara gesekan kasar saat rem belakang diinjak.'),
(48, 14, 'Ada rembesan cairan (oli) di dekat master rem atau rem belakang.'),
(49, 14, 'Mesin butuh waktu lama untuk menyala (start panjang).'),
(50, 14, 'Mesin mati saat gas ditutup mendadak.'),
(51, 14, 'Ada bau bensin menyengat dari area mesin/tangki.'),
(52, 8, 'Suara starter elektrik terdengar kasar dan berat (berat memutar mesin).'),
(53, 8, 'Terdengar bunyi \"cring-cring\" saat tombol starter ditekan.'),
(54, 8, 'Mesin tidak mau menyala meskipun starter terus ditekan, terutama saat mesin dingin.'),
(55, 8, 'Terdapat asap putih tipis dari knalpot saat mesin digas.'),
(56, 8, 'Oli mesin sering berkurang drastis tanpa ada rembesan/kebocoran di luar.'),
(57, 8, 'Tercium bau gosong tipis dari knalpot.'),
(58, 8, 'Getaran kuat terasa di area CVT saat akselerasi.'),
(59, 8, 'Muncul bunyi \"klotok-klotok\" saat mesin panas.'),
(60, 8, 'Suara mesin menjadi lebih bising (ngorok) dari biasanya.'),
(61, 8, 'Tarikan motor terasa berat (ngempos) dan tidak bertenaga.'),
(62, 8, 'Konsumsi BBM menjadi lebih boros tanpa alasan yang jelas'),
(63, 8, 'Engine check light (MIL) menyala kedip 4-6 kali.'),
(64, 8, 'Mesin sangat sulit dihidupkan pada pagi hari (saat dingin).'),
(65, 8, 'Mesin mudah mati (brebet) di awal penyalaan.'),
(66, 8, 'Ada bau bensin menyengat dari knalpot.'),
(67, 9, 'Ada suara \"ngorok\" atau mendengung keras dari area CVT saat kecepatan tinggi.'),
(68, 9, 'Suara mesin menjadi lebih kasar/bising dari biasanya, terutama saat mesin panas.'),
(69, 9, 'Getaran berlebihan terasa di dek kaki atau setang.'),
(70, 9, 'Starter elektrik gagal berfungsi, hanya terdengar suara \"cetek-cetek\" cepat.'),
(71, 9, 'Lampu depan berkedip atau meredup saat tombol starter ditekan.'),
(72, 9, 'Engine Check Light (MIL) menyala 4 kali kedipan panjang dan 6 kali kedipan pendek (Kode 46).'),
(73, 9, 'Lampu Engine Check Light (MIL) menyala kedip 12 kali.'),
(74, 9, 'Mesin tiba-tiba mati saat motor dibawa berjalan jauh/panas.'),
(75, 9, 'Motor tidak bisa dihidupkan kembali setelah didiamkan 5-10 menit.'),
(76, 9, 'Tarikan motor terasa berat (ngempos) dan tidak responsif.'),
(77, 9, 'Asap hitam tebal keluar dari knalpot saat digas.'),
(78, 9, 'Konsumsi bahan bakar meningkat drastis.'),
(79, 9, 'Terdengar bunyi kasar (klotok-klotok) dari kepala silinder (head) saat mesin menyala.'),
(80, 9, 'Oli mesin cepat berkurang (kurang dari 50% saat dicek).'),
(81, 9, 'Suara mesin menjadi sangat bising (kasar) saat putaran tinggi.'),
(82, 5, 'Terdengar bunyi kasar \"tek-tek\" atau \"cit-cit\" dari area CVT saat kecepatan tinggi (di atas 60 km/jam).'),
(83, 5, 'Motor terasa \"gigi kosong\" sesaat saat gas ditarik (seperti jeda akselerasi).'),
(84, 5, 'Terasa ada getaran berlebih di setang saat putaran mesin menengah.'),
(85, 5, 'Mesin terasa sangat panas setelah berjalan sebentar, bahkan di cuaca dingin.'),
(86, 5, 'Terdapat cairan berwarna hijau/biru (coolant) menetes di bagian bawah motor.'),
(87, 5, 'Volume air radiator di tabung reservoir cepat berkurang drastis.'),
(88, 5, 'Saat tombol starter ditekan, terdengar bunyi \"tek-tek\" dan mesin tidak memutar.'),
(89, 5, 'Starter elektrik bekerja normal saat mesin dingin, tetapi gagal saat mesin panas.'),
(90, 5, 'Mesin hanya bisa dihidupkan dengan engkol (jika ada) atau didorong.'),
(91, 5, 'Tarikan motor terasa ngempos (hilang tenaga) di putaran mesin 6000 RPM ke atas.'),
(92, 5, 'Suara mesin terasa lebih kasar/keras dari biasanya.'),
(93, 5, 'Lampu MIL berkedip 12 kali (Kode 12).'),
(94, 5, 'Lampu utama (LED) berkedip-kedip atau mati total.'),
(95, 5, 'Lampu senja (DRL) tetap menyala normal, tetapi lampu utama redup.'),
(96, 5, 'Sekring lampu utama sering putus.'),
(97, 11, 'Starter elektrik gagal memutar mesin, hanya terdengar bunyi \"tik-tik\" pelan.'),
(98, 11, 'Lampu depan/klakson lemah saat tombol starter ditekan.'),
(99, 11, 'Mesin hanya bisa dihidupkan dengan engkol (jika tersedia).'),
(100, 11, 'Mesin mati tiba-tiba saat motor sedang melaju pelan atau saat berhenti (idle).'),
(101, 11, 'Mesin terasa brebet dan tersendat-sendat di putaran menengah.'),
(102, 11, 'Muncul bau bensin menyengat dari area mesin/knalpot.'),
(103, 11, 'Terdengar suara \"klotok-klotok\" atau \"tek-tek\" dari CVT saat motor idle.'),
(104, 11, 'Suara menghilang atau mereda setelah gas ditarik sedikit.'),
(105, 11, 'Tarikan motor terasa berat di awal (start lambat).'),
(106, 11, 'Kecepatan tertinggi (top speed) motor menurun drastis.'),
(107, 11, 'Terdengar suara \"nging\" atau mendengung saat kecepatan tinggi.'),
(108, 11, 'Motor terasa bergetar hebat saat putaran mesin tinggi.'),
(109, 11, 'Starter elektrik berbunyi \"crank-crank\" tapi mesin tidak menyala.'),
(110, 11, 'Perlu waktu lama untuk menekan tombol starter agar mesin menyala.'),
(111, 11, 'Lampu MIL (Malfunction Indicator Lamp) berkedip 12 kali.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Washiatul Akmal', 'admin1@motodiagnos.com', '2025-12-01 18:54:27', '$2y$12$1NQXqOWJ9vR9cBqLVdCpU.WPWEN0g.rXsrRDCQGZVALiTHl65dycC', 'C7q1DZ84mbpW6dCSr4fFzD9kZqCoUoIof7TA4a1wbgZJiSS6bSbexTKvzAEt', '2025-12-01 18:54:27', '2025-12-01 20:55:33'),
(2, 'Rasul Rajab', 'admin2@motodiagnos.com', '2025-12-01 18:54:28', '$2y$12$8fX3sQ.Pnwc7QG4GrBR5ieLPOpif6GYNA2ekjMfwkvkp71XyP1FYy', 'CZbyvtD1RZScIg8rWzP19WBvnwpND8xVfrossNxH1r0oFmkLBZ3gArrTv3NR', '2025-12-01 18:54:28', '2025-12-01 21:22:42'),
(3, 'Anugrah Restu', 'admin3@motodiagnos.com', '2025-12-01 18:54:28', '$2y$12$rXAGTP/3HT.7hm5cH91RWe.tnFXlNf6ao5u6EcY9eMzEbbon8tnx.', 'HleQunLD13qJCnlp6xFpBTTXX7ZZ8lsbMaOsuqjUhgfYpHko04IzkefxC3kS', '2025-12-01 18:54:28', '2025-12-01 21:23:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diseases_motor_type_id_foreign` (`motor_type_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `motor_types`
--
ALTER TABLE `motor_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `motor_types_name_brand_id_unique` (`name`,`brand_id`),
  ADD KEY `motor_types_brand_id_foreign` (`brand_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`disease_id`,`symptom_id`),
  ADD KEY `rules_symptom_id_foreign` (`symptom_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `symptoms`
--
ALTER TABLE `symptoms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `symptoms_motor_type_id_foreign` (`motor_type_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `motor_types`
--
ALTER TABLE `motor_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `symptoms`
--
ALTER TABLE `symptoms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `diseases`
--
ALTER TABLE `diseases`
  ADD CONSTRAINT `diseases_motor_type_id_foreign` FOREIGN KEY (`motor_type_id`) REFERENCES `motor_types` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `motor_types`
--
ALTER TABLE `motor_types`
  ADD CONSTRAINT `motor_types_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rules_symptom_id_foreign` FOREIGN KEY (`symptom_id`) REFERENCES `symptoms` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `symptoms`
--
ALTER TABLE `symptoms`
  ADD CONSTRAINT `symptoms_motor_type_id_foreign` FOREIGN KEY (`motor_type_id`) REFERENCES `motor_types` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
