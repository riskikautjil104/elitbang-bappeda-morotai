<x-app>
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">
                            Form Laporan Akhir Kegiatan
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reports.admin.index') }}">Laporan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Form Laporan Akhir</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary-500/10 border-b border-primary-500/20">
                    <h5 class="text-lg font-semibold text-gray-800 dark:text-white mb-0">
                        Informasi Laporan Akhir E-Litbang
                    </h5>
                </div>
                <div class="card-body p-8">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Section 1: Informasi Umum Kegiatan -->
                        <div class="mb-10">
                            <div class="flex items-center mb-6">
                                <div class="h-10 w-1 bg-primary-500 mr-3"></div>
                                <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-0">
                                    Informasi Umum Kegiatan
                                </h4>
                            </div>

                            <div class="space-y-5">
                                <!-- Judul Kegiatan -->
                                <div>
                                    <label for="judul_kegiatan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Judul Kegiatan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" class="form-control h-12 text-base" id="judul_kegiatan"
                                        name="judul_kegiatan" placeholder="Masukkan judul kegiatan" required />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <!-- Jenis Kegiatan -->
                                    <div>
                                        <label for="jenis_kegiatan"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Jenis Kegiatan <span class="text-red-500">*</span>
                                        </label>
                                        <select class="form-select h-12 text-base" id="jenis_kegiatan"
                                            name="jenis_kegiatan" required>
                                            <option value="">Pilih jenis kegiatan</option>
                                            <option value="penelitian">Penelitian</option>
                                            <option value="inovasi">Inovasi</option>
                                            <option value="pengembangan">Pengembangan</option>
                                            <option value="kegiatan_lainnya">Kegiatan Lainnya</option>
                                        </select>
                                    </div>

                                    <!-- OPD Pengusul -->
                                    <div>
                                        <label for="opd_pengusul"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            OPD Pengusul <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" class="form-control h-12 text-base" id="opd_pengusul"
                                            name="opd_pengusul" placeholder="Nama OPD Pengusul" required />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <!-- Penanggung Jawab -->
                                    <div>
                                        <label for="penanggung_jawab"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Penanggung Jawab <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" class="form-control h-12 text-base" id="penanggung_jawab"
                                            name="penanggung_jawab" placeholder="Nama penanggung jawab" required />
                                    </div>

                                    <!-- Tahun Pelaksanaan -->
                                    <div>
                                        <label for="tahun_pelaksanaan"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Tahun Pelaksanaan <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" class="form-control h-12 text-base" id="tahun_pelaksanaan"
                                            name="tahun_pelaksanaan" placeholder="2024" min="2000" max="2100"
                                            required />
                                    </div>
                                </div>

                                <!-- Lokasi Kegiatan -->
                                <div>
                                    <label for="lokasi_kegiatan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Lokasi Kegiatan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" class="form-control h-12 text-base" id="lokasi_kegiatan"
                                        name="lokasi_kegiatan" placeholder="Lokasi pelaksanaan kegiatan" required />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <!-- Tanggal Mulai -->
                                    <div>
                                        <label for="tanggal_mulai"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Tanggal Mulai <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" class="form-control h-12 text-base" id="tanggal_mulai"
                                            name="tanggal_mulai" required />
                                    </div>

                                    <!-- Tanggal Selesai -->
                                    <div>
                                        <label for="tanggal_selesai"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Tanggal Selesai <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" class="form-control h-12 text-base" id="tanggal_selesai"
                                            name="tanggal_selesai" required />
                                    </div>

                                    <!-- Anggaran -->
                                    <div>
                                        <label for="anggaran"
                                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                            Anggaran (Rp) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" class="form-control h-12 text-base" id="anggaran"
                                            name="anggaran" placeholder="0" min="0" required />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Detail Kegiatan -->
                        <div class="mb-10">
                            <div class="flex items-center mb-6">
                                <div class="h-10 w-1 bg-primary-500 mr-3"></div>
                                <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-0">
                                    Detail Kegiatan
                                </h4>
                            </div>

                            <div class="space-y-5">
                                <!-- Latar Belakang -->
                                <div>
                                    <label for="latar_belakang"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Latar Belakang <span class="text-red-500">*</span>
                                    </label>
                                    <textarea class="form-control text-base" id="latar_belakang" name="latar_belakang" rows="5"
                                        placeholder="Jelaskan latar belakang kegiatan..." required></textarea>
                                    <p class="text-xs text-gray-500 mt-1">Minimal 100 karakter</p>
                                </div>

                                <!-- Tujuan Kegiatan -->
                                <div>
                                    <label for="tujuan_kegiatan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Tujuan Kegiatan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea class="form-control text-base" id="tujuan_kegiatan" name="tujuan_kegiatan" rows="4"
                                        placeholder="Jelaskan tujuan kegiatan..." required></textarea>
                                </div>

                                <!-- Metode Pelaksanaan -->
                                <div>
                                    <label for="metode_pelaksanaan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Metode Pelaksanaan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea class="form-control text-base" id="metode_pelaksanaan" name="metode_pelaksanaan" rows="5"
                                        placeholder="Jelaskan metode yang digunakan dalam pelaksanaan kegiatan..." required></textarea>
                                </div>

                                <!-- Tahapan Pelaksanaan -->
                                <div>
                                    <label for="tahapan_pelaksanaan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Tahapan Pelaksanaan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea class="form-control text-base" id="tahapan_pelaksanaan" name="tahapan_pelaksanaan" rows="6"
                                        placeholder="Jelaskan tahapan-tahapan pelaksanaan kegiatan secara rinci..." required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Hasil dan Evaluasi -->
                        <div class="mb-10">
                            <div class="flex items-center mb-6">
                                <div class="h-10 w-1 bg-primary-500 mr-3"></div>
                                <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-0">
                                    Hasil dan Evaluasi
                                </h4>
                            </div>

                            <div class="space-y-5">
                                <!-- Output Kegiatan -->
                                <div>
                                    <label for="output_kegiatan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Output Kegiatan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea class="form-control text-base" id="output_kegiatan" name="output_kegiatan" rows="4"
                                        placeholder="Jelaskan output/luaran yang dihasilkan dari kegiatan..." required></textarea>
                                </div>

                                <!-- Hasil Kegiatan -->
                                <div>
                                    <label for="hasil_kegiatan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Hasil Kegiatan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea class="form-control text-base" id="hasil_kegiatan" name="hasil_kegiatan" rows="5"
                                        placeholder="Jelaskan hasil kegiatan secara detail..." required></textarea>
                                </div>

                                <!-- Persentase Realisasi -->
                                <div>
                                    <label for="persentase_realisasi"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Persentase Realisasi (%) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="number" class="form-control h-12 text-base pr-12"
                                            id="persentase_realisasi" name="persentase_realisasi" placeholder="0"
                                            min="0" max="100" required />
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">%</span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Masukkan nilai 0-100</p>
                                </div>

                                <!-- Kendala Pelaksanaan -->
                                <div>
                                    <label for="kendala_pelaksanaan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Kendala Pelaksanaan
                                    </label>
                                    <textarea class="form-control text-base" id="kendala_pelaksanaan" name="kendala_pelaksanaan" rows="4"
                                        placeholder="Jelaskan kendala yang dihadapi selama pelaksanaan kegiatan (jika ada)..."></textarea>
                                </div>

                                <!-- Solusi Kendala -->
                                <div>
                                    <label for="solusi_kendala"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Solusi Kendala
                                    </label>
                                    <textarea class="form-control text-base" id="solusi_kendala" name="solusi_kendala" rows="4"
                                        placeholder="Jelaskan solusi yang diterapkan untuk mengatasi kendala (jika ada)..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Lampiran Dokumen -->
                        <div class="mb-10">
                            <div class="flex items-center mb-6">
                                <div class="h-10 w-1 bg-primary-500 mr-3"></div>
                                <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-0">
                                    Lampiran Dokumen
                                </h4>
                            </div>

                            <div class="space-y-5">
                                <!-- File Laporan PDF -->
                                <div>
                                    <label for="file_laporan_pdf"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        File Laporan (PDF) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" class="form-control h-12 text-base" id="file_laporan_pdf"
                                        name="file_laporan_pdf" accept=".pdf" required />
                                    <p class="text-xs text-gray-500 mt-1">Format: PDF, Maksimal 10MB</p>
                                </div>

                                <!-- File Dokumentasi -->
                                <div>
                                    <label for="file_dokumentasi"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        File Dokumentasi (Foto/Video) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file" class="form-control h-12 text-base" id="file_dokumentasi"
                                        name="file_dokumentasi[]" accept="image/*,video/*,.zip,.rar" multiple
                                        required />
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, MP4, atau ZIP/RAR,
                                        Maksimal 50MB</p>
                                </div>

                                <!-- File Data Pendukung -->
                                <div>
                                    <label for="file_data_pendukung"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        File Data Pendukung
                                    </label>
                                    <input type="file" class="form-control h-12 text-base"
                                        id="file_data_pendukung" name="file_data_pendukung[]"
                                        accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar" multiple />
                                    <p class="text-xs text-gray-500 mt-1">Format: PDF, Word, Excel, ZIP/RAR,
                                        Maksimal 20MB per file</p>
                                </div>

                                <!-- File SK -->
                                <div>
                                    <label for="file_sk"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        File SK (Surat Keputusan)
                                    </label>
                                    <input type="file" class="form-control h-12 text-base" id="file_sk"
                                        name="file_sk" accept=".pdf" />
                                    <p class="text-xs text-gray-500 mt-1">Format: PDF, Maksimal 5MB</p>
                                </div>

                                <!-- File PPT Pemaparan -->
                                <div>
                                    <label for="file_ppt_pemaparan"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        File Presentasi/Pemaparan
                                    </label>
                                    <input type="file" class="form-control h-12 text-base" id="file_ppt_pemaparan"
                                        name="file_ppt_pemaparan" accept=".ppt,.pptx,.pdf" />
                                    <p class="text-xs text-gray-500 mt-1">Format: PPT, PPTX, atau PDF, Maksimal
                                        20MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Alert Info -->
                        <div class="alert alert-primary border-primary-500/20 bg-primary-500/10 mb-8" role="alert">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-primary-500 mr-3 mt-0.5 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div class="text-sm">
                                    <strong class="font-semibold">Perhatian:</strong> Pastikan semua data yang
                                    diisi sudah benar dan lengkap. Field yang bertanda <span
                                        class="text-red-500">*</span> wajib diisi.
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div
                            class="flex flex-wrap gap-3 justify-end pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="button"
                                class="btn btn-outline-secondary rounded-lg px-8 h-12 text-base font-semibold">
                                Simpan Draft
                            </button>
                            <button type="reset"
                                class="btn btn-outline-danger rounded-lg px-8 h-12 text-base font-semibold">
                                Reset Form
                            </button>
                            <button type="submit"
                                class="btn btn-primary rounded-lg px-8 h-12 text-base font-semibold shadow-sm hover:shadow-md transition-all duration-200">
                                Submit Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
