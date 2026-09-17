<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | CarryOn Academic Management</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>
<body class="bg-[#F8FAFC] text-gray-900 min-h-screen flex flex-col justify-between selection:bg-blue-100 selection:text-blue-900">

    <!-- Background Subtle Decorative Pattern -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="absolute -top-[20%] -left-[10%] w-[600px] h-[600px] rounded-full bg-blue-50/70 blur-3xl"></div>
        <div class="absolute top-[40%] -right-[15%] w-[600px] h-[600px] rounded-full bg-teal-50/60 blur-3xl"></div>
    </div>

    <!-- Main Container -->
    <div class="flex-1 flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-[440px] space-y-8">

            <!-- Logo & Brand Header -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center gap-3 mb-2">
                    <img
                        src="{{ asset('images/carryon_logo_mark_v2.png') }}"
                        alt="CarryOn Logo"
                        class="h-10 w-auto object-contain drop-shadow-sm"
                    >
                    <div class="text-left leading-tight">
                        <div class="text-2xl font-black tracking-tight text-gray-950 font-sans">CarryOn</div>
                        <div class="text-[10px] tracking-[0.2em] font-semibold text-gray-400 uppercase">ACADEMIC MANAGEMENT</div>
                    </div>
                </div>
                <h2 class="mt-4 text-xl font-bold tracking-tight text-gray-900">
                    Welcome back
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Please enter your institutional credentials to continue
                </p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-8 sm:p-9 transition-all">

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-5 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-sm">
                        <span class="material-symbols-outlined text-emerald-600 text-[20px]">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm">
                        <span class="material-symbols-outlined text-red-500 text-[20px] mt-0.5">error</span>
                        <div class="flex-1 leading-snug">
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form action="{{ route('authenticate') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-600 mb-2">
                            Academic Email
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px] pointer-events-none">
                                mail
                            </span>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="name@usjr.edu.ph"
                                class="w-full h-11 pl-11 pr-4 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition duration-150"
                                required
                                autocomplete="email"
                            >
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="text-xs font-semibold uppercase tracking-wider text-gray-600">
                                Password
                            </label>
                            <a href="#" class="text-xs font-medium text-blue-600 hover:text-blue-700 hover:underline transition">
                                Forgot Password?
                            </a>
                        </div>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-[20px] pointer-events-none">
                                lock
                            </span>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                class="w-full h-11 pl-11 pr-11 text-sm rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 placeholder-gray-400 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none transition duration-150"
                                required
                                autocomplete="current-password"
                            >
                            <button
                                type="button"
                                onclick="togglePasswordVisibility()"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
                                title="Toggle password visibility"
                            >
                                <span id="toggle-icon" class="material-symbols-outlined text-[20px]">
                                    visibility
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-1">
                        <label class="flex items-center gap-2.5 text-sm text-gray-600 cursor-pointer select-none">
                            <input
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 cursor-pointer"
                            >
                            <span>Remember me on this device</span>
                        </label>
                    </div>

                    <!-- Sign In Submit Button -->
                    <button
                        type="submit"
                        class="w-full h-11 rounded-xl bg-gray-900 hover:bg-black text-white text-sm font-semibold shadow-sm hover:shadow transition-all duration-200 flex items-center justify-center gap-2 group mt-2"
                    >
                        <span>Sign In</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:translate-x-0.5 transition-transform">
                            arrow_forward
                        </span>
                    </button>
                </form>

                <!-- Registration / Help Link -->
                <div class="mt-6 pt-5 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-500">
                        Don't have an account?
                        <a href="{{ route('registration') }}" class="font-semibold text-blue-600 hover:text-blue-700 hover:underline">
                            Register now
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer Note -->
            <p class="text-center text-xs text-gray-400">
                &copy; {{ date('Y') }} CarryOn Academic Management. All rights reserved.
            </p>
        </div>
    </div>

</body>
</html>
