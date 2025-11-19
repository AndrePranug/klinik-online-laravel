# 🏥 Sistem Klinik Online

Aplikasi manajemen klinik berbasis web yang memungkinkan pasien untuk membuat janji temu dengan dokter dan mendapatkan antrian secara online, serta memudahkan dokter dan admin dalam mengelola jadwal praktik dan konsultasi.

---

## 📋 Daftar Isi

-   [Fitur Utama](#fitur-utama)
-   [Teknologi](#teknologi)
-   [Persyaratan Sistem](#persyaratan-sistem)
-   [Instalasi](#instalasi)
-   [Konfigurasi Email (Mailtrap)](#konfigurasi-email-mailtrap)
-   [Database Schema](#database-schema)
-   [Role & Permission](#role--permission)
-   [Fitur Detail](#fitur-detail)
-   [Penggunaan](#penggunaan)
-   [Troubleshooting](#troubleshooting)

---

## ✨ Fitur Utama

### 👤 Untuk Pasien

-   ✅ Registrasi dan login akun
-   ✅ Reset password via email
-   ✅ Melihat daftar dokter berdasarkan spesialisasi
-   ✅ Membuat janji temu dengan dokter
-   ✅ Melihat riwayat janji temu
-   ✅ Melihat diagnosis dan resep dari dokter

### 👨‍⚕️ Untuk Dokter

-   ✅ Reset password via email
-   ✅ Manajemen jadwal praktik (CRUD)
-   ✅ Melihat daftar janji temu pasien
-   ✅ Konfirmasi janji temu
-   ✅ Input diagnosis dan resep
-   ✅ Update status konsultasi
-   ✅ Dashboard statistik

### 👨‍💼 Untuk Admin

-   ✅ Reset password via email
-   ✅ Manajemen dokter (CRUD)
-   ✅ Manajemen spesialisasi (CRUD)
-   ✅ Manajemen user (CRUD)
-   ✅ Monitoring semua janji temu
-   ✅ Dashboard dengan statistik lengkap
-   ✅ Filter dan pencarian data

---

## 🛠️ Teknologi

| Kategori            | Teknologi                                |
| ------------------- | ---------------------------------------- |
| **Framework**       | Laravel 12.x                             |
| **Frontend**        | Blade Templates, Tailwind CSS, Alpine.js |
| **Database**        | MySQL 8.3                                |
| **Authentication**  | Laravel Breeze                           |
| **Authorization**   | Spatie Laravel Permission                |
| **Email Service**   | Mailtrap (Development)                   |
| **Package Manager** | Composer & NPM                           |
| **PHP Version**     | 8.3.22                                   |

---

## 💻 Persyaratan Sistem

| Software      | Versi Minimum |
| ------------- | ------------- |
| PHP           | >= 8.3        |
| MySQL         | >= 8.0        |
| Composer      | Latest        |
| Node.js & NPM | Latest        |
| Web Server    | Apache/Nginx  |

---

## 📦 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/klinik-online-laravel.git
cd klinik-online-laravel
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=klinik_online
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Import Database

Import file SQL yang disediakan:

```bash
mysql -u root -p klinik_online < klinik_online.sql
```

Atau melalui phpMyAdmin:

1. Buat database `klinik_online`
2. Import file `klinik_online.sql`

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Storage Link

```bash
php artisan storage:link
```

### 8. Jalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

---

## 📧 Konfigurasi Email (Mailtrap)

Sistem ini menggunakan Mailtrap untuk testing email di environment development, terutama untuk fitur **reset password**.

### Setup Mailtrap

1. **Buat Akun Mailtrap**

    - Kunjungi [https://mailtrap.io](https://mailtrap.io)
    - Daftar akun gratis (Free plan sudah cukup)
    - Verifikasi email Anda

2. **Dapatkan Kredensial SMTP**

    - Login ke dashboard Mailtrap
    - Pilih inbox Anda (atau buat inbox baru)
    - Klik tab **"SMTP Settings"**
    - Pilih **"Laravel 9+"** dari dropdown integrations
    - Copy kredensial yang diberikan

3. **Konfigurasi File `.env`**

Edit file `.env` dan tambahkan/update konfigurasi email:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@klinik-online.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**Ganti nilai berikut:**

-   `MAIL_USERNAME` → Username dari Mailtrap
-   `MAIL_PASSWORD` → Password dari Mailtrap

### Testing Email

Setelah konfigurasi, test dengan fitur reset password:

1. Buka halaman login
2. Klik **"Forgot Password?"**
3. Masukkan email user yang terdaftar (contoh: `patient@gmail.com`)
4. Klik **"Email Password Reset Link"**
5. Buka dashboard Mailtrap Anda
6. Email reset password akan muncul di inbox

### Email yang Dikirim Sistem

| Fitur                  | Deskripsi                                   | Template               |
| ---------------------- | ------------------------------------------- | ---------------------- |
| **Password Reset**     | Email berisi link untuk reset password      | `auth.passwords.email` |
| **Email Verification** | Verifikasi email saat registrasi (opsional) | `auth.verify-email`    |

### Konfigurasi untuk Production

#### Menggunakan Gmail SMTP:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@klinik-online.com"
MAIL_FROM_NAME="Klinik Online"
```

#### Menggunakan SendGrid:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@klinik-online.com"
MAIL_FROM_NAME="Klinik Online"
```

### Test Email Manual

```bash
php artisan tinker
```

```php
Mail::raw('Test email from Klinik Online', function ($message) {
    $message->to('test@example.com')
            ->subject('Test Email');
});
```

Cek inbox Mailtrap Anda untuk melihat email test.

---

## 🗄️ Database Schema

### Tabel Users

| Kolom               | Tipe Data    | Keterangan                         |
| ------------------- | ------------ | ---------------------------------- |
| `id`                | bigint       | Primary Key, AUTO_INCREMENT        |
| `name`              | varchar(255) | Nama lengkap user                  |
| `email`             | varchar(255) | Email (unique)                     |
| `email_verified_at` | timestamp    | Waktu verifikasi email (nullable)  |
| `password`          | varchar(255) | Password terenkripsi               |
| `phone`             | varchar(255) | Nomor telepon (nullable)           |
| `date_of_birth`     | date         | Tanggal lahir (nullable)           |
| `gender`            | enum         | 'male' atau 'female' (nullable)    |
| `address`           | text         | Alamat lengkap (nullable)          |
| `remember_token`    | varchar(100) | Token untuk remember me (nullable) |
| `created_at`        | timestamp    | Waktu dibuat (nullable)            |
| `updated_at`        | timestamp    | Waktu diupdate (nullable)          |

### Tabel Password_Reset_Tokens

| Kolom        | Tipe Data    | Keterangan                       |
| ------------ | ------------ | -------------------------------- |
| `email`      | varchar(255) | Email user (Primary Key)         |
| `token`      | varchar(255) | Token reset password terenkripsi |
| `created_at` | timestamp    | Waktu token dibuat (nullable)    |

**Note**: Token akan expired dalam 60 menit setelah dibuat.

### Tabel Specializations

| Kolom         | Tipe Data    | Keterangan                  |
| ------------- | ------------ | --------------------------- |
| `id`          | bigint       | Primary Key, AUTO_INCREMENT |
| `name`        | varchar(255) | Nama spesialisasi           |
| `description` | text         | Deskripsi (nullable)        |
| `created_at`  | timestamp    | Waktu dibuat (nullable)     |
| `updated_at`  | timestamp    | Waktu diupdate (nullable)   |

### Tabel Doctors

| Kolom               | Tipe Data     | Keterangan                        |
| ------------------- | ------------- | --------------------------------- |
| `id`                | bigint        | Primary Key, AUTO_INCREMENT       |
| `user_id`           | bigint        | Foreign Key -> users.id           |
| `specialization_id` | bigint        | Foreign Key -> specializations.id |
| `license_number`    | varchar(255)  | Nomor izin praktik (unique)       |
| `bio`               | text          | Biografi dokter (nullable)        |
| `experience_years`  | int           | Tahun pengalaman (default: 0)     |
| `consultation_fee`  | decimal(10,2) | Biaya konsultasi                  |
| `photo`             | varchar(255)  | Path foto dokter (nullable)       |
| `created_at`        | timestamp     | Waktu dibuat (nullable)           |
| `updated_at`        | timestamp     | Waktu diupdate (nullable)         |

### Tabel Schedules

| Kolom           | Tipe Data    | Keterangan                       |
| --------------- | ------------ | -------------------------------- |
| `id`            | bigint       | Primary Key, AUTO_INCREMENT      |
| `doctor_id`     | bigint       | Foreign Key -> doctors.id        |
| `day`           | varchar(255) | Hari praktik (Senin-Minggu)      |
| `start_time`    | time         | Jam mulai praktik                |
| `end_time`      | time         | Jam selesai praktik              |
| `slot_duration` | int          | Durasi slot (menit, default: 30) |
| `created_at`    | timestamp    | Waktu dibuat (nullable)          |
| `updated_at`    | timestamp    | Waktu diupdate (nullable)        |

### Tabel Appointments

| Kolom              | Tipe Data    | Keterangan                                                            |
| ------------------ | ------------ | --------------------------------------------------------------------- |
| `id`               | bigint       | Primary Key, AUTO_INCREMENT                                           |
| `user_id`          | bigint       | Foreign Key -> users.id                                               |
| `doctor_id`        | bigint       | Foreign Key -> doctors.id                                             |
| `queue_number`     | varchar(255) | Nomor antrian                                                         |
| `appointment_date` | date         | Tanggal janji temu                                                    |
| `appointment_time` | time         | Waktu janji temu                                                      |
| `status`           | enum         | 'pending', 'confirmed', 'completed', 'cancelled' (default: 'pending') |
| `complaint`        | text         | Keluhan pasien (nullable)                                             |
| `diagnosis`        | text         | Diagnosis dokter (nullable)                                           |
| `prescription`     | text         | Resep obat (nullable)                                                 |
| `created_at`       | timestamp    | Waktu dibuat (nullable)                                               |
| `updated_at`       | timestamp    | Waktu diupdate (nullable)                                             |

### Tabel Roles (Spatie Permission)

| Kolom        | Tipe Data    | Keterangan                  |
| ------------ | ------------ | --------------------------- |
| `id`         | bigint       | Primary Key, AUTO_INCREMENT |
| `name`       | varchar(255) | Nama role                   |
| `guard_name` | varchar(255) | Guard name (default: 'web') |
| `created_at` | timestamp    | Waktu dibuat (nullable)     |
| `updated_at` | timestamp    | Waktu diupdate (nullable)   |

**Unique Constraint**: `name` + `guard_name`

### Tabel Permissions (Spatie Permission)

| Kolom        | Tipe Data    | Keterangan                  |
| ------------ | ------------ | --------------------------- |
| `id`         | bigint       | Primary Key, AUTO_INCREMENT |
| `name`       | varchar(255) | Nama permission             |
| `guard_name` | varchar(255) | Guard name (default: 'web') |
| `created_at` | timestamp    | Waktu dibuat (nullable)     |
| `updated_at` | timestamp    | Waktu diupdate (nullable)   |

**Unique Constraint**: `name` + `guard_name`

### Tabel Model_Has_Roles

| Kolom        | Tipe Data    | Keterangan              |
| ------------ | ------------ | ----------------------- |
| `role_id`    | bigint       | Foreign Key -> roles.id |
| `model_type` | varchar(255) | Nama model class        |
| `model_id`   | bigint       | ID dari model           |

**Primary Key**: (`role_id`, `model_id`, `model_type`)

### Tabel Role_Has_Permissions

| Kolom           | Tipe Data | Keterangan                    |
| --------------- | --------- | ----------------------------- |
| `permission_id` | bigint    | Foreign Key -> permissions.id |
| `role_id`       | bigint    | Foreign Key -> roles.id       |

**Primary Key**: (`permission_id`, `role_id`)

---

## 🔐 Role & Permission

### Roles yang Tersedia

| Role ID | Nama Role   | Deskripsi                                                                   |
| ------- | ----------- | --------------------------------------------------------------------------- |
| 1       | **Admin**   | Akses penuh ke sistem, manajemen dokter, spesialisasi, user, dan monitoring |
| 2       | **Doctor**  | Manajemen jadwal praktik, janji temu, diagnosis, dan resep                  |
| 3       | **Patient** | Melihat dokter, membuat janji temu, dan melihat riwayat konsultasi          |

### Permissions

#### Doctor Management

| Permission       | Admin | Doctor | Patient |
| ---------------- | ----- | ------ | ------- |
| `manage-doctors` | ✅    | ❌     | ❌      |
| `view-doctors`   | ✅    | ❌     | ✅      |
| `create-doctors` | ✅    | ❌     | ❌      |
| `edit-doctors`   | ✅    | ❌     | ❌      |
| `delete-doctors` | ✅    | ❌     | ❌      |

#### Specialization Management

| Permission               | Admin | Doctor | Patient |
| ------------------------ | ----- | ------ | ------- |
| `manage-specializations` | ✅    | ❌     | ❌      |
| `view-specializations`   | ✅    | ❌     | ❌      |
| `create-specializations` | ✅    | ❌     | ❌      |
| `edit-specializations`   | ✅    | ❌     | ❌      |
| `delete-specializations` | ✅    | ❌     | ❌      |

#### Appointment Management

| Permission                  | Admin | Doctor | Patient |
| --------------------------- | ----- | ------ | ------- |
| `manage-appointments`       | ✅    | ❌     | ❌      |
| `view-appointments`         | ✅    | ❌     | ❌      |
| `view-own-appointments`     | ❌    | ✅     | ✅      |
| `create-appointments`       | ❌    | ❌     | ✅      |
| `update-appointment-status` | ❌    | ✅     | ❌      |
| `add-diagnosis`             | ❌    | ✅     | ❌      |

#### Schedule Management

| Permission         | Admin | Doctor | Patient |
| ------------------ | ----- | ------ | ------- |
| `manage-schedules` | ❌    | ✅     | ❌      |
| `view-schedules`   | ❌    | ✅     | ❌      |
| `create-schedules` | ❌    | ✅     | ❌      |
| `edit-schedules`   | ❌    | ✅     | ❌      |
| `delete-schedules` | ❌    | ✅     | ❌      |

#### User Management

| Permission     | Admin | Doctor | Patient |
| -------------- | ----- | ------ | ------- |
| `manage-users` | ✅    | ❌     | ❌      |
| `view-users`   | ✅    | ❌     | ❌      |
| `create-users` | ✅    | ❌     | ❌      |
| `edit-users`   | ✅    | ❌     | ❌      |
| `delete-users` | ✅    | ❌     | ❌      |

### User Default

Database sudah berisi user default berikut:

#### Admin

| Field        | Value            |
| ------------ | ---------------- |
| **Nama**     | Admin Klinik     |
| **Email**    | admin@klinik.com |
| **Password** | password         |
| **Phone**    | 081234567890     |

#### Dokter 1

| Field                | Value            |
| -------------------- | ---------------- |
| **Nama**             | Dr. Budi Santoso |
| **Email**            | budi@klinik.com  |
| **Password**         | password         |
| **Spesialisasi**     | Umum             |
| **License**          | DOC001           |
| **Biaya Konsultasi** | Rp 100.000       |
| **Pengalaman**       | 10 tahun         |

#### Dokter 2

| Field                | Value                 |
| -------------------- | --------------------- |
| **Nama**             | Dr. Siti Aminah, Sp.A |
| **Email**            | siti@klinik.com       |
| **Password**         | password              |
| **Spesialisasi**     | Anak                  |
| **License**          | DOC002                |
| **Biaya Konsultasi** | Rp 150.000            |
| **Pengalaman**       | 8 tahun               |

#### Pasien 1

| Field             | Value              |
| ----------------- | ------------------ |
| **Nama**          | Ahmad Patient      |
| **Email**         | patient@gmail.com  |
| **Password**      | password           |
| **Phone**         | 081234567893       |
| **Tanggal Lahir** | 1990-01-01         |
| **Gender**        | Male               |
| **Alamat**        | Jl. Contoh No. 123 |

#### Pasien 2

| Field             | Value           |
| ----------------- | --------------- |
| **Nama**          | Sinta Harena    |
| **Email**         | sinta@gmail.com |
| **Password**      | password        |
| **Phone**         | 081927281936    |
| **Tanggal Lahir** | 2022-01-17      |
| **Gender**        | Female          |
| **Alamat**        | Jl. Keraton     |

### Data Spesialisasi

| ID  | Nama    | Deskripsi                          |
| --- | ------- | ---------------------------------- |
| 1   | Umum    | Dokter Umum                        |
| 2   | Gigi    | Dokter Spesialis Gigi              |
| 3   | Anak    | Dokter Spesialis Anak              |
| 4   | Jantung | Dokter Spesialis Jantung           |
| 5   | Kulit   | Dokter Spesialis Kulit dan Kelamin |

### Data Jadwal Dokter

#### Dr. Budi Santoso (Dokter Umum)

| Hari  | Jam Mulai | Jam Selesai | Durasi Slot |
| ----- | --------- | ----------- | ----------- |
| Senin | 08:00     | 12:00       | 30 menit    |
| Rabu  | 13:00     | 17:00       | 30 menit    |

#### Dr. Siti Aminah, Sp.A (Dokter Anak)

| Hari   | Jam Mulai | Jam Selesai | Durasi Slot |
| ------ | --------- | ----------- | ----------- |
| Selasa | 09:00     | 13:00       | 30 menit    |
| Kamis  | 14:00     | 18:00       | 30 menit    |

---

## 🎯 Fitur Detail

### 1. Sistem Autentikasi

-   Login/Register dengan Laravel Breeze
-   Email verification (opsional)
-   Password reset via email (Mailtrap)
-   Profile management

### 2. Dashboard Admin

-   📊 Statistik real-time:
    -   Total pasien
    -   Total dokter
    -   Total janji temu
    -   Janji temu menunggu konfirmasi
-   🎨 Quick actions untuk akses cepat
-   📋 Tabel janji temu terbaru
-   🎨 Modern UI dengan gradient dan animasi

### 3. Manajemen Dokter (Admin)

-   ➕ Tambah dokter baru dengan form lengkap
-   ✏️ Edit informasi dokter
-   🗑️ Hapus dokter
-   🔍 Filter dan pencarian
-   📄 Pagination
-   💳 Info: nama, spesialisasi, biaya konsultasi, pengalaman, bio

### 4. Manajemen Spesialisasi (Admin)

-   ➕ Tambah spesialisasi baru
-   ✏️ Edit spesialisasi
-   🗑️ Hapus spesialisasi
-   📊 Jumlah dokter per spesialisasi
-   🎨 Card-based layout

### 5. Manajemen Jadwal (Dokter)

-   📅 Atur jadwal praktik per hari (Senin-Minggu)
-   ⏰ Set waktu mulai dan selesai
-   🕐 Tentukan durasi slot konsultasi (default: 30 menit)
-   📊 Hitung otomatis jumlah slot tersedia

### 6. Booking Janji Temu (Pasien)

-   🔍 Pilih dokter berdasarkan spesialisasi
-   📅 Pilih tanggal konsultasi
-   ⏰ Pilih slot waktu yang tersedia
-   📝 Input keluhan
-   🎫 Generate nomor antrian otomatis

### 7. Manajemen Konsultasi (Dokter)

-   ✅ Konfirmasi janji temu
-   📋 Input diagnosis
-   💊 Input resep obat
-   ✔️ Tandai selesai konsultasi
-   ❌ Batalkan janji temu
-   📊 Filter berdasarkan status dan tanggal

### 8. Riwayat Konsultasi (Pasien)

-   📜 Lihat semua janji temu
-   🏷️ Status badge dengan warna berbeda
-   📄 Detail diagnosis dan resep
-   🔍 Filter berdasarkan status

### 9. Manajemen User (Admin)

-   ➕ Tambah user baru dengan role yang berbeda
-   ✏️ Edit informasi user
-   🗑️ Hapus user (dengan konfirmasi)
-   🔐 Reset password user
-   🔍 Filter berdasarkan role (Admin/Doctor/Patient)
-   🔎 Pencarian berdasarkan nama atau email

### 10. Reset Password

-   📧 Kirim link reset password via email
-   🔒 Token expired dalam 60 menit
-   ✉️ Email template profesional
-   🔐 Validasi token keamanan
-   ✅ Konfirmasi password baru

---

## 📖 Penggunaan

### Sebagai Admin

1. **Login** ke sistem dengan akun admin (`admin@klinik.com`, password: `password`)

2. **Dashboard**

    - Lihat statistik sistem secara real-time
    - Quick access ke fitur utama

3. **Kelola Dokter**:

    - Klik "Manajemen Dokter" di sidebar
    - Tambah dokter baru dengan klik "Tambah Dokter"
    - Edit atau hapus dokter yang ada
    - Filter berdasarkan spesialisasi

4. **Kelola Spesialisasi**:

    - Klik "Spesialisasi" di sidebar
    - Tambah spesialisasi baru
    - Edit atau hapus spesialisasi
    - Lihat jumlah dokter per spesialisasi

5. **Kelola User**:

    - Klik "Manajemen User" di sidebar
    - Tambah user baru (Admin/Doctor/Patient)
    - Edit atau hapus user
    - Filter berdasarkan role

6. **Monitor Janji Temu**:
    - Klik "Janji Temu" di sidebar
    - Filter berdasarkan status atau tanggal
    - Lihat detail setiap janji temu

### Sebagai Dokter

1. **Login** dengan akun dokter (`budi@klinik.com` atau `siti@klinik.com`, password: `password`)

2. **Atur Jadwal Praktik**:

    - Klik "Jadwal Praktik" di sidebar
    - Tambah jadwal untuk setiap hari
    - Tentukan waktu mulai dan selesai
    - Set durasi slot konsultasi

3. **Kelola Janji Temu**:

    - Lihat daftar janji temu di dashboard
    - Konfirmasi janji temu yang pending
    - Klik "Detail" untuk melihat info lengkap pasien

4. **Input Diagnosis**:
    - Buka detail janji temu
    - Klik "Selesaikan Konsultasi"
    - Input diagnosis dan resep obat
    - Simpan dan tandai sebagai selesai

### Sebagai Pasien

1. **Register** akun baru atau **Login** (`patient@gmail.com` atau `sinta@gmail.com`, password: `password`)

2. **Cari Dokter**:

    - Lihat daftar dokter di dashboard
    - Filter berdasarkan spesialisasi yang dibutuhkan
    - Lihat info dokter (bio, pengalaman, biaya konsultasi)

3. **Buat Janji Temu**:

    - Klik "Buat Janji" pada dokter pilihan
    - Pilih tanggal konsultasi
    - Pilih slot waktu yang tersedia
    - Isi keluhan Anda
    - Konfirmasi booking
    - Dapatkan nomor antrian

4. **Lihat Riwayat**:
    - Klik "Riwayat Konsultasi" di sidebar
    - Cek status janji temu (pending/confirmed/completed/cancelled)
    - Lihat diagnosis dan resep jika sudah selesai
    - Filter berdasarkan status

### Reset Password (Semua Role)

1. Di halaman login, klik **"Forgot Password?"**
2. Masukkan email yang terdaftar di sistem
3. Klik **"Email Password Reset Link"**
4. Buka email di **Mailtrap inbox** (development) atau email Anda (production)
5. Klik link reset password di email
6. Masukkan password baru (minimal 8 karakter)
7. Konfirmasi password baru
8. Klik **"Reset Password"**
9. Login dengan password baru Anda

**Note:** Link reset password akan expired dalam 60 menit. Jika sudah expired, request ulang.

---

## 🔧 Troubleshooting

### Error: Class 'Spatie\Permission\...' not found

```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

### Error: npm run dev tidak jalan

```bash
# Hapus folder node_modules dan package-lock.json
rm -rf node_modules package-lock.json

# Install ulang
npm install

# Build assets
npm run build
```

### Error: Storage link tidak berfungsi

```bash
# Buat symbolic link
php artisan storage:link

# Jika masih error, hapus link lama dulu
rm public/storage
php artisan storage:link
```

### Error: Permission denied

```bash
# Linux/Mac
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Atau
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Email tidak terkirim

| Masalah                     | Solusi                                                       |
| --------------------------- | ------------------------------------------------------------ |
| Connection refused          | Periksa `MAIL_HOST` dan `MAIL_PORT` di `.env`                |
| Authentication failed       | Verifikasi `MAIL_USERNAME` dan `MAIL_PASSWORD` dari Mailtrap |
| Email tidak muncul di inbox | Refresh halaman Mailtrap inbox, cek spam folder              |
| Link reset expired          | Link valid 60 menit, request link baru                       |
| Port blocked                | Cek firewall, pastikan port 2525 tidak diblokir              |

### Reset Password tidak bekerja

```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Test email configuration
php artisan tinker
Mail::raw('Test', function($m) { $m->to('test@test.com')->subject('Test'); });
```

### Database Import Error

| Masalah                  | Solusi                                        |
| ------------------------ | --------------------------------------------- |
| Database tidak ditemukan | Buat database `klinik_online` terlebih dahulu |
| Access denied            | Pastikan user MySQL memiliki privilege penuh  |
| Syntax error             | Pastikan menggunakan MySQL >= 8.0             |
| File corrupt             | Download ulang file SQL dari repository       |
| Character encoding       | Set charset ke `utf8mb4_unicode_ci`           |

### Clear All Cache

```bash
# Clear application cache
php artisan cache:clear

# Clear configuration cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear compiled views
php artisan view:clear

# Clear compiled classes
php artisan clear-compiled

# Optimize untuk production
php artisan optimize
```

### Rebuild Assets

```bash
# Development mode dengan hot reload
npm run dev

# Production build (minified)
npm run build

# Watch mode untuk development
npm run watch
```

---

## 📝 Changelog

### Version 1.1.0 (November 2025)

-   ✅ Added Mailtrap integration for email testing
-   ✅ Password reset functionality via email
-   ✅ Email template for password reset
-   ✅ Token expiration system (60 minutes)
-   ✅ Improved email configuration documentation

### Version 1.0.0 (November 2025)

-   ✅ Initial release
-   ✅ Multi-role system (Admin, Doctor, Patient)
-   ✅ Appointment management with queue system
-   ✅ Schedule management with slot duration
-   ✅ Doctor and specialization management
-   ✅ User management (CRUD)
-   ✅ Modern UI with Tailwind CSS
-   ✅ Fully responsive design
-   ✅ Dashboard with real-time statistics
-   ✅ Spatie Permission integration
-   ✅ Laravel Breeze authentication

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## 👥 Tim Pengembang

| Role          | Nama                                           | Kontak                 |
| ------------- | ---------------------------------------------- | ---------------------- |
| **Developer** | Andre Prahardiansyah Nugraha                   | andre.pranug@gmail.com |
| **GitHub**    | [@AndrePranug](https://github.com/AndrePranug) | -                      |

---

## 🙏 Acknowledgments

Terima kasih kepada:

-   **Laravel Framework** - PHP framework yang powerful dan elegant
-   **Spatie Laravel Permission** - Package untuk role dan permission management
-   **Tailwind CSS** - Utility-first CSS framework
-   **Alpine.js** - Lightweight JavaScript framework
-   **Heroicons** - Beautiful hand-crafted SVG icons
-   **MySQL** - Reliable database management system
-   **Mailtrap** - Email testing service

---

## 📞 Support

Jika ada pertanyaan, bug, atau saran, silakan hubungi:

| Channel           | Link/Contact                                                     |
| ----------------- | ---------------------------------------------------------------- |
| **GitHub Issues** | [Create Issue](https://github.com/username/klinik-online/issues) |
| **Email**         | andre.pranug@gmail.com                                           |
| **Documentation** | [Wiki](https://github.com/username/klinik-online/wiki)           |

---
