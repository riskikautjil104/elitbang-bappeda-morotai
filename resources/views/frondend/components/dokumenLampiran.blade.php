<div class="detail-card mb-4">
   <div class="detail-card-header header-info">
      <i class="lni-files mr-2"></i>
      <h5>Dokumen Lampiran</h5>
   </div>
   <div class="detail-card-body">
      <div class="row">
         @if($laporan->file_laporan)
         <div class="col-md-6 mb-3">
            <div class="document-card">
               <div class="document-icon">
                  <i class="lni-file"></i>
               </div>
               <div class="document-info">
                  <h6>Laporan PDF</h6>
                  <p class="text-muted small">{{ basename($laporan->file_laporan) }}</p>
                  <a href="{{ asset('storage/' . $laporan->file_laporan) }}" target="_blank" class="btn btn-download btn-sm">
                     <i class="lni-download mr-1"></i> Download
                  </a>
               </div>
            </div>
         </div>
         @endif

         @if($laporan->file_sk)
         <div class="col-md-6 mb-3">
            <div class="document-card">
               <div class="document-icon">
                  <i class="lni-file"></i>
               </div>
               <div class="document-info">
                  <h6>Surat Keputusan</h6>
                  <p class="text-muted small">{{ basename($laporan->file_sk) }}</p>
                  <a href="{{ asset('storage/' . $laporan->file_sk) }}" target="_blank" class="btn btn-download btn-sm">
                     <i class="lni-download mr-1"></i> Download
                  </a>
               </div>
            </div>
         </div>
         @endif

         @if($laporan->file_pemaparan)
         <div class="col-md-6 mb-3">
            <div class="document-card">
               <div class="document-icon">
                  <i class="lni-file"></i>
               </div>
               <div class="document-info">
                  <h6>Presentasi/Pemaparan</h6>
                  <p class="text-muted small">{{ basename($laporan->file_pemaparan) }}</p>
                  <a href="{{ asset('storage/' . $laporan->file_pemaparan) }}" target="_blank" class="btn btn-download btn-sm">
                     <i class="lni-download mr-1"></i> Download
                  </a>
               </div>
            </div>
         </div>
         @endif

         @if(!empty($laporan->file_dokumentasi_array))
         <div class="col-md-6 mb-3">
            <div class="document-card">
               <div class="document-icon">
                  <i class="lni-image"></i>
               </div>
               <div class="document-info">
                  <h6>Dokumentasi</h6>
                  <p class="text-muted small">{{ count($laporan->file_dokumentasi_array) }} file</p>
                  @foreach($laporan->file_dokumentasi_array as $file)
                  <a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-download btn-sm mb-1">
                     <i class="lni-eye mr-1"></i> Lihat
                  </a>
                  @endforeach
               </div>
            </div>
         </div>
         @endif
      </div>
   </div>
</div>