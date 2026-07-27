<nav class="w-[260px] h-screen fixed left-0 top-0 flex flex-col bg-white border-r border-gray-200 shadow-sm">

    <!-- Logo -->
    <div class="p-6 border-b">
        <h1 class="text-3xl font-bold text-blue-700">
            CarryOn
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Admin Portal
        </p>
    </div>

    <!-- Navigation -->
    <div class="flex-1 p-4 space-y-2">

        <a href="{{ route('dashboard') }}"
           class="block px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">

            📊 Dashboard

        </a>

        <a href="{{ route('users.index') }}"
           class="block px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">

            👥 Users

        </a>

        <a href="{{ route('classes.index') }}"
           class="block px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">

            📚 Classes

        </a>

        <a href="{{ route('reports.index') }}"
           class="block px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-700 transition">

            📄 Reports

        </a>

    </div>

    <!-- Logout -->
    <div class="p-4 border-t">

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button
                type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg transition">

                🚪 Logout

            </button>

        </form>

    </div>

</nav>