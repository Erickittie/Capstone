```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CarryOn') }}</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
</head>


<body class="bg-gray-50 text-gray-800">

    {{-- =====================================================
         NAVIGATION BAR
    ====================================================== --}}

    <nav class="bg-white border-b border-gray-200 shadow-sm">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-center justify-between h-16">


                {{-- =================================================
                     LOGO
                ================================================== --}}

                <div>

                    @auth

                        @if(auth()->user()->role === 'Student')

                            <a
                                href="{{ route('student.dashboard') }}"
                                class="text-2xl font-bold text-blue-600"
                            >
                                CarryOn
                            </a>

                        @elseif(auth()->user()->role === 'Instructor')

                            <a
                                href="{{ route('instructor.dashboard') }}"
                                class="text-2xl font-bold text-blue-600"
                            >
                                CarryOn
                            </a>

                        @else

                            <a
                                href="/"
                                class="text-2xl font-bold text-blue-600"
                            >
                                CarryOn
                            </a>

                        @endif

                    @else

                        <a
                            href="/"
                            class="text-2xl font-bold text-blue-600"
                        >
                            CarryOn
                        </a>

                    @endauth

                </div>



                {{-- =================================================
                     RIGHT SIDE
                ================================================== --}}

                <div class="flex items-center gap-5">

                    @auth

                        {{-- =================================================
                             NOTIFICATION BUTTON
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
                                   shadow-sm"
                            title="Notifications"
                        >

                            {{-- Bell --}}
                            <span class="text-xl leading-none">
                                🔔
                            </span>


                            {{-- Text --}}
                            <span class="font-medium">
                                Notifications
                            </span>


                            {{-- Unread Count --}}
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



                        {{-- =================================================
                             USER INFORMATION
                        ================================================== --}}

                        <div class="hidden sm:block text-right">

                            <p class="text-sm font-semibold text-gray-800">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                {{ auth()->user()->role }}
                            </p>

                        </div>



                        {{-- =================================================
                             LOGOUT
                        ================================================== --}}

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
                                       transition"
                            >
                                Logout
                            </button>

                        </form>


                    @else


                        {{-- =================================================
                             LOGIN
                        ================================================== --}}

                        <a
                            href="{{ route('login') }}"
                            class="px-4 py-2
                                   text-sm
                                   font-medium
                                   text-blue-600
                                   hover:text-blue-700"
                        >
                            Login
                        </a>


                    @endauth

                </div>

            </div>

        </div>

    </nav>



    {{-- =====================================================
         PAGE CONTENT
    ====================================================== --}}

    <main class="min-h-screen">


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

        @yield('content')


    </main>



    {{-- PAGE SCRIPTS --}}

    @stack('scripts')

</body>

</html>
```
