# Dokumentasi Penggunaan E-Litbang

Dokumen ini berisi panduan lengkap penggunaan sistem E-Litbang untuk dua peran utama:
1. **OPD** (Organisasi Perangkat Daerah) - Pengguna yang mengajukan laporan penelitian
2. **Admin** (Superadmin) - Pengelola sistem yang mengelola seluruh data

---

## 📋 Daftar Isi

1. [Panduan OPD](#-panduan-opd)
2. [Panduan Admin](#-panduan-admin)
3. [Fitur & Alur Kerja](#-fitur--alur-kerja)
4. [Tips & Troubleshooting](#-tips--troubleshooting)

---

# 📌 PANDUAN OPD

## 1. Login ke Sistem

### Cara Login:
1. Buka halaman depan E-Litbang
2. Klik tombol **"Login OPD"** di pojok kanan atas atau di footer
3. Masukkan **Email** dan **Password** yang sudah didaftarkan
4. Klik tombol **"Masuk"**

### Jika Lupa Password:
1. Klik link **"Lupa Password?"** di halaman login
2. Masukkan email yang terdaftar
3. Cek email untuk reset password
4. Buat password baru

---

## 2. Dashboard OPD

Setelah login, Anda akan melihat dashboard dengan menu:
- **Beranda** - Ringkasan aktivitas
- **Laporan** - Kelola laporan akhir kegiatan
- **Dokumen Perencanaan** - Lihat dokumen perencanaan (jika ada)
- **Ubah Password** - Ganti password akun

### Stats di Dashboard:
- Total Laporan yang sudah dibuat
- Laporan menunggu verifikasi
- Laporan diterima
- Laporan perlu revisi

---

## 3. Membuat Laporan Akhir Baru

### Langkah-langkah:

1. **Akses Menu Laporan**
   - Klik menu **"Laporan"** di sidebar kiri
   - Klik tombol **"+ Buat Laporan Baru"** atau **"Buat Laporan Akhir"**

2. **Isi Form Laporan**
   
   ### Data Kegiatan:
   | Field | Wajib | Keterangan |
   |-------|-------|------------|
   | Judul Kegiatan | ✓ | Judul penelitian/kajian |
   | Jenis Kegiatan | ✓ | Penelitian/Kajian/Pengembangan |
   | Tahun Pelaksanaan | ✓ | Tahun pelaksanaan kegiatan |
   | Penanggung Jawab | ✓ | Nama PJ kegiatan |
   
   ### Lokasi & Waktu:
   | Field | Wajib | Keterangan |
   |-------|-------|------------|
   | Lokasi | ✓ | Lokasi pelaksanaan |
   | Tanggal Mulai | ✓ | Tanggal mulai |
   | Tanggal Selesai | ✓ | Tanggal selesai |
   
   ### Dokumen:
   | Field | Wajib | Keterangan |
   |-------|-------|------------|
   | Abstrak | ✓ | Ringkasan kegiatan (max 5000 karakter) |
   | Latar Belakang | ✓ | Latar belakang masalah |
   | Tujuan | ✓ | Tujuan kegiatan |
   | Manfaat | ✓ | Manfaat yang diharapkan |
   | Metodologi | ✓ | Metode yang digunakan |
   | Hasil | ✓ | Hasil penelitian |
   | Kesimpulan | ✓ | Kesimpulan |
   | Saran | - | Saran untuk perbaikan |
   | File Laporan | ✓ | Upload file PDF/DOCX (max 10MB) |
   | File Pendukung | - | Upload file tambahan jika ada |

3. **Simpan Laporan**
   - Klik **"Simpan sebagai Draft"** jika belum siap提交
   - Klik **"Kirim untuk Verifikasi"** jika sudah lengkap

---

## 4. Status Laporan

Laporan Anda memiliki status berikut:

| Status | Ikon | Warna | Keterangan |
|--------|------|-------|------------|
| **Draft** | 📝 | Abu-abu | Laporan belum diajukan |
| **Menunggu Verifikasi** | ⏳ | Kuning | Menunggu review admin |
| **Revisi** | 🔧 | Oranye | Perlu perbaikan |
| **Diterima** | ✅ | Hijau | Laporan disetujui |
| **Ditolak** | ❌ | Merah | Laporan ditolak |

---

## 5. Mengedit Laporan

### Laporan dengan Status "Revisi":
1. Buka detail laporan
2. Klik tombol **"Edit"**
3. Perbaiki bagian yang diminta admin
4. Klik **"Kirim Ulang"** untuk resubmit

### Catatan:
- Laporan dengan status "Diterima" **tidak dapat diedit**
- Laporan dengan status "Menunggu Verifikasi" **tidak dapat diedit**

---

## 6. Export Laporan

Untuk mengunduh laporan:
1. Buka detail laporan
2. Klik tombol **"Download PDF"** atau **"Download Word"**
3. File akan terunduh otomatis

---

## 7. Fitur Search & Filter

### Search Laporan:
- Gunakan kotak pencarian untuk mencari berdasarkan:
  - Judul kegiatan
  - Penanggung jawab
  - Jenis kegiatan
  - Tahun

### Filter Laporan:
Gunakan dropdown filter untuk:
- Filter berdasarkan tahun
- Filter berdasarkan jenis kegiatan
- Filter berdasarkan status

---

## 8. Draft Laporan

### Menyimpan ke Draft:
Jika laporan belum lengkap, simpan sebagai draft:
1. Isi form laporan
2. Klik **"Simpan sebagai Draft"**
3. Laporan akan tersimpan dan bisa diedit nanti

### Melihat Draft:
1. Klik tab **"Draft"** di halaman laporan
2. Semua draft akan ditampilkan
3. Klik **"Lanjutkan Edit"** untuk melanjutkan

### Menghapus Draft:
1. Klik tombol **hapus** pada draft
2. Konfirmasi penghapusan
3. Draft akan dihapus permanen

---

## 9. Notifikasi

Sistem akan mengirim notifikasi untuk:
- Laporan diterima ✅
- Laporan perlu revisi 🔧
- Laporan ditolak ❌

Notifikasi muncul di:
- Tombol lonceng di pojok kanan atas
- Email (jika diaktifkan)

---

## 10. Ubah Password

Untuk keamanan, segera ubah password setelah login pertama:

1. Klik **"Ubah Password"** di sidebar
2. Masukkan **Password Lama**
3. Masukkan **Password Baru** (min 8 karakter)
4. Konfirmasi **Password Baru**
5. Klik **"Simpan"**

---

## 11. Dokumen Perencanaan (OPD)

Menu **Dokumen Perencanaan** di dashboard OPD berfungsi untuk melihat dan mengunduh dokumen perencanaan yang telah dipublikasikan oleh admin.

### Akses Dokumen:
1. Klik menu **"Dokumen Perencanaan"** di sidebar
2. Halaman akan menampilkan daftar dokumen yang tersedia

### Informasi yang Ditampilkan:
| Kolom | Deskripsi |
|-------|-----------|
| Judul | Nama dokumen perencanaan |
| Jenis | Jenis dokumen (RPJMD, RKPD, dll) |
| Tahun | Tahun dokumen |
| Tanggal Upload | Kapan dokumen diupload |
| Aksi | Tombol untuk download |

### Filter Dokumen:
- **Filter Jenis:** Filter berdasarkan jenis dokumen
- **Filter Tahun:** Filter berdasarkan tahun
- **Search:** Cari dokumen berdasarkan judul

### Download Dokumen:
1. Temukan dokumen yang ingin diunduh
2. Klik tombol **"Download"** atau icon download
3. File akan terunduh ke perangkat Anda

### Maksud & Tujuan:
- **Tujuan:** Memberikan akses kepada OPD untuk melihat dokumen perencanaan daerah sebagai acuan dalam penyusunan kegiatan penelitian dan pengembangan
- **Manfaat:** OPD dapat menyusun kegiatan yang selaras dengan perencanaan daerah

### Catatan:
- Hanya dokumen yang **dipublikasikan** oleh admin yang dapat dilihat
- OPD **tidak dapat** mengupload, mengedit, atau menghapus dokumen
- Jika ada dokumen yang salah, hubungi admin

---

## 12. Logout / Keluar

Untuk keluar dari sistem:

1. Klik nama pengguna di pojok kanan atas
2. Klik menu **"Logout"** atau **"Keluar"**
3. Konfirmasi logout jika diminta
4. Anda akan kembali ke halaman login

### Tips Keamanan:
- Selalu logout setelah selesai menggunakan sistem
- Jangan biarkan komputer tanpa pengawasan saat masih login
- Tutup browser setelah logout

---

# 📌 PANDUAN ADMIN

## 1. Login sebagai Admin

### Cara Login:
1. Buka halaman login
2. Masukkan kredensial admin (email & password)
3. Klik **"Masuk"**

### Kredensial Default:
- **Email:** admin@elitbang.go.id
- **Password:** (sesuaikan dengan setup awal)

---

## 2. Dashboard Admin

### Stats Cards:
| Metric | Deskripsi |
|--------|-----------|
| Total Laporan | Semua laporan di sistem |
| Menunggu Verifikasi | Laporan belum direview |
| Diterima | Laporan yang disetujui |
| Diarsipkan | Laporan yang diarsipkan |

### Notifikasi:
Notifikasi masuk akan ditampilkan di bagian atas dashboard

---

## 3. Manajemen Laporan

### Melihat Semua Laporan:
1. Klik menu **"Laporan Akhir"** di sidebar
2. Data laporan akan ditampilkan dalam tabel

### Tab Filter:
- **Semua** - Tampilkan semua laporan
- **Menunggu** - Laporan menunggu verifikasi
- **Diterima** - Laporan diterima
- **Diarsipkan** - Laporan yang diarsipkan

### Search & Filter:
- **Search:** Cari berdasarkan judul, OPD, PJ
- **Filter Tahun:** Filter berdasarkan tahun pelaksanaan
- **Filter Status:** Filter berdasarkan status

### Export Data:
1. Klik tombol **"Export"**
2. Pilih format (Excel/PDF)
3. Data akan terunduh

---

## 4. Verifikasi Laporan

### Menerima Laporan:
1. Klik tombol **"Lihat"** pada laporan
2. Review semua data dan file
3. Jika sudah sesuai, klik **"Terima"**
4. Isi feedback (opsional)
5. Konfirmasi

### Meminta Revisi:
1. Klik tombol **"Revisi"**
2. Berikan catatan revisi yang jelas
3. Klik **"Kirim"**
4. OPD akan mendapat notifikasi

### Menolak Laporan:
1. Klik tombol **"Tolak"**
2. Berikan alasan penolakan
3. Klik **"Konfirmasi"**

---

## 5. Menambah Laporan Manual

### Cara Tambah:
1. Klik tombol **"Tambah"**
2. Isi form yang sama seperti OPD
3. Klik **"Simpan"** atau **"Simpan & Kirim"**

### Catatan:
Biasanya admin tidak perlu menambah laporan manual, karena OPD yang input sendiri.

---

## 6. Edit Laporan

1. Klik tombol **"Edit"** pada laporan
2. Ubah data yang diperlukan
3. Klik **"Simpan Perubahan"**

### Batas Edit:
- Hanya edit laporan jika diperlukan koreksi data
- Perubahan akan tercatat di log sistem

---

## 7. Arsip Laporan

### Mengarsipkan:
1. Klik tombol **"Arsipkan"** pada laporan
2. Konfirmasi arsip
3. Laporan akan masuk ke tab "Diarsipkan"

### Membuka Arsip:
1. Buka tab **"Diarsipkan"**
2. Klik tombol **"Buka Arsip"**
3. Laporan akan kembali ke tab sebelumnya

---

## 8. Bulk Actions (Aksi Massal)

### Pilih Beberapa Laporan:
1. Centang checkbox di tabel
2. Pilih aksi:
   - **Bulk Publish** - Publish beberapa laporan
   - **Bulk Unpublish** - Unpublish beberapa laporan
   - **Bulk Archive** - Arsipkan beberapa laporan
   - **Bulk Unarchive** - Buka arsip beberapa laporan

---

## 9. Manajemen Users (OPD)

### Melihat Daftar OPD:
1. Klik menu **"Users"** di sidebar
2. Tabel menampilkan semua user OPD

### Info User:
- Nama lengkap
- Email
- OPD
- Tanggal registrasi
- Status

### Reset Password User:
1. Klik tombol **"Reset Password"**
2. Password akan di-reset ke default

---

## 10. Manajemen Roles

### Mengelola Roles:
1. Klik menu **"Roles"** di sidebar
2. Lihat daftar roles yang ada

### Role Default:
| Role | Deskripsi |
|------|-----------|
| superadmin | Akses penuh ke semua fitur |
| opd | User OPD untuk input laporan |
| admin | Admin terbatas |

---

## 11. Manajemen Dokumen Perencanaan

### Akses Menu:
1. Klik **"Dokumen Perencanaan"** di sidebar
2. Kelola dokumen perencanaan daerah

### Tambah Dokumen:
1. Klik **"Tambah Dokumen"**
2. Isi form:
   - Judul dokumen
   - Jenis dokumen
   - Tahun
   - Deskripsi
   - Upload file
3. Klik **"Simpan"**

### Publish/Unpublish:
- Klik tombol untuk publish/unpublish dokumen
- Hanya dokumen yang di-publish yang terlihat di frontend

---

## 12. Manajemen Tentang

### Edit Halaman Tentang:
1. Klik menu **"Tentang"** di sidebar
2. Edit konten tentang E-Litbang
3. Klik **"Simpan"**

### Urutan Konten:
- Gunakan fitur ordering untuk mengatur urutan

---

## 13. Manajemen Kontak

### Edit Info Kontak:
1. Klik menu **"Kontak"** di sidebar
2. Edit alamat, phone, email
3. Klik **"Simpan"**

---

## 14. Laporan Realisasi Anggaran

### Akses Menu:
1. Klik **"Laporan Realisasi Anggaran"** di sidebar
2. Kelola data realisasi anggaran

### Tambah Data:
1. Klik **"Tambah Data"**
2. Isi form:
   - OPD
   - Bulan/Tahun
   - Anggaran (Rp)
   - Realisasi (Rp)
   - Keterangan
3. Klik **"Simpan"**

### Edit & Hapus:
- Edit dan hapus data sesuai kebutuhan

---

## 15. Logout Admin

Untuk keluar dari panel admin:

1. Klik menu **"Logout"** di sidebar atau profile
2. Konfirmasi logout
3. Anda akan diarahkan ke halaman login

---

# 📌 FITUR & ALUR KERJA

## Alur Pengajuan Laporan OPD

```
┌─────────────────┐
│ 1. Buat Laporan │ ← OPD buat laporan baru
└────────┬────────┘
         ▼
┌─────────────────┐
│ 2. Simpan Draft │ ← Simpan dulu jika belum lengkap
└────────┬────────┘
         ▼
┌─────────────────┐
│ 3. Kirim untuk  │ ← Klik "Kirim untuk Verifikasi"
│    Verifikasi   │
└────────┬────────┘
         ▼
┌─────────────────┐
│ 4. Review Admin │ ← Admin review laporan
└────────┬────────┘
         ▼
    ┌────┴────┐
    │         │
    ▼         ▼
┌───────┐  ┌───────┐
│Diterima│  │ Revisi│
└────┬───┘  └───┬───┘
     │          │
     ▼          ▼
┌───────┐  ┌─────────────────┐
│ Publish│  │ OPD Edit Laporan│
│  di    │  │ sesuai catatan  │
│Web     │  └────────┬────────┘
└────────┘           │
                    ▼
              ┌───────────┐
              │ Kirim Ulang│
              └─────┬─────┘
                    ▼
              ┌───────────┐
              │Review Lagi│
              └───────────┘
```

## Status Laporan

```
┌─────────────────────────────────────────────────────────────┐
│                    Siklus Laporan                            │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  [DRAFT] ──► [MENUNGGU] ──► [REVIEW] ──► [DITERIMA/ DITOLAK]│
│     │              │              │            │             │
│     │              │              │            │             │
│     ▼              ▼              ▼            ▼             │
│  Belum     Sedang di      Admin         Laporan      Laporan│
│  lengkap    review       memberikan     disetujui    ditolak│
│                            feedback                   │
│                                                             │
│  [DRAFT] ◄─────────────[REVISI] ◄─────────[DITOLAK]────────│
│                     (Kembali ke OPD)                        │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

# 📌 TIPS & TROUBLESHOOTING

## Tips untuk OPD

### 1. Membuat Laporan yang Baik
- ✅ Gunakan judul yang jelas dan spesifik
- ✅ Isi abstrak dengan ringkas (200-500 kata)
- ✅ Sertakan metodologi yang jelas
- ✅ Upload file dengan format yang benar
- ✅ Review sebelum mengirim

### 2. Menghindari Kesalahan Umum
- ❌ Jangan upload file > 10MB
- ❌ Jangan biarkan field wajib kosong
- ❌ Jangan submit tanpa review
- ❌ Jangan lupa backup file asli

### 3. Jika Ada Revisi
- 📝 Baca catatan revisi dengan teliti
- 🔧 Perbaiki sesuai catatan
- ✅ Kirim ulang setelah lengkap

---

## Troubleshooting

### Masalah Login

| Masalah | Solusi |
|---------|--------|
| Password salah | Klik "Lupa Password" |
| Akun terkunci | Tunggu 15 menit atau hubungi admin |
| Email tidak terdaftar | Hubungi admin untuk registrasi |

### Masalah Upload File

| Masalah | Solusi |
|---------|--------|
| File terlalu besar | Kompress atau pecah file |
| Format tidak didukung | Gunakan PDF/DOCX |
| Upload gagal | Refresh halaman dan coba lagi |

### Masalah Notifikasi

| Masalah | Solusi |
|---------|--------|
| Email tidak masuk | Cek spam folder |
| Notifikasi tidak muncul | Refresh halaman |

### Masalah Tampilan

| Masalah | Solusi |
|---------|--------|
| Halaman tidak responsif | Gunakan browser terbaru |
| Data tidak muncul | Refresh halaman |
| Tombol tidak berfungsi | Clear cache browser |

---

## Kontak Dukungan

Jika mengalami masalah yang tidak teratasi:
1. Hubungi admin melalui email: **admin@elitbang.go.id**
2. Gunakan menu **Kontak** di frontend
3. Kirim ticket melalui sistem

---

## Catatan Penting

⚠️ **Keamanan:**
- Jangan berikan password kepada siapa pun
- Gunakan password yang kuat
- Logout setelah selesai menggunakan sistem

⚠️ **Backup:**
- Simpan file laporan asli di tempat aman
- Backup data secara berkala

⚠️ **Deadline:**
- Perhatikan deadline pengajuan laporan
- Kirim laporan lebih awal untuk antisipasi revisi

---

**Versi Dokumen:** 1.0  
**Terakhir Diperbarui:** 2025  
**Sistem:** E-Litbang Laravel

