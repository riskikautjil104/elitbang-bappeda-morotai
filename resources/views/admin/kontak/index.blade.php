<x-app>
   <div class="grid grid-cols-12 gap-x-6">
       <div class="col-span-12">
           <div class="card">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0"><i class="ti ti-address-book me-2"></i>Kelola Kontak</h5>
                       <button class="btn btn-primary inline-flex items-center gap-2" onclick="openCreate()">
                           <i class="ti ti-plus"></i> Tambah Baru
                       </button>
                   </div>
               </div>
   
               <div class="card-body">
                   <!-- Search -->
                   <div class="mb-4">
                       <div class="input-group">
                           <span class="input-group-text"><i class="ti ti-search"></i></span>
                           <input type="text" class="form-control" id="searchKontak"
                               placeholder="Cari nama atau label..." onkeyup="searchTable()">
                       </div>
                   </div>
   
                   <!-- Table -->
                   <div class="table-responsive">
                       <table class="table table-hover">
                           <thead>
                               <tr>
                                   <th class="text-start">NO</th>
                                   <th class="text-start"><i class="ti ti-user me-1"></i>NAMA</th>
                                   <th class="text-start"><i class="ti ti-tag me-1"></i>LABEL</th>
                                   <th class="text-start"><i class="ti ti-info-circle me-1"></i>NILAI</th>
                                   <th class="text-start"><i class="ti ti-toggle-left me-1"></i>STATUS</th>
                                   <th class="text-start"><i class="ti ti-sort-ascending me-1"></i>URUTAN</th>
                                   <th class="text-center">AKSI</th>
                               </tr>
                           </thead>
                           <tbody id="tableBody">
                               @forelse($kontaks as $kontak)
                               <tr class="kontak-row">
                                   <td>
                                       <span class="badge bg-light-primary">{{ $loop->iteration + ($kontaks->currentPage() - 1) * $kontaks->perPage() }}</span>
                                   </td>
                                   <td>
                                       <div class="flex items-center gap-3">
                                           <div class="shrink-0">
                                               <div class="avtar avtar-s bg-light-info text-info">
                                                   <i class="{{ $kontak->icon ?? 'ti ti-mail' }}"></i>
                                               </div>
                                           </div>
                                           <div class="grow">
                                               <h6 class="mb-0">{{ $kontak->nama }}</h6>
                                           </div>
                                       </div>
                                   </td>
                                   <td>
                                       <span class="badge bg-light-secondary">{{ $kontak->label }}</span>
                                   </td>
                                   <td>
                                       <span class="text-muted">{{ Str::limit($kontak->nilai, 40) }}</span>
                                   </td>
                                   <td>
                                       <span class="badge {{ $kontak->status ? 'bg-success' : 'bg-danger' }}">
                                           {{ $kontak->status ? 'Aktif' : 'Tidak Aktif' }}
                                       </span>
                                   </td>
                                   <td>
                                       <span class="badge bg-light-secondary">{{ $kontak->urutan }}</span>
                                   </td>
                                   <td>
                                       <div class="flex items-center justify-center gap-2">
                                           <button class="btn btn-icon btn-link-info"
                                               onclick="openShow('{{ $kontak->nama }}','{{ $kontak->label }}','{{ $kontak->nilai }}','{{ $kontak->icon }}','{{ $kontak->urutan }}','{{ $kontak->status ? 'Aktif' : 'Tidak Aktif' }}','{{ $kontak->created_at->format('d M Y, H:i') }}')"
                                               title="Detail">
                                               <i class="ti ti-eye"></i>
                                           </button>
                                           <button class="btn btn-icon btn-link-warning"
                                               onclick="openEdit('{{ $kontak->id }}','{{ $kontak->nama }}','{{ $kontak->label }}','{{ addslashes($kontak->nilai) }}','{{ $kontak->icon }}','{{ $kontak->urutan }}','{{ $kontak->status }}')"
                                               title="Edit">
                                               <i class="ti ti-edit"></i>
                                           </button>
                                           <button type="button" class="btn btn-icon btn-link-danger btnDelete"
                                               data-id="{{ $kontak->id }}" data-nama="{{ $kontak->nama }}"
                                               title="Hapus">
                                               <i class="ti ti-trash"></i>
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                               @empty
                               <tr>
                                   <td colspan="7" class="text-center py-12">
                                       <div class="flex flex-col items-center gap-2">
                                           <i class="ti ti-inbox" style="font-size: 48px; opacity: 0.2;"></i>
                                           <p class="text-muted mb-0">Belum ada data kontak</p>
                                           <button class="btn btn-primary mt-2" onclick="openCreate()">
                                               <i class="ti ti-plus me-1"></i>Tambah Data Pertama
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                               @endforelse
                           </tbody>
                       </table>
                   </div>
   
                   <!-- Pagination -->
                   @if($kontaks->hasPages())
                   <div class="mt-4">
                       {{ $kontaks->links() }}
                   </div>
                   @endif
               </div>
           </div>
       </div>
   </div>
   
   <!-- Modal Create -->
   <div id="modalCreate" class="modal-custom" style="display: none;">
       <div class="modal-overlay" onclick="closeCreate()"></div>
       <div class="modal-dialog-custom">
           <div class="card mb-0">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0">
                           <i class="ti ti-plus me-2"></i>Tambah Data Kontak
                       </h5>
                       <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeCreate()">
                           <i class="ti ti-x"></i>
                       </button>
                   </div>
               </div>
               <form id="createForm">
                   @csrf
                   <div class="card-body">
                       <div class="mb-3">
                           <label class="form-label">Nama <span class="text-danger">*</span></label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-user"></i></span>
                               <input type="text" class="form-control" name="nama" placeholder="Contoh: Email Kantor" required>
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Label <span class="text-danger">*</span></label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-tag"></i></span>
                               <input type="text" class="form-control" name="label" placeholder="Contoh: Email" required>
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Nilai <span class="text-danger">*</span></label>
                           <textarea class="form-control" name="nilai" rows="3" placeholder="Contoh: admin@example.com" required></textarea>
                           <div class="form-text">Isi dengan email, nomor telepon, atau alamat</div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Icon</label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-icons"></i></span>
                               <input type="text" class="form-control" name="icon" placeholder="ti ti-mail">
                           </div>
                           <div class="form-text">Class icon dari Tabler Icons (contoh: ti ti-mail, ti ti-phone)</div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Urutan</label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-sort-ascending"></i></span>
                               <input type="number" class="form-control" name="urutan" min="1" value="1">
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <div class="form-check form-switch">
                               <input class="form-check-input" type="checkbox" name="status" value="1" checked>
                               <label class="form-check-label">Aktif</label>
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
   
   <!-- Modal Edit -->
   <div id="modalEdit" class="modal-custom" style="display: none;">
       <div class="modal-overlay" onclick="closeEdit()"></div>
       <div class="modal-dialog-custom">
           <div class="card mb-0">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0">
                           <i class="ti ti-edit me-2"></i>Edit Data Kontak
                       </h5>
                       <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeEdit()">
                           <i class="ti ti-x"></i>
                       </button>
                   </div>
               </div>
               <form id="editForm">
                   @csrf
                   @method('PUT')
                   <input type="hidden" id="editId" name="id">
                   <div class="card-body">
                       <div class="mb-3">
                           <label class="form-label">Nama <span class="text-danger">*</span></label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-user"></i></span>
                               <input type="text" class="form-control" id="editNama" name="nama" required>
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Label <span class="text-danger">*</span></label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-tag"></i></span>
                               <input type="text" class="form-control" id="editLabel" name="label" required>
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Nilai <span class="text-danger">*</span></label>
                           <textarea class="form-control" id="editNilai" name="nilai" rows="3" required></textarea>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Icon</label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-icons"></i></span>
                               <input type="text" class="form-control" id="editIcon" name="icon">
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Urutan</label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-sort-ascending"></i></span>
                               <input type="number" class="form-control" id="editUrutan" name="urutan" min="1">
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <div class="form-check form-switch">
                               <input class="form-check-input" type="checkbox" id="editStatus" name="status" value="1">
                               <label class="form-check-label">Aktif</label>
                           </div>
                       </div>
                   </div>
                   <div class="card-footer text-end">
                       <button type="button" class="btn btn-secondary me-2" onclick="closeEdit()">
                           <i class="ti ti-x me-1"></i>Batal
                       </button>
                       <button type="submit" class="btn btn-warning">
                           <i class="ti ti-device-floppy me-1"></i>Update
                       </button>
                   </div>
               </form>
           </div>
       </div>
   </div>
   
   <!-- Modal Show -->
   <div id="modalShow" class="modal-custom" style="display: none;">
       <div class="modal-overlay" onclick="closeShow()"></div>
       <div class="modal-dialog-custom">
           <div class="card mb-0">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0">
                           <i class="ti ti-info-circle me-2"></i>Detail Kontak
                       </h5>
                       <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeShow()">
                           <i class="ti ti-x"></i>
                       </button>
                   </div>
               </div>
               <div class="card-body">
                   <div class="grid gap-3">
                       <div class="p-4 rounded-lg bg-light-primary">
                           <div class="flex items-center gap-3">
                               <div class="shrink-0">
                                   <div class="avtar avtar-s bg-primary text-white">
                                       <i class="ti ti-user"></i>
                                   </div>
                               </div>
                               <div class="grow">
                                   <p class="mb-1 text-muted text-sm">Nama</p>
                                   <h6 class="mb-0" id="showNama"></h6>
                               </div>
                           </div>
                       </div>
   
                       <div class="p-4 rounded-lg bg-light-info">
                           <div class="flex items-center gap-3">
                               <div class="shrink-0">
                                   <div class="avtar avtar-s bg-info text-white">
                                       <i class="ti ti-tag"></i>
                                   </div>
                               </div>
                               <div class="grow">
                                   <p class="mb-1 text-muted text-sm">Label</p>
                                   <h6 class="mb-0" id="showLabel"></h6>
                               </div>
                           </div>
                       </div>
   
                       <div class="p-4 rounded-lg bg-light-secondary">
                           <div class="flex items-start gap-3">
                               <div class="shrink-0">
                                   <div class="avtar avtar-s bg-secondary text-white">
                                       <i class="ti ti-info-circle"></i>
                                   </div>
                               </div>
                               <div class="grow">
                                   <p class="mb-1 text-muted text-sm">Nilai</p>
                                   <p class="mb-0" id="showNilai"></p>
                               </div>
                           </div>
                       </div>
   
                       <div class="p-4 rounded-lg bg-light-warning">
                           <div class="flex items-center gap-3">
                               <div class="shrink-0">
                                   <div class="avtar avtar-s bg-warning text-white">
                                       <i id="showIconElement" class="ti ti-icons"></i>
                                   </div>
                               </div>
                               <div class="grow">
                                   <p class="mb-1 text-muted text-sm">Icon</p>
                                   <h6 class="mb-0" id="showIcon"></h6>
                               </div>
                           </div>
                       </div>
   
                       <div class="grid grid-cols-2 gap-3">
                           <div class="p-4 rounded-lg bg-light-success">
                               <div class="flex items-center gap-2">
                                   <i class="ti ti-toggle-left text-success"></i>
                                   <div>
                                       <p class="mb-1 text-muted text-sm">Status</p>
                                       <h6 class="mb-0" id="showStatus"></h6>
                                   </div>
                               </div>
                           </div>
   
                           <div class="p-4 rounded-lg bg-light-secondary">
                               <div class="flex items-center gap-2">
                                   <i class="ti ti-sort-ascending text-secondary"></i>
                                   <div>
                                       <p class="mb-1 text-muted text-sm">Urutan</p>
                                       <h6 class="mb-0" id="showUrutan"></h6>
                                   </div>
                               </div>
                           </div>
                       </div>
   
                       <div class="p-4 rounded-lg bg-light-dark">
                           <div class="flex items-center gap-3">
                               <div class="shrink-0">
                                   <div class="avtar avtar-s bg-dark text-white">
                                       <i class="ti ti-calendar"></i>
                                   </div>
                               </div>
                               <div class="grow">
                                   <p class="mb-1 text-muted text-sm">Dibuat Pada</p>
                                   <h6 class="mb-0" id="showCreated"></h6>
                               </div>
                           </div>
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
   // Modal Functions
   function openCreate() {
       document.getElementById('modalCreate').style.display = 'block';
       document.body.classList.add('modal-open');
   }
   
   function closeCreate() {
       document.getElementById('modalCreate').style.display = 'none';
       document.body.classList.remove('modal-open');
       document.getElementById('createForm').reset();
   }
   
   function openEdit(id, nama, label, nilai, icon, urutan, status) {
       document.getElementById('editId').value = id;
       document.getElementById('editNama').value = nama;
       document.getElementById('editLabel').value = label;
       document.getElementById('editNilai').value = nilai;
       document.getElementById('editIcon').value = icon;
       document.getElementById('editUrutan').value = urutan;
       document.getElementById('editStatus').checked = status == 1;
       
       document.getElementById('modalEdit').style.display = 'block';
       document.body.classList.add('modal-open');
   }
   
   function closeEdit() {
       document.getElementById('modalEdit').style.display = 'none';
       document.body.classList.remove('modal-open');
   }
   
   function openShow(nama, label, nilai, icon, urutan, status, created) {
       document.getElementById('showNama').textContent = nama;
       document.getElementById('showLabel').textContent = label;
       document.getElementById('showNilai').textContent = nilai;
       document.getElementById('showIcon').textContent = icon || '-';
       document.getElementById('showUrutan').textContent = urutan;
       document.getElementById('showStatus').textContent = status;
       document.getElementById('showCreated').textContent = created;
       
       if (icon) {
           document.getElementById('showIconElement').className = icon;
       }
       
       document.getElementById('modalShow').style.display = 'block';
       document.body.classList.add('modal-open');
   }
   
   function closeShow() {
       document.getElementById('modalShow').style.display = 'none';
       document.body.classList.remove('modal-open');
   }
   
   // Search Table
   function searchTable() {
       const search = document.getElementById('searchKontak').value.toLowerCase();
       document.querySelectorAll('.kontak-row').forEach(row => {
           const text = row.textContent.toLowerCase();
           row.style.display = text.includes(search) ? '' : 'none';
       });
   }
   
   // Close modal on Escape
   document.addEventListener('keydown', function(e) {
       if (e.key === 'Escape') {
           closeCreate();
           closeEdit();
           closeShow();
       }
   });
   
   // Create Form Submit
   document.getElementById('createForm').addEventListener('submit', function(e) {
       e.preventDefault();
       
       let formData = new FormData(this);
       
       fetch('{{ route("kontak.admin.store") }}', {
           method: 'POST',
           body: formData,
           headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
           }
       })
       .then(response => response.json())
       .then(data => {
           if (data.success) {
               closeCreate();
               Swal.fire({
                   icon: 'success',
                   title: 'Berhasil!',
                   text: data.message || 'Data berhasil ditambahkan',
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
               text: 'Terjadi kesalahan saat menyimpan data'
           });
       });
   });
   
   // Edit Form Submit
   document.getElementById('editForm').addEventListener('submit', function(e) {
       e.preventDefault();
       
       let formData = new FormData(this);
       let id = document.getElementById('editId').value;
       
       fetch('{{ url("administrator/dashboard/kontak") }}/' + id, {
           method: 'POST',
           body: formData,
           headers: {
               'X-CSRF-TOKEN': '{{ csrf_token() }}'
           }
       })
       .then(response => response.json())
       .then(data => {
           closeEdit();
           Swal.fire({
               icon: 'success',
               title: 'Berhasil!',
               text: 'Data berhasil diperbarui',
               timer: 2000,
               showConfirmButton: false
           }).then(() => {
               location.reload();
           });
       })
       .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat mengupdate data'
            });
        });
    });
    
    // Delete Handler
    document.querySelectorAll('.btnDelete').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            
            Swal.fire({
                title: 'Hapus Data?',
                text: `Hapus "${nama}"? Data yang dihapus tidak dapat dikembalikan!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('{{ url("administrator/dashboard/kontak") }}/' + id, {
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
                                text: data.message || 'Data berhasil dihapus',
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
                            text: 'Terjadi kesalahan saat menghapus data'
                        });
                    });
                }
            });
        });
    });
    
    // Success/Error from Session
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
    @endif
    
    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        confirmButtonText: 'OK'
    });
    @endif
    </script>
</x-app>