# TODO: Ubah OPD Terproduktif menjadi OPD Terbaru

## Task
Mengubah tampilan section "OPD Terproduktif" di halaman beranda menjadi "OPD Terbaru" (berdasarkan tanggal input terbaru, bukan jumlah laporan).

## Files to Edit

### 1. app/Http/Controllers/Frontend/FrontendController.php
- [ ] Ubah query `$opdTerbaru` dari `orderByDesc('laporan_diterima_count')` menjadi `latest()`

### 2. resources/views/frondend/components/opdTerbaru.blade.php
- [ ] Ubah judul: "OPD Terproduktif" → "OPD Terbaru"
- [ ] Ubah deskripsi: "Organisasi Perangkat Daerah dengan kontribusi penelitian terbanyak" → "Organisasi Perangkat Daerah yang baru ditambahkan"
- [ ] Hapus ranking badge (gold/silver/bronze)
- [ ] Hapus statistik penelitian & terverifikasi
- [ ] Sederhanakan tampilan card

## Status
- [x] TODO Created
- [x] Controller Updated
- [x] View Updated
- [x] Completed

