<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">
                            Edit Laporan Realisasi Anggaran
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.laporan-realisasi.index') }}">Laporan
                                Realisasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-lg font-semibold text-gray-500 dark:text-gray-400">
                        Formulir Edit Laporan Realisasi Anggaran
                    </h5>
                </div>

                <form action="{{ route('admin.laporan-realisasi.update', encrypt($laporan->id)) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- Informasi Kegiatan -->
                        <div class="mb-6">
                            <h6 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-3">
                                Informasi Kegiatan
                            </h6>

                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- Nama Kegiatan -->
                                <div class="md:col-span-2">
                                    <label for="nama_kegiatan" class="form-label font-medium mb-1">
                                        Nama Kegiatan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                                        class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                        value="{{ old('nama_kegiatan', $laporan->nama_kegiatan) }}"
                                        placeholder="Masukkan nama kegiatan" required>
                                    @error('nama_kegiatan')
                                        <div class="invalid-feedback text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Kegiatan -->
                                <div>
                                    <label for="tanggal_kegiatan" class="form-label font-medium mb-1">
                                        Tanggal Kegiatan
                                    </label>
                                    <input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan"
                                        class="form-control @error('tanggal_kegiatan') is-invalid @enderror"
                                        value="{{ old('tanggal_kegiatan', $laporan->tanggal_kegiatan) }}">
                                    @error('tanggal_kegiatan')
                                        <div class="invalid-feedback text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Lokasi -->
                                <div>
                                    <label for="lokasi" class="form-label font-medium mb-1">
                                        Lokasi
                                    </label>
                                    <input type="text" id="lokasi" name="lokasi"
                                        class="form-control @error('lokasi') is-invalid @enderror"
                                        value="{{ old('lokasi', $laporan->lokasi) }}"
                                        placeholder="Masukkan lokasi kegiatan">
                                    @error('lokasi')
                                        <div class="invalid-feedback text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Deskripsi -->
                                <div class="md:col-span-2">
                                    <label for="deskripsi" class="form-label font-medium mb-1">
                                        Deskripsi Kegiatan
                                    </label>
                                    <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3"
                                        placeholder="Jelaskan deskripsi kegiatan">{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Anggaran -->
                        <div class="mb-6">
                            <h6 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-3">
                                Informasi Anggaran
                            </h6>

                            <div class="grid md:grid-cols-2 gap-4">
                                <!-- Anggaran -->
                                <div>
                                    <label for="anggaran" class="form-label font-medium mb-1">
                                        Total Anggaran (Rp) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                        <input type="number" id="anggaran" name="anggaran"
                                            class="form-control pl-8 @error('anggaran') is-invalid @enderror"
                                            value="{{ old('anggaran', $laporan->anggaran) }}" min="0"
                                            step="0.01" required>
                                    </div>
                                    @error('anggaran')
                                        <div class="invalid-feedback text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Realisasi -->
                                <div>
                                    <label for="realisasi" class="form-label font-medium mb-1">
                                        Total Realisasi (Rp) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                        <input type="number" id="realisasi" name="realisasi"
                                            class="form-control pl-8 @error('realisasi') is-invalid @enderror"
                                            value="{{ old('realisasi', $laporan->realisasi) }}" min="0"
                                            step="0.01" required>
                                    </div>
                                    @error('realisasi')
                                        <div class="invalid-feedback text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Persentase Realisasi (Auto Hitung) -->
                                <div>
                                    <label class="form-label font-medium mb-1">
                                        Persentase Realisasi
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="persentase_display" class="form-control bg-gray-100"
                                            value="{{ $laporan->persentase_realisasi }}%" readonly>
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">%</span>
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                <div>
                                    <label for="keterangan" class="form-label font-medium mb-1">
                                        Keterangan
                                    </label>
                                    <input type="text" id="keterangan" name="keterangan"
                                        class="form-control @error('keterangan') is-invalid @enderror"
                                        value="{{ old('keterangan', $laporan->keterangan) }}"
                                        placeholder="Catatan tambahan">
                                    @error('keterangan')
                                        <div class="invalid-feedback text-red-500 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- File Pendukung -->
                        <div class="mb-6">
                            <h6 class="text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase mb-3">
                                File Pendukung
                            </h6>

                            <!-- Existing Files -->
                            @php
                                $existingFiles = json_decode($laporan->file_pendukung ?? '[]', true);
                            @endphp

                            @if (count($existingFiles) > 0)
                                <div class="mb-4">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">File yang
                                        sudah ada:</p>
                                    <div class="space-y-2">
                                        @foreach ($existingFiles as $index => $file)
                                            <div
                                                class="flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-800 rounded">
                                                <div class="flex items-center gap-2">
                                                    @php
                                                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                                    @endphp

                                                    @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']))
                                                        <svg class="w-6 h-6 text-green-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    @elseif(in_array($ext, ['mp4', 'mov', 'avi']))
                                                        <svg class="w-6 h-6 text-purple-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-6 h-6 text-blue-500" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                            </path>
                                                        </svg>
                                                    @endif

                                                    <div>
                                                        <p
                                                            class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                            {{ basename($file) }}</p>
                                                        @php
                                                            $fileSize = file_exists(public_path('storage/' . $file))
                                                                ? filesize(public_path('storage/' . $file))
                                                                : 0;
                                                        @endphp
                                                        <p class="text-xs text-gray-500">
                                                            {{ number_format($fileSize / 1024, 0) }} KB</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                        class="text-blue-500 hover:text-blue-700">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <button type="button" class="text-red-500 hover:text-red-700"
                                                        onclick="deleteFile('{{ encrypt($laporan->id) }}', {{ $index }})">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Upload New Files -->
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center"
                                id="dropzone">
                                <input type="file" id="file_pendukung" name="file_pendukung[]"
                                    class="d-none @error('file_pendukung') is-invalid @enderror" multiple
                                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.gif,.mp4,.mov,.avi">

                                <label for="file_pendukung" class="cursor-pointer">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                    <p class="text-gray-600 dark:text-gray-400 mb-1">
                                        <span class="font-semibold text-primary-500">Klik untuk upload</span> atau drag
                                        & drop
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Documents (PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX) |
                                        Images (JPG, JPEG, PNG, GIF) |
                                        Videos (MP4, MOV, AVI)
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">Maksimal 50MB per file</p>
                                </label>
                            </div>

                            <!-- Preview New Files -->
                            <div id="file-preview" class="mt-4"></div>

                            @error('file_pendukung.*')
                                <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div
                        class="card-footer border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.laporan-realisasi.index') }}"
                                class="btn btn-outline-secondary px-4 py-2">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <svg class="w-4 h-4 mr-1.5 inline" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                    </path>
                                </svg>
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Auto hitung persentase
        const anggaranInput = document.getElementById('anggaran');
        const realisasiInput = document.getElementById('realisasi');
        const persentaseDisplay = document.getElementById('persentase_display');

        function hitungPersentase() {
            const anggaran = parseFloat(anggaranInput.value) || 0;
            const realisasi = parseFloat(realisasiInput.value) || 0;

            if (anggaran > 0) {
                const persentase = (realisasi / anggaran) * 100;
                persentaseDisplay.value = persentase.toFixed(1) + '%';
            } else {
                persentaseDisplay.value = '0%';
            }
        }

        anggaranInput.addEventListener('input', hitungPersentase);
        realisasiInput.addEventListener('input', hitungPersentase);

        // File preview
        const fileInput = document.getElementById('file_pendukung');
        const filePreview = document.getElementById('file-preview');
        const dropzone = document.getElementById('dropzone');

        fileInput.addEventListener('change', function(e) {
            previewFiles(this.files);
        });

        // Drag & drop
        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropzone.classList.add('border-primary-500', 'bg-primary-50');
        });

        dropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropzone.classList.remove('border-primary-500', 'bg-primary-50');
        });

        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropzone.classList.remove('border-primary-500', 'bg-primary-50');

            const files = e.dataTransfer.files;
            fileInput.files = files;
            previewFiles(files);
        });

        function previewFiles(files) {
            filePreview.innerHTML = '';

            if (files.length > 0) {
                filePreview.innerHTML =
                    '<div class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">File baru:</div>';
            }

            Array.from(files).forEach((file, index) => {
                const fileSize = formatFileSize(file.size);

                const fileItem = document.createElement('div');
                fileItem.className =
                    'flex items-center justify-between p-2 bg-blue-50 dark:bg-blue-900/20 rounded mb-2';
                fileItem.innerHTML = `
               <div class="flex items-center gap-2">
                  <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                  </svg>
                  <div>
                     <p class="text-sm font-medium text-gray-700 dark:text-gray-300">${file.name}</p>
                     <p class="text-xs text-gray-500">${fileSize}</p>
                  </div>
               </div>
               <button type="button" class="text-red-500 hover:text-red-700" onclick="removeFile(${index})">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                  </svg>
               </button>
            `;
                filePreview.appendChild(fileItem);
            });
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        function removeFile(index) {
            const dt = new DataTransfer();
            const input = document.getElementById('file_pendukung');

            for (let i = 0; i < input.files.length; i++) {
                if (i !== index) {
                    dt.items.add(input.files[i]);
                }
            }

            input.files = dt.files;
            previewFiles(input.files);
        }

        // Delete file function
        function deleteFile(laporanId, fileIndex) {
            Swal.fire({
                title: 'Hapus File?',
                text: "File akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/laporan-realisasi/${laporanId}/file/${fileIndex}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'File berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: data.message || 'Gagal menghapus file'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan sistem'
                            });
                        });
                }
            });
        }

        // SweetAlert untuk notifikasi
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('
                         success ') }}',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('
                         error ') }}',
                showConfirmButton: true,
                confirmButtonColor: '#dc2626'
            });
        @endif
    </script>
</x-app>
