<x-app>
   <div class="grid grid-cols-12 gap-x-6">
       <div class="col-span-12">
           <div class="card">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0"><i class="ti ti-info-circle me-2"></i>Kelola Data Tentang</h5>
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
                           <input type="text" class="form-control" id="searchTentang"
                               placeholder="Cari judul..." onkeyup="searchTable()">
                       </div>
                   </div>
   
                   <!-- Table -->
                   <div class="table-responsive">
                       <table class="table table-hover">
                           <thead>
                               <tr>
                                   <th class="text-start">NO</th>
                                   <th class="text-start"><i class="ti ti-file-text me-1"></i>JUDUL</th>
                                   <th class="text-start"><i class="ti ti-toggle-left me-1"></i>STATUS</th>
                                   <th class="text-start"><i class="ti ti-sort-ascending me-1"></i>URUTAN</th>
                                   <th class="text-start"><i class="ti ti-clock me-1"></i>DIBUAT</th>
                                   <th class="text-center">AKSI</th>
                               </tr>
                           </thead>
                           <tbody id="tableBody">
                               @forelse($tentangs as $tentang)
                               <tr class="tentang-row">
                                   <td>
                                       <span class="badge bg-light-primary">{{ $loop->iteration + ($tentangs->currentPage() - 1) * $tentangs->perPage() }}</span>
                                   </td>
                                   <td>
                                       <div class="flex items-center gap-3">
                                           @if($tentang->gambar)
                                           <div class="shrink-0">
                                               <img src="{{ asset('storage/' . $tentang->gambar) }}" 
                                                   alt="{{ $tentang->judul }}"
                                                   class="rounded"
                                                   style="width: 50px; height: 50px; object-fit: cover;">
                                           </div>
                                           @else
                                           <div class="shrink-0">
                                               <div class="avtar avtar-s bg-light-info text-info">
                                                   <i class="ti ti-photo"></i>
                                               </div>
                                           </div>
                                           @endif
                                           <div class="grow">
                                               <h6 class="mb-0">{{ Str::limit($tentang->judul, 50) }}</h6>
                                               <small class="text-muted">{{ Str::limit(strip_tags($tentang->konten), 80) }}</small>
                                           </div>
                                       </div>
                                   </td>
                                   <td>
                                       <span class="badge {{ $tentang->status ? 'bg-success' : 'bg-danger' }}">
                                           {{ $tentang->status ? 'Aktif' : 'Tidak Aktif' }}
                                       </span>
                                   </td>
                                   <td>
                                       <span class="badge bg-light-secondary">{{ $tentang->urutan }}</span>
                                   </td>
                                   <td>
                                       <span class="text-muted">{{ $tentang->created_at->format('d/m/Y') }}</span>
                                   </td>
                                   <td>
                                       <div class="flex items-center justify-center gap-2">
                                           <button class="btn btn-icon btn-link-info"
                                               onclick="openShow('{{ $tentang->judul }}','{{ Str::limit(strip_tags($tentang->konten), 200) }}','{{ $tentang->urutan }}','{{ $tentang->status ? 'Aktif' : 'Tidak Aktif' }}','{{ $tentang->gambar ? asset('storage/' . $tentang->gambar) : '' }}','{{ $tentang->created_at->format('d M Y, H:i') }}')"
                                               title="Detail">
                                               <i class="ti ti-eye"></i>
                                           </button>
                                           <button class="btn btn-icon btn-link-warning"
                                               onclick="openEdit('{{ $tentang->id }}','{{ $tentang->judul }}','{{ addslashes($tentang->konten) }}','{{ $tentang->urutan }}','{{ $tentang->status }}','{{ $tentang->gambar ? asset('storage/' . $tentang->gambar) : '' }}')"
                                               title="Edit">
                                               <i class="ti ti-edit"></i>
                                           </button>
                                           <button type="button" class="btn btn-icon btn-link-danger btnDelete"
                                               data-id="{{ $tentang->id }}" data-judul="{{ $tentang->judul }}"
                                               title="Hapus">
                                               <i class="ti ti-trash"></i>
                                           </button>
                                       </div>
                                   </td>
                               </tr>
                               @empty
                               <tr>
                                   <td colspan="6" class="text-center py-12">
                                       <div class="flex flex-col items-center gap-2">
                                           <i class="ti ti-inbox" style="font-size: 48px; opacity: 0.2;"></i>
                                           <p class="text-muted mb-0">Belum ada data tentang</p>
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
                   @if($tentangs->hasPages())
                   <div class="mt-4">
                       {{ $tentangs->links() }}
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
                           <i class="ti ti-file-plus me-2"></i>Tambah Data Tentang
                       </h5>
                       <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeCreate()">
                           <i class="ti ti-x"></i>
                       </button>
                   </div>
               </div>
               <form id="createForm" enctype="multipart/form-data">
                   @csrf
                   <div class="card-body">
                       <div class="mb-3">
                           <label class="form-label">Judul <span class="text-danger">*</span></label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-file-text"></i></span>
                               <input type="text" class="form-control" name="judul" placeholder="Masukkan judul" required>
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Konten <span class="text-danger">*</span></label>
                           <textarea class="form-control" name="konten" rows="6" placeholder="Masukkan konten" required></textarea>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Gambar</label>
                           <input type="file" class="form-control" name="gambar" accept="image/*">
                           <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
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
                           <i class="ti ti-edit me-2"></i>Edit Data Tentang
                       </h5>
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
                       <div class="mb-3">
                           <label class="form-label">Judul <span class="text-danger">*</span></label>
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-file-text"></i></span>
                               <input type="text" class="form-control" id="editJudul" name="judul" required>
                           </div>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Konten <span class="text-danger">*</span></label>
                           <textarea class="form-control" id="editKonten" name="konten" rows="6" required></textarea>
                       </div>
   
                       <div class="mb-3">
                           <label class="form-label">Gambar</label>
                           <div id="currentImageContainer" class="mb-2" style="display: none;">
                               <img id="currentImage" src="" alt="Current" class="img-thumbnail" style="max-width: 100px;">
                           </div>
                           <input type="file" class="form-control" name="gambar" accept="image/*">
                           <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar</div>
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
                           <i class="ti ti-info-circle me-2"></i>Detail Tentang
                       </h5>
                       <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeShow()">
                           <i class="ti ti-x"></i>
                       </button>
                   </div>
               </div>
               <div class="card-body">
                   <div id="showImageContainer" class="text-center mb-4" style="display: none;">
                       <img id="showImage" src="" alt="Image" class="img-fluid rounded" style="max-height: 200px;">
                   </div>
   
                   <div class="grid gap-3">
                       <div class="p-4 rounded-lg bg-light-primary">
                           <div class="flex items-center gap-3">
                               <div class="shrink-0">
                                   <div class="avtar avtar-s bg-primary text-white">
                                       <i class="ti ti-file-text"></i>
                                   </div>
                               </div>
                               <div class="grow">
                                   <p class="mb-1 text-muted text-sm">Judul</p>
                                   <h6 class="mb-0" id="showJudul"></h6>
                               </div>
                           </div>
                       </div>
   
                       <div class="p-4 rounded-lg bg-light-info">
                           <div class="flex items-start gap-3">
                               <div class="shrink-0">
                                   <div class="avtar avtar-s bg-info text-white">
                                       <i class="ti ti-text"></i>
                                   </div>
                               </div>
                               <div class="grow">
                                   <p class="mb-1 text-muted text-sm">Konten</p>
                                   <p class="mb-0" id="showKonten"></p>
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
   
                       <div class="p-4 rounded-lg bg-light-warning">
                           <div class="flex items-center gap-3">
                               <div class="shrink-0">
                                   <div class="avtar avtar-s bg-warning text-white">
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
   
   function openEdit(id, judul, konten, urutan, status, gambar) {
       document.getElementById('editId').value = id;
       document.getElementById('editJudul').value = judul;
       document.getElementById('editKonten').value = konten;
       document.getElementById('editUrutan').value = urutan;
       document.getElementById('editStatus').checked = status == 1;
       
       if (gambar) {
           document.getElementById('currentImage').src = gambar;
           document.getElementById('currentImageContainer').style.display = 'block';
       } else {
           document.getElementById('currentImageContainer').style.display = 'none';
       }
       
       document.getElementById('modalEdit').style.display = 'block';
       document.body.classList.add('modal-open');
   }
   
   function closeEdit() {
       document.getElementById('modalEdit').style.display = 'none';
       document.body.classList.remove('modal-open');
   }
   
   function openShow(judul, konten, urutan, status, gambar, created) {
       document.getElementById('showJudul').textContent = judul;
       document.getElementById('showKonten').textContent = konten;
       document.getElementById('showUrutan').textContent = urutan;
       document.getElementById('showStatus').textContent = status;
       document.getElementById('showCreated').textContent = created;
       
       if (gambar) {
           document.getElementById('showImage').src = gambar;
           document.getElementById('showImageContainer').style.display = 'block';
       } else {
           document.getElementById('showImageContainer').style.display = 'none';
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
       const search = document.getElementById('searchTentang').value.toLowerCase();
       document.querySelectorAll('.tentang-row').forEach(row => {
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
       
       fetch('{{ route("tentang.admin.store") }}', {
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
       
       fetch('{{ url("administrator/dashboard/tentang") }}/' + id, {
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
           const judul = this.dataset.judul;
           
           Swal.fire({
               title: 'Hapus Data?',
               text: `Hapus "${judul}"? Data yang dihapus tidak dapat dikembalikan!`,
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#dc2626',
               cancelButtonColor: '#6c757d',
               confirmButtonText: 'Ya, Hapus!',
               cancelButtonText: 'Batal'
           }).then((result) => {
               if (result.isConfirmed) {
                   fetch('{{ url("administrator/dashboard/tentang") }}/' + id, {
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