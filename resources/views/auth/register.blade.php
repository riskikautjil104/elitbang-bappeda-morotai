<x-layout>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg fixed inset-0 bg-white dark:bg-themedark-cardbg z-1034">
        <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0 bg-primary-500/40">
            <div
                class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0 transition-[transform_0.2s_linear] origin-left animate-[2.1s_cubic-bezier(0.65,0.815,0.735,0.395)_0s_infinite_normal_none_running_loader-animate]">
            </div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main relative">
        <div class="auth-wrapper v1 flex items-center w-full h-full min-h-screen">
            <div
                class="auth-form flex items-center justify-center grow flex-col min-h-screen bg-cover relative p-6 bg-[url('../images/authentication/img-auth-bg.jpg')] dark:bg-none dark:bg-themedark-bodybg">
                <div class="card sm:my-12 w-full max-w-[520px] shadow-none">
                    <div class="card-body px-8 py-12 sm:px-12 sm:py-14">
                        <!-- Title Section -->
                        <div class="text-center mb-10">
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-3 text-primary-500">
                                Buat Akun Baru
                            </h2>
                            <p class="text-base text-gray-500 dark:text-gray-400">
                                Daftar untuk mengakses E-Litbang
                            </p>
                        </div>

                        <!-- Form Section -->
                        <div class="space-y-5">
                            <!-- Full Name Input -->
                            <div>
                                <label for="fullName"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Lengkap
                                </label>
                                <input type="text" class="form-control h-12 text-base" id="fullName"
                                    placeholder="Masukkan nama lengkap Anda" />
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label for="emailInput"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Alamat Email
                                </label>
                                <input type="email" class="form-control h-12 text-base" id="emailInput"
                                    placeholder="nama@example.com" />
                            </div>

                            <!-- Phone Number Input -->
                            <div>
                                <label for="phoneInput"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nomor Telepon
                                </label>
                                <input type="tel" class="form-control h-12 text-base" id="phoneInput"
                                    placeholder="08xx xxxx xxxx" />
                            </div>

                            <!-- Password Input -->
                            <div>
                                <label for="passwordInput"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Password
                                </label>
                                <input type="password" class="form-control h-12 text-base" id="passwordInput"
                                    placeholder="Minimal 8 karakter" />
                            </div>

                            <!-- Confirm Password Input -->
                            <div>
                                <label for="confirmPasswordInput"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Konfirmasi Password
                                </label>
                                <input type="password" class="form-control h-12 text-base" id="confirmPasswordInput"
                                    placeholder="Masukkan ulang password Anda" />
                            </div>

                            <!-- Terms & Conditions -->
                            <div class="pt-1">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="termsCheck" />
                                    <label class="form-check-label text-sm text-gray-600 dark:text-gray-400"
                                        for="termsCheck">
                                        Saya menyetujui
                                        <a href="#" class="text-primary-500 hover:text-primary-600 font-medium">
                                            Syarat & Ketentuan
                                        </a>
                                        dan
                                        <a href="#" class="text-primary-500 hover:text-primary-600 font-medium">
                                            Kebijakan Privasi
                                        </a>
                                    </label>
                                </div>
                            </div>

                            <!-- Register Button -->
                            <div class="pt-2">
                                <button type="button"
                                    class="btn btn-primary rounded-lg w-full h-12 text-base font-semibold shadow-sm hover:shadow-md transition-all duration-200">
                                    Daftar Sekarang
                                </button>
                            </div>
                        </div>

                        <!-- Divider -->
                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-white dark:bg-themedark-cardbg text-gray-500 dark:text-gray-400">
                                    atau
                                </span>
                            </div>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Sudah punya akun?
                                <a href={{ route('login') }}
                                    class="font-semibold text-primary-500 hover:text-primary-600 transition-colors ml-1">
                                    Masuk Sekarang
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</x-layout>
