<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

```
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'CarryOn') }}</title>

{{-- Tailwind CSS --}}
<script src="https://cdn.tailwindcss.com"></script>

@stack('styles')
```

</head>

<body class="bg-gray-50 text-gray-800 min-h-screen">

```
{{-- =========================================================
     TOP NAVIGATION
========================================================== --}}

<nav class="fixed top-0 left-0 right-0 z-50
            bg-white border-b border-gray-200 shadow-sm">

    <div class="h-16 px-6 flex items-center justify-between">

        {{-- LOGO --}}

        <div class="flex items-center">

            <a
                href="{{ route('student.dashboard') }}"
                class="text-2xl font-bold text-blue-600"
            >
                CarryOn
            </a>

        </div>


        {{-- RIGHT SIDE --}}

        <div class="flex items-center gap-5">

            @auth

                {{-- =================================================
                     NOTIFICATIONS
                ================================================== --}}

                @php
                    $unreadCount = \App\Models\Student\Notification::where(
                        'user_id',
                        auth()->id()
                    )
                    ->where('is_read', false)
                    ->count();
                @endphp

                <a
                    href="{{ route('student.notifications.index') }}"
                    class="relative flex items-center gap-2
                           px-4 py-2
                           bg-blue-600
                           text-white
                           rounded-lg
                           hover:bg-blue-700
                           transition
                           shadow-sm
                           whitespace-nowrap"
                >

                    <span class="text-xl leading-none">
                        🔔
                    </span>

                    <span class="font-medium">
                        Notifications
                    </span>

                    @if($unreadCount > 0)

                        <span
                            class="flex items-center justify-center
                                   min-w-[22px]
                                   h-[22px]
                                   px-1
                                   bg-red-500
                                   text-white
                                   text-xs
                                   font-bold
                                   rounded-full"
                        >
                            {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                        </span>

                    @endif

                </a>


                {{-- USER --}}

                <div class="hidden sm:block text-right">

                    <p class="text-sm font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ auth()->user()->role }}
                    </p>

                </div>


                {{-- LOGOUT --}}

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="px-4 py-2
                               text-sm
                               font-medium
                               text-gray-600
                               hover:text-red-600
                               transition
                               whitespace-nowrap"
                    >
                        Logout
                    </button>

                </form>

            @endauth

        </div>

    </div>

</nav>


{{-- =========================================================
     SIDEBAR
========================================================== --}}

<aside
    class="fixed
           top-16
           left-0
           bottom-0
           z-40
           w-64
           bg-white
           border-r
           border-gray-200
           shadow-sm
           overflow-y-auto"
>

    <div class="p-5">

        {{-- STUDENT MENU --}}

        <p class="px-3 mb-3 text-xs font-semibold
                  uppercase tracking-wider text-gray-400">
            Student Menu
        </p>


        <nav class="space-y-1">

            {{-- =================================================
                 DASHBOARD
            ================================================== --}}

            <a
                href="{{ route('student.dashboard') }}"
                class="flex items-center gap-3
                       px-4 py-3
                       rounded-xl
                       text-gray-700
                       hover:bg-blue-50
                       hover:text-blue-600
                       transition"
            >

                <span class="text-lg">
                    🏠
                </span>

                <span class="font-medium">
                    Dashboard
                </span>

            </a>


            {{-- =================================================
                 CURRENT CLASS
            ================================================== --}}

            @php
                $studentClasses = auth()->user()
                    ->classes()
                    ->latest('class_rooms.id')
                    ->get();
            @endphp


            <div class="pt-4">

                <p class="px-4 mb-2 text-xs font-semibold
                          uppercase tracking-wider text-gray-400">
                    My Classes
                </p>


                @forelse($studentClasses as $studentClass)

                    <a
                        href="{{ route(
                            'student.class.detail',
                            $studentClass->id
                        ) }}"
                        class="flex items-center gap-3
                               px-4 py-3
                               rounded-xl
                               text-gray-700
                               hover:bg-blue-50
                               hover:text-blue-600
                               transition"
                    >

                        <span class="text-lg">
                            📚
                        </span>

                        <div class="min-w-0">

                            <p class="font-medium truncate">
                                {{ $studentClass->course_code }}
                            </p>

                            <p class="text-xs text-gray-400 truncate">
                                {{ $studentClass->course_name }}
                            </p>

                        </div>

                    </a>

                @empty

                    <p class="px-4 py-2 text-sm text-gray-400">
                        No classes enrolled.
                    </p>

                @endforelse

            </div>


            {{-- =================================================
                 NOTIFICATIONS
            ================================================== --}}

            <div class="pt-4">

                <a
                    href="{{ route('student.notifications.index') }}"
                    class="flex items-center justify-between
                           px-4 py-3
                           rounded-xl
                           text-gray-700
                           hover:bg-blue-50
                           hover:text-blue-600
                           transition"
                >

                    <div class="flex items-center gap-3">

                        <span class="text-lg">
                            🔔
                        </span>

                        <span class="font-medium">
                            Notifications
                        </span>

                    </div>


                    @if($unreadCount > 0)

                        <span
                            class="flex items-center justify-center
                                   min-w-[22px]
                                   h-[22px]
                                   px-1
                                   bg-red-500
                                   text-white
                                   text-xs
                                   font-bold
                                   rounded-full"
                        >
                            {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                        </span>

                    @endif

                </a>

            </div>

        </nav>


        {{-- =================================================
             SIDEBAR FOOTER
        ================================================== --}}

        <div class="mt-8 pt-5 border-t border-gray-200">

            <div class="px-4">

                <p class="text-xs text-gray-400">
                    Signed in as
                </p>

                <p class="text-sm font-semibold text-gray-700 mt-1 truncate">
                    {{ auth()->user()->name }}
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    Student
                </p>

            </div>

        </div>

    </div>

</aside>


{{-- =========================================================
     MAIN CONTENT
========================================================== --}}

<main class="ml-64 pt-16 min-h-screen">

    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div class="max-w-7xl mx-auto px-6 pt-6">

            <div
                class="p-4
                       bg-green-100
                       border border-green-200
                       text-green-700
                       rounded-lg"
            >
                {{ session('success') }}
            </div>

        </div>

    @endif


    {{-- ERROR MESSAGE --}}

    @if(session('error'))

        <div class="max-w-7xl mx-auto px-6 pt-6">

            <div
                class="p-4
                       bg-red-100
                       border border-red-200
                       text-red-700
                       rounded-lg"
            >
                {{ session('error') }}
            </div>

        </div>

    @endif


    {{-- PAGE CONTENT --}}

    <div class="px-6 py-8">

        @yield('content')

    </div>

</main>


@stack('scripts')
```

</body>

</html>
