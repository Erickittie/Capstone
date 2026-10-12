<div class="flex flex-col h-full text-gray-900 antialiased font-sans bg-white border-r border-gray-200">
    <!-- Top Branding / Dashboard Link -->
    <div class="p-6">
        <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium">
            <span class="material-symbols-outlined text-[20px]">dashboard</span>
            <span>Dashboard</span>
        </a>
    </div>

    <!-- Class-Specific Links (Only show when inside a class) -->
    @isset($class)
        <div class="flex-1 px-4 py-2 space-y-1.5 overflow-y-auto">
            <div class="pt-3 pb-1.5 px-3.5 text-[10px] uppercase tracking-wider text-gray-400 font-semibold">
                {{ $class->course_code ?? 'Class' }}
            </div>

            <a href="{{ route('student.class.detail', $class->id) }}" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium">
                <span class="material-symbols-outlined text-[20px] text-gray-500">class</span>
                <span>Class Overview</span>
            </a>
            <a href="{{ route('student.contribution', $class->id) }}" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">monitoring</span>
                <span>Contribution</span>
            </a>
            <a href="{{ route('student.group.status', $class->id) }}" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">groups</span>
                <span>Group Status</span>
            </a>
            <a href="{{ route('student.vote.index', $class->id) }}" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">how_to_vote</span>
                <span>Leader Vote</span>
            </a>
            <a href="{{ route('student.task.manager', $class->id) }}" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">assignment</span>
                <span>Task Manager</span>
            </a>
            <a href="{{ route('student.file.repository', $class->id) }}" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">folder_open</span>
                <span>File Repository</span>
            </a>
            <a href="{{ route('student.checkin.index', $class->id) }}" class="flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium pl-9">
                <span class="material-symbols-outlined text-[20px] text-gray-500">event_available</span>
                <span>Check-In Request</span>
            </a>
        </div>
    @endisset

    <!-- Logout / Bottom Section -->
    <div class="p-4 border-t border-gray-100">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg text-[14px] font-medium">
                <span class="material-symbols-outlined text-[20px]">logout</span>
                <span>Log Out</span>
            </button>
        </form>
    </div>
</div>