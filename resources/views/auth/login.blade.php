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
                <div class="card sm:my-12 w-full max-w-[480px] shadow-none">
                    <div class="card-body px-8 py-12 sm:px-12 sm:py-14">
                        <!-- Title Section -->
                        <div class="text-center mb-10">
                            <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-3 text-primary-500">
                                Selamat Datang
                            </h2>
                            <p class="text-base text-gray-500 dark:text-gray-400">
                                Masuk ke akun E-Litbang Anda
                            </p>
                        </div>

                        <!-- Form Section -->
                        <form class="space-y-5" action="{{ route('authenticate') }}" method="POST">
                            @csrf
                            <!-- Email Input -->
                            <div>
                                <label for="floatingInput"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Alamat Email
                                </label>
                                <input type="email" name="email" class="form-control h-12 text-base"
                                    id="floatingInput" placeholder="nama@example.com" />
                                @error('email')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Password Input -->
                            <div>
                                <label for="floatingInput1"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Password
                                </label>
                                <input type="password" name="password" class="form-control h-12 text-base"
                                    id="floatingInput1" placeholder="Masukkan password Anda" />
                                @error('password')
                                    <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Remember & Forgot -->
                            <div class="flex justify-between items-center pt-1">
                                <div class="form-check">
                                    <input class="form-check-input input-primary" type="checkbox" id="customCheckc1"
                                        checked="" />
                                    <label class="form-check-label text-sm text-gray-600 dark:text-gray-400"
                                        for="customCheckc1">
                                        Ingat saya
                                    </label>
                                </div>
                                <a href="forgot-password-v1.html"
                                    class="text-sm font-medium text-primary-500 hover:text-primary-600 transition-colors">
                                    Lupa Password?
                                </a>
                            </div>

                            <!-- Login Button -->
                            <div class="pt-2">
                                <button type="submit"
                                    class="btn btn-primary rounded-lg w-full h-12 text-base font-semibold shadow-sm hover:shadow-md transition-all duration-200">
                                    Masuk
                                </button>
                            </div>
                        </form>

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

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Beralih Ke
                                <a href={{ route('frontend.home') }}
                                    class="font-semibold text-primary-500 hover:text-primary-600 transition-colors ml-1">
                                    Halaman Utama
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