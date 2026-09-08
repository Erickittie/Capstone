<aside
    class="fixed
           left-0
           top-0
           z-40
           w-[260px]
           h-screen
           bg-white
           border-r
           border-gray-200"
>


    {{-- ================================= --}}
    {{-- LOGO --}}
    {{-- ================================= --}}

    <div
        class="h-[80px]
               px-6
               flex
               items-center
               border-b
               border-gray-200"
    >

        <div>

            <h1 class="text-xl font-bold text-gray-900">
                CarryOn
            </h1>

            <p class="text-xs text-gray-500">
                Instructor Portal
            </p>

        </div>

    </div>


    {{-- ================================= --}}
    {{-- NAVIGATION --}}
    {{-- ================================= --}}

    <nav class="p-4 space-y-2">


        {{-- Dashboard --}}

        <a
            href="{{ route('instructor.dashboard') }}"
            class="flex
                   items-center
                   gap-3
                   px-4
                   py-3
                   rounded-lg
                   text-gray-700
                   hover:bg-blue-50
                   hover:text-blue-600
                   transition"
        >

            <span class="text-xl">
                🏠
            </span>

            <span class="font-medium">
                Dashboard
            </span>

        </a>


        {{-- My Classes --}}

        <a
            href="{{ route('instructor.dashboard') }}"
            class="flex
                   items-center
                   gap-3
                   px-4
                   py-3
                   rounded-lg
                   text-gray-700
                   hover:bg-blue-50
                   hover:text-blue-600
                   transition"
        >

            <span class="text-xl">
                📚
            </span>

            <span class="font-medium">
                My Classes
            </span>

        </a>

    </nav>


    {{-- ================================= --}}
    {{-- LOGOUT --}}
    {{-- ================================= --}}

    <div
        class="absolute
               bottom-0
               left-0
               right-0
               p-4
               border-t
               border-gray-200"
    >

        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="w-full
                       flex
                       items-center
                       gap-3
                       px-4
                       py-3
                       rounded-lg
                       text-red-600
                       hover:bg-red-50
                       transition"
            >

                <span class="text-xl">
                    🚪
                </span>

                <span class="font-medium">
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>