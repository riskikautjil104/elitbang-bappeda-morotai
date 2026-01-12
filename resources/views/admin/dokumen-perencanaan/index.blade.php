<x-app>
   <div class="grid grid-cols-12 gap-x-6">
       <div class="col-span-12">
           <div class="card">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0"><i class="ti ti-file-text me-2"></i>Kelola Dokumen Perencanaan</h5>
                       <button class="btn btn-primary inline-flex items-center gap-2" onclick="openCreate()">
                           <i class="ti ti-plus"></i> Tambah Dokumen
                       </button>
                   </div>
               </div>

               <div class="card-body">
                   <!-- Filter Section -->
                   <div class="row mb-4">
                       <div class="col-md-3">
                           <select class="form-select" id="filterJenis" onchange="applyFilter()">
                               <option value="">Semua Jenis</option>
                               <option value="RPJMD">RPJMD</option>
                               <option value="RPJPD">RPJPD</option>
                               <option value="RKPD">RKPD</option>
                               <option value="RENSTRA">RENSTRA</option>
                               <option value="RENJA">RENJA</option>
                               <option value="Lainnya">Lainnya</option>
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-select" id="filterTahun" onchange="applyFilter()">
                               <option value="">Semua Tahun</option>
                               @foreach($years as $year)
                               <option value="{{ $year }}">{{ $year }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="col-md-2">
                           <select class="form-select" id="filterStatus" onchange="applyFilter()">
                               <option value="">Semua Status</option>
                               <option value="draft">Draft</option>
                               <option value="published">Published</option>
                           </select>
                       </div>
                       <div class="col-md-5">
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-search"></i></span>
                               <input type="text" class="form-control" id="searchDokumen" placeholder="Cari judul atau deskripsi..." onkeyup="searchTable()">
                           </div>
                       </div>
                   </div>

                   <!-- Table -->
                   <div class="table-responsive">
                       <table class="table table-hover">
                           <thead>
                               <tr>
                                   <th>NO</th>
                                   <th><i class="ti ti-file me-1"></i>JUDUL</th>
                                   <th><i class="ti ti-tag me-1"></i>JENIS</th>
                                   <th><i class="ti ti-calendar me-1"></i>TAHUN</th>
                                   <th><i class="ti ti-toggle-left me-1"></i>STATUS</th>
                                   <th><i class="ti ti-world me-1"></i>ONLINE</th>
                                   <th><i class="ti ti-users me-1"></i>KIRIM KE</th>
                                   <th class="text-center">AKSI</th>
                               </tr>
                           </thead>
                           <tbody id="tableBody">
                               @forelse($dokumens as $dokumen)
                               <tr class="dokumen-row">
                                   <td>
                                       <span class="badge bg-light-primary">{{ $loop->iteration + ($dokumens->currentPage() - 1) * $dokumens->perPage() }}</span>
                                   </td>
                                   <td>
                                       <div class="flex items-center gap-3">
                                           <div class="shrink-0">
                                               <div class="avtar avtar-s bg-light-info text-info">
                                                   <i class="ti ti-file-text"></i>
                                               </div>
                                           </div>
                                           <div class="grow">
                                               <h6 class="mb-0">{{ Str::limit($dokumen->judul, 40) }}</h6>
                                               <small class="text-muted">{{ $dokumen->file_name }}</small>
                                           </div>
                                       </div>
                                   </td>
                                   <td>
                                       <span class="badge bg-light-primary">{{ $dokumen->jenis }}</span>
                                   </td>
                                   <td>
                                       <span class="badge bg-light-secondary">{{ $dokumen->tahun }}</span>
                                   </td>
                                   <td>
                                       <span class="badge {{ $dokumen->status === 'published' ? 'bg-success' : 'bg-warning' }}">
                                           {{ $dokumen->status === 'published' ? 'Published' : 'Draft' }}
                                       </span>
                                   </td>
                                   <td>
                                       <span class="badge {{ $dokumen->is_online ? 'bg-success' : 'bg-secondary' }}">
                                           {{ $dokumen->is_online ? 'Ya' : 'Tidak' }}
                                       </span>
                                   </td>
                                   <td>
                                       @if($dokumen->visibility === 'semua_opd')
                                           <span class="badge bg-info">Semua OPD</span>
                                       @elseif($dokumen->visibility === 'opd_terpilih')
                                           <span class="badge bg-primary">{{ $dokumen->opdTerpilih->count() }} OPD</span>
                                       @else
                                           <span class="badge bg-secondary">Tidak Dikirim</span>
                                       @endif
                                   </td>
                                   <td>
                                       <div class="flex items-center justify-center gap-2">
                                           <a href="{{ route('dokumen-perencanaan.admin.download', $dokumen) }}" 
                                              class="btn btn-icon btn-link-primary" 
                                              title="Download">
                                               <i class="ti ti-download"></i>
                                           </a>
                                           <button class="btn btn-icon btn-link-{{ $dokumen->status === 'published' ? 'warning' : 'success' }}"
                                                   onclick="togglePublish('{{ $dokumen->id }}')"
                                                   title="{{ $dokumen->status === 'published' ? 'Unpublish' : 'Publish' }}">
                                               <i class="ti ti-{{ $dokumen->status === 'published' ? 'x' : 'check' }}"></i>
                                           </button>
                                           <button class="btn btn-icon btn-link-info"
                                                   onclick="openShow('{{ $dokumen->id }}')"
                                                   title="Detail">
                                               <i class="ti ti-eye"></i>
                                           </button>
                                           <button class="btn btn-icon btn-link-warning"
                                                   onclick="openEdit('{{ $dokumen->id }}')"
                                                   title="Edit">
                                               <i class="ti ti-edit"></i>
                                           </button>
                                           <button class="btn btn-icon btn-link-danger btnDelete"
                                                   data-id="{{ $dokumen->id }}"
                                                   data-nama="{{ $dokumen->judul }}"
                                                   title="Hapus">
                                               <i class="ti ti-trash"></i>
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                               @empty
                               <tr>
                                   <td colspan="8" class="text-center py-12">
                                       <div class="flex flex-col items-center gap-2">
                                           <i class="ti ti-inbox" style="font-size: 48px; opacity: 0.2;"></i>
                                           <p class="text-muted mb-0">Belum ada dokumen perencanaan</p>
                                           <button class="btn btn-primary mt-2" onclick="openCreate()">
                                               <i class="ti ti-plus me-1"></i>Tambah Dokumen Pertama
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                               @endforelse
                           </tbody>
                       </table>
                   </div>

                   <!-- Pagination -->
                   @if($dokumens->hasPages())
                   <div class="mt-4">
                       {{ $dokumens->links() }}
                   </div>
                   @endif
               </div>
           </div>
       </div>
   </div>

   <!-- Modal Create -->
   <div id="modalCreate" class="modal-custom" style="display: none;">
       <div class="modal-overlay" onclick="closeCreate()"></div>
       <div class="modal-dialog-custom" style="max-width: 800px;">
           <div class="card mb-0">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0"><i class="ti ti-plus me-2"></i>Tambah Dokumen Perencanaan</h5>
                       <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeCreate()">
                           <i class="ti ti-x"></i>
                       </button>
                   </div>
               </div>
               <form id="createForm" enctype="multipart/form-data">
                   @csrf
                   <div class="card-body">
                       <div class="row">
                           <div class="col-md-8">
                               <div class="mb-3">
                                   <label class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="judul" required>
                               </div>
                           </div>
                           <div class="col-md-4">
                               <div class="mb-3">
                                   <label class="form-label">Tahun <span class="text-danger">*</span></label>
                                   <input type="number" class="form-control" name="tahun" min="2000" max="{{ date('Y') + 10 }}" value="{{ date('Y') }}" required>
                               </div>
                           </div>
                       </div>

                       <div class="mb-3">
                           <label class="form-label">Jenis Dokumen <span class="text-danger">*</span></label>
                           <select class="form-select" name="jenis" required>
                               <option value="">Pilih Jenis</option>
                               <option value="RPJMD">RPJMD</option>
                               <option value="RPJPD">RPJPD</option>
                               <option value="RKPD">RKPD</option>
                               <option value="RENSTRA">RENSTRA</option>
                               <option value="RENJA">RENJA</option>
                               <option value="Lainnya">Lainnya</option>
                           </select>
                       </div>

                       <div class="mb-3">
                           <label class="form-label">Deskripsi</label>
                           <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                       </div>

                       <div class="mb-3">
                           <label class="form-label">File Dokumen <span class="text-danger">*</span></label>
                           <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx" required>
                           <small class="form-text text-muted">Format: PDF, DOC, DOCX, XLS, XLSX (Max: 10MB)</small>
                       </div>

                       <div class="mb-3">
                           <div class="form-check form-switch">
                               <input class="form-check-input" type="checkbox" name="is_online" value="1">
                               <label class="form-check-label">Tampilkan di Website</label>
                           </div>
                       </div>

                       <div class="mb-3">
                           <label class="form-label">Kirim ke OPD <span class="text-danger">*</span></label>
                           <select class="form-select" name="visibility" id="visibilityCreate" onchange="toggleOpdSelect('create')" required>
                               <option value="tidak_dikirim">Tidak Dikirim</option>
                               <option value="semua_opd">Semua OPD</option>
                               <option value="opd_terpilih">OPD Tertentu</option>
                           </select>
                       </div>

                       <div class="mb-3" id="opdSelectCreate" style="display: none;">
                           <label class="form-label">Pilih OPD</label>
                           <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                               @foreach($opds as $opd)
                               <div class="form-check">
                                   <input class="form-check-input" type="checkbox" name="opd_ids[]" value="{{ $opd->id }}" id="opd_create_{{ $opd->id }}">
                                   <label class="form-check-label" for="opd_create_{{ $opd->id }}">
                                       {{ $opd->name }}
                                   </label>
                               </div>
                               @endforeach
                           </div>
                       </div>
                   </div>
                   <div class="card-footer text-end">
                       <button type="button" class="btn btn-secondary me-2" onclick="closeCreate()">
                           <i class="ti ti-x me-1"></i>Batal
                       </button>
                       <button type="submit" class="btn btn-primary">
                           <i class="ti ti-device-floppy me-1"></i>Simpan
                       </button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   <!-- Modal Show/Detail -->
<div id="modalShow" class="modal-custom" style="display: none;">
    <div class="modal-overlay" onclick="closeShow()"></div>
    <div class="modal-dialog-custom" style="max-width: 800px;">
        <div class="card mb-0">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <h5 class="mb-0"><i class="ti ti-eye me-2"></i>Detail Dokumen Perencanaan</h5>
                    <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeShow()">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" id="showContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary" onclick="closeShow()">
                    <i class="ti ti-x me-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit" class="modal-custom" style="display: none;">
    <div class="modal-overlay" onclick="closeEdit()"></div>
    <div class="modal-dialog-custom" style="max-width: 800px;">
        <div class="card mb-0">
            <div class="card-header">
                <div class="flex items-center justify-between">
                    <h5 class="mb-0"><i class="ti ti-edit me-2"></i>Edit Dokumen Perencanaan</h5>
                    <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeEdit()">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
            <form id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="editId" name="id">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="editJudul" name="judul" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tahun <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="editTahun" name="tahun" min="2000" max="{{ date('Y') + 10 }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Dokumen <span class="text-danger">*</span></label>
                        <select class="form-select" id="editJenis" name="jenis" required>
                            <option value="">Pilih Jenis</option>
                            <option value="RPJMD">RPJMD</option>
                            <option value="RPJPD">RPJPD</option>
                            <option value="RKPD">RKPD</option>
                            <option value="RENSTRA">RENSTRA</option>
                            <option value="RENJA">RENJA</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" name="deskripsi" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">File Dokumen</label>
                        <div class="alert alert-info mb-2" id="currentFile">
                            <i class="ti ti-file me-1"></i>
                            <span id="currentFileName"></span>
                        </div>
                        <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx">
                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah file. Format: PDF, DOC, DOCX, XLS, XLSX (Max: 10MB)</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="editIsOnline" name="is_online" value="1">
                            <label class="form-check-label">Tampilkan di Website</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kirim ke OPD <span class="text-danger">*</span></label>
                        <select class="form-select" name="visibility" id="visibilityEdit" onchange="toggleOpdSelect('edit')" required>
                            <option value="tidak_dikirim">Tidak Dikirim</option>
                            <option value="semua_opd">Semua OPD</option>
                            <option value="opd_terpilih">OPD Tertentu</option>
                        </select>
                    </div>

                    <div class="mb-3" id="opdSelectEdit" style="display: none;">
                        <label class="form-label">Pilih OPD</label>
                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                            @foreach($opds as $opd)
                            <div class="form-check">
                                <input class="form-check-input opd-checkbox-edit" type="checkbox" name="opd_ids[]" value="{{ $opd->id }}" id="opd_edit_{{ $opd->id }}">
                                <label class="form-check-label" for="opd_edit_{{ $opd->id }}">
                                    {{ $opd->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="button" class="btn btn-secondary me-2" onclick="closeEdit()">
                        <i class="ti ti-x me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

   <style>
       .modal-custom {
           position: fixed;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           z-index: 1050;
           overflow-y: auto;
       }

       .modal-overlay {
           position: fixed;
           top: 0;
           left: 0;
           width: 100%;
           height: 100%;
           background: rgba(0, 0, 0, 0.5);
           backdrop-filter: blur(2px);
       }

       .modal-dialog-custom {
           position: relative;
           max-width: 600px;
           margin: 1.75rem auto;
           z-index: 1051;
           padding: 0 1rem;
       }

       .modal-custom .card {
           animation: modalFadeIn 0.3s ease;
       }

       @keyframes modalFadeIn {
           from {
               opacity: 0;
               transform: translateY(-50px);
           }
           to {
               opacity: 1;
               transform: translateY(0);
           }
       }

       body.modal-open {
           overflow: hidden;
       }
   </style>

   <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
   
   <script>
   function openCreate() {
       document.getElementById('modalCreate').style.display = 'block';
       document.body.classList.add('modal-open');
   }

   function closeCreate() {
       document.getElementById('modalCreate').style.display = 'none';
       document.body.classList.remove('modal-open');
       document.getElementById('createForm').reset();
       document.getElementById('opdSelectCreate').style.display = 'none';
   }

   function toggleOpdSelect(type) {
       const visibility = document.getElementById('visibility' + type.charAt(0).toUpperCase() + type.slice(1)).value;
       const opdSelect = document.getElementById('opdSelect' + type.charAt(0).toUpperCase() + type.slice(1));
       
       if (visibility === 'opd_terpilih') {
           opdSelect.style.display = 'block';
       } else {
           opdSelect.style.display = 'none';
       }
   }

   function togglePublish(id) {
       fetch(`/administrator/dashboard/dokumen-perencanaan/${id}/toggle-publish`, {
           method: 'POST',
           headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}',
               'Content-Type': 'application/json'
           }
       })
       .then(response => response.json())
       .then(data => {
           if (data.success) {
               Swal.fire({
                   icon: 'success',
                   title: 'Berhasil!',
                   text: data.message,
                   timer: 2000,
                   showConfirmButton: false
               }).then(() => {
                   location.reload();
               });
           }
       });
   }

   function searchTable() {
       const search = document.getElementById('searchDokumen').value.toLowerCase();
       document.querySelectorAll('.dokumen-row').forEach(row => {
           const text = row.textContent.toLowerCase();
           row.style.display = text.includes(search) ? '' : 'none';
       });
   }

   function applyFilter() {
       const jenis = document.getElementById('filterJenis').value;
       const tahun = document.getElementById('filterTahun').value;
       const status = document.getElementById('filterStatus').value;
       
       let url = new URL(window.location.href);
       url.searchParams.set('jenis', jenis);
       url.searchParams.set('tahun', tahun);
       url.searchParams.set('status', status);
       
       window.location.href = url.toString();
   }

   document.getElementById('createForm').addEventListener('submit', function(e) {
       e.preventDefault();
       
       let formData = new FormData(this);
       
       fetch('{{ route("dokumen-perencanaan.admin.store") }}', {
           method: 'POST',
           body: formData
       })
       .then(response => response.json())
       .then(data => {
           if (data.success) {
               closeCreate();
               Swal.fire({
                   icon: 'success',
                   title: 'Berhasil!',
                   text: data.message,
                   timer: 2000,
                   showConfirmButton: false
               }).then(() => {
                   location.reload();
               });
           }
       })
       .catch(error => {
           Swal.fire({
               icon: 'error',
               title: 'Gagal!',
               text: 'Terjadi kesalahan saat menyimpan dokumen'
           });
       });
   });

   document.querySelectorAll('.btnDelete').forEach(btn => {
       btn.addEventListener('click', function() {
           const id = this.dataset.id;
           const nama = this.dataset.nama;
           
           Swal.fire({
               title: 'Hapus Dokumen?',
               text: `Hapus "${nama}"? Data yang dihapus tidak dapat dikembalikan!`,
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#dc2626',
               cancelButtonColor: '#6c757d',
               confirmButtonText: 'Ya, Hapus!',
               cancelButtonText: 'Batal'
           }).then((result) => {
               if (result.isConfirmed) {
                   fetch(`/administrator/dashboard/dokumen-perencanaan/${id}`, {
                       method: 'DELETE',
                       headers: {
                           'X-CSRF-TOKEN': '{{ csrf_token() }}',
                           'Content-Type': 'application/json'
                       }
                   })
                   .then(response => response.json())
                   .then(data => {
                       if (data.success) {
                           Swal.fire({
                               icon: 'success',
                               title: 'Terhapus!',
                               text: data.message,
                               timer: 2000,
                               showConfirmButton: false
                           }).then(() => {
                               location.reload();
                           });
                       }
                   });
               }
           });
       });
   });
   function openEdit(id) {
    document.getElementById('modalEdit').style.display = 'block';
    document.body.classList.add('modal-open');
    
    // Fetch dengan header yang jelas
    fetch(`/administrator/dashboard/dokumen-perencanaan/${id}/edit`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            document.getElementById('editId').value = data.dokumen.id;
            document.getElementById('editJudul').value = data.dokumen.judul;
            document.getElementById('editTahun').value = data.dokumen.tahun;
            document.getElementById('editJenis').value = data.dokumen.jenis;
            document.getElementById('editDeskripsi').value = data.dokumen.deskripsi || '';
            document.getElementById('editIsOnline').checked = data.dokumen.is_online;
            document.getElementById('visibilityEdit').value = data.dokumen.visibility;
            document.getElementById('currentFileName').textContent = data.dokumen.file_name;
            
            // Reset checkboxes
            document.querySelectorAll('.opd-checkbox-edit').forEach(cb => cb.checked = false);
            
            // Set selected OPDs
            if (data.selectedOpds && data.selectedOpds.length > 0) {
                data.selectedOpds.forEach(opdId => {
                    const checkbox = document.getElementById(`opd_edit_${opdId}`);
                    if (checkbox) checkbox.checked = true;
                });
            }
            
            // Toggle OPD select visibility
            toggleOpdSelect('edit');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Gagal memuat data dokumen: ' + error.message
        });
        closeEdit();
    });
}

// Helper functions
function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function formatDate(dateString) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric', 
        hour: '2-digit', 
        minute: '2-digit' 
    };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

function getVisibilityText(data) {
    if (data.visibility === 'semua_opd') {
        return '<span class="badge bg-info">Semua OPD</span>';
    } else if (data.visibility === 'opd_terpilih') {
        const count = data.opd_terpilih ? data.opd_terpilih.length : 0;
        return `<span class="badge bg-primary">${count} OPD Terpilih</span>`;
    } else {
        return '<span class="badge bg-secondary">Tidak Dikirim</span>';
    }
}

function closeShow() {
    document.getElementById('modalShow').style.display = 'none';
    document.body.classList.remove('modal-open');
}

function closeEdit() {
    document.getElementById('modalEdit').style.display = 'none';
    document.body.classList.remove('modal-open');
    document.getElementById('editForm').reset();
    document.getElementById('opdSelectEdit').style.display = 'none';
}
// Handle Edit Form Submit
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const id = document.getElementById('editId').value;
    let formData = new FormData(this);
    
    // Laravel method spoofing untuk PUT
    formData.append('_method', 'PUT');
    
    fetch(`/administrator/dashboard/dokumen-perencanaan/${id}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            closeEdit();
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload();
            });
        } else {
            throw new Error(data.message || 'Gagal mengupdate dokumen');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Terjadi kesalahan saat mengupdate dokumen: ' + error.message
        });
    });
});

function openShow(id) {
    document.getElementById('modalShow').style.display = 'block';
    document.body.classList.add('modal-open');
    
    fetch(`/administrator/dashboard/dokumen-perencanaan/${id}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const content = `
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-borderless">
                            <tr>
                                <td width="200" class="fw-bold">Judul</td>
                                <td>: ${data.judul}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Jenis Dokumen</td>
                                <td>: <span class="badge bg-light-primary">${data.jenis}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tahun</td>
                                <td>: ${data.tahun}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Deskripsi</td>
                                <td>: ${data.deskripsi || '-'}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Nama File</td>
                                <td>: ${data.file_name}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Ukuran File</td>
                                <td>: ${formatBytes(data.file_size)}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Status</td>
                                <td>: <span class="badge ${data.status === 'published' ? 'bg-success' : 'bg-warning'}">${data.status === 'published' ? 'Published' : 'Draft'}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tampil Online</td>
                                <td>: <span class="badge ${data.is_online ? 'bg-success' : 'bg-secondary'}">${data.is_online ? 'Ya' : 'Tidak'}</span></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Dikirim ke</td>
                                <td>: ${getVisibilityText(data)}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Diupload oleh</td>
                                <td>: ${data.uploader ? data.uploader.name : '-'}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Upload</td>
                                <td>: ${formatDate(data.created_at)}</td>
                            </tr>
                        </table>
                        
                        <div class="mt-3">
                            <a href="/administrator/dashboard/dokumen-perencanaan/${data.id}/download" class="btn btn-primary">
                                <i class="ti ti-download me-1"></i>Download File
                            </a>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('showContent').innerHTML = content;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('showContent').innerHTML = `
            <div class="alert alert-danger">
                <i class="ti ti-alert-circle me-1"></i>
                Gagal memuat data dokumen: ${error.message}
            </div>
        `;
    });
}

   @if(session('success'))
   Swal.fire({
       icon: 'success',
       title: 'Berhasil!',
       text: '{{ session('success') }}',
       timer: 2000,
       showConfirmButton: false
   });
   @endif
   </script>
</x-app>