<form action="{{ route('authenticate') }}" method="POST" class="space-y-6">

    @csrf

    @if(session('success'))
        <div class="bg-green-50 border border-green-300 text-green-700 rounded-lg px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Email -->
    <div>
        <label
            for="email"
            class="block text-xs uppercase tracking-wider text-gray-500 font-semibold mb-2">

            Academic Email

        </label>

        <div class="relative">

            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400">
                mail
            </span>

            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="name@usjr.edu.ph"
                class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-gray-50 focus:bg-white focus:border-[#0A4D8C] focus:ring-4 focus:ring-blue-100 outline-none transition"
                required>

        </div>

    </div>

    <!-- Password -->
    <div>

        <div class="flex justify-between items-center mb-2">

            <label
                for="password"
                class="text-xs uppercase tracking-wider text-gray-500 font-semibold">

                Password

            </label>

            <a
                href="#"
                class="text-sm text-[#0A4D8C] hover:underline">

                Forgot Password?

            </a>

        </div>

        <div class="relative">

            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-gray-400">
                lock
            </span>

            <input
                id="password"
                type="password"
                name="password"
                placeholder="Enter your password"
                class="w-full h-12 pl-12 pr-4 rounded-xl border border-gray-300 bg-gray-50 focus:bg-white focus:border-[#0A4D8C] focus:ring-4 focus:ring-blue-100 outline-none transition"
                required>

        </div>

    </div>

    <!-- Remember -->
    <div class="flex items-center justify-between">

        <label class="flex items-center gap-2 text-sm text-gray-600">

            <input
                type="checkbox"
                name="remember"
                class="rounded border-gray-300 text-[#0A4D8C] focus:ring-[#0A4D8C]">

            Remember me

        </label>

    </div>

    <!-- Login Button -->
    <button
        type="submit"
        class="w-full h-12 rounded-xl bg-[#0A4D8C] hover:bg-[#083A69] text-white font-semibold shadow-md hover:shadow-lg transition duration-300">

        <span class="flex items-center justify-center gap-2">

            <span class="material-symbols-outlined text-[20px]">
                login
            </span>

            Sign In

        </span>

    </button>

</form>