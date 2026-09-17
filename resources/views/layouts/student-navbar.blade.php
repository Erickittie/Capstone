<header class="h-20 bg-white border-b border-gray-200/80 px-8 flex items-center justify-between sticky top-0 z-20">

    <!-- Left Header Info -->
    <div>
        <h2 class="text-base font-bold text-gray-900">
            Student Portal
        </h2>
        <p class="text-xs text-gray-500">
            Manage your classes, tasks, and group collaboration
        </p>
    </div>

    <!-- Right Profile -->
    <div class="flex items-center gap-3 select-none">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-gray-900 leading-tight">
                {{ Auth::user()->name ?? 'Student' }}
            </p>
            <p class="text-xs text-gray-500 font-medium">
                {{ Auth::user()->role ?? 'Student' }}
            </p>
        </div>

        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold text-sm flex items-center justify-center border border-blue-200 shadow-xs">
            {{ strtoupper(substr(Auth::user()->name ?? 'S', 0, 1)) }}
        </div>
    </div>

</header>
