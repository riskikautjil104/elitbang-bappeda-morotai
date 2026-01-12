@extends('components.layout')

@section('title', 'Detail Tentang')

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <h4 class="card-title">Detail Data Tentang</h4>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-8">
                     <table class="table table-borderless">
                        <tr>
                           <th width="150">Judul:</th>
                           <td>{{ $tentang->judul }}</td>
                        </tr>
                        <tr>
                           <th>Konten:</th>
                           <td>
                              <div class="content-preview">
                                 {!! nl2br(e($tentang->konten)) !!}
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <th>Status:</th>
                           <td>
                              <span class="badge {{ $tentang->status ? 'bg-success' : 'bg-danger' }}">
                                 {{ $tentang->status ? 'Aktif' : 'Tidak Aktif' }}
                              </span>
                           </td>
                        </tr>
                        <tr>
                           <th>Urutan:</th>
                           <td>{{ $tentang->urutan }}</td>
                        </tr>
                        <tr>
                           <th>Dibuat:</th>
                           <td>{{ $tentang->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                           <th>Diupdate:</th>
                           <td>{{ $tentang->updated_at->format('d M Y H:i') }}</td>
                        </tr>
                     </table>
                  </div>

                  <div class="col-md-4">
                     @if($tentang->gambar)
                     <div class="mb-3">
                        <label class="form-label">Gambar:</label>
                        <div>
                           <img src="{{ asset('storage/' . $tentang->gambar) }}" alt="{{ $tentang->judul }}"
                              class="img-fluid rounded shadow">
                        </div>
                     </div>
                     @else
                     <div class="mb-3">
                        <label class="form-label">Gambar:</label>
                        <div class="text-muted">
                           <i class="fas fa-image"></i> Tidak ada gambar
                        </div>
                     </div>
                     @endif
                  </div>
               </div>

               <div class="d-flex justify-content-between mt-4">
                  <a href="{{ route('tentang.admin.index') }}" class="btn btn-secondary">
                     <i class="fas fa-arrow-left"></i> Kembali
                  </a>
                  <div>
                     <a href="{{ route('tentang.admin.edit', $tentang) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                     </a>
                     <form action="{{ route('tentang.admin.destroy', $tentang) }}" method="POST" class="d-inline"
                        id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                           <i class="fas fa-trash"></i> Hapus
                        </button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<style>
   .content-preview {
      max-height: 300px;
      overflow-y: auto;
      padding: 10px;
      background: #f8f9fa;
      border-radius: 5px;
      line-height: 1.6;
   }
</style>
@endsection