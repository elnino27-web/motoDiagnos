<p align="center">
<img src="https://www.google.com/search?q=https://oaidalleapiprodscus.blob.core.windows.net/private/org-vB0B2bUj4I8mK2n2u3617YjL/user-vN07Y8v12h1xV8d5z0w3I4s1/img-H3k5g2e0K9M5f2x4e8j3s0Q4.png%3Fattachment%3Dtrue%26n%3D2" width="200" alt="MotoDiagnos Logo">
</p>

<h1 align="center">🏍️ MotoDiagnos: Sistem Pakar Diagnosa Kerusakan Sepeda Motor</h1>

<p align="center">
<img src="https://www.google.com/search?q=https://img.shields.io/badge/Status-LENGKAP-2ecc71%3Fstyle%3Dflat-square" alt="Status Completed">
<img src="https://www.google.com/search?q=https://img.shields.io/badge/Metode-Forward%2520Chaining-blue%3Fstyle%3Dflat-square" alt="Metode Forward Chaining">
<img src="https://www.google.com/search?q=https://img.shields.io/badge/Framework-Laravel%252010%252B-ff2d20%3Fstyle%3Dflat-square" alt="Framework Laravel">
</p>

MotoDiagnos adalah aplikasi sistem pakar berbasis web yang dikembangkan menggunakan Laravel. Proyek ini bertujuan memberikan diagnosis cepat, akurat, dan terstruktur untuk kerusakan umum pada motor matic (Honda & Yamaha) berdasarkan gejala yang diinput pengguna.

🎯 Keunggulan Utama Proyek

Proyek ini menonjol karena fokus pada akurasi logika sistem pakar dan kualitas antarmuka admin yang responsif.

Keunggulan

Deskripsi

Akurasi Terukur

Menggunakan metode Forward Chaining untuk menghitung Persentase Kecocokan Gejala terhadap Aturan (Rules), memberikan diagnosis yang terukur (Contoh: Akurasi 75%).

Struktur Data Spesifik

Basis pengetahuan diikat secara spesifik pada Tipe Motor, mencegah false positive (diagnosis salah) dan memastikan Gejala yang muncul hanya relevan untuk model motor yang dipilih.

UI/UX Profesional

Desain yang konsisten (menggunakan tema gradien warna unik untuk setiap modul) dan interaktif (seperti counter angka animasi di Dashboard dan input group modern).

Integrasi & Keamanan

Dilindungi oleh Authentication dan Middleware. Fitur Admin (CRUD) yang lengkap menjamin integritas data sensitif.

🧩 Fitur Aplikasi

👤 Antarmuka Pengguna (Diagnosa)

Alur Dinamis: Input bertingkat (Merek → Tipe → Gejala) didukung oleh AJAX.

Laporan Akhir: Menyajikan Penyakit, Tingkat Akurasi, Deskripsi Kerusakan, dan Saran Solusi yang praktis.

🔐 Panel Administrasi (CRUD)

Admin Panel menyediakan tools lengkap untuk memelihara Basis Pengetahuan:

Modul

Ikon

Fungsi Utama

Tema Warna

Merek Motor

fa-tag

Mengelola kategori utama motor.

🔵 Biru (Primary)

Tipe Motor

fa-motorcycle

Mengelola model spesifik (e.g., Beat 110cc).

🟢 Hijau/Tosca (Info)

Gejala

fa-search-plus

Mengelola indikator kerusakan (Kode G01, G02, dst.).

🟠 Kuning/Oranye (Warning)

Kerusakan

fa-bug

Mengelola definisi Penyakit dan Solusi.

🔴 Merah/Pink (Danger)

Rules

fa-project-diagram

Menghubungkan Penyakit $\leftrightarrow$ Gejala (Logika IF-THEN).

🟣 Ungu

⚙️ 🛠 Teknologi yang Digunakan

Backend: Laravel / PHP 12+

Database: MySQL

Arsitektur: MVC, Rule-Based Expert System (Forward Chaining)

Frontend: Blade Template, Bootstrap 4/5, jQuery (Full), Font Awesome

🚀 Instalasi dan Menjalankan Proyek

Clone Repositori:

git clone [https://github.com/elnino27-web/motoDiagnos.git](https://github.com/elnino27-web/motoDiagnos.git)
cd motoDiagnos


Install Dependencies:

composer install


Setup Environment:

cp .env.example .env
php artisan key:generate


Edit konfigurasi database di file .env.

Migrasi Database (dan Seeder):

# Membuat tabel dan mengisi user admin
php artisan migrate:fresh --seed


Jalankan Server:

php artisan serve


Akses melalui: http://localhost:8000

🔐 Kredensial Admin Default

Email: admin@motodiagnos.com

Password: password

Dibuat oleh Washiatus Akmal. Terima kasih telah mengunjungi repositori ini.
