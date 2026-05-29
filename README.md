# BrainPath Backend API

Repository ini berisi layanan Core REST API untuk aplikasi **BrainPath**, sebuah platform rekomendasi materi belajar berbasis AI yang membantu pengguna menemukan jalur belajar terpersonalisasi di bidang IT.

Backend ini dibangun menggunakan **Laravel 11** dan terintegrasi dengan layanan Frontend (Vue 3) serta Machine Learning Service (FastAPI).

---

## Fitur Utama Backend

1. **Authentication & User Management**: Sistem registrasi, login, dan logout aman berbasis token kustom memanfaatkan **Laravel Sanctum**.
2. **Onboarding & Preferensi**: Menyimpan preferensi belajar pengguna (tujuan belajar, pemahaman IT awal, kategori minat) saat pertama kali mendaftar.
3. **Manajemen Resource Kursus**: Operasi CRUD (Create, Read, Update, Delete) untuk materi eksternal (YouTube/sumber lain) yang dipublikasikan secara dinamis oleh Administrator.
4. **Progress Tracker & Evaluasi Kuis**: Pencatatan riwayat belajar pengguna secara real-time, termasuk pencatatan skor kuis interaktif yang tersinkronisasi.
5. **Admin Analytics**: Menyediakan visualisasi data statistik interaksi klik materi, rata-rata relevansi rekomendasi, dan distribusi kategori terpopuler untuk Dashboard Admin.
6. **AI Chatbot Bridge**: Menghubungkan interaksi tanya-jawab pengguna secara aman dari Frontend menuju FastAPI AI Service.

---

## Teknologi yang Digunakan

* **Framework**: Laravel 11
* **Bahasa**: PHP 8.x
* **Autentikasi**: Laravel Sanctum
* **Database**: PostgreSQL (Production) / SQLite / MySQL (Development)

---

## Persiapan Instalasi (Getting Started)

Ikuti langkah-langkah berikut untuk menjalankan layanan API Backend secara lokal:

### 1. Kloning Repositori & Instal Dependensi
```bash
composer install
```

### 2. Konfigurasi Environment File
Salin file `.env.example` menjadi `.env` dan sesuaikan kredensial database Anda:
```bash
cp .env.example .env
```

### 3. Generate Application Key
```bash
php artisan key:generate
```

### 4. Jalankan Migrasi & Database Seeder
Langkah ini akan membuat tabel dan menyemai (*seed*) data kursus awal beserta link video YouTube publik yang bebas dari proteksi penyematan (allow embedding):
```bash
php artisan migrate --seed
```

### 5. Jalankan Local Development Server
```bash
php artisan serve
```
Secara default, server backend akan berjalan di alamat `http://127.0.0.1:8000`.

---

## Dokumentasi API Endpoint Utama

Semua response API mengembalikan format JSON standar:
```json
{
  "success": true,
  "data": ...,
  "message": "Pesan status sukses"
}
```

### Auth Endpoints (Public)
* `POST /api/auth/register` : Mendaftarkan akun pengguna baru.
* `POST /api/auth/login` : Autentikasi pengguna dan mengembalikan token Sanctum.

### Protected Endpoints (Membutuhkan Bearer Token)
* `POST /api/auth/logout` : Menghapus token sesi aktif pengguna.
* `POST /api/onboarding/complete` : Menyimpan preferensi onboarding pertama kali.
* `GET /api/courses` : Mengambil daftar semua kursus yang tersedia.
* `GET /api/courses/{id}` : Mengambil rincian detail spesifik satu kursus beserta progres pengguna.
* `POST /api/courses/{id}/progress` : Mencatat progres belajar (status `in_progress` atau `completed` beserta parameter `score` kuis).
* `GET /api/courses/history` : Mengambil daftar materi yang sedang atau telah dipelajari pengguna (beserta data skor kuis).
* `GET /api/admin/analytics` : Mengambil ringkasan statistik klik rekomendasi dan kategori terpopuler untuk Panel Administrator.
* `POST /api/chatbot` : Gateway interaksi pesan chat langsung ke FastAPI AI Service.
