<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header flex items-center py-4 px-6 h-header-height gap-3">
            <div class="flex items-center gap-2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="" width="40">

                <div class="flex flex-col leading-tight">
                    <h1 class="text-lg text-primary-500">E-Litbang</h1>
                    <span class="text-sm text-muted">Kabupaten Pulau Morotai</span>
                </div>
            </div>
        </div>

        <div class="navbar-content h-calc(100vh_-_74px) py-2.5 overflow-y-auto">
            @auth
            <div class="card pc-user-card mx-[15px] mb-[15px] bg-theme-sidebaruserbg dark:bg-themedark-sidebaruserbg">
                <div class="card-body !p-5">
                    <div class="flex items-center">
                       
                            <div class="rounded-full">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        <div class="ml-4 mr-2 grow">
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                            <small class="capitalize">{{ Auth::user()->getRoleNames()[0] ?? 'User' }}</small>
                        </div>
                        <a class="shrink-0 btn btn-icon inline-flex btn-link-secondary" data-pc-toggle="collapse"
                            href="#pc_sidebar_userlink">
                            <svg class="pc-icon w-[22px] h-[22px]">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>

                    <div class="hidden pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3 *:flex *:items-center *:py-2 *:gap-2.5 *:hover:text-primary-500">
                            
                            @if (Auth::user()->hasRole('opd'))
                            <a href="{{ route('change-password-opd.form') }}">
                                <i class="text-lg leading-none ti ti-lock"></i>
                                <span>Ubah Kata Sandi</span>
                            </a>
                            @else
                            <a href="{{ route('change-password.form') }}">
                                <i class="text-lg leading-none ti ti-lock"></i>
                                <span>Change Password</span>
                            </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="flex items-center py-2 gap-2.5 hover:text-primary-500 w-full text-left">
                                    <i class="text-lg leading-none ti ti-power"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endauth

            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>
                <li class="pc-item">
                    <a href="/dashboard" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

             
                @role('superadmin')
                <li class="pc-item pc-caption">
                    <label>Management Users</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('users.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-shield"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">User</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('admin.roles.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-password-check"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Roles Access</span>
                    </a>
                </li>
                @endrole

                <li class="pc-item pc-caption">
                    <label>Reports</label>
                    <svg class="pc-icon">
                        <use xlink:href="#custom-box-1"></use>
                    </svg>
                </li>
                @role('superadmin')
                <li class="pc-item">
                    <a href="{{ route('reports.admin.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-text-block"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Laporan Akhir</span>
                    </a>
                  
                </li>
              <li class="pc-item">
                <a href="{{ route('dokumen-perencanaan.admin.index') }}" class="pc-link">
                    <i class="ti ti-file-text"></i> Dokumen Perencanaan
                </a>
              </li>
                  <li class="pc-item">
                    <a href="{{ route('admin.laporan-realisasi.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-chart"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Realisasi Anggaran</span>
                    </a>
                </li>

               
                @endrole
                @role('opd')
                <li class="pc-item">
                    <a href="{{ route('apps.reports.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-text-block"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Laporan Akhir</span>
                    </a>
                    
                </li>
                <li class="pc-item">
                    <a href="{{ route('opd.dokumen.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-folder text-lg"></i>
                        </span>
                        <span class="pc-mtext">Dokumen Perencanaan</span>
                    </a>
                </li>
                @endrole
                @role('opd')

                <li class="pc-item">
                    <a href="{{ route('apps.reports.drafts') }}" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-clipboard"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext">Arsip Laporan</span>
                    </a>
                </li>
                @endrole
                @role('superadmin')
                <li class="pc-item pc-caption">
                    <label>Content Management</label>
                </li>
                <li class="pc-item">
                    <a href="{{ route('tentang.admin.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-info-circle text-lg"></i>
                        </span>
                        
                        <span class="pc-mtext">Kelola Tentang</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('kontak.admin.index') }}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ti ti-phone text-lg"></i>
                        </span>
                        
                        <span class="pc-mtext">Kelola Kontak</span>
                    </a>
                </li>
                @endrole
             


            </ul>
        </div>
    </div>
</nav>