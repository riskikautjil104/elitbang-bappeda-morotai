@extends('components.layout')

@section('title', 'Edit Tentang')

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">Edit Data Tentang</h4>
            </div>
            <div class="card-body">
               <form action="{{ route('tentang.admin.update', $tentang) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="row">
                     <div class="col-md-8">
                        <div class="mb-3">
                           <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                           <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                              name="judul" value="{{ old('judul', $tentang->judul) }}" required>
                           @error('judul')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="mb-3">
                           <label for="konten" class="form-label">Konten <span class="text-danger">*</span></label>
                           <textarea class="form-control @error('konten') is-invalid @enderror" id="konten"
                              name="konten" rows="10" required>{{ old('konten', $tentang->konten) }}</textarea>
                           @error('konten')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="mb-3">
                           <label for="gambar" class="form-label">Gambar</label>
                           @if($tentang->gambar)
                           <div class="mb-2">
                              <img src="{{ asset('storage/' . $tentang->gambar) }}" alt="Current Image"
                                 class="img-thumbnail" style="max-width: 200px;">
                           </div>
                           @endif
                           <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar"
                              name="gambar" accept="image/*">
                           @error('gambar')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                           <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin
                              mengubah gambar.</div>
                        </div>

                        <div class="mb-3">
                           <label for="urutan" class="form-label">Urutan</label>
                           <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan"
                              name="urutan" value="{{ old('urutan', $tentang->urutan) }}" min="1">
                           @error('urutan')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror
                        </div>

                        <div class="mb-3">
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{
                                 old('status', $tentang->status) ? 'checked' : '' }}>
                              <label class="form-check-label" for="status">
                                 Aktif
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="d-flex justify-content-between">
                     <a href="{{ route('tentang.admin.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                     </a>
                     <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@push('scripts')
<script>
   // Initialize CKEditor or any rich text editor if needed
    // For now, we'll use basic textarea
</script>
@endpush
@endsection