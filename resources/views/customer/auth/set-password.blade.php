<x-guest-layout>
    <div class="relative min-h-screen flex items-center justify-center bg-gray-900">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/login-bg.jpg') }}" class="w-full h-full object-cover opacity-40">
            <!-- Blueish Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-[#002e5a] via-transparent to-[#002e5a] opacity-70"></div>
        </div>

        <!-- Password Reset Card -->
        <div class="relative z-10 w-full max-w-lg p-8 mx-4">
            <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-12 border border-white/20">

                <!-- Gree Logo -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('images/gree-logo.png') }}" alt="GREE" class="h-14 w-auto drop-shadow-md">
                </div>

                <div class="text-center mb-8">
                    <h1 class="text-2xl font-extrabold text-[#0054a6] tracking-tight text-shadow">Set Your Password</h1>
                    <p class="text-gray-500 text-sm mt-1">Welcome! Please set your password to activate your account.
                    </p>
                </div>

                <form method="POST" action="{{ route('customer.password.update') }}">
                    @csrf

                    <!-- Hidden Fields -->
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="signature" value="{{ $signature }}">
                    <input type="hidden" name="expires" value="{{ $expires }}">

                    <!-- Email Display (Read-only) -->
                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">Email
                            Address</label>
                        <input type="email" value="{{ $email }}" disabled
                            class="block w-full px-4 py-4 bg-gray-100 border border-gray-200 rounded-2xl text-gray-600">
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">New
                            Password</label>
                        <input type="password" name="password" required autofocus
                            class="block w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-[#0054a6] focus:border-transparent transition-all duration-200 outline-none"
                            placeholder="Enter your password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2 ml-1">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" required
                            class="block w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-[#0054a6] focus:border-transparent transition-all duration-200 outline-none"
                            placeholder="Confirm your password">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-[#0054a6] hover:bg-[#004080] text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-900/20 transform transition-all duration-300 hover:scale-[1.02] active:scale-[0.98]">
                        Set Password & Activate Account
                    </button>
                </form>

                <div class="mt-10 text-center">
                    <p class="text-xs text-gray-400 font-medium tracking-widest uppercase">
                        &copy; {{ date('Y') }} Gree Pakistan Ltd.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
