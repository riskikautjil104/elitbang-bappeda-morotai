<x-app>
   <div class="grid grid-cols-12 gap-x-6">
       <div class="col-span-12">
           <div class="card">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0"><i class="ti ti-user me-2"></i>Detail User</h5>
                       <div class="flex gap-2">
                           <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                               <i class="ti ti-edit me-1"></i>Edit
                           </a>
                           <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                               <i class="ti ti-arrow-left me-1"></i>Kembali
                           </a>
                       </div>
                   </div>
               </div>

               <div class="card-body">
                   <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                       <!-- Avatar & Basic Info -->
                       <div class="col-span-1">
                           <div class="text-center mb-4">
                               <img src="{{ asset('assets/images/user/avatar-' . rand(1, 10) . '.jpg') }}"
                                    alt="avatar" class="w-24 h-24 rounded-full mx-auto mb-3">
                               <h4 class="mb-1">{{ $user->name }}</h4>
                               <p class="text-muted mb-0">{{ $user->email }}</p>
                           </div>

                           <div class="space-y-3">
                               <div class="flex justify-between">
                                   <span class="text-muted">Status:</span>
                                   <span class="badge bg-success">Aktif</span>
                               </div>
                               <div class="flex justify-between">
                                   <span class="text-muted">Role:</span>
                                   <span class="badge bg-primary">{{ $user->getRoleNames()->first() ?? 'No Role' }}</span>
                               </div>
                               <div class="flex justify-between">
                                   <span class="text-muted">Dibuat:</span>
                                   <span>{{ $user->created_at->format('d M Y, H:i') }}</span>
                               </div>
                               <div class="flex justify-between">
                                   <span class="text-muted">Terakhir Update:</span>
                                   <span>{{ $user->updated_at->format('d M Y, H:i') }}</span>
                               </div>
                           </div>
                       </div>

                       <!-- Detailed Info -->
                       <div class="col-span-1">
                           <h6 class="mb-3">Informasi Lengkap</h6>

                           <div class="space-y-3">
                               <div>
                                   <label class="form-label text-muted">Nama Lengkap</label>
                                   <p class="mb-0">{{ $user->name }}</p>
                               </div>

                               <div>
                                   <label class="form-label text-muted">Email</label>
                                   <p class="mb-0">{{ $user->email }}</p>
                               </div>

                               <div>
                                   <label class="form-label text-muted">Role & Permissions</label>
                                   <div class="mb-2">
                                       @if($user->roles->count() > 0)
                                           @foreach($user->roles as $role)
                                               <span class="badge bg-primary me-1">{{ $role->name }}</span>
                                           @endforeach
                                       @else
                                           <span class="text-muted">Tidak ada role</span>
                                       @endif
                                   </div>
                                   <div>
                                       @if($user->getAllPermissions()->count() > 0)
                                           <small class="text-muted">Permissions:</small>
                                           @foreach($user->getAllPermissions() as $permission)
                                               <span class="badge bg-light text-dark me-1">{{ $permission->name }}</span>
                                           @endforeach
                                       @else
                                           <small class="text-muted">Tidak ada permission</small>
                                       @endif
                                   </div>
                               </div>

                               @if($user->opd)
                               <div>
                                   <label class="form-label text-muted">OPD</label>
                                   <p class="mb-0">{{ $user->opd->nama_opd }}</p>
                                   <small class="text-muted">{{ $user->opd->alamat }}</small>
                               </div>
                               @endif
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</x-app>
