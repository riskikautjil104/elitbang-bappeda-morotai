<header class="pc-header">
   <div class="header-wrapper flex max-sm:px-[15px] px-[25px] grow">
      <!-- [Mobile Media Block] start -->
      <div class="me-auto pc-mob-drp">
         <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
            <!-- ======= Menu collapse Icon ===== -->
            <li class="pc-h-item pc-sidebar-collapse max-lg:hidden lg:inline-flex"> <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="sidebar-hide"> <i class="ti ti-menu-2"></i> </a> </li>
            <li class="pc-h-item pc-sidebar-popup lg:hidden"> <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="mobile-collapse"> <i class="ti ti-menu-2 text-2xl leading-none"></i> </a> </li>
            <li class="pc-h-item max-md:hidden md:inline-flex">
               {{-- <form class="form-search relative"> <i class="search-icon absolute top-[14px] left-[15px]">
                     <svg class="pc-icon w-4 h-4">
                        <use xlink:href="#custom-search-normal-1"></use>
                     </svg> </i> <input type="search" class="form-control px-2.5 pr-3 pl-10 w-[198px] leading-none" placeholder="Ctrl + K" />
               </form> --}}
            </li>
         </ul>
      </div> <!-- [Mobile Media Block end] -->
      <div class="ms-auto">
         <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
            <li class="dropdown pc-h-item"> <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> <svg class="pc-icon">
                     <use xlink:href="#custom-notification"></use>
                  </svg> @php
                  $notifications = auth()->user()->unreadNotifications->take(5);
                  $countNotif = auth()->user()->unreadNotifications->count();
                  @endphp @if ($countNotif > 0)
                  <span class="badge bg-success-500 text-white rounded-full z-10 absolute right-0 top-0">
                     {{ $countNotif }} </span>
                  @endif </a>
               <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown p-2">
                  <div class="dropdown-header flex items-center justify-between py-4 px-5">
                     @if ($notifications->count() > 0)
                     <form action="{{ route('notifications.markRead') }}" method="POST" class="flex w-full justify-between items-center">
                        @csrf
                        <h5 class="m-0">Notifications</h5> <button class="btn btn-link btn-sm" type="submit">Mark all
                           read</button>
                     </form>
                     @endif
                  </div>
                  <div class="dropdown-body header-notification-scroll relative py-4 px-5" style="max-height: calc(100vh - 215px)">
                     @forelse ($notifications as $notif)
                     <div class="card mb-2">
                        <div class="card-body">
                           <div class="flex gap-4">
                              <div class="shrink-0"> <svg class="pc-icon text-primary-500 w-[22px] h-[22px]">
                                    <use xlink:href="#custom-document-text"></use>
                                 </svg> </div>
                              <div class="grow"> <span class="float-end text-sm text-muted">
                                    {{ $notif->created_at->diffForHumans() }} </span>
                                 <h5 class="text-body mb-2"> {{ $notif->data['title'] }} </h5>
                                 <p class="mb-0"> {{ $notif->data['message'] }} </p>
                              </div>
                           </div>
                        </div>
                     </div> @empty <p class="text-center text-gray-500">Tidak ada notifikasi</p>
                     @endforelse
                  </div>
               </div>
            </li>
            <li class="dropdown pc-h-item header-user-profile"> <a class="pc-head-link dropdown-toggle arrow-none me-0" data-pc-toggle="dropdown" href="#" role="button" aria-haspopup="false" data-pc-auto-close="outside" aria-expanded="false"> <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image" class="user-avtar w-10 h-10 rounded-full" /> </a>
               <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-2">
                  <div class="dropdown-header flex items-center justify-between py-4 px-5">
                     <h5 class="m-0">Profile</h5>
                  </div>
                  <div class="profile-notification-scroll position-relative h-95">
                     <div class="dropdown-body py-4 px-5">
                        <div class="flex mb-1 items-center">
                           {{-- <div class="shrink-0"> <img src="{{ asset('assets/images/user/avatar-2.jpg') }}" alt="user-image" class="w-10 rounded-full" /> </div> --}}
                           <div class="w-10 rounded-full">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                           <div class="grow ms-3">
                            
                              <h6 class="mb-1">{{ Auth::user()->name }} 🖖</h6> <span>{{ Auth::user()->getRoleNames()[0] ?? 'User' }}</span>
                           </div>
                        </div>
                        <hr class="border-secondary-500/10 my-4" />
                        
                        <p class="text-span mb-3">Manage</p>
                        
                           @if (Auth::user()->hasRole('opd'))
                              <a href="{{ route('change-password-opd.form') }}" class="dropdown-item"> 
                                 <span> 
                                 <svg class="pc-icon text-muted me-2 inline-block">
                                 <use xlink:href="#custom-lock-outline">

                                 </use>
                              </svg> 
                              <span>Change Password</span> 
                           </span> 
                        </a>
                        @else
                        <a href="{{ route('change-password.form') }}" class="dropdown-item"> 
                                 <span> 
                                 <svg class="pc-icon text-muted me-2 inline-block">
                                 <use xlink:href="#custom-lock-outline">

                                 </use>
                              </svg> 
                              <span>Change Password</span> 
                           </span> 
                        </a>
                        @endif
                        <hr class="border-secondary-500/10 my-4" /> 
                         <form method="POST" action="{{ route('logout') }}" class="dropdown-item" class="text-danger-500 hover:text-danger-600">
                                @csrf
                                <div class="flex">
                                <button type="submit"
                                    class="flex items-center py-2 gap-2.5  w-full text-left">
                                   <svg class="pc-icon me-2 w-[22px] h-[22px]">
                                 <use xlink:href="#custom-logout-1-outline"></use>
                              </svg> 
                                    <span>Logout</span>
                                </button>
                                </div>
                            </form>
                        
                     </div>
                  </div>
               </div>
            </li>
         </ul>
      </div>
   </div>
</header>
