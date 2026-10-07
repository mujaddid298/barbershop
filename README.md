<div align="center">

# ✂️ BarberShop Management System

### Sistem Manajemen Barbershop Modern Berbasis Web

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Midtrans](https://img.shields.io/badge/Midtrans-Payment-003B8E?style=for-the-badge)](https://midtrans.com)
[![Vite](https://img.shields.io/badge/Vite-Frontend-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)

</div>

---

## 📌 Tentang Project

**BarberShop Management System** adalah aplikasi web full-stack yang dibangun dengan **Laravel 13** untuk mengelola operasional barbershop secara digital dan efisien. Aplikasi ini menyediakan platform terintegrasi antara pelanggan dan admin barbershop, mulai dari pemesanan layanan, manajemen barber, sistem antrian real-time, hingga pembayaran online via **Midtrans**.

---

## ✨ Fitur Utama

### 👤 Panel Pelanggan (User)

| Fitur | Deskripsi |
|-------|-----------|
| 🔐 **Autentikasi** | Register, Login, dan manajemen profil |
| 📅 **Booking Layanan** | Pemesanan layanan potong rambut dengan pilihan barber |
| 🏷️ **Kode Promo** | Penggunaan kode diskon saat booking |
| 💳 **Pembayaran Online** | Integrasi Midtrans untuk transaksi digital |
| 📋 **Riwayat Booking** | Melihat histori pemesanan dan status transaksi |
| ⭐ **Rating & Ulasan** | Memberikan rating pada layanan yang telah diterima |
| 📱 **Live Antrian** | Monitor antrian secara real-time |
| 👤 **Edit Profil** | Kelola data diri dan foto profil |

### 🛠️ Panel Admin

| Fitur | Deskripsi |
|-------|-----------|
| 📊 **Dashboard** | Ringkasan data, statistik, dan grafik pendapatan |
| 💈 **Manajemen Barber** | CRUD data barber beserta keahlian |
| ✂️ **Manajemen Layanan** | Pengelolaan jenis & harga layanan |
| 📅 **Manajemen Booking** | Monitoring dan pengelolaan semua pesanan |
| 🎫 **Manajemen Promo** | Buat dan kelola kode promo/diskon |
| 🖼️ **Hasil Karya** | Upload galeri hasil karya barber |
| 👥 **Manajemen Pelanggan** | Data dan riwayat pelanggan |
| 💰 **Laporan Keuangan** | Rekapitulasi pemasukan dan transaksi |
| 📺 **Live Antrian Display** | Tampilan antrian real-time untuk layar toko |

---

## 🏗️ Teknologi yang Digunakan

### Backend
- **Framework**: Laravel 13 (PHP 8.3)
- **Database**: MySQL
- **Payment Gateway**: Midtrans PHP SDK
- **Queue System**: Laravel Queue
- **Static Analysis**: Larastan

### Frontend
- **Template Engine**: Laravel Blade
- **Build Tool**: Vite

### Tools & Development
- **Testing**: PHPUnit 12
- **Code Style**: Laravel Pint
- **Logging**: Laravel Pail

---

## 🗄️ Struktur Database

```
users           - Data pengguna & admin
barbers         - Data barber (nama, foto, keahlian)
layanans        - Jenis layanan & harga
bookings        - Data pemesanan (termasuk promo & rating)
transaksis      - Data transaksi pembayaran
antrians        - Sistem antrian real-time
promos          - Kode promo & diskon
hasil_karyas    - Galeri hasil karya barber
```

---

## 🚀 Cara Instalasi

### Prasyarat
- PHP >= 8.3
- Composer
- Node.js & NPM
- MySQL
- Git

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/mujaddid298/barbershop.git
cd barbershop
```

**2. Install dependencies PHP**
```bash
composer install
```

**3. Salin file environment**
```bash
cp .env.example .env
```

**4. Generate application key**
```bash
php artisan key:generate
```

**5. Konfigurasi database di `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=barbershop
DB_USERNAME=root
DB_PASSWORD=
```

**6. Konfigurasi Midtrans di `.env`**
```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

**7. Jalankan migrasi & seeder**
```bash
php artisan migrate --seed
```

**8. Install dependencies frontend**
```bash
npm install
```

**9. Build assets**
```bash
npm run build
```

**10. Jalankan aplikasi**
```bash
composer run dev
# atau
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

---

## ⚡ Quick Setup (Satu Perintah)

```bash
composer run setup
```

Perintah ini secara otomatis menjalankan: install dependencies, generate key, migrate database, install NPM packages, dan build assets.

---

## 📁 Struktur Folder

```
barbershop/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/
│   │   │   ├── AdminController.php
│   │   │   ├── BarberController.php
│   │   │   ├── FinanceController.php
│   │   │   ├── HasilKaryaController.php
│   │   │   ├── LayananController.php
│   │   │   ├── PromoController.php
│   │   │   └── UserController.php
│   │   ├── User/
│   │   ├── AuthController.php
│   │   └── LiveQueueController.php
│   └── Models/
│       ├── User.php, Barber.php, Booking.php
│       ├── Layanan.php, Transaksi.php, Antrian.php
│       ├── Promo.php, HasilKarya.php
├── database/
│   └── migrations/        # 15 file migrasi
├── resources/views/
│   ├── pages/
│   │   ├── admin/         # Halaman panel admin
│   │   ├── user/          # Halaman panel user
│   │   └── live-antrian.blade.php
│   └── components/        # Komponen UI (sidebar, dll)
├── routes/
└── public/
```

---

## 💡 Fitur Unggulan

### 📺 Live Antrian Real-time
Tampilan antrian digital yang dapat dipasang di layar TV atau monitor toko. Pelanggan dapat memantau posisi antrian secara langsung.

### 💳 Integrasi Pembayaran Midtrans
Mendukung berbagai metode pembayaran:
- Transfer Bank (BCA, BNI, BRI, Mandiri)
- E-Wallet (GoPay, OVO, Dana, ShopeePay)
- QRIS
- Kartu Kredit/Debit

### ⭐ Sistem Rating
Pelanggan dapat memberikan rating setelah layanan selesai untuk meningkatkan kualitas secara berkelanjutan.

### 🎫 Sistem Promo & Diskon
Admin dapat membuat kode promo dengan batasan penggunaan, tanggal kadaluarsa, dan nilai diskon yang fleksibel.

---

## 🔑 Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@barbershop.com | password |
| User | user@barbershop.com | password |

> ⚠️ **Penting**: Ganti password default setelah instalasi di lingkungan produksi!

---

## 🤝 Kontribusi

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/fitur-baru`)
3. Commit perubahan (`git commit -m 'Tambah fitur baru'`)
4. Push ke branch (`git push origin feature/fitur-baru`)
5. Buat Pull Request

---

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

---

<div align="center">

**Dibuat dengan ❤️ menggunakan Laravel 13**

© 2026 BarberShop Management System

</div>
