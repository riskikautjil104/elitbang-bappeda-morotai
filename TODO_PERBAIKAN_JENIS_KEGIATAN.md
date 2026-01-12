# TODO: Perbaikan Jenis Kegiatan (4 Opsi)

## Target: Penelitian, Inovasi, Pengembangan, Kegiatan Lainnya

### Files yang perlu dicek/diperbaiki:

- [x] `resources/views/apps/reports/create.blade.php` - Dropdown jenis kegiatan (SUDAH DIPERBAIKI)
- [x] `resources/views/apps/reports/edit.blade.php` - Dropdown jenis kegiatan (SUDAH DIPERBAIKI)
- [x] `app/Models/LaporanAkhir.php` - Accessor sudah benar (sudah support 4 jenis kegiatan)

### Perubahan yang dilakukan:

#### create.blade.php:
```php
<!-- SEBELUM (BUG) -->
<option value="penelitian">Penelitian</option>
<option value="pengembangan">Inovasi</option> <!-- SALAH! -->

<!-- SESUDAH (BENAR) -->
<option value="penelitian" {{ old('jenis_kegiatan') == 'penelitian' ? 'selected' : '' }}>Penelitian</option>
<option value="inovasi" {{ old('jenis_kegiatan') == 'inovasi' ? 'selected' : '' }}>Inovasi</option>
<option value="pengembangan" {{ old('jenis_kegiatan') == 'pengembangan' ? 'selected' : '' }}>Pengembangan</option>
<option value="kegiatan_lainnya" {{ old('jenis_kegiatan') == 'kegiatan_lainnya' ? 'selected' : '' }}>Kegiatan Lainnya</option>
```

#### edit.blade.php:
```php
<!-- SEBELUM (BUG) -->
<option value="pengembangan" selected>Inovasi</option> <!-- SALAH! -->

<!-- SESUDAH (BENAR) -->
<option value="inovasi" selected>Inovasi</option>
<option value="pengembangan" selected>Pengembangan</option>
<option value="kegiatan_lainnya" selected>Kegiatan Lainnya</option>
```

### Status: ✅ SELESAI
### Tanggal: 2025-01-20
### Performed by: BLACKBOXAI

