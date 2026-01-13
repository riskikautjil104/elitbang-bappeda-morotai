<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Litbang - Panduan Lengkap</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin-bottom: 30px;
        }

        header h1 {
            color: #1e40af;
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        header p {
            color: #666;
            font-size: 1.1em;
        }

        .role-selector {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
            justify-content: center;
        }

        .role-btn {
            flex: 1;
            max-width: 300px;
            padding: 30px;
            background: white;
            border: 3px solid transparent;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .role-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .role-btn.active {
            border-color: #2563eb;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
        }

        .role-btn .icon {
            font-size: 3em;
            margin-bottom: 15px;
        }

        .role-btn h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .content-area {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            min-height: 500px;
        }

        .search-box {
            margin-bottom: 30px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .menu-card {
            padding: 25px;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(30, 58, 138, 0.3);
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(30, 58, 138, 0.5);
        }

        .menu-card .icon {
            font-size: 2.5em;
            margin-bottom: 15px;
        }

        .menu-card h4 {
            font-size: 1.3em;
            margin-bottom: 10px;
        }

        .menu-card p {
            opacity: 0.9;
            font-size: 0.95em;
        }

        .detail-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .detail-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-btn {
            display: inline-block;
            padding: 12px 30px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 20px;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: #1e40af;
            transform: translateX(-5px);
        }

        .section-title {
            color: #1e40af;
            font-size: 2em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #3b82f6;
        }

        .step-card {
            background: #eff6ff;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 20px;
            border-left: 5px solid #3b82f6;
        }

        .step-card h4 {
            color: #1e40af;
            font-size: 1.3em;
            margin-bottom: 15px;
        }

        .step-list {
            list-style: none;
            padding-left: 0;
        }

        .step-list li {
            padding: 10px 0;
            padding-left: 30px;
            position: relative;
        }

        .step-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #3b82f6;
            font-weight: bold;
            font-size: 1.2em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            font-weight: 600;
        }

        tr:hover {
            background: #eff6ff;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }

        .status-draft { background: #e0e0e0; color: #666; }
        .status-waiting { background: #fef3c7; color: #92400e; }
        .status-revision { background: #fed7aa; color: #c2410c; }
        .status-approved { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }

        .alert {
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            border-left: 5px solid;
        }

        .alert-info {
            background: #dbeafe;
            border-color: #3b82f6;
            color: #1e40af;
        }

        .alert-warning {
            background: #fef3c7;
            border-color: #f59e0b;
            color: #92400e;
        }

        .alert-success {
            background: #d1fae5;
            border-color: #10b981;
            color: #065f46;
        }

        @media (max-width: 768px) {
            .role-selector {
                flex-direction: column;
            }

            .role-btn {
                max-width: 100%;
            }

            .menu-grid {
                grid-template-columns: 1fr;
            }

            header h1 {
                font-size: 1.8em;
            }

            .content-area {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>📚 Panduan E-Litbang</h1>
            <p>Sistem Manajemen Penelitian dan Pengembangan Daerah</p>
        </header>

        <div class="role-selector">
            <div class="role-btn active" onclick="switchRole('opd')">
                <div class="icon">👤</div>
                <h3>Panduan OPD</h3>
                <p>Untuk Organisasi Perangkat Daerah</p>
            </div>
            <div class="role-btn" onclick="switchRole('admin')">
                <div class="icon">⚙️</div>
                <h3>Panduan Admin</h3>
                <p>Untuk Superadmin Sistem</p>
            </div>
        </div>

        <div class="content-area">
            <!-- OPD Content -->
            <div id="opd-content">
                <div id="opd-menu" class="menu-section">
                    <div class="search-box">
                        <input type="text" placeholder="Cari panduan...">
                        <span class="search-icon">🔍</span>
                    </div>

                    <div class="menu-grid">
                        <div class="menu-card" onclick="showDetail('opd-login')">
                            <div class="icon">🔐</div>
                            <h4>Login & Akses</h4>
                            <p>Cara login dan mengakses sistem</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('opd-dashboard')">
                            <div class="icon">📊</div>
                            <h4>Dashboard</h4>
                            <p>Memahami dashboard OPD</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('opd-laporan')">
                            <div class="icon">📝</div>
                            <h4>Buat Laporan</h4>
                            <p>Cara membuat laporan akhir</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('opd-status')">
                            <div class="icon">📋</div>
                            <h4>Status Laporan</h4>
                            <p>Memahami status laporan</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('opd-edit')">
                            <div class="icon">✏️</div>
                            <h4>Edit & Revisi</h4>
                            <p>Cara edit dan revisi laporan</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('opd-dokumen')">
                            <div class="icon">📄</div>
                            <h4>Dokumen Perencanaan</h4>
                            <p>Akses dokumen perencanaan</p>
                        </div>
                    </div>
                </div>

                <!-- Detail Sections OPD -->
                <div id="opd-login" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('opd')">← Kembali</button>
                    <h2 class="section-title">🔐 Login & Akses Sistem</h2>
                    
                    <div class="step-card">
                        <h4>Langkah Login</h4>
                        <ul class="step-list">
                            <li>Buka halaman depan E-Litbang</li>
                            <li>Klik tombol "Login OPD" di pojok kanan atas</li>
                            <li>Masukkan Email dan Password yang sudah didaftarkan</li>
                            <li>Klik tombol "Masuk"</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <strong>⚠️ Lupa Password?</strong><br>
                        Klik link "Lupa Password?" di halaman login → Masukkan email → Cek email untuk reset password
                    </div>

                    <div class="step-card">
                        <h4>Tips Keamanan</h4>
                        <ul class="step-list">
                            <li>Selalu logout setelah selesai menggunakan sistem</li>
                            <li>Jangan biarkan komputer tanpa pengawasan saat masih login</li>
                            <li>Gunakan password yang kuat (minimal 8 karakter)</li>
                            <li>Jangan bagikan password kepada siapa pun</li>
                        </ul>
                    </div>
                </div>

                <div id="opd-dashboard" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('opd')">← Kembali</button>
                    <h2 class="section-title">📊 Dashboard OPD</h2>
                    
                    <div class="step-card">
                        <h4>Menu Dashboard</h4>
                        <ul class="step-list">
                            <li><strong>Beranda</strong> - Ringkasan aktivitas dan statistik</li>
                            <li><strong>Laporan</strong> - Kelola laporan akhir kegiatan</li>
                            <li><strong>Dokumen Perencanaan</strong> - Lihat dokumen perencanaan</li>
                            <li><strong>Ubah Password</strong> - Ganti password akun</li>
                        </ul>
                    </div>

                    <div class="step-card">
                        <h4>Statistik Dashboard</h4>
                        <table>
                            <tr>
                                <th>Metrik</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>Total Laporan</td>
                                <td>Jumlah semua laporan yang pernah dibuat</td>
                            </tr>
                            <tr>
                                <td>Menunggu Verifikasi</td>
                                <td>Laporan yang sedang direview admin</td>
                            </tr>
                            <tr>
                                <td>Diterima</td>
                                <td>Laporan yang sudah disetujui</td>
                            </tr>
                            <tr>
                                <td>Perlu Revisi</td>
                                <td>Laporan yang memerlukan perbaikan</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div id="opd-laporan" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('opd')">← Kembali</button>
                    <h2 class="section-title">📝 Membuat Laporan Akhir</h2>
                    
                    <div class="step-card">
                        <h4>Langkah-Langkah</h4>
                        <ul class="step-list">
                            <li>Klik menu "Laporan" di sidebar kiri</li>
                            <li>Klik tombol "+ Buat Laporan Baru"</li>
                            <li>Isi semua field yang diperlukan</li>
                            <li>Upload file laporan (PDF/DOCX, max 10MB)</li>
                            <li>Pilih "Simpan sebagai Draft" atau "Kirim untuk Verifikasi"</li>
                        </ul>
                    </div>

                    <div class="step-card">
                        <h4>Field yang Wajib Diisi</h4>
                        <table>
                            <tr>
                                <th>Field</th>
                                <th>Wajib</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>Judul Kegiatan</td>
                                <td>✓</td>
                                <td>Judul penelitian/kajian</td>
                            </tr>
                            <tr>
                                <td>Jenis Kegiatan</td>
                                <td>✓</td>
                                <td>Penelitian/Kajian/Pengembangan</td>
                            </tr>
                            <tr>
                                <td>Tahun Pelaksanaan</td>
                                <td>✓</td>
                                <td>Tahun pelaksanaan kegiatan</td>
                            </tr>
                            <tr>
                                <td>Penanggung Jawab</td>
                                <td>✓</td>
                                <td>Nama PJ kegiatan</td>
                            </tr>
                            <tr>
                                <td>Abstrak</td>
                                <td>✓</td>
                                <td>Ringkasan (max 5000 karakter)</td>
                            </tr>
                            <tr>
                                <td>File Laporan</td>
                                <td>✓</td>
                                <td>PDF/DOCX (max 10MB)</td>
                            </tr>
                        </table>
                    </div>

                    <div class="alert alert-info">
                        <strong>💡 Tips Membuat Laporan Baik:</strong><br>
                        ✅ Gunakan judul yang jelas dan spesifik<br>
                        ✅ Isi abstrak dengan ringkas (200-500 kata)<br>
                        ✅ Sertakan metodologi yang jelas<br>
                        ✅ Review sebelum mengirim
                    </div>
                </div>

                <div id="opd-status" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('opd')">← Kembali</button>
                    <h2 class="section-title">📋 Status Laporan</h2>
                    
                    <div class="step-card">
                        <h4>Jenis-Jenis Status</h4>
                        <table>
                            <tr>
                                <th>Status</th>
                                <th>Icon</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-draft">Draft</span></td>
                                <td>📝</td>
                                <td>Laporan belum diajukan</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-waiting">Menunggu</span></td>
                                <td>⏳</td>
                                <td>Menunggu review admin</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-revision">Revisi</span></td>
                                <td>🔧</td>
                                <td>Perlu perbaikan</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-approved">Diterima</span></td>
                                <td>✅</td>
                                <td>Laporan disetujui</td>
                            </tr>
                            <tr>
                                <td><span class="status-badge status-rejected">Ditolak</span></td>
                                <td>❌</td>
                                <td>Laporan ditolak</td>
                            </tr>
                        </table>
                    </div>

                    <div class="alert alert-info">
                        <strong>ℹ️ Catatan Penting:</strong><br>
                        • Laporan dengan status "Diterima" tidak dapat diedit<br>
                        • Laporan dengan status "Menunggu Verifikasi" tidak dapat diedit<br>
                        • Hanya laporan "Revisi" dan "Draft" yang dapat diedit
                    </div>
                </div>

                <div id="opd-edit" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('opd')">← Kembali</button>
                    <h2 class="section-title">✏️ Edit & Revisi Laporan</h2>
                    
                    <div class="step-card">
                        <h4>Cara Mengedit Laporan</h4>
                        <ul class="step-list">
                            <li>Buka detail laporan yang akan diedit</li>
                            <li>Pastikan status laporan "Revisi" atau "Draft"</li>
                            <li>Klik tombol "Edit"</li>
                            <li>Perbaiki bagian yang diminta admin</li>
                            <li>Klik "Kirim Ulang" untuk resubmit</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <strong>⚠️ Penting saat Revisi:</strong><br>
                        📝 Baca catatan revisi dengan teliti<br>
                        🔧 Perbaiki sesuai catatan admin<br>
                        ✅ Review kembali sebelum kirim ulang
                    </div>

                    <div class="step-card">
                        <h4>Export Laporan</h4>
                        <ul class="step-list">
                            <li>Buka detail laporan</li>
                            <li>Klik tombol "Download PDF" atau "Download Word"</li>
                            <li>File akan terunduh otomatis</li>
                        </ul>
                    </div>
                </div>

                <div id="opd-dokumen" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('opd')">← Kembali</button>
                    <h2 class="section-title">📄 Dokumen Perencanaan</h2>
                    
                    <div class="step-card">
                        <h4>Mengakses Dokumen</h4>
                        <ul class="step-list">
                            <li>Klik menu "Dokumen Perencanaan" di sidebar</li>
                            <li>Lihat daftar dokumen yang tersedia</li>
                            <li>Gunakan filter untuk mencari dokumen spesifik</li>
                            <li>Klik tombol "Download" untuk mengunduh</li>
                        </ul>
                    </div>

                    <div class="step-card">
                        <h4>Informasi Dokumen</h4>
                        <table>
                            <tr>
                                <th>Kolom</th>
                                <th>Deskripsi</th>
                            </tr>
                            <tr>
                                <td>Judul</td>
                                <td>Nama dokumen perencanaan</td>
                            </tr>
                            <tr>
                                <td>Jenis</td>
                                <td>RPJMD, RKPD, dll</td>
                            </tr>
                            <tr>
                                <td>Tahun</td>
                                <td>Tahun dokumen</td>
                            </tr>
                            <tr>
                                <td>Tanggal Upload</td>
                                <td>Kapan dokumen diupload</td>
                            </tr>
                        </table>
                    </div>

                    <div class="alert alert-success">
                        <strong>✅ Tujuan:</strong><br>
                        Memberikan akses kepada OPD untuk melihat dokumen perencanaan daerah sebagai acuan dalam penyusunan kegiatan penelitian dan pengembangan
                    </div>
                </div>
            </div>

            <!-- Admin Content -->
            <div id="admin-content" style="display: none;">
                <div id="admin-menu" class="menu-section">
                    <div class="search-box">
                        <input type="text" placeholder="Cari panduan...">
                        <span class="search-icon">🔍</span>
                    </div>

                    <div class="menu-grid">
                        <div class="menu-card" onclick="showDetail('admin-login')">
                            <div class="icon">🔐</div>
                            <h4>Login Admin</h4>
                            <p>Akses panel admin</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('admin-dashboard')">
                            <div class="icon">📊</div>
                            <h4>Dashboard</h4>
                            <p>Overview sistem</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('admin-verifikasi')">
                            <div class="icon">✅</div>
                            <h4>Verifikasi Laporan</h4>
                            <p>Review & approve laporan</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('admin-users')">
                            <div class="icon">👥</div>
                            <h4>Manajemen Users</h4>
                            <p>Kelola akun OPD</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('admin-dokumen')">
                            <div class="icon">📁</div>
                            <h4>Dokumen Perencanaan</h4>
                            <p>Upload & kelola dokumen</p>
                        </div>
                        <div class="menu-card" onclick="showDetail('admin-bulk')">
                            <div class="icon">⚡</div>
                            <h4>Bulk Actions</h4>
                            <p>Aksi massal laporan</p>
                        </div>
                    </div>
                </div>

                <!-- Detail Sections Admin -->
                <div id="admin-login" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('admin')">← Kembali</button>
                    <h2 class="section-title">🔐 Login sebagai Admin</h2>
                    
                    <div class="step-card">
                        <h4>Cara Login</h4>
                        <ul class="step-list">
                            <li>Buka halaman login admin</li>
                            <li>Masukkan email admin</li>
                            <li>Masukkan password admin</li>
                            <li>Klik tombol "Masuk"</li>
                        </ul>
                    </div>

                    <div class="alert alert-info">
                        <strong>ℹ️ Kredensial Default:</strong><br>
                        Email: admin@elitbang.go.id<br>
                        Password: (sesuaikan dengan setup awal)
                    </div>

                    <div class="alert alert-warning">
                        <strong>⚠️ Keamanan:</strong><br>
                        Segera ubah password default setelah login pertama kali untuk menjaga keamanan sistem
                    </div>
                </div>

                <div id="admin-dashboard" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('admin')">← Kembali</button>
                    <h2 class="section-title">📊 Dashboard Admin</h2>
                    
                    <div class="step-card">
                        <h4>Statistik Dashboard</h4>
                        <table>
                            <tr>
                                <th>Metrik</th>
                                <th>Deskripsi</th>
                            </tr>
                            <tr>
                                <td>Total Laporan</td>
                                <td>Semua laporan di sistem</td>
                            </tr>
                            <tr>
                                <td>Menunggu Verifikasi</td>
                                <td>Laporan belum direview</td>
                            </tr>
                            <tr>
                                <td>Diterima</td>
                                <td>Laporan yang disetujui</td>
                            </tr>
                            <tr>
                                <td>Diarsipkan</td>
                                <td>Laporan yang diarsipkan</td>
                            </tr>
                        </table>
                    </div>

                    <div class="alert alert-info">
                        <strong>💡 Fitur Dashboard:</strong><br>
                        • Notifikasi laporan masuk di bagian atas<br>
                        • Grafik statistik bulanan<br>
                        • Quick actions untuk akses cepat
                    </div>
                </div>

                <div id="admin-verifikasi" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('admin')">← Kembali</button>
                    <h2 class="section-title">✅ Verifikasi Laporan</h2>
                    
                    <div class="step-card">
                        <h4>Menerima Laporan</h4>
                        <ul class="step-list">
                            <li>Klik tombol "Lihat" pada laporan</li>
                            <li>Review semua data dan file dengan teliti</li>
                            <li>Jika sudah sesuai, klik tombol "Terima"</li>
                            <li>Isi feedback (opsional)</li>
                            <li>Konfirmasi penerimaan</li>
                        </ul>
                    </div>

                    <div class="step-card">
                        <h4>Meminta Revisi</h4>
                        <ul class="step-list">
                            <li>Klik tombol "Revisi" pada laporan</li>
                            <li>Berikan catatan revisi yang jelas dan detail</li>
                            <li>Sebutkan bagian mana yang perlu diperbaiki</li>
                            <li>Klik "Kirim"</li>
                            <li>OPD akan mendapat notifikasi revisi</li>
                        </ul>
                    </div>

                    <div class="step-card">
                        <h4>Menolak Laporan</h4>
                        <ul class="step-list">
                            <li>Klik tombol "Tolak" pada laporan</li>
                            <li>Berikan alasan penolakan yang jelas</li>
                            <li>Klik "Konfirmasi"</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <strong>⚠️ Tips Verifikasi:</strong><br>
                        • Periksa kelengkapan data dan dokumen<br>
                        • Pastikan metodologi sesuai standar<br>
                        • Berikan feedback yang konstruktif<br>
                        • Verifikasi dalam waktu maksimal 7 hari kerja
                    </div>
                </div>

                <div id="admin-users" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('admin')">← Kembali</button>
                    <h2 class="section-title">👥 Manajemen Users</h2>
                    
                    <div class="step-card">
                        <h4>Melihat Daftar OPD</h4>
                        <ul class="step-list">
                            <li>Klik menu "Users" di sidebar</li>
                            <li>Tabel akan menampilkan semua user OPD</li>
                            <li>Gunakan search untuk mencari user spesifik</li>
                            <li>Filter berdasarkan status atau OPD</li>
                        </ul>
                    </div>

                    <div class="step-card">
                        <h4>Informasi User</h4>
                        <table>
                            <tr>
                                <th>Kolom</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>Nama Lengkap</td>
                                <td>Nama lengkap user</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>Email login</td>
                            </tr>
                            <tr>
                                <td>OPD</td>
                                <td>Instansi user</td>
                            </tr>
                            <tr>
                                <td>Tanggal Registrasi</td>
                                <td>Kapan user terdaftar</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>Aktif/Nonaktif</td>
                            </tr>
                        </table>
                    </div>

                    <div class="step-card">
                        <h4>Reset Password User</h4>
                        <ul class="step-list">
                            <li>Cari user yang akan direset passwordnya</li>
                            <li>Klik tombol "Reset Password"</li>
                            <li>Password akan direset ke default</li>
                            <li>Informasikan ke user untuk login dengan password baru</li>
                        </ul>
                    </div>

                    <div class="alert alert-info">
                        <strong>ℹ️ Catatan:</strong><br>
                        User akan menerima notifikasi email setelah password direset
                    </div>
                </div>

                <div id="admin-dokumen" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('admin')">← Kembali</button>
                    <h2 class="section-title">📁 Manajemen Dokumen Perencanaan</h2>
                    
                    <div class="step-card">
                        <h4>Tambah Dokumen Baru</h4>
                        <ul class="step-list">
                            <li>Klik menu "Dokumen Perencanaan" di sidebar</li>
                            <li>Klik tombol "Tambah Dokumen"</li>
                            <li>Isi form yang tersedia</li>
                            <li>Upload file dokumen</li>
                            <li>Klik "Simpan"</li>
                        </ul>
                    </div>

                    <div class="step-card">
                        <h4>Form Dokumen</h4>
                        <table>
                            <tr>
                                <th>Field</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>Judul Dokumen</td>
                                <td>Nama dokumen perencanaan</td>
                            </tr>
                            <tr>
                                <td>Jenis Dokumen</td>
                                <td>RPJMD, RKPD, Renstra, dll</td>
                            </tr>
                            <tr>
                                <td>Tahun</td>
                                <td>Tahun dokumen berlaku</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>Penjelasan singkat dokumen</td>
                            </tr>
                            <tr>
                                <td>File</td>
                                <td>Upload file PDF</td>
                            </tr>
                        </table>
                    </div>

                    <div class="step-card">
                        <h4>Publish/Unpublish Dokumen</h4>
                        <ul class="step-list">
                            <li>Temukan dokumen di daftar</li>
                            <li>Klik toggle "Publish/Unpublish"</li>
                            <li>Hanya dokumen yang di-publish yang terlihat OPD</li>
                        </ul>
                    </div>

                    <div class="alert alert-success">
                        <strong>✅ Tips:</strong><br>
                        Upload dokumen terbaru agar OPD dapat menyusun kegiatan sesuai perencanaan daerah
                    </div>
                </div>

                <div id="admin-bulk" class="detail-section">
                    <button class="back-btn" onclick="backToMenu('admin')">← Kembali</button>
                    <h2 class="section-title">⚡ Bulk Actions</h2>
                    
                    <div class="step-card">
                        <h4>Cara Menggunakan Bulk Actions</h4>
                        <ul class="step-list">
                            <li>Buka halaman "Laporan Akhir"</li>
                            <li>Centang checkbox pada laporan yang ingin diproses</li>
                            <li>Pilih aksi dari dropdown bulk actions</li>
                            <li>Klik "Terapkan"</li>
                            <li>Konfirmasi aksi</li>
                        </ul>
                    </div>

                    <div class="step-card">
                        <h4>Jenis Bulk Actions</h4>
                        <table>
                            <tr>
                                <th>Aksi</th>
                                <th>Keterangan</th>
                            </tr>
                            <tr>
                                <td>Bulk Publish</td>
                                <td>Publish beberapa laporan sekaligus</td>
                            </tr>
                            <tr>
                                <td>Bulk Unpublish</td>
                                <td>Unpublish beberapa laporan</td>
                            </tr>
                            <tr>
                                <td>Bulk Archive</td>
                                <td>Arsipkan beberapa laporan</td>
                            </tr>
                            <tr>
                                <td>Bulk Unarchive</td>
                                <td>Buka arsip beberapa laporan</td>
                            </tr>
                            <tr>
                                <td>Bulk Delete</td>
                                <td>Hapus beberapa laporan (hati-hati!)</td>
                            </tr>
                        </table>
                    </div>

                    <div class="alert alert-warning">
                        <strong>⚠️ Peringatan:</strong><br>
                        Bulk actions tidak dapat di-undo. Pastikan Anda sudah memilih laporan yang tepat sebelum melakukan aksi massal.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchRole(role) {
            // Toggle active class on buttons
            document.querySelectorAll('.role-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.closest('.role-btn').classList.add('active');

            // Show/hide content
            if (role === 'opd') {
                document.getElementById('opd-content').style.display = 'block';
                document.getElementById('admin-content').style.display = 'none';
                backToMenu('opd');
            } else {
                document.getElementById('opd-content').style.display = 'none';
                document.getElementById('admin-content').style.display = 'block';
                backToMenu('admin');
            }
        }

        function showDetail(sectionId) {
            const role = sectionId.startsWith('opd') ? 'opd' : 'admin';
            
            // Hide menu
            document.getElementById(role + '-menu').style.display = 'none';
            
            // Hide all detail sections
            document.querySelectorAll('#' + role + '-content .detail-section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Show selected section
            document.getElementById(sectionId).classList.add('active');
        }

        function backToMenu(role) {
            // Show menu
            document.getElementById(role + '-menu').style.display = 'block';
            
            // Hide all detail sections
            document.querySelectorAll('#' + role + '-content .detail-section').forEach(section => {
                section.classList.remove('active');
            });
        }
    </script>
</body>
</html>