<!DOCTYPE html>
<html lang="en">

<head>

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
        @yield('title', 'CarryOn - Student Portal')
    </title>


    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Google Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- Material Symbols -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    >


    <style>

        html {
            overflow-y: scroll;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
        }

        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24;
        }

    </style>


    @stack('styles')

    @yield('head')

</head>


<body class="bg-[#F8FAFC] text-gray-900 min-h-screen">


    <!-- =====================================================
         FIXED STUDENT SIDEBAR
    ====================================================== -->

    @include('layouts.student-sidebar')


    <!-- =====================================================
         MAIN APPLICATION AREA
    ====================================================== -->

    <div class="ml-[260px] min-h-screen flex flex-col">


        <!-- =================================================
             FIXED STUDENT NAVBAR
        ================================================== -->

        @include('layouts.student-navbar')


        <!-- =================================================
             FLASH MESSAGES
        ================================================== -->

        @if(session('success'))

            <div class="px-8 pt-6">

                <div
                    class="
                        bg-green-50
                        border
                        border-green-200
                        text-green-700
                        px-4
                        py-3
                        rounded-xl
                        text-sm
                    "
                >

                    {{ session('success') }}

                </div>

            </div>

        @endif


        @if(session('error'))

            <div class="px-8 pt-6">

                <div
                    class="
                        bg-red-50
                        border
                        border-red-200
                        text-red-700
                        px-4
                        py-3
                        rounded-xl
                        text-sm
                    "
                >

                    {{ session('error') }}

                </div>

            </div>

        @endif


        <!-- =================================================
             PAGE CONTENT
        ================================================== -->

        <main class="flex-1 px-8 pt-28 pb-8">

            @yield('content')

        </main>


    </div>


    @stack('scripts')

    @yield('scripts')

</body>

</html>