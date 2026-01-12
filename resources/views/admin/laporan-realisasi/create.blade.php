<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">
                            Tambah Laporan Realisasi Anggaran
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.laporan-realisasi.index') }}">Laporan
                                Realisasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
                        Formulir Laporan Realisasi Anggaran
                    </h5>
                </div>

                <form action="{{ route('admin.laporan-realisasi.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

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
                                        value="{{ old('nama_kegiatan') }}" placeholder="Masukkan nama kegiatan"
                                        required>
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
                                        value="{{ old('tanggal_kegiatan') }}">
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
                                        value="{{ old('lokasi') }}" placeholder="Masukkan lokasi kegiatan">
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
                                        placeholder="Jelaskan deskripsi kegiatan">{{ old('deskripsi') }}</textarea>
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
                                            value="{{ old('anggaran', 0) }}" min="0" step="0.01" required>
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
                                            value="{{ old('realisasi', 0) }}" min="0" step="0.01" required>
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
                                            value="0%" readonly>
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
                                        value="{{ old('keterangan') }}" placeholder="Catatan tambahan">
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

                            <!-- Preview Files -->
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
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    '<div class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-2">File yang dipilih:</div>';
            }

            Array.from(files).forEach((file, index) => {
                const fileIcon = getFileIcon(file.name);
                const fileSize = formatFileSize(file.size);

                const fileItem = document.createElement('div');
                fileItem.className =
                    'flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-800 rounded mb-2';
                fileItem.innerHTML = `
               <div class="flex items-center gap-2">
                  ${fileIcon}
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

        function getFileIcon(filename) {
            const ext = filename.split('.').pop().toLowerCase();

            if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                return `<svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>`;
            } else if (['mp4', 'mov', 'avi'].includes(ext)) {
                return `<svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>`;
            } else {
                return `<svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>`;
            }
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
    </script>
</x-app>
