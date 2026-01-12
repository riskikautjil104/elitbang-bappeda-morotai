<x-app>
    <!-- Page Header -->
    <div class="page-header mb-6">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">
                            Manajemen Role & Permissions
                        </h2>
                    </div>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.html">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Role Management</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card">
                <!-- Card Header -->
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <h5 class="mb-0">
                            <i class="ti ti-shield me-2"></i>Daftar Role Akses Sistem
                        </h5>
                        <button class="btn btn-primary inline-flex items-center gap-2" onclick="openCreate()">
                            <i class="ti ti-plus"></i> Tambah Role
                        </button>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Search -->
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control" id="searchRole"
                                placeholder="Cari role..." onkeyup="searchTable()">
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-start">
                                        <input type="checkbox" class="form-check-input" id="selectAll" />
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-shield me-1"></i>NAMA ROLE
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-lock me-1"></i>GUARD NAME
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-key me-1"></i>PERMISSIONS
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-users me-1"></i>USERS
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-clock me-1"></i>DIBUAT
                                    </th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @forelse ($roles as $role)
                                    <tr class="role-row">
                                        <td>
                                            <input type="checkbox" class="form-check-input" />
                                        </td>
                                        <td>
                                            <div class="flex items-center gap-3">
                                                <div class="shrink-0">
                                                    <div class="avtar avtar-s bg-light-primary text-primary">
                                                        {{ strtoupper(substr($role->name, 0, 2)) }}
                                                    </div>
                                                </div>
                                                <div class="grow">
                                                    <h6 class="mb-0 capitalize">{{ $role->name }}</h6>
                                                    <small class="text-muted">ID: {{ $role->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light-secondary text-secondary">
                                                {{ $role->guard_name }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light-info text-info">
                                                {{ $role->permissions->count() }} Permissions
                                            </span>
                                            @if ($role->permissions->count() > 0)
                                                <div class="mt-1">
                                                    @foreach ($role->permissions->take(2) as $permission)
                                                        <span class="badge bg-light-primary text-primary me-1 mb-1">
                                                            {{ $permission->name }}
                                                        </span>
                                                    @endforeach
                                                    @if ($role->permissions->count() > 2)
                                                        <span class="badge bg-light-secondary text-secondary">
                                                            +{{ $role->permissions->count() - 2 }} lainnya
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light-success text-success">
                                                {{ $role->users->count() }} Users
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $role->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td>
                                            <div class="flex items-center justify-center gap-2">
                                                <button class="btn btn-icon btn-link-info"
                                                    onclick='openShow(@json($role))' title="Detail">
                                                    <i class="ti ti-eye"></i>
                                                </button>
                                                <button class="btn btn-icon btn-link-warning"
                                                    onclick="openEdit({{ $role->id }})" title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                                <button type="button" 
                                                    class="btn btn-icon btn-link-danger {{ $role->users->count() > 0 ? 'opacity-50' : '' }}"
                                                    onclick="confirmDelete({{ $role->id }})"
                                                    {{ $role->users->count() > 0 ? 'disabled' : '' }}
                                                    title="{{ $role->users->count() > 0 ? 'Tidak dapat dihapus karena sedang digunakan' : 'Hapus' }}">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-12">
                                            <div class="flex flex-col items-center gap-2">
                                                <i class="ti ti-shield-off" style="font-size: 48px; opacity: 0.2;"></i>
                                                <p class="text-muted mb-0">Belum ada data role</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if ($roles->hasPages())
                        <div class="mt-4">
                            {{ $roles->links() }}
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
                            <i class="ti ti-shield-plus me-2"></i>Tambah Role Baru
                        </h5>
                        <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeCreate()">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>
                <form id="createForm" method="POST" action="/admin/roles">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Role <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-shield"></i></span>
                                <input name="name" class="form-control" placeholder="Contoh: Editor, Manager" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                @foreach($permissions ?? [] as $permission)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" 
                                               name="permissions[]" value="{{ $permission->id }}"
                                               id="create_permission_{{ $permission->id }}">
                                        <label class="form-check-label" for="create_permission_{{ $permission->id }}">
                                            <i class="ti ti-key text-muted me-1"></i>{{ $permission->name }}
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

    <!-- Modal Edit -->
    <div id="modalEdit" class="modal-custom" style="display: none;">
        <div class="modal-overlay" onclick="closeEdit()"></div>
        <div class="modal-dialog-custom">
            <div class="card mb-0">
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <h5 class="mb-0">
                            <i class="ti ti-edit me-2"></i>Edit Role
                        </h5>
                        <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeEdit()">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body" id="editModalContent">
                        <div class="text-center py-8">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2 text-muted">Memuat data...</p>
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
                            <i class="ti ti-info-circle me-2"></i>Detail Role
                        </h5>
                        <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeShow()">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="avtar avtar-xl bg-light-primary text-primary mx-auto mb-3">
                            <span id="showInitial" class="f-28"></span>
                        </div>
                    </div>

                    <div class="grid gap-3">
                        <div class="p-4 rounded-lg bg-light-primary">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s bg-primary text-white">
                                        <i class="ti ti-shield"></i>
                                    </div>
                                </div>
                                <div class="grow">
                                    <p class="mb-1 text-muted text-sm">Nama Role</p>
                                    <h6 class="mb-0 capitalize" id="showName"></h6>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-lg bg-light-success">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s bg-success text-white">
                                        <i class="ti ti-lock"></i>
                                    </div>
                                </div>
                                <div class="grow">
                                    <p class="mb-1 text-muted text-sm">Guard Name</p>
                                    <h6 class="mb-0" id="showGuard"></h6>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-lg bg-light-info">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s bg-info text-white">
                                        <i class="ti ti-key"></i>
                                    </div>
                                </div>
                                <div class="grow">
                                    <p class="mb-1 text-muted text-sm">Permissions</p>
                                    <div id="showPermissions"></div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-lg bg-light-warning">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s bg-warning text-white">
                                        <i class="ti ti-users"></i>
                                    </div>
                                </div>
                                <div class="grow">
                                    <p class="mb-1 text-muted text-sm">Jumlah Users</p>
                                    <h6 class="mb-0" id="showUsers"></h6>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-lg bg-light-secondary">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s bg-secondary text-white">
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
        /* Custom Modal Styles */
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
            max-width: 500px;
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

        .opacity-50 {
            opacity: 0.5;
            cursor: not-allowed !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // ============================================
        // MODAL FUNCTIONS
        // ============================================
        
        function openCreate() {
            document.getElementById('modalCreate').style.display = 'block';
            document.body.classList.add('modal-open');
            document.getElementById('createForm').reset();
        }

        function closeCreate() {
            document.getElementById('modalCreate').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        function openEdit(roleId) {
            document.getElementById('modalEdit').style.display = 'block';
            document.body.classList.add('modal-open');
            
            // Show loading
            document.getElementById('editModalContent').innerHTML = `
                <div class="text-center py-8">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Memuat data...</p>
                </div>
            `;
            
            fetch(`/admin/roles/${roleId}/edit`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                // Cek apakah response OK
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                // Cek apakah content-type adalah JSON
                const contentType = response.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    throw new Error("Response bukan JSON! Mungkin terjadi redirect atau error page.");
                }
                return response.json();
            })
            .then(data => {
                let content = `
                    <div class="mb-3">
                        <label class="form-label">Nama Role <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-shield"></i></span>
                            <input name="name" value="${data.role.name}" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                `;
                
                data.permissions.forEach(permission => {
                    const checked = data.rolePermissions.includes(permission.id) ? 'checked' : '';
                    content += `
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" 
                                   name="permissions[]" value="${permission.id}"
                                   id="edit_permission_${permission.id}" ${checked}>
                            <label class="form-check-label" for="edit_permission_${permission.id}">
                                <i class="ti ti-key text-muted me-1"></i>${permission.name}
                            </label>
                        </div>
                    `;
                });
                
                content += `</div></div>`;
                document.getElementById('editModalContent').innerHTML = content;
                document.getElementById('editForm').action = `/admin/roles/${roleId}`;
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Gagal memuat data role!'
                });
                closeEdit();
            });
        }

        function closeEdit() {
            document.getElementById('modalEdit').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        function openShow(role) {
            const initial = role.name.substring(0, 2).toUpperCase();
            document.getElementById('showInitial').textContent = initial;
            document.getElementById('showName').textContent = role.name;
            document.getElementById('showGuard').textContent = role.guard_name;
            document.getElementById('showUsers').textContent = `${role.users.length} Users`;
            document.getElementById('showCreated').textContent = new Date(role.created_at).toLocaleString('id-ID');
            
            let permissionsHtml = '';
            if (role.permissions.length > 0) {
                role.permissions.forEach(p => {
                    permissionsHtml += `<span class="badge bg-light-primary text-primary me-1 mb-1">${p.name}</span>`;
                });
            } else {
                permissionsHtml = '<span class="text-muted">Tidak ada permission</span>';
            }
            document.getElementById('showPermissions').innerHTML = permissionsHtml;
            
            document.getElementById('modalShow').style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeShow() {
            document.getElementById('modalShow').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        // ============================================
        // DELETE FUNCTION
        // ============================================
        
        function confirmDelete(roleId) {
            Swal.fire({
                title: 'Hapus Role?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteRole(roleId);
                }
            });
        }

        async function deleteRole(roleId) {
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const response = await fetch(`/admin/roles/${roleId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                // Cek apakah response OK
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                // Cek content type
                const contentType = response.headers.get("content-type");
                if (!contentType || !contentType.includes("application/json")) {
                    throw new Error("Response bukan JSON! Mungkin terjadi redirect atau error page.");
                }

                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                console.error('Delete error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Terjadi kesalahan saat menghapus role'
                });
            }
        }

        // ============================================
        // SEARCH & UTILITIES
        // ============================================
        
        function searchTable() {
            const search = document.getElementById('searchRole').value.toLowerCase();
            document.querySelectorAll('.role-row').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(search) ? '' : 'none';
            });
        }

        // Select All
        document.getElementById('selectAll')?.addEventListener('change', function() {
            document.querySelectorAll('tbody input[type="checkbox"]').forEach(cb => {
                cb.checked = this.checked;
            });
        });

        // Close on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCreate();
                closeEdit();
                closeShow();
            }
        });

        // ============================================
        // FORM SUBMIT HANDLERS
        // ============================================
        
        document.getElementById('createForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Menyimpan...';
            
            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    closeCreate();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => window.location.reload());
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Gagal menyimpan data'
                });
            } finally {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
        });

        document.getElementById('editForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Mengupdate...';
            
            try {
                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    closeEdit();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => window.location.reload());
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: error.message || 'Gagal mengupdate data'
                });
            } finally {
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
        });

        // ============================================
        // SUCCESS/ERROR ALERTS
        // ============================================
        
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
            text: '{{ session('error') }}'
        });
        @endif
    </script>
</x-app>