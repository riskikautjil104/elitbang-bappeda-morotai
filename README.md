<div align="center">
  <img src="public/assets/images/logo.png" alt="ELITBANG Logo" width="200">
  <h1>ELITBANG</h1>
  <p>Sistem Informasi Pelaporan Akhir Kegiatan OPD</p>
</div>

---

## 📋 Deskripsi

**ELITBANG** adalah sistem informasi berbasis web untuk mengelola dan memonitor pelaporan akhir kegiatan Perangkat Daerah (OPD). Sistem ini memungkinkan OPD untuk submite laporan kegiatan, admin untuk melakukan verifikasi, dan menampilkan data kegiatan secara publik.

---

## 🛠️ Teknologi

| Teknologi | Deskripsi |
|-----------|-----------|
| **Laravel 12** | Framework PHP modern |
| **PHP 8.3** | Bahasa pemrograman server |
| **MySQL/SQLite** | Database |
| **Tailwind CSS** | Framework CSS |
| **ApexCharts** | Library untuk chart/visualisasi |
| **Spatie Permission** | Manajemen Role & Permission |
| **Laravel DomPDF** | Export PDF |
| **Maatwebsite Excel** | Export Excel |
| **PHPWord** | Export Word |

---

## 👥 Role & Permission

| Role | Deskripsi | Permission |
|------|-----------|------------|
| **superadmin** | Administrator sistem | create, read, update, delete |
| **opd** | Perangkat Daerah | create, read, update |

---

## 📊 Fitur Utama

### 🔐 Autentikasi
- Login/Logout
- Register user baru
- Lupa password & reset password
- Throttle login (maksimal 5 percobaan)

### 👨‍💼 Admin (Superadmin)
- **Dashboard**: Visualisasi statistik, trend, performa OPD
- **Manajemen User**: CRUD user OPD
- **Manajemen Role**: CRUD role & permission
- **Verifikasi Laporan**: Review & set status (diterima/revisi/ditolak)
- **Publish/Unpublish**: Tampilkan/sembunyikan laporan di frontend
- **Archive**: Arsipkan laporan lama
- **Export**: Export data ke PDF, Excel, Word
- **Manajemen Konten**: Tentang, Kontak, Dokumen Perencanaan

### 🏢 OPD (Perangkat Daerah)
- **Dashboard**: Statistik laporan OPD, performa, ranking
- **Kelola Laporan**: Create, Read, Update, Delete laporan
- **Draft System**: Simpan laporan sebagai draft sebelum submit
- **Upload File**: Upload file laporan, SK, dokumentasi, data pendukung
- **Dokumen Perencanaan**: Lihat dokumen perencanaan

### 🌐 Halaman Publik (Frontend)
- **Beranda**: Homepage dengan statistik, berita terbaru, OPD teraktif
- **Data**: Daftar semua laporan yang dipublikasikan
- **Detail Laporan**: Informasi lengkap kegiatan
- **OPD**: Daftar semua OPD dengan statistik
- **Detail OPD**: Laporan yang dibuat OPD tertentu
- **Tentang**: Informasi tentang aplikasi
- **Kontak**: Form kontak
- **Dokumen Perencanaan**: Daftar dokumen perencanaan

---

## 📂 Struktur Database

### **Users Table**
```php
- id, name, email, password
- role (via Spatie Permission)
- opd_id (foreign key ke tabel opds)
- nama_opd (nama OPD langsung)
- remember_token
```

### **LaporanAkhir Table** (Main Entity)
```php
- id, user_id (OPD pembuat)
- judul_kegiatan, jenis_kegiatan
- penanggung_jawab, tahun_pelaksanaan
- tanggal_mulai/selesai, lokasi_kegiatan
- anggaran, persentase_realisasi
- latar_belakang, tujuan_kegiatan
- metode_pelaksanaan, tahapan_pelaksanaan
- output_kegiatan, hasil_kegiatan
- kendala_pelaksanaan, solusi_kendala
- file_laporan, file_dokumentasi[], file_data_pendukung[]
- file_sk, file_pemaparan
- status: 'menunggu verifikasi' | 'diterima' | 'revisi' | 'ditolak' | 'draft'
- is_draft, is_published, is_archived
- verified_by, tanggal_verifikasi, catatan_admin
- created_at, updated_at
```

### **Opd Table**
```php
- id, nama_opd, kode_opd
- alamat, telepon
- created_at, updated_at
```

### **DokumenPerencanaan Table**
```php
- id, judul, jenis, deskripsi
- file_path, file_name, file_size, tahun
- status (published/draft), is_online
- visibility: 'semua_opd' | 'opd_terpilih'
- uploaded_by, published_at
- created_at, updated_at
```

### **Tentang Table**
```php
- id, judul, konten, gambar
- status (active/inactive)
- urutan
- created_at, updated_at
```

### **Kontak Table**
```php
- id, nama, email, subjek, pesan
- status (belum dibaca/sudah dibaca)
- created_at
```

---

## 🛣️ Route Utama

### **Public Routes**
```
GET  /                    -> Home page
GET  /data                -> Daftar semua laporan (published)
GET  /data/{id}           -> Detail laporan
GET  /opd                 -> Daftar OPD
GET  /opd/{id}            -> Detail OPD
GET  /tentang             -> Halaman Tentang
GET  /kontak              -> Halaman Kontak
GET  /dokumen-perencanaan -> Daftar dokumen
GET  /dokumen-perencanaan/{id} -> Detail dokumen
```

### **Auth Routes**
```
GET/POST /login           -> Login
POST /login/authenticate  -> Proses login (throttle: 5,1)
GET/POST /logout          -> Logout
GET /register             -> Register
POST /register            -> Proses register
GET /forgot-password      -> Lupa password
POST /reset-password      -> Reset password
```

### **Dashboard Routes**
```
GET  /dashboard           -> Redirect ke dashboard sesuai role
GET  /change-password     -> Ubah password (admin)
POST /change-password     -> Proses ubah password
GET  /change-password-opd -> Ubah password (OPD)
POST /change-password-opd -> Proses ubah password OPD
```

### **Admin Routes**
```
prefix /admin
├── /roles                    -> CRUD Role
├── /reports                  -> CRUD Laporan + Export
│   ├── togglePublish         -> Publish/Unpublish
│   ├── bulkPublish           -> Bulk publish
│   ├── toggleArchive         -> Archive/Unarchive
│   └── bulkArchive           -> Bulk archive
└── /users                    -> CRUD User

prefix /administrator/dashboard
├── /tentang                  -> CRUD Tentang
├── /kontak                   -> CRUD Kontak
└── /dokumen-perencanaan      -> CRUD Dokumen
```

### **Apps Routes (OPD)**
```
prefix /apps/reports
├── /                 -> Daftar laporan aktif
├── /drafts           -> Daftar draft
├── /create           -> Buat laporan baru
├── /{id}/show        -> Detail laporan
├── /{id}/edit        -> Edit laporan
├── /{id}/update      -> Proses update
└── /{id}/destroy     -> Hapus laporan
```

### **Export Routes**
```
GET /laporan/export/pdf/{id}   -> Export PDF
GET /laporan/export/word/{id}  -> Export Word
```

---

## 📈 Status Laporan

| Status | Deskripsi | Warna Badge |
|--------|-----------|-------------|
| **draft** | Simpanan draft | Info |
| **menunggu verifikasi** | Menunggu review admin | Warning |
| **diterima** | Laporan disetujui | Success |
| **revisi** | Perlu direvisi | Danger |
| **ditolak** | Laporan ditolak | Secondary |

---

## 🚀 Cara Menjalankan

### **1. Clone Repository**
```bash
git clone <repository-url>
cd elitbang
```

### **2. Install Dependencies**
```bash
composer install
npm install
```

### **3. Setup Environment**
```bash
cp .env.example .env
php artisan key:generate
```

### **4. Configure Database**
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elitbang
DB_USERNAME=root
DB_PASSWORD=
```

### **5. Run Migration & Seeder**
```bash
php artisan migrate --seed
```

### **6. Build Assets**
```bash
npm run build
```

### **7. Jalankan Server**
```bash
php artisan serve
```

Akses di: `http://localhost:8000`

---

## 👤 Default Accounts

| Role | Email | Password |
|------|-------|----------|
| Superadmin | admin@elitbang.test | password |
| OPD | opd@elitbang.test | password |

---

## 📁 Struktur Folder

```
app/
├── Exports/                  # Excel export classes
├── Http/
│   ├── Controllers/
│   │   ├── Admin/            # Admin controllers
│   │   ├── Auth/             # Auth controllers
│   │   ├── Dashboard/        # Dashboard controllers
│   │   ├── Frontend/         # Public pages
│   │   └── Opd/              # OPD specific
│   ├── Middleware/           # Custom middleware
│   ├── Notifications/        # Notification classes
│   └── Requests/             # Form requests
├── Models/                   # Eloquent models
└── Providers/                # Service providers

database/
├── migrations/               # Database migrations
└── seeders/                  # Database seeders

resources/views/
├── admin/                    # Admin pages
├── apps/reports/             # OPD report pages
├── auth/                     # Auth pages
├── components/               # Reusable components
├── dashboard/                # Dashboard views
├── exports/                  # Export templates
├── frondend/                 # Public pages
└── laporan/                  # PDF templates

routes/
└── web.php                   # Route definitions
```

---

## 📝 Lisensi

Proyek ini bersifat open-source dan dapat digunakan sesuai kebutuhan.

---

## 👨‍💻 Developer

Dikembangkan dengan ❤️ menggunakan Laravel

