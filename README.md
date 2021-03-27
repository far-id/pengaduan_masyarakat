<p align="center"><img src="https://laravel.com/img/logotype.min.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Daftar isi

- [Daftar isi](#daftar-isi).
- [Installasi](#installasi).
- [Link youtube](https://youtu.be/brYfkMhah3g).
- [Link laporan](https://drive.google.com/file/d/16Nx5KXjJX_no_QEtTZo9IGMmcoHGGSHV/view?usp=sharing).
- [User](#user).
- [Fitur](#Fitur).


## Installasi

- jalankan di CMD/Terminal `composer install`
- duplikat file `.env.example` dan ubah namanya menjadi `.env`
- Sesuaikan konfigurasi database di dalam file `.env`
- Jalankan di CMD/Terminal
```
php artisan key:generate
php artisan migrate
php artisan db:seed

php artisan serve
```

## User

Terdapat 3 role yang tersedia :
- Admin
- Petugas
- Masyarakat

Username & Password untuk login:
- admin & password
- petugas & password
- masyarakat & password

## Fitur

- Rest API Server
- Auth
- CRUD
  - Pengaduan & Aspirasi
  - Tanggapan
  - Kegiatan
  - Data Masyarakat
  - Data Petugas
  - PDF
