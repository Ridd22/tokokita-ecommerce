# TokoKita — E-Commerce Laravel + Vue 3 + Inertia.js

Starter project toko online berbahasa Indonesia menggunakan Laravel 12, Vue 3, Inertia.js 2, Vite, Tailwind CSS, dan MySQL.

## Fitur
- Katalog produk, pencarian, detail produk, dan pagination.
- Registrasi, login, logout, serta role `admin` / `customer`.
- Keranjang belanja berbasis session.
- Checkout, pembuatan pesanan, pengurangan stok, dan riwayat pesanan.
- Dashboard admin, CRUD produk, dan pengelolaan status pesanan.
- Seeder akun demo dan produk contoh.

> Pembayaran masih simulasi (transfer/COD). Belum terhubung ke payment gateway. Gambar produk contoh memakai emoji sebagai placeholder.

## Persyaratan
- PHP 8.2+ dan ekstensi PHP umum (PDO MySQL, OpenSSL, Mbstring, Tokenizer, XML, Ctype, JSON, Fileinfo).
- Composer 2.
- Node.js 20+ dan npm.
- MySQL / MariaDB (XAMPP bisa digunakan).

## Cara cepat di Windows
1. Ekstrak folder `tokokita` dan buka di VS Code.
2. Jalankan MySQL dari XAMPP, lalu buat database bernama `tokokita` melalui phpMyAdmin.
3. Pastikan `.env` memakai konfigurasi database berikut (setup.bat akan menyalin `.env.example` jika belum ada):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tokokita
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Klik dua kali `setup.bat` atau jalankan perintah berikut di terminal:
   ```bash
   composer install
   copy .env.example .env
   php artisan key:generate
   php artisan migrate --seed
   npm install
   ```
   Jika `.env` sudah ada, jangan menyalinnya ulang.
5. Jalankan `run.bat`, atau buka dua terminal dan jalankan `php artisan serve` serta `npm run dev`.
6. Buka `http://127.0.0.1:8000`.

## Akun demo
| Peran | Email | Password |
|---|---|---|
| Admin | admin@tokokita.test | password |
| Pelanggan | customer@tokokita.test | password |

Ganti password demo sebelum aplikasi dipublikasikan. Registrasi dari halaman publik hanya membuat akun pelanggan.

## Catatan pengembangan
- Field gambar saat ini menggunakan emoji/teks, belum upload file.
- Belum ada ongkir, payment gateway, upload bukti transfer, notifikasi, atau integrasi kurir.
- Sebelum produksi, tambahkan pengujian otomatis, validasi upload, kebijakan otorisasi yang lebih rinci, dan konfigurasi deployment.
