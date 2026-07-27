<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CarryOn</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

<div class="flex">

    @include('layouts.sidebar')

    <div class="flex-1 ml-[260px]">

        @include('layouts.navbar')

        <div class="p-8">

            @yield('content')

        </div>

    </div>

</div>

</body>

</html>