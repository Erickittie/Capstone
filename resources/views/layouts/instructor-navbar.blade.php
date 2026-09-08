<header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-8">

    <div>
        <h2 class="text-xl font-semibold text-gray-800">
            Instructor Portal
        </h2>

        <p class="text-sm text-gray-500">
            Manage your classes and projects
        </p>
    </div>


    <div class="flex items-center gap-4">

        <div class="text-right">

            <p class="text-sm font-semibold text-gray-800">
                {{ Auth::user()->name }}
            </p>

            <p class="text-xs text-gray-500">
                Instructor
            </p>

        </div>

        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold">

            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

        </div>

    </div>

</header>