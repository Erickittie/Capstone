<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

```
<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
>

<meta
    name="csrf-token"
    content="{{ csrf_token() }}"
>

<title>
    @yield('title', 'Admin Portal') | CarryOn
</title>

{{-- Tailwind --}}
<script src="https://cdn.tailwindcss.com"></script>

@stack('styles')
```

</head>

<body class="bg-gray-50 text-gray-800">

```
{{-- =====================================================
     ADMIN SIDEBAR
====================================================== --}}

<aside
    class="fixed
           left-0
           top-0
           w-[260px]
           h-screen
           bg-white
           border-r
           border-gray-200
           shadow-sm
           flex
           flex-col
           z-50"
>


    {{-- LOGO --}}

    <div class="p-6 border-b border-gray-200">

        <h1 class="text-3xl font-bold text-blue-700">
            CarryOn
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Admin Portal
        </p>

    </div>


    {{-- NAVIGATION --}}

    <nav class="flex-1 p-4 space-y-2">


        {{-- DASHBOARD --}}

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-gray-700
                   hover:bg-blue-50
                   hover:text-blue-700
                   transition"
        >

            <span class="text-lg">
                📊
            </span>

            <span class="font-medium">
                Dashboard
            </span>

        </a>


        {{-- USERS --}}

        <a
            href="{{ route('users.index') }}"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-gray-700
                   hover:bg-blue-50
                   hover:text-blue-700
                   transition"
        >

            <span class="text-lg">
                👥
            </span>

            <span class="font-medium">
                Users
            </span>

        </a>


        {{-- CLASSES --}}

        <a
            href="{{ route('classes.index') }}"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-gray-700
                   hover:bg-blue-50
                   hover:text-blue-700
                   transition"
        >

            <span class="text-lg">
                📚
            </span>

            <span class="font-medium">
                Classes
            </span>

        </a>


        {{-- REPORTS --}}

        <a
            href="{{ route('reports.index') }}"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-gray-700
                   hover:bg-blue-50
                   hover:text-blue-700
                   transition"
        >

            <span class="text-lg">
                📄
            </span>

            <span class="font-medium">
                Reports
            </span>

        </a>


    </nav>


    {{-- =====================================================
         ADMIN ACCOUNT
    ====================================================== --}}

    <div class="p-4 border-t border-gray-200">


        @auth

            <div class="px-3 mb-3">

                <p class="text-sm font-semibold text-gray-800">
                    {{ auth()->user()->name }}
                </p>

                <p class="text-xs text-gray-500">
                    {{ auth()->user()->role }}
                </p>

            </div>

        @endauth


        {{-- LOGOUT --}}

        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="w-full
                       flex
                       items-center
                       justify-center
                       gap-2
                       px-4
                       py-3
                       bg-red-600
                       hover:bg-red-700
                       text-white
                       font-medium
                       rounded-lg
                       transition"
            >

                <span>
                    🚪
                </span>

                <span>
                    Logout
                </span>

            </button>

        </form>

    </div>

</aside>



{{-- =====================================================
     MAIN CONTENT
====================================================== --}}

<main
    class="ml-[260px]
           min-h-screen
           p-6"
>


    {{-- SUCCESS --}}

    @if(session('success'))

        <div class="max-w-7xl mx-auto mb-6">

            <div
                class="p-4
                       bg-green-50
                       border
                       border-green-200
                       text-green-700
                       rounded-xl"
            >

                {{ session('success') }}

            </div>

        </div>

    @endif


    {{-- ERROR --}}

    @if(session('error'))

        <div class="max-w-7xl mx-auto mb-6">

            <div
                class="p-4
                       bg-red-50
                       border
                       border-red-200
                       text-red-700
                       rounded-xl"
            >

                {{ session('error') }}

            </div>

        </div>

    @endif


    {{-- PAGE CONTENT --}}

    @yield('content')


</main>


@stack('scripts')
```

</body>

</html>
