# TODO: Fitur Laporan Realisasi Anggaran

## Plan Implementasi

### 1. Database Migration
- [ ] Buat migration untuk tabel `laporan_realisasi_anggarans`

### 2. Model
- [ ] Buat Model `LaporanRealisasiAnggaran.php`
- [ ] Tambah relationship & accessor

### 3. Controller
- [ ] Buat `LaporanRealisasiAnggaranController.php`
- [ ] CRUD methods: index, create, store, show, edit, update, destroy

### 4. Request Validation
- [ ] Buat `LaporanRealisasiRequest.php` dengan validation rules

### 5. Routes
- [ ] Tambah route di `web.php` dengan prefix `/admin/laporan-realisasi`

### 6. Views
- [ ] Buat `index.blade.php` - Daftar laporan
- [ ] Buat `create.blade.php` - Form create
- [ ] Buat `edit.blade.php` - Form edit
- [ ] Buat `show.blade.php` - Detail laporan

### 7. Menu Navigation
- [ ] Tambah link di sidebar admin

---

## Detail Fields untuk Laporan Realisasi Anggaran

| Field | Type | Description |
|-------|------|-------------|
| `id` | BigInt | Primary Key |
| `nama_kegiatan` | String | Nama kegiatan |
| `deskripsi` | Text | Deskripsi kegiatan |
| `anggaran` | Decimal(15,2) | Total anggaran |
| `tanggal_kegiatan` | Date | Tanggal pelaksanaan |
| `lokasi` | String | Lokasi kegiatan |
| `file_pendukung` | JSON | Array file (doc, foto, video) |
| `keterangan` | Text | Keterangan tambahan |
| `created_at` | Timestamp | |
| `updated_at` | Timestamp | |

## File Types yang Diizinkan
- Documents: pdf, doc, docx, xls, xlsx, ppt, pptx
- Images: jpg, jpeg, png, gif
- Videos: mp4, mov, avi

