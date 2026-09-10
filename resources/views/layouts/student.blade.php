<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'CarryOn - Student')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    @yield('head')
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- TOP NAVBAR -->
    <nav class="bg-white border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
        <div class="h-16 px-6 flex items-center justify-between">

            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-lg">C</span>
                </div>

                <div>
                    <h1 class="font-bold text-gray-800 text-lg">
                        CarryOn
                    </h1>

                    <p class="text-xs text-gray-500">
                        Student Portal
                    </p>
                </div>
            </div>

            <!-- Right side -->
            <div class="flex items-center gap-4">

                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        Student
                    </p>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>


    <!-- SIDEBAR -->
    <aside class="fixed top-16 left-0 bottom-0 w-64 bg-white border-r border-gray-200">

        <div class="p-4">

            <p class="text-xs font-semibold text-gray-400 uppercase mb-3">
                Student Menu
            </p>

            <!-- Dashboard -->
            <a
                href="{{ route('student.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg
                       text-gray-700 hover:bg-blue-50 hover:text-blue-600 mb-1">

                <span>🏠</span>

                <span class="font-medium">
                    Dashboard
                </span>

            </a>


            <!-- My Classes -->
            <a
                href="{{ route('student.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg
                       text-gray-700 hover:bg-blue-50 hover:text-blue-600 mb-1">

                <span>📚</span>

                <span class="font-medium">
                    My Classes
                </span>

            </a>


            <div class="border-t border-gray-200 my-4"></div>


            <p class="text-xs font-semibold text-gray-400 uppercase mb-3">
                Class Management
            </p>


            <!-- These will work when a class is selected -->
            @if(isset($class))

                <a
                    href="{{ route('student.class.detail', $class->id) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                           text-gray-700 hover:bg-blue-50 hover:text-blue-600 mb-1">

                    <span>📋</span>

                    <span>
                        Class Overview
                    </span>

                </a>


                <a
                    href="{{ route('student.contribution', $class->id) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                           text-gray-700 hover:bg-blue-50 hover:text-blue-600 mb-1">

                    <span>📊</span>

                    <span>
                        My Contribution
                    </span>

                </a>


                <a
                    href="{{ route('student.group.status', $class->id) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                           text-gray-700 hover:bg-blue-50 hover:text-blue-600 mb-1">

                    <span>👥</span>

                    <span>
                        Group Status
                    </span>

                </a>


                <a
                    href="{{ route('student.task.manager', $class->id) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                           text-gray-700 hover:bg-blue-50 hover:text-blue-600 mb-1">

                    <span>✅</span>

                    <span>
                        My Tasks
                    </span>

                </a>


                <a
                    href="{{ route('student.file.repository', $class->id) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                           text-gray-700 hover:bg-blue-50 hover:text-blue-600 mb-1">

                    <span>📁</span>

                    <span>
                        File Repository
                    </span>

                </a>


                <a
                    href="{{ route('student.checkin.index', $class->id) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg
                           text-gray-700 hover:bg-blue-50 hover:text-blue-600 mb-1">

                    <span>🕐</span>

                    <span>
                        Check-in Request
                    </span>

                </a>

            @endif

        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="ml-64 pt-16 min-h-screen">

        <div class="p-6">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200
                            text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif


            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200
                            text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif


            @yield('content')

        </div>

    </main>


    @yield('scripts')

</body>
</html>