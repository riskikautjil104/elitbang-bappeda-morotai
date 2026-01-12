<x-app>
   <div class="grid grid-cols-12 gap-x-6">
       <div class="col-span-12">
           <!-- Hero Section -->
           <div class="card bg-primary text-white mb-4" style="background: linear-gradient(135deg, #1A5F7A 0%, #159895 100%);">
               <div class="card-body">
                   <div class="row align-items-center">
                       <div class="col-md-8">
                           <h3 class="text-white mb-2">
                               <i class="ti ti-file-text me-2"></i>Dokumen Perencanaan
                           </h3>
                           <p class="text-white-50 mb-0">
                               Akses dokumen perencanaan yang tersedia untuk {{ Auth::user()->name }}
                           </p>
                       </div>
                       <div class="col-md-4 text-end">
                           <div class="d-flex justify-content-end gap-3">
                               <div class="text-center">
                                   <h4 class="text-white mb-0">{{ $dokumens->total() }}</h4>
                                   <small class="text-white-50">Total Dokumen</small>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <div class="card">
               <div class="card-header">
                   <div class="flex items-center justify-between">
                       <h5 class="mb-0">
                           <i class="ti ti-folder me-2"></i>Daftar Dokumen
                       </h5>
                   </div>
               </div>

               <div class="card-body">
                   <!-- Filter Section -->
                   <div class="row mb-4">
                       <div class="col-md-4">
                           <select class="form-select" id="filterJenis" onchange="applyFilter()">
                               <option value="">Semua Jenis Dokumen</option>
                               <option value="RPJMD" {{ request('jenis') == 'RPJMD' ? 'selected' : '' }}>RPJMD</option>
                               <option value="RPJPD" {{ request('jenis') == 'RPJPD' ? 'selected' : '' }}>RPJPD</option>
                               <option value="RKPD" {{ request('jenis') == 'RKPD' ? 'selected' : '' }}>RKPD</option>
                               <option value="RENSTRA" {{ request('jenis') == 'RENSTRA' ? 'selected' : '' }}>RENSTRA</option>
                               <option value="RENJA" {{ request('jenis') == 'RENJA' ? 'selected' : '' }}>RENJA</option>
                               <option value="Lainnya" {{ request('jenis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                           </select>
                       </div>
                       <div class="col-md-3">
                           <select class="form-select" id="filterTahun" onchange="applyFilter()">
                               <option value="">Semua Tahun</option>
                               @foreach($years as $year)
                               <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="col-md-5">
                           <div class="input-group">
                               <span class="input-group-text"><i class="ti ti-search"></i></span>
                               <input type="text" class="form-control" id="searchDokumen" 
                                      placeholder="Cari judul dokumen..." onkeyup="searchTable()">
                           </div>
                       </div>
                   </div>

                   <!-- Document Cards -->
                   <div class="row" id="dokumentList">
                       @forelse($dokumens as $dokumen)
                       <div class="col-md-6 col-lg-4 mb-4 dokumen-item">
                           <div class="card document-card h-100" style="transition: all 0.3s ease;">
                               <div class="card-body">
                                   <!-- Header -->
                                   <div class="flex items-start justify-between mb-3">
                                       <div class="flex items-center gap-2">
                                           <div class="avtar avtar-s bg-light-primary text-primary">
                                               <i class="ti ti-file-text"></i>
                                           </div>
                                           <span class="badge bg-primary">{{ $dokumen->jenis }}</span>
                                       </div>
                                       <span class="badge bg-light-secondary">{{ $dokumen->tahun }}</span>
                                   </div>

                                   <!-- Title -->
                                   <h5 class="mb-2" style="min-height: 48px;">
                                       {{ Str::limit($dokumen->judul, 60) }}
                                   </h5>

                                   <!-- Description -->
                                   @if($dokumen->deskripsi)
                                   <p class="text-muted text-sm mb-3" style="min-height: 40px;">
                                       {{ Str::limit($dokumen->deskripsi, 80) }}
                                   </p>
                                   @else
                                   <p class="text-muted text-sm mb-3" style="min-height: 40px;">
                                       Tidak ada deskripsi
                                   </p>
                                   @endif

                                   <!-- File Info -->
                                   <div class="mb-3 p-2 bg-light rounded">
                                       <small class="text-muted d-block">
                                           <i class="ti ti-paperclip me-1"></i>
                                           {{ Str::limit($dokumen->file_name, 35) }}
                                       </small>
                                       <small class="text-muted">
                                           <i class="ti ti-file me-1"></i>{{ $dokumen->getFileSizeFormatted() }}
                                       </small>
                                   </div>

                                   <!-- Meta Info -->
                                   <div class="border-top pt-3 mb-3">
                                       <div class="flex items-center justify-between text-sm">
                                           <span class="text-muted">
                                               <i class="ti ti-calendar me-1"></i>
                                               {{ $dokumen->published_at->format('d M Y') }}
                                           </span>
                                           @if($dokumen->visibility === 'opd_terpilih')
                                           @php
                                               $pivot = $dokumen->getReadStatusForOpd(Auth::id());
                                           @endphp
                                           @if($pivot && $pivot->is_read)
                                           <span class="badge bg-success">
                                               <i class="ti ti-check me-1"></i>Sudah Dibaca
                                           </span>
                                           @else
                                           <span class="badge bg-warning">
                                               <i class="ti ti-clock me-1"></i>Belum Dibaca
                                           </span>
                                           @endif
                                       @endif
                                       </div>
                                   </div>

                                   <!-- Actions -->
                                   <div class="d-grid gap-2">
                                       <a href="{{ route('opd.dokumen.show', $dokumen->id) }}" 
                                          class="btn btn-primary btn-sm">
                                           <i class="ti ti-eye me-1"></i>Lihat Detail
                                       </a>
                                       <a href="{{ route('opd.dokumen.download', $dokumen->id) }}" 
                                          class="btn btn-outline-secondary btn-sm">
                                           <i class="ti ti-download me-1"></i>Download
                                       </a>
                                   </div>
                               </div>
                           </div>
                       </div>
                       @empty
                       <div class="col-12">
                           <div class="text-center py-12">
                               <div class="flex flex-col items-center gap-2">
                                   <div class="avtar avtar-xl bg-light-primary text-primary mb-3">
                                       <i class="ti ti-inbox" style="font-size: 48px;"></i>
                                   </div>
                                   <h5 class="mb-2">Belum Ada Dokumen</h5>
                                   <p class="text-muted">Belum ada dokumen perencanaan yang tersedia untuk Anda saat ini.</p>
                               </div>
                           </div>
                       </div>
                       @endforelse
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

   <style>
       .document-card {
           border: 2px solid transparent;
           transition: all 0.3s ease;
       }

       .document-card:hover {
           transform: translateY(-5px);
           box-shadow: 0 10px 30px rgba(26, 95, 122, 0.15);
           border-color: #159895;
       }

       .bg-primary-light {
           background: linear-gradient(135deg, rgba(26, 95, 122, 0.1) 0%, rgba(21, 152, 149, 0.1) 100%);
       }
   </style>

   <script>
       function searchTable() {
           const search = document.getElementById('searchDokumen').value.toLowerCase();
           document.querySelectorAll('.dokumen-item').forEach(item => {
               const text = item.textContent.toLowerCase();
               item.style.display = text.includes(search) ? '' : 'none';
           });
       }

       function applyFilter() {
           const jenis = document.getElementById('filterJenis').value;
           const tahun = document.getElementById('filterTahun').value;
           
           let url = new URL(window.location.href);
           
           if (jenis) {
               url.searchParams.set('jenis', jenis);
           } else {
               url.searchParams.delete('jenis');
           }
           
           if (tahun) {
               url.searchParams.set('tahun', tahun);
           } else {
               url.searchParams.delete('tahun');
           }
           
           window.location.href = url.toString();
       }
   </script>
</x-app>