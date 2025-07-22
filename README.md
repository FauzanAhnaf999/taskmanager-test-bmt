# Task Manager - Fullstack Developer Test

Aplikasi sederhana untuk mengelola daftar tugas (Task Manager) yang dibangun sebagai bagian dari tes Fullstack Developer. Aplikasi ini memiliki fitur CRUD (Create, Read, Update, Delete) yang lengkap.

## Tech Stack

- **Backend:** Laravel 12
- **Database:** MySQL
- **Frontend:** HTML, JavaScript (ES6+), Bootstrap 5
- **Interaksi:** AJAX (menggunakan Fetch API)

## Cara Menjalankan Aplikasi

Aplikasi ini terdiri dari backend (Laravel API) dan frontend (file HTML statis). Keduanya perlu dijalankan secara bersamaan.

### 1. Menjalankan Backend (Server Laravel)

1.  **Clone repositori ini.**
2.  Masuk ke direktori proyek: `cd taskmanager-test-bmt`
3.  Install semua dependensi PHP: `composer install`
4.  Salin file `.env.example` menjadi `.env`: `cp .env.example .env`
5.  Buat *Application Key* baru: `php artisan key:generate`
6.  **Setup Database:**
    * Buka **XAMPP** dan jalankan layanan **Apache** & **MySQL**.
    * Buka **phpMyAdmin** dan buat database baru dengan nama, misalnya, `task_manager_db`.
7.  Sesuaikan konfigurasi database di dalam file `.env`:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=task_manager_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```
8.  Jalankan migrasi untuk membuat tabel di database: `php artisan migrate`
9.  Jalankan server development Laravel: `php artisan serve`

Server backend sekarang berjalan di `http://127.0.0.1:8000`.

### 2. Menjalankan Frontend

1.  Pastikan layanan **Apache** di XAMPP Anda sudah berjalan.
2.  Buka browser dan akses file `index.html` yang ada di dalam folder `public`.
3.  URL-nya akan terlihat seperti ini: `http://localhost/taskmanager-test-bmt/public/index.html`

Aplikasi sekarang siap digunakan.

Video Simulasi Fungsionalitas : https://drive.google.com/file/d/1tzpku9bFTRRFa7UH89Ckt1szbIYgenuu/view?usp=drive_link

---

## Jawaban Pertanyaan Teori

### 1. Jelaskan apa itu CORS!

**CORS (Cross-Origin Resource Sharing)** adalah sebuah mekanisme keamanan yang ada di dalam browser. Tujuannya adalah untuk **membatasi** sebuah website (`http://situs-A.com`) agar tidak bisa sembarangan meminta data dari website lain (`http://situs-B.com`).

Secara default, browser akan memblokir permintaan seperti ini untuk mencegah pencurian data. Agar permintaan diizinkan, server tujuan (`situs-B.com`) harus secara eksplisit memberikan izin melalui HTTP Header, contohnya `Access-Control-Allow-Origin`.

Dalam proyek ini, kita mengalami CORS. Frontend kita berjalan di `http://localhost` (melalui XAMPP) dan mencoba meminta data dari backend di `http://127.0.0.1:8000` (melalui `php artisan serve`). Karena "origin" (alamat) nya berbeda, kita harus mengkonfigurasi file `config/cors.php` di Laravel untuk mengizinkan permintaan tersebut.

### 2. Jelaskan tentang Asynchronous!

**Asynchronous** (atau "asinkron") adalah model eksekusi program di mana sebuah tugas bisa dijalankan **tanpa harus menunggu tugas sebelumnya selesai**. Ini kebalikan dari **Synchronous** (sinkron), di mana setiap tugas harus menunggu giliran secara berurutan.

Analogi sederhananya:
* **Synchronous:** Melakukan panggilan telepon. Anda harus menunggu orang di seberang menjawab dan menyelesaikan percakapan sebelum bisa melakukan hal lain.
* **Asynchronous:** Mengirim pesan WhatsApp. Anda bisa mengirim pesan, lalu langsung melanjutkan aktivitas lain. Anda akan mendapat notifikasi saat pesan tersebut dibalas, tanpa harus terus-menerus menunggu.

Dalam pengembangan web, JavaScript menggunakan Asynchronous secara ekstensif untuk tugas-tugas yang memakan waktu, seperti mengambil data dari API. Di proyek ini, saat tombol ditekan untuk mengambil data, kita menggunakan **`fetch()`** yang bersifat asinkron. Halaman web tidak "freeze" atau macet; ia tetap responsif sambil menunggu data datang dari server Laravel. Ini adalah inti dari **AJAX**.

### 3. Apa saja yang bisa mengurangi *load time* website?

Mengurangi *load time* adalah proses optimasi untuk membuat website lebih cepat dimuat. Beberapa cara utamanya adalah:

* **Optimasi Aset (Gambar, CSS, JS):**
    * **Kompresi Gambar:** Mengurangi ukuran file gambar tanpa menurunkan kualitas secara drastis, menggunakan format modern seperti WebP.
    * **Minify CSS & JavaScript:** Menghapus semua karakter yang tidak perlu (seperti spasi dan komentar) dari kode untuk memperkecil ukuran file.
    * **Code Bundling:** Menggabungkan beberapa file CSS atau JavaScript menjadi satu file tunggal untuk mengurangi jumlah permintaan (HTTP requests) ke server.

* **Optimasi Server & Backend:**
    * **Caching:** Menyimpan data yang sering diakses (seperti hasil query database) di memori (contoh: Redis) agar tidak perlu mengambilnya berulang kali dari sumber yang lambat.
    * **Query Database yang Efisien:** Memastikan query ke database berjalan cepat, misalnya dengan menggunakan *indexing*.
    * **Server Response Time:** Memilih hosting yang cepat dan berlokasi dekat dengan target pengguna.

* **Penggunaan Jaringan:**
    * **Gunakan CDN (Content Delivery Network):** Menyimpan aset statis (gambar, CSS, JS) di berbagai server di seluruh dunia. Pengguna akan mengunduh aset dari server yang lokasinya paling dekat, sehingga lebih cepat.
    * **Enable Gzip/Brotli Compression:** Mengompres file di sisi server sebelum dikirim ke browser, sehingga ukuran transfer data menjadi jauh lebih kecil.
