# TODO: Fitur Arsip untuk Admin

## Plan Implementasi

### 1. Database Migration
- [x] Buat migration untuk menambahkan kolom `is_archived` dan `tanggal_arsip` di tabel `laporan_akhirs`

### 2. Model Updates (LaporanAkhir.php)
- [x] Update `$fillable` untuk menyertakan `is_archived` dan `tanggal_arsip`
- [x] Tambahkan casts untuk `tanggal_arsip`
- [x] Update scope `scopeArchived()` untuk menggunakan `is_archived`
- [x] Tambahkan scope `scopeNotArchived()` dan `scopeFilterByTab()`
- [x] Tambahkan method `isArchived()`, `archive()`, `unarchive()`, `toggleArchive()`

### 3. Controller Updates (ReportAdminController.php)
- [x] Tambahkan method `toggleArchive()` - arsip/buka arsip single
- [x] Tambahkan method `bulkArchive()` - arsip massal
- [x] Tambahkan method `bulkUnarchive()` - buka arsip massal
- [x] Update method `index()` untuk filter berdasarkan tab

### 4. Routes Updates (routes/web.php)
- [x] Tambahkan route untuk toggle archive
- [x] Tambahkan route untuk bulk archive
- [x] Tambahkan route untuk bulk unarchive

### 5. View Updates (admin/reports/index.blade.php)
- [x] Tambahkan tab filter: Semua, Menunggu, Diterima, Diarsipkan
- [x] Update stats cards untuk menampilkan jumlah arsip
- [x] Ganti kolom "Publikasi" menjadi "Arsip"
- [x] Tambahkan tombol arsip di kolom aksi
- [x] Update checkbox untuk bulk selection

### 6. Migrasi Database
- [x] Jalankan migrasi `php artisan migrate`

## Status
- [x] Plan dibuat
- [x] Implementasi selesai
- [x] Testing
- [x] Selesai

## Cara Penggunaan

1. **Arsipkan data tunggal**: Klik icon box di kolom aksi pada setiap baris data
2. **Buka arsip data**: Klik icon box yang sama pada data yang sudah diarsipkan
3. **Bulk arsip**: Centang data > Klik "Arsipkan" di baris yang muncul
4. **Bulk buka arsip**: Di tab "Diarsipkan", centang data > Klik "Buka Arsip"
5. **Filter data**: Klik tab di atas tabel untuk memfilter data berdasarkan status


