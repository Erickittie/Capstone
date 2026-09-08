<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>CarryOn - Instructor</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

</head>


<body class="bg-gray-50">

    {{-- ================================= --}}
    {{-- INSTRUCTOR SIDEBAR --}}
    {{-- ================================= --}}

    @include('layouts.instructor-sidebar')


    {{-- ================================= --}}
    {{-- MAIN AREA --}}
    {{-- ================================= --}}

    <main class="ml-[260px] min-h-screen">


        {{-- ================================= --}}
        {{-- INSTRUCTOR NAVBAR --}}
        {{-- ================================= --}}

        @include('layouts.instructor-navbar')


        {{-- ================================= --}}
        {{-- PAGE CONTENT --}}
        {{-- ================================= --}}

        <div class="p-8">

            @yield('content')

        </div>


    </main>

</body>

</html>