<x-guest-layout>
    <div class="relative min-h-screen flex items-center justify-center bg-gray-900">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/login-bg.jpg') }}" class="w-full h-full object-cover opacity-40">
            <!-- Blueish Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#002e5a] via-transparent to-[#002e5a] opacity-70"></div>
        </div>

        <!-- Set Password Card -->
        <div class="relative z-10 w-full max-w-lg p-8 mx-4">
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-12 border border-white/20">

                <!-- Gree Logo -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/gree-logo.png') }}" alt="GREE" class="h-14 w-auto drop-shadow-md">
                </div>

                <div class="text-center mb-8">
                    <h1 class="text-2xl font-extrabold text-[#0054a6] tracking-tight text-shadow">Set Your Password</h1>
                    <p class="text-gray-500 text-sm mt-2">Create a secure password for your account</p>
                </div>

                <form method="POST" action="{{ route('user.password.update') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- Email Field (Readonly) -->
                    <div class="mb-6">
                        <label for="email_display" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input id="email_display" type="email" value="{{ $email }}"
                                class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl bg-gray-50 text-gray-600 cursor-not-allowed"
                                readonly>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            New Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password"
                                class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0054a6] focus:border-transparent transition-all duration-200 @error('password') border-red-500 @enderror"
                                placeholder="Enter new password" required>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-8">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Confirm Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                class="block w-full pl-12 pr-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0054a6] focus:border-transparent transition-all duration-200 @error('password_confirmation') border-red-500 @enderror"
                                placeholder="Confirm new password" required>
                        </div>
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-[#0054a6] to-[#003d7a] text-white font-bold py-3.5 px-4 rounded-xl hover:from-[#003d7a] hover:to-[#002e5a] transform hover:scale-[1.02] transition-all duration-200 shadow-lg hover:shadow-xl">
                            Set Password
                        </button>
                    </div>
                </form>

                <!-- Back to Login Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}"
                        class="text-sm text-[#0054a6] hover:text-[#003d7a] font-medium transition-colors duration-200">
                        ← Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (session('error') || session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('error'))
                    toastr.error('{{ session('error') }}');
                @endif

                @if (session('success'))
                    toastr.success('{{ session('success') }}');
                @endif
            });
        </script>
    @endif
</x-guest-layout>
