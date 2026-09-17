<header class="h-20 bg-white border-b border-gray-200/80 px-8 flex items-center justify-between sticky top-0 z-20">

    <!-- Left Header Info -->
    <div>
        <h2 class="text-base font-bold text-gray-900">
            Instructor Portal
        </h2>
        <p class="text-xs text-gray-500">
            Manage your courses, student groups, and projects
        </p>
    </div>

    <!-- Right Profile -->
    <div class="flex items-center gap-3 select-none">
        <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-gray-900 leading-tight">
                {{ Auth::user()->name ?? 'Dr. Julian Vance' }}
            </p>
            <p class="text-xs text-gray-500 font-medium">
                {{ Auth::user()->role ?? 'Senior Instructor' }}
            </p>
        </div>

        @if(file_exists(public_path('images/instructor_avatar.png')))
            <img
                src="{{ asset('images/instructor_avatar.png') }}"
                alt="User Avatar"
                class="w-10 h-10 rounded-full object-cover border border-gray-200 shadow-xs"
            >
        @else
            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold text-sm flex items-center justify-center border border-blue-200 shadow-xs">
                {{ strtoupper(substr(Auth::user()->name ?? 'I', 0, 1)) }}
            </div>
        @endif
    </div>

</header>