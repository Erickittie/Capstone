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
        <a href="{{ route('instructor.dashboard') }}"
           class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('instructor.dashboard') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
            <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('instructor.dashboard') ? 'text-gray-900' : 'text-gray-400' }}">
                grid_view
            </span>
            <span class="text-sm">Dashboard</span>
        </a>

        @if(isset($classId))
            <!-- Task Ledger for active class -->
            <a href="{{ route('instructor.tasks.ledger', $classId) }}"
               class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition duration-150 {{ request()->routeIs('instructor.tasks.ledger*') ? 'bg-gray-100 text-gray-950 font-semibold shadow-xs' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium' }}">
                <span class="material-symbols-outlined text-[22px] {{ request()->routeIs('instructor.tasks.ledger*') ? 'text-gray-900' : 'text-gray-400' }}">
                    format_list_bulleted
                </span>
                <span class="text-sm">Task Ledger</span>
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