<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Project-Laravel%20Sepatu-red" alt="Project"></a>
<a href="#"><img src="https://img.shields.io/badge/Status-Active-brightgreen" alt="Status"></a>
<a href="#"><img src="https://img.shields.io/badge/License-MIT-blue" alt="License"></a>
</p>

# Laravel Sepatu

Aplikasi **Laravel Sepatu** adalah sistem manajemen dan penjualan sepatu yang dibangun menggunakan Laravel.  
Aplikasi ini menyediakan fitur CRUD sepatu, kategori, upload gambar, autentikasi, dan dashboard ringkasan data.

## 🚀 Fitur Utama

- CRUD Data Sepatu (Tambah, Edit, Delete, View)
- CRUD Kategori Sepatu
- Manajemen User (Admin / User)
- Upload gambar sepatu
- Middleware proteksi halaman admin
- Dashboard rangkuman data
- Struktur MVC rapi mengikuti standar Laravel
- Template Blade yang responsif

## 📂 Struktur Folder Utama

```
app/
resources/views/
routes/web.php
public/uploads/sepatu/
database/migrations/
```

## ⚙️ Instalasi & Setup

### 1. Clone Repository
```
git clone https://github.com/Felix473-Uz/uts-pemweb.git
cd uts-pemweb
```

### 2. Install Dependencies
```
composer install
```

### 3. Copy File Environment
```
cp .env.example .env
```

### 4. Generate Key
```
php artisan key:generate
```

### 5. Atur Database di .env
```
DB_DATABASE=laravel_sepatu
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Migrasi Database
```
php artisan migrate
```

### 7. Jalankan Server Laravel
```
php artisan serve
```

## 🛠️ Teknologi yang Digunakan

- Laravel 10
- Bootstrap
- Blade Templates
- MySQL
- Composer
- PHP 8+

## 🤝 Kontribusi

Pull request sangat diterima!  
Silakan fork repo ini dan ajukan perubahan.

## 🔒 Keamanan

Jika menemukan celah keamanan, laporkan secara pribadi kepada pengembang.

## 📄 Lisensi

Proyek ini menggunakan lisensi **MIT License**.
