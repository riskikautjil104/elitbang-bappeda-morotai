<x-app>
   <!-- Page Header -->
   <div class="page-header mb-6">
       <div class="page-block">
           <div class="row align-items-center">
               <div class="col-md-12">
                   <div class="page-header-title">
                       <h2 class="mb-2 text-3xl font-bold text-gray-800 dark:text-white">
                           Tambah Role Baru
                       </h2>
                   </div>
                   <ul class="breadcrumb mb-0">
                       <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                       <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Role Management</a></li>
                       <li class="breadcrumb-item" aria-current="page">Tambah Role</li>
                   </ul>
               </div>
           </div>
       </div>
   </div>

   <!-- Main Content -->
   <div class="row">
       <div class="col-12">
           <form action="{{ route('admin.roles.store') }}" method="POST">
               @csrf
               
               <div class="card">
                   <!-- Card Header -->
                   <div class="card-header border-b border-gray-200 dark:border-gray-700">
                       <div class="flex items-center justify-between">
                           <div>
                               <h5 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">
                                   Informasi Role
                               </h5>
                               <p class="text-sm text-gray-500 dark:text-gray-400">
                                   Isi data role dan pilih permissions yang sesuai
                               </p>
                           </div>
                           <a href="{{ route('admin.roles.index') }}" 
                              class="btn btn-outline-secondary flex items-center gap-2">
                               <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                         d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                               </svg>
                               Kembali
                           </a>
                       </div>
                   </div>

                   <!-- Card Body -->
                   <div class="card-body">
                       <!-- Alert Messages -->
                       @if(session('success'))
                           <div class="alert alert-success mb-4" role="alert">
                               <div class="flex items-center gap-2">
                                   <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                       <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                   </svg>
                                   {{ session('success') }}
                               </div>
                           </div>
                       @endif

                       @if($errors->any())
                           <div class="alert alert-danger mb-4" role="alert">
                               <div class="flex items-start gap-2">
                                   <svg class="w-5 h-5 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                       <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                   </svg>
                                   <div>
                                       <p class="font-semibold mb-1">Terdapat kesalahan:</p>
                                       <ul class="list-disc list-inside space-y-1">
                                           @foreach($errors->all() as $error)
                                               <li>{{ $error }}</li>
                                           @endforeach
                                       </ul>
                                   </div>
                               </div>
                           </div>
                       @endif

                       <!-- Form Fields -->
                       <div class="space-y-6">
                           <!-- Nama Role -->
                           <div>
                               <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                   Nama Role <span class="text-red-500">*</span>
                               </label>
                               <input 
                                   type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="form-control @error('name') border-red-500 @enderror" 
                                   placeholder="Contoh: Editor, Manager, Supervisor"
                                   required>
                               @error('name')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                               @enderror
                               <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                   Masukkan nama role yang unik dan deskriptif
                               </p>
                           </div>

                           <!-- Guard Name (Optional, biasanya otomatis) -->
                           <div>
                               <label for="guard_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                   Guard Name
                               </label>
                               <input 
                                   type="text" 
                                   id="guard_name" 
                                   name="guard_name" 
                                   value="{{ old('guard_name', 'web') }}"
                                   class="form-control bg-gray-50 dark:bg-gray-700" 
                                   readonly>
                               <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                   Guard name default adalah 'web'
                               </p>
                           </div>

                           <!-- Permissions -->
                           <div>
                               <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                   Permissions
                               </label>
                               
                               <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-800/50">
                                   @if($permissions->count() > 0)
                                       <!-- Select All -->
                                       <div class="mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                                           <div class="form-check">
                                               <input 
                                                   class="form-check-input" 
                                                   type="checkbox" 
                                                   id="selectAll"
                                                   onclick="toggleAllPermissions(this)">
                                               <label class="form-check-label font-semibold text-gray-700 dark:text-gray-300" for="selectAll">
                                                   Pilih Semua Permissions
                                               </label>
                                           </div>
                                       </div>

                                       <!-- Permissions Grid -->
                                       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                           @foreach($permissions as $permission)
                                               <div class="form-check bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-500 transition-colors">
                                                   <input 
                                                       class="form-check-input permission-checkbox" 
                                                       type="checkbox" 
                                                       name="permissions[]" 
                                                       value="{{ $permission->id }}"
                                                       id="permission_{{ $permission->id }}"
                                                       {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                                   <label class="form-check-label text-sm text-gray-700 dark:text-gray-300" for="permission_{{ $permission->id }}">
                                                       <span class="font-medium">{{ $permission->name }}</span>
                                                       @if($permission->description)
                                                           <span class="block text-xs text-gray-500 mt-1">
                                                               {{ $permission->description }}
                                                           </span>
                                                       @endif
                                                   </label>
                                               </div>
                                           @endforeach
                                       </div>

                                       <!-- Selected Count -->
                                       <div class="mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                                           <p class="text-sm text-gray-600 dark:text-gray-400">
                                               <span class="font-semibold" id="selectedCount">0</span> dari 
                                               <span class="font-semibold">{{ $permissions->count() }}</span> permissions dipilih
                                           </p>
                                       </div>
                                   @else
                                       <div class="text-center py-8">
                                           <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                     d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                           </svg>
                                           <p class="text-gray-500 dark:text-gray-400">
                                               Belum ada permissions tersedia
                                           </p>
                                           <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                               Silakan buat permissions terlebih dahulu
                                           </p>
                                       </div>
                                   @endif
                               </div>
                               @error('permissions')
                                   <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                               @enderror
                           </div>
                       </div>
                   </div>

                   <!-- Card Footer -->
                   <div class="card-footer border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                       <div class="flex items-center justify-end gap-3">
                           <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                               Batal
                           </a>
                           <button type="submit" class="btn btn-primary flex items-center gap-2">
                               <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                         d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                               </svg>
                               Simpan Role
                           </button>
                       </div>
                   </div>
               </div>
           </form>
       </div>
   </div>

   @push('scripts')
   <script>
       // Toggle all permissions
       function toggleAllPermissions(source) {
           const checkboxes = document.querySelectorAll('.permission-checkbox');
           checkboxes.forEach(checkbox => {
               checkbox.checked = source.checked;
           });
           updateSelectedCount();
       }

       // Update selected count
       function updateSelectedCount() {
           const checkedBoxes = document.querySelectorAll('.permission-checkbox:checked');
           document.getElementById('selectedCount').textContent = checkedBoxes.length;
       }

       // Listen to checkbox changes
       document.addEventListener('DOMContentLoaded', function() {
           const checkboxes = document.querySelectorAll('.permission-checkbox');
           checkboxes.forEach(checkbox => {
               checkbox.addEventListener('change', updateSelectedCount);
           });
           
           // Initial count
           updateSelectedCount();
       });
   </script>
   @endpush
</x-app>