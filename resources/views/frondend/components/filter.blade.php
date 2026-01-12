<section class="section-padding" style="background: #f8f9fa; margin-top: -30px; position: relative; z-index: 10; padding: 30px 0;">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- Toggle Button -->
            <div class="text-center mb-4">
               <button class="btn btn-primary btn-lg" type="button" data-toggle="collapse" data-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse" style="padding: 15px 40px; font-weight: 600; border-radius: 50px; box-shadow: 0 4px 15px rgba(0,0,0,0.15); transition: all 0.3s ease;">
                  <i class="lni-search" style="margin-right: 8px;"></i> CARI & FILTER DATA
                  <i class="lni-chevron-down ml-2" id="toggleIcon"></i>
               </button>
            </div>

            <!-- Collapsible Filter Form -->
            <div class="collapse" id="filterCollapse">
               <div class="card" style="border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); overflow: hidden; background: white;">
                  <div class="card-body" style="padding: 40px 30px;">
                     <form action="{{ route('frontend.data') }}" method="GET" class="filter-form">
                        <div class="row align-items-end">
                           <!-- Search Input -->
                           <div class="col-lg col-md-6 col-12 mb-3">
                              <label style="font-weight: 600; color: #1A5F7A; margin-bottom: 10px; font-size: 0.9rem; display: block;">
                                 <i class="lni-search" style="margin-right: 5px;"></i> Cari Judul
                              </label>
                              <input type="text" name="search" class="form-control" placeholder="Masukkan judul penelitian..."
                                 value="{{ request('search') }}" style="border-radius: 8px; border: 1px solid #ddd; padding: 12px 15px; height: 48px; font-size: 0.95rem;">
                           </div>

                           <!-- OPD Select -->
                           <div class="col-lg col-md-6 col-12 mb-3">
                              <label style="font-weight: 600; color: #1A5F7A; margin-bottom: 10px; font-size: 0.9rem; display: block;">
                                 <i class="lni-user" style="margin-right: 5px;"></i> Organisasi Perangkat Daerah
                              </label>
                              <select name="opd" class="form-control" style="border-radius: 8px; border: 1px solid #ddd; padding: 12px 15px; height: 48px; font-size: 0.95rem; appearance: none; background: white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e') no-repeat right 12px center; background-size: 20px; padding-right: 40px;">
                                 <option value="">Semua OPD</option>
                                 @foreach($opds as $opd)
                                 <option value="{{ $opd->nama_opd }}" {{ request('opd')==$opd->nama_opd ? 'selected' : '' }}>
                                    {{ $opd->nama_opd }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>

                           <!-- Tahun Select -->
                           <div class="col-lg col-md-6 col-12 mb-3">
                              <label style="font-weight: 600; color: #1A5F7A; margin-bottom: 10px; font-size: 0.9rem; display: block;">
                                 <i class="lni-calendar" style="margin-right: 5px;"></i> Tahun
                              </label>
                              <select name="tahun" class="form-control" style="border-radius: 8px; border: 1px solid #ddd; padding: 12px 15px; height: 48px; font-size: 0.95rem; appearance: none; background: white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e') no-repeat right 12px center; background-size: 20px; padding-right: 40px;">
                                 <option value="">Semua Tahun</option>
                                 @foreach($tahuns as $tahun)
                                 <option value="{{ $tahun }}" {{ request('tahun')==$tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>

                           <!-- Jenis Select -->
                           <div class="col-lg col-md-6 col-12 mb-3">
                              <label style="font-weight: 600; color: #1A5F7A; margin-bottom: 10px; font-size: 0.9rem; display: block;">
                                 <i class="lni-list" style="margin-right: 5px;"></i> Jenis Data
                              </label>
                              <select name="jenis" class="form-control" style="border-radius: 8px; border: 1px solid #ddd; padding: 12px 15px; height: 48px; font-size: 0.95rem; appearance: none; background: white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e') no-repeat right 12px center; background-size: 20px; padding-right: 40px;">
                                 <option value="">Semua Jenis</option>
                                 <option value="penelitian" {{ request('jenis')=='penelitian' ? 'selected' : '' }}>
                                    Penelitian
                                 </option>
                                 <option value="pengembangan" {{ request('jenis')=='pengembangan' ? 'selected' : '' }}>
                                    Pengembangan
                                 </option>
                              </select>
                           </div>

                           <!-- Status Select -->
                           <div class="col-lg col-md-6 col-12 mb-3">
                              <label style="font-weight: 600; color: #1A5F7A; margin-bottom: 10px; font-size: 0.9rem; display: block;">
                                 <i class="lni-check-circle" style="margin-right: 5px;"></i> Status
                              </label>
                              <select name="status" class="form-control" style="border-radius: 8px; border: 1px solid #ddd; padding: 12px 15px; height: 48px; font-size: 0.95rem; appearance: none; background: white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e') no-repeat right 12px center; background-size: 20px; padding-right: 40px;">
                                 <option value="">Semua Status</option>
                                 @foreach($statuses as $key => $label)
                                 <option value="{{ $key }}" {{ request('status')==$key ? 'selected' : '' }}>
                                    {{ $label }}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                           <div class="col-12 text-center">
                              <button type="submit" class="btn btn-primary" style="padding: 14px 40px; font-weight: 600; border-radius: 50px; margin-right: 10px; font-size: 0.95rem; min-width: 160px;">
                                 <i class="lni-search" style="margin-right: 5px;"></i> CARI DATA
                              </button>
                              <a href="{{ route('frontend.data') }}" class="btn btn-outline-secondary" style="padding: 14px 40px; font-weight: 600; border-radius: 50px; font-size: 0.95rem; min-width: 160px;">
                                 <i class="lni-reload" style="margin-right: 5px;"></i> RESET FILTER
                              </a>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>

            <!-- Active Filters Display -->
            @if(request()->hasAny(['search', 'opd', 'tahun', 'jenis', 'status']))
            <div class="mt-4 text-center">
               <div class="d-inline-flex align-items-center flex-wrap justify-content-center" style="gap: 10px;">
                  <span style="font-weight: 600; color: #666; font-size: 0.95rem;">Filter Aktif:</span>
                  
                  @if(request('search'))
                  <span class="badge badge-primary" style="padding: 10px 18px; font-size: 0.9rem; border-radius: 25px; font-weight: 500;">
                     <i class="lni-search" style="margin-right: 5px;"></i> "{{ request('search') }}"
                  </span>
                  @endif

                  @if(request('opd'))
                  <span class="badge badge-info" style="padding: 10px 18px; font-size: 0.9rem; border-radius: 25px; font-weight: 500;">
                     <i class="lni-user" style="margin-right: 5px;"></i> {{ request('opd') }}
                  </span>
                  @endif

                  @if(request('tahun'))
                  <span class="badge badge-success" style="padding: 10px 18px; font-size: 0.9rem; border-radius: 25px; font-weight: 500;">
                     <i class="lni-calendar" style="margin-right: 5px;"></i> {{ request('tahun') }}
                  </span>
                  @endif

                  @if(request('jenis'))
                  <span class="badge badge-warning" style="padding: 10px 18px; font-size: 0.9rem; border-radius: 25px; font-weight: 500;">
                     <i class="lni-list" style="margin-right: 5px;"></i> {{ ucfirst(request('jenis')) }}
                  </span>
                  @endif

                  @if(request('status'))
                  <span class="badge badge-secondary" style="padding: 10px 18px; font-size: 0.9rem; border-radius: 25px; font-weight: 500;">
                     <i class="lni-check-circle" style="margin-right: 5px;"></i> {{ $statuses[request('status')] ?? request('status') }}
                  </span>
                  @endif
               </div>
            </div>
            @endif

         </div>
      </div>
   </div>
</section>
<script>
   // Toggle icon rotation when collapse is triggered
   document.addEventListener('DOMContentLoaded', function() {
      const filterCollapse = document.getElementById('filterCollapse');
      const toggleIcon = document.getElementById('toggleIcon');
      
      if (filterCollapse && toggleIcon) {
         filterCollapse.addEventListener('show.bs.collapse', function () {
            toggleIcon.style.transform = 'rotate(180deg)';
            toggleIcon.style.transition = 'transform 0.3s ease';
         });
         
         filterCollapse.addEventListener('hide.bs.collapse', function () {
            toggleIcon.style.transform = 'rotate(0deg)';
            toggleIcon.style.transition = 'transform 0.3s ease';
         });
      }
   
      // Auto-open if there are active filters
      @if(request()->hasAny(['search', 'opd', 'tahun', 'jenis', 'status']))
      if (filterCollapse) {
         $(filterCollapse).collapse('show');
      }
      @endif
   });
   </script>
   
   <style>
   /* Button hover effect */
   .btn-primary{
      background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%);
      border: #159895;
   }
   .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
      background: linear-gradient(135deg, #1a5f7a 0%, #159895 100%);
   }
   
   .btn-outline-secondary {
      border: 2px solid #6c757d;
      color: #6c757d;
   }
   
   .btn-outline-secondary:hover {
      background: #6c757d;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
   }
   
   /* Form control focus effect */
   .form-control:focus {
      border-color: #159895;
      box-shadow: 0 0 0 0.2rem rgba(21, 152, 149, 0.15);
      outline: none;
   }
   
   .form-control:hover {
      border-color: #159895;
   }
   
   /* Remove default select arrow in IE */
   select.form-control::-ms-expand {
      display: none;
   }
   
   /* Smooth collapse animation */
   .collapse {
      transition: height 0.35s ease;
   }
   
   /* Badge hover effect */
   .badge {
      transition: all 0.3s ease;
      cursor: pointer;
   }
   
   .badge:hover {
      transform: scale(1.05);
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
   }
   
   /* Label styling */
   label {
      user-select: none;
   }
   
   /* Responsive adjustments */
   @media (max-width: 991px) {
      .row.align-items-end > [class*="col-"] {
         margin-bottom: 20px !important;
      }
      
      .btn-primary, .btn-outline-secondary {
         display: block;
         width: 100%;
         margin: 5px 0 !important;
      }
   }
   
   /* Card shadow on hover */
   .card:hover {
      box-shadow: 0 8px 25px rgba(0,0,0,0.12);
      transition: box-shadow 0.3s ease;
   }
   </style>