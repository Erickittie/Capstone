<aside class="fixed left-0 top-0 z-40 w-[260px] h-screen bg-white border-r border-gray-200/80 flex flex-col select-none">

    <!-- Logo Section -->
    <div class="h-20 px-6 flex items-center gap-3 border-b border-gray-100">
        <img
            src="{{ asset('images/carryon_logo_mark_v2.png') }}"
            alt="CarryOn Logo"
            class="h-8 w-auto object-contain drop-shadow-sm"
        >
        <div class="leading-tight">
            <h1 class="text-lg font-black tracking-tight text-gray-950 font-sans">
                CarryOn
            </h1>
            <p class="text-[9px] tracking-[0.2em] font-semibold text-gray-400 uppercase">
                ACADEMIC MANAGEMENT
            </p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">

        <!-- Dashboard -->
        <a href="{{ route('student.dashboard') }}"
           class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('student.dashboard') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
            <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('student.dashboard') ? 'text-gray-900' : 'text-gray-400' }}">
                grid_view
            </span>
            <span class="text-sm">Dashboard</span>
        </a>

        @if(isset($class))
            <!-- Section label -->
            <div class="pt-3 pb-1 px-1">
                <p class="text-[9px] tracking-[0.18em] font-semibold text-gray-400 uppercase truncate">
                    {{ $class->course_code }}
                </p>
            </div>

            <!-- Class Overview -->
            <a href="{{ route('student.class.detail', $class->id) }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('student.class.detail') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('student.class.detail') ? 'text-gray-900' : 'text-gray-400' }}">
                    class
                </span>
                <span class="text-sm">Class Overview</span>
            </a>

            <!-- My Contribution -->
            <a href="{{ route('student.contribution', $class->id) }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('student.contribution') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('student.contribution') ? 'text-gray-900' : 'text-gray-400' }}">
                    monitoring
                </span>
                <span class="text-sm">My Contribution</span>
            </a>

            <!-- Group Status -->
            <a href="{{ route('student.group.status', $class->id) }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('student.group.status') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('student.group.status') ? 'text-gray-900' : 'text-gray-400' }}">
                    groups
                </span>
                <span class="text-sm">Group Status</span>
            </a>

            <!-- Leader Voting -->
            <a href="{{ route('student.vote.index', $class->id) }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('student.vote.*') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('student.vote.*') ? 'text-gray-900' : 'text-gray-400' }}">
                    how_to_vote
                </span>
                <span class="text-sm">Leader Voting</span>
            </a>

            <!-- My Tasks -->
            <a href="{{ route('student.task.manager', $class->id) }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('student.task.manager') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('student.task.manager') ? 'text-gray-900' : 'text-gray-400' }}">
                    assignment
                </span>
                <span class="text-sm">My Tasks</span>
            </a>

            <!-- File Repository -->
            <a href="{{ route('student.file.repository', $class->id) }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('student.file.repository') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('student.file.repository') ? 'text-gray-900' : 'text-gray-400' }}">
                    folder_open
                </span>
                <span class="text-sm">File Repository</span>
            </a>

            <!-- Check-In Request -->
            <a href="{{ route('student.checkin.index', $class->id) }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('student.checkin.*') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('student.checkin.*') ? 'text-gray-900' : 'text-gray-400' }}">
                    event_available
                </span>
                <span class="text-sm">Check-In Request</span>
            </a>
        @endif

    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-gray-100">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="w-full flex items-center gap-3.5 px-4 py-3 rounded-xl text-gray-600 hover:bg-red-50 hover:text-red-600 font-medium text-sm transition duration-150 group">
                <span class="material-symbols-outlined text-[22px] text-gray-400 group-hover:text-red-500 transition-colors">
                    logout
                </span>
                <span>Log Out</span>
            </button>
        </form>
    </div>

</aside>
