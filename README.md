# 🏥 Sistem Klinik Online

Aplikasi manajemen klinik berbasis web yang memungkinkan pasien untuk membuat janji temu dengan dokter dan mendapatkan antrian secara online, serta memudahkan dokter dan admin dalam mengelola jadwal praktik dan konsultasi.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi](#teknologi)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Database Schema](#database-schema)
- [Role & Permission](#role--permission)
- [Fitur Detail](#fitur-detail)
- [Screenshot](#screenshot)
- [Penggunaan](#penggunaan)
- [Troubleshooting](#troubleshooting)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

## ✨ Fitur Utama

### 👤 Untuk Pasien
- ✅ Registrasi dan login akun
- ✅ Melihat daftar dokter berdasarkan spesialisasi
- ✅ Membuat janji temu dengan dokter
- ✅ Melihat riwayat janji temu
- ✅ Melihat diagnosis dan resep dari dokter

### 👨‍⚕️ Untuk Dokter
- ✅ Manajemen jadwal praktik (CRUD)
- ✅ Melihat daftar janji temu pasien
- ✅ Konfirmasi janji temu
- ✅ Input diagnosis dan resep
- ✅ Update status konsultasi
- ✅ Dashboard statistik

### 👨‍💼 Untuk Admin
- ✅ Manajemen dokter (CRUD)
- ✅ Manajemen spesialisasi (CRUD)
- ✅ Monitoring semua janji temu
- ✅ Dashboard dengan statistik lengkap
- ✅ Filter dan pencarian data

## 🛠️ Teknologi

- **Framework**: Laravel 12.x
- **Frontend**: 
  - Blade Templates
  - Tailwind CSS 4.x
  - Alpine.js
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Authorization**: Spatie Laravel Permission
- **Package Manager**: Composer & NPM

## 💻 Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL >= 5.7
- Web Server (Apache/Nginx)

## 📦 Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/username/klinik-online.git
cd klinik-online
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

### 5. Migrasi Database & Seeder
```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder (termasuk role, permission, dan user default)
php artisan db:seed
```

### 6. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## ⚙️ Konfigurasi

### Storage Link

Buat symbolic link untuk storage:
```bash
php artisan storage:link
```

### Cache Optimization (Production)
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🗄️ Database Schema

### Tabel Users
```sql
- id (bigint, PK)
- name (varchar)
- email (varchar, unique)
- email_verified_at (timestamp, nullable)
- password (varchar)
- phone (varchar, nullable)
- address (text, nullable)
- date_of_birth (date, nullable)
- gender (enum: male, female, nullable)
- remember_token (varchar, nullable)
- timestamps
```

### Tabel Specializations
```sql
- id (bigint, PK)
- name (varchar, unique)
- description (text, nullable)
- timestamps
```

### Tabel Doctors
```sql
- id (bigint, PK)
- user_id (bigint, FK -> users.id)
- specialization_id (bigint, FK -> specializations.id)
- license_number (varchar, unique)
- consultation_fee (decimal)
- experience_years (integer, nullable)
- education (text, nullable)
- timestamps
```

### Tabel Doctor_Schedules
```sql
- id (bigint, PK)
- doctor_id (bigint, FK -> doctors.id)
- day (enum: Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, Minggu)
- start_time (time)
- end_time (time)
- slot_duration (integer, default: 30)
- timestamps
```

### Tabel Appointments
```sql
- id (bigint, PK)
- user_id (bigint, FK -> users.id)
- doctor_id (bigint, FK -> doctors.id)
- appointment_date (date)
- appointment_time (time)
- queue_number (varchar)
- complaint (text)
- diagnosis (text, nullable)
- prescription (text, nullable)
- status (enum: pending, confirmed, completed, cancelled)
- timestamps
```

### Tabel Roles (Spatie Permission)
```sql
- id (bigint, PK)
- name (varchar)
- guard_name (varchar)
- timestamps
```

### Tabel Permissions (Spatie Permission)
```sql
- id (bigint, PK)
- name (varchar)
- guard_name (varchar)
- timestamps
```

### Tabel Model_Has_Roles
```sql
- role_id (bigint, FK)
- model_type (varchar)
- model_id (bigint)
```

### Tabel Role_Has_Permissions
```sql
- permission_id (bigint, FK)
- role_id (bigint, FK)
```

## 🔐 Role & Permission

### Roles yang Tersedia

1. **Admin**
   - Akses penuh ke sistem
   - Manajemen dokter
   - Manajemen spesialisasi
   - Monitoring semua janji temu
   - Dashboard admin

2. **Doctor (Dokter)**
   - Manajemen jadwal praktik sendiri
   - Melihat janji temu pasien
   - Konfirmasi dan kelola konsultasi
   - Input diagnosis dan resep
   - Dashboard dokter

3. **Patient (Pasien)**
   - Melihat daftar dokter
   - Membuat janji temu
   - Melihat riwayat konsultasi
   - Dashboard pasien

### Permissions
```php
// Doctor Management
'manage-doctors'
'view-doctors'
'create-doctors'
'edit-doctors'
'delete-doctors'

// Specialization Management
'manage-specializations'
'view-specializations'
'create-specializations'
'edit-specializations'
'delete-specializations'

// Appointment Management
'manage-appointments'
'view-appointments'
'view-own-appointments'
'create-appointments'
'update-appointment-status'
'add-diagnosis'

// Schedule Management
'manage-schedules'
'view-schedules'
'create-schedules'
'edit-schedules'
'delete-schedules'
```

### User Default

Setelah menjalankan seeder, akan tersedia:

**Admin:**
- Email: `admin@klinik.com`
- Password: `password`

**Dokter:**
- Email: `dokter@klinik.com`
- Password: `password`

**Pasien:**
- Email: `pasien@klinik.com`
- Password: `password`

## 🎯 Fitur Detail

### 1. Sistem Autentikasi
- Login/Register dengan Laravel Breeze
- Email verification
- Password reset
- Profile management

### 2. Dashboard Admin
- 📊 Statistik real-time:
  - Total pasien
  - Total dokter
  - Total janji temu
  - Janji temu menunggu konfirmasi
- 🎨 Quick actions untuk akses cepat
- 📋 Tabel janji temu terbaru
- 🎨 Modern UI dengan gradient dan animasi

### 3. Manajemen Dokter (Admin)
- ➕ Tambah dokter baru dengan form lengkap
- ✏️ Edit informasi dokter
- 🗑️ Hapus dokter
- 🔍 Filter dan pencarian
- 📄 Pagination
- 💳 Info: nama, spesialisasi, biaya konsultasi, pengalaman

### 4. Manajemen Spesialisasi (Admin)
- ➕ Tambah spesialisasi baru
- ✏️ Edit spesialisasi
- 🗑️ Hapus spesialisasi
- 📊 Jumlah dokter per spesialisasi
- 🎨 Card-based layout

### 5. Manajemen Jadwal (Dokter)
- 📅 Atur jadwal praktik per hari
- ⏰ Set waktu mulai dan selesai
- 🕐 Tentukan durasi slot konsultasi (15/30/45/60 menit)
- 📊 Hitung otomatis jumlah slot tersedia
- 🎨 Card layout dengan visual yang menarik

### 6. Booking Janji Temu (Pasien)
- 🔍 Pilih dokter berdasarkan spesialisasi
- 📅 Pilih tanggal konsultasi
- ⏰ Pilih slot waktu yang tersedia
- 📝 Input keluhan
- 🎫 Generate nomor antrian otomatis

### 7. Manajemen Konsultasi (Dokter)
- ✅ Konfirmasi janji temu
- 📋 Input diagnosis
- 💊 Input resep obat
- ✔️ Tandai selesai konsultasi
- ❌ Batalkan janji temu
- 📊 Filter berdasarkan status dan tanggal

### 8. Riwayat Konsultasi (Pasien)
- 📜 Lihat semua janji temu
- 🏷️ Status badge dengan warna berbeda
- 📄 Detail diagnosis dan resep
- 🔍 Filter berdasarkan status

## 🎨 UI/UX Features

### Modern Design
- ✨ Gradient backgrounds
- 🎯 Card-based layouts
- 🎨 Color-coded status badges
- 🌈 Smooth transitions dan hover effects
- 📱 Fully responsive design

### Interactive Elements
- 🔄 Animated pulse untuk pending status
- 🎭 Icon-based navigation
- 💫 Transform animations pada buttons
- 🎪 Glassmorphism effects
- 🖼️ Avatar dengan initial letters

### User Experience
- 🔙 Breadcrumb navigation
- 💡 Helper text dan tooltips
- ⚠️ Error messages yang informatif
- ✅ Success notifications
- 📊 Visual statistics cards
- 🔍 Advanced filtering

## 📸 Screenshots

### Dashboard Admin
```
- Stats cards dengan gradient
- Quick action buttons
- Recent appointments table
- Modern color scheme
```

### Manajemen Dokter
```
- Grid layout untuk dokter cards
- Filter dan search functionality
- Avatar dengan inisial
- Badge untuk spesialisasi
```

### Jadwal Praktik
```
- Calendar-based view
- Slot duration selector
- Available slots calculator
- Day-wise schedule cards
```

### Form Konsultasi
```
- Patient info banner
- Diagnosis textarea dengan icon
- Prescription textarea
- Auto-save functionality
```

## 📖 Penggunaan

### Sebagai Admin

1. **Login** ke sistem dengan akun admin
2. **Dashboard** - Lihat statistik sistem
3. **Kelola Dokter**:
   - Klik "Manajemen Dokter" di sidebar
   - Tambah dokter baru dengan klik "Tambah Dokter"
   - Edit atau hapus dokter yang ada
4. **Kelola Spesialisasi**:
   - Klik "Spesialisasi" di sidebar
   - Tambah spesialisasi baru
   - Edit atau hapus spesialisasi
5. **Monitor Janji Temu**:
   - Klik "Janji Temu" di sidebar
   - Filter berdasarkan status atau tanggal
   - Lihat detail setiap janji temu

### Sebagai Dokter

1. **Login** dengan akun dokter
2. **Atur Jadwal Praktik**:
   - Klik "Jadwal Praktik" di sidebar
   - Tambah jadwal untuk setiap hari
   - Tentukan waktu dan durasi slot
3. **Kelola Janji Temu**:
   - Lihat daftar janji temu di dashboard
   - Konfirmasi janji temu yang pending
   - Klik "Detail" untuk melihat info lengkap
4. **Input Diagnosis**:
   - Buka detail janji temu
   - Klik "Selesaikan Konsultasi"
   - Input diagnosis dan resep
   - Simpan dan selesaikan

### Sebagai Pasien

1. **Register** atau **Login**
2. **Cari Dokter**:
   - Pilih spesialisasi yang dibutuhkan
   - Lihat daftar dokter tersedia
3. **Buat Janji Temu**:
   - Klik "Buat Janji" pada dokter pilihan
   - Pilih tanggal dan waktu
   - Isi keluhan
   - Konfirmasi booking
4. **Lihat Riwayat**:
   - Cek status janji temu
   - Lihat diagnosis dan resep jika sudah selesai

## 🔧 Troubleshooting

### Error: Class 'Spatie\Permission\...' not found
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

### Error: npm run dev tidak jalan
```bash
npm install
npm run build
```

### Error: Storage link tidak berfungsi
```bash
php artisan storage:link
```

### Error: Permission denied
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```


## 📝 Changelog

### Version 1.0.0 (2025)
- ✅ Initial release
- ✅ Multi-role system (Admin, Doctor, Patient)
- ✅ Appointment management
- ✅ Schedule management
- ✅ Doctor and specialization management
- ✅ Modern UI with Tailwind CSS
- ✅ Responsive design
- ✅ Dashboard with statistics

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## 👥 Tim Pengembang

- **Developer**: Andre Prahardiansyah Nugraha
- **Email**: andre.pranug@gmail.com
- **GitHub**: [@AndrePranug](https://github.com/yourusername)

## 🙏 Acknowledgments

- Laravel Framework
- Spatie Laravel Permission
- Tailwind CSS
- Alpine.js
- Heroicons

## 📞 Support

Jika ada pertanyaan atau masalah, silakan:
- Buat [Issue](https://github.com/username/klinik-online/issues)
- Email: support@klinik.com
- Documentation: [Wiki](https://github.com/username/klinik-online/wiki)

---

**Dibuat dengan ❤️ menggunakan Laravel & Tailwind CSS**