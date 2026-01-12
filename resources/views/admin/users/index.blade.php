<x-app>
    <div class="grid grid-cols-12 gap-x-6">
        <div class="col-span-12">
            <div class="card">
                <div class="card-header">
                    <div class="flex items-center justify-between">
                        <h5 class="mb-0"><i class="ti ti-users me-2"></i>Daftar User</h5>
                        <button class="btn btn-primary inline-flex items-center gap-2" onclick="openCreate()">
                            <i class="ti ti-plus"></i> Tambah User
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Search -->
                    <div class="mb-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control" id="searchUser"
                                placeholder="Cari nama, email, atau role..." onkeyup="searchTable()">
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-start">NO</th>
                                    <th class="text-start">
                                        <i class="ti ti-user me-1"></i>NAMA Lengkap Opd
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-mail me-1"></i>EMAIL
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-building me-1"></i>NAMA OPD
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-shield me-1"></i>ROLE
                                    </th>
                                    <th class="text-start">
                                        <i class="ti ti-clock me-1"></i>DIBUAT
                                    </th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @forelse($users as $u)
                                <tr class="user-row">
                                    <td>
                                        <span class="badge bg-light-primary">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="shrink-0">
                                                <div class="avtar avtar-s bg-light-success text-success">
                                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                                </div>
                                            </div>
                                            <div class="grow">
                                                <h6 class="mb-0">{{ $u->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <i class="ti ti-mail-opened text-muted"></i>
                                            <span class="text-muted">{{ $u->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <i class="ti ti-building text-muted"></i>
                                            <span class="text-muted">{{ $u->nama_opd ?: '-' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <i class="ti ti-shield text-muted"></i>
                                            <span class="badge bg-primary">{{ $u->getRoleNames()->first() ?: 'No Role'
                                                }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $u->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td>
                                        <div class="flex items-center justify-center gap-2">
                                            <button class="btn btn-icon btn-link-info"
                                                onclick="openShow('{{ $u->name }}','{{ $u->email }}','{{ $u->nama_opd ?: '-' }}','{{ $u->created_at->format('d M Y, H:i') }}')"
                                                title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                            <button class="btn btn-icon btn-link-warning"
                                                onclick="openEdit('{{ $u->id }}','{{ $u->name }}','{{ $u->email }}','{{ $u->nama_opd ?: '' }}','{{ $u->getRoleNames()->first() }}')"
                                                title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                                                class="inline-block deleteForm">
                                                @csrf @method('DELETE')
                                                <button type="button" class="btn btn-icon btn-link-danger btnDelete"
                                                    title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-12">
                                        <div class="flex flex-col items-center gap-2">
                                            <i class="ti ti-users-off" style="font-size: 48px; opacity: 0.2;"></i>
                                            <p class="text-muted mb-0">Belum ada data user</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($users, 'hasPages') && $users->hasPages())
                    <div class="mt-4">
                        {{ $users->links() }}
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
                            <i class="ti ti-user-plus me-2"></i>Tambah User
                        </h5>
                        <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeCreate()">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap OPD <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-user"></i></span>
                                <input name="name" class="form-control" placeholder="Masukkan nama lengkap OPD" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                <input name="email" type="email" class="form-control" placeholder="contoh@email.com"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                <input name="password" type="password" id="createPassword" class="form-control"
                                    placeholder="Min. 8 karakter" required>
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('createPassword')">
                                    <i class="ti ti-eye" id="createPasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama OPD <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-building"></i></span>
                                <input name="nama_opd" class="form-control" placeholder="Masukkan nama OPD" required>
                            </div>
                        </div>

                        <!-- Modal Create - Role Dropdown Section -->
                        <div class="mb-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-shield"></i></span>
                                <select name="role" class="form-select" required>
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->name }}">
                                        {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                    </option>
                                    @endforeach
                                </select>
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
                            <i class="ti ti-edit me-2"></i>Edit User
                        </h5>
                        <button type="button" class="btn btn-icon btn-link-secondary" onclick="closeEdit()">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>

                <form method="POST" id="editForm">
                    @csrf @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-user"></i></span>
                                <input id="editName" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                <input id="editEmail" name="email" type="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-muted">(Opsional)</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-lock"></i></span>
                                <input name="password" type="password" id="editPassword" class="form-control"
                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="togglePassword('editPassword')">
                                    <i class="ti ti-eye" id="editPasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama OPD</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-building"></i></span>
                                <input id="editNamaOpd" name="nama_opd" class="form-control"
                                    placeholder="Masukkan nama OPD">
                            </div>
                        </div>

                        <!-- Modal Edit - Role Dropdown Section -->
                        <div class="mb-3">
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-shield"></i></span>
                                <select name="role" id="editRole" class="form-select" required>
                                    <option value="">Pilih Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->name }}">
                                        {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                    </option>
                                    @endforeach
                                </select>
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
                            <i class="ti ti-info-circle me-2"></i>Detail User
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
                                        <i class="ti ti-user"></i>
                                    </div>
                                </div>
                                <div class="grow">
                                    <p class="mb-1 text-muted text-sm">Nama</p>
                                    <h6 class="mb-0" id="showName"></h6>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-lg bg-light-success">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s bg-success text-white">
                                        <i class="ti ti-mail"></i>
                                    </div>
                                </div>
                                <div class="grow">
                                    <p class="mb-1 text-muted text-sm">Email</p>
                                    <h6 class="mb-0" id="showEmail"></h6>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 rounded-lg bg-light-info">
                            <div class="flex items-center gap-3">
                                <div class="shrink-0">
                                    <div class="avtar avtar-s bg-info text-white">
                                        <i class="ti ti-building"></i>
                                    </div>
                                </div>
                                <div class="grow">
                                    <p class="mb-1 text-muted text-sm">Nama OPD</p>
                                    <h6 class="mb-0" id="showNamaOpd"></h6>
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
                                    <p class="mb-1 text-muted text-sm">Terdaftar Sejak</p>
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

        /* Prevent body scroll when modal is open */
        body.modal-open {
            overflow: hidden;
        }
    </style>

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ asset('assets/js/sweetalert2.js') }}">

    </script>

    <script>
        // Modal Functions - Pure JavaScript
        function openCreate() {
            document.getElementById('modalCreate').style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeCreate() {
            document.getElementById('modalCreate').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        function openEdit(id, name, email, namaOpd, role) {
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editNamaOpd').value = namaOpd || '';
            document.getElementById('editRole').value = role || '';
            document.getElementById('editForm').action = "/users/" + id;
            document.getElementById('modalEdit').style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeEdit() {
            document.getElementById('modalEdit').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        function openShow(name, email, namaOpd, created) {
            document.getElementById('showInitial').textContent = name.charAt(0).toUpperCase();
            document.getElementById('showName').textContent = name;
            document.getElementById('showEmail').textContent = email;
            document.getElementById('showNamaOpd').textContent = namaOpd || '-';
            document.getElementById('showCreated').textContent = created;
            document.getElementById('modalShow').style.display = 'block';
            document.body.classList.add('modal-open');
        }

        function closeShow() {
            document.getElementById('modalShow').style.display = 'none';
            document.body.classList.remove('modal-open');
        }

        // Toggle Password
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + 'Icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('ti-eye', 'ti-eye-off');
            } else {
                input.type = 'password';
                icon.classList.replace('ti-eye-off', 'ti-eye');
            }
        }

        // Search Table
        function searchTable() {
            const search = document.getElementById('searchUser').value.toLowerCase();
            document.querySelectorAll('.user-row').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(search) ? '' : 'none';
            });
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeCreate();
                closeEdit();
                closeShow();
            }
        });

        // Delete Confirmation
        document.querySelectorAll('.btnDelete').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Hapus User?',
                    text: 'Data yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Success Alert
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
        @endif

        // Error Alert
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