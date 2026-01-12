<x-app>
    <div class="grid grid-cols-12 gap-x-6">
       <div class="col-span-12">
          <div class="card">
             <div class="card-header">
                <div class="flex items-center justify-between">
                   <h5 class="mb-0"><i class="ti ti-lock me-2"></i>Change Password</h5>
                   <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                      <i class="ti ti-arrow-left me-1"></i>Back to Dashboard
                   </a>
                </div>   
             </div>
 
             <div class="card-body">
                <form method="POST" action="{{ route('change-password.update') }}">
                   @csrf
 
                   <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <!-- Current Password -->
                      <div class="mb-3">
                         <label class="form-label">Current Password <span class="text-danger">*</span></label>
                         <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-lock"></i></span>
                            <input name="current_password" type="password" id="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               placeholder="Enter current password" required>
                            <button class="btn btn-outline-secondary" type="button"
                               onclick="togglePassword('current_password')">
                               <i class="ti ti-eye" id="current_password_icon"></i>
                            </button>
                         </div>
                         @error('current_password')
                         <div class="invalid-feedback d-block">{{ $message }}</div>
                         @enderror
                      </div>
 
                      <!-- New Password -->
                      <div class="mb-3">
                         <label class="form-label">New Password <span class="text-danger">*</span></label>
                         <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-lock"></i></span>
                            <input name="password" type="password" id="password"
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="Min. 8 characters (uppercase, lowercase, numbers)"
                               required>
                            <button class="btn btn-outline-secondary" type="button"
                               onclick="togglePassword('password')">
                               <i class="ti ti-eye" id="password_icon"></i>
                            </button>
                         </div>
                         @error('password')
                         <div class="invalid-feedback d-block">{{ $message }}</div>
                         @enderror
                      </div>
 
                      <!-- Confirm New Password -->
                      <div class="mb-3">
                         <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                         <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-lock"></i></span>
                            <input name="password_confirmation" type="password" id="password_confirmation" 
                               class="form-control"
                               placeholder="Confirm new password" required>
                            <button class="btn btn-outline-secondary" type="button"
                               onclick="togglePassword('password_confirmation')">
                               <i class="ti ti-eye" id="password_confirmation_icon"></i>
                            </button>
                         </div>
                      </div>
                   </div>
 
                   <div class="alert alert-info">
                      <i class="ti ti-info-circle me-2"></i>
                      <strong>Password Requirements:</strong>
                      <ul class="mb-0 mt-2">
                         <li>Minimum 8 characters</li>
                         <li>Contains uppercase and lowercase letters</li>
                         <li>Contains numbers</li>
                      </ul>
                   </div>
 
                   <div class="flex justify-end gap-2">
                      <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                         <i class="ti ti-x me-1"></i>Cancel
                      </a>
                      <button type="submit" class="btn btn-primary">
                         <i class="ti ti-device-floppy me-1"></i>Update Password
                      </button>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 
    <!-- SweetAlert2 CDN -->
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
 
    <script>
       function togglePassword(inputId) {
          const input = document.getElementById(inputId);
          const icon = document.getElementById(inputId + '_icon');
 
          if (input.type === 'password') {
             input.type = 'text';
             icon.classList.replace('ti-eye', 'ti-eye-off');
          } else {
             input.type = 'password';
             icon.classList.replace('ti-eye-off', 'ti-eye');
          }
       }
 
       // Success Alert
       @if(session('success'))
       Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '{{ session('success') }}',
          timer: 3000,
          showConfirmButton: false
       });
       @endif
 
       // Error Alert
       @if($errors->any())
       Swal.fire({
          icon: 'error',
          title: 'Failed!',
          html: `
             <ul class="text-start">
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
             </ul>
          `,
          confirmButtonText: 'OK'
       });
       @endif
    </script>
 
    <style>
       .invalid-feedback {
          display: block !important;
       }
    </style>
 </x-app>