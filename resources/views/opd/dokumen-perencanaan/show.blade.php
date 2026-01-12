<x-app>
   <div class="grid grid-cols-12 gap-x-6">
       <!-- Main Content -->
       <div class="col-span-12 col-lg-8">
           <div class="card">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <div>
                           <a href="{{ route('opd.dokumen.index') }}" class="btn btn-link btn-sm mb-2">
                               <i class="ti ti-arrow-left me-1"></i> Kembali
                           </a>
                           <h4 class="mb-0">{{ $dokumenPerencanaan->judul }}</h4>
                       </div>
                   </div>
               </div>

               <div class="card-body">
                   <!-- Document Info -->
                   <div class="row mb-4">
                       <div class="col-md-6">
                           <div class="p-3 bg-light rounded mb-3">
                               <label class="text-muted text-sm mb-1">
                                   <i class="ti ti-tag me-1"></i>Jenis Dokumen
                               </label>
                               <h6 class="mb-0">
                                   <span class="badge bg-primary">{{ $dokumenPerencanaan->jenis }}</span>
                               </h6>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="p-3 bg-light rounded mb-3">
                               <label class="text-muted text-sm mb-1">
                                   <i class="ti ti-calendar me-1"></i>Tahun
                               </label>
                               <h6 class="mb-0">{{ $dokumenPerencanaan->tahun }}</h6>
                           </div>
                       </div>
                   </div>

                   <!-- Description -->
                   @if($dokumenPerencanaan->deskripsi)
                   <div class="mb-4">
                       <h5 class="mb-3">
                           <i class="ti ti-file-description me-2"></i>Deskripsi
                       </h5>
                       <div class="p-3 bg-light rounded">
                           <p class="mb-0" style="white-space: pre-wrap;">{{ $dokumenPerencanaan->deskripsi }}</p>
                       </div>
                   </div>
                   @endif

                   <!-- File Info -->
                   <div class="mb-4">
                       <h5 class="mb-3">
                           <i class="ti ti-paperclip me-2"></i>Informasi File
                       </h5>
                       <div class="p-4 border rounded">
                           <div class="flex items-center gap-4">
                               <div class="avtar avtar-l bg-light-primary text-primary">
                                   <i class="ti ti-file-text" style="font-size: 2rem;"></i>
                               </div>
                               <div class="flex-grow">
                                   <h6 class="mb-1">{{ $dokumenPerencanaan->file_name }}</h6>
                                   <p class="text-muted mb-0">
                                       <span class="badge bg-light-secondary me-2">
                                           <i class="ti ti-file me-1"></i>{{ $dokumenPerencanaan->getFileSizeFormatted() }}
                                       </span>
                                       <span class="badge bg-light-info">
                                           <i class="ti ti-calendar me-1"></i>{{ $dokumenPerencanaan->published_at->format('d M Y, H:i') }}
                                       </span>
                                   </p>
                               </div>
                           </div>

                           <!-- Download Button -->
                           <div class="mt-4">
                               <a href="{{ route('opd.dokumen.download', $dokumenPerencanaan->id) }}" 
                                  class="btn btn-primary w-100">
                                   <i class="ti ti-download me-2"></i>Download Dokumen
                               </a>
                           </div>
                       </div>
                   </div>

                   <!-- PDF Preview (Optional) -->
                   @if(Str::endsWith($dokumenPerencanaan->file_path, '.pdf'))
                   <div class="mb-4">
                       <h5 class="mb-3">
                           <i class="ti ti-eye me-2"></i>Preview Dokumen
                       </h5>
                       <div class="border rounded" style="height: 600px;">
                           <iframe src="{{ asset('storage/' . $dokumenPerencanaan->file_path) }}" 
                                   width="100%" 
                                   height="100%" 
                                   style="border: none;">
                           </iframe>
                       </div>
                   </div>
                   @endif

                  <!-- Read Status Alert -->
@if($dokumenPerencanaan->visibility === 'opd_terpilih')
    @php
        $pivot = $dokumenPerencanaan->getReadStatusForOpd(Auth::id());
    @endphp
    @if($pivot && $pivot->is_read)
    <div class="alert alert-success">
        <i class="ti ti-check me-2"></i>
        Anda telah membaca dokumen ini pada {{ $pivot->read_at->format('d M Y, H:i') }}
    </div>
    @else
    <div class="alert alert-info">
        <i class="ti ti-info-circle me-2"></i>
        Dokumen ini ditandai sebagai sudah dibaca
    </div>
    @endif
@endif
               </div>
           </div>
       </div>

       <!-- Sidebar -->
       <div class="col-span-12 col-lg-4">
           <!-- Metadata Card -->
           <div class="card mb-4">
               <div class="card-header">
                   <h5 class="mb-0">
                       <i class="ti ti-info-circle me-2"></i>Informasi Dokumen
                   </h5>
               </div>
               <div class="card-body">
                   <div class="grid gap-3">
                       <!-- Status -->
                       <div class="p-3 bg-light rounded">
                           <label class="text-muted text-sm mb-2 d-block">
                               <i class="ti ti-toggle-left me-1"></i>Status
                           </label>
                           <span class="badge bg-success">
                               <i class="ti ti-check me-1"></i>Published
                           </span>
                       </div>

                       <!-- Online Status -->
                       <div class="p-3 bg-light rounded">
                           <label class="text-muted text-sm mb-2 d-block">
                               <i class="ti ti-world me-1"></i>Tampil di Website
                           </label>
                           <span class="badge {{ $dokumenPerencanaan->is_online ? 'bg-success' : 'bg-secondary' }}">
                               {{ $dokumenPerencanaan->is_online ? 'Ya' : 'Tidak' }}
                           </span>
                       </div>

                       <!-- Visibility -->
                       <div class="p-3 bg-light rounded">
                           <label class="text-muted text-sm mb-2 d-block">
                               <i class="ti ti-users me-1"></i>Dikirim ke
                           </label>
                           @if($dokumenPerencanaan->visibility === 'semua_opd')
                               <span class="badge bg-info">Semua OPD</span>
                           @elseif($dokumenPerencanaan->visibility === 'opd_terpilih')
                               <span class="badge bg-primary">OPD Terpilih</span>
                           @else
                               <span class="badge bg-secondary">Tidak Dikirim</span>
                           @endif
                       </div>

                       <!-- Uploaded By -->
                       <div class="p-3 bg-light rounded">
                           <label class="text-muted text-sm mb-2 d-block">
                               <i class="ti ti-user me-1"></i>Diupload Oleh
                           </label>
                           <h6 class="mb-0">{{ $dokumenPerencanaan->uploader->name }}</h6>
                       </div>

                       <!-- Published Date -->
                       <div class="p-3 bg-light rounded">
                           <label class="text-muted text-sm mb-2 d-block">
                               <i class="ti ti-calendar me-1"></i>Tanggal Publish
                           </label>
                           <h6 class="mb-0">{{ $dokumenPerencanaan->published_at->format('d M Y, H:i') }}</h6>
                       </div>
                   </div>
               </div>
           </div>

           <!-- Quick Actions -->
           <div class="card">
               <div class="card-header">
                   <h5 class="mb-0">
                       <i class="ti ti-bolt me-2"></i>Aksi Cepat
                   </h5>
               </div>
               <div class="card-body">
                   <div class="d-grid gap-2">
                       <a href="{{ route('opd.dokumen.download', $dokumenPerencanaan->id) }}" 
                          class="btn btn-primary">
                           <i class="ti ti-download me-2"></i>Download Dokumen
                       </a>
                       <button onclick="window.print()" class="btn btn-outline-secondary">
                           <i class="ti ti-printer me-2"></i>Print Halaman
                       </button>
                       <a href="{{ route('opd.dokumen.index') }}" class="btn btn-outline-secondary">
                           <i class="ti ti-arrow-left me-2"></i>Kembali ke Daftar
                       </a>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <style>
       @media print {
           .btn, .card-header, nav, footer {
               display: none !important;
           }
           
           iframe {
               height: auto !important;
               page-break-inside: avoid;
           }
       }
   </style>
</x-app>